<?php
	function covertDate($date,$from, $format){	
		if($date ==''){
			return "";
		}
		return DateTime::createFromFormat($from, $date)->format($format);
	}
	
	function FormatNumAcc($num){
		if($num <0)
			return '('.number_format(((-1)*$num),2).')';
		return $num;
	}
	function FormatNumAccRe($num,$R){
		if($num*$R <0)
			return '('.number_format(((-1)*$R*$num),2).')';
		return $num*$R;
	}
	
	
	