<div class="container lobiTwoPage">
    <div class="row">    
        <!--items-->
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-11<?php }?>">
            <h1><?php echo nl2br($wmPage["h1"]);?></h1>
            <h2><?php echo $wmPage["Sub_Title"];?></h2>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            
            <div class="row">
            <?php for($i=0;$i<count($arr);$i++){/*decide if show regular item or full width item*/
                // Deside if item is clickable or not
                $clickableItem = ($arr[$i]['Page_Type'] == 158) ? 0 : 1;

                $currentItem = $arr[$i];
                if($currentItem['Page_Type'] == 151){/*show sep title bar*/?>
                    <div class="sepTitle"><?php echo $currentItem['Name']?></div>
                <?php }elseif($currentItem['Page_Type'] == 152){/*show doctors form search*/
                        include(dirname(__FILE__)."/../php_display/search_doctors_form_only.php");

                        echo "<style>";
                        include(dirname(__FILE__)."/../php_header/css/search_doctors_form_only.php");
                        echo "</style>";
                }else{/*show regular loby three item*/
                     include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);
                }
              
           }?>
           </div>

            <?php /*<div class="row newsPagePager">
                <?php include(dirname(__FILE__)."/../php_components/pager.php");?>
            </div>*/?>

            <!-- MORE BUTTON -->
            <?php require_once(dirname(__FILE__)."/../php_components/more.php");?>
        </div>
        <!--end-->
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-12 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
</div>