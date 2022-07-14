<div class="anchorOffset" id="<?php echo $sec["ID"];?>"></div>
<section class="sec_<?php echo $sec["ID"];?> pad1">
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- VIDEO EMBED -->
                <?php if($sec["Video_Embed"]){ ?>
                    <div class="video-container videoEmbed">
                        <iframe width="640" height="540" src="//www.youtube.com/embed/<?php echo $sec["Video_Embed"]?>?rel=0&amp;showinfo=0&amp;controls=1" style="border:0px" allowfullscreen></iframe>
                    </div>
                <?php }?>
                <!-- END VIDEO EMBED -->

                <!-- VIDEO EMBED DESCRITION -->
                <?php if($sec["Video_Text"]){?>
                    <h3 class="videoAndImageDescription">
                        <?php
                        if(intval(mb_strlen($sec["Video_Text"], 'UTF-8'))>85){
                        echo mb_substr($sec["Video_Text"],0,82, "utf-8")."...";
                        }else{
                        echo $sec["Video_Text"];
                        }?>
                    </h3>
                <?php }?>
                <!-- END VIDEO EMBED DESCRITION -->
            </div>
        </div>
    </div>
</section>