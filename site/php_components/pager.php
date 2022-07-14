<?php
if($sp && $sp->getNumPages()>1){
	echo "<div class=\"pagerLinks\">";
	if($page<$sp->getNumPages()){
	?>
	<a href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo $selectedCategory;?>/<?php echo $page+1;?>/<?php echo $getParams[3];?>"><div class="pagerNext"></div></a>
	
	<?php }?>
	<div class="pagerNumbers">
	<?php
	for($j=0,$i=1;$i<=$sp->getNumPages();$i++){
		if($i<$page-2){continue;}
		if($i>$page+2){break;}
		if($j>0){
			echo ".";
		}
		?><?php if($page==$i){?><?php echo $i;?><?php }else{?><a href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo $selectedCategory;?>/<?php echo $i;?>/<?php echo $getParams[3];?>"><?php echo $i;?></a><?php }$j++;?><?
	}?>
	</div>

	<?php if($page>1){?>
	<a href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$wmPage["ID"];?>/<?php echo $selectedCategory;?>/<?php echo $page-1;?>/<?php echo $getParams[3];?>"><div class="pagerPrev"></div></a>
	<?php
	}
	echo "<div class=\"clear\"></div></div>";
}
?>
