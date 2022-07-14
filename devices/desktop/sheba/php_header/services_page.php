<?php
/* rel=”next and rel=”prev” indicates to Google that content is linked together through a paginated series */

if($sp && $sp->getNumPages()>1){

    if((intval($page)-1)>0){?>
    <link rel="prev" href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo (intval($page)-1);?>" />
    <?php }
    if(intval($page)!==intval($sp->getNumPages())){?>
    <link rel="next" href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo (intval($page)+1);?>" />
    <?php }

}

/* end */
?>