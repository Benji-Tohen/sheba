<?php
    $arrTopMenu=$wm->getShowenMenuLevel($wm->getIdByPageType(35, $wmPage["Lang"]));
    // print_r(HOMEPAGEID);
    // echo "<br/>";
    // print_r($wm->getIdByPageType(35, $wmPage["Lang"]));exit;
 ?>
<nav 
    class="navbar navbar-default-new <?php echo ($wmPage['Page_Type'] !=5)?'gray-line-desc' : ''?>" 
    role="navigation" 
>
    <div class="wrapp-mega-menu">           
        <div class="navbar-collapse" data-toggle="collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php $column = 0;
                foreach($arrTopMenu as $item){
                    $selected=(($wm->inChildren($id, $item["ID"])) || (trim($item["Link"], "/")==trim("http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"], "/")));
                    $item["Link"]=$wm->getLink($item);
                    $link=	$item["Link"]["Link"];
                    $target=$item["Link"]["Target"];
                    $arrTopSubMenu=$wm->getShowenMenuLevel($item["ID"]);

                    $allarr=array();
                    foreach ($arrTopSubMenu as $value) {/*create big array of arrays acording to blocks*/
                        $allarr[$value['show_in_block']][] = $value;
                    }
                    $arrTopSubMenu = $allarr;
                    $soso = array();
                    foreach ($allarr as $key => $value) {
                        $soso[$key]=$value;
                    }
                    $arrTopSubMenu=$soso;
                    switch ($column) {
                        case 0: $column_css = ""; break;
                        case 1: $column_css = "columns-2"; break;
                        case 2: $column_css = "columns-3"; break;
                    }?>

                    <li>
                        <?php if($item["Open_In"]=="_self"){
                            $target = "onkeypress=window.location.href='$link' onclick=window.location.href='$link'";
                        }else{
                            $target = "onkeypress=window.open('$link') onclick=window.open('$link')";
                        }?>
                        <a 
                            class="link_menu <?php echo ($item['ID'] == $wmPage['ID']) ? 'link-active':'';  ?>" 
                            name="mega<?php echo $column;?>" 
                            tabindex="0" 
                            target="" 
                            <?php echo $target?> 
                        >   <?php echo $item["Name"];?>
                        </a>
                        <?php if(isset($item["Enable_Dropdown"]) && !empty($item["Enable_Dropdown"])){?>
                            <?php /*children menu*//*special case for maabadot*/
                            if($item["ID"] == 53489){
                                $item["Sub_Title"] = 'בחר את המעבדה הרצויה';
                            }
                            ?>
                            <ul tabindex="0" class="dropdown-menu multi-column columns-3">
                                <div class="row">
                                    <div class="col col-sm-12 col-md-3 col-lg-3 infoItem">
                                        <h2><?php echo $item["Name"];?></h2>
                                        <?php if ($item["Sub_Title"]) { ?><h5><?php echo $item["Sub_Title"];?></h5><?php } ?>
                                    </div>
                                    <?php
                                    $colI=1;
                                    foreach($arrTopSubMenu as $key=> $dir){
                                        $arrTopSubMenuInDirs=$dir;
                                        $dir["Link"]=$wm->getLink($dir);
                                        $link=	$dir["Link"]["Link"];
                                        $target=$dir["Link"]["Target"];
                                    ?>
                                    <div class="col-12 col-md-3 col-lg-3">
                                        <ul class="multi-column-dropdown multi-dropdown-new">
                                            <?php
                                                foreach($allarr[$colI] as $dirChild){
                                                // Deside if item is clickable or not
                                                $clickableItem = ($dirChild['Page_Type'] == 151) ? 0 : 1;
                                                $dirChild["Link"]=$wm->getLink($dirChild);
                                                $link=	$dirChild["Link"]["Link"];
                                                $target=$dirChild["Link"]["Target"];
                                                $target_child = $dirChild["Open_In"];
                                            ?>
                                                <li>
                                                    <a href="<?php echo ($clickableItem) ? $link : '';?>" target="<?php echo $target_child;?>" class="<?php echo ($clickableItem) ? '' : 'notClickable';?>"><?php echo $dirChild["Name"];?></a>
                                                </li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                    <?php $colI++;} ?>
                                </div>
                            </ul>
                        <?php }?>
                    </li>
                <?php $column++; } ?>
            </ul>
        </div>
    </div>
</nav>
