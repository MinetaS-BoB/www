<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include_once "../config/db_info.php";
include_once "../config/db_connect.php";
include_once "../function/const_array.php";
include_once "../function/kerrigancap_lib.php";


?>

</script>
<table width="735" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr> 
          <td align="center" <? echo $CONTENT_STYLE; ?>><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30" class="black_16"><strong><font color="#3366CC"> 
                  SSH Login</font></strong></td>
              </tr>
              <tr> 
                <td>관리의 편리성을 위해 웹 방식의 SSH 로그인을 지원합니다. 로그인 계정은 system 입니다<br></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <form name=ssh_login action='./SSH_Proc.php' method='POST'>
    <input type=hidden name= menushow value=<? echo $menushow; ?>>
    <input type=hidden name=THEME value=<?  echo $THEME; ?>>
    <input type=hidden name=action value='adminsave'>
    <tr> 
      <td> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?> >
          <tr bgcolor="#000000"> 
            <td colspan=4 <? echo $TITLE_STYLE ; ?>>&nbsp; SSH Login</td>
          </tr>          
          <tr> 
            <td width="92"  <? echo $LEFT_STYLE; ?> >ID</td>
            <td colspan="3" <? echo $CONTENT_STYLE; ?>> <input type="TEXT" name="ADMIN_TITLE" size="20"> 
          </tr>
		   <tr> 
            <td width="92"  <? echo $LEFT_STYLE; ?> >Password</td>
            <td colspan="3" <? echo $CONTENT_STYLE; ?>> <input type="TEXT" name="ADMIN_TITLE_E" size="20">
          </tr>
        </table>
        <center>
          <p> 
            <input type = "image" src = "./img/btn_set/btn_complete.gif" align = "absmiddle" class = "noninput">
        </center></td>
    </tr>
  </form>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>
