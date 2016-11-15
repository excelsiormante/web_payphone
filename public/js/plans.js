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
            if ( response.status === "failed" ) {
                // ERROR
            } else {
                
            }
          },
          error:function(){
            
          }
    });
}

$("#subscribe").click(function(){
    $(".section").fadeOut('slow');
    $("#tab_subscribe").delay(400).fadeIn('slow');

    $.ajax({
          type: 'GET',
          url: 'api/plans',
          dataType: "json",
          beforeSend:function(){
            // this is where we append a loading image
            $('#div_products').html('<div class="cssload-loader"><div class="cssload-inner cssload-one"></div><div class="cssload-inner cssload-two"></div><div class="cssload-inner cssload-three"></div></div>');
          },
          success:function(response){
            if ( response.status === "failed" ) {
                // ERROR
            } else {
                // successful request; do something with the data
                $('#div_products').empty();
                $.each(response, function(group){
                    $('#div_products').append('<div class="col-lg-12 col-md-12 text-center">');
                    $('#div_products').append('<h3>'+group+'</h3>');
                    $.each(response[group], function(products){
                        $('#div_products').append('<div');
                        $('#div_products').append('<div class="media wow fadeInRight">');
                        $('#div_products').append('<a href="#confirmationModal" class="btn btn-primary" data-toggle="modal" onclick="confirmProduct('+response[group][products]['id']+')">'+response[group][products]['name']+' &nbsp;&nbsp;&nbsp; <strong>$'+response[group][products]['price']+'</strong></a>');
                        $('#div_products').append('</div>');
                    });
                    $('#div_products').append('</div><hr>');
                });
            }
          },
          error:function(){
            // failed request; give feedback to user
            $('#subscribe-ajax').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
          }
    });
});