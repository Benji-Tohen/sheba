<?php
if($_POST["do"]=="joinMailing"){
	require_once('classes/content_management/class.content_updater.php');
	require_once('classes/site_users/class.site_users.php');
	$siteUsers=new SiteUsers($db, "wm_siteusers");
	$arrFields=array(
		"Email"		=>	$_POST["Email"]
		,"Name"			=>	$_POST["Name"]
		,"Enabled"		=>	1
	);	
	$siteUsers->addUser($arrFields);
}
?>
<div class="joinMailingListForm" dir="<?php echo $gui->getDir();?>">
<?php if($_POST["do"]=="joinMailing"){?>
<div style="margin-top: 5px; margin-right: 15px; color: #b11717; font-weight: bold;">
<?php echo $text["Joining mailinglist success"];?>
</div>
<? }else{?>
<script language="javascript" src="site/js/checkMail.js"></script>
<script language="javascript">
<!--
function checkForm(){
	
	if(!isValidEmail(document.joinMailingList.Email.value)){
		alert("אנא הזן כתובת דואל חוקית");
		document.joinMailingList.Email.focus();
		return false;
	}
	return true;
}
-->
</script>
<form name="joinMailingList" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" style="padding: 0px; margin: 0px;" onsubmit="return checkForm();">
<input type="hidden" name="p" value="<?php echo $id;?>" />
<input type="hidden" name="do" value="joinMailing" />
<input type="hidden" name="test" value="1" />

<img src="site/images/general/ontheway.jpg" border="0" alt="" />
<br />
<table cellpadding="0" cellspacing="0" style="margin-top: 5px;">
<tr>
	<td><?php echo $text["Name"];?>:&nbsp;</td>
	<td><input style="width: 111px; height: 15px; border: 1px solid #818890;" type="text" name="Name" value="" /></td>
	<td><a href="http://www.oryarok.org.il/?p=33" style="color: #8b0003 !important; font-size: 10px;">&nbsp;הצהרת פרטיות</a></td>	
</tr>
<tr>
	<td><?php echo $text["Mail"];?>:&nbsp;</td>
	<td><input style="width: 111px; height: 15px; border: 1px solid #818890;" type="text" name="Email" dir="ltr" /></td>	
	<td>&nbsp;<input style="cursor: pointer; width: 43px; height: 19px; border: 1px solid #818890;" type="submit" name="submit" value="<?php echo $text["Join"];?>" /></td>	
</tr>
</table>
</form>
<?php }?>
</div>