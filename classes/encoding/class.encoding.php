<?php
class Encoding{

	function Encoding(){
	
	}

	function utf8_to_unicode( $str ) {
			
			$unicode = array();        
			$values = array();
			$lookingFor = 1;
			
			for ($i = 0; $i < strlen( $str ); $i++ ) {
	
				$thisValue = ord( $str[ $i ] );
				
				if ( $thisValue < 128 ) $unicode[] = $thisValue;
				else {
				
					if ( count( $values ) == 0 ) $lookingFor = ( $thisValue < 224 ) ? 2 : 3;
					
					$values[] = $thisValue;
					
					if ( count( $values ) == $lookingFor ) {
				
						$number = ( $lookingFor == 3 ) ?
							( ( $values[0] % 16 ) * 4096 ) + ( ( $values[1] % 64 ) * 64 ) + ( $values[2] % 64 ):
							( ( $values[0] % 32 ) * 64 ) + ( $values[1] % 64 );
							
						$unicode[] = $number;
						$values = array();
						$lookingFor = 1;
				
					} // if
				
				} // if
				
			} // for
	
			return $unicode;
		
		} // utf8_to_unicode
		
		
	function utf8win1251($s){
	$out="";$c1="";$byte2=false;
	for ($c=0;$c<strlen($s);$c++){
	$i=ord($s[$c]);
	if ($i<=127) $out.=$s[$c];
	if ($byte2){
	$new_c2=($c1&3)*64+($i&63);
	$new_c1=($c1>>2)&5;
	$new_i=$new_c1*256+$new_c2;
	if ($new_i==1025) $out_i=168; else
	if ($new_i==1105) $out_i=184; else $out_i=$new_i-848;
	$out.=chr($out_i);
	$byte2=false;}
	if (($i>>5)==6) {$c1=$i;$byte2=true;}
	}
	return $out;}
	
	
	function utf_ascii($utf){
		$ascii="";
		for($i=0;$i<strlen($utf);$i++){
			$currOrd=ord($utf[$i]);
			echo "\r\n<br>".$currOrd."  =>  ". $utf[$i] ." => ". chr($currOrd+9);
			if($currOrd>224 && $currOrd<250){
				$currChar=chr($currOrd+9);
			}else{
				$currChar=$utf[$i];
			}
			
			$ascii.=$currChar;
		}
		return $ascii;
	}	
	
	
	function hebUTF_2_win1255($utf){
		
		$win1255=$utf;
		
		$uni_win_heb=array("א","ב","ג","ד","ה","ו","ז","ח","ט","י","ך","כ","ל","ם","מ","ן","נ","ס","ע","ף","פ","ץ","צ","ק","ר","ש","ת");
		for($i=0;$i<count($uni_win_heb);$i++){
			$win1255=str_replace($uni_win_heb[$i], chr($i+224), $win1255);
		}
	
		//$win1255=str_replace(chr, chr(300), $win1255);
		
		return $win1255;
	}
	
	function unicode_hebrew($str) {
	   for ($ii=0;$ii<strlen($str);$ii++) {
		   $xchr=substr($str,$ii,1);
		   if (ord($xchr)>223) {
			   $xchr=ord($xchr)+1264;
			   $xchr="&#" . $xchr . ";";
		   }
		   $encode=$encode . $xchr;
	
	   }
	   return $encode;
	}


	function decode_unicoded_hebrew($str) {
	   $decode="";
	
	   $ar=explode("&#",$str);
	
	   foreach ($ar as $value ) {
	
		   $in1=strpos($value,";"); //end of code
	
		   if ($in1>0) {// unicode
	
			   $code=substr($value,0,$in1);
				   
			   if ($code>=1456 and $code<=1514) { //hebrew
					   $code=$code-1264;
				   $xchr=chr($code);
				   } else { //other unicode
				   $xchr="&#" . $code . ";";
				 } 
			   $xchr=$xchr . substr($value,$in1+1);  
		   } else //not unicode
				 $xchr = $value;
		   
	
		   $decode=$decode . $xchr;
	   }
	   return $decode;
	}
	
	function Encode ( $str, $type )
	{
	 // $type: 
	// 'w' - encodes from UTF to win 
	 // 'u' - encodes from win to UTF 
	
	   static $conv='';
	   if (!is_array ( $conv ))
	   {    
		   $conv=array ();
		   for ( $x=128; $x <=143; $x++ )
		   {
			 $conv['utf'][]=chr(209).chr($x);
			 $conv['win'][]=chr($x+112);
		   }
	
		   for ( $x=144; $x <=191; $x++ )
		   {
				   $conv['utf'][]=chr(208).chr($x);
				   $conv['win'][]=chr($x+48);
		   }
	 
		   $conv['utf'][]=chr(208).chr(129);
		   $conv['win'][]=chr(168);
		   $conv['utf'][]=chr(209).chr(145);
		   $conv['win'][]=chr(184);
		 }
		 if ( $type=='w' )
			 return str_replace ( $conv['utf'], $conv['win'], $str );
		 elseif ( $type=='u' )
			 return str_replace ( $conv['win'], $conv['utf'], $str );
		 else
		   return $str;
	  }
	


}
?>
