// JavaScript Document
function getVideo(objname, video){
	
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
			
			//document.getElementById('memo').innerHTML = document.getElementById('inner_content').innerHTML;
//			document.getElementById('inner_content').className='displaynon';
			
			document.getElementById(objname).innerHTML = xmlObj.responseXML.getElementsByTagName('data')[0].firstChild.data;		
			

			document.getElementById(objname).className='movie_view';
			
//			xmlObj.responseXML.getElementsByTagName('data')[0].firstChild.data
			
		 }
	}
	
	file="site/php_display/video_page_movie_xml.php";
	file+="?v="+video;
	file=encodeURI(file);
	
	xmlObj.open ('GET', file, true);
	xmlObj.send (null);
}