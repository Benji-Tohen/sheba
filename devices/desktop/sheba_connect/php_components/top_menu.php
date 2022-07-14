<?php $arrTopMenu=$wm->getMenuLevel($wm->getIdByPageType(35, $wmPage["Lang"]));?>

<div class="topMenu">
	<div class="d-block d-lg-none">
		<?php include('search.php');?>
	</div>

	<ul class="menuItems">
	    <!-- MENU ITEMS -->
	    <?php
	    $start = true;
	    $i = 0;
	    $maxMenuItems = 10;
	    foreach ($arrTopMenu as $item) {
	        if ($i < $maxMenuItems) {   
	            if ($item["Hide_On_Menu"]) {
	                continue;
	            }
	            $selected = (($wm->inChildren($id, $item["ID"])) || (trim($item["Link"], "/") == trim("http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"], "/")));
	            $item["Link"] = $wm->getLink($item);
	            $link = $item["Link"]["Link"];
	            $target = $item["Link"]["Target"];
	            ?>
	                <li class="menuItem <?php echo $selected ? "active":""; ?>">
	                    <a href="<?php echo $link; ?>" target="<?php echo $target; ?>" class="topMenuLink ts" title="<?php echo $string->htmlentities($item["Name"]);?>" tabindex="0">
	                        <?php echo $item["Name"]; ?>
	                    </a>
	                    <!--Sub Menu-->
	                        <?php /* if ($item["Enable_Dropdown"]) { ?>
	                            <ul class="d-none d-lg-block submenu ts">
	                                <?php
	                                $arrTopSubMenu = $wm->getShowenMenuLevel($item["ID"]);
	                                foreach ($arrTopSubMenu as $child) {
	                                    $child["Link"] = $wm->getLink($child);
	                                    $link = $child["Link"]["Link"];
	                                    $target = $child["Link"]["Target"];
	                                    ?>
	                                    <li><a href="<?php echo $link; ?>" target="<?php echo $target; ?>" title="<?php echo $string->htmlentities($child["Name"]);?>" tabindex="-1" class="ts"><?php echo $child["Name"]; ?></a></li>
	                                <?php } ?>
	                            </ul>
	                        <?php } */?>
	                    <!-- END Sub Menu-->
	                </li>
	        <?php
	        $i++;
	        }
		} ?>
	    <!-- END MENU ITEMS -->
	</ul>
</div>