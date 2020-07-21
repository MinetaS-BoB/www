<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include "../config/db_info.php";
include "../config/db_connect.php";
include "../config/admin_info.php";
include "../config/board_info.php";
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";


$BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";

if(file_exists("./table/${GID}/${BID}/detail_config.php")) include  "./table/${GID}/${BID}/detail_config.php";

if($_POST[Act] == "Del") {

include_once "../config/db_info.php";
include_once "../config/db_connect.php";
include_once "../config/admin_info.php";
include_once "../config/board_info.php";
include_once "../function/const_array.php";
include_once "../function/kerrigancap_lib.php";
	
	
if(!$UID) js_alert_location("글이 존재 하지 않습니다","../${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
	
/* 현재 삭제될 글의 상세정보를 가져온다 */
$SQL_STR="SELECT ID,NAME,PASSWD,EMAIL,THREAD,FID , UPDIR1 FROM $BOARD_NAME WHERE UID='$UID'";
$SQL_QRY=mysql_query($SQL_STR) or die(mysql_error());
$LIST=mysql_fetch_array($SQL_QRY);

if($member != "1"){ //회원제가 아닐경우
	$LIST[PASSWD]=trim($LIST[PASSWD]);
	if($passwd != $LIST[PASSWD]) {
		js_alert_location("패스워드가 틀립니다.","-1");		
	}
}else if(!isAdmin()){ //회원제일 경우 로그인 여부를 책크 및 로그인 아이디및 게시판 아이디 필드를 비교한다. 
	
	if(!isMember()){
		js_alert_location("글을 삭제할 권한이 없습니다 \\n\\n 먼저 로그인 하여 주시기 바랍니다.","close");
		
	}else if(!trim($LIST[ID]) || ($_COOKIE[MEMBER_ID] != $LIST[ID])){
		js_alert_location("글을 삭제할 권한이 없습니다 \\n\\n 글작성시 아이디로 로그인 하여 주시기 바랍니다.","close");
	
	}
}

/* 만약지우려는 글에 하위리플(리스트에서의 리플)이 달려있는 경우는 삭제불가능 */
$ReplyComment = $LIST[THREAD]."A";

$count = getSingleValue("select count(UID) from $BOARD_NAME where FID = '$LIST[FID]' AND THREAD = '$ReplyComment'");
if($count > 0) js_alert_location("리플이 달린 글은 지울수 없습니다.","close");

//exit;
/******** 업로딩된 파일 삭제 **************/
$Updir = explode("|", $LIST[UPDIR1]);

	for($i = 0; $i < sizeof($Updir); $i++){
		if($Updir[$i] && is_file("./table/$GID/${BID}/updir/$Updir[$i]")) {
			unlink("./table/$GID/$BID/updir/$Updir[$i]");
		}
	}

		
/******* 리플 테이블로 부터 정보 삭제 *********/
$SQL_STR="DELETE FROM {$BOARD_NAME}_comment WHERE MID='$UID'";

@mysql_query($SQL_STR) or die(mysql_error());

/******* 포인터 점수 삭제 *********/
if($LIST[ID] && $PointEnable == "checked"){
	$query_result = mysql_query( "select count(*) from ${MEMBER_TABLE_NAME} where ID = '$LIST[ID]'", $DB_CONNECT );
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	if ( $query_result ) {
			
			$Content = "${BOARD_TITLE_DESC} 게시판 글삭제로 포인트 삭제" ; // 포인트 내용
			$GName = "System" ; // 부여자 
			$Flag = "BW";//콘멘트 플래그 						
			
			$presult = boolInsertPoint($BOARD_NAME , $LIST[ID] , $GName , "-{$WritingPoint}" , $Flag ,$Content);
			if(!$presult) js_alert("포인트 DB 작업 실패");			
			$sqlstr = "update ${MEMBER_TABLE_NAME} set WriteNum = WriteNum - 1 where ID = '$LIST[ID]'";
			$sqlqry = mysql_query($sqlstr) or die(mysql_error());
			
	}
	
}

/******* 테이블로 부터 정보 삭제 *********/
	$SQL_STR="DELETE FROM $BOARD_NAME WHERE UID='$UID'";
	$result = mysql_query($SQL_STR) or die(mysql_error());
	
	// 스크랩테이블 삭제 
	if($result){
		$sql = "DELETE FROM ${SCRAP_TABLE_NAME} WHERE ScrapType  = 'BOARD' AND TableName = '$BOARD_NAME' AND DocNo = '$UID'";
		$sresult = mysql_query($sql);
	}
	
	js_alert_opener_location("게시물을 삭제했습니다.","../${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");

}
?>
<head><title>글 삭제</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="JavaScript">
<!--
function sSubmit(){
var f =  document.delete_form;
checkenable = new Array(); 
    if(f.checkenable){
    var checkenablelen = f.checkenable.length
        for (i = 0; i < checkenablelen; i++){
            if(f.checkenable[i].value == ""){
            alert(f.checkenable[i].title);
            f.checkenable[i].focus();
            return false;
            }
        }
        if(!checkenablelen && f.checkenable.value == ""){
        alert(f.checkenable.title);
        f.checkenable.focus();
        return false;
        }
    }
	
    f.submit();
}
//-->
</script> 
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<?
/* 회원 및 비회원게시판일 경우(즉, 패스워드 입력이 있고 없고에 따라 삭제 모드 표시를 달리 한다. */
$BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";
$sqlstr="SELECT ID,NAME,PASSWD,EMAIL,THREAD FROM $BOARD_NAME WHERE UID='$UID'";
$sqlqry = mysql_query($sqlstr) or die(mysql_error());
$isID = @mysql_result($sqlqry, 0, ID);
?>
<?
if(!$isID && !isAdmin()): //회원제 전용이 아닐 경우(즉, 패스워드 폼이 필요없을 경우)
?>
  <table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0" style=font-family:'굴림';font-size:12px;line-height:20px;color:#333333>
	<form name="delete_form" action="<?=$PHP_SELF?>" method=post>
	<input type='hidden' name='Act' value='Del'>
	<input type='hidden' name='UID' value='<?=$UID?>'>
	<input type='hidden' name='CURRENT_PAGE' value='<?=$CURRENT_PAGE?>'>
	<input type='hidden' name='BID' value='<?=$BID?>'>
	<input type='hidden' name='GID' value='<?=$GID?>'>
	<input type='hidden' name='category' value='<?=$category?>'>	
	<input type="hidden" name="sysop" value="<? echo $sysop; ?>">
	<input type="hidden" name="fm" value="<? echo $fm; ?>">
	<input type="hidden" name="BType" value="<? echo $BType; ?>">
	<input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">
	  
      <tr align="center"> 
        <td height="5" bgcolor="#999999"></td>
      </tr>	  
      <tr align="center"> 
        <td height="50" bgcolor="#EEEEEE">글 작성 시의 <strong><font color="#0000FF">비밀번호</font></strong>를 
          입력해주세요<br>
          삭제된 글은 <font color="#FF0000">복구가 불가능</font>합니다.</td>
      </tr>
      <tr> 
        <td height="30" align="center">비밀번호: 
          <input type="password" name="passwd" size="10" style='BACKGROUND-COLOR: white; BORDER: 1; HEIGHT: 18px; border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid;' id="checkenable" title="비밀번호를 입력해 주세요";>
          </td>
      </tr>
      <tr> 
        <td align="center" bgcolor="#EEEEEE" height="100%"><input type="button" value="삭제하기" onClick="javascript:sSubmit();" style="border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid; height:40;">&nbsp;<input type="button" value="취소하기" onClick="javascript:window.close();" style="border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid; height:40;"></td>
      </tr>
    </form>
  </table>
<script language="JavaScript">
<!--
document.delete_form.passwd.focus();
//-->
</script>  
<? 
else: //회원제 전용일 경우 
?>  
  <table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0" style=font-family:'굴림';font-size:12px;line-height:20px;color:#333333>
		<form name="delete_form" action="<?=$PHP_SELF?>" method=post>
		<input type='hidden' name='Act' value='Del'>
		<input type='hidden' name='UID' value='<?=$UID?>'>
		<input type='hidden' name='CURRENT_PAGE' value='<?=$CURRENT_PAGE?>'>
		<input type='hidden' name='BID' value='<?=$BID?>'>
		<input type='hidden' name='GID' value='<?=$GID?>'>
		<input type='hidden' name='category' value='<?=$category?>'>	  
		<input type="hidden" name="member" value="1">
		<input type="hidden" name="sysop" value="<? echo $sysop; ?>">
		<input type="hidden" name="fm" value="<? echo $fm; ?>">
		<input type="hidden" name="BType" value="<? echo $BType; ?>">
		<input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">
      <tr align="center"> 
        <td height="5" bgcolor="#999999"></td>
      </tr>	  
      <tr align="center"> 
        <td height="50" bgcolor="#EEEEEE"><br>
          삭제된 글은 <font color="#FF0000">복구가 불가능</font>합니다.</td>
      </tr>
      <tr> 
        <td height="30" align="center">정말삭제하시겠습니까?</td>
      </tr>
      <tr> 
        <td align="center" bgcolor="#EEEEEE" height="100%"><input type="button" value="삭제하기" onClick="javascript:sSubmit();" style="border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid; height:40;">&nbsp;<input type="button" value="취소하기" onClick="javascript:window.close();" style="border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid; height:40;"></td>
      </tr>
    </form>
  </table>  
<?
endif;
?>  
  </center>
</body>
</html>