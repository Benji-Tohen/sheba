<?php
require_once(dirname(__FILE__).'/../../../classes/password/passwords.class.php');

$ec = new encrypt();

if($_POST){
        
        $check_inputs = array(
            array("string255"   => $_POST["First_Name"]),
            array("string255"   => $_POST["Last_Name"]),
            array("string255"   => $_POST["Username"]),
            array("number"      => $_POST["Level"]),
            array("string255"   => $_POST["Password"]),
            array("email"       => $_POST["mail"])
        );

        $secureTexts = new secure_inputs();
        $cerror = $secureTexts->isNotSecure($check_inputs);
        if (!$cerror) {

            $arrFields=array(
                    "First_Name"	=>	$_POST["First_Name"],
                    "Last_Name"		=>	$_POST["Last_Name"],
                    "Level"		=>	$_POST["Level"],
                    "Username"		=>	$_POST["Username"]		
            );

            if ($_POST["Password"]) {
                $passwords = new passwords($db);
                $error = $passwords->new_password_check($_POST["Password"], $_POST["ID"]);
            }
            
            if (!$error) {
                if($_POST["Password"]){
                        //$arrFields["Password"]="MD5('".$_POST["Password"]."')";
                        $arrFields["Password"] = $ec->sha256($_POST["Password"]);
                }
                if($_POST["mail"]){
                        $arrFields["mail"] = $ec->encrypt($_POST["mail"]);
                }

                if(!$_POST["ID"]){	//	Add new user
                        $exists=!$login->addUser($arrFields);
                }else{				//	Update existing user
                        $exists=!$login->editUser($_POST["ID"], $arrFields);
                }
                
                if ($_POST['changed_permissions']) {
                    if (!$_POST["ID"]) die("invalid user id");
                    $user_id = intval($_POST["ID"]);
                    $db->runQuery("DELETE FROM wm_pages_permissions WHERE wm_user_id=$user_id");
                    foreach ($_POST['connectedPages'] as $num=>$page_id) {
                        $db->runQuery("INSERT INTO wm_pages_permissions(wm_user_id,wm_page_id) VALUES ($user_id,$page_id)");
                    }
                }

                if(!$exists){
                        header("location: index.php?show=users/users");
                        exit;
                }
                
            }
        }
}

if($_REQUEST["user_id"]){
	$user_data=$login->getValues($_REQUEST["user_id"]);
        if ($user_data["mail"]) {
            $user_data["mail"] = trim($ec->decrypt($user_data["mail"]));
        }
}

if(!$user_data && $_POST){
	if (!$cerror) $user_data=$_POST;
}

?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<?php//<div id="outerUsersDiv" style="width:100%;height:100%;overflow-y:auto">?>
<div class="navigator_line"><a href="index.php?show=users/users"><?php echo $text["Users"];?></a> -&gt; <?php echo $text["Edit"];?>: <?php echo $user_data["First_Name"];?> <?php echo $user_data["Last_Name"];?></div>
<div class="editPagePadding" style="overflow-y: auto; height: 650px;">
<div class="SecurityMessage"><?php echo $cerror;?></div>
<?php if($exists){?>
This username already exists,<br />
Please choos another one
<?php }?>
<script type="text/javascript">
function searchConnectedPages(){
    parameters=encodeURI("search="+document.getElementById('txtSearchConnected').value);
    questAjax("users/searchPages.php", parameters, "connectedPagesSearch", "GET");
}
function saveChecked(id) {
    document.getElementById('changed_permissions').value = 1;
}
//document.body.style.overflowY="auto";   // fix for scroll
//document.body.style.height="100%";      // fix for scroll
//document.getElementById('outerUsersDiv').style.height = top.document.getElementById('main1').offsetHeight-10+"px";
</script>
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="users/edit_user" />
<input type="hidden" name="ID" value="<?php echo $user_data["ID"];?>" />
<input type="hidden" id="changed_permissions" name="changed_permissions" value="0" />
<table>
	<tr>
		<td><?php echo $text["First Name"];?></td>
		<td><input type="text" name="First_Name" value="<?php echo $user_data["First_Name"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Last Name"];?></td>
		<td><input type="text" name="Last_Name" value="<?php echo $user_data["Last_Name"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["User Level"];?></td>
		<td>
			<select name="Level">
				<option value="1" <?php echo ($user_data["Level"]==1)?"SELECTED":"";?>><?php echo $text["Administrator"];?></option>
				<option value="2" <?php echo ($user_data["Level"]==2)?"SELECTED":"";?>><?php echo $text["Manager"];?></option>		
				<option value="3" <?php echo ($user_data["Level"]==3)?"SELECTED":"";?>><?php echo $text["Client"];?></option>							
			</select>
		</td>		
	</tr>
	<tr>
		<td><?php echo $text["Username"];?></td>
		<td><input type="text" name="Username" value="<?php echo $user_data["Username"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Password"];?></td>
		<td><input type="password" name="Password" value="" /></td>		
                <?php if ($error) echo '<td><font color="red">'.$error.'</font></td>'; ?>
	</tr>
        <tr>
                <td><?php echo $text["Email"];?></td>
                <td><input type="text" name="mail" value="<?php echo $user_data["mail"];?>" /></td>
        </tr>
        <tr>
                <td>חפש דפים להרשאות:</td>
                <td>
                    <input type="text" id="txtSearchConnected" name="txtSearchConnected" autocomplete="off" style="width: 200px;" onkeyup="searchConnectedPages();document.getElementById('search_suggest_connected').style.display='none';" />
                    <input type="button" name="search" value="<?php echo $text["Search"];?>" onclick="searchConnectedPages();document.getElementById('search_suggest_connected').style.display='none';" />
                </td>
        </tr>
        <tr>
                <td colspan="2">
                <div id="search_suggest_connected" style="padding: 0px; margin: 0px; margin-right: 23px;"></div>
                <div id="connected"></div>
                <div style="z-index:200;width:97%;" id="connectedPagesSearch"></div>
                </td>
        </tr>
        <tr>
                <td colspan="2">
                <div style="z-index: 2;width: 97%;">
                <?php
                echo "<u style='line-height: 30px;'>דפים שלמשתמש זה יש הרשאות אליהם</u><br />";
                $user_id = intval($user_data["ID"]);
                $query2 =   "SELECT a.Name, a.Page_Type, b.wm_page_id FROM wm_pages a ".
                            "INNER JOIN wm_pages_permissions b ".
                            "ON a.ID=b.wm_page_id ".
                            "WHERE b.wm_user_id=$user_id";
                $arrAllowedPages = $db->getArray($query2);
                if (count($arrAllowedPages)) {
                    foreach ($arrAllowedPages as $num => $arr)                  {/*display allowed pages*/
                        $orgDivId = $key;
                        $value = $arr['Page_Type'];
                        $name = $arr['Name'];
                        $id = $arr['wm_page_id'];
                        $pageType = $db->getRow("SELECT Name, ID FROM wm_pagetype WHERE ID=".$value);
                        echo '<div>';
                        echo '<div style="float:right;direction:rtl;width:100px">&nbsp;'.$pageType['Name'].':</div>';
                        echo '<div style="float:right;width:30px">';
                        ?><input type="checkbox" checked="checked" onclick="saveChecked(0)" name="connectedPages[]" value="<?php echo $id?>"/><?php
                        echo '</div>';
                        echo '<div style="float:right;direction:rtl">'.$name.'</div>';
                        echo '<div style="clear:both"></div>';
                        echo '</div>';
                    }
                }
                ?>
                </div>
                </td>
        </tr>
	<tr>
		<td></td>
		<td><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
</table>
</form>

</div>
<?php//</div>?>
