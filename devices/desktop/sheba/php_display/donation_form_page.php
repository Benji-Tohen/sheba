<div class="anchorOffset" id="<?php echo $wmPage["ID"]; ?>"></div>
<section class="sec_<?php echo $wmPage["ID"]; ?>">
    
    <div class="container">
        <div class="row">
            <div class="col-12 <?php if ($wmPage["Enable_SideContent"]) { ?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php } ?>">
                <div class="row" id="formAnchor">
                    <?php if ($wmPage["Content"]) { ?>
                        <div class="col-12 col-md-12 col-lg-10 offset-lg-1 sectionContent">
                            <div class="richtext"><?php echo $wmPage["Content"]; ?></div>
                        </div>
                    <?php } 
                    if ((isset($_POST["ConfirmationCode"]) && $_POST["ConfirmationCode"] == "0000000") || 
                        (isset($isSent["Success"]) && !$isSent["Success"]  && $_POST)){ 
                    ?>
                        <div class="col-12">
                            <div class="errorMassege">
                                <h2><?php echo $trans->getText("Donating Error!"); ?></h2>
                                <h3><?php echo $trans->getText("Please try again"); ?></h3>
                            </div>
                        </div>
                    <?php } else if (isset($_POST["ConfirmationCode"]) && $_POST["ConfirmationCode"] != "0000000") { ?>
                        <div class="col-12">
                            <div class="thankYou">
                                <img src="<?php echo $filepath; ?>/img/approved.svg" alt="<?php echo $wmPage["Answer_Text"]; ?>" />
                                <h2><?php echo $trans->getText("Thank You"); ?></h2>
                                <div class="answerText"><?php echo $wmPage["Answer_Text"]; ?></div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                location.hash = "#goBackAnswer";
                            });
                        </script>
                        <?php echo $wmPage["Conversion"]; ?>
                    <?php } ?>
                </div>
                <?php
                $countries = $wm->getMenuLevel($wmPage["ID"]);
                $countries_index = array();
                foreach ($countries as $country) {
                    $countries_index[$country["Name"]] = '<a href="javascript:openDialog(contents[\'' . $country["Name"] . '\'].title,contents[\'' . $country["Name"] . '\'].content)">' . $country['Name'] . '</a>';
                ?>
                    <script type="text/javascript">
                        contents["<?php echo $country["Name"]; ?>"] = {
                            title: <?php echo json_encode($country["Name"]); ?>,
                            content: <?php echo json_encode(trim($country["Content_Center"])); ?>
                        };
                    </script>
                <?php }

                foreach ($countries_index as $key => $rep) {                      // used for exact replace word
                    $wmPage["Content_Center"] = preg_replace('/\b' . $key . '\b/', $rep, $wmPage["Content_Center"]);
                }
                ?>

                <div class="" id="openForm">
                    <div class="row">
                        <?php if ($wmPage["Content_Center"]) { ?>
                            <div class="col-12 col-md-12 col-lg-10 offset-lg-1 sectionContentCenter">
                                <div class="richtext"><?php echo $wmPage["Content_Center"]; ?></div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="formArea">
                        <?php if (isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]) { ?>

                        <?php } else { ?>
                            <form 
                                action="https://direct.tranzila.com/israelkasirer/iframe.php" 
                                method="post" 
                                name="contactForm" 
                                style="padding: 0px; margin: 0px;"
                                id="donation_form" 
                            >
                                <input type="hidden" name="hidden_url" value="<?php echo $cfg["WM"]["Server"]; ?>/<?php echo $wmPage["Alias"] ? $wmPage["Alias"] : $wmPage["ID"]; ?>" />
                                <input type="hidden" name="hidden_subject" value="<?php echo $trans->getText("Send"); ?> <?php echo $cfg["WM"]["WebsiteName"]; ?> (<?php echo $wmPage["Name"] ?>)" />
                                <input type="hidden" name="page_id" value="<?php echo $wmPage['ID'];?>" />
                                <input type="hidden" name="pdesc" value="Donation" />

                                <div class="row">
                                    <div class="col-12">
                                        <div class="secureMsg">
                                            <img src="<?php echo $cfg["WM"]["Server"]; ?>/webfiles/lp_images/secure.png" alt="<?php echo $trans->getText('Secure donation form'); ?>" class="secureImg" />
                                            <?php echo $trans->getText('Secure donation form'); ?>
                                        </div>
                                    </div>
                                </div>

                                <?php /*
                                <div class="row rowMargin">
                                    <!-- Gift -->
                                    <div class="col-12 col-md-4 col-lg-4 inputDiv">
                                        <input type="checkbox" id="in_name_of" name="in_name_of"><label class="checkboxText" for="in_name_of"><?php echo $trans->getText("Make this a monthly gift");?></label>
                                        <label for="In_Name" class="hiddenLabel"><?php echo $trans->getText("Enter name here")."&nbsp;*";?></label>
                                        <input name="In_Name" type="text" id="In_Name" class="formInput" placeholder="<?php echo $trans->getText("Enter name here");?>" />
                                    </div>
                                </div>
                                */ ?>

                                <div class="row rowMargin">
                                    <!-- Division Type -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="division" class="outsideInputTitle"><?php echo $trans->getText("who you want to donate to?") . "&nbsp;*"; ?></label>
                                        <div class="form-group">
                                            <select class="form-control" name="division" id="division" required>
                                                <option value="0"><?php echo $trans->getText("Choose"); ?></option>
                                                <?php  foreach ($arrLinksDivisions as $key => $division) { ?>
                                                    <option value="<?php echo $division["Name"]; ?>"><?php echo $division["Name"]; ?></option>
                                                <?php } ?>
                                                <option value="other"><?php echo $trans->getText("Others"); ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Amount -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv" required>
                                        <label for="Amount" class="outsideInputTitle"><?php echo $trans->getText("Amount in nis") . "&nbsp;*"; ?></label>
                                        <div class="form-group">
                                            <select class="form-control" name="sum" id="Amount">
                                                <option value="0"><?php echo $trans->getText("Choose"); ?></option>
                                                <?php foreach ($arrLinksAmount as $key => $amount) { ?>
                                                    <option value="<?php echo $amount["Name"]; ?>"><?php echo $amount["Name"]; ?></option>
                                                <?php } ?>
                                                <option value="other"><?php echo $trans->getText("Other"); ?></option>
                                            </select>
                                        </div>

                                        <?php /* <input type="checkbox" id="monthly_gift"><label class="checkboxText" for="monthly_gift"><?php echo $trans->getText("Make this a monthly gift");?></label> */ ?>
                                    </div>
                                </div>

                                <div class="row rowMargin">
                                    <!-- Other amount -->
                                    <div id="other_amount" class="col-12 inputDiv">
                                        <label for="other_amount" class="outsideInputTitle"><?php echo $trans->getText("Other amount") . "&nbsp;*"; ?></label>
                                        <input name="other_amount" type="text" id="other_amount_input" class="formInput" placeholder="<?php echo $trans->getText("Enter an amount"); ?>" />
                                    </div>
                                </div>

                                <div class="row rowMargin">
                                    <!-- Receipt -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="receipt" class="checkboxText"><?php echo $trans->getText("Receipt on the name of"); ?></label>
                                        <input name="receipt" type="text" id="receipt" class="formInput receiptInput" />
                                    </div>

                                    <!-- Comments -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="comments" class="checkboxText"><?php echo $trans->getText("Comments"); ?></label>
                                        <textarea name="comments" type="text" id="comments" class="formTextArea"></textarea>
                                    </div>
                                </div>

                                <hr />

                                <div class="row rowMargin">
                                    <!-- First name -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="First_Name" class="outsideInputTitle"><?php echo $trans->getText("Full Name With Last Name") . "&nbsp;*"; ?></label>
                                        <input name="contact" type="text" id="First_Name" class="formInput" />
                                    </div>

                                    <!-- Street -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="Street" class="outsideInputTitle"><?php echo $trans->getText("Full Address") . "&nbsp;*"; ?></label>
                                        <input name="address" type="text" id="Street" class="formInput" autocomplete="street-address" />
                                    </div>
                                </div>

                                <div class="row rowMargin">
                                    <!-- City -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="City" class="outsideInputTitle"><?php echo $trans->getText("City") . "&nbsp;*"; ?></label>
                                        <input name="city" type="text" id="City" class="formInput" autocomplete="address-level2" />
                                    </div>

                                    <!-- Zip Code -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="Zip_Code" class="outsideInputTitle"><?php echo $trans->getText("Zip Code") . "&nbsp;"; ?></label>
                                        <input name="Zip_Code" type="text" id="Zip_Code" class="formInput" />
                                    </div>
                                </div>

                                <div class="row rowMargin">
                                    <!-- Phone -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="Phone" class="outsideInputTitle"><?php echo $trans->getText("Phone") . "&nbsp;*"; ?></label>
                                        <input name="phone" type="text" id="Phone" class="formInput" autocomplete='email' />
                                    </div>

                                    <!-- Email -->
                                    <div class="col-12 col-md-6 col-lg-6 inputDiv">
                                        <label for="Email" class="outsideInputTitle"><?php echo $trans->getText("Email") . "&nbsp;*"; ?></label>
                                        <input name="email" type="email" id="Email" class="formInput" autocomplete='tel' />
                                    </div>
                                </div>

                                <div class="row rowMargin">
                                    <div class="col-12 col-md-4 col-lg-4 offset-md-4 offset-lg-4 inputDiv">
                                        <label class="outsideInputTitle">&nbsp;</label>
                                        <button id="submit_btn" class="lpButton ts">
                                            <?php echo $trans->getText("Send Donation"); ?>
                                        </button>
                                        <input type="hidden" name="hidden_Submit" value="1" />
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if ($wmPage["Enable_SideContent"]) { ?>
                <div class="col-10 offset-xs-1 col-sm-10 offset-sm-1 col-md-4 offset-md-0 col-lg-4 offset-lg-0 pageSideContent ">
                    <?php include(dirname(__FILE__) . "/../php_components/side_widgets.php"); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>