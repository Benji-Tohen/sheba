<?php include($_SERVER["DOCUMENT_ROOT"]."/devices/desktop/sheba/php_components/combo_box.php");?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/devices/desktop/sheba/php_components/select2.php");?>
<script>
  $(document).ready(function(){
    $( ".selectpicker" ).combobox();
    $(".select2").each(function(index, select){
        const data = {
            selectionCssClass: "form-control",
            dir: "rtl"
        };
        if( "ph" in select.dataset ){
            data["placeholder"] = select.dataset.ph;
        }
        $(select).select2(data);
    });

    document.getElementById('sendForm').onsubmit = function () {
        delayBtn(document.getElementById('submit'),1000000);
        if (!grecaptcha.getResponse()) {
            document.getElementById("submit").disabled = true;
            alert('Captcha failed');
            document.getElementById("submit").disabled = false;
            return false; //return false not send form
        }else{
            return true;
        }
    }
  });

</script>

<?php
function recaptcha_clientkey() {
    switch ($_SERVER["SERVER_NAME"]) {
        case "www.sheba.co.il":
            return "6Lc_3AsTAAAAAM03d_sTtsqUYAMogqvsFWwjVH6t";
            break;
        case "www.shebatest.co.il":
            return "6LfeUQ4TAAAAAMY0_4ov41aYavTBxsFBYEQLGzXd";
            break;
        case "gastro.sheba.co.il":
            return "6Lc_3AsTAAAAAM03d_sTtsqUYAMogqvsFWwjVH6t";
            break;
        case "shikum.sheba.co.il":
        case "yeladim.sheba.co.il":
        case "heart.sheba.co.il":
        case "heart-surgery.sheba.co.il":
        case "ella.sheba.co.il":
        case "cancer.sheba.co.il":
        case "imaging.sheba.co.il":
        case "talpiot.sheba.co.il":
        case "rnd.sheba.co.il":
        case "research.sheba.co.il":
        case "nashim.sheba.co.il":
        case "maternity.sheba.co.il":
        case "nursing-students.sheba.co.il":
        case "mdacc-sheba.sheba.co.il":
            return "6Lc_3AsTAAAAAM03d_sTtsqUYAMogqvsFWwjVH6t";
            break;
        default:
            return "6Lc_3AsTAAAAAM03d_sTtsqUYAMogqvsFWwjVH6t";
            break;    
    }
}?>

<div class="container formPage">
    <div class="row">
        <div class="col <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1>
                <?php echo ($allFormData["h1"]) ? $allFormData["h1"] : $allFormData["Name"];?>
            </h1>
            <?php if ($wmPage["Sub_Title"]) { ?>
                <h2><?php echo $wmPage["Sub_Title"];?></h2>
            <?php } ?>
    
            <!--  DINAMIC FORM  -->
            <?php if(true){?>
                <?php if(
                    isset($_POST['csrf']) && !empty($_POST['csrf']) &&
                    isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']) &&
                    isset($_POST['submit']) && !empty($_POST['submit'])
                
                ){?>
                     <?php if(!$eladResult && $_POST){ ?>
                        <div class="col">
                            <div class="errorMassege">
                                <h2><?php echo $trans->getText("Send Error!");?></h2>
                                <h3><?php echo $trans->getText("Please try again");?></h3>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="answerText">
                            <?php echo $form["Answer_Text"]?$form["Answer_Text"]:$wmPage["Answer_Text"];?>
                        </div>
                <?php } ?>
                    <?php echo $form['Conversion']?>
                <?php } else {?>
                    <form 
                        id="sendForm"
                        action="<?php echo $_SERVER['REQUEST_URI']."?form_submit=1"?>" 
                        method="post" 
                    >
                        <input type="hidden" name="csrf" value="<?php echo $csrf_display?>" />
                        <input type="hidden" name="submit" value="1" />
                        <?php echo $htmlFields;?>
                        <div 
                            style="margin-bottom: 10px;" 
                            data-callback="recaptchaCallback" 
                            class="g-recaptcha" 
                            data-sitekey="<?php echo recaptcha_clientkey(); ?>">
                        </div>

                        <!-- <input type="submit" name="submit" id="submin"  class="dynamicSubmit" value="<?php echo $trans->getText("Send");?>" /> -->
                        <button type="submit" class="dynamicSubmit" id="submit" ><?php echo $trans->getText("Send");?></button>
                    </form>
                <?php }?>
            <?php }?>
            <!--  END DINAMIC FORM  -->
            <div class="col col-md-6 col-lg-6">
                <div class="fieldsNote"><?php echo "*&nbsp;".$trans->getText("Fields with an asterisk are required");?></div>
            </div>
        </div>
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-10 col-offset-1 col-sm-10 offset-sm-1 col-md-4 offset-md-0 col-lg-4 offset-lg-0 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
</div>


