<?
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/skin_info.php";
include "../../../config/shopDisplay_info.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

$ListNo = "10" ;
$PageNo = "10" ;

$MenuImg1 = "" ; // 받은쪽지 이미지 
$MenuImg2 = "" ; // 보낸쪽지 이미지
$MenuImg3 = "" ; // 쪽지보내기 이미지 
switch($MType){
	case "rec" : $MenuImg1 = "btn_recv_paper_on" ; $MenuImg2 = "btn_send_paper_off" ; $MenuImg3 = "btn_write_paper_off"; break ; 
	case "send" : $MenuImg1 = "btn_recv_paper_off" ; $MenuImg2 = "btn_send_paper_on"; $MenuImg3 = "btn_write_paper_off"; break ; 
	case "write" : $MenuImg1 = "btn_recv_paper_off" ; $MenuImg2 = "btn_send_paper_off"; $MenuImg3 = "btn_write_paper_on"; break ; 
}		
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title><? echo $_COOKIE[MEMBER_ID]; ?>님의 쪽지함</title>
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
          <td width="25" align="center" bgcolor="#FFFFFF" ><img src="./images/icon_01.gif" width="5" height="5"></td>
          <td width="65" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>내 
            쪽지함</b></font></td>
          <td width="500" bgcolor="#FFFFFF" ></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="600" height="20" colspan="14"></td>
  </tr>
  <tr> 
    <td width="30" height="24"></td>
    <td width="99" align="center" valign="middle"><a href="./list.php?MType=rec"><img src="./images/<? echo $MenuImg1; ?>.gif"  border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle"><a href="./list.php?MType=send"><img src="./images/<? echo $MenuImg2; ?>.gif"  border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle"><a href="./write.php?MType=write"><img src="./images/<? echo $MenuImg3; ?>.gif"  border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="60" valign="middle" bgcolor="#EFEFEF">&nbsp;</td>
    <td width="4" align="center" valign="middle"><img src="./images/left_img.gif" width="4" height="24"></td>
    <td width="18" align="center" valign="middle" background="./images/bar_bg_img.gif"><img src="./images/arrow_01.gif" width="7" height="5"></td>
    <td width="148" align="left" valign="middle" background="./images/bar_bg_img.gif">전체 
      받은 쪽지 [ <B><? echo number_format(getTotalMemoCnt($_COOKIE[MEMBER_ID])); ?></B> ]통</td>
    <td width="4"><img src="./images/right_img.gif" width="4" height="24"></td>
    <td width="3" bgcolor="#EFEFEF"></td>
    <td width="30" height="24"></td>
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
                <td width="30%" height="24"><b>보낸사람</b></td>
                <td width=25%><b>보낸시간</b></td>
                <td width=25%><b>읽은시간</b></td>
                <td width=20%><b>쪽지삭제</b></td>
              </tr>
<?



if($MType == "send") $WHERE  = "WHERE SendID  = '$_COOKIE[MEMBER_ID]'";
else if($MType == "rec") $WHERE  = "WHERE ReceiveID  = '$_COOKIE[MEMBER_ID]' ";

/* 총 갯수 구하기 */
$TOTAL = getSingleValue("SELECT count(UID) FROM ${MEMO_TABLE_NAME} $WHERE");
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
$SELECT_STR="SELECT * FROM ${MEMO_TABLE_NAME} $WHERE order by UID DESC LIMIT $START_NO, $ListNo";
$SELECT_QRY=mysql_query($SELECT_STR);
while($LIST=@mysql_fetch_array($SELECT_QRY)):


?>
			   <tr bgcolor=#ffffff align=center> 
                <td width="30%" height="24"><a href = "./write.php?MType=write&ReceiveID=<? echo $LIST[SendID];?>"><? echo $LIST[SendID]; ?> (<? echo getMemberName($LIST[SendID]);?>) </a></td>
                <td width=25%><a href = "./view.php?MType=<? echo $MType; ?>&UID=<? echo $LIST[UID]; ?>&CURRENT_PAGE=<? echo $CURRENT_PAGE; ?>"><? echo date("y-m-d h:i",$LIST[SendDate]); ?></a></td>
                <td width=25%><? if ($LIST[ConfirmDate]== 0) echo "읽지않음" ; else echo date("y-m-d h:i:s",$LIST[ConfirmDate]); ?></td>
                <td width=20%><a href = "javascript:Del('<? echo $LIST[UID]?>')"><img src = './images/btn_comment_delete.gif' border = 0></a></td>
              </tr>
<?

$BOARD_NO1--;
endwhile;
	
if(!$TOTAL){
?>
              <tr>
                <td height=24 align=center colspan=4>자료가 없습니다.</td>
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
$TransData = "MType=$MType";

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
ECHO"&nbsp;<A HREF='$PHP_SELF?CURRENT_PAGE=$i&$TransData'>$NUMBER_SHAPE</a>";
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
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
  </tr>
  <tr> 
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
  </tr>
  <tr> 
    <td height="40" align="center" valign="bottom"><a href="javascript:window.close();"><img src="./images/btn_close.gif" width="48" height="20" border="0"></a><br>
      <br></td>
  </tr>
</table>
</body>
</html>
<script>
	function Del(UID){
		var f = confirm("삭제된 데이터는 복구가 불가능 합니다. 삭제 하시겠습니까?");
		if(f){
			location.href = "../index.php?mode=delete&UID=" + UID + "&MType=<? echo $MType; ?>&CURRENT_PAGE=<? echo $CURRENT_PAGE; ?>" ; 
		}
	}
</script>