<?
	include "../function/kerrigancap_lib.php" ;	
?>
<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

if($query=="setcookie"){
setcookie("ROOT_PASS", "$PASS", 0, "/");
setcookie("ADMIN_CHECK_GRADE", "1", 0, "/");
setcookie("MEMBER_NAME", "관리자", 0, "/");
setcookie("MEMBER_ID", "$admin", 0, "/");
setcookie("MEMBER_EMAIL", "", 0, "/");
setcookie("MEMBER_GRADE", "1", 0, "/");
setcookie("MEMBER_NICKNAME", "최고관리자", 0, "/");
setcookie("ROOT_COLOR_TYPE", "2", 0, "/");	 
echo "<script>location.replace('install4.php');</script>";
exit;
}
?>
<TITLE>INSTALL PAGE</TITLE>
<link href="./style.css" rel="stylesheet" type="text/css">
<table width="747" border="0" cellspacing="0" cellpadding="0" align = center>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr> 
          <td align="center" bgcolor="#FFFFFF"><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30" class="black_16"><strong><font color="#3366CC">기초설정</font></strong></td>
              </tr>
              <tr> 
                <td> * 사이트 기본정보 및 환경을 설정합니다.<br>
											Mall 절대 경로는 신용카드 결제/이메일 전송시 사용되므로 반드시 입력해주셔야 합니다.
								</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width=100% cellspacing=0 cellpading = 0 border=0 >
        <TR> 
          <TD WIDTH=100% HEIGHT=50 BGCOLOR=WHITE VALIGN=TOP><table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" >
              <TR ALIGN=CENTER HEIGHT=22 > 
                <TD colspan="6" > <form name=install action='install5.php' method='POST'>
                    <input type=HIDDEN name=query value='adminsave'>
                    <table width="700" border="0" align="center" cellpadding="5" cellspacing="1" >
                      <tr> 
                        <td> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                            <tr > 
                              <td colspan=2 <? echo $TITLE_STYLE ; ?>>&nbsp;<font color="#660033"><b><font color="#CCCCCC"> 
                                관리자정보 및 환경을 변경합니다.</font></b></font></td>
                            </tr>
                            <tr> 
                              <td bgcolor="F2F2F2" width="201"> <p align="CENTER"> 
                                  <font color='#092F7B'>상호명</font></td>
                              <td bgcolor="#FFFFFF" width="511"> <input type="TEXT" name="COMPANY_NAME" size="20" value='<?=$COMPANY_NAME?>'> 
                              </td>
                            </tr>
                            <tr> 
                              <td bgcolor="F2F2F2" width="201"> <p align="CENTER"> 
                                  <font color='#092F7B'>홈페이지명</font></td>
                              <td bgcolor="#FFFFFF" width="511"> <input type="TEXT" name="ADMIN_TITLE" size="20" value='<?=$ADMIN_TITLE?>'> 
                              </td>
                            </tr>
                            <tr> 
                              <td bgcolor="F2F2F2" width="201"> <p align="CENTER"> 
                                  <font color='#092F7B'>이메일</font></td>
                              <td bgcolor="#FFFFFF" width="511"> <input type="text" name="ADMIN_EMAIL" size="40" value='<?=$ADMIN_EMAIL?>'> 
                                &nbsp;&nbsp; </td>
                            </tr>
                            <tr> 
                              <td bgcolor="F2F2F2" width="201"> <p align="CENTER"> 
                                  <font color='#092F7B'>Mall 절대경로</font></td>
                              <td bgcolor="#FFFFFF" width="511"> <input type="text" name="SITE_URL" size="40" value='http://<? echo $_SERVER['HTTP_HOST'] ; ?>'> 
                                <br>
                                (보기 : http://www.truesolution.co.kr ) </td>
                            </tr>
                            <tr> 
                              <td bgcolor="#FFFFFF"colspan = 3 height = 30 align = center ><input type=SUBMIT value ='설 정 완 료' name="SUBMIT" class = btn20></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                  </FORM></TD>
              </TR>
            </TABLE></TD>
        </TR>
      </TABLE></td>
  </tr>
</table>
<script>
	document.install.COMPANY_NAME.focus();
</script>