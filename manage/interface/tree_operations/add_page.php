<?php

require_once('../../../conf/conf.data.php');

require_once('../../../classes/elad/elad_integration.class.php');



$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$dt=new DateTime1();



$parent=intval($_REQUEST["parent"]);



if(!$parent){

	$parent=1;

}
/*
echo "shery";
print_r($_REQUEST["parent"]);
/*$allChilder = wm->getAllChildren($_REQUEST["parent"],"Ordering");
/*print_r($allChilder);*/


$wm->orderParent($parent);



$fa["Ordering"]=0;//($wm->getLastInOrder($parent)+1);



$fa["AddThis"]  =1;

$fa["Enable_SideContent"]  =1;



if($_REQUEST["Name"]){

	$fa["Name"]=			$_REQUEST["Name"];

}else{

	$fa["Name"]=			"'Untitled'";

}



$fa["Menu_Name"]=			$_REQUEST["Name"];



if($_REQUEST["Sub_Title"]){

	$fa["Sub_Title"]=			$_REQUEST["Sub_Title"];

}



if($_REQUEST["Content"]){

	$fa["Content"]=			$_REQUEST["Content"];

}else{

	$fa["Content"]="";

}

if($_REQUEST["Lang"]){

	$fa["Lang"]=			$_REQUEST["Lang"];

}

/*

if($_REQUEST["Hide_On_Menu"]){

	$fa["Hide_On_Menu"]=	$_REQUEST["Hide_On_Menu"];

}

*/

$fa["Hide_On_Menu"]=	0;

$fa['noindex']=0;

if($_REQUEST["Page_Type"]){

	$fa["Page_Type"]=		$_REQUEST["Page_Type"];

}



if($_REQUEST["Start_Date"]){

	$fa["Start_Date"]=date("Y-m-d", $dt->timestampFromText($_REQUEST["Start_Date"]));

}else{

	$fa["Start_Date"]=date("Y-m-d", $TIME);

}



$fa["UpdatedTime"]=time();





// add input check

$check_inputs = array(

    array("number"=>$fa["Ordering"]),

    array("number"=>$fa["AddThis"]),

    array("number"=>$fa["Enable_SideContent"]),

    array("string255"=>$fa["Name"]),

    array("string255"=>$fa["Menu_Name"]),

    array("string255"=>$fa["Sub_Title"]),

    array("text"=>$fa["Content"]),

    array("string10"=>$fa["Lang"]),

    array("number"=>$fa["Hide_On_Menu"]),

    array("number"=>$fa["Page_Type"]),

    array("string255"=>$fa["Start_Date"]),

    array("number"=>$fa["UpdatedTime"])

);



$secureTexts = new secure_inputs();

$error = $secureTexts->isNotSecure($check_inputs);

if ($error) die($error);





$id=$wm->add($parent, $_REQUEST["Name"], true);



if ($fa["Page_Type"]==98) {                         // if its an event ..

    $elad = new EladIntegration();

    $event = array(

        "ID"                => $id,

        "Name"              => $fa['Name'],

        "UpdatedTime"       => time(),

        "Event_Currency"    => 0,

        "Event_Price"       => 0,

        "Sheba_Yashir"      => 0,

        "EventType_ID"      => 0

    );

    $elad->insert_event($event);

}



$wm->setValues($id, $fa);



//header("location: ".$_SERVER['HTTP_REFERER']);

//exit;

//$respond="success";



$respond=$id;



$log->write("Page added: '".$fa["Name"]."'", "create");





header("location: ../../gui/index.php?id=".$parent."&page=".$_REQUEST["page"]);

exit;



//require_once("../xml/responder.php");

?>

