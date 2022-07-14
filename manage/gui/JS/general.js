function highlight(id, className){
	if(!className){
		className="highLight";
	}
	document.getElementById(id).className=className;
}

function confirm1(id, prev_class, text){
	result=confirm(text);
	if(!result){
		highlight(id, prev_class);
	}
	return result;
}


function highlightImage(id, className){
	if(!className){
		className="highLightImage";
	}
	document.getElementById(id).className=className;
}

function confirm2(id, prev_class, text){
	result=confirm(text);
	if(!result){
		highlightImage(id, prev_class);
	}
	return result;
}
