$(document).ready(function() {
    $('#profile-edit').click(function(){
        $(".bhoechie-tab-container").delay(50).fadeOut('fast');
        $(".profile-form").delay(50).fadeIn('fast');

        $.ajax({
            type: 'GET',
            url: 'get/profile',
            dataType : "json",
            beforeSend:function(){
            },
            success:function(response){
                $('input[name=firstname]').val(response.firstname);
                $('input[name=middlename]').val(response.middlename);
                $('input[name=lastname]').val(response.lastname);
                $('input[name=mobileno]').val(response.archer_account_id);
                $('input[name=gender][value="' + response.gender + '"]').prop('checked', true);
                $('input[name=birthdate]').val(response.birthday);
                $('input[name=address]').val(response.address);
                $('input[name=city]').val(response.city);
                $('input[name=state]').val(response.state);
                $('input[name=postal]').val(response.postal_code);
                $('select[name=country]').val(response.country);
            },
            error:function(){

            },
            complete:function(){
              load_profile_js();
            }
        });
    });
});

function load_profile_js(){
    // process the form
    $('#formprofile').submit(function(event) {
        var formData = {
            'firstname'  : $('input[name=firstname]').val(),
            'middlename' : $('input[name=middlename]').val(),
            'lastname'    : $('input[name=lastname]').val(),
            'mobileno'    : $('input[name=mobileno]').val(),
            'gender'     : $('input[name=gender]').val(),
            'birthdate'  : $('input[name=birthdate]').val(),
            'address'    : $('input[name=address]').val(),
            'city'       : $('input[name=city]').val(),
            'state'      : $('input[name=state]').val(),
            'postal'     : $('input[name=postal]').val(),
            'country'    : $('select[name=country]').val()
        };

        $.ajax({

            type        : 'GET',
            url         : 'edit/profile',
            data        : formData,
            dataType    : 'json',
            beforeSend:function(){
            },
            success:function(response){
                alert(response.message);
            },
            error:function(){

            },
            complete:function(){
              
            }

        });
    });
}