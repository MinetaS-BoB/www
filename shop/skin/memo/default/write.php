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
<body topmargin="0" leftmargin="0" >
<script language="JavaScript">
<!--
function WRITE_FUNC(){
var f =  document.WRITE_FORM;
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
	f.spamfree.value='<?=time()?>';
    f.submit();
	document.all.WRITE_FORM_TRANSFER_DIV.style.display = "";
	document.all.WRITE_FORM_DIV.style.display ="none";
}
//-->
</script>
<DIV id=WRITE_FORM_TRANSFER_DIV style="display:none"> <br>
  <br>
  <br>
  <br>
  <table cellpadding="3" cellspacing="1" bgcolor="#E7E3E7" align="center" width="308">
    <tr> 
      <td width="300" bgcolor="white" height="100" align="center"><b>쪽지를 저장중입니다.</b><br> 
        <br>
        잠시만 기다려 주시기 바랍니다.</td>
    </tr>
  </table>
</DIV>
<DIV id=WRITE_FORM_DIV style="display:block"> 
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
        받은 쪽지 [ <B><? echo number_format(getTotalMemoCnt($_COOKIE[MEMBER_ID])); ?></B> 
        ]통</td>
      <td width="4"><img src="./images/right_img.gif" width="4" height="24"></td>
      <td width="3" bgcolor="#EFEFEF"></td>
      <td width="30" height="24"></td>
    </tr>
  </table>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
    <form name="WRITE_FORM" action="../index.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="blank" value="">
      <!-- mysql에서 언어가 kr 이 아닌경우 modify시 맨처음 hidden값이 사라지는 알지못할 버그발생땜에 -->
      <input type="hidden" name="mode" value="write">
      <input type="hidden" name="spamfree" value="">
      <tr> 
        <td height="200" align="center" valign="top"> <table width="540" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td height="20"></td>
            </tr>
            <tr> 
              <td height="2" bgcolor="#808080"></td>
            </tr>
            <tr> 
              <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF"> 
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24" rowspan="2"><b>받는 회원아이디</b></td>
                    <td width=70% align="center"><input type=text name="ReceiveID" style="width:95%;" id="checkenable" title="받는회원 아이디를 입력하세요" value = "<? echo $ReceiveID; ?>"></td>
                  </tr>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td>※ 여러 회원에게 보낼때는 컴마(,)로 구분하세요.</td>
                  </tr>
                </table></td>
            </tr>
            <tr> 
              <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF"> 
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24" rowspan="2"><b>제목</b></td>
                    <td width=70% align="center"><input type=text name="Subject" style="width:95%;" id="checkenable" title="제목을 입력하세요"></td>
                  </tr>
                </table></td>
            </tr>
            <tr> 
              <td height="200" align="center" valign="middle" bgcolor="#F6F6F6"> 
                <textarea name=Content  rows=10 style='width:95%;' id="checkenable" title="내용을 입력하세요"></textarea></td>
            </tr>
          </table></td>
      </tr>
      <tr> 
        <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
      </tr>
			<tr>
				<td height = 10></td>
			</tr>
      <tr> 
        <td height="40" align="center" valign="bottom"><img src="./images/btn_paper_send.gif" border=0 onClick = "WRITE_FUNC();" style = "cursor:hand">&nbsp;&nbsp; 
          <a href="javascript:window.close();"><img src="./images/btn_close.gif" width="48" height="20" border="0"></a><br> 
          <br></td>
      </tr>
    </form>
  </table>
</div>
</body>
</html>
