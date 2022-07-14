<!-- European format dd-mm-yyyy -->
<!-- Date only with year scrolling -->
<!--<script language="JavaScript" type="text/javascript" src="JS/calendar/calendar1.js"></script>-->
<!--
<script type="text/javascript" src="JS/calendar/js/datepicker/datepicker.js"></script>
<script type="text/javascript" src="JS/calendar/js/datepicker/lang/he.js"></script> 
<link type="text/css" href="JS/calendar/css/datepicker.css" rel="stylesheet" />
-->
<!--
<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
-->

<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$('#datepicker').datepicker({ dateFormat: 'dd/mm/yy' });
});
</script>

<div id="newPageForm" style="margin-top: 10px; width: 300px; height: 200px; background-image:url(images/background/300X200.gif); background-repeat: no-repeat; position: fixed; <?php echo $gui->getLeft();?>: 27px; top: 112px; display: none;">
	<form style="padding: 0px;margin: 0px;" name="edit" action="../interface/tree_operations/add_page.php" method="post" ><!--onsubmit="return validateFields();"-->
		<input type="hidden" name="parent" value="<?php echo $id;?>" />
		<input type="hidden" name="page" value="<?php echo $page;?>" />
		<table width="100%">
			<tr>
				<td style="padding-<?php echo $gui->getLeft();?>: 12px;"><strong style="color: #ffffff;"><?php echo $text["Add new Page"];?></strong></td>
				<td align="<?php echo $gui->getRight();?>" style="padding: 3px;padding-<?php echo $gui->getRight();?>: 6px;"><img src="images/icons/close.gif" onclick="hideLayer('newPageForm');" style="cursor: pointer;" alt="Close" /></td>
			</tr>
		</table>
		<div style="padding: 20px;padding-top: 20px; color: #ffffff;">
		<table>
			<tr>
				<td><strong><?php echo $text["Name"];?>:</strong></td>
				<td><input type="text" name="Name" value="" style="width: 180px;" /></td>
			</tr>
		<?php if($wm->getParent($id)==0){?>
			<tr>
				<td><strong><?php echo $text["Language"];?>:</strong></td>
				<td>

			<select name="Lang"  style="width: 186px;">
			<?php $arrLang=$db->getArray("SELECT * FROM wm_languages ORDER BY Ordering");?>
			<?php foreach($arrLang as $lang){?>
				<option value="<?php echo $lang["Lang"];?>"><?php echo $lang["Name"];?></option>
			<?php }?>

<!--
				<option value="he"><?php echo $text["Hebrew"];?></option>
				<option value="en"><?php echo $text["English"];?></option>
-->
<!--
				<option value="sp"><?php echo $text["Spanish"];?></option>		
				<option value="fr"><?php echo $text["France"];?></option>		
				-->
			</select>
			<input type="hidden" name="Page_Type" value="90" />
				</td>				
			</tr>
		<?php }else{?>
			<tr>
				<td><strong><?php echo $text["Page Type"];?>:</strong></td>
				<td>
				<select name="Page_Type" style="width: 186px;">
					<?php 
					$arr_page_type=$wm->getPageTypes();
					for($i=0;$i<count($arr_page_type);$i++){
					?>
						<option value="<?php echo $arr_page_type[$i]["ID"];?>" <?php echo $arr_page_type[$i]["ID"]==$wm->getProperty($id, "Default_Child_Type")?"selected":"";?>><?php echo $text[$arr_page_type[$i]["Name"]]?$text[$arr_page_type[$i]["Name"]]:$arr_page_type[$i]["Name"];?></option>
					<?php }?>
				</select>
				</td>				
			</tr>		
		<?php }?>
		
		<?php if($wm->getProperty($id, "Admin_Start_Date")){?>
			<tr>
				<td><strong><?php echo $text["Date"];?>:</strong></td>
				<td><input type="text" name="Start_Date" id="datepicker" value="<?php echo date("d/m/Y", TIME);?>" /></td>
			</tr>	
		<?php }else{?>
<input type="hidden" name="Start_Date" id="datepicker" value="<?php echo date("d/m/Y", TIME);?>" />
		<?php }?>				
			<tr>
				<td></td>
				<td align="<?php echo $gui->getRight();?>"><input type="submit" name="submit" value="<?php echo $text["Add"];?>" /></td>				
			</tr>

		</table>
		</div>
	</form>

</div>
<?php if($wm->getProperty($id, "Admin_Start_Date")){?>
<script language="JavaScript" type="text/javascript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	//var cal1 = new calendar1(document.forms['edit'].elements['Start_Date']);
	//cal1.year_scroll = true;
	//cal1.time_comp = false;
//-->
</script>
<?php }?>
