//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your Browser Is old!\nIt's about time to upgrade don't you think?");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();
var currentStrArray=Array();
var currentNav=-1;

document.onkeyup=searchSuggest;



//Called from keyup on the search textbox.
//Starts the AJAX request.
function searchSuggest(e) {
	
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	if(keycode==38 || keycode==40){
		if(currentNav>-1){
			suggestOut(document.getElementById('suggestion_'+currentNav));
		}
		if(keycode==40){
			currentNav++;
		}else if(keycode==38){
			currentNav--;
		}	
		if(currentNav<0){
			currentNav=-1;
			return;
		}
		if(currentNav>=currentStrArray.length-1){
			currentNav=(currentStrArray.length-2);
		}
		document.getElementById('txtSearch').value=currentStrArray[currentNav];
		
		
		suggestOver(document.getElementById('suggestion_'+currentNav));
		return;		
	}
	
	currentNav=-1;

	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = document.getElementById('txtSearch').value;//escape(document.getElementById('txtSearch').value);
                var this_url = 'pages/searchSuggest.php?search=' + encodeURI(str);
                var search_options = document.getElementById('searchOptions').value;
                if (search_options) this_url += '&options='+search_options;
                if (search_parent_id) this_url += '&id='+search_parent_id;
		searchReq.open("GET", this_url, true);
		searchReq.onreadystatechange = handleSearchSuggest; 
		searchReq.send(null);
	}		
}


function searchCache() {
    var cacheReq = getXmlHttpRequestObject();
    var this_url = 'pages/searchSuggest.php?cache=1&id='+search_parent_id;
    cacheReq.open("GET", this_url, true);
    cacheReq.send(null);
}


//Called when the AJAX response is returned.
function handleSearchSuggest() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_suggest')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		currentStrArray=str;
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
			suggest += 'class="suggest_link" id="suggestion_'+ i +'">' + str[i] + '</div>';
			ss.innerHTML += suggest;
			document.getElementById('search_suggest').style.display='block';
		}
	}
}

//Mouse over function
function suggestOver(div_value) {
	div_value.className = 'suggest_link_over';
}
//Mouse out function
function suggestOut(div_value) {
	div_value.className = 'suggest_link';
}


//Click function
function setSearch(value) {
	document.getElementById('txtSearch').value = value;
	document.getElementById('search_suggest').innerHTML = '';
	document.getElementById('search_suggest').style.display='none';
}
