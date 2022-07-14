<?php
class obj extends ArrayObject {                                                 // used by admin translation
    public function offsetSet($i, $v) { parent::offsetSet($i, $v); }
    public function offsetGet($i) { return (parent::offsetExists($i)) ? parent::offsetGet($i) : $i; }
}

class WebMaster extends TreeData{

	var $page_type_table;
	function WebMaster($db, $table, $page_type_table=NULL){
		$this->db =	$db;
		$this->table =	$table;
		$this->page_type_table=	"wm_pagetype";	
        $this->db->connect();
        $this->pagesToArchive = [];
	}
	
	
	/*****************************************
	*	Adds an inheriting child (duplicate)
	*****************************************/
	function add($parent=1, $newName="Untitled", $inherit=false, $sameParent=false){
		if($inherit){
			$row_defaults=$this->getValues($parent);
			$arrFields=array();

		}
		if($sameParent){
			$parent=$sameParent;
		}
		$arrFields["Parent"]=		$parent;
		$arrFields["Name"]=		$newName;
		$arrFields["Ordering"]=		0;
		$arrFields["Lang"]=		$row_defaults["Lang"];

		if($this->table=="wm_pages_versions"){
			$arrFields["wm_pages"]=0;
		}else{
			$arrFields["wm_pages_versions"]=0;
		}

				
		if(strcmp($newName, "Untitled")!=0){
			//$itemID=$this->db->getExistQuery("SELECT ID FROM ".$this->table." WHERE Parent=".intval($parent)." AND Name='".$newName."'");
		}
		


		if(!$itemID){
			$itemID=$this->db->updateData($this->table, $arrFields);
		}
			
		return $itemID;
	}	


	function duplicate($parent=1, $newName="Untitled"){
	
		$row_defaults=$this->getValues($parent);
		$arrFields=array();
		if(is_array($row_defaults)){
			foreach($row_defaults as $field => $value){
				if(strcmp($field, "ID")==0){
					continue;
				}
				$arrFields[$field]=$value;
			}
		}

		$arrFields["Name"]=		$newName;
		$arrFields["Menu_Name"]=	$newName;
		$arrFields["Alias"]=		NULL;
		
		
		if(!$itemID){
			$itemID=$this->db->updateData($this->table, $arrFields);
		}
			
		return $itemID;
	}

	function getHomePageById($id){
		$pageType=$this->getPageType($id);

		if($id==0){
			return false;
		}

		if($pageType["ID"]==5){
			return $id;
		}
		
		$parent=$this->getParent($id);
		
		return $this->getHomePageById($parent);
	}

	function getHomePageByDomain($domain){
		return $this->db->getField("SELECT ID FROM ".$this->table." WHERE domain='".mysqli_real_escape_string($this->db->conn, $domain)."'", "ID");
	}
	
	function getHomePageByLang($lang){
		return $this->db->getField("SELECT ID FROM ".$this->table." WHERE Parent=1 AND Deleted=0 AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."'", "ID");
	}
	
	function getLastField($id, $field){
		if($id==0){
			return NULL;
		}
		$field=$this->get($id, $field);
		if(!$field){
			return $this->getLastField($this->getParent($id), $field);
		}
		
		return $field;
	}
	
	function getPageTypes($admin_enable=1){
		global $login;

		$query="SELECT * FROM ".$this->page_type_table;
		$query.=" WHERE (Admin_Level=0 OR Admin_Level>=".$login->getLevel().")";
		if($admin_enable){
			$query.=" AND Admin_Enable=1";
		}
		$query.=" ORDER BY Ordering";

		return $this->db->getArray($query);
	}
	
	function getPageType($id,$useSecondary=false){
		/*if $useSecondary is true - send back Secondary page type else send default page type*/
		if($useSecondary){
			$secondaryPageType = $this->db->getRow("SELECT Secondary_Page_Type FROM wm_pages WHERE ID=$id");
			if($secondaryPageType['Secondary_Page_Type']>0){/*we have a secondary page type!*/
				return $this->db->getRow("SELECT * FROM ".$this->page_type_table." WHERE ID=".$secondaryPageType['Secondary_Page_Type']);
			}
		}
		if(intval($id)>0){
			return $this->db->getRow("SELECT * FROM ".$this->page_type_table." WHERE ID=".$this->get($id, "Page_Type"));
		}else{
			return;
		}
	}
	
	function getProperty($id, $field_name){
		$row=$this->getPageType($id);
		return $row[$field_name];
	}
	
	function getParentProperty($id, $field_name){
		$property=$this->getProperty($this->getParent($id), $field_name);
		if(!$property){
			$property=0;
		}
		return $property;
	}
	
	function getFirstChild($id){
		return $this->db->getField("SELECT ID FROM ".$this->table." WHERE Deleted=0 AND Ordering=(SELECT MIN(Ordering) FROM ".$this->table." WHERE Deleted=0 AND Parent=".intval($id).") AND Parent=".intval($id), "ID");
	}

	function getFirstChildAlias($id){
		$id=$this->getFirstChild($id);
		$alias=$this->get($id, "Alias");
		return ($alias?$alias:$id);
	}
	
	function getLangMain($lang){
		return $this->db->getField("SELECT ID FROM ".$this->table." WHERE Deleted=0 AND Lang='".$lang."' AND Parent=1", "ID");	
	}
	
	function getLanguagesArray(){
		return $this->db->getArray("SELECT ID, Lang FROM ".$this->table." WHERE Deleted=0 AND Parent=1 ORDER BY Name");
	}
	
	function getLanguagesArrayList(){
		if(!empty($_SESSION["avail_languages"])){
			return $_SESSION["avail_languages"];
		}
		
		$_SESSION["avail_languages"]=$this->db->getArrayForField("SELECT Lang FROM ".$this->table." WHERE Deleted=0 AND Parent=1 ORDER BY Lang", "Lang");
		return $_SESSION["avail_languages"];
	}

	function getLanguagesMenu($id=NULL){
		global $text;
		global $cfg;

		$str="";
		$arr=$this->getLanguagesArray();
		for($i=0;$i<count($arr);$i++){
			if($arr[$i]["ID"]==$id){
				continue;
			}
			//$str.="<div class=\"lang_menu_item\"><a href=\"?p=".$arr[$i]["ID"]."\">".$text[$arr[$i]["Lang"]]."</a></div>";
			$str.="<div class=\"lang_menu_item\"><a href=\"".$cfg["WM"]["Server"]."/".$arr[$i]["ID"]."\">".$text[$arr[$i]["Lang"]]."</a></div>";
		}
		
		return $str;
	}
	

	function getNewsList($id=null, $order="Start_Date DESC, Start_Time DESC, Name", $limit=null){
		$query="SELECT ID, Name, h1, Sub_Title, External_Sub_Title, custom_class, Alias, Video_Embed, Content, Content_Center, Link, Open_In, Author, Top_Header, Top_Header_Alt, Top_Header2, File_Name, Comments, Start_Date, Lang, Conversion, Page_Type, search_only_specialist_doctors FROM ".$this->table." WHERE Deleted=0 AND Parent=".intval($id)." AND Hide_On_Menu=0 ORDER BY ".$order." ".$limit;
		//echo $query;
		return $this->db->getArray($query);
	}

    function getNewsListNoLamp($id=null, $order="Start_Date DESC, Start_Time DESC, Name", $limit=null){
        $query="SELECT ID, Name, Sub_Title, Content, Alias, Link, Open_In, Author, Top_Header, Top_Header2, File_Name, Comments, Start_Date FROM ".$this->table." WHERE Deleted=0 AND Parent=".intval($id)." ORDER BY ".$order." ".$limit;
        return $this->db->getArray($query);
    }

    //For which item the "news" red light is on, the function gets items by parent ID
    function getFeaturedNews($id=null, $limit=null){
        $query="SELECT ID, Name, Sub_Title, Content, Video_Embed, Video_Text, Alias, Link, Open_In, Top_Header, Top_Header2, File_Name, Start_Date FROM ".$this->table." WHERE Deleted=0 AND Parent=".intval($id)." AND ShowOnHomepage=1 ORDER BY Ordering LIMIT ".$limit;
        return $this->db->getArray($query);
    }

	function getNewsContent($lang="he", $order="Start_Date DESC, Start_Time DESC, Name", $limit=null){
		$query="SELECT * FROM ".$this->table." WHERE ShowOnHomepage=1 AND Deleted=0 AND Hide_On_Menu=0 and Lang='".$lang."' ORDER BY ".$order." ".$limit;
		
		return $this->db->getArray($query);
	}
	
	function getNews($id, $limit=NULL){
		return $this->getNewsList($id, "Start_Date DESC, Start_Time DESC, Name", $limit);
	}
	
	function getOrderingNews($id, $limit=NULL){
		return $this->getNewsList($id, "Ordering", $limit);
	}

    function getOrderingNewsNoLamp($id, $limit=NULL){
        return $this->getNewsListNoLamp($id, "Ordering", $limit);
    }

	function getItems($id, $limit=NULL){
		$pageType=$this->getPageType($id);
		return $this->getNewsList($id, $pageType["order_by"], $limit);
	}

    function getArchiveItems($id, $limit=NULL,$year=NULL){
        $pageType=$this->getPageType($id);
        return $this->getArchiveNewsList($id, $pageType["order_by"], $limit, $year);
    }

    function getArchiveNewsList($id=null, $order="Start_Date DESC, Start_Time DESC, Name", $limit=null, $year=null){
        $query="SELECT ID, Name, Sub_Title, Video_Embed, Content, Content_Center, Alias, Link, Open_In, Author, Top_Header, Top_Header2, File_Name, Comments, Start_Date FROM ".$this->table." WHERE Deleted=0 AND Parent=".intval($id)." AND Hide_On_Menu=0 AND UPPER(DATE_FORMAT(`Start_Date`,'%M %Y'))='".$year."' ORDER BY ".$order." ".$limit;
        return $this->db->getArray($query);
    }

	function getNewsListPager($id=null, $order="Start_Date DESC, Start_Time DESC, Name", $numItems=10){
		$sp=new SuperPager($this->db, "FROM ".$this->table, "*", "WHERE Deleted=0 AND Parent=".intval($id)." AND Hide_On_Menu=0", "", " ORDER BY ".$order, $numItems);
		return $sp;		
	}
	
	function getNewsPager($id, $numItems=10){
		return $this->getNewsListPager($id, "Start_Date DESC, Start_Time DESC, Name", $numItems);
	}
	
	function getOrderingNewsPager($id, $numItems=10){
		return $this->getNewsListPager($id, "Ordering", $numItems);	

	}
	
	function getFolderPage($id){
		return $this->db->getArray("SELECT * FROM ".$this->table." WHERE Deleted=0 AND Parent=".intval($id)." ORDER BY Ordering");
	}	

    function getSitempMenu($id, $deep=0){

		global $cfg;
		global $menu_str;
		global $string;
		
		$query="SELECT ID, Alias, Name, Link FROM wm_pages WHERE Hide_on_Menu=0 AND Deleted=0 AND Parent=".intval($id);
		$arr_menu=$this->db->getArray($query);
		$numItems=count($arr_menu);

		if(empty($arr_menu)){
			return;
		}


		$menu_str.="<ul>";

		for($i=0;$i<$numItems;$i++){
			
			$page_type=$this->getPageType($arr_menu[$i]["ID"]);

			if(!$arr_menu[$i]["Hide_On_Menu"] || $arr_menu[$i]["Page_Type"]==5){

				$link=$this->getLink($arr_menu[$i]);		

				if($arr_menu[$i]["Page_Type"]==5){
					if($arr_menu[$i]["Lang"]==$cfg["WM"]["Default_Language"]){
						$link["Link"]=$cfg["WM"]["Server"];
					}else{
						$link["Link"]=$cfg["WM"]["Server"]."/".$arr_menu[$i]["Lang"];
					}
				}


				if(strpos($link["Link"], $_SERVER["SERVER_NAME"])===false || $arr_menu[$i]["noindex"]){

				}else{			
					$menu_str.="
<li".($deep==0?" class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\"":"")."><a href=\"".$link["Link"]."\" title=\"".$string->htmlentities($arr_menu[$i]["Name"])."\">".$arr_menu[$i]["Name"]."</a>";
				}
				
			}

			

//			if(!$page_type || $page_type["ShowChildrenOnMenu"]){
				$menu_str.=$this->getSitempMenu($arr_menu[$i]["ID"], ($deep+1));
//			}


				$menu_str.="</li>";
		}
		$menu_str.="</ul>";
	}
    
	function getMainMenu($local_id, $deep=0){
		global $menu_str;
		global $id;
		global $cfg;
		global $string;

		$arr_menu=$this->getArray($local_id, " AND Deleted=0 ORDER BY Ordering", "ID, Name, Menu_File, Hide_On_Menu, Alias");

			
		for($i=0;$i<count($arr_menu);$i++){
			
			if(!$this->userAllowed($arr_menu[$i]["ID"])){
				continue;
			}

			if($arr_menu[$i]["Hide_On_Menu"]){
				continue;
			}

	
			//$topParent=			$this->getTopParentAfterRoot($id);
			
			
			$page_type=			$this->getPageType($arr_menu[$i]["ID"]);
			
			$show=(($arr_menu[$i]["ID"]==$id || $this->getParent($id)==$this->getParent($arr_menu[$i]["ID"]) || $this->getParent($arr_menu[$i]["ID"])==$id)?"_show":"");
			
			if($arr_menu[$i]["ID"]==$id && $deep>=0){
				$show="_selected";
			}
			
			if($page_type["ShowOnMenu"]){
				//$menu_str.="\r\n<table cellpadding=\"0\" cellspacing=\"0\" class=\"menu_item_".$deep.$show."\">";
				//$menu_str.="\r\n<tr>";					
				//$menu_str.="\r\n\t<td>";
			
				$menu_str.="\r\n<div class=\"menuItem_".$deep.$show.$hide."\">";

/*
				if($page_type["GotoFirstChild"] && $this->hasChildren($arr_menu[$i]["ID"])){
					$menu_str.="<a href=\"".$cfg["WM"]["Server"]."/".$this->getFirstChild($arr_menu[$i]["ID"])."\">".$arr_menu[$i]["Name"]."</a>";					
				}elseif($page_type["Redirect"]){
					$menu_str.="<a href=\"".$cfg["WM"]["Server"]."/".$page_type["Redirect"]."\">".$page_type["Name"]."</a>";									
				}else{
					if($arr_menu[$i]["Alias"]){
						$link=$cfg["WM"]["Server"]."/".$arr_menu[$i]["Alias"];
					}else{
						$link=$cfg["WM"]["Server"]."/".$arr_menu[$i]["ID"];
					}
					$menu_str.="<a href=\"".$link."\">".$string->htmlentities($arr_menu[$i]["Name"])."</a>";
				}
*/

				$menu_str.="<a href=\"".$link["Link"]."\" target=\"".$link["target"]."\">".$string->htmlentities($arr_menu[$i]["Name"])."</a>";

				$menu_str.="</div>";
				//$menu_str.="</td>";
				//$menu_str.="\r\n</tr>";
				//$menu_str.="\r\n</table>";
			}
			if(!$page_type || $page_type["ShowChildrenOnMenu"]){
				$menu_str.=$this->getMainMenu($arr_menu[$i]["ID"], ($deep+1));
			}
		}
	}

	function getSitemap($id=null, $deep=0){
		global $cfg;
		
		// Get pages for sitemap
		$arr = [];
		$this->getChildrenRecursiveIDs($arr, $id);
		$subdomainIds=implode(",", $arr);		
		$query="SELECT ID, 
						Name, 
						UpdatedTime, 
						Alias,
						Page_Type, 
						Link,
						Top_Header,
						Lang 
				FROM wm_pages 
				WHERE Deleted = 0 
				AND noindex = 0 
				AND Hide_On_Menu = 0
				AND ID IN($subdomainIds)";
		$pagesArr=$this->db->getArray($query);

		$sitemapContent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$sitemapContent .= "<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.9\"	xmlns:image=\"http://www.google.com/schemas/sitemap-image/1.1\">";

		$priority = "0.5";

        foreach ($pagesArr as $pageKey => $pageArr) {
            $pageLinkArr = $this->getLink($pageArr);

            if($pageArr["Page_Type"]==5){
                if($pageArr["Lang"]==$cfg["WM"]["Default_Language"]){
                    $pageLinkArr["Link"]=$cfg["WM"]["Server"];
                } else {
                    $pageLinkArr["Link"]=$cfg["WM"]["Server"]."/".$pageArr["Lang"];
                }
            }

            if(
				strpos($pageLinkArr["Link"], $_SERVER["HTTP_HOST"]) != false
				&& $pageArr["Link"] == ''
			){
                $sitemapContent .= "
                   <url>
                    <loc>".str_replace('&', '&amp;', strip_tags($pageLinkArr["Link"]))."</loc>
                    <lastmod>".date("Y-m-d", $pageArr["UpdatedTime"])."</lastmod>
                    <changefreq>weekly</changefreq>
                    <priority>".$priority."</priority>
                    ";

                if($pageArr["Top_Header"]){
                	$sitemapContent .= "<image:image>
									      <image:loc>".$cfg["WM"]["Server"].'/'.$pageArr["Top_Header"]."</image:loc>
									    </image:image>
									    ";
                }

                $sitemapContent .= "</url>";
            }
        }

        $sitemapContent .= "</urlset>";

        return $sitemapContent;
	}




	function getSitemapImages($id, $deep=0){
		global $cfg;
		global $menu_str;
		
		//$arr_menu=$this->getArray($id, " ORDER BY Ordering", "ID, Name, UpdatedTime, Alias, Top_Header, Top_Header2, noindex, Lang");
		
		$arr=array();

		$this->getChildrenRecursiveIDs($arr, $id);
		$subdomainIds=implode(",", $arr);		
		$query="SELECT ID, Name, UpdatedTime, Alias, Top_Header, Top_Header2, noindex, Lang FROM wm_pages WHERE Deleted=0 AND noindex=0 AND ID IN($subdomainIds)";
		$arr_menu=$this->db->getArray($query);




		$numItems=count($arr_menu);

		for($i=0;$i<$numItems;$i++){
			
			$page_type=$this->getPageType($arr_menu[$i]["ID"]);
			if($page_type["ShowOnMenu"]){
			
				if($page_type["GotoFirstChild"]){
					$link_id=$this->getFirstChild($arr_menu[$i]["ID"]);
				}elseif($page_type["Redirect"]){
					$link_id=$page_type["Redirect"];
				}else{
					$link_id=$arr_menu[$i]["ID"];
				}
/*
				if($arr_menu[$i]["Alias"]){
					$link=$cfg["WM"]["Server"]."/".$arr_menu[$i]["Alias"];
				}else{
					$link=$cfg["WM"]["Server"]."/".$link_id;
				}
*/
				$link=$this->getLink($arr_menu[$i]);
				


$query="SELECT * FROM wm_pages_gallery WHERE wm_pages=".intval($arr_menu[$i]["ID"]);
$arrImages=$this->db->getArray($query);

if($arr_menu[$i]["Top_Header"]){
	$topHeader=array(
		"File_Name"	=>	$arr_menu[$i]["Top_Header"],
		"Name"		=>	$arr_menu[$i]["Name"]
	);
	array_push($arrImages, $topHeader);
}

if($arr_menu[$i]["Top_Header2"]){
	$topHeader=array(
		"File_Name"	=>	$arr_menu[$i]["Top_Header2"],
		"Name"		=>	$arr_menu[$i]["Name"]
	);
	array_push($arrImages, $topHeader);
}

if(!$arr_menu[$i]["noindex"] && !empty($arrImages)){


	$menu_str.="
	<url>
		<loc>".$link["Link"]."</loc>
	";

	foreach($arrImages as $image){
		$menu_str.="
			<image:image>
				<image:loc>".$cfg["WM"]["Server"]."/".$image["File_Name"]."</image:loc>
				<image:title><![CDATA[".$image["Name"]."]]></image:title>
		";
		if($image["Content"]){
			$menu_str.="
				<image:caption><![CDATA[".$image["Content"]."]]></image:caption>
			";
		}


		$menu_str.="
			</image:image>
		";
	}

	$menu_str.="
	</url>
					";
}		

				
			}
//			if(!$page_type || $page_type["ShowChildrenOnMenu"]){
				//$menu_str.=$this->getSitemapImages($arr_menu[$i]["ID"], ($deep+1));
//			}
		}
	}



	function getMobileSitemap($id, $deep=0){
		global $cfg;
		global $menu_str;

		
		
		$arr_menu=$this->getArray($id, " AND Deleted=0 ORDER BY Ordering", "ID, Name, UpdatedTime, Alias, Hide_On_Menu, noindex");
		for($i=0;$i<count($arr_menu);$i++){
			
			$page_type=$this->getPageType($arr_menu[$i]["ID"]);



			if(!$arr_menu[$i]["Hide_On_Menu"] && !$arr_menu[$i]["noindex"]){
				$query="SELECT ID, Name, Alias, Link, Open_In FROM wm_pages WHERE ID=".intval($arr_menu[$i]["ID"]);
				$pageData=$this->db->getRow($query);
				$link=$this->getLink($pageData);

				$menu_str.="
				   <url>
					<loc>".$link["Link"]."</loc>
					<lastmod>".date("Y-m-d", $arr_menu[$i]["UpdatedTime"])."</lastmod>
					<changefreq>weekly</changefreq>
					<priority>0.5</priority>
				   </url>			
				";
				
			}
//			if(!$page_type || $page_type["ShowChildrenOnMenu"]){
				$menu_str.=$this->getMobileSitemap($arr_menu[$i]["ID"], ($deep+1));
//			}
		}
	}

	function getSitemapHTML($id, $deep=0){
		global $cfg;
		global $menu_str;
		
		$arr_menu=$this->getArray($id, " AND Deleted=0 ORDER BY Ordering", "ID, Name, Hide_On_Menu, Alias, Hide_On_Menu");
		for($i=0;$i<count($arr_menu);$i++){
			
			$page_type=$this->getPageType($arr_menu[$i]["ID"]);
			if($page_type["ShowOnMenu"] && !$arr_menu[$i]["Hide_On_Menu"]){
			
				if($page_type["GotoFirstChild"]){
					$link_id=$this->getFirstChild($arr_menu[$i]["ID"]);
				}elseif($page_type["Redirect"]){
					$link_id=$page_type["Redirect"];
				}else{
					$link_id=$arr_menu[$i]["ID"];
				}

				if($arr_menu[$i]["Alias"]){
					$link=$arr_menu[$i]["Alias"];
				}else{
					$link=$link_id;
				}
				
				$menu_str.="\r\n<div style=\"padding-right: ".($deep*10)."px; margin-bottom: 3px; ".($deep==0?"margin-top: 10px; font-size: 14px;":"")."\" class=\"sitemapItem\"><a style=\"".($deep==0?"color: #993300 !important;":"")."\" href=\"".$cfg["WM"]["Server"]."/".$link."\">".$arr_menu[$i]["Name"]."</a></div>";
				
			}
//			if(!$page_type || $page_type["ShowChildrenOnMenu"]){
				$menu_str.=$this->getSitemapHTML($arr_menu[$i]["ID"], ($deep+1));
//			}
		}
	}			
	
	function getSearchArr($searchKey, $lang, $limit=false){
		
		if(!$searchKey){
			return array();
		}
		
		$searchKey=trim($searchKey);
		
		$query="SELECT page.ID, page.Name, page.Sub_Title, page.Page_Type, par.Page_Type AS ParentType, page.File_Name, page.Comments, page.Top_Header, page.Lang  
			FROM wm_pages page
			INNER JOIN wm_pages par ON par.ID=page.Parent
			WHERE page.Deleted=0 AND page.Hide_On_Menu=0 ";
				
		if($lang){
			$query.=" AND page.Lang='".$lang."'";
		}
		
		$searchKeysArr=	explode(" ", $searchKey);
		foreach($searchKeysArr as $val){
			if($val==""){
				continue;
			}
			$query.=" AND (
						page.Name LIKE '%".mysqli_real_escape_string($this->db->conn, $val)."%' OR
						page.Content LIKE '%".mysqli_real_escape_string($this->db->conn, $val)."%' OR
						page.Sub_Title LIKE '%".mysqli_real_escape_string($this->db->conn, $val)."%'
					 )
			";
		}

		if ($limit) $query .= " $limit";
		
		return $this->db->getArray($query);
	}

	function getBottomMenuId($lang){
		$query="
			SELECT ID 
			FROM wm_pages 
			WHERE Deleted=0 AND Parent=".HOMEPAGEID." AND Page_Type=33 
			LIMIT 0,1
		";
		return $this->db->getField($query, "ID");
	}

	function getBottomLinks($id, $selectedID=0, $deep=0){
		global $cfg;
		global $menu_str;
		
		$arr_menu=$this->getArray($id, " AND Deleted=0 ORDER BY Ordering", "ID, Name, Hide_On_Menu, Alias, Link, Open_In ");
		for($i=0;$i<count($arr_menu);$i++){
			if($arr_menu[$i]["Hide_On_Menu"]){
				continue;
			}		
			$page_type=$this->getPageType($arr_menu[$i]["ID"]);
			if($page_type["ShowOnMenu"]){
				$query="SELECT ID, Name, Alias, Link, Open_In FROM wm_pages WHERE ID=".intval($arr_menu[$i]["ID"]);
				$pageData=$this->db->getRow($query);
				$link=$this->getLink($pageData);

				if(!$link["Target"]){
					$link["Target"]="_self";
				}


				$menu_str.="&nbsp;&nbsp;<a href=\"".$link["Link"]."\"";
				if ($arr_menu[$i]["ID"]==$selectedID) {$menu_str.=" class=\"selected\"";}
				$menu_str.=" title=\"".$arr_menu[$i]["Name"]."\" target=\"".$link["Target"]."\">".$arr_menu[$i]["Name"]."</a>&nbsp;&nbsp;|";
			}
//			if(!$page_type || $page_type["ShowChildrenOnMenu"]){
			if($page_type["ID"]==2){
				$menu_str.=$this->getBottomLinks($arr_menu[$i]["ID"], ($deep+1));
			}
//			}
		}
	}	
	
	function getMainMenuList($id, $deep=0){
		global $menu_str;
		$arr_menu=$this->getArray($id, " AND Deleted=0 ORDER BY Ordering", "ID, Name, Hide_On_Menu");
		
		
		$menu_str.="\r\n\t";
		$menu_str.="<ul>";
		
		for($i=0;$i<count($arr_menu);$i++){
			$page_type=			$this->getPageType($arr_menu[$i]["ID"]);
			
			if($this->hasChildren($arr_menu[$i]["ID"])){
				//$menu_str.="\r\n\t";
				//$menu_str.="<ul>";

				$menu_str.="\r\n\t\t";
				//$menu_str.="<li><a class=\"drop\" href=\"?p=".$arr_menu[$i]["ID"]."\">".$arr_menu[$i]["Name"]."<!--[if IE 7]><!--></a><!--<![endif]-->
				$menu_str.="<li><a class=\"drop\" href=\"#\">".$arr_menu[$i]["Name"]."<!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->";
				$menu_str.=$this->getMainMenuList($arr_menu[$i]["ID"], ($deep+1));
				$menu_str.="<!--[if lte IE 6]></td></tr></table></a><![endif]-->";
				$menu_str.="\r\n\t\t";	
				$menu_str.="</li>";
			}else{
				$menu_str.="\r\n\t\t";
				$menu_str.="<li";
				if($i==count($arr_menu)-1){
					$menu_str.=" class=\"last\"";
				}
				$menu_str.="><a href=\"".$cfg["WM"]["Server"]."/".$arr_menu[$i]["ID"]."\">".$arr_menu[$i]["Name"]."</a></li>";			
			}
		}
		
		$menu_str.="\r\n\t";
		$menu_str.="</ul>";
		
	}
	
	function getNavigator($id, $str="", $saperator="&gt;",$formName=NULL){
		global $cfg;
		global $string;
		global $wmPage;
		global $topLangId;



		$query=		"SELECT ID, Parent, Page_Type, Name, Alias, Link, Open_In, Hide_On_Menu, Lang FROM wm_pages WHERE ID=".intval($id);
		$pageData=	$this->db->getRow($query);
		$parent=	$pageData["Parent"];
		$pageType=	$pageData["Page_Type"];
		$pageHidden=	$pageData["Hide_On_Menu"];
		$page_name=	$string->htmlentities($pageData["Name"]);


		

		if($parent==0){
			
			$str=explode("___", $str);
			$str=array_reverse($str);
			$str=implode("___", $str);
			$str=str_replace("___", " $saperator ", $str);

			return $str;
		}
		

		//if(isset($topLangId) && $id==$topLangId){
			$link=$this->getLink($pageData);
		//}
		

		$pageType=$this->getPageType($id);



		if($pageType["showOnBreadcrumbs"]){
			if($this->getParent($parent)==0){
				$str.= "<a href=\"".$link["Link"]."\">".$page_name."</a>";
			}else{
				if($formName!=NULL){
					$str.= "$formName";
				}
				else if($pageHidden || $id==$wmPage["ID"]){
					$str.= "$page_name";
				}else{
					$str.= "<a href=\"".$link["Link"]."\">".$page_name."</a>";
				}			
		
				$str.="___";					
			}
		}

		return $this->getNavigator($parent, $str, $saperator);
	}

	function getIphoneNavigator($idIn, $str="", $saperator="&gt;"){
		global $cfg;
		global $id;

		$page_name=	$this->get($idIn, "Name");
		$pageHidden=	$this->get($idIn, "Hide_On_Menu");
		$pageAlias=	$this->get($idIn, "Alias");
		$parent=	$this->getParent($idIn);
		$pageType=	$this->get($idIn, "Page_Type");
		$parentPageType=	$this->get($parent, "Page_Type");

		if($parent==0){
			$str=explode("___", $str);
			$str=array_reverse($str);
			$str=implode("___", $str);
			$str=str_replace("___", " $saperator ", $str);

			return trim($str, $saperator);			

			return $str;
		}
		
		if($pageAlias){
			$link=$cfg["WM"]["Server"]."/".$pageAlias;
		}else{
			$link=$cfg["WM"]["Server"]."/".intval($idIn);
		}

		if($pageType!=1){	//$idIn==$id){
			if($this->getParent($parent)==0){
				if($pageHidden){
					$str.= "$page_name";
				}else{
					$str.= "<a href=\"".$link."\" title=\"".$page_name."\">".$page_name."</a>";
				}
			}else{

				if($pageHidden){
					$str.= "$page_name";
				}else{
					$str.= "<a href=\"".$link."\" title=\"".$page_name."\">".$page_name."</a>";
				}			
			
				$str.="___";
									
			}
		}

		if($pageType==53){
			
			$str=trim($str, "___");
			$str=explode("___", $str);
			$str=array_reverse($str);
			$str=implode("___", $str);
			$str=str_replace("___", " $saperator ", $str);
			
			return $str;
		}
		
		return $this->getIphoneNavigator($parent, $str, $saperator);
	}


	function getMenuLevel($id){
		return $this->getArray($id, " AND Deleted=0 ORDER BY Ordering", "ID, Name, Sub_Title, Hide_On_Menu, Alias, Link, Page_Type, Top_Header, Content_Center, Video_Embed, Open_In, Enable_Dropdown, Enable_SideContent, Lang");
	}


	function getMainDomains($id){
		return $this->getArray($id, " AND Deleted=0 ORDER BY Ordering", "ID, domain");
	}


	function getShowenMenuLevel($id){
		return $this->getArray($id, " AND Page_Type NOT IN(158) AND Deleted=0 AND Hide_On_Menu=0 ORDER BY Ordering", "ID , Parent, Name, Sub_Title, Hide_On_Menu, Alias, Link, Page_Type, Top_Header, Content_Center, Video_Embed, Open_In, Enable_Dropdown, Enable_SideContent, Lang, show_in_block, Ordering , Deleted");
    }
    
    function getShowenChildren($id){
		return $this->getArray($id, " AND Deleted=0 AND Hide_On_Menu=0 ORDER BY Ordering", "ID , Parent, Name, Sub_Title, Hide_On_Menu, Alias, Link, Page_Type, Top_Header, Content_Center, Video_Embed, Open_In, Enable_Dropdown, Enable_SideContent, Lang, show_in_block, Ordering , Deleted");
	}




	function getItemsByPageType($pageType, $lang=NULL){
		$homepageItemsId=$this->getIdByPageType($pageType, $lang);
		$query="
			SELECT * 
			FROM wm_pages 
			WHERE Parent=".intval($homepageItemsId)." AND Deleted=0 AND Hide_On_Menu=0 
			ORDER BY Ordering
		";

		$itemsArray=$this->db->getArray($query);
/*
		$length=count($itemsArray);
		for($i=0;$i<$length;$i++){
			$link=$this->getLink($itemsArray[$i]);
			$itemsArray[$i]["Link"]=$link;

		}
*/
		return $itemsArray;
	}

	function getHomePageBanners($lang){
		return $this->getItemsByPageType(76, $lang);
	}

	function getHomePageItems($lang){
		return $this->getItemsByPageType(60, $lang);
	}
	

	
	/**************************************************************************
		Admin	
	**************************************************************************/
	
	/*
		Delete related records from other tables
	*/
	function deleteRelatedRecords($id){
		$related_table=$this->getProperty(intval($id), "Related_Table");
		if(!$related_table){
			$related_table=$this->getProperty($this->getParent(intval($id)), "Related_Table");
		}
		if(!$related_table){
			return;
		}
		
		$this->db->runQuery("DELETE FROM ".$related_table." WHERE ".$this->table."=".intval($id));
	}
	
	/*****************************************
	*	Delete Leaf & Children
	*****************************************/
	function delete($id, $cond=""){
		global $cfg;
		return $this->delete_both($id, "", false);
	}

    /*
	function archive($id, $cond=""){
		$archiveDate=time();
		return $this->archive_both($id, "", false, $archiveDate);
    }
    */
    
	function archive_both($id, $cond="", $only_children=true, $archiveDate){
		$query="SELECT * FROM ".$this->table." WHERE Parent=".$id.$cond;
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$this->archive_both($arr[$i]["ID"], $cond, $only_children, $archiveDate);
		}
		if($only_children){
			return true;
		}
		$query="UPDATE ".$this->table." SET Deleted=".$archiveDate.", Hide_On_Menu=1 WHERE ID=".$id.$cond;

		$this->db->runQuery($query);
		return true;
    }

    function archive($id, $cond=""){
        $this->pagesToArchive = [];
		$archiveDate=time();
        $this->collectPagesToArchive($id, "", false, $archiveDate);
        
        $query="UPDATE ".$this->table." SET Deleted=".$archiveDate.", Hide_On_Menu=1 WHERE ID IN (".implode(',', $this->pagesToArchive).")".$cond;
        return $this->db->runQuery($query);
    }

    function collectPagesToArchive($id, $cond="", $only_children=true, $archiveDate){
		$query="SELECT * FROM ".$this->table." WHERE Parent=".$id.$cond;
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$this->collectPagesToArchive($arr[$i]["ID"], $cond, $only_children, $archiveDate);
		}
		if($only_children){
			return true;
		}
        // $query="UPDATE ".$this->table." SET Deleted=".$archiveDate.", Hide_On_Menu=1 WHERE ID=".$id.$cond;
        $this->pagesToArchive[] = $id;

		// $this->db->runQuery($query);
		return true;
    }

	function unArchive($id, $cond=""){
		return $this->unArchive_both($id, "", false);
	}


	function unArchive_both($id, $cond="", $only_children=true){
		$query="SELECT * FROM ".$this->table." WHERE Parent=".$id.$cond;
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$this->unArchive_both($arr[$i]["ID"], $cond, $only_children);
			$query="UPDATE ".$this->table." SET Deleted=0 WHERE ID=".$arr[$i]["ID"].$cond;
			$this->db->runQuery($query);
		}
		if($only_children){
			return true;
		}
		
		$query="UPDATE ".$this->table." SET Deleted=0 WHERE ID=".$id.$cond;
		$this->db->runQuery($query);
		return true;
	}

	
	
	function getRelatedTableArray($page_id){
		$related_table=$this->getProperty($page_id, "Related_Table");
		return $this->db->getArray("SELECT * FROM ".$related_table." WHERE ".$this->table."=".intval($page_id)." ORDER BY Ordering");
	}
	
	function getHomePageContent($lang="he", $id=NULL, $limit=NULL, $orderBy="Start_Date DESC, UpdatedTime DESC", $restricParents=NULL){
		$query="SELECT * FROM wm_pages WHERE Deleted=0 AND ShowOnHomepage=1 AND Lang='".$lang."' AND Page_Type!=51";
		if($id){
			$query.=" AND Parent=".intval($id);
		}

		if($restricParents){
			$query.=" AND Parent NOT IN($restricParents)";
		}

		$query.=" ORDER BY ".$orderBy;
		
		if($limit){
			$query.=" LIMIT ".$limit;
		}
		
		return $this->db->getArray($query);
	}

	function getHomePageContentByPageType($pageType, $limit=NULL, $orderBy="Start_Date DESC, UpdatedTime DESC", $lang="he", $restricParents=NULL){
		$query="SELECT * FROM wm_pages WHERE Deleted=0 AND ShowOnHomepage=1 AND Hide_On_Menu=0 AND Lang='".$lang."'";
		
		$query.=" AND Page_Type=".intval($pageType);

		if($restricParents){
			$query.=" AND Parent NOT IN($restricParents)";
		}
		
		$query.=" ORDER BY ".$orderBy;
		
		if($limit){
			$query.=" LIMIT ".$limit;
		}

		return $this->db->getArray($query);
	}
	
	function getTickerContent($id=NULL, $limit=NULL, $orderBy="Start_Date DESC", $lang="en"){
		$query="SELECT * FROM wm_pages WHERE Deleted=0 AND ShowOnTicker=1 AND Hide_On_Menu=0 AND Lang='".$lang."'";
		if($id){
			$query.=" AND Parent=".intval($id);
		}
		$query.=" ORDER BY ".$orderBy;
		
		if($limit){
			$query.=" LIMIT ".$limit;
		}

		return $this->db->getArray($query);
	}

	function userAllowed($id){

		$topProtectedId=$this->getTopTrueID($id, "Protected");
	
		if(!$topProtectedId){
			return true;
		}
		
		if(!is_array($_SESSION["site_user"]["pages_allowed"])){
			return false;
		}

		if(in_array($topProtectedId, $_SESSION["site_user"]["pages_allowed"])){
			return true;
		}

		return false;

	}

	function loginSiteUser($username, $password){
		$query="SELECT ID FROM wm_pages WHERE Protected=1 AND Username='".mysqli_real_escape_string($this->db->conn, $username)."' AND Password='".mysqli_real_escape_string($this->db->conn, $password)."' ORDER BY ID";
		$arr=$this->db->getArrayForField($query, "ID");
		if(is_array($arr)){
			$_SESSION["site_user"]["pages_allowed"]=$arr;
			return $_SESSION["site_user"]["pages_allowed"][0];
		}else{
			return false;
		}
	}
	
	function getSiteRow($site_id){
		return $this->db->getRow("SELECT * FROM wm_sites WHERE ID=".intval($site_id));
	}
	
	function setParameter($name, $value){
		$query="UPDATE wm_parameters SET Value='".mysqli_real_escape_string($this->db->conn, $value)."' WHERE Name='".mysqli_real_escape_string($this->db->conn, $name)."'";
		$this->db->runQuery($query);
	}
	
	function getParameter($name){
		return $this->db->getField("SELECT Value FROM wm_parameters WHERE Name='".mysqli_real_escape_string($this->db->conn, $name)."'", "Value");
	}
	
	/*function getLinks(){
		return $this->db->getArray("SELECT * FROM wm_links WHERE Hide_On_Menu=0 ORDER BY Ordering");
	}*/
        function getLinks($lang='he'){
             $quer = "SELECT * FROM wm_links WHERE Hide_On_Menu=0 AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."' ORDER BY Ordering";
		return $this->db->getArray($quer);
	}
	function getLinks2(){
		return $this->db->getArray("SELECT * FROM wm_links2 WHERE Hide_On_Menu=0 ORDER BY Ordering");
	}

	function getLinksDivisions(){
		return $this->db->getArray("SELECT * FROM wm_links_divisions WHERE Hide_On_Menu=0 AND Lang='".$_SESSION["WM"]["Lang"]."' ORDER BY Ordering");
	}

	function getLinksDonationType(){
		return $this->db->getArray("SELECT * FROM wm_links_donation_type WHERE Hide_On_Menu=0 AND Lang='".$_SESSION["WM"]["Lang"]."' ORDER BY Ordering");
	}

	function getLinksAmount(){
		return $this->db->getArray("SELECT * FROM wm_links_amount WHERE Hide_On_Menu=0 AND Lang='".$_SESSION["WM"]["Lang"]."' ORDER BY Ordering");
	}
        
        function getLinksHeader($lang='he'){
		return $this->db->getArray("SELECT * FROM wm_links_header WHERE Hide_On_Menu=0 AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."' ORDER BY Ordering");
	}

	function getLinksHeaderByHomePageID($homePageId=2){
		return $this->db->getArray("SELECT * FROM wm_links_header WHERE Hide_On_Menu=0 AND homePageId=".intval($homePageId)." ORDER BY Ordering");
	}
	function getStickyBarByHomePageID($homePageId=2){
		return $this->db->getArray("SELECT * FROM wm_sticky_bar WHERE Hide_On_Menu=0 AND homePageId=".intval($homePageId)." ORDER BY Ordering");
	}

	function getChildren($id, $pageType=3, $orderby=NULL){
		$query="SELECT ID, Name FROM ".$this->table." WHERE Deleted=0 AND Page_Type=".$pageType." AND Parent=".intval($id);
		if($orderby){
			$query.=" ORDER BY ".$orderby;
		}

		$arr=$this->db->getArray($query);
		return $arr;
	}
	function getChildrenByPageName($parent_id, $pageType=3, $page_name, $orderby=NULL){
		$query="SELECT ID, Content FROM ".$this->table." WHERE Deleted=0 AND Page_Type=".$pageType." AND Parent=".intval($id)."AND Name='".$page_name;
		if($orderby){
			$query.=" ORDER BY ".$orderby;
		}

		$arr=$this->db->getArray($query);
		return $arr;
	}
	function getAllChildren($id, $orderby=NULL, $hideOnMenu = true, $limit = NULL){
		$query="SELECT * FROM ".$this->table." WHERE Deleted=0 AND ID != 1";
		if($hideOnMenu){
			$query .=" AND Hide_On_Menu=0";
		}
		$query .=" AND Parent=".intval($id);
		
		if($orderby){
			$query.=" ORDER BY ".$orderby;
        }
        
        if($limit){
            $query .= " LIMIT ".$limit;
        }

		$arr=$this->db->getArray($query);
               /* print_r($arr);*/
		return $arr;
	}
	
	function getChildrenOnMenu($id, $pageType=3, $orderby=NULL){
		$query="SELECT ID, Name FROM ".$this->table." WHERE Hide_On_Menu=0 AND Deleted=0 AND Page_Type=".$pageType." AND Parent=".intval($id);
		if($orderby){
			$query.=" ORDER BY ".$orderby;
		}

		$arr=$this->db->getArray($query);
		return $arr;
	}
	
	function getLinksContent($id=NULL){
		$query="SELECT * FROM ".$this->table." WHERE Deleted=0 ";
		if($id){
			$query.=" AND Parent=".intval($id);
		}
		$query.=" ORDER BY Ordering";
		return $this->db->getArray($query);
	}

	function getAliasID($alias, $homePageId=NULL){
		if(!$homePageId){
			$homePageId=HOMEPAGEID;
		}
		$alias=DOMAIN."/".$alias;
		return $this->db->getField("SELECT ID FROM wm_pages WHERE Deleted=0 AND Alias='".mysqli_real_escape_string($this->db->conn, $alias)."'", "ID");
	}
	
	function getAliasIDNoDomain($alias){
		return $this->db->getField("SELECT ID FROM wm_pages WHERE Deleted=0 AND Alias='".mysqli_real_escape_string($this->db->conn, $alias)."'", "ID");
	}	

	function getAlias($wmPage){
		if($wmPage["Alias"]){
			return $wmPage["Alias"];
		}
		return $wmPage["ID"];
	}

	function showArticlesOnTime($time){
		$query="
			UPDATE wm_pages 
			SET Hide_On_Menu=0  
			WHERE Deleted=0 AND Start_Date<='".mysqli_real_escape_string($this->db->conn, date("Y-m-d", $time))."' 
			AND Show_On_Time=1
			";
		$this->db->runQuery($query);
	}

	function hideArticlesOnTime($time){
		$query="
			UPDATE wm_pages 
			SET Hide_On_Menu=1  
			WHERE Deleted=0 AND End_Date<='".mysqli_real_escape_string($this->db->conn, date("Y-m-d", $time))."' 
			AND Expire_On_Time=1
			";
		$this->db->runQuery($query);
	}

	function uploadThumbs($uploadedName, $versions, $uploadedPath){
		if(is_uploaded_file($_FILES[$uploadedName]['tmp_name'])){
			$file=new File();
			foreach($versions as $version){
				$file->checkPath($full_file_path);
				
			}
		}
	}

	function getTranslations($lang){
		$query="SELECT * FROM wm_translate WHERE Lang='".$lang."'";
		return $this->db->getArray($query);
	}

	function getIdByPageType($pageType, $lang=NULL){
		$query="
			SELECT ID  
			FROM wm_pages 
			WHERE Deleted=0 AND Page_Type=".intval($pageType)."
		";
		
		$query.=" AND Parent=".intval(HOMEPAGEID);

		
		if($lang){
			$query.=" AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."'";
		}
		
		return $this->db->getField($query, "ID");
	}


	function getIdByPageTypeNoHomepageID($pageType, $lang=NULL){
		$query="
			SELECT ID  
			FROM wm_pages 
			WHERE Deleted=0 AND Page_Type=".intval($pageType)."
		";
		


		
		if($lang){
			$query.=" AND Lang='".$lang."'";
		}
		
		

		return $this->db->getField($query, "ID");
	}


	function getLinkByPageType($pageType, $lang=NULL){
		$pageId=$this->getIdByPageType($pageType, $lang);
		$row=$this->getValues($pageId);
		return $this->getLink($row);
	}

	function getPageComments($id){
		
		$where=" AND enabled=1 AND wm_pages=".intval($id);
		$order="post_date DESC";
		$numItems=10;

		$sp=new SuperPager($this->db, "FROM wm_comments", "*", "WHERE 1 ".$where, "", " ORDER BY ".$order, $numItems);

		return $sp;
	}

	function getTopParentAfterMenuId($id, $menuId){

		if(!$id){
			return false;
		}

		if($this->getParent($id)==$menuId){
			return $id;
		}

				
		return $this->getTopParentAfterMenuId($this->getParent($id), $menuId);
	}

	function getGalleryItems($id){
		// Get all galleries ids that connected to the page
		$connected_galleries_ids = $this->db->getField("SELECT GROUP_CONCAT(`wm_gallery_id`) as connected_galleries_ids FROM `wm_gallery_page` WHERE wm_page_id = ".$id, 'connected_galleries_ids');

		// Get gallery be page && connected gallery
		$query="SELECT * FROM wm_pages_gallery WHERE wm_pages=".intval($id);
		if($connected_galleries_ids){
			$query.=" OR wm_gallery_id IN(".$connected_galleries_ids.")";
		}
		$query.=" ORDER BY Ordering";
		$galleryItems = $this->db->getArray($query);
		
		return $galleryItems;
	}

	function getHomepageGalleryItems($lang="he"){
		$query="SELECT wm_pages_gallery.*  
			FROM wm_pages_gallery 
			INNER JOIN wm_pages ON wm_pages.ID=wm_pages_gallery.wm_pages 
			WHERE wm_pages_gallery.ShowOnHomepage=1 AND wm_pages.Lang='".$lang."'
			ORDER BY wm_pages.Start_Date DESC, wm_pages_gallery.Ordering";
			//echo "<hr>$query<hr>";
		return $this->db->getArray($query);
	}

	function getTopImages(){
		return $this->db->getArray("SELECT * FROM wm_links2 ORDER BY Ordering");
	}

	function getBanners($bannerType, $order="RAND()", $limit=1000){
		return $this->db->getArray("SELECT * FROM wm_banners WHERE Banner_Type=".intval($bannerType)." ORDER BY ".$order." LIMIT 0,".$limit);
	}

	function getLink($wmPage, $alterDomain=false, $alterDomainSection="item"){
		global $cfg;
		$target=NULL;

		$arrLink=array();

		if(isset($wmPage["Link"]) && (
				strpos($wmPage["Link"], 'sms:') !== false
				|| strpos($wmPage["Link"], 'mailto:') !== false
				|| strpos($wmPage["Link"], 'tel:') !== false
			)
		){
			$arrLink=array(
				"Link"		=>	$wmPage["Link"],
				"Target"	=>	$wmPage["Open_In"],
				"Onclick"	=> 	"window.open('".$wmPage["Link"]."');"
			);
			return $arrLink;
		}
		
		$addLangAlias="";
		/*
		if($wmPage["Lang"]!=$cfg["WM"]["Default_Language"]){
			//$addLangAlias="/".$wmPage["Lang"];
		}
		*/
		$wmPage["ID"] = isset($wmPage["ID"]) ? $wmPage["ID"]:0 ;
		$pageType=$this->getPageType($wmPage["ID"]);

		if($pageType["ID"]==5 || $pageType["ID"]==109){/*home page and moadon yoldot*/
                        $domain = $this->db->getRow("SELECT domain FROM wm_pages WHERE ID = ".$wmPage['ID']);
                        $wmPage['domain'] = $domain['domain'];
                        if($wmPage['domain'] != ''){
                            $link = PROTOCOL."://".$wmPage['domain'];
                        }else{
                            $link=$cfg["WM"]["Server"].$addLangAlias;
                        }
			
			$target=	"_self";
		}elseif($pageType["GotoFirstChild"] && $this->hasChildren($wmPage["ID"])){
		
			$fc=	$this->getFirstChild($wmPage["ID"]);
		/*
			$alias=	$this->get($fc, "Alias");
			$link=$cfg["WM"]["Server"].$addLangAlias."/".($alias?$alias:$fc);
			$target="_self";
		*/
			$childWmPage=$this->getValues($fc);
			return $this->getLink($childWmPage);
		
		}else{
                        //if(!$wmPage["File_Name"]){
                            $wmPage["File_Name"]=$this->get($wmPage["ID"], "File_Name");
                       // }
                            //echo $wmPage["ID"];
                        //print_r($wmPage);
                        //echo "----".$wmPage["ID"]."---".$wmPage["Name"];
              
/*                            
if(isset($wmPage["File_Name"]) && $wmPage["File_Name"] && !$wmPage["Alias"]){
                                $pathinfo=pathinfo($_SERVER["DOCUMENT_ROOT"]."/".$wmPage["File_Name"]);
                              
				//$link=		$cfg["WM"]["Server"]."/".$wmPage["File_Name"];
                                $link=$cfg["WM"]["Server"]."/".$wmPage["ID"].".".$pathinfo['extension'];
				$target=	"_self";
			}else  

 */                          
                        if(isset($wmPage["Link"]) && $wmPage["Link"]){
				if(substr($wmPage["Link"], 0, 7)!="http://" && substr($wmPage["Link"], 0, 8)!="https://"){
					$wmPage["Link"]=PROTOCOL."://".$_SERVER["SERVER_NAME"]."/".$wmPage["Link"];
				}

				$link=		$wmPage["Link"];
				$target=	isset($wmPage["Open_In"]) ? $wmPage["Open_In"] : '_self'; 
			}else{
				if(isset($wmPage["Alias"]) && $wmPage["Alias"]){
					//$link=$cfg["WM"]["Server"].$addLangAlias."/".$wmPage["Alias"];
					$link=PROTOCOL."://".$wmPage["Alias"];
				}else{
					$link=$cfg["WM"]["Server"]."/".$wmPage["ID"];
				}					
			}
			$target="_self";
			

		}

		if(isset($wmPage["Open_In"]) && $wmPage["Open_In"]){
			$target=$wmPage["Open_In"];
		}

		if(!$target){
			$target="_self";
		}

		$onclick = ($target=="_blank") ? "window.open('".$link."');" : "document.location='".$link."';";



		if($alterDomain){
			$urlParse=parse_url($link);
			$link=$urlParse["scheme"]."://".DOMAIN."/".$alterDomainSection.$urlParse["path"];
		}	


		$arrLink=array(
			"Link"		=>	$link,
			"Target"	=>	$target,
			"Onclick"	=> 	$onclick
		);

		return $arrLink;
	}

	function getBanner($bannerType, $howMany=1){
		$query="
			SELECT * 
			FROM wm_banners 
			WHERE Banner_Type=".intval($bannerType)." 
			ORDER BY RAND() 
			LIMIT 0,".$howMany."
		";
		return $this->db->getRow($query);
	}

	function initGETParams(){
		global $wmPage;
		
		$arrRequestUri=explode("?", $_SERVER["REQUEST_URI"]);

		if(count($arrRequestUri)>1){
			list($nothing, $getParams)=$arrRequestUri;
		}else{
			return;
		}

		$getParams=explode("&", $getParams);
		foreach($getParams as $param){
			list($var, $val)=explode("=", $param);
			$_GET[$var]=urldecode($val);
		}
	}

	function getHeaderRow($id=NULL){
		$query="
			SELECT * 
			FROM wm_header_settings 
			WHERE 1 
		";
		if($id){
			$query.=" AND ID=".intval($id);
		}

		return $this->db->getRow($query);
	}


	function getContentArray($description = null){

	    $firstParaEnd = strpos($description, "<hr />");


	
	    if($firstParaEnd===false){

		    $temp = array("intro" => $description, "body" => "");
		    return $temp;

           
            }


		    $intro = substr($description, 0, $firstParaEnd);

		    $firstParaEnd += 6;
		    $body = substr($description, $firstParaEnd, strlen($description)-strlen($intro));


		    $temp = array("intro" => $intro, "body" => $body);
		    return $temp;	    

	

	}
	function getNumItems($id){
		$query="
			SELECT COUNT(*) AS num FROM wm_pages WHERE Parent=".intval($id)."
		";
		return $this->db->getField($query, "num");
	}

	function getNumShowenItems($id){
		$query="
			SELECT COUNT(*) AS num FROM wm_pages WHERE Deleted=0 AND Hide_On_Menu=0 AND Parent=".intval($id)."
		";
		return $this->db->getField($query, "num");
	}

	function getShowenItems($id){
		$query="
			SELECT 
			
			FROM wm_pages WHERE Deleted=0 AND Hide_On_Menu=0 AND Parent=".intval($id)."
		";
		return $this->db->getField($query, "num");
	}

	function getTopItemForMenu($id, $menuId){

		if(!$id){
			return false;
		}

		if($this->getParent($id)==$menuId){
			return $this->getValues($id);
		}
				
		return $this->getTopItemForMenu($this->get($id, "Parent"), $menuId);
	}

	function getLanguageRow($lang){
		$query="
			SELECT * 
			FROM wm_languages 
			WHERE Lang='".$lang."'
			";
		return $this->db->getRow($query);
	}
	
	function getTopParentAfterMenu($id, $lang){

		if(!$id){
			return false;
		}

		if($this->getParent($id)==$this->getIdByPageType(35, $lang)){
			return $id;
		}
						
		return $this->getTopParentAfterMenu($this->getParent($id), $lang);
	}


	function getDefaultLanguage(){
		return $this->getParameter("default_language");
	}

	function getVersions($id){
		$query="
			SELECT ID, UpdatedTime 
			FROM wm_pages_versions 
			WHERE wm_pages=$id 
			ORDER BY UpdatedTime DESC
		";
		return $this->db->getArray($query);
	}

	function revertToVersion($versionId){
		global $cfg;
		$wmVersions=new WebMaster($this->db, $cfg["WM"]["DATABASE_TABLE"]["PagesVersions"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
		$fieldsArray=$this->getValues($versionId);
		$id=$fieldsArray["wm_pages"];
		unset($fieldsArray["wm_pages"]);
		
		$fieldsArray["wm_pages_versions"]=$fieldsArray["ID"];
		$fieldsArray["ID"]=$id;
		$this->setValues($id, $fieldsArray);
	}

	function getMobileMainId(){
		global $wmPage;
		return $this->getIdByPageType(53, $wmPage["Lang"]);
	}

	function getMobileMenu(){
		$menuId=$this->getMobileMainId();

		$query="
			SELECT *    
			FROM wm_pages 
			WHERE Deleted=0 AND Hide_On_Menu=0 AND Parent=".$menuId."
			ORDER BY Ordering
		";

		return $this->db->getArray($query);
	}

	function loadForGoogle(){
		if(strpos($_SERVER["REQUEST_URI"], "_escaped_fragment_")===false){
			return false;
		}

		return true;
	}



	function getLandpageId($id){
		$pageType=$this->get($id, "Page_Type");
		if($pageType==56){
			return $id;
		}
		if($id<1){
			return 0;
		}
		return $this->getLandpageId($this->getParent($id));
	}

	function getLandpageByUser(){
		global $lpusers;

		$query="
		SELECT ID 
		FROM wm_pages 
		WHERE wm_landing_pages_customers=".intval($_SESSION["LPMEDIA"]["USER_DATA"]["ID"])." 
		ORDER BY Ordering
		LIMIT 0,1";
		$pageId=$this->db->getField($query, "ID");
		
		return $pageId;		
	}	

	function getParentsArrayOriginal($id, $arr=NULL, $level=0){

		global $login;


		if(!$arr){
			$arr=array();
		}
		
		//if($this->getParent($id)==0){
		if($id==0){
			return array_reverse($arr);
		}
		
		$query="
			SELECT ID, Parent, Name, wm_landing_pages_customers 
			FROM wm_pages 
			WHERE ID=".intval($id)."
		";

		$row=$this->db->getRow($query);

		$row=$this->getValues($id);

		


		$arr[$level]=$row;
		


			
		return $this->getParentsArrayOriginal($row["Parent"], $arr, ++$level);
	}


	function getParentsArray($id, $arr=NULL, $level=0){
		global $login;
		global $lpusers;

		if(!$arr){
			$arr=array();
		}
		
		//if($this->getParent($id)==0){
		if($id==0){
			return array_reverse($arr);
		}
		
		$query="
			SELECT ID, Parent, Name, wm_landing_pages_customers 
			FROM wm_pages 
			WHERE ID=".intval($id)."
		";

		$row=$this->db->getRow($query);
/*
		if($login->isUser() && !$login->isManager()){
			//if($lpusers->isPageBelongs($row)){
			//	$arr[$level]=$row;
			//}
		}else{
			$arr[$level]=$row;
		}
*/

		$arr[$level]=$row;
			
		return $this->getParentsArray($row["Parent"], $arr, ++$level);
	}

	function getPermissions($id, $user_id, $level=1) {                      // is this page permitted for editing ?
                if ($level==1) return true;                                     // Admins have access to edit all pages
		$allowed_ids = array();
                $allowed_ids_index = array();
		$parents = $this->getParentsArray($id);
		foreach ($parents as $n=>$parent) {
                    $allowed_ids[] = $parent['ID'];                             // collect all tree
                    $allowed_ids_index[$parent['ID']] = 1;                      // collect all tree
                }
		$allowed_ids = implode(",",$allowed_ids);
		$permissions = $this->db->getArray("SELECT * FROM wm_pages_permissions WHERE wm_user_id=".intval($user_id));
                if (count($permissions)) {
                    foreach ($permissions as $n=>$permission) {
                        if (@$allowed_ids_index[$permission['wm_page_id']]) return true;
                    }
                }
                return false;
	}


	function isPageConnected($id){
		return $this->inParentsIds($id, "1");
	}

	function deleteDisconnectedPages(){
		$query="SELECT * FROM wm_pages";
		$arr=$this->db->getArray($query);
		$i=0;

		foreach($arr as $row){
			if(!$this->isPageConnected($row["ID"])){

				$this->delete($row["ID"]);
				$i++;
			}
		}

		$query="
			SELECT wm_pages_gallery.ID 
			FROM wm_pages_gallery 
			LEFT JOIN wm_pages ON wm_pages.ID=wm_pages_gallery.wm_pages 
			WHERE wm_pages.ID IS NULL OR wm_pages_gallery.wm_pages IS NULL
		";

		$arrIds=$this->db->getArrayForField($query, "ID");
		
		$ids=implode(",", $arrIds);
	
		$query="
			DELETE 
			FROM wm_pages_gallery 
			WHERE ID IN(".$ids.")
		";

		$this->db->runQuery($query);
	}

	function getAlternates($wmPage){
		$strAlternateHTML="";
		$alternates=explode("\r\n", $wmPage["alternate"]);
		foreach($alternates as $alternate){
			if(!isset($alternate)){
				continue;
			}
			list($url, $lang)=explode(",", $alternate);
			$strAlternateHTML.="\r\n<link rel=\"alternate\" href=\"".$url."\" hreflang=\"".$lang."\" />";
		}
		return $strAlternateHTML;
	}

	function writeHeaders(){

		//header("Cache-Control: max-age=2692000, public");
		header("Content-Type: text/html; charset=utf-8");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s", time() - 60*60*12)." GMT"); 
		header("Expires: ".gmdate("D, d M Y H:i:s", (time() + 60*60*12))." GMT");
	}


	function getAdminTranslation($lang){
		if($_SESSION["ADMIN_TRANS"][$lang]){
                        $txt = unserialize($_SESSION["ADMIN_TRANS"][$lang]);    // this is required when reading from session <--
			return $txt;
		}

		$query="SELECT Name, Value FROM wm_translate_admin WHERE Lang='".mysqli_real_escape_string($this->db->conn, $lang)."'";
		$arr=$this->db->getArray($query);

		//$txt=array();
                $txt = new obj;                                                 // definition is in top of file
		foreach($arr as $val){
			$txt[$val["Name"]]=$val["Value"];
		}
		$_SESSION["ADMIN_TRANS"][$lang]=serialize($txt);                // this is required when saving into session <--
		return $txt;
	}

	function getPages($parent){
		$query="
			SELECT * 
			FROM wm_pages 
			WHERE Parent=".intval($parent)." AND Deleted=0 AND Hide_On_Menu=0 
			ORDER BY Ordering
		";
		return $this->db->getArray($query);
	}

    function insertSearch($word){
        /*limit search table to 2000 rows*/
        $queryCheckSize="
                SELECT count(*) as CountRows
                FROM wm_search_words
                WHERE 1";

        $totalRows=$this->db->getRow($queryCheckSize);
        if(intval($totalRows["CountRows"])>2000){
            return;
        }else{
            $word=trim($word);
            $query="
                SELECT *
                FROM wm_search_words
                WHERE search_word='".mysqli_real_escape_string($this->db->conn,$word)."'";

            $wordInTable=$this->db->getArray($query);

            /*if the word exist in table- update the count field for this word*/
            if($wordInTable){
                $countUpdate=intval($wordInTable[0]["count_searches"]+1);
                $updateQuery="UPDATE wm_search_words SET count_searches=".$countUpdate." WHERE search_word='".mysqli_real_escape_string($this->db->conn,$word)."'";
                $this->db->runQuery($updateQuery);
            }else{
                /*if the word don't exist in table- insert*/
                $insertQuery="INSERT INTO wm_search_words (search_word,count_searches) VALUES ('".mysqli_real_escape_string($this->db->conn,$word)."',1)";
                $this->db->runQuery($insertQuery);
            }
        }
    }


    /* Check if page deleted for 404 error (Operated in indextop.php) */
	function checkIfPageDeleted($a){
        if(is_numeric($a)){
            $query="SELECT Deleted FROM wm_pages WHERE ID=".$a;
        }else{
            $query="SELECT Deleted FROM wm_pages WHERE Alias='".mysqli_real_escape_string($this->db->conn,$a)."'";
        }
        return $this->db->getRow($query);
    }
    
    function fixLanguage(){
    	global $getParams;
    	global $urlHasLangAlias;
    	
	$availLangs=$this->getLanguagesArrayList();
	
	if(isset($getParams[0])){
		$lang=substr($getParams[0], 0, 2);

		if(in_array($lang, $availLangs)){
			$urlHasLangAlias=true;

			$_SESSION["WM"]["Lang"]=$lang;
			$getParams=array_splice($getParams, 1);
		}
	}
    }
    
    function urlLangAliasOk($wmPage){
    	global $urlHasLangAlias;
    	global $cfg;

   	if($wmPage["Lang"]==$cfg["WM"]["Default_Language"] && !$urlHasLangAlias){
    		return true;
    	}elseif($wmPage["Lang"]!=$cfg["WM"]["Default_Language"] && $urlHasLangAlias){
    		return true;
    	}

   	return false;
    }
    
    function get404(){
		//global $wmPage;
		//if(strpos($_SERVER["SERVER_NAME"], "sheba.co.il")===false){
    	// Every website need to have 404 page as a child of homepage
		if(true){
     		$id=$this->getIdByPageType(84, $_SESSION["WM"]["Lang"]);
     	}else{
     		$id=$this->getIdByPageTypeNoHomepageID(84, $_SESSION["WM"]["Lang"]);
     	}

    	header("HTTP/1.0 404 Not Found");

		return $id;
    }
    
    function gotoPageType($pageTypeId){
	$id=$this->getIdByPageType($pageTypeId);
	$wmPage=$this->getValues($id);
	$link=$this->getLink($wmPage);
	header("location: ".$link["Link"]);
	exit;
    }

	
    function removeDomainFromAlias($alias, $id){
	$homePageId=	$this->getHomePageById($id);
	$homePageDomain=$this->get($homePageId, "domain");
	return str_replace($homePageDomain."/", "", $alias);
    }

    function addDomainToAlias($alias, $id){
	$homePageId=	$this->getHomePageById($id);
	$homePageDomain=$this->get($homePageId, "domain");
	return $homePageDomain."/".$alias;
    }
    
    function changeAlias($alias, $id, $newDomain){
    	$strippedAlias=$this->removeDomainFromAlias($alias, $id);
    	return $this->addDomainToAlias($newDomain, $id);
    }
    
    function getConnectedPages($pageId,$pagetypeIds,$orderBy=NULL,$limit='0,10000',$where=NULL){/*get pages connected to this page by pagetype*/
        $query = "SELECT wm_connected_pages_ids.Ordering,wm_connected_pages_ids.wm_connected_wm_pages_ids,wm_pages.ID,wm_pages.Top_Header,wm_pages.Name,wm_pages.Start_Date,wm_pages.Sub_Title,wm_pages.Top_Header_Alt FROM wm_connected_pages_ids 
                  INNER JOIN wm_pages
                  ON wm_pages.ID = wm_connected_pages_ids.wm_connected_wm_pages_ids
                  WHERE wm_pages = ".$pageId."
                  AND wm_connected_page_type IN (".$pagetypeIds.")";



        if($where){
            $query.=" AND $where";
        }
        if($orderBy){
            $query.= " ORDER BY $orderBy";
        }
        $query.=" LIMIT $limit";
       
        return $this->db->getArray($query);
    }
    
    function getDynamicFieldsByPageType($pageId,$pagetypeId,$blockNum=1){/*get dynamic fiedls connected to this page by page id and page type*/
        $query = "SELECT wm_pages_dynamic_field_values.Value ,wm_pages_dynamic_fields.Name as Name FROM wm_pages_dynamic_fields
                  INNER JOIN wm_pages_dynamic_field_values 
                  ON wm_pages_dynamic_field_values.wm_forms_fields = wm_pages_dynamic_fields.ID
                  WHERE wm_pages_dynamic_fields.page_type = ".$pagetypeId."
                  AND wm_pages_dynamic_fields.block_num = ".$blockNum."
                  AND wm_pages_dynamic_field_values.wm_pages = ".$pageId." 
                  ORDER BY wm_pages_dynamic_fields.ID";
        return $this->db->getArray($query);
    }
    
    function getHasValueId($id, $fieldName){
                
            $thisValue=$this->get($id, $fieldName);
            
            if($this->getParent($id)==0){
                    return false;
            }

            if($thisValue){
                    return $id;
            }


            if(!$thisValue){
                    return $this->getHasValueId($this->getParent($id), $fieldName);
            }
    }
    
    function getSearchArrRecursive(&$arr, $searchKey, $parent=null,$searchFieldNames = array('Name','Content','Sub_Title')){
		if(!$searchKey){
			return array();
		}

		$searchKey=trim($searchKey);
		
		$query="SELECT ID, Name, Sub_Title, Alias, Top_Header 
			FROM wm_pages 
			WHERE Deleted=0 AND Hide_On_Menu=0";
				
		if($lang){
			$query.=" AND Lang='".$lang."'";
		}

		if($parent){
			$query.=" AND Parent=".intval($parent)."";
		}

		
		$searchKeysArr=	explode(" ", $searchKey);
                $numSearchFieldNames = count($searchFieldNames);
		foreach($searchKeysArr as $val){
			if($val==" "){
				continue;
			}
			$query.=" AND (";
                        foreach ($searchFieldNames as $key=>$value) {
                            $query.= $value." LIKE '%".mysqli_real_escape_string($this->db->conn, $val)."%'";
                            if($numSearchFieldNames-1 > $key){$query.=" OR ";}
                        }
                        $query.=") ORDER BY ORDERING";
		}


		$newArr=$this->db->getArray($query);

		foreach($newArr as $item) { // do an array looping at first

	
			array_push($arr, $item);
			//$new_arr = array(); // create an array to be included on the second position
			//$new_arr[0] = $line_arr;

			//array_push($arr[$key][1],$new_arr);//include the whole array on the sec position
		};

//		array_push($arr, $this->db->getArray($query));


		if($this->hasChildren($parent)){
			$children=$this->getMenuLevel($parent);
			foreach($children as $item){
				if($this->hasChildren($item["ID"])){
					$this->getSearchArrRecursive($arr, $searchKey, $item["ID"],$searchFieldNames);
				}
			}
		}
		

	}
        
        function getChildrenRecursive(&$arr, $parent=null){
                
		$query="SELECT ID, Name, Sub_Title, Alias, Top_Header, File_Name , Content, UpdatedTime  
			FROM wm_pages 
			WHERE Deleted=0 AND Hide_On_Menu=0";
                
			
		if($lang){
			$query.=" AND Lang='".$lang."'";
		}
                
		if($parent){
			$query.=" AND Parent=".intval($parent)."";
		}
                
		$newArr=$this->db->getArray($query);
                
                	
               
		foreach($newArr as $item) { // do an array looping at first
			array_push($arr, $item);
			//$new_arr = array(); // create an array to be included on the second position
			//$new_arr[0] = $line_arr;

			//array_push($arr[$key][1],$new_arr);//include the whole array on the sec position
		};

//		array_push($arr, $this->db->getArray($query));


		if($this->hasChildren($parent)){
			$children=$this->getMenuLevel($parent);
			foreach($children as $item){
				if($this->hasChildren($item["ID"])){
					$this->getChildrenRecursive($arr, $item["ID"]);
				}
			}
		}
		
	} 
        
        //before calling the function make sure that arr is array
        function getChildrenRecursiveIDs(&$arr, $parent=null){
                
                if(!is_array($arr)){
                    $arr=array();
                }
            
		$query="SELECT ID FROM wm_pages WHERE Deleted=0 AND Hide_On_Menu=0";
		if($parent) $query.=" AND Parent=".intval($parent)."";

		$newArr=$this->db->getArrayForField($query, "ID");
               
		foreach($newArr as $item) { // do an array looping at first
                    array_push($arr, $item);
		};

		if($this->hasChildren($parent)){
			$children=$this->getMenuLevel($parent);
			foreach($children as $item){
				if($this->hasChildren($item["ID"])){
					$this->getChildrenRecursiveIDs($arr, $item["ID"]);
				}
			}
		}
		
	} 
	
//before calling the function make sure that arr is array
function getChildrenRecursiveByPageType(&$arr, $parent=null, $pageType){
		
	if(!is_array($arr)){
		$arr=array();
	}            
		
	$query="SELECT ID, Name, Sub_Title, Alias, Top_Header ,Author
		FROM wm_pages 
		WHERE Deleted=0 AND Hide_On_Menu=0
		AND Page_Type IN ($pageType)";
			
	if(isset($lang) && $lang){
		$query.=" AND Lang='".$lang."'";
	}

	if($parent){
		$query.=" AND Parent=".intval($parent)."";
	}
	$newArr=$this->db->getArray($query);
			
	foreach($newArr as $item) { // do an array looping at first	
		array_push($arr, $item);
	};
					
	if($this->hasChildren($parent)){
		$children=$this->getMenuLevel($parent);
		foreach($children as $item){
			if($this->hasChildren($item["ID"])){
				$this->getChildrenRecursiveByPageType($arr, $item["ID"],$pageType);
			}
		}
	}		
} 
        



	function getTemplate($pageId=0){
		if(!$pageId){
			return false;
		}
		$templateId=$this->get($pageId, "wm_template");
		$templateName=$this->db->getField("SELECT Value FROM wm_template WHERE ID=".intval($templateId), "Value");
		return $templateName;
	}
        function getPagesByPageType($pageType, $orderBy=NULL) {
            $orderBy = ($orderBy == NULL ? '': " ORDER BY ".mysqli_real_escape_string($this->db->conn, $orderBy));
            return $this->db->getArray("SELECT * FROM wm_pages WHERE Deleted=0 AND Hide_On_Menu=0 AND Page_Type=".intval($pageType).$orderBy);
        }
        function getUnitsByPageType($pageType, $orderBy=NULL) {
            $orderBy = ($orderBy == NULL ? '': " ORDER BY ".mysqli_real_escape_string($this->db->conn, $orderBy));
            $query = "SELECT ID, Parent, Name FROM wm_pages WHERE Deleted=0 AND Hide_On_Menu=0 AND Lang='he' AND dontShowInUnitsSearch=0 AND Page_Type=".intval($pageType).$orderBy;
            return $this->db->getArray($query);
        }
        function getSideMenuLinks($parent,$lang='he') {
            return $this->db->getArray("SELECT * FROM wm_side_menu_links WHERE Hide_On_Menu=0 AND Parent=".intval($parent)." AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."'");
        }
        function getDomainSideMenuLinks($domain_parent,$lang='he') {
            return $this->db->getArray("SELECT * FROM wm_side_menu_links WHERE Hide_On_Menu=0 AND Domain_Parent=".intval($domain_parent)." AND Parent=0 AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."' ORDER BY Ordering");
        }


        function getFooterSideMenuLinks($parent, $lang='he') {
            return $this->db->getArray("SELECT * FROM wm_links_footer_side WHERE Hide_On_Menu=0 AND Parent=".intval($parent)." AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."' ORDER BY Ordering" );
        }
        
        function getFooterSideMenuLinksMsr($parent, $lang='he') {
            return $this->db->getArray("SELECT * FROM wm_links_footer_side_msr WHERE Hide_On_Menu=0 AND Parent=".intval($parent)." AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."' ORDER BY Ordering" );
        }

        function getEventsInstances($eventsIds) {
            return $this->db->getArray("SELECT wm_events.Name, wm_events.Start_Date, wm_events.Start_Time, wm_pages.Sub_Title, wm_events.ID as idMofa, wm_pages.Alias, wm_pages.ID, wm_pages.Link"
                                     . " FROM wm_events  "
                                     . "INNER JOIN wm_pages "
                                     . "ON wm_pages.ID = wm_events.wm_pages WHERE wm_events.wm_pages IN ($eventsIds)");
        }
        
        /*function getAncestors($id) {/*get all parents of some page - return reversed array*/
            /*first check if ID exists*/
            /*$idExists = $this->db->getRow('SELECT ID FROM wm_pages WHERE ID ='.intval($id));
            if(count($idExists)>0){
            	$result = $this->db->getRow("SELECT GetAncestry(".intval($id).") as ancestor");
           	    return array_reverse(explode(',', $result['ancestor']));
            }else{
            	return false;
            }
        }
        
        function getNavigatorByAncestry($id, $str="", $saperator="&gt;",$formName=NULL){
        	/*first check if ID exists*/
            /*$idExists = $this->db->getRow('SELECT ID FROM wm_pages WHERE ID ='.intval($id));
            if(count($idExists)>0){
	            $result = $this->db->getRow("SELECT GetAncestry(".intval($id).") as ancestor");
	            $arr = array_reverse(explode(',', $result['ancestor']));
	            array_push($arr, $id);
	            foreach ($arr as $key=>$value) {
	                if($key>1){
	                    $name=$this->db->getRow("SELECT ID, Parent, Page_Type, Name, Alias, Link, Open_In, Hide_On_Menu, Lang FROM wm_pages WHERE ID =".$value);
	                    $link = $this->getLink($name);
	                    $nav.="<a href='".$link['Link']."'>".$name['Name']."</a>".$saperator;
	                }
	            }
	            return $nav;
        	}else{
        		return false;
        	}
        }*/
        
        function getChildrenRecursiveWithLevel(&$arr, $parent=0, $limit = "0,10", $order = "Start_Date DESC", $level=0) {/*this needs fixing...!!*/
            $query = "SELECT ID,Name FROM wm_pages".
                      " WHERE Deleted = 0 AND Parent=".intval($parent).
                      " ORDER BY ".mysqli_real_escape_string($this->db->conn, $order).
                      " LIMIT ".mysqli_real_escape_string($this->db->conn, $limit);
            $temp_arr=$this->db->getArray($query);
            
            if(empty($temp_arr)){
                return;                
            }            
            
            $num=count($temp_arr);
            for($i=0;$i<$num;$i++){
                $temp_arr[$i]["level"]=$level;
                $arr[]=$temp_arr[$i];
                if($this->hasChildren($temp_arr[$i]["ID"])){
                    $tmp=$this->getChildrenRecursiveWithLevel($arr,  $temp_arr[$i]["ID"], "0,10000", $order, ($level+1));
                    if($tmp){/*if we get empty values - uncomment this!*/
                        //$arr[]=$tmp;
                    }
                }
            }
        }
        
        // this function is used to fix missing alts and titles in images with a chosen title
        function fixContentAlts($content, $title) {
            $images = explode("<img", $content);
            if (count($images)) {
                $changes_made = false;
                for ($im=1; $im<count($images); $im++) {
                    $img = $images[$im];
                    $alt_found = $title_found = false;
                    if (strpos($img,"alt=")>0) {                                // if alt is found..
                        if (strpos($img,'alt=""')>0) $img = str_replace('alt=""','',$img);
                        else if (strpos($img,"alt=''")>0) $img = str_replace("alt=''",'',$img);
                        else $alt_found = true;               
                    }
                    if (strpos($img,"title=")>0) {                              // if title is found..
                        if (strpos($img,'title=""')>0) $img = str_replace('title=""','',$img);
                        else if (strpos($img,"title=''")>0) $img = str_replace("title=''",'',$img);
                        else $title_found = true;           
                    }
                    if (!$alt_found) {
                        $img = ' alt="'.str_replace('"','&quot;',trim($title)).'" '.$img;
                        $changes_made = true;
                    }
                    if (!$title_found) {
                        $img = ' title="'.str_replace('"','&quot;',trim($title)).'" '.$img;
                        $changes_made = true;
                    }
                    $images[$im] = $img;
                }
                if ($changes_made) return implode("<img", $images);
            }
            return $content;
        }



        // TICKERS
        function linkTo($pageId, $identifier){
        	if(!$pageId || !$identifier){
        		return false;
        	}

        	$fields=array(
        		"wm_pages"	=>	$pageId,
        		"identifier"	=>	$identifier
        	);

        	return $this->db->updateData("wm_pages_sendto", $fields);
        }

        function unlinkTo($pageId, $identifier){
        	if(!$pageId || !$identifier){
        		return false;
        	}
        	
        	$query="DELETE FROM wm_pages_sendto WHERE wm_pages=".intval($pageId)." AND identifier=".intval($identifier);
        	$this->db->runQuery($query);
        }

        function unlinkPageId($pageId){
        	if(!$pageId){
        		return false;
        	}
        	
        	$query="DELETE FROM wm_pages_sendto WHERE wm_pages=".intval($pageId);
        	$this->db->runQuery($query);
        }

        function isLinkedTo($pageId, $identifier){
        	if(!$pageId || !$identifier){
        		return false;
        	}
        	$query="SELECT ID FROM wm_pages_sendto WHERE wm_pages=".intval($pageId)." AND identifier=".intval($identifier);
        	return $this->db->getField($query, "ID");
        }

        function toggleLink($pageId, $identifier){
        	if($this->isLinkedTo($pageId, $identifier)){
        		$this->unlinkTo($pageId, $identifier);
        	}else{
        		$this->linkTo($pageId, $identifier);
        	}
        }
           
        function getLinkedPages($identifier, $lang="he", $limit="0, 10", $orderBy="Start_Date DESC"){
        	if(!$identifier){
        		return false;
        	}

        	if(ENABLE_CACHE && isset($_SESSION["cache"]["getLinkedPages"][$lang][$limit][$orderBy])){
        		//return $_SESSION["cache"]["getLinkedPages"][$lang][$limit][$orderBy];
        	}


        	//wm_pages.*     not enough to get link:  wm_pages.ID, wm_pages.Alias, wm_pages.Name, wm_pages.Sub_Title, wm_pages.Top_Header, wm_pages.Top_Header2, wm_pages.Hide_On_Menu, wm_pages.Page_Type, wm_pages.access_key
        	$query="
        	SELECT wm_pages.ID, wm_pages.Alias, wm_pages.Name, wm_pages.Sub_Title, wm_pages.Top_Header, wm_pages.Top_Header2, wm_pages.Hide_On_Menu, wm_pages.Page_Type, wm_pages.Lang
        	FROM wm_pages
        	INNER JOIN wm_pages_sendto ON wm_pages_sendto.wm_pages=wm_pages.ID
        	WHERE Deleted=0 AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."' AND wm_pages_sendto.identifier=".intval($identifier);

        	//$query.=" ORDER BY ".$orderBy;

        	if($limit){
        		$query.=" LIMIT ".$limit;
        	}

        	$arr=$this->db->getArray($query);

        	$_SESSION["cache"]["getLinkedPages"][$lang][$limit][$orderBy]=$arr;

        	return $arr;
        }
           
        function getLinkedPagesPager($identifier, $lang="he",  $orderBy="Start_Date DESC", $itemsInPage=4){
        	if(!$identifier){
        		return false;
        	}
        	/*
        	$query="
        	SELECT wm_pages.* 
        	FROM wm_pages 
        	INNER JOIN wm_pages_sendto ON wm_pages_sendto.wm_pages=wm_pages.ID 
        	WHERE Lang='".$lang."' AND wm_pages_sendto.identifier=".intval($identifier);
        	*/
        	$sp=new SuperPager($this->db, "FROM wm_pages", "wm_pages.*", "INNER JOIN wm_pages_sendto ON wm_pages_sendto.wm_pages=wm_pages.ID WHERE Lang='".mysqli_real_escape_string($this->db->conn, $lang)."' AND wm_pages_sendto.identifier=".intval($identifier), "", " ORDER BY ".$orderBy, $itemsInPage);
        	
        	return $sp;
        }


        function getLinkedPagesAdmin($identifier, $lang="he", $limit="0, 10", $orderBy="Start_Date DESC"){
        	if(!$identifier){
        		return false;
        	}
        	$query="
        	SELECT wm_pages.*, wm_pagetype.icon, wm_pagetype.Name AS PageTypeName  
        	FROM wm_pages 
        	INNER JOIN wm_pages_sendto ON wm_pages_sendto.wm_pages=wm_pages.ID 
        	INNER JOIN wm_pagetype ON wm_pagetype.ID=wm_pages.Page_Type
        	WHERE Lang='".$lang."' AND wm_pages_sendto.identifier=".intval($identifier);

        	//$query.=" ORDER BY ".$orderBy;
        	
        	if($limit){
        		$query.=" LIMIT ".$limit;
        	}



        	$arr=$this->db->getArray($query);

        	return $arr;
        }


        // END TICKERS

	function getLinksConnect($lang='he'){
		 $quer = "SELECT * FROM wm_links_connect WHERE Hide_On_Menu=0 AND Lang='".mysqli_real_escape_string($this->db->conn, $lang)."' ORDER BY Ordering";
		return $this->db->getArray($quer);
	}

    function getChild($id, $pageType){
		$query = "SELECT * FROM ".$this->table." WHERE Deleted=0 AND Page_Type=".intval($pageType)." AND Parent=".intval($id);
		$pageArr = $this->db->getRow($query);
		return $pageArr;
	}

	function getChildrenOfPagetype($pagetypeId) {
		$result = [
			'parent' => [],
			'children' => [],
		];

		$homepageId = $this->getHomePageByDomain(DOMAIN);

		// Find parent
		$query = "SELECT * 
					FROM wm_pages 
					WHERE Hide_On_Menu = 0 
					AND Deleted = 0 
					AND Parent = ".intval($homepageId)." 
					AND Page_Type = ".intval($pagetypeId);
		$result['parent'] = $this->db->getRow($query);

		// Find children of parent
		if(!empty($result['parent'])){
			$query = "SELECT * 
					FROM wm_pages 
					WHERE Hide_On_Menu = 0 
					AND Deleted = 0 
					AND Parent = ".intval($result['parent']['ID'])."
					ORDER BY Ordering";
			$result['children'] = $this->db->getArray($query);
		}

		return $result;
	}

}
?>
