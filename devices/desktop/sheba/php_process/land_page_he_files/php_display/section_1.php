<nav class="navbar navbar-default topMenu">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="navbar-<?php echo $gui->getRight(); ?>">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="navbar-brand d-none d-lg-block d-block d-lg-none " itemscope itemtype="http://schema.org/Organization">
                <?php
                $homeAlias = "";
                if ($wmPage["Lang"] != $cfg["WM"]["Default_Language"]) {
                    $homeAlias = "/" . $wmPage["Lang"];
                }
                ?>
                <a href="<?php echo $cfg["WM"]["Server"] . $homeAlias; ?>" title="<?php echo $trans->getText("logoName"); ?>" itemprop="url">
                    <img src="<?php echo $cfg["WM"]["Server"]; ?>/webfiles/languages/1/friendsofsheba_logo.jpg" alt="<?php echo $trans->getText("logoName"); ?>" title="<?php echo $trans->getText("logoName"); ?>" class="img-fluid logo" itemprop="logo" />
                </a>
            </div>
        </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-<?php echo $gui->getLeft(); ?> menuItems d-none d-lg-block">

                <!-- MENU ITEMS -->
                <?php
                $start = true;
                $j = 0;
                $maxMenuItems = 10;
                foreach ($children as $item) {
                   if($j==0){$j++;continue;}
                    if ($j < $maxMenuItems) {
                        if ($item["Hide_On_Menu"]) {
                            continue;
                        }
                        $selected = (($wm->inChildren($id, $item["ID"])) || (trim($item["Link"], "/") == trim("http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"], "/")));
                        $alias=$item["Alias"]?"#".$item["Alias"]:"#".$item["ID"];
                        $itemLink = $item["Link"]?$item["Link"]:$alias;
                        $itemTarget = $item["Link"]?$item["Open_In"]:"_self";
                        $className="topMenuItem".$index;
                        $item["Link"] = $wm->getLink($item);
                        $link = $item["Link"]["Link"];
                        $target = $item["Link"]["Target"];
                        ?>


                            <li class="menuItem <?php echo $className?> <?php echo $selected ? "active":""; ?>">
                                <a href="<?php echo $itemLink;?>" target="<?php echo $itemTarget;?>" class="topMenuLink <?php echo $itemLink;?>">
                                    <?php echo $item["Name"]; ?>
                                </a>
                                <!--Sub Menu-->
                                    <?php if ($item["Enable_Dropdown"]) { ?>
                                        <ul class="d-none d-lg-block submenu">
                                            <?php
                                            $arrTopSubMenu = $wm->getShowenMenuLevel($item["ID"]);
                                            foreach ($arrTopSubMenu as $child) {
                                                $child["Link"] = $wm->getLink($child);
                                                $link = $child["Link"]["Link"];
                                                $target = $child["Link"]["Target"];
                                                ?>
                                                <li><a href="<?php echo $link; ?>" target="<?php echo $target; ?>"><?php echo $child["Name"]; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                <!-- END Sub Menu-->
                            </li>

                    <?php
                    $j++;
                    }

            } ?>

                <!-- END MENU ITEMS -->
            </ul>


            <div id="top_menu_mobile" class="d-none d-lg-block d-block d-lg-none ">
                <?php
                foreach($children as $item){
                    if($item["Hide_On_Menu"]){continue;}
                        $selected=(($wm->inChildren($id, $item["ID"])) || (trim($item["Link"], "/")==trim("http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"], "/")));
                        $alias=$item["Alias"]?"#".$item["Alias"]:"#".$item["ID"];
                        $itemLink = $item["Link"]?$item["Link"]:$alias;
                        $itemTarget = $item["Link"]?$item["Open_In"]:"_self";
                        $className="topMenuItem".$index;
                        $item["Link"]=$wm->getLink($item);
                        $link=  $item["Link"]["Link"];
                        $target=$item["Link"]["Target"];
                                        $arrTopSubMenu=$wm->getShowenMenuLevel($item["ID"]);
                                        $gotSubMenu=( $item["Enable_Dropdown"] && count($arrTopSubMenu)>0 );
                ?>
                        <div class="panel panel-default">
                          <div class="panel-heading" >
                            <div class="panel-title">

                                <?php if($gotSubMenu){ ?>
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $j ?>"><div class="submenuArrow glyphicon glyphicon-menu-down">  </div> </a>
                                <?php } ?>

                                <a href="<?php echo $itemLink;?>" target="<?php echo $itemTarget;?>" class="topMenuLink <?php echo $itemLink;?>"><?php echo $item["Name"];?></a>
                                <!--Sub Menu-->
                                    <?php
                                        if( $gotSubMenu ){
                                        ?>
                                          <div id="collapse<?php echo $j; ?>" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul id="sub<?php echo $j; ?>" class="submenu_mobile">
                                                    <?php
                                                    $arrTopSubMenu=$wm->getShowenMenuLevel($item["ID"]);
                                                    foreach($arrTopSubMenu as $child){
                                                        $child["Link"]=$wm->getLink($child);
                                                        $link=  $child["Link"]["Link"];
                                                        $target=$child["Link"]["Target"];
                                                        ?>
                                                        <li><a href="<?php echo $link;?>" target="<?php echo $target;?>"><?php echo $child["Name"];?></a></li>
                                                        <?php }?>
                                                </ul>

                                            </div>
                                          </div>
                                    <?php }?>
                                    <!--End-->
                            </div>
                          </div>
                        </div>
                <?php $j++;
                }?>
            </div>


            <ul class="nav navbar-nav navbar-<?php echo $gui->getRight();?> d-none d-lg-block">
                <!-- LOGO -->
                <li itemscope itemtype="http://schema.org/Organization" class="websiteLogo">
<?php
$homeAlias = "";
if ($wmPage["Lang"] != $cfg["WM"]["Default_Language"]) {
    $homeAlias = "/" . $wmPage["Lang"];
}
?>
                    <a href="<?php echo $cfg["WM"]["Server"] . $homeAlias; ?>" title="<?php echo $trans->getText("logoName"); ?>" itemprop="url">
                        <img src="<?php echo $cfg["WM"]["Server"]; ?>/webfiles/languages/1/friendsofsheba_logo.jpg" alt="<?php echo $trans->getText("logoName"); ?>" title="<?php echo $trans->getText("logoName"); ?>" class="img-fluid logo" itemprop="logo" />
                    </a>

                </li>
                <!-- END LOGO -->
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- END CONTAINER -->
</nav>


<!-- MARGIN FOR FIXED HEADER -->
<div class="marginSection"></div>
<!-- END MARGIN FOR FIXED HEADER -->