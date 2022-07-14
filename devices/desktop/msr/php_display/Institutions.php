<div class="container institutionsPage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["Name"];?></h1>
           <?php /* <h2><?php echo $wmPage["Sub_Title"];?></h2> */ ?>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            
            <div class="searchRow">
                <input class="searchBox" id="searchChildren" type="text" placeholder="<?php echo $trans->getText("Find institutions, units and clinics")?>" onkeyup="updateChildrenList()" />
                <button tabindex="0" onclick="updateChildrenList()" onkeypress="updateChildrenList()" class="searchBoxButton" title="<?php echo $trans->getText("Search")?>"><?php echo $trans->getText("Search")?></button>
            </div>

            <!--News Items-->
            <div id="childrenWrap">
                <?php for($i=0;$i<count($arr);$i++){?>
                    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
                <?php }?>
            </div>
            <!--end-->
        </div>
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
    

</div>
