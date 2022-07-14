<?php 
/* include('php_components/side_menu.php'); */
include('php_components/searchLoader.php');

$homePageId = $wm->getHomePageById($wmPage["ID"]);
/*if its a ghost page bring its ghost homr page*/
if(strpos($_SERVER['REQUEST_URI'], '/item/')!== FALSE){
    $topMenuId = $wm->getIdByPageType(35, $wmPage["Lang"]);
    $ghostHomePage = $wm->getParent($topMenuId);
    if($ghostHomePage!==$homePageId){
        $homePageId=$ghostHomePage;
    }
}

/*check if logo need to redirect to subdomain home page*/
$isLogoLinkToSubDomain = $db->getRow("SELECT logo_link_to_subdomain_home_page, domain FROM wm_pages WHERE ID = ".intval($homePageId)); 

if($isLogoLinkToSubDomain['logo_link_to_subdomain_home_page']==1){
    $logoLinkTo = $isLogoLinkToSubDomain['domain'];
}else{
    $logoLinkTo = $mainDomain;
}?>

<?php if(DEV_MODE){?>
    <pre><h1 class="text-center" style="background-color: red; color: white; padding: 30px 0;">THIS IS DEV</h1></pre>
<?php }?>

<div class="row">
    <div class="col">
        <div class="appointment_menu">
            <div class=" ">
                <!-- appointment_menu-->
                <?php include('php_components/appointment_menu.php');?>
            </div>
        </div>
    </div>
</div>

<?php if(!$display_header_logo){?>
     <!-- HEADER DESKTOP -->
    <header class="header-desktop d-none d-md-block">
        <?php include('php_components/heder_desktop.php');?>
    </header>

    <!-- HEADER MOBILE -->
    <div class="d-md-none d-block">
        <?php include('php_components/header_mobile.php');?>
    </div>

    <!-- HEADER BANNER -->
    <div class="wrapp-banner">
        <?php include('php_components/heder_banner.php');?>
    </div>
    <?php } else { ?>
    <!-- Header logo -->
    <header class="header-desktop d-none d-block">
        <div class="container header-logo">
            <?php include('php_components/header_logo.php');?>
        </div>
    </header>
<?php } ?>
<!-- INTERNAL PAGE -->
<main class="pageWrapper">
    <?php if($wmPage["Page_Type"]!=5) { ?>
        <div class="container breadCrumbsContainer">
            <div class="row">
                <div class="col">
                    <div class="breadCrumbs">
                        <?php include_once($device.'/php_components/navigator.php');?>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    <?php
    $isSecondaryArr = $wm->getPageType($wmPage["ID"],true);
    if($isSecondaryArr['Page'] !== $wmPage["Type"]["Page"]){
        $wmPage["Type"]["Page"] = $isSecondaryArr['Page'];
    }
    if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".$device.'/php_display/'.$wmPage["Type"]["Page"]))
    {
        echo "<div class='".str_replace('.php','',$wmPage['Type']['Page'])."'>"; 
        require_once('php_display/'.$wmPage["Type"]["Page"]); echo "</div>";
    } ?>
</main>

<?php /** start new footer */?>

<?php /** footer params */ ?>

<?php 
    $homePageID = $wm->getHomePageById($wmPage['ID']);
    $logoFooter = $wm->getLanguageRow($wmPage['Lang']);
    $dataValueHomePage = $wm->getValues($homePageID);
    if ($dataValueHomePage['Top_Header3']) {
        $footerLogoImg = $dataValueHomePage['Top_Header3'];
    } else if ($logoFooter["File_Name_Second"]){
        $footerLogoImg = $logoFooter['File_Name_Second'];
    } else {
        $footerLogoImg = $logoFooter['File_Name'];
    }
    $altFooterLogo = $dataValueHomePage['Top_Header3_Alt'] ? $dataValueHomePage['Top_Header3_Alt'] :$trans->getText("logoName");
    $homeDynamicFields = $wm->getDynamicFieldsByPageType($homePageID,$wmPage['Type']['ID'],1);
    if(isset($homeDynamicFields[1]["Value"]) && $homeDynamicFields[1]["Value"]){
        $newsletterBtnTitle = $string->shorten($homeDynamicFields[1]["Value"] ,20);
    } elseif($params->getValue('newsletter_default_title')){
        $newsletterBtnTitle = $string->shorten($params->getValue('newsletter_default_title'), 20);
    } else {
        $newsletterBtnTitle = $string->shorten($trans->getText("subscribeText"),20);
    }
    $homePageHideChat = $db->getRow("SELECT hide_newsletter_footer, newsletter_btn_link FROM wm_pages WHERE ID = ".intval($homePageID));
    $boolSotialLinksNewsletter = $homePageHideChat['hide_newsletter_footer'] == 0 ? true : false;
    $arrLinksStickyBar=$wm->getStickyBarByHomePageID($homePageId);
    $creditPosition = $arrLinksStickyBar ? "credit-position" : "";
?>

<footer class="new-footer">
    <div class="container">
        <div class="wrapper-one-row">
            <div class="wrapper-logo">
                <div itemscope itemtype="http://schema.org/Organization">
                    <?php $homeAlias="";
                        if($wmPage["Lang"]!=$cfg["WM"]["Default_Language"]){
                            $homeAlias="/".$wmPage["Lang"];
                        }
                        $homepage = (($_SERVER['HTTPS'])?"https":"http")."://$logoLinkTo";
                    ?>
                    <a href="<?php echo $homepage;?>" title="<?php echo $trans->getText("logoName");?>" itemprop="url">
                        <img 
                            <?php /*
                            src="<?php echo  $cfg["WM"]["Server"];?>/<?php echo $logoFooter["File_Name_Second"] ? $logoFooter["File_Name_Second"] : $logo["File_Name"];?>" 
                            alt="<?php echo $trans->getText("logoName");?>"*/  ?>
                            src="<?php echo  $cfg["WM"]["Server"];?>/<?php echo $footerLogoImg;?>" 
                            alt="<?php echo $altFooterLogo; ?>"
                            class="img-fluid logo-footer" 
                            itemprop="logo" 
                        />
                    </a>
                </div>

                <a href="<?php echo $trans->getText('badge_link');?>" target="_blank" class="standards" title="<?php echo $trans->getText('standards text');?>">
                    <div class="text-center">
                        <img src="<?php echo $cfg["WM"]["Server"];?>/webfiles/icons/standards.png" alt="" class="mb-2">
                        <div class="standards-label"><?php echo $trans->getText('standards text');?></div>
                    </div>
                </a>
            </div>
            <div class="wrapper-social-links" >
                <?php if($boolSotialLinksNewsletter){ 
                    $arrBottomLinks=$wm->getLinks($wmPage['Lang']);?>
                    <?php foreach($arrBottomLinks as $item){
                        if($item['ID'] != 38 && $item['ID'] != 40 && $homePageId =='62589'){?>
                            <a class="wrapp-icon" href="<?php echo $item["URL"]?($item["URL"]):"#";?>" title="<?php echo $item["Name"];?>" target="_blank">
                                <?php if(isset($item['Value']) && !empty($item['Value'])){ ?>
                                    <i class="<?php echo $item['Value'] ?>"></i>
                                <?php } else{ ?>
                                    <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $item["File_Name"];?>" alt="<?php echo $item["Name"];?>" />
                                <?php }?>
                            </a>
                        <?php } elseif($homePageId !='62589') {?>
                            <a class="wrapp-icon" href="<?php echo $item["URL"]?($item["URL"]):"#";?>" title="<?php echo $item["Name"];?>" target="_blank">
                                <?php if(isset($item['Value']) && !empty($item['Value'])){ ?>
                                    <i class="<?php echo $item['Value'] ?>"></i>
                                <?php } else{ ?>
                                    <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $item["File_Name"];?>" alt="<?php echo $item["Name"];?>" />
                                <?php }?>
                            </a>
                        <?php } ?>
                    <?php }?>
                <?php }?>
            </div>
        </div>
        <div class="wrapper-second-row">
            <?php  require_once 'php_components/footer_desktop.php';?>
        </div>
        <div class="wrapper-second-row-mob">
            <?php require_once 'php_components/footer_mobile.php';?>
        </div>
    </div>
    
    <div class="wrapper-credit <?php echo $creditPosition ?>">
        <div class="container">
            <div class="credit-text">
                <div class="rightsReserved"><?php echo $trans->getText('all rights reserved')?></div>
                <div class="tohenCredit">&nbsp;|&nbsp;<a href="http://www.tohen-media.com" title="<?php echo $trans->getText("Site by: Media Processor");?>" target="_blank"><?php echo $trans->getText("Site by: Media Processor");?></a></div>
            </div>
        </div>
    </div>
</footer>
<?php /** end new footer */?>

<?php /**start sticky bar  */ ?>

<?php if(isset($arrLinksStickyBar) && !empty($arrLinksStickyBar)){ ?>
    <div class="wrapper-all-sticky-bar" id="wrapper-all-sticky-bar">
        <div class="wrapper-sticky-bar">
            <?php $topL = 1; ?>
                <?php foreach($arrLinksStickyBar as $item){?>
                    <div class="icon-sticky-bar">
                        <a name="top<?php echo $topL;?>" href="<?php echo $item["URL"];?>" title="<?php echo $item["Name"];?>" target="<?php echo $item["Target"]?($item["Target"]):"_self";?>" class="<?php echo (isset($item["custom_class"]) && $item["custom_class"]) ? "custom_".$item["custom_class"] : '';?>">
                            <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $item["File_Name"];?>" alt="<?php echo $item["Name"];?>" class="svg" />
                            <div class="icon-name-sticky-bar"><?php echo str_replace(' ','</br>',$trans->getText($item["Name"]));?></div>
                        </a>
                    </div>
            <?php $topL++; ?>
            <?php }?>
        </div>
    </div>
<?php }?>
<?php /** end sticky bar */ ?>

<?php if($wmPage["schema_markup"]){
    echo $wmPage["schema_markup"];
}?>