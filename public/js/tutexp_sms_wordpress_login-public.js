AccountKit_OnInteractive = function () {
    AccountKit.init(
        {
            appId: "1952653494947783",
            state: randomString(20),
            version: "v1.0",
            fbAppEventsEnabled: true,
            redirect: "http://my-wp.dev/wp-admin/admin-ajax.php?action=tutexpFacebookDataFetch1"
        }
    );
};

function randomString(length) {
    return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1);
}

(function ($) {
    'use strict';



    // $("#mobile-number").intlTelInput();
    $("#mobile-number,#country").intlTelInput({
        'nationalMode':false
    }).done(function () {
        // analytics
        $('.selected-flag').one('click', function () {
            ga('send', 'event', 'demo', 'clicked selected country');
        });
        $('#mobile-number').one('keyup', function () {
            ga('send', 'event', 'demo', 'typed something in input');
        });
    });


    $('#tutexpsms-registerForm').on('submit', function (e) {
        var info = $(this);

        var isValid = $("#mobile-number").intlTelInput("isValidNumber");
        if (!isValid) {
            e.preventDefault();
            alert("phone number not valid");
        } else {

            var intlNumber = $("#mobile-number").intlTelInput("getNumber");
            info.append('<input type="hidden" name="phoneOriginal" value="' + intlNumber + '" /> ');
            return true;
        }

    });


    $('.tutexpForm .form').find('input, textarea').on('keyup blur focus', function (e) {

        var $this = $(this),
            label = $this.prev('label');

        if (e.type === 'keyup') {
            if ($this.val() === '') {
                label.removeClass('active highlight');
            } else {
                label.addClass('active highlight');
            }
        } else if (e.type === 'blur') {
            if ($this.val() === '') {
                label.removeClass('active highlight');
            } else {
                label.removeClass('highlight');
            }
        } else if (e.type === 'focus') {

            if ($this.val() === '') {
                label.removeClass('highlight');
            }
            else if ($this.val() !== '') {
                label.addClass('highlight');
            }
        }

    });

    $('.tutexpForm .tab a').on('click', function (e) {

        e.preventDefault();

        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');

        var target = $(this).attr('href');

        $('.tutexpForm .tab-content > div').not(target).hide();

        $(target).fadeIn(600);

    });




})(jQuery);
