<?
include "../config/db_info.php";
include "../config/db_connect.php";
include "../config/admin_info.php";
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";

if ( !$_COOKIE[ADMIN_CHECK_GRADE] ) :
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>[<? echo $ADMIN_TITLE; ?> 관리자 페이지]</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.imgs){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<!-- 링크점선없애기시작 -->
<SCRIPT language=JavaScript>
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</SCRIPT>
<script language=javascript>

function loginForm(f) {

	if ( !f.ADMINID.value.length ) {
		alert('\n아이디를 입력해 주십시오. \n');
		f.ADMINID.focus();
		return false;
	}else if ( !f.ADMINPASS.value.length ) {
		alert('\n패스워드를 입력해 주십시오. \n');
		f.ADMINPASS.focus();
		return false;
	}

}

function convLow(f)
{

	var ADMINID = f.ADMINID.value;
	f.ADMINID.value = ADMINID.toLowerCase();
}


</script>
<style type="text/css">
<!--
.inputline {  border: 1px #CCCCCC solid; font-size: 9pt; color: #999999}
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('img/btn_login_on.gif','img/btn_home_on.gif');javascript:document.ADMIN_LOG.ADMINID.focus();" >
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" bgcolor="EFF4F8"> <table width="499" height="298" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="right" valign="bottom" bgcolor="#FFFFFF"><table width="474" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="474" height="81"><img src="img/img_01.gif" width="474" height="81"></td>
              </tr>
              <tr>
                <td width="474" height="147" background="img/img_02.gif"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="1">
                    <FORM ACTION='./Sysop_Login_Check.php' METHOD='POST' NAME='ADMIN_LOG' onsubmit='return loginForm(this);'>
					<input type = "hidden" name = "IP" value = "<? echo $_SERVER['REMOTE_ADDR']; ?>">
					<input type = "hidden" name = "Referer" value = "<? echo $_SERVER['HTTP_REFERRER']; ?>">
                      <tr>
                        <td width="25%" height="20">&nbsp;</td>
                        <td width="34%" align="left"><input name="ADMINID" type="text" class="inputline" style = "width:120px" tabindex="1" onblur = "convLow(this.form)" value = ""></td>
                        <td width="14%" rowspan="2"><input type = "image" src="img/btn_login.gif" name="login" width="65" height="66" border="0"  onfocus = "this.blur();"></td>
                        <td width="27%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="15">&nbsp;</td>
                        <td valign="top"><input name="ADMINPASS" type="password" class="inputline" style = "width:120px" tabindex="2" value = ""></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="57">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td colspan="2" align="right"><a href="../" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home','','img/btn_home_on.gif',1)"><img src="img/btn_home.gif" name="home" width="79" height="16" border="0"></a></td>
                        <td>&nbsp;</td>
                      </tr>
                    </form>
                  </table></td>
              </tr>
              <tr>
                <td><img src="img/img_03.gif" width="474" height="45"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?
else :
header("Location:./main.php?THEME=Front");
exit;
endif;
?>
