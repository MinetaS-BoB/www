<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";


$DB_CONNECT = mysql_connect(trim($db_host), trim($db_user), trim($db_password));
$result = mysql_select_db($USER_DB, $DB_CONNECT);
if ( !$DB_CONNECT || !$result ) js_alert_location("\\n\\nMYSQL 관련 입력정보가 일치하지 않아, 프로그램을 설치할 수 없습니다.\\n\\n입력정보를 다시한번 확인해 주십시오.\\n\\n","-1");


$fp = fopen("../config/db_connect.php", "w");
fwrite($fp,"<?	
	\$DB_CONNECT = mysql_connect(\$MYSQL_HOST, \$MYSQL_ID, \$MYSQL_PASSWORD);
	mysql_select_db(\$MYSQL_DB, \$DB_CONNECT);
	if ( !\$DB_CONNECT ) {echo \"mysql 데이터 베이스에 연결할 수 없습니다.\"; exit;}
?>");
fclose($fp);

$fp = fopen("../config/db_info.php", "w");
fwrite($fp,"<?
\$MYSQL_HOST = \"$db_host\";
\$MYSQL_DB = \"$USER_DB\";
\$MYSQL_ID = \"$db_user\";
\$MYSQL_PASSWORD = \"$db_password\";
?>");
fclose($fp);


?>
<HTML><HEAD>
<SCRIPT language=javascript>
        window.alert('\n\n<? echo $admin ; ?>님 Data Base 및 디렉토리 설치가 완료되었습니다.\n\n상세 정보페이지 설정으로 이동합니다.. \n\n');
        window.top.location.replace('./install4.php?PASS=<?=$PASS?>&admin=<? echo $admin;?>&query=setcookie');
</SCRIPT>