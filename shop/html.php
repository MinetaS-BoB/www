<?

header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include "./config/db_info.php";
include "./config/db_connect.php";
include "./config/admin_info.php";
include "./config/skin_info.php";
include "./config/shopDisplay_info.php";
include "./config/cart_info.php";
include "./function/const_array.php";
include "./function/kerrigancap_lib.php";

include "./function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$UID = filter($UID);
$PID = filter($PID);
$CURRENT_PAGE = filter($CURRENT_PAGE);
$pmode = filter($pmode);
$html = filter($html);


if($query == "INQ"):

/* 파일 업로딩 시작
unset($UPDIR);
for($i=0; $i<sizeof($file); $i++){
	if($file[$i]!="none" && $file[$i]){
    	if (file_exists("./${STOCK_FOLDER_NAME}/$file_name[$i]")) {
	    $file_name[$i] = time()."_$file_name[$i]";
    	}
	    if(!move_uploaded_file($file[$i], "./${STOCK_FOLDER_NAME}/$file_name[$i]")) {
    	echo "파일 업로드에 실패 하였습니다.";
	    exit;}
	$UPDIR .=$file_name[$i]."|";
	}
}
*/
/* 파일 업로딩 끝 */
$WDate=time();
$Tel="${Tel1}-${Tel2}-${Tel3}";
$Hand="${Hand1}-${Hand2}-${Hand3}";
$Fax="${Fax1}-${Fax2}-${Fax3}";
$ZIP="${Zip1_1}-${Zip1_2}";
$Email = $Email1_1."@".$Email1_2;
$sql = "INSERT INTO $INQUIRY_TABLE_NAME (IID,Company,Name,Jumin,Tel,Fax,ZIP,Address1,Address2,City,Province,Country,Hand,Email,Contents,Option1,Option2,Option3,Option4,Option5,Option6,Option7,Option8,Option9,UPDIR,WDate,SiteKey)
VALUES('$IID','$Company','$Name','$Jumin','$Tel','$Fax','$ZIP','$Address1','$Address2','$City','$Province','$Country','$Hand','$Email','$Contents','$Option1','$Option2','$Option3','$Option4','$Option5','$Option6','$Option7','$Option8','$Option9','$UPDIR','$WDate' , '$SiteKey')";
$result=mysql_query($sql) or die(mysql_error());

if($result){
	js_alert_location("고객님의 문의에 감사 드립니다.","./");
}else{
	js_alert_location("DB 작업중 에러가 발생하였습니다.","-1");
}

endif;



if($pmode == "poll" && !${"PollCookie".$UID} ) {

// 투표 기간이 종료 되었을때
$Sqlqry = mysql_query("SELECT * FROM ${POLL_TABLE_NAME} WHERE UID='$UID'");
$List = mysql_fetch_array($Sqlqry);
$Contents = explode("|",$List[Contents]);
$Vote = explode("|",$List[Vote]);

for($i = 0; $i < sizeof($Vote); $i++) {
	if($poll_qna-1 == $i) $Vote[$i] += 1;
	$vote_ok .= $Vote[$i]."|";
}

$Point = $List [Point];


// 추천 테이블에 존재 하지 않으면..입력과 포인트 부여을 하고 존재 할경우는 튕겨낸다.

$result = boolRecommandExistID(${POLL_TABLE_NAME} , $UID , $_COOKIE[MEMBER_ID], 'GOOD', 'POLL');
if(!$result)  {
		// 항목 투표수 1 증가

	$poll_sql = "UPDATE ${POLL_TABLE_NAME} SET Vote='$vote_ok' where UID='$UID'";
	mysql_query($poll_sql);
	// 투표 한사람에게 쿠키 생성(마지막 시간만큼)
	setcookie("PollCookie{$UID}","1",$List[ToDay],"/");

	boolInsertRecommand(${POLL_TABLE_NAME} , $UID , $_COOKIE[MEMBER_ID], 'GOOD', 'POLL');
	boolInsertPoint(${POLL_TABLE_NAME} , $_COOKIE[MEMBER_ID] , "System" , $Point , "P" ,"투표참여" );

} else {

	js_alert_location("이미 투표에 참여 하셨습니다" , "-1" );

}

	// 포인트 부여

	js_location("$PHP_SELF?html=poll&PID=$PID&UID=$UID&mode=view");
	exit;

}
?>

<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php");
?>
<table width="884" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" align="center" valign="top">
<? if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php");?></td>
    <td align="center" valign="top">

<?
if($html == "poll"){
	include_once ("./util/poll/index.php");
}else {
	include_once ("./${SKIN_FOLDER_NAME}/html/$HtmlSkin/$html.php");
}
?>

</td>
  </tr>
</table>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
?>
