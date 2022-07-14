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



<div class="container doctorPage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            
            <div class="row pageHeader">
                <!-- INNER IMAGE -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <?php 
                   
                    if($wmPage["Top_Header"]!=''){
                    $thumbWidth=$params->getValue("imgThumbWidth");
                    $thumbHeight=$params->getValue("imgThumbHeight");
                    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."186"."X"."228"."/aoeX1/".$wmPage["Top_Header"];
                    }else{
                    $thumbWidth=$params->getValue("imgThumbWidth");
                    $thumbHeight=$params->getValue("imgThumbHeight");
                    $thumb_call=$cfg["WM"]["Server"].$drPic['picture'];
                     } ?>
                    <div class="innerImg">
                        <img src="<?php echo $thumb_call;?>" alt="<?php echo str_replace('"','&quot;',$wmPage["Name"]);?>" title="<?php echo str_replace('"','&quot;',$wmPage["Name"]); ?>" class="innerImage img-responsive" />

                        <?php if($wmPage["Video_Text"]){?>
                            <div class="videoAndImageDescription"><?php echo $wmPage["Video_Text"];?></div>
                        <?php }?>
                    </div>
                    
                </div>
                <!-- END INNER IMAGE -->
                <?php /*first block of fiedls display*/
                ?>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 doctorInfo">
                    <h1><?php echo $wmPage["Name"];?></h1>
                    <?php if ($arrDynamicFieldsFirstBlock[2]['Value']) { ?>
                    <i class="fa fa-envelope-o"></i><a href="mailto:<?php echo $arrDynamicFieldsFirstBlock[2]['Value']?>"><h3 class="doctorEmail"><?php echo $arrDynamicFieldsFirstBlock[2]['Value']?></h4></a>
                    <?php } ?>
                    <div class="clear"></div>
                    <?php if ($arrDynamicFieldsFirstBlock[3]['Value']) { ?><i class="fa fa-phone"></i><h3 class="doctorPhone"><?php echo $arrDynamicFieldsFirstBlock[3]['Value']?></h3><?php } ?>
                </div>
            </div>
            
            
            <div class="row doctorDescription">
                <div class="panel with-nav-tabs panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab"><h4><?php echo $trans->getText("About Doctor")?></h4></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1default">
                                <?php /*second block of fiedls display*/
                                $numItems = count($arrDynamicFieldsSecondBlock);
                                for($i=0;$i<=$numItems;$i=$i+=2){?>
                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                        <div class="doctorInfoGroup">
                                            <?php if ($trans->getText($arrDynamicFieldsSecondBlock[$i]['Name'])&&$arrDynamicFieldsSecondBlock[$i]['Value']) { ?><h4 class="doctorInfoTitle"><?php echo $trans->getText($arrDynamicFieldsSecondBlock[$i]['Name'])?></h4><?php } ?>
                                            <?php if ($arrDynamicFieldsSecondBlock[$i]['Value']) { ?><h4><?php echo $arrDynamicFieldsSecondBlock[$i]['Value']?></h4><?php } ?>
                                        </div>
                                        <div class="doctorInfoGroup">
                                            <?php if (isset($arrDynamicFieldsSecondBlock[$i+1])&&$trans->getText($arrDynamicFieldsSecondBlock[$i+1]['Name'])&&$arrDynamicFieldsSecondBlock[$i+1]['Value']) { ?><h4 class="doctorInfoTitle"><?php echo $trans->getText($arrDynamicFieldsSecondBlock[$i+1]['Name'])?></h4><?php } ?>
                                            <?php if (isset($arrDynamicFieldsSecondBlock[$i+1])&&$arrDynamicFieldsSecondBlock[$i+1]['Value']) { ?><h4><?php echo $arrDynamicFieldsSecondBlock[$i+1]['Value']?></h4><?php } ?>
                                        </div>

                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>  
                    
                    <div class="bottomPanelBody">
                        <?php /*third block of fiedls display*/
                        foreach ($arrDynamicFieldsThirdBlock as $key => $value) {
                            if($value['Value']!=''){?>
                                <?php if ($trans->getText($value['Name'])) { ?><h4 class="doctorInfoTitle"><?php echo $trans->getText($value['Name'])?></h4><?php } ?>
                                <div class="richtext"><?php echo $value['Value'];?></div>
                                <div class="clear"></div>
                           <?php }?>
                        <?php }?>

                        <div class="richtext"><?php echo $wmPage["Content"];?></div>
                    </div>
                </div> 
            </div>
        </div>
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>      
</div>    
<?php // </div> ?>
