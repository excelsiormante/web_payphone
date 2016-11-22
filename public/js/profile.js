$(document).ready(function() {

    // process the form
    $('#formprofile').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'firstname'              : $('input[name=fistname]').val(),
            'middlename'             : $('input[name=middlename]').val(),
            'lasname'    : $('input[name=lastname]').val(),
            'gender'    : $('input[name=gender]').val(),
            'birthdate'    : $('input[name=birthdate]').val(),
            'address'    : $('input[name=address]').val(),
            'city'    : $('input[name=city]').val(),
            'state'    : $('input[name=state]').val(),
            'country'    : $('select[name=country]').val()
        };

        // process the form
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'edit/profile', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                console.log(data); 

                // here we will handle errors and validation messages
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});