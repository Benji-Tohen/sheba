<div class="pageFeatures">
    <div class="featureButton" onclick="window.print();" tabindex="0" onkeypress="$(this).click()">
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-print"></i></div>
            <?php /* <div class="form-control"><?php echo $trans->getText("Print");?></div> */?>
        </div>
    </div>
    <?php /*
    <div class="featureLineSep d-none d-lg-block"></div>
    
    
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
    <div class="featureLineSep d-none d-lg-block"></div>
    
    <div class="featureButton myDiv" tabindex="0" onkeypress="$(this).click()">
        <div class="input-group">
            <div class="input-group-addon" id="shareDialogToggle" ><i class="fa fa-share-alt"></i></div>
            <?php /* <div class="form-control" id="shareDialogToggle2"><?php echo $trans->getText("Share");?></div> */?>
        </div>
        <!-- SHARE Dialog -->
        <div class="shareDialog">
            <?php /* echo $params->getValue("AddThis"); */?>
            <!-- <div class="glyphicon glyphicon-eject shareDialogArrow"></div> -->

            <ul class="shareList" tabindex="-1">
                <li class="facebook shareItem" tabindex="-1">
                    <a href="http://www.facebook.com/sharer.php?u=<?php echo $cfg["WM"]["Server"].$_SERVER['REQUEST_URI'];?>" target="_blank" title="<?php echo $trans->getText("Share by Facebook");?>">
                        <div class="shareIcon">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </div>
                    </a>
                </li>
                <li class="twitter shareItem" tabindex="-1">
                    <a href="http://twitter.com/share?url=<?php echo $cfg["WM"]["Server"].$_SERVER['REQUEST_URI'];?>&amp;text=<?php echo urlencode($trans->getText("Share by Twitter"));?>&amp;hashtags=<?php echo urlencode($trans->getText("Share by Twitter"));?>" target="_blank" title="<?php echo $trans->getText("Share by Twitter");?>">
                        <div class="shareIcon">
                            <i class="fab fa-twitter" aria-hidden="true"></i>
                        </div>
                    </a>
                </li>
                <li class="twitter shareItem" tabindex="-1">
                    <a href="whatsapp://send?text=<?php echo $cfg["WM"]["Server"].$_SERVER['REQUEST_URI'];?>"  target="_blank" title="<?php echo $trans->getText("Share by Whatsapp");?>">
                        <div class="shareIcon">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        </div>
                    </a>
                </li>
                <li class="email shareItem" tabindex="-1">
                    <a href="mailto:friend@example.com?subject=<?php echo $cfg["WM"]["Server"].$_SERVER['REQUEST_URI'];?>"  target="_blank" title="<?php echo $trans->getText("Share by Email");?>">
                        <div class="shareIcon">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                    </a>
                </li>
                <li class="telegram shareItem" tabindex="-1">
                    <a href="https://t.me/share/url?url=<?php echo $cfg["WM"]["Server"].$_SERVER['REQUEST_URI'];?>"  target="_blank" title="<?php echo $trans->getText("Share by Telegram");?>">
                        <div class="shareIcon">
                            <i class="fab fa-telegram" aria-hidden="true"></i>
                        </div>
                    </a>
                </li>
                <li class="linkedin shareItem" tabindex="-1">
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $cfg["WM"]["Server"].$_SERVER['REQUEST_URI'];?>"  target="_blank" title="<?php echo $trans->getText("Share by Linkedin");?>">
                        <div class="shareIcon">
                            <i class="fab fa-linkedin" aria-hidden="true"></i>
                        </div>
                    </a>
                </li>
                <li class="print shareItem" tabindex="-1">
                    <button onclick="window.print();" onkeypress="$(this).click()" title="<?php echo $trans->getText("Print");?>">
                        <div class="shareIcon">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </div>
                    </button>
                </li>
            </ul>
        </div>
        <!-- END SHARE Dialog -->
    </div>
</div>


<style>
    .shareList{
        padding: 0px;
        margin: 0px;
        list-style-type: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .shareItem a, .shareItem button{
        font-size: 22px;
        color: #2bb99b;
        background: none;
    }

    .shareItem a:hover, .shareItem button:hover{
        color: #000;
    }
</style>