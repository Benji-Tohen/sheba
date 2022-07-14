var showImageWidthStart=50;
var showImageHeightStart=50;
var showImageWidthEnd=400;
var showImageHeightEnd=400;
var showImageGrowSpeed=30;
var showImageCurrentWidth=0;
var showImageCurrentHeight=0;
var showImageCurrentLeft=0;
var showImageCurrentTop=0;
var showImageInterval=null;
var imgShowObj;
var clientWidth;
var clientHeight;
var showImageMoveRight;
var showImageMoveDown;


function closeImageShow(){
	imgShowObj.style.display='none';
	document.getElementById('imageShowBackground').style.display='none';
}



function showImage(objStart, speed, endImgID){

	showImageGrowSpeed=	speed;

	imgShowObj=document.getElementById('imageShow');
	//imgShowObj.src=endSrc;
	imgShowObj.src=pic[endImgID].src;
		

	imgShowObj.style.top="-1000px";
	imgShowObj.style.left="-1000px";

	if(imgShowObj.style.display!='block'){
		//imgShowObj.style.display='block';
	}

	

	document.getElementById('imageShowBackground').style.display=	'block';
	if(document.all){
		document.getElementById('imageShowBackground').style.height=	document.body.clientHeight;
	}else{
		document.getElementById('imageShowBackground').style.height=	document.body.offsetheight;
	}
	
	


		
	if(document.all){
		point=			getElementAbsoluteCoords(objStart);
		showImageCurrentLeft=	point[0];
		showImageCurrentTop= 	point[1];
	}else{
		showImageCurrentLeft=	objStart.offsetLeft;
		showImageCurrentTop=	objStart.offsetTop;
	}

	imgShowObj.style.left=	showImageCurrentLeft;
	imgShowObj.style.top=	showImageCurrentTop;

	showImageWidthStart=	objStart.width;
	showImageHeightStart=	objStart.height;
	
	//showImageWidthEnd=	imgShowObj.width;
	//showImageHeightEnd=	imgShowObj.height;

	showImageWidthEnd=	pic[endImgID].width;
	showImageHeightEnd=	pic[endImgID].height;
	




	showImageCurrentWidth=	showImageWidthStart;
	showImageCurrentHeight=	showImageHeightStart;

	imgShowObj.width=		showImageCurrentWidth+'px';
	imgShowObj.Height=		showImageCurrentHeight+'px';


	clientWidth=	window.innerWidth;
	clientHeight=	window.innerHeight;
	
	if(!clientWidth){
		clientWidth=	document.body.clientWidth;
		clientHeight=	document.body.clientHeight;
	}
	
	var scrolltop;

	if(document.all){
		scrolltop=document.documentElement.scrollTop;

		endOffsetLeft=	((clientWidth-showImageWidthEnd)/2);
		endOffsetTop=	((document.documentElement.clientHeight-showImageHeightEnd)/2)+scrolltop;

	}else{
		scrolltop=window.pageYOffset;

		endOffsetLeft=	((clientWidth-showImageWidthEnd)/2);
		endOffsetTop=	((clientHeight-showImageHeightEnd)/2)+scrolltop;
	}
	







	showImageMoveRight=	(endOffsetLeft>showImageCurrentLeft);
	showImageMoveDown=	(endOffsetTop>showImageCurrentTop);
	
	
	showImageInterval=setInterval('showImageGrow()', 3);
}



function showImageGrow(){

	var endWidth=		false;
	var endHeight=		false;
	var inPlaceLeft=	false;
	var inPlaceTop=		false;
	
	

	if(imgShowObj.style.display!='block'){
		imgShowObj.style.display='block';
	}

	if((showImageCurrentWidth+showImageGrowSpeed)<showImageWidthEnd){
		showImageCurrentWidth+=showImageGrowSpeed;
	}else{
		endWidth=true;
	}

	if((showImageCurrentHeight+showImageGrowSpeed)<showImageHeightEnd){
		showImageCurrentHeight+=showImageGrowSpeed;		
	}else{
		endHeight=true;	
	}

	if(showImageMoveRight){
		if(showImageCurrentLeft<endOffsetLeft){
			showImageCurrentLeft+=showImageGrowSpeed;
		}else{
			inPlaceLeft=true;
		}
	}else{
		if(showImageCurrentLeft>endOffsetLeft){
			showImageCurrentLeft-=showImageGrowSpeed;
		}else{
			inPlaceLeft=true;
		}
	}


	if(showImageMoveDown){
		if(showImageCurrentTop<endOffsetTop){
			showImageCurrentTop+=showImageGrowSpeed;
		}else{
			inPlaceTop=true;
		}	
	}else{
		if(showImageCurrentTop>endOffsetTop){
			showImageCurrentTop-=showImageGrowSpeed;
		}else{
			inPlaceTop=true;
		}	
	}

	imgShowObj.style.left=	showImageCurrentLeft+'px';
	imgShowObj.style.top=	showImageCurrentTop+'px';

	imgShowObj.style.width=showImageCurrentWidth+'px';
	imgShowObj.style.height=showImageCurrentHeight+'px';
	
	if(endWidth && endHeight && inPlaceLeft && inPlaceTop){
		imgShowObj.style.width=		showImageWidthEnd+'px';
		imgShowObj.style.height=	showImageHeightEnd+'px';
		clearInterval(showImageInterval);
	}

}
