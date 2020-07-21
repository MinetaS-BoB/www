<?php
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";

$mid = "$CARD_ID";/* 테스트 상점 아이디 : 2999199998 */
//$storeid  = "2999199998"; test only
$OrderNo="$cod"; /* 주문번호 */
$OrderName="$userName"; /* 주문자명 */
$BrandName="$goods_name"; /* 상품명 */
$amount="$TOTAL_MONEY"; /* 결제금액 */
$TmpTel = split("\-", $UserTel1);
$OrderTelNo=$UserTel1;
$Email=$UserEmail;
$deliverName=$Re_Name;
$OrderAddr=$Re_Address;



//  #####################################################################

	include "php_function.php";	
	//아래는 주문번호를 생성하는것임, 유니크한 것이면 어떤값이든 상관없음.
	$g_OrderDate = f_Now_Date();
	$g_OrderTime = f_NOW_Time();	
	$orderNum = $g_OrderDate . "-" . $g_OrderTime . rand(10,99);
?>
<form name="payfrm" method="post" action="request.php">
<!--주문번호-->
<input type="hidden" name="OrderNo" value="<?= $OrderNo ?>">
<!--결재성공후 이동될페이지-->
<input type="hidden" name="RecognPage" value="<?=$MART_BASEDIR?>/skinwiz/cardmodule/<?=$PHONE_PACK?>/result.php">
<!--결재실패후 이동될페이지-->
<input type="hidden" name="ErrorPage"  value="<?=$MART_BASEDIR?>/skinwiz/cardmodule/<?=$PHONE_PACK?>/result.php">
<input type="hidden" name="OrderAddr" value="<? echo $OrderAddr;?>">
<!-- 결제지 주소 (상세주소포함) -->
<input type="hidden" name="msgtype" value="30"><!-- 11 : 신용카드, 33 : 계좌이체, 30 : 핸드폰 --> 

<input type="hidden" name="BrandName" value="<?=$BrandName?>" ><!--  상품명 -->
<input type="hidden" name="Amount" value="<?=$amount?>"><!--  결제가격 -->
<input name="OrderName" type="hidden" value="<?=$OrderName?>"><!--  이 름 -->
<input name="Email" type="hidden" value="<?=$Email?>"><!-- E-mail  -->
<input name="OrderTelNo" type="hidden" value="<?=$OrderTelNo?>"><!-- 전화번호  -->
<input name="zip1" type="hidden">
<input name="zip2" type="hidden"><!-- 우편번호  -->
<input name="deliverName" type="hidden" value="<?=$deliverName?>"><!--  이 름 -->
<input name="deliverTelNo" type="hidden"><!-- 전화번호  -->
<input name="d_zip1" type="hidden">
<input name="d_zip2" type="hidden"><!--  우편번호 -->
<input name="d_addr1" type="hidden"><!--  주 소 -->
<input name="d_addr2" type="hidden"><!-- 상세주소  -->
</form>
<script language="JavaScript">
<!--
f = document.payfrm;
f.submit();
//-->
</script>