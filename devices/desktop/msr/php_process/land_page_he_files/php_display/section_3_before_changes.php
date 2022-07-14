<div class="anchorOffset" id="<?php echo $sec["ID"];?>"></div>
<section class="sec_<?php echo $sec["ID"];?>">
    <button type="button" class="donateButton ts" onclick="scrollToForm()" title="<?php echo $trans->getText("Donate")."&nbsp;".$trans->getText("Now");?>" data-toggle="collapse" data-target="#openForm"><?php echo $trans->getText("Donate")."<br />".$trans->getText("Now");?></button>

	<div class="container">
		<div class="row" id="formAnchor">
			<?php if($sec["Content"]){?>
				<div class="col-12 col-md-12 col-lg-10 col-lg-offset-1 sectionContent">
					<div class="richtext"><?php echo $sec["Content"];?></div>
				</div>
			<?php }?>
            <?php if(isset($_POST["ConfirmationCode"]) && $_POST["ConfirmationCode"]=="0000000"){ ?>
            <div class="col-12">
                <div class="errorMassege">
                    <h2><?php echo $trans->getText("Donating Error!");?></h2>
                    <h3><?php echo $trans->getText("Please try again");?>:</h3>
                </div>
            </div>
            <?php } else if (isset($_POST["ConfirmationCode"]) && $_POST["ConfirmationCode"]!="0000000") { ?>
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
            <div class="row">
                <?php if($sec["Content_Center"]){?>
                    <div class="col-12 col-md-12 col-lg-10 col-lg-offset-1 sectionContentCenter">
                        <div class="richtext"><?php echo $sec["Content_Center"];?></div>
                    </div>
                <?php }?>
            </div>

            <div class="formArea">
                <?php if(isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]){?>

                <?php }else{?>
                    <form action="<?php echo $cfg["WM"]["Server"];?>?POST" method="post" name="contactForm" style="padding: 0px; margin: 0px;" onsubmit="return checkFormContact();">
                        <input type="hidden" name="hidden_url" value="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>"/>
                        <input type="hidden" name="hidden_subject" value="<?php echo $trans->getText("Send");?> <?php echo $cfg["WM"]["WebsiteName"];?> (<?php echo $wmPage["Name"]?>)" />
                        <div class="row">
                            <div class="col-12">
                                <div class="secureMsg">
                                    <img src="<?php echo $cfg["WM"]["Server"];?>/webfiles/lp_images/secure.png" alt="<?php echo $trans->getText('Secure donation form');?>" class="secureImg" />
                                    <?php echo $trans->getText('Secure donation form');?>
                                </div>
                            </div>
                        </div>

                        <?php /*
                        <div class="row rowMargin">
                            <!-- Gift -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <input type="checkbox" id="in_name_of" name="in_name_of"><label class="checkboxText" for="in_name_of"><?php echo $trans->getText("Make this a monthly gift");?></label>
                                <label for="In_Name" class="hiddenLabel"><?php echo $trans->getText("Enter name here")."&nbsp;*";?></label>
                                <input name="In_Name" type="text" id="In_Name" class="formInput" placeholder="<?php echo $trans->getText("Enter name here");?>" required="required" />
                            </div>
                        </div>
                        */?>

                        <div class="row rowMargin">
                            <!-- First name -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="First_Name" class="outsideInputTitle"><?php echo $trans->getText("First Name")."&nbsp;*";?></label>
                                <input name="Full_Name" type="text" id="First_Name" class="formInput" required="required" />
                            </div>

                            <!-- Last name -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Last_Name" class="outsideInputTitle"><?php echo $trans->getText("Last Name")."&nbsp;*";?></label>
                                <input name="Last_Name" type="text" id="Last_Name" class="formInput" required="required" />
                            </div>

                            <!-- Company name -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="CompanyCompany" class="outsideInputTitle"><?php echo $trans->getText("Company Name")."&nbsp;";?></label>
                                <input name="Company" type="text" id="Company" class="formInput"  />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Street -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label id="Street" class="outsideInputTitle"><?php echo $trans->getText("Street")."&nbsp;*";?></label>
                                <input name="Street" type="text" id="Street" class="formInput" required="required" />
                            </div>

                            <!-- House Num -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="House_Num" class="outsideInputTitle"><?php echo $trans->getText("House Num")."&nbsp;*";?></label>
                                <input name="House_Num" type="text" id="House_Num" class="formInput" required="required" />
                            </div>

                            <!-- Apartment Num -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Apartment_Num" class="outsideInputTitle"><?php echo $trans->getText("Apartment Num")."&nbsp;";?></label>
                                <input name="Apartment_Num" type="text" id="Apartment_Num" class="formInput"  />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- City -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="City" class="outsideInputTitle"><?php echo $trans->getText("City")."&nbsp;*";?></label>
                                <input name="City" type="text" id="City" class="formInput" required="required" />
                            </div>

                            <!-- Zip Code -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label id="Address" class="outsideInputTitle"><?php echo $trans->getText("Zip Code")."&nbsp;";?></label>
                                <input name="Zip_Code" type="text" id="Zip_Code" class="formInput" />
                            </div>

                            <!-- Phone -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Phone" class="outsideInputTitle"><?php echo $trans->getText("Phone")."&nbsp;*";?></label>
                                <input name="Phone" type="text" id="Phone" class="formInput" required="required" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Email -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Email" class="outsideInputTitle"><?php echo $trans->getText("Email")."&nbsp;*";?></label>
                                <input name="Email" type="email" id="Email" class="formInput" required="required" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <hr />
                            <!-- Donation Type -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="donationType" class="outsideInputTitle"><?php echo $trans->getText("donationType")."&nbsp;*";?></label>
                                <div class="form-group">
                                    <select class="form-control" name="donationType" id="donationType">
                                        <option value="0"><?php echo $trans->getText("Choose");?></option>
                                        <?php foreach ($arrLinksDonationType as $key => $donationType) {?>
                                            <option value="<?php echo $donationType["Name"];?>"><?php echo $donationType["Name"];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <!-- Honor -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Honor_Memory" class="checkboxText"><?php echo $trans->getText("In Honor");?></label>
                                <input name="Honor_Memory" type="text" id="Honor_Memory" class="formInput" />
                            </div>

                            <!-- Division Type -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="division" class="outsideInputTitle"><?php echo $trans->getText("division")."&nbsp;*";?></label>
                                <div class="form-group">
                                    <select class="form-control" name="division" id="division">
                                        <option value="0"><?php echo $trans->getText("Choose");?></option>
                                        <?php foreach ($arrLinksDivisions as $key => $division) {?>
                                            <option value="<?php echo $division["Name"];?>"><?php echo $division["Name"];?></option>
                                        <?php }?>
                                        <option value="other"><?php echo $trans->getText("Others");?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="other_division">
                            <div class="row rowMargin">
                                <div class="col-12 col-md-4 col-lg-4 col-md-offset-8 col-lg-offset-8 inputDiv">
                                    <label for="other_division_input" class="checkboxText"><?php echo $trans->getText("Other Division");?></label>
                                    <input name="other_division_input" type="text" id="other_division_input" class="formInput" />
                                </div>
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Receipt -->
                            <div class="col-12 col-md-4 col-lg-4 col-md-offset-8 col-lg-offset-8 inputDiv">
                                <label for="receipt" class="checkboxText"><?php echo $trans->getText("Receipt on the name of");?></label>
                                <input name="receipt" type="text" id="receipt" class="formInput" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Comments -->
                            <div class="col-12 inputDiv">
                                <label for="comments" class="checkboxText"><?php echo $trans->getText("Comments");?></label>
                                <textarea name="comments" type="text" id="comments" class="formTextArea"></textarea>
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <hr />

                            <!-- Amount -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Amount" class="outsideInputTitle"><?php echo $trans->getText("Amount in nis")."&nbsp;*";?></label>
                                <div class="form-group">
                                    <select class="form-control" name="Amount" id="Amount">
                                        <option value="0"><?php echo $trans->getText("Choose");?></option>
                                        <?php foreach ($arrLinksAmount as $key => $amount) {?>
                                            <option value="<?php echo $amount["Name"];?>"><?php echo $amount["Name"];?></option>
                                        <?php }?>
                                        <option value="other"><?php echo $trans->getText("Other");?></option>
                                    </select>
                                </div>

                                <?php /* <input type="checkbox" id="monthly_gift"><label class="checkboxText" for="monthly_gift"><?php echo $trans->getText("Make this a monthly gift");?></label> */ ?>
                            </div>

                            <!-- Other amount -->
                            <div id="other_amount" class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="other_amount" class="outsideInputTitle"><?php echo $trans->getText("Other amount")."&nbsp;*";?></label>
                                <input name="other_amount" type="text" id="other_amount_input" class="formInput" placeholder="<?php echo $trans->getText("Enter an amount");?>"/>
                            </div>

                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label class="outsideInputTitle">&nbsp;</label>
                                <button type="submit" name="submit" class="lpButton ts">
                                    <?php echo $trans->getText("Send donation");?>
                                </button>
                                <input type="hidden" name="hidden_Submit" value="1" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <hr />

                            <div class="donationTaxs"><?php echo $trans->getText("donation_tax_text");?></div>
                        </div>
                    </form>
                <?php }?>
            </div>
        </div>
	</div>
</section>