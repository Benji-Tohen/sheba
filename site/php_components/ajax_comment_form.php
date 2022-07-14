<?php
session_start();
require_once('../../conf/conf.data.php');
require_once('../../classes/gui/class.gui.php');
require_once('../../classes/webmaster/class.webmaster.php');
require_once('../../classes/translate/class.translate.php');
require_once('../../classes/parameters/class.parameters.php');
require_once("../../classes/phpmailer/class.send_mail.php");
require_once('../../classes/phpmailer/sendmail.php');
require_once('../../classes/content_management/class.content_updater.php');
require_once('../../classes/site_users/class.site_users.php');


$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=intval($_REQUEST["id"]);
$wmPage=$wm->getValues($id);

$gui=new Gui($wmPage["Lang"]);
$trans=new Translate($db, $wmPage["Lang"]);
$params=new Parameters($db);
?>
<div class="commentForm" id="ajaxCommentForm" dir="<?php echo $gui->getDir();?>">
<?php 
if($_POST["hidden_Submit"]){		//	use $_POST or $_GET

		$commentsEnable=$wm->get($id, "Comments");
		if($commentsEnable=="no"){
			$enabled="0";
		}elseif($commentsEnable=="yes"){
			$enabled="1";			
		}elseif($commentsEnable=="with approval"){
			$enabled="0";			
		}


		$arrFields=array(
			"Name"			=>	strip_tags($_POST["Name"]),
			"Email"			=>	strip_tags($_POST["Email"]),
			"Subject"		=>	strip_tags($_POST["Subject"]),	
			"Comments"		=>	strip_tags($_POST["Comments"]),
			"wm_pages"		=>	$_POST["id"],
			"post_date"		=>	time(),
			"enabled"		=>	$enabled
		);

		$db->updateData("wm_comments", $arrFields);	

		if(!$wmPage["Email"]){
			$wmPage["Email"]=$params->getValue("site_mail_default_email");
		}
	
		$toList=	$wmPage["Email"];			//	The Email Address
		$subject=	"Comment from ranaor website";		//	The Subject
		$from=		$wmPage["Email"];			//	From EMail address
									
		//$body="This is an email from Website<br /><br />";	//	Some Initial Text
		$body="From ".$wmPage["Name"].":<br /><br />";

		$_POST["id"]=$wmPage["Name"];

		$postLang=array(
			"id"			=>	"דף",
			"Name"			=>	"שם",
			"Email"			=>	"דואל",
			"Subject"		=>	"נושא",
			"Comments"		=>	"תוכן הפנייה"
		);
	
		$body.=getFormTable($_POST, $postLang);	//	use $_POST or $_GET	
		$toArray=explode(",", $toList);
		foreach($toArray as $to){
			sendSingleMail($subject, $body, $to, $from);
		}


		$siteUsers=new SiteUsers($db, "wm_siteusers");
	
		$enable=1;
		if($_POST["SendMail"]){
			$enable=1;
				$commentsEnable=$this->get($id, "Comments");
		if($commentsEnable=="no"){

		}elseif($commentsEnable=="yes"){
			
		}elseif($commentsEnable=="with approval"){
			
		}
}
	
		$arrFields=array(
			"Name"			=>	$_POST["Name"],
			"Email"			=>	$_POST["Email"],	
			"Comments"		=>	$_POST["Comments"]
		);
	
		$user_id=$siteUsers->addUser($arrFields);

?>

	<div class="commentsThankYou"><?php echo $trans->getText("Your comment sent");?></div>
	<?php //echo $wm->getTopValue($wmPage["ID"], "Conversion");?>
<?php }else{?>

<form method="get" name="ajaxCommentFormForm" style="padding: 0px; margin: 0px;" onsubmit="return false;">
<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="hidden" name="hidden_Submit" value="1" />
<input type="hidden" name="hidden_subject" value="<?php echo $trans->getText("Comment from");?> <?php echo $cfg["WM"]["WebsiteName"];?> (<?php echo $wmPage["Name"]?>)" />

<div class="ajaxCommentFormText">
	<div class="ajaxCommentFormTextText"><?php echo $trans->getText("CommentName");?>:</div>
	<input name="Name" type="text" id="Name" size="50" class="ajaxCommentFormInputText" />
	<div style="clear: both;"></div>
</div>

<div class="ajaxCommentFormText">
	<div class="ajaxCommentFormTextText"><?php echo $trans->getText("CommentSubject");?>:</div>
	<input name="Subject" type="text" id="Subject" size="50" class="ajaxCommentFormInputText" />
	<div style="clear: both;"></div>
</div>

<div class="ajaxCommentFormText">
	<div class="ajaxCommentFormTextText"><?php echo $trans->getText("CommentEmail");?>:</div>
	<input name="Email" type="text" id="Email" size="50" class="ajaxCommentFormInputText" dir="ltr" />
	<div style="clear: both;"></div>
</div>

<div class="ajaxCommentFormTextarea">
	<div class="ajaxCommentFormTextText"><?php echo $trans->getText("CommentComments");?>:</div>
	<textarea name="Comments" class="ajaxCommentFormTextareaArea"></textarea>
	
</div>

<div class="ajaxCommentFormText">
	<div class="ajaxCommentFormInputButton" onclick="submitAjaxCommentForm(document.ajaxCommentFormForm, '<?php echo $cfg["WM"]["Server"];?>/site/php_components/ajax_comment_form.php', 'ajaxCommentForm', 'callAjaxComments();');"><?php echo $trans->getText("Send");?></div>
</div>

<div style="clear: both;"></div>
</form>
<?php }?>

</div>
