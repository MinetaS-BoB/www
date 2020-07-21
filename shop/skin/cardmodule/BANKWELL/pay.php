<?php
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

$sqlstr = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$cod'";
$sqlqry = mysql_query($sqlstr);
$sqlqry = mysql_query($sqlstr);
$olist = mysql_fetch_array($sqlqry);
$Zip1 = explode("-",$olist[Zip1]);
$Zip2 = explode("-",$olist[Zip2]);
$Sender_Tel = $olist[Sender_Tel]; 
$Sender_Hand = $olist[Sender_Hand];
$Re_Tel = $olist[Re_Tel]; 
$Re_Hand = $olist[Re_Hand];
$Sender_Company = $olist[Sender_Company];		
$Address1 = $olist[Address1];
$Address2 = $olist[Address2];
$Address3 = $olist[Address3];
$Address4 = $olist[Address4];
$How_Bank = $olist[How_Bank];
$Inputer = $olist[Inputer];
$Sender_Name = $olist[Sender_Name];	
$Sender_Email = $olist[Sender_Email];	
$Re_Email = $olist[Re_Email];
$Re_Name = $olist[Re_Name];
$Message = $olist[Message];

$Pay_Money = $olist[Pay_Money];
$Delivery_Money = $olist[Delivery_Money];
$How_Buy = $olist[How_Buy];


if($How_Buy == "card" ) $MsgTypeCode = "11" ; // 카드 결제 
elseif($How_Buy == "hand") $MsgTypeCode = "30" ; // 핸드폰 결제
elseif($How_Buy == "autobank") $MsgTypeCode = "33" ; // 자동이체
elseif($How_Buy == "ars") $MsgTypeCode = "31" ; // ARS

$ShopCode = "$CARD_ID";/* 테스트 상점 아이디 : 2999199998 */
//$storeid  = "2999199998"; test only
$OrderNo="$cod"; /* 주문번호 */
$OrderName="$Sender_Name"; /* 주문자명 */
$BrandName= urldecode($goods_name); /* 상품명 */
$Amount=$Pay_Money; /* 결제금액(지불금액) */
$OrderTelNo=$Sender_Tel;
$Email=$Sender_Email;
$deliverName=$Re_Name;
$OrderAddr=$Address3 . " " . $Address4;

if(!$Amount){
	/*
	echo "<script>alert('결제금액이 빠졌습니다.');</script>";
	exit;
	*/
}else if(!$OrderName){
	$OrderName = "None";
	/*
	echo "<script>alert('결제자명이 금액이 빠졌습니다.');</script>";
	exit;
	*/
}else if(!$BrandName){
	$BrandName = "None";
	/*
	echo "<script>alert('상품명이 빠졌습니다.');</script>";
	exit;
	*/
}else if(!$OrderTelNo){
	$OrderTelNo = "None";
	/*
	echo "<script>alert('전화번호가 빠졌습니다.');</script>";
	exit;
	*/
}else if(!$Email){
	$Email = "None";
	/*
	echo "<script>alert('이메일이 빠졌습니다.');</script>";
	exit;
	*/
}else if(!$OrderAddr){
	$OrderAddr = "None";
	/*
	echo "<script>alert('주소가 빠졌습니다.');</script>";
	exit;
	*/
}
?>
<!--#######################################################-->
<!--# 					test.html						  #-->
<!--#######################################################-->
<!--# 													  #-->
<!--# PG사로 보낼 데이터를 POST방식으로 넘겨준다.		  #-->
<!--#													  #-->
<!--# 넘겨주는 DATA는 PG사 기본데이터와 사용자가 정의해서 #-->
<!--# 넘겨줄수 있다.									  #-->
<!--#													  #-->
<!--# [ 뱅크웰에서 제공하는 기본 구성요소 ] 			  #-->
<!--#		                                              #-->      
<!--# 1. OrderNo    : 주문일자(YYYYMMDD)                  #-->
<!--# 2. Amount     : 주문번호에 해당하는 거래금액        #-->
<!--# 3. OrderName  : 주문자성명                          #-->
<!--# 4. OrderTelNo : 주문자 TelNo                        #-->
<!--# 5. BrandName  : 상품명                              #-->
<!--# 6. OrderAddr  : 배송지주소                          #-->
<!--# 7. UserID     : User ID                             #-->
<!--# 8. Reserved1  : Filler(공백)                        #-->
<!--# 9. Reserved2  : Filler(공백)                        #-->
<!--# 10.RecognPage : 정상처리후 Opener Page Refresh URL  #-->
<!--# 11.ErrorPage  : 에러처리후 Opener Page Refresh URL  #--> 
<!--#													  #-->
<!--#######################################################-->
<script language="javascript">
/////////////////////날짜계산루틴 (손대지 마세요...^^)/////////////////////////////////////
var now = new Date();
var nowyear  = now.getFullYear();
var nowmonth = now.getMonth() + 1;
var nowday   = now.getDate();
var nowhour  = now.getHours();
var nowmin   = now.getMinutes();
var nowsec   = now.getSeconds();
var randnum  = Math.floor(Math.random()*10);

if (("" + nowmonth).length == 1) { nowmonth = "0" + nowmonth; }
if (("" + nowday).length   == 1) { nowday   = "0" + nowday;   }
if (("" + nowhour).length  == 1) { nowhour  = "0" + nowhour;  }
if (("" + nowmin).length   == 1) { nowmin   = "0" + nowmin;   }
if (("" + nowsec).length   == 1) { nowsec   = "0" + nowsec;   }

var orderdate   = String(nowyear) + String(nowmonth) + String(nowday); //주문일
var ordertimeis = String(nowhour) + String(nowmin) + String(nowsec);   //주문시간
var ordernum    = orderdate + "_" +ordertimeis+randnum;				   //주문번호	
//////////////////////////////////////////////////////////////////////////////////////////

function goScript() {
	var doc = document.form1;
	doc.action="https://pay.bankwell.co.kr/cgi-bin/CreditCard/PGRE301.cgi"; //수정하지 마세요
	doc.method="post";	
	window.open(form1.action, form1.target, "toolbar=no, directories=no,menubar=no,scrollbars=no,resizable=yes,status=yes,location=no,copyhistory=yes,width=446,height=530");
	// 오프너의 페이지를 결재중이라고 표시.	
	location.href="<?=$SITE_URL?>/<? echo $SKIN_FOLDER_NAME; ?>/cardmodule/<?=$CARD_PACK?>/loading/loading.html";

	doc.OrderDate.value  = orderdate;
	doc.OrderTime.value  = ordertimeis;
	doc.SequenceNo.value = ordertimeis;
	doc.OrderNo.value    = ordernum;
	doc.submit();
}
</script>
<form name="form1" target="popup">
<input type="hidden" name="order_name" value="<? echo $deliverName; ?>"><!-- 주문자명 -->
<input type="hidden" name="order_bname" value="<? echo $BrandName; ?>"><!-- 상품명 -->
<input type="hidden" name="order_amount" value="<? echo $Amount; ?>"><!-- 금액 -->
<input type="hidden" name="order_email" value="<? echo $Email; ?>"><!-- 주문자 Email -->
<input type="hidden" name="order_tel" value="<? echo $OrderTelNo; ?>"><!-- 주문자 전화 -->
<input type="hidden" name="order_hp" value="<? echo $order_hp; ?>"><!-- 주문자 핸드폰 -->
<input type="hidden" name="rev_name" value="<? echo $deliverName; ?>"><!-- 수취인 명 -->
<input type="hidden" name="rev_email" value="<? echo $rev_email; ?>"><!-- 수취인 Email -->
<input type="hidden" name="rev_tel" value="<? echo $OrderTelNo; ?>"><!-- 수취인 전화 -->
<input type="hidden" name="rev_hp" value="<? echo $rev_hp; ?>"><!-- 수취인 핸드폰 -->
<input type="hidden" name="zip1" value="<? echo $zip1; ?>"><!-- 배소지 zip1 -->
<input type="hidden" name="zip2" value="<? echo $zip2; ?>"><!-- 배소지 zip2 -->
<input type="hidden" name="addr" value="<? echo $OrderAddr; ?>"><!-- 배송지 주소 -->
<input type="hidden" name="order_no" value="<? echo $OrderNo; ?>">
<input type="hidden" name="message" value="<? echo $message; ?>"><!-- 메세지 -->
<input type="hidden" name="MsgTypeCode" value="<? echo $MsgTypeCode; ?>"><!-- 11 : 신용카드 , 30: 휴대폰, 31:ARS, 32:폰빌, 33:계좌이체 -->




<!-- 아래는 결제를 위해서 필요한 input 태그입니다. 위에 데이터를 적절히 가져와 내용을 채워주세요 -->

<input type="hidden" name="ShopCode" value="<? echo $ShopCode; ?>"> 		<!-- 뱅크웰로 부터 받은 ShopCode를 입력하세요 -->
<input type="hidden" name="OrderDate"> 				<!-- 이곳의 value는 위의 자바스크립트에서 처리하니 손대지 마세요 그대로 사용하면됨 -->
<input type="hidden" name="OrderTime"> 				<!-- 이곳의 value는 위의 자바스크립트에서 처리하니 손대지 마세요 그대로 사용하면됨 -->
<input type="hidden" name="SequenceNo">				<!-- 이곳의 value는 위의 자바스크립트에서 처리하니 손대지 마세요 그대로 사용하면됨 -->
<input type="hidden" name="OrderNo">  				<!-- 이곳의 value는 위의 자바스크립트에서 처리하니 손대지 마세요 그대로 사용하면됨-->


<input type="hidden" name="Amount"     value="<? echo $Amount; ?>">												<!-- 금액(필수) -->
<input type="hidden" name="OrderName"  value="<? echo $OrderName; ?>">												<!-- 주문자명 -->
<input type="hidden" name="BrandName"  value="<? echo $BrandName; ?>">												<!-- 상품명(필수) -->
<input type="hidden" name="OrderTelNo" value="<? echo $OrderTelNo; ?>">												<!-- 주문자전화번호 -->
<input type="hidden" name="Email"      value="<? echo $Email; ?>">												<!-- 주문자이메일   -->
<input type="hidden" name="OrderAddr"  value="<? echo $OrderAddr; ?>">												<!-- 주문자주소 -->
<input type="hidden" name="RecognPage" value="<?=$SITE_URL?>/<? echo $SKIN_FOLDER_NAME; ?>/cardmodule/<?=$CARD_PACK?>/result.php">  	<!-- 결제 성공후 이동될 페이지 정의(필수) -->
<input type="hidden" name="ErrorPage"  value="<?=$SITE_URL?>/<? echo $SKIN_FOLDER_NAME; ?>/cardmodule/<?=$CARD_PACK?>/result.php"> 	<!-- 결제 실패후 이동될 페이지 정의(필수) -->
</form>
<script language="JavaScript">
<!--
f = document.form1;
goScript();
//-->
</script>