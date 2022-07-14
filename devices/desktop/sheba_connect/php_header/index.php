<!-- jQuery v3.5.1 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>jquery/jquery.min.js"></script>

<!--  JQuery-UI-1.12.1 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>jquery-ui/jquery-ui.min.js"></script>
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" />

<!-- Bootstrap-4.5.3 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>bootstrap/js/bootstrap.min.js"></script> 

<!-- Bootstrap-4.5.2 RTL from: https://github.com/MahdiMajidzadeh/bootstrap-v4-rtl -->
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>bootstrap-v4-rtl/css/bootstrap-rtl.min.css" rel="stylesheet" />

<!-- fontawesome-free-5.15.1-web -->
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>fontawesome/css/fontawesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>fontawesome/css/brands.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>fontawesome/css/solid.min.css" rel="stylesheet" type="text/css" />

<!-- Slick-1.8.1 -->
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>slick/slick/slick.css" rel="stylesheet" />
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>slick/slick/slick.min.js"></script> 

<!-- Blueimp 3.3.0 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>blueimp/js/jquery.blueimp-gallery.min.js"></script>
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/lib/";?>blueimp/css/blueimp-gallery.min.css" rel="stylesheet" />

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