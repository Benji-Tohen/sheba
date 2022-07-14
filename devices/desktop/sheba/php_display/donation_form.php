<div class="container">
    <div class="row">
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
             <h1><?php echo $wmPage["Name"];?></h1>
             <div class="col-12 noPadding">
                 <?php echo $wmPage["Content"];?>
             </div>
            <div class="col-12 noPadding">
            	<?php if(isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]){?>
					<div class="richtext"><?php echo $wmPage["Answer_Text"];?></div>
					<?php echo $wmPage["Conversion"];?>
				<?php }else{?>
	                <form action="<?php echo $link;?>/POST" method="post" name="contactForm" style="padding: 0px; margin: 0px;" onsubmit="return checkFormContact();">
                        <input type="hidden" name="hidden_url" value="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>"/>
	                	<input type="hidden" name="hidden_subject" value="<?php echo $trans->getText("Send");?> <?php echo $cfg["WM"]["WebsiteName"];?> (<?php echo $wmPage["Name"]?>)" />
		                <div class="row">
		                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 inputDiv">
		                        <input name="First_Name" type="text" id="First_Name" class="form-control formInput" placeholder="<?php echo $trans->getText("Name");?>" required="required" />
		                    </div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 inputDiv">
                                <input name="Email" type="text" id="Email" class="form-control formInput" placeholder="<?php echo $trans->getText("Email");?>" required="required" />
                            </div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 inputDiv">
                                <input  name="Phone" type="text" id="Phone" class="form-control formInput" placeholder="<?php echo $trans->getText("Phone");?>" required="required" />
                            </div>
		                    <div class="col-12 commentsTextarea">
		                            <textarea name="Comments" id="Comments" class="form-control formInput" rows="9" cols="25" required="required"
		                                placeholder="<?php echo $trans->getText('Message');?>"></textarea>
		                    </div>
		                    <div class="col-md-12">
		                        <button type="submit" name="submit" class="submitButton pull-<?php echo $gui->getLeft();?>">
		                        	<?php echo $trans->getText("Send");?>
		                        </button>
		                        <input type="hidden" name="hidden_Submit" value="1" />
		                    </div>
		                </div>
	                </form>
                <?php }?>
            </div>
            <!-- PAGE FEATURES -->
            <?php if($wmPage["AddThis"]){ ?>
            <?php include(dirname(__FILE__)."/../php_components/page_features.php");?>
            <?php }?>
        </div>

        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
        <div class="col-12 col-lg-4 pageSideContent">
            <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
        </div>
        <?php }?>
    </div>

</div>
