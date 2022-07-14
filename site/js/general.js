function loadPage(page, qs){
	$('<link>', {
	    rel: 'stylesheet',
	    type: 'text/css',
	    href: 'http://'+document.domain+'/css/'+page
	}).appendTo('head');
	$.getScript('http://'+document.domain+'/js/'+page, function(){});

	$.ajax({
	  url: 'ajaxPage/'+page,
	  data: qs,
	  cache: false,
	  success: function(data) {
	    $('#pageData').html(data);
	  }
	});
}


function justifyMenu(menuClassName, menuContainer, centermenu) {
	//var menuWidth=$('.justifyMenu').width();

	var menuWidth=$('body').width();

	if(!menuClassName){
		menuClassName='justifyMenu';
	}

	if(menuContainer){
		menuWidth=$('.'+menuContainer).width();
	}



	$('.'+menuClassName).css('width', menuWidth+'px');

	//alert(menuWidth);

	//alert($('.justifyMenu').width());

	var imageWidth=0;
	var numImages=0;
	var innerMenuWidth=0;

	$('.'+menuClassName+' .menuItem').each(function(i){
		//console.log($(this).attr('src'));
		innerMenuWidth+=$(this).width();
		numSpaces=i;
		if(i>3){
			return false;
		}
	});
	numSpaces+=1;

	var areaLeft=		menuWidth-innerMenuWidth;
	var halfAreaLeft=	(areaLeft/2);
	var spaceBetweenItem=	areaLeft/numSpaces;
	var halfSpaceBetweenItem=(spaceBetweenItem/2)-2;


	//alert(areaLeft);

	//console.log(menuWidth+" "+innerMenuWidth+" "+areaLeft+" "+halfAreaLeft+" "+spaceBetweenItem+" "+halfSpaceBetweenItem);


	if(centermenu){
		//	Use this to put the menu in the middle
		$('.'+menuClassName).css("padding-right", halfAreaLeft);		
	}else{
		//	Use this to space equally between the menu items
		$('.'+menuClassName+' .menuItem').css("margin-right", halfSpaceBetweenItem+"px");
		$('.'+menuClassName+' .menuItem').css("margin-left", halfSpaceBetweenItem+"px");
	}
}
/*
function justifyMenu(centermenu) {
	//var menuWidth=$('.justifyMenu').width();

	var menuWidth=$('body').width();

	$('.justifyMenu').css('width', menuWidth+'px');

	//alert(menuWidth);

	//alert($('.justifyMenu').width());

	var imageWidth=0;
	var numImages=0;
	var innerMenuWidth=0;

	$('.menuItem').each(function(i){
		console.log($(this).attr('src'));
		innerMenuWidth+=$(this).width();
		numSpaces=i;
		if(i>3){
			return false;
		}
	});
	numSpaces+=1;

	var areaLeft=		menuWidth-innerMenuWidth;
	var halfAreaLeft=	(areaLeft/2);
	var spaceBetweenItem=	areaLeft/numSpaces;
	var halfSpaceBetweenItem=(spaceBetweenItem/2);


	//console.log(menuWidth+" "+innerMenuWidth+" "+areaLeft+" "+halfAreaLeft+" "+spaceBetweenItem+" "+halfSpaceBetweenItem);


	if(centermenu){
		//	Use this to put the menu in the middle
		$('.justifyMenu').css("padding-right", halfAreaLeft);		
	}else{
		//	Use this to space equally between the menu items
		$('.menuItem').css("margin-right", halfSpaceBetweenItem+"px");
		$('.menuItem').css("margin-left", halfSpaceBetweenItem+"px");
	}
}
*/
