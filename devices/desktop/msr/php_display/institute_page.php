<div class="container institutePage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <div class="pageTitleBG"><h1><?php echo $wmPage["Name"];?></h1></div>
            <div class="instituteInfoBox">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 infoCol">
                    <?php if ($arrDynamicFields[0]['Value']) { ?><?php echo $arrDynamicFields[0]['Value']?><?php } ?>
                </div>
                
                
                
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <?php if ($arrDynamicFields[1]['Value']) { ?><?php echo $arrDynamicFields[1]['Value']?><?php } ?>
                </div>
                <div class="clear"></div>
            </div>
            
            



            <?php if (count($arr_connected_doctors)>0) {?>
				<div class="doctors-slider" <?php if (count($arr_connected_doctors)<4) echo 'style="direction:rtl"'; ?>>
                     <h3 class="doctors-sliderHeadline"><?php echo $trans->getText('Clinic Team');?></h3>
					<?php 

						foreach ($arr_connected_doctors as $doctor) {
						$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/120X150/iarX1/";
						if (!$doctor['Top_Header']) {
							//$doctor['Top_Header'] = 'webfiles/shebaPics/shebaMain/doctor-male.jpg';
							$drPic = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$doctor['ID']);
							$doctor['Top_Header'] = 'webfiles/shebaPics/shebaMain/'.((strpos($drPic['picture'],"female")>0)?'doctor-female.jpg':'doctor-male.jpg');
							//echo "doctor_top_header = {$doctor['Top_Header']}";
						}
					?>
				  	<div >
					  	<a href="<?php echo $cfg["WM"]["Server"].'/'.$doctor['ID']?>" class="item">
							<img src="<?php echo $thumb_call.$doctor['Top_Header']?>" alt="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" title="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" class="doctorImg" />
							<div class="doctorName"><?php echo $doctor['Name']?></div>
						</a>
					</div>
					<?php } ?>
				</div>
            <?php }?>
								







 
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            <div class="sepLine"></div>
            
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            <?php if ($wmPage["Content_Center"]) { ?>
            <div class="lobiTwoPage">
                <button tabindex="0" class="showMoreButton ts" id="showMoreText" title="<?php echo $trans->getText("Show More");?>"><?php echo $trans->getText("Show More");?></button>
            </div>

            <div class="richtext" id='moreTextWrap'  style="display: none;"><?php echo $wmPage["Content_Center"];?></div>
            <?php } ?>
        
        
        
        <!-- Intitutes Search -->
        <?php 
        if(/*$wmPage['show_extended'] == 1*/ true){/*if is extended require search module from Institutions.php*/?>
            <div class="searchRow">
                <input class="searchBox" id="searchChildren" type="text" placeholder="<?php echo $trans->getText("Find institutions, units and clinics")?>" onkeyup="updateChildrenList()" />
                <div tabindex="0" onclick="updateChildrenList()" onkeypress="updateChildrenList()" class="searchBoxButton" title="<?php echo $trans->getText("Search")?>"><?php echo $trans->getText("Search")?></div>
            </div>

            <!--News Items-->
            <div id="childrenWrap">
                <?php if ($wmPage["Image_Text"]) { ?>
                    <a href="<?php echo $wmPage["Image_Text"]?>" class="infoWrap">
                        <div class="infoCircle">
                            <img src="<?php $cfg["WM"]["Server"];?>/site/images/info.svg" class="svg" />
                        </div>
                        <h3 class="infoText"><?php echo $trans->getText("For more info about the clinic");?></h3>
                    </a>
                <?php } ?>
                
                <?php for($i=0;$i<count($arr);$i++){?>
                    <?php include(dirname(__FILE__)."/../php_html/Institutions.php");?>
                <?php }?>
            </div>
            <!--end-->
        <?php }?>


            <?php if($wmPage["wm_forms"]){?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="eventRegisterButton"><a href='<?php echo $cfg["WM"]["Server"]."/item/57328/".$wmPage['Page_Type']."/".$wmPage['ID'];?>'><?php echo $wmPage['Form_Btn_Text']?></a></di$
                </div>
            </div>
            <?php } ?>


         <?php /*if($wmPage["wm_forms"]){?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="eventRegisterButton"><a href='<?php echo $cfg["WM"]["Server"]."/item/".$wm->getIdByPageType(6)."/".$wmPage['Page_Type']."/".$wmPage['ID'];?>'><?php echo $wmPage['Form_Btn_Text']?></a></div>
                </div>
            </div>
            <?php }*/ ?>
        
        </div>
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
        <!-- END Intitutes Search -->
        
    </div>    
</div>
