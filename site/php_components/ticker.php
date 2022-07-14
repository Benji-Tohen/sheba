<?php
session_start();
require_once('../../conf/conf.data.php');
require_once('../../classes/gui/class.gui.php');
require_once('../../classes/webmaster/class.webmaster.php');
require_once('../../classes/time/class.date_time.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$dt=new DateTime1();

$arrHomeNews=$wm->getTickerContent();

$run_ticker=true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>News Ticker</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<link href="<?php echo $cfg["WM"]["Server"];?>/site/design/ticker.css" type="text/css" rel="stylesheet" />
<script language="JavaScript" type="text/JavaScript">
<!--
function getObj(preObj, obj){
	return preObj.getElementById(obj);
}


function writeConsole(content) {
 if(!top.consoleRef){
	 top.consoleRef=window.open('','myconsole',
	  'width=350,height=250'
	   +',menubar=0'
	   +',toolbar=1'
	   +',status=0'
	   +',scrollbars=1'
	   +',resizable=1')
	}
 top.consoleRef.document.writeln(
  '<html><head><title>Console</title></head><body bgcolor=white onLoad="self.focus()">'
   +content
   +'</body></html>'
 )
 top.consoleRef.document.close()
}

//-->
</script>
</head>
<body OnLoad="tickerStart(0);" onmouseover="stopTicker();" onmouseout="startTicker();" dir="<?php echo $_SESSION["lang"]=="en"?"ltr":"rtl";?>">
<div id="tickerL0" class="mainLayer">


			<?php for($i=0;$i<count($arrHomeNews);$i++){?>
				<div class="entry">
					<div class="entryTitle"><a href="<?php echo $cfg["WM"]["Server"];?>/<?php echo $arrHomeNews[$i]["Alias"]?$arrHomeNews[$i]["Alias"]:$arrHomeNews[$i]["ID"];?>/" target="_top"><?php echo $arrHomeNews[$i]["Name"];?></a></div>
					<div class="entrySubTitle"><?php echo nl2br($arrHomeNews[$i]["Sub_Title"]);?></div>
				</div>
			<?php }?>
</div>
<div id="tickerL1" class="mainLayer"></div>

<script type="text/javascript">
var running=true;
var ticker=Array(1);
ticker[0]=getObj(document, "tickerL0");
ticker[1]=getObj(document, "tickerL1");
var LAYER_HEIGHT=ticker[0].offsetHeight;
var SPEED=50;
var TICKER_BOTTOM=150;
var LENGTH=1;
var START_X=0;
//var START_Y=TICKER_BOTTOM;
var num=0;





function checkLayerHeight(){
	setTimeout("updateLayerHeight()", 100);
}
function updateLayerHeight(){
	LAYER_HEIGHT=ticker[0].offsetHeight;
	moveToStart(num);
	moveToTail(getOp(num));	
}



var ticker_height=document.getElementById("tickerL0").offsetHeight;
var run_ticker=true;


//alert(ticker_height+" > "+(TICKER_BOTTOM+5));


run_ticker=true;



var START_Y=1;
var DEBUGGER=0;
var TIMER1;

function stopTicker(){
	running=false;
	clearTimeout(TIMER1);
}

function startTicker(){
	<?php if($run_ticker){?>
		if(run_ticker){
			
			running=true;
			clearTimeout(TIMER1);
			TIMER1=setTimeout('makeRound(0)', SPEED);
		}
	<?php }?>
}


function tickerStart(num){
	if(!run_ticker){
		running=false;
	}else{
		getObj(document, "tickerL1").innerHTML=getObj(document, "tickerL0").innerHTML;	
	}
	moveToStart(num);
	moveToTail(getOp(num));
	makeRound(num);
}

function moveToStart(num){
	ticker[num].style.top=START_Y;
	//ticker[num].style.left=START_X;

}


function makeRound(num){

	//DEBUGGER++;
	//consoletext=DEBUGGER+"<br><br>SPEED="+SPEED+"<br><br>LENGTH="+LENGTH;
	//consoletext=DEBUGGER+"<br><br>Top: "+ticker[num].style.top;
	//writeConsole(consoletext);

	var current0=ticker[num].style.top.substr(0, ticker[num].style.top.length-2);
	var current1=ticker[getOp(num)].style.top.substr(0, ticker[getOp(num)].style.top.length-2);

	

	ticker[num].style.top=current0-LENGTH;
	ticker[getOp(num)].style.top=current1-LENGTH;




	if(current0==-LAYER_HEIGHT){
		moveToTail(num);	//Move to Others Buttom
	}

	if(current1==-LAYER_HEIGHT){
		moveToTail(getOp(num));	//Move to Others Buttom
	}
	if(running){
		TIMER1=setTimeout("makeRound("+num+")", SPEED);
	}
}

function moveToTail(num){
	ticker[num].style.top=(parseInt(ticker[getOp(num)].style.top.substr(0, ticker[getOp(num)].style.top.length-2))+LAYER_HEIGHT);
}

function getOp(num){
	if(num==0)
		return 1;
		
	return 0;
}
</script>
</body>
</html>
