<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
/* 
cmode 코멘트 모드 
*/
?>
<script language = javascript>
<!--
function checkCommentForm(f){
  if(f.NAME.value == ''){
  alert('이름을 입력하세요');
  f.NAME.focus();
	return false;
  } else if(f.CONTENTS.value == ''){
  alert('내용을 입력하세요');
  f.CONTENTS.focus();
	return false;
  } else if(f.PASSWD.value == ''){
  alert('패스워드를 입력하세요');
  f.PASSWD.focus();  
	return false;
  }
	
 }


function DELETE_COMMENT(UID,CURRENT_PAGE,BID,GID,BUID){
	window.open("<? echo ${BOARD_FOLDER_NAME}; ?>/skin_comment/<?=$COMMENT_SKIN_TYPE;?>/delete.php?UID="+UID+"&CURRENT_PAGE="+CURRENT_PAGE+"&BID="+BID+"&GID="+GID+"&BUID="+BUID,"","scrollbars=no, toolbar=no, width=320, height=220, top=220, left=350")
}
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align = center>
  <tr  height="1"> 
    <td height="1" colspan="6" align="center" bgcolor="#CCCCCC"></td>
  </tr>
<?      
$SQL_STR = "SELECT * FROM ${DEFAULT_TABLE_NAME}_${GID}_${BID}_comment WHERE MID='$UID' ORDER BY UID desc";
$SQL_QRY = mysql_query($SQL_STR);
while($CommentList = mysql_fetch_array($SQL_QRY)):
$CommentList[CONTENTS] = stripslashes($CommentList[CONTENTS]);
$CommentList[CONTENTS] = nl2br($CommentList[CONTENTS]);
?>
 
  <tr> 
    <td width="30">&nbsp;</td>
    <td width="50"><?=$CommentList[NAME]?></td>
    <td width="1" align="center" valign="middle" bgcolor="f0f0f0"><img src="<? echo ${BOARD_FOLDER_NAME}; ?>/skin_comment/<?=$COMMENT_SKIN_TYPE;?>/images/dotline.gif" width="1" height="25"></td>
    <td ><?=$CommentList[CONTENTS]?></td>
    <td width="80" align="center" ><?=date("Y.m.d",$CommentList[W_DATE])?> </td>
    <td width="20" align="center"><a href="javascript:;" onClick="DELETE_COMMENT('<?=$CommentList[UID]?>','<?=$CURRENT_PAGE;?>','<?=$BID;?>','<? echo $GID; ?>','<?=$UID?>');"><img src="<? echo ${BOARD_FOLDER_NAME}; ?>/skin_comment/<?=$COMMENT_SKIN_TYPE;?>/images/memo_del.gif" width="9" height="9" border="0"></a></td>
  </tr>
  <tr  height="1"> 
    <td height="1" colspan="6" align="center" bgcolor="#CCCCCC"></td>
  </tr>
<? endwhile;?>  
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0"  align = center>
 <? if(!$cmode) $cmode="write"; ?>        
<FORM NAME="COMMENT" METHOD="POST" ACTION="<? echo $_SERVER[PHP_SELF]; ?>" onSubmit="return checkCommentForm(this)">
<INPUT TYPE="hidden" NAME="COMMENT_MODE" VALUE="WRITE">
<INPUT TYPE="hidden" NAME="BID" VALUE="<?=$BID?>">
<INPUT TYPE="hidden" NAME="GID" VALUE="<?=$GID?>">
<INPUT TYPE="hidden" NAME="UID" VALUE="<?=$UID?>">
<INPUT TYPE="hidden" NAME="mode" VALUE="<?=$mode?>">
<INPUT TYPE="hidden" NAME="cmode" VALUE="<?=$cmode?>">
<INPUT TYPE="hidden" NAME="CURRENT_PAGE" VALUE="<?=$CURRENT_PAGE?>">
<INPUT TYPE="hidden" NAME="BOARD_NO" VALUE="<?=$BOARD_NO?>">
<input TYPE="hidden" name="ID" value="<?=$_COOKIE[MEMBER_ID]?>">
<input type='hidden' name='category' value='<? echo $category; ?>'>
<input type="hidden" name="sysop" value="<? echo $sysop; ?>">
<input type="hidden" name="fm" value="<? echo $fm; ?>">
<input type="hidden" name="BType" value="<? echo $BType; ?>">
<input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">

  <tr align="left"> 
    <td height="18" colspan="8"><strong>한즐글 쓰기</strong></td>
  </tr>
  <tr  height="1"> 
    <td height="1" colspan="8" align="center" bgcolor="#CCCCCC"></td>
  </tr>
  <tr> 
    <td width="70" height="30">이름</td>
    <td width="1" align="center" valign="middle" bgcolor="f0f0f0"><img src="<? echo ${BOARD_FOLDER_NAME}; ?>/skin_comment/<?=$COMMENT_SKIN_TYPE;?>/images/dotline.gif" width="1" height="25"></td>
    <td align="left">&nbsp; <input name="NAME" type="text"  value="<?=$_COOKIE[MEMBER_NAME]?>" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 18px; width:100px"></td>
    <td width="1" align="center" valign="middle" bgcolor="f0f0f0"><img src="<? echo ${BOARD_FOLDER_NAME}; ?>/skin_comment/<?=$COMMENT_SKIN_TYPE;?>/images/dotline.gif" width="1" height="25"></td>
    <td width="70">비밀번호</td>
    <td width="1" align="center" valign="middle" bgcolor="f0f0f0"><img src="<? echo ${BOARD_FOLDER_NAME}; ?>/skin_comment/<?=$COMMENT_SKIN_TYPE;?>/images/dotline.gif" width="1" height="25"></td>
    <td align="left">&nbsp; <input name="PASSWD" type="password" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 18px; width:100px"></td>
    <td>&nbsp;</td>
  </tr>
  <tr  height="1"> 
    <td height="1" colspan="8" align="center" bgcolor="#CCCCCC"></td>
  </tr>
  <tr> 
    <td>내용</td>
    <td width="1" align="center" valign="middle" bgcolor="f0f0f0"><img src="<? echo ${BOARD_FOLDER_NAME}; ?>/skin_comment/<?=$COMMENT_SKIN_TYPE;?>/images/dotline.gif" width="1" height="25"></td>
    <td colspan="5" align="left">&nbsp; <textarea name="CONTENTS"  rows="3"  style="width:98%" ></textarea></td>
    <td align="center"><input type="submit" value="작성" style="width=60px; height=35px; cursor:hand"></td>
  </tr>
  <tr> 
    <td height="5"></td>
    <td colspan="8"></td>
  </tr>
  <tr  height="1"> 
    <td height="1" colspan="9" align="center" bgcolor="#CCCCCC"></td>
  </tr></form>
</table>