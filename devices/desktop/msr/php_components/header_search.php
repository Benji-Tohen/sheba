<form 
    class="navbar-form-heder" 
    id='searchForm' 
    role="search" 
    action="<?php echo $cfg["WM"]["Server"].'/item/'.$wm->getIdByPageTypeNoHomepageID(12,$wmPage['Lang']);?>" 
    method="get"
>
    <div class="input-group">
        <label 
            class="d-none"
            for="q_search_box" 
            ><?php echo $trans->getText("Search");?>
        </label>
        <input 
            class="search-input" 
            id="q_search_box"
            type="text" 
            name="q" 
            placeholder="<?php if($homePageId!=('62589')){echo $trans->getText("headerSearchText");};?>" 
            value="<?php echo isset($q)?strip_tags($q):"";?>" 
        />
        <button 
            class="search-button"
            tabindex="0" 
            onkeypress="$('#searchForm').submit()" 
            onclick="$('#searchForm').submit()" 
            title="<?php echo $trans->getText("Search");?>" 
            >
            <img src="<?php echo $cfg["WM"]["Server"];?>/webfiles/icons/search_icon_copy.svg" alt="" class=""  />
        </button>
        <input type="hidden" name="search" value="1" />
    </div>
</form>