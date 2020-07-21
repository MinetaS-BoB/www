<?
$CONTENT = stripslashes(getSingleValue("SELECT Content  FROM ${CONTENT_TABLE_NAME} WHERE Code = 'MAIL_CODE_05'"));
$sqlstr = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE  CODE_VALUE = '$CODE_VALUE '";
$list = _mysql_fetch_array($sqlstr);
$Buy_Date=date ("Y-m-d H:i:s", $list[BuyDate]);
$PayTypeText = $ORDER_METHOD_ARRAY[$list[How_Buy]];
$Pay_Money = number_format($list[Pay_Money]);// 결제액
############################################################################
# 메일 발송
############################################################################
include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/ORDER_MAIL.php");
?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top"> 
    <td height="10" colspan="3"> </td>
  </tr>
  <tr align="left" valign="top"> 
    <td height="5" colspan="3"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_top_img_03.gif" width="690" height="100"></td>
  </tr>
  <tr align="left" valign="top"> 
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="670" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="10"></td>
        </tr>
        <tr> 
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%" align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;주문완료 
                      </td>
                    </tr>
                  </table></td>
                <td width="50%" align="right" valign="middle" class="666666_s">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="10"></td>
        </tr>
        <tr> 
          <td height="5" background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/customer/bar01.gif"> 
          </td>
        </tr>
        <tr> 
          <td height="20" align="left" valign="middle"> </td>
        </tr>
        <tr> 
          <td height="20" align="center" valign="top"> <br> <table border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="60" align="center">&nbsp;</td>
                <td align="center"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_img_02.gif" width="556" height="236"></td>
              </tr>
            </table>
            <br> 
            <table border="0" cellspacing="0" cellpadding="0">
              <tr align="center"> 
                <td><a href="./"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_home.gif" width="102" height="27" border="0"></a></td>
              </tr>
            </table>
            <br></td>
        </tr>
        <tr> 
          <td height="50" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td width="10" background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
