<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');


if($_REQUEST["template"]){
	$_SESSION["template"]=intval($_REQUEST["template"]);
}

if(!$_SESSION["template"]){
	$_SESSION["template"]=1;
}

$template=$_SESSION["template"];

$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);

if($_REQUEST["parent"]){
	$parent=$fileName=intval($_REQUEST["parent"]);
}else{
	$parent=	$fileName=$db->getField("SELECT Parent FROM wm_css_settings WHERE ID=".intval($id), "Parent");
}

$content_update=new ContentUpdater($db, $update_table);


if($_POST){
        $check_inputs = array(
                array("string255"		=>	$_POST["Name"]),
		array("number"			=>	$_SESSION["template"]),
		array("number"			=>	$_POST["parent"]),
		array("string255"		=>	$_POST["class_name"]),
		array("string255"		=>	$_POST["color"]),
		array("string255"               =>	$_POST["background_color"]),
		array("string255"     		=>	$_POST["background_position"]),
		array("string255"               =>	$_POST["background_repeat"]),
		array("string255"               =>	$_POST["border"]),
		array("string255"		=>	$_POST["border_color"]),
		array("string255"		=>	$_POST["font_size"]),
		array("string255"		=>	$_POST["font_weight"]),
		array("string255"		=>	$_POST["width"]),
		array("string255"		=>	$_POST["height"]),
		array("string255"		=>	$_POST["margin_top"]),
		array("string255"		=>	$_POST["margin_bottom"]),
		array("string255"		=>	$_POST["margin_right"]),
		array("string255"		=>	$_POST["margin_left"]),
		array("string255"		=>	$_POST["padding_top"]),
		array("string255"               =>	$_POST["padding_bottom"]),
		array("string255"		=>	$_POST["padding_right"]),
		array("string255"		=>	$_POST["padding_left"]),
		array("string255"		=>	$_POST["display"]),
		array("string255"		=>	$_POST["abs_top"]),
		array("string255"		=>	$_POST["abs_bottom"]),
		array("string255"		=>	$_POST["abs_right"]),
		array("string255"		=>	$_POST["abs_left"]),
		array("text"                    =>	$_POST["more"])
        );

        $secureTexts = new secure_inputs();
        $error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {
        
            $arrFields=array(
                    "Name"				=>	$_POST["Name"],
                    "wm_template"			=>	$_SESSION["template"],
                    "Parent"			=>	$_POST["parent"],
                    "class_name"			=>	$_POST["class_name"],
                    "color"				=>	$_POST["color"],
                    "background_color"		=>	$_POST["background_color"],
                    "background_position"		=>	$_POST["background_position"],
                    "background_repeat"		=>	$_POST["background_repeat"],
                    "border"			=>	$_POST["border"],
                    "border_color"			=>	$_POST["border_color"],
                    "font_size"			=>	$_POST["font_size"],
                    "font_weight"			=>	$_POST["font_weight"],
                    "width"				=>	$_POST["width"],
                    "height"			=>	$_POST["height"],
                    "margin_top"			=>	$_POST["margin_top"],
                    "margin_bottom"			=>	$_POST["margin_bottom"],
                    "margin_right"			=>	$_POST["margin_right"],
                    "margin_left"			=>	$_POST["margin_left"],
                    "padding_top"			=>	$_POST["padding_top"],
                    "padding_bottom"		=>	$_POST["padding_bottom"],
                    "padding_right"			=>	$_POST["padding_right"],
                    "padding_left"			=>	$_POST["padding_left"],
                    "display"			=>	$_POST["display"],
                    "abs_top"			=>	$_POST["abs_top"],
                    "abs_bottom"			=>	$_POST["abs_bottom"],
                    "abs_right"			=>	$_POST["abs_right"],
                    "abs_left"			=>	$_POST["abs_left"],
                    "more"				=>	$_POST["more"]

            );

            if($_POST["delImage"]){
                    $fileName=$db->getField("SELECT File_Name FROM ".$update_table." WHERE ID=".intval($id), "File_Name");
                    //@unlink("../../".$fileName);
                    $arrFields["File_Name"]="";
            }

    /*
            if(!$id){
                    $query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table." WHERE WM_Pages=".$_POST["page_id"];
                    $max_ordering=$db->getField($query, "max_ordering");

                    $ordering=$max_ordering+1;

                    $arrFields["Ordering"]=$ordering;
            }
    */	

            $new_id=$content_update->update($id, $arrFields);

            if(!$id){
                    $id=$new_id;
            }




            if(is_uploaded_file($_FILES['user_file']['tmp_name'])){
                    $file_path="webfiles/".$folderName."/".$id."/";
                    $full_file_path="../../".$file_path; 
                    @chmod($full_file_path, 0777);

                    $file=new File();
                    $file->checkPath($full_file_path);

                    $file_name=str_replace(" ", "_", $_FILES['user_file']['name']);

                    $content_update->update($id, array("File_Name"=>$file_path.$file_name));
                    move_uploaded_file($_FILES['user_file']['tmp_name'], $full_file_path.$file_name);
                    @chmod($full_file_path.$file_name, 0777);
            }



            // overriding styles
            $css_q='select * from wm_css_settings WHERE wm_template='.$template.' ORDER BY Ordering';
            $css_array = $db->getArray($css_q);
            $str_css="";


            foreach($css_array as $style){
                    if(!$style["class_name"]){
                            continue;
                    }

                    $str_css.="\r\n".$style["class_name"]."{";
                    if($style["color"]){
                            $str_css.="\r\n\tcolor: ".$style["color"]." !important;";
                    }

                    if($style["background_color"]){
                            list($filename, $ext)=explode("[.]", $style["background_color"]);

                            if($ext=="png"){
                                    $str_css.="\r\n\tbackground-image: url(".$cfg["WM"]["Server"]."/site/images/".$style["background_color"].");";
                            }else{


                                            list($firstColor, $secondColor)=explode(",", $style["background_color"]);
                                    if($secondColor){
                                            $str_css.="\r\n\t

    background-color: $firstColor;
    /*
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$firstColor', endColorstr='$secondColor');  for IE 
    */

    background-image: linear-gradient(top, $firstColor 20%, $secondColor 80%);
    background-image: -o-linear-gradient(top, $firstColor 20%, $secondColor 80%);
    background-image: -moz-linear-gradient(top, $firstColor 20%, $secondColor 80%);
    background-image: -webkit-linear-gradient(top, $firstColor 20%, $secondColor 80%);
    background-image: -ms-linear-gradient(top, $firstColor 20%, $secondColor 80%);

    background-image: -webkit-gradient(
            linear,
            left top,
            left bottom,
            color-stop(0.20, $firstColor),
            color-stop(0.80, $secondColor)
    );
                                            ";
                                    }else{
                                            $str_css.="\r\n\tbackground-color: ".$style["background_color"].";";

                                    }

                            }
                    }

                    if($style["File_Name"]){
                            $str_css.="\r\n\tbackground: url(".$cfg["WM"]["Server"]."/".$style["File_Name"].");";
                    }

                    if($style["background_position"]){
                            $str_css.="\r\n\tbackground-position: ".$style["background_position"].";";
                    }

                    if($style["background_repeat"]){
                            $str_css.="\r\n\tbackground-repeat: ".$style["background_repeat"].";";
                    }

                    if($style["border"]){
                            $str_css.="\r\n\tborder: ".$style["border"]." solid;";
                    }
                    if($style["border_color"]){
                            $str_css.="\r\n\tborder-color: ".$style["border_color"].";";
                    }
                    if($style["font_size"]){
                            $str_css.="\r\n\tfont-size: ".$style["font_size"]." !important;";
                    }
                    if($style["font_weight"]){
                            $str_css.="\r\n\tfont-weight: ".$style["font_weight"].";";
                    }
                    if($style["width"]){
                            $str_css.="\r\n\twidth: ".$style["width"].";";
                    }
                    if($style["height"]){
                            $str_css.="\r\n\theight: ".$style["height"].";";
                    }


                    if($style["margin_top"]){
                            $str_css.="\r\n\tmargin-top: ".$style["margin_top"].";";
                    }

                    if($style["margin_bottom"]){
                            $str_css.="\r\n\tmargin-bottom: ".$style["margin_bottom"].";";
                    }

                    if($style["margin_right"]){
                            $str_css.="\r\n\tmargin-right: ".$style["margin_right"].";";
                    }

                    if($style["margin_left"]){
                            $str_css.="\r\n\tmargin-left: ".$style["margin_left"].";";
                    }

                    if($style["padding_top"]){
                            $str_css.="\r\n\tpadding-top: ".$style["padding_top"].";";
                    }

                    if($style["padding_bottom"]){
                            $str_css.="\r\n\tpadding-bottom: ".$style["padding_bottom"].";";
                    }

                    if($style["padding_right"]){
                            $str_css.="\r\n\tpadding-right: ".$style["padding_right"].";";
                    }

                    if($style["padding_left"]){
                            $str_css.="\r\n\tpadding-left: ".$style["padding_left"].";";
                    }

                    if($style["display"]){
                            $str_css.="\r\n\tdisplay: ".$style["display"].";";
                    }

                    if($style["abs_top"]){
                            $str_css.="\r\n\ttop: ".$style["abs_top"].";";
                    }

                    if($style["abs_bottom"]){
                            $str_css.="\r\n\tbottom: ".$style["abs_bottom"].";";
                    }

                    if($style["abs_right"]){
                            $str_css.="\r\n\tright: ".$style["abs_right"].";";
                    }

                    if($style["abs_left"]){
                            $str_css.="\r\n\tleft: ".$style["abs_left"].";";
                    }

                    if($style["more"]){
                            $str_css.="\r\n\t".$style["more"];
                    }

                    $str_css.="\r\n}\r\n";	
            //	echo $css_row[$css_i]['Name'].'{color: '.$css_row[$css_i]['Color'].' !important;}';
            //	echo $css_row[$css_i]['Name'].' a,'.$css_row[$css_i]['Name'].' a:hover,'.$css_row['Name'].' a:visited,'.$css_row[$css_i]['Name'].' a:active{color: '.$css_row[$css_i]['Color'].' !important;}';
            }



            $templateFolder=$db->getField("SELECT Value FROM wm_template WHERE ID=".$template, "Value");

            $fp = fopen('../../webfiles/css/dynamic_'.$templateFolder.'.css', 'w');

            fwrite($fp, $str_css);
            fclose($fp);

            if(!$_POST["SubmitAdd"]){
                    if(!$parent){
                            $parent=$_POST["Parent"];
                    }
                    header("location: index.php?show=".$folderName."/index&page_id=".$page_id."&parent=".$parent);
                    exit;
            }else{
                    $id=NULL;
            }
         }
}

if($id && $id>0){
	$row_item=$content_update->getValues($id);	
}else{
	$row_item["Parent"]=$parent;
}


$gui=new Gui("he");
?>
<?php require_once('common/header.php');?>
<script language="javascript" type="text/javascript">
function chooseFile(filePath){
	document.edit.Code.value=filePath;
}
</script>
<?php require_once('common/body.php');?>
<div class="navigator_line">

<a href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a>
<?php if($row_item["Parent"]){echo " -> ".$db->getField("SELECT Name FROM ".$update_table." WHERE ID=".$row_item["Parent"], "Name");
}?>
 -> <?php echo $row_item?$row_item["Name"]:$text["Add Item"];?> 
</div>

<div class="editPagePadding">
<div class="SecurityMessage"><?php echo $error;?></div>

<form action="index.php" name="edit" method="post" enctype="multipart/form-data" style="height: 650px; overflow: auto; padding-right: 20px;">

<div style="position: absolute; left: 20px;">
		<?php if($row_item["File_Name"] && file_exists("../../".$row_item["File_Name"])){?>
			
<?php 
$fileNameArr=$row_item["File_Name"];
list($name, $ext)=explode("[.]", $fileNameArr);
?>
<?php if($ext=="swf"){?>
<object width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"><param name="movie" value="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>"></param><param name="wmode" value="transparent"></param><embed src="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>" type="application/x-shockwave-flash" wmode="transparent" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"></embed></object>
<?php }elseif($row_item["File_Name"]){?>			
<img src="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>" style="max-width: 400px;" />
<?php }?>

		<input type="checkbox" name="delImage" value="1" /> <?php echo $text["Delete"];?>
		<?php };?>
</div>

<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_item["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<!--<input type="hidden" name="parent" value="<?php echo $parent;?>" />-->
<table>		
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_item["Name"];?>" /></td>		
	</tr>

	<tr>
		<td><?php echo $text["Parent"];?>:</td>
		<td>
			<select name="parent" id="parent">
				<option value="0">ROOT</option>
				<?php
				$parents_array = $db->getArray("SELECT ID, Name FROM wm_css_settings where Parent='0' AND wm_template=".$template." ORDER BY Ordering");
				foreach($parents_array as $item){
					echo "<option value='".$item['ID']."'";
					if ($parent == $item['ID']) echo " selected";
					echo ">".$item['Name']."</option>";
				}
				?>
			</select>
		</td>		
	</tr>

<?php if($row_item["Parent"]>0){?>
	<tr>
		<td>שם מחלקה:</td>
		<td><input type="text" name="class_name" dir="ltr" value="<?php echo $row_item["class_name"];?>" /></td>		
	</tr>
	<tr>
		<td valign="top">צבע טקסט:</td>
		<td><input type="text" name="color" dir="ltr" value="<?php echo $row_item["color"];?>" /></td>		
	</tr>
	<tr>
		<td valign="top">צבע רקע:</td>
		<td><input type="text" name="background_color" dir="ltr" value="<?php echo $row_item["background_color"];?>" /></td>		
	</tr>
	<tr>
		<td valign="top">מסגרת:</td>
		<td><input type="text" name="border" dir="ltr" value="<?php echo $row_item["border"];?>" /></td>		
	</tr>
	<tr>
		<td valign="top">צבע מסגרת:</td>
		<td><input type="text" name="border_color" dir="ltr" value="<?php echo $row_item["border_color"];?>" /></td>		
	</tr>
	<tr>
		<td>גודל טקסט:</td>
		<td><input type="text" name="font_size" dir="ltr" value="<?php echo $row_item["font_size"];?>" /></td>		
	</tr>
	<tr>
		<td>סטייל טקסט:</td>
		<td>
			<select name="font_weight">
				<option value=""></option>
				<option value="normal"	<?php echo $row_item["font_weight"]=="normal"?"selected":"";?>>Normal</option>
				<option value="bold"	<?php echo $row_item["font_weight"]=="bold"?"selected":"";?>>Bold</option>
			</select>		
		</td>		
	</tr>
	<tr>
		<td>רוחב:</td>
		<td><input type="text" name="width" dir="ltr" value="<?php echo $row_item["width"];?>" /></td>		
	</tr>
	<tr>
		<td>גובה:</td>
		<td><input type="text" name="height" dir="ltr" value="<?php echo $row_item["height"];?>" /></td>		
	</tr>


	<tr>
		<td>רווח עליון:</td>
		<td><input type="text" name="margin_top" dir="ltr" value="<?php echo $row_item["margin_top"];?>" /></td>		
	</tr>
	<tr>
		<td>רווח תחתון:</td>
		<td><input type="text" name="margin_bottom" dir="ltr" value="<?php echo $row_item["margin_bottom"];?>" /></td>		
	</tr>




	<tr>
		<td>רווח ימין:</td>
		<td><input type="text" name="margin_right" dir="ltr" value="<?php echo $row_item["margin_right"];?>" /></td>		
	</tr>
	<tr>
		<td>רווח שמאל:</td>
		<td><input type="text" name="margin_left" dir="ltr" value="<?php echo $row_item["margin_left"];?>" /></td>		
	</tr>


	<tr>
		<td>דיפון עליון:</td>
		<td><input type="text" name="padding_top" dir="ltr" value="<?php echo $row_item["padding_top"];?>" /></td>		
	</tr>
	<tr>
		<td>דיפון תחתון:</td>
		<td><input type="text" name="padding_bottom" dir="ltr" value="<?php echo $row_item["padding_bottom"];?>" /></td>		
	</tr>




	<tr>
		<td>דיפון ימין:</td>
		<td><input type="text" name="padding_right" dir="ltr" value="<?php echo $row_item["padding_right"];?>" /></td>		
	</tr>
	<tr>
		<td>דיפון שמאל:</td>
		<td><input type="text" name="padding_left" dir="ltr" value="<?php echo $row_item["padding_left"];?>" /></td>		
	</tr>


	<tr>
		<td valign="top">קובץ רקע:</td>
		<td><input type="file" name="user_file" /></td>		
	</tr>
	<tr>
		<td>מחזוריות הרקע:</td>
		<td>
			<select name="background_repeat">
				<option value="">ללא</option>
				<option value="no-repeat" 	<?php echo $row_item["background_repeat"]=="no-repeat"?"selected":"";?>>אל תחזור</option>
				<option value="repeat" 		<?php echo $row_item["background_repeat"]=="repeat"?"selected":"";?>>חזור</option>
				<option value="repeat-x" 	<?php echo $row_item["background_repeat"]=="repeat-x"?"selected":"";?>>חזור על ציר X</option>
				<option value="repeat-y" 	<?php echo $row_item["background_repeat"]=="repeat-y"?"selected":"";?>>חזור על ציר Y</option>				
			</select>
		</td>		
	</tr>
	<tr>
		<td>מיקום הרקע:</td>
		<td><input type="text" name="background_position" dir="ltr" value="<?php echo $row_item["background_position"];?>" /></td>		
	</tr>

	<tr>
		<td>הצג:</td>
		<td>
			<select name="display">
				<option value="">ללא</option>
				<option value="none" 	<?php echo $row_item["display"]=="none"?"selected":"";?>>אל תציג</option>
				<option value="block" 	<?php echo $row_item["display"]=="block"?"selected":"";?>>בלוק</option>
			</select>
		</td>		
	</tr>


	<tr>
		<td>מיקום עליון:</td>
		<td><input type="text" name="abs_top" dir="ltr" value="<?php echo $row_item["abs_top"];?>" /></td>		
	</tr>
	<tr>
		<td>מיקום תחתון:</td>
		<td><input type="text" name="abs_bottom" dir="ltr" value="<?php echo $row_item["abs_bottom"];?>" /></td>		
	</tr>




	<tr>
		<td>מיקום ימין:</td>
		<td><input type="text" name="abs_right" dir="ltr" value="<?php echo $row_item["abs_right"];?>" /></td>		
	</tr>
	<tr>
		<td>מיקום שמאל:</td>
		<td><input type="text" name="abs_left" dir="ltr" value="<?php echo $row_item["abs_left"];?>" /></td>		
	</tr>
	<tr>
		<td>עוד:</td>
		<td><textarea name="more" dir="ltr"><?php echo $row_item["more"];?></textarea></td>		
	</tr>

<?php }?>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
