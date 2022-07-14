<div class="container-fluid noPadding bigGallery">
    <!--Big Gallery-->
    <?php if(!empty($arr_pictures)){?>
    <div class="row noMargin">
        <div class="col-md-12 noPadding">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner row_slick_gallery">
                    <?php $i=1; foreach($arr_pictures as $item){
                    $onclick = $item['Code'] == '' ? '': "window.location.replace('".$item['Code']."')";
                    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/1920X490/zcX1/";
                    ?>
                    <div onclick="<?php echo $onclick?>" title="<?php echo $item["Name"];?>" class="rowslickitem item <?php echo $i==1?"active":"";?> " onmouseover="this.title='';">
                        <img src="<?php echo $thumb_call.$item["File_Name"];?>" alt="<?php echo $item["Name"];?>" />
                        <div class="carousel-caption">
                            <?php if($item["Content"]){?>
                                <h1><?php echo $item["Content"];?></h1>
                            <?php }?>
                        </div>
                    </div>
                    <?php $i++;}?>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <!--end-->
</div>


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 homeFeed">
            <!-- CHILDREN FEED -->
            <div class="row homeChildrenFeed">
                <?php 
                   
                
                                
                foreach ($arrChildren as $key => $child) {
                    $link=$wm->getLink($child);
                    if($key == 6){break;}/*max 6 children*/
                    if($child['Top_Header'] == ''){
                        $thumb_call='';$child['Top_Header'] = 'site/images/defaultNewsPic.jpg';
                    }else{
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                    }
                    ?>
                <a href="<?php echo $link['Link']?>" target="<?php echo $link['Target']?>" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 item newFeedItem">
                        <img src="<?php echo $thumb_call.$child['Top_Header']?>" alt="<?php echo $child['Name']?>" title="<?php echo $child['Name']?>" class="newsImg" />
                        <h4><?php echo $child['Name']?></h4>
                    </a>
                    <?php if($key == 2){
                        echo "<div class='clear'></div>";
                    }?>
                <?php }?>
                
            </div>
            <!-- CHILDREN END -->
                  
            <!-- FIRST BANNER MIDDLE -->
            <?php 

            	if(is_array($firstBanner)){ ?>
                <img src="<?php echo $thumb_call_banner.$firstBanner['File_Name']?>" alt="<?php echo $firstBanner['Value']?>" title="<?php echo $firstBanner['Value']?>" class="img-responsive bannerImg" />
            <?php }?>
            
            <!-- FIRST BANNER MIDDLE - END -->
            
            <!-- EVENTS FEED -->
            <div class="homeEventsFeed">
                <div class="row">
                    <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                        <div class="titleLine color2"></div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"><h2><?php echo $trans->getText("Events Board");?></h2></div>
                    <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                        <div class="titleLine color2"></div>
                    </div>
                </div>

                <!-- Caroufredsel -->
                <div class="row carouselWrap">
                    <div class="col-xs-12">
                        <div class="events-slider">
                                <?php

                                    foreach ($arrHomeEventsRelated as $value) {
                                        $date = date_create($value['Start_Date']);
                                        $date =  date_format($date, 'd/m/Y');
                                        if($value['Top_Header'] == ''){
                                            $thumb_call='';$value['Top_Header'] = 'site/images/defaultEventPic.jpg';
                                        }else{
                                            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                                        }
                                        $link=$wm->getLink($value, true);
                                        /*check if we have mofa date to display*/
                                         $mofaDate = $db->getRow("SELECT Start_Date FROM wm_events WHERE wm_pages=".intval($value['ID']));
                                         if($mofaDate['Start_Date']!=''){
                                            $value['Start_Date']=$mofaDate['Start_Date'];
                                         }
                                        $date = date_create($value['Start_Date']);
                                        $date =  date_format($date, 'd/m/Y');
                                    ?>
                                        <div>
                                            <a href="<?php echo $link['Link']?>" class="item newFeedItem1">
                                                
                                                <img src="<?php echo $thumb_call.$value['Top_Header']?>" alt="<?php echo $value['Name']?>" title="<?php echo $value['Name']?>" class="newsImg1" />
                                                <h4><?php echo $value['Name']?></h4>
                                                <div class="newFeedItemDate"><?php echo $trans->getText("תאריך האירוע: ");?><?php echo $date?></div>
                                                 <?php if ($value["Sub_Title"]) { ?>
                                                    <div class="newFeedItem1h6">
                                                        <?php
                                                        if(intval(mb_strlen($value["Sub_Title"], 'UTF-8'))>90){
                                                        echo mb_substr($value["Sub_Title"],0,87, "utf-8")."...";
                                                        }else{
                                                        echo $value["Sub_Title"];
                                                        }?>
                                                    </div>
                                                <?php } ?>
                                                 <div class="overlay ts">
                                                    <img src="<?php $cfg["WM"]["Server"];?>/site/images/plus.png" alt="<?php echo $value['Name']?>" title="<?php echo $value['Name']?>" />
                                                </div>
                                            </a>
                                        </div>
                                <?php } ?>
                        </div>

                            <?php /*
                            //print_r($arrHomeEventsRelated);  
                            echo '<div id="carousel2">';
                            foreach ($arrHomeEventsRelated as $value) {
                                $date = date_create($value['Start_Date']);
                                $date =  date_format($date, 'd-m-Y');
                                if($value['Top_Header'] == ''){
                                    $thumb_call='';$value['Top_Header'] = 'site/images/defaultEventPic.jpg';
                                }else{
                                    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                                }
                                ?>
                                    <a href="#" class="item newFeedItem">
                                        <img src="<?php echo $thumb_call.$value['Top_Header']?>" alt="<?php echo $value['Name']?>" title="<?php echo $value['Name']?>" class="newsImg" />
                                        <h4><?php echo $value['Name']?></h4>
                                        <div class="newFeedItemDate"><?php echo $date?></div>
                                    <h6>
                                        <?php
                                        if(intval(mb_strlen($value["Sub_Title"], 'UTF-8'))>90){
                                        echo mb_substr($value["Sub_Title"],0,87, "utf-8")."...";
                                        }else{
                                        echo $value["Sub_Title"];
                                        }?>
                                    </h6>
                                    </a>
                                <?php }
                                echo "</div>";
                                echo '<i class="fa fa-angle-left galleryArrowLeft" id="prevItem2"></i>';
                                echo '<i class="fa fa-angle-right galleryArrowRight" id="nextItem2"></i>';

                            */?>
                        
                    </div>
                </div>
                <!-- END Caroufredsel -->

                <a href="<?php echo $wm->getIdByPageType(105)?>" style="margin-bottom: 60px;" class="moreButton"><?php echo $trans->getText("More Events");?>&nbsp;&nbsp;<i class="fa fa-chevron-<?php echo $gui->getRight();?> color2"></i></a>
            </div>
            
            <!-- SECOND BANNER MIDDLE -->
            <?php  
            if(is_array($secondBanner)){
                ?>
                <img src="<?php echo $thumb_call_banner.$firstBanner['File_Name']?>" alt="<?php echo $firstBanner['Value']?>" title="<?php echo $firstBanner['Value']?>" class="img-responsive bannerImg  banneerr" />
            <?php }?>
            
            <!-- SECOND BANNER MIDDLE - END -->
            
            <!-- NEWS FEED -->
            <div class="homeEventsFeed">
                <div class="row">
                    <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                        <div class="titleLine bgcolor2"></div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"><h2><?php echo $trans->getText("News");?></h2></div>
                    <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                        <div class="titleLine bgcolor2"></div>
                    </div>
                </div>

                <!-- Caroufredsel -->
                <div class="row carouselWrap">
                    <div class="col-xs-12">
                        <div class="events-slider">
                                <?php
                                    foreach ($arrHomeNewsRelated as $value) {
                                        $date = date_create($value['Start_Date']);
                                        $date =  date_format($date, 'd/m/Y');
                                        if($value['Top_Header'] == ''){
                                            $thumb_call='';$value['Top_Header'] = 'site/images/defaultEventPic.jpg';
                                        }else{
                                            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                                        }
                                        $link=$wm->getLink($value, true);
                                        /*check if we have mofa date to display*/
                                         $mofaDate = $db->getRow("SELECT Start_Date FROM wm_events WHERE wm_pages=".intval($value['ID']));
                                         if($mofaDate['Start_Date']!=''){
                                            $value['Start_Date']=$mofaDate['Start_Date'];
                                         }
                                        $date = date_create($value['Start_Date']);
                                        $date =  date_format($date, 'd/m/Y');
                                    ?>
                                        <div>
                                            <a href="<?php echo $link['Link']?>" class="item newFeedItem1">
                                                
                                                <img src="<?php echo $thumb_call.$value['Top_Header']?>" alt="<?php echo $value['Name']?>" title="<?php echo $value['Name']?>" class="newsImg1" />
                                                <h4><?php echo $value['Name']?></h4>
                                                <div class="newFeedItemDate"><?php echo $date?></div>
                                                 <?php if ($value["Sub_Title"]) { ?>
                                                    <div class="newFeedItem1h6">
                                                        <?php
                                                        if(intval(mb_strlen($value["Sub_Title"], 'UTF-8'))>90){
                                                        echo mb_substr($value["Sub_Title"],0,87, "utf-8")."...";
                                                        }else{
                                                        echo $value["Sub_Title"];
                                                        }?>
                                                    </div>
                                                <?php } ?>
                                                 <div class="overlay ts">
                                                    <img src="<?php $cfg["WM"]["Server"];?>/site/images/plus.png" alt="<?php echo $value['Name']?>" title="<?php echo $value['Name']?>" />
                                                </div>
                                            </a>
                                        </div>
                                <?php } ?>
                        </div>




                        <?php /*$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                        echo '<div id="carousel">';
                        foreach ($arrHomeNewsRelated as $value) {
                            $date = date_create($value['Start_Date']);
                            $date =  date_format($date, 'd-m-Y');
                            if($value['Top_Header'] == ''){
                                $thumb_call='';$value['Top_Header'] = 'site/images/defaultNewsPic.jpg';
                            }else{
                                $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                            }

                            $link=$wm->getLink($value, true);
                            ?>
                                <a href="<?php echo $link['Link']?>" class="item newFeedItem">
                                    <img src="<?php echo $thumb_call.$value['Top_Header']?>" alt="<?php echo $value['Name']?>" title="<?php echo $value['Name']?>" class="newsImg" />
                                    <h4><?php echo $value['Name']?></h4>
                                    <div class="newFeedItemDate"><?php echo $date?></div>
                                <h6>
                                    <?php
                                    if(intval(mb_strlen($value["Sub_Title"], 'UTF-8'))>90){
                                    echo mb_substr($value["Sub_Title"],0,87, "utf-8")."...";
                                    }else{
                                    echo $value["Sub_Title"];
                                    }?>
                                </h6>
                                </a>
                            <?php }
                            echo "</div>";
                            echo '<i class="fa fa-angle-left galleryArrowLeft" id="prevItem"></i>';
                            echo '<i class="fa fa-angle-right galleryArrowRight" id="nextItem"></i>';

                        */?>
                    </div>
                </div>
                <!-- END Caroufredsel -->
                <a href="<?php echo $wm->getIdByPageType(104)?>" style="margin-bottom: 60px;" class="moreButton color2"><?php echo $trans->getText("More News");?>&nbsp;&nbsp;<i class="fa fa-chevron-<?php echo $gui->getRight();?> color2"></i></a>
            </div>  
            
            
               <div class="carouselWrap">
                <?php /*show related doctors*/
                /*echo '<h1>'.print_r($arr_connected_doctors).'</h1>';*/
                if(count($arr_connected_doctors) > 0){
                  ?>
                    <h2 class="clinicTeamTitle"><?php echo $trans->getText("Clinic Team");?></h2>
        
                    
                    <?php
                    echo '<div id="carousel">';
                    foreach ($arr_connected_doctors as $doctor) {
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/120X150/zcX1/";
                        ?>
                        <a href="<?php echo $cfg["WM"]["Server"].'/'.$doctor['ID']?>" class="item">
                            <img src="<?php echo $thumb_call.$doctor['Top_Header']?>" alt="<?php echo $doctor['Name']?>" title="<?php echo $doctor['Name']?>" class="doctorImg" />
                            <h5 class="doctorName"><?php echo $doctor['Name']?></h5>
                        </a>
                    <?php }
                    echo "</div>";
                    echo '<a id="prevItem" class="next galleryArrowLeft" href="#" style="display: block;"></a>';
                    echo '<a id="nextItem" class="next galleryArrowRight" href="#" style="display: block;"></a>';
                }
                ?>
            </div>
        </div>
        <!-- SIDE CONTENT -->
        <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
            <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
        </div>
    </div>
</div>
