function confirmProduct(plan_id){
    $.ajax({
          type: 'GET',
          url: 'api/plan_desc',
          data: {
              plan_id : plan_id
          },
          dataType: "json",
          beforeSend:function(){
            
          },
          success:function(response){
              $('#plan_id').val(response.product_id);
              $('#plan_name').html(response.name);
              $('#plan_price').html("This will deduct $"+response.price+" to your E-wallet");
          },
          error:function(){
            
          }
    });
}

function confirmPlan(){
    var plan_id = $('#plan_id').val();
    $.ajax({
          type: 'GET',
          url: 'api/subscribe',
          data: {
              plan_id : plan_id
          },
          dataType: "json",
          beforeSend:function(){
            
          },
          success:function(response){
              alert(response);
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
          beforeSend:function(){
            // this is where we append a loading image
            $('#div_products').html('<div class="loading"><img src="{{asset("images/loading.gif")}}" alt="Loading..." /></div>');
          },
          success:function(response){
            // successful request; do something with the data
            $('#div_products').empty();
            var data = jQuery.parseJSON(response);
            $.each(data, function(group){
                $('#div_products').append('<div class="col-lg-12 col-md-12 text-center">');
                $('#div_products').append('<h3>'+group+'</h3>');
                $.each(data[group], function(products){
                    $('#div_products').append('<div');
                    $('#div_products').append('<div class="media wow fadeInRight">');
                    $('#div_products').append('<a href="#confirmationModal" class="btn btn-primary" data-toggle="modal" onclick="confirmProduct('+data[group][products]['id']+')">'+data[group][products]['name']+' &nbsp;&nbsp;&nbsp; <strong>$'+data[group][products]['price']+'</strong></a>');
                    $('#div_products').append('</div>');
                });
                $('#div_products').append('</div><hr>');
            });
          },
          error:function(){
            // failed request; give feedback to user
            $('#subscribe-ajax').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
          }
    });
});