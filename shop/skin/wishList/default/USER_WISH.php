<?
if (!isMember()) {
	js_alert_location("로그인 후 이용해 주세요. ","-1");
}
?>
<script>
<!--
	function wishDelete(){
		if(confirm("위시 리스트에 있는 상품을 비우시겠습니까?")) location.href = "./<? echo ${SKIN_FOLDER_NAME}; ?>/wishList/index.php?mode=truncate";		
	}
//-->
</script>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;상품보관함(찜하기) </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="3"  bgcolor="909090"></td>
        </tr>
        <tr> 
          <td height="3" align="left"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="F6F6F6">
              <tr> 
                <td width="97" align="center" valign="middle" class="333333_b">상품</td>
                <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/bar01.gif" width="3" height="5"></td>
                <td width="200"  align="center" valign="middle" bgcolor="F6F6F6" class="333333_b">상품명</td>
                <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/bar01.gif" width="3" height="5"></td>
                <td width="77"  align="center" valign="middle" class="333333_b">단가</td>
                <td width="3"  align="center" valign="top" class="333333_b"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/bar01.gif" width="3" height="5"></td>
                <td width="77"  align="center" valign="middle" class="333333_b">적립금</td>
                <td width="3"  align="center" valign="top" class="333333_b"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/bar01.gif" width="3" height="5"></td>
                <td width="80"  align="center" valign="middle" class="333333_b">장바구니담기</td>
                <td width="3"  align="center" valign="top" class="333333_b"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/bar01.gif" width="3" height="5"></td>
                <td width="37"  align="center" valign="middle" class="333333_b">삭제</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="4" ></td>
        </tr>
        <tr> 
          <td align="left" valign="top"> 
            <?
$ListNo = $SubListNo ; 
$PageNo = $SubPageNo ; 
if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;

$WHERE = "WHERE ID = '$_COOKIE[MEMBER_ID]'";

$TOTAL = getSingleValue("SELECT count(*) as cnt FROM ${WISHLIST_TABLE_NAME} $WHERE ");// 검색 조건에 맞는 레코드 수

//--페이지 나타내기--
$TP = ceil($TOTAL / $ListNo) ; /* 페이지 하단의 총 페이지수 */
$CB = ceil($CURRENT_PAGE / $PageNo);
$SP = ($CB - 1) * $PageNo + 1;
$EP = ($CB * $PageNo);
$TB = ceil($TP / $PageNo);
$NO = $TOTAL-($ListNo*($CURRENT_PAGE-1));
$wsql = "SELECT * FROM ${WISHLIST_TABLE_NAME} $WHERE"; 
$wresult = mysql_query($wsql);
while($wlist = mysql_fetch_array($wresult)):

$sql = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID = '$wlist[PID]' AND Status = 'Y'";
$list = _mysql_fetch_array($sql);
$list[Name] = stripslashes($list[Name]);
$list[CompName] = stripslashes($list[CompName]);
$list[Model] = stripslashes($list[Model]);
$Picture = explode("|",$list[Picture]); 
$linkUrl = "${MART_MAIN_FILE_NAME}?code=$list[Category]&query=view&no=$list[UID]";

?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="1" bgcolor="#C7C7C7"></td>
              </tr>
              <tr> 
                <td height="28" align="left" valign="middle"><table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="108" height="85" align="center" valign="middle" class="999999"><table border="0" cellpadding="1" cellspacing="1" bgcolor="E5E5E5">
                          <tr> 
                            <td bgcolor="#FFFFFF"><a href='<? echo $linkUrl ; ?>'><img src='<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[0]?>' width='<? echo $WLIMAGEW; ?>' height='<? echo $WLIMAGEH; ?>' border=0></A></td>
                          </tr>
                        </table></td>
                      <td width="230" style="padding-left:5;word-break:break-all;">
                        <? if($list[None] == "checked") echo "[품절]";?>
                        <? echo $list[Name]; ?></td>
                      <td width="100"  align="center" valign="middle" style="color:red;font-size: 9pt;font-weight:bold"><? echo number_format($list[Price]);?> 원</td>  
                      <td width="92" align="center" class="green-b"><? echo number_format($list[Point]);?> Point</td>
                      <td width="92"  align="center" valign="middle" class="666666">
                        <? if($list[None] != "checked"){?>
                        <a href = "<? echo ${CART_MAIN_FILE_NAME}; ?>?query=cart_save&no=<?=$list[UID]?>&BUYNUM=1&GoodsPrice=<? echo $list[Price];?>&GoodsPoint=<? echo $list[Point]; ?>"><img src = <? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/btn_cart_go.gif border = 0></a>
                        <? }?>                      </td>
                      <td width="48"  align="center" valign="middle" class="666666"><a href = "<? echo ${SKIN_FOLDER_NAME}; ?>/wishList/index.php?mode=delete&UID=<? echo $wlist[UID]; ?>"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/btn_del.gif" width="21" height="13" border = 0></a></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <? endwhile;?>          </td>
        </tr>
        <tr> 
          <td height="2" bgcolor="909090"></td>
        </tr>
        <tr> 
          <td  height = 10 ></td>
        </tr>
        <tr> 
          <td height="30" align="center" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                <td width="8" height="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/product/box02_01.gif" width="8" height="8"></td>
                <td></td>
                <td width="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/product/box02_02.gif" width="8" height="8"></td>
              </tr>
              <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                <td height="26"></td>
                <td align="center" valign="middle"> 
<?
$TransData = "query=wish";
include "${SKIN_FOLDER_NAME}/page/${PageSkin}/index.php" ; 
?>                </td>
                <td></td>
              </tr>
              <tr align="left" valign="top" bgcolor="#E9F5E5"> 
                <td height="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/product/box02_04.gif" width="8" height="8"></td>
                <td></td>
                <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/product/box02_03.gif" width="8" height="8"></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <br> <table width = "336" border="0" cellspacing="0" cellpadding="0" align = center>
        <tr> 
          <td width = "336" align = center ><a href="./"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/btn_shopping.gif" width="102" height="27" border="0"></a> 
            <? if($TOTAL){?>
            <a href="javascript:wishDelete();"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/btn_allcancle_02.gif" width="102" height="27" border="0"></a> 
            <? }?>          </td>
        </tr>
      </table>
      <br> <br></td>
  </tr>
</table>
            <br>
            <br></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/wishList/<?=$WishSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
