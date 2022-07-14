<?php 
$statement_id = $trans->getText("accessibility_statement");//($wmPage["Lang"]=="he")?58127:58127;           // <-- replace with page ID of accesibility statement
$character = $trans->getText("A");
?>
<a href="#" title="<?php echo $trans->getText("Accessibility")?>" id="toggleBNagish_new">
	<span><?php echo $trans->getText("Accessibility")?></span>
	<i id="angle" class="fa fa-angle-down"></i>
</a>
<div style="clear:both"></div>
<div id="BNagishMenu_new">
	<br>
	<div class="d-flex flex-row justify-content-around">
		<a class="toggleBNagishSize" href="javascript:void(0)"  onclick="increaseFontSize()" title="<?php echo $trans->getText("Increase")?>"><?php echo $character?>+</a>
		<a class="toggleBNagishSize" href="javascript:void(0)" onclick="resetFontSize()" title="<?php echo $trans->getText("Reset font size")?>"><?php echo $character?></a>
		<a class="toggleBNagishSize" href="javascript:void(0)"  id="pluse" onclick="decreaseFontSize()" title="<?php echo $trans->getText("Decrease")?>"><?php echo $character?>-</a>
	</div>
	<br>
	<strong><?php echo $trans->getText("Information")?></strong>

	<a href="/<?php echo $statement_id?>" title="<?php echo $trans->getText("Accessibility Statement")?>"><?php echo $trans->getText("Accessibility Statement")?></a>
	<br>
	<strong><?php echo $trans->getText("Site Colors Display")?></strong>
	<span>(* <?php echo $trans->getText("Works in modern browsers like Chrome & Firefox")?>)</span>
	<a href="#" class="webColors" id="BNagish_new_DefaultColors" title="<?php echo $trans->getText("Normal Display")?>"><?php echo $trans->getText("Normal Display")?></a>
	<a href="#" class="webColors" id="BNagish_new_Grayscale" title="<?php echo $trans->getText("Turns site to black & white")?>"><?php echo $trans->getText("Adjusted for color blinded")?></a>
	<a href="#" class="webColors" id="BNagish_new_Inverted" title="<?php echo $trans->getText("Inverts site colors for maximum negativity.  Fit for hard vision")?>"><?php echo $trans->getText("Adjusted for hard vision")?></a>
	<a href="#" id="BNagish_new_Close" style="border-radius:0px 0px 7px 7px;color:#f6f6f6;font-size:16px;padding:10px;font-weight:bold;text-align:center" title="<?php echo $trans->getText("Close")?>"><?php echo $trans->getText("Close")?></a>
</div>
