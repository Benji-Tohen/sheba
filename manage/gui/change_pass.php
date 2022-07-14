<?php
//$login->logoutUser();
//$lpusers->logoutUser();
$ipb = new ipblock($db, $cfg);				// loaded at config
if (!$ipb->is_ip_allowed()) $ipb->show_block_page();	// if IP is blocked - deny access to site
if (!$login->isReplacePassword()) {                     // if we are not required to change password - dont enter this page
    header('location: /');
    exit;
}
if($_POST){
        require_once(dirname(__FILE__).'/../../classes/password/passwords.class.php');
        $old_password = $_POST["Password"];
        $new_password1 = $_POST["New_Password"];
        $new_password2 = $_POST["New_Password2"];
        $user_id = $_SESSION["User_Data"]["ID"];
        
        $passwords = new passwords($db);
        if (!$passwords->is_existing_password($old_password, $user_id)) $error = "הסיסמא הנוכחית שהזנת שגויה";
        else if ($new_password1!=$new_password2) $error = "על שתי הסיסמאות החדשות להיות זהות";
        else $error = $passwords->new_password_check($new_password1, $user_id);
        
        if (!$error) {                                                          // if all tests passed successfully - changed password
            $passwords->change_password($old_password, $new_password1, $user_id);            
            require_once('common/header.php');
            ?>
            <div style="position:absolute;top:50%;width:100%;text-align:center;direction:rtl;font-size:16px">
            הסיסמא הוחלפה בהצלחה!<br/><br/>
            מיד תועבר לאתר..
            </div>
            <script>setTimeout(function(){location.href='/'},1000)</script>
            <?php
            exit;
        }
/*        
        print_r($_POST);
        print_r($_SESSION);
        exit;
	$userEmail=$_POST["Username"];

	if($lpusers->loginUser($_POST["Username"], $_POST["Password"])){
		$_POST["Username"]="client";
		$_POST["Password"]="client123";
	}


	if($login->loginUser($_POST["Username"], $_POST["Password"])){

 * Array   
(
    [User_Data] => Array
        (
            [ID] => 1
            [Parent] => 1
            [Ordering] => 0
            [Name] => Untitled
            [First_Name] => Tomer
            [Last_Name] => Efrati
            [Username] => thomas
            [Password] => e10adc3949ba59abbe56e057f20f883e
            [Level] => 1
            [blocked] => 0
            [password_time] => 1430140543
            [block_time] => 0
            [mail] => 
        )

)
 */

}
?>
<?php require_once('common/header.php');?>
<script type="text/javascript">
if(top===self){
}else{
	top.location=window.location.href;
}
</script>
<style type="text/css">
input{
	width: 150px;
	height: 24px;
	font-size: 20px;
}
.login_box{
	margin: 0px;
	font-size: 24px;
	font-weight: bold;
	border: 1px solid #c0c0c0;
	padding: 20px;
	width: 250px;
}
</style>
</head>
<body dir="<?php echo $gui->getDir();?>" onLoad="if(top.menu){top.menu.location=top.menu.location;}">
<center>
<br /><br /><br />
<img src="images/tmlogo.png" border="0" />
<div class="login_box" style="width:350px">
<div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;">מטעמי אבטחה הינך נדרש להחליף את סיסמתך</div>
<div style="font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #ff0000; height: 15px;">
<?php if($error){?>
	<?php echo $error;?>
<?php }?>
</div>
<form action="<?php /*echo $_SERVER['REQUEST_URI'];*/?>" name="edit" method="post" enctype="multipart/form-data" style="padding: 0px; margin: 0px;">
<input type="hidden" name="se" value="<?php echo $_REQUEST["se"];?>" />
<table cellpadding="0" cellspacing="6">
	<tr>
		<td style="font-size:15px">סיסמא נוכחית:&nbsp;</td>
		<td><input type="password" name="Password" value="<?php echo $old_password;?>" dir="ltr" /></td>		
	</tr>
	<tr>
		<td style="font-size:15px">סיסמא חדשה:&nbsp;</td>
		<td><input type="password" name="New_Password" value="<?php echo $new_password1;?>" dir="ltr" /></td>		
	</tr>
	<tr>
		<td style="font-size:15px">הזן סיסמא חדשה בשנית:&nbsp;</td>
		<td><input type="password" name="New_Password2" value="<?php echo $new_password2;?>" dir="ltr" /></td>		
	</tr>
	<tr>
		<td></td>
		<td align="<?php echo $gui->getRight();?>"><input style="width: 80px; height: 30px; border: 1px solid #000000; background-color: #ffffff; cursor: pointer; font-weight: bold; font-size: 18px;" type="Submit" name="Submit" value="החלף" /></td>		
	</tr>
</table>
</form>
</div>
</center>
<script language="javascript" type="text/javascript">
document.edit.Username.focus();
</script>

