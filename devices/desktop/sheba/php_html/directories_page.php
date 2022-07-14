<?php if(($arrUnits[$i]['Name']) && ($arrUnits[$i]['AudioFile'])){ ?>
<div class="row">
    <!-- ITEM TITLE -->
    <div class="col-6 col-sm-6 col-md-8 col-lg-8 itemText">
        <?php if ($arrUnits[$i]['Name']) { ?><h4><?php echo $arrUnits[$i]['Name'];?></h4><?php } ?>
    </div>
    
    <!-- ITEM PHONE -->
    <div class="col-6 col-sm-6 col-md-4 col-lg-4 itemPhone">
        <?php if ($arrUnits[$i]['AudioFile']) { ?><h4><?php echo $arrUnits[$i]['AudioFile'];?></h4><?php } ?>
    </div>
</div>
<?php } ?>
