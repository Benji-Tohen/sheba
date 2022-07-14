<?php /*
if($_SERVER['REMOTE_ADDR'] == '31.168.120.186'){
	echo "shery";
	
	$query1 = "update wm_forms_field_types set Value = replace(Value,'checked','')";
	echo "<pre>";
	print_r($db->runQuery($query1));
	echo "</pre>";

	$query = "SELECT * 
				FROM  `wm_forms_field_types` 
				WHERE  `ID` =2
				LIMIT 0 , 30";
	echo "<pre>";
	print_r($db->getArray($query));
	echo "</pre>";
}
*/

function recaptcha_clientkey() {
    switch ($_SERVER["SERVER_NAME"]) {
        case "sheba.tohendns.com":
            return "6Lc5hgYTAAAAAMCZS1nel557gkcXJ3e_koSZHQ3x";
            break;
        case "www.sheba.co.il":
            return "6Lc_3AsTAAAAAM03d_sTtsqUYAMogqvsFWwjVH6t";
            break;
        case "www.shebatest.co.il":
            return "6LfeUQ4TAAAAAMY0_4ov41aYavTBxsFBYEQLGzXd";
            break;
        case "gastro.sheba.co.il":
            return "6LfCah8TAAAAALWLdUgr1VBrl7GiZyzUjoaq4VXS";
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
        return "6LcsbB8TAAAAAGsSbMNWwqXsnvStiSmkL2BSKobs";
            break;
		case "eng.msr.org.il": // Captcha settings in analytics@tohen-media.com
            return "6LdbT1MUAAAAAPusiu-uwxe7NEzKCYz8_E2zdMCU";
        case "msr.org.il":
        case "www.msr.org.il": // Captcha settings in analytics@tohen-media.com
            return "6LcG8E0UAAAAAC9oSqONTCdr-oR6rPivx29FZIlU";
            break;
            
    }
}

?>
<style type="text/css">
    .breadCrumbs a, .breadCrumbs{
        display: none;
    }
</style>
<div class="container formPage">
    <div class="row">

        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $form["Name"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!--	DINAMIC FORM	-->
            <?php if(true){?>
                <?php if($_POST){?>
                    <div class="answerText"><?php echo $form["Answer_Text"]?$form["Answer_Text"]:$wmPage["Answer_Text"];?></div>
                                <?php echo $form['Conversion']?>
                <?php }else{?>
                    <form method="post">
                    <?php echo $htmlFields;?>
                        <div style="margin-bottom: 10px;" data-callback="recaptchaCallback" class="g-recaptcha" data-sitekey="<?php echo recaptcha_clientkey(); ?>"></div>
                    <input type="hidden" name="csrf" value="<?php echo $csrf_display?>" />
                    <input type="submit" name="submit" onclick="alert('Captcha failed')" class="dynamicSubmit" value="<?php echo $trans->getText("Send");?>" />
                    </form>
                <?php }?>
            <?php }?>
            <!--	END DINAMIC FORM	-->
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="fieldsNote"><?php echo "*&nbsp;".$trans->getText("Fields with an asterisk are required");?></div>
            </div>
        </div>
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
</div>
