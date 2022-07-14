<div class="container lobiTwoPage">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["h1"];?></h1>
            <h2><?php echo $wmPage["Sub_Title"];?></h2>
        </div>
        
        <!--items-->
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-11<?php }?>">
            <?php for($i=0;$i<count($arr);$i=($i+2)){?>
			<?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
		<?php }?>
            
	    	<?php require_once(dirname(__FILE__)."/../php_components/more.php");?>
            
            <div class="row newsPagePager">
                <?php include(dirname(__FILE__)."/../php_components/pager.php");?>
            </div>
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