<?php 
require_once('../../classes/pager/class.pager.php');
require_once('data.php');

$id=			intval($_REQUEST["id"]);
$page=			intval($_REQUEST["page"]);
$bannerType=		intval($_REQUEST["Banner_Type"]);
?>
<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
<script language="JavaScript" type="text/javascript" src="JS/ajax.js"></script>
<script>
function searchPages(){
	parameters=encodeURI("search="+document.getElementById('txtSearchConnected').value+"&thisId=<?php echo $id;?>");
	questAjax("banners/searchPages.php", parameters, "connectedPagesSearch", "GET");
}

function saveChecked(pageId){
    if($('#check'+pageId).prop('checked') == true){
        jQuery("#connected").append('<input id="tempCheckbox'+pageId+'" type="checkbox" style="display: none;" name="connectedPages[]" checked="checked" value="'+pageId+'">');
    }else{
        jQuery("#tempCheckbox"+pageId).attr('checked', false);
    }
}
</script>
<?php


$gui=new Gui("he");?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');

if($_POST){/*update in db after submit*/
    /*maybe not working perfect but i cant see why right now..*/
    /*first delete all pages connected to banner than update*/
    $connectedPagesBeforeDelete = $db->getArray("SELECT wm_pages FROM wm_connected_banners WHERE banner_id = ".$_POST['bannerId']);
    $db->runQuery("DELETE FROM wm_connected_banners WHERE banner_id = ".$_POST['bannerId']);
    $_POST['connectedPages'] = array_unique($_POST['connectedPages'], SORT_REGULAR);

    foreach ($_POST['connectedPages'] as $key => $page) {
        $arr = array(
                'wm_pages'=>$page,
                'banner_id'=>$_POST['bannerId']
            );
            $db->updateData("wm_connected_banners",$arr);
            /*make sure has connected in wm_pages is set to wm_pages ID*/
            $arr = array(
                'hasConnectedBanners'=>$page
            );
            $db->updateData("wm_pages",$arr,$page);
            
    }
    
    /*now update has connected in wm_pages*/
    
    foreach ($connectedPagesBeforeDelete as $key => $page) {
        $hasConnections = $db->getRow("SELECT ID FROM wm_connected_banners WHERE wm_pages = ".$page['wm_pages']);
        if(count($hasConnections) == 0){/*is not connected anymore*/
            $arr = array(
                'hasConnectedBanners'=>0
            );
            $db->updateData("wm_pages",$arr,$page['wm_pages']);
        }
    }
}

?>
<a style="float: left;" href="javascript:history.back()"><img border="0" src="images/icons/back.gif" alt="Back" /></a>
<div class="tabbertab">
    <form method="post">
	<h3><?php echo $text["connected page types"];?></h3>
                
		<input type="text" id="txtSearchConnected" name="txtSearchConnected" autocomplete="off" style="width: 200px;" onkeyup="searchPages();document.getElementById('search_suggest_connected').style.display='none';" />
		<input type="button" name="search" value="<?php echo $text["Search"];?>" onclick="searchPages();document.getElementById('search_suggest_connected').style.display='none';" />
		<br />
		<div id="search_suggest_connected" style="padding: 0px; margin: 0px; margin-right: 23px;"></div>
                <input type="hidden" name="bannerId" value="<?php echo $id;?>" />
		<input type="hidden" name="Parent" value="<?php echo $row["Parent"];?>" />
                <div id="connected">
                    
                </div>

        <div style="position: absolute;z-index: 200;background: #fff;width: 97%;" id="connectedPagesSearch"></div>

		
              <?php   
               echo "<u style='line-height: 30px;'>דפים שכבר מקושרים לבאנר</u><br />";
                $arrWmPages = $db->getArray("SELECT banner_id, wm_pages, Name FROM wm_connected_banners INNER JOIN wm_pages ON wm_pages.ID = wm_connected_banners.wm_pages WHERE banner_id=".$id);
		foreach ($arrWmPages as $key => $page) {/*display connected pages*/
                        $isChecked = $db->getRow("SELECT ID FROM wm_connected_banners WHERE banner_id=".$page['banner_id']." AND wm_pages=".$page['wm_pages']);
                        if(count($isChecked) > 0){
                            if($isShown==0){
                                echo "<style>#connected$orgDivId{display: block !important;}</style>";
                                $isShown = 1;
                            }
                            
                            ?><input type="checkbox" checked="checked" name="connectedPages[]" <?php echo $isChecked?> value="<?php echo $page['wm_pages']?>"/><?php echo $page['Name'];?><br />
                        <?php }
                        
                }?>
        <input class="adminButton" type="submit" name="submit" value="<?php echo $text["Update"];?>" style="position: absolute;top: 550px;    right: 20px;" />
    </form>
</div>
