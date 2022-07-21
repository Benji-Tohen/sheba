<?php include($_SERVER["DOCUMENT_ROOT"]."/devices/desktop/sheba/php_components/select2.php");?>
<!--  DINAMIC FORM  -->
<?php if($wmPage["wm_forms"]){ ?>
<div id="form_anchor">
    <?php if(
        isset($_POST['csrf']) && !empty($_POST['csrf']) &&
        isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']) &&
        isset($_POST['submit']) && !empty($_POST['submit'])

    ){?>
            <?php if($_POST && isset($eladResult) && $eladResult){ ?>
                <div class="answerText">
                    <?php echo $form["Answer_Text"]?$form["Answer_Text"]:$wmPage["Answer_Text"];?>
                </div>
            <?php } elseif($_POST){ ?>
                <div class="col">
                    <div class="errorMassege">
                        <h2><?php echo $trans->getText("Send Error!");?></h2>
                        <h3><?php echo $trans->getText("Please try again");?></h3>
                    </div>
                </div>
            <?php } ?>
        <?php echo $form['Conversion']?>
    <?php } else {?>
        <form 
            id="sendForm"
            action="<?php echo $_SERVER['REQUEST_URI']."?form_submit=1#form_anchor"?>" 
            method="post" 
        >
            <input type="hidden" name="csrf" value="<?php echo $csrf_display?>" />
            <input type="hidden" name="submit" value="1" />
            <?php echo $htmlFields;?>

            <div class="row">
                <div class="col">
                    <div 
                    style="margin-bottom: 10px;" 
                    data-callback="recaptchaCallback" 
                    class="g-recaptcha" 
                    data-sitekey="<?php echo recaptcha_clientkey(); ?>">
                </div>
                </div>
                <div class="col d-flex justify-content-end">
                    <!-- <input type="submit" name="submit" id="submin"  class="dynamicSubmit" value="<?php echo $trans->getText("Send");?>" /> -->
                    <button type="submit" class="dynamicSubmit" id="submit" ><?php echo $trans->getText("Send");?></button>
                </div>
            </div>
        </form>
    <?php }?>
</div>
<?php }?>
<!--  END DINAMIC FORM  -->