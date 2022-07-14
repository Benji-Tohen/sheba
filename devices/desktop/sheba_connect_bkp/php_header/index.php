<!-- JQUERY -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>jquery/jquery.min.js"></script>
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>jquery/jquery-ui.min.js"></script>
<!-- END JQUERY -->

<!-- BOOTSTRAP -->
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/bootstrap/";?>css/bootstrap.<?php echo $gui->getDir();?>.min.css" rel="stylesheet" />
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/bootstrap/";?>js/bootstrap.min.js"></script>
<!-- END BOOTSTRAP -->


<!-- FONT AWESOME -->
<link href='<?php echo $cfg["WM"]["Server"]."/".$device."/lib/font-awesome/css/font-awesome.min.css";?>' rel='stylesheet' type='text/css' />
<!-- END FONT AWESOME -->

<!-- SLICK -->
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/slick/slick.min.js";?>"></script>
<!-- END SLICK -->

<!-- AJAX functions -->
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/ajax.js"></script>
<!-- AJAX functions END -->

<!-- Google Captcha -->
<?php /*
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
*/?>
<!-- Google Captcha END -->

<!-- Placeholder Jquery for IE9 -->
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/jquery_placeholder/jquery.placeholder.min.js"></script>
<!-- END Placeholder Jquery for IE9 -->


<?php 
if(file_exists($device.'/php_header/'.$wmPage["Type"]["Page"])){
	require_once($device.'/php_header/'.$wmPage["Type"]["Page"]);
}

if(preg_match('/(?i)msie [1-9]\./',$_SERVER['HTTP_USER_AGENT']))
{
    // if IE<=8
   $message = "האתר תומך באקספלורר 11 ומעלה";
	echo "<script type='text/javascript'>alert('$message');</script>";
}

?>