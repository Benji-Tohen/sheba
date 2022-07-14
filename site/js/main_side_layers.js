// JavaScript Document
function hideLayers(){
	var arr=document.getElementsByTagName("table");
	for(i=0;i<arr.length;i++){
		if(arr.item(i) && arr.item(i).id){
			left=arr.item(i).id.split('_');
				if(left[0]=="submenu"){
					//open_0.filters[0].Apply();
					arr.item(i).className="hiddenMenu_off";
					//open_0.filters[0].Play(duration=2);
				}
		}
	}
}

function showLayerEvent(e){

}

function showLayer(id, dontWipe){

	var layerId="submenu_"+id;
	var makeMenu="hiddenMenu_on";

	if(getObj(document, layerId)){
	
		if(getObj(document, layerId).className=="hiddenMenu_on"){
			makeMenu="hiddenMenu_off";
		}
	
		hideLayers();
		
		//all_menu.filters[0].Apply();
		if(!dontWipe && navigator.appName!="Netscape"){
		//	eval("submenu_"+ id +".filters[0].Apply();"); 
			
			eval("if(getObj(document, 'submenu_"+ id +"').filters[0]){getObj(document, 'submenu_"+ id +"').filters[0].Apply();}");
			
			//eval("getObj(document, 'submenu_"+ id +"').filters[0].Apply();");		
		}
		getObj(document, layerId).className=makeMenu;
		//all_menu.filters[0].Play(duration=3);
		if(!dontWipe && navigator.appName!="Netscape"){
		//	eval("submenu_"+ id +".filters[0].Play(duration=0.5);");
			
			eval("getObj(document, 'submenu_"+ id +"').filters[0].Play(duration=0.5);");
		}
	}
}


function getObj(preObj, obj){
	if(navigator.appName=="Netscape"){
		if (parseFloat(navigator.appVersion)>=5){	//	netscape >= 5
    		return preObj.getElementById(obj);
		}else{										//	netscape <5
			return preObj.eval(obj);
		}	
	}else{											//	explorer	
			return preObj.all[obj];
	}
}


function getSource(e){
		if (document.all)
			return event.srcElement;
		else if (document.getElementById)
			return e.target;
}

function init(){
	<?if($id){?>
		showLayer("<?=$parent?>", true);
	<?}?>
	self.focus();
}