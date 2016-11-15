$("#selectplan").click(function(){
    $(".section").fadeOut('slow');
    $("#tab_selectplan").delay(400).fadeIn('slow');
    
    $.ajax({
        type     : 'GET',
        url      : 'api/myplans',
        dataType : "json",
        beforeSend:function(){
            $('#myplans').html('<div class="cssload-loader"><div class="cssload-inner cssload-one"></div><div class="cssload-inner cssload-two"></div><div class="cssload-inner cssload-three"></div></div>');
        },
        success:function(response){
            if ( response.status === "failed" ) {
                window.location = response.home;
            } else {
                $("#myplans").empty();
                $.each(response, function(group){
                    $("#myplans").append('<a href="#paypercallModal" class="select-plan" data-toggle="modal">');
    //                $("#myplans").append('<img src="http://localhost/web_payphone/public/images/paypercall.png" class="img-responsive">');
                    $("#myplans").append('<h2 class="text-center">'+group+'</h2>');
                    $("#myplans").append('<hr>');
                    $.each(response[group], function(details){
                        $("#myplans").append('<h3 class="text-center">'+response[group][details].name+'</h3>');
                        $("#myplans").append('<p class="text-center"><font color="#04ff00"><strong>'+response[group][details].remaining_mins+'</strong> minutes left before expiration</font></p>');
                    });
                    $("#myplans").append('</a>');
                });
            }
        },
        error:function(){
            
        }
    });
});



