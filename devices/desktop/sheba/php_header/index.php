<?php 
  $arrCarousel=$wm->getHomePageContent($_SESSION["WM"]["Lang"]);
  $carousel_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."180"."X"."165"."/zcX1/";
?>


<?php 
/*  
    menu dasent hidden because don't download file rtl
    <link href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>css/bootstrap.<?php echo $gui->getDir();?>.min.css" rel="stylesheet" />
    <script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>js/jquery.min.js"></script>
*/ ?>


<!-- jQuery v3.5.1 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/jquery/";?>jquery.min.js"></script>

<!--  JQuery-UI-1.12.1 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/jquery-ui/";?>jquery-ui.min.js"></script>
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/jquery-ui/";?>jquery-ui.min.css" rel="stylesheet" />
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/jquery-ui/";?>jquery-ui.theme.min.css" rel="stylesheet" />


<!-- Bootstrap-4.5.3 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/bootstrap/";?>js/bootstrap.min.js"></script> 

<!-- Bootstrap-4.5.2 RTL from: https://github.com/MahdiMajidzadeh/bootstrap-v4-rtl -->
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/bootstrap-v4-rtl/";?>css/bootstrap-rtl.min.css" rel="stylesheet" />

<!-- fontawesome-free-5.15.1-web -->
<link href='<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/fontawesome/css/fontawesome.min.css";?>' rel='stylesheet' type='text/css' />
<link href='<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/fontawesome/css/brands.min.css";?>' rel='stylesheet' type='text/css' />
<link href='<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/fontawesome/css/solid.min.css";?>' rel='stylesheet' type='text/css' />

<!-- Slick-1.8.1 -->
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/slick/";?>slick/slick.css" rel="stylesheet" />
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/slick/";?>slick/slick.min.js"></script> 

<!-- Blueimp 3.3.0 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/blueimp/";?>js/jquery.blueimp-gallery.min.js"></script>
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/blueimp/";?>css/blueimp-gallery.min.css" rel="stylesheet" />



<?php /* maria
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>js/jquery.blueimp-gallery.min.js"></script>
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>css/blueimp-gallery.<?php echo $gui->getDir();?>.min.css" rel="stylesheet" />
*/?>

<!-- CarouFredsel -->
<?php /* maria
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>caroufredsel/jquery.carouFredSel.<?php echo $gui->getDir();?>.js"></script>


 
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>slick/slick.min.js"></script> 
*/?>




<!-- Transformicons -->

<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>transformicons/js/transformicons.js"></script>

<!-- iCheck -->
<link rel="stylesheet" href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/icheck/css/skins/flat/green.css";?>" type="text/css" property="stylesheet" />
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/icheck/js/icheck.min.js";?>"></script>
<!-- END iCheck -->



<!-- Home Page Responsive Gallery -->
<?php /*
<link rel="stylesheet" type="text/css" href="<?php echo $cfg["WM"]["Server"];?>/site/js/slick-master/slick/slick.css"/>
*/ ?>

<?php /*
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/slick-master/js/jquery-migrate-1.2.2.js"></script>
*/ ?>

<?php /*
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/slick-master/slick/slick.js"></script>
*/ ?>

<?php /*
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/jquery.mousewheel.min.js"></script>

<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/jquery.touchSwipe.min.js"></script>
*/ ?>
<!-- end -->


<!-- datepicker -->

<script type="text/javascript" defer src="<?php echo $cfg["WM"]["Server"];?>/site/js/jquery.ui.datepicker-he.js"></script>

<!-- datepicker END -->



<!-- AJAX functions -->
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/site/js/ajax.js"></script>

<!-- Google Captcha -->
<script src="https://www.google.com/recaptcha/api.js?hl=iw" async defer></script>



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

if(file_exists($device.'/php_header/'.$wmPage["Type"]["Page"]))
{
    require_once($device.'/php_header/'.$wmPage["Type"]["Page"]);
}

/* if(preg_match('/(?i)msie [1-9]\./',$_SERVER['HTTP_USER_AGENT']))
{
    // if IE<=8
   $message = "האתר תומך באקספלורר11 ומעלה";
	echo "<script type='text/javascript'>alert('$message');</script>";
} */

?>



