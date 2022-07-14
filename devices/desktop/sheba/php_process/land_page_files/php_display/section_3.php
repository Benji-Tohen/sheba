<div class="anchorOffset" id="<?php echo $sec["ID"];?>"></div>
<section class="sec_<?php echo $sec["ID"];?>">
    <button type="button" class="donateButton ts" onclick="scrollToForm()" title="<?php echo $trans->getText("DONATE NOW");?>" data-toggle="collapse" data-target="#openForm"><?php echo $trans->getText("DONATE NOW");?></button>
    
	<div class="container">
		<div class="row justify-content-center" id="formAnchor">
			<?php if($sec["Content"]){?>
				<div class="col col-lg-10 sectionContent">
					<div class="richtext"><?php echo $sec["Content"];?></div>
				</div>
			<?php }?>
            
            <?php if(!$isSent["Success"] && !isset($isSent["Success"])  && $_POST){ ?>
            <div class="col-12">
                <div class="errorMassege">
                    <h2><?php echo $trans->getText("Donating Error!");?></h2>
                    <h3><?php echo $trans->getText("Please try again");?></h3>
                </div>
            </div>
            <?php }
            if( isset($_POST["ConfirmationCode"]) && $_POST["ConfirmationCode"]=="0000000"  && !$eladResult ){ ?>
                <div class="col-12">
                <div class="errorMassege">
                    <h2><?php echo $trans->getText("Donating Error!");?></h2>
                    <h3><?php echo $trans->getText("Please try again");?>:</h3>
                </div>
            </div>
            <?php } else if ((isset($_POST["ConfirmationCode"])) && $_POST["ConfirmationCode"]!="0000000" && $eladResult) { ?>
            <div class="col-12">
                <div class="thankYou">
                    <img src="<?php echo $filepath;?>/img/approved.svg" alt="<?php echo $wmPage["Answer_Text"];?>" />
                    <h2><?php echo $trans->getText("Thank You");?></h2>
                    <div class="answerText"><?php echo $sec["Answer_Text"];?></div>
                </div>
            </div>
            
            <script type="text/javascript">
                $(document).ready(function(){
                    location.hash = "#goBackAnswer"; 
                });
            </script>
            <?php echo $sec["Conversion"];?>
            <?php }?>
		</div>
        
            
            <?php
                $countries=$wm->getMenuLevel($sec["ID"]);
                $countries_index = array();
                foreach ($countries as $country) {
                    $countries_index[$country["Name"]] = '<a href="javascript:openDialog(contents[\''.$country["Name"].'\'].title,contents[\''.$country["Name"].'\'].content)">'.$country['Name'].'</a>';
                ?>
                <script type="text/javascript">
                contents["<?php echo $country["Name"];?>"] = {
                    title:   <?php echo json_encode($country["Name"]);?> ,
                    content: <?php echo json_encode(trim($country["Content_Center"])); ?>
                };
                </script>
            <?php }
            
                foreach ($countries_index as $key=>$rep) {                      // used for exact replace word
                    $sec["Content_Center"] = preg_replace('/\b'.$key.'\b/', $rep, $sec["Content_Center"]);
                }
            ?>
            
        
        <div class="collapse" id="openForm">
            <div class="row justify-content-center">
                <?php if($sec["Content_Center"]){?>
                    <div class="col col-lg-10 sectionContentCenter">
                        <div class="richtext"><?php echo $sec["Content_Center"];?></div>
                    </div>
                <?php }?>
            </div>

            <div class="formArea">
                <?php if(isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]){?>
                    
                <?php }else{?>
                    <form 
                        action="https://direct.tranzila.com/israelkasirer/iframe.php" 
                        method="post" 
                        name="contactForm" 
                        style="padding: 0px; margin: 0px;" 
                        id="donation_form"
                    >
                        <input type="hidden" name="hidden_url" value="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>"/>
                        <input type="hidden" name="hidden_subject" value="<?php echo $trans->getText("Send");?> <?php echo $cfg["WM"]["WebsiteName"];?> (<?php echo $wmPage["Name"]?>)" />
                        <input type="hidden" name="page_id" value="<?php echo $wmPage['ID'];?>" />
                        <input type="hidden" name="pdesc" value="Donation" />

                        <div class="row rowMargin">
                            <!-- Amount -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Amount" class="outsideInputTitle"><?php echo $trans->getText("Amount")."&nbsp;*";?></label>
                                <div class="form-group">
                                    <select class="form-control" name="sum" id="Amount">
                                        <option>50</option>
                                        <option>100</option>
                                        <option>180</option>
                                        <option>250</option>
                                        <option>500</option>
                                        <option>1000</option>
                                        <option>1800</option>
                                        <option value="other">other amount</option>
                                    </select>
                                </div>
                                    <?php /*
                                <input type="checkbox" id="monthly_gift"><label class="checkboxText" for="monthly_gift"><?php echo $trans->getText("Make this a monthly gift");?></label>
                                */?>
                            </div>

                            <!-- Other amount -->
                            <div id="other_amount" class="col-12 col-md-4 inputDiv">
                                <label for="other_amount" class="outsideInputTitle"><?php echo $trans->getText("Other amount")."&nbsp;*";?></label>
                                <input name="other_amount_input" type="text" id="other_amount_input" class="formInput" placeholder="<?php echo $trans->getText("Enter an amount");?>" />
                            </div>

                            <!-- Other amount -->
                            <div class="col-12 col-md-4 inputDiv">
                                <?php /*
                                <label for="Currency" class="outsideInputTitle"><?php echo $trans->getText("Currency")."&nbsp;*";?></label>
                                <input name="Currency" type="text" id="Currency" class="formInput" placeholder="<?php echo $trans->getText("Currency");?>" required="required" />
                                */ ?>
                                <label for="Currency" class="outsideInputTitle"><?php echo $trans->getText("Currency")."&nbsp;*";?></label>
                                <div class="form-group">
                                    <select class="form-control" name="currency" id="Currency">
                                        <?php /*<option value="978"><?php echo $trans->getText("€");?></option>*/?>
                                        <option value="2"><?php echo $trans->getText("$");?></option>
                                        <option value="1"><?php echo $trans->getText("ILS");?></option>
                                        <?php /*<option value="978"><?php echo $trans->getText("EUR");?></option>*/?>
                                        <?php /* <option value="826"><?php echo $trans->getText("GBP");?></option> */?>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- In Honor/Memory of -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Honor_Memory" class="outsideInputTitle"><?php echo $trans->getText("In Honor/Memory of");?></label>
                                <input name="Honor_Memory" type="text" id="Honor_Memory" class="formInput" />
                            </div>

                            <!-- Designation -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Designation" class="outsideInputTitle"><?php echo $trans->getText("Designation")."&nbsp;*";?></label>
                                <div class="form-group">
                                    <select class="form-control" name="division" id="Designation">
                                        <option value="<?php echo $trans->getText("Where it is most needed");?>"><?php echo $trans->getText("Where it is most needed");?></option>
                                        <option value="<?php echo $trans->getText("The Edmond and Lily Safra Children's Hospital");?>"><?php echo $trans->getText("The Edmond and Lily Safra Children's Hospital");?></option>
                                        <option value="<?php echo $trans->getText("The Cancer Center");?>"><?php echo $trans->getText("The Cancer Center");?></option>
                                        <option value="<?php echo $trans->getText("Surgical Intensive Care Unit");?>"><?php echo $trans->getText("Surgical Intensive Care Unit");?></option>
                                        <option value="<?php echo $trans->getText("CAR-T");?>"><?php echo $trans->getText("CAR-T");?></option>
                                    </select>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Title" class="outsideInputTitle"><?php echo $trans->getText("Title")."&nbsp;*";?></label>
                                <div class="form-group">
                                    <select class="form-control" name="Title" id="Title">
                                        <option><?php echo $trans->getText("Ms.");?></option>
                                        <option><?php echo $trans->getText("Mr.");?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Full name -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="First_Name" class="outsideInputTitle"><?php echo $trans->getText("Full Name")."&nbsp;*";?></label>
                                <input name="contact" type="text" id="First_Name" class="formInput" required="required" />
                            </div>

                            <!-- Email -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Email" class="outsideInputTitle"><?php echo $trans->getText("Email")."&nbsp;*";?></label>
                                <input name="email" type="email" id="Email" class="formInput" required="required" />
                            </div>

                            <!-- Phone -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Phone" class="outsideInputTitle"><?php echo $trans->getText("Phone")."&nbsp;*";?></label>
                                <input name="phone" type="text" id="Phone" class="formInput" required="required" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Address -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label id="Address" class="outsideInputTitle"><?php echo $trans->getText("Address")."&nbsp;*";?></label>
                                <input name="address" type="text" id="Address" class="formInput" required="required" />
                            </div>

                            <!-- Billing address -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Billing_Address" class="outsideInputTitle"><?php echo $trans->getText("Billing address")."&nbsp;*";?></label>
                                <input name="Billing_Address" type="text" id="Billing_Address" class="formInput" required="required" />
                            </div>

                            <!-- Country -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Country" class="outsideInputTitle"><?php echo $trans->getText("Country")."&nbsp;*";?></label>
                                <input name="remarks" type="text" id="Country" class="formInput" required="required" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- State -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="City" class="outsideInputTitle"><?php echo $trans->getText("City")."&nbsp;*";?></label>
                                <input name="city" type="text" id="City" class="formInput" required="required" />
                            </div>

                            <!-- Zip/Postal code -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Zip_Postal_Code" class="outsideInputTitle"><?php echo $trans->getText("Zip/Postal code")."&nbsp;*";?></label>
                                <input name="Zip_Postal_Code" type="text" id="Zip_Postal_Code" class="formInput" required="required" />
                            </div>

                            <!-- Leave a comment -->
                            <div class="col-12 col-md-4 inputDiv">
                                <label for="Comment" class="outsideInputTitle"><?php echo $trans->getText("Leave a comment");?></label>
                                <input name="comments" type="text" id="Comment" class="formInput" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8 inputDiv">
                                <input type="checkbox" id="subsctibe"><label class="checkboxText" for="subscribe"><?php echo $trans->getText("I would like to receive Sheba newsletter");?></label>
                            </div>

                            <div class="col-12 col-md-4 inputDiv">
                                <button class="lpButton ts">
                                    <?php echo $trans->getText("Send donation");?>
                                </button>
                                <input type="hidden" name="hidden_Submit" value="1" />
                            </div>        
                        </div>
                    </form>
                <?php }?>
            </div>
        </div>
	</div>
</section>
