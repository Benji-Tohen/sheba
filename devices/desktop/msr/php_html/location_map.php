<?php $link=$wm->getLink($arr[$i]);?>
<div class="row item" id="<?php echo $arr[$i]['Name'];?>">  
    <!-- ITEM TITLE -->
    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10 itemText">
        <a href="#top" onclick="clickroute(<?php echo $arr[$i]['Author']?>);">
            <h4><?php echo $arr[$i]['Name'];?></h4>
            <?php if ($arr[$i]["Sub_Title"]) { ?>
            <h5>
                <?php
                if(intval(mb_strlen($arr[$i]["Sub_Title"], 'UTF-8'))>183){
                echo mb_substr($arr[$i]["Sub_Title"],0,180, "utf-8")."...";
                }else{
                echo $arr[$i]["Sub_Title"];
                }?>
            </h5>
            <?php } ?>
        </a>
        <h5>
            <i class="fa fa-chevron-<?php echo $gui->getRight();?>"></i><a  href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>"><?php echo $trans->getText("לעמוד המכון לחץ כאן");?></a>
        </h5>
    </div>
    
    <!-- ITEM WAZE -->
    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
        <a href="http://waze.to/?ll=<?php echo $arr[$i]['Author']?>&navigate=yes" class="wazeLink">
            <img src="<?php echo $cfg["WM"]["Server"];?>/site/images/waze.png" alt="<?php echo $trans->getText("Waze")?>" title="<?php echo $trans->getText("Waze")?>" />
            <div class="titlePop">
                <h5><?php echo $trans->getText("Navigate via Waze")?></h5>
                <span class="glyphicon glyphicon-eject"></span>
            </div>
        </a>
    </div>
    
</div>
