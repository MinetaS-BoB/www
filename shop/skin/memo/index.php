<?
include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/skin_info.php";
include "../../config/shopDisplay_info.php";
include "../../config/admin_info.php";
include "../../config/cart_info.php";
include "../../function/const_array.php";
include "../../config/membercheck_info.php";// 쪽지 관련 
include "../../function/kerrigancap_lib.php";


// 쪽지용 추가 회원판별 Function
function isForMember($ID){
	global $MEMBER_TABLE_NAME; 
	global $MEMBER_TEMP_FOLDER_NAME; 
	$tmpLoginCnt = false;	
	$cnt = getSingleValue("select count(UID) from ${MEMBER_TABLE_NAME} where ID = '$ID'");
	if($cnt > 0  ) $tmpLoginCnt = true;	
	if($tmpLoginCnt) return true;
	else return false;	
}



if (!isMember()) {
	js_alert_location("로그인후 이용 가능합니다.","close");
}

if($USE_LETTER != "checked"){
	js_alert_location("쪽지기능 사용불가 상태입니다.","close");
}

if($LETTER_DEL_DATE > 0 ){// 쪽지 삭제 일이 지정 되었으면..
// SendDate 와 비교해서 $LETTER_DEL_DATE 일 지났으면..삭제 
	$sql = "select UID , SendDate from ${MEMO_TABLE_NAME}" ; 
	$result = mysql_query($sql);
	while($list = mysql_fetch_array($result)){
		$DelDate = $list[SendDate] + 60*60*24*$LETTER_DEL_DATE;
		if(time() > $DelDate){
			mysql_query("delete from ${MEMO_TABLE_NAME} where UID = '$list[UID]'");
		}				
	}

}

if($mode == "write"){//쪽지 쓰기 	
	if(!$spamfree){// 스팸글 방지로직
		js_alert_location("잘못된 경로로 오셨습니다.(스팸글 방지)","-1");
	}elseif($spamfree < time() - 60*60 || $spamfree > time() - 5){
		js_alert_location("잘못된 경로로 오셨습니다.(스팸글 방지2)","-1");
	} 	
	$ReceiveID = trim($ReceiveID);
	$Subject = htmlspecialchars(addslashes($Subject));
	$Content = htmlspecialchars(addslashes($Content));
	$SendDate = time();
	$SendID = $_COOKIE[MEMBER_ID];
	
	$tmpArray = explode("," , $ReceiveID )  ;
	$tmpArraySize = sizeof($tmpArray) ;
	

	if(in_array($_COOKIE[MEMBER_ID],$tmpArray) ) js_alert_location("자신에게는 쪽지를 보내실수 없습니다.","-1");
			
		for($i = 0 ; $i < sizeof($tmpArray)  ; $i++){
			$sql = "insert into ${MEMO_TABLE_NAME} (ReceiveID , Subject , Content  , SendID  , SendDate , SiteKey ) values (
			'$tmpArray[$i]' , '$Subject' , '$Content'  ,  '$SendID'  , '$SendDate' , '$SiteKey' )" ;
			
			if(isForMember($tmpArray[$i])){						 				
				$result = mysql_query($sql);
				if(!$result) js_alert_location("DB 작업중 에러가 발생하였습니다. ","-1");
			}else{
				js_alert_location("회원에게만 쪽지를 보내실수가 있습니다.","-1");
			}		
		
		}
	
			
	// 보낸 편지함으로 이동한다..
		
		js_location("./$MemoSkin/list.php?MType=send");
		exit;
			
			
				
	
	
}//쓰기 


if($mode == "delete"){
	
	$sql = "delete from ${MEMO_TABLE_NAME} where UID = '$UID'" ; 
	$result = mysql_query($sql);

	if(!$result) js_alert_location("DB 작업중 에러가 발생하였습니다. ","-1");
			
	js_location("./$MemoSkin/list.php?MType=$MType&CURRENT_PAGE=$CURRENT_PAGE");
	exit;	
		
}// 삭제 

if($MType == "write"){
	js_location("./$MemoSkin/write.php?MType=write&ReceiveID=$ReceiveID");
	exit;
}elseif(!$mode) {
	js_location("./$MemoSkin/list.php?MType=rec");
	exit;
}

?>
