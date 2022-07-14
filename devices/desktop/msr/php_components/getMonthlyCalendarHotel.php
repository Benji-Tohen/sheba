<?php 

/*for some reason after two calls ajax stop working!*/
require_once(dirname(__FILE__).'/../../../../conf/conf.data.php');
require_once(dirname(__FILE__).'/../../../../classes/gui/class.gui.php');
require_once(dirname(__FILE__).'/../../../../classes/webmaster/class.webmaster.php');
require_once(dirname(__FILE__).'/../../../../classes/time/class.date_time.php');
require_once(dirname(__FILE__).'/../../../../classes/translate/class.translate.php');
require_once(dirname(__FILE__).'/../../../../classes/string/class.string.php');
require_once(dirname(__FILE__).'/../../../../classes/time/class.calendar_x.php');

/*after click on date got to specific form*/
$onclickFormUri = $cfg['WM']['Server'].'/item/57328/1/72653';
/*after click on date got to specific form - END*/
?>
<style>
	/* CALENDAR  MONTHLY-*/
.monthCalendarNav{
    background-color: #34c1d5;
    padding: 18px 0;
    color: #FFF;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
    position: relative;
}

.monthCalendar{
    margin-<?php echo $gui->getLeft();?>: auto;
}

div#monthlyCalendar{
    max-width: 100%;
    width : 750px;
}

.monthCalendarNavLeft, .monthCalendarNavRight{
    color: #ffffff;
    font-size: 20px;
    top: 37%;
}

.monthCalendarNavLeft{
    cursor: pointer;
    position: absolute;
    left: 30px;
}

.monthCalendarNavRight{
    cursor: pointer;
    position: absolute;
    right: 30px;
}

.monthCalendarYear{
    font-size: 24px;
    font-weight: 300;
}

.monthCalendar table {
    border-collapse: separate;
    background-color: #f5f5f5;
    margin: 0 auto 10px auto;
    font-size: 14px;
    padding: 30px 26px;
}

.monthCalendar td, .monthCalendar th {
    padding: 0px;
    width: 35px;
    height: 35px;
    text-align: center;
    vertical-align: middle;
    position: relative;
    cursor: default;
}

.monthCalendar td{
    font-size: 15.2px;
    color: #555555;
}

.monthCalendar th{
    color: #34c1d5;
    font-size: 18px;
    font-weight: 300;
    padding-bottom: 10px;
}

.dateSelectedIcon{
    color: #1ABC9C;
    position: absolute;
    <?php echo $gui->getLeft();?>: 5px;
    top: -1px;
    font-size: 6px;
    display: none;
}

.monthCalendar td:hover .dateSelectedIcon{
    display: block;
    color: #46F4D1;

}

.monthCalendar td.today {
    background-color: #e1e1e1;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}

.monthCalendar td.today:hover {
    background-color: #34c1d5;
    color: #ffffff;
}

.monthCalendar td:hover{
    background-color: #34c1d5;
    color: #FFF;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    cursor: pointer;
}

.monthCalendar td:hover .dateSelectedIcon{
    display: none;
}

.monthCalendar td.today:hover .dateSelectedIcon{
    display: none;
}

.monthCalendar td.padding:hover{
    background: none;
    cursor: default;
}

.monthCalendar .date_has_event:hover{
    color: #1BBC9B;
    background: none;
    cursor: pointer;
}

.monthCalendar td.date_has_event .dateSelectedIcon{
    display: block;
}
.monthCalendar td.date_has_event:hover  .boxWrap, .monthCalendar td.date_has_event:focus  .boxWrap, .monthCalendar td.date_has_event:focus  .boxWrap{
        display: block;
    background-position: 162px -81px;
}

.monthCalendar .events {
    position: absolute;
    right: 50%;
}
.monthCalendar .events ul {
    /* text-align: <?php echo $gui->getRight();?>; */
    right: -50%;
    top: 22px;
    position: relative;
    display: none;
    z-index: 1000;
    padding: 0px;
    background-color: #f5f5f5;
    color: #a3a3a3;
    border: none;
    font-size: 15px;
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.3);
    box-shadow: 0 0 10px 0 rgba(0,0,0,0.3);
    width: 300px;
    -moz-border-radius: 5px;
    -khtml-border-radius: 5px;
    -webkit-border-radius: 5px;
    -border-radius: 5px;
    list-style: none;
}

.monthCalendar .events li {
    border-bottom: 1px solid #dbdbdb;
    padding: 15px;
}

.monthCalendar .events li:hover{
    background-color: #1bbc9b;
}

.monthCalendar .events li:hover a{
    color: #ffffff;
}

.monthCalendar .events li:last-child{
    border-bottom: none;
}


.monthCalendar .events li span {
    display: block;
    font-size: 15px;
    text-align: justify;
    font-weight: 400;

}

.monthCalendar .events li span.desc {
    font-weight: normal;
    color: #949494;
}

.eventsBoxArrow{
    position: absolute;
    top: -33px;
    margin: 0 auto;
    text-align: center;
    left: 0;
    right: 0;
    color: #f5f5f5;
    text-shadow: 0px 0px 5px #A6A5A5;
    font-size: 50px;
    z-index: -5;
}
/* END MONTHLY- CALENDAR */

</style>
<?php
$_REQUEST["Lang"] = isset($_REQUEST["Lang"]) ? $_REQUEST["Lang"]:$_SESSION['WM']['Lang'];
$_REQUEST["m"] = isset($_REQUEST["m"]) ? $_REQUEST["m"]:'';
$_REQUEST["y"] = isset($_REQUEST["y"]) ? $_REQUEST["y"]:'';

$check_inputs = array(
    array("string10"    => $_REQUEST["Lang"]),
    array("number"      => $_REQUEST["m"]),
    array("number"      => $_REQUEST["y"])
);


$secureTexts = new secure_inputs();
$error = $secureTexts->isNotSecure($check_inputs);
if ($error) die("invalid input");


$lang= isset($_REQUEST["Lang"]) ? $_REQUEST["Lang"] : $_SESSION['WM']['Lang'] ;
$month=	intval($_REQUEST["m"]);
$year=	intval($_REQUEST["y"]);

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $lang);
$dt=new DateTime1();
$string=new String();





if(!$month || !$year){
	list($month, $year)=split(",", date("m,Y", time()));
}


$prevMonth=$month-1;
$prevYear=$year;
$nextMonth=$month+1;
$nextYear=$year;

if($month==1){
	$prevMonth=12;
	$prevYear=$year-1;
}elseif($month==12){
	$nextMonth=1;
	$nextYear=$year+1;
}

$cal=new CalendarX($month, $year);



$arrMonthNames["he"]=array(
	"ינואר",
	"פברואר",
	"מרץ",
	"אפריל",
	"מאי",
	"יוני",
	"יולי",
	"אוגוסט",
	"ספטמבר",
	"אוקטובר",
	"נובמבר",
	"דצמבר"

);

$eventsConnectedToSite = $wm->getConnectedPages(HOMEPAGEID, 98, null, "0,1000", "Hide_On_Menu=0");
$eventsIdsString = '';
foreach ($eventsConnectedToSite as $key => $event) {
    $eventsIdsString.=$event['wm_connected_wm_pages_ids'].',';
}
$eventsIdsString = rtrim($eventsIdsString,',');
$arrDates = $wm->getEventsInstances($eventsIdsString);

?>
<div id="monthlyCalendar" class="monthCalendar">
		<div class="monthCalendarNav">
                    <a tabindex="0" href="javascript:void(0);" onclick="questAjax('<?php echo $cfg["WM"]["Server"].'/'.$device;?>/php_components/getMonthlyCalendarHotel.php', 'm=<?php echo ($prevMonth);?>&y=<?php echo $prevYear;?>&Lang=<?php echo $lang;?>', 'monthlyCalendar', 'get', '');" class="monthCalendarNavRight"><i class="fa fa-angle-right"></i></a>
			<?php 
			if($lang=="he"){			
				echo $arrMonthNames[$_SESSION["WM"]["Lang"]][($month-1)];
			}else{
				echo date("M", mktime(0,0,0,$month,date("d"),date("Y")));
			}
			?> 
            <div class="monthCalendarYear"><?php echo $year;?></div>
            <a tabindex="0" href="javascript:void(0);" onclick="questAjax('<?php echo $cfg["WM"]["Server"].'/'.$device;?>/php_components/getMonthlyCalendarHotel.php', 'm=<?php echo ($nextMonth);?>&y=<?php echo $nextYear;?>&Lang=<?php echo $lang;?>', 'monthlyCalendar', 'get', '');" class="monthCalendarNavLeft"><i class="fa fa-angle-left"></i></a>
		</div>
		<table> 
			<thead>
				<tr>
					<th><?php echo $trans->getText("sun");?></th>
					<th><?php echo $trans->getText("mon");?></th>
					<th><?php echo $trans->getText("tue");?></th>
					<th><?php echo $trans->getText("wed");?></th>
					<th><?php echo $trans->getText("thu");?></th>
					<th><?php echo $trans->getText("fri");?></th>
					<th><?php echo $trans->getText("sat");?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php 
					if($cal->getFirstDayW()>0){
						$colspan=($cal->getFirstDayW()-1);
						if($colspan){?>
							<td class="padding" colspan="<?php echo $colspan;?>"></td>
    						<?php }
        					}
                            /*normalize month*/
                            if($month != 10 && $month != 11 && $month != 12 && !strstr($month, '0')){
                                $month="0".$month;
                            }
        					?>
        					<?php for($j=$cal->getFirstDayW(),$i=1;$i<=$cal->getLastDay();$i++){?>
    						<?php if(($j-1)%7==0 && $i>1){
    							echo "</tr><tr>";
    						}?>
                            <?php
                                echo "\n<!---->";
        						if(strlen($i)==1){$i="0".$i;}/*add 0 before 0-9 days in month*/
            						$date=$year."-".$month."-".$i;
                                   // print_r($arrDates);
                                    $arrEvents=array();
                                   /*get events connected to site and inset instances to $arrDates*/
                                foreach ($arrDates as $value) {
                                    //echo $date."<br />";
                                    if($date==$value['Start_Date']) { 
                                        $arrEvents[]=  $value;
                                    }
                                }
                               $fullDate =  $i." ".$month." ".$year;                      
    						?>

                                            	   
						<td id="<?php echo $year."-".$month."-".$i;?>" fullDate="<?php echo $fullDate?>" class="<?php echo ($fullDate==date("d m Y", time())?"today":"");echo ((is_array($arrEvents) && count($arrEvents))?" date_has_event":"");?> ts chooseDate"
<?php if(true){?>
	onmouseover="if(document.getElementById('homeEvents')){questAjax('<?php echo $cfg["WM"]["Server"];?>/site/php_components/ajaxHomeEvents.php', 'fDate=<?php echo $year."-".$month."-".$i;?>&lang=<?php echo $lang;?>', 'homeEvents', 'get');}" 
	onclick="tdClick('<?php echo $year."-".$month."-".$i;?>')" 
<?php }?>>
                            <i class="dateSelectedIcon fa fa-circle"></i>
							<?php echo $i;?>
                            
							<?php if(is_array($arrEvents) && count($arrEvents)){?>
                                <div class="events">
                                    <ul class="boxWrap">
                                        <div class="eventsBoxArrow"><i class="fa fa-sort-asc"></i></div>
										<?php foreach($arrEvents as $event){
										if(!$event["Link"]){
											$eventLink = $wm->getLink($event);
											$event["Link"] = $eventLink["Link"];
											//$event["Link"]="https://".($event["Alias"]?$event["Alias"]:$event["ID"]);
										}
										?>
										<li>
											<span class="title"><a href="<?php echo $event["Link"]?$event["Link"]."/".$event['idMofa']:"javascript: void(0);";?>"><?php echo $event["Name"];?></a></span>
											<span class="desc"><?php echo nl2br($string->shorten($event["Sub_Title"], 70));?></span>
										</li>
										<?php }?>
									</ul>
								</div>
							<?php }?>
						</td>
					<?php $j++;}?>

					<?php $colspan=(7-$cal->getLastDayW());?>
					<?php if($colspan){?>
						<td class="padding" colspan="<?php echo $colspan;?>"></td>
					<?php }?>
				</tr>
			</tbody>
		</table>
</div>

<script type="text/javascript">

    function tdClick(id_Td){
        var fullDate=$('#'+id_Td).attr('fullDate');
        fdArray=fullDate.split(" ");
        dateFormatted=fdArray[0]+"/"+fdArray[1]+"/"+fdArray[2];
        createCookie('selectedCalendarDate', dateFormatted,365);
        window.location.href = "<?php echo $onclickFormUri?>";
    }

    function readCookie(name) {
      var value = "; " + document.cookie;
      var parts = value.split("; " + name + "=");
      if (parts.length == 2) return parts.pop().split(";").shift();
    }
    // -------------------------------------------------------------------------------------------------------------------------------------
    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }
</script>
