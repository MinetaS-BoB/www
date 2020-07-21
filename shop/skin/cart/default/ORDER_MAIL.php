<?

$IMG_URL = $SITE_URL."/${SKIN_FOLDER_NAME}/cart/".$CartSkin."/ordermailimg";
$CSS_URL = $SITE_URL."/${SKIN_FOLDER_NAME}/cart/".$CartSkin."/css";

$SEND_CONTENT = "<title>주문완료메일</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<link href='$CSS_URL/body.css' rel='stylesheet' type='text/css'>
<body leftmargin='5' topmargin='5' marginwidth='0' marginheight='0'>
<table width='653' border='0' cellspacing='0' cellpadding='0'>
  <tr> 
    <td width='650' background='$IMG_URL/body.gif'><table width='650' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td height='50'><table width='650' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='2'><img src='$IMG_URL/img_top_l.gif' width='2' height='50'></td>
                <td background='$IMG_URL/bg_top.gif'>&nbsp;</td>
                <td width='2'><img src='$IMG_URL/img_top_r.gif' width='2' height='50'></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><img src='$IMG_URL/img_order.gif' width='650' height='118'></td>
        </tr>
        <tr>
          <td align='center'><table width='600' border='0' cellspacing='0' cellpadding='0'>
              <tr> 
                <td height='80' colspan='2' bgcolor='#F1F1F1'> <table width='565' border='0' cellspacing='0' cellpadding='0'>
                    <tr> 
                      <td width='43'>&nbsp;</td>
                      <td class='company'>안녕하세요. <strong>$list[Sender_Name]</strong> 고객님<br> 
                        <br>
                        저희 $ADMIN_TITLE 을 이용해 주셔서 대단히 감사합니다.<br>
                        고객님께서 주문하신 내역을 확인해 드립니다.<br>$CONTENT</td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan='2'>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan='2'><table width='600' border='0' cellpadding='0' cellspacing='0' class='company'>
                    <tr> 
                      <td height='3' colspan='3' bgcolor='#83A1C7'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>주문번호&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'><font color='618DC4'><strong>$CODE_VALUE</strong></font></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>받으시는분&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$list[Re_Name]</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>연락처&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$list[Re_Tel]</td>

                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>받으실 
                        분 주소&nbsp; &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$list[Address3] $list[Address4]</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
										<tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>결제방법&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$PayTypeText 결제</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>결제하실 금액&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$Pay_Money 원</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>구매일자&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$Buy_Date</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td height='3' colspan='3' bgcolor='#83A1C7'></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan='2'>&nbsp;</td>
              </tr>        
                          
            </table></td>
        </tr>
        <tr>
          <td height='65' align='right'> <table width='450' border='0' cellspacing='0' cellpadding='0'>
              <tr> 
                <td width='425' align='right' class='company'>${ADMIN_TITLE}을 이용해주셔서 
                  감사합니다.<br></td>
                <td width='25'>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height='88' align='center' background='$IMG_URL/bg_bottom.gif' class='company'>공정거래위원회 
            고시 제2000-1호에 따른 안내 사업자번호 : $COMPANY_BUSINESS_NUM<br>
            주소 :$COMPANY_ADD 상호 : $COMPANY_NAME 대표자명 : $COMPANY_CEO<br>
            쇼핑몰명:$ADMIN_TITLE ☎ 연락처 : $CUSTOMER_TEL, 팩스번호: $CUSTOMER_FAX</td>
        </tr>
      </table></td>
    <td width='3' valign='top' bgcolor='E4E4E4'><img src='$IMG_URL/img_r.gif' width='3' height='4'></td>
  </tr>
  <tr bgcolor='E4E4E4'> 
    <td height='3' colspan='2' valign='top'><img src='$IMG_URL/img_l.gif' width='3' height='3'></td>
  </tr>
</table>
";

if ( $list[Sender_Email]) {
$Tomail = $list[Sender_Email] ;
$From = $ADMIN_EMAIL;

$subject = "고객님의 주문내역입니다. - $ADMIN_TITLE -";

$from = "From:$From\nContent-Type:text/html";

mail ($Tomail, $subject, $SEND_CONTENT, $from);
mail ($ADMIN_EMAIL, $subject, $SEND_CONTENT, $from);


}
?>

