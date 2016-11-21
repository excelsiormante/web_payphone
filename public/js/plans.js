function confirmProduct(plan_id){
    $.ajax({
          type: 'GET',
          url: 'api/plan_desc',
          dataType: "json",
          data: {
              plan_id : plan_id
          },
          beforeSend:function(){
            
          },
          success:function(response){
            if ( response.status === "failed" ) {
                // ERROR
            } else {
              $('#plan_id').val(response.product_id);
              $('#plan_name').html(response.name);
              $('#plan_price').html("This will deduct $"+response.price+" to your E-wallet");
            }
          },
          error:function(){
            
          }
    });
}

function subscribePlan(){
    var plan_id = $('#plan_id').val();
    $.ajax({
          type: 'GET',
          url: 'api/subscribe',
          dataType: "json",
          data: {
              plan_id : plan_id
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

                

            }
          },
          error:function(){
            // failed request; give feedback to user
            $('#subscribe-ajax').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
          }
    });


});