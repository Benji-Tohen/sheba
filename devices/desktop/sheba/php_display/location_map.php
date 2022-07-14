<a name="top">&nbsp;</a>
<div class="container institutionsPage">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
             
            <h1><?php echo $wmPage["h1"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            <?php /*removed on november 21 
            <div class="searchRow">
                <input class="searchBox" id="searchChildren" type="text" placeholder="<?php echo $trans->getText("Find institutions, units and clinics")?>" onkeyup="updateChildrenList()" />
                <button onclick="updateChildrenList()" class="searchBoxButton" title="<?php echo $trans->getText("Search")?>"><?php echo $trans->getText("Search")?></button>
            </div>
            follwing sheba's requast*/?>
            <div class='embed-container'>
                <iframe src='https://maps.spreo.co/sheba-medical-center/' style='border:0'></iframe>
            </div>
  
  
            <div id="childrenWrap">
                <?php for($i=0;$i<count($arr);$i++){?>
                    <?php 
                    if($arr[$i]['Author']){ ?>
                    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
                    <?php }?>
                <?php }?>
            </div>
        </div>
        
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-12 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
        <!-- END SIDE CONTENT -->
    </div>
</div>
