<div class="container-fluid noPadding bigGallery">
    <!--Big Gallery-->
    <?php if(!empty($arr_pictures)){?>
    <div class="row noMargin">
        <div class="col-12 noPadding">
                <div class="carousel-inner row_slick_gallery">
                    <?php $i=1; foreach($arr_pictures as $item){
                    $onclick = $item['Code'] == '' ? '': "window.location.replace('".$item['Code']."')";
                    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/1920X490/zcX1/";
                    ?>
                    <div onclick="<?php echo $onclick?>" title="<?php echo $item["Name"];?>" class="rowslickitem item <?php echo $i==1?"active":"";?> " onmouseover="this.title='';">
                        <img src="<?php echo $thumb_call.$item["File_Name"];?>" alt="<?php echo $item["Name"];?>" />
                        <?php if($item["Content"]){?>
                        <div class="carousel-caption">
                            <h1><?php echo nl2br($item["Content"]);?></h1>
                        </div>
                        <?php }?>
                    </div>
                    <?php $i++;}?>
                </div>
        </div>
    </div>
    <?php }?>
    <!--end-->
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 homeFeed">
            <?php if($isHomePageEng||true){?>
            <!-- CHILDREN FEED -->
            <div class="row homeChildrenFeed">
                <?php 
                foreach ($arrChildren as $key => $child) {
                    $link=$wm->getLink($child);
                    if($child['Top_Header'] == ''){
                        $thumb_call='';$child['Top_Header'] = 'site/images/defaultNewsPic.jpg';
                    }else{
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                    }
                    if($child['Page_Type'] != 151){
                    ?>
                <a href="<?php echo $link['Link']?>" target="<?php echo $link['Target']?>" class="col-12 col-sm-12 col-md-4 col-lg-4 item newFeedItemEn">
                        <img src="<?php echo $thumb_call.$child['Top_Header']?>" alt="<?php echo $child['Name']?>" title="<?php echo $child['Name']?>" class="newsImg" />
                        <h4><?php echo $child['Name']?></h4>
                    </a>
                    <?php }else{ ?>
                    </div>
                     <div class="col-12">
                                <?php if(isset($child['Name']) && !empty($child['Name'])){?>
                                    <h2 class="ItemLongTitle"><?php echo $child['Name']?></h2>
                                <?php }?>
                     </div>
                     <div class="row homeChildrenFeed">
                        <?php } ?>
                <?php }?>
                
            </div>
            <!-- CHILDREN END -->
            <?php }?>

            <?php if (count($arr_connected_doctors)>0) {?>
                <div class="doctors-slider" <?php if (count($arr_connected_doctors)<4) echo 'style="direction:rtl"'; ?>>
                     <h3 class="doctors-sliderHeadline"><?php echo $trans->getText('Clinic Team');?></h3>
                    <?php 

                        foreach ($arr_connected_doctors as $doctor) {
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/120X150/iarX1/";
                        if (!$doctor['Top_Header']) {
                            //$doctor['Top_Header'] = 'webfiles/shebaPics/shebaMain/doctor-male.jpg';
                            $drPic = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$doctor['ID']);
                            $doctor['Top_Header'] = 'webfiles/shebaPics/shebaMain/'.((strpos($drPic['picture'],"female")>0)?'doctor-female.jpg':'doctor-male.jpg');
                            //echo "doctor_top_header = {$doctor['Top_Header']}";
                        }
                    ?>
                    <div >
                        <a href="<?php echo $cfg["WM"]["Server"].'/'.$doctor['ID']?>" class="item">
                            <img src="<?php echo $thumb_call.$doctor['Top_Header']?>" alt="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" title="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" class="doctorImg" />
                            <div class="doctorName"><?php echo $doctor['Name']?></div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            <?php }?>
                        


        </div>
        <!-- SIDE CONTENT -->
        <div class="col-10 offset-xs-1 col-sm-10 offset-sm-1 col-md-4 offset-md-0 col-lg-4 offset-lg-0 pageSideContent">
            <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
        </div>
    </div>
</div>
