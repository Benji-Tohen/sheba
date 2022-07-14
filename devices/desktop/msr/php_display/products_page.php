<?php require_once(dirname(__FILE__)."/../php_components/news_text.php");?>
<div class="servicesPageAll">
	<?php for($i=0;$i<count($arr);$i+=3){?>
		<?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
	<?php }?>
    	<?php require_once(dirname(__FILE__)."/../php_components/more.php");?>
</div>
