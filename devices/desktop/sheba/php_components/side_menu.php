<script>
$(document).ready(function(){
    $('.input-group').click(function(){
        console.log($(this));
       //$(this).nextUntil('.input-group').toggle(); 
    });
});
</script>
<?php 
$isMesserPage= $wm->get($homePageId, "is_messer_page");
/*first get the array of all side menu categories and links - should be the same for all sites...*/
$domain_parent = $wm->getHomePageByDomain($_SERVER['SERVER_NAME']);
$linksCatArr = $wm->getDomainSideMenuLinks($domain_parent,$wmPage['Lang']);
//print_r($linksCatArr);
//exit;
//$linksCatArr = $wm->getSideMenuLinks(0,$wmPage['Lang']);
?>
<div class="sideMenuWrap" id="sideMenu">
    <div class="closeSideMenuWrap">
        <button class="closeSideMenu" title="<?php echo $trans->getText("Close");?>"><i class="fa fa-times"></i></button>
    </div>
    <div class="sideMenuLogo">
        <?php if($isMesserPage==0){?>
            <img src="<?php echo $cfg["WM"]["Server"];?>/<?php echo $logo["File_Name"];?>" alt="<?php echo $trans->getText("logoName");?>" title="<?php echo $trans->getText("logoName");?>" class="img-fluid" />
        <?php } else {?>
            <?php if($wmPage["Lang"]=="he"){?>
                <img src="<?php echo $cfg["WM"]["Server"];?>/webfiles/languages/1/MESER.png" alt="<?php echo $trans->getText("logoName");?>" title="<?php echo $trans->getText("logoName");?>" class="img-fluid" />
            <?php } else {?>
                <img src="<?php echo $cfg["WM"]["Server"];?>/webfiles/languages/1/MESEREN.png" alt="<?php echo $trans->getText("logoName");?>" title="<?php echo $trans->getText("logoName");?>" class="img-fluid" />
            <?php }?>
        <?php }?>
    </div>
    
    <?php 
    foreach ($linksCatArr as $key => $cat) {
        $subCatArr = $wm->getSideMenuLinks($cat['ID']);
        ?>
        <!-- MENU PARENT -->
        <a href="<?php echo count($subCatArr) == 0 ? $cat['URL']: $cat['URL']?>" target="<?php echo $cat['Open_In']?>" title="<?php echo $cat['Name']?>" class="input-group">
            <span class="input-group-addon" style="<?php echo ($cat['File_Name'] != '' ? 'padding: 0px;':'')?>" id="basic-addon<?=$cat['ID']?>">
                <?php 
                if($cat['File_Name'] == ''){?>
                    <i class="fa fa-map-marker"></i>
                <?php }else{
                    $unique_thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/60X60/zcX1/";?>
                    <img src="<?php echo $unique_thumb_call.$cat['File_Name'];?>" alt="<?php echo $cat['Name']?>" title="<?php echo $cat['Name']?>" />
                <?php }?>
            </span>
            <div class="form-control" aria-describedby="basic-addon<?=$cat['ID']?>">
                <?php echo $cat['Name']?>
            </div>
        </a>
         <!-- MENU PARENT -->
         <?php 
             foreach ($subCatArr as $key => $subCat) {?>
                <!-- MENU CHILD -->
                <a style="display: none;" href="<?php echo ($subCat['URL'] == '' ? 'javascript:void(0)': $subCat['URL'])?>" target="<?php echo ($subCat['Open_In'])?$subCat['Open_In']:"_self";?>" title="<?php echo $subCat['Name']?>" class="sideMenuChild"><?php echo $subCat['Name']?></a>
                <!-- MENU CHILD -->
             <?php }
         
            }?>
</div>
