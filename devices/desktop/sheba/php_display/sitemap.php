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
            
            
            <div class="richtext">
                <?php 
                foreach ($allChildrenInSite as $key => $value) {
                    echo "<a href='".$cfg["WM"]["Server"].'/'.$value['ID']."' style='margin-right: ".(20*$value['level'])."px'>".$value['Name']."</a><br />";
                    
                }
                ?>
            </div>

            
            <!-- PAGE FEATURES -->
            <?php if($wmPage["AddThis"]){ ?>
                <?php include(dirname(__FILE__)."/../php_components/page_features.php");?>
            <?php }?>
            
            <?php if($wmPage["wm_forms"]){?>
            <div class="row">
                <div class="col-12">
                    <div class="eventRegisterButton"><a href='<?php echo $cfg["WM"]["Server"]."/".$wm->getIdByPageType(6)."/".$wmPage['Page_Type']."/".$wmPage['ID'];?>'><?php echo $wmPage['Form_Btn_Text']?></a></div>
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
