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
include "../function/filter.php";

/* 다운로드시 회원등급 체크  */
if(file_exists("./table/${GID}/${BID}/detail_config.php")) include  "./table/${GID}/${BID}/detail_config.php";

include "./func/GradePermission.php";
/* 다운 카운트를 올립니다. */

$BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";
$url = "./table/${GID}/${BID}/updir/${filename}";

download_filter($filename);

// 다이렉트로 치고들어오는 경우를 방지
if(ereg("../" , $filename)) js_alert_location("잘못된 접근입니다.","close");


$sql = "select ID from $BOARD_NAME where UID = '$UID'";
$list = _mysql_fetch_array($sql);

if($list[ID] != $_COOKIE[MEMBER_ID]){// 자기 자신이 다운받을시는 카운트를 올리지 않는다.
	mysql_query("UPDATE $BOARD_NAME SET DOWNCOUNT=DOWNCOUNT + 1 WHERE UID='$UID'");
}

// 포인트 감소 부분 추가

if(isMember() && $PointEnable == "checked" ){
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	$Content = "${BOARD_TITLE_DESC} 다운로드시 포인트 부여" ; // 포인트 내용
	$GName = "System" ; // 부여자
	$Flag = "BD";//다운로드시 플래그
	$presult = boolInsertPoint($BOARD_NAME , $_COOKIE[MEMBER_ID] , $GName , $DownPoint , $Flag ,$Content);
	//if(!$presult) js_alert("포인트 DB 작업 실패");
}

	$dn = "1"; 							// 1 이면 다운, 0 이면 브라우져가 인식하면 화면에 출력
	$dn_yn = ($dn) ? "attachment" : "inline";

	$bin_txt = "1"; 						// 아스키면 r, 바이너리면 rb
	$bin_txt = ($bin_txt) ? "r" : "rb";

	if(eregi("(MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) 		// 브라우져 구분
	{
		Header("Content-type: application/octet-stream");
		Header("Content-Length: ".filesize("$url"));   		// 이 부분을 넣어 주어야지 다운로드 진행 상태가 표시 됩니다.
		Header("Content-Disposition: $dn_yn; filename=$filename");
		Header("Content-Transfer-Encoding: binary");
		Header("Pragma: no-cache");
		Header("Expires: 0");
	} else {
		Header("Content-type: file/unknown");
		Header("Content-Length: ".filesize("$url"));
		Header("Content-Disposition: $dn_yn; filename=$filename");
		Header("Content-Description: PHP Generated Data");
		Header("Pragma: no-cache");
		Header("Expires: 0");
	}
	if (is_file("$url"))
	{

	$fp = fopen("$url", "$bin_txt");
	if (!fpassthru($fp))  						// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 기타 보단 이방법이...
	fclose($fp);
	} else {
		js_alert("해당 파일이나 경로가 존재하지 않습니다");

	}
?>
