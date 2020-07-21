<table width="193" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="175" align="center">
<? if(!isMember()):?>
<script language="JavaScript">
<!--
var bReset = true;
var bReset2 = true;

function checkLoginLeftForm(f){

	  if(f.ID.value == '' || f.ID.value == '아이디'){
		  alert('아이디를 입력해주세요');
		  f.ID.focus();
		  return false;
	  }

		if(bReset2 == true){

			if(f.PWD2.value == '' || f.PWD2.value == '패스워드'){
				alert('패스워드를 입력하세요');
				chkReset2(f);
				f.PWD.value = "";
				f.PWD.focus();
				return false;
			}

		} else {
				if(f.PWD.value == '' || f.PWD.value == '패스워드'){
				alert('패스워드를 입력하세요');
				f.PWD.value = "";
				f.PWD.focus();
				return false;
			}

		}

 }


function chkReset(f) {
if (bReset) { if ( f.ID.value == '아이디' ) f.ID.value = ''; bReset = false; }
}

function chkReset2(f) {
if (bReset2 ) bReset2 = false;
document.getElementById("pw1").style.display = "none";
document.getElementById("pw2").style.display = "";
f.PWD.focus();
}


function convLow(f){
var ID = f.ID.value;
f.ID.value = ID.toLowerCase();
}

//-->
</script>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
	          
	          <p class="bg-primary text-muted" style="padding-top:10px; padding-bottom:10px; padding-left:10px">로그인</p></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <form name = "LoginLeftFrm" method=post action='<? echo ${MEMBER_FOLDER_NAME}; ?>/LOG_CHECK.php' onSubmit = "return checkLoginLeftForm(this);">
                <input type = "hidden" name = "IP" value = "<? echo $_SERVER['REMOTE_ADDR'];?>">
                <tr>
                  <td align="right"><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/txt_left_id.gif" width="31" height="12" /></td>
                  <td>&nbsp; <input name="ID" type="text"   onBlur = "convLow(this.form)" value = "아이디" onFocus='chkReset(this.form);' style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; HEIGHT: 18px; width:80px;color:gray;ime-mode:disabled" tabindex="1"></td>
                  <td rowspan="2"><input type="image" src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_left_login.gif" width="41" height="39"  onFocus = "this.blur();"></td>
                </tr>
                <tr>
                  <td align="right"><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_txt_pass.gif" width="40" height="12" /></td>
                  <td>&nbsp;
									<span id = "pw1"><input name="PWD2" type="text"  style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:gray; HEIGHT: 18px; width:80px" tabindex="2" value = "패스워드"  onFocus='chkReset2(this.form);'></span><span id = "pw2" style='display:none;'><input name="PWD" type="password"  style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:gray; HEIGHT: 18px; width:80px" tabindex="3" onFocus='chkReset2(this.form);'></span></td>
                </tr>
              </form>
            </table></td>
        </tr>
        <tr>
          <td height="30" align="right"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=accept" onFocus = "this.blur();"><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_left_regis.gif" width="57" height="12" border="0" /></a></td>
                <td width="20px">&nbsp;</td>
                <td><a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=passsearch" onFocus = "this.blur();"><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_left_idpasssearch.gif" width="94" height="12" border="0" /></a></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <? else : ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><p class="bg-primary text-muted" style="padding-top:10px; padding-bottom:10px; padding-left:10px">로그인</p></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" colspan="3" align="center"><? echo $_COOKIE[MEMBER_NAME];?> 님 안녕하세요!</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="30" align="center"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <? if(isAdmin()){?>
								<td><a href="./manager/" target = "_blank" style = "color:FF8600"><h6>관리자홈</h6></a></td>
                <td width="10px">&nbsp;</td>
								<? } ?>

                <td><a href="javascript:open_memo('<? echo $SKIN_FOLDER_NAME ; ?>');"><h6>쪽지(<? echo number_format(getTotalNotReadMemoCnt($_COOKIE[MEMBER_ID]))?>)</h6></a></td>
                <td width="10px">&nbsp;</td>
                <td><a href="javascript:open_scrap('<? echo $SKIN_FOLDER_NAME ; ?>');"><h6>스크랩(<? echo number_format(getTotalScrapCnt($_COOKIE[MEMBER_ID] , "BOARD"))?>)</h6></a></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <? endif;?>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td valign='top' colspan="2">
	          <p class="bg-primary text-muted" style="padding-top:10px; padding-bottom:10px; padding-left:10px">물품 카테고리</p></td>
        </tr>
        <tr>
          <td height='5' valign='top' colspan="2"></td>
        </tr>
<?
$displayID = 1;
$sqlstr = "select * from ${CATEGORY_TABLE_NAME} where cat_no < 100 and cat_flag = 'M' order by cat_no asc";
$sqlqry = mysql_query($sqlstr) or die(mysql_error());
while($list = mysql_fetch_array($sqlqry)):
$bigcode = substr($list[cat_no], -2);
$big_code = substr($code, -2); /* wizmart에서 넘어온 코드값의 대분류 코드값을 구한다 */
/* 하위 카테고리 유무 책크 */
$sqlsubcountstr = "select count(UID) from ${CATEGORY_TABLE_NAME} where cat_no LIKE '%$bigcode' and cat_flag = 'M' order by cat_no asc";
$sqlsubcountqry = mysql_query($sqlsubcountstr);
//echo "\$sqlsubcountqry = $sqlsubcountqry <br>";
$sqlsubcount = mysql_result($sqlsubcountqry, 0, 0);

if (ereg($bigcode,$big_code)) {$show_hidden = "show";}else{$show_hidden = "none";}/*
/* 하위 카테고리 유무 책크 및 토글을 입력한다 */
if($sqlsubcount > 1) $ahref = "<A href='./${MART_MAIN_FILE_NAME}?code=$list[cat_no]' onFocus = 'this.blur()' onClick=\" DisplayToggle('menu$displayID')\">";
else $ahref = "<A href='./${MART_MAIN_FILE_NAME}?code=$list[cat_no]' onFocus = 'this.blur()'>";
echo "<tr>
<td colspan = 2 height='25' style='padding-left:20px'>$ahref $list[cat_name]</a></td>
</tr> <tr>
<td colspan = 2 height='1' valign='top'></td>
</tr>
";

/* 중분류 카테고리를 리스트 한다.*/
if($sqlsubcount > 1):
echo "<tr bgcolor='#F9F9F9'><td colspan='2'><div id='menu$displayID' style='display:$show_hidden;margin-left:17px'><table cellpadding=0 cellspacing=1  width=160 border=0 valign=top >";
$sqlsubstr = "select cat_no, cat_name from ${CATEGORY_TABLE_NAME} where cat_no > 99 and cat_no <10000 and cat_no LIKE '%$bigcode'  and cat_flag = 'M' order by cat_no asc";
$sqlsubqry = mysql_query($sqlsubstr) or die(mysql_error());
while($sublist = mysql_fetch_array($sqlsubqry)):
echo "<tr bgcolor='#F9F9F9'>
<td height=21 style=padding-left:10px>-
<A href='./${MART_MAIN_FILE_NAME}?code=$sublist[cat_no]&mid_cate=yes' onFocus = 'this.blur()'>$sublist[cat_name]</A>
</td></tr>
";

endwhile;
echo "</table></div></td></tr>";
$displayID++;
endif;
echo "<tr>
<td colspan = 2><img src='$SKIN_FOLDER_NAME/layout/$LayOutSkin/images/left_category_dotline.gif' width='183' height='3' /></td>
</tr>";
endwhile;
?>
        <div id=menu<?=$displayID?> style='display:none;margin-left:5px'></div>
      </table>
      <script>
function DisplayToggle(currMenu) {
		if (document.all) {
						thisMenu = eval("document.all." + currMenu + ".style");
						if (thisMenu.display != "none") {
								thisMenu.display = "none";
						}	else {

										for (i = 1; i < <?=$displayID+1?>; i++ ){

														if (eval("document.all.menu" + i + ".style").display != "none") {
																		eval("document.all.menu" + i + ".style").display = "none";
														}	else {
																		thisMenu.display = "block";
														}
										}
						}
						return false
		}	else {
						return false
		}
}

</script>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><p class="bg-primary text-muted" style="padding-top:10px; padding-bottom:10px; padding-left:10px">고객지원센터</p>
          
          <div class="index_help">
          <h5><a href = "<? echo $BOARD_MAIN_FILE_NAME; ?>?BID=qna&GID=board">고객게시판</a></h5>
          <h5><a href = "<? echo $BOARD_MAIN_FILE_NAME; ?>?BID=notice&GID=board">공지사항</a></h5>
          <h5><a href = "<? echo $BOARD_MAIN_FILE_NAME; ?>?BID=faq&GID=board">자주묻는질문</a></h5>
          <h5><a href = "<? echo $HTML_MAIN_FILE_NAME; ?>?html=guide">이용안내</a></h5>
          </div>

          </td>
        </tr>
        <tr>
          <td height="10" align="right"></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/left_box_banner.gif" width="183" height="213" border="0" usemap="#Customer_Map" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
        </tr>
      </table>
			<!-- 투표 -->
<script>
function checkPollForm(f){
	if(!radiocheck(f.poll_qna)){
		alert('투표해주십시요.');
		return false;
	}
}
</script>
  <form name = "PollFrm" action='<? echo ${HTML_MAIN_FILE_NAME}; ?>?html=poll' method='post' onSubmit = "return checkPollForm(this);">
    <input type='hidden' name='PID' value='<? echo $PID; ?>'>
    <input type='hidden' name='pmode' value='poll'>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><p class="bg-primary text-muted" style="padding-top:10px; padding-bottom:10px; padding-left:10px">오늘의 투표</p>
          </tr>
<?
if(!$PID) $PID = "POLL1";
$ptoday = mktime(0,0,0,date("m"),date("d"),date("Y"));
$plist  = _mysql_fetch_array("SELECT * FROM ${POLL_TABLE_NAME} WHERE PID='$PID' AND ToDay >= $ptoday order by UID desc limit 1 ");
$P_Subject  = stripslashes($plist[Subject]);
$P_Contents = explode("|",stripslashes($plist[Contents]));

if($plist[ToDay] < $ptoday) {
	$pmode = "end"; // 투표가 존재 하지 않을경우  pmode 값은 end로 진행중인 투표가 없습니다..표시..
}
$poll_Cookie = $_COOKIE["PollCookie{$plist[UID]}"];


if($pmode != "end") :// 투표가 존재 하면
?>
          <input type='hidden' name='UID' value='<? echo $plist[UID]; ?>'>
          <tr>
            <td><strong>&nbsp;<font color="3499CD"><? echo $P_Subject; ?> </font>
              </strong><br>&nbsp;
              <span style = "color:5A5D5A;font-weight:bold"><? echo date("Y/m/d" , $plist[FromDay]); ?> ~ <? echo date("Y/m/d" , $plist[ToDay]); ?></span></td>
          </tr>
          <tr>
            <td>
<?
	// 항목 출력
	for($i=0; $i < sizeof($P_Contents) && $P_Contents[$i] ; $i++) {

	$pno = $i+1;
	$P_Contents[$i] = str_replace("58(3A)","|",$P_Contents[$i]);

?>
	<input type='radio' name='poll_qna' value='<? echo $pno; ?>' onFocus="this.blur();">
	<? echo $P_Contents[$i];?>
	<br>
<?
	}// end for 투표 항목 표시
?>
			</td>
          </tr>
          <tr>
            <td height="30" align="center"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
									<? if(!$poll_Cookie){
							   		if(!isMember()):
							   ?>
                    <img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_left_poll.gif"  border = 0 onClick = "javascript:alert('       투표를 하기 위해서는 로그인 해주십시요.!!        ');" style = cursor:hand>
                    <? else :?>
                    <input type = "image" src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_left_poll.gif">
                    <? endif;?>
                    <? }else{?>
                    <img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_left_poll.gif"  onClick = "javascript:alert('          회원님은 이미 투표를 하셨습니다!!!.              ');" style = cursor:hand>
                    <? }?>
				  				</td>
                  <td width="10">&nbsp;</td>
                  <td><a href = "<? echo ${HTML_MAIN_FILE_NAME}; ?>?html=poll&PID=<? echo $PID;?>&pmode=view&UID=<? echo $plist[UID];?>"><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_left_poll_result.gif" width="60" height="20" border = 0></a></td>
                </tr>
              </table></td>
          </tr>
          <? else : ?>
          <tr>
            <td height = 60 align = center valign = middle><h6>진행중인 투표가 없습니다.</h6><br>
						<a href = "<? echo ${HTML_MAIN_FILE_NAME}; ?>?html=poll"><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/btn_left_poll_result.gif" width="60" height="20" border = 0></a>
			</td>
          </tr>
          <? endif; ?>
        </table>
	  </form>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
        </tr>
      </table></td>
    <td width="5"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
</table>

<map name="Customer_Map">
  <area shape="rect" coords="5,6,181,57" href="<? echo $MEMBER_MAIN_FILE_NAME; ?>?query=order" onfocus = "this.blur()">
  <area shape="rect" coords="5,59,180,108" href="<? echo $MEMBER_MAIN_FILE_NAME; ?>?query=order" onfocus = "this.blur()">
  <area shape="rect" coords="5,108,179,156" href="<? echo $HTML_MAIN_FILE_NAME; ?>?html=guide" onfocus = "this.blur()">
  <area shape="rect" coords="6,159,179,211" href="<? echo $MEMBER_MAIN_FILE_NAME; ?>?query=point" onfocus = "this.blur()">
</map>
