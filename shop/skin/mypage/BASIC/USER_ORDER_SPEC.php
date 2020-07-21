<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
if(!$OrderValue){
	js_alert_location("주문내역이 삭제되었거나 주문번호가 잘못되었습니다","-1");
}


	$sql = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$OrderValue'";

   $Cart_List = _mysql_fetch_array($sql) ; 	 
	 $OrderValue = $Cart_List[CODE_VALUE];
	 $OrderDetail = $Cart_List[Co_Name];	// 주문 상세 정보
	 $OrderID = $Cart_List[ID];   
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
	 
	 if(!$OrderID) $OrderID = " 비회원 ";
	 else $OrderID = " 회원 ";
	 
	 $Deliverer = $Cart_List[Deliverer];
	 $InvoiceNo = $Cart_List[InvoiceNo];
	 
		
	  

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
                <td height="25" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="5" background="/img/customer/bar01.gif"> 
                            </td>
                          </tr>
                          <tr> 
                            <td height="20" align="left" valign="middle"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td height="3"  bgcolor="909090"></td>
                                </tr>
                                <tr> 
                                  <td height="3" align="left"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="F6F6F6">
                                      <tr> 
                                        <td width="97" align="center" valign="middle" class="333333_b">사진</td>
                                        <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                                        <td width="177"  align="center" valign="middle" bgcolor="F6F6F6" class="333333_b">상품명</td>
                                        <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                                        <td width="140"  align="center" valign="middle" class="333333_b">옵션</td>
                                        <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                                        <td width="77"  align="center" valign="middle" class="333333_b">수량</td>
                                        <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                                        <td width="77"  align="center" valign="middle" class="333333_b">합계</td>
                                        <td width="3"  align="center" valign="top" class="333333_b"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bar01.gif" width="3" height="5"></td>
                                        <td  align="center" valign="middle" class="333333_b">포인트</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td height="4" ></td>
                                </tr>
                                <tr> 
                                  <td height="1" bgcolor="#C7C7C7"></td>
                                </tr>
                                <tr> 
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <?
$Cart_Data = split("\n", $OrderDetail);
for($i = 0; $i < sizeof($Cart_Data) && chop($Cart_Data[$i]); $i++) {

$C_dat = explode("|", chop($Cart_Data[$i]));
				
				$CartNo =  $C_dat[0] ; // 상품 번호 
				$CartCnt =  $C_dat[1] ; // 상품 수량
				$CartPrice =  $C_dat[2] ; // 상품 가격 (품목 하나당 합산 가격)
				$CartPoint =  $C_dat[3] ; // 상품 포인트(품목 하나당 합산 포인트)
				$CartTmpOpt1  = $C_dat[4] ; // Option1
				$CartTmpOpt2  = $C_dat[5] ; // Option2
				$CartTmpOpt3  = $C_dat[6] ; // Option4
				$CartTmpOpt4  = $C_dat[7] ; // Option5
									
				$Total_QTY += $CartCnt;
				
				$VIEW_QUERY = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID='$CartNo'";
				
				$LIST = mysql_fetch_array(mysql_query($VIEW_QUERY, $DB_CONNECT));
				$Picture = explode("|", $LIST[Picture]);
				$VIEW_LINK = "${MART_MAIN_FILE_NAME}?query=view&code=$LIST[Category]&no=$LIST[UID]'";
			
				$SUM_MONEY = $CartPrice * $CartCnt;
				$SUM_POINT = $CartPoint * $CartCnt;				
				
				$TOTAL_MONEY += $SUM_MONEY ;
				$TOTAL_POINT += $SUM_POINT ;

?>
                                      <tr> 
                                        <td width="97" height="60" align="center"><table width="65" border="0" cellpadding="0" cellspacing="1" bgcolor="dddddd">
                                            <tr> 
                                              <td align="center" valign="top" bgcolor="#FFFFFF"><A HREF='<? echo ${MART_MAIN_FILE_NAME}; ?>?code=<?=$LIST[Category]?>&query=view&no=<?=$LIST[UID]?>'><IMG SRC='<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[0]?>' WIDTH='60' HEIGHT='60' BORDER=0></A></td>
                                            </tr>
                                          </table></td>
                                        <td width="175"><A HREF='<? echo ${MART_MAIN_FILE_NAME}; ?>?code=<?=$LIST[Category]?>&query=view&no=<?=$LIST[UID]?>'> 
                                          <?=$LIST[Name]?>
                                          </A> <br> </td>
                                        <td width="147" style = "padding-left:5px"> 
<?
for($k = 4 ; $k < 8 ; $k++ ){// 옵션에 값이 있는  갯수 만큼						
	

	if( $C_dat[$k] ):

	if($C_dat[$k]) $OptionTitle = 	"<font color = '009077'>" . $OptionName[key($OptionName)][0] . "</font> ";// 옵션 이름									
	
	if(ereg("=" , trim($C_dat[$k])))  {// 옵션중에 선택 옵션이 있는 경우만 뿌려준다.
		$tmpOptionValue = explode("=" , trim($C_dat[$k]));																	
		if(intval($tmpOptionValue[1]) > 0) $tmpPrefix = " 추가" ;
		else $tmpPrefix = " 차감" ;						
		echo  $OptionTitle . trim($tmpOptionValue[0]). "  " . $tmpOptionValue[1] . " $tmpPrefix <br>" ;
	}else{		
		echo  $OptionTitle  . " $C_dat[$k] <br>" ;
	}
	next($OptionName); 

	endif;
								
}
reset($OptionName);// 포인트 리셋
?>
                                        </td>
                                        <td width="83" align="center">
                                          <?=$CartCnt?>
                                        </td>
                                        <td width="78" align="center"> 
                                          <?=number_format($CartPrice * $CartCnt)?>
                                          원</td>
                                        <td width="90" align="center"> 
                                          <? if(isMember()) echo number_format($CartPoint * $CartCnt) ." Point";?>
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td background="/image/dot_line_02.gif" height="1" colspan="6" align="center"> 
                                        </td>
                                      </tr>
<?
}   // for

?>
                                      <BR>
                                    </table>
                                    <br> <table width="100%" border="3" cellpadding="0" cellspacing="0" bordercolor="EEEEEE">
                                      <tr> 
                                        <td height="30" align="center" bgcolor="FFFFFF" >주문상품 
                                          가격합계 : <strong><font color="#000000"><? echo  number_format($Total_Money);?>원</font></strong> 
                                          (배송비 <? echo  number_format($Delivery_Money);?>원 
                                          포함) 
                                          <? if(isMember()) echo" - 지급포인트 : <strong>".number_format($TOTAL_POINT)."포인트";?></strong> 
                                        </td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td height="2"> </td>
                                </tr>
                                <tr> 
                                  <td height="1" bgcolor="B2B2B2"> </td>
                                </tr>
                              </table>
                              <br> </td>
                          </tr>
                          <tr> 
                            <td height="20" align="center" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td height="25" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/cart_t_06.gif" width="84" height="16"></td>
                                </tr>
                              </table>
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr> 
                                              <td height="3"  bgcolor="909090"></td>
                                            </tr>
                                            <tr> 
                                              <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
																							<tr> 
                                                    <td width="115" height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      회원구분</td>
                                                    <td bgcolor="ffffff"><? echo $OrderID; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td width="115" height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      주문번호</td>
                                                    <td bgcolor="ffffff"><font color = "C15B27"><? echo $OrderValue; ?></font></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      주문하시는분 </td>
                                                    <td bgcolor="ffffff"><? echo $Sender_Name; ?> </td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      회사/부서명 </td>
                                                    <td bgcolor="ffffff"><? echo $Sender_Company; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      전화번호 </td>
                                                    <td bgcolor="ffffff"><? echo $Sender_Tel ;?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      휴대전화 </td>
                                                    <td bgcolor="ffffff"><? echo $Sender_Hand ;?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      이메일 </td>
                                                    <td bgcolor="ffffff"><? echo $Sender_Email;?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      주소 </td>
                                                    <td bgcolor="ffffff"><? echo "$Zip1[0]-$Zip1[1] $Address1 $Address2"; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      희망배송일 </td>
                                                    <td bgcolor="ffffff"><? echo $WishDate; ?></td>
                                                  </tr>
                                                </table></td>
                                            </tr>
                                            <tr> 
                                              <td height="2" bgcolor="909090"></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                              <br> <br> <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td height="25" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/cart_t_07.gif" width="84" height="16"></td>
                                </tr>
                              </table>
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr> 
                                              <td height="3"  bgcolor="909090"></td>
                                            </tr>
                                            <tr> 
                                              <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                                  <tr> 
                                                    <td width="115" height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      받는분 </td>
                                                    <td bgcolor="ffffff"><? echo $Re_Name; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      전화번호 </td>
                                                    <td bgcolor="ffffff"><? echo $Re_Tel ;?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      휴대전화 </td>
                                                    <td bgcolor="ffffff"><? echo $Re_Hand; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      이메일 </td>
                                                    <td bgcolor="ffffff"><? echo $Re_Email;?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      주소 </td>
                                                    <td bgcolor="ffffff"><? echo "$Zip2[0]-$Zip2[1] $Address3 $Address4"; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      남기실말씀</td>
                                                    <td bgcolor="ffffff"><? echo $Message; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <? if($Deliverer){ ?>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      택배회사</td>
                                                    <td bgcolor="ffffff"> 
                                                      <a href = "<? echo getDeliveryUrl($Deliverer); ?>" target = "_blank"><? echo $Deliverer; ?></a>
                                                    </td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <? }?>
                                                  <? if($InvoiceNo){ ?>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      송장번호</td>
                                                    <td bgcolor="ffffff"> 
                                                      <? echo $InvoiceNo; ?>
                                                    </td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <? } ?>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      거래상태</td>
                                                    <td bgcolor="ffffff"> <? echo $ORDER_STATUS_ARRAY[$OrderStep]; ?> 
                                                    </td>
                                                  </tr>
                                                </table></td>
                                            </tr>
                                            <tr> 
                                              <td height="2" bgcolor="909090"></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                              <br> <br> <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td height="25" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/cart_t_09.gif" width="84" height="16"></td>
                                </tr>
                              </table>
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr> 
                                              <td height="3"  bgcolor="909090"></td>
                                            </tr>
                                            <tr> 
                                              <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      결제방법 </td>
                                                    <td bgcolor="ffffff"><? echo $ORDER_METHOD_ARRAY[$PayType]; ?> 
                                                      결제 </td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td width="115" height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      주문금액 </td>
                                                    <td bgcolor="ffffff"><? echo number_format($Total_Money); ?> 
                                                      원</td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <? if($Point_Money):?>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      사용포인트 </td>
                                                    <td bgcolor="ffffff"><? echo number_format($Point_Money); ?> 
                                                      Point</td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <? endif;?>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      결제금액 </td>
                                                    <td bgcolor="ffffff"><? echo number_format($Pay_Money); ?> 
                                                      원</td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <? if ($PayType == "bank") :?>
                                                  <tr> 
                                                    <td height="28" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      은행</td>
                                                    <td bgcolor="ffffff"><? echo $BANK; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      입금자명 </td>
                                                    <td bgcolor="ffffff"><? echo $Inputer; ?></td>
                                                  </tr>
                                                  <tr bgcolor="#C7C7C7"> 
                                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                                    </td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="30" valign="middle" class="333333_b"> 
                                                      &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                                      입금예정일 </td>
                                                    <td bgcolor="ffffff"><? echo date("Y 년 m 월 d 일",$PayDate); ?></td>
                                                  </tr>
                                                  <? endif;?>
                                                </table></td>
                                            </tr>
                                            <tr> 
                                              <td height="2" bgcolor="909090"></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                              <br> <br> <table border="0" cellspacing="0" cellpadding="0">
                                <tr align="center"> 
                                  <td width="112"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/btn_ok.gif"  border="0" onclick="javascript:location.href='<? echo $MEMBER_MAIN_FILE; ?>?query=order'" style="cursor:hand"></td>
                                </tr>
                              </table>
                              <br></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br> <br></td>
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
