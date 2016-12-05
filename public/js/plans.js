function subscribePlan(){
    var plan_id       = $('#hid_id').val();
    var plan_price    = $('#hid_price').val();
    var plan_duration = $('#hid_duration').val();
    $.ajax({
          type: 'GET',
          url: 'api/subscribe',
          dataType: "json",
          data: {
              plan_id       : plan_id,
              plan_price    : plan_price,
              plan_duration : plan_duration
          },
          beforeSend:function(){
            
          },
          success:function(response){
            if ( response.result === 1 ) {
                alert(response.message);
                $("#selectplan").trigger("click");
            } else {
                alert(response.message);
            }
          },
          error:function(){
            
          }
    });
}

$("#subscribe").click(function(){
    $(".section").fadeOut('fast');
    $("#tab_subscribe").delay(50).fadeIn('fast');

    $.ajax({
          type: 'GET',
          url: 'api/plans',
          dataType: "json",
          beforeSend:function(){
            // this is where we append a loading image
            overlay.show();
          },
          success:function(response){
            if ( response.status === "failed" ) {
                // ERROR
            } else {
                // successful request; do something with the data
                overlay.delay(500).fadeOut('fast');
                $('#div_products').empty();
                $('#plangroup').empty();

                var countgroup = 0;
                $.each(response, function(group){
                    var htmlstring = '';
                    var grouplabel = '';
                    
                    if(countgroup == 0){
                      htmlstring = htmlstring + '<li data-type="'+group+'" class="is-visible">';
                      grouplabel = '<input type="radio" name="duration-1" value="'+group+'" id="'+group+'-1" checked><label for="'+group+'-1">'+group+'</label>';
                      countgroup = 1;
                    }else{
                      htmlstring = htmlstring + '<li data-type="'+group+'" class="is-hidden">';
                      grouplabel = '<input type="radio" name="duration-1" value="'+group+'" id="'+group+'-1"><label for="'+group+'-1">'+group+'</label>';
                    }

                    htmlstring = htmlstring + '<header class="pricing-header"><h2>'+group+'</h2></header>';

                   $.each(response[group], function(products){
                        var product_id       = response[group][products]['id'];
                        var product_name     = response[group][products]['name'];
                        var product_price    = response[group][products]['price'];
                        var product_duration = response[group][products]['duration'];
                        //htmlstring = htmlstring +'<div class="media wow fadeInRight">';
                        htmlstring = htmlstring +'<a style="min-width:350px; margin-bottom:10px; background-color:rgba(0,0,0,0.5);" data-id="'+product_id+'" data-name="'+product_name+'" data-price="'+product_price+'" data-duration="'+product_duration+'" href="#confirmationModal" class="btn btn-primary product_list" data-toggle="modal"><div class="col-md-8 text-left" style="white-space:normal; margin-top:5px;">'+response[group][products]['name']+'</div><div class="col-md-4 text-right" style="margin-top:7px; font-size:20px;"><font color="#04ff00">$'+response[group][products]['price']+'</font></div><div class="col-md-12" style="white-space:normal; font-size:13px; font-weight:200;"><hr style="max-width:250px;">'+response[group][products]['description']+'</div></a>';
                        //htmlstring = htmlstring +'</div>'; 
                    }); 

                    htmlstring = htmlstring + '</li>' ;

                    $('#div_products').append(htmlstring);
                    $('#plangroup').append(grouplabel);
                });

                //load subscribe flip after loading html tags               
                $.getScript("js/lib/subscribe-flip.js");

                

            }
          },
          error:function(){
            // failed request; give feedback to user
            $('#subscribe-ajax').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
          },
          complete: function(){
              load_plan_js();
          }
    });
});

function load_plan_js(){
    $(".product_list").click(function(){
        var product_id = $(this).data("id");
        var product_name = $(this).data("name");
        var product_price = $(this).data("price");
        var product_duration = $(this).data("duration");
        $('#hid_id').val(product_id);
        $('#hid_price').val(product_price);
        $('#hid_duration').val(product_duration);
        $('#plan_name').html(product_name);
        $('#plan_price').html("This will deduct $"+product_price+" to your E-wallet");
    });
}