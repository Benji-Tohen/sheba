<?php 
$arrAllDoctors[$i]["Name"] = isset($arrAllDoctors[$i]["Name"]) ? $arrAllDoctors[$i]["Name"]: '';
$arrAllDoctors[$i]["Top_Header"] = isset($arrAllDoctors[$i]["Top_Header"]) ? $arrAllDoctors[$i]["Top_Header"]: '';
?>
<a href="<?php echo $cfg["WM"]["Server"].'/'.$arrAllDoctors[$i]['ID'];?>" title="<?php echo str_replace('"','&quot;',$arrAllDoctors[$i]["Name"]);?>" class="row item">  
    <!-- ITEM ICON -->
    <?php if($arrAllDoctors[$i]["Top_Header"]!=''){
        $thumbWidth=$params->getValue("imgThumbWidth");
        $thumbHeight=$params->getValue("imgThumbHeight");
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/".$arrAllDoctors[$i]["Top_Header"];
        }else{/*get deafault pic*/
        $drPic = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$arrAllDoctors[$i]['ID']);
        $thumbWidth=$params->getValue("imgThumbWidth");
        $thumbHeight=$params->getValue("imgThumbHeight");
        $thumb_call=$cfg["WM"]["Server"].$drPic['picture'];
    } ?>
    <div class="col-xs-3 col-xs-offset-0 col-sm-3 col-sm-offset-0 col-md-2 col-lg-2">
        <img src="<?php echo $thumb_call.$arrAllDoctors[$i]["Top_Header"];?>" alt="<?php echo str_replace('"','&quot;',nl2br($arrAllDoctors[$i]["Name"]));?>" title="<?php echo str_replace('"','&quot;',nl2br($arrAllDoctors[$i]["Name"]));?>" class="img-circle img-responsive" />
    </div>
   
    <?php 
        $queryDoctors = "SELECT Value FROM wm_pages_dynamic_field_values WHERE wm_pages = ".$arrAllDoctors[$i]["ID"]." AND wm_forms_fields='10'";
        /*echo $queryDoctors;*/
        $doctorJob = $db->getRow($queryDoctors);
         $queryDoctors1 = "SELECT Name FROM wm_doctor_title WHERE wm_doctor_title.ID = ".$arrAllDoctors[$i]["wm_doctor_title"];
        $doctorTitle = $db->getRow($queryDoctors1);
       ?>


    <?php /*$doctorExpertise = $db->getRow("SELECT wm_doctor_expertise.Name FROM wm_doctor_expertise INNER JOIN wm_pages ON wm_pages.wm_doctor_expertise = wm_doctor_expertise.ID WHERE wm_pages.ID = ".$arrAllDoctors[$i]["ID"]);*/?>
    <!-- ITEM TITLE -->
    <div class="col-xs-7 col-sm-8 col-md-9 col-lg-9 itemText">
        <h3><?php 
        echo  $doctorTitle["Name"]." ".$arrAllDoctors[$i]['lastName']." ".$arrAllDoctors[$i]['firtsName'] ;?></h3>
        <?php if (isset($arrAllDoctors[$i]["Sub_Title"]) && $arrAllDoctors[$i]["Sub_Title"]) { ?><h6><?php echo nl2br($arrAllDoctors[$i]["Sub_Title"]);?></h6><?php } ?>
        <?php if ($doctorJob['Value']) { ?><h6 class="jobTitle"><?php echo $doctorJob['Value'];?></h6><?php } ?>
          <?php 
    ?>
    </div>
    
    <!-- ITEM Arrow -->
    <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 itemArrow">
        <div class="clinicArrow"></div>
    </div>
</a>
