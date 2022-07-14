
<a class="accessibilityLink" tabindex="0" accesskey="m" onclick="$('html, body').animate({ scrollTop: $('.<?php echo str_replace('.php','',$wmPage['Type']['Page'])?>').offset().top }, 1000).focus();" href="javascript:void(0)">דלג לתוכן העמוד (מקש קיצור m)</a>
<a class="accessibilityLink" tabindex="0" accesskey="2" href="<?php echo $cfg["WM"]["Server"];?>/צור_קשר">דלג לצור קשר (מקש קיצור 2)</a>
<a class="accessibilityLink" tabindex="0" accesskey="3" href="">דלג למפת האתר (מקש קיצור 3)</a>

<style>
.accessibilityLink {
    position: absolute;
    top: -1000px;
    right: 666px;
    padding: 10px;
    font: inherit;
    font-size:  16px;
    color: #000;
    border: 1px solid #e5e5e5;
    background-color: #fff;
}
</style>
