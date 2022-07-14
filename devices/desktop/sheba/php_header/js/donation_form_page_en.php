
function scrollToForm() {
    $('html, body').animate({
        scrollTop: $("#formAnchor").offset().top
    }, 1000);
}

function submitForm(e){
    /* Do not submit form yet */
    event.preventDefault();

    var form = document.getElementById("donation_form");

    delayBtn(document.getElementById('submit_btn'),1000000);

    $.ajax({
        type: "POST",
        url: "<?php echo $cfg["WM"]["Server"]?>/ajax/transila_handshake",
        data: $(form).serialize(),
        success: function(thtk){
            $('#donation_form').append(`
                <input type="hidden" name="thtk" value="${thtk}" />
            `);
            /* Submit form now */
            form.submit();
        }
    });
}

$(document).ready(function() {
    $("#other_amount").hide();
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
    $("#Amount").change(function(){ 
        var selected_text = $("#Amount option:selected").text();
        if( selected_text == "other amount")
            {
                $("#other_amount").show();
                $("#other_amount_input").prop('required', true); 
            }
        else 
        {
            $("#other_amount").hide();
            $("#other_amount_input").prop('required', false); 
        }
    });

    var form = document.getElementById("donation_form");
    form.addEventListener("submit", submitForm, true);

    /*
    document.getElementById('donation_form').onsubmit = function () {
        delayBtn(document.getElementById('submit'),1000000);
    }
    */
});

