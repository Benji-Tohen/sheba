function loadPage(page, qs){
	$.ajax({
	  url: 'ajax/'+page,
	  data: qs,
	  success: function(data) {
	    $('#pageData').html(data);
	  }
	});
}

function getElementAbsoluteCoords(aElement){
      aLeft = 0;
      aTop  = 0;
      if (aElement.offsetParent)
      {
            aLeft = aElement.offsetLeft;
            aTop  = aElement.offsetTop;
            while (aElement = aElement.offsetParent)
            {
                  aLeft += aElement.offsetLeft;
                  aTop  += aElement.offsetTop;
            }
      }
      point=Array(2);
      point[0]=aLeft;
      point[1]=aTop;
      return point;
}

function submitAjaxForm(formObj, postTo, objName){

	if(!ajaxFormCheckFields(formObj)){
		return false;
	}

	var parameters="";
	for(i=0;i<formObj.elements.length;i++){
		if(i>0){
			parameters+="&";	
		}
		parameters+=formObj.elements[i].name+"="+formObj.elements[i].value;
		
	}

	questAjax(postTo, parameters, objName);

	return false;
}
