<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp; 약관동의</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" align="center" valign="top"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/join_img_01.gif" width="290" height="15"></td>
              </tr>
              <tr>
                <td align="center"><table width="635" border="0" cellpadding="0" cellspacing="0" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/join_td_bg_02.gif">
                    <tr>
                      <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/join_td_bg_01.gif" width="635" height="24"></td>
                    </tr>
                    <tr>
                      <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><div id="scrollbox">
<?
$sql = "select * from ${CONTENT_TABLE_NAME} where Code = 'agreement'";
$list = _mysql_fetch_array($sql);
$Content = stripslashes($list[Content]);  
echo $Content; 
?>
                              </div></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td height="56" align="center" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/join_td_bg_03.gif"><table border="0" cellspacing="0" cellpadding="0">
                          <tr align="center">
                            <td width="133"><a href="<? echo $_SERVER['PHP_SELF']?>?query=regis"  onFocus = "this.blur();"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_agree.gif" border="0"></a></td>
                            <td width="133"><a href="./"  onFocus = "this.blur();"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_noagree.gif" border="0"></a></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br>
            <br></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
