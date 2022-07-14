<?php
$homeAlias = "";
if ($wmPage["Lang"] != $cfg["WM"]["Default_Language"]) {
    $homeAlias = "/" . $wmPage["Lang"];
}
?>

<div class="overlay"></div>
<div class="popupDialog">
    <button class="closeDialog" onclick="openDialog()" title="<?php echo $trans->getText("Close")?>"><div class="glyphicon glyphicon-remove"></div></button>
    <div class="dialogTitle">
        Title
    </div>
    <div class="dialogText">
        Text
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container align-items-end">
        <a href="<?php echo $cfg["WM"]["Server"] . $homeAlias; ?>" class="navbar-brand" title="<?php echo $trans->getText("logoName"); ?>" itemprop="url">
            <img src="<?php echo $cfg["WM"]["Server"]; ?>/webfiles/languages/1/friendsofsheba_logo.jpg" alt="<?php echo $trans->getText("logoName"); ?>" title="<?php echo $trans->getText("logoName"); ?>" class="img-fluid logo" itemprop="logo" />
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach($children as $item){
                        if ($item["Hide_On_Menu"]) {
                            continue;
                        }
                        $selected=(($wm->inChildren($id, $item["ID"])) || (trim($item["Link"], "/")==trim("http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"], "/")));
                        $alias=$item["Alias"]?$item["Alias"]:$item["ID"];
                        $className="topMenuItem".$index;
                        $item["Link"]=$wm->getLink($item);
                        $link=  $item["Link"]["Link"];
                        $target=$item["Link"]["Target"];
                        $arrTopSubMenu=$wm->getShowenMenuLevel($item["ID"]); 
                        $gotSubMenu=( $item["Enable_Dropdown"] && count($arrTopSubMenu)>0 );
                    ?>
                        <li class="nav-item <?php echo $selected ? "active" : ""; ?>">
                            <a class="nav-link" href="#<?php echo $alias;?>">
                                <?php echo $item["Name"];?>
                                <?php if($selected){ ?>
                                    <span class="sr-only">(current)</span>
                                <?php }?>
                            </a>
                        </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>

<!-- MARGIN FOR FIXED HEADER -->
<div class="marginSection"></div>
<!-- END MARGIN FOR FIXED HEADER -->