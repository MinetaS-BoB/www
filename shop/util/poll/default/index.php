<table width="691" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="35" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="25"><img src="./util/poll/<? echo $PollSkin; ?>/images/customer_icon01.gif" width="9" height="9" align="absmiddle"> 
            <span class="444444"><? echo $ADMIN_TITLE;?> 설문조사 </span></td>
        </tr>
      </table></td>
  </tr>
</table>
<!-- 카테고리 삽입-->
<table width="691" border="0" cellspacing="0" cellpadding="0" >
  <tr> 
    <td><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" background="./util/poll/<? echo $PollSkin; ?>/images/board_tab_bg.gif">
        <tr> 
          <td><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="7">&nbsp;</td>
                <td width="489">
								
								<table height="34" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
<?
include "./manager/util1_1.php"; // 투표 배열
$i = 1 ; 
foreach($POLL_ARRAY as $key => $value){
	unset($selected);
	
	if($PID == $key){ 
		$selected = "class=td_board_over";
		$lowimage = "<img src=./util/poll/$PollSkin/images/board_icon.gif width=9 height=5>";
		$boldclass = "class=td_board_up";
		$heightLenghtUp = "24";
		$heightLength = "10";
		$valignPosition = "valign = top"; 
	}
	else{ 
		
		$lowimage = "";
		$boldclass = "";
		$heightLenghtUp = "30";
		$heightLength = "4";
		$valignPosition = "";
	}
?>
                            <td align="center" <? echo $selected; ?>> <table height="34" border="0" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="10">&nbsp;</td>
                                  <td <? echo $heightLenghtUp; ?> align="center" valign="bottom" <? echo $boldclass; ?>><a href="<? echo $_SERVER[PHP_SELF];?>?html=poll&PID=<? echo $key; ?>" >
                                    <? echo trim($POLL_ARRAY[$key]);?></a></td>
                                  <td width="10">&nbsp;</td>
                                </tr>
                                <tr align="center" <? echo $valignPosition; ?>> 
                                  <td <? echo $heightLength; ?> colspan="3"><? echo $lowimage; ?></td>
                                </tr>
                              </table></td>
                            <? 
														if($i != sizeof($POLL_ARRAY) ){?>
                            <td align="center"><img src="./util/poll/<? echo $PollSkin; ?>/images/board_mid_line.gif" width="9" height="34"></td>
                            <? } ?>
                            <?
$i++;
}
?>
                          </tr>
                        </table></td>
                <td width="59" valign="bottom"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="10"> </td>
  </tr>
</table>
<!-- 카테고리 삽입-->
<?
$ptoday = time();
$plist  = _mysql_fetch_array("SELECT * FROM ${POLL_TABLE_NAME} WHERE UID = '$UID'");
$P_Subject  = stripslashes($plist[Subject]);
$P_Contents = explode("|",stripslashes($plist[Contents]));
// 등록일 | 종료일
if($plist[FromDay]) $FromDay = date("Y.m.d",$plist[FromDay]);
if($plist[ToDay])   $ToDay = date("Y.m.d",$plist[ToDay]);

// 총 투표수
$Vote = explode("|",$plist[Vote]);
$total_vote = "";
for($i = 0; $i< sizeof($Vote) -1; $i++) $total_vote += $Vote[$i];

if($FromDay && $ToDay){// 시작일과 완료일이 있을경우
	$txt_period = $FromDay . " ~ " . $ToDay ;
}
?>
<table width="691" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="25" align="right"> 
      <? if($plist[UID]){?>
      <table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="./util/poll/<? echo $PollSkin; ?>/images/poll_st_01.gif" width="82" height="11"></td>
          <td ><? echo number_format($total_vote); ?></td>
          <td width="95" align="right"><img src="./util/poll/<? echo $PollSkin; ?>/images/poll_st_02.gif" width="82" height="11"></td>
          <td  ><? echo $txt_period; ?></td>
        </tr>
      </table>
      <? }?>
    </td>
  </tr>
</table>
<table width="691" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td><img src="./util/poll/<? echo $PollSkin; ?>/images/customer_box_top.gif" width="691" height="5"></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="1" bgcolor="#C6C6C6"></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="25" align="right" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="21" style = "padding-left:12px"><img src="./util/poll/<? echo $PollSkin; ?>/images/customer_icon02.gif" width="14" height="19"></td>
                      <td width="100%">&nbsp;<? echo $P_Subject; ?></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td background="./util/poll/<? echo $PollSkin; ?>/images/customer_dot.gif">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="235"><table width="235" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td align="right"><table width="223" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="21" height="30"><img src="./util/poll/<? echo $PollSkin; ?>/images/customer_icon03.gif" width="15" height="19"></td>
                                  <td width="201"><? echo $ADMIN_TITLE;?> 투표 결과입니다.</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td valign="bottom"><img src="./util/poll/<? echo $PollSkin; ?>/images/customer_img01.gif" width="235" height="106"></td>
                          </tr>
                        </table></td>
                      <td align="center" valign = middle><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <?
// 항목 : 투표수 출력
for($i=0; $i < sizeof($P_Contents) && $P_Contents[$i]; $i++) {

	$no = $i+1;
	// %와 바 길이
	$percent = @intval($Vote[$i]/$total_vote*100);
	$bar_width = 100;
	$bar_length = @intval($Vote[$i]/$total_vote*$bar_width)+1;	
	--$bar_length;
	

?>
                          <tr> 
                            <td width="413"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td width="8" rowspan="3"><img src="./util/poll/<? echo $PollSkin; ?>/images/black_icon.gif" width="8" height="8"></td>
                                        <td width="186" height="22" rowspan="3"> 
                                          <?=$no?>.<?=$P_Contents[$i]?>
                                        </td>
                                        <td height="5" colspan="2"></td>
                                        <td width="49" rowspan="3"> 
                                          <?=$percent?>
                                          % </td>
                                        <td width="70" rowspan="3" align="right" style = "padding-right:20px">
                                          <?=$Vote[$i]?>명</td>
                                      </tr>
                                      <tr> 
                                        <td width="160" background="./util/poll/<? echo $PollSkin; ?>/images/poll_ba01.gif"> 
                                          <table border="0" cellspacing="0" cellpadding="0" height="11" >
                                            <tr> 
                                              <td background="./util/poll/<? echo $PollSkin; ?>/images/poll_ba02.gif" width="<?=$bar_length*1.45?>" height="<?=$bar_height?>"></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr> 
                                        <td height="5" colspan="2"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td width="400" height="10" background="./util/poll/<? echo $PollSkin; ?>/images/customer_dot02.gif"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?
}
?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="1" bgcolor="#C6C6C6"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><img src="./util/poll/<? echo $PollSkin; ?>/images/customer_box_bottom.gif"  width = "691" height="5"></td>
  </tr>
</table>
<br>
<table width="691" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="164" height="25"><img src="./util/poll/<? echo $PollSkin; ?>/images/customer_icon01.gif" width="9" height="9" align="absmiddle"> 
            <span class="444444">설문 리스트</span> </td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="691" border="0" cellspacing="0" cellpadding="0">
  <!-- 채용정보   bgcolor="AEDCE3"
         알바       bgcolor="FFC8A9"
         교육정보   bgcolor="C5DD9D"
         취업자료실  bgcolor="9AE2CA"
         회원서비스  bgcolor="E7C2F9"
	-->
  <tr> 
    <td height="3" bgcolor="AAD2F6"> </td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr align="center"> 
                <td width="50" height="27" bgcolor="F2F2F2">번호</td>
                <td width="4" bgcolor="F2F2F2"><img src="./util/poll/<? echo $PollSkin; ?>/images/board_line.gif" width="3" height="27"></td>
                <td width="70" bgcolor="F2F2F2"><p>분류</p></td>
                <td width="4" bgcolor="F2F2F2"><img src="./util/poll/<? echo $PollSkin; ?>/images/board_line.gif" width="3" height="27"></td>
                <td width="330" bgcolor="F2F2F2">설문내용</td>
                <td width="4" bgcolor="F2F2F2"><img src="./util/poll/<? echo $PollSkin; ?>/images/board_line.gif" width="3" height="27"></td>
                <td width="70" bgcolor="F2F2F2">진행여부</td>
                <td width="4" bgcolor="F2F2F2"><img src="./util/poll/<? echo $PollSkin; ?>/images/board_line.gif" width="3" height="27"></td>
                <td width="135" bgcolor="F2F2F2">조사기간</td>
                <td width="4" bgcolor="F2F2F2"><img src="./util/poll/<? echo $PollSkin; ?>/images/board_line.gif" width="3" height="27"></td>
                <td width="70" bgcolor="F2F2F2">참여인원</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?

$PageNo = $SubListNo ;
$ListNo = $SubPageNo ;

$TOTAL_STR = "SELECT count(UID) FROM ${POLL_TABLE_NAME} WHERE PID = '$PID'";
$TOTAL = getSingleValue($TOTAL_STR);
//echo "\$TOTAL : $TOTAL";

if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
//--페이지 나타내기--
$TP = ceil($TOTAL / $ListNo) ; /* 페이지 하단의 총 페이지수 */
$CB = ceil($CURRENT_PAGE / $PageNo);
$SP = ($CB - 1) * $PageNo + 1;
$EP = ($CB * $PageNo);
$TB = ceil($TP / $PageNo);
$START_NO = ($CURRENT_PAGE - 1) * $ListNo;
$BOARD_NO=$TOTAL-($ListNo*($CURRENT_PAGE-1));


// 게시물 뽑아오기
$sqlstr = "select * from ${POLL_TABLE_NAME} WHERE PID = '$PID' ORDER BY UID DESC LIMIT $START_NO, $ListNo";
$result = mysql_query($sqlstr);
   
// 투표가 하나도 없을때
    if(!$TOTAL){
?>
              <tr> 
                <td height="25" colspan="6" align="center">투표가 존재 하지 않습니다.</td>
              </tr>
              <tr> 
                <td height="1" colspan="6" align="center" background="./util/poll/<? echo $PollSkin; ?>/images/dot_line_garo_login.gif"> 
                </td>
              </tr>
<?	
	// 투표가 있을때
	} else {
	
    while($List = mysql_fetch_array($result)) {
				
		$poll = "진행중";
		// 지금 시간
		$ptoday = time();

		// 종료된 투표는 종료일에 색
		
		if($List[ToDay] < $ptoday) $poll = "종료";		

		// 등록일 | 종료일
		$FromDay = date("Y.m.d",$List[FromDay]);
		$ToDay = date("Y.m.d",$List[ToDay]);

		// 총 투표수
		$Vote = explode("|",$List[Vote]);
		$total_vote = "0";
		for($i = 0; $i < sizeof($Vote) && $Vote[$i] ; $i++) $total_vote += $Vote[$i];
 // if($List[ToDay] > $ptoday) {
?>
              <tr> 
                <td width="54" height="25" align="center">
                  <?=$BOARD_NO?>
                </td>
                <td width="74" align="center">
                  <?=$POLL_ARRAY[$List[PID]]; ?>
                </td>
                <td width="334"> <a href="<? echo $_SERVER[PHP_SELF]?>?html=<? echo $html; ?>&PID=<?=$List[PID]?>&UID=<? echo $List[UID];?>&pmode=view&CURRENT_PAGE=<?=$CURRENT_PAGE;?>">
                  <?=$List[Subject]?>
                  </a></td>
                <td width="74" align="center" class="main_notice">
                  <?=$poll?>
                </td>
                <td width="135" align="center">
                  <?=$FromDay?>
                  ~ 
                  <?=$ToDay?>
                </td>
                <td width="70" align="center"><? echo $total_vote; ?></td>
              </tr>
              <tr> 
                <td height="1" colspan="6" align="center" background="./util/poll/<? echo $PollSkin; ?>/images/dot_line_garo_login.gif"> 
                </td>
              </tr>
<?		
		$BOARD_NO--;
		}
	   
	}

?>
              
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="4" valign="top"> </td>
  </tr>
  <tr> 
    <td height="1" valign="top" bgcolor="DCDCDC"> </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="25" align="center" valign="bottom"> 
      <!-- 페이징-->
<?												
$TransData = "html=$html&PID=$PID&pmode=view";
include "${SKIN_FOLDER_NAME}/page/${PageSkin}/index.php" ; 
?>
      <!-- 페이징-->
    </td>
  </tr>
</table>
<br>
