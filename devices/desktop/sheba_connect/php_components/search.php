<?php
	$yashirSearchPageId = $wm->getIdByPageTypeNoHomepageID(148);
	$yashirSearchPageArr = $wm->getValues($yashirSearchPageId);
	$yashirSearchPageLink = $wm->getLink($yashirSearchPageArr);
?>
<div class="search-container">
	<button class="search-toggle-btn" title="<?php echo $trans->getText('Search');?>" onclick="toggleSearch();">
		<i class="fa fa-search"></i>
	</button>

	<form action="<?php echo $yashirSearchPageLink["Link"];?>" method="get" class="searchForm" data-toggle-status="false">
	    <label for="q" class="labelHide"><?php echo $trans->getText("Search");?></label>
	    <input type="text" name="q" id="q" class="searchInput" placeholder="<?php echo $trans->getText("Search")."...";?>" value="<?php echo isset($q)?strip_tags($q):"";?>" />
	    <button type="submit" name="search" class="formSearchButton">
	        <i class="fa fa-search"></i>
	    </button>
	</form>
</div>