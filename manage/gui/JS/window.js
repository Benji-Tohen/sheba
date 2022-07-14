// JavaScript Document
function openWin(file, width, height){
	var place;
	if(document.all){
		place=', top='+(screen.height/2-height/2)+',left='+(screen.width/2-width/2);
	}else{
		place=', top='+(document.body.clientWidth/2-height/2)+',left='+(document.body.clientHeight/2-width/2);
	}
	newWindow=window.open(file,'newWin','toolbar=no,location=no,scrollbars=auto,resizable=yes,width='+ width +', height='+ height+place);
}