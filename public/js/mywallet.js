$("#ewallet").click(function(){
    $(".section").fadeOut('fast');
    $("#tab_ewallet").delay(50).fadeIn('fast');

    $.ajax({
          type: 'GET',
          url: 'api/getwallet',
          dataType : "json",
          beforeSend:function(){
            // this is where we append a loading image
            overlay.show();
          },
          success:function(response){
            if ( response.status === "failed" ) {
                // ERROR
            } else {
                overlay.delay(500).fadeOut('fast');
                $('#div_balance').empty();
                $('#div_balance').append('<h1 class="text-left"><strong>$'+response.balance+'</strong></h1>');
                $('#div_balance').append('<p class="text-left">As of today 7:14pm</p>');
            }
          },
          error:function(){

          },
          complete:function(){
              load_wallet_js();
          }
    });
});
function load_wallet_js(){
    $(document).ready(function(){
        $('#btnpaypal').removeProp('data-dismiss');
        $('#btnpaypal').prop('href', '#');
        $('#btnpaymaya').removeProp('data-dismiss');
        $('#btnpaymaya').prop('href', '#'); 
    });
    
$('#amount').keyup(function(){
    var amount = $('#amount').val();
    if(amount <= 0 || amount == '' || amount == null) {   
        $('#btnpaypal').removeAttr('data-dismiss');
        $('#btnpaypal').attr('href', '#');
        $('#btnpaymaya').removeAttr('data-dismiss');
        $('#btnpaymaya').attr('href', '#');     
    } else {
        $('#btnpaypal').attr('href', "paypal/set/"+ amount);
        $('#btnpaymaya').attr("href", "paymaya/set/" + amount);     
    }
});

$('.btnpayment').click(function(){
    if($('#amount').val() <= 0 || $('#amount').val() == '' || $('#amount').val() == null) {
        alert('Please enter valid amount!');
    }
    });
}