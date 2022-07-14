


<div class="container">
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
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 homeFeed">
            <!-- CHILDREN FEED -->
            <div class="row homeChildrenFeed">
                <?php 
                foreach ($arrChildren as $key => $child) {
                    $link=$wm->getLink($child, true);
                    if($key == 5){break;}/*max 6 children*/
                    if($key == 3){?>
                        <!-- FIRST BANNER MIDDLE -->
                        <?php 
                        if(is_array($firstBanner)){
                            ?>
                            <img src="<?php echo $thumb_call_banner.$firstBanner['File_Name']?>" alt="<?php echo $firstBanner['Value']?>" title="<?php echo $firstBanner['Value']?>" class="img-responsive bannerImg" />
                        <?php }?>

                        <!-- FIRST BANNER MIDDLE - END -->
                    <?php }
                    if($child['Top_Header'] == ''){
                        $thumb_call='';$child['Top_Header'] = 'site/images/defaultNewsPic.jpg';
                    }else{
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                    }
                    ?> 
                    <a href="<?php echo $link['Link']?>" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 item newFeedItem">
                        <img src="<?php echo $thumb_call.$child['Top_Header']?>" alt="<?php echo $child['Name']?>" title="<?php echo $child['Name']?>" class="newsImg" />
                        <h4><?php echo $child['Name']?></h4>
                    </a>
                    <?php if($key == 2){
                        echo "<div class='clear'></div>";
                    }?>
                <?php }?>
                
            </div>
            <!-- CHILDREN END -->
                  
            <!-- WEEKLY CALENDAR -->
            <?php include(dirname(__FILE__)."/../php_components/getWeeklyCalendarHotel.php");?>
            <!-- WEEKLY CALENDAR END -->
           
            
           
            
            
        </div>
        <!-- SIDE CONTENT -->
        <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
            <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
        </div>
    </div>
</div>
