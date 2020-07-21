<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
	/*
		비회원 주문시조회 ( 주문자 이름 + 비번으로 체크)
	*/
?>

<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;상품배송
                  및 주문현황 </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td height="3"  bgcolor="909090"></td>
                    </tr>
                    <tr> 
                      <td height="3" align="left"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="F6F6F6">
                          <tr> 
                            <td width="37" align="center" valign="middle" class="333333_b">번호</td>
                            <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                            <td width="147"  align="center" valign="middle" bgcolor="F6F6F6" class="333333_b">주문번호</td>
                            <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                            <td width="117"  align="center" valign="middle" class="333333_b">주문일자</td>
                            <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                            <td width="129"  align="center" valign="middle" class="333333_b">구매액</td>
														<td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                            <td width="141"  align="center" valign="middle" class="333333_b">결제방식</td>
                            <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                            <td width="97"  align="center" valign="middle" class="333333_b">구매상태</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td height="4" ></td>
                    </tr>
                    <tr> 
                      <td align="left" valign="top"> 
<?
$ListNo = $SubListNo;
$PageNo = $SubPageNo;


if (!$sort) {$sort = "UID";}
if(isMember()) $WHEREIS = " WHERE ID='$_COOKIE[MEMBER_ID]'";
else $WHEREIS = " WHERE Sender_Name='$_COOKIE[ORDER_NON_MEMBER_NAME]' AND PWD = '$_COOKIE[ORDER_NON_MEMBER_PWD]'";

$TOTAL = getSingleValue("SELECT count(*) FROM ${BUYER_TABLE_NAME} $WHEREIS");
if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
$START_NO = ($CURRENT_PAGE - 1) * $ListNo;

//--페이지 나타내기--
$TP = ceil($TOTAL / $ListNo) ; /* 총페이지수(Total Page) : 총게시물수 / 페이지당 리스트수  */
$CB = ceil($CURRENT_PAGE / $PageNo); /* 현재블록(Current Block) : 현재페이지 / 표시되는 페이지 수 */
$SP = ($CB - 1) * $PageNo + 1; /* 블록의 처음 페이지(Start Page) 구하기 */
$EP = ($CB * $PageNo); /*블록의 마지막 페이지(End Page) : 현재 블록 * 표시되는 페이지수 */
$TB = ceil($TP / $PageNo); /* 총블록수(Total Block) : 총페이지수 / 표시되는 페이지 수 */
//--페이지링크를 작성하기--
$NO = $TOTAL-($ListNo*($CURRENT_PAGE-1));
$sql = "SELECT * FROM ${BUYER_TABLE_NAME} $WHEREIS ORDER BY $sort DESC LIMIT $START_NO , $ListNo";
$result = mysql_query($sql);
//echo "\$LIST_QUERY: $LIST_QUERY";


while( $Cart_List = mysql_fetch_array( $result ) ) :
 
	 $OrderValue = $Cart_List[CODE_VALUE];	   
	 $Inputer = stripslashes($Cart_List[Inputer]);
	 $Sender_Name = stripslashes($Cart_List[Sender_Name]);
	 $Sender_Company = stripslashes($Cart_List[Sender_Company]);
	 $PWD = stripslashes($Cart_List[PWD]);			 
	 $Sender_Email = stripslashes($Cart_List[Sender_Email]);	   
	 $Sender_Tel = stripslashes($Cart_List[Sender_Tel]);
	 $Sender_Hand = stripslashes($Cart_List[Sender_Hand]);	   
	 $Re_Name = stripslashes($Cart_List[Re_Name]);	   
	 $Re_Tel = stripslashes($Cart_List[Re_Tel]);		
	 $Re_Hand = stripslashes($Cart_List[Re_Hand]);
	 $Re_Email = stripslashes($Cart_List[Re_Email]);		
	 $Zip1 = explode("-" , $Cart_List[Zip1]);
	 $Zip2 = explode("-" , $Cart_List[Zip2]);			 
	 
	 $Address1 = stripslashes($Cart_List[Address1]);
	 $Address2 = stripslashes($Cart_List[Address2]);
	 $Address3 = stripslashes($Cart_List[Address3]);
	 $Address4 = stripslashes($Cart_List[Address4]);
	 
	 
	 $Message = nl2br(stripslashes($Cart_List[Message]));
	 $PayType = $Cart_List[How_Buy]; // 결제 방법
	 $BANK = stripslashes($Cart_List[How_Bank]);
	 $BuyDate = $Cart_List[BuyDate];
	 $WishDate = date("Y년 m월 d일" , $Cart_List[WishDate]);
	 $PayDate = $Cart_List[PayDate];
	 $OrderStep = $Cart_List[Co_Now];
	 
	 $Point_Money = $Cart_List[Point_Money];// 포인트 사용액
	 $Pay_Money = $Cart_List[Pay_Money]; // 실제 결제액
	 $Delivery_Money = $Cart_List[Delivery_Money]; // 택배비
	 $Total_Money = $Cart_List[Total_Money]; // 총액
	 
	 
/*		
	$UID = $Cart_List[UID];
	$Sender_Name = $Cart_List[Sender_Name];
	$Sender_Email = $Cart_List[Sender_Email];
	$Sender_Tel = $Cart_List[Sender_Tel];
	$Sender_Pcs = $Cart_List[Sender_Pcs];
	$Re_Name = $Cart_List[Re_Name];
	$Re_Tel = $Cart_List[Re_Tel];
	$Zip = $Cart_List[Zip];
	$Address = split(" ", $Cart_List[Address]);
	$Re_Date = $Cart_List[Re_Date];
	$Message = nl2br(stripslashes($Cart_List[Message]));
	$How_Buy = $Cart_List[How_Buy];
	$How_Bank = explode("|", $Cart_List[How_Bank]);
	$Point_Money = $Cart_List[Point_Money];
	$Ziro_Money = $Cart_List[Ziro_Money];
	$Card_Money = $Cart_List[Card_Money];
	$Total_Money = $Cart_List[Total_Money];
	$Co_Del = $Cart_List[Co_Del];
	$Co_Uid = $Cart_List[CODE_VALUE];
	$Co_Now = $Cart_List[Co_Now];
	$Co_Memberid = $Cart_List[Co_Memberid];
	$Cart_Info = $Cart_List[Co_Name];
	$Buy_Date = $Cart_List[Buy_Date];
	$SUB_SMONEY = $SUB_SMONEY + $Total_Money;
*/
	
	$i++;



?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="1" bgcolor="#C7C7C7"></td>
                          </tr>
                          <tr> 
                            <td height="28" align="left" valign="middle"><table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="39" height="30" align="center" valign="middle"> 
                                    <? echo $NO; ?>
                                  </td>
                                  <td width="147" align="center">
																	<a href="<? echo $MEMBER_MAIN_FILE_NAME; ?>?query=order_detail&OrderValue=<?=$OrderValue?>" style = "font-weight:bold;color:C15B27"> 
                                    <? echo $OrderValue; ?>
                                    </a></td>
                                  <td width="116"  align="center" valign="middle"> 
                                    <? echo date("Y.m.d H:i:s",$BuyDate); ?>
                                  </td>
                                  <td width="124" align="center"> 
                                    <? echo number_format($Total_Money); ?>
                                    원</td>
                                  <td width="142" align="center"> 
                                    <? echo $ORDER_METHOD_ARRAY[$PayType]; ?>
                                  </td>
                                  <td width="102"  align="center" valign="middle"> 
                                    <? echo $ORDER_STATUS_ARRAY[$OrderStep]; ?>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
<? 
--$NO;
endwhile;
if(!$TOTAL){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="1" bgcolor="#C7C7C7"></td>
                          </tr>
                          <tr> 
                            <td height="28" align="left" valign="middle"><table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                                            <tr> 
                                              <td height="30" align="center" valign="middle">구매내역이 존재하지 않습니다.
                                              </td>
                                            </tr>
                                          </table></td>
                          </tr>
                        </table>
<? } ?>
                      </td>
                    </tr>
                    <tr> 
                      <td height="2" bgcolor="909090"></td>
                    </tr>
                  </table>
                  <table width="100%">
                    <tr> 
                      <td height="20"></td>
                    </tr>
                    <tr> 
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                            <td width="8" height="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/box02_01.gif" width="8" height="8"></td>
                            <td></td>
                            <td width="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/box02_02.gif" width="8" height="8"></td>
                          </tr>
                          <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                            <td height="26"></td>
                            <td align="center" valign="middle"> 
<?
$TransData = "query=$query";
include "./${SKIN_FOLDER_NAME}/page/${PageSkin}/index.php" ; 
?>
                            </td>
                            <td></td>
                          </tr>
                          <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                            <td height="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/box02_04.gif" width="8" height="8"></td>
                            <td></td>
                            <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/box02_03.gif" width="8" height="8"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <br> </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
              </tr>
            </table>
            <br>
            <br></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
