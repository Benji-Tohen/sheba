<?php
require_once '../../conf/conf.data.php';

$cityName = mysqli_real_escape_string($db->conn,$_POST['cityName']);
$inputId = mysqli_real_escape_string($db->conn,$_POST['inputId']);
$query = "SELECT * FROM wm_cities_dynamic_form WHERE Name LIKE '".$_POST['cityName']."%' LIMIT 0,50";
$res = $db->getArray($query);
foreach ($res as $key => $value) {?>
<div style="cursor: pointer;" onclick="$('#<?php echo $inputId?>').val('<?php echo $value['Name']?>');$(this).parent().hide();"><?php echo $value['Name']?></div>
<?php }

