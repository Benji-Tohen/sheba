<?php

$start = intval($_POST["start"]);
$limit = intval($_POST["limit"]);
$pageid = intval($_POST["pageid"]);

$output = [
    'items' => 0,
    'total_items' => 0,
    'data' => []
];

// Get services items
$servicesFolder = $wm->getChildren($pageid, 157);
$services = $wm->getAllChildren($servicesFolder[0]['ID'], 'Ordering', true, $start . "," . $limit);

// Get Total Items count
$output["total_items"] = count($wm->getAllChildren($servicesFolder[0]['ID'], 'Ordering', true));

// Normalize JSON for response
if(!empty($services)){
    $output['items'] = count($services);
    foreach ($services as $updateKey => $update) {
        $link = $wm->getLink($update);
        $date = new DateTime($update["Start_Date"]);

        $output['data'][$updateKey]['url'] = $link["Link"];
        $output['data'][$updateKey]['target'] = $link["Target"];
        $output['data'][$updateKey]['date'] = $date->format('d-m-Y');
        $output['data'][$updateKey]['title'] = $update["h1"]!='' ? $update["h1"] : $update["Name"];
        $output['data'][$updateKey]['sub_title'] = $update["Sub_Title"]!='' ? $update["Sub_Title"]: "";
        $output['data'][$updateKey]['thumb'] = $cfg["WM"]["Server"]."/webfiles/images/cache/600X444/zcX1/";
        if($update["Top_Header"]){
            $output['data'][$updateKey]['img'] = $update["Top_Header"];
        } else {
            $output['data'][$updateKey]['img'] = "webfiles/default/defaultNewsPic.jpg";
        }
    }
}

// Response JSON
echo json_encode($output, JSON_UNESCAPED_UNICODE);
exit;
?>