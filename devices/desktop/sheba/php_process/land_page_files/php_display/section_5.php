<div class="anchorOffset" id="<?php echo $sec["ID"];?>"></div>
<section class="sec_<?php echo $sec["ID"];?> pad1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?php echo nl2br($sec["Sub_Title"]);?></h2>
                <h3><?php echo $sec["Content_Center"];?></h3>
            </div>
        </div>
        
        <div class="row">
            <?php $grands=$wm->getMenuLevel($sec["ID"]);$grandsNum=count($grands);?>
            <?php for($j=0;$j<$grandsNum;$j++){$sec_child=$grands[$j];$grandLink=$wm->getLink($sec_child);?>
                <div class="col-12 col-lg-4">
                    <a href="<?php echo $grandLink["Link"];?>" title="<?php echo $sec_child["Name"];?>" class="grandItem">
                        <img src="<?php echo $thumb_call_grandchild.$sec_child["Top_Header"];?>" alt="<?php echo $sec_child["Name"];?>" title="<?php echo $sec_child["Name"];?>" class="img-fluid" />
                        <h5><?php echo $sec_child["Name"];?></h5>
                        <h6><?php echo $sec_child["Sub_Title"];?></h6>
                    </a>
                </div>
            <?php }?>
        </div>
    </div>
</section>