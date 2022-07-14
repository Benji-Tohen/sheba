<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');

$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);


$newCustomer=!$id;


$content_update=new ContentUpdater($db, $update_table);


if($_POST){

	$arrFields=array(
		"Name"				=>	$_POST["Name"],
		"Email"				=>	$_POST["Email"],
		"URL"				=>	$_POST["URL"],
		"Alias"				=>	$_POST["Alias"],
		"Start_Date"			=>	$_POST["Start_Date"],
		"End_Date"			=>	$_POST["End_Date"]
	);

	if(!$id){
		$arrFields["Joining_Date"]=date("Y-m-d H:i:s", time());
	}

	if($_POST["Password"]){
		$arrFields["Password"]=md5($_POST["Password"]);
	}

/*
	if(!$id){
		$query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table." WHERE WM_Pages=".$_POST["page_id"];
		$max_ordering=$db->getField($query, "max_ordering");
		
		$ordering=$max_ordering+1;
		
		$arrFields["Ordering"]=$ordering;
	}
*/	
		
	$new_id=$content_update->update($id, $arrFields);
	
	if(!$id){
		$id=$new_id;

		$queryCreateUsersTable="
CREATE TABLE IF NOT EXISTS `wm_landing_pages_site_users_customer_".intval($id)."` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL default '',
  `First_Name` varchar(20) NOT NULL default '',
  `Last_Name` varchar(20) NOT NULL default '',
  `Email` varchar(50) NOT NULL default '',
  `Enabled` tinyint(1) unsigned NOT NULL default '0',
  `JoiningDate` datetime NOT NULL,
  `Phone` varchar(50) NOT NULL default '',
  `Address` varchar(255) NOT NULL default '',
  `LandingPage` bigint(20) NOT NULL,
  `LandingPageName` varchar(255) NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  KEY `LandingPage` (`LandingPage`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;			
		";
		$db->runQuery($queryCreateUsersTable);


		$queryCreateUsersTable="
CREATE TABLE `wm_landing_pages_site_users_values_customer_".intval($id)."` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `Parent` bigint(20) unsigned NOT NULL default '0',
  `Ordering` bigint(20) unsigned NOT NULL default '0',
  `Name` varchar(255) default NULL,
  `Value` text,
  `wm_forms_fields` bigint(20) unsigned NOT NULL default '0',
  `wm_landing_pages` bigint(20) unsigned NOT NULL default '0',
  `wm_landing_pages_site_users_customer_".intval($id)."` int(10) unsigned NOT NULL default '0',
  `wm_landing_pages_site_users_values_customer_post_".intval($id)."` int(10) unsigned NOT NULL default '0',
  `JoiningDate` datetime NOT NULL,
  UNIQUE KEY `ID` (`ID`),
  KEY `wm_forms_fields` (`wm_forms_fields`),
  KEY `wm_pages` (`wm_landing_pages`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		";
		$db->runQuery($queryCreateUsersTable);


		$queryCreateUsersTable="
CREATE TABLE `wm_landing_pages_site_users_values_customer_post_".intval($id)."` (
  `ID` int(11) NOT NULL auto_increment,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `wm_landing_pages` bigint(20) NOT NULL,
  `wm_landing_pages_site_users_customer_".intval($id)."` bigint(20) NOT NULL,
  `JoiningDate` datetime NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		";
		$db->runQuery($queryCreateUsersTable);


	}


if($newCustomer){
	$clientName=$_POST["Name"];

	$clientName = ereg_replace("[^A-Za-z0-9]", "", $clientName);
	
	$file_path="webfiles/landing_pages_customers/".intval($id)."_".$clientName;
	$full_file_path="../../".$file_path; 
	$file=new File();
	$file->checkPath($full_file_path);

	$arrFields=array("folder"=>$file_path);

	$content_update->update($id, $arrFields);
}


	if(is_uploaded_file($_FILES['user_file']['tmp_name'])){
		$file_path="webfiles/landing_pages_customers/".intval($id)."/Default_Header/";
		$full_file_path="../../".$file_path; 
		@chmod($full_file_path, 0777);
	
		$file=new File();
		$file->checkPath($full_file_path);

		$file_name=str_replace(" ", "_", $_FILES['user_file']['name']);
		
		$content_update->update($id, array("Default_Header"=>$file_path.$file_name));
		move_uploaded_file($_FILES['user_file']['tmp_name'], $full_file_path.$file_name);
		@chmod($full_file_path.$file_name, 0777);
	}

	if(!$_POST["SubmitAdd"]){
		header("location: index.php?show=".$folderName."/index&page_id=".$page_id);
		exit;
	}else{
		$id=NULL;
	}
}

if($id && $id>0){
	$row_item=$content_update->getValues($id);
}


$gui=new Gui("he");
?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line">
<a href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $row_item?$row_item["Name"]:$text["Add Item"];?></div>
<div class="editPagePadding">

<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_item["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<table>		
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_item["Name"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Alias"];?>:</td>
		<td><input type="text" name="Alias" value="<?php echo $row_item["Alias"];?>" dir="ltr" style="width: 200px;" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Link"];?>:</td>
		<td><input type="text" name="URL" value="<?php echo $row_item["URL"];?>" dir="ltr" style="width: 200px;" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Email"];?>:</td>
		<td><input type="text" name="Email" value="<?php echo $row_item["Email"];?>" dir="ltr" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Password"];?>:</td>
		<td><input type="text" name="Password" dir="ltr" /></td>		
	</tr>
	<tr>
		<td valign="top">תמונת הדר:</td>
		<td>
<?php if($row_item["Default_Header"] && file_exists("../../".$row_item["Default_Header"])){?><?php 
$fileNameArr=$row_item["Default_Header"];
list($name, $ext)=explode("[.]", $fileNameArr);
?>
<?php if($ext=="swf"){?>
<object width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"><param name="movie" value="<?php echo $cfg["WM"]["Server"]."/".$row_item["Default_Header"];?>"></param><param name="wmode" value="transparent"></param><embed src="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>" type="application/x-shockwave-flash" wmode="transparent" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"></embed></object>
<?php }elseif($row_item["Default_Header"]){?>			
<img src="<?php echo "../../".$row_item["Default_Header"];?>" width="250" border="0" />
<?php }?>
<br />
<?php };?>

			<input type="file" name="user_file" />

		</td>		
	</tr>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
<script language="javascript" type="text/javascript">
document.edit.Name.focus();
</script>
