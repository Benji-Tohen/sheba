<?php
$query="SELECT * 
	FROM wm_banners 
	WHERE Banner_Type=2 
	ORDER BY RAND() 
	LIMIT 0,1";
$rowBanner=$db->getRow($query);
?>
<a href="<?php echo $rowBanner["URL"];?>"><img src="<?php echo $cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=310&amp;h=593&amp;src=../../".$rowBanner["File_Name"];?>" alt="<?php echo $rowBanner["Name"];?>" border="0" /></a>
