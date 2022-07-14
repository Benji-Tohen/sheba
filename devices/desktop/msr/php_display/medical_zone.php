<div class="container">
    <!-- Page image -->
    <div class="row">
        <div class="col">
            <!-- Desktop (inner) image -->
            <?php if($wmPage['Top_Header']){ ?>
                <img 
                    src="<?php echo $thumb_inner_img.$wmPage['Top_Header'];?>" 
                    alt="<?php echo str_replace('"','&quot;',$wmPage["Name"]);?>" 
                    class="innerImg img-fluid d-none d-lg-block"
                />
            <?php }?>
            <!-- Mobile (inner) image -->
            <?php if($wmPage['Top_Header2']){ ?>
                <img 
                    src="<?php echo $thumb_mobile_img.$wmPage['Top_Header2'];?>" 
                    alt="<?php echo str_replace('"','&quot;',$wmPage["Name"]);?>" 
                    class="innerImg img-fluid d-block d-lg-none"
                />
            <!-- Mobile (outer) image -->
            <?php } else if($wmPage['Top_Header']){ ?>
                <img 
                    src="<?php echo $thumb_mobile_img.$wmPage['Top_Header'];?>" 
                    alt="<?php echo str_replace('"','&quot;',$wmPage["Name"]);?>" 
                    class="innerImg img-fluid d-block d-lg-none"
                />
            <?php }?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?> col-lg-8<?php } else { ?> col-lg-12<?php }?>"">
            <h1><?php echo $wmPage['h1'];?></h1>
            <div class="content"><?php echo $wmPage['Content'];?></div>

            <!-- field_of_activity -->
            <?php if(!empty($field_of_activity_children)){ ?>
                <h2><?php echo $field_of_activity['h1'];?></h2>

                <!-- Carousel -->
                <div class="fields-of-activity-carousel" id="field_of_activity">
                    <?php foreach ($field_of_activity_children as $itemKey => $itemVal) { 
                        $link = $wm->getLink($itemVal);
                    ?>
                        <div>
                            <!-- Item -->
                            <a href="<?php echo $link['Link']?>" class="slickItem">
                                <img 
                                    src="<?php echo $thumb_item_img.$itemVal['Top_Header']?>" 
                                    alt="<?php echo $itemVal['Name']?>" 
                                    title="<?php echo $itemVal['Name']?>" 
                                    class="img-fluid slick-item-img" 
                                />

                                <h4><?php echo $itemVal['h1'];?></h4>
                            </a>
                        </div>
                    <?php }?>
                </div>

                <div class="divider-line"></div>
            <?php }?>

            <!-- field_of_activity_rows -->
            <?php if(!empty($field_of_activity_children_rows)){ ?>
                <h2><?php echo $field_of_activity_rows['h1'];?></h2>

                <!-- Carousel -->
                <div class="fields-of-activity-rows" id="field_of_activity-rows">
                    <div class="row">
                        <?php foreach ($field_of_activity_children_rows as $itemKey => $itemVal) { 
                                $link = $wm->getLink($itemVal);
                            ?>
                                <div class="col-6 col-sm-6 col-md-4 px-0 my-4 mx-0">
                                    <!-- Item -->
                                    <a href="<?php echo $link['Link']?>" class="slickItem">
                                        <img 
                                            src="<?php echo $thumb_item_img.$itemVal['Top_Header']?>" 
                                            alt="<?php echo $itemVal['Name']?>" 
                                            title="<?php echo $itemVal['Name']?>" 
                                            class="img-fluid slick-item-img" 
                                        />

                                        <h4><?php echo $itemVal['h1'];?></h4>
                                    </a>
                                </div>
                        <?php }?>
                    </div>
                </div>

                <div class="divider-line"></div>
            <?php }?>


            <!-- doctors -->
            <?php if(!empty($arr_connected_doctors)){ ?>
                <h2><?php echo $trans->getText('Clinic Team');?></h2>

                <!-- Carousel -->
                <div class="doctors-slider" id="doctors_slider">
                    <?php foreach ($arr_connected_doctors as $itemKey => $itemVal) { 
                        $link = $wm->getLink($itemVal);
                    ?>
                        <div>
                            <!-- Item -->
                            <a href="<?php echo $link['Link']?>" class="slickItem">
                                <img 
                                    src="<?php echo $thumb_doctor_img.$itemVal['Top_Header']?>" 
                                    alt="<?php echo $itemVal['Name']?>" 
                                    title="<?php echo $itemVal['Name']?>" 
                                    class="slick-item-img doctor-item" 
                                />

                                <h4><?php echo $itemVal['Name'];?></h4>

                                <?php if($itemVal['Sub_Title']){ ?>
                                    <h5><?php echo nl2br($itemVal['Sub_Title']);?></h5>
                                <?php }?>
                            </a>
                        </div>
                    <?php }?>
                </div>

                <div class="divider-line"></div>
            <?php }?>


            <!-- Page gallery -->
            <?php if (!empty($arr_pictures)){ ?>
                <div class="carousel-inner row_slick_gallery" sum-img="<?php echo count($arr_pictures); ?>" id="inner_gallery">
                    <?php 
                    foreach ($arr_pictures as $itemKey => $item) {
                        $onclick = $item['Code'] == '' ? '' : "window.location.replace('" . $item['Code'] . "')";
                        $isVideo = (strpos($item["File_Name"], '.mp4') === false) ? false : true;
                    ?>
                        <div 
                            class="gallery-item" 
                            onclick="<?php echo $onclick ?>" 
                            title="<?php echo $item["Name"]; ?>" 
                            onmouseover="this.title='';"
                        >
                            <?php if($isVideo){ ?>
                                <video autoplay muted loop controls playsinline class="vid" alt="<?php echo $item["Name"]; ?>">
                                    <source src="<?php echo $item["File_Name"]; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php } else { ?>
                                <img 
                                    class="img-fluid img-banner" 
                                    src="<?php echo $item["File_Name"]; ?>" 
                                    alt="<?php echo $item["Name"]; ?>" 
                                />
                            <?php }?>
                        </div>
                    <?php $i++;
                    } ?>
                </div>

                <div class="divider-line"></div>
            <?php } ?>


            <!-- tests -->
            <?php if(!empty($medical_zone_tests_children)){ ?>
                <h2><?php echo $medical_zone_tests['h1'];?></h2>

                <?php
                foreach ($medical_zone_tests_children as $itemKey => $itemVal) {
                    $link = $wm->getLink($itemVal);
                ?>
                    <div>
                        <a 
                            href="<?php echo $link['Link'] ?>" 
                            class="feed-item d-flex justify-content-center justify-content-lg-start flex-column flex-lg-row"
                            title="<?php echo isset($itemVal['Name']) ? $itemVal['Name'] : $itemVal['Name']; ?>" 
                        >
                            <img 
                                src="<?php echo $thumb_item_img.$itemVal['Top_Header']; ?>" 
                                alt="<?php echo isset($itemVal['Top_Header_Alt']) ? $itemVal['Top_Header_Alt'] : $itemVal['Name'] ?>" 
                                class="img-fluid" 
                            />
                            <div>
                                <h4><?php echo $itemVal['Name'] ?></h4>
                                <?php if ($itemVal["Sub_Title"]) { ?>
                                    <div class="feed-item-subtitle">
                                        <?php echo nl2br($itemVal["Sub_Title"]); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </a>
                    </div>
                <?php } ?>
                
                <div class="divider-line"></div>
            <?php } ?>


            <!-- treatments -->
            <?php if(!empty($treatments_children)){ ?>
                <h2><?php echo $treatments['h1'];?></h2>

                <?php
                foreach ($treatments_children as $itemKey => $itemVal) {
                    $link = $wm->getLink($itemVal);
                ?>
                    <div>
                        <a 
                            href="<?php echo $link['Link'] ?>" 
                            class="feed-item d-flex justify-content-center justify-content-lg-start flex-column flex-lg-row"
                            title="<?php echo isset($itemVal['Name']) ? $itemVal['Name'] : $itemVal['Name']; ?>" 
                        >
                            <img 
                                src="<?php echo $thumb_item_img.$itemVal['Top_Header']; ?>" 
                                alt="<?php echo isset($itemVal['Top_Header_Alt']) ? $itemVal['Top_Header_Alt'] : $itemVal['Name'] ?>" 
                                class="img-fluid" 
                            />
                            <div>
                                <h4><?php echo $itemVal['Name'] ?></h4>
                                <?php if ($itemVal["Sub_Title"]) { ?>
                                    <div class="feed-item-subtitle">
                                        <?php echo nl2br($itemVal["Sub_Title"]); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </a>
                    </div>
                <?php } ?>

                <div class="divider-line"></div>
            <?php } ?>


            <!-- clinical_studies_children -->
            <?php if(!empty($clinical_studies_children)){ ?>
                <h2><?php echo $clinical_studies['h1'];?></h2>

                <?php
                foreach ($clinical_studies_children as $itemKey => $itemVal) {
                    $link = $wm->getLink($itemVal);
                ?>
                    <div class="clinical-studies">
                        <a 
                            href="<?php echo $link['Link'] ?>" 
                            class="feed-item d-flex justify-content-start"
                            title="<?php echo isset($itemVal['Name']) ? $itemVal['Name'] : $itemVal['Name']; ?>" 
                        >
                            <div class="item-arrow">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <h4><?php echo $itemVal['Name'] ?></h4>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Form -->
            <?php include_once($device.'/php_components/dynamic_form/form_html.php');?>
        </div>

        <?php if($wmPage["Enable_SideContent"]){ ?>
        <!-- SIDE CONTENT -->
        <div class="col-12 col-lg-4 mt-4 mt-lg-0 pageSideContent">
            <div class="side-block">
                <!-- Contact -->
                <div class="contact-block">
                    <?php if($medical_zone_contact_title){?>
                    <div class="contact-title"><?php echo $medical_zone_contact_title;?></div>
                    <?php }?>
                    <?php if($medical_zone_contact_content){?>
                        <div class="contact-content"><?php echo $medical_zone_contact_content;?></div>
                    <?php }?>
                    <?php if($medical_zone_contact_btn_link){?>
                        <a class="contact-btn" href="<?php echo $medical_zone_contact_btn_link;?>"><?php echo $medical_zone_contact_btn_title;?></a>
                    <?php }?>
                    <?php if($medical_zone_contact_link_url){?>
                        <a class="contact-link" href="<?php echo $medical_zone_contact_link_url;?>"><?php echo $medical_zone_contact_link_title;?></a>
                    <?php }?>
                </div>

                <!-- stories -->
                <?php if(!empty($stories_children)){ ?>
                    <div class="stories">
                        <h2 class="stories-title"><?php echo $stories['h1'];?></h2>

                        <?php
                        foreach ($stories_children as $itemKey => $itemVal) {
                            $link = $wm->getLink($itemVal);
                        ?>
                            <div>
                                <a 
                                    href="<?php echo $link['Link'] ?>" 
                                    class="feed-item d-flex flex-column justify-content-center"
                                    title="<?php echo isset($itemVal['Name']) ? $itemVal['Name'] : $itemVal['Name']; ?>" 
                                >
                                    <img 
                                        src="<?php echo $thumb_stories_img.$itemVal['Top_Header']; ?>" 
                                        alt="<?php echo isset($itemVal['Top_Header_Alt']) ? $itemVal['Top_Header_Alt'] : $itemVal['Name'] ?>" 
                                        class="img-fluid" 
                                    />
                                    <div>
                                        <h4><?php echo $itemVal['Name'] ?></h4>
                                        <?php if ($itemVal["Sub_Title"]) { ?>
                                            <div class="feed-item-subtitle">
                                                <?php echo $string->shorten($itemVal["Sub_Title"], 100); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if(!empty($medical_zone_more)){ ?>
                    <!-- Glossary of Terms -->
                    <div class="got-block">
                        <?php if($medical_zone_more['Content']){?>
                        <div class="got-title"><?php echo $medical_zone_more['Content'];?></div>
                        <?php }?>
                    </div>

                    <div class="divider-line"></div>
                    
                    <!-- Q&A -->
                    <div class="qna-block">
                        <?php if($medical_zone_more['Content_Center']){?>
                        <div class="qna-title"><?php echo $medical_zone_more['Content_Center'];?></div>
                        <?php }?>
                    </div>
                <?php }?>

                <div class="divider-line"></div>

                <!-- medical_zone_more -->
                <?php if(!empty($medical_zone_more_children)){ ?>
                    <div class="medical-zone-more">
                        <h2 class="medical-zone-more-title"><?php echo $medical_zone_more['h1'];?></h2>

                        <?php
                        foreach ($medical_zone_more_children as $itemKey => $itemVal) {
                            $link = $wm->getLink($itemVal);
                        ?>
                            <div>
                                <a 
                                    href="<?php echo $link['Link'] ?>" 
                                    class="feed-item d-flex justify-content-start"
                                    title="<?php echo isset($itemVal['Name']) ? $itemVal['Name'] : $itemVal['Name']; ?>" 
                                >
                                    <div class="item-arrow">
                                        <i class="fas fa-chevron-left"></i>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h4><?php echo $itemVal['Name'] ?></h4>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php include(dirname(__FILE__) . "/../php_components/side_widgets.php"); ?>
            </div>
        </div>
    <?php } ?>
    </div>
</div>