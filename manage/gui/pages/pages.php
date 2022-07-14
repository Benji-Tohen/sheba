<?php require_once('common/header.php');?>
<?php $page_title="Admin";?>
<script language="javascript" type="text/javascript" src="JS/xmlHTTP.js"></script>
<script language="javascript" type="text/javascript">
function validateFields(){
	var postData="";
	for(i=0;i<document.edit.elements.length;i++){
		if(document.edit.elements[i].value){
			if(i>0){
				postData+="&";
			}
			postData+=document.edit.elements[i].name+"="+document.edit.elements[i].value;
		}
	}
	
	loadXMLPosDoc(document.edit.action, postData);
	document.location=document.location;
	return false;
}
</script>
<?php require_once('common/body.php');?>
<?php $wm_page_id=$id;?>
<div class="navigator_line"><?php require_once("navigator.php");?></div>
<div class="listPagePadding">
<?php 
require_once(dirname(__FILE__)."/pages_list.php");

require_once('new_page_form.php');
?>
</div>
