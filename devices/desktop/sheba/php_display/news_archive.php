<div class="container unitsPage">
    <div class="row">
        <div class="col-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["h1"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
        </div>
        
        <!--News Items-->
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-11<?php }?>">
            <?php for($i=0;$i<count($arr);$i++){?>
                <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
            <?php }?>
            <?php /*<div class="row newsPagePager">
                <?php include(dirname(__FILE__)."/../php_components/pager.php");?>
            </div>*/?>
            
            <!-- MORE BUTTON -->
            <?php require_once(dirname(__FILE__)."/../php_components/more.php");?>
        </div>
        <!--end-->
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-12 col-sm-10 offset-sm-1 col-md-4 offset-md-0 col-lg-4 offset-lg-0 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
</div>