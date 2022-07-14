function checkFormContact(){

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

}
