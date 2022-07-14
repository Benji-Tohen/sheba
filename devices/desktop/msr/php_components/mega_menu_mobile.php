<?php $arrTopMenu=$wm->getShowenMenuLevel($wm->getIdByPageType(35, $wmPage["Lang"])); ?>

<nav 
    class="navbar p-0 navbar-default-new navbar-mobile <?php echo ($wmPage['Page_Type'] !=5)?'gray-line-desc' : ''?>" 
    role="navigation"
>
    <div class="w-100">
        <?php /** menu mobile */ ?>
        <div class=" p-3 navbar-header <?php echo ($wmPage['Page_Type'] !=5)?'gray-line' : ''?>">
            <div class="wrapp-heder-mob">
                <div class="toggel-mob">
                    <button onclick="myFunction(this)" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </button>
                </div>
                <?php if(isset($logo["File_Name"]) && !empty($logo["File_Name"])  && empty($logoHomePage)){?>
                    <div class="logo-mob">
                        <?php include('header_logo.php');?>
                    </div>
                <?php } ?>
                <div class="lang-mob language_menu">
                    <?php include('language_menu.php');?>
                </div>
            </div>
            <?php if(isset($logoHomePage) && !empty($logoHomePage)){ ?>
                <div class="wrapp-logo-exclusive">
                    <?php include('header_logo.php');?>
                </div>
            <?php }?>
            <div class="headerIconsMob w-100">
                    <!-- HEADER ICONS -->
                <?php include('header_icons.php');?>
            </div>
            <div class="wrapp-banner-mob">
                <?php include('heder_banner.php');?>
            </div>
        </div>
    </div>
    <!--/.navbar-header-->
    <?php /** sub mobile menu  */ ?>
    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
        <?php /** search input  mobile */ ?>
        <div class="wrapp-search-mob">
            <!-- HEADER SEARCH -->
            <div><?php include('header_search.php');?></div>
        </div>
        <?php /**  desctop menu  */ ?>
        <ul class="nav navbar-nav" style="float: none;">
    
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

                <li class="dropdown mob" >
                    <?php if($item["Open_In"]=="_self"){
                        $target = "onkeypress=window.location.href='$link' onclick=window.location.href='$link'";
                    }else{
                        $target = "onkeypress=window.open('$link') onclick=window.open('$link')";
                    }?>
                    <a 
                        class="link_menu  <?php echo ($item['ID'] == $wmPage['ID']) ? 'link-active':'';  ?>" 
                        name="mega<?php echo $column;?>" 
                        tabindex="0" 
                        target="" <?php echo $target?> 
                        ><?php echo $item["Name"];?>

                    </a>
                    <?php if(isset($item["Enable_Dropdown"]) && !empty($item["Enable_Dropdown"])){?>
                        <?php /*children menu*//*special case for maabadot*/
                        if($item["ID"] == 53489){
                            $item["Sub_Title"] = 'בחר את המעבדה הרצויה';
                        }?>
                        <div data-toggle="dropdown" class="buttom_down">
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <ul tabindex="0" class="submenu-mobile dropdown-menu">
                            <?php foreach($arrTopSubMenu as $childKey => $child){
                                foreach($child as $i => $ch){
                                    $link = $wm->getLink($ch);
                            ?>
                                <li>
                                    <?php if($ch['Page_Type']==151){ ?>
                                        <span>
                                            <?php echo $ch["Name"];?>
                                        </span>
                                    <?php } else{?>
                                        <a  
                                            title="<?php echo $ch["Name"];?>"
                                            href="<?php echo $link['Link'];?>" 
                                            target="<?php echo $link['Target'];?>"
                                            ><?php echo $ch["Name"];?>
                                        </a>
                                    <?php }?>
                                </li>
                            <?php }}?>
                        </ul>
                    <?php }?>
                </li>
            <?php }?>
        </ul>
    </div>
</nav>
   