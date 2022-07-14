<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <?php if($arr_pictures){?>
        <h3 class="title"><?php echo $arr_pictures[$i]["Name"];?></h3>
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



<div class="container eventPage">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            
            <div class="row eventHeader">
                <div class="col-12 col-md-2 col-lg-2">
                    <div class="dateCircle">
                        <?php 
                        /*TODO need to do setlocale according to wm_lang in index top*/
                       /*check if we have mofa date to display*/
                             $mofaDate = $db->getRow("SELECT Start_Date FROM wm_events WHERE wm_pages=".intval($wmPage['ID']));
                             if($mofaDate['Start_Date']!=''){
                                $wmPage['Start_Date']=$mofaDate['Start_Date'];
                             }
                            $date = date_create($value['Start_Date']);
                            $date =  date_format($date, 'd-m-Y');
                        
                         setlocale(LC_ALL,"he_IL.UTF-8");
                         $eventDate = $wmPage['Start_Date'];
                         $datetime = new DateTime($eventDate);
                         $timestamp = strtotime($wmPage['Start_Date']);
                         $eventDayNum = $datetime->format('d');
                         $eventDayStr = strftime('%A', $timestamp); 
                         $eventMonthStr = strftime("%b",$timestamp);
                         /*if($_SERVER['REMOTE_ADDR'] == '31.168.120.186'){
                                    echo "shery: ";
                                    echo "<pre>";
                                    print_r($wmPage);
                                    echo "</pre>";

                            } */
                        ?>
                        <div class="dayNum"><?php echo $eventDayNum?></div>
                        <div class="mounthText"><?php echo $eventMonthStr?></div>
                    </div>
                </div>
                
                <div class="col-12 col-md-10 col-lg-10">
                    <h1><?php echo $wmPage["h1"];?></h1>
                    <h6 class="eventDayTitle"><strong><?php echo $trans->getText("event day")?>:&nbsp;</strong><?php echo $eventDayStr?></h6>
                    <h6 class="eventHourTitle"><strong><?php echo $trans->getText("event hour")?>:&nbsp;</strong><?php echo $wmPage['Start_Time']?></h6>
                    <h6 class="eventPlaceTitle"><strong><?php echo $trans->getText("event location")?>:&nbsp;</strong><?php echo $arrPlace["Name"]?></h6>
                </div>
            </div>
            
            <div class="eventItemsWrap">
                <?php foreach ($arrChildrenContent as $value) {?>
                <!-- EVENT ITEM -->
                <div class="row eventItem">
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="eventItemHour">
                            <h5><?php echo $value['Name']?></h5>
                        </div>
                    </div>

                    <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                        <h5 class="eventItemTitle"><?php echo $value['Sub_Title']?></h5>
                        <?php // <h5 class="eventItemText"></h5> ?>
                    </div>
                </div>
                <!-- END EVENT ITEM -->
                <?php }?>
            </div>
            
            <div class="row eventDescriptionWrap">
                <?php if($wmPage["Top_Header2"]){ ?>
                
                
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="eventDescription">
                        <?php /*<h3><?php echo $trans->getText("Signup for the event")?></h3>*/?>
                        <div class="richtext"><?php echo $wmPage["Content"];?></div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-6">
                    <!-- INNER IMAGE -->
                    <?php if($wmPage["Top_Header2"]){
                    $thumbWidth=$params->getValue("imgThumbWidth");
                    $thumbHeight=$params->getValue("imgThumbHeight");
                    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."340"."X"."500"."/zcX1/";
                    ?>
                    <div class="innerImg">
                        <img src="<?php echo $cfg["WM"]["Server"].'/'.$wmPage["Top_Header2"];?>" alt="<?php echo $wmPage["Name"]?>" title="<?php echo $wmPage["Name"]?>" class="innerImage img-fluid" />

                        <?php if($wmPage["Video_Text"]){?>
                            <div class="videoAndImageDescription"><?php echo $wmPage["Video_Text"];?></div>
                        <?php }?>
                    </div>
                    <?php }?>
                    <!-- END INNER IMAGE -->
                </div>
                <?php }else{ ?>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="eventDescription">
                        <?php /*<h3><?php echo $trans->getText("Signup for the event")?></h3>*/?>
                        <div class="richtext"><?php echo $wmPage["Content"];?></div>
                    </div>
                </div>
                
                    <?php /*
                <div class="col-12 col-md-6 col-lg-6">
                    <!-- INNER IMAGE -->
                    <?php if($wmPage["Top_Header2"]){
                    $thumbWidth=$params->getValue("imgThumbWidth");
                    $thumbHeight=$params->getValue("imgThumbHeight");
                    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."340"."X"."500"."/zcX1/";
                    ?>
                    <div class="innerImg">
                        <img src="<?php echo $cfg["WM"]["Server"].'/'.$wmPage["Top_Header2"];?>" alt="<?php echo $wmPage["Name"]?>" title="<?php echo $wmPage["Name"]?>" class="innerImage img-fluid" />

                        <?php if($wmPage["Video_Text"]){?>
                            <div class="videoAndImageDescription"><?php echo $wmPage["Video_Text"];?></div>
                        <?php }?>
                    </div>
                    <?php }?>
                    <!-- END INNER IMAGE -->
                </div>
                */?>
                
                <?php } ?>
                
            </div>
            <?php if($wmPage["wm_forms"]){
                $formPageId=$wm->getIdByPageType(6);
                $formPageData=$wm->getValues($formPageId);

                $link=$wm->getLink($formPageData);
            ?>
            <div class="row">
                <div class="col-12">
                    <a href='<?php echo $link["Link"]."/אירוע/".$mofaId;?>'>
	                    <div class="eventRegisterButton">
    		                <?php echo ($wmPage["Form_Btn_Text"]) ? $wmPage["Form_Btn_Text"] : $trans->getText("Register for the event"); ?>
            	        </div>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-12 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>    
</div>
