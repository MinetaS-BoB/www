<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include "../config/db_info.php";
include "../config/db_connect.php";
include "../config/admin_info.php";
include "../config/membercheck_info.php";
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";

include "../function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$ID = filter($ID);
$PWD = filter($PWD);


$ID = trim($ID);
$PWD = trim($PWD);


$ID_Length = strlen($ID);



if(ereg($IP , $DENYIP)) js_alert_location("접근거부 아이피 입니다.","-1");
$DENYID = explode("|" , $DENYID);
if(in_array($ID , $DENYID)) js_alert_location("접근거부 아이디 입니다.","-1");


if(!$ReturnUrl) $ReturnUrl="../";
else $ReturnUrl = urldecode($ReturnUrl);

if(!$_POST['ID'] || !$_POST['PWD'] || !$_POST['IP']) {
	js_alert_location("아이디와 패스워드를 모두 입력해 주십시오.","-1");
}

if(($ID_Length >= 15) || ($ID_Length < 4)) {
	js_alert_location("아이디는 4~15 자 사이의 영문숫자 혼합으로 구성되어야 합니다.","-1");
}

$MEMBER_EXISTS = mysql_query("SELECT ID,PWD,Name,Email,Url,Jumin1,Grade,NickName,Sex FROM ${MEMBER_TABLE_NAME} WHERE ID='$ID'");

$LIST = mysql_fetch_array($MEMBER_EXISTS);
if ( !$LIST ) js_alert_location("존재하지 않는 아이디 입니다.","-1");

/* 패스워드 책크 */

$MEMBER_EXISTS = mysql_query("SELECT ID,PWD,Name,NickName,Email,Url,Jumin1,Jumin2,Grade,NickName,Sex
FROM ${MEMBER_TABLE_NAME}
WHERE ID='$ID'
AND PWD='$PWD'", $DB_CONNECT);
$LIST = mysql_fetch_array($MEMBER_EXISTS);

if ( !$LIST ) js_alert_location("패스워드가 일치하지 않습니다.","-1");

/* 승인여부 책크 */

$MEMBER_EXISTS = mysql_query("SELECT ID,PWD,Name,Email,Url,Jumin1,Grade,NickName,Sex
FROM ${MEMBER_TABLE_NAME}
WHERE ID='$ID'
AND PWD='$PWD'
AND GrantSta='checked'", $DB_CONNECT);

$LIST = mysql_fetch_array($MEMBER_EXISTS);

if ( !$LIST ) js_alert_location("회원님은 승인이 이루어 지지 않았습니다. \\n 자세한 사항은 관리자에게 문의하세요.","-1");


$CurrentID = $LIST[ID];     // 아이디
$CurrentPWD = $LIST[PWD];     // 비번
$CurrentNAME = $LIST[Name]; // 이름
$CurrentEMAIL = $LIST[Email]; // 이멜
$CurrentURL = $LIST[Url];     // 홈
$CurrentGrade = $LIST[Grade];     // 등급

/*******************************************************************************
회원로그파일의 생성시간을 구해서 2시간(mktime()기준 - 7200)이 경과된 경우 자동삭제..
*******************************************************************************/

$LOG_DIR = opendir("../${MEMBER_TEMP_FOLDER_NAME}/login_user");
while($LOG_FILE = readdir($LOG_DIR)) {
	if(is_file("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE") && mktime() - filemtime("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE") > 7200) {
		unlink("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE");
	}
}
closedir($LOG_DIR);



// 로그인에 대한 포인트 부여 하루에 한번만..
$DLIST = _mysql_fetch_array("SELECT  WDate FROM ${LOGIN_HISTORY_TABLE_NAME} WHERE ID='$CurrentID' order by WDate Desc Limit 1");

if( date("ymd") != date("ymd",$DLIST[WDate]) ){//오늘에 2번 로그인시는 해당 되지 않는다..

		$time = time();
		$Content = date("Y-m-d H : i : s"). " 로그인 " ;
		$GName = "System";// 포인트 부여자
		$Flag = "L";// 로그인 플래그
		boolInsertPoint('',$CurrentID , $GName , $LPoint , $Flag ,$Content);
}


//로그인 기록
$result = boolInsertLoginHistory($CurrentID , $IP , '사이트' , $_SERVER['HTTP_REFERRER']);

// 로그인 집계용 기록
$LLIST = mysql_fetch_array(mysql_query("SELECT LoginNum FROM ${MEMBER_TABLE_NAME}  WHERE ID='$CurrentID'"));
$UPDATE_LOGIN_NUM = $LLIST[LoginNum] + 1;
mysql_query("UPDATE ${MEMBER_TABLE_NAME}  SET LoginNum='$UPDATE_LOGIN_NUM' WHERE ID='$CurrentID'") or die(mysql_error());


setcookie("MEMBER_NAME", "$CurrentNAME", 0, "/");
setcookie("MEMBER_ID", "$CurrentID", 0, "/");
setcookie("MEMBER_EMAIL", "$CurrentEMAIL", 0, "/");
setcookie("MEMBER_GRADE", "$CurrentGrade", 0, "/");
setcookie("MEMBER_NICKNAME", "$CurrentNickName", 0, "/");
if($CurrentGrade == "1") {
setcookie("ADMIN_CHECK_GRADE", "1", 0, "/");// 1등급이면 관리자 권한을 준다.
setcookie("ROOT_PASS", "$CurrentPWD", 0, "/");
srand ((double) microtime() * 1000000);
$value = rand(2,3);
setcookie("ROOT_COLOR_TYPE", "$value", 0, "/");
}


$fp = fopen("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$CurrentID.cgi", "w");
$LoginTime = time();
fwrite($fp, "$CurrentID|$CurrentNAME|$LoginTime|$CurrentEMAIL|$CurrentGrade|$CurrentNickName|");
fclose($fp);

if(!strcmp($ispopup, "yes")){// 팝업인경우 팝업 닫고 지정된 URL로 이동
js_opener_location($ReturnUrl);
exit;
}
// 장바구니일 경우는 플래그 처리 필요
js_location("$ReturnUrl");
exit;
?>
