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
          /*  if ( response.result === 2 ) {
                alert(response.message);
            } else {
                var plans = response.data;
                $("#myplans").empty();
                $.each(plans, function(group){
                    $("#myplans").append('<a href="#paypercallModal" class="select-plan" data-toggle="modal">');
//                    $("#myplans").append('<img src="http://localhost/web_payphone/public/images/paypercall.png" class="img-responsive">');
                    $("#myplans").append('<h2 class="text-center">'+group+'</h2>');
                    $("#myplans").append('<hr>');
                    $.each(plans[group], function(details){
//                        $("#myplans").append('<h3 class="text-center">'+plans[group][details].name+'</h3>');
                        $("#myplans").append('<p class="text-center"><font color="#04ff00"><strong>'+plans[group][details].remaining_mins+'</strong> day/s left before expiration</font></p>');
                    });
                    $("#myplans").append('</a>');
                });
            }  */ 
        },
        error:function(){
                
            }
        });
    });



