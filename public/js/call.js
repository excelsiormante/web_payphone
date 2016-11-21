function addSpeedDial(){
    var product_id = $("#plan_types").val();
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

function call(){
    alert("Unsupported yet.");
}

function changeProduct(){
    generateCallPage($("#plan_types").val());
}

$("#call").click(function(){
    generateCallPage();
});

function generateCallPage(product_id){
    $(".section").fadeOut('fast');
    $("#tab_call").delay(50).fadeIn('fast');
    
    $.ajax({
          type: 'GET',
          url: 'api/get_speed_dials',
          dataType : "json",
          data: {
              product_id : product_id
          },
          beforeSend:function(){
            // this is where we append a loading image
            $('#div_call').hide();
            overlay.show();
          },
          success:function(response){
            overlay.delay(500).fadeOut('fast');
            if ( response['plans'] === false ) {
                alert("No available plan.");
                $("#subscribe").trigger("click");
            } else {
                
                $("#plan").html(response['selected_plan'].name);
                $("#remaining_mins").html(response['selected_plan'].remaining_mins + " Minutes Left");
                $("#plan_types").empty();
                $.each(response['plans'], function(plan){
                    var plan_details = response['plans'][plan];
                    if ( typeof product_id == "undefined" ) {
                        $("#plan_types").append("<option value='"+plan_details.product_id+"'>"+plan_details.product_type+"</option>");
                    } else {
                        if ( product_id == plan_details.product_id ) {
                            $("#plan_types").append("<option value='"+plan_details.product_id+"' selected>"+plan_details.product_type+"</option>");
                        } else {
                            $("#plan_types").append("<option value='"+plan_details.product_id+"'>"+plan_details.product_type+"</option>");
                        }
                    }
                });
                $("#div_speed_dials").empty();
                if ( response['speed_dials'] !== false ) {
                    $.each(response['speed_dials'], function(speed_dials){
                        var number = response['speed_dials'][speed_dials].bnumber;
                        $("#div_speed_dials").append('<a href="#" class="btn btn-primary dialer" onclick="call('+number+')" id="menu-toggle"><strong><font color="#44ff00">Call : &nbsp; &nbsp; '+number+'</font></strong> &nbsp;&nbsp;&nbsp;</a></br>');
                    });
                }
                $('#div_call').show();
            }
          },
          error:function(){

          }
    });
}