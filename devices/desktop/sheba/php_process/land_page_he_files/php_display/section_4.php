<?php /*
<div class="anchorOffset" id="<?php echo $sec["ID"];?>"></div>
<section class="sec_<?php echo $sec["ID"];?> pad1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?php echo nl2br($sec["Sub_Title"]);?></h2>
                <h3><?php echo $sec["Content_Center"];?></h3>
            </div>
        </div>
        
        <div class="row fiveItems">
            <?php 
                $grands=$wm->getMenuLevel($sec["ID"]);$grandsNum=count($grands);
                //$grands = array_reverse($grands);
            ?>
            <?php for($j=0;$j<$grandsNum;$j++){$sec_child=$grands[$j];$grandLink=$wm->getLink($sec_child);?>
                <div class="col-12 col-md-3 col-lg-3">
                    <a href="<?php echo $grandLink["Link"];?>" title="<?php echo $sec_child["Name"];?>" class="grandItem">
                        <img src="<?php echo $sec_child["Top_Header"];?>" alt="<?php echo $sec_child["Name"];?>" title="<?php echo $sec_child["Name"];?>" class="img-fluid img-circle" />
                        <h3><?php echo $sec_child["Name"];?></h3>
                    </a>
                </div>
            <?php }?>
        </div>
    </div>
</section>
*/?>