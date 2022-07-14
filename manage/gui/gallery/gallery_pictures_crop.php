<?php

require_once('../../../conf/conf.data.php');
require_once('../../../classes/file/class.file.php');
require_once('../../../classes/content_management/class.content_updater.php');
//require_once(dirname(__FILE__).'/../../../classes/thumb/phpthumb.class.php');

$id=$_GET["id"];
$update_table="wm_pages_gallery";
$content_update=new ContentUpdater($db, $update_table);
$proportion = 15/8;
$src = $_GET['src'];
if ($_GET['op']=="change") {
    
    $check_inputs = array(
        array("number"      => $id),
        array("string1000"  => $src),
        array("number"      => $_GET['x']),
        array("number"      => $_GET['y']),
        array("number"      => $_GET['w']),
        array("number"      => $_GET['h'])
    );
    $secureTexts = new secure_inputs();
    $error = $secureTexts->isNotSecure($check_inputs);
    if ($error) die($error);
    
    $dir = dirname(__FILE__)."/../../../";
    $file = $dir.$src;
    //$res = imagecreatefromjpeg($file);
    $res = imagecreatefromstring(file_get_contents($file));                     // automatically detect image
    $res2 = imagecreatetruecolor( $_GET['w'] , $_GET['h'] );
    imagecopy($res2, $res, 0, 0, $_GET['x'], $_GET['y'], $_GET['w'], $_GET['h']);
    $pos = strrpos($src,".");
    $new_filename = substr($src,0,$pos)."_crop_".substr(md5(microtime()),0,8).".jpg";
    //header('Content-Type: image/jpeg');
    imagejpeg($res2, $dir.$new_filename);
    $content_update->update($id, array("File_Name"=>$new_filename));
    echo '<script>top.main1.location=top.main1.location;top.close_layer();</script>';
    //echo '<script>window.opener.location=window.opener.location;window.close();</script>';
    //$res2 = imagecreate()
    //imagecopy ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )
    //exit;
}

if ($_GET['op']=="preview") {
    $check_inputs = array(
        array("number"      => $id),
        array("string255"   => $column),
        array("string1000"  => $img),
        array("string1000"  => $src),
        array("number"      => $_GET['x']),
        array("number"      => $_GET['y']),
        array("number"      => $_GET['w']),
        array("number"      => $_GET['h'])
    );
    $secureTexts = new secure_inputs();
    $error = $secureTexts->isNotSecure($check_inputs);
    if ($error) die($error);
    
    $dir = dirname(__FILE__)."/../../../";
    $file = $dir.$src;
    //$res = imagecreatefromjpeg($file);
    $res = imagecreatefromstring(file_get_contents($file));                     // automatically detect image
    $res2 = imagecreatetruecolor( $_GET['w'] , $_GET['h'] );
    imagecopy($res2, $res, 0, 0, $_GET['x'], $_GET['y'], $_GET['w'], $_GET['h']);
    header('Content-Type: image/jpeg');
    imagejpeg($res2);
    exit;
}
?>
<script src="/devices/desktop/sheba/bootstrap/js/jquery.min.js"></script>
<script src="/manage/gui/JS/jcrop/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="/manage/gui/JS/jcrop/jquery.Jcrop.css" type="text/css" />
<style>
body { background: #fff; }
</style>
<div style="position:absolute;top:0px;left:0px;overflow:hidden"><img src="/<?php echo $src;?>" id="prop" style="position:absolute;top:0px;left:0px;opacity:0" /></div>
<table cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="550">
      <div style="text-align:right;font-family:arial;font-size:20px;color:#5b687b;padding-bottom:10px">חיתוך תמונה</div>
      <div style="width:100%;border:1px solid #e2e7ed;border-radius:8px;background:#fdfdfd">
        <div style="float:right;padding:10px;border:1px solid #e2e6ef;border-radius:6px;background:#f8f8f8;margin-top:25px;margin-bottom:20px;margin-right:20px">
          <table cellspacing="0" cellpadding="0" style="direction:rtl">
            <tr>
              <td style="font-family:Arial;font-size:12px;color:#5c6880;padding-left:10px">התמונה שלך</td>
              <td style="font-family:Arial;font-size:12px;color:#5c6880;padding-left:10px">גובה</td>
              <td style="font-family:Arial;font-size:12px;color:#5c6880">רוחב</td>
            </tr>
            <tr><td height="8" colspan="3"></td></tr>
            <tr>
              <td style="font-family:Arial;font-size:12px;color:#5c6880;padding-left:20px;font-weight:bold">תמונה מקורית</td>
              <td id="orig_height" style="font-family:Arial;font-size:12px;color:#5c6880;padding-left:20px;font-weight:bold">592px</td>
              <td id="orig_width" style="font-family:Arial;font-size:12px;color:#5c6880;font-weight:bold">890px</td>
            </tr>
            <tr><td height="3" colspan="3"></td></tr>
            <tr>
              <td style="font-family:Arial;font-size:12px;color:#5c6880;padding-left:10px;font-weight:bold">תמונה חתוכה</td>
              <td id="crop_height" style="font-family:Arial;font-size:12px;color:#5c6880;padding-left:10px;font-weight:bold">0px</td>
              <td id="crop_width" style="font-family:Arial;font-size:12px;color:#5c6880;font-weight:bold">0px</td>
            </tr>
          </table>
        </div>
        <div style="clear:both"></div>
        <div style="margin:10px;margin-top:0px">
          <img src="/<?php echo $src;?>" id="target" width="100%" />
        </div>
        <button onclick="submit_change()" style="float:right;border:0px;border-radius:5px;margin:10px;padding:10px;background:#56b46a;color:#fff">שמור</button>
        <button onclick="preview_image()" style="float:right;border:0px;border-radius:5px;margin:10px;padding:10px;background:#67acc9;color:#fff">תצוגה מקדימה</button>
        <button onclick="top.close_layer()" style="float:right;border:0px;border-radius:5px;margin:10px;padding:10px;background:none;color:#7887a8">ביטול</button>
        <div style="clear:both;height:10px"></div>
      </div>
    </td>
  </tr>
</table>

<div id="preview" style="position:fixed;top:0px;left:0px;background:#000;width:100%;height:100%;visibility:hidden;opacity:0.8;z-index:9999">
    <table cellspacing="0" cellpadding="0" width="100%" height="100%">
        <tr>
            <td width="100%" height="100%" align="center" valign="middle" style="color:#fff;direction:rtl">מבצע..</td>
        </tr>
    </table>
</div>

<div id="preview_bar" style="visibility:hidden;position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:9999">
    <table cellspacing="0" cellpadding="0" width="100%" height="100%">
        <tr>
            <td width="100%" height="100%" align="center" valign="middle">
                <div id="preview_div" style="background:#fff;visibility:hidden;border:1px solid #000">
                    <div style="padding:10px"><img id="preview_img" /></div>
                    <center><button style="background:#888;color:#fff;border:1px solid #444" onclick="close_preview()">סגור</button></center>
                    <div style="height:5px"></div>
                </div>
            </td>
        </tr>
    </table>    
</div>

<?php // <button style="position:fixed;left:50%;top:20px" onclick='submit_change()'>SAVE CHANGE</button> // ?>
<script language="Javascript">
var global_coords, proportion;
<?php if ($proportion) { ?>
var fixed_proportion = <?php echo $proportion?>;
<?php } ?>
window.onload = function() {
    var img, img2, orig_width, orig_height, width, height; 
    //or however you get a handle to the IMG
    img = document.getElementById('prop');
    orig_width = img.clientWidth;
    orig_height = img.clientHeight;
    document.getElementById('orig_height').innerHTML = orig_height+"px";
    document.getElementById('orig_width').innerHTML = orig_width+"px";
    img2 = document.getElementById('target');
    width = parseInt(img2.style.width);
    height = parseInt(img2.style.height);
    proportion = width / orig_width;                                            // proportion of display -vs- original aspect
    console.log('original image is '+orig_width+'x'+orig_height+' big, shown image is '+width+'x'+height+' big, proportion = '+proportion);
}
function showCoords(c)
{
    // variables can be accessed here as
    // c.x, c.y, c.x2, c.y2, c.w, c.h
    console.log(c);
    global_coords = c;
    document.getElementById('crop_height').innerHTML = parseInt(c.h / proportion)+"px";
    document.getElementById('crop_width').innerHTML = parseInt(c.w / proportion)+"px";
};

jQuery(function($) {
    $('#target').Jcrop({
        <?php if ($proportion) { ?>
        aspectRatio: fixed_proportion,
        <?php } ?>
        onSelect: showCoords,
        onChange: showCoords
    });
});

function show_preview_image() {
    var img = document.getElementById('preview_img');
    document.getElementById('preview_div').style.visibility = "visible";
    document.getElementById('preview_div').style.width = (img.clientWidth+20)+"px";
}

function close_preview() {
    document.getElementById('preview_div').style.visibility = "hidden";
    document.getElementById('preview').style.visibility = "hidden";
    document.getElementById('preview_bar').style.visibility = "hidden";
}

function preview_image() {
    var g = global_coords;
    if (g===undefined) alert('לא ניתן להציג תצוגה מקדימה היות ולא נבחר איזור חיתוך לתמונה החדשה')
    else if (g.x) {
        gx = parseInt(g.x / proportion);
        gy = parseInt(g.y / proportion);
        gw = parseInt(g.w / proportion);
        gh = parseInt(g.h / proportion);        
        //window.open('content_pictures_crop.php?op=preview&id=<?php echo $id;?>&img=<?php echo $img;?>&column=<?php echo $column;?>&src=<?php echo $src;?>&x='+gx+'&y='+gy+'&w='+gw+'&h='+gh);
        //var img = document.createElement('img');
        var img = document.getElementById('preview_img');
        img.src = 'content_pictures_crop.php?op=preview&id=<?php echo $id;?>&img=<?php echo $img;?>&column=<?php echo $column;?>&src=<?php echo $src;?>&x='+gx+'&y='+gy+'&w='+gw+'&h='+gh;
        document.getElementById('preview').style.visibility = "visible";
        document.getElementById('preview_bar').style.visibility = "visible";
        img.onload = function(){show_preview_image()};                          // show the preview image once loaded
    }
}

function submit_change() {
    var g = global_coords;
    if (g===undefined) alert('לא ניתן לשמור היות ולא נבחר איזור חיתוך לתמונה החדשה')
    else if (confirm('האם אתה בטוח שברצונך לשמור שינויים אלה?')) {
        var gx, gy, gw, gh;
        gx = parseInt(g.x / proportion);
        gy = parseInt(g.y / proportion);
        gw = parseInt(g.w / proportion);
        gh = parseInt(g.h / proportion);        
        location.href = 'gallery_pictures_crop.php?op=change&id=<?php echo $id;?>&src=<?php echo $src;?>&x='+gx+'&y='+gy+'&w='+gw+'&h='+gh;
    }
}
</script>

<?php /*
<script src="/devices/desktop/sheba/bootstrap/js/jquery.min.js"></script>
<script src="/manage/gui/JS/jcrop/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="/manage/gui/JS/jcrop/jquery.Jcrop.css" type="text/css" />
<h1>CROP IMAGE:</h1>
<img src="/<?php echo $src?>" id="target" /><br/>
<button style="position:fixed;left:50%;top:20px" onclick='submit_change()'>SAVE CHANGE</button>
<script language="Javascript">
var global_coords;
function showCoords(c)
{
    // variables can be accessed here as
    // c.x, c.y, c.x2, c.y2, c.w, c.h
    console.log(c);
    global_coords = c;
};

jQuery(function($) {
    $('#target').Jcrop({
        onSelect: showCoords,
        onChange: showCoords
    });
});

function submit_change() {
    var g = global_coords;
    location.href = 'gallery_pictures_crop.php?op=change&id=<?php echo $id?>&src=<?php echo $src?>&x='+g.x+'&y='+g.y+'&w='+g.w+'&h='+g.h;
}
</script>
 */ ?>