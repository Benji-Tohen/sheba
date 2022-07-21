<?php
set_time_limit(0);

require_once('../../classes/file/class.file.php');
require_once(dirname(__FILE__).'/../../../classes/thumb/phpthumb.class.php');

$id=$_REQUEST["id"];
$page_id=$_REQUEST["page_id"];
$gallery_id=$_REQUEST["gallery_id"];

$update_table="wm_pages_gallery";

$content_update=new ContentUpdater($db, $update_table);
$file=new File();

/*
$row_picture=$content_update->getValues($id);

$gallery_id=$row_picture['wm_gallery_id'];
*/
if($gallery_id){
	$galleryRow = $db->getRow('SELECT * FROM wm_galleries WHERE ID = '.intval($gallery_id));
} else {
	$galleryRow = [];
}


if($_POST){
	// Delete Desktop Image
	if($id && isset($_POST["delete_desktop_image"]) && $_POST["current_desktop_image"]){
		// Delete File
		$pathToImage = $_SERVER["DOCUMENT_ROOT"]."/".$_POST["current_desktop_image"];
		$pathToThumb = $pathToImage."_thumb.";
		unlink($pathToImage);
		unlink($pathToThumb);

		// Delete From DB
		$arrFields=array(
	        "File_Name" => ""
		);
		$new_id=$content_update->update($id, $arrFields);

		if($gallery_id){
			header("location: index.php?show=gallery/gallery_pictures&gallery_id=".$gallery_id);
		} else {
			header("location: index.php?show=gallery/gallery_pictures&page_id=".$page_id);
		}
		
		exit;
	}

	// Delete Mobile Image
	if($id && isset($_POST["delete_mobile_image"]) && $_POST["current_mobile_image"]){
		// Delete File
		$pathToImage = $_SERVER["DOCUMENT_ROOT"]."/".$_POST["current_mobile_image"];
		$pathToThumb = $pathToImage."_thumb.";
		unlink($pathToImage);
		unlink($pathToThumb);

		// Delete From DB
		$arrFields=array(
	        "File_Name_Mobile" => ""
		);
		$new_id=$content_update->update($id, $arrFields);
		
		if($gallery_id){
			header("location: index.php?show=gallery/gallery_pictures&gallery_id=".$gallery_id);
		} else {
			header("location: index.php?show=gallery/gallery_pictures&page_id=".$page_id);
		}
		exit;
	}


	list($filenme, $ext)=explode(".", $_FILES['user_file']['name']);

	if($ext=="zip"){
		if($gallery_id){
			$tmp_folder=$cfg["WM"]["File_Uploades_Folder"]."/tmp/extracted_".$gallery_id;	
		} else {
			$tmp_folder=$cfg["WM"]["File_Uploades_Folder"]."/tmp/extracted_".$page_id;
		}
		$tmp_folder_full="../../".$tmp_folder;

		if(is_dir($tmp_folder_full)){
			$file->rm_rf($tmp_folder_full);
		}

		if(!is_dir($tmp_folder_full)){
			mkdir($tmp_folder_full);
		}
		chmod($tmp_folder, 0777);
//		$systemStr=exec("unzip ".$_FILES['user_file']['tmp_name']." -d ".$tmp_folder_full, $result);

		$zip = new ZipArchive;
		$zip->open($_FILES['user_file']['tmp_name']);
		$zip->extractTo($tmp_folder_full); 
   		$zip->close(); 
		
		$handle = opendir($tmp_folder_full);
		while (false !== ($fileName = readdir($handle))){
			if($fileName=="." || $fileName==".."){continue;}
			$arrFields=array(
				"Parent"			=>	0,
				"WM_Pages"			=>	$page_id,
				"wm_gallery_id"		=>  $gallery_id,
				"Name"				=>	"",
				"File_Name"			=>	$file_path.$fileName
			);
			$new_id=$content_update->update(NULL, $arrFields);
			
			if($gallery_id){
				$file_path=$cfg["WM"]["File_Uploades_Folder"]."/Gallery/global/".$gallery_id."/";
			} else {
				$file_path=$cfg["WM"]["File_Uploades_Folder"]."/Gallery/".$page_id."/".$new_id."/";
			}
			$full_file_path="../../".$file_path;
			
			$file->checkPath($full_file_path);
		
			$content_update->update($new_id, array("File_Name"=>$file_path.$fileName));

			copy($tmp_folder_full."/".$fileName, $full_file_path.$fileName);
			
			chmod($tmp_folder_full."/".$fileName, 0777);
			chmod($full_file_path, 0777);
			chmod($full_file_path.$fileName, 0777);




			list($fileNameOnly, $ext)=explode("[.]", $fileName);
			$thumb_name=$fileNameOnly."_thumb.".$ext;



			/*	Resize Image and Generate Thumb	*/
			/*
			if(file_exists($full_file_path.$fileName)){
			   
			   $phpThumb = new phpThumb();

			   copy($full_file_path.$fileName, $full_file_path."tmp_".$fileName);
			   chmod($full_file_path."tmp_".$fileName, 0777);

				//	Resize Image
			   $phpThumb->setSourceFilename($full_file_path.$fileName); 

               $phpThumb->setParameter('w', 2000);
               $phpThumb->setParameter('h', 2000);

			   $outputFilename = $full_file_path.$fileName;


			    if ($phpThumb->GenerateThumbnail()) { 
				if ($phpThumb->RenderToFile($outputFilename)) { 
					chmod($outputFilename, 0777);
					//echo "<img src=\"".$outputFilename."\" />";	
				   // do something on success
				} else {
				   //failed
					echo "Error generation thumb";
					exit;
				}
			    } else {
				// failed
				echo "Error generation thumb 1";
				exit;
			    }
			    unlink($full_file_path."tmp_".$fileName);
			}
			*/

			
    		}
		closedir($handle);

		

		$file->rm_rf($tmp_folder_full);

		if($gallery_id){
			header("location: index.php?show=gallery/gallery_pictures&gallery_id=".$gallery_id);
		} else {
			header("location: index.php?show=gallery/gallery_pictures&page_id=".$page_id);
		}
		exit;	
	}

	$check_inputs = array(
		array("number"      => $gallery_id ? $gallery_id : $page_id),
		array("string255"   => $_POST["Name"]),
		array("text"        => $_POST["Content"]),
		array("string255"   => $_POST["Code"])
	);
	
	$secureTexts = new secure_inputs();
	$error = $secureTexts->isNotSecure($check_inputs);
	if (!$error) {
		$arrFields=array(
				"Parent"			=>	0,
				"wm_pages"			=>	$page_id,
				"wm_gallery_id"		=>	$gallery_id,
				"Name"				=>	$_POST["Name"],
				"Content"			=>	$_POST["Content"],
				"Code"				=>	$_POST["Code"],
				"Name_btn"          => 	$_POST["Name_btn"],
				"Contant2"			=>	$_POST["Contant2"]
		);

		if(!$id){
				if($gallery_id){
					$query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table." WHERE gallery_id=".$_POST["gallery_id"];
				} else {
					$query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table." WHERE WM_Pages=".$_POST["page_id"];
				}
				$max_ordering=$db->getField($query, "max_ordering");

				$ordering=$max_ordering+1;

				$arrFields["Ordering"]=$ordering;
		}

		
		$new_id=$content_update->update($id, $arrFields);

		if(!$id){
				$log->write("Picture added: ".($_FILES['user_file']['name']?"'".$_FILES['user_file']['name']."'":"")." for page '".$wm->get($id, "Name")."'", "picture_add");
				$id=$new_id;
		}
		$log->write("Picture edited: ".($_FILES['user_file']['name']?"'".$_FILES['user_file']['name']."'":"")." for page '".$wm->get($id, "Name")."'", "picture_edit");

		if($gallery_id){
			$file_path=$cfg["WM"]["File_Uploades_Folder"]."/Gallery/global/".$gallery_id."/";
		} else {
			$file_path=$cfg["WM"]["File_Uploades_Folder"]."/Gallery/".$page_id."/".$id."/";
		}
		$full_file_path="../../".$file_path; 


		$file->checkPath($full_file_path);

		if(is_uploaded_file($_FILES['user_file']['tmp_name'])){
				$file_name=$_FILES['user_file']['name'];
				$extension = end(explode(".", $file_name));
				$extension = $extension ? ".".$extension : "";
				$file_name=md5(time()).$extension;

				list($fileNameOnly, $ext)=explode("[.]", $file_name);
				$thumb_name=$fileNameOnly."_thumb.".$ext;

				$content_update->update($id, array("File_Name"=>$file_path.$file_name));
				move_uploaded_file($_FILES['user_file']['tmp_name'], $full_file_path.$file_name);

				chmod($full_file_path, 0777);
				chmod($full_file_path.$file_name, 0777);



				/* Generate Thumb*/
				/*
				if(file_exists($full_file_path.$file_name) && $extension != '.mp4'){

					$phpThumb = new phpThumb();

					copy($full_file_path.$file_name, $full_file_path."tmp_".$file_name);
					chmod($full_file_path."tmp_".$file_name, 0777);

						
					$phpThumb->setSourceFilename($full_file_path.$file_name); 

					$phpThumb->setParameter('w', 2000);
					$phpThumb->setParameter('h', 2000);
					$outputFilename = $full_file_path.$file_name;


						//	Generate Thumb
					$phpThumb = new phpThumb();
					$phpThumb->setSourceFilename($full_file_path."tmp_".$file_name); 
					$phpThumb->setParameter('w', $_POST["width"]);
					$phpThumb->setParameter('h', $_POST["height"]);
					$phpThumb->setParameter('zc', 1);
					$outputFilename = $full_file_path.$thumb_name;


					if ($phpThumb->GenerateThumbnail()) { 
						if ($phpThumb->RenderToFile($outputFilename)) { 
								chmod($outputFilename, 0777);
								//echo "<img src=\"".$outputFilename."\" />";	
							// do something on success
						} else {
							//failed
								echo "Error generation thumb";
								exit;
						}
					} else {
						// failed
						echo "Error generation thumb 1";
						exit;
					}

					unlink($full_file_path."tmp_".$file_name);
				}
				*/
		}


		// Mobile Image
		if(isset($_FILES['File_Name_Mobile']['name']) && $_FILES['File_Name_Mobile']['name']){
			list($filenme, $ext)=explode(".", $_FILES['File_Name_Mobile']['name']);
		}
		if(is_uploaded_file($_FILES['File_Name_Mobile']['tmp_name'])){
			//$file_name=$_FILES['user_file']['name'];
			//O.G: Added _mobile so it will not have the same name as desktop image
			$file_name=md5(time())."_mobile.".$ext;
			
			list($fileNameOnly, $ext)=explode("[.]", $file_name);
			$thumb_name=$fileNameOnly."_thumb.".$ext;

			$content_update->update($id, array("File_Name_Mobile"=>$file_path.$file_name));

			/* CHECK IF FILE IS MORE THEN X */
			$filesize = filesize($_FILES['File_Name_Mobile']['tmp_name']);
			if($filesize > 5000000){
			// if($filesize > 50000000){
				die("THE FILE YOU UPLOADED IS MORE THEN 5MB. PLEASE UPLOAD LESS THEN 50MB.");
			} else {
				move_uploaded_file($_FILES['File_Name_Mobile']['tmp_name'], $full_file_path.$file_name);
				chmod($full_file_path, 0777);
				chmod($full_file_path.$file_name, 0777);
			}

			/*	Resize Image and Generate Thumb	*/
			if(file_exists($full_file_path.$file_name) && strpos($file_name,'.mp4') === false){
				
				$phpThumb = new phpThumb();

				copy($full_file_path.$file_name, $full_file_path."tmp_".$file_name);
				chmod($full_file_path."tmp_".$file_name, 0777);

				//	Resize Image
				$phpThumb->setSourceFilename($full_file_path.$file_name); 
				/*$phpThumb->setParameter('w', $params->getValue("gallery_image_width"));
				$phpThumb->setParameter('h', $params->getValue("gallery_image_height"));*/

				$phpThumb->setParameter('w', 2000);
				$phpThumb->setParameter('h', 2000);
				$outputFilename = $full_file_path.$file_name;


				if ($phpThumb->GenerateThumbnail()) { 
				if ($phpThumb->RenderToFile($outputFilename)) { 
					chmod($outputFilename, 0777);
					//echo "<img src=\"".$outputFilename."\" />";	
					// do something on success
				} else {
					//failed
					//echo "Error generation thumb";
					exit;
				}
				} else {
				// failed
				echo "Error generation thumb 1";
				exit;
				}

				//	Generate Thumb
				$phpThumb = new phpThumb();
				$phpThumb->setSourceFilename($full_file_path."tmp_".$file_name); 
				$phpThumb->setParameter('w', $_POST["width"]);
				$phpThumb->setParameter('h', $_POST["height"]);
				$phpThumb->setParameter('zc', 1);
				$outputFilename = $full_file_path.$thumb_name;


				if ($phpThumb->GenerateThumbnail()) { 
				if ($phpThumb->RenderToFile($outputFilename)) { 
					chmod($outputFilename, 0777);
					//echo "<img src=\"".$outputFilename."\" />";	
					// do something on success
				} else {
					//failed
					echo "Error generation thumb";
					exit;
				}
				} else {
				// failed
				echo "Error generation thumb 1";
				exit;
				}

				unlink($full_file_path."tmp_".$file_name);
			}
		}

		if($_POST["submit"]){
				if($gallery_id){
					header("location: index.php?show=gallery/gallery_pictures&gallery_id=".$gallery_id);
				} else {
					header("location: index.php?show=gallery/gallery_pictures&page_id=".$page_id);
				}
				exit;
		}elseif($_POST["SubmitAdd"]){
				$id=NULL;
		}elseif($_POST["submitDisplay"]){

		}
	}
}

if($id){
	$row_picture=$content_update->getValues($id);
}

if($page_id){
	$row_page=$wm->getValues($page_id);
	$gui=new Gui($row_page["Lang"]);
} else {
	$gui=new Gui('he');
}


?>
<?php require_once('common/header.php');?>
<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
<script language="javascript" type="text/javascript">
function chooseFile(filePath){
	document.edit.Code.value=filePath;
}
</script>
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
<?php require_once('common/body.php');?>

<?php if($_REQUEST["submitDisplay"]){
$pageAlias= $page_id ? $wm->get($page_id, "Alias") : 0;
if(!$pageAlias){
	$pageAlias=$page_id;
}
?>
<script language="javascript" type="text/javascript">
self.parent.location="<?php echo $cfg["WM"]["Server"]."/".$pageAlias."/";?>";
</script>
<?php }?>

<div class="navigator_line">
<?php 
	if($page_id){
		$wm_page_id=$page_id;
		require_once("pages/navigator.php");
	} else if($gallery_id){ ?>
		<a href="index.php?show=wm_galleries/index">
			<?php echo $trans->getText('Galleries');?>
		</a>
		&nbsp; / &nbsp;
		<span><?php echo $galleryRow['Name'];?></span>
		&nbsp; / &nbsp;
		<span><?php echo $row_picture["Name"];?></span>
	<?php }
?>
<?php /*
<a style="color: #ffffff;" href="index.php?page_id=<?php echo $page_id;?>&show=gallery/gallery_pictures"><?php echo $text["List"];?></a> / <?php echo $row_picture?$row_picture["Name"]:$text["Add Item"];?>
*/ ?>
</div>

<div class="editPagePadding" style="overflow: auto;height: 640px;border-bottom: 10px solid #c1c1c0;">
<div class="SecurityMessage"><?php echo $error;?></div>
<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="gallery/gallery_pictures_edit" />
<input type="hidden" name="id" value="<?php echo $row_picture["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<input type="hidden" name="gallery_id" value="<?php echo $gallery_id;?>" />


<input type="hidden" name="width" value="<?php echo $params->getValue("gallery_thumb_width");?>" />
<input type="hidden" name="height" value="<?php echo $params->getValue("gallery_thumb_height");?>" />
<table>		
	<?php if(isset($row_page["Page_Type"]) && $row_page["Page_Type"]==8){?>
	<tr>
		<td valign="top"><?php echo $text["Video"];?>:</td>
		<td><input type="text" name="Code" value="<?php echo $row_picture["Code"];?>" dir="ltr" /> <a style="color: #ffffff !important;" href="#" onclick="window.open('gallery/browse.php',
'Browser','menubar=0,resizable=1,width=350,height=250');"><?php echo $text["Choose"];?></a></td>		
	</tr>
	<?php }?>
	<tr>
		<td colspan="2">
		<?php if($row_picture["File_Name"] && file_exists("../../".$row_picture["File_Name"])){?>
            <?php if(strpos($row_picture['File_Name'], '.mp4') !== false){ ?>
                <?php echo $text['Video'];?>
            <?php } else { ?>
                <?php /* <a href="gallery/gallery_pictures_crop.php?id=<?php echo $id;?>&src=<?php echo $row_picture["File_Name"];?>" target="_blank" title="Click to crop the image"><img src="<?php echo $cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=300&amp;h=300&amp;src=../../".$row_picture["File_Name"];?>" /></a> */ ?>
                <a href="javascript:create_layer('/manage/gui/gallery/gallery_pictures_crop.php?id=<?php echo $id;?>&src=<?php echo $row_picture["File_Name"];?>',700,600)" title="Click to crop image"><img src="<?php echo $cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=200&amp;h=200&amp;src=../../".$row_picture["File_Name"];?>" /></a>
            <?php }?>
		<?php };?>
		</td>
	</tr>
	<?php if($row_picture["File_Name"]){?>
	<tr>
		<input type="hidden" name="current_desktop_image" value="<?php echo $row_picture["File_Name"];?>" />
		<td><button name="delete_desktop_image" onclick="return confirm('Are you sure you want to delete?');"><?php echo $text["Delete Desktop Image"];?></button></td>
	</tr>
	<?php }?>
	<!-- <tr>
		<td colspan="2">
		<?php if($row_page["Page_Type"]==9 && $row_picture["File_Name_1"] && file_exists("../../".$row_picture["File_Name_1"])){?>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="300" height="75" id="mp3_player" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="../../site/flash/mp3_player.swf?myMedia=http://www.orlanoar.com/<?php echo $row_picture["File_Name_1"];?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="../../site/flash/mp3_player.swf?myMedia=http://www.orlanoar.com/<?php echo $row_picture["File_Name_1"];?>" quality="high" bgcolor="#ffffff" width="300" height="75" id="mp3_player" name="mp3_player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>			
		<?php };?>
		</td>
	</tr> -->
	<tr>
		<td><?php echo $text["Image"];?>:</td>
		<td><input type="file" name="user_file" /></td>		
	</tr>
	<tr>
		<td colspan="2">
		<?php if($row_picture["File_Name_Mobile"] && file_exists("../../".$row_picture["File_Name_Mobile"])){?>
            <?php if(strpos($row_picture['File_Name_Mobile'], '.mp4') !== false){ ?>
                <?php echo $text['Video'];?>
            <?php } else { ?>
                <?php /* <img src="<?php echo $cfg["WM"]["Server"]."/webfiles/images/cache/300X300/zcX0/".$row_picture["File_Name"];?>" border="1" /> */?>
                <a href="javascript:create_layer('/manage/gui/gallery/gallery_pictures_crop.php?id=<?php echo $id;?>&column=Gallery&src=<?php echo $row_picture["File_Name_Mobile"];?>',700,600)" title="Click to crop image"><img src="<?php echo $cfg["WM"]["Server"]."/webfiles/images/cache/200X200/zcX1/".$row_picture["File_Name_Mobile"];?>" /></a>
            <?php }?>
		<?php };?>
		</td>
	</tr>
	<?php if($row_picture["File_Name_Mobile"]){?>
	<tr>
		<input type="hidden" name="current_mobile_image" value="<?php echo $row_picture["File_Name_Mobile"];?>" />
		<td><button name="delete_mobile_image" onclick="return confirm('Are you sure you want to delete?');"><?php echo $text["Delete Mobile Image"];?></button></td>
	</tr>
	<?php }?>
	<tr>
		<td><?php echo $text["Mobile_Image"];?>:</td>
		<td><input type="file" name="File_Name_Mobile" id="File_Name_Mobile" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_picture["Name"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Name_btn"];?>:</td>
		<td><input type="text" name="Name_btn" value="<?php echo $string->htmlentities($row_picture["Name_btn"]);?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Link"];?>:</td>
		<td><input type="text" name="Code" value="<?php echo $row_picture["Code"];?>" dir="ltr" /></td>		
	</tr>
	<tr>
		<td valign="top"><?php echo $text["Content"];?>:</td>
		<td><textarea name="Content" style="width: 220px; height: 100px;"><?php echo $row_picture["Content"];?></textarea></td>		
	</tr>
	<tr>
		<td valign="top"><?php echo $text["Contant2"];?>:</td>
		<td><textarea name="Contant2" style="width: 220px; height: 50px;"><?php echo $row_picture["Contant2"];?></textarea></td>		
	</tr>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>">

<div style="width: 300px; text-align: left; margin-top: 5px;">
	<input type="submit" name="submitDisplay" value="<?php echo $text["Update And Display"];?>" style="float: left;" />
	<input type="submit" name="submit" value="<?php echo $text["Update"];?>" style="float: right;" />
	<input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" style="float: right; margin-right: 5px;" />	
	
	
	<div style="clear: both;"></div>
</div>





</td>		
	</tr>		
</table>
</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
        $('input[type=submit]').bind('click', function(){
            $('input[type=submit]').val('<?php echo $text['processing'];?>');
        });
	});
</script>
