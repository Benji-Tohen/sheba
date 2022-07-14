<div class="breadCrumbs">
    <?php 
    if($wmPage["Parent"]!=1){
    	//echo $wm->getNavigator($id, "");
        $navArray=explode("&gt;", $wm->getNavigator($id, ""));
        $firstItem=true;
        
        for($i=0;$i<count($navArray);$i++){
            if($i==0){
                continue;
            }
            if($i>1){
                echo " &gt; ";
            }
            echo $navArray[$i];
           
        }
    }
    ?>
</div> 