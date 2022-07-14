<div class="container marg1_b">
	<div class="row">
		<div class="col-12">
			<div class="headLineH1"><h1> <?php echo $wmPage["Name"]; ?> </h1></div>
			<div class="breadCrumbsStyle">
			<!-- BREADCRUMBS -->
			<?php
			   include(dirname(__FILE__).'/../php_components/breadCrumbs.php');
			?>
			<!-- END BREADCRUMBS -->
			</div>
			<div class="greyLine"></div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="headLineH2">
				<h2><?php echo $wmPage["Sub_Title"]; ?></h2>
			</div>
		</div>
	</div>

	<div class="row">
	    <div class="col-12 col-md-12 col-lg-12">
	    	<?php /*
	        <div class="newsPageAll">
	            <?php
	            if(isset($arr) && $arr){
	                for($i=0;$i<count($arr);$i++){?>
	                    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
	                <?php }
	            }else{?>
	                    <div class="newsItemText"></div>
	            <?php }?>
            */?>
	        </div>
	        <div>
	          <script>
	            (function() {
	              var cx = '006838370188681540999:7wxto4uprwq';
	              var gcse = document.createElement('script');
	              gcse.type = 'text/javascript';
	              gcse.async = true;
	              gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
	              var s = document.getElementsByTagName('script')[0];
	              s.parentNode.insertBefore(gcse, s);

	              setTimeout(function(){  
	                  $('.gsc-results-wrapper-visible').append("<style>.breadCrumbs{ margin-bottom: 13px; } .gsc-above-wrapper-area{ border: none; } .search_page .gsc-wrapper .gsc-webResult .gsc-result{ padding: 14px 0 8px 0; } .gsc-control-wrapper-cse, .gs-bidi-start-align gs-snippet, .gs-bidi-start-align{ direction: rtl; text-align: right; } .pageTitle{ display: none; } .gsc-control-cse div{ padding: 0px; } .search_page .gsc-control-cse{ padding: 0px; } .gsc-option-menu-ite{ text-align: center; } .gsc-webResult.gsc-result, .gsc-results .gsc-imageResult{ border-bottom: 1px solid #EAEAEA; } .gsc-webResult.gsc-result:hover, .gsc-imageResult:hover{ border-bottom: 1px solid #EAEAEA; } .gs-result .gs-title, .gs-result .gs-title *{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gsc-control-cse .gs-spelling, .gsc-control-cse .gs-result .gs-title, .gsc-control-cse .gs-result .gs-title *{ color: #1ABC9C; font-size: 22px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:visited, .gs-webResult.gs-result a.gs-title:visited b, .gs-imageResult a.gs-title:visited, .gs-imageResult a.gs-title:visited b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult.gs-result a.gs-title:link, .gs-webResult.gs-result a.gs-title:link b, .gs-imageResult a.gs-title:link, .gs-imageResult a.gs-title:link b{ color: #1ABC9C; font-size: 20px; text-decoration: none; font-family: 'Open Sans', 'Open Sans Hebrew'; } .gs-webResult div.gs-visibleUrl, .gs-imageResult div.gs-visibleUrl{ color: #7B7B7B; font-size: 14px; } .gs-webResult .gs-snippet, .gs-imageResult .gs-snippet, .gs-fileFormatType{ color: #444444; font-size: 14px; }</style>");
	              }, 1000);
	            })();
	          </script>
	          <gcse:searchresults-only></gcse:searchresults-only>
	        </div>
	    </div>
	</div>
	
	<div class="clear"></div>
</div> 