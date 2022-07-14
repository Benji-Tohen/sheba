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
                        <img src="<?php echo $thumb_call.$item["File_Name"];?>" alt="<?php echo $item["Name"];?>" class="img-fluid"/>
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


<!-- TTO ITEMS -->
<div class="tto-items">
    <div class="container">
        <div class="row">
            <?php 
            foreach ($arrChildren as $key => $child) {
                $link=$wm->getLink($child);
                if($child['Top_Header'] == ''){
                    $items_thumb='';
                    $child['Top_Header'] = 'site/images/defaultNewsPic.jpg';
                }
                if($child['Page_Type'] != 151){
                ?>
                <a 
                    href="<?php echo $link['Link']?>" 
                    target="<?php echo $link['Target']?>" 
                    title="<?php echo $child['Name']?>" 
                    class="col-12 col-sm-12 col-md-3 col-lg-3 item <?php echo $child['custom_class'] != '' ? " custom_".$child['custom_class'] : ''?>"
                >
                    <img 
                        src="<?php echo $items_thumb.$child['Top_Header']?>" 
                        alt="<?php echo $child['Name']?>" 
                        class="newsImg" 
                    />
                    <h4><?php echo $child['Name']?></h4>
                </a>
                <?php }else{ ?>
                </div>
                <div class="row">
                <div class="col-12">
                        <?php if(isset($child['Name']) && !empty($child['Name'])){?>
                            <h2 class="ItemLongTitle"><?php echo $child['Name']?></h2>
                        <?php }?>
                </div>
            <?php }
        }?>
        </div>
    </div>
</div>
<!-- TTO ITEMS -->