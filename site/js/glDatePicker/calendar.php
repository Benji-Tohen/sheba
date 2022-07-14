<?php
$query = "
			SELECT Start_Date FROM wm_pages a
			WHERE EXISTS(
				SELECT ID FROM wm_pages b
				WHERE Page_Type='77'
				AND a.Parent=b.ID)
			AND Hide_On_Menu=0
			AND Deleted=0
			ORDER BY Start_Date DESC
";
$arrDates = $db->getArray($query);
?>
$(document).ready(function() {
	$('.datePicker').glDatePicker({
	    showAlways: true,
	    allowMonthSelect: false,
	    allowYearSelect: false,
	    prevArrow: ' ',
	    nextArrow: ' ',
		onClick: (function(el, cell, date, data) {
	        updateEvent(date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate());
	    }),
       selectableDates: [
        	<?php foreach ($arrDates as $item){
       			if (strtotime($item['Start_Date']) >= strtotime(date("Y-m-d"))){
       				$selected_date = $item['Start_Date'];
       			}
        		list($year, $month, $day) = explode("-", $item['Start_Date']);
        		echo "{ date: new Date($year, ".intval($month-1).", ".intval($day).") },\n";
        	}?>
	    ],
	    <?php if ($selected_date){
	    	list($year, $month, $day) = explode("-", $selected_date);?>
	    	selectedDate: new Date(<?php echo $year;?>, <?php echo intval($month-1);?>, <?php echo intval($day);?>)
	    <?php }?>
	});
	<?php if ($selected_date){?>
		if (homePage==1) updateEvent("<?php echo "$year-$month-$day";?>");
	<?php }?>
	function updateEvent(date){
	    $.ajax({
	        url: "<?php echo $cfg["WM"]["Server"];?>/ajax/update_event?home="+homePage+"&date="+date,
	        success: function(data){
	        	if (data.substr(0,9) =="redirect:"){
	        		window.location = data.substr(9);
	        	} else {
	            	$(".events").html(data);
	            }
	        }
	    });
	}
});
