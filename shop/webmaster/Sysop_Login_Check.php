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

if(ereg($_POST['ADMINID'] , $DENYID)) js_alert_location("접근거부 아이디 입니다.","-1");
if(!$_POST['ADMINID'] || !$_POST['ADMINPASS'] || !$_POST['IP']) js_alert_location("잘못된 접근입니다.","-1");

$ADMINID = trim(strtolower($ADMINID));
$ADMINPASS = trim(strtolower($ADMINPASS));

$sql = "select ID , PWD , Name , NickName , Grade , Email , GrantSta from ${MEMBER_TABLE_NAME} where ID = '$ADMINID' and PWD = '$ADMINPASS'" ;
$result = mysql_query($sql);
$list = mysql_fetch_array($result);

$ALLOWFORADMIN = explode("|" , $ALLOWFORADMIN);
if(!$list[ID]) js_alert_location("아이디 패스워드가 일치 하지 않습니다","./index.php");
if(!in_array($list[Grade] , $ALLOWFORADMIN)) js_alert_location("접근허용 회원등급이 아닙니다.","./index.php"); 
if(ereg($IP , $DENYIP)) js_alert_location("접근거부 아이피 입니다.","./index.php");
if($list[GrantSta] != "checked" ) js_alert_location("승인이 안되었거나 삭제된 회원입니다,","./index.php");



	if($list[Grade] == "1")  setcookie("ROOT_PASS", "$ADMINPASS", 0, "/");


	 setcookie("ADMIN_CHECK_GRADE", "$list[Grade]", 0, "/");
	 setcookie("MEMBER_NAME", "$list[Name]", 0, "/");
	 setcookie("MEMBER_ID", "$list[ID]", 0, "/");
	 setcookie("MEMBER_EMAIL", "$list[Email]", 0, "/");
	 setcookie("MEMBER_GRADE", "$list[Grade]", 0, "/");
	 setcookie("MEMBER_NICKNAME", "$list[NickName]", 0, "/");

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


	 $fp = fopen("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$ADMINID.cgi", "w");
	 $LoginTime = time();
	 fwrite($fp, "$list[ID]|$list[Name]|$LoginTime|$list[Email]|$list[Grade]|$list[NickName]|");
	 fclose($fp);

	srand ((double) microtime() * 1000000);
	$value = rand(2,3);
	setcookie("ROOT_COLOR_TYPE", "$value", 0, "/");

	$result = boolInsertLoginHistory($list[ID] , $IP , '관리자페이지' , $_SERVER['HTTP_REFERRER'] , 'LOGIN' );
	if(!$result) js_alert("Login History DB 작업중 에러");

	$DLIST = _mysql_fetch_array("SELECT  WDate FROM ${LOGIN_HISTORY_TABLE_NAME} WHERE ID='$ADMINID' order by WDate Desc Limit 1");

	if( date("ymd") != date("ymd",$DLIST[WDate]) ){//오늘에 2번 로그인시는 해당 되지 않는다..

		$time = time();
		$Content = date("Y-m-d H : i : s"). " 로그인 " ;
		$GName = "System";// 포인트 부여자
		$Flag = "L";// 로그인 플래그
		boolInsertPoint('',$ADMINID , $GName , $LPoint , $Flag ,$Content);
	}

	js_alert_location("${list[Name]} 님 ${MEMBER_GRADE_NAME[$list[Grade]]} 모드로 로그인 되셨습니다. " , "./main.php?THEME=Front" );


?>
