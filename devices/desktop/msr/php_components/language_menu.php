<?php
if(count($arrLanguages)>1){?>
    <?php foreach($arrLanguages as $lang){/*if($lang['Alias']=='55359'){continue;}*/
            $domainLink = $db->getRow("SELECT domain FROM wm_pages WHERE Parent = ".MAINPAGEID." AND Page_Type = 5 AND Lang ='".$lang['Lang']."'");
             ?>
                <a  href="https://<?php echo $domainLink['domain']?>" title="<?php echo $lang["Name"];?>" class="langLink">
                    <div <?php echo $lang["Lang"]===$wmPage["Lang"] ? "style='background-color: #344A61;color: #FFF;'":""?> class="langName ts">
                        <?php echo $lang["Name"];?>
                    </div>
                </a>
    <?php }?>
<?php }?>
