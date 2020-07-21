<?
	include "../function/kerrigancap_lib.php" ;	
?>
<TITLE>INSTALL PAGE</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="./style.css" rel="stylesheet" type="text/css">

<script language='JavaScript'>
function install_check(f) {        
        if ( !f.db_host.value ) {
        alert('MYSQL 호스트를 입력해 주십시오.');
				f.db_host.focus();	
        return false;
        }
        if ( !f.USER_DB.value ) {
        alert('사용하실 MYSQL DB의 이름을 입력해 주십시오.');
				f.USER_DB.focus();
        return false;
        }
        if ( !f.db_user.value ) {
        alert('MYSQL DB 아이디를 입력해 주십시오.');
				f.db_user.focus();
        return false;
        }
        if ( !f.admin.value ) {
        alert('관리자 ID를 입력해 주십시오.');
				f.admin.focus();
        return false;
        }
        if ( !f.PASS.value ) {
        alert('초기로 등록하실 관리자 패스워드를 입력해 주십시오.');
				f.PASS.focus();
        return false;
        }
        if ( !f.PASS1.value ) {
        alert('초기로 등록하실 관리자 패스워드를 다시한번 입력해 주십시오.');
				f.PASS1.focus();
        return false;
        }
        if ( f.PASS.value != f.PASS1.value ) {
        alert('초기로 등록하실 관리자 패스워드와 확인하신 패스워드가 다릅니다.');
				f.PASS1.focus();
        return false;
        }
        if (confirm('\n입력하신 모든 값들이 정말로 정확합니까?\n')) return true;
        return false;
}
</script>
<table width="747" border="0" cellspacing="0" cellpadding="0" align = center>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr> 
          <td align="center" bgcolor="#FFFFFF"><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30" class="black_16"><strong><font color="#3366CC">쇼핑몰 
                  INSTALL PAGE</B></FONT></font></strong></td>
              </tr>
              <tr> 
                <td> <br>
                  * DB 정보를 정확히 입력해주십시요</p></td>
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
                <TD colspan="6" ><FORM NAME=install ACTION='./install3.php' METHOD='POST' onsubmit='return install_check(this);'>                  
                      <table width=700 cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                        <TR> 
                          <TD <? echo $TITLE_STYLE ; ?> COLSPAN=4 height="17">&nbsp; <FONT COLOR="#CCCCCC">다음의 
                            필드들을 정확히 입력해 주시기 바랍니다.</FONT></TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="F2F2F2" width="134"><FONT COLOR='#092F7B'>* 
                            MYSQL호스트</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="136"> <INPUT type="TEXT" name="db_host" size="15" value="localhost"> 
                          </TD>
                          <TD BGCOLOR="F2F2F2" width="135"><FONT COLOR='#092F7B'>* 
                            사용DB이름</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="177"> <INPUT type="TEXT" name="USER_DB" size="20"> 
                          </TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="F2F2F2" width="134"><FONT COLOR='#092F7B'>* 
                            DB 아이디</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="136"> <input type="TEXT" name="db_user" size="15"> 
                          </TD>
                          <TD BGCOLOR="F2F2F2" width="135"><FONT COLOR='#092F7B'>* 
                            DB 패스워드</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="177"> <INPUT type="TEXT" name="db_password" size="20"> 
                          </TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="#FFFFFF" COLSPAN=4><FONT COLOR='#092F7B'>* 
                            MYSQL호스트가 타 호스트인 경우 변경해 주십시오. MYSQL 정보가 정확해야 정상적으로 
                            설치됩니다. </FONT></TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="F2F2F2" width="134"><FONT COLOR='#092F7B'>* 
                            Admin ID</FONT></TD>
                          <TD colspan="3" BGCOLOR="#FFFFFF"> <INPUT type="TEXT" name="admin" size="15"> 
                          </TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="F2F2F2" width="134"><FONT COLOR='#092F7B'>* 
                            패스워드등록</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="136"> <INPUT type="password" name="PASS" size="15"> 
                          </TD>
                          <TD BGCOLOR="F2F2F2" width="135"><FONT COLOR='#092F7B'>* 
                            패스워드확인</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="177"> <INPUT type="password" name="PASS1" size="15"> 
                          </TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="#FFFFFF" COLSPAN=4><FONT COLOR='#092F7B'>* 
                            ID 및 패스워드는 반드시 기억하고 계셔야합니다.</FONT></TD>
                        </TR>
						<tr>
							<TD BGCOLOR="#FFFFFF" COLSPAN=4 align = center height = 30 ><INPUT TYPE=SUBMIT VALUE='INSTALL START' class = "btn20"></td>
						</tr>
                      </TABLE>                     
                  </FORM></TD>
              </TR>
            </TABLE></TD>
        </TR>
      </TABLE></td>
  </tr>
</table>


