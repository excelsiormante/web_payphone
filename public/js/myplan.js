$("#selectplan").click(function(){
    $(".section").fadeOut('fast');
    $("#tab_selectplan").delay(50).fadeIn('fast');
    
    $.ajax({
        type     : 'GET',
        url      : 'api/myplans',
        dataType : "json",
        beforeSend:function(){
            overlay.show();
        },
        success:function(response){
            overlay.delay(500).fadeOut('fast');
            if ( response.result === 2 ) {
                alert(response.message);
            } else {
                var plans = response.data;
                $("#myplans").empty();
                var html = "";
                $.each(plans, function(group){
                    html += '<a href="#call" data-product="'+plans[group].product_id+'" onclick="generateCallPage(this)">\n\
                                <div class="col-md-12 text-center">\n\
                                    <div class="col-md-5">\n\
                                        <img src="" class="img-responsive pull-right" style="height:60px; width:60px; margin-top:25px">\n\
                                    </div>\n\
                                    <div class="col-md-7">\n\
                                        <h3 class="text-left">'+group+'</h3>\n\
                                        <p class="text-left">'+plans[group].remaining_days+' days left before expiration</p>\n\
                                    </div>\n\
                                </div>\n\
                            </a>';
                });
                $("#myplans").html(html);
            }
        },
        error:function(){
                
            }
        });
    });

function generateCallPage(_this){
    if ( typeof _this === "string" ) {
        var product_id = _this;
    } else {
        var product_id = $(_this).data("product");
    }
    $(".section").fadeOut('fast');
    $("#tab_call").delay(50).fadeIn('fast');
    $("#plan_id").val(product_id);
    $.ajax({
          type: 'GET',
          url: 'api/get_speed_dials',
          dataType : "json",
          beforeSend:function(){
            // this is where we append a loading image
            $('#div_call').hide();
            overlay.show();
          },
          success:function(response){
            overlay.delay(500).fadeOut('fast');
            if ( response.result === 2 ) {
                alert(response.message);
            } else {
                if ( response.data.length === 0 ) {
                    alert("No available plan.");
                    $("#subscribe").trigger("click");
                } else {
                    var data = response.data;
                    
                    if ( typeof product_id == "undefined" ) {
                        $("#plan").html(data[0]['product_type']);
                        $("#remaining_mins").html(data[0]['remain_days'] + " days left.");
                        
                        $("#div_speed_dials").empty();
                        var numbers = data[0]['numbers'];
                        if ( numbers.length > 0 ) {
                            $.each(numbers, function(key){
                                var number = numbers[key];
                                $("#div_speed_dials").append('<a href="#" class="btn btn-primary dialer" onclick="call('+number.bnumber+')" id="menu-toggle"><strong><font color="#44ff00">Call : &nbsp; &nbsp; '+number.bnumber+'</font></strong> &nbsp;&nbsp;&nbsp;</a></br>');
                            });
                        }
                    }
                    
                    $("#plan_types").empty();
                    $.each(data, function(key){
                        var plan = data[key];
                        
                        if ( typeof product_id == "undefined" ) {
                            $("#plan_types").append("<option value='"+plan.product_id+"'>"+plan.product_type+"</option>");
                        } else {
                            if ( product_id == plan.product_id ) {
                                $("#plan_types").append("<option value='"+plan.product_id+"' selected>"+plan.product_type+"</option>");
                                $("#plan").html(data[key]['product_type']);
                                $("#remaining_mins").html(data[key]['remain_days'] + " days left.");

                                $("#div_speed_dials").empty();
                                var numbers = data[key]['numbers'];
                                if ( numbers.length > 0 ) {
                                    $.each(numbers, function(item){
                                        var number = numbers[item];
                                        $("#div_speed_dials").append('<a href="#" class="btn btn-primary dialer" onclick="call('+number.bnumber+')" id="menu-toggle"><strong><font color="#44ff00">Call : &nbsp; &nbsp; '+number.bnumber+'</font></strong> &nbsp;&nbsp;&nbsp;</a></br>');
                                    });
                                }
                            } else {
                                $("#plan_types").append("<option value='"+plan.product_id+"'>"+plan.product_type+"</option>");
                            }
                        }
                    });
                }
            }
          },
          error:function(){

          },
          complete:function(){
            $('#div_call').show();
          }
    });
}

function addSpeedDial(){
    var product_id =  $("#plan_id").val();
    $.ajax({
          type: 'GET',
          url: 'api/add_speed_dial',
          dataType: "json",
          data: {
              product_id        : product_id,
              speed_dial_number : $("#speed_dial_number").val()
          },
          beforeSend:function(){
            
          },
          success:function(response){
            if ( response.result === 1 ) {
                $("#speed_dial_number").val("");
                alert(response.message);
                generateCallPage(product_id);
            } else {
                alert(response.message);
            }
          },
          error:function(){
            
          }
    });
}

function call(number){
    $("#telNumber").val(number);
    $("#dialer").trigger("click");
}