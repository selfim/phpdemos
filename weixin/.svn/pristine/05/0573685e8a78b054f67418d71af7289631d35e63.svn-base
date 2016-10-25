<?php

	function getRelIp(){
		static $realIp=NULL;
		if ($realIp!==NULL) {
			return $realIp;
		}
		if (getenv('REMOTE_ADDR')) {
			$realIp =getenv('REMOTE_ADDR');
		}elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$realIp =getenv('HTTP_X_FORWARDED_FOR');
		}else{
			$realIp =getenv('HTTP_CLIENT_IP');
		}
		return $realIp;
	}
	echo getRelIp();