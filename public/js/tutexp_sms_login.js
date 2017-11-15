AccountKit_OnInteractive = function(){
    AccountKit.init(
        {
            appId:"1952653494947783",
            state:randomString(20),
            version:"v1.0",
            fbAppEventsEnabled:true,
            redirect:"http://my-wp.dev/wp-admin/admin-ajax.php?action=tutexpFacebookDataFetch1"
        }
    );
};
function randomString(length) {
    return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1);
}
(function ($) {
    'use strict';

    var mobileNumber = null;
    var countryCode = null;
    $('.smsLogin').on('click', function (e) {

        var isValid = $("#mobile-number").intlTelInput("isValidNumber");
        if (!isValid) {
            e.preventDefault();
            alert("phone number not valid");
        } else {

            var intlNumber = $("#mobile-number").intlTelInput("getNumber");
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: tutexp_ajax1.ajaxurl,
                data: {
                    'action': 'ajax_login',
                    'mobile_number':intlNumber
                },
                success: function (data) {
                    if(!data.status){
                        alert(data.message);
                    }

                }
            }).then(function (result) {
                if(result.status){
                    var countryData = $("#mobile-number").intlTelInput("getSelectedCountryData");
                    var countryData1 = $("#mobile-number").val();
                    countryCode = "+"+ countryData.dialCode;
                    mobileNumber = countryData1;

                   smsLogin(countryCode,mobileNumber);
                }
            });


        }
        // smsLogin(countryCode,mobileNumber);
    });


    function loginCallback(response) {

        if (response.status === "PARTIALLY_AUTHENTICATED") {
            var code = response.code;
            var csrf = response.state;
            jQuery.ajax({
                url : tutexp_ajax.ajax_url,
                type : 'post',
                data : {
                    'action' : 'tutexpFacebookDataFetch',
                    'code' : code,
                    'csrf' : csrf,
                    'countryCode':countryCode,
                    'mobileNumber':mobileNumber
                },
                success : function( response ) {
                    console.log(response);
                    var  str = response.substring(0, response.length - 1);
                    window.location = str;
                }
            });

            // Send code to server to exchange for access token
        }
        else if (response.status === "NOT_AUTHENTICATED") {
            // handle authentication failure
        }
        else if (response.status === "BAD_PARAMS") {
            // handle bad parameters
        }
    }

    // phone form submission handler
    function smsLogin(countryCode,phoneNumber) {
        alert(countryCode,phoneNumber);
        // debugger;
        AccountKit.login(
            'PHONE',
            {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
            loginCallback
        );
    }


    // email form submission handler
    function emailLogin() {
        var emailAddress = document.getElementById("email").value;
        AccountKit.login(
            'EMAIL',
            {emailAddress: emailAddress},
            loginCallback
        );
    }
})(jQuery);