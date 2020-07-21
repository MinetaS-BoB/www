<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
include  "${BOARD_FOLDER_NAME}/func/FILTERING.php";

/* CATEGORY 가 없을 경우 $CATEGORY에 $BID를 넣는다. $CATEGORY는 한 테이블에서 여러가지 카테고리를 나눌경우 샤용 */

//if(!$CATEGORY) $CATEGORY_IN = $BID;
//else $CATEGORY_IN = $CATEGORY;

$CATEGORY_IN = $CATEGORY;
/* DB에 저장될 DATA를 한 번 처리를 한다. */

$NAME = addslashes($NAME);

if(isMember()) $ID =  "$_COOKIE[MEMBER_ID]";
if(!$IP) $IP = $REMOTE_ADDR;

if(substr($SUBJECT,0,4)=="Re: ") $SUBJECT=substr($SUBJECT,4);
$CONTENTSOri = split("\[원본내용]", $CONTENTS);
$SUBJECT = addslashes($SUBJECT);
$CONTENTS = addslashes($CONTENTSOri[0]);

$THREAD = "A";
$W_DATE = time();
$MDATE = time();
$COUNT = 0;
$NEW_THREAD="A";

/* 파일 업로딩 시작 */
unset($UPDIR1);
unset($UPDIR2);
$file_field_name = "file";
file_uploade($file_field_name);
$upload_path = "${BOARD_FOLDER_NAME}/table/".$GID."/".$BID."/updir";
while(is_array($file_name) && list($att_key, $att_value) = each($file_name)):
$MicroTsmp = explode(" ",microtime());
$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file_tmp_name[$att_key]!="none" && $file_tmp_name[$att_key]){
    	$extention = strrchr($file_name[$att_key], ".");
		/*
		if(ereg($extention, $REVOKE_EXTENSION)) {
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



	$SQL_STR="SELECT FID,THREAD,EMAIL,SPARE1 FROM $BOARD_NAME WHERE UID='$UID'";
	$SQL_QRY=mysql_query($SQL_STR);

	$CURRENT_FID=mysql_result($SQL_QRY,0,FID);
	$CURRENT_THREAD=mysql_result($SQL_QRY,0,THREAD);
	$CURRENT_EMAIL=mysql_result($SQL_QRY,0,EMAIL);
	$SQL_STR_REPLY="SELECT right(THREAD,1) from $BOARD_NAME WHERE FID='$CURRENT_FID' and length('$CURRENT_THREAD')+1=length(THREAD) and locate('$CURRENT_THREAD',THREAD)=1 order by THREAD DESC limit 0,1";
	$SQL_QRY=mysql_query($SQL_STR_REPLY);
	if($LIST=@mysql_fetch_array($SQL_QRY)) {
		$MORE_THREAD=$LIST[0];
		$FUTURE_THREAD=$CURRENT_THREAD.chr(ord($MORE_THREAD)+1);
	} else {

		$FUTURE_THREAD=$CURRENT_THREAD."A";
	}



$SQL_STR="INSERT INTO $BOARD_NAME set BID='$CATEGORY_IN',ID='$ID', NAME='$NAME', PASSWD='$PASSWD', EMAIL='$EMAIL',URL='$URL', SUBJECT='$SUBJECT',
SUB_TITLE1='$SUB_TITLE1', SUB_TITLE2='$SUB_TITLE2',CONTENTS='$CONTENTS', SUB_CONTENTS1='$SUB_CONTENTS1', SUB_CONTENTS2='$SUB_CONTENTS2',
FID='$CURRENT_FID', THREAD='$FUTURE_THREAD', W_DATE='$W_DATE',COUNT='$COUNT', UPDIR1='$UPDIR1', UPDIR2='$UPDIR2', SPARE1 = '$SPARE1' , MDATE='$MDATE' , SiteKey = '$SiteKey'";

$SQL_QRY=mysql_query($SQL_STR) ;
/* Mail_Receive = 1 이면 Writer_Email 메일을 보낸다. */


if($ID && $PointEnable == "checked" ){

	$query_result = mysql_query( "select UID from ${MEMBER_TABLE_NAME} where ID = '$ID'", $DB_CONNECT );
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	if ( $query_result ) {
		$Content = "${BOARD_TITLE_DESC} 답변글쓰기 포인트 부여" ; // 포인트 내용
		$GName = "System" ; // 부여자
		$Flag = "BW";//글쓸때 플래그
		$presult = boolInsertPoint($BOARD_NAME , $ID , $GName , $WritingPoint , $Flag ,$Content);
		if(!$presult) js_alert("포인트 DB 작업 실패");
		$sqlstr = "update ${MEMBER_TABLE_NAME} set WriteNum = WriteNum + 1 where ID = '$ID'";
		$sqlqry = mysql_query($sqlstr) or die(mysql_error());
	}

}


	// 게시판 실제 이름
	$BOARD_TITLE_DESC = getTableName($GID , $BID);

	if(is_file( "./config/admin_info.php")) include "./config/admin_info.php";

	if($RepleMail == "1" && $CURRENT_EMAIL){// 답변 메일이 있을경우만 메일 보낸다..
		$SEND_CONTENT = "<a href=\"$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$CATEGORY&tableskin=skip&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax\">$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$CATEGORY&mode=view&UID=$UID&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax</a> <br> 작성자 : $NAME <br> <br> $CONTENTS ";
		$TO_MAIL = $CURRENT_EMAIL;
		$FROM_EMAIL = "$NAME <$EMAIL>";
		$SUBJECT = "{$BOARD_TITLE_DESC} 게시판에 대한 답변글이 도착하였습니다.";

		$mail_result =  boolMailSend($TO_MAIL , $FROM_EMAIL , $SUBJECT , $SEND_CONTENT );
		if(!$mail_result) js_alert(" 메일발송이 실패 하였습니다.") ;

	}


	if($MAILTOADMIN == "checked" && !isAdmin()){

		if($CURRENT_EMAIL){// 답변 메일이 있을경우만 메일 보낸다..
			$SEND_CONTENT = "<a href=\"$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$CATEGORY&tableskin=skip&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax\">$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$CATEGORY&mode=view&UID=$UID&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax</a> <br> 작성자 : $NAME <br> <br> $CONTENTS ";
			$TO_MAIL = $CURRENT_EMAIL;
			$FROM_EMAIL = "$NAME <$EMAIL>";
			$SUBJECT = "{$BOARD_TITLE_DESC} 게시판에 답변글이 도착하였습니다.";

			$mail_result =  boolMailSend($TO_MAIL , $FROM_EMAIL , $SUBJECT , $SEND_CONTENT );
			if(!$mail_result) js_alert("관리자에게 메일발송이 실패 하였습니다.") ;

		}
	}



if($flag == "write_only") $tmode = "write";
else $tmode = "";
js_location("${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=$tmode&category=$CATEGORY&CURRENT_PAGE=${CURRENT_PAGE}&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
exit;

?>
