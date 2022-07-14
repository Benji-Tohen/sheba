<?php 
	$homePageId = $wm->getHomePageById($wmPage["ID"]);
    $dataValueHomePage = $wm->getValues($homePageId);
    $logoHomePage = $dataValueHomePage['Top_Header2'];
    $altLogo = $dataValueHomePage['Top_Header2_Alt'] ? $dataValueHomePage['Top_Header2_Alt'] :$trans->getText("logoName");
?>
<div itemscope itemtype="http://schema.org/Organization">
	<?php
		$homeAlias="";
		if($wmPage["Lang"]!=$cfg["WM"]["Default_Language"]){
			$homeAlias="/".$wmPage["Lang"];
		}
		$homepage = (($_SERVER['HTTPS'])?"https":"http")."://$logoLinkTo";
	?>
	<a 
		href="<?php echo $homepage;?>" 
		title="<?php echo $trans->getText("logoName");?>" 
		itemprop="url"
	>
		<?php if(isset($logoHomePage) && !empty($logoHomePage)){?>
			<img 
				src="<?php echo  $cfg["WM"]["Server"];?>/<?php echo $logoHomePage;?>" 
				alt="<?php echo $altLogo;?>" 
				class="img-fluid logo-heder" 
				itemprop="logo" 
			/>
		<?php } else { ?>
			<img 
				src="<?php echo  $cfg["WM"]["Server"];?>/<?php echo $logo["File_Name"];?>" 
				alt="<?php echo $trans->getText("logoName");?>" 
				class="img-fluid logo" 
				itemprop="logo" 
			/>
		<?php }?>
	</a>
</div> 


