var flyInterval=null;
var itemFlyTop=0;
var itemFlyleft=0;
var objFly=null;
var offset=0;
var pixToMove=20;
var cartTop=0;
var cartLeft=0;
var itemFlyTopOff=0;
var itemFlyleftOff=0;
var count=0;
var itemFlyMoveRight=true;
var itemFlyMoveDown=true;

function flytobasket(objName){
	var cart;
	var inputObj;

	itemFlyMoveRight=true;
	itemFlyMoveDown=true;

	if(!document.getElementById(objName)){
		return;
	}

	cart=		document.getElementById('cart');
	objFly=		document.getElementById('objFly');
	inputObj=	document.getElementById(objName);


	if(document.all){
		//point=		getElementAbsoluteCoords(cart);
		cartTop=	cart.offsetTop;
		cartLeft=	cart.offsetLeft;

		//cartTop=	point[1];
		//cartLeft=	point[0];			
	
		point=		getElementAbsoluteCoords(inputObj);
		itemFlyTop=	point[1];
		itemFlyleft=	point[0];
	}else{
		cartTop=	cart.offsetTop;
		cartLeft=	cart.offsetLeft;

		itemFlyTop=	inputObj.offsetTop;
		itemFlyleft=	inputObj.offsetLeft;				
	}	
	

	itemFlyTopOff=cartTop-itemFlyTop;
	itemFlyleftOff=cartLeft-itemFlyleft;

	if(itemFlyTopOff>itemFlyleftOff){
		offset=itemFlyTopOff/itemFlyleftOff;
	}else{
		offset=itemFlyleftOff/itemFlyTopOff;
	}

	if(itemFlyTop>cartTop){
		itemFlyMoveDown=false;
	}

	if(itemFlyleft>cartLeft){
		itemFlyMoveRight=false;
	}

	
	objFly.className="storeItem";
	objFly.innerHTML=inputObj.innerHTML;
	objFly.style.display="block";

	objFly.style.top=itemFlyTop+"px";
	objFly.style.left=itemFlyleft+"px";

	flyInterval=setInterval("doFlight()", 1);
}


function doFlight(){
	
	if(itemFlyTopOff<itemFlyleftOff){
		if(itemFlyMoveDown){
			itemFlyTop+=pixToMove;	
		}else{
			itemFlyTop-=pixToMove;	
		}
		if(itemFlyMoveRight){
			itemFlyleft+=pixToMove*Math.abs(offset);
		}else{
			itemFlyleft-=pixToMove*Math.abs(offset);
		}

	}else{
		if(itemFlyMoveDown){
			itemFlyTop+=pixToMove*Math.abs(offset);
		}else{
			itemFlyTop-=pixToMove*Math.abs(offset);
		}

		if(itemFlyMoveRight){
			itemFlyleft+=pixToMove;	
		}else{
			itemFlyleft-=pixToMove;	
		}
	}

	count++;



	itemFlyTop=	Math.round(itemFlyTop);
	itemFlyleft=	Math.round(itemFlyleft);

	objFly.style.top=	itemFlyTop+"px";
	objFly.style.left=	itemFlyleft+"px";


	endOfTop=	((itemFlyMoveDown && itemFlyTop>cartTop) || (!itemFlyMoveDown && itemFlyTop>cartTop) || itemFlyTop<0);
	endOfBottom=	((itemFlyMoveRight && itemFlyleft>cartLeft) || (!itemFlyMoveRight && itemFlyleft<cartLeft) || itemFlyleft<0);

	if(endOfTop && endOfBottom){
		clearInterval(flyInterval);
		objFly.style.display="none";
	}
/*
	if(itemFlyTop>cartTop && itemFlyleft>cartLeft){
		clearInterval(flyInterval);
		objFly.style.display="none";
	}
*/

	
	
}
