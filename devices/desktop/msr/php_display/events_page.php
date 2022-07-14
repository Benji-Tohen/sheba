<div class="container eventsPage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            
            <!-- TITLE -->
            <div class="row">
                <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                    <div class="titleLine"></div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"><h1><?php echo $wmPage["Name"];?></h1></div>
                <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                    <div class="titleLine"></div>
                </div>
            </div>
            <!-- END TITLE -->

                
            <!-- SUBTITLE -->
            <?php if($wmPage["Sub_Title"]){?>
            <div class="row">
                <div class="col-xs-12">
                    <h2><?php echo $wmPage["Sub_Title"];?></h2>
                </div>
            </div>
            <?php }?>
            <!-- END SUBTITLE -->
            
            <!-- CONTENT -->
            <?php if($wmPage["Content"]){?>
                <div class="richtext"><?php echo $wmPage["Content"];?></div>
            <?php }?>
            <!-- END CONTENT -->
            <?php /*
            <a class="previousEvent"><i class="fa fa-angle-<?php echo $gui->getLeft();?>"></i>&nbsp;&nbsp; <?php echo $trans->getText("Previous")?></a>
            <a class="nextEvent"><i class="fa fa-angle-<?php echo $gui->getRight();?>"></i>&nbsp;&nbsp; <?php echo $trans->getText("Next")?></a>
	    */ ?>
        </div>
        
        <!--items-->
        <div class="col-xs-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-11<?php }?>">
            <?php for($i=0;$i<$numItems;$i=($i+3)){?>
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
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
</div>
