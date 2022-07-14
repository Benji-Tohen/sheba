<?php

require_once('../../../conf/conf.data.php');



$wm_cities=	intval($_REQUEST["wm_cities"]);

$wm_places=	intval($_REQUEST["wm_places"]);



$query="

	SELECT * 

	FROM wm_places 

	WHERE wm_cities=".intval($wm_cities)."

	ORDER BY Name

";

$arr=$db->getArray($query);

?>

<select name="wm_places" style="width: 150px;">

	<?php foreach($arr as $place){?>

		<option value="<?php echo $place["ID"];?>" <?php echo $place["ID"]==$wm_places?"selected":"";?>><?php echo $place["Name"];?></option>

	<?php }?>

</select>

