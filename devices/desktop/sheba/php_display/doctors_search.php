<?php include($_SERVER["DOCUMENT_ROOT"]."/devices/desktop/sheba/php_components/combo_box.php");?>
<?php 
$currentMedDomain=0;
if(isset($getParams[1])){
	$currentMedDomain=$getParams[1];
}

// Define path and name of cached file    
$cachefile = $_SERVER['DOCUMENT_ROOT'].'/webfiles/html/docs/docsCache.html';    

// How long to keep cache file?   
/*if(isset($_SESSION['User_Data']['ID']) && $_SESSION['User_Data']['ID']!=''){/*we are in admin - disable cache*/
if(true){
    $cachetime = 1;
}else{
    $cachetime = 86400;
}  

// Is cache file still fresh? If so, serve it.    

if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {    
include($cachefile);
   
}else{   
 
// if no file or too old, render and capture HTML page.
ob_start();?>
<div class="container doctorSearchPage">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["h1"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            
            <div class="searchRow">
                <input type="hidden" id="search_only_specialist_doctors" name="search_only_specialist_doctors" value="<?php echo $_POST['search_only_specialist_doctors'] > 0 ? 1:0 ?>">
                <input class="searchBox" id="searchByName" type="text" value="<?php echo ($_POST['docName']!='')?$_POST['docName']:"";?>" placeholder="<?php echo $trans->getText("Type doctor's name")?>" />
                <select id="searchByMedDomain" class="searchBox comboSelect">
                    <option value=""><?php echo $trans->getText("Health field")?></option>
                    <?php 
                    foreach ($arrExpertise as $value) {
                        if(!$value[$doctorExpertiseInLang]){
                            continue;
                        }
                    ?>
                        <option value="<?php echo $value['ID']?>" <?php echo ($value['ID']==intval($_POST['medicalDomain']))?"selected":"";?> <?php echo ($value['ID']==$currentMedDomain)?"selected":"";?>><?php echo $string->shorten($trans->getText($value[$doctorExpertiseInLang]), 50);?></option>
                    <?php }?>
                </select>
                <select id="searchByUnit" class="searchBox comboSelect">
                    <option value=""><?php echo $trans->getText("Unit")?></option>
                    <?php
                    foreach ($arrUnitsNew as $value) {
                        if(!$value['Name']){
                            continue;
                        }?>
                            <option value="<?php echo $value['ID']?>" <?php echo ($value['ID']==intval($_POST['medicalUnit']))?"selected":"";?>><?php echo $trans->getText($value['Name'])?></option>
                    <?php }?>
                </select>
                <div tabindex="0" onkeypress="$(this).click()" onclick="searchDoctors()" class="searchBoxButton" id="searchKeywordBtn"><?php echo $trans->getText("Search")?></div>
            </div>
            
            <!-- Letters Search -->
            <div class="lettersWrap">
                <?php 
                foreach ($arrLetters as $key => $value) {?>
                    <div tabindex="0" onkeypress="$(this).click()" onclick="searchDoctorsAlpha('<?php echo $value?>',this)" class="letterLink"><?php echo $value?></div>
                <?php }?>
                    <div tabindex="0" onkeypress="$(this).click()" onclick="searchDoctorsAll()" class="searchBoxButton" id="searchLetterBtn"><?php echo $trans->getText("Display all")?></div>
            </div>
            <!-- END Letters Search -->
            <!--Doctors Search Items-->
            <h2 class="searchCategodyTitle"><?php /*רופאים "אביגד"*/?></h2>
            <div id="childrenWrap">
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
<script>
    $(document).ready(function(){
        $('.comboSelect').combobox();
    });
</script>
<?php   


// Save the cached content to a file    
$fp = fopen($cachefile, 'w');    
fwrite($fp, ob_get_contents());    
fclose($fp);    

// Send browser output    
ob_end_flush();
}?>
