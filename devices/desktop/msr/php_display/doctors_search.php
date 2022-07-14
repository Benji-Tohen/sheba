<?php  
// Define path and name of cached file    
$cachefile = $_SERVER['DOCUMENT_ROOT'].'/webfiles/html/docs/docsCache.html';    

// How long to keep cache file?   
if(isset($_SESSION['User_Data']['ID']) && $_SESSION['User_Data']['ID']!=''){/*we are in admin - disable cache*/
    $cachetime = 1;
}else{
    $cachetime = 1;
}  

// Is cache file still fresh? If so, serve it.    

if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {    
include($cachefile);
   
}else{   
// if no file or too old, render and capture HTML page.
ob_start();?>
<div class="container doctorSearchPage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["Name"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            
            <div class="searchRow">
                <input class="searchBox" id="searchByName" type="text" placeholder="<?php echo $trans->getText("Type doctor's name")?>" />
                <select id="searchByMedDomain" class="searchBox">
                    <option value="0"><?php echo $trans->getText("Health field")?></option>
                    <?php 
                    foreach ($arrExpertise as $value) {?>
                        <option value="<?php echo $value['ID']?>"><?php echo $trans->getText($value['Name'])?></option>
                    <?php }?>
                </select>
                <select id="searchByUnit" class="searchBox">
                    <option value="0"><?php echo $trans->getText("Unit")?></option>
                    <?php
                    foreach ($arrUnitsNew as $value) {
                    /*$ancestorsArr = $wm->getAncestors($value['ID']);*/
                        /*if($ancestorsArr[2]=='2'){/*show only units under sheba main*/?>
                            <option value="<?php echo $value['ID']?>"><?php echo $trans->getText($value['Name'])?></option>
                        <?php /*}*/
                        ?>
                    <?php }?>
                </select>
                <div tabindex="0" onkeypress="$(this).click()" onclick="searchDoctors()" class="searchBoxButton"><?php echo $trans->getText("Search")?></div>
            </div>
            
            <!-- Letters Search -->
            <div class="lettersWrap">
                <?php 
                foreach ($arrLetters as $key => $value) {?>
                    <div tabindex="0" onkeypress="$(this).click()" onclick="searchDoctorsAlpha('<?php echo $value?>',this)" class="letterLink"><?php echo $value?></div>
                <?php }?>
                    <div tabindex="0" onkeypress="$(this).click()" onclick="searchDoctorsAll()" class="searchBoxButton"><?php echo $trans->getText("Display all")?></div>
            </div>
            <!-- END Letters Search -->
            <!--Doctors Search Items-->
            <h2 class="searchCategodyTitle"><?php /*רופאים "אביגד"*/?></h2>
            <div id="childrenWrap">
                <?php /*
                $numAllDoctors = count($arrAllDoctors);
                for($i=0;$i<$numAllDoctors;$i++){?>
                    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
                <?php }*/?>
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
<?php   
// Save the cached content to a file    
$fp = fopen($cachefile, 'w');    
fwrite($fp, ob_get_contents());    
fclose($fp);    

// Send browser output    
ob_end_flush();
}?>