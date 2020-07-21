<?
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
// ###################################################################################
//
//   config.php
//
//   Copyright (c) 2004 BANKWELL Co. LTD.
//   All rights reserved.
//
// ###################################################################################
//
//                             환경 변수 선언 모듈
//
// ###################################################################################
//
//                  [ Mall의 환경에 맞게 수정이 필요한 부분 ]
//
//  1. LOG_FLAG     : Log화일을 생성할지 여부를 결정하는 Flag
//                    (1 : LOG_PATH에 해당하는 디렉토리에 Log화일 생성)
//  3. LOG_PATH     : LOG_FLAG가 1일경우 생성할 Log화일의 디렉토리 PATH
//  4. TABLE_NAME   : Table 명
//  5. SHOPCODE     : PG사에서 부여받은 상점번호.
//  6. SERVER_URL   : PG사 Server URL
//  7. SERVER_FILE  : PG사 신용카드 승인 요청 FILE
//
//  * 주의
//      SERVER_RUL의 정보는 PG사에서 별도의 변경 요청이
//      있기전까지는 변경해서는 안된다.
//
// ###################################################################################

$LOG_FLAG          = "0";					// 0: 로그기록 남기지않음 1: 로그기록남기기
//$LOG_PATH        = "/temp/shoplogs/"; 	//로그 남길 디렉토리 절대경로
// $ADULT_CD	   = "1";					//성인컨텐츠 사용일 경우(Mobile에만 적용됨)

// 거래구분 코드(11:신용카드승인, 30:핸드폰승인, 31:ARS결제, 32:폰빌 결제, 33:계좌이체)

if ($msgtype == "30"){ 
	$MESSAGETYPECODE   = "30";     			//거래구분코드(30:핸드폰승인)
}else if ($msgtype == "31"){ 
	$MESSAGETYPECODE   = "31";     			//거래구분코드(31:ARS결제)
}else if ($msgtype == "32"){ 
	$MESSAGETYPECODE   = "32";     			//거래구분코드(32:폰빌결제)
}else if ($msgtype == "33"){ 
	$MESSAGETYPECODE   = "33";     			//거래구분코드(33:계좌이체)
}else{ 
	$MESSAGETYPECODE   = "11";     			//거래구분코드(11:신용카드승인)
}


$SHOPCODE          = "$CARD_ID";			//뱅크웰에서 부여받은 가맹점번호(shopcode)를 넣으세요
if ($ADULT_CD == "1" && $MESSAGETYPECODE == "30") {
	$SERVER_URL        = "https://pay.bankwell.co.kr/bankwell/jsp/";
	$SERVER_FILE       = "Ready.jsp";
} else {
	$SERVER_URL        = "https://pay.bankwell.co.kr/cgi-bin/CreditCard/";
	$SERVER_FILE       = "PGRE301.cgi";
}

?>