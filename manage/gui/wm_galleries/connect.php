<?php 
require_once('../../classes/pager/class.pager.php');
require_once('data.php');

$gui=new Gui("he");
$id=			intval($_REQUEST["id"]);
$page=			intval($_REQUEST["page"]);

if($_POST && isset($_POST['update_connected'])){/*update in db after submit*/   
    // Clear all gallery connections
    $db->runQuery("DELETE FROM wm_gallery_page WHERE wm_gallery_id = ".$_POST['wm_gallery_id']);

    // Prepare array of pages to connect
    $newItems = array_unique($_POST['connectedPages'], SORT_REGULAR);
    if(isset($_POST['alreadyConnectedPages']) && !empty($_POST['alreadyConnectedPages']) && !empty($newItems)){
        $itemsToConnect = array_merge($_POST['alreadyConnectedPages'], $newItems);
    } else if(isset($_POST['alreadyConnectedPages']) && !empty($_POST['alreadyConnectedPages']) && empty($newItems)){
        $itemsToConnect = $_POST['alreadyConnectedPages'];
    } else {
        $itemsToConnect = $newItems;
    }

    $itemsToConnect = array_unique($itemsToConnect, SORT_REGULAR);

    // Connect pages to gallery
    foreach ($itemsToConnect as $key => $page_id) {
        if($page_id){
            $arr = array(
                'wm_page_id'=>$page_id,
                'wm_gallery_id'=>$_POST['wm_gallery_id']
            );
            $db->updateData("wm_gallery_page",$arr);
        }
    }
}

$arrWmPages = $db->getArray("SELECT wm_gallery_page.wm_gallery_id, wm_gallery_page.wm_page_id, wm_pages.Name 
                                FROM wm_gallery_page 
                                INNER JOIN wm_pages ON wm_pages.ID = wm_gallery_page.wm_page_id 
                                WHERE wm_gallery_id=".$id);
?>
<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
<script language="JavaScript" type="text/javascript" src="JS/ajax.js"></script>
<script>
    var debounceTimer;
    function searchPages(){
        parameters=encodeURI("search="+document.getElementById('txtSearchConnected').value+"&thisId=<?php echo $id;?>");
        questAjax("wm_galleries/searchPages.php", parameters, "connectedPagesSearch", "GET");
    }
    function saveChecked(pageId){
        if($('#check'+pageId).prop('checked') == true){
            jQuery("#connected").append('<input class="tempCheckbox'+pageId+'" type="checkbox" style="display: none;" name="connectedPages[]" checked="checked" value="'+pageId+'">');
        }else{
            jQuery(".tempCheckbox"+pageId).remove();
        }
    }
    // Debounce
    function handleSearchKeyUp(){
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            searchPages()
        }, 1500);
    }
</script>
<?php 
    require_once('common/header.php');
    require_once('common/body.php');
?>
<a style="float: left;" href="javascript:history.back()"><img border="0" src="images/icons/back.gif" alt="Back" /></a>
<div class="tabbertab">
    <form method="post" class="connected-pages-form">
	<h3><?php echo $text["connected page types"];?></h3>
		<input type="text" id="txtSearchConnected" name="txtSearchConnected" autocomplete="off" style="width: 200px;" onkeyup="handleSearchKeyUp();document.getElementById('search_suggest_connected').style.display='none';" />
		<input type="button" name="search" value="<?php echo $text["Search"];?>" onclick="searchPages();document.getElementById('search_suggest_connected').style.display='none';" />
		<br />
		<div id="search_suggest_connected" style="padding: 0px; margin: 0px; margin-right: 23px;"></div>
        <input type="hidden" name="wm_gallery_id" value="<?php echo $id;?>" />
        <input type="hidden" name="update_connected" value="1" />
		<input type="hidden" name="Parent" value="<?php echo $row["Parent"];?>" />
        <div id="connected">
            
        </div>
        <div style="position: absolute;z-index: 200;background: #fff;width: 97%;" id="connectedPagesSearch"></div>
              <?php   
               echo "<u style='line-height: 30px;'>דפים שכבר מקושרים</u><br />";
                
                    foreach ($arrWmPages as $key => $page) {/*display connected pages*/
                        $isChecked = $db->getRow("SELECT ID FROM wm_gallery_page WHERE wm_gallery_id=".$id." AND wm_page_id=".$page['wm_page_id']);
                        if(count($isChecked) > 0){
                            if($isShown==0){
                                echo "<style>#connected$orgDivId{display: block !important;}</style>";
                                $isShown = 1;
                            }
                            
                            ?><input type="checkbox" checked="checked" name="alreadyConnectedPages[]" <?php echo $isChecked?> value="<?php echo $page['wm_page_id']?>"/><?php echo $page['Name'];?><br />
                        <?php }
                }?>
        <input class="adminButton" type="submit" name="submit" value="<?php echo $text["Update"];?>" style="position: absolute;top: 550px;    right: 20px;" />
    </form>
</div>

<style>
    .connected-pages-form{
        padding: 10px;
    }
</style>