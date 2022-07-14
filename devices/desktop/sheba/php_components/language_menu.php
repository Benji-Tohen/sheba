<div class="isons-heder">
    <?php if(count($arrLanguages)>1){ ?>
        <!-- Icon globe -->
        <a 
            title="<?php echo $trans->getText("Choose language");?>"
            class="icon-globe" 
            data-toggle="collapse" 
            href="#collapseExample" 
            role="button" 
            aria-expanded="false" 
            aria-controls="collapseExample"
            >
            <i class="fas fa-globe" aria-hidden="true"></i>
        </a>
    
        <div class="collapse drop-lang " id="collapseExample">
            <?php foreach($arrLanguages as $lang){ 
                $domainLink = $db->getRow(
                                "SELECT domain 
                                    FROM wm_pages 
                                    WHERE Parent = ".MAINPAGEID." AND Page_Type = 5 AND Lang ='".$lang['Lang']."'"
                                );?>
    
                <a  
                    href="https://<?php echo $domainLink['domain']?>" 
                    title="<?php echo $lang["Name"];?>" 
                    class="wrap-lang-name"
                >
                    <div class="lang-name <?php echo $lang["Lang"]===$wmPage["Lang"] ? "lang-name-active":""?> ts">
                        <?php echo mb_substr($lang["Name"],0,2 ,'UTF-8');?>
                    </div>
                </a>
            <?php }?>
        </div>
        <?php }?>
    </div>
    


<?php if($wmPage['domain'] != 'www.sheba.co.il'){?>
    <div class="isons-heder">
        <a 
            class="icon-home ts"
            href="<?php echo $trans->getText("Link-to-main-lang-site");?>" 
            title="<?php echo $trans->getText("Link to main site");?>" 
        >
            <i class="fas fa-home" aria-hidden="true"></i>
        </a>
    </div>
<?php }?>
<?php if($params->getValue('accessibility')){?>
<div class="isons-heder">
    <div class="access-icon" onclick="$('#BNagishMenu_new').toggle();" title="<?php echo $trans->getText("accessibility menu");?>">
        <?php echo file_get_contents("./webfiles/accessibilty/access.svg"); ?>
    </div>
</div>
<?php }?>




