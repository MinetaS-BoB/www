<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<?
if(!$ID) $ID = $_COOKIE[MEMBER_ID];
if(!$NAME) $NAME = $_COOKIE[MEMBER_NAME];
if(!$IP) $IP = $_SERVER['REMOTE_ADDR'];
$CONTENTS = addslashes(strip_tags($CONTENTS));
$W_DATE=time();


$THREAD = "";
$FID = 0;


if(!$cmode || $cmode == "write"){
	$THREAD = "A";
	/* 패밀리 아이디 생성 */
	$FID = getSingleValue("SELECT max(FID)+1 as cnt FROM ${BOARD_NAME}_comment");

}else{


	$NEW_THREAD="A";
	$SQL_STR="SELECT FID,THREAD FROM ${BOARD_NAME}_comment WHERE UID='$CUID'";
	$SQL_QRY=mysql_query($SQL_STR);

	$FID=mysql_result($SQL_QRY,0,FID);
	$CURRENT_THREAD=mysql_result($SQL_QRY,0,THREAD);		
	
	$SQL_STR_REPLY="SELECT right(THREAD,1) from ${BOARD_NAME}_comment WHERE FID='$FID' and length('$CURRENT_THREAD')+1=length(THREAD) and locate('$CURRENT_THREAD',THREAD)=1 order by THREAD DESC limit 0,1";
	$SQL_QRY=mysql_query($SQL_STR_REPLY);
	if($LIST=@mysql_fetch_array($SQL_QRY)) {
		$MORE_THREAD=$LIST[0];
		$THREAD=$CURRENT_THREAD.chr(ord($MORE_THREAD)+1);
	} else {

		$THREAD=$CURRENT_THREAD."A";
	}
	

}

$QUERY_STR = "insert into ${BOARD_NAME}_comment set          
			  MID  = '$UID' ,
			  ID  = '$ID' ,       
			  NAME  = '$NAME' ,         
			  PASSWD  = '$PASSWD' ,             
			  SUBJECT  = '$SUBJECT' ,                   
			  THREAD  = '$THREAD' ,            
			  FID  = '$FID' ,      
			  CONTENTS  = '$CONTENTS' , 
			  IP = '$IP' ,            
			  W_DATE  = '$W_DATE', 			           
			  SiteKey  = '$SiteKey'           
";
//echo $QUERY_STR;
//exit;
 
$result = mysql_query($QUERY_STR);

if($ID && $PointEnable == "checked" ){
	
	$query_result = mysql_query( "select UID from ${MEMBER_TABLE_NAME} where ID = '$ID'", $DB_CONNECT );
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	if ( $query_result ) {
		$Content = "${BOARD_TITLE_DESC} 코멘트 쓰기 포인트 부여" ; // 포인트 내용
		$GName = "System" ; // 부여자 
		
		$Flag = "BCW";//콘멘트 플래그 	
		$presult = boolInsertPoint("${BOARD_NAME}_comment" , $ID , $GName , $CommentPoint , $Flag ,$Content);
		if(!$presult) js_alert("포인트 DB 작업 실패");
		
		$sqlstr = "update ${MEMBER_TABLE_NAME} set WriteNum = WriteNum + 1 where ID = '$ID'";
		mysql_query($sqlstr);
		}
	
}



if($result){
	js_alert_location("자료가 성공적으로 등록 되었습니다","${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&BOARD_NO=$BOARD_NO&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
}else{
	js_alert_location("DB작업중 에러가 발생하였습니다.","-1");
}

?>