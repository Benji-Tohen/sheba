function checkFormContact(formSelector) {
    // DIVISION
    var divisionElemSelector = '#division';
    if ($(formSelector + " " + divisionElemSelector + ' option:selected').val() === "0") {
        return invalidInput(divisionElemSelector, "<?php echo $trans->getText('Please insert division');?>");
    } else {
        clearValidationErrors(divisionElemSelector);
    }

    // AMOUNT
    var amountElemSelector = '#Amount';
    if ($(formSelector + " " + amountElemSelector + ' option:selected').val() === "0") {
        return invalidInput(amountElemSelector, "<?php echo $trans->getText('Please insert amount');?>");
    } else {
        clearValidationErrors(amountElemSelector);
    }

    // FIRST NAME
    var nameElemSelector = '#First_Name';
    if ($(formSelector + " " + nameElemSelector).val().length < 2) {
        return invalidInput(nameElemSelector, "<?php echo $trans->getText('Please insert Name');?>");
    } else {
        clearValidationErrors(nameElemSelector);
    }

    // CITY
    var cityElemSelector = '#City';
    if ($(formSelector + " " + cityElemSelector).val().length < 2) {
        return invalidInput(cityElemSelector, "<?php echo $trans->getText('Please insert City');?>");
    } else {
        clearValidationErrors(cityElemSelector);
    }

    // STREET
    var streetElemSelector = '#Street';
    if ($(formSelector + " " + streetElemSelector).val().length < 2) {
        return invalidInput(streetElemSelector, "<?php echo $trans->getText('Please insert Street');?>");
    } else {
        clearValidationErrors(streetElemSelector);
    }

    // PHONE
    var phoneElemSelector = '#Phone';
    var phonePattern = $(formSelector + " " + phoneElemSelector).val().match('[0-9]{8,}');
    if ($(formSelector + " " + phoneElemSelector).val().length < 8 && phonePattern != "null") {
        return invalidInput(phoneElemSelector, "<?php echo $trans->getText('Please insert Phone');?>");
    } else {
        clearValidationErrors(phoneElemSelector);
    }

    // EMAIL
    var emailElemSelector = '#Email';
    if (!isValidEmail($(formSelector + " " + emailElemSelector).val())) {
        return invalidInput(emailElemSelector, "<?php echo $trans->getText('Please insert Email');?>");
    } else {
        clearValidationErrors(emailElemSelector);
    }

    return true;
}

/* VALIDATIONS */
function clearValidationErrors(inputElement) {
    $(inputElement).removeClass("inValid");
    if ($(inputElement).prop('type') == 'checkbox') {
        $(inputElement).next('label').next('#inputErrMsg').remove();
    } else {
        $(inputElement).next('#inputErrMsg').remove();
    }
}

// WHEN INPUT IS INVALID
function invalidInput(inputElement, textError) {
    clearValidationErrors(inputElement);
    throwValidateErrMsg(inputElement, textError);
    $(inputElement).addClass('inValid');
    $(inputElement).focus();
    return false;
}

// THROW VALIDATION ERROR
function throwValidateErrMsg(inputElement, textError) {
    var errElement = document.createElement('div');
    errElement.setAttribute('id', 'inputErrMsg');
    errElement.setAttribute('class', 'inputErrText');
    if ($(inputElement).prop('type') == 'checkbox') {
        if ($(inputElement).next('label').next('#inputErrMsg').length === 0) {
            $(inputElement).next('label').after(errElement);
        }
    } else {
        if ($(inputElement).next('#inputErrMsg').length === 0) {
            $(inputElement).after(errElement);
        }
    }
    $(errElement).html(textError);
    return false;
}

function scrollToForm() {
    $('html, body').animate({
        scrollTop: $("#formAnchor").offset().top
    }, 1000, function () {
        //$('.donateButton').prop('disabled', true);
    });
}

function scrollAndOpenForm() {
    $('html, body').animate({
        scrollTop: $("#formAnchor").offset().top
    }, 800, function () {
        $('.donateButton').prop('disabled', true);
    });
    $("#openForm").addClass(" in");
}

function submitForm(e){
    /* Do not submit form yet */
    event.preventDefault();

    var form = document.getElementById("donation_form");

    if(!checkFormContact('#donation_form')){
        return false;
    }

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


$(document).on('change', $('#division'), function () {
    var selected_text = $("#division option:selected").val();
    if (selected_text == "other") {
        $("#other_division").show();
        $("#other_division_input").prop('required', true);
    } else {
        $("#other_division").hide();
        $("#other_division_input").prop('required', false);
    }
});

$(document).on('change', $('#Amount'), function () {
    var selected_text = $("#Amount option:selected").val();
    if (selected_text == "other") {
        $("#other_amount").show();
        $("#Amount").prop('required', true);
    } else {
        $("#other_amount").hide();
        $("#Amount").prop('required', false);
    }
});

$(document).ready(function () {
    $('.clickToDonate').on('click', function () {
        scrollAndOpenForm();
    });


    $("#other_amount").hide();
    $("#other_division").hide();
    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=(.+?(?:&|$))').exec(window.location.href);
        if (results == null) {
            return null;
        }
        else {
            return results[1] || 0;
        }
    }

    if ($.urlParam('fromCampain') == 1) {
        scrollAndOpenForm();
    }
});


$(document).ready(function(){
    var form = document.getElementById("donation_form");
    form.addEventListener("submit", submitForm, true);
});