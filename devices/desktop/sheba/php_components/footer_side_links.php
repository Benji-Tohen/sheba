<div class="footer-side-content">
    <?php $categoryLinksFooter = $wm->getFooterSideMenuLinks(0,$wmPage['Lang']);
    foreach ($categoryLinksFooter as $cat) {
        $subLinksFooter = $wm->getFooterSideMenuLinks($cat['ID'],$wmPage['Lang']);?>
        <h5><?php echo $cat['Name']?></h5>
        <?php foreach ($subLinksFooter as $link) {?>
            <a  href="<?php echo $link['URL'] ?>" title="<?php echo $link['Name'];?>" target="<?php echo $link['Open_In'];?>">
                <?php echo $link['Name']; ?>
            </a>
        <?php }
    }?>
</div>



