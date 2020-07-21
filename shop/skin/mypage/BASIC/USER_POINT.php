<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include "./function/member_check_module.php";

?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;마일리지내역 </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td height="3"  bgcolor="909090"></td>
                    </tr>
                    <tr> 
                      <td height="3" align="left"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="F6F6F6">
                          <tr> 
                            <td width="177" align="center" valign="middle" class="333333_b">일시</td>
                            <td width="3" align="center" valign="top"><img src="/img/bbs/bar01.gif" width="3" height="5"></td>
                            <td width="297"  align="center" valign="middle" bgcolor="F6F6F6" class="333333_b">내역</td>
                            <td width="3" align="center" valign="top"><img src="/img/bbs/bar01.gif" width="3" height="5"></td>
                            <td width="80"  align="center" valign="middle" class="333333_b">마일리지</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td height="4" ></td>
                    </tr>
                    <tr> 
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="1" bgcolor="#C7C7C7"></td>
                          </tr>
                          <tr> 
                            <td height="28" align="left" valign="middle"> 
<?
$ListNo = $SubListNo;
$PageNo = $SubPageNo;

$WHEREIS = "WHERE ID='{$_COOKIE[MEMBER_ID]}' ";

$SUM_POINT = 0 ; 
$TOTAL_POINT = getTotalPoint($_COOKIE[MEMBER_ID]); 
$TOTAL = getSingleValue("SELECT count(*) FROM ${POINT_TABLE_NAME} $WHEREIS");

if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
$START_NO = ($CURRENT_PAGE - 1) * $ListNo;

//--페이지 나타내기--
$TP = ceil($TOTAL / $ListNo) ; /* 총페이지수(Total Page) : 총게시물수 / 페이지당 리스트수  */
$CB = ceil($CURRENT_PAGE / $PageNo); /* 현재블록(Current Block) : 현재페이지 / 표시되는 페이지 수 */
$SP = ($CB - 1) * $PageNo + 1; /* 블록의 처음 페이지(Start Page) 구하기 */
$EP = ($CB * $PageNo); /*블록의 마지막 페이지(End Page) : 현재 블록 * 표시되는 페이지수 */
$TB = ceil($TP / $PageNo); /* 총블록수(Total Block) : 총페이지수 / 표시되는 페이지 수 */
//--페이지링크를 작성하기--
$NO = $TOTAL-($ListNo*($CURRENT_PAGE-1));
$sql = "SELECT * FROM ${POINT_TABLE_NAME} $WHEREIS order by UID desc limit $START_NO , $ListNo " ; 
$result = mysql_query($sql);
while($list = mysql_fetch_array($result)):
$SUM_POINT += $list[Point];
?>
                              <table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="180" height="30" align="center" valign="middle"><? echo date("Y-m-d h:i:s" , $list[WDate]);?></td>
                                  <td width="300"><? echo stripslashes($list[Content]); ?></td>
                                  <td width="80"  align="right" style = "padding-right:10px"><? echo $list[Point]; ?> Point</td>
                                </tr>
                              </table>
<?  --$NO;
	endwhile;	
?>                            </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td height="2" bgcolor="909090"></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <br> <table width="100%">
        <tr> 
          <td height="20"></td>
        </tr>
        <tr> 
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                <td width="8" height="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/box02_01.gif" width="8" height="8"></td>
                <td></td>
                <td width="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/box02_02.gif" width="8" height="8"></td>
              </tr>
              <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                <td height="26"></td>
                <td align="center" valign="middle"> 
<?
$TransData = "query=$query";
include "./${SKIN_FOLDER_NAME}/page/${PageSkin}/index.php" ; 
?>                </td>
                <td></td>
              </tr>
              <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                <td height="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/box02_04.gif" width="8" height="8"></td>
                <td></td>
                <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/box02_03.gif" width="8" height="8"></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <br> <table width="100%" border="3" cellpadding="0" cellspacing="0" bordercolor="EEEEEE">
        <tr> 
          <td height="50" align="center"><table border="0" cellspacing="0" cellpadding="5">
              <tr> 
                <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/mypage_img_01.gif" width="102" height="21"></td>
                <td class="red-b"><? echo  number_format($TOTAL_POINT);?></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <br> </td>
              </tr>
            </table>
            <br>
            <br></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/mypage/<?=$MyPageSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
