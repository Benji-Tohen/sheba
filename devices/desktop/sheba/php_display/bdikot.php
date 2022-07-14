<div class="container doctorSearchPage">
    <div class="row">
        <div class="col-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["h1"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            
            <div class="searchRow">
                <input class="searchBox" id="searchByName" type="text" placeholder="<?php echo $trans->getText("Type Disease Name")?>" />
                <div onclick="searchDoctors()" class="searchBoxButton"><?php echo $trans->getText("Search")?></div>
            </div>
            
            <!-- Letters Search -->
            <div class="lettersWrap">
                <?php 
                foreach ($arrLetters as $key => $value) {?>
                    <div onclick="searchDoctorsAlpha('<?php echo $value?>')" class="letterLink"><?php echo $value?></div>
                <?php }?>
                    <div onclick="searchDoctorsAll()" class="searchBoxButton"><?php echo $trans->getText("Display all")?></div>
            </div>
            <!-- END Letters Search -->
                
            <!--Doctors Search Items-->
            <h2 class="searchCategodyTitle"><?php echo $trans->getText("Test search results")?></h2>
            <div id="childrenWrap">
                <?php for($i=0;$i<count($arrAllDoctors);$i++){?>
                    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
                <?php }?>
            </div>
            <!--end-->
        </div>
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-12 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
    

</div>
