<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/




if (!$sort) {$sort = "Ranking";}
if ($query == 'search') {
	$WHEREIS = "WHERE 1 AND Status = 'Y' ";
	if ($Category) { $WHEREIS = "$WHEREIS AND Category LIKE '%$Category'";}
	if ($price1) {$WHEREIS = "$WHEREIS AND Price >= $price1";}
	if ($price2) {$WHEREIS = "$WHEREIS AND Price <= $price2";}
	if ($Brand) {$WHEREIS = "$WHEREIS AND Brand LIKE '%$Brand%'";}
	if ($keyword) {
	$keyword = strip_tags(trim($keyword));
	$WHEREIS = "$WHEREIS AND Name LIKE '%$keyword%' OR Brand  LIKE '%$keyword%'";}
}


if ($query == 'natural') {
	if (!$keyword) {
		js_alert_location("\\n자연에 검색에 필요한 문장을 입력해 주세요.\\n","-1");
	}

	$Natural_Key_Spl = explode(" ", $keyword);
	$WHEREIS = "WHERE $Target LIKE '%$Natural_Key_Spl[0]%'";

	for ($i = 1; $i < sizeof($Natural_Key_Spl) && $i <= 100; $i++) {
		$WHEREIS = "$WHEREIS $andor $Target LIKE '%$Natural_Key_Spl[$i]%'";
	}
}


/* 페이징과 관련된 수식 구하기 */

$ListNo = $SearchSubListNo;
$PageNo = $SearchSubPageNo ;

if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
$START_NO = ($CURRENT_PAGE - 1) * $ListNo;
$TOTAL_STR = "SELECT count(*) FROM ${MALL_TABLE_NAME} $WHEREIS";
$REALTOTAL = getSingleValue($TOTAL_STR);

$sqlstr = "SELECT count(*) FROM ${MALL_TABLE_NAME} $WHEREIS";
$TOTAL = getSingleValue($sqlstr);
//--페이지 나타내기--
$TP = ceil($TOTAL / $ListNo) ; /* 페이지 하단의 총 페이지수 */
$CB = ceil($CURRENT_PAGE / $PageNo);
$SP = ($CB - 1) * $PageNo + 1;
$EP = ($CB * $PageNo);
$TB = ceil($TP / $PageNo);
?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr >
          <td height="10" colspan="3"></td>
        </tr>
        <tr align="left" valign="top">
          <td width="10" height="10" background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_box01.gif">&nbsp;</td>
          <td align="center" background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_box02.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="21">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr align="left" valign="top">
                      <td width="320"><img src="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_title01.gif" width="143" height="26"></td>
                      <td width="360" align="right" valign="middle"  style="padding-right:10">
                        <!--<a href="search02.php"><img src="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_btn_deep.gif" width="55" height="14" border="0"></a>-->
                      </td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="12"></td>
              </tr>
              <tr>
                <td height="20" class="333333">
                  <?=$keyword?>
                  검색어로 총
                  <?=number_format($REALTOTAL)?>
                  개의 상품들을 검색하였습니다.</td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table></td>
          <td width="10" background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_box03.gif">&nbsp;</td>
        </tr>
        <tr align="left" valign="top">
          <td background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/sub_box01_08.gif"></td>
          <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr >
                      <td width="120" height="76" align="center" background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_img01.gif"></td>
                      <td width="440" align="center" background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_bg01.gif"><table border="0" cellspacing="0" cellpadding="0">
                          <form  action="<? echo $_SERVER[PHP_SELF]; ?>" method = "post">
                            <input type="hidden" name="query" value="search">
                            <input type="hidden" name="Target" value="all">
                            <tr align="left" valign="bottom">
                              <td> <input name="keyword" type="text" class="input1" size="30">
                              </td>
                              <td width="5">&nbsp;</td>
                              <td width="74"><input type = "image" src="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_btn_research.gif" width="74" height="20"></td>
                            </tr>
                          </form>
                        </table></td>
                      <td width="120" align="center" background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/search_bg01.gif"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="3"  bgcolor="#51C7CF"></td>
              </tr>
              <tr>
                <td height="28" align="left" valign="top" bgcolor="#F0FAFB"><table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="364" align="center" valign="middle" class="333333_bs">제품정보</td>
                      <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/bar02.gif" width="3" height="5"></td>
                      <td width="117"  align="center" valign="middle" class="333333_bs">브랜드</td>
                      <td width="3"  align="center" valign="top" class="333333_bs"><img src="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/bar02.gif" width="3" height="5"></td>
                      <td width="90"  align="center" valign="middle" class="333333_bs">원산지</td>
                      <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/bar02.gif" width="3" height="5"></td>
                      <td width="93"  align="center" valign="middle" class="333333_bs">가격/포인트</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="4" ></td>
              </tr>
              <tr>
                <td align="left" valign="top">
<?
$LIST_QUERY = "SELECT * FROM ${MALL_TABLE_NAME} $WHEREIS ORDER BY $sort ASC LIMIT $START_NO,$ListNo";

$TABLE_DATA = mysql_query($LIST_QUERY, $DB_CONNECT);
$NO = $TOTAL-($ListNo*($CURRENT_PAGE-1));
while( $list = mysql_fetch_array( $TABLE_DATA ) ) :

$link_url = "'${MART_MAIN_FILE_NAME}?query=view&code=$list[Category]&no=$list[UID]'";
$Picture = explode("|", $list[Picture]);

?>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#A7E1E6">
                      <td height="1" colspan="6"  class="666666"></td>
                    </tr>
                    <tr>
                      <td width="371" height="70" align="center" valign="middle" class="666666"><table width="348" height="60" border="0" cellpadding="0" cellspacing="0">
                          <tr align="left" valign="top">
                            <td width="61"><A HREF=<? echo $link_url; ?>><IMG SRC='./<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[0]?>' WIDTH='60' HEIGHT='60' BORDER=0></A></td>
                            <td width="25">&nbsp;</td>
                            <td width="262" class="666666"><span class="333333_b"><A HREF=<?=$link_url?>>
                              <?=$list[Name]?>
                              </A></span> </td>
                          </tr>
                        </table></td>
                      <td width="1"></td>
                      <td width="117"  align="center" valign="middle" class="666666">
                        <?=$list[Brand]?>
                      </td>
                      <td width="91"  align="center" valign="middle" class="666666"><? echo $list[GetComp];?></td>
                      <td width="3"></td>
                      <td width="97"  align="center" valign="middle" class="666666">
                        <?=number_format($list[Price])?>
                        원</FONT><BR>
                        <?=number_format($list[Point])?>
                        포인트</td>
                    </tr>
                  </table>
                  <? endwhile;?>
                </td>
              </tr>
              <tr>
                <td height="2" bgcolor="#51C7CF"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td align="center" valign="top">
<?
/* PREVIOUS or First 부분 */
$TransData = "query=$query&cat=$cat&Target=$Target&keyword=$keyword&price1=$price1&price2=$price2&Brand=$Brand&sort=$sort&andor=$andor";
include "${SKIN_FOLDER_NAME}/page/${PageSkin}/index.php" ;
?>
                </td>
              </tr>
              <tr>
                <td height="30" align="center" valign="top">&nbsp;</td>
              </tr>
            </table></td>
          <td background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/sub_box01_04.gif"></td>
        </tr>
        <tr align="left" valign="top">
          <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
          <td background="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/sub_box01_06.gif"></td>
          <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/search/<?=$SearchSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
