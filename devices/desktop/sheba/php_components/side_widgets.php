<?php


include_once($device.'/php_components/side_items.php');

if($isMesserPage==1){/*messer widgets are coming from different place*/
    $parent = $db->getRow("SELECT ID FROM wm_pages WHERE Parent = ".intval($homePageId)." AND Page_Type=76 AND Deleted=0 ORDER BY Ordering");
    $arrPageBanners=$db->getArray("SELECT * FROM wm_pages WHERE Hide_On_Menu=0 AND Parent=".$parent['ID']." AND Deleted=0 ORDER BY Ordering");
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."300"."X"."240"."/zcX1/";
}else{
   /*first check if this page has its own banners - else get parent banners - recursive*/
    $bannerPageId = $wm->getHasValueId($wmPage["ID"],"hasConnectedBanners");
    $query = "SELECT * FROM wm_connected_banners
                INNER JOIN wm_banners
                ON wm_banners.ID = wm_connected_banners.banner_id
                WHERE wm_pages=".intval($bannerPageId)." AND End_Date > NOW() AND (Banner_Type = 3 OR Banner_Type = 4) ORDER BY wm_banners.Ordering";
    $arrPageBanners = $db->getArray($query);
}

$bannerL = 0;
if(!$wmPage["hide_banners"]){
    foreach ($arrPageBanners as $key => $banner) {
        if($isMesserPage==1){
            $banner['File_Name'] = $banner['Top_Header'];
            $banner['URL'] = $banner['Link'];
            
        }
        $bannerL++;
        if ($banner['Banner_Type']==3){
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."300"."X"."240"."/zcX1/";
        }else if ($banner['Banner_Type']==4){
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."300"."X"."100"."/zcX1/";
        }
        ?>
        <div class="sideWidget">
            <?php  $bannerCustomClass = (isset($banner["custom_class"]) && $banner["custom_class"]) ? "custom_".$banner["custom_class"] : '';
            if($banner['URL']) echo '<a title="'.$banner['Name'].'" class="'.$bannerCustomClass.'" name="banner_'.$banner["Name"].'" href="'.$banner['URL'].'">'; ?>
            <img  
                src="<?php echo $thumb_call.$banner['File_Name']?>" 
                alt="<?php echo $banner['Name']?>" 
                class="img-fluid"
            />
            <div><?php echo $banner['Value']!='' ? $banner['Value']: ''?></div>
            <?php if ($banner['URL']) echo '</a>'; ?>
        </div>
<?php }  
 }?>

<div class="sideWidget" style="display: none;">
    <div id='div-gpt-ad-1435758696350-0' style='height:100px; width:300px; border:1px solid #000; float:left'>
        <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1435758696350-0'); });
        </script>
    </div>
 </div>
