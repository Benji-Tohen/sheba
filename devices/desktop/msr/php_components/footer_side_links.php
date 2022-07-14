


<?php 
if ($isMesserPage==0){ ?>
    <div class="footerSideContent">
    <?php 
    $categoryLinksFooter = $wm->getFooterSideMenuLinks(0,$wmPage['Lang']);
    foreach ($categoryLinksFooter as $cat) {
        $subLinksFooter = $wm->getFooterSideMenuLinks($cat['ID'],$wmPage['Lang']);
        ?>
        <h5><strong><?php echo $cat['Name']?></strong></h5><br />
        <?php
        if (!isset($bl) || !$bl){ $bl=0; }
        foreach ($subLinksFooter as $link) {
            $bl++;
        ?>
            <h5><a name="footer<?php echo $bl;?>" href="<?php echo $link['URL'] /*echo $link['URL'] == '' ? '#footer'.$bl : $link['URL']."#footer$bl"*/?>"><?php echo $link['Name']; ?></a></h5><br />
        <?php }
        echo '<br />';
    }
    ?>
    </div>
<?php }else{ ?>

<div class="footerSideContent">
<?php 
$categoryLinksFooter = $wm->getFooterSideMenuLinksMsr(0,$wmPage['Lang']);
foreach ($categoryLinksFooter as $cat) {
    $subLinksFooter = $wm->getFooterSideMenuLinksMsr($cat['ID'],$wmPage['Lang']);
    ?>
    <h5><strong><?php echo $cat['Name']?></strong></h5><br />
    <?php
    if (!isset($bl) || !$bl){ $bl=0; }
    foreach ($subLinksFooter as $link) {
        $bl++;
    ?>
        <h5><a name="footer<?php echo $bl;?>" target="<?php echo $link['Open_In'];?>" href="<?php echo $link['URL'] /*echo $link['URL'] == '' ? '#footer'.$bl : $link['URL']."#footer$bl"*/?>"><?php echo $link['Name']; ?></a></h5><br />
    <?php }
    echo '<br />';
}
?>
</div>



<?php } ?>


