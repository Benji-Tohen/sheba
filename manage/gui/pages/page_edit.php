<?php
if($id==1){
	echo "Error, Please contact the administrator";
	exit;
}

if($row["wm_landing_pages_customers"]){
	$query="
		SELECT folder FROM wm_landing_pages_customers WHERE ID=".intval($row["wm_landing_pages_customers"])."
	";
	$customerFolder=$db->getField($query, "folder");
	$_SESSION["customerFolder"]=$customerFolder;
}

if(isset($_GET["error"]) && $_GET["error"]){
	$saveErrorMsg = base64_decode($_GET["error"]);
}

?>
<?php require_once('common/header.php');?> 
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<!--
<script type="text/javascript" src="JS/calendar/js/datepicker/datepicker.js"></script>
<script type="text/javascript" src="JS/calendar/js/datepicker/lang/he.js"></script> 
<link type="text/css" href="JS/calendar/css/datepicker.css" rel="stylesheet" />
-->
<script language="javascript" type="text/javascript" src="JS/xmlHTTP.js"></script>
<script language="javascript" type="text/javascript" src="JS/tabber.js"></script>
<link href="design/tabber.css" type="text/css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="pages/ajax_search_parent.js"></script>
<script language="JavaScript" type="text/javascript" src="JS/ajax.js"></script>

<!--	imageareaselect	-->
<script src="ckeditor/ckeditor.js"></script>

<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="JS/imageareaselect/css/imgareaselect-default.css" />
<script type="text/javascript" src="JS/imageareaselect/scripts/jquery.imgareaselect.pack.js"></script>
<!--[if IE 7]>
  <link rel="stylesheet" type="text/css" href="JS/imageareaselect/css/ie7_hacks.css" />
  <![endif]-->

  <!--[if IE 8]>
  <link rel="stylesheet" type="text/css" href="JS/imageareaselect/css/ie6_hacks.css" />
  <![endif]-->

<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery-ui-1.8.23.custom.min.js"></script>
<?php if ($gui->getDir()=="rtl"){?>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery.ui.datepicker-he.js"></script>
<?php }?>
<link type="text/css" href="JS/jquery-ui/css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />

<link href="JS/select2/select2.css" rel="stylesheet" />
<script src="JS/select2/select2.js"></script>

<style type="text/css">
.keyWordsWrapper{
	position: relative;
}

#keyWordsSuggest{
	position: absolute;
	display: none;
	border: 1px solid #c0c0c0;
	border-bottom: none;
	background-color: #ffffff;
	width: 200px;
	max-height: 100px;
	overflow: auto;
}

.suggestItem{
	cursor: pointer;
	padding: 2px;
	border-bottom: 1px solid #c0c0c0;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
	$(".select2").select2();
	$('#keyWords').keyup(function(){
		var val=$('#keyWords').val();
		var arr=val.split(',');
		var lastValue=arr[arr.length-1];
	
		if(lastValue!=''){
			//console.log(lastValue);

			$.ajax({
			  url: '<?php echo $cfg["WM"]["Server"];?>/manage/interface/tree_operations/ajax_suggest_keyword.php?q='+lastValue,
			  success: function(data) {
			    $('#keyWordsSuggest').html(data);
			    $('#keyWordsSuggest').fadeIn();
			    //console.log(data);
			  }
			});

		}
	});

	$('.suggestItem').live('click', function(){
		var oldVal=$('#keyWords').val();
		var place=oldVal.lastIndexOf(",");
		oldVal=oldVal.substr(0, place);
		var newVal;
		if(oldVal){
			newVal=oldVal+","+$(this).html();
		}else{
			newVal=$(this).html();
		}

		newVal+=",";

	    	//console.log(newVal);		

	    	$('#keyWords').focus();

		$('#keyWords').val('');
		$('#keyWords').val(newVal);


		$('#keyWordsSuggest').fadeOut();
		


	});



	$( ".Start_Date" ).datepicker({ dateFormat: 'dd/mm/yy' });

	<?php if(isset($_GET["error"]) && $_GET["error"]){ ?>
		$(document).ready(function(){
			alert('<?php echo $saveErrorMsg;?>');
		});
	<?php } ?>
});

<?php
if($row["Top_Header"] && file_exists(dirname(__FILE__)."/../../../".$row["Top_Header"])){
	$imageSize=getimagesize(dirname(__FILE__)."/../../../".$row["Top_Header"]);

	$propWidth=intval($imageSize[0])/intval($imageSize[1])*150;
	?>

	$(document).ready(function () {
		doAspect(<?php echo $imageSize[0];?>, <?php echo $imageSize[1];?>);
	});

	function doAspect(width, height){

		if(!width || !height){
			width=	document.getElementById('selectionWidth').value;
			height=	document.getElementById('selectionHeight').value;
		}
		 $('#aspect').imgAreaSelect({ 	aspectRatio: '<?php echo $params->getValue("page_thumb_crop_ratio");?>', handles: true, fadeSpeed: 200, onSelectChange: changeValues, keys: true
							,imageWidth: width
							,imageHeight: height
				
		 });

	}

	<?php
}
?>

function changeValues(img, selection){

    if (!selection.width || !selection.height){
        return;
    }
/*    
    var scaleX = 100 / selection.width;
    var scaleY = 100 / selection.height;

    $('#preview img').css({
        width: Math.round(scaleX * 300),
        height: Math.round(scaleY * 300),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });
*/
    //+"|"+selection.x2+"|"+selection.y2
    $('#selectionParams').val(selection.x1+","+selection.y1+","+selection.width+","+selection.height);
    $('#selectionWidth').val(selection.width);
    $('#selectionHeight').val(selection.height);

}

</script>

<script type="text/javascript">
/*function validateFields(){*/

	/*
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
	document.location="index.php?id=<?php //echo $wm->getParent($id);?>";
	return false;
	*/
/*}*/


function searchParent(){
	parameters=encodeURI("search="+document.getElementById('txtSearch').value+"&thisId=<?php echo $id;?>");
	questAjax("pages/searchParent.php", parameters, "parentSearch", "GET");
	
}

function changeParent(id, name){
	document.edit.Parent.value=id;
	document.getElementById('parentName').innerHTML=name;
}


function chackUnique(){
	parameters=encodeURI("alias="+document.getElementById('Alias').value+"&thisId=<?php echo $row["ID"];?>");
	questAjax("pages/checkUnique.php", parameters, "aliasAlert", "GET");
}

/*
function checkCaseSensitive(){
    var aliasString = document.getElementById('Alias').value;
    if (aliasString != aliasString.toLowerCase()){
        alert('אין לכתוב עם אותיות גדולות. הכתובת הידידותית תשמר באותיות קטנות.\nUppercase not allowed. Alias will be saved as lowercase.');
    }
}

function checkAlias(){
    chackUnique();
    checkCaseSensitive();
}
*/

function searchConnectedPages(){
    if(document.getElementById('txtSearchConnected').value.length >2){
    	
        parameters=encodeURI("search="+document.getElementById('txtSearchConnected').value+"&thisId=<?php echo $id;?>");
        questAjax("pages/searchConnectedPages.php", parameters, "connectedPagesSearch", "GET");
    }
}

function saveChecked(pageId){
    if($('#check'+pageId).prop('checked') == true){
        jQuery("#connected").append('<input id="tempCheckbox'+pageId+'" type="checkbox" style="display: none;" name="connectedPages[]" checked="checked" value="'+pageId+'">');
    }else{
        jQuery("#tempCheckbox"+pageId).attr('checked', false);
    }
}

</script>
<?php require_once('common/body.php');?>
<div id="imageManager"></div>
<!--<script language="javascript" type="text/javascript" src="JS/wz_dragdrop.js"></script>-->
 
<?php if($_REQUEST["display"]){?>
	<?php if($_REQUEST["version"]){?>
	<?php echo $_REQUEST["version"];?>
	exit;
	
		<script language="javascript" type="text/javascript">
		self.parent.location="<?php echo $cfg["WM"]["Server"]."/preview/".($_REQUEST["version"]);?>";
		</script>
	<?php }else{
        $link=$wm->getLink($row);?>
		<script language="javascript" type="text/javascript">
		/*self.parent.location="<?php echo $cfg["WM"]["Server"]."/".($row["Alias"]?$row["Alias"]:$row["ID"]);?>";*/
		self.parent.location="<?php echo $link["Link"];?>";
		</script>
	<?php }?>
<?php }?>

<?php $wm_page_id=$id;?>

<div class="navigator_line"><?php require_once("navigator.php");?></div>
<div class="editPagePaddingPageEdit">


<form name="edit" action="../interface/tree_operations/edit_page.php" method="post" enctype="multipart/form-data" onsubmit="/*return validateFields();*/" style="padding: 0px; margin: 0px;">
<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="hidden" name="page" value="<?php echo $_REQUEST["page"];?>" />
<input type="hidden" name="Lang" value="<?php echo $row["Lang"];?>" />
<input type="hidden" name="Hide_On_Menu" value="<?php echo $row["Hide_On_Menu"];?>" />
<input type="hidden" name="Ordering" value="<?php echo $row["Ordering"];?>" />
<input type="hidden" name="ShowOnHomepage" value="<?php echo $row["ShowOnHomepage"];?>" />
<input type="hidden" name="ShowOnTicker" value="<?php echo $row["ShowOnTicker"];?>" />
<input type="hidden" name="rss" value="<?php echo $row["rss"];?>" />
<input type="hidden" name="YearMonth" value="<?php echo $row["YearMonth"];?>" />
<input type="hidden" name="End_Date" value="<?php echo $row["End_Date"];?>" />
<input type="hidden" name="Start_Time" value="<?php echo $row["Start_Time"];?>" />
<input type="hidden" name="End_Time" value="<?php echo $row["End_Time"];?>" />
<input type="hidden" name="Top_Header_Height" value="<?php echo $row["Top_Header_Height"];?>" />
<input type="hidden" name="wm_categories" value="<?php echo $row["wm_categories"];?>" />
<input type="hidden" name="checkbox_line" value="<?php echo $row["checkbox_line"];?>" />
<input type="hidden" name="noindex" value="<?php echo $row["noindex"];?>" />
<input type="hidden" name="hasConnectedBanners" value="<?php echo $row["hasConnectedBanners"];?>" />

<?php if($versionId){?>
<input type="hidden" name="versionId" value="<?php echo $versionId;?>" />
<?php }?>


<div class="tabber">

<div class="tabbertab">
	<h3><?php echo $text["Content edit"];?></h3>

	<?php if($wm->getParentProperty($id, "Admin_Start_Date")){?>
		<h4><?php echo $text["Date"];?>:</h4>
		<input type="text" name="Start_Date" class="Start_Date" value="<?php echo date("d/m/Y", $dt->timestampFromMysql($row["Start_Date"]));?>"  /> 
		<input type="checkbox" name="Show_On_Time" value="1" <?php echo $row["Show_On_Time"]?"checked":"";?> style="border: none;" /> <?php echo $text["Show On Time"];?>
	<?php }else{?>
		<input type="hidden" name="Start_Date" value="<?php echo date("d/m/Y", $dt->timestampFromMysql($row["Start_Date"]));?>" />
		<input type="hidden" name="Show_On_Time" value="<?php echo $row["Show_On_Time"]?"1":"0";?>" />
	<?php }?>
        
        
        <?php
        if($row['Page_Type'] == 98){/*start time field only for events page type*/?>
            <input type="text" name="Start_Time" value="<?php echo $row['Start_Time'];?>"  /> 
        <?php }
        
        
        
        if($row['Page_Type'] == 96){/*choose title field and area of expertise only for dotor page type*/?>
            <h4><?php echo $text["doc title"];?>:</h4>
            <select name="wm_doctor_title" required>
                            <option value=""><?php echo $text["Choose"];?></option>
            <?php
                     $query="SELECT * FROM wm_doctor_title ORDER BY Name";
                     $docTitles=$db->getArray($query);
                    
                     foreach($docTitles as $title){?>
                            <option value="<?php echo $title["ID"];?>" <?php echo $title["ID"]==$row["wm_doctor_title"]?"selected":"";?>><?php echo $text[$title["Name"]].' ('.$title['sex'].")";?></option>
            <?php 	}?>
            </select>
            
            <h4><?php echo $text["area of expertise"];?>:</h4>
            <select style="width:100%" name="wm_doctor_expertise[]" multiple='multiple'>
            <?php
				$query="SELECT * FROM wm_doctor_expertise ORDER BY Name";
				$areasOfExpertise=$db->getArray($query);
				$arrExpertize = explode(',', $row["wm_doctor_expertise"]);
				foreach($areasOfExpertise as $title){
					if($row["Lang"] == 'he'){
						$doctorExpertiseInLang = 'Name';
					}else{
						if($title['Value']){
							$doctorExpertiseInLang = 'Value';
						}else{
							$doctorExpertiseInLang = '';
						}
					}
					if($doctorExpertiseInLang !=''){ ?>
							<option self="<?php echo $title['Value'];?>" value="<?php echo $title["ID"];?>" <?php echo in_array($title["ID"], $arrExpertize)?"selected":"";?>><?php echo $title[$doctorExpertiseInLang];?></option>
			<?php 	}
			}?>
            </select>
            
        <?php }?>
	
	<h4><?php echo $text["Page Name"];?></h4>	
	<textarea name="Name" style="width: 761px; height: 30px;"><?php echo $row["Name"];?></textarea>

	<h4><?php echo $text["h1"];?></h4>	
	<textarea name="h1" style="width: 761px; height: 30px;"><?php echo $row["h1"];?></textarea>


	<?php if ($row["Page_Type"]==62){?>
	<h4><?php echo $text["Color"];?></h4>	
	<input type="text" name="Color" style="width: 761px;" value="<?php echo $row["Color"];?>" maxlength="6" />
	<?php }else{?>
	<input type="hidden" name="Color" value="<?php echo $row["Color"];?>" />
	<?php }?>

	<h4><?php echo $text["Author"];?></h4>	
	<input type="text" name="Author" value="<?php echo $row["Author"];?>" style="width: 765px; height: 16px;" />

	<?php if($wm->getProperty($id, "ID")==46){?>
		<h4>מס' משתתפים מקסימלי</h4>
		<input type="txt" name="max_participants" value="<?php echo $row["max_participants"];?>" />
	<?php }else{?>
		<input type="hidden" name="max_participants" value="<?php echo $row["max_participants"];?>" />
	<?php }?>

	<?php if($wm->getProperty($id, "ID")==49 || $wm->getProperty($id, "ID")==50){?>
		<?php if($wm->getProperty($id, "ID")==50){?>
		<h4>ספיישל</h4>
		<input type="checkbox" name="Special" value="1" <?php echo $row["Special"]?"checked":"";?> />
		<?php }?>

		<h4>עיר</h4>
		<select name="City">
			<option value="0">ללא</option>
		<?php
			 $query="SELECT * FROM wm_cities ORDER BY Name";
			 $cities=$db->getArray($query);
			 foreach($cities as $city){?>
				<option value="<?php echo $city["ID"];?>" <?php echo $city["ID"]==$row["City"]?"selected":"";?>><?php echo $city["Name"];?></option>
		<?php 	}?>
		</select>
	<?php }else{?>
		<input type="hidden" name="Special" value="<?php echo $row["Special"]?"1":"0";?>" />
		<input type="hidden" name="City" value="<?php echo $row["City"];?>" />
	<?php }?>
	


	<?php  if($wm->getProperty($id, "Admin_Enable_Email")){
		if(!$row["Email"]){
			$row["Email"]=$params->getValue("site_mail_default_email");
		}
	?>
	<h4>Email</h4>
	<input type="text" name="Email" style="width: 761px;" value="<?php echo $row["Email"];?>" dir="ltr" />
	<?php }else{?>
		<input type="hidden" name="Email" value="<?php echo $row["Email"];?>" />
	<?php }?>


	<?php if($wm->getProperty($id, "Admin_Sub_Title")){?>
		<h4><?php echo $text["Sub_Title"];?></h4>
        <textarea id="elm8" name="Sub_Title" style="width: 761px;"><?php echo $row["Sub_Title"];?></textarea>

		<h4><?php echo $text["External_Sub_Title"];?></h4>	
		<textarea name="External_Sub_Title" style="width: 761px; height: 30px;"><?php echo $row["External_Sub_Title"];?></textarea>

	<?php }else{?>
		<input type="hidden" name="Sub_Title" value="<?php echo $row["Sub_Title"];?>" />
		<input type="hidden" name="External_Sub_Title" value="<?php echo $row["External_Sub_Title"];?>" />
	<?php }?>





	<!--
	<h3><?php echo $text["Scroller"];?></h3>
	<textarea name="Scroller" style="width: 400px; height: 100px;"><?php echo $row["Scroller"];?></textarea>
	-->
	<input type="hidden" name="Scroller" value="<?php echo $text["Scroller"];?>">

	<h4><?php echo $text["Content"];?></h4>
<div style="width: 766px; height: 180px;">
<textarea id="elm1" name="Content"><?php echo $row["Content"];?></textarea>
<script>
CKEDITOR.replace( 'Content',
	{
        height:250,
		basicEntities : false,
		tabSpaces : 0,
		<?php if($gui->getDir()=="rtl"){?>
		language: 'he'
		<?php }else{?>
		language: 'en'
		<?php }?>		
	});
</script>
</div>






	<input type="hidden" name="Content_Bottom" value="<?php echo $row["Content_Bottom"];?>" />



</div>


<iframe name="file_explorer" frameborder="0" width="0" height="0" src="javascript:'
        <script>
        var obj;
        window.KCFinder = {callBack:function(url){
            eval(\'parent.document.forms[0].\'+obj+\'.value=url\')
        }};
        function open_it(id){
            obj=id;
            window.open(\'/manage/gui/ckeditor/plugins/kcfinder/browse.php?type=images&langCode=he\',\'t\',\'width=1200,height=800\');
            return false
        }</script>'"></iframe>

<script type="text/javascript">
function create_layer(url,width,height) {
    var d = top.document, el = document.createElement('div'), html = '';
    el.id = "crop_frame";
    el.style.position = "absolute";   
    el.style.top = "50px";
    el.style.left = ((d.documentElement.clientWidth-width)/2)+"px";
    el.style.width = (width+2)+"px";
    el.style.height = (height+14)+"px";
    el.style.border = "1px solid #000";
    el.style.boxShadow = "4px 4px 10px #666";
    el.style.background = "#888";
    el.style.zIndex = "99999";
    el.style.cursor = "pointer";
    html = '<iframe name="crop_frame" style="position:absolute;top:12px;left:0px" frameborder="0" width="'+width+'" height="'+height+'" src="'+url+'"></iframe>';
    html+= '<div style="position:absolute;top:-1px;right:2px;text-shadow:1px 1px 1px #000,-1px -1px 1px #000;cursor:pointer;color:#fff;font-weight:bold;font-size:10px" onclick="parent.close_layer()">X</div>';
    el.innerHTML = html;
    d.body.appendChild(el);
    setTimeout(function(){$(top.document.getElementById('crop_frame')).draggable()},1000);
    top.close_layer = function() { $(top.document.getElementById('crop_frame')).remove() }
}
</script>
   

<div class="tabbertab" style="overflow-y: scroll;height: 590px;">
	<h3><?php echo $text["Content"];?></h3>
	<h4><?php echo $text["Content"];?></h4>
	<div style="width: 766px;">
		<textarea id="elm2" name="Content_Center"><?php echo $row["Content_Center"];?></textarea>
		<script>
		CKEDITOR.replace( 'Content_Center',
			{
				height: '200px',
				<?php if($gui->getDir()=="rtl"){?>
				language: 'he'
				<?php }else{?>
				language: 'en'
				<?php }?>		
					});
		</script>
	</div>

	<hr>
	
	<h4><?php echo $text["btn_name"];?></h4>
	<input type="text" name="btn_name" style="width: 761px;" value="<?php echo $row["btn_name"];?>" dir="ltr" />

	<h4><?php echo $text["btn_url"];?></h4>
	<input type="text" name="btn_url" style="width: 761px;" value="<?php echo $row["btn_url"];?>" dir="ltr" />

	<hr>


        
	<?php if (!in_array($row["Page_Type"],array(1,5,90,109))) echo '<div style="visibility:hidden">'; ?>
        <h4>כיצד להציג תמונת תפריט</h4>
        <?php 
        /*how to display Menu_File*/
        $display_modes = array(1=>'תמונה שלמה',2=>'תמונת רקע ולוגו במרכז',3=>'לוגו בצד וטקסט בצד השני');?>
        <select name='Menu_File_Display_Mode'>
        <?php
        foreach ($display_modes as $key=> $mode) {?>
            <option <?php echo $key == $row['Menu_File_Display_Mode'] ? 'selected':''; ?> value="<?php echo $key;?>"><?php echo $mode;?></option>
        <?php }?>
        </select>
	<h4>תמונת תפריט</h4>
	<?php if($row["Menu_File"]){
	$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."400"."X"."145"."/zcX1/";
	?>
	<input type="hidden" name="existing_Menu_File" value="<?php echo $row["Menu_File"];?>" />
        <?php /* <a href="gallery/content_pictures_crop.php?column=existing_Menu_File&img=existing_Menu_File_img&src=<?php echo $row["Menu_File"]?>" target="_blank" title="Click to crop image"><img id="existing_Menu_File_img" src="<?php echo $thumb_call.$row["Menu_File"];?>" border="0" style="max-height: 80px;" /></a> */ ?>
        <a href="javascript:create_layer('/manage/gui/gallery/content_pictures_crop.php?column=existing_Menu_File&img=existing_Menu_File_img&src=<?php echo $row["Menu_File"];?>',700,600)" title="Click to crop image"><img id="existing_Menu_File_img" src="<?php echo $thumb_call.$row["Menu_File"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a>

	<input type="checkbox" name="delete_Menu_File" value="1" style="border: none;" onclick="if(this.checked){document.getElementById('Menu_File').style.display='block';}else{document.getElementById('Menu_File').style.display='none';}" />&nbsp;<?php echo $text["Delete Image"];?>

	<input type="file" name="Menu_File" id="Menu_File" style="display: none; margin-top: 7px;" />

	<?php }else{?>
		<input type="file" name="Menu_File" />
	<?php }?>
                
        <h4> הסבר לתמונת תפריט (alt)</h4>
        <input type="text" name="Menu_File_Alt" value="<?php echo $row['Menu_File_Alt'];?>"/>
                
        <h4>לוגו תפריט</h4>
	<?php if($row["Menu_File_Logo"]){
	$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."400"."X"."145"."/zcX1/";
	?>
	<input type="hidden" name="existing_Menu_File_Logo" value="<?php echo $row["Menu_File_Logo"];?>" />
        <?php /* <a href="gallery/content_pictures_crop.php?column=existing_Menu_File_Logo&img=existing_Menu_File_img&src=<?php echo $row["Menu_File_Logo"]?>" target="_blank" title="Click to crop image"><img id="existing_Menu_File_Logo_img" src="<?php echo $thumb_call.$row["Menu_File_Logo"];?>" border="0" style="max-height: 80px;" /></a> */ ?>
        <a href="javascript:create_layer('/manage/gui/gallery/content_pictures_crop.php?column=existing_Menu_File_Logo&img=existing_Menu_File_Logo_img&src=<?php echo $row["Menu_File_Logo"];?>',700,600)" title="Click to crop image"><img id="existing_Menu_File_Logo_img" src="<?php echo $thumb_call.$row["Menu_File_Logo"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a>

	<input type="checkbox" name="delete_Menu_File_Logo" value="1" style="border: none;" onclick="if(this.checked){document.getElementById('Menu_File_Logo').style.display='block';}else{document.getElementById('Menu_File_Logo').style.display='none';}" />&nbsp;<?php echo $text["Delete Image"];?>

	<input type="file" name="Menu_File_Logo" id="Menu_File" style="display: none; margin-top: 7px;" />

	<?php }else{?>
		<input type="file" name="Menu_File_Logo" />
	<?php }?>
                
        <h4> טקסט לתמונת תפריט</h4>
        <input type="text" name="Menu_File_Text" style="width:400px" value="<?php echo $row['Menu_File_Text'];?>"/>
        

	<h4>תמונת תפריט נבחרת</h4>
	<?php if($row["Menu_File_Selected"]){
	$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."400"."X"."145"."/zcX1/";
	?>
	<input type="hidden" name="existing_Menu_File_Selected" value="<?php echo $row["Menu_File_Selected"];?>" />
        <?php /* <a href="gallery/content_pictures_crop.php?column=existing_Menu_File_Selected&img=existing_Menu_File_Selected_img&src=<?php echo $row["Menu_File_Selected"]?>" target="_blank" title="Click to crop image"><img id="existing_Menu_File_Selected_img" src="<?php echo $thumb_call.$row["Menu_File_Selected"];?>" border="0" style="max-height: 80px;" /></a> */ ?>
        <a href="javascript:create_layer('/manage/gui/gallery/content_pictures_crop.php?column=existing_Menu_File_Selected&img=existing_Menu_File_Selected_img&src=<?php echo $row["Menu_File_Selected"];?>',700,600)" title="Click to crop image"><img id="existing_Menu_File_Selected_img" src="<?php echo $thumb_call.$row["Menu_File_Selected"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a>

	<input type="checkbox" name="delete_Menu_File_Selected" value="1" style="border: none;" onclick="if(this.checked){document.getElementById('Menu_File_Selected').style.display='block';}else{document.getElementById('Menu_File_Selected').style.display='none';}" />&nbsp;<?php echo $text["Delete Image"];?>

	<input type="file" name="Menu_File_Selected" id="Menu_File_Selected" style="display: none; margin-top: 7px;" />

	<?php }else{?>
		<input type="file" name="Menu_File_Selected" />
	<?php }?>

	<?php if (!in_array($row["Page_Type"],array(1,5,90,109))) echo '</div>'; ?>
	
</div>



<?php if($wm->getProperty($id, "Admin_Enable_Image")){?>
<div class="tabbertab">
	<h3><?php echo $text["Media"];?></h3>
	<div style="max-height: 256px;">
		<h4><?php echo $text["Images"];?></h4>
		<div style="padding-right: 5px; padding-left: 5px;"><?php echo $text["Images Desclaimer"];?></div>

		<h4><?php echo $text["External Image"];?></h4>
		<?php if($row["Top_Header"]){
			$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."400"."X"."110"."/zcX1/";
		?>
		<input type="hidden" name="existing_Top_Header" value="<?php echo $row["Top_Header"];?>" />

		<input type="hidden" id="selectionParams" name="selectionParams" value="" />
		<input type="hidden" id="selectionWidth" name="selectionWidth" value="" />
		<input type="hidden" id="selectionHeight" name="selectionHeight" value="" />
		<div id="topHeaderId" style="float: <?php echo $gui->getLeft();?>;">
                <?php /* <a href="gallery/content_pictures_crop.php?column=existing_Top_Header&img=top_header_img&src=<?php echo $row["Top_Header"]?>" target="_blank" title="Click to crop image"><img id="top_header_img" src="<?php echo $thumb_call.$row["Top_Header"];?>" id="aspect" border="0" width="<?php echo $propWidth;?>" height="110" /></a> */ ?>
                <a href="javascript:create_layer('/manage/gui/gallery/content_pictures_crop.php?id=<?php echo $row["ID"];?>&column=existing_Top_Header&img=top_header_img&src=<?php echo $row["Top_Header"];?>',700,600)" title="Click to crop image"><img id="top_header_img" src="<?php echo $thumb_call.$row["Top_Header"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a>
                
    	</div>
		
		<input type="checkbox" name="delete_Top_Header" value="1" style="border: none; float: <?php echo $gui->getLeft();?>;" onclick="if(this.checked){document.getElementById('topHeader1').style.display='block';}else{document.getElementById('topHeader1').style.display='none';}" />&nbsp;<?php echo $text["Delete Image"];?>
		<div style="clear: both;"></div>
		<input type="file" name="header_file" id="topHeader1" style="display: none; margin-top: 7px;" />

        <div style="clear: both;"></div>

        <?php if (($row["Page_Type"]==5)||($row["Page_Type"]==95)) {?>
			<h4><?php echo $text["Image Link"];?></h4>
			<input type="text" name="Image_Text" style="width: 760px;" value="<?php echo $row["Image_Text"];?>" />
		<?php }?>
		<br />
	
		<?php }else{?>
                    <input type="file" name="header_file" />
                    <input type="text" name="existing_Top_Header" />
                    <button onclick="return file_explorer.open_it('existing_Top_Header')">סייר קבצים</button>
                    <?php if ($row["Page_Type"]==95) { ?>
                    <h4>קישור למכון</h4>
                    <input type="text" name="Image_Text" style="width: 760px;" value="<?php echo $row["Image_Text"];?>" />
                    <?php } ?>
		<?php }?>
        
                <h4> הסבר לתמונת חיצונית (alt)</h4>
                <input type="text" name="Top_Header_Alt" style="width:400px" value="<?php echo $row['Top_Header_Alt']?>"/>
	
		<!--<h4><?php echo $text["Height"];?>:</h4><input type="text" name="Top_Header_Height" value="<?php echo $row["Top_Header_Height"];?>" />-->
		<?php /*?>
		<h3><?php echo $text["Menu Image"];?></h3>
		<?php if($row["Menu_File"]){?>
			<img src="<?php echo $cfg["WM"]["Server"]."/".$row["Menu_File"];?>" alt="menu Image" />
			<br />
		<?php }?>
		<input type="file" name="Menu_File" />
		<?php */?>
	</div>

	<div class="longLine"></div>

	<?php if($row['Page_Type'] == 171) { ?> <!-- Page type medical_zone_new -->

	<h4><?php echo $text["Video"];?></h4>
	<div style="padding-right: 5px; padding-left: 5px;"><?php echo $text["Video Disclaimer"];?></div>

	<?php if($row["Video_Embed"]){ ?>
		<input type="hidden" name="Video_Embed" value="<?php echo $row["Video_Embed"];?>" />
		<!-- Video Thumbnail -->
		<div id="videoEmbedId" style="float: <?php echo $gui->getLeft();?>;">
			<video width="<?php echo $propWidth;?>" height="110" controls="controls" preload="metadata">
				<source src="<?php echo $cfg["WM"]["Server"].'/'.$row["Video_Embed"];?>" type="video/mp4">
			</video>
		</div>
		
		<input type="checkbox" name="delete_Video_Embed" value="1" style="border: none; float: <?php echo $gui->getLeft();?>;" onclick="if(this.checked){document.getElementById('deleteVideo').style.display='block';}else{document.getElementById('deleteVideo').style.display='none';}" />&nbsp;<?php echo $text["Delete video"];?>
		<div style="clear: both;"></div>
		<input type="file" name="video_file" id="deleteVideo" style="display: none; margin-top: 7px;" />
		<div style="clear: both;"></div>

	<?php }else{?>
		<input type="file" name="video_file" />
		<input type="text" name="existing_video_file" />
		<button onclick="return file_explorer.open_it('existing_video_file')">סייר קבצים</button>
	<?php }?>

	<div class="longLine"></div>

	<?php } ?>


	<div style="max-height: 156px;">

		<h4><?php echo $text["Internal Image"];?></h4>
		<?php if($row["Top_Header2"]){
		$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."400"."X"."110"."/zcX1/";
		?>
		<input type="hidden" name="existing_Top_Header2" value="<?php echo $row["Top_Header2"];?>" />
                <?php /* <a href="gallery/content_pictures_crop.php?column=existing_Top_Header2&img=top_header2_img&src=<?php echo $row["Top_Header2"]?>" target="_blank" title="Click to crop image"><img id="top_header2_img" src="<?php echo $thumb_call.$row["Top_Header2"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a> */ ?>
                <a href="javascript:create_layer('/manage/gui/gallery/content_pictures_crop.php?id=<?php echo $row["ID"];?>&column=existing_Top_Header2&img=top_header2_img&src=<?php echo $row["Top_Header2"];?>',700,600)" title="Click to crop image"><img id="top_header2_img" src="<?php echo $thumb_call.$row["Top_Header2"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a>
	
		<input type="checkbox" name="delete_Top_Header2" value="1" style="border: none;" onclick="if(this.checked){document.getElementById('topHeader2').style.display='block';}else{document.getElementById('topHeader2').style.display='none';}" />&nbsp;<?php echo $text["Delete Image"];?>

		<input type="file" name="header_file2" id="topHeader2" style="display: none; margin-top: 7px;" />

		<?php }else{?>
			<input type="file" name="header_file2" />
                        <input type="text" name="existing_Top_Header2" />
                        <button onclick="return file_explorer.open_it('existing_Top_Header2')">סייר קבצים</button>
		<?php }?>
                        
                <h4> הסבר לתמונת פנימית (alt)</h4>
                <input type="text" name="Top_Header2_Alt" style="width:400px" value="<?php echo $row['Top_Header2_Alt'];?>"/>
	</div>


	<br />
	<div class="longLine"></div>


	<h4><?php echo $text["Footer Image"];?></h4>
	<?php if($row["Top_Header3"]){
	$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."400"."X"."110"."/zcX0/";
	?>
	<input type="hidden" name="existing_Top_Header3" value="<?php echo $row["Top_Header3"];?>" />
        <?php /* <a href="gallery/content_pictures_crop.php?column=existing_Top_Header3&img=top_header3_img&src=<?php echo $row["Top_Header3"]?>" target="_blank" title="Click to crop image"><img id="top_header3_img" src="<?php echo $thumb_call.$row["Top_Header3"];?>" border="0" /></a> */ ?>
        <a href="javascript:create_layer('/manage/gui/gallery/content_pictures_crop.php?column=existing_Top_Header3&img=top_header3_img&src=<?php echo $row["Top_Header3"];?>',700,600)" title="Click to crop image"><img id="top_header3_img" src="<?php echo $thumb_call.$row["Top_Header3"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a>
        

	<input type="checkbox" name="delete_Top_Header3" value="1" style="border: none;" onclick="if(this.checked){document.getElementById('topHeader3').style.display='block';}else{document.getElementById('topHeader3').style.display='none';}" />&nbsp;<?php echo $text["Delete Image"];?>

	<input type="file" name="header_file3" id="topHeader3" style="display: none; margin-top: 7px;" />

	

	<?php }else{?>
		<input type="file" name="header_file3" dir="ltr" />
        <input type="text" name="existing_Top_Header3" />
        <button onclick="return file_explorer.open_it('existing_Top_Header3')">סייר קבצים</button>
	<?php }?>
        
        <h4> הסבר לתמונת Footer (alt)</h4>
        <input type="text" name="Top_Header3_Alt" style="width:400px" value="<?php echo $row['Top_Header3_Alt'];?>"/>

	<div class="clear"></div>
	<br />
	<div class="longLine"></div>

    <!-- OG Image -->
    <h4><?php echo $text["OG Image"];?></h4>
	<?php if($row["og_image"]){
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."400"."X"."110"."/zcX0/";
	?>
        <input type="hidden" name="existing_og_image" value="<?php echo $row["og_image"];?>" />
        <?php /* <a href="gallery/content_pictures_crop.php?column=existing_og_image&img=og_image_img&src=<?php echo $row["og_image"]?>" target="_blank" title="Click to crop image"><img id="og_image_img" src="<?php echo $thumb_call.$row["og_image"];?>" border="0" /></a> */ ?>
        <a href="javascript:create_layer('/manage/gui/gallery/content_pictures_crop.php?column=existing_og_image&img=og_image_img&src=<?php echo $row["og_image"];?>',700,600)" title="Click to crop image"><img id="og_image_img" src="<?php echo $thumb_call.$row["og_image"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a>
        <input type="checkbox" name="delete_og_image" value="1" style="border: none;" onclick="if(this.checked){document.getElementById('og_image').style.display='block';}else{document.getElementById('og_image').style.display='none';}" />&nbsp;<?php echo $text["Delete Image"];?>
        <input type="file" name="og_image" id="og_image" style="display: none; margin-top: 7px;" />
	<?php }else{?>
		<input type="file" name="og_image" dir="ltr" />
        <input type="text" name="existing_og_image" />
        <button onclick="return file_explorer.open_it('existing_og_image')">סייר קבצים</button>
	<?php }?>

	<div class="clear"></div>
	<br />
	<div class="longLine"></div>

    <!-- Background color or Image -->
	<?php if($row['Page_Type'] == 171) { ?> <!-- 171 id of the medical_zone_new. Change accordingly -->
		<h4><?php echo $text["Page background"];?></h4>
		<br/>
		<div>
			<div class="checkboxAlign">
				<input type="checkbox" name="set_bg_color" value="<?php echo $row["bg_color"] ? 1 : 0;?>" <?php echo $row["bg_color"] ? 'checked' : '';?> style="border: none;" onclick="if(this.checked){document.getElementById('background-color').style.display='block';this.value='1';}else{document.getElementById('background-color').style.display='none';this.value='0';}"/>
				<label for="set_bg_color"><?php echo $text["Set background color"];?></label>
			</div>
			<div id="background-color" class="checkboxAlign" style="display: <?php echo $row["bg_color"] ? 'block' : 'none';?>; margin-top: 7px;">
				<label for="bg_color"><?php echo $text["Background color"];?>:</label>
				<input type="color" name="bg_color" value="<?php echo $row["bg_color"];?>" />
			</div>
		</div>
		<div>
			<p><?php echo $text["Background image"];?></p>
			<div>
				<?php if($row["bg_image"]){
					$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."400"."X"."110"."/zcX1/";
					?>
					<input type="hidden" name="existing_bg_image" value="<?php echo $row["bg_image"];?>" />
					<a href="javascript:create_layer('/manage/gui/gallery/content_pictures_crop.php?id=<?php echo $row["ID"];?>&column=existing_bg_image&img=bg_image_img&src=<?php echo $row["bg_image"];?>',700,600)" title="Click to crop image"><img id="bg_image_img" src="<?php echo $thumb_call.$row["bg_image"];?>" border="0" width="<?php echo $propWidth;?>" height="110" /></a>
					<div>
						<div class="checkboxAlign">
							<input type="checkbox" name="delete_bg_image" value="1" style="border: none; float: <?php echo $gui->getLeft();?>;" onclick="if(this.checked){document.getElementById('bg_image').style.display='block';}else{document.getElementById('bg_image').style.display='none';}" />
							&nbsp;<?php echo $text["Delete Image"];?>
						</div>
						<input type="file" name="background_image" id="bg_image" style="display: none; margin-top: 7px;" />
					</div>
				<?php }else{?>
					<input type="file" name="background_image"/>
					<input type="text" name="existing_bg_image" />
					<button onclick="return file_explorer.open_it('existing_bg_image')">סייר קבצים</button>
				<?php }?>
			</div>
		</div>
	<?php } ?>

	

	<div class="clear"></div>
	<br />
	<div class="longLine"></div>



        <?php if (!in_array($row["Page_Type"],array(1,5,90,109))) echo '<div style="visibility:hidden">'; ?>
	<h4><?php echo $text["Video Embed"];?></h4>
	<input type="text" name="Video_Embed" style="width: 760px;" value="<?php echo $row["Video_Embed"];?>" dir="ltr" />
	<div style="padding-right: 5px; padding-left: 5px;"><?php echo $text["Copy youtube link"];?></div>
	<h4><?php echo $text["Video Text"];?></h4>
	<textarea name="Video_Text" style="width: 760px; height: 30px;"><?php echo $row["Video_Text"];?></textarea>
	
	<?php if (in_array($row["Page_Type"],array(5))){/*only in home page - use AudioFile filed as link for btn under video*/?>
		<h4><?php echo $text["Video Link Btn"];?></h4>
		<input style="margin-bottom: 20px;width: 760px;" type="text" name="AudioFile"  value="<?php echo $row["AudioFile"];?>" dir="ltr" />
	<?php }?>
		
        <?php if (!in_array($row["Page_Type"],array(1,5,90,109))) echo '</div>'; ?>

</div>
<?php }?>





































<div class="tabbertab">
	<h3><?php echo $text["Search Engines"];?></h3>

	<h4><?php echo $text["Alias"];?></h4>
	<div dir="ltr">
	<?php $homePageId=$wm->getHomePageById($row["ID"]);echo "http://".$wm->get($homePageId, "domain");?>/
	<input type="text" name="Alias" id="Alias" style="width: 200px;" value="<?php echo $wm->removeDomainFromAlias($row["Alias"], $row["ID"]);?>" dir="ltr<?php //echo $gui->getDir();?>" onkeyup="chackUnique();" onchange="alert('Please know that changing page alias may harm its SEO');" autocomplete="off" />
	</div>
	
	<div style="padding-right: 5px; padding-left: 5px; padding-top: 5px;" id="aliasAlert"><?php echo $text["Alias desclaimer"];?></div>

	<div class="longLine"></div>

	<h4><?php echo $text["Meta Title"];?></h4>
	<input type="text" name="META_Title" style="width: 760px;" value="<?php echo $row["META_Title"];?>" />

	<h4><?php echo $text["Meta Description"];?></h4>
	<textarea name="META_Description" style="height: 50px; width: 760px;"><?php echo $row["META_Description"];?></textarea>
	
	<div class="keyWordsWrapper">
		<h4><?php echo $text["Meta Kerywords"];?></h4>
		<textarea name="META_Kerywords" id="keyWords" class="keyWords" style="height: 50px; width: 760px;"><?php echo $row["META_Kerywords"];?></textarea>
		<div id="keyWordsSuggest"></div>
	</div>

	<h4><?php echo $text["canonical"];?></h4>
	<input type="text" name="canonical" style="width: 760px;" value="<?php echo $row["canonical"];?>" dir="ltr" />
	<h4><?php echo $text["alternate"];?></h4>
	<textarea type="text" name="alternate" style="width: 760px; height: 40px;" dir="ltr" ><?php echo $row["alternate"];?></textarea>

	<div class="longLine"></div>

	<h4><?php echo $text["Conversion"];?></h4>
	<textarea name="Conversion" style="width: 760px;" dir="ltr"><?php echo $row["Conversion"];?></textarea>

	<div class="longLine"></div>

	<?php if($login->getLevel()<=$adminLevel || $adminLevel==0){?>
	<h4><?php echo $text["custom_class"];?></h4>
	<input type="text" name="custom_class" style="width: 760px;" value="<?php echo $row["custom_class"];?>" dir="ltr" />
	<?php } else { ?>
	<input type="hidden" name="custom_class" style="width: 760px;" value="<?php echo $row["custom_class"];?>" dir="ltr" />
	<?php } ?>

</div>


<div class="tabbertab">
	<h3><?php echo $text["External Links"];?></h3>

	<?php if($wm->getProperty($id, "Admin_Enable_Link")){

		if(!$row["Open_In"]){
			$row["Open_In"]="_self";
		}
	?>
		<h4><?php echo $text["Link to page"];?></h4>
	<?php
	/*
		<select name="Open_In" style="width: 760px;">
			<option value="_blank" <?php echo ($row["Open_In"]=="_blank")?"selected":"";?>>פתח בחלון חדש</option>
			<option value="_self" <?php echo ($row["Open_In"]=="_self")?"selected":"";?>>החלף דף קיים</option>
		</select>
	*/
	?>

	<div style="width: 760px;">
		<div style="width: 200px; float: right;">
			<input type="radio" name="Open_In" value="_blank" <?php echo ($row["Open_In"]=="_blank")?"checked":"";?>> <?php echo $text["Open a new page"];?>

			<br />
			<input type="radio" name="Open_In" value="_self" <?php echo ($row["Open_In"]=="_self")?"checked":"";?>>	<?php echo $text["Replace page"];?>
		</div>

		<div style="width: 200px; float: left; direction: ltr;">
			<input type="radio" name="moved_type" value="0" <?php echo ($row["moved_type"]=="0")?"checked":"";?>> None
			<br />
			<input type="radio" name="moved_type" value="301" <?php echo ($row["moved_type"]=="301")?"checked":"";?>> 301 Moved permanently
			<br />
			<input type="radio" name="moved_type" value="302" <?php echo ($row["moved_type"]=="302")?"checked":"";?>> 302 Moved temporarily
		</div>
	</div>
		<div style="clear: both;"></div>
		<br />
		<input type="text" name="Link" style="width: 760px;" value="<?php echo $row["Link"];?>" dir="ltr" />
		<br />
		<?php echo $text["Link Text"];?>

	

	<?php } else {?>
		<input type="hidden" name="Open_In" value="<?php echo $row["Open_In"];?>" />
		<input type="hidden" name="Link" value="<?php echo $row["Link"];?>" />
		<input type="hidden" name="moved_type" value="<?php echo $row["moved_type"];?>" />
	<?php }?>

	
	<div class="longLine"></div>


	<h4><?php echo $text["Link to file"];?></h4>
	<?php if($row["File_Name"]){?>
	<a href="<?php echo $cfg["WM"]["Server"]."/".$row["File_Name"];?>" target="_blank"><?php echo $cfg["WM"]["Server"]."/".$row["File_Name"];?></a>
	<input type="hidden" name="existing_File" value="<?php echo $row["File_Name"];?>" />
	<input type="checkbox" name="delete_File" value="1" style="border: none;" />&nbsp;<span><?php echo $text["Delete File"];?></span><br />
	<?php }?>
	
	<input type="file" name="File" value="<?php echo $row["File_Name"];?>" dir="ltr" />
	<br />
	<?php echo $text["files upload desclaimer"];?>


	<div class="longLine"></div>
<?php if (!in_array($row["Page_Type"],array(5))){?>
<?php echo $text["מספר טלפון"];?><br/>
<input type="text" name="AudioFile" value="<?php echo $row["AudioFile"];?>">
<?php }?>



</div>


<?php /*


<?php if($wm->getParentProperty($wm->getParent($id), "ID")==17 || $wm->getParentProperty($wm->getParent($id), "ID")==21){?>
	<h3><?php echo $text["Download File"];?></h3>
	<input type="file" name="AudioFile" />
	<input type="hidden" name="existing_AudioFile" value="<?php echo $row["AudioFile"];?>" />
	<?php if($row["AudioFile"]){
	$mediaURL=$cfg["WM"]["Server"]."/".$row["AudioFile"];
	?>
	<br />
		<?php if($row["AudioFile"]){?>
			<a href="<?php echo $mediaURL;?>" target="_blank"><?php echo $mediaURL;?></a>
			<input type="checkbox" name="delete_AudioFile" value="1" style="border: none;" /> <span style="color: #ffffff;"><?php echo $text["Delete"];?></span>
		<?php }?>
	<?php }?>
<?php }?>
		
<?php */?>


<?php if($wm->getProperty($id, "Admin_Enable_Advanced")){?>
<div class="tabbertab">
	<h3><?php echo $text["Advanced"];?></h3>
        <?php
        if($row['Page_Type'] == 5){/*show_doc_gallery field only for home page type*/?>
            <h4><?php echo $text["show doc gallery"];?>:</h4>
            <input type="checkbox" <?php echo $row["show_doc_gallery"]==1 ? 'checked="checked"':'' ?> name="show_doc_gallery" value="1"  />
            
            <h4><?php echo $text["show event calendar"];?>:</h4>
            <input type="checkbox" <?php echo $row["Show_Event_Calendar"]==1 ? 'checked="checked"':'' ?> name="Show_Event_Calendar" value="1"  />
            
            <h4><?php echo $text["is messer page"];?>:</h4>
            <input type="checkbox" <?php echo $row["is_messer_page"]==1 ? 'checked="checked"':'' ?> name="is_messer_page" value="1"  /> 
			<?php 
			if($row['ID'] != 2){/*main sheba site dont need this field*/ ?>
			<h4><?php echo $text["is logo link to subdomain homepage"];?>:</h4>
            <input type="checkbox" <?php echo $row["logo_link_to_subdomain_home_page"]==1 ? 'checked="checked"':'' ?> name="logo_link_to_subdomain_home_page" value="1"  /> 
			<?php }
			?>
        <?php }?>
        <h4><?php echo $text["show in block"];?>:</h4>
            <select name="show_in_block">
            <?php
                     $blocks = range(1, 3);
                     foreach($blocks as $block){?>
                            <option value="<?php echo $block;?>" <?php echo $block==$row["show_in_block"]?"selected":"";?>><?php echo $block?></option>
            <?php 	}?>
            </select>
    <?php 
    if(strpos($_SERVER['SERVER_NAME'], 'msr.org.il') !== false){?>
	    <h4><?php echo $text["Header"];?>:</h4>
		<?php $availableHeaders = array(
			"None" => "none",
			"Image Gallery" => "image_galley"
		);?>
	    <select name="header_type">
	    <?php foreach($availableHeaders as $headerItemName => $headerItemVal){?>
	        <option value="<?php echo $headerItemVal;?>" <?php echo $headerItemVal==$row["header_type"]?"selected":"";?>><?php echo $headerItemName;?></option>
	    <?php }?>
	    </select>
    <?php }
    ?>
<!--
	<div style="cursor: pointer;" onclick="document.getElementById('manageNameDiv').style.display='block'; this.style.display='none';"><?echo $text["System name"];?></div> style="display: none;"-->

	<div id="manageNameDiv">
		<h4><?php echo $text["Domain"];?></h4>
		<input type="text" name="domain" style="width: 760px;" dir="ltr" value="<?php echo $row["domain"];?>" />
	</div>

	<div id="manageNameDiv">
		<h4><?php echo $text["Manage Name"];?></h4>
		<textarea name="Menu_Name" style="width: 760px; height: 30px;"><?php echo $row["Menu_Name"];?></textarea>
	</div>

	<div class="longLine"></div>

	<?php if($row['Page_Type'] == 152){/*only in search doctors form only show field  - searchonlySpecialists*/?>
            <input type="checkbox" name="search_only_specialist_doctors" <?php echo $row['search_only_specialist_doctors']==0 ? '': "checked='checked'"?> />
			<span style="font-weight: bold"><?php echo $text["search only specialist doctors"];?></span>
    <?php }?>
    <br />

    <?php if($row['Page_Type'] == 96){/*only in search doctors form only show field  - searchonlySpecialists*/?>
            <input type="checkbox" name="is_specialist_doctor" <?php echo $row['is_specialist_doctor']==0 ? '': "checked='checked'"?> />
			<span style="font-weight: bold"><?php echo $text["is specialist doctor"];?></span>
    <?php }?>
    <br />


    <?php
    if($wm->get($row["Parent"], "Page_Type")=="35"){?>
	    <input type="checkbox" name="Enable_Dropdown" value="1" <?php echo $row["Enable_Dropdown"]?"checked":"";?> style="vertical-align: middle;"/>
        <span style="font-weight: bold"><?php echo $text["Enable Dropdown"];?></span>
    	<br />
    <?php }?>

    <input type="checkbox" name="Enable_SideContent" value="1" <?php echo $row["Enable_SideContent"]?"checked":"";?> style="vertical-align: middle;"/>
        <span style="font-weight: bold"><?php echo $text["Enable Side Content"];?></span>
    <br />
    
	
    <?php if($row['Page_Type'] == 95){/*is extended institute field only for institute page*/?>
            <input type="checkbox" name="show_extended" value="1" <?php echo $row["show_extended"]?"checked":"";?> style="border: none;" /> <?php echo $text["show extended"];?>
             <br />
            <input type="checkbox" name="dontShowInUnitsSearch" value="1" <?php echo $row["dontShowInUnitsSearch"]?"checked":"";?> style="vertical-align: middle;"/>
        	<span style="font-weight: bold"><?php echo $text["dont Show In Units Search"];?></span>
    <?php }?>
    <br />

    <input type="checkbox" name="vertical_images" value="1" <?php echo $row["vertical_images"]?"checked":"";?> style="vertical-align: middle;"/>
    <span style="font-weight: bold"><?php echo $text["Vertical Images"];?></span>
    
    <br />
    
    <input type="checkbox" name="hide_banners" value="1" <?php echo $row["hide_banners"]?"checked":"";?> style="vertical-align: middle;"/>
    <span style="font-weight: bold"><?php echo $text["Hide Banners"];?></span>
    
    
    <div class="longLine"></div>
    
    <?php if($row['Page_Type'] == 98){/*only for events pages*/?>
	<h3><?php echo $text["cancel event"];?></h3>
	<input type="checkbox" name="cancel_event" value="1" <?php echo $row["cancel_event"]?"checked":"";?> /> <?php echo $text["cancel event"];?>
	 <?php }?>



	<h4><?php echo $text["Language"];?>:</h4>
	<select name="Lang" style="width: 186px;">
	<?php $arrLang=$db->getArray("SELECT * FROM wm_languages ORDER BY Ordering");?>
	<?php foreach($arrLang as $lang){?>
		<option value="<?php echo $lang["Lang"];?>" <?php echo $lang["Lang"]==$row["Lang"]?"selected":"";?>><?php echo $lang["Name"];?></option>
	<?php }?>
	</select>

	<div class="longLine"></div>


	<?php if($wm->getParent($id)==0){?>
		<h4><?php echo $text["Language"];?>:</h4>
			
			<input type="hidden" name="Page_Type" value="0" />
			<!--<input type="hidden" name="Lang" value="<?php echo $row["Lang"];?>" />-->
			<!--
			<select name="Lang" style="width: 156px;">
				<option value="en"><?php //echo $text["English"];?></option>
				<option value="he"><?php //echo $text["Hebrew"];?></option>			
			</select>
			-->				</td>				
	
	<?php }else{?>
		<h4><?php echo $text["Page Type"];?></h4>
			
			<?php if($row["Page_Type"]==5){?>
					<input type="hidden" name="Page_Type" value="5" />
					Home Page
											
			<?php }else{?>
<?php
$adminLevel=$wm->getProperty($id, "Admin_Level");
?>

<?php if($login->getLevel()<=$adminLevel || $adminLevel==0){?>
					<select name="Page_Type" style="width: 760px;">
					<?php
					$arr_page_type=$wm->getPageTypes();
					for($i=0;$i<count($arr_page_type);$i++){
					?>
						<option value="<?php echo $arr_page_type[$i]["ID"];?>" <?php
						echo $row["Page_Type"]==$arr_page_type[$i]["ID"]?"selected":"";
						?>><?php echo $text[$arr_page_type[$i]["Name"]]?$text[$arr_page_type[$i]["Name"]]:$arr_page_type[$i]["Name"];?></option>
					<?php }?>
					</select>
<?php }else{?>
			<?php echo $wm->getProperty($id, "Name");?>
			<input type="hidden" name="Page_Type" value="<?php echo $row["Page_Type"];?>" />
<?php }?>



			<?php }?>
	<?php }?>
	<?php 
	/*add new field Secondary_Page_Type*/

	$adminLevel=$wm->getProperty($id, "Admin_Level");
	?>
	<h4><?php echo $text["Secondary_Page_Type"];?></h4>
	<?php if($login->getLevel()<=$adminLevel || $adminLevel==0){?>
						<select name="Secondary_Page_Type" style="width: 760px;">
						<?php
						$arr_page_type=$wm->getPageTypes();
						?><option value="0"><?php echo $text['Choose']?></option><?php 
						for($i=0;$i<count($arr_page_type);$i++){
						?>
							<option value="<?php echo $arr_page_type[$i]["ID"];?>" <?php
							echo $row["Secondary_Page_Type"]==$arr_page_type[$i]["ID"]?"selected":"";
							?>><?php echo $text[$arr_page_type[$i]["Name"]]?$text[$arr_page_type[$i]["Name"]]:$arr_page_type[$i]["Name"];?></option>
						<?php }?>
						</select>
	<?php }else{?>
				<?php echo $wm->getProperty($id, "Name");?>
				<input type="hidden" name="Secondary_Page_Type" value="<?php echo $row["Secondary_Page_Type"];?>" />
	<?php }
	/*add new field Secondary_Page_Type - END*/
	?>

	
	<div class="longLine"></div>

						<h4><?php echo $text["Revert to version"];?>:</h4>

						<select name="version" style="width: 760px;" dir="ltr" onchange="document.location='index.php?show=pages/page_edit&versionId='+this.value+'&page=<?php echo $_REQUEST["page"];?>';">

						<?php
						$arrVersions=$wm->getVersions($id);
						for($i=0;$i<count($arrVersions);$i++){
						?>
							<option value="<?php echo $arrVersions[$i]["ID"];?>" <?php
							//echo ($row["wm_pages_versions"]==$arrVersions[$i]["ID"] || ($versionId && $versionId==$arrVersions[$i]["ID"]))?"selected":"";
if($versionId){
	echo $versionId==$arrVersions[$i]["ID"]?"selected":"";
}else{
	echo $row["wm_pages_versions"]==$arrVersions[$i]["ID"]?"selected":"";
}				

							?>><?php echo date("D d/m/Y H:i:s", $arrVersions[$i]["UpdatedTime"]);?></option>
						<?php }?>
						</select>


	<div class="longLine"></div>


	<?php if($login->isSuperManager()){?>
		<h4>Customer</h4>
		<?php 
		$query="
		SELECT * 
		FROM wm_landing_pages_customers 
		ORDER BY Name
		";
		$arrForms=$db->getArray($query);
		?>
		<select name="wm_landing_pages_customers">
			<option value="0">-- NO CUSTOMER --</option>
		<?php foreach($arrForms as $form){?>
			<option value="<?php echo $form["ID"];?>" <?php echo $form["ID"]==$row["wm_landing_pages_customers"]?"selected":"";?>><?php echo $form["Name"];?></option>
		<?php }?>
		</select>


		<div class="longLine"></div>

	<?php }else{?>
		<input type="hidden" name="wm_landing_pages_customers" value="<?php echo $row["wm_landing_pages_customers"];?>" />
	<?php }?>











	<?php  if($wm->getProperty($id, "Admin_Enable_Protection")){?>
		
		
		<div style="font-weight: bold;">

		<input type="checkbox" name="Protected" value="1" <?php echo ($row["Protected"])?"checked":"";?> onclick="if(this.checked){document.getElementById('protectDetails').style.display='block';}else{document.getElementById('protectDetails').style.display='none';}" style="border: none;" /> <?php echo $text["Protect this page with password"];?>
		<br />
	
			<div id="protectDetails" <?php echo $row["Protected"]?"":"style=\"display: none;\"";?>>
				<table cellpadding="3" cellspacing="0">
				<tr>
					<td><?php echo $text["Username"];?>:</td>
					<td><input type="text" name="Username" value="<?php echo $row["Username"];?>" dir="ltr" /></td>	
				</tr>
				<tr>
					<td><?php echo $text["Password"];?>:</td>
					<td><input type="text" name="Password" value="<?php echo $row["Password"];?>" dir="ltr" /></td>	
				</tr>
				</table>
			</div>
		</div>

	
	<?php }else{?>
		<input type="hidden" name="Username" value="<?php echo $row["Username"];?>">
		<input type="hidden" name="Password" value="<?php echo $row["Password"];?>">
	<?php }?>
	
	<div class="longLine"></div>


	<h4><?php echo $text["Template"];?></h4>
	<select name="wm_template">
		<?php $templates=$db->getArray("SELECT * FROM wm_template ORDER BY Ordering");?>
		<option value="0"><?php echo $text["Template"];?></option>
		<?php foreach($templates as $item){?>
			<option value="<?php echo $item["ID"];?>" <?php echo $row["wm_template"]==$item["ID"]?"selected":"";?>><?php echo $item["Name"];?></option>
		<?php }?>
	</select>



	<h4><?php echo $text["Enable Comments"];?></h4>
	<select name="Comments">
		<option value="no" 		<?php echo $row["Comments"]=="no"?"selected":"";?>><?php echo $text["No Comments"];?></option>
		<option value="yes"		<?php echo $row["Comments"]=="yes"?"selected":"";?>><?php echo $text["Show Comments"];?></option>
		<option value="with approval"	<?php echo $row["Comments"]=="with approval"?"selected":"";?>><?php echo $text["Show Comments Approval"];?></option>
	</select>

	<?php if($row['Page_Type'] == 5){ ?>
    <?php /*show elad chat*/?>
    <br />
    <div class="longLine"></div>
    <input type="checkbox" name="hide_elad_chat" <?php echo $row["hide_elad_chat"]==1 ? "checked":"";?> /><?php echo $text["Hide Elad Chat"];?>
    <?php

    /*edit newletter btn in footer*/?>
    <br />
    <div class="longLine"></div>
    <input type="checkbox" name="hide_newsletter_footer" <?php echo $row["hide_newsletter_footer"]==1 ? "checked":"";?> /><?php echo $text["Hide Newlleter Btn"];?>
    <br />
    <br />
    <label><?php echo $text["Newsletter Btn Link To"];?></label>
    <?php 
    	$newsletterPlaceholder = ($params->getValue("newsletter_default_link") != '') ? $params->getValue("newsletter_default_link") : $cfg["WM"]["Server"].'/item/57328/1/59721';
    ?>
    <br />
    <input type="text" style="width: 300px;" name="newsletter_btn_link" placeholder="<?php echo $newsletterPlaceholder;?>" value="<?php echo $row["newsletter_btn_link"];?>" dir="ltr" />
    
	<?php } ?>

    <?php 

/*
	<select name="Parent" style="width: 206px;">
	<?php
	function makeParentsOptions($id, $level){
		global $wm;
		global $row;
		$name=$wm->get($id, "Name");
		$nameFixxed=str_repeat("&nbsp;", ($level*2)).substr($name, 0, 50);
		echo "<option value=\"".$id."\" ".($row["Parent"]==$id?"selected":"").">".$nameFixxed."</option>";
	}

	if($row["Parent"]==1){
		echo "<option value=\"1\">".$text["Root"]."</option>";
	}else{
		$wm->evalTreeExt("makeParentsOptions", 1, 0, "", "Ordering", 4, "ID, Parent, Name");
	}
	?>
	</select>
*/
?>




</div>
<?php }else{?>
	<input type="hidden" name="Page_Type" value="<?php echo $row["Page_Type"];?>" />
	<input type="hidden" name="Answer_Text" value="<?php echo $row["Answer_Text"];?>" />
	<input type="hidden" name="Protected" value="<?php echo $row["Protected"];?>" />
	<input type="hidden" name="Username" value="<?php echo $row["Username"];?>" />
	<input type="hidden" name="Password" value="<?php echo $row["Password"];?>" />
	<input type="hidden" name="Comments" value="<?php echo $row["Comments"];?>" />
	<input type="hidden" name="Parent" value="<?php echo $row["Parent"];?>" />
<?php }?>




<?php if($wm->getProperty($id, "Admin_Enable_Advanced")){?>
	<div class="tabbertab">

		<h4><?php echo $text["Parent"];?></h4>

		<?php echo $text["Parent desclaimer"];?>

		<div id="parentName" style="font-weight: bold; font-size: 14px;">
			<?php echo $wm->get($row["Parent"], "Name");?>
		</div>

	

		<input type="text" id="txtSearch" name="txtSearch" autocomplete="off" style="width: 200px;" />
		<input type="button" name="search" value="<?php echo $text["Search"];?>" onclick="searchParent();document.getElementById('search_suggest').style.display='none';" />
		<br />
		<div id="search_suggest" style="padding: 0px; margin: 0px; margin-right: 23px;"></div>

		<input type="hidden" name="Parent" value="<?php echo $row["Parent"];?>" />


		<div id="parentSearch">

		</div>

	</div>
<?php }else{?>
	<input type="hidden" name="Parent" value="<?php echo $row["Parent"];?>" />
<?php }?>


<div class="tabbertab">
	<h3><?php echo $text["Form"];?></h3>
	<br />
	<?php if(true){?>
	<h4>Form</h4>
	<?php 
	$query="
	SELECT * 
	FROM wm_forms 
	WHERE wm_landing_pages_customers=0 ".($row["wm_landing_pages_customers"]?"OR wm_landing_pages_customers=".$row["wm_landing_pages_customers"]:"")."
	ORDER BY Name
	";
	$arrForms=$db->getArray($query);
	?>
	<select name="wm_forms" class="select2" onchange="if(this.value>0){$('#formData').slideDown();}else{$('#formData').slideUp();}">
		<option value="0">-- NO FROM --</option>
	<?php foreach($arrForms as $form){?>
		<option value="<?php echo $form["ID"];?>" <?php echo $form["ID"]==$row["wm_forms"]?"selected":"";?>><?php echo $form["Name"];?></option>
	<?php }?>
	</select>
		<div class="longLine"></div>
	<?php }?>
                
        <h4><?php echo $text["Email Address"];?></h4>
        <input type="text" name="Email_Address" value="<?php echo $row["Email_Address"];?>" placeholder="<?php echo $text["Email Address"];?>" style="width: 760px; height: 20px; padding: 5px; font-size: 16px;" />
        <h4><?php echo $text["Email Title"];?></h4>
        <input type="text" name="Email_Subject" value="<?php echo $row["Email_Subject"];?>" placeholder="<?php echo $text["Email Title"];?>" style="width: 760px; height: 20px; padding: 5px; font-size: 16px;" />
        <h4><?php echo $text["Email Content"];?></h4>
        <textarea type="text" name="Email_Body" value="<?php echo $row["Email_Body"];?>" placeholder="<?php echo $text["Email Content"];?>" style="width: 760px; height: 60px; padding: 5px; font-size: 16px;" /></textarea>

	<?php if($wm->getProperty($id, "Admin_Answer_Text")){?>
            <h4><?php echo $text["Button_Text"];?></h4>    
            <input type="text" name="Form_Btn_Text" value="<?php echo $row["Form_Btn_Text"];?>" />
	<h4><?php echo $text["Answer_Text"];?></h4>
	<div id="richTextEditor" style="width: 760px;">
	<textarea id="elm3" name="Answer_Text"><?php echo $row["Answer_Text"];?></textarea>
<script>
CKEDITOR.replace( 'Answer_Text',
	{
<?php if($gui->getDir()=="rtl"){?>
language: 'he'
<?php }else{?>
language: 'en'
<?php }?>		
	});
</script>
	</div>
	<?php }else{?>
	<input type="hidden" name="Answer_Text" value="<?php echo $row["Answer_Text"];?>">
	<?php }?>

</div>


<div class="tabbertab">
	<h3><?php echo $text["Share"];?></h3>
	<br />

	<input type="checkbox" name="AddThis" value="1" <?php echo $row["AddThis"]?"checked":"";?> /> <?php echo $text["Allow AddThis"];?>
	<!--
	<div class="longLine"></div>
	<input type="checkbox" name="facebook_comments" value="1" <?php echo $row["facebook_comments"]?"checked":"";?> /> <?php echo $text["Allow facebook comments"];?>
	<div class="longLine"></div>
	<input type="checkbox" name="facebook_like" value="1" <?php echo $row["facebook_like"]?"checked":"";?> /> <?php echo $text["Allow facebook like"];?>
	-->
</div>

<?php /*check if need to add dynamic fields tab*/

$isDynamic = $db->getArray("SELECT ID FROM wm_pages_dynamic_fields WHERE page_type=".$row['Page_Type']);
if(count($isDynamic) > 0){
	$dinamicFieldsHtml = $db->getArray("SELECT wm_forms_field_types.Multiple as ffMulti, wm_forms_field_types.Name as ffName,wm_forms_field_types.Value as ffValue,wm_pages_dynamic_fields.Name as fdName,wm_pages_dynamic_fields.mandatory as fdMandatory,wm_pages_dynamic_fields.Value as fdValue,wm_pages_dynamic_fields.ID as IDfield, wm_pages_dynamic_fields.block_num, wm_pages_dynamic_fields.wm_forms_field_types as fieldType FROM wm_forms_field_types INNER JOIN wm_pages_dynamic_fields ON wm_forms_field_types.ID = wm_pages_dynamic_fields.wm_forms_field_types WHERE wm_pages_dynamic_fields.page_type = ".$row['Page_Type']);
?>
<div class="tabbertab">
	<h3><?php echo $text["Dynamic Fields"];?></h3>
	<?php
	/*check if fields have values*/
	foreach ($dinamicFieldsHtml as $key => $value) {
		$existingValue = $db->getRow("SELECT * FROM wm_pages_dynamic_field_values WHERE wm_forms_fields=".$value['IDfield']." AND wm_pages=".$id);

		$targum = $value['fdName'];
		$value['ffValue'] = str_replace('[#NAME#]',$text[$targum] , $value['ffValue']);
		$value['ffValue'] = str_replace('[#DEFAULT_VALUE#]',$existingValue['Value'] , $value['ffValue']);

		if($value['fieldType'] == 66){//id of checkbox
			$checked = $existingValue['Value'] ? 'checked' : '';
			$value['ffValue'] = str_replace('[#CHECKED#]', $checked, $value['ffValue']);
		}
		
		$value['ffValue'] = str_replace('[#FIELD_NAME#]',"dynamic_field_".$value['IDfield'] , $value['ffValue']);
		if ($value['fdMandatory']) $value['ffValue'] = str_replace("<input","<input required", $value['ffValue']);
		

		if($value['fieldType'] == 5){/*fieldType is textaera - in this case need to add ckeditor*/
			echo $text[$targum];
			?>
			<div id="" style="width: 760px;">
				<?php echo $targum?>
				<textarea id="" class="editor" name="<?php echo "dynamic_field_".$value['IDfield']?>"><?php echo $existingValue['Value'];?></textarea>
			
			</div>
		<?php }else{/*fieldType is simple text*/
				echo $targum;
				echo $value['ffValue'].'<br />';
			}
			
		}
	?>
        

</div>
        
<script>
 /*load all dynamic editors with delay...hopefully less heavy on client!*/   
 // main1.$("[required]")  <-- all required fields
    function get_parent_tab(obj) {                                              // function that finds the tab number a given element is in
        var prnt = obj.parentNode, i, tabs = [], index_found = -1;
        while (prnt.className.substr(0,9)!="tabbertab") prnt=prnt.parentNode;   // find the parent tab div
        var all_tabs = prnt.parentNode;                                         // the parent of it should be the div that holds ALL tabs
        for (i=0; i<all_tabs.children.length; i++) {                            // go over all the "children" of the div that holds all tabs..
            if (all_tabs.children[i].className.substr(0,9)=="tabbertab") {      // if a given child has "tabbertab" in it - its a tab..
                tabs.push(all_tabs.children[i]);                                // add it to an array of "tabs"
            }
        }
        for (i=0; i<tabs.length; i++) {                                         // now, go over the list of "tabs" we found ..
            if (tabs[i]==prnt) {                                                // find the tab that is the same as the tab of our input 
                 index_found = i;                                               // return the index of it
                 break;
            } 
        }
        return index_found;                                                     // return the index of the found tab
    }
 
    $("form").attr("novalidate",1);                                             // this will force to disable html5 validation
    $("form").submit(function(){                                                // <-- when user submits the form..
        if ($("[required]").length) {                                           // if we have fields with "required" attribute ..
            for (i=0; i<$("[required]").length; i++) {                          // go over them ..
                var el = $("[required]")[i];                                    // for every "required" input ..
                parent_tab_num = get_parent_tab(el);                            // find the tab number it is in (required for moving tabs)
                if (!el.value) {                                                // if our "required" element has no vale in it ..
                    $("li")[parent_tab_num].children[0].click();                // use the found tab number to simulate a "click" on its "li"
                    el.focus();                                                 // put focus on our "required" element
                    alert("עליך להכניס ערך / לבחור עבור שדה זה");                   // give alert message
                    return false;
                }
            }
        }
    });
 
    $(document).ready(function(){
        var indexon=0;
        $( 'textarea.editor').each(function() {
            indexon++;
            var editor = $(this);
            $(this).timer = setTimeout(function(){
                CKEDITOR.replace( editor.attr('name') ,{
							basicEntities : false,
                            <?php if($gui->getDir()=="rtl"){?>
                            language: 'he'
                            <?php }else{?>
                            language: 'en'
                            <?php }?>		
                                    }); 
            }, indexon*3000);
        });
    });

</script>
<?php }?>

<?php /*check if need to add connected pages tab fields tab*/

if($row["Secondary_Page_Type"]>0){
	$original_page_type=$row['Page_Type'];
	$row['Page_Type']=$row["Secondary_Page_Type"];
}

$isConnected = $db->getRow("SELECT connected_Page_Types FROM wm_pagetype WHERE ID =".$row['Page_Type']);

if($isConnected['connected_Page_Types'] != ''){//show tab and display connect options
	$arrConnectedTypes = explode(',', $isConnected['connected_Page_Types']);

	?>
<div class="tabbertab">
	<h3><?php echo $text["connected page types"];?></h3>
		<input type="text" id="txtSearchConnected" name="txtSearchConnected" autocomplete="off" style="width: 200px;" onkeyup="searchConnectedPages();document.getElementById('search_suggest_connected').style.display='none';" />
		<input type="button" name="search" value="<?php echo $text["Search"];?>" onclick="searchConnectedPages();document.getElementById('search_suggest_connected').style.display='none';" />
		<br />
		<div id="search_suggest_connected" style="padding: 0px; margin: 0px; margin-right: 23px;"></div>
                
		<?php /* this is probably not needed
            <input type="hidden" name="Parent" value="<?php echo $row["Parent"];?>" />
            */
        ?>
                <div id="connected">
                    
                </div>

        <div style="position: absolute;z-index: 200;background: #fff;width: 97%;" id="connectedPagesSearch"></div>

		
                
        <div style="position: absolute;z-index: 2;<?php // height: 600px;?>width: 97%;overflow-y: scroll;">
        <?php
        echo "<u style='line-height: 30px;'>דפים שכבר מחוברים</u><br />";
        
	foreach ($arrConnectedTypes as $key => $value) {/*display connected pages categories*/
		//$pageTypeName = $db->getRow("SELECT Name FROM wm_pagetype WHERE ID=".$value[$key]);
                $orgDivId = $key;
                echo "<div id='connected$key' style='display: none;border: 1px solid;padding: 10px;margin-bottom: 10px;max-height: 350px;overflow-y: auto;'>";
		$pageType = $db->getRow("SELECT Name, ID FROM wm_pagetype WHERE ID=".$value);

		echo $pageType['Name'].'<br />';
		echo '---------------'.'<br />';
                $isShown=0;
                /*new faster code*/
		$arrWmPages = $db->getArray("SELECT wm_pages.Name, wm_pages.ID ,wm_pages.Email FROM wm_pages 
                                  INNER JOIN wm_connected_pages_ids ON wm_connected_pages_ids.wm_connected_wm_pages_ids = wm_pages.ID 
                                 WHERE Page_Type =".$pageType['ID']." AND (wm_connected_pages_ids.wm_pages = ".$id.")");
		
		foreach ($arrWmPages as $key => $page) {/*display connected pages*/
                        /*$isChecked = $db->getRow("SELECT ID FROM wm_connected_pages_ids WHERE wm_connected_wm_pages_ids=".$page['ID']." AND wm_pages=".$id);
                        if(count($isChecked) > 0){*/
                            if($isShown==0){
                                echo "<style>#connected$orgDivId{display: block !important;}</style>";
                                $isShown = 1;
                            }
                            
                            ?><input type="checkbox" checked="checked" name="connectedPages[]" value="<?php echo $page['ID']?>"/><?php echo $page['Name'];?><br />
                        <?php /*}*/
                        /*new faster code*/
                }
                echo "</div>";
        	
	}
        
	?>
        </div>

</div>
<?php }?>
<div class="tabbertab">
	<h3><?php echo $text["Connected Ordering"];?></h3>
	<?php
        /*first get the pagetypes this page is connected to*/
        $pageTypesConnected = $db->getArray("SELECT DISTINCT wm_connected_page_type, Name
                                             FROM wm_connected_pages_ids
                                             INNER JOIN wm_pagetype ON wm_pagetype.ID = wm_connected_pages_ids.wm_connected_page_type
                                             WHERE wm_pages=".$id);?>
        <script type="text/javascript">
        // When the document is ready set up our sortable with it's inherant function(s)
        $(document).ready(function() {
			<?php foreach ($pageTypesConnected as $key => $value) {?>
            $(".test-list<?php echo $key?>").sortable({
				handle : '.handle',
				update : function () {
					var order = $(".test-list<?php echo $key?>").sortable('serialize');
					var sentFromPageID = <?php echo $id?>;
                        $("#info").load("../../manage/interface/tree_operations/order_jquery_connected_pages.php?",{listItem:order,sentFromPageID:sentFromPageID});
                        //alert(order);
					}
				});
				<?php }?>
			});
			</script>

        <?php
         foreach ($pageTypesConnected as $key => $pageType) {?>
                <div onclick="jQuery('.listItemsScroller').hide();jQuery('#listItemsScroller<?php echo $key;?>').show();" style="float: right;border: 1px solid;margin-right: 5px;cursor: pointer;"><?php echo $pageType['Name']?></div>
				<?php }
        /*now display unique tab for each pagetype connected*/
        foreach ($pageTypesConnected as $key => $pageType) {?>
      
            <?php
        
        $arr_tree = $db->getArray("SELECT wm_pages.ID as ID ,wm_pages.Name as Name, Menu_Name, icon,wm_connected_pages_ids.Ordering as ordd FROM wm_connected_pages_ids
                                   INNER JOIN wm_pages
                                   ON wm_pages.ID = wm_connected_pages_ids.wm_connected_wm_pages_ids
                                   INNER JOIN wm_pagetype
                                   ON wm_pages.Page_Type = wm_pagetype.ID
                                   WHERE wm_pages =".$id."
                                   AND wm_pagetype.ID = ".$pageType['wm_connected_page_type']
                                   ." ORDER BY wm_connected_pages_ids.Ordering asc");
        
       ?>
      
<div class="listItemsScroller" id="listItemsScroller<?php echo $key;?>" dir="ltr" style="<?php echo ($key > 0 ? 'display: none;' :'' )?>">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<div id="info"></div>
<ul id="test-list" dir="ltr" class="ui-sortable test-list<?php echo $key?>">
	<?php for($i=0;$i<count($arr_tree);$i++){?>
		<li Orderrr="<?php echo $arr_tree[$i]['ordd']?>" id="listItem_<?php echo $arr_tree[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>"><?php /*class="list_tr_<?php echo ($i%2==0?0:1);?>"*/?>
		
			<!--<img src="JS/sort/arrow.png" alt="move" width="16" height="16" class="handle" />-->
			<img class="handle" src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["txtSearch"]?"2":"0";?>.png" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />
		
		<div class="listItemContent">

			<div class="listItemPageType">
			<?php //echo $cfg["WM"]["Server"]."/".($arr_tree[$i]["Link"]?$arr_tree[$i]["Link"]:($arr_tree[$i]["Alias"]?$arr_tree[$i]["Alias"]:$arr_tree[$i]["ID"]));?>
			<?php $link=$wm->getLink($arr_tree[$i]);?>
				<a href="<?php echo $link["Link"];?>"  target="<?php echo $arr_tree[$i]["Link"]?"_blank":"_top";?>"><img src="<?php echo $cfg["WM"]["Server"]?>/manage/gui/images/icons/<?php echo $arr_tree[$i]["icon"];?>" alt="<?php echo $arr_tree[$i]["PageTypeName"];?>" border="0" /></a>
			</div>

			<div class="listItemText" dir="<?php echo $gui->getDir();?>" style="width: 300px;">
				<?php
                                if($arr_tree[$i]["Menu_Name"] == ''){
                                    //$arr_tree[$i]["Menu_Name"] = $arr_tree[$i]["Name"];
                                }
                                if($wm->getProperty($arr_tree[$i]["ID"], "Admin_Enable_Children")){?>
					<a href="index.php?show=pages/pages&id=<?php echo $arr_tree[$i]["ID"];?>"><strong><?php echo $string->shorten($arr_tree[$i]["Menu_Name"], 50);?></strong></a>
				<?php }else{?>
					<?php echo $string->shorten($arr_tree[$i]["Menu_Name"], 50);?>
				<?php }?>
				<div>
					<?php 
						if($arr_tree[$i]["Start_Date"]){
							list($y,$m,$d)=explode("-", $arr_tree[$i]["Start_Date"]);
							$startDate=$d."/".$m."/".$y;
							echo $startDate."&nbsp;&nbsp;";
						}?>

				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
		</li>
	<?php }?>
</ul>
<div class="listItemLast"></div>
</div>
</div>
        <?php }
        	if($row["Secondary_Page_Type"]>0){
				$row['Page_Type']=$original_page_type;
			}


        ?>   
        
</div>

        

<?php if($params->getValue("store_enable")){?>
<div class="tabbertab">
	<h3><?php echo $text["Store"];?></h3>
	<br />
	<h4><?php echo $text["Price"];?></h4>
	<input type="text" name="price" value="<?php echo $row["price"];?>">
	
	<h4><?php echo $text["Quantity"];?></h4>
	<input type="text" name="quantity" value="<?php echo $row["quantity"];?>">
</div>
<?php }?>




<div class="tabbertab">
	<h3><?php echo $trans->getText("schema_markup_title"); ?></h3>
	<h4><?php echo $trans->getText("schema_markup_title"); ?></h4>

	<div class="notice" id="aliasAlert"><?php echo $trans->getText("schema_markup_description"); ?><a href="https://search.google.com/structured-data/testing-tool" target="_blank"><?php echo $trans->getText("Here"); ?></a></div>

	<div class="schemaMarkup">
		<textarea name="schema_markup" class="schemaMarkupTextArea"><?php echo $row["schema_markup"];?></textarea>
    </div>
</div>


</div>




<div class="submitBtns" style="position: fixed; bottom: 10px; width: 760px; text-align: left; margin-top: 5px; margin-<?php echo $gui->getLeft();?>: 16px;">
	<input class="adminButton" type="submit" name="submit" value="<?php echo $text["Update"];?>" style="float: right;" />
	<input class="adminButton" type="submit" name="submitDisplay" value="<?php echo $text["Update And Display"];?>" style="float: right; margin-right: 5px;" />
	<input class="adminButton" type="submit" name="preview" value="<?php echo $text["Preview"];?>" style="float: right;" />
	<input class="adminButton" type="submit" name="submitReturn" value="<?php echo $text["Update And Return"];?>" style="float: left; margin-left: 1px;" />
	<div style="clear: both;"></div>
</div>





<script language="javascript" type="text/javascript">
<!--
//SET_DHTML("editPageForm");
//dd.elements.newPageForm.hide('editPageForm');
//-->
</script>
</form>
<br />

</div>
