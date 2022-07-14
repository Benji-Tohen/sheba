<!--Big Gallery-->
<div class="container big-gallery">
    <?php if (!empty($arr_pictures)){ ?>
        <div>
            <div class="carousel-inner row_slick_gallery " sum-img="<?php echo count($arr_pictures); ?>">
                <?php $i = 1;
                foreach ($arr_pictures as $item) {
                    $onclick = $item['Code'] == '' ? '' : "window.location.replace('" . $item['Code'] . "')";
                    $thumb_call = $cfg["WM"]["Server"] . "/webfiles/images/cache/1140X450/zcX1/";
                    $thumb_call_mob = $cfg["WM"]["Server"] . "/webfiles/images/cache/768X680/zcX1/";
                ?>
                <?php if(strpos($item["File_Name"], '.mp4') !== false){
                    $videoMobile = $item["File_Name_Mobile"] ? $item["File_Name_Mobile"] : $item["File_Name"]
                ?>
                    <div>
                        <!-- Video desktop -->
                        <div class="item d-none d-md-block">
                            <video autoplay muted loop playsinline class="vid" alt="<?php echo $item["Name"]; ?>">
                            <source src="<?php echo $item["File_Name"]; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                            </video>
                        </div>
                        <!-- Video mobile -->
                        <div class="item d-block d-md-none">
                            <video autoplay muted loop playsinline class="vid" alt="<?php echo $item["Name"]; ?>">
                            <source src="<?php echo $videoMobile; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                <?php } else { ?>
                    <div 
                        class="rowslickitem item <?php echo $i == 1 ? "active" : ""; ?> " 
                        onclick="<?php echo $onclick ?>" 
                        title="<?php echo $item["Name"]; ?>" 
                        onmouseover="this.title='';"
                    >
                        <div class="d-none d-md-block">
                            <img 
                                class="img-fluid img-banner" 
                                src="<?php echo $thumb_call . $item["File_Name"]; ?>" 
                                alt="<?php echo $item["Name"]; ?>" 
                            />
                        </div>
                        <div class="d-block d-md-none">
                            <?php $imgMob = $item["File_Name_Mobile"] ? $item["File_Name_Mobile"] : $item["File_Name"] ?>
                            <img 
                                class="img-fluid" 
                                src="<?php echo $thumb_call_mob . $imgMob; ?>" 
                                alt="<?php echo $item["Name"]; ?>" 
                            />
                        </div>
                        <?php if ($item["Content"]) { ?>
                            <div class="carousel-caption">
                                <h1><?php echo nl2br($item["Content"]); ?></h1>
                            </div>
                        <?php } ?>
                    </div>
                <?php }?>
                <?php $i++;
                } ?>
            </div>
        </div>
    <?php } ?>
    <!--end-->
</div>


<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-8 homeFeed">
            <div class="homeChildrenFeed">

                <!-- CHILDREN FEED -->
                <div class="row">
                    <?php foreach ($arrChildren as $key => $child) {
                        $link = $wm->getLink($child);

                        if ($child['Top_Header'] == '') {
                            $thumb_call = '';
                            $child['Top_Header'] = 'site/images/defaultNewsPic.jpg';
                        } else {
                            $thumb_call = $cfg["WM"]["Server"] . "/webfiles/images/cache/240X160/zcX1/";
                        }
                        if ($child['Page_Type'] != 151) {
                    ?>
                            <div class="col-6 col-sm-6 col-md-4">
                                <a 
                                    class="item newFeedItemEn<?php echo $child['custom_class'] != '' ? " custom_" . $child['custom_class'] : '' ?>"
                                    href="<?php echo $link['Link'] ?>" 
                                    target="<?php echo $link['Target'] ?>" 
                                    title="<?php echo $child['Name'] ? $child["Name"] :  $child["Menu_Name"]; ?>"
                                    name="banner_<?php echo $child['Name'] ? $child['Name'] : $child['Menu_Name'];?>"

                                >
                                    <img 
                                        src="<?php echo $thumb_call . $child['Top_Header'] ?>" 
                                        alt="<?php echo isset($child['Top_Header_Alt']) ? $child['Top_Header_Alt'] : $child['Name'] ?>" 
                                        class="newsImg img-fluid" 
                                    />
                                    <?php if (isset($child['Name']) && !empty($child['Name'])) { ?>
                                        <div class="item-name"><?php echo $child['Name'] ?></div>
                                    <?php } ?>
                                </a>
                            </div>
                        <?php } else { ?>

                            <div class="col-12">
                                <div class="clear"></div>
                                <?php if (isset($child['Name']) && !empty($child['Name'])) { ?>
                                    <h2 class="ItemLongTitle"><?php echo $child['Name'] ?></h2>
                                <?php } ?>
                            </div>
                    <?php }
                    } ?>
                </div>
                <!-- CHILDREN END -->
            </div>
            <!-- NEWS FEED -->
            <?php if (!empty($arrHomeNewsRelated)) { ?>
                <div class="home-news-feed ">
                    <div class="row">
                        <div class="d-none d-sm-block col-sm-4 col-md-4 col-lg-4">
                            <div class="titleLine bgcolor2"></div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <h2><?php echo $trans->getText("News"); ?></h2>
                        </div>
                        <div class="d-none d-sm-block col-sm-4 col-md-4 col-lg-4">
                            <div class="titleLine bgcolor2"></div>
                        </div>
                    </div>
                    <!-- Caroufredsel -->
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <?php
                                foreach ($arrHomeNewsRelated as $value) {
                                    $date = date_create($value['Start_Date']);
                                    $date =  date_format($date, 'd/m/Y');
                                    if ($value['Top_Header'] == '') {
                                        $thumb_call = '';
                                        $value['Top_Header'] = 'site/images/defaultEventPic.jpg';
                                    } else {
                                        $thumb_call = $cfg["WM"]["Server"] . "/webfiles/images/cache/240X160/zcX1/";
                                    }
                                    $link = $wm->getLink($value, true);
                                    /*check if we have mofa date to display*/
                                    $mofaDate = $db->getRow("SELECT Start_Date FROM wm_events WHERE wm_pages=" . intval($value['ID']));
                                    if ($mofaDate['Start_Date'] != '') {
                                        $value['Start_Date'] = $mofaDate['Start_Date'];
                                    }
                                    $date = date_create($value['Start_Date']);
                                    $date =  date_format($date, 'd-m-Y');
                                ?>
                                    <div class="homeNewsItem">
                                        <a 
                                            href="<?php echo $link['Link'] ?>" 
                                            class="item newFeedItem1"
                                            title="<?php echo isset($value['Name']) ? $value['Name'] : $value['Name']; ?>" 
                                        >
                                            <img 
                                                src="<?php echo $thumb_call . $value['Top_Header'] ?>" 
                                                alt="<?php echo isset($value['Top_Header_Alt']) ? $value['Top_Header_Alt'] : $value['Name'] ?>" 
                                                class="img-fluid events-img" 
                                            />
                                            <div class="wrapp-news-text">
                                                <div class="detailscontainer">
                                                    <div class="newFeedItemDate">
                                                        <?php echo $date ?>
                                                    </div>
                                                    <h4><?php echo $value['Name'] ?></h4>
                                                    <?php if ($value["Sub_Title"]) { ?>
                                                        <div class="new-sub-title">
                                                            <?php echo $string->shorten($value["Sub_Title"], 100); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="newsCta">
                                                    <i class="fas fa-angle-double-<?php echo $gui->getRight(); ?> color2 newsChev"></i>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="gray-line"></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- END Caroufredsel -->
                    </div>
                </div>
                <a 
                    href="<?php echo $wm->getIdByPageType(104) ?>"  
                    class="moreButton"
                    title="<?php echo $trans->getText("More News"); ?>"
                >
                    <?php echo $trans->getText("More News"); ?>
                    &nbsp;
                    <i class="fas fa-chevron-<?php echo $gui->getRight(); ?> color2"></i>
                </a>
            <?php } ?>

            <!-- EVENTS FEED -->
            <?php if (!empty($arrHomeEventsRelated)) { 
                include(dirname(__FILE__) . "/../php_components/events_carousel.php");
            }?>
        </div>
        <!-- SIDE CONTENT -->
        <div class="col-12 col-sm-12 col-md-4 pageSideContent">
            <?php include(dirname(__FILE__) . "/../php_components/side_widgets.php"); ?>
        </div>
    </div>
</div>