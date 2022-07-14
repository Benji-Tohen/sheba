<!--
<form name="theClock">
	<input type="text" name="theTime" size="8" class="clockinput" />
<form>
-->
<div class="theClock" id="theClock"></div>
<script language="javascript">
<!--
var clockID = 0;

function UpdateClock() {
   if(clockID) {
      clearTimeout(clockID);
      clockID  = 0;
   }

   var tDate = new Date();
/*
   medocument.theClock.theTime.value = "" 
                                   + tDate.getHours() + ":" 
                                   + tDate.getMinutes() + ":" 
                                   + tDate.getSeconds();
*/

sec=tDate.getSeconds();
if(sec<10){
	sec="0"+sec;
}

   document.getElementById('theClock').innerHTML="" 
                                   + tDate.getHours() + ":" 
                                   + tDate.getMinutes() + ":" 
                                   + sec;
      
   clockID = setTimeout("UpdateClock()", 1000);
}
function StartClock() {
   clockID = setTimeout("UpdateClock()", 500);
}

function KillClock() {
   if(clockID) {
      clearTimeout(clockID);
      clockID  = 0;
   }
}

StartClock();
-->
</script>