<?php
	function rip_tags($string) { 
		$string = preg_replace ('/<[^>]*>/', ' ', $string); 
		$string = str_replace("\r", '', $string);
		$string = str_replace("\n", ' ', $string);
		$string = str_replace("\t", ' ', $string);
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		
		return $string; 
	}
?>