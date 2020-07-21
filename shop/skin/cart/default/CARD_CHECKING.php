<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
/*
	비회원 주문시 비밀번호 (이름 + 비밀번호로 조회)
	이메일란 2개 (주문자와 배송지정보)
	희망 배송일 추가
	택배비 필드 추가(기존의 총합-결제 금액) 은 차등 가격시 문제가 많이 됨..
	결제모듈 변동

	다중 구매는 삭제
	모든거래는 포인트를 기본으로 한다..

	온라인 + 포인트
	실시간 계좌 이체 + 포인트
	핸드폰 + 포인트

	PayMoney 하나로 통합

*/

$PWD = $_POST[PWD];
if ($PointMoney) $PointMoney = str_replace("," , "" , $PointMoney);
if ($PayMoney) $PayMoney = str_replace("," , "" , $PayMoney);
else $PayMoney = str_replace("," , "" , $TOTAL_MONEY);

if (is_file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")) {
        $Co_Name_Array = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
        for ($i = 0; $i < sizeof($Co_Name_Array) && $Co_Name_Array[$i] ; $i++) {
                $Co_Name = "$Co_Name".chop($Co_Name_Array[$i])."\n";
        }
}

$ID = $_COOKIE[MEMBER_ID];
//현재 동일 데이타가 있는지 책크
$sqlstr = "select count(UID) from ${BUYER_TABLE_NAME} where CODE_VALUE = '$_COOKIE[CART_CODE]'";
$sqlqry = mysql_query($sqlstr);
$result = @mysql_result($sqlqry, 0, 0);

if(!$result){  /*cod값이 없으면 처음 입력되는 것이고 cod값이 있으면 수정모드이다 */
	$CODE_VALUE = $_COOKIE[CART_CODE]; // 장바구니고유코드
	$PWD = addslashes(trim($PWD));
	$Message = addslashes($Message);
	$Address1 = addslashes($Address1);
	$Address2 = addslashes($Address2);
	$Address3 = addslashes($Address3);
	$Address4 = addslashes($Address4);
	$Sender_Tel = $Tel1_1."-".$Tel1_2."-".$Tel1_3;
	$Sender_Hand = $Tel2_1."-".$Tel2_2."-".$Tel2_3;
	$Sender_Email = $Sender_Email1 . "@" . $Sender_Email2;
	$Re_Tel = $Tel3_1."-".$Tel3_2."-".$Tel3_3;
	$Re_Hand = $Tel4_1."-".$Tel4_2."-".$Tel4_3;
	$Re_Email = $Re_Email1 . "@" . $Re_Email2;
	$BuyDate = time();
	$WishDate = getCreateDate($WDY,$WDM,$WDD);// 배송 희망일

	if($PayType == "bank") $PayDate = getCreateDate($DY,$DM,$DD) ;// 입금예정일(온라인 입급일경우)


$sql = "INSERT INTO  ${BUYER_TABLE_NAME} (
ID , PWD , Sender_Name , Sender_Company , Sender_Email , Sender_Tel , Sender_Hand , Zip1 , Address1 , Address2 , Re_Name ,
Re_Email , Re_Tel , Re_Hand , Zip2 , Address3 , Address4 , Message , How_Buy , How_Bank , Inputer , Point_Money , Pay_Money ,
Delivery_Money , Total_Money , CODE_VALUE , Co_Now , Co_Name , PayDate , BuyDate , WishDate , Reserved1 , Reserved2 , SiteKey ) VALUES (

'$ID' , '$PWD' , '$Sender_Name' , '$Sender_Company' , '$Sender_Email' , '$Sender_Tel' , '$Sender_Hand' , '${Zip1_1}-${Zip1_2}' , '$Address1' , '$Address2' , '$Re_Name' ,
'$Re_Email' , '$Re_Tel' , '$Re_Hand' , '${Zip2_1}-${Zip2_2}' ,'$Address3' , '$Address4' , '$Message' , '$PayType' , '$How_Bank' , '$Inputer' , '$PointMoney' , '$PayMoney' ,
'$Delivery_Money' , '$TOTAL_MONEY' , '$CODE_VALUE' , '10' , '$Co_Name' , '$PayDate' , '$BuyDate' , '$WishDate' , '$Reserved1' , '$Reserved2' , '$SiteKey'
)";
echo $sql;
$db_result = mysql_query($sql);

if(!$db_result) js_alert_location("DB 작업중 에러가 발생 하였습니다","-1");

}else{

	$CODE_VALUE = $_COOKIE[CART_CODE]; // 장바구니고유코드
	$PWD = addslashes(trim($PWD));
	$Message = addslashes($Message);
	$Address1 = addslashes($Address1);
	$Address2 = addslashes($Address2);
	$Address3 = addslashes($Address3);
	$Address4 = addslashes($Address4);
	$Sender_Tel = $Tel1_1."-".$Tel1_2."-".$Tel1_3;
	$Sender_Hand = $Tel2_1."-".$Tel2_2."-".$Tel2_3;
	$Sender_Email = $Sender_Email1 . "@" . $Sender_Email2;
	$Re_Tel = $Tel3_1."-".$Tel3_2."-".$Tel3_3;
	$Re_Hand = $Tel4_1."-".$Tel4_2."-".$Tel4_3;
	$Re_Email = $Re_Email1 . "@" . $Re_Email2;
	$BuyDate = time();
	$WishDate = getCreateDate($WDY,$WDM,$WDD);// 배송 희망일
	if($PayType == "bank") $PayDate = getCreateDate($DY,$DM,$DD) ;// 입금예정일(온라인 입급일경우)


$sql = "UPDATE ${BUYER_TABLE_NAME} SET
ID = '$ID' ,
PWD = '$PWD' ,
Sender_Name = '$Sender_Name' ,
Sender_Company = '$Sender_Company' ,
Sender_Email = '$Sender_Email' ,
Sender_Tel = '$Sender_Tel' ,
Sender_Hand = '$Sender_Hand' ,
Zip1 = '${Zip1_1}-${Zip1_2}' ,
Address1 = '$Address1' ,
Address2  = '$Address2' ,
Re_Name  = '$Re_Name' ,
Re_Email  = '$Re_Email' ,
Re_Tel  = '$Re_Tel' ,
Re_Hand  = '$Re_Hand' ,
Zip2  = '${Zip2_1}-${Zip2_2}' ,
Address3 = '$Address3' ,
Address4  = '$Address4' ,
Message  = '$Message' ,
How_Buy  = '$PayType' ,
How_Bank  = '$How_Bank' ,
Inputer  = '$Inputer' ,
Point_Money  = '$PointMoney' ,
Pay_Money  = '$PayMoney' ,
Delivery_Money = '$Delivery_Money' ,
Total_Money = '$TOTAL_MONEY' ,
CODE_VALUE = '$CODE_VALUE' ,
Co_Now = '10' ,
Co_Name = '$Co_Name' ,
PayDate = '$PayDate' ,
BuyDate = '$BuyDate' ,
WishDate  = '$WishDate' ,
Reserved1  = '$Reserved1' ,
Reserved2  = '$Reserved2' ,
SiteKey = '$SiteKey'
WHERE  CODE_VALUE='$CODE_VALUE'
";

$db_result = mysql_query($sql);

if(!$db_result) js_alert_location("DB 작업중 에러가 발생 하였습니다","-1");

}
/* 상품명을 구한다 */
$Co_Name = trim($Co_Name);
$GoodsName1 = split("\n", $Co_Name);
$GoodsQuantity = sizeof($GoodsName1);
$GoodsName = split("\|", $GoodsName1[0]);
$goods_name = strip_tags(getSingleValue("select Name from ${MALL_TABLE_NAME} where UID = '$GoodsName[0]'"));
if($GoodsQuantity > 1) $QuantityStr = "외 ".($GoodsQuantity - 1)."종";
/* 결제 창으로 값을 넘긴다. */
$goods_name = urlencode($goods_name." ".$QuantityStr);
?>
<iframe frameborder="0" scrolling="no" id="PayIFrame"  src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/blank.php" width="0" height="0"> </iframe>
<?
$goods_name = strip_tags($goods_name);
/******* 핸드폰 전용 결제창 *****************************************************************/
if ($PayType == 'hand' && $PHONE_ENABLE == 'checked' && $TOTAL_MONEY >= $PHONE_ENABLE_MONEY ) :
	echo "<script>PayIFrame.location=\"$SKIN_FOLDER_NAME/cardmodule/$CARD_PACK/pay.php?goods_name=$goods_name&cod=$CODE_VALUE\";</script>";

/******* 신용카드 전용 결제창 *****************************************************************/
elseif ($PayType == 'card' && $CARD_ENABLE == 'checked' && $TOTAL_MONEY >= $CARD_ENABLE_MONEY ) :
	echo "<script>PayIFrame.location=\"$SKIN_FOLDER_NAME/cardmodule/$CARD_PACK/pay.php?goods_name=$goods_name&cod=$CODE_VALUE\";</script>";

/******* 실시간 계좌이체 전용 결제창 *****************************************************************/
elseif ($PayType == 'autobank' && $AUTOBANKING_ENABLE == 'checked') :
	echo "<script>PayIFrame.location=\"$SKIN_FOLDER_NAME/cardmodule/$CARD_PACK/pay.php?goods_name=$goods_name&cod=$CODE_VALUE\";</script>";

// 에스크로 모드 추가



/******* 무통장입금 or Point 결제 *****************************************************************/
else:
js_location("$CART_MAIN_FILE_NAME?query=step3&PayType=$PayType&cod=$CODE_VALUE");
exit;
endif;
?><table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;결재중 </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="96%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="60">&nbsp;</td>
        </tr>
        <tr height="8">
          <td align="center">
            <img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/pay_img.gif" width="591" height="311" border="0" usemap="#PayProcessing">
            <map name="PayProcessing">
              <area shape="rect" coords="127,212,242,235" href="javascript:location.reload();">
              <area shape="rect" coords="255,209,415,232" href="./<? echo ${CART_MAIN_FILE_NAME}; ?>?query=step2">
            </map></td>
        </tr>
      </table></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
