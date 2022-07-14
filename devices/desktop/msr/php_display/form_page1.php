<div class="container formPage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
            <h1><?php echo $wmPage["Name"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            
            <!--	DINAMIC FORM	-->
            <?php if(true){?>
                <?php if($_POST){?>
                    <div class="answerText"><?php echo $form["Answer_Text"];?></div>
                                <?php echo $form['Conversion']?>
                <?php }else{?>
                    <form action="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" method="post">
                    <?php echo $htmlFields;?>
                                <div style="margin-bottom: 10px;" class="g-recaptcha" data-sitekey="6Lc5hgYTAAAAAMCZS1nel557gkcXJ3e_koSZHQ3x"></div>    
                    <input type="submit" name="submit" class="dynamicSubmit" value="<?php echo $trans->getText("Send");?>" />
                    </form>
                <?php }?>
            <?php }?>
            <!--	END DINAMIC FORM	-->
        </div>
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
    </div>
</div>
