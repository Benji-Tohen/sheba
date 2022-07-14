$(document).ready(function() {
    /* iCheck */
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
    /* END iCheck */

    $('.datepicker').datepicker({ 
        yearRange: "1930:2030",
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true
    });

    $('#sendForm').submit(function(event) {
        delayBtn('#submit', 10000)
    });
});

function recaptchaCallback() {
    $("input[type=submit]").removeAttr("disabled");
    $("input[type=submit]").removeAttr("onclick");
};
