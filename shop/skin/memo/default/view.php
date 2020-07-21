<?
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/skin_info.php";
include "../../../config/shopDisplay_info.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

include "../../../function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$UID = filter($UID);

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

if(!$UID) js_alert_location("쪽지가 삭제되었거나 존재하지 않는 쪽지 입니다.","-1");

$sql = "select * from ${MEMO_TABLE_NAME} where UID = '$UID'" ;
$list = _mysql_fetch_array($sql);

/*
	수신 여부 설정
*/
if($MType == "rec"){// 수신일 경우만
	//ReceiveID  ConfirmDate  SendID
	if($_COOKIE[MEMBER_ID] !=$list[SendID] && $list[ConfirmDate] == 0){// 보낸이가 자기가 아니고 한번도 읽지 않았으면..update
		$ConfirmDate = time();
		$usql = "update ${MEMO_TABLE_NAME} set ConfirmDate = '$ConfirmDate' where UID = '$UID'";
		mysql_query($usql);
	}
}

$Subject = stripslashes($list[Subject]);
$Content = nl2br(stripslashes($list[Content]));

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
                <td height="24"><b><? echo $list[SendID]; ?> 님께 <? echo date("ymd j:i"); ?> 에 보낸 쪽지의 내용입니다. </b></td>
              </tr>
              <tr bgcolor=#ffffff >
                <td height="10"></td>
              </tr>
			   <tr bgcolor=#ffffff >
                <td height="24" align = left style = "padding-left:10px;word-break:break-all;">
				<? echo $Subject;?><br><br>
				<? echo $Content;?>
				</td>
              </tr>
            </table></td>
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
    <td height="40" align="center" valign="bottom"><a href = "./list.php?MType=<? echo $MType;?>&CURRENT_PAGE=<? echo $CURRENT_PAGE; ?>"><img src="./images/btn_list_view.gif"  border="0"></a> <a href="javascript:window.close();"><img src="./images/btn_close.gif" width="48" height="20" border="0"></a><br>
      <br></td>
  </tr>
</table>
</body>
</html>
<script>
	function Del(UID){
		var f = confirm("삭제된 데이터는 복구가 불가능 합니다. 삭제 하시겠습니까?");
		if(f){
			location.href = "../index.php?mode=delete&UID=" + UID + "&MType=<? echo $MType; ?>" ;
		}
	}
</script>
