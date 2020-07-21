<? include "./function/member_check_module.php" ; ?>

<?
if($mode == "remove_progress"){
		
	$OutDate = time();	
	$Content = addslashes($Content);	
	$OutContent = "$OutReason|$Content";	
	
	if(isAdmin()) {
		js_alert_location("최고 관리자는 탈퇴 하실수 없습니다.","./");
	}	 	 
	 
	$sql = "UPDATE ${MEMBER_TABLE_NAME} SET 
					OutDate = $OutDate , 
					OutContent = '$OutContent'	,
					GrantSta = 'remove'
					WHERE ID='$_COOKIE[MEMBER_ID]'
					";
			
	$result = mysql_query($sql);
	
	if($MEMBER_OUT_LIMIT_DATE) $OutDateContent = "회원님의 모든정보는 $MEMBER_OUT_LIMIT_DATE일 후 자동 삭제 됩니다." ;
	if($result)	js_alert_location("\\n 정상적으로 탈퇴 신청이 이루어 졌습니다\\n$OutDateContent","./${MEMBER_FOLDER_NAME}/LOG_OUT.php");
	 else js_alert_location("\\n DB 작업중 에러가 발생했습니다..\\n","./");
				
	
}
		
?>


<script>
	function checkOutForm(f){		
		
		if(!f.OutReason.value){
			alert("탈퇴 사유를 선택해 주세요");
			f.OutReason.focus();
			return false;
		}
		if(!f.Content.value){
			alert("남기실 말씀을 적어주세요");
			f.Content.focus();
			return false;
		}
		
		var con = confirm("탈퇴를 하시면 회원에 관한 모든 자료가 삭제 됩니다. \n\n정말로 탈퇴를 하시겠습니까?");	
		
		if(!con)	return false;
		else return true;	
		
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
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;회원탈퇴</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<form name = "MemberOutFrm" method = "post" action = "<? echo $_SERVER['PHP_SELF']?>" onSubmit = "return checkOutForm(this)">
					<input type = "hidden" name = "query" value = "<? echo $query;?>">
					<input type = "hidden" name = "mode" value = "remove_progress">
					
					
              <tr>
                <td align="center" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="50" valign="top" class="999999">탈퇴하시면 회원에 관한 모든 자료가 삭제되므로 주문자료등은 반드시 메모해 두시기 바랍니다.<br>
                            탈퇴 후 삭제된 자료는 저희 쇼핑몰에서 책임지지 않습니다.</td>
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
                                                <td width="115" height="30" valign="middle" class="333333_b"> &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> 탈퇴사유 </td>
                                                <td bgcolor="ffffff">
                                                 <select name="OutReason" >
																									<option selected>탈퇴사유를 선택해 주세요</option>
																									<?
																										foreach($ARRAY_OUT_REASON as $key => $value){
																										echo "<option value = '$key'>$value</option>";
																										}
																									?>
																									</select>                                               </td>
                                              </tr>
                                              <tr bgcolor="#C7C7C7">
                                                <td height="1" colspan="2" valign="middle" class="333333_b"> </td>
                                              </tr>
                                              <tr>
                                                <td height="30" valign="middle" class="333333_b"> &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> 남기실말씀 </td>
                                                <td bgcolor="ffffff"><textarea name="Content" cols="83" rows="5" class="input2"></textarea></td>
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
                          <td width="112" align="center"><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_ok_03.gif"  border="0"></td>
                          <td width="112" align="center"><a href="./"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_cancle_02.gif"  border="0"></a></td>
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
