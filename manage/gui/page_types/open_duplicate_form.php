<?php
    $url=$_POST["url"];
?>
<div class="duplicateTypleform">
    <form method="post" action="<?php echo $url;?>">
        <span class="duplicateFormText">Please Insert a New File Name</span><br/>
        <input type="text" name="newFileName" class="duplicateFormInput" id="duplicateFormInput"/><span class="fileExtension">.php</span><br/>
        <div id="takenError"></div>
        <input type="submit" value="OK" class="submitButt"/><br/>
    </form>
</div>