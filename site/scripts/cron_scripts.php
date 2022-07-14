<?php 
//$forceCron=($_REQUEST["page"]?true:false);
$forceCron=false;

//	Scripts that will run every X time 
if(!$_SESSION["cron_updated"] || $forceCron){

	$cronDailyLast=		intval($params->getValue("cron_daily_last_timestamp"));
	$cronHourlyLast=	intval($params->getValue("cron_hourly_last_timestamp"));
	$cronHalfdayLast=	intval($params->getValue("cron_halfday_last_timestamp"));

	if(TIME>($cronDailyLast+60*60*24) || $forceCron){
		require_once('cron_daily.php');
		$params->setParameter("cron_daily_last_timestamp", TIME);
	}

	if(TIME>($cronHalfdayLast+60*60*12) || $forceCron){
		require_once('cron_halfday.php');
		$params->setParameter("cron_halfday_last_timestamp", TIME);
	}

	if(TIME>($cronHourlyLast+60*60) || $forceCron){
		require_once('cron_hour.php');
		$params->setParameter("cron_hourly_last_timestamp", TIME);
	}
	

	$_SESSION["cron_updated"]=true;
}
?>
