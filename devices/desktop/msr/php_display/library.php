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
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 homeFeed">
            <!-- Updates Feed Title -->
            <div class="feature-title"><?php echo $trans->getText("Updates");?></div>

            <!-- Updates Feed - Items from AJAX -->
            <div class="updates-feed" id="updatesFeed" pageid="<?php echo $id;?>"></div>

            <button class="btn-load-more" id="loadMoreUpdatesBtn" onclick="loadMoreUpdates(10);"><?php echo $trans->getText("Load More");?></button>
        </div>
        <!-- SIDE CONTENT -->
        <div class="col-10 offset-xs-1 col-sm-10 offset-sm-1 col-md-4 offset-md-0 col-lg-4 offset-lg-0 pageSideContent">
            <!-- Opening Hours -->
            <?php if($arrDynamicFieldsFirstBlock[5]["Value"]){ ?>
            <div class="info-block">
                <div class="info-block-header"><?php echo $arrDynamicFieldsFirstBlock[5]["Value"];?></div>
                <div class="info-block-body"><?php echo $arrDynamicFieldsFirstBlock[6]["Value"];?></div>
            </div>
            <?php }?>
            <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
        </div>
    </div>
</div>
