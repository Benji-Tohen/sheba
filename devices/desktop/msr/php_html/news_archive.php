<?php 
   $link=$wm->getLink($arr[$i]);
?>
<div class="row item">  
    <!-- ITEM IMAGE -->
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 itemImage">
        <?php
        if($arr[$i]["Top_Header"] == ''){
            $arr[$i]["Top_Header"] = $cfg["WM"]["Server"].'/site/images/defaultNewsPic.jpg';
            $thumb_call = '';
        }else{
            $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/zcX1/";
        }
        
        if($arr[$i]["Top_Header"]){?>
			<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
                            <img style="width: 295px;height: 178px;" src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-responsive" />
			</a>
		<?php }?>
    </div>

    <!-- ITEM TITLE -->
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 itemText">
        <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">

            <?php
                $date = date_create($arr[$i]["Start_Date"]);
                $date =  date_format($date, 'd-m-Y');
            ?>
            <h6><?php echo $date;?></h6>
            <h3><?php echo $arr[$i]['Name'];?></h3>
            <h4><?php echo nl2br($arr[$i]["Sub_Title"]);?></h4>
        </a>
    </div>
</div>
