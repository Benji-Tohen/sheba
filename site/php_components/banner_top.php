<?php
$query="SELECT * 
	FROM wm_banners 
	WHERE Banner_Type=1 
	ORDER BY RAND() 
	LIMIT 0,1";
$rowBanner=$db->getRow($query);
?>
<div style="margin-top: 20px;">
	<a href="<?php echo $rowBanner["URL"];?>"><img src="<?php echo $cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=1000&amp;h=112&amp;src=../../".$rowBanner["File_Name"];?>" alt="<?php echo $rowBanner["Name"];?>" border="0" /></a>
</div>

