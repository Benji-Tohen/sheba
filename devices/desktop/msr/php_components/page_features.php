<div class="pageFeatures">
    <div class="featureButton" onclick="window.print();" tabindex="0" onkeypress="$(this).click()">
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-print"></i></div>
            <?php /* <div class="form-control"><?php echo $trans->getText("Print");?></div> */?>
        </div>
    </div>
    <?php /*
    <div class="featureLineSep hidden-xs hidden-sm"></div>
    
    
    <div class="featureButton" >
        <div class="input-group">
            <div class="input-group-addon" tabindex="0" onkeypress="$(this).click()" id="emailDialogToggle"><i class="fa fa-envelope-o"></i></div>
            <?php /* <div class="form-control" id="emailDialogToggle2"><?php echo $trans->getText("Send to friend");?></div> *//*?>
        </div>
        
        <!-- EMAIL DIALOG -->
	<?php $share_id = time() + rand(1,1000); ?>
        <div class="emailDialog">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="<?php echo $trans->getText("E-Mail");?>" aria-describedby="basic-addon<?=$share_id?>">
                    <span tabindex="0" onkeypress="$(this).click()" class="input-group-addon" id="basic-addon<?=$share_id?>"><?php echo $trans->getText("Send");?></span>
                </div>
            </form>
            <div class="glyphicon glyphicon-eject emailDialogArrow"></div>
        </div>
        <!-- END EMAIL DIALOG -->
    </div>
    */?>
    <div class="featureLineSep hidden-xs hidden-sm"></div>
    
    <div class="featureButton myDiv" tabindex="0" onkeypress="$(this).click()">
        <div class="input-group">
            <div class="input-group-addon" id="shareDialogToggle" ><i class="fa fa-share-alt"></i></div>
            <?php /* <div class="form-control" id="shareDialogToggle2"><?php echo $trans->getText("Share");?></div> */?>
        </div>
        <!-- SHARE Dialog -->
        <div class="shareDialog">
            <?php echo $params->getValue("AddThis");?>
            <div class="glyphicon glyphicon-eject shareDialogArrow"></div>
        </div>
        <!-- END SHARE Dialog -->
    </div>
</div>
