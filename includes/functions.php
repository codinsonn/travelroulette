<?php

	function trace($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	function addError($error){
		if(!isset($_SESSION["errors"])) {
			$_SESSION["errors"] = array();
		}
		$_SESSION["errors"][] = $error;
	}

	function addNotification($index, $notif){
		if(!isset($_SESSION["notifs"])) {
			$_SESSION["notifs"] = array();
		}
		$_SESSION["notifs"][$index] = $notif;
	}

	function encodeURI($url) {
	    $unescaped = array(
	        '%2D'=>'-','%5F'=>'_','%2E'=>'.','%21'=>'!', '%7E'=>'~',
	        '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')'
	    );
	    $reserved = array(
	        '%3B'=>';','%2C'=>',','%2F'=>'/','%3F'=>'?','%3A'=>':',
	        '%40'=>'@','%26'=>'&','%3D'=>'=','%2B'=>'+','%24'=>'$'
	    );
	    $score = array(
	        '%23'=>'#'
	    );
	    return strtr(rawurlencode($url), array_merge($reserved,$unescaped,$score));
	}

	function getDevice(){

		$device = '';

		if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
			$device = "ipad";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') ) {
			$device = "iphone";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') ) {
			$device = "blackberry";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
			$device = "android";
		}

		return $device;

	}

	function get_base_root(){
		$local_root = "http://localhost:1124/thorr.stevens/20152016/TravelRoulette/";
		$live_root = "http://student.howest.be/thorr.stevens/20152016/MAIII/TRAVELROULETTE";

		if(in_array($_SERVER["SERVER_ADDR"], array("127.0.0.1", "::1", "192.168.75.121", "fe80::21c:42ff:fe00:8"))){
		    $root = $local_root;
		}else{
			$root = $live_root;
		}

		return $root;
	}

	function redirect($url) {
		header("Location: {$url}");
		exit();
	}

?>