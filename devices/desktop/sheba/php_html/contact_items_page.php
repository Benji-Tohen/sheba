<?php $link=$wm->getLink($arr[$i]);
      $answersArr = $wm->getFolderPage($arr[$i]['ID']);
?>
<div class="row item">  
    <!-- ITEM IMAGE -->
    <div class="col-12 col-md-2 col-lg-2 itemImage d-flex justify-content-center justify-content-md-start">
        <?php if($arr[$i]["Top_Header"]){?>
			<a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
				<img src="<?php echo $thumb_call.$arr[$i]["Top_Header"];?>" alt="<?php echo $arr[$i]["Name"];?>" title="<?php echo $arr[$i]["Name"];?>" class="img-fluid" />
			</a>
		<?php }?>
    </div>

    <!-- ITEM TITLE -->
    <div class="col-12 col-md-8 col-lg-8 itemText d-flex justify-content-center justify-content-md-start">
        <a href="<?php echo $link["Link"];?>" target="<?php echo $link["Target"];?>" title="<?php echo $arr[$i]["Name"];?>">
            <h3><?php echo $arr[$i]['Name'];?></h3>
            <h4><?php echo nl2br($arr[$i]["Sub_Title"]);?></h4>
        </a>
    </div>
    
    <!-- EXPAND -->
    <div class="col-12 col-md-2 col-lg-2 itemExpand"  id='<?php echo $arr[$i]['ID']?>'>
        <button type="button" class="fa fa-plus" aria-label="add item">
          <span class="tcon-visuallyhidden">add item</span>
        </button>
    </div>
</div>

<!-- EXPANDED -->
<div class="row" style="display: none;" id='expandWrap<?php echo $arr[$i]['ID']?>'>
    <?php 
    foreach ($answersArr as $answer) {
        if($answer['Top_Header'] != ''){
            $iconAnswer = $thumb_call_answer.$answer['Top_Header']; 
        }else{
            
        }
        ?>
        <div class="col-12 infoBox">
            <div class="arrowDown"><span class="glyphicon glyphicon-play"></span></div>
            <div class="infoLine input-group">
                <div class="infoIcon input-group-addon"><img src="<?php echo $iconAnswer;?>" alt="<?php echo $answer['Sub_Title']?>" /></div>
                <div class="infoText"><?php echo $answer['Content']?></div>
            </div>
        </div>
    <?php }?>
</div>
