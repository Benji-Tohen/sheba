function checkFormContact(){

	if(document.contactForm.First_Name.value.length<2){
		alert("<?php echo $trans->getText("Please insert First Name");?>");
		document.contactForm.First_Name.focus();
		return false;
	}

	if(document.contactForm.Last_Name.value.length<2){
		alert("<?php echo $trans->getText("Please insert Last Name");?>");
		document.contactForm.Last_Name.focus();
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
<?php if($siteUsers->isAnonymousUser()){?>
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
<?php }?>
	return true;
}
