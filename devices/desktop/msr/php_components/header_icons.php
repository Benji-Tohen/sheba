<div class="wrapp-header-icons justify-content-between d-flex w-100">
    <?php $arrLinksHeader=$wm->getLinksHeaderByHomePageID($homePageId);?>
    <?php $topL = 1; ?>
        <?php foreach($arrLinksHeader as $item){?>
            <div class="headerIcon ">
                <a 
                    class="<?php echo (isset($item["custom_class"]) && $item["custom_class"]) ? "custom_".$item["custom_class"] : '';?>"
                    name="top<?php echo $topL;?>" 
                    href="<?php echo $item["URL"];?>" 
                    title="<?php echo $item["Name"];?>" 
                    target="<?php echo $item["Target"]?($item["Target"]):"_self";?>" 
                >
                    <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $item["File_Name"];?>" alt="<?php echo $item["Name"];?>" class="svg" />
                    <div class="headerIconName"><?php echo $trans->getText($item["Name"]);?></div>
                </a>
            </div>
    <?php $topL++; ?>
    <?php }?>
</div>

