<?php if(($arrUnits[$i]['Name']) && ($arrUnits[$i]['AudioFile'])){ ?>

<?php /*a href="<?php echo $cfg["WM"]["Server"].'/'.$arrUnits[$i]['ID'];?>" title="<?php echo str_replace('"','&quot;',$arrUnits[$i]["Name"]);?>" class="row item">  */?>
    <!-- ITEM TITLE -->
    <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8 itemText">
        <?php if ($arrUnits[$i]['Name']) { ?><h4><?php echo $arrUnits[$i]['Name'];?></h4><?php } ?>
    </div>
    
    <!-- ITEM PHONE -->
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 itemPhone">
        <?php if ($arrUnits[$i]['AudioFile']) { ?><h4><?php echo $arrUnits[$i]['AudioFile'];?></h4><?php } ?>
    </div>
<?php /* </a>*/ ?>
<?php } ?>
