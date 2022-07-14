<?php 
if(!$_SESSION["facebookappid"]){
	$facebookappid=$params->getValue("facebook_app_id");
	$_SESSION["facebookappid"]=$facebookappid;
}
$facebookappid=$_SESSION["facebookappid"];

if($useFacebook && $facebookappid){?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $facebookappid;?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php }?>



<?php if(true || !$_SESSION["fuid"]){?>
<script type="text/javascript">
  window.fbAsyncInit = function() {
      // Additional initialization code here
      FB.Event.subscribe('auth.authResponseChange', function(response) {
	$.ajax({
		url: "<?php echo $cfg["WM"]["Server"];?>/ajax/facebook_connect/?fuid="+response.authResponse.userID,
		success: function(data){
			$('.loginForm').fadeOut();
		}
	});
      });
  };
</script>
<?php }?>
