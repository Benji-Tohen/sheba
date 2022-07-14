function getExists(table, field, val){
	
	var xmlObj = null;
	if(window.XMLHttpRequest){
	  xmlObj = new XMLHttpRequest();
	} else if(window.ActiveXObject){
	  xmlObj = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  return;
	}
	
	xmlObj.onreadystatechange = function(){
		if(xmlObj.readyState == 4){
			//document.getElementById(objname).innerHTML = xmlObj.responseXML.getElementsByTagName('data')[0].firstChild.data;
			
			
//			xmlObj.responseXML.getElementsByTagName('data')[0].firstChild.data
		 }
	}
	
	file="../xml/isExists_xml.php?table="+table+"&field="+field+"&val="+val;
	
	xmlObj.open ('GET', file, true);
	xmlObj.send (null);
}

function isRoomExists(room_number, building_number, room_id){

	passForm=false;

	var xmlObj = null;
	if(window.XMLHttpRequest){
	  xmlObj = new XMLHttpRequest();
	} else if(window.ActiveXObject){
	  xmlObj = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  return;
	}
	
	xmlObj.onreadystatechange = function(){
		if(xmlObj.readyState == 4){
			//document.getElementById(objname).innerHTML = xmlObj.responseXML.getElementsByTagName('data')[0].firstChild.data;
			exists=xmlObj.responseXML.getElementsByTagName('data')[0].firstChild.data;

			if(exists){
				roomExists(room_number, building_number);
			}else{
				roomNotExists();	
			}
//			xmlObj.responseXML.getElementsByTagName('data')[0].firstChild.data
		 }
	}
	
	file="../xml/isExists_xml.php?room_number="+room_number+"&building_number="+building_number+"&room_id="+room_id;
	
	xmlObj.open ('GET', file, true);
	xmlObj.send (null);
}

// JavaScript Document
function questAjax(url, parameters, objName, method, runAfter) {	
  if(!method){
	method="POST";  
  }
  ajaxRequest = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 ajaxRequest = new XMLHttpRequest();
	 if (ajaxRequest.overrideMimeType) {
		// set type accordingly to anticipated content type
		//ajaxRequest.overrideMimeType('text/xml');
		ajaxRequest.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!ajaxRequest) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }
  
  ajaxRequest.onreadystatechange = function(){
	  
	  if (ajaxRequest.readyState == 1) {
		if(objName){
		  //document.getElementById(objName).innerHTML = "מעלה מידע...";
		}
	  }
	  
	  if (ajaxRequest.readyState == 2) {
		if(objName){
		  //document.getElementById(objName).innerHTML = "מידע התעדכן";
		}
	  }
	  
	  if (ajaxRequest.readyState == 3) {
		if(objName){
		  //document.getElementById(objName).innerHTML = "אינטראקטיבי";
		}
	  }	  
	  
	  if (ajaxRequest.readyState == 4) {
		 if (ajaxRequest.status == 200) {
			if(objName){
				result = ajaxRequest.responseText;
				document.getElementById(objName).innerHTML = result;            
			}
		 } else {
			document.getElementById(objName).innerHTML = "Error recieving data: "+ajaxRequest.status+" - "+ajaxRequest.statusText;
		 }
		
		if(runAfter){
			eval(runAfter);
		}

	  }		  
	  
  };
  
  if(method=="GET"){
	  ajaxRequest.open('GET', url+"?"+parameters, true);
	  ajaxRequest.send(null);
  }else{
	  ajaxRequest.open('POST', url, true);
	  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  ajaxRequest.setRequestHeader("Content-length", parameters.length);
	  ajaxRequest.setRequestHeader("Connection", "close");
	  ajaxRequest.send(parameters);
  }
}

