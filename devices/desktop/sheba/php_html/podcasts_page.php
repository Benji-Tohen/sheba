<?php
    $link=$arr[$i]['Link'];
    $url = substr($link, 8);
    if (strpos($url, 'soundcloud') === 0) { ?>
	<div class="col-12 col-sm-12 col-md-6 col-lg-6 item twoItemsRow">
        <iframe width="100%" height="210" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//<?php echo $url;?>&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=false&visual=true"></iframe>
    </div>
<?php } ?>