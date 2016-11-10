$(document).ready(function(){
            $('#btnpaypal').removeProp('data-dismiss');
                $('#btnpaypal').prop('href', '#');
                $('#btnpaymaya').removeProp('data-dismiss');
                $('#btnpaymaya').prop('href', '#'); 
        });


        $('#amount').keyup(function(){

            var amount = $('#amount').val();
            if(amount <= 0 || amount == '' || amount == null)
            {   
                $('#btnpaypal').removeAttr('data-dismiss');
                $('#btnpaypal').attr('href', '#');
                $('#btnpaymaya').removeAttr('data-dismiss');
                $('#btnpaymaya').attr('href', '#');     
            }
            else
            { 
                
                $('#btnpaypal').attr('href', "paypal/set/"+ amount);
                $('#btnpaymaya').attr("href", "paymaya/set/" + amount);     
            }

        });

        $('.btnpayment').click(function(){
            if($('#amount').val() <= 0 || $('#amount').val() == '' || $('#amount').val() == null)
            {
                alert('Please enter valid amount!');
            }


        });