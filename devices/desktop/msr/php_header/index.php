<?php 

$arrCarousel=$wm->getHomePageContent($_SESSION["WM"]["Lang"]);

//$carousel_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&w=180&h=165&src=";

$carousel_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."180"."X"."165"."/zcX1/";

?>

<!--<meta http-equiv="X-UA-Compatible" content="IE=edge" />-->









<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>css/bootstrap.<?php echo $gui->getDir();?>.min.css" rel="stylesheet" />

<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>js/jquery.min.js"></script>

<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>js/jquery-ui.min.js"></script>

<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>css/jquery-ui.min.css" rel="stylesheet" />

<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>css/jquery-ui.theme.css" rel="stylesheet" />


<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>js/bootstrap.min.js"></script> 

<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>js/jquery.blueimp-gallery.min.js"></script>

<link href='<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/font-awesome/css/font-awesome.min.css";?>' rel='stylesheet' type='text/css' />

<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>css/blueimp-gallery.<?php echo $gui->getDir();?>.min.css" rel="stylesheet" />

<!-- CarouFredsel -->

<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>caroufredsel/jquery.carouFredSel.<?php echo $gui->getDir();?>.js"></script>




<!-- SlickSlider -->


<?php /* <link href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>slick/slick.css" rel="stylesheet" />*/?>
<?php /* <link href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>slick/slick-theme.css" rel="stylesheet" />*/?>


<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>js/jquery-migrate-1.2.1.min.js"></script> 
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>slick/slick.min.js"></script> 


<!-- Transformicons -->

<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>transformicons/js/transformicons.js"></script>





<!-- Home Page Responsive Gallery -->

<link rel="stylesheet" type="text/css" href="<?php echo $cfg["WM"]["Server"];?>/site/js/slick-master/slick/slick.css"/>

<?php /* <script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/slick-master/js/jquery-migrate-1.2.1.min.js"></script> */ ?>
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/slick-master/js/jquery-migrate-1.2.2.js"></script>

<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/slick-master/slick/slick.js"></script>

<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/jquery.mousewheel.min.js"></script>

<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/jquery.touchSwipe.min.js"></script>

<!-- end -->

<!-- datepicker -->

<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/jquery.ui.datepicker-he.js"></script>

<!-- datepicker END -->



<!-- AJAX functions -->

<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/ajax.js"></script>

<!-- AJAX functions END -->

<!-- Google Captcha -->

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- Google Captcha END -->


<!-- Placeholder Jquery for IE9 -->
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/jquery_placeholder/jquery.placeholder.min.js"></script>
<!-- END Placeholder Jquery for IE9 -->

<!-- iCheck -->
<link rel="stylesheet" property="stylesheet" href="<?php echo $cfg["WM"]["Server"]."/".$device;?>/bootstrap/icheck/css/skins/flat/green.css" />
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"]."/".$device;?>/bootstrap/icheck/js/icheck.min.js"></script>
<!-- END iCheck -->

<!-- Google DFP Code -->
<script type='text/javascript'>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
  (function() {
    var gads = document.createElement('script');
    gads.async = true;
    gads.type = 'text/javascript';
    var useSSL = 'https:' == document.location.protocol;
    gads.src = (useSSL ? 'https:' : 'http:') +
      '//www.googletagservices.com/tag/js/gpt.js';
    var node = document.getElementsByTagName('script')[0];
    node.parentNode.insertBefore(gads, node);
  })();
</script>

<script type='text/javascript'>
  googletag.cmd.push(function() {
    googletag.defineSlot('/42446970/sheba-1', [300, 100], 'div-gpt-ad-1435758696350-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
<!-- Google DFP END -->

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
<meta name="google-site-verification" content="LPbrUPPBlW2mFV3g4xSjCADv6cdVypZrAGnDUOFo3-o" />



