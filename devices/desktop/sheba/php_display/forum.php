<?php
/*pseudo login doctror*/
//$_SESSION['doctor_id']='';
//$_SESSION['doctor_name']="dr soso";


//echo $_SESSION["doctor_name"]." --- ".$_SESSION["doctor_id"];
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
	default:
		return "6Lc_3AsTAAAAAM03d_sTtsqUYAMogqvsFWwjVH6t";
		break;
            
    }
}
?>
<div class="container forumPage">
    <div class="row">
        <input id="Forum_Id" name="Forum_Id" type="hidden" value="<?php echo $forumId?>"/>

        <?php if(!isset($_SESSION['isHuman']) && $_SESSION['isHuman'] !=1){/*show captcha only if not validated human before*/?>
            <div style="display: none;margin-bottom: 10px;" class="g-recaptcha" data-sitekey="<?php echo recaptcha_clientkey();?>"></div>
        <?php }?>
        <div class="col-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <h1><?php echo $wmPage["h1"];?></h1>
                </div>

                <div class="col-12 col-md-8 col-lg-8">
                    <?php /*search message form*/?>
                    <div id='searchMessageForm0' class="searchMessageForm">
                        <form name="searchMessage" id="searchMessage">
                            <input name="Forum_Id" type="hidden" value="<?php echo $forumId?>"/>
                            <input name="searchText" placeholder="<?php echo $trans->getText("searchText")?>"  class="form-control forumSearchBox" type="text"/>
                            <i class="forumSearchButton fa fa-search" id="submitSearchMessage"></i>
                        </form>
                        <div class="askBtn" onclick="$('#addMessageForm0').show();$('.g-recaptcha').appendTo($('#captchaHolder0'));$('.g-recaptcha').show()"><?php echo $trans->getText("Ask")?></div>
                    </div>
                </div>
            </div>

            <div class="lineSep"></div>

            <h5><?php echo $wmPage["Sub_Title"];?></h5>

            <?php /*add new message form*/?>
            <div id='addMessageForm0' class="addMessageForm" style="display: none;">
                <div class="addMessageFormHead"><?php echo $trans->getText("Ask Your Question")?></div>
                <form name="newMessage" id="messageForm0" class="row addMessageFormBody">
                    <input name="pageid" type="hidden" value="<?php echo $wmPage["ID"];?>" class="form-control" />
                    <input name="pagename" type="hidden" value="<?php echo $wmPage["Name"];?>" class="form-control" />
                    <input name="Parent" type="hidden" value="0" class="form-control" />
                    <input name="Forum_Id" type="hidden" value="<?php echo $forumId?>" class="form-control" />
                    <div class="col-12 col-md-6 col-lg-6">
                        <?php if(isset($_SESSION["doctor_id"])){?>
                            <input name="Full_Name" value="<?php echo $_SESSION["doctor_name"]?>"  type="text" class="form-control" />
            		    <?php } else {?>
                            <input name="Full_Name" placeholder="<?php echo $trans->getText("Full Name")?>"  type="text" class="form-control" />
                        <?php } ?>
			
                        <input name="Subject" placeholder="<?php echo $trans->getText("Subject")?>" type="text" class="form-control" />
                        <input name="Email" placeholder="<?php echo $trans->getText("E-Mail")?>" type="text" class="form-control email0" dir="ltr" />
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <textarea name="Value" placeholder="<?php echo $trans->getText("Description")?>" class="form-control"></textarea>
                        <div id='captchaHolder0'></div>
                        <input type="button" id="0" class="submitMessage" value="<?php echo $trans->getText("Send")?>"/>
                        <input onclick="$('#addMessageForm0').hide();" type="button" class="cancelMessage" value="<?php echo $trans->getText("Cancel")?>"/>
                    </div>
                </form>
            </div>
            <div id="allMessagesWrap">
            <?php
            /*display forum messages*/
            foreach ($messages as $key => $message) {
                include(dirname(__FILE__)."/../php_html/forum.php");
             }?>
            </div>
            <a href="javascript:void(0)" limit='<?php echo $limitMessages?>' id="moreMessages" class="loadMore"><?php echo $trans->getText("Load more messages")?></a>
        </div>

        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="col-12 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
</div>
