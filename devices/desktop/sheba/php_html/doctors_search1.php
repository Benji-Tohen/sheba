<a href="<?php echo $cfg["WM"]["Server"].'/'.$arrAllDoctors[$i]['ID'];?>" title="<?php echo str_replace('"','&quot;',$arrAllDoctors[$i]["Name"]);?>" class="row item">  
    <!-- ITEM ICON -->
    <?php if($arrAllDoctors[$i]["Top_Header"]!=''){
        $thumbWidth=$params->getValue("imgThumbWidth");
        $thumbHeight=$params->getValue("imgThumbHeight");
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/".$arrAllDoctors["Top_Header"];
        }else{/*get deafault pic*/
        $drPic = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$arrAllDoctors[$i]['ID']);
        $thumbWidth=$params->getValue("imgThumbWidth");
        $thumbHeight=$params->getValue("imgThumbHeight");
        $thumb_call=$cfg["WM"]["Server"].$drPic['picture'];
    } ?>
    <div class="col-3 offset-xs-0 col-sm-3 offset-sm-0 col-md-2 col-lg-2">
        <img src="<?php echo $thumb_call.$arrAllDoctors[$i]["Top_Header"];?>" alt="<?php echo str_replace('"','&quot;',nl2br($arrAllDoctors[$i]["Name"]));?>" title="<?php echo str_replace('"','&quot;',nl2br($arrAllDoctors[$i]["Name"]));?>" class="img-circle img-fluid" />
    </div>
   
    <?php /*$doctorJob = $db->getRow("SELECT Value.wm_pages_dynamic_field_values FROM wm_pages_dynamic_field_values INNER JOIN wm_pages ON wm_pages.wm_doctor_expertise = wm_doctor_expertise.ID WHERE wm_pages.ID = ".$arrAllDoctors[$i]["ID"]);*/?>
    <?php /*$doctorExpertise = $db->getRow("SELECT wm_doctor_expertise.Name FROM wm_doctor_expertise INNER JOIN wm_pages ON wm_pages.wm_doctor_expertise = wm_doctor_expertise.ID WHERE wm_pages.ID = ".$arrAllDoctors[$i]["ID"]);*/?>
    <!-- ITEM TITLE -->
    <div class="col-7 col-sm-8 col-md-9 col-lg-9 itemText">
         <?php 
    if($_SERVER['REMOTE_ADDR'] == '31.168.120.186'){
        echo "shery: ";
        print_r($arrAllDoctors[$i]["ID"]);
        }


    ?>
        <h3><?php echo $arrAllDoctors[$i]['Name'];?></h3>
        <?php if ($arrAllDoctors[$i]["Sub_Title"]) { ?><h6><?php echo nl2br($arrAllDoctors[$i]["Sub_Title"]);?></h6><?php } ?>
        <?php if ($doctorExpertise['Name']) { ?><h6 class="jobTitle"><?php echo $doctorExpertise['Name'];?></h6><?php } ?>
    </div>
    
    <!-- ITEM Arrow -->
    <div class="col-2 col-sm-1 col-md-1 col-lg-1 itemArrow">
        <div class="clinicArrow"></div>
    </div>
</a>
