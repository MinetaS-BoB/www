<? include "./function/member_check_module.php" ; ?>

<?
if($mode == "progress"){	
	$AuthPass = trim($_POST['AuthPass']);
	$sql = "select count(UID) from ${MEMBER_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]' and PWD = '$AuthPass'";
	//echo $sql;
	//exit;
	 
	$cnt = getSingleValue($sql);
?>
<form name = "AuthFrm2" method = "POST" action = "<? echo $_SERVER[PHP_SELF];?>">
<input type = "hidden" name = "query" value = "regis">
<input type = "hidden" name = "PassAuthResult" value = "PassAuthChecked">
</form>
<?	
	if($cnt == 0) {
		js_alert_location("비밀번호가 일치 하지 않습니다.","./${MEMBER_MAIN_FILE_NAME}?query=auth");
	} else { 
?>
<script>
	document.AuthFrm2.submit();
</script>
<?
	
	}
	exit;		
	
}
		
?>
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
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;비밀번호확인</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<form name = "AuthFrm" action = "<? echo $_SERVER[PHP_SELF];?>" method = "post" onSubmit = "return checkForm(this);">
					<input type = "hidden" name = "query" value = "<? echo $query;?>">
					<input type = "hidden" name = "mode" value = "progress">
					
              <tr>
                <td align="center" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="50" valign="top" class="999999">회원정보 수정을 하기 위해서는 비밀번호가 필요합니다.</td>
                      </tr>
                      <tr>
                        <td align="center"><table width="680" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="center" valign="top"><table width="680" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left" valign="top"><table width="680" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="3"  bgcolor="909090"></td>
                                        </tr>
																				<tr>
                                          <td height="3" align="left"><table width="680" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">                                             
                                             
                                              <tr>
                                                <td width="111" height="30" valign="middle" class="333333_b"> &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> 아이디 </td>
                                                <td width="549" bgcolor="ffffff"><? echo $_COOKIE[MEMBER_ID]; ?></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="2" bgcolor="909090"></td>
                                        </tr>
																				<tr>
                                          <td height="3" align="left"><table width="680" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">                                             
                                             
                                              <tr>
                                                <td width="111" height="30" valign="middle" class="333333_b"> &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> 성명 </td>
                                                <td width="549" bgcolor="ffffff"><? echo $_COOKIE[MEMBER_NAME]; ?></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="2" bgcolor="909090"></td>
                                        </tr>
                                        <tr>
                                          <td height="3" align="left"><table width="680" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">                                             
                                             
                                              <tr>
                                                <td width="111" height="30" valign="middle" class="333333_b"> &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> 비밀번호 </td>
                                                <td width="549" bgcolor="ffffff"><input  type = "password" name="AuthPass" class="input2"></td>
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
                        </table></td>
                      </tr>
                    </table>
                      <br>
                      <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="112" align="center"><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_ok_03.gif"  border="0"  onFocus = "this.blur();"></td>
                          <td width="112" align="center"><a href="javascript:history.go(-1)"  onFocus = "this.blur();"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_cancle_02.gif"  border="0"></a></td>
                        </tr>
                      </table></td>
              </tr></form>
              
            </table>
            <br>
            <br></td>
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
<script>

	function checkForm(f){	
		
		if(!f.AuthPass.value){
			alert("비밀번호를 입력해주세요");
			f.AuthPass.focus();
			return false;
		}
	}
	
	document.AuthFrm.AuthPass.focus();
	
</script>