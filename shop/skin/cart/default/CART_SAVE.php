<?
	// 장바구니 담기 판단기준
	// 기존은 TOTAL_MONEY로 판단
	// 지금 $TotalUnit 갯수로 판단 가격이 없는 애들을 장바구니 담기 
	
?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top"> 
    <td height="10" colspan="3"> </td>
  </tr>
  <tr align="left" valign="top"> 
    <td height="5" colspan="3"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_top_img_01.gif" width="690" height="100"></td>
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
                      <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;장바구니 
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
          <td height="5" background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bar02.gif"> 
          </td>
        </tr>
        <tr> 
          <td height="20" align="left" valign="middle"> </td>
        </tr>
        <tr> 
          <td height="20" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" valign="top"> 
                        <? 

// 장바구니 보기
include "./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_VIEW.php";

?>
                        <br> <table border="0" cellspacing="0" cellpadding="0" align = center>
                          <tr align="center"> 
													<? if ($TotalUnit > 0) :?>
                            <td width="112">                              
                              <a href='./<? echo ${CART_MAIN_FILE_NAME}; ?>?query=trash' onclick="return really();"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_allcancle.gif" width="102" height="27" border="0" align = absmiddle></a>                             
                            </td>
												 <? endif;?>
												 <? if ($TotalUnit > 0) :?>
                            <td width="112">                              
                              <a href="./<? echo ${CART_MAIN_FILE_NAME}; ?>?query=step1"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_buy.gif" width="102" height="27" border="0"  align = absmiddle></a>                         
                            </td>
													<? endif;?>
                            <td width="112"><a href="./"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_shopping.gif" width="102" height="27" border="0"  align = absmiddle></a></td>                            
                          </tr>
                        </table>
                        <br> </td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td height="10"></td>
              </tr>
            </table></td>
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
