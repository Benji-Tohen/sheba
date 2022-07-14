<?php 
function getTimestamp($date){
	list($y,$m,$d)=explode("-", $date);
	return mktime(0,0,0,$m,$d,$y);
}

$query="SELECT * 
	FROM wm_pages 
	WHERE rss=1 AND Deleted=0 
	ORDER BY Start_Date DESC";
$arr=$db->getArray($query);

header ("Content-Type: application/xml");
echo "<?xml version=\"1.0\"?>";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <atom:link href="<?php echo $cfg["WM"]["Server"];?>/rss/" rel="self" type="application/rss+xml" />
    <title><?php echo $params->getValue("rss_title");?></title>
    <link><?php echo $cfg["WM"]["Server"];?></link>
    <description></description>
    <language>he-il</language>
    <pubDate><?php echo date('D, d M Y H:i:s ', time()-15000);?>GMT</pubDate>
    <lastBuildDate><?php echo date('D, d M Y H:i:s ', time()-15000);?>GMT</lastBuildDate>
    <docs><?php echo $cfg["WM"]["Server"];?>/rss/</docs>
    <generator>Tohen Media - WebMaster Pro</generator>
<image>
	<url><?php echo $cfg["WM"]["Server"];?>/webfiles/header_settings/1/logo.png</url>
	<title><?php echo $params->getValue("rss_title");?></title>
	<link><?php echo $cfg["WM"]["Server"];?></link>
</image>
<?php foreach($arr as $item){?> 
    <item>
      <title><?php echo $item["Name"];?></title>
      <link><?php echo $cfg["WM"]["Server"];?>/<?php echo $item["Alias"]?$item["Alias"]:$item["ID"];?>/</link>
      <description><?php echo $item["Sub_Title"];?></description>
      <pubDate><?php echo date('D, d M Y H:i:s ', getTimestamp($item["Start_Date"]));?>GMT</pubDate>
      <guid><?php echo $cfg["WM"]["Server"];?>/<?php echo $item["ID"];?>/</guid>
    </item>
<?php }?>
  </channel>
</rss>
