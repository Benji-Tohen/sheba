<?php
// Define path and name of cached file    
$cachefile = $_SERVER['DOCUMENT_ROOT'].'/webfiles/html/menu/menuCache_'.$_SERVER['HTTP_HOST'].'.html';    

// How long to keep cache file?   
if(isset($_SESSION['User_Data']['ID']) && $_SESSION['User_Data']['ID']!=''){/*we are in admin - disable cache*/
    $cachetime = 1;
}else{
    $cachetime = 86400;
}
    

// Is cache file still fresh? If so, serve it.    

if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {    
include($cachefile);
   
}else{   
// if no file or too old, render and capture HTML page.
ob_start();
    $numberOfPages = array();
  $wm->getChildrenRecursive(&$numberOfPages, 4);
  /* echo '-----'.count($numberOfPages).'-------';*/
 $arrTopMenu=$wm->getShowenMenuLevel($wm->getIdByPageType(35, $wmPage["Lang"]));

?>



<?php if (true) { ?>
<nav class="navbar navbar-default" role="navigation" >
    <div class="container">
	    <div class="navbar-header">
	        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only"><?php /* Toggle navigation */ ?></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	        </button>
	        <div class="sideMenuToggle hidden-sm hidden-md hidden-lg ts">
                <img src="<?php echo $cfg["WM"]["Server"];?>/site/images/info.svg" alt="<?php echo $trans->getText("Main Bar");?>" title="<?php echo $trans->getText("Main Bar");?>" class="svg" />
            </div>
            <div class="searchToggle hidden-sm hidden-md hidden-lg ts"><i class="fa fa-search"></i></div>
            <form id='searchMobileForm' class="searchMobileForm" role="search" action="<?php echo $cfg["WM"]["Server"].'/2353';?>" method="get">
                <div class="input-group">
                    <input type="text" name="q" class="form-control searchBox" placeholder="<?php echo $trans->getText("headerSearchText");?>" value="<?php echo isset($q)?strip_tags($q):"";?>" />
                    <input type="hidden" name="search" value="1" />
                    <span onclick="$('#searchForm').submit()" class="input-group-addon searchButton"><i class="fa fa-search"></i></span>
                </div>
            </form>
        </div>
	    <!--/.navbar-header-->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="float: none;">
                    <div class="sideMenuToggle hidden-xs ts"><img src="<?php echo $cfg["WM"]["Server"];?>/site/images/info.svg" alt="<?php echo $trans->getText("Main Bar");?>" title="<?php echo $trans->getText("Main Bar");?>" class="svg" /></div>
                    <li class="langMobile hidden-sm hidden-md hidden-lg">
                        <?php include('language_menu.php');?>
                    </li>
                    <div class="clear_on_mobile"></div>
                <?php 
                    $column = 0;
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

                        switch ($column) {
                    case 0: $column_css = ""; break;
                    case 1: $column_css = "columns-2"; break;
                    case 2: $column_css = "columns-3"; break;
                    }
                    ?>
                    
                    
                    <li class="dropdown" >
                            <?php 
                            if($item["Open_In"]=="_self"){
                                $target = "onkeypress=window.location.href='$link#mega$column' onclick=window.location.href='$link#mega$column'";
                            }else{
                                $target = "onkeypress=window.open('$link#mega$column') onclick=window.open('$link#mega$column')";
                            }
                            ?>
                        <a  name="mega<?php echo $column;?>" tabindex="0" target="" <?php echo $target?> class="dropdown-toggle" data-toggle="dropdown"><?php echo $item["Name"];?>
                            <?php if($item["Enable_Dropdown"]){?>
                                <?php if(count($arrTopSubMenu)>0){ ?>
                                    <i class="fa fa-angle-down"></i>
                                <?php } ?>
                            <?php } ?>
                        </a>
                        <?php if($item["Enable_Dropdown"]){?>
                            <?php /*children menu*/
                            /*special case for maabadot*/
                            if($item["ID"] == 53489){
                                $item["Sub_Title"] = 'בחר את המעבדה הרצויה';
                            }
                            ?>
                            <ul tabindex="0" class="dropdown-menu multi-column columns-3">
                                <div class="row">
                                    <div class="hidden-xs col-sm-12 col-md-3 col-lg-3 infoItem">
                                        <h2><?php echo $item["Name"];?></h2>
                                        <?php if ($item["Sub_Title"]) { ?><h5><?php echo $item["Sub_Title"];?></h5><?php } ?>
                                    </div>
                                       <?php                   
                                        foreach($arrTopSubMenu as $key=> $dir){
                                            $arrTopSubMenuInDirs=$dir;
                                            $dir["Link"]=$wm->getLink($dir);
                                            $link=	$dir["Link"]["Link"];
                                            $target=$dir["Link"]["Target"];
                                            ?>
                                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                <ul class="multi-column-dropdown">
                                                    <?php  
                                                        foreach($arrTopSubMenuInDirs as $dirChild){
                                                        $dirChild["Link"]=$wm->getLink($dirChild);
                                                        $link=	$dirChild["Link"]["Link"];
                                                        $target=$dirChild["Link"]["Target"];
                                                    ?>
                                                        <li><a href="<?php echo $link;?>"><?php echo $dirChild["Name"];?></a></li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                </div>
                            </ul>
                        <?php }?>
                    </li>
                    <?php $column++; } ?>
                </ul>
            </div>
            <!--/.navbar-collapse-->
        </div>
	</nav>
	<!--/.navbar-->
<?php } 
// Save the cached content to a file    
$fp = fopen($cachefile, 'w');    
fwrite($fp, ob_get_contents());    
fclose($fp);    

// Send browser output    
ob_end_flush();
}
?>
