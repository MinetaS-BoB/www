<?
##################################################################################################################	 	
#				Written by kerrigancap
#				Copyright kerrigancap
#				Date 2005 . 02 . 26	   
##################################################################################################################
if (phpversion() >= 4.2) {
   if (count($_POST)) extract($_POST, EXTR_PREFIX_SAME, 'VARS_');
   if (count($_GET)) extract($_GET, EXTR_PREFIX_SAME, '_GET');
   if (count($_SERVER)) extract($_SERVER, EXTR_PREFIX_SAME, 'SERVER_');
   if (count($_FILES)) extract($_FILES, EXTR_PREFIX_SAME, 'FILES_' );
   if (count($_ENV)) extract($_ENV, EXTR_PREFIX_SAME, 'ENV_');
   if (count($_COOKIE)) extract($_COOKIE, EXTR_PREFIX_SAME, 'COOKIE_');
   if (count($_SESSION)) extract($_SESSION, EXTR_PREFIX_SAME, 'SESSION_');
}

##################################################################################################################
# 관리자 용 컬러 세팅
##################################################################################################################

if($_COOKIE[ROOT_COLOR_TYPE] == "1"){
//Dark Skin
// 테이블 1px 테두리 색상 
$TABLE_STYLE = "bgcolor = 'CCCCCC'" ;
//타이틀 큰사이즈 스타일
$TITLE_STYLE = " bgcolor = '000000' class = 'title_big'" ;
// 타이틀 작은 사이즈 스타일
$TITLE_SMALL_STYLE = " bgcolor = '000000' class = 'title_small'" ; 
// 왼쪽의 컨텐트 TD 타이틀 스타일 
$LEFT_STYLE = " bgcolor = 'CE0000' class = 'title_small'" ; 
// 오른쪽 컨텐츠 TD 스타일
$CONTENT_STYLE = "bgcolor = 'FFFFFF'";

}else if($_COOKIE[ROOT_COLOR_TYPE] == "2"){

// BlueRay Skin
// 테이블 1px 테두리 색상 
$TABLE_STYLE = "bgcolor = 'B9CFE3'" ;
//타이틀 큰사이즈 스타일
$TITLE_STYLE = " bgcolor = '005584' class = 'title_big'" ; 
// 타이틀 작은 사이즈 스타일
$TITLE_SMALL_STYLE = " bgcolor = '000000' class = 'title_small'" ; 
// 왼쪽의 컨텐트 TD 타이틀 스타일 
$LEFT_STYLE = " bgcolor = 'F0F8FF' class = 'blue_admin'" ; 
// 오른쪽 컨텐츠 TD 스타일
$CONTENT_STYLE = "bgcolor = 'FFFFFF'";

} else if($_COOKIE[ROOT_COLOR_TYPE] == "3"){
//Grace Skin
$TABLE_STYLE = "bgcolor = 'B9CFE3'" ;
//타이틀 큰사이즈 스타일
$TITLE_STYLE = " bgcolor = '00A6A8' class = 'title_big'" ; 
// 타이틀 작은 사이즈 스타일
$TITLE_SMALL_STYLE = " bgcolor = '000000' class = 'title_small'" ; 
// 왼쪽의 컨텐트 TD 타이틀 스타일 
$LEFT_STYLE = " bgcolor = 'E5F6F6' class = 'blue_admin_02'" ; 
// 오른쪽 컨텐츠 TD 스타일
$CONTENT_STYLE = "bgcolor = 'FFFFFF'";

}

##################################################################################################################	 		  
# 파일 업로드시 사용
##################################################################################################################


function file_uploade($file_field_name){
global $file_field_name, $file_name, $file_type, $file_error, $file_size, $file_tmp_name;
$file_name=$_FILES[$file_field_name]['name'];
$file_type=$_FILES[$file_field_name]['type'];
$file_error=$_FILES[$file_field_name]['error'];
$file_size=$_FILES[$file_field_name]['size'];
$file_tmp_name=$_FILES[$file_field_name]['tmp_name'];
}


##################################################################################################################	 		  
# 각종 이동 스크립트
##################################################################################################################	 

					 
function js_location($val) {
	if ($val < 0) {
		echo "<script language='javascript'>history.go(${val});</script>";
	} else if ($val == 'close') {
		echo "<script language='javascript'>self.close();</script>";
	} else if ($val == "parent") {
		echo "<script language='javascript'>opener.location.reload();self.close();</script>";
	} else if ($val == "reload") {
		echo "<script language='javascript'>location.reload();</script>";
	} else {
		echo "<script language='javascript'>location.replace ('$val');</script>";
	}
	exit;
}

function js_alert($val) {
	echo "<script language='javascript'>alert ('$val');</script>";
}

function js_alert_location($val, $val2) {
	js_alert ($val);
	js_location ($val2);
	exit;
}
// 팝업창 닫고 부모창을 이동시김
function js_alert_opener_location($val , $val2){
	js_alert ($val);
	echo "<script language='javascript'>opener.location.replace ('$val2');self.close();</script>";
	exit;
}

// 팝업창 닫고 부모창에 값전달  $val2 인자로 FrmUserInfo.ID.value=''는 opener의 ID값을 ''로 넘겨준다.
function js_alert_opener_valuesend($val , $val2){
	js_alert ($val);
	echo "<script language='javascript'>opener.${val2};self.close();</script>";
	exit;
}


##################################################################################################################	 
# 각종화일관련
##################################################################################################################	 


//이미지 업로드만
	function confirm_upload($file_name){				
		$extention  = strtolower(strrchr($file_name , "."));		
		$allow_files  = array(".jpg",".gif",".jpeg" ,".png");		
		$flag = false;
		if ( in_array($extention , $allow_files) ) $flag = true;		
		if(!$flag) js_alert_location("올리신 첨부파일형식은 허용한 업로드파일 형식이 아닙니다.","-1");
		
	}

//파일업로드




function file_display($file_name,$path ,$default_width = '300', $default_height = '500'){//파일을 이미지파일, 플래쉬 파일, 무비 파일에 맞는 형식으로 출력 해준다..		
	
	unset($tmp);			
	$pos  =strrpos($file_name,".");
	$extension  = strtolower(substr($file_name , $pos+1));
	$pwd = "$path/$file_name";			
	$img_size = getimagesize($pwd);
	$width = $img_size[0];
	$height = $img_size[1];
	
	if($extension == "jpg" || $extension == "jpeg" || $extension == "gif" || $extension == "png" || $extension == "bmp" ){												
		
		 display_img ($pwd, $default_width, $default_height, $noimg = '' , $width , $height);							
						
	}else if($extension == "swf"){
	
		 $tmp = "
		  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='$default_width' height='$default_height'>
		  <param name='movie' value='$pwd'>
		  <param name='quality' value='high'>
		  <embed src='$pwd' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='$default_width' height='$default_height'></embed></object>";
	  
	
	}else if($extension == "avi" || $extension == "asf" ||  $extension == "wmv" || $extension == "mpeg"){
	

	$tmp = "<embed src = '$pwd' width = '$default_width' height = '$default_height' autostart = 1>";
	
	}
										
	echo $tmp;

}//파일을 이미지파일, 플래쉬 파일, 무비 파일에 맞는 형식으로 출력 해준다..




##################################################################################################################	 
# 문자열관련함수들
##################################################################################################################	 
// 문자열 끊기 (이상의 길이일때는 ... 로 표시)


function STR_CUTTING( $LONG_STR , $CUTTING_LEN )
{
    $LONG_STR  = trim( $LONG_STR ); 
    for( $i=0 ; $i < $CUTTING_LEN ; $i++ ){ 
        if( ord( $LONG_STR[$i] ) >= 128 )
        {
            $KOR++;
        } 
        else
        {
            $ENG++;
        } 
    } 
    if( strlen( $LONG_STR ) > $CUTTING_LEN ){ 
        if( $KOR % 2 == 1 )
        { 
            $CUTTING_LEN = $CUTTING_LEN - 1; 
        } 
        $SHORT_STR = substr( $LONG_STR , 0 , $CUTTING_LEN ); 
        return "$SHORT_STR..."; 
    }
    else {
        $SHORT_STR = substr( $LONG_STR , 0 , $CUTTING_LEN ); 
        return "$SHORT_STR"; 
    }
}

//검색용어 진하고 밑줄
function convert_word($word,$text){
	$text = str_replace($word,"<b><u>$word</u></b>",$text);
	return $text;
}

##################################################################################################################	 
# 이미지 관련 함수
##################################################################################################################	 


// 이미지를 리사이징 해서 보여주기 (width 와 height 같에 따라 비율 만큼 리사이징 된다)

function display_img ($pwd, $width, $height, $noimg = '' , $original_width , $original_height) {
	if (!is_file($pwd)) {
			if (!empty($noimg)) {
					echo "<img src=${noimg} border=0 width=".$width." border=0>";
			}
	}  else {
			
			if ($original_width > $original_height) {
					if ($original_width > $width) {
							$xx = $width / $original_width;
							if ((int)($original_height * $xx) > $height) {
									$img_size = " height=$height ";
							} else {
									$img_size = " width=$width ";
							}
					} else {
							$img_size = "";
					}
			} else {
					if ($original_height > $height) {
							$xx = $height / $original_height;
							if ((int)($original_width * $xx) > $width) {
									$img_size = " width=$width ";
							} else {
									$img_size = " height=$height ";
							}
					} else {
							$img_size = "";
					}
			}
			
			$popWin_width  = intval($original_width + 20) ; 
			$popWin_Height  = intval($original_height + 20) ; 
			
			echo "<a href=\"javascript:doNothing()\" onClick=\"win1Open=displayImage('$pwd', 'BoardPopupImage', '$popWin_width', '$popWin_Height')\" onMouseOver=\"window.status='Click to display picture'; return true;\" onMouseOut=\"window.status=''\"><img src=" . $pwd . " ".$img_size ." border=0></a>";
	}
}



##################################################################################################################	 
# 총쿼리실행수및 시간
##################################################################################################################	 
 function getMicrotime($startPage,$endPage){
	global $TOTALQUERY;
	$start = explode(" ",$startPage);
	$end   = explode(" ",$endPage);
	$result_micro =$end[0] - $start[0];
	$result_time  =$end[1] - $start[1];
	echo "
		<!-- SQL QUERY TIME & HTML PRINT TIME
		-------------------------------------------------------------------
		SQL QUERY TIME & HTML PRINT TIME
		-------------------------------------------------------------------
		StartTime : $startPage
		EndTime   : $endPage
		-------------------------------------------------------------------
		Total Excute Time  : $result_time sec $result_micro micro
		Total SQL Query    : $TOTALQUERY
		-------------------------------------------------------------------
		-->
	";
 }


##################################################################################################################	 
# 파일및 폴더 이름 바꾸기 
################################################################################################################## 

function boolRename($oldfile,$newfile) {
   if (!rename($oldfile,$newfile)) {
     if (copy ($oldfile,$newfile)) {
         unlink($oldfile);
         return true;
     }
     return false;
   }
   return true;
} 

 
##################################################################################################################	 
# 루트 시스템 절대 경로 얻기
##################################################################################################################	 
 function getServerSys(){
	 return $_SERVER["DOCUMENT_ROOT"];
 }

##################################################################################################################	 
# 루트 Url 얻기(메일 발송할때 사용)
##################################################################################################################	 
 function getSeverUrl(){
	 return "http://".$_SERVER["HTTP_HOST"];
 }

##################################################################################################################	 
 # 현재 시스템 경로 얻기
##################################################################################################################	 
 function getSysPath(){
	 return $_SERVER["SCRIPT_FILENAME"];
 }

##################################################################################################################	 
 # 현재 URL 경로 얻기
##################################################################################################################	 
 function getUrlPath(){
	 return "http://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"];
 }

##################################################################################################################	 
 # 원격지 아이피 얻기
##################################################################################################################	 
 function getIp(){
	 return $_SERVER["REMOTE_ADDR"];
 }


##################################################################################################################	 
# Mysql 기본 정의
##################################################################################################################
	 
	function _mysql_fetch_array($sql){// mysql_query + mysql_fetch_array 
		$row = array();
		$result = mysql_query($sql);
		if($result){		
			$row =  mysql_fetch_array($result);
			return $row; 
			
		}else{
			return mysql_error();
		}
	}
	
	function getSingleValue($sql){// 스칼라 값을 구할때 
		$list = _mysql_fetch_array($sql);
		if($list){
			return $list[0];
		}else{
			return mysql_error();
		}
	}
	
	
	function mysql_query_error($sql) {
		$result = mysql_query($sql) or die("<font size=2>" . $sql . "<br>" . mysql_error() . "<br>MySQL Error No. " . mysql_errno() . "</font>");
		return $result;
	}

	function mysql_pop_value($sql) {
		$result = mysql_query_error($sql);
		if (mysql_num_rows($result) == 0) {
			return false;
		} else {
			$val = array_pop(mysql_fetch_row($result));
			return $val;
		}
	}
	
	function set_sql_str ($set_sql, $arr, $str) {
		$r_str;
	
		foreach ($arr as $key=>$val) {
			if (ereg ("^$str", $key)) {
				$key = ereg_replace ("^$str", "", $key);
	
				if (!empty($key)) {
					if (!empty($set_sql)) {
						$set_sql .= ', ';
					}
					$set_sql .= "${key} = '${val}'";
				}
			}
	
		}
	}


function getSelectDate($TYPE , $YearName , $MonthName , $DayName , $Value =0, $LimitYear ,$DisplayName){

	global $SITE_START_DATE;

// Type (YMD , YM , Y) => 년월일,년월 , 일 $Value =>수정값 $LimitYear => 년도  시작년 + 
// $YearName = > 년 이름
// $MonthName = > 월 이름
// $DayName = > 일 이름
// $DisplayName => 년 월 일 표시 (Y N)

	if($DisplayName == "Y"){
		
		$YearText = "년";
		$MonthText = "월";
		$DayText = "일";
		
	}else{
		$YearText = "";
		$MonthText = "";
		$DayText = "";
	}


	$year = date("Y");// 시작 년도 		, $SITE_START_DATE
	$month = date("m");
	$day = date("j");
	
	if($Value){
		$regyear = date("Y", $Value);
		$regmonth = date("m", $Value);
		$regday = date("d", $Value);
	}else{
		$regyear = date("Y");		
		$regmonth = date("m");
		$regday = date("d");
		
	}	
	
	  if(ereg ("Y" , $TYPE )){
		echo "<select name='$YearName' size='1'>";		
		for($i = $year ;$i <= $year + $LimitYear;$i++) {
			if($regyear == $i) 	echo "<option value='$i' selected>$i</option>";			
			else echo "<option value='$i'>$i</option>";
		}
		echo "</select>$YearText " ; 
	  }
	  
	  if(ereg ("M" , $TYPE )){	
		echo "<select name='$MonthName' size='1'>";
		for($i="1";$i<=12;$i++) {
			if($regmonth == $i) echo "<option value='$i' selected>".sprintf("%02d",$i)."</option>";			
			else echo "<option value='$i'>".sprintf("%02d",$i)."</option>";
			
		}
		echo "</select>$MonthText " ;
	  }
	 
	  if(ereg ("D" , $TYPE )){	
		echo "<select name='$DayName' size='1'>";
		for($i="1";$i<=31;$i++) {
			if($regday == $i) echo "<option value='$i' selected>".sprintf("%02d",$i)."</option>";			
			else echo "<option value='$i'>".sprintf("%02d",$i)."</option>";
			
		}
		echo "</select>$DayText";
	  }
		
		

}// end function

//해당 달의 마지막 날 계산

function getDateCount($M,$Y){
	$D=1;
	while(checkdate($M,$D,$Y)){
		$D++;
	}
	$D--;
	if($M==2){
		if(!($Y%4))$D++;
		if(!($Y%100))$D--;
		if(!($Y%400))$D++;
	}
	return $D;
}

//요일 찾기
function getWeek($Date) { 
	$ArrayWeek =array("일","월","화","수","목","금","토");
	return $ArrayWeek[date('w',$Date)];
}

function getCreateDate($year,$month,$day) { 
	if(!$year){
		$year = date('Y',mktime());
	}
	if(!$month){
		$month = date('m',mktime());
	}
	if(!$day){
		$day = date('d',mktime());
	}
	
	return mktime(23,59,59,$month,$day,$year);
}


##################################################################################################################	 
# 주문 관련 함수
##################################################################################################################

// 택배회사 URL

function getDeliveryUrl($Company){
	global $PARTNER_TABLE_NAME;
	return getSingleValue("SELECT URL FROM ${PARTNER_TABLE_NAME} WHERE Company = '$Company' LIMIT 1");
}

// 거래처 회사명
function getPartnerName($UID){
	global $PARTNER_TABLE_NAME;
	return getSingleValue("SELECT Company FROM ${PARTNER_TABLE_NAME} WHERE UID = '$UID' LIMIT 1");
}




##################################################################################################################	 
# 회원 관련 함수
##################################################################################################################

// 회원인지 아닌지(파일과 쿠키값을 같이 비교)
function isMember(){
	global $MEMBER_TABLE_NAME; 
	global $MEMBER_TEMP_FOLDER_NAME; 
	global $_COOKIE;
	//$tmpLoginFile = false;
	$tmpLoginCnt = false;	
	$ID = $_COOKIE[MEMBER_ID];	
	//$File =  getenv("DOCUMENT_ROOT") . "/${MEMBER_TEMP_FOLDER_NAME}/login_user/$ID.cgi";	
	//if(file_exists($File)) $tmpLoginFile = true;	
	$cnt = getSingleValue("select count(UID) from ${MEMBER_TABLE_NAME} where ID = '$ID'");
	if($cnt > 0  ) $tmpLoginCnt = true;	
	//if($tmpLoginFile && $tmpLoginCnt) return true;
	if($tmpLoginCnt) return true;
	else return false;
	
}

// 최고 관리자 쿠키아이디와등급을 DB와 비교
function isAdmin(){
	global $MEMBER_TABLE_NAME; 
	global $_COOKIE; 
	$tmpAdminStatus = false;
	$ID = $_COOKIE[MEMBER_ID];
	$Grade = $_COOKIE[MEMBER_GRADE];
	$Pass = $_COOKIE[ROOT_PASS];		
	if(isMember($ID)){
		$list = _mysql_fetch_array("select ID , Grade from ${MEMBER_TABLE_NAME} where ID = '$ID' and Grade = '$Grade' and PWD = '$Pass'");		
		if($ID == $list[ID] && $Grade = $list[Grade]) $tmpAdminStatus = true;
		else $tmpAdminStatus = false;	
	}	
	
	return $tmpAdminStatus;
}


// 아이디로 이름  구하기
function getMemberName($ID){
	global $MEMBER_TABLE_NAME; 
	return getSingleValue("select Name from ${MEMBER_TABLE_NAME} where ID = '$ID'");
}

// 아이디로 등급  구하기
function getMemberGrade($ID){
	global $MEMBER_TABLE_NAME; 
	return getSingleValue("select Grade from ${MEMBER_TABLE_NAME} where ID = '$ID'");
}

// 회원 번호로 회원 아이디 구하기 
function getMemberIDByUID($UID){
	global $MEMBER_TABLE_NAME; 
	return getSingleValue("select ID from ${MEMBER_TABLE_NAME} where UID = '$UID'");
}


// 회원 NickName 얻기 
function getNickName($ID){	
	global $MEMBER_TABLE_NAME; 
	return getSingleValue("select NickName from ${MEMBER_TABLE_NAME} where ID = '$ID'");
}


//주민번호 앞자리로 나이 첵크

function getAge($Jumin1,$Jumin2){
	$TmpYear = substr($Jumin1,0,2);
	$AMonth = substr($Jumin1,2,2);
	$ADay = substr($Jumin1,4,2);

	if($Jumin2 !=''){
		$CkCent = substr($Jumin2,0,1);
		if($CkCent=='3' || $CkCent=='4'){
			$AYear = "20{$TmpYear}";
		}else{
			$AYear = "19{$TmpYear}";
		}
	}else{
		if($TmpYear>0 && $TmpYear<40){
			$AYear = "20{$TmpYear}";
		}else{
			$AYear = "19{$TmpYear}";
		}
	}
	$NYear = date('Y',time());
	$NMonth = date('m',time());
	$NDay = date('d',time());

	$Age = $NYear - $AYear;

/*
	if($AMonth < $NMonth || ($AMonth==$NMonth && $ADay < $NDay)){
		$Age=$Age+1;
	}
*/
	return $Age;
}

// 회원의 성별

function getSex($Jumin2){		
		$digit = substr($Jumin2,0,1);
		$txt_sex = "";
		switch($digit){
			case "1" : 
			case "3" : $txt_sex = "남"  ; break;
			case "2" : 
			case "4" : $txt_sex = "여"  ; break;
		}		
		return $txt_sex;									
}

// 회원의 최종로그인 날짜

function getLastLoginDate($ID){
		global ${LOGIN_HISTORY_TABLE_NAME};
		$sql = "select WDate from ${LOGIN_HISTORY_TABLE_NAME} where ID = '$ID' AND Flag = 'LOGIN' order by UID desc limit 1";
		return getSingleValue($sql);
}
// 회원 최근 접속 아이피 
function getLastLoginIP($ID){
		global ${LOGIN_HISTORY_TABLE_NAME};
		$sql = "select IP from ${LOGIN_HISTORY_TABLE_NAME} where ID = '$ID' AND Flag = 'LOGIN' order by UID desc limit 1";
		return getSingleValue($sql);
}




##################################################################################################################	 
# 사이트 컨텐츠 관련 함수
##################################################################################################################

function getContentPage($Code){
	global $CONTENT_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select Content from ${CONTENT_TABLE_NAME} where Code = '$Code'");
}


##################################################################################################################	 
# 포인트 관련 함수
##################################################################################################################

function getTotalPoint($ID){
	global $POINT_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select sum(point) from ${POINT_TABLE_NAME} where ID = '$ID'");
}

// 사용 가능 포인트 (장바구니에서 사용)

function getTotalEnablePoint($ID){
	global $POINT_TABLE_NAME;
	global $BUYER_TABLE_NAME;
	global $Sitekey;
	$Amount =  getSingleValue("select sum(point) from ${POINT_TABLE_NAME} where ID = '$ID'");
	if(!$Amount) return "0";
	else return $Amount;
}




// 포인트
function boolInsertPoint($TBL , $ID , $GName , $Point , $Flag ,$Content ){
	global $POINT_TABLE_NAME;
	global $SiteKey;
	//Flag는 글쓰기 인지 글쓰기(BW) , 코멘트쓰기(BCW) , 회원로그인(ML) , 회원추천(MR) , 추천(R) , 비추(NR) , 
	//주문 종료시 (OF) , 주문변경 (OC) 주문상품 반품 (OR) ,  투표참여시(P)
	//글읽기 (BR) , 게시판 다운로드(BD) , 관리자 입력(SI) , 로그인(L) , 회원가입  (M) , 추천인 (RM)	
	//$TBL 게시판일경우는 게시판테이블 / 주문일경우는 주문번호
	$Date = time();
	$result = mysql_query("insert into ${POINT_TABLE_NAME} SET TBL = '$TBL' , Point='$Point', ID='$ID' , GName = '$GName' ,Content = '$Content' , Flag = '$Flag'  , WDate = $Date , SiteKey = '$SiteKey'");
	return $result;
}



##################################################################################################################	 
# 쪽지 관련 함수
##################################################################################################################

function getTotalMemoCnt($ID){// 받은 총 쪽지 
	global $MEMO_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select count(UID) from ${MEMO_TABLE_NAME} where ReceiveID = '$ID'");	
}

function getTotalNotReadMemoCnt($ID){// 읽지 않은 쪽지 
	global $MEMO_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select count(UID) from ${MEMO_TABLE_NAME} where ReceiveID = '$ID' and ConfirmDate = 0");	
}

##################################################################################################################	 
# 스크랩 관련 함수
##################################################################################################################
//enum('BOARD', 'CAFE', 'BLOG', 'OTHER1', 'OTHER2') 게시판 ,카페 , 블로그 other1, other2 의 경우는 구인구직에 사용
function getTotalScrapCnt($ID){
	global $SCRAP_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select count(UID) from ${SCRAP_TABLE_NAME} where ID = '$ID'");	
}

function boolInsertScrap($ID , $ScrapType , $TableName , $DocNo){	
	global $SCRAP_TABLE_NAME;
	global $Sitekey;
	$WDate = time();
	$result = mysql_query("insert into ${SCRAP_TABLE_NAME} set ID  = '$ID' , ScrapType = '$ScrapType', TableName = '$TableName' , DocNo = '$DocNo' , WDate = $WDate , SiteKey = '$SiteKey'");
	return $result;
}

##################################################################################################################	 
# 게시판 관련 함수
##################################################################################################################

function getTableName($GID , $BID){// 테이블 이름 얻기
	global $BOARD_MAIN_TABLE_NAME;
	return getSingleValue("select BoardDes from ${BOARD_MAIN_TABLE_NAME} where GID = '$GID' and BID = '$BID'");
}

function getSubject($GID , $BID , $UID){//게시판 제목 얻기
	global $DEFAULT_TABLE_NAME;
	$list = _mysql_fetch_array("select SUBJECT from ${DEFAULT_TABLE_NAME}_{$GID}_{$BID} where UID = '$UID'");
	if($list[SUBJECT]) return stripslashes($list[SUBJECT]);
	else return "삭제된게시물입니다";
}


function getTableCountByGroup($GID){//그룹에 딸린 게시판 갯수 얻기
	global $BOARD_MAIN_TABLE_NAME;
	return getSingleValue("select count(*) from ${BOARD_MAIN_TABLE_NAME} where GID = '$GID'");
}

function getGroupName($GID){// 그룹명 얻기
	global $BOARD_GROUP_TABLE_NAME;
	return getSingleValue("select GrpSubject  from ${BOARD_GROUP_TABLE_NAME} where GID = '$GID'");
}

function getGID($BID){// GID  얻기  BID를 통해서
	global $BOARD_MAIN_TABLE_NAME;
	return getSingleValue("select GID  from ${BOARD_MAIN_TABLE_NAME} where BID = '$BID'");
}

function getCountArticle($GID, $BID){// 게시물 갯수 얻기 
	global $DEFAULT_TABLE_NAME;				
	$BoardArticleCnt = getSingleValue("select count(*) from ${DEFAULT_TABLE_NAME}_${GID}_${BID}");	
	return $BoardArticleCnt;		
}

function boolCommentTableExist($GID , $BID){// 코멘트 테이블 존재 여부	
	global $MYSQL_DB;
	global $DEFAULT_TABLE_NAME;
	$result = mysql_list_tables ($MYSQL_DB);
	$exitCnt = 0;
	while ($i < mysql_num_rows ($result)) {
	   $tb_names[$i] = mysql_tablename ($result, $i);
	   if("${DEFAULT_TABLE_NAME}_${GID}_${BID}_comment" == $tb_names[$i]) $exitCnt = 1 ;  // 코멘트 테이블이 존재 하면  $exitCnt = 1
	   $i++;
	}	
	if($exitCnt == 1) return true;
	else return false;	
}


function getCountCommentArticle($GID , $BID){// 코멘트 게시물 갯수 얻기 
	global $DEFAULT_TABLE_NAME;
	$BoardCommentArticleCnt  = 0 ; 		
	if(boolCommentTableExist($GID , $BID) == true){// 코멘트 테이블이 존재 할경우 행갯수 반환	
		$BoardCommentArticleCnt = getSingleValue("select count(*) from ${DEFAULT_TABLE_NAME}_${GID}_${BID}_comment");
	}			
	return $BoardCommentArticleCnt;
}


##################################################################################################################	 
# 추천 관련 함수
##################################################################################################################


function boolRecommandExistID($TBL , $PID , $ID, $Flag = 'GOOD', $RTYPE = 'BOARD'){// 이미 추천을 했는지 본다
	global $RECOMMAND_TABLE_NAME;
	global $SiteKey;	
	$cnt = getSingleValue ("select count(UID) from ${RECOMMAND_TABLE_NAME} where TBL = '$TBL' and ID = '$ID' and PID = '$PID' and Flag = '$Flag' and RTYPE = '$RTYPE'");
	if($cnt == 0) return false;
	else return true;	
}

function boolInsertRecommand($TBL , $PID , $ID, $Flag = 'GOOD', $RTYPE = 'BOARD'){
	global $RECOMMAND_TABLE_NAME;
	global $SiteKey;
	$WDate = time();
	$sql = "insert into ${RECOMMAND_TABLE_NAME} set TBL = '$TBL' , PID = '$PID' , ID = '$ID' , Flag = '$Flag' , RTYPE = '$RTYPE' , WDate = $WDate , SiteKey = '$SiteKey'" ; 
	$result = mysql_query($sql);
	return $result;
}

function getTotalCountRecommand($TBL , $PID , $Flag = 'GOOD' , $RTYPE = 'BOARD'){// 추천수 얻기
	global $RECOMMAND_TABLE_NAME;	
	global $SiteKey;	
	return getSingleValue("select count(UID) from ${RECOMMAND_TABLE_NAME} where  TBL = '$TBL' and  PID = '$PID'  and  Flag = '$Flag' and  RTYPE = '$RTYPE'") ; 	
}

function getFileSize($file, $BID) {//파일 사이즈  게시판용

	global $GID ; 
	global $BOARD_FOLDER_NAME;
	if(file_exists("./${BOARD_FOLDER_NAME}/table/$GID/$BID/updir/$file") && $file){
	   // 일반적인 파일 사이즈 단위를 설정한다.
		$kb = 1024;         // Kilobyte
		$mb = 1024 * $kb;   // Megabyte
		$gb = 1024 * $mb;   // Gigabyte
		$tb = 1024 * $gb;   // Terabyte
	
	// byte단위의 파일을 가져온다.
	   $size = filesize("./${BOARD_FOLDER_NAME}/table/$GID/$BID/updir/$file");
	/* 만약 파일이 kb(키로바이트)보다 적으면 그 값을 그대로 리턴하고 아니면 적당한 파일단위를 붙인다.*/	
	   if($size < $kb) {
		   return $size." B";
	   }
	   else if($size < $mb) {
		  return round($size/$kb,2)." KB";
	   }
	   else if($size < $gb) {
		   return round($size/$mb,2)." MB";
	  }
	   else if($size < $tb) {
		   return round($size/$gb,2)." GB";
	   }
	   else {
		  return round($size/$tb,2)." TB";
	   }
	}   
}


function getIcon($ex){
	global $BOARD_FOLDER_NAME;
	$img = "" ; 
	switch(strtolower($ex)){
		case ".doc" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_doc.gif' border = 0  align = absmiddle>" ; break ; 
		case ".ppt" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_ppt.gif' border = 0  align = absmiddle>" ; break ; 
		case ".xls" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_excel.gif' border = 0  align = absmiddle>" ; break ;
		case ".hwp" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_hwp.gif' border = 0  align = absmiddle>" ; break ;
		case ".gif" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_gif.gif' border = 0  align = absmiddle>" ; break ;
		case ".jpg" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_jpg.gif' border = 0  align = absmiddle>" ; break ;
		case ".zip" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_zip.gif' border = 0  align = absmiddle>" ; break ;
		default :
			$img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_etc.gif' border = 0  align = absmiddle>";  
	}	
	return $img;
}


function auto_link($str)
{
$str=eregi_replace("[-_a-z0-9]+(\.[-_a-z0-9]+)*@[-a-z0-9]+(\.[-a-z0-9]+)+", "<a href='mailto:\\0' target=_blank>\\0</a>",$str);
$str=eregi_replace ("(http|mms|ftp|telnet)://[-a-z0-9]+(\.[-a-z0-9]+)*(/[^\\\*\"\<\>\| &]+(\.[^\\\*\"\<\>\| &]+)?)*/?", "<a href='\\0' target=_blank>\\0</a>",$str);
//$str=eregi_replace ("(http|mms|ftp|telnet)://[-a-z0-9]+(\.[-a-z0-9]+)*(/([^ >]+)*)*/?", "<a href='\\0' target=_blank>\\0</a>",$str);
return $str;
}


##################################################################################################################	 
# 관리자 페이지 함수
##################################################################################################################


// 카테고리 flag 값을 가지고  카테고리 명을 얻는다..
function getCateName($code,$flag='M'){
	global $CATEGORY_TABLE_NAME;
	global $SiteKey;
	return getSingleValue("select cat_name from ${CATEGORY_TABLE_NAME} where cat_no = '$code' and cat_flag = '$flag'");	
}

// 메인 index 사진 
function getBannerPicture($Skin , $Code){  	
	global $BANNER_TABLE_NAME;
	global $STOCK_FOLDER_NAME;
	$sql = "select * from ${BANNER_TABLE_NAME} where Skin = '$Skin'  and Code = '$Code'";	
	$list = _mysql_fetch_array($sql);	  
	$Url1 = stripslashes($list[Url1]);
	$Url2 = stripslashes($list[Url2]);
	$Url3 = stripslashes($list[Url3]);
	$Target1 = stripslashes($list[Target1]); 
	$Target2 = stripslashes($list[Target2]); 
	$Target3 = stripslashes($list[Target3]); 
	
	$URL = $Url1 . "|";
	$TARGET = $Target1 . "|";
	$Size = explode("|",$list[PictureSize]); 	
	$Picture = explode("|" , $list[Picture]);
	$Url = explode("|" , $URL);
	$Target = explode("|" , $TARGET);
			
	
	echo "<a href = '/shop' onfocus = 'this.blur();'><img src ='/shop/img/shop_logo.png' border=0 ></a>";
}


function getRotateBannerCount($Skin){
	global $BANNER_TABLE_NAME;	
	$sql = "SELECT COUNT(*) FROM ${BANNER_TABLE_NAME} WHERE Skin = '$Skin' AND Code LIKE 'A%'" ;	
	return getSingleValue($sql);
}



function getGeneralPoint($Price,$Point = 0){// 일반 
	global $POINTSTATUS; // 전체 포인트를 쓸경우 checked
	global $POINTRATE;// 전체 포인트율 	
	if($POINTSTATUS == "checked"){
		return $Price * ($POINTRATE/100);// 전체 포인트 쓸경우 		
	}else{
		return $Point; // 각각의 포인트를 리턴해준다..
	}				
}


##################################################################################################################	 
# 로그인 관련 함수 
##################################################################################################################

//로그인 할때 DB 입력
function boolInsertLoginHistory($ID , $IP , $Location = '' ,$Referer , $Flag = 'LOGIN'){
	global $LOGIN_HISTORY_TABLE_NAME;
	global $SiteKey;
	$WDate = time();
	$sql = "insert into ${LOGIN_HISTORY_TABLE_NAME}  set ID = '$ID' , IP = '$IP' , Location = '$Location' , Referer = '$Referer' , Flag = '$Flag' , WDate = $WDate , SiteKey = '$SiteKey'" ; 
	$result = mysql_query($sql);
	return $result;	
	
}

// 로그인 수 

function getMemberLoginCnt($ID){
	global $LOGIN_HISTORY_TABLE_NAME;
	return getSingleValue("select count(UID) from ${LOGIN_HISTORY_TABLE_NAME} where ID = '$ID' AND Flag = 'LOGIN'");
}




##################################################################################################################	 
# 메일관련 함수 페이지 함수
##################################################################################################################
// 단순 메일 보내기
function boolMailSend($TO_MAIL , $FROM_EMAIL , $SUBJECT , $SEND_CONTENT ){
	
	$MailHeaders .=  "Return-Path: $FROM_EMAIL \r\n";
	$MailHeaders .=  "From: $NAME <$FROM_EMAIL> \r\n";
	$MailHeaders .=  "X-Mailer: FORM Mailer \r\n";
	$MailHeaders .=  "Mime-Version: 1.0\r\n";
	$MailHeaders .=  "Content-Type: text/html; charset='iso-2022-kr'\r\n";	
	
	$mail_result = mail($TO_MAIL, $SUBJECT , $SEND_CONTENT , $MailHeaders);
	return $mail_result;
	
}
##장바구니 관련 옵션
function OptionValueFnc($Option1, $AddPriceOption){
	if($Option1 && eregi("=", $Option1)){//옵션1이 있고 가격이 별도 이면 가격별도 or 가격추가를 이곳에서 정한다.
		if($AddPriceOption == 2){ # 1: 가격추가 2: 가격별도
			$splitArr = split("=", $Option1);
			$splitArr[1] = ereg_replace(",", "", $splitArr[1]);
			if(intval($splitArr[1])) $GoodsPrice = $splitArr[1];
			
			$OptionValue[0] = $GoodsPrice;
			$OptionValue[1] = $splitArr[0];
			return $OptionValue;
		}
	}
}

##보드관련 아이콘 함수
function showBoardIcon($flag=null, $flag1=null, $uid=null){
#flag : list, write, ....
#flag : null or 1 단순모드
	global $BOARD_FOLDER_NAME,$SKIN_FOLDER_NAME, $ICON_SKIN_TYPE, $BID, $GID, $UID, $category, $CURRENT_PAGE,$SEARCHTITLE,$searchkeyword,$sysop,$fm,$BType,$ListMax,$NEXT_BOARD,$PRE_BOARD,$SKIN_FOLDER_NAM,$BOARD_NAME;
	$fncuid=$uid?$uid:$UID;
	
	
	switch($flag){
		case "list":
			$icon = "<img src=\"./$BOARD_FOLDER_NAME/icon/$ICON_SKIN_TYPE/list_btn.gif\" border=\"0\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "write":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/write_btn.gif\" border=\"0\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&mode=write&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;	
		case "modify":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/modify_btn.gif\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&mode=modify&UID=$fncuid&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;	
		case "save":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/save_btn.gif\" onClick=\"javascript:WRITE_FUNC();\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "reply":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/reply_btn.gif\" onclick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&mode=reply&UID=$fncuid&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;								
		case "cancel":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/cancel_btn.gif\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&query=list&category=$category&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "delete":
			$icon = "<img src=\"./$BOARD_FOLDER_NAME/icon/$ICON_SKIN_TYPE/del_btn.gif\" onClick=\"javascript:DELETE_THIS('$fncuid','$CURRENT_PAGE','$BID','$GID');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "new":
			$icon = "<img src='./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/new_btn.gif' align = absmiddle>";
		break;
		case "next":
			$icon = "<img alt=\"다음\" src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/next_btn.gif\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&mode=view&UID=$NEXT_BOARD[0]&CURRENT_PAGE=$CURRENT_PAGE');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "none_recomm":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/none_recomm_btn.gif\" border=\"0\" style=\"cursor:hand\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&UID=$fncuid&mode=view&CURRENT_PAGE=$CURRENT_PAGE&RECOMMAND=BAD&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\"  align = absmiddle>";
		break;
		case "prev":
			$icon = "<img alt=\"이전\" src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/prev_btn.gif\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&mode=view&UID=$PRE_BOARD[0]&CURRENT_PAGE=$CURRENT_PAGE');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "print":
			$icon = "<img alt=\"프린트\" src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/print_btn.gif\" onClick=\"javascript:printThis();\" style=\"cursor:hand\"  align = absmiddle> ";
		break;
		case "re":
			$icon = "<img src='./$BOARD_FOLDER_NAME/icon/${ICON_SKIN_TYPE}/re_btn.gif' align=absmiddle>";
		break;
		case "recomm":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/recomm_btn.gif\" border=\"0\" style=\"cursor:hand\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&UID=$fncuid&mode=view&CURRENT_PAGE=$CURRENT_PAGE&RECOMMAND=GOOD&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\"  align = absmiddle>";
		break;
		case "scrap":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/scrap_btn.gif\" border=\"0\" style=\"cursor:hand\" onclick=\"javascript:write_scrap('$SKIN_FOLDER_NAME','$BOARD_NAME','$fncuid','BOARD')\"  align = absmiddle>";
		break;	
		case "search":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/search_btn.gif\" border = 0 onclick=\"javascript:search();\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "hot":// 조회수 일정 이상
			$icon = "<img src='./$BOARD_FOLDER_NAME/icon/${ICON_SKIN_TYPE}/hot_btn.gif' align=absmiddle>";
		break;
		case "key":// 비밀글키
			$icon = "<img src='./$BOARD_FOLDER_NAME/icon/${ICON_SKIN_TYPE}/key_btn.gif' align=absmiddle>";
		break;
		case "arrow":// 뷰페이지에서 현재 리스트 번호 보여주는 화살표시
			$icon = "<img src='./$BOARD_FOLDER_NAME/icon/${ICON_SKIN_TYPE}/arrow_btn.gif' align=absmiddle>";
		break;	
																											
	}
	
	
	return $icon;

}


// 옵션 아이콘표시

function getOptionIcon($Array){
	global $OPTION_IMAGE_ARRAY;
	$ArrayValue = explode("|" , $Array);
	for($i = 0 ; $i < sizeof($ArrayValue) ; $i++){
		if($ArrayValue[$i] !="N"){// 옵션이 N 이 아닌것 만
			echo $OPTION_IMAGE_ARRAY[$ArrayValue[$i]] ; 
		}																												
	}
}

function IsCartEnable($OptionName, $FilelLIst){// 장바구니 담기의 가능여부 책크
	$tmpCartFlag = true;
	unset($isenable);
	foreach($OptionName as $key => $value){
		if($FilelLIst[$key]) :
			if($OptionName[$key][1] == "checked"):// 셀렉트 박스이고 값이 존재 하면 카트에 바로 담지 않는다.
				$Option = split("\n", $FilelLIst[$key]);
				for($i = 0; $i < sizeof($Option) && $Option[$i]; $i++) {// 값이 존재 
					$tmpCartFlag = false;
				}
			endif;
		endif;
	}
	if(!strcmp($FilelLIst["None"],"checked") || $tmpCartFlag == false) $isenable =  false;
	else $isenable =  true;

	return $isenable;
}
?>