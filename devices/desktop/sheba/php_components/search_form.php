<form name="search_form" id="search_form" class="searchForm" action="<?php echo $searchAlias["Link"];?>">
	<input type="text" name="q" id="q" class="searchFormText" value="<?php echo strip_tags($q);?>" />
	<input type="submit" value="<?php //echo $trans->getText("SearchButton");?>" class="submitSearch" />
</form>
