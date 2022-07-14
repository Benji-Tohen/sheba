<?php

if($sp && $sp->getNumPages()>1){
    echo "<div class=\"pagerLinks\">";?>
    <a style="float: <?php echo $gui->getRight();?>;margin-<?php echo $gui->getLeft();?>: 20px;" href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo  $sp->getNumPages();?>/"><?php echo $trans->getText("Last Page");?></a>

    <?php if($page<$sp->getNumPages()){?>
        <a style="float: <?php echo $gui->getRight();?>;margin-<?php echo $gui->getLeft();?>: 16px;" href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo $page+1;?>/"><?php echo $trans->getText("Next"); ?></a>
    <?php
    $headerLink="next";
    }
    if($page>1){
        ?>
    <a style="float: <?php echo $gui->getLeft();?>;margin-<?php echo $gui->getRight();?>: 16px;" href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo $page-1;?>/"><?php echo $trans->getText("Previous"); ?></a>
    <?php
        $headerLink="prev";
    }
    for($j=0,$i=1;$i<=$sp->getNumPages();$i++){
        if($i<$page-2){continue;}
        if($i>$page+2){break;}
        if($j>0){
            echo "  ";
        }?>
    <?php if($page==$i){?><?php echo $i;?><?php }else{?><a href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo $i;?>/"><?php echo $i;?></a><?php }$j++;?>
    <?php }?>
    <?php echo "</div>";
}
?>
