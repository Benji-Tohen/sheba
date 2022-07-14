<a name="top">&nbsp;</a>
<div class="container institutionsPage">
    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php if($wmPage["Enable_SideContent"]){?>col-md-8 col-lg-8<?php } else { ?>col-md-12 col-lg-12<?php }?>">
             
            <h1><?php echo $wmPage["Name"];?></h1>
            <?php if ($wmPage["Sub_Title"]) { ?><h2><?php echo $wmPage["Sub_Title"];?></h2><?php } ?>
            <div class="richtext"><?php echo $wmPage["Content"];?></div>
            
            <div class="searchRow">
                <input class="searchBox" id="searchChildren" type="text" placeholder="<?php echo $trans->getText("Find institutions, units and clinics")?>" onkeyup="updateChildrenList()" />
                <button onclick="updateChildrenList()" class="searchBoxButton" title="<?php echo $trans->getText("Search")?>"><?php echo $trans->getText("Search")?></button>
            </div>
            
            <div class="mapEmbed">
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>
            
            <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

            <script type="text/javascript">
                var locations = [<?php 
                foreach ($locationsArr as $location) {
                  if($location['Author']){
                  $cordination=explode(",",$location['Author']);
                  $lat=$cordination[0];
                  $langi=$cordination[1];
                  ?>["<?php echo $location['Name'];?>",<?php echo $lat ;?>,<?php echo $langi ;?>,<?php echo $location['ID'];?>]<?php if ($locationsCounter < (count($locationsArr)-1)){echo ",";} ?><?php $locationsCounter++;}}?>];
                   //alert(locations);
                     var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: new google.maps.LatLng(32.04756, 34.845205),
                mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var infowindow = new google.maps.InfoWindow();
                var marker, i;
                for (i = 0; i < locations.length; i++) {  
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
                });
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent('<a href="/'+locations[i][3]+'">'+locations[i][0]+'</a>');
                  infowindow.open(map, marker);
                  map.setZoom(18);
                  map.panTo(marker.position);
                }
                })(marker, i));
                }
            </script>
  
  
            <div id="childrenWrap">
                <?php for($i=0;$i<count($arr);$i++){?>
                    <?php 
                    if($arr[$i]['Author']){ ?>
                    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
                    <?php }?>
                <?php }?>
            </div>
        </div>
        
        
        <!-- SIDE CONTENT -->
        <?php if($wmPage["Enable_SideContent"]){?>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 pageSideContent">
                <?php include(dirname(__FILE__)."/../php_components/side_widgets.php");?>
            </div>
        <?php }?>
        <!-- END SIDE CONTENT -->
    </div>
</div>
