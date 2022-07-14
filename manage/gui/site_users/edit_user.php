<?php
require_once('../../classes/site_users/class.site_users.php');

$siteUsers=new SiteUsers($db, "wm_siteusers");

$id=	intval($_REQUEST["user_id"]);

$queryForms="	
		SELECT DISTINCT sf.form_id AS fid, sf.form_name AS fname 
		FROM wm_siteusers_forms sf 
		ORDER BY fname
";

$formsArr=$db->getArray($queryForms);

if($_POST){

        $check_inputs = array(
            array("string255"   => $_POST["Name"]),
            array("string255"   => $_POST["First_Name"]),
            array("string255"   => $_POST["Last_Name"]),
            array("email"       => $_POST["Email"]),
            array("number"      => $_POST["Enabled"])
        );
        
        $secureTexts = new secure_inputs();
        $cerror = $secureTexts->isNotSecure($check_inputs);
        if (!$cerror) {

            $arrFields=array(
                    "Name"			=>	($_POST["Name"]?$_POST["Name"]:($_POST["First_Name"]." ".$_POST["Last_Name"])),
                    "First_Name"		=>	$_POST["First_Name"],
                    "Last_Name"		=>	$_POST["Last_Name"],
                    "Email"			=>	$_POST["Email"],
                    "Enabled"		=>	$_POST["Enabled"]
            );

            if(!$_POST["ID"]){	//	Add new user
                    $arrFields["JoiningDate"]	=	time();
                    $newId=$siteUsers->addUser($arrFields);
                    $exists=!$newId;
                    $id=$newId;
            }else{				//	Update existing user
                    $exists=!$siteUsers->update($_POST["ID"], $arrFields);
                    $id=$_POST["ID"];
            }

            if(!is_array($_POST["formIds"])){
                    $_POST["formIds"]=array();
            }

            foreach($formsArr as $form){
                    if(in_array($form["fid"], $_POST["formIds"])){
                            $siteUsers->userAddForm($id, $form["fid"]);			
                    }else{
                            $siteUsers->userDeleteForm($id, $form["fid"]);
                    }	
            }


            if(!$exists){
                    header("location: index.php?show=site_users/users");
                    exit;
            }
        }
}

if($id){
	$user_data=$siteUsers->getValues($_REQUEST["user_id"]);
}

if(!$user_data && $_POST){
	if (!$cerror) $user_data=$_POST;
}


?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Site Users"];?>	-> <?php echo $id?$text["Edit"].":".$user_data["First_Name"]." ".$user_data["Last_Name"]:$text["Add New"];?></div>


<div class="editPagePadding">
<div class="SecurityMessage"><?php echo $cerror;?></div>
	<?php if($exists){?>
	This username already exists,<br />
	Please choos another one
	<?php }?>
	<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
	<input type="hidden" name="show" value="site_users/edit_user" />
	<input type="hidden" name="ID" value="<?php echo $user_data["ID"];?>" />
	<table>
		<?php /*
		<tr>
			<td style="font-size: 14px;"><?php echo $text["Name"];?></td>
			<td><input type="text" name="Name" value="<?php echo $user_data["Name"];?>" style="width: 200px; font-size: 16px; padding-right: 5px; padding-left: 5px;" /></td>		
		</tr>
		*/?>
		<tr>
			<td style="font-size: 14px;"><?php echo $text["First Name"];?></td>
			<td><input type="text" name="First_Name" value="<?php echo $user_data["First_Name"];?>" style="width: 200px; font-size: 16px; padding-right: 5px; padding-left: 5px;" /></td>		
		</tr>
		<?php /*
		<tr>
			<td style="font-size: 14px;"><?php echo $text["Last Name"];?></td>
			<td><input type="text" name="Last_Name" value="<?php echo $user_data["Last_Name"];?>" style="width: 200px; font-size: 16px; padding-right: 5px; padding-left: 5px;" /></td>		
		</tr>
		*/?>
		<tr>
			<td style="font-size: 14px;"><?php echo $text["Email"];?></td>
			<td><input type="text" name="Email" value="<?php echo $user_data["Email"];?>" dir="ltr" style="width: 200px; font-size: 16px; padding-right: 5px; padding-left: 5px;" /></td>		
		</tr>
		<tr>
			<td style="font-size: 14px;"><?php echo $text["Send Email"];?></td>
			<td>
				<select name="Enabled" style="width: 212px; font-size: 16px; padding-right: 5px; padding-left: 5px;">
					<option value="1" <?php echo ($user_data["Enabled"]==1)?"SELECTED":"";?>><?php echo $text["Enabled"];?></option>
					<option value="0" <?php echo ($user_data["Enabled"]==0)?"SELECTED":"";?>><?php echo $text["Disabled"];?></option>							
				</select>
			</td>		
		</tr>
		<tr>
			<td colspan="2">
				<hr />
			</td>
		</tr>
		<tr>
			<td valign="top" style="font-size: 14px;"><?php echo $text["Belong to forms"];?></td>
			<td valign="top" style="font-size: 14px;">
				<?php foreach($formsArr as $form){?>
					<input type="checkbox" name="formIds[]" value="<?php echo $form["fid"];?>" <?php echo $siteUsers->userInForm($user_data["ID"], $form["fid"])?"checked":"";?> style="font-size: 16px;" /> <?php echo $form["fname"];?>
					<br />
				<?php }?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<hr />
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" style="padding: 3px 20px; font-size: 16px; font-weight: bold; float: left;" /></td>		
		</tr>		
	</table>
	</form>

	</div>
</div>
