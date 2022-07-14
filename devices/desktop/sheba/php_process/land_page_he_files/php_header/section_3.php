<style type="text/css">
    .sec_<?php echo $sec["ID"];?>{
        padding: 140px 0 40px 0;
        position: relative;
        background-color: #f1f1f1;
    }

    .sec_<?php echo $sec["ID"];?> .hiddenLabel{
        visibility: hidden;
        display: none;
    }

    .sec_<?php echo $sec["ID"];?> .richtext{
        color: #444444;
        font-size: 24px;
        font-weight: 400;
        text-align: center;
    }

    .sec_<?php echo $sec["ID"];?> .sectionTitle{
        text-align: center;
    }

    .sec_<?php echo $sec["ID"];?> .sectionContent{
        margin-bottom: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .sectionContentCenter{
        margin-bottom: 40px;
    }

    .sec_<?php echo $sec["ID"];?> .formArea label.outsideInputTitle{
        color: #444444;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea .formInput{
        width: 100%;
        height: 48px;
        border: 1px solid #d2d2d2;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        color: #444444;
        font-size: 18px;
        font-weight: normal;
        padding-<?php echo $gui->getLeft();?>: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .formArea input::-webkit-input-placeholder {
        color: #c9c9c9;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea input:-moz-placeholder { /* Firefox 18- */
       color: #c9c9c9;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea input::-moz-placeholder {  /* Firefox 19+ */
       color: #c9c9c9;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea input:-ms-input-placeholder {
       color: #c9c9c9;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea .form-control{
        width: 100%;
        height: 48px;
        border: 1px solid #d2d2d2;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        color: #444444;
        font-size: 18px;
        font-weight: normal;
        padding-<?php echo $gui->getLeft();?>: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .formArea .rowMargin{
        margin-bottom: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .formArea .checkboxText{
        color: #444444;
        font-size: 18px;
        font-weight: 400;
        margin-<?php echo $gui->getLeft();?>: 10px;
        vertical-align: -3px;
    }

    .sec_<?php echo $sec["ID"];?> .donateButton{
        position: absolute;
        margin: 0 auto;
        z-index: 10;
        right: 0;
        left: 0;
        top: -115px;
        background-color: #138770;
        color: #ffffff;
        border: 12px solid #f1f1f1;
        width: 230px;
        height: 230px;
        font-size: 40px;
        line-height: 42px;
        font-weight: normal;
        text-align: center;
        -webkit-border-radius: 500px;
        -moz-border-radius: 500px;
        border-radius: 500px;
    }

    .sec_<?php echo $sec["ID"];?> .donateButton:hover, .sec_<?php echo $sec["ID"];?> .donateButton:focus, .sec_<?php echo $sec["ID"];?> .donateButton:active{
        background-color: #2c353c;
        color: #F1F1F1;
        border: 12px solid #f1f1f1;
        outline: none;
    }

    .sec_<?php echo $sec["ID"];?> .thankYou{
        text-align: center;
    }

    .sec_<?php echo $sec["ID"];?> .thankYou img{
        margin-bottom: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .thankYou h2{
        margin-bottom: 20px;
        color: #138770;
        font-size: 36px;
        font-weight: bold;
    }

    .sec_<?php echo $sec["ID"];?> .answerText{
        font-size: 24px;
        color: #666666;
    }

    .sec_<?php echo $sec["ID"];?> .errorMassege{
        text-align: center;
    }

    .sec_<?php echo $sec["ID"];?> .errorMassege h2{
        margin-bottom: 20px;
        font-size: 36px;
        font-weight: bold;
        color: #c61c1f;
    }

    .sec_<?php echo $sec["ID"];?> .errorMassege h3{
        font-size: 24px;
        color: #666666;
        font-weight: normal;
    }


    .sec_<?php echo $sec["ID"];?> .secureImg{
        vertical-align: top;
        margin-bottom: 10px;
    }

    .sec_<?php echo $sec["ID"];?> .secureImg img{
        margin-<?php echo $gui->getRight();?>: 5px;
    }

    .sec_<?php echo $sec["ID"];?> .formTextArea{
        width: 100%;
        min-height: 90px;
        border: 1px solid #d2d2d2;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        color: #444444;
        font-size: 18px;
        font-weight: normal;
        padding-right: 20px;
    }

    .sec_<?php echo $sec["ID"];?> hr{
        border-top: 1px solid #d2d2d2;
    }

    .sec_<?php echo $sec["ID"];?> .donationTaxs{
        font-size: 18px;
    }

    .sec_<?php echo $sec["ID"];?> .secureMsg{
        font-size: 14px;
        font-weight: bold;
    }

    .sec_<?php echo $sec["ID"];?> .inputDiv .receiptInput{
        height: 90px;
    }

    /*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
    @media (max-width:1440px){

    }

    /*--------------------------  MD ( max 1200 ) --------------------------*/
    @media (max-width:1200px){

    }

    /*--------------------------  SM ( max 992 ) --------------------------*/
    @media(max-width:992px){
        .sec_<?php echo $sec["ID"];?> .formArea .rowMargin{
            margin-bottom: 0px;
        }

        .sec_<?php echo $sec["ID"];?> .formArea .formInput{
            margin-bottom: 10px;
        }
    }

    /*--------------------------  XS ( max 768 ) --------------------------*/
    @media (max-width:768px){
        .sec_<?php echo $sec["ID"];?> .donateButton{
            top: -72px;
            width: 150px;
            height: 150px;
            font-size: 24px;
            border: 7px solid #f1f1f1;
            line-height: 28px;
        }

        .sec_<?php echo $sec["ID"];?> .donateButton:hover, .sec_<?php echo $sec["ID"];?> .donateButton:focus, .sec_<?php echo $sec["ID"];?> .donateButton:active{
            border: 7px solid #f1f1f1;
        }

        .sec_<?php echo $sec["ID"];?>{
            padding: 100px 0 40px 0;
        }

        .sec_<?php echo $sec["ID"];?> .sectionContent{
            margin-bottom: 0px;
        }

        .sec_<?php echo $sec["ID"];?> .richtext p{
            margin: 0px;
        }
    }

    /*--------------------------  max 480 --------------------------*/
    @media (max-width:480px){

    }
</style>

<script type="text/javascript">
    function checkFormContact(formSelector){
        // DIVISION
        var divisionElemSelector = '#division';
        if($(formSelector+" "+divisionElemSelector+' option:selected').val() === "0"){
            return invalidInput(divisionElemSelector, "<?php echo $trans->getText('Please insert division');?>");
        } else {
            clearValidationErrors(divisionElemSelector);
        }

        
        // AMOUNT
        var amountElemSelector = '#Amount';
        var otherAmountElemSelector = '#other_amount_input';
        var selected_text = $("#Amount option:selected").val();
        if($(formSelector+" "+amountElemSelector+' option:selected').val() === "0"){
            return invalidInput(amountElemSelector, "<?php echo $trans->getText('Please insert amount');?>");
        } else if( ($(otherAmountElemSelector).val()) < <?php echo $arrLinksAmount[0]['Name']; ?>  && $(formSelector+" "+amountElemSelector+' option:selected').val() === "other" ){
            return invalidInput(otherAmountElemSelector, "<?php echo $trans->getText('minimal donatation is')." ".$arrLinksAmount[0]['Name']; ?>");
        } else {
            if($(formSelector+" "+amountElemSelector+' option:selected').val() === "other"){
                $('#Amount option:selected').val($(otherAmountElemSelector).val());
            }
            clearValidationErrors(amountElemSelector);
        }

        // FIRST NAME
        var nameElemSelector = '#First_Name';
        if($(formSelector+" "+nameElemSelector).val().length < 2){
            return invalidInput(nameElemSelector, "<?php echo $trans->getText('Please insert Name');?>");
        } else {
            clearValidationErrors(nameElemSelector);
        }

        // CITY
        var cityElemSelector = '#City';
        if($(formSelector+" "+cityElemSelector).val().length < 2){
            return invalidInput(cityElemSelector, "<?php echo $trans->getText('Please insert City');?>");
        } else {
            clearValidationErrors(cityElemSelector);
        }

        // STREET
        var streetElemSelector = '#Street';
        if($(formSelector+" "+streetElemSelector).val().length < 2){
            return invalidInput(streetElemSelector, "<?php echo $trans->getText('Please insert Street');?>");
        } else {
            clearValidationErrors(streetElemSelector);
        }

        // PHONE
        var phoneElemSelector = '#Phone';
        var phonePattern = $(formSelector+" "+phoneElemSelector).val().match('[0-9]{8,}');
        if($(formSelector+" "+phoneElemSelector).val().length < 8 && phonePattern!="null"){
            return invalidInput(phoneElemSelector, "<?php echo $trans->getText('Please insert Phone');?>");
        } else {
            clearValidationErrors(phoneElemSelector);
        }

        // EMAIL
        var emailElemSelector = '#Email';
        if(!isValidEmail($(formSelector+" "+emailElemSelector).val())){
            return invalidInput(emailElemSelector, "<?php echo $trans->getText('Please insert Email');?>");
        } else {
            clearValidationErrors(emailElemSelector);
        }

        return true;
    }

    /* VALIDATIONS */
    function clearValidationErrors(inputElement){
        $(inputElement).removeClass("inValid");
        if($(inputElement).prop('type') == 'checkbox'){
            $(inputElement).next('label').next('#inputErrMsg').remove();
        } else {
            $(inputElement).next('#inputErrMsg').remove();
        }
    }

    // WHEN INPUT IS INVALID
    function invalidInput(inputElement, textError){
        clearValidationErrors(inputElement);
        throwValidateErrMsg(inputElement, textError);
        $(inputElement).addClass('inValid');
        $(inputElement).focus();
        return false;
    }

    // THROW VALIDATION ERROR
    function throwValidateErrMsg(inputElement, textError){
        var errElement = document.createElement('div');
        errElement.setAttribute('id', 'inputErrMsg');
        errElement.setAttribute('class', 'inputErrText');
        if($(inputElement).prop('type') == 'checkbox'){
            if($(inputElement).next('label').next('#inputErrMsg').length === 0){
                $(inputElement).next('label').after(errElement);
            }
        } else {
            if($(inputElement).next('#inputErrMsg').length === 0){
                $(inputElement).after(errElement);
            }
        }
        $(errElement).html(textError);
        return false;
    }

    function scrollToForm() {
        $('#openForm').addClass("in");
        $('html, body').animate({
            scrollTop: $("#formAnchor").offset().top
        }, 1000, function(){
            //$('.donateButton').prop('disabled', true);
        });
    }

    function scrollAndOpenForm(){
        $('html, body').animate({
             scrollTop: $("#formAnchor").offset().top
         }, 800, function(){
             $('.donateButton').prop('disabled', true);
         });
         $("#openForm").addClass(" in");
    }

    
    function submitForm(e){
        /* Do not submit form yet */
        event.preventDefault();

        var form = document.getElementById("donation_form");

        /* Check validations */
        if(!checkFormContact('#donation_form')){
            return false;
        }

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

    $(document).ready(function(){
        var form = document.getElementById("donation_form");
        form.addEventListener("submit", submitForm, true);
    });


    $(document).on('change', $('#division'), function(){
        var selected_text = $("#division option:selected").val();
        if(selected_text == "other"){
            $("#other_division").show();
            $("#other_division_input").prop('required', true);
        } else  {
            $("#other_division").hide();
            $("#other_division_input").prop('required', false);
        }
    });

    $(document).on('change', $('#Amount'), function(){
        var selected_text = $("#Amount option:selected").val();
        if(selected_text == "other"){
            $("#other_amount").show();
            $("#Amount").prop('required', true);
        } else  {
            $("#other_amount").hide();
            $("#Amount").prop('required', false);
        }
    });

    $(document).ready(function() {
        $('.clickToDonate').on('click', function(){
             scrollAndOpenForm();
        });


        $("#other_amount").hide();
        $("#other_division").hide();
       $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=(.+?(?:&|$))').exec(window.location.href);
            if (results==null){
               return null;
            }
            else{
               return results[1] || 0;
            }
        }

        if($.urlParam('fromCampain')==1){
           scrollAndOpenForm();
        }
    });
</script>