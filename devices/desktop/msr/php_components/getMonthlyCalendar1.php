<?php 

/*for some reason after two calls ajax stop working!*/
require_once(dirname(__FILE__).'/../../../../conf/conf.data.php');
require_once(dirname(__FILE__).'/../../../../classes/gui/class.gui.php');
require_once(dirname(__FILE__).'/../../../../classes/webmaster/class.webmaster.php');
require_once(dirname(__FILE__).'/../../../../classes/time/class.date_time.php');
require_once(dirname(__FILE__).'/../../../../classes/translate/class.translate.php');
require_once(dirname(__FILE__).'/../../../../classes/string/class.string.php');
require_once(dirname(__FILE__).'/../../../../classes/time/class.calendar_x.php');




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
                    <a tabindex="0" href="javascript:void(0);" onclick="questAjax('<?php echo $cfg["WM"]["Server"].'/'.$device;?>/php_components/getMonthlyCalendar.php', 'm=<?php echo ($prevMonth);?>&y=<?php echo $prevYear;?>&Lang=<?php echo $lang;?>', 'monthlyCalendar', 'get', '');" class="monthCalendarNavRight"><i class="fa fa-angle-right"></i></a>
			<?php 
			if($lang=="he"){			
				echo $arrMonthNames[$_SESSION["WM"]["Lang"]][($month-1)];
			}else{
				echo date("M", mktime(0,0,0,$month,date("d"),date("Y")));
			}
			?> 
            <div class="monthCalendarYear"><?php echo $year;?></div>
            <a tabindex="0" href="javascript:void(0);" onclick="questAjax('<?php echo $cfg["WM"]["Server"].'/'.$device;?>/php_components/getMonthlyCalendar.php', 'm=<?php echo ($nextMonth);?>&y=<?php echo $nextYear;?>&Lang=<?php echo $lang;?>', 'monthlyCalendar', 'get', '');" class="monthCalendarNavLeft"><i class="fa fa-angle-left"></i></a>
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
                                                 	   
						<td class="<?php echo ($fullDate==date("d m Y", time())?"today":"");echo ((is_array($arrEvents) && count($arrEvents))?" date_has_event":"");?> ts"
<?php if(false && (is_array($arrEvents) && count($arrEvents))){?>
	onmouseover="if(document.getElementById('homeEvents')){questAjax('<?php echo $cfg["WM"]["Server"];?>/site/php_components/ajaxHomeEvents.php', 'fDate=<?php echo $year."-".$month."-".$i;?>&lang=<?php echo $lang;?>', 'homeEvents', 'get');}" 
	onclick="document.location='<?php echo $cfg["WM"]["Server"];?>/<?php echo $eventsId;?>/<?php echo $year."-".$month."-".$i;?>';" 
<?php }?>>
                            <i class="dateSelectedIcon fa fa-circle"></i>
							<?php echo $i;?>

							<?php if(is_array($arrEvents) && count($arrEvents)){?>
                                <div class="events">
                                    <ul class="boxWrap">
                                        <div class="eventsBoxArrow"><i class="fa fa-sort-asc"></i></div>
										<?php foreach($arrEvents as $event){
										if(!$event["Link"]){
											$event["Link"]="https://".($event["Alias"]?$event["Alias"]:$event["ID"]);
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
