<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<html>
<script language=javascript>
function loginForm(f) {		
		if ( !f.SecretPASS.value ) {
			alert('\n비밀번호를 입력해 주십시오. \n');
			f.SecretPASS.focus();
			return false;
		}
}
</script>
<br><br>
<body onload="javascript:document.SecretFrm.SecretPASS.focus()";>
<table width="460" border="3" align="center" cellpadding="0" cellspacing="0" bordercolor="#EFEFEF">
<form name='SecretFrm' action = "./<? echo $BOARD_FOLDER_NAME; ?>/secret_log_check.php" method="post" onsubmit='return loginForm(this);'>
<input type="hidden" name="BID" value="<?=$BID?>">
<input type="hidden" name="GID" value="<?=$GID?>">
<input type="hidden" name="Mode" value="SecretLogin">
<input type="hidden" name="UID" value="<?=$UID?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="nmode" value="<?=$nmode?>">
<input type="hidden" name="rmode" value="<?=$rmode?>"><!-- 취소시 분기 rmode : modify => 이전 UID로 else 리스트로 -->
<input type="hidden" name="CURRENT_PAGE" value="<?=$CURRENT_PAGE?>">
<input type="hidden" name="ExtendDB" value="<?=$ExtendDB?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="sysop" value="<?=$sysop?>">
<input type="hidden" name="fm" value="<?=$fm?>">
<input type="hidden" name="BType" value="<? echo $BType; ?>">
<input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">
<?
	$GoBackUrl = "${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax" ; 
	if($rmode == "modify") $GoBackUrl .= $GoBackUrl . "&mode=view&UID=$UID"; 
?>
  <tr> 
    <td width="565" height="96"> <table width="336" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr bgcolor="#f5f5f5" style="padding-left:5"> 
            <td width="135" height="25"><div align="center"><strong>비밀번호 </strong></div></td>
            <td width="143" ><input type="password" name="SecretPASS" size="14" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 18px; width:80%" id="checkenable" title="비밀번호를 입력해 주세요";></td>
            <td width="61"><input type = "image" src="./<? echo $BOARD_FOLDER_NAME; ?>/images/save_btn.gif"   style="cursor:hand"></td>
            <td width="61"><img src="./<? echo $BOARD_FOLDER_NAME; ?>/images/cancel_btn.gif"  onClick="javascript:history.go(-1);" style="cursor:hand";></td>
          </tr>
          <tr> 
            <td colspan="4" bgcolor = DDDDDD width = 400 height = 1></td>
          </tr>       
      </table></td>
  </tr></form>
</table>
<table height = 100>
  <tr>
    <td></td>

  </tr>
</table>
