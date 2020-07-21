<?php


	$DB_CONNECT = mysql_connect($MYSQL_HOST, $MYSQL_ID, $MYSQL_PASSWORD);
	mysql_select_db($MYSQL_DB, $DB_CONNECT);
	if ( !$DB_CONNECT ) {echo "mysql 데이터 베이스에 연결할 수 없습니다."; exit;}


?>
