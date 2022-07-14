
<!-- PAGE BAR -->
<?php /*
if(file_exists($device."/php_modules/inner_page_bar_02/display.php")){
    include($device."/php_modules/inner_page_bar_02/display.php");
} */
?>
<!-- END PAGE BAR -->

<!-- DESKTOP IMAGE -->
<?php if($desktopImg){?>
    <img 
        src="<?php echo $desktopImg;?>" 
        alt="<?php echo $wmPage["Top_Header_Alt"]?>" title="<?php echo $wmPage["Top_Header_Alt"]?>" 
        class="mb-5 img-fluid d-none d-lg-block mx-auto" 
    />
<?php }?>

<?php if($mobileImg){?>
    <img 
        src="<?php echo $mobileImg;?>" 
        alt="<?php echo $wmPage["Top_Header2_Alt"]?>" title="<?php echo $wmPage["Top_Header2_Alt"]?>" 
        class="mb-5 img-fluid d-block d-lg-none mx-auto" 
    />
<?php }?>

<div class="error container marg1">
    <div class="row">
        <!-- PAGE CONTENT -->
        <div class="col-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">                     
            <!-- TEXT -->
            <div class="richtext" id="mainContent"><?php echo $wmPage["Content"];?>
            <?php /* echo $trans->getText("Go to");?>
                <a 
                    title="<?php echo $trans->getText("Homepage");?>"
                    href="<?php echo 'https://'.$_SERVER['SERVER_NAME'];?>"
                >
                    <?php echo $trans->getText("Homepage");?>
                </a>
            <?php */?>
            </div>
            <!-- END TEXT -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>