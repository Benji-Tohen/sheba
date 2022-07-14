<script>

</script>
<div id="appointmentsWrapper" class="w-100" style="display:none;">
	<div class="model-dialog" role="document">
		<div class="modl-body">
			<?php
			$appointmentsPageID = $trans->getText('appointmentsPageID');
			$arrAppointments = $wm->getAllChildren($appointmentsPageID, 'Ordering');
			$valAppointments = $wm->getValues($appointmentsPageID);
			?>
			<div id="appointmentsMenuTitle" class="container appointmentsMenuTitle">
				<?php echo nl2br($valAppointments["h1"]); ?>
			</div>
			<div class="appointmentsMenuClose" onClick="$('#appointmentsWrapper').fadeOut('fast');">
				<i class="fas fa-times-circle"></i>
			</div>
			<div class="d-flex container appointmentsMenu">
				<?php
				foreach ($arrAppointments as $item) {
					$link=$wm->getLink($item);
					if($item['Conversion']!=''){
						$linkHTML = "onclick='".$item['Conversion']."; return false;'"; 
						$isConversion = 1;// Item with JS redirect
					}else{
						$linkHTML = "href='".$link["Link"]."'"; // Item with link
					}
					//$item = $wm->getValues($item);
					?>
					<a <?php echo $linkHTML;?> target="<?php echo $link["Target"];?>" title="<?php echo $item["Name"];?>" class="appoitmentsItem">
					<img src="<?php echo $cfg["WM"]["Server"]."/".$item["Top_Header"];?>" alt="<?php echo $item["Top_Header_Alt"] ? $item["Top_Header_Alt"] : $item["Name"];?>" title="<?php echo $item["Name"];?>" class="img-fluid appoitmentsItemImage" />
						<div class="">
							<h2 class="appoitmentsItemTitle"><?php echo $item["h1"]; ?></h2>
							<h4 class="appoitmentsItemText">
								<?php echo nl2br($item["Content_Center"]); ?>
							</h4>
						</div>
					</a>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="overlayScreen"></div>

</div>