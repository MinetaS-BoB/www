<?
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/skin_info.php";
include "../../../config/shopDisplay_info.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";
$ListNo = "100" ;
$PageNo = "10" ;

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title><? echo $_COOKIE[MEMBER_ID]; ?>님의 스크랩함</title>
<style>
body, td, p, input, button, textarea, select, .c1 { font-family:Tahoma,굴림; font-size:9pt; color:#565656; }

a:link, a:visited, a:active { text-decoration:none; color:#466C8A; }
a:hover { text-decoration:underline; }

a.menu:link, a.menu:visited, a.menu:active { text-decoration:none; color:#454545; }
a.menu:hover { text-decoration:none; }

.member { font-weight:bold; }
.guest  { font-weight:normal; }

.lh { line-height: 150%; }
.jt { text-align:justify; }

.li { font-weight:bold; font-size:18px; vertical-align:-4px; color:#66AEAD; }

.ul { list-style-type:square; color:#66AEAD; }

.ct { font-family: Verdana, 굴림; color:#424E10; } 

.ed { border:1px solid #CCCCCC; } 
.tx { border:1px solid #CCCCCC; } 

.small { font-size:8pt; font-family:돋움; }

</style>
</head>
<body topmargin="0" leftmargin="0" <? if($SOURCEPROTECTION == "checked") echo $SOURCE_PROTECTION_CODE ; ?>>
<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="middle" bgcolor="#EBEBEB"> <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="25" align="center" bgcolor="#FFFFFF" ><img src="../skin/member/shop_member/img/icon_01.gif" width="5" height="5"></td>
          <td width="75" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>스크랩함</b></font></td>
          <td width="490" bgcolor="#FFFFFF" ></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="200" align="center" valign="top"> <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="20"></td>
        </tr>
        <tr> 
          <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
          <td width="540" bgcolor="#FFFFFF"> <table width=100% cellpadding=1 cellspacing=1 border=0>
              <tr bgcolor=#E1E1E1 align=center> 
                <td width="11%" height="24"><b>번호</b></td>
                <td width="13%"><b>게시판</b></td>
                <td width="45%"><b>제목</b></td>
                <td width="20%"><b>보관일시</b></td>
                <td width="11%"><b>삭제</b></td>
              </tr>
<?
$WHERE  = "WHERE ID  = '$_COOKIE[MEMBER_ID]'";
/* 총 갯수 구하기 */
$TOTAL = getSingleValue("SELECT count(UID) FROM ${SCRAP_TABLE_NAME} $WHERE");
if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
//--페이지 나타내기--
/* 하단 페이지수 표시 for ($i = $SP; $i <= $EP && $i <= $TP ; $i++) */
$TP = ceil($TOTAL / $ListNo) ; /* 총페이지수(Total Page) : 총게시물수 / 페이지당 리스트수  */
$CB = ceil($CURRENT_PAGE / $PageNo); /* 현재블록(Current Block) : 현재페이지 / 표시되는 페이지 수 */
$SP = ($CB - 1) * $PageNo + 1; /* 블록의 처음 페이지(Start Page) 구하기 */
$EP = ($CB * $PageNo); /*블록의 마지막 페이지(End Page) : 현재 블록 * 표시되는 페이지수 */
$TB = ceil($TP / $PageNo); /* 총블록수(Total Block) : 총페이지수 / 표시되는 페이지 수 */
//--페이지링크를 작성하기--

$START_NO = ($CURRENT_PAGE - 1) * $ListNo;
$BOARD_NO1=$TOTAL-($ListNo*($CURRENT_PAGE-1));
$SELECT_STR="SELECT * FROM ${SCRAP_TABLE_NAME} $WHERE order by UID DESC LIMIT $START_NO, $ListNo";
//echo $SELECT_STR;


$SELECT_QRY=mysql_query($SELECT_STR);
while($LIST=@mysql_fetch_array($SELECT_QRY)):


$tmpArray = explode("_" , $LIST[TableName]);
$GID = $tmpArray[1];
$BID = $tmpArray[2];


switch($LIST[ScrapType]){
	case "BOARD" : $LinkUrl1 = "../../../${BOARD_MAIN_FILE_NAME}?GID=$GID&BID=$BID" ; $LinkUrl2 = "../../../${BOARD_MAIN_FILE_NAME}?GID=$GID&BID=$BID&mode=view&UID=$LIST[DocNo]" ;  $BoardName = getTableName($GID , $BID); $SubjectName = getSubject($GID , $BID , $LIST[DocNo]) ; break ;
}

?>			  
			  
              <tr height=25 bgcolor="#F6F6F6" align="center"> 
                <td height="24"><? echo $BOARD_NO1; ?></td>
                <td><a href="javascript:;" onClick="opener.document.location.href='<? echo $LinkUrl1; ?>';"><? echo $BoardName; ?></a></td>
                <td align="left" style='word-break:break-all;'>&nbsp;<a href="javascript:;" onClick="opener.document.location.href='<? echo $LinkUrl2; ?>';"><? echo $SubjectName; ?></a></td>
                <td><? echo date("y-m-d h:i",$LIST[WDate]); ?></td>
                <td><a href = "javascript:Del('<? echo $LIST[UID]?>')"><img src="./images/btn_comment_delete.gif" width="45" height="14" border="0"></a></td>
              </tr>
			  
<?

$BOARD_NO1--;
endwhile;
	
if(!$TOTAL){
?>
              <tr>
                <td height=24 align=center colspan=5>스크랩한 자료가 없습니다.</td>
              </tr>
<? } ?>			  
            </table></td>
        </tr>
				<tr>
					<td height = 10 ></td>
				</tr>
				<tr>
					<td align = center>
<?
$TransData = "";

if ( $CB > 1 ) {
$PREV_PAGE = $SP - 1;
echo "<a href='$PHP_SELF?CURRENT_PAGE=$PREV_PAGE&$TransData'><img src='./images/btn_prev.gif' border='0' align = absmiddle></a>";
} else {
echo "<img src='./images/btn_prev.gif'  border='0' align = absmiddle>";
 }

/* LISTING NUMBER PART */
for ($i = $SP; $i <= $EP && $i <= $TP ; $i++) {
if($CURRENT_PAGE == $i){$NUMBER_SHAPE= "<B>${i}</B>";}
else $NUMBER_SHAPE=${i};
ECHO"&nbsp;<A HREF='$PHP_SELF?CURRENT_PAGE=$i&$TransData' >$NUMBER_SHAPE</a>";
}

/* NEXT or END PART */
if ($CB < $TB) {
$NEXT_PAGE = $EP + 1;
ECHO "&nbsp;<a href='$PHP_SELF?CURRENT_PAGE=$NEXT_PAGE&$TransData'><img src='./images/btn_next.gif' border='0' align = absmiddle></a>";
} else {
ECHO"&nbsp;<img src='./images/btn_next.gif'  border='0' align = absmiddle>";
}

?>				
					</td>
				</tr>
				
      </table></td>
  </tr>
  <tr> 
    <td height="30" align="center"></td>
  </tr>
  <tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
  </tr>
  <tr> 
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
  </tr>
  <tr> 
    <td height="40" align="center" valign="bottom"><a href="javascript:window.close();"><img src="./images/btn_close.gif" width="48" height="20" border="0"></a></td>
  </tr>
</table>
<br>
</body>
</html>
<script>
	function Del(UID){
		var f = confirm("삭제된 데이터는 복구가 불가능 합니다. 삭제 하시겠습니까?");
		if(f){
			location.href = "../index.php?mode=delete&UID=" + UID + "&CURRENT_PAGE=<? echo $CURRENT_PAGE; ?>" ; 
		}
	}
</script>