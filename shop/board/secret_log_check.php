<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../config/db_info.php";
include "../config/db_connect.php";
include "../config/admin_info.php";
include "../config/board_info.php";
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";





if(!$SameDB){
	$BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";
	$UpdirPath = $BID;
}else{
	$BOARD_NAME="${DEFAULT_TABLE_NAME}_${SameDB}";
	$UpdirPath = $SameDB;
	}
/****[확장DB사용시] *******/
if($ExtendDB)
$BOARD_NAME="$ExtendDB";


if(!strcmp($Mode, "SecretLogin")): // 비밀글이나 수정시

	/* 일반 게시물 등록자의 정보를 가져온다. */
	$SqlStr = "select UID, PASSWD, THREAD, FID from $BOARD_NAME where UID = $UID";
	$sqlqry = mysql_query($SqlStr);
	$list = mysql_fetch_array($sqlqry);

	if($mode == "secret")://비밀글 로그인일경우
		if(strcmp($list[THREAD],"A")){
			$SqlStr = "select PASSWD from $BOARD_NAME where FID = $list[FID] and THREAD = 'A'";
			$sqlqry = mysql_query($SqlStr);
			$list = mysql_fetch_array($sqlqry);
		}

		$url="../$BOARD_MAIN_FILE_NAME?BID=$BID&GID=$GID&mode=$nmode&rmode=$rmode&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax";

		if($SecretPASS == $list[PASSWD]){
			$COOKIE_VALUE = $UID."_".$BID."_".$GID;
			setcookie("SECRET", "$COOKIE_VALUE", 0, "/");
			js_location("$url");
			exit;
		}else{//로그인 실패일경우
			js_alert_location("비밀글 로그인에 실패하였습니다.\\n\\n비밀번호를 체크해주세요","$url");
		}

	else ://modify로그인일경우

		$url="../$BOARD_MAIN_FILE_NAME?BID=$BID&GID=$GID&mode=$nmode&rmode=$rmode&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax";

		if($SecretPASS == $list[PASSWD]){
			$COOKIE_VALUE = $UID."_".$BID."_".$GID;
			setcookie("MODIFY", "$COOKIE_VALUE", 0, "/");
			js_location("$url");
			exit;
		}else{//로그인 실패일경우
			js_alert_location("수정모드 로그인에 실패하였습니다.\\n\\n비밀번호를 체크해주세요","$url");
		}

	endif;


endif;
?><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
