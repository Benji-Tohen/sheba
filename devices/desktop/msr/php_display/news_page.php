<div class="container unitsPage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["Name"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            <?php 
            $date = date_create($wmPage['Start_Date']);
            $date =  date_format($date, 'd-m-Y');
            ?>
            <div class="richtext"><?php echo $date;?></div>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
        </div>
       
        
        <?php /*<!--News Items-->
        <div class="col-xs-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-11<?php }?>">
            <?php for($i=0;$i<count($arr);$i++){?>
                <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
            <?php }?>
            <div class="row newsPagePager">
                <?php include(dirname(__FILE__)."/../php_components/pager.php");?>
            </div>
            
            <!-- MORE BUTTON -->
            <a href="#" class="showMoreButton"><?php echo $trans->getText("Show More");?></a>
        </div>
        <!--end-->*/?>
        
        <?php //echo "miki:"; print_r($wmPage); ?>
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
         
    </div>
    

</div>
