<?php
function fix_date($date) {
    $dt=new DateTime1();
    return date("Y-m-d", $dt->timestampFromText($date));
}

if ($_POST) {
    $check_inputs = array(
        array("string255"   => $_POST["From_Date"]),
        array("string255"   => $_POST["To_Date"]),
        array("string255"   => $_POST["username"]),
        array("string255"   => $_POST["log_operation"])
    );

    $secureTexts = new secure_inputs();
    $error = $secureTexts->isNotSecure($check_inputs);
    if (!$error) {   
        $fromDate = ($_POST['From_Date'])?fix_date($_POST['From_Date']):"";
        $toDate = ($_POST['To_Date'])?fix_date($_POST['To_Date']):"";
        $user = @$_POST['username'];
        $operation = @$_POST['log_operation'];
        $arrLog=$log->filterLog("0, 100", 1, $fromDate, $toDate, $operation, $user);
    } else die($error);
} else $arrLog=$log->getLog("0, 100");
    
if($_GET["do"]=="del"){
	$log->delAll();
}

?>
<?php require_once('common/header.php');?>
<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery-ui-1.8.23.custom.min.js"></script>
<?php if ($gui->getDir()=="rtl"){?>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery.ui.datepicker-he.js"></script>
<?php }?>
<link type="text/css" href="JS/jquery-ui/css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<script language="javascript" type="text/javascript">
$(document).ready(function(){
    $(".From_Date").datepicker({ dateFormat: 'dd/mm/yy' });
    $(".To_Date").datepicker({ dateFormat: 'dd/mm/yy' });
});
</script>
<?php require_once('common/body.php');?>
<div class="editPagePadding" style="overflow: auto; height: 600px;">
<table cellspacing="3" cellpadding="2">
    <form method="post">
    <tr>
        <td>חיפוש לפי שם משתמש:</td>
        <td><input type="text" name="username" value="<?php echo $_POST['username'];?>"/></td>
    </tr>
    <tr>
        <td>חיפוש מתאריך:</td>
        <td><input type="text" name="From_Date" class="From_Date" value="<?php echo ($_POST['From_Date'])?$_POST['From_Date']:"";?>"  /> </td>		
    </tr>
    <tr>
        <td>חיפוש עד תאריך:</td>
        <td><input type="text" name="To_Date" class="To_Date" value="<?php echo ($_POST['To_Date'])?$_POST['To_Date']:"";?>"  /> </td>		
    </tr>
    <tr>
        <td>חיפוש לפי סוג פעולה:</td>
        <td>
            <?php
            $log_operations = array(
                "create"        => "יצירת דף",
                "edit"          => "עריכה",
                "delete"        => "מחיקה",
                "login"         => "כניסה למערכת",
                "login_failed"  => "נסיון כניסה שנכשל",
                "logout"        => "יציאה מהמערכת",
                "picture_add"   => "הוספת תמונה",
                "picture_edit"  => "עריכת תמונה",
                "archive"       => "הוספה לארכיון",
                "order"         => "שינוי סדר"
            )
            ?>
            <select name="log_operation">
                <option value="">-- בחר פעולה --</option>
                <?php
                foreach ($log_operations as $key=>$operation) {
                    $is_sel = ($_POST['log_operation']==$key) ? "selected" : "";
                    echo "<option $is_sel value='$key'>$operation</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><input type="submit" value="חפש" /></td>
        <td></td>
    </tr>
    </form>
</table>
    
<table cellspacing="3" cellpadding="2" class="list_table">
	<tr style="font-weight: bold;">
		<td>זמן</td>
		<td>משתמש</td>
		<td>תיאור הפעולה</td>
	</tr>
<?php $i=0;foreach($arrLog as $log){?>
	<tr style="font-weight: bold;" id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
		<td><?php echo $dt->showFullTimeFomDateTime($log["log_time"]);?></td>
		<td><?php echo $log["log_user"];?></td>
		<td dir="ltr"><?php echo $log["log_desc"];?></td>
	</tr>
<?php $i++;}?>
</table>
</div>
<a href="index.php?show=log/index&amp;do=del">מחק לוג</a>
