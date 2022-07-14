<!-- MORE BUTTON -->
<div id="moreNews"></div>
<?php if($totalItems>intval($numItems)){?>
<div onkeypress="$(this).click()" tabindex="0" class="showMoreButton moreButtonDesk" id="moreButton_<?php echo $_SESSION["WM"]["Lang"];?>" title="<?php echo $trans->getText("Show More");?>"><?php echo $trans->getText("Show More");?></div>
<?php }?>
