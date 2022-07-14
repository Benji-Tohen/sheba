<header>
	<?php include('php_components/header.php');?>
</header>

<main>
    <?php if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".$device.'/php_display/'.$wmPage["Type"]["Page"])){ require_once('php_display/'.$wmPage["Type"]["Page"]); }?>
</main>

<footer>
	<?php include('php_components/footer.php');?>
</footer>