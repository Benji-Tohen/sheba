<!-- HEADER BANNER -->
<?php if($wm->get($homePageId, "Menu_File") || $wm->get($homePageId, "Menu_File_Logo")|| $wm->get($homePageId, "Menu_File_Text")){
    /*check how to display Menu_File*/
    $display_mode = $wm->get($homePageId, "Menu_File_Display_Mode");
    switch ($display_mode) {
        case 1:/*display one big pic*/
            if($wm->get($homePageId, "Menu_File_Selected")) { ?>
                <!-- DESKTOP IMAGE -->
                <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-fluid d-none d-lg-block" />
                <!-- MOBILE IMAGE -->
                <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File_Selected");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-fluid d-lg-none" />
            <?php } else {?>
            <!-- DESKTOP AND MOBILE SAME IMAGE -->
            <a href="<?php echo $cfg["WM"]["Server"].$homeAlias;?>" title="<?php echo $trans->getText("logoName");?>" itemprop="url">
		        <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-fluid bannerOnly" />
	        </a>
        <?php }
            break;
        case 2:/*display background with logo in center*/
        ?>
            <div style="background-image: url('<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File");?>');" class="mainBannerBG">
                <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File_Logo");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-fluid mainBannerLogo" />
            </div>
        <?php
            break;
        case 3:/*display logo on one side and text on the other*/
        ?>
        <div class="container">
            <div class="row">
                <?php if($wm->get($homePageId, "Menu_File_Text")){?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="mainBannerText" style="height: auto">
                        <a href="<?php echo $cfg["WM"]["Server"];?>" title="<?php echo $wm->get($homePageId, "Menu_File_Text");?>" class="mainBannerTextCell"><?php echo $wm->get($homePageId, "Menu_File_Text");?></a>
                    </div>
                </div>
                <?php }?>
                <?php if($wm->get($homePageId, "Menu_File_Logo")){?>
                    <div class="col-12 col-sm-6 col-md-3 offset-md-3 col-lg-3 offset-lg-3">
                        <img src="<?php echo $cfg["WM"]["Server"]."/".$wm->get($homePageId, "Menu_File_Logo");?>" alt="<?php echo $wm->get($homePageId, "Name");?>" title="<?php echo $wm->get($homePageId, "Name");?>" class="img-fluid mainBannerLogoWithText" />
                    </div>
                <?php }?>
            </div>
        </div>
        <?php
            break;
        default:
            break;
    }?>
<?php }?>
<!-- END HEADER BANNER -->