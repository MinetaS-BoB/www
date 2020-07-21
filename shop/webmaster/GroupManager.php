<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include ("./ROOT_CHECK.php");


if($rank_mode == "up"){

	$cur_ranking = getSingleValue("select Ranking from ${BOARD_GROUP_TABLE_NAME} where UID = '$UID'");
	if($cur_ranking == "1") $Ranking = "1";
	else $Ranking = $cur_ranking - 1 ;

	$sql = "update ${BOARD_GROUP_TABLE_NAME} set Ranking = '$Ranking' where UID = '$UID'";
	mysql_query($sql);
	js_location("${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");
	exit;

}

if($rank_mode == "down"){

	$cur_ranking = getSingleValue("select Ranking from ${BOARD_GROUP_TABLE_NAME} where UID = '$UID'");

	$Ranking = $cur_ranking + 1 ;

	$sql = "update ${BOARD_GROUP_TABLE_NAME} set Ranking = '$Ranking' where UID = '$UID'";
	// echo $sql;

	mysql_query($sql);
	js_location("${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");
	exit;

}


if(!strcmp($create_group,"makeit")){

	$WDate = time();
	// Group ID 중복 체크
	$NewGroupID = trim($NewGroupID);
	$GroupCnt = getSingleValue("select count(*) from ${BOARD_GROUP_TABLE_NAME} where GID = '$NewGroupID'");
	if($GroupCnt > 0) js_alert_location("${NewGroupID} 는 이미 사용중인 그룹아이디 입니다.","-1");

	$cur_ranking = getSingleValue("select max(Ranking) from ${BOARD_GROUP_TABLE_NAME}");
	$next_ranking = $cur_ranking + 1 ;

	$sql = "insert into ${BOARD_GROUP_TABLE_NAME}  (GID , AdminID , Ranking , GrpSubject , WDate, SiteKey ) values (
			'$NewGroupID' , '$AdminID' , '$next_ranking', '$GrpSubject' , '$WDate', '$SiteKey' )";

	$result  = mysql_query($sql);

	if($result) js_alert_location("${NewGroupID} 그룹이 생성되었습니다","${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");
	else js_alert_location("DB 작업중 에러가 발생하였습니다.","${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");

}//그룹 만들기


/* 테이블설명 및 패스워드 변경 */
if(!strcmp($MODE,"ChangeIt")){
$SQL_STR = "UPDATE ${BOARD_GROUP_TABLE_NAME} SET GrpSubject ='$GrpSubject', AdminID='$AdminID' WHERE GID='$GID'";
$SQL_QRY = mysql_query($SQL_STR) or die(mysql_error());
js_alert_location("성공적으로 변경되었습니다.","${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");
}


if(!strcmp($MODE , "DelG" )){
// 삭제 시작


if($GID == "") js_alert_location("그룹 ID 값이 넘어 오지 않았습니다.","-1");

$group_sql = "select GID , BID  from ${BOARD_MAIN_TABLE_NAME} where GID='$GID'";

$group_result = mysql_query($group_sql);
while($list = mysql_fetch_array($group_result)):


/******** 채널파일 삭제 **************/

if(is_dir("../${BOARD_FOLDER_NAME}/channel/${GID}_${list[BID]}")):

	$LOG_DIR = opendir("../${BOARD_FOLDER_NAME}/channel/${GID}_${list[BID]}");
	while($LOG_FILE = readdir($LOG_DIR)) {
		if($LOG_FILE !="." && $LOG_FILE !=".."){
			  unlink("../${BOARD_FOLDER_NAME}/table/${GID}_${list[BID]}/$LOG_FILE");
		}
	}
	closedir($LOG_DIR);
	$result = rmdir("../${BOARD_FOLDER_NAME}/channel/${GID}_${list[BID]}");
	if(!$result) js_alert_location("./${BOARD_FOLDER_NAME}/channel/${GID}_${list[BID]} 를 삭제하지 못했습니다. 수동으로 삭제해 주세요","-1");

endif;



/******** 업로딩된 파일 삭제 updir 삭제 **************/
$LOG_DIR = opendir("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir");
while($LOG_FILE = readdir($LOG_DIR)) {
	if($LOG_FILE !="." && $LOG_FILE !=".."){
          unlink("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir/$LOG_FILE");
	}
}
closedir($LOG_DIR);

$uresult = rmdir("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir");
if(!$uresult) js_alert_location("./${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir 를 삭제하지 못했습니다. 수동으로 삭제해 주세요","-1");


/******** config 파일 삭제 및 table 디렉토리 삭제 **************/
$LOG_DIR2 = opendir("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}");
while($LOG_FILE2 = readdir($LOG_DIR2)) {
	if($LOG_FILE2 !="." && $LOG_FILE2 !=".."){
          unlink("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/$LOG_FILE2");
	} //if($LOG_FILE !="." && $LOG_FILE !="..") 닫음
}
closedir($LOG_DIR2);


$ccresult = rmdir("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}");
if(!$ccresult) js_alert_location("./${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir 를 삭제하지 못했습니다. 수동으로 삭제해 주세요","-1");


rmdir("../${BOARD_FOLDER_NAME}/table/${GID}");// 그룹폴더 삭제

/* comment 테이블 삭제 */

$deli = 0;
$i = 0 ;
$comment_result = mysql_list_tables ($MYSQL_DB);
while ($i < mysql_num_rows ($comment_result)) {
   $tb_names[$i] = mysql_tablename ($comment_result, $i);
   if("${DEFAULT_TABLE_NAME}_${GID}_{$list[BID]}_comment" == $tb_names[$i]) $deli = 1 ;
  	$i++;
}

if($deli == 1){// 코멘트 테이블이 존재 할경우 삭제
	$COMMENT_DROP = "DROP TABLE ${DEFAULT_TABLE_NAME}_${GID}_${list[BID]}_comment";
	$cresult = mysql_query($COMMENT_DROP) or die(mysql_error());
	if(!$cresult) js_alert_location("${DEFAULT_TABLE_NAME}_${GID}_${list[BID]}_comment 를 삭제하지 못했습니다. 수동으로 삭제해 주세요","-1");
}


/* 테이블 삭제 */
$TABLE_DROP = "DROP TABLE ${DEFAULT_TABLE_NAME}_${GID}_${list[BID]}";
$tresult = mysql_query($TABLE_DROP) or die(mysql_error());
if(!$tresult) js_alert_location("${DEFAULT_TABLE_NAME}_${GID}_${list[BID]} 를 삭제하지 못했습니다. 수동으로 삭제해 주세요","-1");



$MAIN_TABLE_DEL = "delete from ${BOARD_MAIN_TABLE_NAME} where GID='$GID' and BID = '${list[BID]}'";
mysql_query($MAIN_TABLE_DEL) or die(mysql_error());

endwhile;

/* ${BOARD_MAIN_TABLE_NAME} w 으로 부터 관련 졍보 삭제 */

$QUERY_DEL = "delete from ${BOARD_GROUP_TABLE_NAME} where GID='$GID'";
$gresult = mysql_query($QUERY_DEL) or die(mysql_error());

if($gresult) js_alert_location("${GID} 그룹을 성공적으로 삭제하였습니다.","${PHP_SELF}?menushow=$menushow&THEME=$THEME&GID=${GID}&CURRENT_PAGE=$CURRENT_PAGE&Grp=$Grp&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");


// 삭제 긑

}

?>
<script>
<!--

function checkForm(f){

	if(!f.NewGroupID.value){
		alert("그룹아이디를 입력해주세요");
		f.NewGroupID.focus();
		return false;
	}else if(!TypeCheck(f.NewGroupID.value,NUM+ALPHA)){
		alert("그룹아이디는 영문/숫자 조합만 가능합니다.");
		f.NewGroupID.focus();
		return false;
	}else if(!f.GrpSubject.value){
		alert("그룹명을 입력해주세요");
		f.GrpSubject.focus();
		return false;
	}

}


function del_confirm(f,GID){

	var con = confirm("\n\n그룹이 삭제 되면 관련 테이블도 삭제가 됩니다 \n\n 정말로 삭제하시겠습니까?");
	if(con){
		location.href ='<?=$PHP_SELF?>?menushow=<? echo $menushow ; ?>&THEME=<? echo $THEME; ?>&GID=' + GID + '&CURRENT_PAGE=<?=$CURRENT_PAGE?>&MODE=DelG';
	};


}

//-->
</script>

<table  width="770" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="8"></td>
    <td height="8"></td>
  </tr>
  <tr>
    <td> </td>
    <td valign="top">
	<table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr>
          <td align="center" bgcolor="#FFFFFF"><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30" class="black_16"><strong><font color="#3366CC">게시판그룹 관리</font></strong></td>
              </tr>
              <tr>
                <td>게시판 그룹생성 수정 삭제 하실수 있습니다<br>
                  </td>
              </tr>
            </table></td>
        </tr>
      </table>
	<br>
      <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
        <FORM name = "TableFrm" action="<? echo $_SERVER[PHP_SELF]; ?>" method="post" onSubmit = "return checkForm(this);">
         <input type=hidden name= menushow value=<? echo $menushow; ?>>
          <input type=hidden name="THEME" value="<?=$THEME?>">
         <input type="hidden" name="create_group" value="makeit">
          <tr bgcolor=#ffffff>
            <td width=92>그룹아이디</td>
            <td width="107"> <input name="NewGroupID" size = "15"  maxlength = 20> </font></td>
            <td width=67>그룹명</td>
            <td width="208"> <input name="GrpSubject" size = "30"  maxlength = 30> </font></td>
            <td align=middle width=82>그룹관리자</td>
            <td width="82" align=middle> <input name="AdminID" type="text"  size=8 maxlength=20> </font>
            </td>
            <td align=middle width=54><input type="image" src="./img/btn_set/btn_create.gif" align = "absmiddle" class = "noninput"></td>
          </tr>
        </form>
      </table>
      <br>
      <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
        <tr align="center" >
          <td width=7% <? echo $TITLE_STYLE ; ?>>순번</td>
          <td width=12% <? echo $TITLE_STYLE ; ?>>그룹아이디</td>
          <td width=29% <? echo $TITLE_STYLE ; ?>>그룹명</td>
          <td width=15% <? echo $TITLE_STYLE ; ?>>그룹관리자</td>
          <td width="10%" <? echo $TITLE_STYLE ; ?>>게시판수</td>
          <td width=9% <? echo $TITLE_STYLE ; ?>>수정</td>
          <td width=9% <? echo $TITLE_STYLE ; ?>>보기</td>
          <td width=9% <? echo $TITLE_STYLE ; ?>>삭제</td>
        </tr>
        <?

$WHERE = "WHERE UID <> '' ";
if($SEARCHTITLE && $searchkeyword) $WHERE .= "and $SEARCHTITLE like '%$searchkeyword%'";
$TargetBoard = "${BOARD_GROUP_TABLE_NAME} ";
$TOTAL = getSingleValue("SELECT count(UID) FROM $TargetBoard $WHERE");
if(!isset($ListCount) || !$ListCount) $ListCount = 10;
$LIST_NO=$ListCount; /* 페이지당 출력 리스트 수 */


if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
//--페이지 나타내기--
$TP = ceil($TOTAL / $LIST_NO) ; /* 페이지 하단의 총 페이지수 */
$CB = ceil($CURRENT_PAGE / $PageNo);
$SP = ($CB - 1) * $PageNo + 1;
$EP = ($CB * $PageNo);
$TB = ceil($TP / $PageNo);
//--페이지링크를 작성하기--



$START_NO = ($CURRENT_PAGE - 1) * $LIST_NO;
$BOARD_NO=$TOTAL-($LIST_NO*($CURRENT_PAGE-1));
$SELECT_STR="SELECT * FROM $TargetBoard $WHERE ORDER BY Ranking ASC LIMIT $START_NO, $LIST_NO";
$SELECT_QRY=mysql_query($SELECT_STR);
while($GROUP_LIST=@mysql_fetch_array($SELECT_QRY)):
?>
        <tr bgcolor=#ffffff>
          <FORM  ACTION="<? echo $_SERVER[PHP_SELF]; ?>">
            <input type="hidden" name="GID" value="<?=$GROUP_LIST[GID]?>">
            <input type="hidden" name="MODE" value="ChangeIt">
            <input type=hidden name= "menushow" value=<? echo $menushow; ?>>
            <input type="hidden" name="THEME" value="<?=$THEME?>">
            <input type="hidden" name="CURRENT_PAGE" value="<?=$CURRENT_PAGE?>">
            <input type="hidden" name="ListCount" value="<?=$ListCount?>">
            <input type="hidden" name="SEARCHTITLE" value="<?=$SEARCHTITLE?>">
            <input type="hidden" name="searchkeyword" value="<?=$searchkeyword?>">
            <td align=center <? echo $LEFT_STYLE; ?>>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                  <td align = center><a href = "<? echo $_SERVER[PHP_SELF];?>?THEME=<? echo $THEME; ?>&menushow=<? echo $menushow;?>&UID=<?=$GROUP_LIST[UID]?>&CURRENT_PAGE=<? echo $CURRENT_PAGE; ?>&rank_mode=up"><img src = "./img/btn_up.gif" align = absmiddle border = 0></a></td>
                </tr>
                <tr>
                  <td align = center><a href = "<? echo $_SERVER[PHP_SELF];?>?THEME=<? echo $THEME; ?>&menushow=<? echo $menushow;?>&UID=<?=$GROUP_LIST[UID]?>&CURRENT_PAGE=<? echo $CURRENT_PAGE; ?>&rank_mode=down"><img src = "./img/btn_down.gif" align = absmiddle border = 0></a></td>
                </tr>
              </table> </td>
            <td align=middle <? echo $LEFT_STYLE; ?>><?=$GROUP_LIST[GID]?></td>
            <td align=middle > <input name=GrpSubject   value="<?=$GROUP_LIST[GrpSubject ]?>" size=30 maxlength=20>
            </td>
            <td align=center > <input size=10 name=AdminID  value="<?=$GROUP_LIST[AdminID]?>">
            </td>
            <td  align=center> <? echo number_format(getTableCountByGroup($GROUP_LIST[GID]))?>
              개 </td>
            <td align=center><img src="./img/btn_set/btn_modify_02.gif" onclick="javascript:submit()"; style="cursor:hand;"></td>
            <td align=center><A HREF="<? echo $_SERVER['PHP_SELF'];?>?menushow=menu7&THEME=BoardManager&GID=<? echo $GROUP_LIST[GID]; ?>"><img src="./img/btn_set/btn_view_02.gif" border="0"></a></td>
            <td align=center><A HREF="javascript:del_confirm(this.form,'<? echo $GROUP_LIST[GID]; ?>','<? echo $GROUP_LIST[BID]?>')"><img src="./img/btn_set/btn_img06.gif" border="0"></a></td>
          </form>
        </tr>
        <?
endwhile;
?>
      </table>
      <br> <table cellspacing=0 cellpadding=0 width="100%" border=0>
        <tr>
          <td align=center >
<?
	$PostValue = "menushow=$menushow&THEME=$THEME&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword&ListCount=$ListCount";
	include "./adminskin/pageskin/$PGSKIN/index.php" ;
?>


           </td>
        </tr>
      </table>
      <br> </td>
  </tr>
</table>
