<div class="first-col">
    <h4><?php echo $trans->getText("title_senter_sheba") ?></h4>
    <div class="footer-contact-text">
        <?php echo $trans->getText("Find us on googlemaps"); ?>
    </div>
    <div class="wrapp-news-letter-btn">
        <?php if($boolSotialLinksNewsletter){?>
            <a href="<?php
                if($gui->getDir() == "ltr"){
                    echo "mailto:shebaPr@sheba.health.gov.il";
                } else {
                    if($homePageHideChat['newsletter_btn_link']==''){
                        echo $params->getValue("newsletter_default_link") != '' ? $params->getValue("newsletter_default_link") : $cfg["WM"]["Server"].'/item/57328/1/59721';
                    }else{
                        echo $homePageHideChat['newsletter_btn_link'];
                    }
                    
                } ?>" title="<?php echo $trans->getText("subscribeText") ?>"
            >
                <?php echo $newsletterBtnTitle; ?>
            </a>
        <?php }?>
    </div>
</div>
<div class="second-col">
    <?php require 'bottom_menu.php';?>
</div>
<div class="third-col">
    <?php require 'footer_side_links.php';?>
</div>