<?php
require_once('site/scripts/index_top.php');
$wm->writeHeaders();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($allFormData) && $wmPage['Page_Type'] == 6){
    $mtitle=$allFormData["meta_title"]?$allFormData["meta_title"]:$mtitle;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $wmPage["Lang"];?>">
<head>
<?php
/*
<!--New doc: <?php echo $_SERVER["SERVER_ADDR"]." - ".time();?>-->
*/
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $string->htmlentities($mtitle);?></title>


<?php /* Canonical Logic */ ?>
<?php if(strpos($_SERVER['REQUEST_URI'],'/item/')!==FALSE){/* /item/ pages are duplicates - add canonical to home page*/
    $ghostPageID = $wm->getHomePageById($wmPage['ID']);
    $ghostPageValues = $wm->getValues($ghostPageID);
    $ghostPageLINK = $wm->getLink($ghostPageValues);
    ?>
    <link rel="canonical" href="<?php echo $wmPage['Alias']!='' ? "https://".$wmPage['Alias'] :  $ghostPageLINK['Link']."/".$wmPage['ID'];?>" />
<?php } else if($wmPage["canonical"]){ ?>
<link rel="canonical" href="<?php echo $wmPage["canonical"];?>" />
<?php } elseif($wmPage["Type"]["ID"] == 6) { 
    // No need for canonical
} else {
  $link=$wm->getLink($wmPage);
  $canonical=strtolower($link["Link"]);
?>
<link rel="canonical" href="<?php echo $canonical;?>" />
<?php }?>
<?php /* END Canonical Logic */ ?>


<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/favicon-128.png" sizes="128x128" />

<meta name="application-name" content="&nbsp;"/>
<meta name="msapplication-TileColor" content="#FFFFFF" />
<meta name="msapplication-TileImage" content="mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

<?php 
	if(strpos($_SERVER['SERVER_NAME'], 'msr.org.il')===FALSE){?>
		<link rel="shortcut icon" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/favicon.ico" />
	<?php }else{?>
		<link rel="shortcut icon" href="<?php echo $cfg["WM"]["Server"]?>/site/images/favicomatic/msr/favicon.ico" />
	<?php }
?>


<?php 
if($wmPage["alternate"]){
	echo $wm->getAlternates($wmPage);
}
?>
<meta name="author" content="<?php if($wmPage["Author"]){echo $wmPage["Author"];}else{echo $params->getValue("default_author");}?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php if(isset($allFormData)){?>
    <meta name="description" content="<?php echo $allFormData["meta_desc"]?$allFormData["meta_desc"]:$string->htmlentities($wm->getTopValue($id, "META_Description"));?>" />
<?php }else{?>
    <meta name="description" content="<?php echo $string->htmlentities($wm->getTopValue($id, "META_Description"));?>" />
<?php }?>
<meta name="keywords" content="<?php echo $string->htmlentities($wm->getTopValue($id, "META_Kerywords"));?>" />


<?php 
    if($wmPage["og_image"]){
        $ogImage = $cfg["WM"]["Server"]."/".$wmPage["og_image"];
    } else if($wmPage["Top_Header2"]){
        $ogImage = $cfg["WM"]["Server"]."/".$wmPage["Top_Header2"];
    } else if($wmPage["Top_Header"]){
        $ogImage = $cfg["WM"]["Server"]."/".$wmPage["Top_Header"];
    } else {
        $ogImage = "";
    }

    if ($ogImage) { ?>
        
        <meta property="og:image" content="<?php echo $ogImage?>" />

        <!-- Schema.org markup for Google+ -->
        <meta itemprop="image" content="<?php echo $ogImage;?>">
        <meta itemprop="name" content="<?php echo $wmPage["META_Title"];?>">
        <meta itemprop="description" content="<?php echo $string->htmlentities($wm->getTopValue($id, "META_Description"));?>">
        <!-- END Schema.org markup for Google+ -->

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="<?php echo $params->getValue("twitter_card");?>">
        <meta name="twitter:site" content="<?php echo $params->getValue("twitter_site");?>">
        <meta name="twitter:title" content="<?php echo $string->htmlentities($mtitle);?>">
        <meta name="twitter:description" content="<?php echo $string->htmlentities($wm->getTopValue($id, "META_Description"));?>">
        <meta name="twitter:creator" content="<?php echo $params->getValue("twitter_creator");?>">
        <!-- END Twitter Card data -->

        <!-- Twitter Summary card images must be at least 120x120px -->
        <meta name="twitter:image" content="<?php echo $ogImage;?>">
        <!-- END Twitter Summary card images must be at least 120x120px -->

        <!-- Open Graph data (facebook, linkedin) -->
        <meta property="og:title" content="<?php echo $string->htmlentities($mtitle);?>" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo $cfg["WM"]["Server"].$_SERVER["REQUEST_URI"];?>" />
        <meta property="og:image" content="<?php echo $ogImage;?>" />
        <meta property="og:description" content="<?php echo $string->htmlentities($wm->getTopValue($id, "META_Description"));?>" /> 
        <meta property="og:site_name" content="<?php echo $params->getValue("website_name");?>" />
        <!-- END Open Graph data (facebook, linkedin) -->
<?php } ?>




<?php
$google_var = ($wmPage['Conversion'] ? $wmPage['Conversion'] : "");
if ($google_var) { ?>
<meta  name="google-site-verification" content="<?php echo $google_var?>" />
<?php } ?>
<?php /*
if(false && strpos($_SERVER['REQUEST_URI'],'/item/')!==FALSE){?> 
<meta name="robots" content="noindex, follow" />
<?php }elseif((isset($previewId) && $previewId) || $wmPage["noindex"]){?>
<meta name="robots" content="noindex, nofollow" />
<?php }else{?>
<meta name="robots" content="index, follow" />
<?php }*/ ?>

<?php if(isset($allFormData)){?>
     <meta name="robots" content="<?php echo $allFormData["meta_index"]?"index, follow":"noindex, nofollow";?>" />
<?php }else{?>
    <meta name="robots" content="<?php echo ((isset($previewId) && $previewId) || $wmPage["noindex"])?"noindex, nofollow":"index, follow";?>" />
<?php }?>
<?php if($params->getValue("rss")){?>
<link rel="alternate" type="application/rss+xml" title="RSS Feed for <?php echo $cfg["WM"]["Server"];?>" href="<?php echo $cfg["WM"]["Server"];?>/rss" />
<?php }?>
<?php if(file_exists($device."/php_header/index.php")){require_once($device."/php_header/index.php");}?>
<?php if(file_exists('manage/site_integration/php_header/top_menu.php')){require_once("manage/site_integration/php_header/top_menu.php");}?>
<?php echo $params->getValue("google_analytics");?>
<?php if (file_exists($device."/php_header/".$wmPage["Type"]["Page"])){?>
<?php require_once($device."/php_header/".$wmPage["Type"]["Page"]);?>
<?php }?>
<link rel="stylesheet" href="<?php echo $cfg["WM"]["Server"];?>/css/<?php echo $gui->getDir();?>.css" type="text/css" />
<?php if(file_exists($device."/php_header/css/".$wmPage["Type"]["Page"])){?>
<link rel="stylesheet" href="<?php echo $cfg["WM"]["Server"];?>/css/<?php echo $pageContentId;?>/<?php echo $gui->getDir();?>.css" type="text/css" />
<?php }else{?>
<?php }?>
<?php if($template){//$params->getValue("use_css_settings")?>
<link rel="stylesheet" href="<?php echo $cfg["WM"]["Server"];?>/webfiles/css/dynamic_<?php echo $template;?>.css" type="text/css" />
<?php }?>
<script type="text/javascript">if(top.location.host!=location.host)document.body.innerHTML='invalid access';</script>
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/mainjs/<?php echo $pageContentId;?>.js"></script>
<?php if (file_exists($device."/php_header/js/".$wmPage["Type"]["Page"])){?>
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/js/<?php echo $pageContentId;?>.js"></script>
<?php }else{?>
<?php }?>
<?php echo $params->getValue("google_tag_manager_head");?>
<?php echo $params->getValue("meta_tags");?>
</head>
<body class="<?php echo $gui->getDir();?>">
<?php 
/*if(DEV_MODE){
	echo "<pre>";
		echo "<h1 style='text-align:center;'>THIS IS DEV</h1>";
	echo "</pre>";
}*/
?>
<div id="mainOverlay" style="display: none;"></div>
<?php echo $params->getValue("google_tag_manager_body");?>
<?php 
    if($_SERVER['SERVER_NAME'] == 'connect.sheba.co.il'){
        require_once('site/js/bnagish/bnagish.php');
    }else{
        require_once('site/js/bnagishMain/bnagish.php'); 
    }
    
?>
<?php if(file_exists('manage/site_integration/php_display/top_menu.php')){require_once("manage/site_integration/php_display/top_menu.php");}?>
<?php require_once($device.'/index.php');?>

    <?php 
if(strpos($_SERVER['SERVER_NAME'],'msr.org.il')===false && strpos($_SERVER['SERVER_NAME'],'connect.sheba.co.il')===false){?>
    <?php 
   
   
   /*we can now have differnt chat scripts per params in URL - first we check if it is requested in the REQUEST_URI*/ 
   $chatScriptParam = explode('chat_script=',$_SERVER['REQUEST_URI']);
  
   if(isset($chatScriptParam[1]) && $chatScriptParam[1]!=''){
    $chatScript = $params->getScriptChat($chatScriptParam[1]);
    echo $chatScript;
   }else if(!$login->isManager()){
        /*check if this pages homepage ancestor is set to hide or show chat module*/
        $homePageID = $wm->getHomePageById($wmPage['ID']);
        $homePageHideChat = $db->getRow("SELECT hide_elad_chat FROM wm_pages WHERE ID = ".intval($homePageID));
        if($homePageHideChat['hide_elad_chat']==0 && $wmPage['ID'] != "158352"){
            if(DEBUG_MODE){?>
                  <script defer src="https://webchat.eladsoftware.com/wg_sheba_pilot/scripts/simplechat.js" type="text/javascript"></script>
            <?php }else{?>
                <script defer src="https://webchat.eladsoftware.com/wg_sheba_prod/scripts/simplechat.js" type="text/javascript"></script>
            <?php }
            
        }
   
   ?>
    <script>
        document.addEventListener("simpleChatLibLoaded", function () {

            simpleChat.init("sc_client", 'body', {
                'libStrings': {
                    'headerConnectString': {
                        'value': "מוקד זימון תורים דיגיטלי",
                    },
                    'headerAgentString': {
                        'value': '',
                    },
                    'bubbleTooltipString': {
                        'value': "מוקד זימון תורים דיגיטלי",
                    },
                    'startConversationString': {
                        'value': 'ברוכים הבאים למוקד זימון תורים דיגיטלי,<br>המוקד פעיל בימים א\'-ה\' בשעות 08:00-16:00,<br>למעט ערבי חג וחוה"מ.<br>השירות ניתן בשפה העברית בלבד.',
                    },
                },
                'customTheme': 'sheba',
            });


        }, false);
    </script>
  <?php  } 
    }
?>

<?php 
// O.G temorary script to be tested on https://beyond.sheba.co.il/158352
if ($wmPage['ID'] == "158352") {
?>
    <script>
    window.addEventListener('mouseover', initLandbot, { once: true });
    window.addEventListener('touchstart', initLandbot, { once: true });
    var myLandbot;
    function initLandbot() {
    if (!myLandbot) {
        var s = document.createElement('script');s.type = 'text/javascript';s.async = true;
        s.addEventListener('load', function() {
        var myLandbot = new Landbot.Livechat({
            configUrl: 'https://chats.landbot.io/v3/H-1056253-YEYVYVS3Q0WDTTTA/index.json',
        });
        });
        s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.js';
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    }
    }
</script>
<?php 
};
?>
</body>
</html>
