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

    $('.future_date').datepicker({ 
        minDate: new Date(),
        yearRange: "1930:2030",
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true
    });
});

function recaptchaCallback() {
    $("input[type=submit]").removeAttr("disabled");
    $("input[type=submit]").removeAttr("onclick");
};

