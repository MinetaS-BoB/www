<?
//  #####################################################################

//                                                                       

//    가맹점 TEST 화면                                                   

//                                                                       

//  #####################################################################

//                                                                       

//  [ PG사 지불처리 TEST화면 ]                                           

//                                                                       

//   1. OrderNo       : 주문번호(해당날짜에대한 유일한 번호)             

//   2. Amount        : 거래금액                                         

//   3. OrderName     : 주문자 성명                                      

//   4. OrderTelNo    : 주문자 전화번호                                  

//   5. BrandName     : 상품명                                           

//   6. OrderAddr     : 배송지 주소                                      

//   7. UserID        : User ID                                          

//   8. Reserved1     : 임시 필드1                                       

//   9. Reserved2     : 임시 필드2                                       

//   10. Email        : 주문자 Email                                     

//   11. RecognPage   : 결제성공후 넘겨줄 페이지 정의                    

//   12. ErrorPage    : 결제실패시 넘겨줄 페이지 정의                    

//                                                                       

//           *  주의                                                     

//           1. 주문번호와 주문금액은 필수입력사항이다.                  

//           2. 문의전화 : 1566-0430									 

//                                                                       

//  #####################################################################

	include "php_function.php";	
	//아래는 주문번호를 생성하는것임, 유니크한 것이면 어떤값이든 상관없음.
	$g_OrderDate = f_Now_Date();
	$g_OrderTime = f_NOW_Time();	
	$orderNum = $g_OrderDate . "-" . $g_OrderTime . rand(10,99);
?>
<html>
<head>
	<style type="text/css">
		.menuTitle{ width:300px; height:30px; border:1px solid #808080; cursor:hand;}		  
		.blk { display:inline-block; background-color:#ffffff;	padding:0px;}		  
		.non { display:none; position:relative; top:-19px; left:0px;}
	</style>
	<script language="javascript">
		function sametop(){
			frm = document.payfrm;
			if (frm.same.checked){
				frm.deliverName.value  = frm.OrderName.value;
				frm.deliverTelNo.value = frm.OrderTelNo.value;
				frm.d_zip1.value       = frm.zip1.value;
				frm.d_zip2.value	   = frm.zip2.value;
				frm.d_addr1.value      = frm.addr1.value;
				frm.d_addr2.value      = frm.addr2.value;
			}else{
				frm.deliverName.value  = "";
				frm.deliverTelNo.value = "";
				frm.d_zip1.value       = "";
				frm.d_zip2.value	   = "";
				frm.d_addr1.value      = "";
				frm.d_addr2.value      = "";	
			}
		}
	
		function CheckIt(){
			frm = document.payfrm;
			if (!frm.msgtype[0].checked && !frm.msgtype[1].checked && !frm.msgtype[2].checked){
				alert("결제수단을 선택하셔야 합니다 !!!");
				return;
			}
			// 아래는 배송지 주소를 처리하는 내용입니다.
			frm.OrderAddr.value = frm.d_addr1.value + " " + frm.d_addr2.value;
			if (!frm.BrandName.value)   {alert("상품명을 입력하세요!"); frm.BrandName.focus(); return;}
			if (!frm.Amount.value)      {alert("가격을 입력하세요 !"); frm.Amount.focus(); return;}
			if (!frm.OrderName.value)   {alert("구매자 이름을 입력하세요"); frm.OrderName.focus(); return;}
			if (!frm.OrderTelNo.value)  {alert("구매자 전화번호가 없습니다 !"); frm.OrderTelNo.focus(); return;}
			if (!frm.addr1.value)       {alert("주소가 없습니다 !"); frm.addr1.focus(); return;}
			if (!frm.deliverName.value) {alert("수령자 명이 없습니다 !"); frm.deliverName.focus(); return;}
			if (!frm.deliverTelNo.value){alert("수령자 전화번호가 없습니다 !"); frm.deliverTelNo.focus(); return;}
			if (!frm.d_addr1.value)     {alert("수령자 주소가 없습니다 !"); frm.d_addr1.focus(); return;}
			
			frm.submit();
		}
	</script>
</head>
<body>
<form name="payfrm" method="post" action="request.php">
<!--주문번호-->
<input type="hidden" name="OrderNo" value="<?= $orderNum ?>">
<!--결재성공후 이동될페이지-->
<input type="hidden" name="RecognPage" value="http://www.happyday69.com/skinwiz/cardmodule/BANKWELL/result.php">
<!--결재실패후 이동될페이지-->
<input type="hidden" name="ErrorPage"  value="http://www.happyday69.com/skinwiz/cardmodule/BANKWELL/result.php">
<input type="hidden" name="OrderAddr">

<table width="500" border="0" cellpadding="3" cellspacing="2" >
<tr>
	<td bgcolor="#efefef" colspan="2" align="center">		
		<input type="radio" name="msgtype" value="11">신용카드 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type="radio" name="msgtype" value="33">계좌이체 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<input type="radio" name="msgtype" value="30">핸드폰 &nbsp; &nbsp; 
	</td></tr>

<!-- 아래의 구매자 정보는 여기서 제시한 name명으로 모든값이 들어갈수 있게 처리해주세요-->
<tr>
	<td bgcolor="#cdcdcd" colspan="2" align="center"> <b>구매자정보</b> </td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> 상품명</td>
	<td bgcolor="#efefef"><input type="text" name="BrandName" ></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> 결제가격</td>
	<td bgcolor="#efefef"><input type="text" name="Amount" >원</td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> 이 름 </td>
	<td bgcolor="#efefef"><input name="OrderName" type="text" ></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> E-mail</td>
	<td bgcolor="#efefef"><input name="Email" type="text" ></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> 전화번호</td>
	<td bgcolor="#efefef"><input name="OrderTelNo" type="text" size="20"></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> 우편번호</td>
	<td bgcolor="#efefef">
		<input name="zip1" type="text" size="7"> - <input name="zip2" type="text" size="7">
	</td></tr>
<tr>
	<td rowspan="2" bgcolor="#efefef"><font color="#CC3300">*</font> 주 소</td>
	<td bgcolor="#efefef"><input name="addr1" type="text" size="35"></td></tr>
<tr>
	<td bgcolor="#efefef"> <input name="addr2" type="text" size="26"> 상세주소</td></tr>
<tr>
	<td bgcolor="#cdcdcd" colspan="2" align="center"> <b>배송지정보</b> &nbsp; &nbsp; 
		<input type="checkbox" name="same" onClick="javascript:sametop()">위와같음</td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> 이 름 </td>
	<td bgcolor="#efefef"><input name="deliverName" type="text" ></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> 전화번호</td>
	<td bgcolor="#efefef"><input name="deliverTelNo" type="text" size="20"></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> 우편번호</td>
	<td bgcolor="#efefef">
		<input name="d_zip1" type="text" size="7"> - <input name="d_zip2" type="text" size="7">
	</td></tr>
<tr>
	<td rowspan="2" bgcolor="#efefef"><font color="#CC3300">*</font> 주 소</td>
	<td bgcolor="#efefef"><input name="d_addr1" type="text" size="35"></td></tr>
<tr>
	<td bgcolor="#efefef"> <input name="d_addr2" type="text" size="26"> 상세주소</td></tr>
<tr>
<tr>
	<td colspan="2" bgcolor="#efefef">
		<table border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
				<a href="javascript:CheckIt();">결재하기</a>
			</td>
			<td width="2">&nbsp;</td>
			<td>
				<a href="javascript:history.back();">취소</a>	
			</td></tr>
		</table>
	</td></tr>
</form>
</body>
</html>