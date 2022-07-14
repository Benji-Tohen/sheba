<?php
//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?far=1&amp;w=100&amp;h=100&amp;src=";
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/farX1/";
?>
<div class="cartPageText">
<?php require_once(dirname(__FILE__)."/../php_components/news_text.php");?>
</div>
<div class="buyNowArea">
	<div class="sumInfo">
		<select name="shipmentMethod" class="shipmentMethod">
			<?php foreach($shipmentMethods as $option){?>
				<option value="<?php echo $option["ID"];?>" <?php echo $shipmentMethod==$option["ID"]?"selected":"";?>><?php echo $option["Name"];?></option>
			<?php }?>
		</select>		

		<div class="subtotalInfo"><?php echo $trans->getText("Subtotal");?> <div class="subTotalNumberInfo"><div class="subTotalNumberNumber"><?php echo number_format($orderSum, 2);?></div> <?php echo $trans->getText("currencySign");?></div></div>
	</div>
	<div class="buyNowButton"><?php echo $trans->getText("Buy Now");?></div>
	<?php if($params->getValue("paypal_enable")){
		echo "<br />";
		//echo $params->getValue("paypal_buy_now_button");
		require_once(dirname(__FILE__)."/../php_components/paypal_button.php");
	}?>
	<?php if($params->getValue("phone_order")){
		$link=$wm->getLinkByPageType(75, $wmPage["Lang"]);
?>

		<div class="buyNowButton" id="phoneOrder"><a href="<?php echo $link["Link"];?>"><?php echo $trans->getText("Phone Order");?></a></div>
	<?php }?>
</div>
<div class="clear"></div>
<?php if($orderItems){?>
	<div class="cartItemTitles">
		<div class="cartItemNameTitle cartItemTitle"><?php echo $trans->getText("Items to buy");?></div>
		<div class="cartItemQuantity cartItemTitle"><?php echo $trans->getText("Quantity");?></div>
		<div class="cartItemPrice cartItemTitle"><?php echo $trans->getText("PriceTitle");?></div>
		<div class="clear"></div>
	</div>

	<?php foreach($orderItems as $orderItem){
		$itemDetails=$wm->getValues($orderItem["wm_pages"]);
		if(!$itemDetails["Top_Header2"]){
			$itemDetails["Top_Header2"]=$itemDetails["Top_Header"];
		}
	?>
	<div class="cartItem">
		<div class="classCartItemInner">
			<img src="<?php echo $thumb_call."/".$itemDetails["Top_Header2"];?>" alt="<?php echo $orderItem["Name"];?>" title="<?php echo $orderItem["Name"];?>" class="cartItemImage" />
			<div class="cartItemName">
				<?php echo $orderItem["Name"];?>
				<div class="cartItemSubtitle"><?php echo nl2br($itemDetails["Sub_Title"]);?></div>
				<div class="cartItemOptions">
					<div class="cartItemDelete" id="id_<?php echo $orderItem["ID"];?>"><?php echo $trans->getText("Delete");?></div>
					<div class="clear"></div>
				</div>
			</div>
			
			<div class="cartItemQuantity">
				<input type="text" name="quantity" value="<?php echo $orderItem["quantity"];?>" />
				<div class="updateItemQuantityButton" id="id_<?php echo $orderItem["ID"];?>"><?php echo $trans->getText("Update");?></div>
			</div>
			
			
			<div class="cartItemPrice"><?php echo number_format($orderItem["price"], 2);?> <?php echo $trans->getText("currencySign");?></div>
			<div class="clear"></div>
		</div>
	</div>
	<?php }?>
	<div class="subtotal"><?php echo $trans->getText("Subtotal");?> <div class="subTotalNumber"><div class="subTotalNumberNumber"><?php echo number_format($orderSum, 2);?></div> <?php echo $trans->getText("currencySign");?></div></div>
<?php }else{?>
	<div class="cartNoItemsText"><?php echo $trans->getText("You have no items in your cart");?></div>
<?php }?>
