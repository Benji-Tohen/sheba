<?php
$numberOfPages = array();
  $wm->getChildrenRecursive(&$numberOfPages, 4);
  /* echo '-----'.count($numberOfPages).'-------';*/
 $arrTopMenu=$wm->getShowenMenuLevel($wm->getIdByPageType(35, $wmPage["Lang"]));
?>
<div class="menuBG">
    <div class="container">
        <div class="row">
            <header class="cd-main-header col-xs-12">
                <div id="cd-search" class="cd-search">
                    <form>
                        <input type="search" placeholder="<?php echo $trans->getText("Search");?>...">
                    </form>
                </div>
                <ul class="cd-header-buttons">
                    <li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
                    <li><a class="cd-nav-trigger" href="#cd-primary-nav"><span></span></a></li>
                    <li class="sideMenuToggle"><i class="fa fa-bars"></i></div></li>
                </ul> <!-- cd-header-buttons -->
            </header>
        </div>
    </div>
</div>


<main class="cd-main-content">
    <!-- your content here -->
</main>
<?php /* <div class="cd-overlay"></div> */
function sortByOrder($a, $b) {
    return $a['show_in_block'] - $b['show_in_block'];
}
function sortByOrdering($a, $b) {
    return $a['Ordering'] - $b['Ordering'];
 }
?>

<nav class="cd-nav">
    <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
        <div class="sideMenuToggle hidden-on-collapse"><i class="fa fa-bars"></i></div>
    <?php
    $i=0;
     
     
    foreach($arrTopMenu as $item){
        $selected=(($wm->inChildren($id, $item["ID"])) || (trim($item["Link"], "/")==trim("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"], "/")));
        $item["Link"]=$wm->getLink($item);
        $link=	$item["Link"]["Link"];
        $target=$item["Link"]["Target"];
        $arrTopSubMenu=$wm->getShowenMenuLevel($item["ID"]);
        
        usort($arrTopSubMenu, 'sortByOrder');/*sort array acording to page block display*/
        $allarr=array();
        foreach ($arrTopSubMenu as $value) {/*create big array of arrays acording to blocks*/
            $allarr[$value['show_in_block']][] = $value;
          }  
          $arrTopSubMenu = $allarr;
          $soso = array();
          foreach ($allarr as $key => $value) {
              usort($value, 'sortByOrdering');/*sort array acording to page block display*/
             $soso[$key]=$value;
          }
          $arrTopSubMenu=$soso;
        ?>

            <li class="<?php if($arrTopSubMenu){echo "has-children";}?>">
                <a href="<?php echo $link;?>"><?php echo $item["Name"];?></a>
                <?php /*children menu*/?>
                <ul class="cd-secondary-nav is-hidden">
                    
                    <?php
                                    
                    
                    $l=0;
                    foreach($arrTopSubMenu as $key=> $dir){
                        $arrTopSubMenuInDirs=$dir;
                        $dir["Link"]=$wm->getLink($dir);
                        $link=	$dir["Link"]["Link"];
                        $target=$dir["Link"]["Target"];
                        ?>

                            <li class="go-back">
                                <span class="backButton">
                                    <?php echo $trans->getText("Back");?>
                                </span>
                            </li>
                            <?php /*
                            <li class="see-all"><a href="http://codyhouse.co/?p=409">כל המחלקות</a></li>
                            */ ?>
                    
                            <?php if($l==0 && $item["Sub_Title"]){?>
                                <li class="has-children">
                                    <ul class="is-hidden">
                                        <li>
                                            <div class="topMainMenuContent">
                                                <div class="navTextTitle"><?php echo $item["Name"];?></div>
                                                <div class="navTextSubTitle"><?php echo $item["Sub_Title"];?></div>
                                            </div>
                                        </li>


                                    </ul>
                                </li>
                            <?php }?>
                            
                            
                            <li class="has-children"> 
                                
                                <ul >
                                    <li class="go-back">
                                        <span class="backButton">
                                            <?php echo $trans->getText("Back");?>
                                        </span>
                                    </li>
                                    

                                       
                                <?php
                                foreach($arrTopSubMenuInDirs as $dirChild){
                                    $dirChild["Link"]=$wm->getLink($dirChild);
                                    $link=	$dirChild["Link"]["Link"];
                                    $target=$dirChild["Link"]["Target"];
                                    ?>
                                    <li>
                                        <a href="<?php echo $link;?>"><?php echo $dirChild["Name"];?></a>
                                    </li>

                                <?php }?>
                                </ul>
                            </li>
                    <?php $l++;}?>
                </ul>
            </li>

        <?php $i++;}?>
    </ul> <!-- primary-nav -->
</nav> <!-- cd-nav -->
