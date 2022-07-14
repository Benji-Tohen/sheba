<div class="wrapp-header-mobile">
	<!-- MEGA MENU MOBILE-->
	<?php /* if it's the preview form page don't load the mega menu*/
		if(!((isset($getParams[1]) && $getParams[1]=="1000") && $wmPage["Page_Type"]==6)){ 
			include_once('mega_menu_mobile.php');
		}
	?>
</div>



