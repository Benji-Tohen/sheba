<div class="container">
    <div class="row institute-page">
        <div class="col-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>  content">
            <div class="title-page">
                <h1><?php echo nl2br($wmPage["h1"]);?></h1>
            </div>
            <div class=" box-border d-flex flex-column justify-content-md-between flex-md-row align-items-start">
                <div class="w-100 half-box-one ">
                    <?php if ($arrDynamicFields[0]['Value']) { ?><?php echo $arrDynamicFields[0]['Value']?><?php } ?>
                </div>

                <div class="w-100 half-box">
                    <?php if ($arrDynamicFields[1]['Value']) { ?><?php echo $arrDynamicFields[1]['Value']?><?php } ?>
                    <?php if(!empty($navig_waze_link)){?>
                        <div class="title-link"><?php echo $navig_with_waze_label['Value']?></div>
                        <a href="http://waze.to/?ll=<?php echo $latLng;?>&navigate=yes" 
                            class="wazeLink"
                            title="<?php echo $trans->getText("Waze")?>"
                        >
                            <img class="icon-waze" 
                                src="<?php echo $cfg["WM"]["Server"];?>/site/images/waze.png" 
                                alt="<?php echo $trans->getText("Waze")?>" 
                            />
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php /*Button Page */ ?>    
            <?php if(!empty($wmPage["btn_name"]) && !empty($wmPage["btn_url"])){?>
                <div class="event-register-button">
                    <a href='<?php echo $wmPage["btn_url"];?>' title=" <?php echo $wmPage["btn_name"];?>">
                        <?php echo $wmPage["btn_name"];?>
                    </a>
                </div>
            <?php }?>
            <?php /*Doctors Section */ ?>
            <?php if(count($arr_connected_doctors)>0){?>
                <?php include(dirname(__FILE__)."/../php_components/doctors_carousel.php");?>
            <?php } ?>
            <?php if ($wmPage["Sub_Title"]) { ?>
                <h2><?php echo $wmPage["Sub_Title"];?></h2>
            <?php } ?>
            <div class="sepLine"></div>                
            <div class="richtext">
                <?php echo $wmPage["Content"];?>
            </div>
            <?php if ($wmPage["Content_Center"]) { ?>
                <div class="lobiTwoPage">
                    <button
                        tabindex="0"  
                        class="showMoreButton ts"
                        id="showMoreText" 
                        title="<?php echo $trans->getText("Show More");?>"
                    >
                        <?php echo $trans->getText("Show More");?>
                    </button>
                </div>
                <div class="richtext" id='moreTextWrap'  style="display: none;"><?php echo $wmPage["Content_Center"];?></div>
            <?php } ?>
            
            <!-- Intitutes Search -->
            <div class="searchRow">
                <input 
                    class="searchBox" 
                    id="searchChildren" 
                    type="text" 
                    placeholder="<?php echo $trans->getText("Find institutions, units and clinics")?>" 
                    onkeyup="updateChildrenList()" 
                />
                <div 
                    tabindex="0" 
                    onclick="updateChildrenList()" 
                    onkeypress="updateChildrenList()" 
                    class="searchBoxButton" 
                    title="<?php echo $trans->getText("Search")?>"
                >
                    <?php echo $trans->getText("Search")?>
                </div>
            </div>
            <div id="childrenWrap"></div>
            <!-- Intitutes Search END -->
            <?php if(!empty($wmPage["btn_name"]) && !empty($wmPage["btn_url"])){?>
                <div class="event-register-button">
                    <a href='<?php echo $wmPage["btn_url"];?>' title=" <?php echo $wmPage["btn_name"];?>">
                        <?php echo $wmPage["btn_name"];?>
                    </a>
                </div>
            <?php }?>
        </div>
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-10  col-sm-10 offset-sm-1 col-md-4 offset-md-0 col-lg-4 offset-lg-0 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
</div>