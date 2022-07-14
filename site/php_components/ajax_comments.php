<?php
session_start();
require_once('../../conf/conf.data.php');
require_once('../../classes/gui/class.gui.php');
require_once('../../classes/pager/class.super_pager.php');
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

$trans=new Translate($db, $_SESSION["WM"]["Lang"]);
$params=new Parameters($db);

$sp=$wm->getPageComments($id);
$arr=$sp->getPage(1);
?>
<?php $i=1;foreach($arr as $item){?>
	<div class="comment">
		<div id="commentTitle" class="commentTitle" onclick="$('#commentText_<?php echo $item["ID"];?>').slideToggle('fast');"><?php echo $i.". ".$item["Subject"];?></div>
		<div id="commentName" class="commentName"><?php echo $item["Name"];?> (<?php echo date("d.m.y", $item["post_date"]);?>)</div>
		<div id="commentText_<?php echo $item["ID"];?>" class="commentText">	
			<?php echo nl2br(strip_tags($item["Comments"]));?>
		</div>
	</div>
<?php $i++;}?>
