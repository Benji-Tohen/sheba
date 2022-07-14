<div class="container institutePage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <div class="pageTitleBG"><h1><?php echo $wmPage["Name"];?></h1></div>
            <div class="instituteInfoBox">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 infoCol">
                    <?php if ($arrDynamicFields[0]['Value']) { ?><h6><?php echo $arrDynamicFields[0]['Value']?></h6><?php } ?>
                </div>
                
                
                
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <?php if ($arrDynamicFields[1]['Value']) { ?><h6><?php echo $arrDynamicFields[1]['Value']?></h6><?php } ?>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="carouselWrap">
                <?php /*show related doctors*/
                if(count($arr_connected_doctors) > 0){
                  ?>
                    <h2 class="clinicTeamTitle"><?php echo $trans->getText("Clinic Team");?></h2>
        
                    
                    <?php
                    echo '<div id="carousel">';
                    foreach ($arr_connected_doctors as $doctor) {
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/120X150/zcX1/";
			if (!$doctor['Top_Header']) {
				//$doctor['Top_Header'] = 'webfiles/shebaPics/shebaMain/doctor-male.jpg';
				$drPic = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$doctor['ID']);
				$doctor['Top_Header'] = 'webfiles/shebaPics/shebaMain/'.((strpos($drPic['picture'],"female")>0)?'doctor-female.jpg':'doctor-male.jpg');
				//echo "doctor_top_header = {$doctor['Top_Header']}";
			}
                        ?>
                        <a href="<?php echo $cfg["WM"]["Server"].'/'.$doctor['ID']?>" class="item">
                            <img src="<?php echo $thumb_call.$doctor['Top_Header']?>" alt="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" title="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" class="doctorImg" />
                            <h5 class="doctorName"><?php echo $doctor['Name']?></h5>
                        </a>
                    <?php }
                    echo "</div>";
                    echo '<a id="prevItem" class="next galleryArrowLeft" href="#" style="display: block;"></a>';
                    echo '<a id="nextItem" class="next galleryArrowRight" href="#" style="display: block;"></a>';
                }
                ?>
            </div>
            
            <h2><?php echo $wmPage["Sub_Title"];?></h2>
            <div class="sepLine"></div>
            
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            <div class="lobiTwoPage">
                <div class="showMoreButton ts" id="showMoreText"><?php echo $trans->getText("Show More");?></div>
            </div>
            <div class="richtext" id='moreTextWrap'  style="display: none;"><?php echo $wmPage["Content_Center"];?></div>
            
        </div>
        
        
        <!-- Intitutes Search -->
        <?php 
        if($wmPage['show_extended'] == 1){/*if is extended require search module from Institutions.php*/?>
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">

            <div class="searchRow">
                <input class="searchBox" id="searchChildren" type="text" placeholder="<?php echo $trans->getText("Find institutions, units and clinics")?>" onkeyup="updateChildrenList()" />
                <div onclick="updateChildrenList()" class="searchBoxButton"><?php echo $trans->getText("Search")?></div>
            </div>

            <!--News Items-->
            <div id="childrenWrap">
                <?php for($i=0;$i<count($arr);$i++){?>
                    <?php include(dirname(__FILE__)."/../php_html/Institutions.php");?>
                <?php }?>
            </div>
            <!--end-->
        </div>
        <?php }?>
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
        <!-- END Intitutes Search -->
        
    </div>    
</div>
