function checkFormContact(){

	if(document.contactForm.Password.value.length<5){
		alert("<?php echo $trans->getText("Please insert Password");?>");
		document.contactForm.Password.focus();
		return false;
	}

	if(document.contactForm.PasswordValidate.value!=document.contactForm.Password.value){
		alert("<?php echo $trans->getText("Please validate Password");?>");
		document.contactForm.PasswordValidate.focus();
		return false;
	}

	return true;
}
