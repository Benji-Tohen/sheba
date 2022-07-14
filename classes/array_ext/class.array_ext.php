<?php
class ArrayExt{ 

	function ArrayExt(){
	
	}

	
	function array_qsort (&$array, $column, $order='SORT_ASC', $first=0, 
	$last= -2){
	  // $array  - the array to be sorted
	  // $column - index (column) on which to sort
	  //          can be a string if using an associative array
	  // $order  - SORT_ASC (default) for ascending or SORT_DESC for descending
	  // $first  - start index (row) for partial array sort
	  // $last  - stop  index (row) for partial array sort
	  // $keys  - array of key values for hash array sort
	 if (is_array($array)) {
	  $keys = array_keys($array);
	 
	  if($last == -2) $last = count($array) - 1;
	  if($last > $first) {
	   $alpha = $first;
	   $omega = $last;
	   $key_alpha = $keys[$alpha];
	   $key_omega = $keys[$omega];
	   $guess = $array[$key_alpha][$column];
	   while($omega >= $alpha) {
		 if($order == 'SORT_ASC') {
		   while($array[$key_alpha][$column] < $guess) {$alpha++; $key_alpha 
	= $keys[$alpha]; }
		   while($array[$key_omega][$column] > $guess) {$omega--; $key_omega 
	= $keys[$omega]; }
		 } else {
		   while($array[$key_alpha][$column] > $guess) {$alpha++; $key_alpha 
	= $keys[$alpha]; }
		   while($array[$key_omega][$column] < $guess) {$omega--; $key_omega 
	= $keys[$omega]; }
		 }
		 if($alpha > $omega) break;
		 $temporary = $array[$key_alpha];
		 $array[$key_alpha] = $array[$key_omega]; $alpha++;
		 $key_alpha = $keys[$alpha];
		 $array[$key_omega] = $temporary; $omega--;
		 $key_omega = $keys[$omega];
	   }
	   $this->array_qsort ($array, $column, $order, $first, $omega);
	   $this->array_qsort ($array, $column, $order, $alpha, $last);
	  }
	 }
	  return $array;
	}
	

   function in_multi_array( $p_needle, $p_haystack )
   {

       if( !is_array( $p_haystack ) )
       {
           return false;
       }
		
       if( in_array( $p_needle, $p_haystack ) )
       {
           return true;
       }

       foreach( $p_haystack as $row )
       {
           if( $this->in_multi_array( $p_needle, $row ) )
           {
               return true;
           }
       }

       return false;
   } 

}
?>