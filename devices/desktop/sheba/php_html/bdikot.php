<a href="<?php echo $cfg["WM"]["Server"].'/'.$arrAllDoctors[$i]['ID'];?>" title="<?php echo str_replace('"','&quot;',$arrAllDoctors[$i]["Name"]);?>" class="row item">  
    <!-- ITEM ICON -->
    <?php 
    	$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/".$arrAllDoctors[$i]["Top_Header"];
    ?>
    
    <?php ?>
    <!-- ITEM TITLE -->
    <div class="col-10 col-sm-11 col-md-11 col-lg-11 itemText">
        <?php $arr_dynamic_forms  = $wm->getDynamicFieldsByPageType($arrAllDoctors[$i]['ID'],$arrAllDoctors[$i]['Page_Type'],1); ?>
        <h3>
        	<?php echo $arrAllDoctors[$i]['Name'];?>
	        <?php if(!empty($arr_dynamic_forms[$i]['Value'])){ ?>
	        		&#45;&nbsp;<span>&#40;<?php echo $arr_dynamic_forms[$i]['Value']; ?>&#41;</span>
	        <?php } ?>
        </h3>
        <?php if ($arrAllDoctors[$i]["Sub_Title"]) { ?><h6><?php echo nl2br($arrAllDoctors[$i]["Sub_Title"]);?></h6><?php } ?>
        <?php if ($doctorExpertise['Name']) { ?><h6 class="jobTitle"><?php echo $doctorExpertise['Name'];?></h6><?php } ?>
    </div>
    
    <!-- ITEM Arrow -->
    <div class="col-2 col-sm-1 col-md-1 col-lg-1 itemArrow">
        <div class="clinicArrow"></div>
    </div>
</a>
