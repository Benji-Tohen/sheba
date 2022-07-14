<?php
exit;
require_once('../file/class.file.php');
require_once('phpthumb.class.php');

$file=new File();
$file->cropImage($_POST["ofile"], "../../", $_POST["selectionParams"]);

list($x,$y,$w,$h)=explode(",", $_POST["selectionParams"]);


header("Pragma: no-cache");
header("Expires: -1");
?>
<!--<img src="../../<?php echo $_POST["ofile"];?>?yy=<?php echo time();?>" id="aspect" border="0" width="<?php echo (($w/$h)*150);?>" height="150" border="0" />
-->
