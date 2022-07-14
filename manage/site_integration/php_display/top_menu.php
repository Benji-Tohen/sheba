<?php 
if($id==2){
	$id=$wmPage["ID"];
}
if($params->getValue("admin_enable_site_admin") && $login->isUser()){	//$login->isManager() &&
        if ($login->isReplacePassword()) {
            echo '<script>location.href="/manage/gui/index.php?show=change_pass"</script>';
            exit;
        }
	require_once('classes/lpusers/class.lpusers.php');
	$lpusers=new lpusers($db);
        
	$text=$wm->getAdminTranslation($gui->lang);
	if(empty($text)){
		$text=$wm->getAdminTranslation("en");
	}

/*
	//if($params->getValue("admin_enable_site_admin") && $login->isManager()){
	if (file_exists(dirname(__FILE__)."/../../gui/lang/".$gui->lang.".php")){
		require_once(dirname(__FILE__)."/../../gui/lang/".$gui->lang.".php");
	}
*/
        
$is_allow_edit = $wm->getPermissions($id, $_SESSION["User_Data"]["ID"], $_SESSION["User_Data"]["Level"]);
?>
<div class="adminMenu">
	<div class="adminTopMenuLeft">
		<div class="adminButton" style="padding: 0px; margin: 0px;" onclick="document.location='<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/logout/';";>
<div class="fadehover">
		<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/exit.png" class="firstImage" border="0" />
		<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/exit_hover.png" class="secondImage" border="0" />
</div>
		</div>	
	</div>

	<div class="adminTopMenuCenter"></div>
	<div class="adminTopMenuRight">
		<a href="http://www.tohen-media.com" target="_blank"><img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/logo.png" alt="טוחן מדיה" style="float: right;" border="0" /></a>

		<div class="adminTopMenuSap" style="margin-right: 0px;"></div>
<?php if($login->isManager()){?>
		<div class="adminButtonRight" id="openAdminMenu">
			<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/tools.png" />
			<div class="adminButtonIconText"><?php echo $text["menu tools"];?></div>
		</div>
<?php }?>

<?php if($login->isManager() || $_SESSION["User_Data"]["Level"]==2|| ($login->isUser() && $lpusers->isPageBelongs($wmPage))){?>
                <?php if ($is_allow_edit || $_SESSION["User_Data"]["Level"]==2) { ?>
		<div class="adminButtonRight" id="addPageButton">
			<img border="0" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/add.png" onclick="" style="cursor: pointer;" alt="Add a page" />
			<div class="adminButtonIconText"><?php echo $text["menu add"];?></div>
		</div>
                <?php } ?>
<?php }?>

		<div class="adminButtonRight" id="newsPageButton">
			<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/navigate.png" border="0" />
			<div class="adminButtonIconText"><?php echo $text["menu navigator"];?></div>
		</div>

		<div class="adminTopMenuSap"></div>


                <?php if ($is_allow_edit || $_SESSION["User_Data"]["Level"]==2 && $wmPage['Page_Type']!=6) { ?>
		<div class="adminButtonRight" id="editPageButton">
			<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/edit.png" border="0" />
			<div class="adminButtonIconText"><?php echo $text["menu edit"];?></div>
		</div>
                <?php } ?>


<?php if($login->isManager() || ($login->isUser() && $lpusers->isPageBelongs($wmPage))){?>
		<?php if($wm->getProperty($id, "Admin_Is_Gallery")==1){?>
			<div class="adminButtonRight" id="openGalleryButton">
				<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/gallery.png" border="0" />
				<div class="adminButtonIconText"><?php echo $text["menu gallery"];?></div>
			</div>
		<?php }?>
<?php }?>
		<?php if($wmPage["Comments"]!="no"){?>
			<div class="adminButtonRight" id="commentsButton">
				<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/talkback.png" border="0" />
				<div class="adminButtonIconText"><?php echo $text["menu comments"];?></div>
			</div>
		<?php }?>


<?php if($login->isManager() || $_SESSION["User_Data"]["Level"]==2 || ($login->isUser() && $lpusers->isPageBelongs($wmPage))){?>
                <?php if ($is_allow_edit || $_SESSION["User_Data"]["Level"]==2) { ?>
		<div class="adminButtonRight" id="duplicatePageButton">
			<img border="0" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/duplicate.png" onclick="" style="cursor: pointer;" alt="Add a page" />
			<div class="adminButtonIconText"><?php echo $text["menu duplicate"];?></div>
		</div>
                <?php } ?>
<?php }?>




<?php if(($login->isManager() || $_SESSION["User_Data"]["Level"]==2 || ($login->isUser() && $lpusers->isPageBelongs($wmPage))) && $wmPage["Page_Type"]!=5){?>
		<div class="adminButtonRight" onclick="document.location='<?php echo $cfg["WM"]["Server"];?>/manage/interface/tree_operations/change_param.php?field=Hide_On_Menu&page=1&value=<?php echo $wmPage["Hide_On_Menu"]?"0":"1";?>&id=<?php echo $id;?>';">
			<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/Eye0<?php echo $wmPage["Hide_On_Menu"]?"0":"1";?>.png" border="0" />
			<div class="adminButtonIconText"><?php echo $text["menu hide"];?></div>
		</div>
<?php }?>

<?php if($login->isManager() || $_SESSION["User_Data"]["Level"]==2 || ($login->isUser() && $lpusers->isPageBelongs($wmPage))){?>
                <?php if ($is_allow_edit || $_SESSION["User_Data"]["Level"]==2) { ?>
		<div class="adminButtonRight" onclick="document.location='<?php echo $cfg["WM"]["Server"];?>/manage/interface/tree_operations/change_param.php?field=noindex&page=1&value=<?php echo $wmPage["noindex"]?"0":"1";?>&id=<?php echo $id;?>';">
			<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/noindex0<?php echo $wmPage["noindex"]?"0":"1";?>.png" border="0" />
			<div class="adminButtonIconText"><?php echo $text["index"];?></div>
		</div>
                <?php } ?>
<?php }?>





		<div class="adminTopMenuSap"></div>
		
		<?php if (is_dir("devices/desktop") && $layout!="desktop"){?>
			<div class="adminButtonRight" onclick="document.location='<?php echo $cfg["WM"]["Server"]."?change_layout=desktop";?>';">
				<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/Eye01.png" border="0" style="display: inline;" />
				<div class="adminButtonIconText"><?php echo $text["Desktop Site"];?></div>
			</div>
		<?php }?>

		<?php /* <div class="adminTopMenuSap"></div> */ ?>



		<?php if($wm->getParentProperty($id, "ShowChildrenOnHomePage") && $wm->getProperty($id, "ShowOnHomepage")){?>
                        <?php /*
			<div class="adminButtonRight" onclick="document.location='<?php echo $cfg["WM"]["Server"];?>/manage/interface/tree_operations/change_param.php?field=rss&amp;page=<?php echo $page;?>&amp;value=<?php echo $wmPage["rss"]?"0":"1";?>&amp;id=<?php echo $id;?>';" border="0" />
				<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/send_to1<?php echo $wmPage["rss"]?"1":"0";?>.png" border="0" />
				<div class="adminButtonIconText"><?php echo $text["menu rss"];?></div>
			</div>

			<div class="adminButtonRight" onclick="document.location='<?php echo $cfg["WM"]["Server"];?>/manage/interface/tree_operations/change_param.php?field=ShowOnHomepage&amp;page=<?php echo $page;?>&amp;value=<?php echo $wmPage["ShowOnHomepage"]?"0":"1";?>&amp;id=<?php echo $id;?>';" border="0" />
				<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/send_to1<?php echo $wmPage["ShowOnHomepage"]?"1":"0";?>.png" border="0" />
				<div class="adminButtonIconText"><?php echo $text["menu news"];?></div>
			</div>

			<div class="adminButtonRight" onclick="document.location='<?php echo $cfg["WM"]["Server"];?>/manage/interface/tree_operations/change_param.php?field=ShowOnTicker&amp;page=<?php echo $page;?>&amp;value=<?php echo $wmPage["ShowOnTicker"]?"0":"1";?>&amp;id=<?php echo $id;?>';" border="0" />

				<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/send_to1<?php echo $wmPage["ShowOnTicker"]?"1":"0";?>.png" border="0" />
				<div class="adminButtonIconText"><?php echo $text["menu ticker"];?></div>
			</div> */ ?>
		<?php }?>

		<?php if($login->isUser() && !$login->isManager()){?>
				<div class="adminButtonRight" id="siteUsersButton">
					<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/siteUsers.png" onclick="" style="cursor: pointer;" alt="Site users" border="0" />
					<div class="adminButtonIconText"><?php echo $text["Site Users"];?></div>
				</div>
		<?php }?>
                
                <div class="adminTopMenuSap"></div>
                
                <?php if ($is_allow_edit || $_SESSION["User_Data"]["Level"]==2) { ?>
		<div class="adminButtonRight" id="facebookPublishButton">
			<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/social-facebook-box-blue-icon.png" width="36" height="36" border="0" />
			<div class="adminButtonIconText">פרסם בפייסבוק</div>
		</div>
                <?php } ?>
                
                <?php if ($is_allow_edit || $_SESSION["User_Data"]["Level"]==2) { ?>
		<div class="adminButtonRight" id="twitterPublishButton">
			<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/icons_tweet_new.png" width="36" height="36" border="0" />
			<div class="adminButtonIconText">פרסם בטוויטר</div>
		</div>
                <?php } ?>
                
                <?php /*
                <div class="adminButtonRight" id="eventsButton">
                        <img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/edit.png" border="0" />
                        <div class="adminButtonIconText">אירועים</div>
                </div>
                
                <div class="adminButtonRight" id="doctorsButton">
                        <img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/edit.png" border="0" />
                        <div class="adminButtonIconText">רופאים</div>
                </div>
                
                <div class="adminButtonRight" id="newsButton">
                        <img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/edit.png" border="0" />
                        <div class="adminButtonIconText">חדשות</div>
                </div>
                 */ ?>
                
                <?php if ($wmPage["Page_Type"]==98) { // on event page ..?>
                <div class="adminButtonRight" id="mofaButton">
                        <img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/edit.png" border="0" />
                        <div class="adminButtonIconText">הוסף מופע</div>
                </div>
                <?php } ?>
                
                <?php if ($wmPage["wm_forms"]) { // if page uses a form .. ?>
                <div class="adminButtonRight" id="formButton">
                        <img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/top_menu/edit.png" border="0" />
                        <div class="adminButtonIconText">ערוך טופס</div>
                </div>
                <?php } ?>

	</div>
</div>

<div id="adminLayer">
	<div class="adminLayerTop">
		<div class="grabBullet"></div>
		<div id="closeAdminButton" class="closeButton"></div>
	</div>
	<div style="clear: both;"></div>
	<iframe id="main1" name="main1" src="<?php echo $cfg["WM"]["Server"];?>/manage/index_no_menu.php" width="798" height="100%" scrolling="no" frameborder="0"></iframe>
</div>

<?php if($login->isManager()){?>
<div id="adminMenuLayer">
	<div class="adminMenuLayerTop">
		<div class="grabBullet"></div>
		<div id="closeAdminMenuButton" class="closeButton"></div>
	</div>
	<div style="clear: both;"></div>
	<iframe id="adminMenu" name="adminMenu" src="<?php echo $cfg["WM"]["Server"];?>/manage/menu.php" width="168" height="750" scrolling="yes" frameBorder="0"></iframe>
</div>
<?php }?>

<?php
switch ($wmPage['Page_Type']) {
    case 84: 
    	$id = $wmPage['ID']; 
    	break;
	 case 6: 
		{
			//$message = "wrong answer";
			//echo "<script type='text/javascript'>console.log('----".$getParams[3]."----');</script>";
			//$id = $getParams[3]; 
			//echo "MYTEST".$getParams[3]."AAAA";
		}
    	break;
}
if($getParams[0]=="item" && $getParams[1]=="57328"){
	$id = $getParams[3];
}else if ($getParams[0]=="57328"){
	$id = $getParams[2];
}else if($getParams[0]=="item"){
	$id = $getParams[1];
}

//if ($_SERVER['HTTP_USER_AGENT']=="Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/41.0.2272.76 Chrome/41.0.2272.76 Safari/537.36") {
//    print_r($wmPage);
//}
?>

<script language="javascript">
$("#closeAdminButton").click(function () {

	$("#adminLayer").slideUp(500,function(){});

});

$("#editPageButton").click(function () {

<?php 
if($previewId){
	?>
	main1.location="<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=pages/page_edit&id=<?php echo $id;?>&versionId=<?php echo $previewId;?>";
<?php }else{
	?>
	main1.location="<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=pages/page_edit&id=<?php echo $id;?>";
<?php }?>

$("#adminLayer").slideDown(500,function(){
});
});


$("#facebookPublishButton").click(function () {
        main1.location="<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=wm_facebook_pages/publish&id=<?php echo $id;?>";
	$("#adminMenuLayer").slideDown(500,function(){});
});

$("#twitterPublishButton").click(function () {
        main1.location="<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=wm_twitter_pages/publish&id=<?php echo $id;?>";
	$("#adminMenuLayer").slideDown(500,function(){});
});


$("#newsPageButton").click(function () {
main1.location="<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=pages/pages&id=<?php echo $id;?>";

$("#adminLayer").slideDown(500,function(){



});
});


$("#addPageButton").click(function () {
	main1.location="<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=pages/pages&id=<?php echo $id;?>&addpage=1";

	$("#adminLayer").slideDown(500,function(){});
});



$("#siteUsersButton").click(function () {
	main1.location="<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=landing_pages_site_users/users";
	$("#adminLayer").slideDown(500,function(){});
});


$("#openAdminMenu").click(function () {
	$("#adminMenuLayer").slideDown(500,function(){});
});

$("#closeAdminMenuButton").click(function () {
	$("#adminMenuLayer").slideUp(500,function(){});
});


$("#openGalleryButton").click(function () {
	main1.location='<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=gallery/gallery_pictures&page_id=<?php echo $id;?>';
	$("#adminLayer").slideDown(500,function(){});
});

<?php /*
$("#eventsButton").click(function () {
	main1.location='<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=pages/pages&id=55246';
	$("#adminLayer").slideDown(500,function(){});
});

$("#doctorsButton").click(function () {
	main1.location='<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=pages/pages&id=55554';
	$("#adminLayer").slideDown(500,function(){});
});

$("#newsButton").click(function () {
	main1.location='<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=pages/pages&id=33261';
	$("#adminLayer").slideDown(500,function(){});
}); */ ?>

<?php if ($wmPage["Page_Type"]==98) { // on event page ..?>
$("#mofaButton").click(function () {
	main1.location='<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=wm_events/index&page_id=<?php echo $id;?>';
	$("#adminLayer").slideDown(500,function(){});
});
<?php } ?>

<?php if ($wmPage["wm_forms"]) { // if page uses a form .. ?>
$("#formButton").click(function () {
	main1.location='<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=wm_forms_fields/index&form_id=<?php echo $wmPage["wm_forms"];?>';
	$("#adminLayer").slideDown(500,function(){});
});
<?php } ?>


$("#commentsButton").click(function () {
	main1.location='<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=comments/index&page_id=<?php echo $id;?>';
	$("#adminLayer").slideDown(500,function(){});
});


$("#duplicatePageButton").click(function () {
	var shure=confirm("<?php echo $text["Confirm duplicate tree"];?>");
	if(shure==false){
		return;
	}
	main1.location="<?php echo $cfg["WM"]["Server"];?>/manage/interface/tree_operations/duplicate_page.php?id=<?php echo $id;?>&Name=<?php
echo urlencode("עותק של ".str_replace("\"", "'", $wmPage["Name"]));
?>";
	$("#adminLayer").slideDown(500,function(){});
});





$(document).ready(
	function(){
		$('#adminLayer').draggable();
		$('#adminMenuLayer').draggable();
	}
);

$(document).ready(function(){
 
$("img.firstImage").hover(
	function() { $(this).animate({"opacity": "0"}, "slow");},
	function() { $(this).animate({"opacity": "1"}, "slow");}
	);
});
</script>
<?php }?>
