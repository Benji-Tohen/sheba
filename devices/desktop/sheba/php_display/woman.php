<div class="container-fluid noPadding bigGallery">
    <!--Big Gallery-->
    <?php if(!empty($arr_pictures)){?>
    <div class="row noMargin">
        <div class="col-12 noPadding">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner row_slick_gallery" sum-img="<?php  echo count($arr_pictures); ?>">
                    <?php $i=1; foreach($arr_pictures as $item){
                        $onclick = $item['Code'] == '' ? '': "window.location.replace('".$item['Code']."')";
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/1920X550/zcX1/";
                        $thumb_call_mob=$cfg["WM"]["Server"]."/webfiles/images/cache/768X680/zcX1/";
                    ?>
                    <div 
                        onclick="<?php echo $onclick?>" 
                        title="<?php echo $item["Name"];?>" 
                        class="rowslickitem item <?php echo $i==1?"active":"";?> " onmouseover="this.title='';"
                    >
                        <div class="d-none d-lg-block">
                            <img  
                                class="img-fluid" 
                                src="<?php echo $thumb_call.$item["File_Name"];?>" 
                                alt="<?php echo $item["Name"];?>" 
                            />
                        </div>
                        <div class="d-block d-lg-none">
                            <?php $imgMob = $item["File_Name_Mobile"] ?$item["File_Name_Mobile"] :$item["File_Name"] ?>
                            <img 
                                class="img-fluid" 
                                src="<?php echo $thumb_call_mob.$imgMob;?>" 
                                alt="<?php echo $item["Name"];?>" 
                            />
                        </div>
                        <?php if($item["Content"]){?>
                            <div class="carousel-caption">
                                <h1><?php echo $item["Content"];?></h1>
                            </div>
                        <?php }?>
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
        <div class="col-12 col-md-8 col-lg-8 homeFeed">
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
                <a href="<?php echo $link['Link']?>" target="<?php echo $link['Target']?>" class="col-12 col-md-4 col-lg-4 item newFeedItem<?php echo $child['custom_class'] != '' ? " custom_".$child['custom_class'] : ''?>">
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
            if(is_array($firstBanner)) {
                if($firstBanner['URL']) {?>
                    <a href="<?php echo $firstBanner['URL'];?>" title="<?php echo $firstBanner['Name']; ?>">
                        <img 
                            src="<?php echo $thumb_call_banner.$firstBanner['File_Name']?>" 
                            alt="<?php echo $firstBanner['Value']?>" 
                            class="img-fluid bannerImg" 
                        />
                    </a>
                <?php } else {?>
                        <img 
                            src="<?php echo $thumb_call_banner.$firstBanner['File_Name']?>" 
                            alt="<?php echo $firstBanner['Value']?>" 
                            class="img-fluid bannerImg" 
                        />
                <?php }
            }?>

            
            <!-- FIRST BANNER MIDDLE - END -->
            <?php if(!empty($arrHomeNewsRelated)){ ?>
            
            <!-- NEWS FEED -->
            <?php include(dirname(__FILE__) . "/../php_components/news_carousel.php"); ?>

            <!-- END Caroufredsel -->
            <?php }?>
            <!-- SECOND BANNER MIDDLE -->
            <?php 
            if(is_array($secondBanner)) {
                if($secondBanner['URL']) {?>
                    <a href="<?php echo $secondBanner['URL'];?>" title="<?php echo $secondBanner['Name']; ?>">
                        <img 
                            src="<?php echo $thumb_call_banner.$secondBanner['File_Name']?>" 
                            alt="<?php echo $secondBanner['Value']?>" 
                            class="img-fluid bannerImg" 
                        />
                    </a>
                <?php } else {?>
                    <img 
                        src="<?php echo $thumb_call_banner.$secondBanner['File_Name']?>" 
                        alt="<?php echo $secondBanner['Value']?>" 
                        class="img-fluid bannerImg" 
                    />
                <?php }
            }?> 
            <!-- SECOND BANNER MIDDLE - END -->

            <!-- Events carousel -->
            <?php include(dirname(__FILE__) . "/../php_components/events_carousel.php"); ?>

            <?php /*
            <div class="carouselWrap">
                <?php if(count($arr_connected_doctors) > 0){?>
                    <h2 class="clinicTeamTitle"><?php echo $trans->getText("Clinic Team");?></h2>
                    <?php
                    echo '<div id="carousel">';
                    foreach ($arr_connected_doctors as $doctor) {
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/120X150/zcX1/";
                        ?>
                        <a 
                            href="<?php echo $cfg["WM"]["Server"].'/'.$doctor['ID']?>" 
                            class="item"
                            title="<?php echo $doctor['Name']?>" 
                        >
                            <img 
                                src="<?php echo $thumb_call.$doctor['Top_Header']?>" 
                                alt="<?php echo $doctor['Name']?>" 
                                class="doctorImg" 
                            />
                            <h5 class="doctorName"><?php echo $doctor['Name']?></h5>
                        </a>
                    <?php }
                    echo "</div>";
                    echo '<a id="prevItem" class="next galleryArrowLeft" href="#" style="display: block;"></a>';
                    echo '<a id="nextItem" class="next galleryArrowRight" href="#" style="display: block;"></a>';
                }?>
            </div>
            */ ?>
        </div>
        
        <!-- SIDE CONTENT -->
        <div class="col-10 offset-xs-1 col-sm-10 offset-sm-1 col-md-4 offset-md-0 col-lg-4 offset-lg-0 pageSideContent">
            <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
        </div>
    </div>
</div>
