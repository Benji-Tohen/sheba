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
            
            <?php if($tranzillaProcess && $tranzillaError){ ?>
            <div class="col-12">
                <div class="errorMassege">
                    <h2><?php echo $trans->getText("Donating Error!");?></h2>
                    <h3><?php echo $trans->getText("Please try again");?>:</h3>
                </div>
            </div>
            <?php } else if ($tranzillaProcess) { ?>
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

                        <div class="row rowMargin">
                            <!-- Gift -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <input type="checkbox" id="in_name_of" name="in_name_of"><label class="checkboxText" for="in_name_of"><?php echo $trans->getText("Make this a monthly gift");?></label>
                                <label for="In_Name" class="hiddenLabel"><?php echo $trans->getText("Enter name here")."&nbsp;*";?></label>
                                <input name="In_Name" type="text" id="In_Name" class="formInput" placeholder="<?php echo $trans->getText("Enter name here");?>" required="required" />
                            </div>

                            <!-- Honor_Memory -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <input type="checkbox" id="recognition"><label class="checkboxText" for="recognition"><?php echo $trans->getText("In Honor/Memory of");?></label>
                                <label for="Honor_Memory" class="hiddenLabel"><?php echo $trans->getText("In Honor/Memory of");?></label>
                                <input name="Honor_Memory" type="text" id="Honor_Memory" class="formInput" />
                            </div>

                            <!-- First name -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="First_Name" class="outsideInputTitle"><?php echo $trans->getText("Full Name")."&nbsp;*";?></label>
                                <input name="Full_Name" type="text" id="First_Name" class="formInput" required="required" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Last name -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Last_Name" class="outsideInputTitle"><?php echo $trans->getText("Last Name")."&nbsp;*";?></label>
                                <input name="Last_Name" type="text" id="Last_Name" class="formInput" required="required" />
                            </div>

                            <!-- Company name -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="CompanyCompany" class="outsideInputTitle"><?php echo $trans->getText("Company Name")."&nbsp;*";?></label>
                                <input name="Company" type="text" id="Company" class="formInput" required="required" />
                            </div>

                            <!-- Street -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label id="Street" class="outsideInputTitle"><?php echo $trans->getText("Street")."&nbsp;*";?></label>
                                <input name="Street" type="text" id="Street" class="formInput" required="required" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- House Num -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="House_Num" class="outsideInputTitle"><?php echo $trans->getText("House Num")."&nbsp;*";?></label>
                                <input name="House_Num" type="text" id="House_Num" class="formInput" required="required" />
                            </div>

                            <!-- Apartment Num -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Apartment_Num" class="outsideInputTitle"><?php echo $trans->getText("Apartment Num")."&nbsp;*";?></label>
                                <input name="Apartment_Num" type="text" id="Apartment_Num" class="formInput" required="required" />
                            </div>

                            <!-- City -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="City" class="outsideInputTitle"><?php echo $trans->getText("City")."&nbsp;*";?></label>
                                <input name="City" type="text" id="City" class="formInput" required="required" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Zip Code -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label id="Address" class="outsideInputTitle"><?php echo $trans->getText("Zip Code")."&nbsp;*";?></label>
                                <input name="Zip_Code" type="text" id="Zip_Code" class="formInput" required="required" />
                            </div>

                            <!-- Phone -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Phone" class="outsideInputTitle"><?php echo $trans->getText("Phone")."&nbsp;*";?></label>
                                <input name="Phone" type="text" id="Phone" class="formInput" required="required" />
                            </div>

                            <!-- Email -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Email" class="outsideInputTitle"><?php echo $trans->getText("Email")."&nbsp;*";?></label>
                                <input name="Email" type="email" id="Email" class="formInput" required="required" />
                            </div>
                        </div>

                        <div class="row rowMargin">
                            <!-- Amount -->
                            <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                <label for="Amount" class="outsideInputTitle"><?php echo $trans->getText("Amount")."&nbsp;*";?></label>
                                <div class="form-group">
                                    <select class="form-control" name="Amount" id="Amount">
                                        <option>10</option>
                                        <option>20</option>
                                        <option>30</option>
                                        <option>40</option>
                                        <option>50</option>
                                        <option>60</option>
                                        <option>70</option>
                                        <option>80</option>
                                        <option>90</option>
                                        <option>100</option>
                                        <option value="other">other amount</option>
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

                    </form>
                <?php }?>
            </div>
        </div>
	</div>
</section>