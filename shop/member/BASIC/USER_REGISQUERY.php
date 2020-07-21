<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/


include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/admin_info.php";
include "../../config/skin_info.php"; //멤버관련 스킨정보를 가져옮($MemberSkin - 회원가입스킨명)
include "../../config/membercheck_info.php";
include "../../function/const_array.php";
include "../../function/kerrigancap_lib.php";

include "../../function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$ID = filter($ID);
$Name = filter($Name);
$PWD = filter($PWD);
$RecID = filter($RecID);



$ID = trim($ID);
$Name = trim($Name);
$PWD = trim($PWD);
$RecID = trim($RecID);
$PWDAnswer = addslashes($PWDAnswer);
/*******************************************************************************
회원로그파일의 생성시간을 구해서 2시간(mktime()기준 - 7200)이 경과된 경우 자동삭제..
*******************************************************************************/
$LOG_DIR = opendir("../../${MEMBER_TEMP_FOLDER_NAME}/login_user");
while($LOG_FILE = readdir($LOG_DIR)) {
	if(is_file("../../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE") && mktime() - filemtime("../../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE") > 7200) {
		unlink("../../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE");
	}
}
closedir($LOG_DIR);

$ID = trim($ID);
$Name = trim($Name);
$PWD = trim($PWD);
$RecID = trim($RecID);
$PWDAnswer = addslashes($PWDAnswer);
$BirthDay = $BirthYY."-".$BirthMM."-".$BirthDD;

$Tel = $Tel1_1."-".$Tel1_2."-".$Tel1_3;
$Hand = $Hand1_1."-".$Hand1_2."-".$Hand1_3;
$Fax = $Fax1_1."-".$Fax1_2."-".$Fax1_3;
$CTel = $CTel1_1."-".$CTel1_2."-".$CTel1_3;//  회사 전호
$CFax = $CFax1_1."-".$CFax1_2."-".$CFax1_3;// 회사 팩스
$Fax = $Fax1_1."-".$Fax1_2."-".$Fax1_3;
$Zip1 = $Zip1_1."-".$Zip1_2;
$Zip2 = $Zip2_1."-".$Zip2_2;
$MarrDate = $MarrYY."-".$MarrMM."-".$MarrDD;
if(!$Email) $Email = $Email1_1."@".$Email1_2;
if(!$Grade) $Grade=10;
$GrantSta=$EGrantSta;
$MDesc = addslashes($MDesc);// 관라자입력시 메모를 적어 주는 경우
if(!$MPublic) $MPublic = "N"; // 정보 공개 여부
$RegDate = time();
$MProfile  = addslashes($MProfile);// 자기 소개

/**********************************************************************/
if ( !$ID || !$PWD || !$Name || !$IDCheckFlag || !$IP) {
	js_alert_location("\\n\\n비정상적인 방법으로 접근하였습니다.\\n\\n","../../");
}

// 아이디 중복 체크 확인
$id_exists = mysql_fetch_array(mysql_query( "select * from ${MEMBER_TABLE_NAME} where ID='$ID'", $DB_CONNECT ));
if ($id_exists) js_alert_location("\\n\\n이미 등록된 아이디입니다.\\n\\n","-1");


if($UseJuminCheck == "checked" && $Grade=="10"){ // 주민 번호 사용을 하고 일반 회원이면 주민 번호 체크를 한다.
	$num_exists = mysql_fetch_array(mysql_query( "select * from ${MEMBER_TABLE_NAME} where Jumin1='$Jumin1' AND Jumin2='$Jumin2'", $DB_CONNECT ));
	if ($num_exists) js_alert_location("\\n\\n이미 등록된 주민등록번호입니다.\\n\\n관리자에게 문의하십시오\\n\\n","-1");
}


/*****************************************************************************
  추천인에게 포인트 적립해주기.(Point 테이블에 적용)
*****************************************************************************/
if ($RecID && $USE_RECOMMEND == "checked") {
if($RecID == $ID) js_alert("본인은 추천하실수 없습니다.");
$reqer_exists = mysql_fetch_array(mysql_query( "select ID from ${MEMBER_TABLE_NAME} where ID='$RecID'", $DB_CONNECT ));
	if ($reqer_exists) 	boolInsertPoint('' , $RecID , $ID , $RPoint , 'RM',  "$Name($ID)회원의 추천포인트");
}


// 회원 아이콘 등록
unset($Picture);
/* 파일 업로딩 시작 */

$file = $_FILES["file1"]["tmp_name"];
$file_name = $_FILES["file1"]["name"];

if($file!="none" && $file){
		upload_image_filter($file_name);
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		upload_filter($file_name);

  	if (file_exists("../../${MEMBER_TEMP_FOLDER_NAME}/user_image/$file_name")) {
    	$file_name = time()."_$file_name";
  	}
    if(!move_uploaded_file($file, "../../${MEMBER_TEMP_FOLDER_NAME}/user_image/$file_name")) {
  		js_alert_location("파일 저장에 실패 했습니다.","-1");
		}
		$Picture =$file_name;
}




/**************************************************************************************************
  DB CONNECT -> INSERT INTO ${MEMBER_TABLE_NAME} ; DB연결후 회원데이터를 저장한다. 1차 기본 정보 입력
**************************************************************************************************/

$sql = "INSERT INTO ${MEMBER_TABLE_NAME} (
ID,PWD,Name,NickName,PWDHint,PWDAnswer,Sex,Jumin1,Jumin2,BirthDay,BirthType,Email,
MailReceive, SMSReceive , Tel,Hand,Fax,Zip1,Address1,Address2,Job,Scholarship,Company,CTel, CFax, Zip2,
Address3,Address4,MarrStatus,MarrDate,RegDate,ModDate , Url,RecID,GrantSta,Grade,WriteNum,RegIP,
 LicenseNo , Business , Item , President , MProfile  , MDesc , MPublic , Picture , SiteKey)
VALUES(
'$ID','$PWD','$Name','$NickName','$PWDHint','$PWDAnswer','$Sex','$Jumin1','$Jumin2','$BirthDay','$BirthType','$Email',
'$MailReceive', '$SMSReceive' , '$Tel','$Hand','$Fax','$Zip1','$Address1','$Address2','$Job','$Scholarship','$Company','$CTel','$CFax','$Zip2',
'$Address3','$Address4','$MarrStatus','$MarrDate','$RegDate','$RegDate','$Url','$RecID','$GrantSta','$Grade','0','$IP' ,
'$LicenseNo' , '$Business' , '$Item' , '$President' , '$MProfile' , '$MDesc' , '$MPublic' , '$Picture' , '$SiteKey')";

$result = mysql_query($sql);
if(!$result){
	js_alert_location("DB 작업중 에러가 발생 했습니다.","../../");
}



/*******************************************************************************
지금 부터 본격적인 회원로긴(쿠키값 설정 및 파일 생성)이 시작된다
*******************************************************************************/
if($GrantSta == "checked"):
	$MEMBER_EXISTS = mysql_query("SELECT ID,PWD,Name,NickName , Email,Url,Jumin1,Grade
	FROM ${MEMBER_TABLE_NAME}
	WHERE ID='$ID'
	AND PWD='$PWD'
	AND GrantSta='checked'", $DB_CONNECT);
	$LIST = mysql_fetch_array($MEMBER_EXISTS);
	if ( !$LIST ) {
		js_alert_location("아이디와 패스워드가 일치하지 않습니다.","-1");
	}

	// 포인트 부여
	if($EPoint > 0 ) { boolInsertPoint('', $ID , "System" , $EPoint , 'M', "회원가입 축하 포인트");}


	if(!$WHERE_REGIS):// 관리자 모드에서 등록된게 아닐경우만 쿠키 생성 해준다..

			$CurrentID = $LIST[ID];     // 아이디
			$CurrentNAME = $LIST[Name]; // 이름
			$CurrentEMAIL = $LIST[Email]; // 이멜
			$CurrentURL = $LIST[Url];     // 홈
			$CurrentGrade = $LIST[Grade];     // 등급
			$CurrentNickName = $LIST[NickName]; 	// 닉네임

			setcookie("MEMBER_NAME", "$CurrentNAME", 0, "/");
			setcookie("MEMBER_ID", "$CurrentID", 0, "/");
			setcookie("MEMBER_EMAIL", "$CurrentEMAIL", 0, "/");
			setcookie("MEMBER_GRADE", "$CurrentGrade", 0, "/");
			setcookie("MEMBER_NICKNAME", "$CurrentNickName", 0, "/");
			$fp = fopen("../../${MEMBER_TEMP_FOLDER_NAME}/login_user/$CurrentID.cgi", "w");
			$LoginTime = time();
			fwrite($fp, "$CurrentID|$CurrentNAME|$Log_Time|$CurrentEMAIL|$CurrentURL|$CurrentGrade|$CurrentNickName");
			fclose($fp);

	endif;

endif ;

if($SendMail == "Y" && $MailReceive == "Y") { include("./USER_REGIS_MAIL.php"); }


if($GrantSta == "checked"){
	js_alert("\\n가입이 정상적으로 이루어졌습니다. \\n회원으로 가입해 주신 {$Name} 님께 진심으로 감사드립니다.");
}else{
	js_alert("\\n {$Name} 님께서는 관리자 승인후 회원서비스를 이용하실수 있습니다..");
}


if($ispopup == "yes"){// 팝업창에서 값이 넘어 온 경우
	js_location("close");
	exit;
}

if ($WHERE_REGIS == "ADMIN") { // 관리자 모드에서 값이 넘어 온 경우
	js_location("-1");
	exit;
}else{
	js_location("../../${MEMBER_MAIN_FILE_NAME}?query=regis_complete");
	exit;
}

?>
