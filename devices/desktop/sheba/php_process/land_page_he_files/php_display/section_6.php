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
            <div class="col-12 col-md-10 col-lg-10 mx-auto">
                <div class="row">
                    <?php $grands=$wm->getMenuLevel($sec["ID"]);$grandsNum=count($grands);?>
                    <?php for($j=0;$j<$grandsNum;$j++){$sec_child=$grands[$j];$grandLink=$wm->getLink($sec_child);?>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 grandItemWrap">
                            <a href="<?php echo $grandLink["Link"];?>" title="<?php echo $sec_child["Name"];?>" class="grandItem">
                                <div class="itemLabel"><?php echo $sec_child["Name"];?></div>
                                <img src="<?php echo $thumb_call_grandchild.$sec_child["Top_Header"];?>" alt="<?php echo $sec_child["Name"];?>" title="<?php echo $sec_child["Name"];?>" class="img-fluid" />
                                <h6><?php echo $sec_child["Sub_Title"];?></h6>
                                <?php /*<div class="clickToDonate"><?php echo $trans->getText("Click here to donate");?></div>*/?>
                            </a>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>