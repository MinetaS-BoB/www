<?
//  ###################################################################################
// 
//    request.php
// 
//    Copyright (c) 2004 BANKWELL Co. LTD.
//    All rights reserved.
// 
//  ###################################################################################
// 
//    PG사로 신용카드 승인요청을 요구한다.
// 
//  ###################################################################################
// 
//  [ request.php를 호출할때 인자로 넘어오는 구성요소 ]
// 
//   1. OrderDate    : 주문일자(YYYYMMDD)
//   2. Amount       : 주문번호에 해당하는 거래금액
//   3. OrderName    : 주문자성명
//   4. OrderTelNo   : 주문자 TelNo
//   5. BrandName    : 상품명
//   6. OrderAddr    : 배송지주소
//   7. UserID       : User ID
//   8. Reserved1    : Filler(공백)
//   9. Reserved2    : Filler(공백)
// 
//       * 주의
//          1. 주문번호와 승인금액은 반듯이 존재하여야 한다.
//          2. 호출형식은 OpenWindow형식으로 하는것을 원칙으로 한다.
// 
//  ###################################################################################
include "./config.php";
include "./log.php";
include "./mysql_function.php";
include "./php_function.php";

//*************************************************************************
//  ShoppingMall의 결제요청 화면으로 부터 POST방식으로 전달되어온 인자값들을
//  받아 입력값의 유효성여부를 검사하는 루틴
//*************************************************************************
Function RecvFromMerchant()
{  
	global $MESSAGETYPECODE, $SHOPCODE, $OrderDate, $OrderTime, $SequenceNo, $OrderNo, $Amount, $OrderName, $OrderTelNo;
	global $BrandName,	$OrderAddr,	$UserID,$Email, $Reserved1, $Reserved2, $RecognPage, $ErrorPage ;
	
	// 아래는 사용자 정의(test.php파일 참조)
	global $msgtype, $zip1, $zip2, $addr1, $addr2, $deliverName, $deliverTelNo, $d_zip1, $d_zip2, $d_addr1, $d_addr2;
	
   //==========================================================================
   // Log Write (write log file) //넘어온값에 대한 로그를 남긴다
   //==========================================================================
   TraceLog ("Request", "상점에서넘겨받은값 : ",
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
                 
	//==========================================================================
	// 입력정보 검사
	//==========================================================================
	// 거래(주문)번호 체크 최하 1000원
	
	if (strlen($OrderNo) < 3 or strlen($OrderNo) > 100) {return "orderno";}						  // 주문번호체크
	else If (strlen($Amount) < 3 Or strlen($Amount) > 9 Or !FncOnlyDigits($Amount)) {return "amount";} // 거래금액체크
	else if (trim($OrderName)   == "") {return "ordername";}
	else if (trim($BrandName)   == "") {return "brandname";}
	else if (trim($OrderTelNo)  == "") {return "ordertelno";}
	else if (trim($deliverName) == "") {return "delivername";}
	else if (trim($OrderAddr)   == " "){return "orderaddr";}
	else{
		return "";
	}	
}

//*************************************************************************
//  Merchant의 결제요청 화면으로 부터 입력받은 값들을 이용하여 PG사의
//  승인 입력화면 인자로 전송할 전문을 생성하는 루틴
//*************************************************************************
function MakeReqPacket()
{
	global $MESSAGETYPECODE, $SHOPCODE, $OrderDate, $OrderTime, $SequenceNo, $OrderNo, $Amount, $OrderName, $OrderTelNo;
	global $BrandName,	$OrderAddr,	$UserID,$Email, $Reserved1, $Reserved2, $RecognPage, $ErrorPage ;
	
	// 아래는 사용자 정의(test.php파일 참조)
	global $msgtype, $zip1, $zip2, $addr1, $addr2, $deliverName, $deliverTelNo, $d_zip1, $d_zip2, $d_addr1, $d_addr2;

	$strAstric = chr(38);
	// Current System Date
	$OrderDate = f_Now_Date();
	// Current System Time
	$OrderTime = f_Now_Time();
	// 거래일자별 유니크한 순번 생성
	$SequenceNo = $OrderTime;

	// 요청전문 생성
	$g_ReqPacket = "MsgTypeCode=" .   $MESSAGETYPECODE  .   $strAstric .
		           "ShopCode="    .   $SHOPCODE         .   $strAstric .
                   "OrderDate="   .   $OrderDate		.   $strAstric .
                   "OrderTime="   .   $OrderTime		.   $strAstric .
                   "SequenceNo="  .   $SequenceNo		.   $strAstric .
                   "OrderNo="     .   $OrderNo			.   $strAstric .
                   "Amount="      .   $Amount			.   $strAstric .
                   "OrderName="   .   $OrderName		.   $strAstric .
                   "OrderTelNo="  .   $OrderTelNo		.   $strAstric .
                   "BrandName="   .   $BrandName		.   $strAstric .
                   "OrderAddr="   .   $OrderAddr		.   $strAstric .
                   "UserID="      .   $UserID			.   $strAstric .
                   "Email="		  .   $Email			.   $strAstric .
				   "Reserved1="   .   $Reserved1        .   $strAstric .
                   "Reserved2="   .   $Reserved2        .   $strAstric .
                   "RecognPage="  .   $RecognPage		.   $strAstric .
                   "ErrorPage="   .   $ErrorPage		.   $strAstric .	
				   // for 사용자정의
				   "msgtype="     .   $msgtype			.   $strAstric .
				   "zip1="        .   $zip1			    .   $strAstric . 
				   "zip2="        .   $zip2			    .   $strAstric . 
                   "addr1="       .   $addr1			.   $strAstric . 
				   "addr2="       .   $addr2			.   $strAstric .
				   "deliverName=" .   $deliverName		.   $strAstric .
				   "deliverTelNo=".   $deliverTelNo		.   $strAstric .
				   "d_zip1="	  .   $d_zip1			.   $strAstric .
				   "d_zip2="	  .   $d_zip2			.   $strAstric .
				   "d_addr1="	  .   $d_addr1			.   $strAstric .
				   "d_addr2="	  .   $d_addr2			.   $strAstric ;

	TraceLog ("Request", "BankWell로넘길전문 : ", "g_ReqPacket=" . $g_ReqPacket );
	return $g_ReqPacket;
}


   //*************************************************************************
   //  MAIN
   //*************************************************************************
	TraceLog ("Request", "Request 시작 =======================================", "===> Start");

   $htmlHead = "<HTML><HEAD></HEAD><BODY><CENTER><BR><BR>";
   $htmlTail = "</CENTER></BODY></HTML>";

   // Merchant로부터 전달된 인자를 받아온다
   
	$bRetVal = RecvFromMerchant();

   if ($bRetVal <> ""){		
		if ($bRetVal == "orderno"){
			print "<script language='javascript'>alert('주문번호형식이 정확하지 않습니다.'); history.back();</script>";
		}else if ($bRetVal == "brandname"){
			print "<script language='javascript'>alert('상품명이 없습니다'); history.back();</script>";	
		}else if ($bRetVal == "amount"){
			print "<script language='javascript'>alert('금액을 확인해주세요'); history.back();</script>";
		}else if ($bRetVal == "ordername"){
			print "<script language='javascript'>alert('구매자 성명이 없습니다'); history.back();</script>";
		}else if ($bRetVal == "ordertelno"){
			print "<script language='javascript'>alert('구매자 전화번호 없습니다'); history.back();</script>";
		}else if ($bRetVal == "delivername"){
			print "<script language='javascript'>alert('수령자 성명이 없습니다'); history.back();</script>";
		}else if ($bRetVal == "orderaddr"){
			print "<script language='javascript'>alert('수령지 주소가 없습니다'); history.back();</script>";	
		}
   }
   
   // 승인 요청 전문을 생성한다.
   $strTargetURL = $SERVER_URL . $SERVER_FILE . "?" . MakeReqPacket();

   TraceLog ("Request", "PG사로넘기는값 : ", $strTargetURL );
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=euc_kr">
<TITLE></TITLE>
</HEAD>
<BODY>
<CENTER>
<BR><BR><BR>
<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" valign="center">
<tr>
	<td><img src="img/2.gif" width="500" height="34"></td></tr>
<tr>
	<td><img src="img/S.gif" width="500" height="31"></td></tr>
<tr>
	<td height="47"><br></td></tr>
<tr>
	<td><div align="center"><a href="javascript:history.go(-1);"><img src="img/3.gif" width="146" height="44" border="0"></a></div></td></tr>
<tr>
	<td><img src="img/4.gif" width="500" height="51"></td></tr>
<tr>
	<td>&nbsp;</td></tr>
</table></CENTER>
<SCRIPT LANGUAGE="JavaScript">
<!--
   time_id = setTimeout('TimeClosing()', 500);
//-->
</SCRIPT>
</BODY>
</HTML>
<SCRIPT LANGUAGE="JavaScript">
<!--
   var time_id;
   function TimeClosing()
   {
      clearTimeout(time_id);
      window.open("<?echo $strTargetURL ?>", "Connection", "toolbar=no, directories=no,menubar=no,scrollbars=no,resizable=yes,status=yes,location=no,copyhistory=yes,width=610,height=600");
   }
//-->
</SCRIPT>