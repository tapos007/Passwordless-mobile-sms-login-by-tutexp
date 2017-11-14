(function ($) {
    'use strict';

    // $("#mobile-number").intlTelInput();
    $("#mobile-number").intlTelInput({}).done(function () {
        // analytics
        $('.selected-flag').one('click', function () {
            ga('send', 'event', 'demo', 'clicked selected country');
        });
        $('#mobile-number').one('keyup', function () {
            ga('send', 'event', 'demo', 'typed something in input');
        });
    });



    $('#tutexpsms-registerForm').on('submit', function(e){
        var info = $(this);

        var isValid = $("#mobile-number").intlTelInput("isValidNumber");
        if(!isValid){
            e.preventDefault();
            alert("phone number not valid");
        }else{

            var intlNumber = $("#mobile-number").intlTelInput("getNumber");
            info.append('<input type="hidden" name="phoneOriginal" value="'+ intlNumber +'" /> ');
            return true;
        }

    });




})(jQuery);
