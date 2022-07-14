<?php $arrTopMenu=$wm->getMenuLevel($wm->getIdByPageType(35, $wmPage["Lang"]));?>
<?php $start=true;
      $i=0;
foreach($arrTopMenu as $item){
	if($item["Hide_On_Menu"]){continue;}
		$selected=(($wm->inChildren($id, $item["ID"])) || (trim($item["Link"], "/")==trim("http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"], "/")));
		$item["Link"]=$wm->getLink($item);
		$link=	$item["Link"]["Link"];
		$target=$item["Link"]["Target"];
?>
    <ul class="nav navbar-nav <?php if(intval($i)==0){echo "firstNav";}?>">
        <?php if($selected){?>
            <li class="active">
                <a href="<?php echo $link;?>" target="<?php echo $target;?>" class="topMenuLink"><?php echo $item["Name"];?></a>
                <!--Sub Menu-->
                <?php if($item["Enable_Dropdown"]){?>
                <ul class="submenu noPadding">
                    <?php
                    $arrTopSubMenu=$wm->getShowenMenuLevel($item["ID"]);
                    foreach($arrTopSubMenu as $child){
                        $child["Link"]=$wm->getLink($child);
                        $link=	$child["Link"]["Link"];
                        $target=$child["Link"]["Target"];
                        ?>
                        <li><a href="<?php echo $link;?>" target="<?php echo $target;?>"><?php echo $child["Name"];?></a></li>
                        <?php }?>
                </ul>
                <?php }?>
                <!--End-->
            </li>
        <?php }else{?>
            <li>
                <a href="<?php echo $link;?>" target="<?php echo $target;?>" class="topMenuLink"><?php echo $item["Name"];?></a>
                <!--Sub Menu-->
                <?php if($item["Enable_Dropdown"]){?>
                <ul class="submenu noPadding">
                    <?php
                    $arrTopSubMenu=$wm->getShowenMenuLevel($item["ID"]);
                    foreach($arrTopSubMenu as $child){
                        $child["Link"]=$wm->getLink($child);
                        $link=	$child["Link"]["Link"];
                        $target=$child["Link"]["Target"];
                        ?>
                        <li><a href="<?php echo $link;?>" target="<?php echo $target;?>"><?php echo $child["Name"];?></a></li>
                        <?php }?>
                </ul>
                <?php }?>
                <!--End-->
            </li>
        <?php }?>
    </ul>
<?php $i++;
}?>
