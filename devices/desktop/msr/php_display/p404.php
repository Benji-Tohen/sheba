
<!-- PAGE BAR -->
<?php 
if(file_exists($device."/php_modules/inner_page_bar_02/display.php")){
    include($device."/php_modules/inner_page_bar_02/display.php");
}
?>
<!-- END PAGE BAR -->

<div class="error container marg1">
    <div class="row">
        <!-- PAGE CONTENT -->
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <!-- IMAGE -->
            <?php if($wmPage["Top_Header2"]){?>
                <img src="<?php echo $cfg["WM"]["Server"].'/'.$wmPage["Top_Header2"];?>" alt="<?php echo $wmPage["Name"]?>" title="<?php echo $wmPage["Name"]?>" class="innerImage img-responsive" />
            <?php }?>
            <!-- END IMAGE -->
            
            <div class="notFoundCircle">404</div>
            
            <!-- TEXT -->
            <div class="richtext" id="mainContent"><?php echo $wmPage["Content"];?>
            <?php echo $trans->getText("Go to");?>
                <a href="<?php echo $wm->getHomePageByLang($_SESSION["WM"]["Lang"]);?>">
                    <?php echo $trans->getText("Homepage");?>
                </a>
            </div>
            <!-- END TEXT -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>