<?php
	//$logoImg = $cfg["WM"]["Server"]."/webfiles/yashir_logos/logo.png";
	$logoImg = $db->getRow("SELECT Top_Header FROM wm_pages WHERE ID = ".intval($homePageId));
	$logoImg = $logoImg['Top_Header'];
?>

<div class="topHeader">
	<div class="mobileHeader hidden-sm hidden-md hidden-lg">
		<a href="<?php echo $cfg["WM"]["Server"] . $homeAlias; ?>" title="<?php echo $trans->getText("logoName"); ?>"  class="mobileLogo">
		    <img src="<?php echo $cfg["WM"]["Server"].'/'.$logoImg ?>" alt="<?php echo $trans->getText("logoName"); ?>" title="<?php echo $trans->getText("logoName"); ?>" class="img-responsive" />
		</a>
		<button title="<?php echo $trans->getText('Toggle Menu');?>" class="toggleBtn" onclick="toggleMenu()"><i class="fa fa-bars" aria-hidden="true"></i></button>
		<div class="mobileTopMenuWrap">
			<?php include('top_menu.php');?>
		</div>
	</div>

	<div class="container hidden-xs">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div itemscope itemtype="http://schema.org/Organization">
				    <?php
					    $homeAlias = "";
					    if ($wmPage["Lang"] != $cfg["WM"]["Default_Language"]) {
					        $homeAlias = "/" . $wmPage["Lang"];
					    }
				    ?>
				    <a accesskey="1" href="<?php echo $cfg["WM"]["Server"] . $homeAlias; ?>" title="<?php echo $trans->getText("logoName"); ?>" itemprop="url" class="logo">

								<img src="<?php echo $cfg["WM"]["Server"].'/'.$logoImg ?>" alt="<?php echo $trans->getText("logoName"); ?>" title="<?php echo $trans->getText("logoName"); ?>" class="img-responsive" itemprop="logo" />
				    </a>
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="headerFirstRow">
					<a href="https://yashir.sheba.co.il" target="_blank" class="defaultBtn ts loginBtnLink"><?php echo $trans->getText('Click here to enter');?></a>
					<?php include('search.php');?>
					<div class="clear"></div>
				</div>

				<div class="headerSecondRow">
					<?php include('top_menu.php');?>
				</div>
			</div>
		</div>
	</div>
</div>
