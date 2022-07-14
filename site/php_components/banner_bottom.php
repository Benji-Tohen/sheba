<?php
$query="SELECT * 
	FROM wm_banners 
	WHERE Banner_Type=4 
	ORDER BY RAND() 
	LIMIT 0,1";
$rowBanner=$db->getRow($query);
?>
<a href="<?php echo $rowBanner["URL"];?>"><img src="<?php echo $cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=1000&amp;h=262&amp;src=../../".$rowBanner["File_Name"];?>" alt="<?php echo $rowBanner["Name"];?>" border="0" style="margin-top: 50px;" /></a>
