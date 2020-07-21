<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
function checkCartLogin(f){
	if(!f.ID.value){
		alert("아이디를 입력해 주세요");
		f.ID.focus();
		return false;
	}
	if(!f.PWD.value){
		alert("비밀번호를 입력해 주세요");
		f.PWD.focus();
		return false;
	}		
}
</script>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top"> 
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top"> 
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="10"></td>
        </tr>
        <tr> 
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;로그인 </td>
              </tr>
            </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr> 
          <td height="16" align="center" valign="top"><table width="615" height="230" border="0" cellpadding="0" cellspacing="0">           

              <FORM name = "Cart_Login" method=post action='<? echo ${MEMBER_FOLDER_NAME}; ?>/LOG_CHECK.php' onSubmit = "return checkCartLogin(this)">
							<input type = "hidden" name = "ReturnUrl" value = "">							
							<input type = "hidden" name = "IP" value = "<? echo $_SERVER['REMOTE_ADDR']; ?>">
							
			  
                <tr> 
                  <td height="225" align="left" valign="top"><table width="615" height="225" border="0" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td height="225" align="center" valign="top" background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/login_box_bg01.gif"><table width="615" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td height="100">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td align="center" valign="top"> <table border="0" cellspacing="0" cellpadding="0">
                                  <tr align="left" valign="top"> 
                                    <td width="212"><table border="0" cellspacing="0" cellpadding="0">
                                        <tr align="left" valign="middle"> 
                                          <td width="60" height="30"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/img_id.gif" width="43" height="12"></td>
                                          <td width="160"> <input name="ID" type="text" class="input1" size="23"></td>
                                        </tr>
                                        <tr align="left" valign="middle"> 
                                          <td height="30"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/img_pw.gif" width="43" height="12"></td>
                                          <td><input name="PWD" type="password" class="input1" size="23"></td>
                                        </tr>
                                      </table></td>
                                    <td><input type = "image" src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_login.gif" width="61" height="61" border="0"></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td align="left" valign="top" style="padding-left:62"> <table width="320" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                            <tr align="left" valign="top"> 
                              <td width="172"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/img_find.gif" width="172" height="18"></td>
                              <td width="15"></td>
                              <td><a href="<? echo ${MEMBER_MAIN_FILE_NAME}; ?>?query=passsearch"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_find.gif" width="127" height="18" border="0"></a></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td height="5"></td>
                      </tr>
                      <tr> 
                        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                            <tr align="left" valign="top"> 
                              <td width="137"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/img_join.gif" width="137" height="18"></td>
                              <td width="15"></td>
                              <td><a href="<? echo ${MEMBER_MAIN_FILE_NAME}; ?>?query=accept"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_join.gif" width="127" height="18" border="0"></a></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td height="40" align="left" valign="top" style="padding-left:62">&nbsp;</td>
                </tr>
              </form>
            </table>
            <!-- 비회원주문조회 -->
            <table width="490" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="left" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bmember_buy_title.gif" width="460" height="34"></td>
              </tr>
              <tr> 
                <td height="30"></td>
              </tr>
              <tr> 
                <td align="left" valign="top"><table width="490" border="0" cellspacing="0" cellpadding="0">
                    <tr align="left" valign="top"> 
                      <td width="392"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bmember_buy_ok.gif" width="392" height="35"></td>
                      <td><A HREF='<? echo ${CART_MAIN_FILE_NAME}; ?>?query=step2'><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_buy_ok.gif" width="103" height="35" border="0"></a></td>
                    </tr>
                    <tr align="left" valign="top"> 
                      <td height="10"></td>
                      <td></td>
                    </tr>
                    <tr align="left" valign="top"> 
                      <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bmember_buy_join.gif" width="392" height="35"></td>
                      <td><A HREF='<? echo ${MEMBER_MAIN_FILE_NAME}; ?>?query=accept'><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_buy_join.gif" width="103" height="35" border="0"></a></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="50" align="left" valign="top">&nbsp;</td>
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
<script>
document.Cart_Login.ReturnUrl.value = escape('<? echo "../${CART_MAIN_FILE_NAME}?query=step2"; ?>');
</script> 