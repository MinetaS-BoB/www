<?
//  ###################################################################################
// 
//    return.php
// 
//    Copyright (c) 2004  BANKWELL Co. LTD.
//    All rights reserved.
// 
//  ###################################################################################
//  ###################################################################################
// 
//   PG사에서 승인 결과를 받아 DB에 수정하는 모듈
// 
//  ###################################################################################
// 
//  [ return.php를 호출할때 인자로 넘어오는 구성요소 ]
// 
//   1. ShopCode     : 해당 쇼핑몰 번호(PG사에서 부여받은 코드)
//   2. ReplyCode    : 응답코드로 '0000'이면 정상 그외는 에러처리한다.
//   3. ScrMessage   : 응답메시지
//   4. OrderDate    : 거래요청일자(YYYYMMDD)
//   5. OrderTime    : 거래요청시간(HHMMSS)
//   6. SequenceNo   : 거래요청번호
//   7. OrderNo      : 주문번호
//   8. Installment  : 할부개월
//   9. AcquireCode  : 매입사코드
//  10. AcquireName  : 매입사이름
//  11. ApprovalNo   : 승인번호
//  12. ApprovalTime : 승인일시(YYYYMMDDHHMM000)
//  13. CardIssuer   : 카드발급사이름
//  14. tran_date    : PG사의 거래일자(YYYYMMDD)
//  15. tran_seq     : PG사의 거래번호
//  16. Reserved1    : FILLER
//  17. Reserved1    : FILLER
// 
//    * Mall에서는 해당 페이지를 수정하여 결과를 DB에 수정할 수 있도록 한다.
// 
//  ###################################################################################
//	이곳에 HTML 구문이나 Java Script 구문을 넣지 마세요 !!!
include "./config.php";
include "./log.php";
//include "./mysql_function.php";
include "./php_function.php";

	TraceLog ("Request", "FromPG  : ",
                  "OrderNo="      .  $OrderNo       . ", " .
                  "Amount="       .  $Amount        . ", " .
                  "OrderName="    .  $OrderName     . ", " .
                  "OrderTelNo="   .  $OrderTelNo    . ", " .
                  "BrandName="    .  $BrandName     . ", " .
                  "OrderAddr="    .  $OrderAddr     . ", " .
                  "UserID="       .  $UserID        . ", " .
                  "Reserved1="    .  $Reserved1     . ", " .
				  "MsgTypeCode=" .   $MESSAGETYPECODE  . ", " .
		          "ShopCode="    .   $SHOPCODE         . ", " .
                  "OrderDate="   .   $OrderDate		   . ", " .
                  "OrderTime="   .   $OrderTime		   . ", " .
                  "SequenceNo="  .   $SequenceNo	   . ", " .
                  "OrderNo="     .   $OrderNo		   . ", " .
                  "Amount="      .   $Amount		   . ", " .
                  "OrderName="   .   $OrderName		   . ", " .
                  "OrderTelNo="  .   $OrderTelNo	   . ", " .
                  "BrandName="   .   $BrandName		   . ", " .
                  "OrderAddr="   .   $OrderAddr		   . ", " .
                  "UserID="      .   $UserID	       . ", " .
                  "Email="		  .  $Email	       	   . ", " .
				  "Reserved1="   .   $Reserved1        . ", " .
                  "Reserved2="   .   $Reserved2        . ", " .
                  "RecognPage="  .   $RecognPage	   . ", " .
                  "ErrorPage="   .   $ErrorPage		   . ", " .
				  // for 사용자정의
				  "msgtype="     .   $msgtype		   . ", " .
				  "zip1="        .   $zip1			   . ", " . 
				  "zip2="        .   $zip2			   . ", " . 
                  "addr1="       .   $addr1			   . ", " . 
				  "addr2="       .   $addr2			   . ", " .
				  "deliverName=" .   $deliverName	   . ", " .
				  "deliverTelNo=".   $deliverTelNo	   . ", " .
				  "d_zip1="	     .   $d_zip1		   . ", " .
				  "d_zip2="	     .   $d_zip2		   . ", " .
				  "d_addr1="	 .   $d_addr1		   . ", " .
				  "d_addr2="	 .   $d_addr2		   );                 


 include "../../../config/db_info.php";
 include "../../../config/db_connect.php";
	$sqlstr = "select * from wizBuyers where CODE_VALUE = '$OrderNo'";
	$sqlqry = mysql_query($sqlstr);
	$list = mysql_fetch_array($sqlqry);
	// 아래 if 문에 데이터 베이스 업데이트를 하시면 됩니다(결재성공시).
	if ($ReplyCode == "0000"){		
		 $sqlstr = "update wizBuyers set CardStatus = '', Co_Now = 'C' where CODE_VALUE = '$OrderNo'";
		 $sqlqry = mysql_query($sqlstr); 
		 echo "<script>
		 parent.location.replace('../../../wizbag.php?query=step4&check=$list[Total_Money]&cod=$list[CODE_VALUE]&userName=$list[Sender_Name]&userTel=$list[Sender_Tel]&UserEmail=$list[Sender_Email]&cardmoney=$list[Card_Money]');
		 </script>";
	}else{
		 echo " <script>
		 parent.location.replace('../../../wizbag.php?query=step3&check=$list[How_Buy]&cod=$list[CODE_VALUE]');
		 </script>";
	}
?>