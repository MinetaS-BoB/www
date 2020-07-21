<?
$sqlstr = "select BoardDes from $BOARD_MAIN_TABLE_NAME where BID = '$BID' and GID = '$GID'";
$sqlqry = mysql_query($sqlstr);
$BoardDes = mysql_result($sqlqry, 0, 0);  
?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $BOARD_FOLDER_NAME; ?>/mall_default/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $BOARD_FOLDER_NAME; ?>/mall_default/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $BOARD_FOLDER_NAME; ?>/mall_default/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<? echo $BOARD_FOLDER_NAME; ?>/mall_default/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $BOARD_FOLDER_NAME; ?>/mall_default/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;<?=$BoardDes?> </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top">