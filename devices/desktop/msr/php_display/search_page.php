<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="newsPageAll">
                <?php
                if(isset($arr) && $arr){
                    for($i=0;$i<count($arr);$i++){?>
                        <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
                    <?php }
                }else{?>
                        <div class="newsItemText"><?php /*echo $trans->getText("No Results Found");*/?></div>
                <?php }?>
            </div>
            <div>
              <gcse:searchresults-only></gcse:searchresults-only>
            </div>
        </div>
        
        <!-- SIDE CONTENT -->

            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>

    </div>
</div>