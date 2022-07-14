<?php include('php_components/side_menu.php');
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





/*messer page dont have top section*/  
$isMesserPage= $wm->get($homePageId, "is_messer_page");
if($isMesserPage==0){ /*messer is sligthly different*/?>
<div class="mainHeader" style="position: relative;">
    <?php 
    /*accessibilityJumpMenu*/
    include_once($device.'/php_components/accessibilityJumpMenu.php');
    /*accessibilityJumpMenu - END*/
    ?>
    <div class="container">
        <div class="row languageRow" noresize="1">
            <div class="hidden-xs col-sm-4 col-sm-offset-8 col-md-4 col-lg-4 col-md-offset-8 col-lg-offset-8">
                <?php include('php_components/language_menu.php');?>
            </div>
        </div>

        <div class="row iconsSearchLogoRow" noresize="1">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                <div itemscope itemtype="http://schema.org/Organization">
                    <?php 

                        $homeAlias=""; 
                        if($wmPage["Lang"]!=$cfg["WM"]["Default_Language"]){ 
                            $homeAlias="/".$wmPage["Lang"]; 
                        }
			$homepage = (($_SERVER['HTTPS'])?"https":"http")."://$mainDomain";
                        if($wmPage["Lang"]!=$cfg["WM"]["Default_Language"]){ $homepage = (($_SERVER['HTTPS'])?$cfg["WM"]["Server"]:$cfg["WM"]["Server"]);}
                    ?>
                    <a href="<?php echo $homepage; //echo $cfg["WM"]["Server"].$homeAlias;?>" title="<?php echo $trans->getText("logoName");?>" itemprop="url">
                        <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $logo["File_Name"];?>" alt="<?php echo $trans->getText("logoName");?>" title="<?php echo $trans->getText("logoName");?>" class="img-responsive logo" itemprop="logo" />
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <form id='searchForm' class="navbar-form navbar-<?php echo $gui->getLeft();?>" role="search" action="<?php echo $cfg["WM"]["Server"].'/item/'.$wm->getIdByPageTypeNoHomepageID(12,$wmPage['Lang']);?>" method="get">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control searchBox" placeholder="<?php echo $trans->getText("headerSearchText");?>" value="<?php echo isset($q)?strip_tags($q):"";?>" />
			<input type="hidden" name="search" value="1" />
                        <span tabindex="0" onkeypress="$('#searchForm').submit()" onclick="$('#searchForm').submit()" title="<?php echo $trans->getText("Search");?>" class="input-group-addon searchButton"><i class="fa fa-search"></i></span>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 headerIcons">
                <?php $arrLinksHeader=$wm->getLinksHeaderByHomePageID($homePageId);?>
                <?php $topL = 1; ?>
                    <?php foreach($arrLinksHeader as $item){?>
                        <div class="headerIcon">
                            <a name="top<?php echo $topL;?>" href="<?php echo $item["URL"];?>" title="<?php echo $item["Name"];?>" target="<?php echo $item["Target"]?($item["Target"]):"_self";?>">
                                <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $item["File_Name"];?>" alt="<?php echo $item["Name"];?>" title="<?php echo $item["Name"];?>" class="svg" />
                                <div class="headerIconName"><?php echo $trans->getText($item["Name"]);?></div>
                            </a>
                        </div>
                <?php $topL++; ?>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<?php 
}else{?>
    <style>
        .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus{
            color: #ffffff;
            background-color: #C4DA5B;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus{
            color: #ffffff;
            background-color: #C4DA5B;
        }

        /*--------------------------  XS ( max 768 ) --------------------------*/
        @media (max-width:768px){
            .homeNewsFeed .newFeedItem{
                text-align: center;
            }

            .newFeedItem img{
                margin: 0 auto 10px auto;
            }

            .homeEventsFeed .newFeedItem{
                text-align: center;
            }
        }
    </style>
    <div class="mainHeader msrHeader" style="position: relative;">
    <?php 
    /*accessibilityJumpMenu*/
    include_once($device.'/php_components/accessibilityJumpMenu.php');
    /*accessibilityJumpMenu - END*/
    ?>
    <div class="container">
        <div class="row languageRow" noresize="1">
            <div class="hidden-xs col-sm-4 col-sm-offset-8 col-md-4 col-lg-4 col-md-offset-8 col-lg-offset-8">
                <?php include('php_components/language_menu.php');?>
            </div>
        </div>

        <div class="row iconsSearchLogoRow" noresize="1">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                <div itemscope itemtype="http://schema.org/Organization">
                    <?php 

                        $homeAlias=""; 
                        if($wmPage["Lang"]!=$cfg["WM"]["Default_Language"]){ 
                            $homeAlias="/".$wmPage["Lang"]; 
                        }
            $homepage = (($_SERVER['HTTPS'])?"https":"http")."://$mainDomain";
                        if($wmPage["Lang"]!=$cfg["WM"]["Default_Language"]){ $homepage = (($_SERVER['HTTPS'])?$cfg["WM"]["Server"]:$cfg["WM"]["Server"]);}
                    $homepage = $cfg["WM"]["Server"];
                    ?>
                     <?php if($wmPage["Lang"]=="en"){ ?>
                         <a href="<?php echo $homepage;?>" title="<?php echo $trans->getText("logoName");?>" itemprop="url">
                            <img src="<?php echo $cfg["WM"]["Server"];?>/webfiles/languages/1/MESEREN.png" alt="<?php echo $trans->getText("logoName");?>" title="<?php echo $trans->getText("logoName");?>" class="img-responsive logo" itemprop="logo" />
                        </a>
                    <?php }else { ?>
                        <a href="<?php echo $homepage;?>" title="<?php echo $trans->getText("logoName");?>" itemprop="url">
                            <img src="<?php echo $cfg["WM"]["Server"];?>/webfiles/languages/1/MESER.png" alt="<?php echo $trans->getText("logoName");?>" title="<?php echo $trans->getText("logoName");?>" class="img-responsive logo" itemprop="logo" />
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <form id='searchForm' class="navbar-form navbar-<?php echo $gui->getLeft();?>" role="search" action="<?php echo $cfg["WM"]["Server"].'/item/'.$wm->getIdByPageType(12,$wmPage['Lang']);?>/msr=1" method="get">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control searchBox" placeholder="<?php echo $trans->getText("headerSearchTextMsr");?>" value="<?php echo isset($q)?strip_tags($q):"";?>" />
            <input type="hidden" name="search" value="1" />
                        <span tabindex="0" onkeypress="$('#searchForm').submit()" onclick="$('#searchForm').submit()" title="<?php echo $trans->getText("Search");?>" class="input-group-addon searchButton"><i class="fa fa-search"></i></span>
                    </div>
                </form>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <a href="https://waze.to/li/hsv8y2fnh9&amp;navigate=yes" class="wazeLink" target="_blank">
                    <img style="width: 50px;" src="https://www.sheba.co.il/site/images/waze.png" alt="Waze" title="Waze">
                    <div class="titlePop">
                        <h5 style="font-family: Arial;color: #16264d;font-size: 15.4px;font-weight: 400;letter-spacing: -0.385px;line-height: 20px;text-align: center;transform: scaleX(1.0071); /* width and height properties ommitted due to transform */"><?php echo $trans->getText("הגעה למסר");?></h5>
                    </div>
                </a>
            </div>
            
        </div>
    </div>
</div>
<?php }

?>
<!-- HEADER BANNER -->
<?php if($wm->get($homePageId, "Menu_File") || $wm->get($homePageId, "Menu_File_Logo")|| $wm->get($homePageId, "Menu_File_Text")){
    /*check how to display Menu_File*/
    $display_mode = $wm->get($homePageId, "Menu_File_Display_Mode");
    switch ($display_mode) {
        case 1:/*display one big pic*/
         if($wm->get($homePageId, "Menu_File_Selected")) { ?>
            <!-- DESKTOP IMAGE -->
            <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-responsive hidden-xs hidden-sm" />
            <!-- MOBILE IMAGE -->
            <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File_Selected");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-responsive hidden-md hidden-lg" />
        <?php } else {?>
            <!-- DESKTOP AND MOBILE SAME IMAGE -->
            <a href="<?php echo $cfg["WM"]["Server"].$homeAlias;?>" title="<?php echo $trans->getText("logoName");?>" itemprop="url">
		<img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-responsive bannerOnly" />
	    </a>
        <?php }
            break;
        case 2:/*display background with logo in center*/

              ?>
            <div style="background-image: url('<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File");?>');" class="mainBannerBG">
                <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File_Logo");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-responsive mainBannerLogo" />
            </div>
        <?php  
            break;
        case 3:/*display logo on one side and text on the other*/
            ?>
            <div class="container">
                <div class="row">
                    <?php if($wm->get($homePageId, "Menu_File_Text")){?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="mainBannerText">
                            <a href="<?php echo $cfg["WM"]["Server"];?>" title="<?php echo $wm->get($homePageId, "Menu_File_Text");?>" class="mainBannerTextCell"><?php echo $wm->get($homePageId, "Menu_File_Text");?></a>
                        </div>
                    </div>
                    <?php }?>
                    <?php if($wm->get($homePageId, "Menu_File_Logo")){?>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
                            <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File_Logo");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-responsive mainBannerLogoWithText" />
                        </div>
                    <?php }?>
                </div>
            </div>   
        <?php
            break;
        default:
            break;
    }
    ?>
    
<?php }?>
<!-- END HEADER BANNER -->

<!-- Desktop Outer Image -->
<?php if($wmPage["Page_Type"] == 5 && empty($home_arr_pictures) && $wmPage['Top_Header'] && $wmPage["header_type"]=="image_galley"){
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/1920X480/zcX1/";
?>
    <img src="<?php echo $thumb_call.$wmPage['Top_Header'];?>" class="homepageInnerImg img-responsive hidden-xs hidden-sm" />
<?php }?>

<!-- Mobile inner Image -->
<?php if($wmPage["Page_Type"] == 5 && empty($mobilePicArray) && $wmPage['Top_Header2'] && $wmPage["header_type"]=="image_galley"){
    $thumb_mobile_call=$cfg["WM"]["Server"]."/webfiles/images/cache/992X992/zcX1/";
?>
    <img src="<?php echo $thumb_mobile_call.$wmPage['Top_Header2'];?>" class="homepageInnerImg img-responsive hidden-xs hidden-sm hidden-md hidden-lg" />
<?php }?>


<!-- MEGA MENU -->
<?php 
    /* if it's the preview form page don't load the mega menu*/
    if(!((isset($getParams[1]) && $getParams[1]=="1000") && $wmPage["Page_Type"]==6)){
        include_once($device.'/php_components/mega_menu.php');
    }
?>

<!-- Home Gallery -->
<?php if($wmPage["Page_Type"] == 5 && !empty($home_arr_pictures) && $wmPage["header_type"]=="image_galley"){?>
    <div class="carousel-inner row_slick_gallery hidden-xs hidden-sm">
        <?php $i=1; foreach($home_arr_pictures as $item){
        $onclick = $item['Code'] == '' ? '': "window.location.replace('".$item['Code']."')";
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/1920X480/zcX1/";
        ?>
        <div onclick="<?php echo $onclick?>" title="<?php echo $item["Contant2"];?>" class="rowslickitem item <?php echo $i==1?"active":"";?> " onmouseover="this.title='<?php echo $item["Contant2"];?>';">
            <img src="<?php echo $thumb_call.$item["File_Name"];?>" alt="<?php echo $item["Contant2"];?>" />
            <?php if($item["Name"] || $item["Content"]){?>
            <div class="carousel-caption">
                <?php if($item["Name"]){?>
                    <div class="carouselName"><?php echo nl2br($item["Name"]);?></div>
                <?php }?>
                <?php if($item["Content"]){?>
                    <div class="carouselContent"><?php echo nl2br($item["Content"]);?></div>
                <?php }?>
            </div>
            <?php }?>
        </div>
        <?php $i++;}?>
    </div>

    <?php if(!empty($mobilePicArray)){?>
    <div class="carousel-inner mobile_slick_gallery hidden-xs hidden-sm hidden-md hidden-lg">
        <?php
        $i=1;
        foreach($home_arr_pictures as $item){
            if(!$item["File_Name_Mobile"]){
                continue;
            }
            $onclick = $item['Code'] == '' ? '': "window.location.replace('".$item['Code']."')";
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/992X992/zcX1/";
        ?>
        <div onclick="<?php echo $onclick?>" title="<?php echo $item["Contant2"];?>" class="rowslickitem item <?php echo $i==1?"active":"";?> " onmouseover="this.title='<?php echo $item["Contant2"];?>';">
            <img src="<?php echo $thumb_call.$item["File_Name_Mobile"];?>" alt="<?php echo $item["Contant2"];?>" />
            <?php if($item["Name"] || $item["Content"]){?>
            <div class="carousel-caption">
                <?php if($item["Name"]){?>
                    <div class="carouselName"><?php echo nl2br($item["Name"]);?></div>
                <?php }?>
                <?php if($item["Content"]){?>
                    <div class="carouselContent"><?php echo nl2br($item["Content"]);?></div>
                <?php }?>
            </div>
            <?php }?>
        </div>
        <?php $i++;}?>
    </div>
    <?php }?>
<?php }?>

<!-- INTERNAL PAGE -->
<div class="pageWrapper">
    <div class="container breadCrumbsContainer">
        <div class="row">
            <div class="col-xs-12">
                <div class="breadCrumbs">
                    <?php include_once($device.'/php_components/navigator.php');?>
                </div>
            </div>
        </div>
    </div>
    <?php 
   
      $isSecondaryArr = $wm->getPageType($wmPage["ID"],true);
     if($isSecondaryArr['Page'] !== $wmPage["Type"]["Page"]){
        $wmPage["Type"]["Page"] = $isSecondaryArr['Page'];
     }

    if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".$device.'/php_display/'.$wmPage["Type"]["Page"])){echo "<div class='".str_replace('.php','',$wmPage['Type']['Page'])."'>"; require_once('php_display/'.$wmPage["Type"]["Page"]); echo "</div>";}?>
</div>



<!-- FOOTER -->
<div class="footer">
    <div class="container footerBar">
        <div class="row">
            <a href="<?php 
                if($gui->getDir() == "ltr"){
                    echo "mailto:shebaPr@sheba.health.gov.il";
                } else {
                    echo $cfg["WM"]["Server"].'/item/57328/1/59721';
                } ?>" title="<?php echo $trans->getText("subscribeText") ?>" class="col-xs-12 col-sm-12 col-md-5 col-lg-5 subscribeNewsletter">
                <div style="<?php echo $isMesserPage==1 ? 'display: none;': ''?>" class="input-group">
                <span class="input-group-addon subscribeButton bgcolor2">
                    <span><?php echo $trans->getText("subscribeText") ?></span>
                    <i class="fa fa-angle-<?php echo $gui->getRight();?>"></i>
                </span>
                </div>
            </a>
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                <ul class="socialIcons">
                    <?php 
                    if($isMesserPage==0){
                        $arrBottomLinks=$wm->getLinks($wmPage['Lang']);
                    }else{/*the parent of those pages is page type loby three a.k.a 91*/
                        $parent = $db->getRow("SELECT ID FROM wm_pages WHERE Parent = ".intval($homePageId)." AND Page_Type=91");
                        $arrBottomLinks=$db->getArray("SELECT * FROM wm_pages WHERE Hide_On_Menu=0 AND Parent=".intval($parent['ID']));
                    }
                    
                    /*print_r($arrBottomLinks);*/
                    ?>
                    <?php foreach($arrBottomLinks as $item){
                        if($isMesserPage==1){
                            $item["URL"]=$item["Link"];
                            $item["File_Name"]=$item["Top_Header"];
                        }
                        ?>
                        <li>
                            <a href="<?php echo $item["URL"]?($item["URL"]):"#";?>" title="<?php echo $item["Name"];?>" target="_blank">
                                <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $item["File_Name"];?>" alt="<?php echo $item["Name"];?>" title="<?php echo $item["Name"];?>" />
                            </a>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <?php require_once 'php_components/bottom_menu.php';?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <?php if($isMesserPage==0){?>
                                 <!--Facebook Widget-->
                        <div class="facebookWidget">
                            <?php
                                 if($wmPage["Lang"]=='en'){
                                    $likeBoxName = $params->getValue("likeBoxEn");
                                  }else {
                                    $likeBoxName = $params->getValue("likeBox");
                                }
                            ?>
                            <h5><?php echo $trans->getText("Find us on Facebook");?></h5>
                            <?php echo $likeBoxName; ?>
                        </div>
                        <!--END Facebook Widget-->
                        <div class="clear"></div>
                        <!--Google Maps Widget-->
                        <h4 class="footerMapText"><?php echo $isMesserPage==0 ? $trans->getText("Find us on googlemaps") : $trans->getText("Find us on googlemaps MSR") ?></h4>
                        <iframe class="mapsEmbed" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3381.805425420908!2d34.84477584673818!3d32.047457694152584!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151d4a8c7ee51359%3A0xa363450ffa189a8!2sThe+Chaim+Sheba+Medical+Center+at+Tel+Hashomer!5e0!3m2!1sen!2sil!4v1423730732733" <?php //width="100%" height="152" frameborder="0" ?> style="width:100%;height:152px;border:0px"></iframe>
                        <!--END Google Maps Widget-->
                        <div class="clear"></div>
                           <?php  }else{?>
                           <!--Google Maps Widget-->
                        <h4 class="footerMapText"><?php echo $isMesserPage==0 ? $trans->getText("Find us on googlemaps") : $trans->getText("Find us on googlemaps MSR") ?></h4>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3381.7991130775517!2d34.8482456854177!3d32.047628528124186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151d4a89631bfccb%3A0xf99e20c56eade21b!2z157XodeoLSDXlNee16jXm9eWINeU15DXqNem15kg15zXodeZ157Xldec16bXmdeUINeo16TXldeQ15nXqiB8IE1TUiAtIElzcmFlbCBDZW50ZXIgZm9yIE1lZGljYWwgU2ltdWxhdGlvbg!5e0!3m2!1siw!2sil!4v1460489965604" style="width:100%;height:152px;border:0px" allowfullscreen></iframe>
                        <!--END Google Maps Widget-->
                        <div class="clear"></div>
                             <!--Facebook Widget-->
                        <div class="facebookWidget">
                            <?php
                                 if($wmPage["Lang"]=='en'){
                                    $likeBoxName = $params->getValue("likeBoxEnMsr");
                                  }else {
                                    $likeBoxName = $params->getValue("likeBoxMsr");
                                }
                            ?>
                            <h5><?php echo $trans->getText("Find us on Facebook");?></h5>
                            <?php echo $likeBoxName; ?>
                        </div>
                        <!--END Facebook Widget-->
                        <div class="clear"></div>
                        
                               <?php  }?>
                       
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <?php require_once 'php_components/footer_side_links.php';?>
            </div>
        </div>
    </div>
</div>

<div class="bottomCredits">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-8 col-md-offset-8 bottomCreditsLeft">
                <div class="rightsReserved"><?php echo $trans->getText('all rights reserved')?></div>
                <div class="tohenCredit">&nbsp;|&nbsp;<a href="http://www.tohen-media.com" target="_blank"><?php echo $trans->getText("Site by: Media Processor");?></a></div>
            </div>
        </div>
    </div>
</div>
