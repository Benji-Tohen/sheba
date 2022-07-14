<?php
class String{
	
	function String(){

	}

	function htmlentities($str){
		$str=str_replace("&", "&amp;", $str);
		$str=str_replace("\"", "&quot;", $str);
		$str=str_replace("’", "&rsquo;", $str);
		$str=str_replace("‘", "&lsquo;", $str);
		$str=str_replace("’", "&rsquo;", $str);
		$str=str_replace("'", "&#39;", $str);
		return $str;
	}

	function shorten($str, $maxCharacters=20, $useDots=true){
		$strlen=mb_strlen($str, "utf-8");
		$str=mb_substr($str, 0, $maxCharacters, "utf-8");

		if($useDots && $strlen>$maxCharacters){
			$str.="...";
		}
		return $str;
	}

	function getYoutubeCodeFromLink($link){
		list($remove, $link)=explode("v=", $link);
		list($link, $remove)=explode("&", $link);
		return $link;
	}

	function startsWith($haystack, $needle){
	    return !strncmp($haystack, $needle, strlen($needle));
	}

	function jsonEncodeUTF($input) {
		
	    return preg_replace_callback(
		    '/\\\\u([0-9a-zA-Z]{4})/',
		    function ($matches) {
		        return mb_convert_encoding(pack('H*',$matches[1]),'UTF-8','UTF-16');
		    },
		    json_encode($input)
	    );

    }
}
