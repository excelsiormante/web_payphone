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