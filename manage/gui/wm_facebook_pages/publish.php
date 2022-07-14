<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');
require_once('fb_publish.php');

$id=$_REQUEST["id"];
$page = $wm->getValues($id);                                                    // get the page to publish details
$facebook_pages = $db->getArray("SELECT * FROM wm_facebook_pages");             // get list of all facebook pages we administer

if ($_POST) {
    
    $check_inputs = array(
        array("text"        => $_POST["Message"])
    );

    $secureTexts = new secure_inputs();
    $error = $secureTexts->isNotSecure($check_inputs);
    if (!$error) {    
        if ($_POST['fb_page_ids']) {
            $link=$wm->getLink($page);        
            $fb_pages = array();
            foreach ($facebook_pages as $n=>$arr) $fb_pages[$arr['ID']] = $arr;
            $fbAction=new FacebookActions();
            foreach ($_POST['fb_page_ids'] as $n=>$fb_page_id) {
                $fb_page = $fb_pages[intval($fb_page_id)];
                $fb_page_id = $fb_page['fb_page_id'];
                $fb_page_token = $fb_page['fb_page_access_token'];
                $message = $_POST['message'];
                //echo $fbAction->doWallPost($fb_page_id, $fb_page_token, $page['Name'], $message, $link["Link"], $trans->getText("Facebook Caption"), $page['Sub_Title']);
                $fbAction->doWallPost($fb_page_id, $fb_page_token, $page['Name'], $message, $link["Link"], $trans->getText("Facebook Caption"), $page['Sub_Title']);
            }
            $error = "הדף פורסם בהצלחה בעמודי הפייסבוק שנבחרו";
        }
        // https://graph.facebook.com/oauth/access_token?client_id=888672384525453&client_secret=50659406475a01ed9442fba17b67e8a4&grant_type=fb_exchange_token&fb_exchange_token=CAAMoPinNJI0BAHkZCmBsW6Q3deUlpngZAdBlSb5gIRElzOBz9LFUgkaX7UVGXjrQtfT6CH6iYeVFSBtIppTS0ZBFlTx3f2ZBHUBsLuiWCxtOWRr9JR8x7WQhG44qL5d4Lyg7msQLnsKjZBHt4WlK9zXEd0A8bZCLM7lw1ZBn9g5wYlPZBCCVbPpvjlDZCCxHE5i1ZAIV03wfitBwZDZD
    }
}

?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line">פרסם דף בפייסבוק</div>

<div class="editPagePadding">
<div class="SecurityMessage"><?php echo $error;?></div>
<br />
<u>אתה עומד לפרסם את הדף הבא:</u><br/>
<?php echo $page['Name'];?> (<?php echo $page['Sub_Title'];?>)<br/>
<br /><br/>
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="<?php echo $folderName;?>/publish" />
<input type="hidden" name="id" value="<?php echo $id;?>" />
<b><u>בחר את הדפים שברצונך לפרסם את הדף:<b></u><br/>
<?php
foreach ($facebook_pages as $num=>$array) {?>
<input type="checkbox" name="fb_page_ids[]" value="<?php echo $array['ID'];?>" /> <?php echo $array['fb_page_title'];?> (<?php echo $array['fb_page_id'];?>)<br/>
<?php } ?>
<br/><br/>
הוסף הודעה: <input type="text" name="message" /><br/>
<br/><br/><br/>
<input type="submit" value="פרסם את הדף בעמודי הפייסבוק שנבחרו" onclick="return confirm('האם לבצע פעולה זו?')" />
</form>
<?php /*
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_item["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<input type="hidden" name="search" value="<?php echo $_REQUEST["search"];?>" />
<table>		
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="fb_page_title" value="<?php echo $row_item["fb_page_title"];?>" /></td>		
	</tr>
	<tr>
		<td>FB_ACCESS_TOKEN:</td>
		<td><input type="text" name="fb_page_access_token" value="<?php echo $row_item["fb_page_access_token"];?>" /></td>		
	</tr>
	<tr>
		<td>FB_PAGE_ID:</td>
		<td><input type="text" name="fb_page_id" value="<?php echo $row_item["fb_page_id"];?>" /></td>		
	</tr>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
</table>
</form> */ ?>
</div>

