
<?php /* CLUB BUTTON */ ?>
<?php 
	$arr_dynamic_button = $wm->getDynamicFieldsByPageType($wmPage['ID'],$wmPage['Type']['ID'],1);
	$club_btn_text = $params->dynamicValue($arr_dynamic_button,'connect_home_btn_text');
	$club_btn_link = $params->dynamicValue($arr_dynamic_button,'connect_home_btn_link');
	$club_btn_link_open_in_new_tab = $params->dynamicValue($arr_dynamic_button,'connect_home_btn_link_open_in_new_tab');

	if($club_btn_link["Value"] !== ""){ ?>
		<a class="club-btn-link" href="<?php echo $club_btn_link['Value']; ?>" target="<?php echo (intval($club_btn_link_open_in_new_tab['Value']) > 0 ) ? '_blank' : '_self'; ?>" title="<?php echo $club_btn_text['Value']; ?>"><?php echo $club_btn_text['Value'] ;?></a>
	<?php } ?>

<header>
	<?php include('php_components/header.php');?>
</header>

<main>
    <?php if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".$device.'/php_display/'.$wmPage["Type"]["Page"])){ require_once('php_display/'.$wmPage["Type"]["Page"]); }?>
</main>


<footer>
	<?php include('php_components/footer.php');?>
</footer>

<?php if($wmPage["schema_markup"]){
    echo $wmPage["schema_markup"];
}?>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<?php if(!$login->isManager()){ ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ca20267675ef5f7"></script>
<?php } ?>
