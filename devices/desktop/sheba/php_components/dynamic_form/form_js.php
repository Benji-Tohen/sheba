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

    $('#sendForm').submit(function(event) {
        delayBtn('#submit', 10000)
    });
    $(".select2").each(function(index, select){
        const data = {
            selectionCssClass: "form-control",
            dir: "rtl"
        };
        if( "ph" in select.dataset ){
            data["placeholder"] = select.dataset.ph;
        }
        $(select).select2(data);
    });
});

function recaptchaCallback() {
    $("input[type=submit]").removeAttr("disabled");
    $("input[type=submit]").removeAttr("onclick");
};
