$(document).ready(function(){
    $("#dialer").click(function(){
        $(".section").fadeOut('slow');
        $("#tab_dialer").delay(400).fadeIn('slow');
    });
    
    $('.num').click(function () {
        $("#telNumber").val($("#telNumber").val() + $(this).data("value"));
    });

    $('.num-delete').click(function () {
        var str = $('#telNumber').val();
        $('#telNumber').val(str.substring(0, str.length - 1));
    });
    
    $(".call-num").click(function(){
        var dialedNumber = $('#telNumber').val();
        if ( dialedNumber === "" ) {
            alert("No number to call");
        } else {
            $('#telNumber').val("");
            alert("Calling " + dialedNumber + "...");
            $.ajax({
                type     : 'GET',
                url      : 'api/dialCall',
                dataType : "json",
                data:{
                    dialedNumber : dialedNumber
                },
                beforeSend:function(){
                    overlay.show();
                },
                success:function(response){
                    $("#hid_call_id").val(response.call_id);
                    start_call();
                },
                error:function(){

                }
            });
        }
    });
    
    $(".end-call-num").click(function(){
        var callId = $("#hid_call_id").val();
        if ( callId === "" ) {
            alert("No existing call");
        } else {
            $.ajax({
                type     : 'GET',
                url      : 'api/endCall',
                dataType : "json",
                data:{
                    callId : callId
                },
                beforeSend:function(){
                    overlay.show();
                },
                success:function(response){
                    $("#hid_call_id").val("");
                    alert("Call Ended.");
                    overlay.hide();
                },
                error:function(){

                }
            });
        }
    })
});

function start_call(){
    var callId = $("#hid_call_id").val();
    $.ajax({
        type     : 'GET',
        url      : 'api/startCall',
        dataType : "json",
        data:{
            callId : callId
        },
        beforeSend:function(){
            
        },
        success:function(response){
            overlay.hide();
            alert("Call Connected");
        },
        error:function(){

        }
    });
}