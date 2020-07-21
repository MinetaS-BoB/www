<?
include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/admin_info.php";
include "../../config/skin_info.php";
include "../../config/shopDisplay_info.php";
include "../../config/cart_info.php";
include "../../function/const_array.php";
include "../../config/membercheck_info.php";// 쪽지 관련 
include "../../function/kerrigancap_lib.php";


if (!isMember()) {
	js_alert_location("로그인후 이용 가능합니다.","close");
}

if($USE_SCRAB != "checked"){
	js_alert_location("스크랩기능 사용불가 상태입니다.","close");
}



if($mode == "write"){//스크랩 쓰기 	
		
	
	$ID = $_COOKIE[MEMBER_ID];
	$ScrapType = $Type;
	$TableName = $Tbl ; 
	$DocNo = $UID;
	$WDate = time();
	
	$ExitCnt = getSingleValue("select count(*) from ${SCRAP_TABLE_NAME} where ID = '$ID' and ScrapType = '$ScrapType' and TableName = '$TableName' and DocNo = '$DocNo'");
	
	if($ExitCnt > 0) js_alert_location("이미 스크랩 하셨습니다.","close");
	
	$result =  boolInsertScrap($ID , $ScrapType , $TableName , $DocNo);
	
	if(!$result) js_alert_location("DB 작업중 에러가 발생하였습니다.","close");
			
			
	// 보낸 편지함으로 이동한다..
		
		js_location("./$ScrapSkin/list.php");
		exit;
							
	
	
}//쓰기 


if($mode == "delete"){
	
	$sql = "delete from ${SCRAP_TABLE_NAME} where UID = '$UID'" ; 
	$result = mysql_query($sql);
	
	if($result) js_alert_location("성공적으로 삭제 되었습니다","./");
	else js_alert_location("DB 작업중 에러가 발생하였습니다. ","-1");
			
	
}// 삭제 


if(!$mode) {
	js_location("./$ScrapSkin/list.php");
	exit;
}

?>
