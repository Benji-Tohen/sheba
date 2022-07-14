<?php
/************************************************************************************** 
* Class: Pager 
* Author: Tsigo <tsigo@tsiris.com> 
* Methods: 
*         findStart 
*         findPages 
*         pageList 
*         nextPrev 
* Redistribute as you see fit. 
**************************************************************************************/ 
 class Pager 
  { 
  
  	var $nextPage;
	var $prevPage;
	
  /*********************************************************************************** 
   * int findStart (int limit) 
   * Returns the start offset based on $_GET['page'] and $limit 
   ***********************************************************************************/ 
   function findStart($limit) 
    { 
     if ((!isset($_GET['page'])) || ($_GET['page'] == "1")) 
      { 
       $start = 0; 
       $_GET['page'] = 1; 
      } 
     else 
      { 
       $start = ($_GET['page']-1) * $limit; 
      } 

     return $start; 
    } 
  /*********************************************************************************** 
   * int findPages (int count, int limit) 
   * Returns the number of pages needed based on a count and a limit 
   ***********************************************************************************/ 
   function findPages($count, $limit) 
    { 
     $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1; 

     return $pages; 
    } 
  /*********************************************************************************** 
   * string pageList (int curpage, int pages) 
   * Returns a list of pages in the format of " < [pages] > " 
   ***********************************************************************************/ 
   function pageList($curpage, $pages) 
    { 

	$qs=$_SERVER['QUERY_STRING'];
	for($i=50;$i>-1;$i--){
		$qs = str_replace("&page=".$i,"",$qs);
	}

	

	if($qs)
		$qs.="&amp;";



     $page_list  = ""; 

     /* Print the first and previous page links if necessary  */
     if (($curpage != 1) && ($curpage)) 
      { 
       //$page_list .= "  <a href=\"".$_SERVER['PHP_SELF']."?". $qs ."page=1\" title=\"First Page\"><font face=\"webdings\">7</font></a> "; 
      } 

     if (($curpage-1) > 0) 
      { 
	  	$this->prevPage="<a href=\"".$_SERVER['PHP_SELF']."?". $qs ."page=".($curpage-1)."\" title=\"Previous Page\"><img src=\"images/icons/arow_right.png\" alt=\"הקודם\" title=\"הקודם\" / border=\"0\" /></a> ";
       $page_list .= $this->prevPage; 
      } 

     /* Print the numeric page list; make the current page unlinked and bold */
     for ($i=1; $i<=$pages; $i++) 
      { 
       if ($i == $curpage) 
        { 
         $page_list .= "<b class=\"pager_selected\">".$i."</b>"; 
        } 
       else 
        { 
         $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?". $qs ."page=".$i."\" title=\"Page ".$i."\">".$i."</a>"; 
        } 
       $page_list .= " "; 
      } 
 
     /* Print the Next and Last page links if necessary */ 
     if (($curpage+1) <= $pages) 
      {
		  $this->nextPage= "<a href=\"".$_SERVER['PHP_SELF']."?". $qs ."page=".($curpage+1)."\" title=\"Next Page\"><img src=\"images/icons/arow_left.png\" alt=\"הבא\" title=\"הבא\" / border=\"0\" /></a> "; 
       $page_list .= $this->nextPage; 
	   
      } 

     if (($curpage != $pages) && ($pages != 0)) 
      { 
       //$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?". $qs ."page=".$pages."\" title=\"Last Page\"><font face=\"webdings\">8</font></a> "; 
      } 

    // $page_list .= "</td>\n"; 

     return $page_list; 
    } 
  /*********************************************************************************** 
   * string nextPrev (int curpage, int pages) 
   * Returns "Previous | Next" string for individual pagination (it's a word!) 
   ***********************************************************************************/ 
   function nextPrev($curpage, $pages) 
    { 
     $next_prev  = "<table><tr>"; 

     if (($curpage-1) <= 0) 
      { 
       //$next_prev .= "Previous"; 
      } 
     else 
      { 
       $next_prev .= "<td align=left><a href=\"".$_SERVER['PHP_SELF']."?". $qs ."page=".($curpage-1)."\">Prev</a></td>"; 
      } 

     //$next_prev .= " | "; 

     if (($curpage+1) > $pages) 
      { 
       //$next_prev .= "Next"; 
      } 
     else 
      { 
       $next_prev .= "<td align=right><a href=\"".$_SERVER['PHP_SELF']."?". $qs ."page=".($curpage+1)."\">Next</a></td>"; 
      } 
		
	 $next_prev .= "</tr></table>";

     return $next_prev; 
    } 
  } 
?>
