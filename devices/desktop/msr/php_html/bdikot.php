<a href="<?php echo $cfg["WM"]["Server"].'/'.$arrAllDoctors[$i]['ID'];?>" title="<?php echo str_replace('"','&quot;',$arrAllDoctors[$i]["Name"]);?>" class="row item">  
    <!-- ITEM ICON -->
    <?php 
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/".$arrAllDoctors["Top_Header"];
    ?>
    <div class="col-xs-3 col-xs-offset-0 col-sm-3 col-sm-offset-0 col-md-2 col-lg-2">
        <img src="<?php echo $thumb_call;?>" alt="<?php echo str_replace('"','&quot;',nl2br($arrAllDoctors[$i]["Name"]));?>" title="<?php echo str_replace('"','&quot;',nl2br($arrAllDoctors[$i]["Name"]));?>" class="img-circle img-responsive" />
    </div>
    <?php ?>
    <!-- ITEM TITLE -->
    <div class="col-xs-7 col-sm-8 col-md-9 col-lg-9 itemText">
        <h3><?php echo $arrAllDoctors[$i]['Name'];?></h3>
        <?php if ($arrAllDoctors[$i]["Sub_Title"]) { ?><h6><?php echo nl2br($arrAllDoctors[$i]["Sub_Title"]);?></h6><?php } ?>
        <?php if ($doctorExpertise['Name']) { ?><h6 class="jobTitle"><?php echo $doctorExpertise['Name'];?></h6><?php } ?>
    </div>
    
    <!-- ITEM Arrow -->
    <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 itemArrow">
        <div class="clinicArrow"></div>
    </div>
</a>
