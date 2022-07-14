// JavaScript Document
var pos; // variable for posting information
function loadXMLPosDoc(url,posData) {
    // branch for native XMLHttpRequest object
    if (window.XMLHttpRequest) {
        pos = new XMLHttpRequest();
        pos.onreadystatechange = processPosChange;
        pos.open("POST", url, false);
		pos.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        pos.send(posData);
    // branch for IE/Windows ActiveX version
    } else if (window.ActiveXObject) {
        pos = new ActiveXObject("Microsoft.XMLHTTP");
        if (pos) {
            pos.onreadystatechange = processPosChange;
            pos.open("POST", url, false);
			pos.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            pos.send(posData);
        }
    }
}

function grabPosXML (tagName) {
	return pos.responseXML.documentElement.getElementsByTagName('data')[0].firstChild.data;
}

function processPosChange() {
    // page loaded "complete"
    if (pos.readyState == 4) {
        // page is "OK"
        if (pos.status == 200) {
			if ( grabPosXML("posStatus") == 'fail' ) { 
				alert('There were problems Updating. Please check back in a couple minutes');
			}
		}
	}
}