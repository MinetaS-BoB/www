<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

set_time_limit (0);
/* CATEGORY 가 없을 경우 $CATEGORY에 $BID를 넣는다. $CATEGORY는 한 테이블에서 여러가지 카테고리를 나눌경우 샤용 */
//if(!$CATEGORY) $CATEGORY_IN = $BID;
//else $CATEGORY_IN = $CATEGORY;
$CATEGORY_IN = $CATEGORY;
/*** ADMIN 패스워드 가져오기 ******/
if($GID) $ADMIN_STR="SELECT Pass FROM ${BOARD_MAIN_TABLE_NAME} WHERE BID='$BID' and GID='$GID'";
else $ADMIN_STR="SELECT Pass FROM ${BOARD_MAIN_TABLE_NAME} WHERE BID='$BID'";
$ADMIN_QRY=mysql_query($ADMIN_STR);
$ADMINPWD=mysql_fetch_array($ADMIN_QRY) or die(mysql_error());;

/*** 글 작성자 패스워드 및 업로딩 파일 가져오기 *****/
	$SQL_STR="SELECT ID, PASSWD, UPDIR1, UPDIR2 FROM $BOARD_NAME WHERE UID='$UID'";
	$SQL_QRY=mysql_query($SQL_STR);
	$LIST=mysql_fetch_array($SQL_QRY);
	$UPDIRF = explode("|", $LIST[UPDIR1]); /* 현재 업로딩 된 파일 가져오기 */
	$UPDIRFN = explode("|", $LIST[UPDIR2]); /* 현재 업로딩 된 파일 이름 가져오기 */
	$LIST[PASSWD]=trim($LIST[PASSWD]);


if(!isAdmin()){

	if($PASSWD && $PASSWD != $LIST[PASSWD]) { // 비회원 게시판으로 패스워드를 입력하는 폼이라면 입력된 패스워드를 상호 비교한다.
		js_alert_location("글작성시 패스워드를 입력해주세요.","-1");
	}
}

/* 파일 업로딩 시작 */
unset($UPDIR1);
unset($UPDIR2);
//echo "sizeof($file) = ".sizeof($file)."<br>";
$file_field_name = "file";
file_uploade($file_field_name);
$upload_path = "./${BOARD_FOLDER_NAME}/table/".$GID."/".$BID."/updir";

		while(is_array($file_name) && list($att_key, $att_value) = each($file_name)):
		//echo "file_name[$att_key] = ".$file_name[$att_key]." <br>";
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
				$Tmp1[$att_key]=$file_name[$att_key];
				if($UPDIRF[$att_key]) unlink($upload_path."/".$UPDIRF[$att_key]);
				if($FILE_NAME_REARRANGE) $file_name[$att_key]=time()."".$extention;
				if (file_exists($upload_path."/".$file_name[$att_key]) && !$UpLoadingOverWriteEnable) {
				if(!$FILE_NAME_REARRANGE) $file_name[$att_key] = date("is")."_$file_name[$att_key]";
				else $file_name[$att_key] = $newFileName."_$file_name[$att_key]".$extention;
				}
				if(!move_uploaded_file($file_tmp_name[$att_key], $upload_path."/".$file_name[$att_key])) {
					js_alert_location("파일 업로드에 실패 하였습니다.","-1");
				}
			$Tmp[$att_key]=$file_name[$att_key];
			}else if($file_del[$att_key] && $UPDIRF[$att_key]){ //파일 삭제 옵션이 책크 되어 있으면
			unlink($upload_path."/".$UPDIRF[$att_key]);
			}else {
			$Tmp[$att_key]=$UPDIRF[$att_key];
			$Tmp1[$att_key]=$UPDIRFN[$att_key];
			}

		$UPDIR1 .= $Tmp[$att_key]."|";
		$UPDIR2 .= $Tmp1[$att_key]."|";

		endwhile;

		/* DB에 저장될 DATA를 한 번 처리를 한다. */
		include "./${BOARD_FOLDER_NAME}/func/FILTERING.php";
		include "./${BOARD_FOLDER_NAME}/func/FILTERING_Word.php";
		$MDATE = time();
		$NAME = addslashes($NAME);
		$SUBJECT = addslashes($SUBJECT);
		$CONTENTS = addslashes($CONTENTS);

		/* board DB에 처리된 값들을 INSERT 한다. */


		$QUERY_STR = "UPDATE $BOARD_NAME SET BID='$CATEGORY_IN',NAME='$NAME',EMAIL='$EMAIL',URL='$URL',SUBJECT='$SUBJECT',SUB_TITLE1='$SUB_TITLE1',
		SUB_TITLE2='$SUB_TITLE2',CONTENTS='$CONTENTS',SUB_CONTENTS1='$SUB_CONTENTS1',SUB_CONTENTS2='$SUB_CONTENTS2',UPDIR1='$UPDIR1',UPDIR2='$UPDIR2',SPARE1='$SPARE1',MDATE='$MDATE'
		WHERE UID='$UID'";

		$result=mysql_query($QUERY_STR) or die(mysql_error());
		if($flag == "write_only") $tmode = "write";
		else $tmode = "";
		if($result)  js_alert_location("자료가 성공적으로 수정 되었습니다.","./${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=$tmode&category=$CATEGORY_IN&mode=view&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&BOARD_NO=$BOARD_NO&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
		else js_alert_location("DB작업중 에러가 발생 하였습니다.","-1");

?>
