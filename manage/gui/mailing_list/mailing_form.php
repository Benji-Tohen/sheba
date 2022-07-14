<?php 
require_once('common/header.php');
require_once('data.php');
require_once('../../classes/parameters/class.parameters.php');

$param=		new Parameters($db);
$tester=	$param->getValue("mailing_list_tester_email");
$beforeSend=	$param->getValue("mailing_list_before_send_text");

$id=		intval($_REQUEST["id"]);

$content_update=new ContentUpdater($db, $update_table);

$row_item=$content_update->getValues($id);

$gui=new Gui($row_item["Lang"]);


$mailBody=file_get_contents($cfg["WM"]["Server"]."/manage/gui/mailing_list/mailingList.php");


$postContent=	$row_item["Content"];
$postContent=	stripslashes($postContent);

$postContent=	str_replace($cfg["WM"]["File_Uploades_Folder_fck"], "http://".$_SERVER["HTTP_HOST"].$cfg["WM"]["File_Uploades_Folder_fck"], $postContent);

$mailBody=str_replace("[#DIR#]", 	$gui->getDir(), $mailBody);
$mailBody=str_replace("[#ALIGN#]", 	$gui->getLeft(), $mailBody);
$mailBody=str_replace("[#CONTENT#]", 	$postContent, $mailBody);


$queryForms="	SELECT DISTINCT sf.form_id AS fid, sf.form_name AS fname, (
			SELECT COUNT(*) 
			FROM wm_siteusers wsu 
			INNER JOIN wm_siteusers_forms wsf ON wsf.wm_siteusers=wsu.ID 
			WHERE wsf.form_id=fid) AS numUsers   
		FROM wm_siteusers_forms sf 
		ORDER BY fname
";

$formsArr=$db->getArray($queryForms);
?>
<script type="text/javascript" src="FCKeditor/fckeditor.js"></script><!--_<?php echo $gui->getDir();?>-->
<style type="text/css">
.mailPreview{
	color: #000000 !important;
	background-color: #ffffff;
	width: 500px;
	margin-bottom: 5px;
}

.mailSubject{
	margin-bottom: 5px;
}
</style>

<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Mailing List"];?></div>
<div class="editPagePadding">
<form name="sendMailingList" action="index.php" method="post" enctype="multipart/form-data" onsubmit="if(sendMailingList.check.checked){return true;}else{alert('עליך להסכים לתנאי השליחה');return false;}">
<input type="hidden" name="show" value="mailing_list/mailing_send" />
<input type="hidden" name="Subject" style="width: 495px; margin-bottom: 10px;" value="<?php echo $row_item["Name"];?>" />
<textarea name="Content" style="display: none;"><?php echo $row_item["Content"];?></textarea>


<div class="mailSubject"><?php echo $row_item["Name"];?></div>

<div class="mailPreview">

<?php echo $mailBody;?>

</div>


<input type="checkbox" name="test" value="1" checked /> <?php echo $text["Test"];?> (<?php echo $tester;?>)
<br />

<?php foreach($formsArr as $form){?>
	<input type="checkbox" name="formIds[]" value="<?php echo $form["fid"];?>" /> <?php echo $form["fname"];?> (<?php echo $form["numUsers"];?> <?php echo $text["Recipients"];?>)
	<br />
<?php }?>


<!--
<tr>
	<td><?php echo $text["Attachment"];?></td>
	<td><input type="file" name="fileAttached" style="margin-bottom: 10px;" /></td>	
</tr>
-->

<?php
/*
	<?php require_once('FCKeditor/fckeditor.php');?>
	<div id="richTextEditor" style="width: 500px;">
	<?php
	$sBasePath = "FCKeditor/";

	$oFCKeditor = new FCKeditor('Content') ;
	$oFCKeditor->BasePath = $sBasePath ;
	$oFCKeditor->Height= "300";

	$oFCKeditor->Config['AutoDetectLanguage']	= false;
	$oFCKeditor->Config['DefaultLanguage']		= $gui->lang;
	$oFCKeditor->Config['ContentLangDirection']	= $gui->getDir();


	$oFCKeditor->Value = '' ;
	$oFCKeditor->Create() ;
	?>
	</div>

<?php
*/
?>
<?php
/*
<div id="richTextEditor" style="width: 500px;">
<?php

//$sBasePath = $_SERVER['PHP_SELF'] ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

include("FCKeditor/fckeditor.php");
$sBasePath = "FCKeditor/";

$oFCKeditor = new FCKeditor('Content');
$oFCKeditor->BasePath = $sBasePath ;

$oFCKeditor->ToolbarSet='Middle';

//$oFCKeditor->Width = 500;
//$oFCKeditor->Height = 300;

//$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/default/' ;

$oFCKeditor->Value = $row["Content"];



$fckconfig_file="../fckconfig_".$row["Lang"].".js";

$oFCKeditor->Create($fckconfig_file);

?>
</div>
*/
?>

<br />
<div style="width: 500px; height: 100px; overflow: auto; border: 1px solid #000000; padding: 5px;"><?php echo nl2br($beforeSend);?></div>
<input type="checkbox" name="check" value="1" /> קראתי ואני מסכים לתנאים
<br /><br />
<input type="submit" name="submit" value="<?php echo $text["Send"];?>" />

</form>
</div>
<?php require_once('common/footer.php');?>
