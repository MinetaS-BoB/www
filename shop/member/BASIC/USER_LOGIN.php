<script>
function checkLoginForm(f){
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

function checkOrder(f){
	if(!f.OrderName.value){
		alert("성명을 입력해주세요");
		f.OrderName.focus();
		return false;
	}
	if(!f.OrderPWD.value){
		alert("비밀번호를 입력해주세요");
		f.OrderPWD.focus();
		return false;
	}
}
</script>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;로그인</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top">
					<!-- 내용-->
<table width="615" height="230" border="0" cellpadding="0" cellspacing="0">
							<form name = "LoginFrm" method=post action='<? echo ${MEMBER_FOLDER_NAME}; ?>/LOG_CHECK.php' onSubmit = "return checkLoginForm(this);">
							<input type = "hidden" name = "IP" value = "<? echo $_SERVER['REMOTE_ADDR'];?>">
							<input type = "hidden" name = "ReturnUrl" value = "<? echo $ReturnUrl; ?>">

                <tr> 
                  <td height="225" align="left" valign="top"><table width="615" height="225" border="0" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td height="225" align="center" valign="top" style="background-image: url(<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/login_box_bg01.gif);"><table width="615" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td height="100">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td align="center" valign="top"> <table border="0" cellspacing="0" cellpadding="0">
                                  <tr align="left" valign="top"> 
                                    <td width="212"><table border="0" cellspacing="0" cellpadding="0">
                                        <tr align="left" valign="middle"> 
                                          <td width="60" height="30"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/img_id.gif" width="43" height="12"></td>
                                          <td width="160"> <input name="ID" type="text" class="input1" size="23"></td>
                                        </tr>
                                        <tr align="left" valign="middle"> 
                                          <td height="30"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/img_pw.gif" width="43" height="12"></td>
                                          <td><input name="PWD" type="password" class="input1" size="23"></td>
                                        </tr>
                                      </table></td>
                                    <td><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_login.gif"  border="0" onFocus = "this.blur();"></td>
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
                              <td width="172"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/img_find.gif" width="172" height="18"></td>
                              <td width="15"></td>
                              <td><a href="<? echo $_SERVER[PHP_SELF];?>?query=passsearch"  onFocus = "this.blur();"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_find.gif" width="127" height="18" border="0" ></a></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td height="5"></td>
                      </tr>
                      <tr> 
                        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                            <tr align="left" valign="top"> 
                              <td width="137"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/img_join.gif" width="137" height="18"></td>
                              <td width="15"></td>
                              <td><a href="<? echo $_SERVER[PHP_SELF];?>?query=accept"  onFocus = "this.blur();"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_join.gif" width="127" height="18" border="0" ></a></td>
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
<? 
if ( ereg("order",urldecode($ReturnUrl)) ){ // 비회원 주문배송조회
?>
 <table width="490" border="0" cellspacing="0" cellpadding="0">
<form name = "Frm" action='<? echo $_SERVER[PHP_SELF];?>'  method = "post" onSubmit=" return checkOrder(this);">
<input type=hidden name=query value='order'>
<input type=hidden name=mode value='NonMemberCookie'>
                <tr> 
                  <td align="left" valign="top"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bmember_title.gif" ></td>
                </tr>
                <tr> 
                  <td height="10"></td>
                </tr>
                <tr> 
                  <td height="160" align="left" valign="top"><table width="490" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg1.gif" width="18" height="19" /></td>
                              <td width="100%" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_top_line.gif">&nbsp;</td>
                              <td width="19"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg2.gif" width="19" height="19" /></td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_top.gif"><table border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td height="15"></td>
                              </tr>                               
                                <tr> 
                                  <td align="center" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                                  
																	<tr align="left" valign="middle"> 
                                    <td width="70" height="30">고객성명</td>
                                    <td width="161"><input name="OrderName" type="text" class="input1" size="23" maxlength = 10 tabindex = "60"></td>
                                  </tr>
																	<tr align="left" valign="middle"> 
                                    <td height="30">비밀번호</td>
                                    <td><input name="OrderPWD" type="password" class="input1" size="23" maxlength = 20 tabindex = "61"></td>
                                  </tr>
																	
                                </table></td>
                              </tr>
                                  </table></td>
                            </tr>
                            <tr>
                              <td height="40" colspan="3" align="center" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_bottom.gif"><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_ok.gif" border="0"  onFocus = "this.blur();"></td>
                            </tr>							
                            <tr>
                              <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg3.gif" width="18" height="19" /></td>
                              <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_bottom_line.gif">&nbsp;</td>
                              <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg4.gif" width="19" height="19" /></td>
                            </tr>
                          </table></td>
                </tr>
              </form>
            </table>           
<? } ?>
					<!-- 내용-->
					</td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
