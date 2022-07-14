// JavaScript Document
function openLayer(id, width, height){
	if(document.getElementById(id).className=="" || document.getElementById(id).className=="apear"){
		document.getElementById(id).className="disapear";	
	}else{
		var left;
		var top;
		
		document.getElementById(id).className="apear";
		document.getElementById(id).style.position='absolute';	
		if(document.all){
			left=(screen.width/2-width/2);
			top=(screen.height/4-height/2);
			document.getElementById(id).style.left=parseInt(left)+"px";
			document.getElementById(id).style.top=parseInt(top)+"px";
		}else{
			left=(document.body.clientWidth/2-width/2);
			top=(document.body.clientHeight/4-height/2);
			document.getElementById(id).style.left=left+"px";
			document.getElementById(id).style.top=top+"px";
		}
	}
}

function hideLayer(id){
	//document.getElementById(id).className="disapear";
	document.getElementById(id).style.display="none";
}

function showLayer(id){
/*
	document.getElementById(id).className="apear";
	document.getElementById(id).style.display="block";
*/
	document.getElementById(id).style.display="block";
}

function putInCenter(id){
		return;
		
		var width;
		var height;
		width=parseInt(document.getElementById(id).style.width.replace("px", ""));
		height=parseInt(document.getElementById(id).style.height.replace("px", ""));

		
		if(document.all){
			left=(screen.width/2-parseInt(width)/2);
			top=(screen.height/4-parseInt(height)/2);
			document.getElementById(id).style.left=parseInt(left)+"px";
			document.getElementById(id).style.top=parseInt(top)+"px";
		}else{
			left=(document.body.clientWidth/2-width/2);
			top=(document.body.clientHeight/4-height/2);
			document.getElementById(id).style.left=left+"px";
			document.getElementById(id).style.top=top+"px";
		}


}
