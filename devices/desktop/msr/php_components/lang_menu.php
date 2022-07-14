<?php foreach ($arrLanguages as $item) {
	if ($_SESSION["WM"]["Lang"] != $item['Lang']) {?>
		<a href="<?php echo $item['Alias'];?>" class="languageItem">
			<?php echo $item['Name'];?>
		</a>
		<?php 
	}
}?>
