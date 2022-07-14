<?php foreach($arrLanguages as $item) {
	if($_SESSION["WM"]["Lang"] != $item['Lang']) {?>
		<a 
			class="languageItem"
			href="<?php echo $item['Alias'];?>" 
			title="<?php echo $item['Name'];?>" 
		>
			<?php echo $item['Name'];?>
		</a>
	<?php }
}?>
