<?php
header ("Content-Type: application/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php
$menu_str;
$wm->getSitemapimages(HOMEPAGEID);
echo $menu_str;
?>  
</urlset>
