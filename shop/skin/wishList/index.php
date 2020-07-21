<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/skin_info.php";
include "../../config/shopDisplay_info.php";
include "../../config/admin_info.php";
include "../../config/cart_info.php";
include "../../function/const_array.php";
include "../../function/kerrigancap_lib.php";


include "../../function/member_check_module.php" ; // 회원체크

if ($mode == 'insert') {// 하나 이력

		
		$cnt = getSingleValue("select count(UID) from ${WISHLIST_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]' and PID = '$no'");// 기존에 담아 져 있는지 검사
		if($cnt > 0 ) js_alert_location("고객님이 선택하신 제품은 이미 위시리스트에 담겨 있는 제품입니다.","-1");
		
		//옵션이 있을경우 
	  if($Option1 || $Option2)   js_alert_location("옵션이 있는 상품은 위시리스트에 담을수 없습니다.","-1");
		
		$WDate = time();		
		$sql = "insert into ${WISHLIST_TABLE_NAME} (ID, PID , OptionDetail , WDate , SiteKey) values 
				('$_COOKIE[MEMBER_ID]', '$no' , '$OptionDetail' , '$WDate' , '$SiteKey' ) ";		
		$result = mysql_query($sql);
		
		if($result){		
			$WISH_NUM = getSingleValue("select count(UID) as cnt from ${WISHLIST_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]'");			
			js_alert_location("\\n\\n선택하신 제품을 WISH LIST 에 담았습니다.    \\n\\n현재 고객님의 WISH LIST에는 ${WISH_NUM}개의 제품이 담겨있습니다.\\n\\n","../../${MEMBER_MAIN_FILE_NAME}?query=wish");
		}else{
			js_alert_location("DB 작업중 에러가 발생 했습니다.","-1");
		}

	
} else if($mode == "delete"){// 삭제
	
		
		$sql = "delete from ${WISHLIST_TABLE_NAME} where UID = '$UID' and ID = '$_COOKIE[MEMBER_ID]'";
				
		$result = mysql_query($sql);
		if($result){
			 js_alert_location("\\n\\n선택하신 제품을 WISH LIST 에서 삭제하였습니다   \\n\\n","../../${MEMBER_MAIN_FILE_NAME}?query=wish");
		}else{
			js_alert_location("DB 작업중 에러가 발생 했습니다.","-1");
		}

} else if($mode == "truncate"){// 모두 삭제

		$sql = "delete from ${WISHLIST_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]'";
		$result = mysql_query($sql);
		if($result){
			js_alert_location("\\n\\n위시 리스트를 성공적으로 삭제 시켰습니다.   \\n\\n","../../${MEMBER_MAIN_FILE_NAME}?query=wish");
		}else{
			js_alert_location("DB 작업중 에러가 발생 했습니다.","-1");
		}

// 다중 입력란 구현예정
}


?>