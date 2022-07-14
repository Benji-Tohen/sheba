<?php 
/*for some reason after two calls ajax stop working!*/
require_once(dirname(__FILE__).'/../../../../conf/conf.data.php');
require_once(dirname(__FILE__).'/../../../../classes/gui/class.gui.php');
require_once(dirname(__FILE__).'/../../../../classes/webmaster/class.webmaster.php');
require_once(dirname(__FILE__).'/../../../../classes/time/class.date_time.php');
require_once(dirname(__FILE__).'/../../../../classes/translate/class.translate.php');
require_once(dirname(__FILE__).'/../../../../classes/string/class.string.php');
require_once(dirname(__FILE__).'/../../../../classes/time/class.calendar_w.php');

$check_inputs = array(
    array("string10"    => $_REQUEST["Lang"]),
    array("number"      => $_REQUEST["t"])
);

$secureTexts = new secure_inputs();
$error = $secureTexts->isNotSecure($check_inputs);
if ($error) die("invalid input");

$lang= isset($_REQUEST["Lang"]) ? $_REQUEST["Lang"] : $wmPage['Lang'] ;
$time=	intval($_REQUEST["t"]);
$is_param = intval($_REQUEST["t"]);
$wmPageType = isset($wmPage['Type']['ID'])? $wmPage['Type']['ID']: $_REQUEST['wmPageType'];
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $lang);
$dt=new DateTime1();
$string=new String();

if(!$time) $time = time();                  // will use timestamp here instead

$prevWeek=$time-(86400*7);                  // previous week = timestamp - 86400 (seconds per day) * 7 days
$nextWeek=$time+(86400*7);                  // next weeek = timestamp + 86400 (seconds per day) * 7 days

$cal=new CalendarW($time);

$arrDayNames["he"]=array(
    "ראשון",
    "שני",
    "שלישי",
    "רביעי",
    "חמישי",
    "שישי",
    "שבת"
);

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

/*$eventsConnectedToSite = $wm->getConnectedPages(HOMEPAGEID, 98, null, "0,1000", null);
foreach ($eventsConnectedToSite as $key => $event) {
    $eventsIdsString.=$event['wm_connected_wm_pages_ids'].',';
}
$eventsIdsString = rtrim($eventsIdsString,',');
$arrDates = $wm->getEventsInstances($eventsIdsString);
$arrDatesIndexed = array();
foreach ($arrDates as $n=>$arr) {
    if (!@$arrDatesIndexed[$arr['Start_Date']]) $arrDatesIndexed[$arr['Start_Date']] = array();
    $arrDatesIndexed[$arr['Start_Date']][] = $arr;
}*/
 
//print_r($arrDatesIndexed);
?>

<?php if (!$is_param) { ?><div id="weeklyCalendar" class="col-12"><?php } ?>
    <div class="weeklyHeader">
        <div class="r"><a href="javascript:void(0);" onclick="questAjax('<?php echo $cfg["WM"]["Server"].'/'.$device;?>/php_components/getWeeklyCalendarHotel.php', 't=<?php echo ($prevWeek);?>&Lang=<?php echo $lang;?>&wmPageType=<?php echo $wmPageType?>', 'weeklyCalendar', 'get', '');"><i class="fa fa-angle-right"></i></a></div>
        <div class="l"><a href="javascript:void(0);" onclick="questAjax('<?php echo $cfg["WM"]["Server"].'/'.$device;?>/php_components/getWeeklyCalendarHotel.php', 't=<?php echo ($nextWeek);?>&Lang=<?php echo $lang;?>&wmPageType=<?php echo $wmPageType?>', 'weeklyCalendar', 'get', '');"><i class="fa fa-angle-left"></i></a></div>
        <?php//<center>?>
        <div class="center">
            <?php
                echo "הזמנת חדר לתאריכים ";
                if ($cal->weekDays[0]['year']==$cal->weekDays[6]['year']) {     // if same year ..
                    echo "<b>";
                    if ($cal->weekDays[0]['month']==$cal->weekDays[6]['month']) {
                        echo $cal->weekDays[0]['dom']."-".$cal->weekDays[6]['dom']." ב".$arrMonthNames["he"][$cal->weekDays[0]['month_num']-1];
                    } else {
                        echo $cal->weekDays[0]['dom']." ".$arrMonthNames["he"][$cal->weekDays[0]['month_num']-1];
                        echo "-";
                        echo $cal->weekDays[6]['dom']." ".$arrMonthNames["he"][$cal->weekDays[6]['month_num']-1];
                    }
                    echo "</b>";
                    echo " {$cal->year}";
                } else {
                    echo "<b>";
                    echo $arrMonthNames["he"][$cal->weekDays[0]['month_num']-1]." ".$cal->weekDays[0]['dom']." ".$cal->weekDays[0]['year'];
                    echo "-";
                    echo $arrMonthNames["he"][$cal->weekDays[6]['month_num']-1]." ".$cal->weekDays[6]['dom']." ".$cal->weekDays[6]['year'];
                    echo "</b>";
                }

            ?>
        </div>
        <?php//</center>?>
    </div>
    
    <table style="width:100%">
        <tr <?php//bgcolor="#e7e7e7"?>style="background:#e7e7e7">
            <td class="td1"><?=$arrDayNames["he"][0]?></td>
            <td class="td1"><?=$arrDayNames["he"][1]?></td>
            <td class="td1"><?=$arrDayNames["he"][2]?></td>
            <td class="td1"><?=$arrDayNames["he"][3]?></td>
            <td class="td1"><?=$arrDayNames["he"][4]?></td>
            <td class="td1"><?=$arrDayNames["he"][5]?></td>
            <td class="td1_e"><?=$arrDayNames["he"][6]?></td>
        </tr>
        <tr <?php//bgcolor="#f1f1f1"?>style="background:#f1f1f1">
            <?php 
            for ($i=0; $i<7; $i++) {
                $class = ($i==6) ? "td2_e" : "td2";
           ?>
            
            <td class="<?=$class?>" onmouseover="day_over(this)" onmouseout="day_out(this)" onclick="/*day_click(this,'<?php/* echo $cal->weekDays[$i]['date']; */?>')*/">
               
                <?php if (@$arrDatesIndexed[$cal->weekDays[$i]['date']]) { ?><div class="exist"><i class="fa fa-circle e1"></i></div><?php } ?>
                <a href="<?php echo $cfg["WM"]["Server"].'/'.$wm->getIdByPageType(6)."/".$wmPageType.'/'.$cal->weekDays[$i]['date']?>"> 
                    <?php echo $cal->weekDays[$i]['dom']; ?>
                </a>
            </td>  
        
            <?php } ?>
        </tr>
            <?php /*
            <td class="td2"><?=$cal->weekDays[0]['dom']?></td>
            <td class="td2"><?=$cal->weekDays[1]['dom']?></td>
            <td class="td2">
                <div class="exist"><i class="fa fa-circle e1"></i></div>
                <?=$cal->weekDays[2]['dom']?>
            </td>
            <td class="td2"><?=$cal->weekDays[3]['dom']?></td>
            <td class="td2 td2_s">
                <div class="exist"><i class="fa fa-circle e2"></i></div>
                <?=$cal->weekDays[4]['dom']?>
                <div class="spike"><i class="fa fa-caret-down"></i></div>
            </td>
            <td class="td2"><?=$cal->weekDays[5]['dom']?></td>
            <td class="td2_e"><?=$cal->weekDays[6]['dom']?></td>
        </tr> */ ?>
    </table>
    
    <div class="eventsBox" style="display:none">
        <div class="title">סיורים בחדר לידה</div>
        <li><font>שבת גן - בוקר ואקטואליה</font></li>
        <li><font>שבת גן - בוקר ואקטואליה</font></li>
        <li><font>שבת גן - בוקר ואקטואליה</font></li>
        <li><font>שבת גן - בוקר ואקטואליה</font></li>
    </div>
        
<?php if (!$is_param) { ?>
</div>

<script type="text/javascript">
var weekly_events = <?php echo json_encode($arrDatesIndexed); ?>;
var is_sel = null;
function day_over(obj) {
    if (obj==is_sel) return;
    $(obj).addClass("td2_s");
    $(obj).find("i").removeClass("e1").addClass("e2");
}
function day_out(obj) {
    if (obj==is_sel) return;
    $(obj).removeClass("td2_s");
    $(obj).find("i").removeClass("e2").addClass("e1");
}
function day_click(obj,dt) {
    if (is_sel && is_sel!=obj) {
        $(is_sel).removeClass("td2_s");
        $(is_sel).find("i").removeClass("e2").addClass("e1");
    }
    is_sel = obj;
    $("#weeklyCalendar .spike").remove();
    $(obj).append('<div class="spike"><i class="fa fa-caret-down"></i></div>');
    if (typeof(weekly_events[dt])==="undefined") show_no_events();
    else show_events(weekly_events[dt]);
}
function show_no_events() {
    $("#weeklyCalendar .eventsBox").css({display:"block"});
    $("#weeklyCalendar .eventsBox").html('<?php echo "אין אירועים בתאריך זה"; ?>');
}
function show_events(obj) {
    var number_of_events = obj.length, i;
    $("#weeklyCalendar .eventsBox").css({display:"block"});
    $("#weeklyCalendar .eventsBox").html("");    
    for (i=0; i<number_of_events; i++) {
        $("#weeklyCalendar .eventsBox").append('<div class="title"><a href="/'+obj[i].ID+'">'+obj[i].Name+'</a></div>');
        if (obj[i].Sub_Title.length) $("#weeklyCalendar .eventsBox").append('<li><font>'+obj[i].Sub_Title+'</font></li>');
    }
}
</script>
<style>
.weeklyHeader {
    position:relative;
    height:70px;
    background:rgba(52,193,213,0.8);
    -webkit-border-top-left-radius: 7px;
    -webkit-border-top-right-radius: 7px;
    -moz-border-radius-topleft: 7px;
    -moz-border-radius-topright: 7px;
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
}
.weeklyHeader .r {
    position:absolute;
    right:30px;
    top:16px;
}
.weeklyHeader .r i {
    color:#ffffff;
    font-size:36px;
    line-height:36px;
}
.weeklyHeader .l {
    position:absolute;
    left:30px;
    top:16px;
}
.weeklyHeader .l i {
    color:#ffffff;
    font-size:36px;
    line-height:36px;
}
.weeklyHeader .center {
    text-align: center;
    padding-top:18px;
    color:#ffffff;
    font-size:23px;
}
#weeklyCalendar .td1 {
    width:14.2%;
    text-align:center;
    border-left:1px solid #ffffff;
    border-bottom:1px solid #ececec;
    height:40px;
}
#weeklyCalendar .td1_e {        /* end of line */
    width:14.8%;
    text-align:center;
    border-bottom:1px solid #ececec;
}
#weeklyCalendar .td2 { 
    cursor:pointer;
    font-size:21px;
    text-align:center;
    border-left:1px solid #e2e2e2;
    height:100px;
    position:relative;
}
#weeklyCalendar .td2 a, #weeklyCalendar .td2 a:visited, #weeklyCalendar .td2_e a, #weeklyCalendar .td2_e a:visited{
    color: #444444;
}
#weeklyCalendar .td2 .exist {
    position:absolute;
    top:0px;
    left:10px;
}
#weeklyCalendar .td2 .exist .e1 {
    font-size:13px;
    color:rgba(52,193,213,0.8);
}
#weeklyCalendar .td2 .exist .e2 {
    font-size:13px;
    color:#ffffff;
}
#weeklyCalendar .td2 .spike {
    width:100%;
    position:absolute;
    right:0px;
    bottom:-24px;
    font-size:30px;
    color:rgba(52,193,213,0.8);
}
#weeklyCalendar .td2_s {        /* selected */
    background:rgba(52,193,213,0.8);
}
#weeklyCalendar .td2_s a, #weeklyCalendar td2_s.td2_e a{
    color:#ffffff;
}
#weeklyCalendar .td2_e {        /* end of line */
    font-size:21px;
    text-align:center;
    height:100px;
    position:relative;
    cursor:pointer;
}
#weeklyCalendar .td2_e .spike {
    width:100%;
    position:absolute;
    right:0px;
    bottom:-24px;
    font-size:30px;
    color:rgba(52,193,213,0.8);
}

#weeklyCalendar .eventsBox {
    margin-top:14px;
    margin-bottom:10px;
    padding:10px;
    padding-right:20px;
    background:#f1f1f1;
    border-radius:7px;
}
#weeklyCalendar .eventsBox .title {
    font-size:18px;
    color:#555555;
    margin-bottom:5px;
}
#weeklyCalendar .eventsBox li {
    color:rgba(52,193,213,0.8);
    margin-bottom:2px;
}
#weeklyCalendar .eventsBox font {
     color:#555555;
}

/*--------------------------  Laptops ( max 1400 ) --------------------------*/
@media (max-width:1400px){
  
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .weeklyHeader .center{
        font-size: 16px;
        padding-top: 13px;
        max-width: 145px;
        margin: 0 auto;
    }
    
    #weeklyCalendar .td2_e, #weeklyCalendar .td2{
        height: inherit;
    }
    
    #weeklyCalendar{
        margin-bottom: 20px;
        padding: 0px;
    }
    
    #weeklyCalendar .td2 .exist .e1, #weeklyCalendar .td2 .exist .e2{
        font-size: 6px;
    }
    
    #weeklyCalendar .td2 .exist{
        top: -10px;
        <?php echo $gui->getRight();?>: 5px;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    
}
</style>


<?php } ?>
