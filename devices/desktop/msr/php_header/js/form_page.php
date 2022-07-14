$(document).ready(function() {
    /* iCheck */
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
    /* END iCheck */
});

jQuery(document).ready(function(){
    $('.datepicker').datepicker({ dateFormat: 'dd/mm/yy' });
});

function recaptchaCallback() {
    $("input[type=submit]").removeAttr("disabled");
    $("input[type=submit]").removeAttr("onclick");
};

/*function checkFormContact(){

	if(document.contactForm.First_Name.value.length<2){
		alert("<?php echo $trans->getText("Please insert Name");?>");
		document.contactForm.First_Name.focus();
		return false;
	}

	if(document.contactForm.Phone.value.length<2){
		alert("<?php echo $trans->getText("Please insert Phone");?>");
		document.contactForm.Phone.focus();
		return false;
	}

	if(!isValidEmail(document.contactForm.Email.value)){
		alert("<?php echo $trans->getText("Please insert a valid Email address");?>");
		document.contactForm.Email.focus();
		return false;
	}

	return true;

}*/

