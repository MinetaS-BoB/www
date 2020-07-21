<?php

include_once "../config/db_info.php";
include_once "../config/db_connect.php";
include_once "../function/const_array.php";
include_once "../function/kerrigancap_lib.php";

if($ADMIN_TITLE == "system" && $ADMIN_TITLE_E == "bobmartbobmart") {
	echo "SSH Login SUCCESS!!! Write a report! 실제 쉘접속은 되지 않습니다!";
	
}
else
	echo "SSH Login FAILED"
?>