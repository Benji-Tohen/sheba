<div class="container doctorSearchPage">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["h1"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?>
                <h2>
                    <?php echo $wmPage["Sub_Title"];?>
                </h2>
            <?php } ?>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            <div class="carouselWrap">
                <?php /*show related doctors*/
                if(count($arr_connected_doctors) > 0){ ?>
                    <h2 class="clinicTeamTitle">
                        <?php echo $trans->getText("Doctors Treating This Condition");?>
                    </h2>
                    <?php
                    echo '<div id="carousel">';
                    foreach ($arr_connected_doctors as $doctor) {
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/120X150/zcX1/";
                        ?>
                        <a href="<?php echo $cfg["WM"]["Server"].'/'.$doctor['ID']?>" class="item">
                            <img 
                                src="<?php echo $thumb_call.$doctor['Top_Header']?>" 
                                alt="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" 
                                title="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" 
                                class="doctorImg" 
                            />
                            <h5 class="doctorName"><?php echo $doctor['Name']?></h5>
                        </a>
                    <?php }
                    echo "</div>";
                    echo '<a id="prevItem" class="next galleryArrowLeft" href="#" style="display: block;"></a>';
                    echo '<a id="nextItem" class="next galleryArrowRight" href="#" style="display: block;"></a>';
                }?>
            </div>
            <!--News Items-->
            <div id="childrenWrap">
                <?php for($i=0;$i<count($arr_connected_institute);$i++){?>
                    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
                <?php }?>
            </div>
            <!--end-->
            <?php /*-------------------------- Start code modul------------------------------------- */?>
            <?php foreach($arr_modul as $key => $item){
                $link=$wm->getLink($item); ?>
                <?php if($key== 0){ 
                    $style = 'block';

                }else{
                    $style = 'none';
                }?>
                <div class="item newsItem">
                    <div class="row">
                        <!-- ITEM IMAGE -->
                        <?php if($item["Top_Header"]){?>
                        <div class="col-5 col-sm-4 col-md-2 col-lg-2 itemImage">
                            <a 
                                href="<?php echo $link["Link"];?>" 
                                target="<?php echo $link["Target"];?>" 
                                title="<?php echo $string->htmlentities($item["Name"]);?>"
                            >
                                <img 
                                src="<?php echo $thumb_call_item.$item["Top_Header"];?>" 
                                alt="<?php echo $string->htmlentities($item["Name"]);?>" 
                                title="<?php echo $string->htmlentities($item["Name"]);?>" 
                                class="img-fluid" 
                            />
                            </a>
                        </div>
                        <?php }?>
                        <div class="col-10 col-sm-10 col-lg-11 col-md-11 itemTitle">
                            <h2><?php echo $string->htmlentities($item['Name']);?></h2>
                        </div>
                        <!-- EXPAND -->
                        <div class="col-1 col-md-1 col-md-1 col-lg-1 itemToggle itemExpand"  id='<?php echo $item['ID']?>'>
                            <button type="button" class="fas fa-angle-<?php echo ($key==0)?"up":"down";?>"></button>
                        </div>
                    </div>
                </div>

			    			<!-- EXPANDED -->
			    <div class="row expendedItem" style="display:<?php echo $style; ?>;" id='expandWrap<?php echo $item['ID']?>'>
			        <div class="col-12 col-md-10 col-lg-10">
			            <h6 class="expandContent">
			                <?php echo $item["Content"]; ?>
			            </h6>
			        </div>
			    </div>
			<?php } ?>
            <?php /*-------------------------- End code modul----------------------------------------*/?>
        </div>
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="d-none d-lg-block col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
    

</div>
