<?php 
$useFacebook=false;
if($wmPage["facebook_comments"]){
	echo "<br /><div class=\"fb-comments\" data-href=\"".urlencode($cfg["WM"]["Server"]."/".($wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"]))."\" data-num-posts=\"2\" data-width=\"500\"></div>";
	$useFacebook=true;
}elseif($wmPage["facebook_like"]){
	echo "<br /><div class=\"fb-like\" data-href=\"".urlencode($cfg["WM"]["Server"]."/".($wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"]))."\" data-send=\"true\" data-width=\"450\" data-show-faces=\"true\"></div>";
	$useFacebook=true;
}
?>



<?php if($wmPage["Comments"]!="no"){?>
	<div class="commentsTitle">
		<div class="commentsTitleRight"><?php echo $trans->getText("Comments");?></div>
		<div class="commentsTitleLeft"><?php //echo $trans->getText("Add Comment");?></div>
	</div>
	<div id="ajaxComments" class="ajaxComments"></div>
	<div id="ajaxCommentForm"></div>
	<script type="text/javascript" language="javascript">
		setTimeout("callAjaxComments()", 1000);
		setTimeout("callAjaxForm()", 1500);
		function callAjaxForm(){
			questAjax('<?php echo $cfg["WM"]["Server"];?>/site/php_components/ajax_comment_form.php', 'id=<?php echo $id;?>', 'ajaxCommentForm');
		}
	</script>
<?php }?>
<div class="clear"></div>
