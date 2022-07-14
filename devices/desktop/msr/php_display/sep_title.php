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



<div class="container articlePage">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["h1"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            
            <!-- PAGE FEATURES -->
            <?php if($wmPage["AddThis"]){ ?>
                <?php include(dirname(__FILE__)."/../php_components/page_features.php");?>
            <?php }?>
            
            <!-- INNER IMAGE -->
            <?php if($wmPage["Top_Header2"]){
            $thumbWidth=$params->getValue("imgThumbWidth");
            $thumbHeight=$params->getValue("imgThumbHeight");
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."632"."X"."356"."/zcX1/";
            ?>
            <div class="innerImg">
                <img src="<?php echo $cfg["WM"]["Server"].'/'.$wmPage["Top_Header2"];?>" alt="<?php echo $wmPage["Name"]?>" title="<?php echo $wmPage["Name"]?>" class="innerImage img-fluid" />

                <?php if($wmPage["Video_Text"]){?>
                    <div class="videoAndImageDescription">
                        <?php
                        if(intval(mb_strlen($wmPage["Video_Text"], 'UTF-8'))>85){
                        echo mb_substr($wmPage["Video_Text"],0,82, "utf-8")."...";
                        }else{
                        echo $wmPage["Video_Text"];
                        }?>
                    </div>
                <?php }?>
            </div>
            <?php }?>
            <!-- END INNER IMAGE -->
            
            <!-- GALLERY -->
            <?php if (!empty($arr_pictures)) { ?>
            <div id="regularGallery" class="owl-carousel">
                <?php for($i=0;$i<count($arr_pictures);$i++){
                    if(file_exists($arr_pictures[$i]["File_Name"])){
                        if($arr_pictures[$i]["Code"]){
                            $link=$arr_pictures[$i]["Code"];
                        }else{
                            $link=$cfg["WM"]["Server"]."/".$arr_pictures[$i]["File_Name"];
                        }?>
                        <div>
                            <a href="<?php echo $link;?>" title="<?php echo $string->htmlentities($arr_pictures[$i]["Name"]);?>" data-gallery>
                                <img src="<?php echo $thumb_call_galleryimage.$arr_pictures[$i]["File_Name"];?>" alt="<?php echo $arr_pictures[$i]["Name"];?>" title="<?php echo $arr_pictures[$i]["Name"];?>" class="img-fluid" />
                            </a>
                        </div>
                <?php }} ?>
            </div>    
            <?php } ?>
            <!-- END GALLERY -->
            
            <!-- VIDEO EMBED -->
            <?php if($wmPage["Video_Embed"]){ ?>
                <div class="video-container videoEmbed">
                    <iframe width="640" height="340" src="//www.youtube.com/embed/<?php echo $wmPage["Video_Embed"]?>?rel=0&amp;showinfo=0&amp;controls=1" <?php//frameborder="0"?> style="border:0px" allowfullscreen></iframe>
                </div>
            <?php }?>
            <!-- END VIDEO EMBED -->
            
            <div class="richtext"><?php echo $wmPage["Content"];?></div>

            
            <!-- PAGE FEATURES -->
            <?php if($wmPage["AddThis"]){ ?>
                <?php include(dirname(__FILE__)."/../php_components/page_features.php");?>
            <?php }?>
            
            <?php if($wmPage["wm_forms"]){
                $formPageId=$wm->getIdByPageType(6);
                $formPageData=$wm->getValues($formPageId);
                $link=$wm->getLink($formPageData);

                $thisPageAlias=$wmPage['ID'];
                if($wmPage["Alias"]){
                    $pageAliasUrl=explode("/", $wmPage["Alias"]);
                    $thisPageAlias=end($pageAliasUrl);
                }
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="eventRegisterButton"><a href='<?php echo $link["Link"]."/שיבא/".$thisPageAlias;?>'><?php echo ($wmPage["Form_Btn_Text"]) ? $wmPage["Form_Btn_Text"] : $trans->getText("Register for the event"); ?></a></div>
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
