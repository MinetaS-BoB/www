<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
/*

*/



$Active_Cnt = getSingleValue("SELECT COUNT(UID)  FROM ${MALL_TABLE_NAME} WHERE UID='$no'");
if(!$Active_Cnt) js_alert_location("상품이 존재하지 않거나 삭제 되었습니다.","-1");

$GoToListUrl = "&ArrangeBy=$ArrangeBy&option3=$option3&Brand=$Brand&ListNo=$ListNo&mid_cate=$mid_cate&small_cate=$small_cate";
//카테고리 매장 분류에서 사용자 정의가 되어있어면 아래와 같이 실행된다.
$big_code = substr($code, -2);
$sqlstr = "select * from ${CATEGORY_TABLE_NAME} where cat_no < 100 AND cat_no LIKE '%$big_code' and cat_flag = 'M'";
$codelist = _mysql_fetch_array($sqlstr);
if($codelist[cat_skin]) $ShopSkin = $codelist[cat_skin];
if($codelist[cat_skin_viewer]) $ViewerSkin = $codelist[cat_skin_viewer];
/* 정의된 shop-skin이 있으면 이것으로 skin을 바꾼다.*/
//현재는 대분류에서 지정된 것이 일률적으로 모든 이하 페이지에 지정되도록 되어있습니다
echo stripslashes($codelist[cat_top]);
//카테고리 매장 분류에서 사용자 정의가 되어있어면 상기와 같이 실행된다.

$VIEW_QUERY = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID='$no'";
// echo  'query : '.$VIEW_QUERY;
$list = mysql_fetch_array(mysql_query($VIEW_QUERY, $DB_CONNECT));
$list[Name] = stripslashes($list[Name]);
$list[Model] = stripslashes($list[Model]);
$list[CompName] = stripslashes($list[CompName]);
$list[Brand] = stripslashes($list[Brand]);
$list[Description1] = stripslashes($list[Description1]);
$list[Description2] = stripslashes($list[Description2]);

if ($list[TextType1] != "checked") $list[Description1] = nl2br($list[Description1]);// 상품 설명
if ($list[TextType2] != "checked") $list[Description2] = nl2br($list[Description2]);

$Picture = explode("|",$list[Picture]);
$DetailPicture = explode("|",$list[DetailPicture]);


// 조회수를 증가시킨다.
//  한번만 올라가게 수정 요망
$HIT_QUERY = "UPDATE ${MALL_TABLE_NAME} SET Hit = Hit+1 WHERE UID='$no'";
mysql_query($HIT_QUERY,$DB_CONNECT) or die(mysql_error());

/* 이전 디렉토리 구하기 */
$PRE_SHOP_CODE = $code;
?>
<SCRIPT LANGUAGE=javascript>


//상품가격 세팅
function setPrice(tmpPrice)
{

		f = document.view_form;
		var tmp = "";
		var tmp = tmpPrice.split("=");
		var TmpPrice = tmp[1];
		var TmpPoint = tmp[2];
		var BUYNUM = f.BUYNUM.value;

	if(tmpPrice != "none"){// 가격변동시
		//alert(TmpPrice);

		f.GoodsPrice.value = eval( parseInt(<? echo $list[Price];?>) + parseInt(TmpPrice) ) * BUYNUM ;
		f.OriginalPrice.value = eval( parseInt(<? echo $list[Price];?>) + parseInt(TmpPrice) );

		if(TmpPoint != ""){
			f.GoodsPoint.value = eval( parseInt(<? echo $list[Point];?>) + parseInt(TmpPoint) ) * BUYNUM ;
			f.OriginalPoint.value = eval(parseInt(<? echo $list[Point];?>) + parseInt(TmpPoint)  );
		}

	}else{// 가격변동을 하지 않을경우
		f.GoodsPrice.value = <? echo $list[Price];?> * BUYNUM ;
		f.OriginalPrice.value = <? echo $list[Price];?>;
		f.GoodsPoint.value = <? echo $list[Point]?> * BUYNUM ;
		f.OriginalPoint.value = <? echo $list[Point];?>;
	}
}


function num_plus(f){

	gnum = parseInt(f.BUYNUM.value);
	f.BUYNUM.value = gnum + 1;
	f.GoodsPrice.value = eval(f.OriginalPrice.value * f.BUYNUM.value);// 가격
	f.GoodsPoint.value = eval(f.OriginalPoint.value * f.BUYNUM.value);// 포인트
	return;

}

function num_minus(f){

	gnum = parseInt(f.BUYNUM.value);

if( gnum > 1 ){

	f.GoodsPrice.value -= f.OriginalPrice.value ;// 가격
	f.GoodsPoint.value -= f.OriginalPoint.value ;// 포인트
	f.BUYNUM.value = gnum - 1;

	}

	return;

}


function wishreally(ID){

	var f = document.view_form;

	if (ID == "") {

		var e = confirm("위시리스트를 이용하기 위해서는 로그인을 하셔야 합니다.\n\n로그인 하시겠습니까?");
		if(e){

			f.action = "<? echo ${MEMBER_MAIN_FILE_NAME}; ?>";
			f.method = "post";
			f.query.value = "login";
			f.sub_query.value = "";
			f.mode.value = "";
			f.OriginalPrice.value = "";
			f.OriginalPoint.value = "";
			f.ReturnUrl.value = escape(document.URL);

			f.submit();
			return true;

		}else{
			return false;
		}

	}else if (confirm('\n\n정말로 본 제품을 위시리스트에 담으시겠습니까?\n\n')){
		f.action = "./<? echo ${SKIN_FOLDER_NAME}; ?>/wishList/index.php";
		f.mode.value = "insert" ;
		f.submit();
	 return true;
	}else{
	return false;
	}

}

function baropay(f,val){
f.GoodsPrice.value = f.GoodsPrice.value/f.BUYNUM.value;
f.GoodsPoint.value = f.GoodsPoint.value/f.BUYNUM.value;
f.sub_query.value = val;
f.method = "post";
f.submit();

}

function checkForm(f){

	<?
	foreach($OptionName as $key => $value){
	if($list[$key]) :
		if($OptionName[$key][1] == "checked"):// 셀렉트 박스일경우만 체크
	?>
		if(f.<?=$key?>.value == 'none'){
			alert('<? echo $OptionName[$key][0];?>를 선택해 주세요');
			f.<?=$key?>.focus();
			return false;
		}
	<?
		endif;
	endif;
	next($OptionName);
	}
	?>

	f.GoodsPrice.value = f.GoodsPrice.value/f.BUYNUM.value;
	f.GoodsPoint.value = f.GoodsPoint.value/f.BUYNUM.value;


}
</SCRIPT><table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;상품상세설명 </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
      <!-- 상품보기 -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="10"></td>
          <td width="100%" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <FORM NAME='view_form' ACTION='<? echo ${CART_MAIN_FILE_NAME}; ?>' metbod="post" onsubmit='return checkForm(this);'>
                <INPUT TYPE=HIDDEN NAME='query' VALUE='cart_save'>
                <INPUT TYPE=HIDDEN NAME='no' VALUE='<?=$no?>'>
                <INPUT TYPE=HIDDEN NAME='sub_query' VALUE= ''>
                <INPUT TYPE=HIDDEN NAME='mode' VALUE=''>
								<INPUT TYPE=HIDDEN NAME='OriginalPrice' VALUE='<? echo $list[Price];?>'>
								<INPUT TYPE=HIDDEN NAME='OriginalPoint' VALUE='<? echo $list[Point];?>'>
								<INPUT TYPE=HIDDEN NAME='ReturnUrl' VALUE=''>
                <tr>
                  <td width="300" align="center" valign="top"> <table width="266" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="top"><table width="266" border="0" cellpadding="0" cellspacing="0">
                            <tr align="left" valign="top">
                              <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/box03_01.gif" width="18" height="18"></td>
                              <td width="230" background="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/box03_02.gif">&nbsp;</td>
                              <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/box03_03.gif" width="18" height="18"></td>
                            </tr>
                            <tr align="left" valign="top">
                              <td background="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/box03_08.gif">&nbsp;</td>
                              <td align="center"><A HREF='#' onclick="javascript:window.open('<? echo ${SKIN_FOLDER_NAME}; ?>/viewer/<?=$ViewerSkin?>/picview.php?no=<?=$list[UID]?>', 'BICIMAGEWINDOW','width=630,height=565,statusbar=no,scrollbars=no,toolbar=no,resizable=no')"><IMG SRC='<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[1]?>' BORDER=0 width="<? echo $MIMAGEW; ?>" height = "<? echo $MIMAGEH; ?>"></A></td>
                              <td height="230" background="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/box03_04.gif">&nbsp;</td>
                            </tr>
                            <tr align="left" valign="top">
                              <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/box03_07.gif" width="18" height="18"></td>
                              <td background="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/box03_06.gif">&nbsp;</td>
                              <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/box03_05.gif" width="18" height="18"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td height="5"></td>
                      </tr>
                      <tr>
                        <td align="center" valign="top"><A HREF='#' onclick="javascript:window.open('<? echo ${SKIN_FOLDER_NAME}; ?>/viewer/<?=$ViewerSkin?>/picview.php?no=<?=$list[UID]?>', 'BICIMAGEWINDOW','width=630,height=565,statusbar=no,scrollbars=no,toolbar=no,resizable=no')"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_zoom.gif" width="129" height="33" border="0"></a></td>
                      </tr>
                    </table></td>
                  <td width="10"></td>
                  <td width="380" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10" colspan="2"> </td>
                      </tr>
											<tr>
                      <td width="8" height="12">&nbsp;</td>
                      <td width="392" height="25"><a href="#" onClick="MM_openBrWindow('<? echo ${SKIN_FOLDER_NAME}; ?>/viewer/<?=$ViewerSkin?>/recommand_mail.php?no=<? echo $list[UID]; ?>&code=<? echo $code;?>','','width=385,height=450')"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_mail.gif" width="104" height="18" border="0"></a></td>
                    </tr>
                      <tr>
                        <td height="230" colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10" height="30"></td>
                              <td colspan="3" class="333333_b">
                                <? if($list[None] == "checked") echo "[품절]";?>
                                <?=$list[Name]?>
                                <?if($list[Model]):?>
                                (
                                <?=$list[Model]?>
                                )
                                <?endif;?>
                              </td>
                            </tr>
                            <tr>
                              <td height="1" colspan="4" bgcolor="#EDEDED"></td>
                            </tr>
                            <tr>
                              <td width="10" height="30"></td>
                              <td width="70" class="666666"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/blit03.gif" width="3" height="5">
                                판매가격 </td>
                              <td width="15" align="center" class="666666">:</td>
                              <td width="275" class="green-b">
															<input class="green-b" type="text" size="7" name="GoodsPrice" readonly style="color:red;text-align:right;font-size: 9pt; border:0 solid #000000;background-color:white;" value="<?=$list[Price];?>"> 원
                              </td>
                            </tr>
                            <tr>
                              <td height="1" colspan="4" bgcolor="#EDEDED"></td>
                            </tr>
														<? if($POINT_ENABLE == "checked"){?>
														<tr>
                              <td width="10" height="30"></td>
                              <td width="70" class="666666"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/blit03.gif" width="3" height="5">
                                포인트 </td>
                              <td width="15" align="center" class="666666">:</td>
                              <td width="275" class="green-b">

															<input class="green-b" type="text" size="7" name="GoodsPoint" readonly style="color:Orange;text-align:right;font-size: 9pt; border:0 solid #000000;background-color:white;" value="<?=$list[Point];?>"> Point
                                                             </td>
                            </tr>
                            <tr>
                              <td height="1" colspan="4" bgcolor="#EDEDED"></td>
                            </tr>
														<? }?>
														<? if($list[Brand]){?>
                            <tr>
                              <td width="10" height="30"></td>
                              <td width="71" class="666666"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/blit03.gif" width="3" height="5">
                                브랜드</td>
                              <td align="center" class="666666">:</td>
                              <td class="666666">
                                <?=$list[Brand]?>
                              </td>
                            </tr>
                            <tr>
                              <td height="1" colspan="4" bgcolor="#EDEDED"></td>
                            </tr>
														<? } ?>
														<? if($list[GetComp]){?>
                            <tr>
                              <td width="10" height="30"></td>
                              <td width="71" class="666666"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/blit03.gif" width="3" height="5">
                                원산지</td>
                              <td align="center" class="666666">:</td>
                              <td class="666666"><? echo stripslashes($list[GetComp]); ?></td>
                            </tr>
                            <tr>
                              <td height="1" colspan="4" bgcolor="#EDEDED"></td>
                            </tr>
														<? } ?>
															<?
																foreach($OptionName as $key => $value){
																if($list[$key]) :

															?>
                            <tr>
                              <td width="10" height="30"></td>
                              <td width="71" class="666666"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/blit03.gif" width="3" height="5">
                                <? echo $OptionName[$key][0];?> </td>
                              <td align="center" class="666666">:</td>
                                          <td class="666666">
                               <?
																	if($OptionName[$key][1] == "checked"):// 셀렉트 박스
																	$Option = split("\n", $list[$key]);
															?>
                                            <select name="<? echo key($OptionName);?>" class="input1" <?
																$checkSelect = "";
															 for($i = 0; $i < sizeof($Option) && $Option[$i]; $i++) {
															 	if(ereg("=" , trim($Option[$i])))  $checkSelect = " onChange = \"setPrice(this.value)\"" ; else $checkSelect = "" ;
															 }
															 echo $checkSelect;
															 ?>>
                                              <option value = "none"><? echo $OptionName[$key][0];?>
                                              선택</option>
																<?

																for($i = 0; $i < sizeof($Option) && $Option[$i]; $i++) {
																	if(ereg("=" , trim($Option[$i])))  {
																	$tmpOptionValue = explode("=" , trim($Option[$i]));
																	if(intval($tmpOptionValue[1]) > 0) $tmpPrefix = " 추가" ;
																	else $tmpPrefix = " 차감" ;
																	echo  "<option value='".trim($Option[$i])."'>".trim($tmpOptionValue[0]). "  " . $tmpOptionValue[1] . " $tmpPrefix" . "</option>";
																	}else {
																	echo  "<option value='".trim($Option[$i])."'>".trim($Option[$i])."</option>";
																	}
																}

																?>
                                            </select>
                               <?
																else : // text
																	echo $list[$key];
																endif;
															?>
                                          </td>
                            </tr>
                            <tr>
                              <td height="1" colspan="4" bgcolor="#EDEDED"></td>
                            </tr>
<?
endif;
next($OptionName);
}
?>
                            <tr>
                              <td width="10" height="30"></td>
                              <td width="71" class="666666"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/blit03.gif" width="3" height="5">
                                주문수량</td>
                              <td align="center" class="666666">:</td>
                              <td class="666666"> <table width = 70 cellpadding=0 cellspacing=0 border=0 >
                                  <tr>
                                    <td rowspan=2> <input type=text size=3 name="BUYNUM" maxlength=4 value="1" class="input2" <? echo $ONLY_NUMBER_STYLE; ?> readonly>
                                    </td>
                                    <td><a href="javascript:num_plus(document.view_form);"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_up.gif" border=0></a></td>
                                    <td rowspan=2>&nbsp;&nbsp;개</td>
                                  </tr>
                                  <tr>
                                    <td><a href="javascript:num_minus(document.view_form);"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_down.gif" border=0></a></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td height="1" colspan="4" bgcolor="#EDEDED"></td>
                            </tr>
                            <tr>
                              <td width="10" height="30"></td>
                              <td width="71" class="666666"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/blit03.gif" width="3" height="5">
                                제품상태 </td>
                              <td align="center" class="666666">:</td>
                              <td class="666666" style="word-break:break-all;">
																<?
																	if($list[None] == "checked")  echo $OPTION_IMAGE_ARRAY[NONE]; // 품절이면 품절 아이콘
																	else  getOptionIcon($list[Option3]); // 나머지 옵션 아이콘
																?>

                              </td>
                            </tr>
                            <tr>
                              <td height="1" colspan="4" bgcolor="#EDEDED"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td height="15" colspan="2"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right" valign="top">
                          <? if($list[None] != "checked" ){?>
                          <img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_wish.gif" border="0" onClick = "javascript:wishreally('<? if(isMember()) echo $_COOKIE[MEMBER_ID]; ?>');" style=cursor:hand>
                          <img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_buy.gif" border="0"  onclick=baropay(document.view_form,'baro'); style=cursor:hand>
                          <input type="image" src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_cart.gif" border="0">
                          <? }?>
                          <a href="<? echo $_SERVER[PHP_SELF]; ?>?code=<?=$PRE_SHOP_CODE?>&<? echo $GoToListUrl; ?>"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_list.gif" border="0"></a>

                        </td>
                      </tr>
                    </table></td>
                </tr>
              </form>
            </table></td>
          <td width="10"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="25"></td>
  </tr>
</table>
<!-- 상품상세설명 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="26" align="left" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/proimfo_title.gif" width="670" height="26"></td>
  </tr>
  <tr>
    <td height="10" ></td>
  </tr>
  <tr>
    <td height="0" class="333333">
      <?
	  if($DetailPicture[0]) echo "<img src = './${STOCK_FOLDER_NAME}/product_detail/$DetailPicture[0]' border = 0>";
	  echo $list[Description1]; ?>
    </td>
  </tr>
  <tr>
    <td height="10" ></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="26" align="left" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/proimfo_title_02.gif" width="670" height="26"></td>
  </tr>
  <tr>
    <td height="10" ></td>
  </tr>
  <tr>
    <td class="333333" valign = top>
<?
// 배송 관련 정보
$Delivery_Contents = getSingleValue("select Content  from ${CONTENT_TABLE_NAME} where Code = 'delivery' ");
$Delivery_Contents = stripslashes($Delivery_Contents);
echo $Delivery_Contents;
?>
    </td>
  </tr>
  <tr>
    <td height="10" ></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="26" align="left" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/proimfo_title_03.gif" width="670" height="26"></td>
  </tr>
  <tr>
    <td height="10" ></td>
  </tr>
  <tr>
    <td height="0" class="333333" valign = top>
<?
// 교환 환불 정보
$Drawback_Contents = getSingleValue("select Content  from ${CONTENT_TABLE_NAME} where Code = 'exchange' ");
$Drawback_Contents = stripslashes($Drawback_Contents);
echo $Drawback_Contents;
?>
    </td>
  </tr>
  <tr>
    <td height="10" ></td>
  </tr>
</table>
<? if($GoodsDisplayPid == "checked"):?>
<!-- 관련상품-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="26" align="left" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/proimfo_title_04.gif" width="670" height="26"></td>
  </tr>
  <tr>
    <td height="10" ></td>
  </tr>
  <tr>
    <td height="0" class="333333" valign = top><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="130" ></td>
                <td width = 5></td>
                <td width="130" ></td>
                <td width = 5></td>
                <td width="130" ></td>
                <td width = 5></td>
                <td width="130" ></td>
                <td width = 5></td>
                <td width="130" ></td>
              </tr>
              <tr align="center" valign="top">
<?
$szSearch = " ORDER BY Ranking ASC ";

$CID = explode("|" , $list[CID]);
$NO = 0;
for($i = 0 ; $i < $GoodsDisplayPidCnt && $CID[$i] ; $i++){
echo 'aaaa';
$SQL_STR="SELECT * FROM ${MALL_TABLE_NAME} WHERE Status = 'Y' AND UID = '$CID[$i]'";
echo"\$SQL_STR = $SQL_STR <br>";
$LIST = _mysql_fetch_array($SQL_STR);
$Picture = explode("|", $LIST[Picture]);
$VIEW_LINK = "$PHP_SELF?query=view&code=$LIST[Category]&no=$LIST[UID]";

?>
                <td width="130" height="170"><table width="130" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="120" align="center" valign="middle"><table width="100" height="100" border="1" cellpadding="0" cellspacing="0" bordercolor="#EBEBEB">
                          <tr>
                            <td align="center" valign="top"><A HREF=<? echo $VIEW_LINK;?> ><img src=<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[0]?> width="<? echo $PLIMAGEW; ?>" height="<? echo $PLIMAGEH;?>"  border="0"></a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td height="60" align="center" valign="top">
					 					 <table width = 80%>
								  	<tr>
										<td align = center  style="word-break:break-all;">
											<A HREF=<? echo $VIEW_LINK;?> class="link_gray">
											<? echo $LIST[Name]; ?></a><br> <span class="333333">
											<?=number_format($LIST[Price])?>
											원</span>
										</td>
									</tr>
								  </table>

					  </td>
                    </tr>
                  </table></td>
                <?
$NO++;
if($NO%$BreakGoodPidListNo != $BreakGoodPidListNo-1 ) echo "<td width=5></td>";
if(!($NO%$BreakGoodPidListNo)) echo "</tr><tr align='center' valign='top'><td colspan = 10 height = 10></td></tr><tr><td height = 1 bgcolor='DBDBDB' colspan = 10></td></tr><tr align='center' valign='top'>";

}
?>
              </tr>
            </table>
    </td>
  </tr>
  <tr>
    <td height="10" ></td>
  </tr>
</table>
<!-- 관련상품 -->
<? endif;?>

<!-- 상품평보기 -->
<? if($GoodsDisplayEstim == "checked"): // 표시 여부 ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="100%" height="72" border="0" cellpadding="0" cellspacing="0" background="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/valuation_td_02.gif">
        <tr>
          <td height="80" valign="top" ><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/valuation_td_01.gif" width="670" height="76"></td>
        </tr>
        <tr>
          <td align="center"  ><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <form name="EstimateFrm" action = "<? echo $_SERVER['PHP_SELF'];?>" method = post onSubmit = "return EstimateCheckForm('<? if(isMember()) echo $_COOKIE[MEMBER_ID];?>')">
                <input type="hidden" name="mode" value="Estimate_Write">
                <input type="hidden" name="query" value="<?=$query?>">
                <input type="hidden" name="code" value="<?=$code?>">
                <input type="hidden" name="GID" value="<?=$no?>">
                <input type="hidden" name="Name" value="<? echo $_COOKIE[MEMBER_NAME]; ?>">
                <input type="hidden" name="ID" value="<? echo $_COOKIE[MEMBER_ID]; ?>">
                <input type="hidden" name="IP" value="<? echo $_SERVER[REMOTE_ADDR]; ?>">
								<input type="hidden" name="ReturnUrl" value="">
                <tr>
                  <td width="85%" align = center> <textarea name="CONTENTS" cols="80" rows="3" class="input2"></textarea>
                  </td>
                  <td width="15%" rowspan="2" >
                    <input type = "image" src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_valuation.gif" width="89" height="74" border="0">
                  </td>
                </tr>
                <tr>
                  <td height="25" align = center><table border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td width="46" class="star"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/valuation_img_01.gif" width="41" height="14"></td>
                        <td class="star"><input type="radio" name="Grade" value="5" checked>
                          ★ ★ ★ ★ ★ </td>
                        <td class="star"><input type="radio" name="Grade" value="4">
                          ★ ★ ★ ★ </td>
                        <td class="star"><input type="radio" name="Grade" value="3">
                          ★ ★ ★</td>
                        <td class="star"><input type="radio" name="Grade" value="2">
                          ★ ★</td>
                        <td class="star"><input type="radio" name="Grade" value="1">
                          ★ </td>
                      </tr>
                    </table></td>
                </tr>
              </form>
            </table></td>
        </tr>
        <tr>
          <td height="18" valign="bottom" ><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/valuation_td_03.gif" width="670" height="14"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td align="left" valign="top"> <a name = "#EVAL"></a>
<?
$sqlstr = "select * from ${EVALUATION_TABLE_NAME} where GID = '$no' and Display = 'Y' ORDER BY UID desc";
// echo 'query : '.$sqlstr;
$sqlqry = mysql_query($sqlstr) or die(mysql_error());
$k = 0 ;
while($list = mysql_fetch_array($sqlqry)):
$list[Contents] = nl2br(stripslashes($list[Contents]));
$list[Subject] = stripslashes($list[Subject]);
?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top" bgcolor="#F8F8F8"><table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="10" height="16" align="center" class="333333" ><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/valuation_img_02.gif" width="15" height="15"></td>
                      <td width="10" align="center" class="333333" ><strong><? echo $list[ID]; ?></strong></td>
                      <td width = 70 align="center" class="star">
												 <?
												 $star_grade = "";
												 switch($list[Grade]){
													case "1": $star_grade = "★☆☆☆☆" ; break;
													case "2": $star_grade = "★★☆☆☆" ; break;
													case "3": $star_grade = "★★★☆☆" ; break;
													case "4": $star_grade = "★★★★☆" ; break;
													case "5": $star_grade = "★★★★★" ; break;
												}

												echo $star_grade;
												?>
                      </td>
                      <td align="left" class="666666" style="word-break:break-all;"><? echo $list[Contents]; ?><? echo "[" . date("Y-m-d" , $list[WDate]) ."]";?>
                      </td>
                      <td width="80" align="center" class="666666"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="42" align="center">
                            </td>
                            <td width="26" align="center">
                              <? if($list[ID] == $_COOKIE[MEMBER_ID] || isAdmin()){?>
                              <img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_del.gif"  border="0" style = "cursor:hand" onClick = "javascript:delFnc('<? echo $list[UID]; ?>','<? echo $code ; ?>','<? echo $no ; ?>')">
                              <? } ?>
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/valuation_bar.gif" width="670" height="3"></td>
        </tr>
      </table>
      <?
$k++;
endwhile;
if($k == 0){
?>
      <table width="100%" height = 50 border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle" bgcolor="#F8F8F8"> 상품 평이 존재 하지 않습니다.</td>
        </tr>
      </table>
<?
}
?>
    </td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
  </tr>
</table>
<script language="JavaScript">

 function delFnc(UID , CODE ,NO){
	var f = confirm("상품평을 삭제 하시겠습니까?");
	if(f) location.href = '<? echo $_SERVER[PHP_SELF];?>?query=view&code=' + CODE + "&no=" + NO + "&UID=" + UID + "&mode=del";
}


function EstimateCheckForm(ID){
	var f = document.EstimateFrm;
	if (ID == "") {

			var e = confirm("고객 상품평을 작성하기 위해서는 로그인을 하셔야 합니다.\n\n로그인 하시겠습니까?");
			if(e){

				f.action = "<? echo ${MEMBER_MAIN_FILE_NAME}; ?>?query=login";
				f.method = "post";
				f.ReturnUrl.value = escape(document.URL);
				return true;

			}else{
				return false;
			}

	}else{

		if (f.CONTENTS.value == "" ){
			alert("내용을 입력해주세요");
			f.CONTENTS.focus();
			return false;

		} else {

			 f.action="<?=$PHP_SELF?>";
			 return true;
		}

	}
}
</script>
<? endif;?>
</td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
<? echo stripslashes($codelist[cat_bottom]);?>
