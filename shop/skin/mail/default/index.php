<?
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/skin_info.php";
include "../../../config/shopDisplay_info.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

if($query == "sendmail"):// 메일 보내기 

if(!$spamfree){// 스팸글 방지로직
	js_alert_location("잘못된 경로로 오셨습니다.(스팸글 방지)","-1");
}elseif($spamfree < time() - 60*60 || $spamfree > time() - 5){
	js_alert_location("잘못된 경로로 오셨습니다.(스팸글 방지2)","-1");
} 



$Title = stripslashes($Subject);
$Content = nl2br(stripslashes($Contents));
$Mail_Contents = $Content ;
$result = boolMailSend($Sender_Email , $Receiver_Email , $Title , $Mail_Contents );
if($result){
	js_alert_location("${Receiver}님에게 성공적으로 메일을 전송 하였습니다","close");
}else{
	js_alert_location("메일 전송중 에러가 발생 하였습니다.\\n\\n 관리자에게 문의하여주시기 바랍니다.","close");
}

endif;

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>메일보내기</title>
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
            <td width="65" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>메일보내기</b></font></td>
            <td width="500" bgcolor="#FFFFFF" ></td>
          </tr>
        </table></td>
    </tr>
  </table>  
  <table width="600" border="0" cellspacing="0" cellpadding="0">
    <form name="WRITE_FORM" action="<? echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="query" value="sendmail">     
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
                    <td width="30%" height="24" rowspan="2"><b>보내는분 성명</b></td>
                    <td width=70% align="center"><input type=text name="Sender" style="width:95%;" id="checkenable" title="보내는분 성명을 입력하세요" value = "<? echo $_COOKIE[MEMBER_NAME];?>"></td>
                  </tr>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td></td>
                  </tr>
                </table></td>
            </tr>
						<tr> 
              <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF"> 
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24" rowspan="2"><b>보내는분 이메일</b></td>
                    <td width=70% align="center"><input type=text name="Sender_Email" style="width:95%;" id="checkenable" title="보내는분 이메일을 입력하세요" value = "<? echo $_COOKIE[MEMBER_EMAIL];?>"></td>
                  </tr>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td></td>
                  </tr>
                </table></td>
            </tr>
						<tr> 
              <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF"> 
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24" rowspan="2"><b>받는분 성명</b></td>
                    <td width=70% align="center"><input type=text name="Receiver" style="width:95%;" id="checkenable" title="받는분 성명을 입력하세요" value = "<? echo $Name; ?>"></td>
                  </tr>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td></td>
                  </tr>
                </table></td>
            </tr>
						<tr> 
              <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF"> 
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24" rowspan="2"><b>받는분 이메일</b></td>
                    <td width=70% align="center"><input type=text name="Receiver_Email" style="width:95%;" id="checkenable" title="받는분 이메일을 입력하세요" value = "<? echo $Email; ?>"></td>
                  </tr>
                  <tr bgcolor=#E1E1E1 align=center> 
                    <td></td>
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
                <textarea name=Contents  rows=10 style='width:95%;' id="checkenable" title="내용을 입력하세요"></textarea></td>
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
        <td height="40" align="center" valign="bottom"><img src="./images/but_confirm.gif" border=0 onClick = "WRITE_FUNC();" style = "cursor:hand">&nbsp;&nbsp; 
          <a href="javascript:window.close();"><img src="./images/btn_close.gif" border="0"></a><br> 
          <br></td>
      </tr>
    </form>
  </table>
</div>
</body>
</html>
