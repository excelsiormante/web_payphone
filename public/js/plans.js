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

                        //htmlstring = htmlstring +'<div class="media wow fadeInRight">';
                        htmlstring = htmlstring +'<a href="#confirmationModal" class="btn btn-primary" data-toggle="modal" onclick="confirmProduct('+response[group][products]['id']+')">'+response[group][products]['name']+' &nbsp;&nbsp;&nbsp; <strong>$'+response[group][products]['price']+'</strong></a>';
                        //htmlstring = htmlstring +'</div>'; 
                    }); 

                    htmlstring = htmlstring + '</li>' ;

                    $('#div_products').append(htmlstring);
                    $('#plangroup').append(grouplabel);
                });

                //load subscribe flip after loading html tags               
                $.getScript("js/lib/subscribe-flip.js");

                overlay.delay(500).fadeOut('fast');

            }
          },
          error:function(){
            // failed request; give feedback to user
            $('#subscribe-ajax').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
          },
          complete: function(){
              load_js();
          }
    });
});

function load_js(){
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