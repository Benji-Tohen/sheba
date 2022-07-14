<?php
if(isset($arr[$i])){
	$arr[$i]["Name"] = str_replace('"','&quot;',isset($arr[$i]["Name"]) ? $arr[$i]["Name"]:'' );
}

//$arr[$i] = isset($arr[$i]) ? $arr[$i]:array();
if (isset($arr[$i+1])) $arr[$i+1]["Name"] = str_replace('"','&quot;',$arr[$i+1]["Name"]);
if (isset($arr[$i+2])) $arr[$i+2]["Name"] = str_replace('"','&quot;',$arr[$i+2]["Name"]);
?>
<div class="row eventsItemsRow" <?php echo !isset($arr[$i])?"style='display: none;'":"";?>>
    <?php
    if($arr[$i]){
     $link=$wm->getLink($arr[$i]);?>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 item">

          <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
            <?php if (isset($arr[$i]["Start_Date"]) && $arr[$i]["Start_Date"]) { 
                /*check if we have mofa date to display*/
                $mofaDate = $db->getRow("SELECT Start_Date FROM wm_events WHERE wm_pages=".intval($arr[$i]['ID']));
                 if($mofaDate['Start_Date']!=''){
                        $arr[$i]["Start_Date"]=$mofaDate['Start_Date'];
                 }
                $date = date_create($arr[$i]["Start_Date"]);
                $date =  date_format($date, 'd-m-Y');
                ?><h6 class="itemDate"><?php echo $date;?></h6><?php } ?>
        </a>

             <?php    
                    $arr[$i]["Top_Header"] = isset($arr[$i]["Top_Header"]) ? $arr[$i]["Top_Header"]: '';          
                    if($arr[$i]["Top_Header"]!=''){
	                    $currentImage = $cfg["WM"]["Server"]."/webfiles/images/cache/"."240"."X"."160"."/zcX1/".$arr[$i]["Top_Header"];
                    }else{
	                    $currentImage = $cfg["WM"]["Server"]."/webfiles/images/cache/"."240"."X"."160"."/zcX1/webfiles/default/defaultNewsPic.jpg";
//        	            $currentImage='https://sheba.tohendns.com/site/images/defaultNewsPic.jpg';
                    } 
             ?>
                   
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
                <img src="<?php echo $currentImage;?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-responsive" />
            </a>

            
        <?php /* if($arr[$i]["Top_Header"]){?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-responsive" />
            </a>
        <?php }*/?>
            
        <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
            <?php if ($arr[$i]["Name"]) { ?><h5><?php echo $arr[$i]["Name"];?></h5><?php } ?>
        </a>
        
      
        
        <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
	    <?php if ($arr[$i]["Sub_Title"]) { ?>
            <h6>
                <?php
                if(intval(mb_strlen($arr[$i]["Sub_Title"], 'UTF-8'))>103){
                echo mb_substr($arr[$i]["Sub_Title"],0,100, "utf-8")."...";
                }else{
                echo $arr[$i]["Sub_Title"];
                }?>
            </h6>
	    <?php } ?>
        </a>
    </div>
<?php }?>
    
	<?php
    if($arr[$i+1]){
     $link=$wm->getLink($arr[$i+1]);?>
	   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 item">
    
                <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                <?php if ($arr[$i+1]["Start_Date"]) { 
                /*check if we have mofa date to display*/
                $mofaDate = $db->getRow("SELECT Start_Date FROM wm_events WHERE wm_pages=".intval($arr[$i+1]['ID']));
                 if($mofaDate['Start_Date']!=''){
                        $arr[$i+1]["Start_Date"]=$mofaDate['Start_Date'];
                 }
                $date = date_create($arr[$i+1]["Start_Date"]);
                $date =  date_format($date, 'd-m-Y');
                ?><h6 class="itemDate"><?php echo $date;?></h6><?php } ?>
            </a>
 
                  
                  <?php              
                    if($arr[$i+1]["Top_Header"]!=''){
                    $currentImage = $cfg["WM"]["Server"]."/webfiles/images/cache/"."240"."X"."160"."/zcX1/".$arr[$i+1]["Top_Header"];
                    }else{
                    $currentImage='http://sheba.tohendns.com/site/images/defaultNewsPic.jpg';
                    } 
                ?>
                   
                    <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                        <img src="<?php echo $currentImage;?>" alt="<?php echo $arr[$i+1]["Name"];?>" title="<?php echo $arr[$i+1]["Name"];?>" class="img-responsive" />
                    </a>
    
                
               
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                <?php if ($arr[$i+1]["Name"]) { ?><h5><?php echo $arr[$i+1]["Name"];?></h5><?php } ?>
            </a>

           
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
		<?php if ($arr[$i+1]["Sub_Title"]) { ?>
                <h6>
                    <?php
                    if(intval(mb_strlen($arr[$i+1]["Sub_Title"], 'UTF-8'))>103){
                    echo mb_substr($arr[$i+1]["Sub_Title"],0,100, "utf-8")."...";
                    }else{
                    echo $arr[$i+1]["Sub_Title"];
                    }?>
                </h6>
		<?php } ?>
            </a>
        </div>
	<?php }?>
    
    <?php if($arr[$i+2]){
        $link=$wm->getLink($arr[$i+2]);
        ?>
	   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 item">
               
             <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+2]["Name"];?>">
             <?php if ($arr[$i+2]["Start_Date"]) { 
                /*check if we have mofa date to display*/
                $mofaDate = $db->getRow("SELECT Start_Date FROM wm_events WHERE wm_pages=".intval($arr[$i+2]['ID']));
                 if($mofaDate['Start_Date']!=''){
                        $arr[$i+2]["Start_Date"]=$mofaDate['Start_Date'];
                 }
                $date = date_create($arr[$i+2]["Start_Date"]);
                $date =  date_format($date, 'd-m-Y');
                ?><h6 class="itemDate"><?php echo $date;?></h6><?php } ?>
        </a>
                      
                  <?php              
                    if($arr[$i+2]["Top_Header"]!=''){
                    $currentImage = $cfg["WM"]["Server"]."/webfiles/images/cache/"."240"."X"."160"."/zcX1/".$arr[$i+2]["Top_Header"];
                    }else{
                    $currentImage='http://sheba.tohendns.com/site/images/defaultNewsPic.jpg';
                    } 
                ?>
                   
                    <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+1]["Name"];?>">
                        <img src="<?php echo $currentImage;?>" alt="<?php echo $arr[$i+2]["Name"];?>" title="<?php echo $arr[$i+2]["Name"];?>" class="img-responsive" />
                    </a>
               
               
               
        <?php /* if($arr[$i+2]["Top_Header"]){?>
            <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+2]["Name"];?>">
                <img src="<?php echo $thumb_call.$arr[$i+2]["Top_Header"];?>" alt="<?php echo $arr[$i+2]["Name"];?>" title="<?php echo $arr[$i+2]["Name"];?>" class="img-responsive" />
            </a>
        <?php }*/?>
           
               
               
              
               
        <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+2]["Name"];?>">
            <?php if ($arr[$i+2]["Name"]) { ?><h5><?php echo $arr[$i+2]["Name"];?></h5><?php } ?>
        </a>
        
       
        <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i+2]["Name"];?>">
            <?php if ($arr[$i+2]["Sub_Title"]) { ?>
            <h6>
                <?php
                if(intval(mb_strlen($arr[$i+2]["Sub_Title"], 'UTF-8'))>103){
                echo mb_substr($arr[$i+2]["Sub_Title"],0,100, "utf-8")."...";
                }else{
                echo $arr[$i+2]["Sub_Title"];
                }?>
            </h6>
	    <?php } ?>
        </a>
    </div>
	<?php }?>
</div>
