<div class="container-fluid noPadding bigGallery">
    <!--Big Gallery-->
    <?php if(!empty($arr_pictures)){?>
    <div class="row noMargin">
        <div class="col-md-12 noPadding">
                <div class="carousel-inner row_slick_gallery">
                    <?php $i=1; foreach($arr_pictures as $item){
                    $onclick = $item['Code'] == '' ? '': "window.location.replace('".$item['Code']."')";
                    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/1920X490/zcX1/";
                    ?>
                    <div onclick="<?php echo $onclick?>" title="<?php echo $item["Name"];?>" class="rowslickitem item <?php echo $i==1?"active":"";?> " onmouseover="this.title='';">
                        <img src="<?php echo $thumb_call.$item["File_Name"];?>" alt="<?php echo $item["Name"];?>" />
                        <div class="carousel-caption">
                            <?php if($item["Content"]){?>
                                <h1><?php echo nl2br($item["Content"]);?></h1>
                            <?php }?>
                        </div>
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
        <div class="col-12 col-md-8 col-lg-8 homeFeed">
            <?php if($isHomePageEng){?>
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
                <a href="<?php echo $link['Link']?>" target="<?php echo $link['Target']?>" class="col-12 col-md-4 col-lg-4 item newFeedItemEn">
                        <img src="<?php echo $thumb_call.$child['Top_Header']?>" alt="<?php echo $child['Name']?>" title="<?php echo $child['Name']?>" class="newsImg img-fluid" />
                        <h4><?php echo $child['Name']?></h4>
                    </a>
                    <?php if($key == 2){
                        echo "<div class='clear'></div>";
                    }?>
                <?php }?>
                
            </div>
            <!-- CHILDREN END -->
            <?php }?>
   
        <?php if($wmPage["Lang"]!="en"||true) { ?>
            <!-- NEWS FEED -->
            <div class="homeNewsFeed">
                <div class="row">
                    <?php $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                    foreach ($arrHomeNewsRelated as $key=> $value) {
                        $date = date_create($value['Start_Date']);
                        $date =  date_format($date, 'd-m-Y');
                        if($value['Top_Header'] == ''){
                            $thumb_call='';$value['Top_Header'] = 'site/images/defaultNewsPic.jpg';
                        }else{
                            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                        }

                        $link=$wm->getLink($value, true);
                        ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <a href="<?php echo $link['Link']?>" class="item newFeedItem">
                                    <div class="overlay ts">
                                        <img src="<?php $cfg["WM"]["Server"];?>/site/images/plus.png" alt="<?php echo str_replace('"','&quot;',$value['Name'])?>" title="<?php echo str_replace('"','&quot;',$value['Name'])?>" />
                                    </div>

                                    <img src="<?php echo $thumb_call.$value['Top_Header']?>" alt="<?php echo str_replace('"','&quot;',$value['Name'])?>" title="<?php echo str_replace('"','&quot;',$value['Name'])?>" class="newsImg img-fluid" />
                                    
                                    <h4><?php echo $value['Name']?></h4> 
                                </a>
                            </div>
                    <?php if($key%3==2){echo "<div style='clear:both'></div>";}  } ?>
                </div>
            </div>        
	    <?php }

            if(is_array($arrCenterBanners[0])){?>
                <div>
                <?php 
                    if($arrCenterBanners[0]["Link"]){?>
                        <a href="<?php echo $arrCenterBanners[0]["Link"];?>" target="<?php echo $arrCenterBanners[0]["Open_In"];?>">
                <?php } ?>
                <img class="img-fluid msrBanner" src="<?php echo $cfg["WM"]["Server"].'/'.$arrCenterBanners[0]['Top_Header']?>"/>
                <?php 
                    if($arrCenterBanners[0]["Link"]){ echo "</a>"; }
                ?>
                </div>
            <?php }

                
                
             if ($wmPage["Lang"]!="en" || true) { 
             
                       
                
                ?>
            
            <!-- EVENTS FEED -->
            <div class="homeEventsFeed">
                <div class="row">
                    <div class="d-none d-lg-block col-sm-4 col-md-4 col-lg-4">
                        <div class="titleLine color2"></div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4"><h2><?php echo $trans->getText("This Month in messer");?></h2></div>
                    <div class="d-none d-lg-block col-sm-4 col-md-4 col-lg-4">
                        <div class="titleLine color2"></div>
                    </div>
                </div>



                <div class="row">
                    <?php
                        foreach ($arrHomeEventsRelated as $key=> $value) {
                        $date = date_create($value['Start_Date']);
                        $date =  date_format($date, 'd-m-Y');
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
                        $date =  date_format($date, 'd-m-Y');
                    ?>
               
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                            <a href="<?php echo $link['Link']?>" class="item newFeedItem">
                                <img src="<?php echo $thumb_call.$value['Top_Header']?>" alt="<?php echo $value['Name']?>" title="<?php echo $value['Name']?>" class="newsImg1 img-fluid" />
                                <h4><?php echo $value['Name']?></h4>
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
                          
                    <?php if($key%3==2){echo "<div style='clear:both'></div>";}   } ?>
                </div>

            </div>
	    <?php } 
            
            
                if(is_array($arrCenterBanners[1])){ ?>
                    <div>
                         <?php 
                            if($arrCenterBanners[1]["Link"]){?>
                                <a href="<?php echo $arrCenterBanners[1]["Link"];?>" target="<?php echo $arrCenterBanners[1]["Open_In"];?>">
                        <?php } ?>
                        <img class="img-fluid msrBanner" src="<?php echo $cfg["WM"]["Server"].'/'.$arrCenterBanners[1]['Top_Header']?>"/>
                        <?php 
                            if($arrCenterBanners[1]["Link"]){ echo "</a>"; }
                        ?>
                    </div>
                <?php }

              

                if (count($arr_connected_doctors)>0) {?>
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
        <div class="col-12 col-lg-4 pageSideContent">
            <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
        </div>
    </div>
</div>
