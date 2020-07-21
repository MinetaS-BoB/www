<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<?
/*
파일 용량 제한 추가
ATTACH_CAPACITY
*/


set_time_limit (0);


/* CATEGORY 가 없을 경우 $CATEGORY에 $BID를 넣는다. $CATEGORY는 한 테이블에서 여러가지 카테고리를 나눌경우 샤용 */
//if(!$CATEGORY) $CATEGORY_IN = $BID;
//else $CATEGORY_IN = $CATEGORY;

$CATEGORY_IN = $CATEGORY;
$SUBJECT = trim($SUBJECT);

if(!$SUBJECT){
	js_alert_location("제목이 없습니다.","-1");
}

/* 파일 업로딩 시작 */
unset($UPDIR1);
unset($UPDIR2);
$file_field_name = "file";
file_uploade($file_field_name);
$upload_path =  "./${BOARD_FOLDER_NAME}/table/".$GID."/".$BID."/updir";
while(is_array($file_name) && list($att_key, $att_value) = each($file_name)):
$MicroTsmp = explode(" ",microtime());
$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file_tmp_name[$att_key]!="none" && $file_tmp_name[$att_key]){
    	$extention = strrchr($file_name[$att_key], ".");

		/*
		if(ereg($extention, $REVOKE_EXTENSION)) { // 금지 확장자
			js_alert_location("$extention 은 금지된 확장자입니다.","-1");
		}
		*/
		upload_filter($extention);
		$UPDIR2 .=$file_name[$att_key]."|"; /* 원래 파일명만 넣어둠*/
		if($FILE_NAME_REARRANGE) $file_name[$att_key]=time()."".$extention;
    	if (file_exists($upload_path."/".$file_name[$att_key]) && !$UpLoadingOverWriteEnable) {
	    if(!$FILE_NAME_REARRANGE) $file_name[$att_key] = date("is")."_$file_name[$att_key]";
		else $file_name[$att_key] = $newFileName."_$file_name[$att_key]".$extention;
    	}
	    if(!move_uploaded_file($file_tmp_name[$att_key], $upload_path."/".$file_name[$att_key])) {
			js_alert_location("파일 업로딩에 실패하였습니다.","-1");
    	}
	$UPDIR1 .=$file_name[$att_key]."|";
	}
endwhile;

/* 파일 업로딩 끝 */

/* DB에 저장될 DATA를 한 번 처리를 한다. */
include "./${BOARD_FOLDER_NAME}/func/FILTERING.php";
include "./${BOARD_FOLDER_NAME}/func/FILTERING_Word.php";


$NAME = addslashes($NAME);
if(isMember()) $ID =  "$_COOKIE[MEMBER_ID]";
if(!$IP) $IP = $REMOTE_ADDR;
$SUBJECT = addslashes($SUBJECT);
$CONTENTS = addslashes($CONTENTS);
$THREAD = "A";
$COUNT = 0;
$W_DATE=time();
if(!$MDATE) $MDATE = time();

/* 패밀리 아이디 생성 */
$QUERY_STR = "SELECT max(FID)+1 FROM ${BOARD_NAME}";
$LIST = mysql_query($QUERY_STR);
$FID = mysql_result($LIST,0,0);

/* board DB에 처리된 값들을 INSERT 한다. */
$QUERY_STR = "INSERT INTO $BOARD_NAME (BID,ID,NAME,PASSWD,EMAIL,URL,SUBJECT,SUB_TITLE1,SUB_TITLE2,CONTENTS,SUB_CONTENTS1,SUB_CONTENTS2,THREAD,FID,COUNT,RECCOUNT,DOWNCOUNT,UPDIR1,UPDIR2,IP,SPARE1,W_DATE , MDATE , SiteKey )
VALUES('$CATEGORY_IN','$ID','$NAME','$PASSWD','$EMAIL','$URL','$SUBJECT','$SUB_TITLE1','$SUB_TITLE2','$CONTENTS','$SUB_CONTENTS1','$SUB_CONTENTS2','$THREAD','$FID','$COUNT','$RECCOUNT','$DOWNCOUNT','$UPDIR1','$UPDIR2','$IP','$SPARE1','$W_DATE' , '$MDATE', '$SiteKey')";
//echo "\$QUERY_STR = $QUERY_STR";
//exit;
$RESULT=mysql_query($QUERY_STR) or die(mysql_error());
if(!$RESULT) js_alert_location("DB 작업중 에러가 발생 하였습니다","-1");
/*
ID 가 존재 하고 글 쓰기 포인트 여부가 존재 한다면...wizPoint 에 내용을 적어 둔다..
*/
if($ID && $PointEnable == "checked" ){

	$query_result = mysql_query( "select UID from ${MEMBER_TABLE_NAME} where ID = '$ID'", $DB_CONNECT );
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	if ( $query_result ) {
	$Content = "${BOARD_TITLE_DESC} 글쓰기 포인트 부여" ; // 포인트 내용
	$GName = "System" ; // 부여자
	$Flag = "BW";//글쓸때 플래그
	$presult = boolInsertPoint($BOARD_NAME , $ID , $GName , $WritingPoint , $Flag ,$Content);
	if(!$presult) js_alert("포인트 DB 작업 실패");

	$sqlstr = "update ${MEMBER_TABLE_NAME} set WriteNum = WriteNum + 1 where ID = '$ID'";
	$sqlqry = mysql_query($sqlstr) or die(mysql_error());
	}

}

/* 어드민에게 공지 메일 날리기 */

// 게시판 실제 이름
$BOARD_TITLE_DESC = getTableName($GID , $BID);

if($MAILTOADMIN == "checked" && $EMAIL && !isAdmin()){
if(file_exists("./config/admin_info.php")) include "./config/admin_info.php";
	$SEND_CONTENT = "<a href=\"$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$CATEGORY&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax\">$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$CATEGORY&mode=view&UID=$UID&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax</a> <br> 작성자 : $NAME <br> <br> $CONTENTS ";
	$TO_MAIL = $ADMIN_EMAIL;
	$FROM_MAIL = "$NAME <$EMAIL>";
	$SUBJECT = "${NAME} 님이 ${BOARD_TITLE_DESC} 게시판에 글을 남겼습니다.";
	$SEND_CONTENT = "<IFRAME SRC='${SITE_URL}/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$CATEGORY&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax' WIDTH=780 HEIGHT=700 FRAMEBORDER=0></IFRAME>";
	$mail_result =  boolMailSend($TO_MAIL , $FROM_EMAIL , $SUBJECT , $SEND_CONTENT );

	if(!$mail_result) js_alert("관리자에게 메일발송이 실패 하였습니다.") ;


}
/* 메일보내기 끝 */

js_alert_location("자료가 성공적으로 등록되었습니다","./${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$CATEGORY&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");

?>
