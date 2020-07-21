<?
include_once "../config/admin_info.php";
include_once "../config/skin_info.php";
include_once "../function/const_array.php";
include_once "../config/cart_info.php";
?>

<html>
<head>
<title>[<? echo $ADMIN_TITLE ?>] - 관리자 페이지</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="./style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/GoodWord.js"></script>
<script language="javascript" src="../js/General.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="128" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="198" height="128" align="center" valign="middle" style = "padding-left:10px"><img src="./img/_logo_standard.gif"></td>
          <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td height="28"><img src="./img/_admin_img_01.gif" width="105" height="15"></td>
                      <td align="right"><table  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="36"><a href="../" target="_blank"><img src="./img/_btn_home.gif" width="32" height="18" border="0"></a></td>
                            <td width="63"><a href="main.php?THEME=Front"><img src="./img/_btn_admin_home.gif" width="59" height="18" border="0"></a></td>
                            <td width="70"><a href ="./Sysop_Logout.php"><img src="./img/_btn_logout.gif" width="59" height="18" border="0"></a></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="32" align="right"><img src="./img/_menu_top.gif" width="32" height="51"></td>
                      <td background="./img/_menu_bg.gif"><table  width = "100%" border="0" cellspacing="0" cellpadding="1">
                          <tr align="center">
							<td class="mainmenu"><a href =./main.php?menushow=menu12&THEME=SSH class="mainmenu_a">SSH Manager</a></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="100%" valign="top"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="198" height="100%" style = "padding-left:10px"><? include "./Menu_Left.php";?></td>
          <td width="20" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
          <td valign="top" bgcolor="#FFFFFF"><br>
		  <?
if(file_exists("./${THEME}.php"))require("./${THEME}.php");
?>

            <table border = 0 cellpadding="0" cellspacing="0"><tr><td height = 50></td></tr></table>
			 </td>
        </tr>
    </table></td>
  </tr>

  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="1" bgcolor="C7C7C7"> </td>
      </tr>
      <tr>
        <td height="1"> </td>
      </tr>
      <tr>
        <td height="50" align="right" bgcolor="EFEFEF"><table width="130" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
