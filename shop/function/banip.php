<?	
	if(ereg($_SERVER['REMOTE_ADDR'] , $DENYIP)){
		js_alert_location($_SERVER['REMOTE_ADDR'] . " 아이피는 사이트에 접속하실수 없습니다.", "-1");
	}
?>