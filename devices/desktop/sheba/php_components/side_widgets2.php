<?php
/*first check if this page has its own banners - else get parent banners - recursive*/
$bannerPageId = $wm->getHasValueId($wmPage["ID"],"hasConnectedBanners");
$query = "SELECT * FROM wm_connected_banners
                                 INNER JOIN wm_banners
                                 ON wm_banners.ID = wm_connected_banners.banner_id
                                 WHERE wm_pages=".intval($bannerPageId)." AND End_Date > NOW() AND (Banner_Type = 3 OR Banner_Type = 4) ORDER BY wm_banners.Ordering";
//echo $query;
$arrPageBanners = $db->getArray($query);

if(($wmPage['Type']['ID'] == 98 || $wmPage['Type']['ID'] == 105 || ($wmPage['Type']['ID'] == 5 && $wmPage['Show_Event_Calendar'] == 1)) && $wmPage["Lang"]!='en'){/*in specific pages events calendar is displayed */
    require_once ('getMonthlyCalendar.php');
    /*?>
    <div class="sideWidget">
        <div class="calendar">
            <div class="header"><?php echo $trans->getText("Calendar");?></div>
            <div class="datePicker" gldp-el="mydate"></div>
        </div>
    </div>
    <?php */
}
$bannerL = 0;
foreach ($arrPageBanners as $key => $banner) {
    $bannerL++;
    if ($banner['Banner_Type']==2){
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."300"."X"."240"."/zcX1/";
    }else if ($banner['Banner_Type']==3){
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."300"."X"."100"."/zcX1/";
    }
    ?>
    <div class="sideWidget">
	<?php if ($banner['URL']) echo '<a title="'.$banner['Name'].'" name="banner'.$bannerL.'" href="'.$banner['URL'].'">'; ?>
        <img src="<?php echo $thumb_call.$banner['File_Name']?>" alt="<?php echo $banner['Name']?>" title="<?php echo $banner['Name']?>" />
        <div><?php echo $banner['Value']!='' ? $banner['Value']: ''?></div>
	<?php if ($banner['URL']) echo '</a>'; ?>
    </div>
<?php } ?>

<div class="sideWidget" style="display: none;">
	<!-- /42446970/sheba-1 -->
	<div id='div-gpt-ad-1435758696350-0' style='height:100px; width:300px; border:1px solid #000; float:left'>
	<script type='text/javascript'>
	googletag.cmd.push(function() { googletag.display('div-gpt-ad-1435758696350-0'); });
	</script>
	</div>
    </div>
