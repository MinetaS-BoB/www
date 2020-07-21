<?php
//<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
/**********************************************************************************************
*
* 파일명 : AGS_pay_result.php
* 작성일자 : 2005/03
*
* 소켓결제결과를 처리합니다.
*
* Copyright 2004-2005 AEGISHYOSUNG.Co.,Ltd. All rights reserved.
*
**********************************************************************************************/

$AuthTy = trim( $_POST["AuthTy"] );							//결제형태
$SubTy = trim( $_POST["SubTy"] );							//서브결제형태
$rStoreId = trim( $_POST["rStoreId"] );						//업체ID
$rBusiCd = trim( $_POST["rBusiCd"] );						//전문코드
$rOrdNo = trim( $_POST["rOrdNo"] );							//주문번호
$rProdNm = trim( $_POST["rProdNm"] );						//상품명
$rApprNo = trim( $_POST["rApprNo"] );						//승인번호
$rAmt = trim( $_POST["rAmt"] );								//거래금액
$rSuccYn = trim( $_POST["rSuccYn"] );						//성공여부
$rResMsg = trim( $_POST["rResMsg"] );						//실패사유
$rApprTm = trim( $_POST["rApprTm"] );						//승인시각
$rCardCd = trim( $_POST["rCardCd"] );						//카드사코드
$rCardNm = trim( $_POST["rCardNm"] );						//카드사명
$rMembNo = trim( $_POST["rMembNo"] );						//가맹점번호
$rAquiCd = trim( $_POST["rAquiCd"] );						//매입사코드
$rAquiNm = trim( $_POST["rAquiNm"] );						//매입사명
$rBillNo = trim( $_POST["rBillNo"] );						//전표번호
$rDealNo = trim( $_POST["rDealNo"] );						//거래고유번호
$ICHE_OUTBANKNAME = trim( $_POST["ICHE_OUTBANKNAME"] );		//이체계좌은행명
$ICHE_OUTACCTNO = trim( $_POST["ICHE_OUTACCTNO"] );			//이체계좌번호
$ICHE_OUTBANKMASTER = trim( $_POST["ICHE_OUTBANKMASTER"] );	//이체계좌소유주
$ICHE_AMOUNT = trim( $_POST["ICHE_AMOUNT"] );				//이체금액
$rHP_TID = trim( $_POST["rHP_TID"] );						//핸드폰결제TID
$rHP_DATE = trim( $_POST["rHP_DATE"] );						//핸드폰결제날짜
$rHP_HANDPHONE = trim( $_POST["rHP_HANDPHONE"] );			//핸드폰결제핸드폰번호
$rHP_COMPANY = trim( $_POST["rHP_COMPANY"] );				//핸드폰결제통신사명(SKT,KTF,LGT)
$rVirNo = trim( $_POST["rVirNo"] );				            //가상계좌번호 가상계좌추가
$VIRTUAL_CENTERCD = trim( $_POST["VIRTUAL_CENTERCD"] );				            //가상계좌번호 가상계좌추가

?>
<script language=javascript> // "지불처리중" 팝업창 닫기
<!--
var openwin = window.open("AGS_progress.html","popup","width=300,height=160");
openwin.close();
-->
</script>
<?
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";


$sqlstr = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$rOrdNo'";
$sqlqry = mysql_query($sqlstr);
$list = mysql_fetch_array($sqlqry);
$PayDate = time();
	
if($rSuccYn == "y"){
		 $sqlstr = "UPDATE ${BUYER_TABLE_NAME} SET CardStatus = '', Co_Now = '20' WHERE CODE_VALUE = '$rOrdNo'";
		 $sqlqry = mysql_query($sqlstr); 
   echo "<script>
	 parent.location.replace('../../../${CART_MAIN_FILE_NAME}?query=step3&cod=$rOrdNo');
	 </script>";	 
}else{
	 echo " <script>
	 parent.location.replace('../../../${CART_MAIN_FILE_NAME}?query=step2&cod=$rOrdNo');
	 </script>";
}
exit;
?>
<html>
<head>
<title>올더게이트</title>
<style type="text/css">
<!--
body { font-family:"돋움"; font-size:9pt; color:#000000; font-weight:normal; letter-spacing:0pt; line-height:180%; }
td { font-family:"돋움"; font-size:9pt; color:#000000; font-weight:normal; letter-spacing:0pt; line-height:180%; }
.clsright { padding-right:10px; text-align:right; }
.clsleft { padding-left:10px; text-align:left; }
-->
</style>
<script language=javascript> // "지불처리중" 팝업창 닫기
<!--
var openwin = window.open("AGS_progress.html","popup","width=300,height=160");
openwin.close();
-->
</script>
<script language=javascript>
<!--
//////////////////////////////////////////////////////
// 영수증 출력은 카드결제시에만 사용하실 수 있습니다.
//////////////////////////////////////////////////////
function show_receipt() 
{
	if("<?=$rSuccYn?>"== "y" && "<?=$AuthTy?>"=="card")
	{
		url="http://www.allthegate.com/customer/receiptLast3.jsp"
		url=url+"?sRetailer_id="+sRetailer_id.value;
		url=url+"&approve="+approve.value;
		url=url+"&send_no="+send_no.value;
		
		window.open(url, "window","toolbar=no,location=no,directories=no,status=,menubar=no,scrollbars=no,resizable=no,width=470,height=700,top=0,left=150");
	}
	else
	{
		alert("해당하는 결제내역이 없습니다");
	}
}
-->
</script>
</head>
<body topmargin=0 leftmargin=0 rightmargin=0 bottommargin=0>
<table border=0 width=100% height=100% cellpadding=0 cellspacing=0>
	<tr>
		<td align=center>
		<table width=400 border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<td class=clsleft>지불 결과</td>
			</tr>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<td>
				<table width=400 border=0 cellpadding=0 cellspacing=0>
					<tr>
						<td class=clsright width=150>결제형태 : </td>
						<td class=clsleft width=250>
<?php

if($AuthTy == "card")
{
	if($SubTy == "isp")
	{
		echo "신용카드결제 - 안전결제(ISP)";
	}	
	else if($SubTy == "visa3d")
	{
		echo "신용카드결제 - 안심클릭";
	}
	else if($SubTy == "normal")
	{
		echo "신용카드결제 - 일반결제";
	}
	
}
else if($AuthTy == "iche")
{
	echo "계좌이체";
}
else if($AuthTy == "hp")
{
	echo "핸드폰결제";
}else if($AuthTy == "virtual")
{
	echo "가상계좌결제";
}

?>
						</td>
					</tr>
					<tr>
						<td class=clsright>상점아이디 : </td>
						<td class=clsleft><?=$rStoreId?></td>
					</tr>
					<tr>
						<td class=clsright>전문코드 : </td>
						<td class=clsleft><?=$rBusiCd?></td>
					</tr>
					<tr>
						<td class=clsright>주문번호 : </td>
						<td class=clsleft><?=$rOrdNo?></td>
					</tr>
					<tr>
						<td class=clsright>상품명 : </td>
						<td class=clsleft><?=$rProdNm?></td>
					</tr>
					<tr>
						<td class=clsright>승인번호 : </td>
						<td class=clsleft><?=$rApprNo?></td>
					</tr>
					<tr>
						<td class=clsright>승인금액 : </td>
						<td class=clsleft><?=$rAmt?></td>
					</tr>
					<tr>
						<td class=clsright>성공여부 : </td>
						<td class=clsleft><?=$rSuccYn?></td>
					</tr>
					<tr>
						<td class=clsright>처리메세지 : </td>
						<td class=clsleft><?=$rResMsg?></td>
					</tr>
					<tr>
						<td class=clsright>승인시각 : </td>
						<td class=clsleft><?=$rApprTm?></td>
					</tr>
					<tr>
						<td class=clsright>카드사코드 : </td>
						<td class=clsleft><?=$rCardCd?></td>
					</tr>
					<tr>
						<td class=clsright>카드사명 : </td>
						<td class=clsleft><?=$rCardNm?></td>
					</tr>
					<tr>
						<td class=clsright>매입사코드 : </td>
						<td class=clsleft><?=$rAquiCd?></td>
					</tr>
					<tr>
						<td class=clsright>매입사명 : </td>
						<td class=clsleft><?=$rAquiNm?></td>
					</tr>
					<tr>
						<td class=clsright>가맹점번호 : </td>
						<td class=clsleft><?=$rMembNo?></td>
					</tr>
					<tr>
						<td class=clsright>전표번호 : </td>
						<td class=clsleft><?=$rBillNo?></td>
					</tr>
					<tr>
						<td class=clsright>거래고유번호 : </td>
						<td class=clsleft><?=$rDealNo?></td>
					</tr>
					<tr>
						<td class=clsright>이체계좌은행명 : </td>
						<td class=clsleft><?=$ICHE_OUTBANKNAME?></td>
					</tr>
					<tr>
						<td class=clsright>이체계좌번호 : </td>
						<td class=clsleft><?=$ICHE_OUTACCTNO?></td>
					</tr>
					<tr>
						<td class=clsright>이체계좌소유주 : </td>
						<td class=clsleft><?=$ICHE_OUTBANKMASTER?></td>
					</tr>
					<tr>
						<td class=clsright>이체금액 : </td>
						<td class=clsleft><?=$ICHE_AMOUNT?></td>
					</tr>
					<tr>
						<td class=clsright>핸드폰결제TID : </td>
						<td class=clsleft><?=$rHP_TID?></td>
					</tr>
					<tr>
						<td class=clsright>핸드폰결제날짜 : </td>
						<td class=clsleft><?=$rHP_DATE?></td>
					</tr>
					<tr>
						<td class=clsright>핸드폰결제핸드폰번호 : </td>
						<td class=clsleft><?=$rHP_HANDPHONE?></td>
					</tr>
					<tr>
						<td class=clsright>핸드폰결제통신사명 : </td>
						<td class=clsleft><?=$rHP_COMPANY?></td>
					</tr>
                     <tr><!-- 가상계좌추가 -->
						<td class=clsright>입금계좌번호 : </td>
						<td class=clsleft><?=$rVirNo?></td>
					</tr>
                    <tr><!-- 가상계좌추가 -->
						<td class=clsright>입금은행 : </td>
						<td class=clsleft><?=$VIRTUAL_CENTERCD?></td>
					</tr>
                    <tr><!-- 가상계좌추가 -->
						<td class=clsright>예금주명 : </td>
						<td class=clsleft>(주)이지스효성</td>
					</tr>
                    <tr>
						<td class=clsright>영수증 :</td>
						<!--영수증출력을위해서보내주는값-------------------->
						<input type=hidden name=sRetailer_id value="<?=$rStoreId?>"><!--상점아이디-->
						<input type=hidden name=approve value="<?=$rApprNo?>"><!---승인번호-->
						<input type=hidden name=send_no value="<?=$rOrdNo?>"><!--주문번호-->
						<!--영수증출력을위해서보내주는값-------------------->
						<td class=clsleft><input type="button" value="영수증" onClick="javascript:show_receipt();"></td>
					<tr>
						<td colspan=2>&nbsp;</td>
					</tr>
					<tr>
						<td align=center colspan=2>카드 이용명세서에 구입처가 <font color=red>이지스효성(주)</font>로 표기됩니다.</td>
					</tr>
					
				</table>
				</td>
			</tr>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<td class=clsleft>Copyright 2004-2005 AEGISHYOSUNG.Co.,Ltd. All rights reserved.</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>
