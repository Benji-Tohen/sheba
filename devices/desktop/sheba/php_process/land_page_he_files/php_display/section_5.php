<div class="anchorOffset" id="<?php echo $sec["ID"];?>"></div>
<section class="sec_<?php echo $sec["ID"];?>">
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
                    <?php 
                        $grands=$wm->getMenuLevel($sec["ID"]);
                        $thumb_call_firstchild = $cfg["WM"]["Server"]."/webfiles/images/cache/"."622"."X"."278"."/zcX1/";;
                        ?>
                    <?php foreach ($grands as $key => $sec_child) {
                        $valuePage=$wm->getValues($sec_child["ID"]);
                        $linkName = $valuePage['btn_name'] ? $valuePage['btn_name'] : $trans->getText("Read More");
                        $linkUrl = $valuePage['btn_url'] ? $valuePage['btn_url'] : "";
                        $link = $wm->getLink($sec_child);
                        if($key > 3){ continue; }
                    ?>
                        <?php if($key == 0){?>
                        <div class="col-12">
                            <div class="firstItem">
                                <div class="firstItemImg">
                                    <img src="<?php echo $thumb_call_firstchild.$sec_child["Top_Header"];?>" alt="<?php echo $sec_child["Name"];?>" title="<?php echo $sec_child["Name"];?>" class="img-fluid" />
                                </div>

                                <div class="firstItemContent">
                                   <h5><?php echo $sec_child["Name"];?></h5>
                                   <h6><?php echo $sec_child["Sub_Title"];?></h6>
                                   <div class="Link_More">
                                    <?php if(isset($linkUrl) && !empty($linkUrl)){ ?>
                                        <a 
                                            class="redMoreLinck" 
                                            href="<?php echo $linkUrl;?>" 
                                            title="<?php echo $linkName;?>" >
                                            <?php echo $linkName;?>
                                        </a>
                                    <?php } ?>
                                   </div>

                                   <button type="button" title="<?php echo $trans->getText("Click here to donate");?>" class="clickToDonate" data-toggle="collapse" data-target="#openForm" onclick="scrollToForm()">
                                       <?php echo $trans->getText("Click here to donate");?>
                                   </button> 
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 grandItemWrap">
                            <div class="grandItem">
                                <img src="<?php echo $thumb_call_grandchild.$sec_child["Top_Header"];?>" alt="<?php echo $sec_child["Name"];?>" title="<?php echo $sec_child["Name"];?>" class="img-fluid" />
                                <h5><?php echo $sec_child["Name"];?></h5>
                                <h6><?php echo $sec_child["Sub_Title"];?></h6>
                                <div class="Link_More">
                                    <?php if(isset($linkUrl) && !empty($linkUrl)){ ?>
                                        <a 
                                            class="redMoreLinck" 
                                            href="<?php echo $linkUrl;?>" 
                                            title="<?php echo $linkName;?>" >
                                            <?php echo $linkName;?>
                                        </a>
                                    <?php } ?>
                                </div>

                                <button  type="button"  title="<?php echo $trans->getText("Click here to donate");?>" class="clickToDonate" data-toggle="collapse" data-target="#openForm" onclick="scrollToForm()">
                                    <?php echo $trans->getText("Click here to donate");?>
                                </button>
                            </div>
                        </div>
                        <?php }?>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <button 
        type="button" 
        class="donateButton ts" 
        onclick="scrollToForm()" 
        title="<?php echo $trans->getText("Donate")."&nbsp;".$trans->getText("Now");?>"
        data-toggle="collapse" 
        data-target="#openForm"
    ><?php echo $trans->getText("Donate")."<br />".$trans->getText("Now");?></button>
</section>