<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <?php if($arr_pictures){?>
        <?php if ($arr_pictures[$i]["Name"]) { ?><h3 class="title"><?php echo $arr_pictures[$i]["Name"];?></h3><?php } ?>
    <?php }?>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <div class="row page-header"> 
                <!-- INNER IMAGE -->
                <div class="col-12 col-md-4 col-lg-4">
                    <?php if($wmPage["Top_Header"]!=''){
                        $thumbWidth=$params->getValue("imgThumbWidth");
                        $thumbHeight=$params->getValue("imgThumbHeight");
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."186"."X"."228"."/aoeX1/".$wmPage["Top_Header"];
                    }else{
                        $thumbWidth=$params->getValue("imgThumbWidth");
                        $thumbHeight=$params->getValue("imgThumbHeight");
                        $thumb_call=$cfg["WM"]["Server"].$drPic['picture'];
                    } ?>
                    <div class="innerImg">
                        <img 
                            src="<?php echo $thumb_call;?>" 
                            alt="<?php echo str_replace('"','&quot;',$wmPage["Name"]);?>" 
                            class="innerImage img-fluid" 
                        />
                        <?php if($wmPage["Video_Text"]){?>
                            <div class="videoAndImageDescription">
                                <?php echo $wmPage["Video_Text"];?>
                            </div>
                        <?php }?>
                    </div>

                    <?php if($arrDynamicFieldsFirstBlock[4]['Value']){/*show link to yuotube video if exists*/?>
                        <button 
                            class="watch-video-btn"
                            onclick="showDocVideo();"
                        >
                            <div class="watch-video-btn-icon"></div>
                            <div class="watch-video-btn-label">
                                <?php echo $arrDynamicFieldsFirstBlock[5]['Value']!='' ? $arrDynamicFieldsFirstBlock[5]['Value']:$trans->getText('watch video') ?>
                            </div>
                        </button>
                        <div class="fullScreenIframeWrap">
                            <button 
                                class="closeVideoPop" 
                                onclick="closeDocVideo()"
                                ><i class="fas fa-times" aria-hidden="true"></i>
                            </button>
                            <iframe 
                                class="fullScreenIframe" width="100%" height="100%" 
                                src="https://www.youtube.com/embed/<?php echo $arrDynamicFieldsFirstBlock[4]['Value']?>" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                        </div>
                    <?php }?>

                    <?php if($wmPage["is_specialist_doctor"]){ ?>
                        <a 
                            href="<?php echo $params->getValue('surgeon_selection_link');?>" 
                            title="<?php echo $trans->getText('is_specialist_doctor');?>" 
                            class="specialist_doctor"
                        >
                            <img 
                                src="<?php echo $cfg["WM"]["Server"].'/webfiles/icons/sheba-yashir_doctor_page-BTN.png'; ?>" 
                                alt="<?php echo $trans->getText('is_specialist_doctor');?>" 
                                class="specialistDoctorImg" 
                            />
                        </a>
                    <?php } ?>
                </div>
                <!-- END INNER IMAGE -->
                <?php /*first block of fiedls display*/?>
                <div class="col-12 col-md-8 col-lg-8 doctorInfo">
                    <h1>
                        <?php echo $wmPage["h1"];?>
                    </h1>
                    <?php if($arrDynamicFieldsFirstBlock[2]['Value']) { ?>
                        <a   
                            href="mailto:<?php echo $arrDynamicFieldsFirstBlock[2]['Value']?>"
                            title="<?php echo $arrDynamicFieldsFirstBlock[2]['Value']?>"
                            >
                            <h3 class="doctorEmail mb-4">
                                <i class="fas fa-envelope"></i>
                                <?php echo $arrDynamicFieldsFirstBlock[2]['Value']?>
                            </h3>
                        </a>
                    <?php } ?>
                    <div class="clear"></div>
                    <?php if ($arrDynamicFieldsFirstBlock[3]['Value']) { ?>
                        <i class="fas fa-phone-alt"></i>
                        <a 
                            class="callMobile" 
                            title=" <?php echo $arrDynamicFieldsFirstBlock[3]['Value']?>"
                            href="tel:<?php echo $arrDynamicFieldsFirstBlock[6]['Value'] != '' ? $arrDynamicFieldsFirstBlock[6]['Value'] : $arrDynamicFieldsFirstBlock[3]['Value']?>">
                            <h3 class="doctorPhone">
                                <?php echo $arrDynamicFieldsFirstBlock[3]['Value']?>
                            </h3>
                        </a>
                        <h3 class="callDesktop">
                            <span class="number-phone">
                                <?php echo $arrDynamicFieldsFirstBlock[3]['Value']?>
                            </span>
                        </h3>
                    <?php } ?>
                    <div class="clear "></div>
                    <div class="doc-row-between">
                        <button 
                            title="<?php echo $trans->getText("Back to previus");?>" 
                            onclick= " <?php echo $backLink;?>"
                            class="back-to-doc-search ts"
                            id="backBtn"
                            ><?php echo $trans->getText("Back to previus");?>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs" id="doktor-tab" role="tablist">
                                <li class="nav-item">
                                    <a  
                                        class="nav-link active" 
                                        href="#tab1default" 
                                        data-toggle="tab"
                                        aria-selected="true"
                                        aria-controls="<?php echo $trans->getText("Profile")?>"
                                        id="profile-tab"
                                        title="<?php echo $trans->getText("Profile")?>"
                                    >
                                        <h4>
                                            <?php echo $trans->getText("Profile")?>
                                        </h4>
                                    </a>
                                </li>
                                <?php if($wmPage["Content_Center"]){ ?>
                                    <li class="nav-item">
                                        <a 
                                            class="nav-link" 
                                            href="#tabGratitude" 
                                            data-toggle="tab"
                                            aria-selected="true"
                                            aria-controls="<?php echo $trans->getText("Gratitude")?>"
                                            title="<?php echo $trans->getText("Gratitude")?>"
                                            id="gratitude-tab"
                                        >
                                            <h4>
                                                <?php echo $trans->getText("Gratitude")?>
                                            </h4>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                      
                        <div class="tab-content" id="nav-doktor-content-tab">
                            <div class="tab-pane fade show active panel-body" id="tab1default" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="topTabSection row">
                                    <?php /*second block of fiedls display*/
                                    $numItems = count($arrDynamicFieldsSecondBlock);
                                    for($i=0;$i<=$numItems;$i=$i+=2){?>
                                        <div class="col-12 col-md-5 col-lg-5">
                                            <?php if ($trans->getText($arrDynamicFieldsSecondBlock[$i]['Name'])&&$arrDynamicFieldsSecondBlock[$i]['Value']) { ?>
                                                <div class="doctorInfoGroup">
                                                    <h4 class="doctorInfoTitle"><?php echo $trans->getText($arrDynamicFieldsSecondBlock[$i]['Name'])?></h4>
                                                    <?php if ($arrDynamicFieldsSecondBlock[$i]['Value']) { ?>
                                                        <h4><?php echo $arrDynamicFieldsSecondBlock[$i]['Value']?></h4>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            <?php if (isset($arrDynamicFieldsSecondBlock[$i+1])&&$trans->getText($arrDynamicFieldsSecondBlock[$i+1]['Name'])&&$arrDynamicFieldsSecondBlock[$i+1]['Value']) { ?>
                                                <div class="doctorInfoGroup">
                                                    <h4 class="doctorInfoTitle"><?php echo $trans->getText($arrDynamicFieldsSecondBlock[$i+1]['Name'])?></h4>
                                                    <?php if (isset($arrDynamicFieldsSecondBlock[$i+1])&&$arrDynamicFieldsSecondBlock[$i+1]['Value']) { ?>
                                                        <h4>
                                                            <?php echo $arrDynamicFieldsSecondBlock[$i+1]['Value']?>
                                                        </h4>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php }?>
    
                                    <?php if(isset($arrDynamicFieldsFirstBlock[7]['Value']) && $arrDynamicFieldsFirstBlock[7]['Value']){ ?>
                                    <div class="col-12">
                                        <h4 class="doctorInfoTitle">
                                            <?php echo $trans->getText($arrDynamicFieldsFirstBlock[7]['Name'])?>
                                        </h4>
                                        <h4>
                                            <?php echo $arrDynamicFieldsFirstBlock[7]['Value']?>
                                        </h4>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="col-12 bottomPanelBody">
                                    <?php /*third block of fiedls display*/
                                    foreach ($arrDynamicFieldsThirdBlock as $key => $value) {
                                        if($value['Value']!=''){?>
                                            <?php if($trans->getText($value['Name'])) { ?>
                                                <h4 class="doctorInfoTitle">
                                                    <?php echo $trans->getText($value['Name'])?>
                                                </h4>
                                            <?php } ?>
                                            <div class="richtext">
                                                <?php echo html_entity_decode(str_replace('&nbsp;', ' ', htmlentities($value['Value']))); ?>
                                            </div>
                                            <div class="clear"></div>
                                        <?php }?>
                                    <?php }?>
                                    <div class="richtext">
                                        <?php echo $wmPage["Content"];?>
                                    </div>
                                </div>
                            </div>

                            <?php if($wmPage["Content_Center"]){ ?>
                                <div class="tab-pane panel-body fade" id="tabGratitude" role="tabpanel" aria-labelledby="gratitude-tab">
                                    <div class="col-12">
                                        <div class="richtext">
                                            <?php echo $wmPage["Content_Center"];?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-12 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>      
</div>    

