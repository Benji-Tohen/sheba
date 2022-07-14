<div class="container directoriesPage">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["h1"];?></h1>
            <h2><?php echo $wmPage["Sub_Title"];?></h2>
            <?php if($wmPage["Content"]){?>
                <div class="richtext"><?php echo $wmPage["Content"];?></div>
            <?php }?>
            
            <div class="searchRow">
                <input class="searchBox" id="searchByName" type="text" placeholder="<?php echo $trans->getText("Type institue")?>" />
                <button onclick="searchDoctors()" class="searchBoxButton" title="<?php echo $trans->getText("Search")?>"><?php echo $trans->getText("Search")?></button>
            </div>
            
            <!-- Letters Search -->
            <div class="lettersWrap">
                <?php 
                foreach ($arrLetters as $key => $value) {?>
                    <div onclick="searchDoctorsAlpha('<?php echo $value?>',this)" class="letterLink" title="<?php echo $value?>"><?php echo $value?></div>
                <?php }?>
                    <button onclick="searchDoctorsAll()" class="searchBoxButton" title="<?php echo $trans->getText("Display all")?>"><?php echo $trans->getText("Display all")?></button>
            </div>
            <!-- END Letters Search -->
                
            <!--Doctors Search Items-->
            <h2 class="searchCategodyTitle"><?php // **אות רלוונטית** ?></h2>
            <div id="childrenWrap">
                <?php for($i=0;$i<count($arrUnits);$i++){?>
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
