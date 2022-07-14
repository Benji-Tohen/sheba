<div class="anchorOffset" id="<?php echo $sec["ID"];?>"></div>
<footer class="sec_<?php echo $sec["ID"];?> pad1">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3  footerCol">
                <div class="footerTitle"><?php echo $trans->getText("About Shebas Friend");?></div>
                <div class="richtext">
                    <?php echo $sec["Content"];?>
                </div>
            </div>
            
            <div class="col-12 col-md-4 col-lg-4 col-lg-offset-1  footerCol">
                <div class="footerTitle"><?php echo $trans->getText("Sheba Friends");?></div>
                
                <div class="footerForm">
                <?php if(isset($_POST["contact_Submit"]) && $_POST["contact_Submit"]){?>
                    <div class="richtext"><?php echo $trans->getText("thanks for contacting us");?></div>
                    <?php echo $wmPage["Conversion"];?>
                <?php } else { ?>
                    <form id="contactForm" name="contactForm" action="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$id;?>/POST" method="post" style="padding: 0px; margin: 0px;" onsubmit="return checkFormContact();">
                        <input type="hidden" name="hidden_url" value="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>"/>
                        <input type="hidden" name="hidden_subject" value="<?php echo $trans->getText("Send");?> <?php echo $cfg["WM"]["WebsiteName"];?> (<?php echo $wmPage["Name"]?>)" />

                        <label for="First_Name" class="labelHide"><?php echo $trans->getText("Name");?></label>
                        <input name="First_Name" type="text" id="First_Name" class="form-control formInput" aria-label="<?php echo $trans->getText("Name");?>" placeholder="<?php echo $trans->getText("Name");?> *" required="required" />
                        
                        <label for="Email" class="labelHide"><?php echo $trans->getText("Email");?></label>
                        <input name="Email" type="text" id="Email" class="form-control formInput" aria-label="<?php echo $trans->getText("Email");?>" placeholder="<?php echo $trans->getText("Email");?> *" required="required" />

                        <label for="Phone" class="labelHide"><?php echo $trans->getText("Phone Number");?></label>
                        <input name="Phone" type="text" id="Phone" class="form-control formInput" aria-label="<?php echo $trans->getText("Phone");?>" placeholder="<?php echo $trans->getText("Phone Number");?> *" required="required" />
                        
                        <button type="submit" name="submit" class="submitButton ts pull-<?php echo $gui->getRight();?>" aria-label="<?php echo $trans->getText("Send");?>">
                            <?php echo $trans->getText("Send");?>
                        </button>
                        <input type="hidden" name="contact_Submit" value="1" />
                    </form>
                <?php }?>
                </div>
            </div>
            
            <div class="col-12 col-md-4 col-lg-4  footerCol">
                <div class="footerTitle"><?php echo $trans->getText("Who we are?");?></div>
                
                <div class="richtext">
                    <?php echo $sec["Content_Center"];?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="bottomCredit">
                    <a href="<?php if($gui->getDir()=="rtl") { ?>http://www.tohen-media.com<?php } else { ?>http://www.tohen-media.com/en<?php }?>" target="_blank"><?php echo $trans->getText("Site by: Media Processor");?></a>    
                </div>
            </div>
        </div>
    </div>
</footer>