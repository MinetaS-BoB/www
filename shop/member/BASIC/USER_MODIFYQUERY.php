<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?

include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/admin_info.php";
include "../../config/membercheck_info.php";
include "../../function/const_array.php";
include "../../function/kerrigancap_lib.php";
include "../../function/filter.php";

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
$MProfile = addslashes($MProfile);

if($WHERE_REGIS == "ADMIN"){
	$MDesc = addslashes($MDesc);// 관라자입력시 메모를 적어 주는 경우
	$GoJumpUrl = "../../manager/main.php?menushow=$menushow&THEME=MemberList&CURRENT_PAGE=$CURRENT_PAGE&WHERE=$WHERE&keyword=$keyword&SELECT_SORT=$SELECT_SORT&add=$add&Sex=$Sex&Dsort=$Dsort&SYear=$SYear&SMonth=$SMonth&SDay=$SDay";
}

if(!$MPublic) $MPublic = "N"; // 정보 공개 여부
$ModDate = time();

// 닉네임 수정 불가

  $PicValue = getSingleValue("select Picture from ${MEMBER_TABLE_NAME} where ID = '$ID'");

	/* 파일 업로딩 시작 */
	$file = $_FILES["file1"]["tmp_name"];
	$file_name = $_FILES["file1"]["name"];
	// echo $file_name;
	unset($Picture);
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file!="none" && $file){
		upload_image_filter($file_name);
		// confirm_upload($file_name);
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		if($PicValue) unlink("../../${MEMBER_TEMP_FOLDER_NAME}/user_image/$PicValue");
		if (file_exists("../../${MEMBER_TEMP_FOLDER_NAME}/user_image/$file_name")) {
			$file_name = $newFileName."_$file_name";
		}
		if(!move_uploaded_file($file, "../../${MEMBER_TEMP_FOLDER_NAME}/user_image/$file_name")) {
			js_alert_location("파일 업로드에 실패 하였습니다.","-1");
		}
		$UPDIR=$file_name;
	}else {
		$UPDIR=$PicValue;
	}
	$Picture =$UPDIR;
	// echo $Picture;


	/*
	for($i=0; $i<sizeof($file); $i++){

	}
*/
$sql = "UPDATE ${MEMBER_TABLE_NAME} SET ";

if($PWD) $sql .= " PWD = '$PWD', ";//비밀 번호가 존재한 경우만 비번 바꿈..

$sql .="
Sex = '$Sex',
PWDHint = '$PWDHint' ,
PWDAnswer = '$PWDAnswer'  ,
BirthDay = '$BirthDay',
BirthType = '$BirthType',
Email = '$Email',
MailReceive = '$MailReceive',
SMSReceive = '$SMSReceive',
Tel = '$Tel',
Hand = '$Hand',
Fax = '$Fax',
Zip1 = '$Zip1',
Address1 = '$Address1',
Address2 = '$Address2',
Job = '$Job',
Scholarship = '$Scholarship',
Company = '$Company',
CTel = '$CTel' ,
CFax = '$CFax' ,
Zip2 = '$Zip2',
Address3 = '$Address3',
Address4 = '$Address4',
MarrStatus = '$MarrStatus',
MarrDate = '$MarrDate',
Url = '$Url' ,
ModDate = '$ModDate' ,
LicenseNo = '$LicenseNo',
Business = '$Business',
Item = '$Item',
President = '$President' , ";
if($WHERE_REGIS == "ADMIN"){
 $sql .= " GrantSta = '$GrantSta' , Grade = '$Grade' , MDesc  = '$MDesc' , "; // 관리자 일때만
}
$sql .= "
MPublic = '$MPublic' ,
MProfile = '$MProfile' ,
Picture = '$Picture'
WHERE ID='$ID'
";



$result = mysql_query($sql);
if(!$result){
	js_alert_location("DB 작업중 에러가 발생 했습니다.","../../");
}

if($WHERE_REGIS != "ADMIN"){
	js_alert_location("\\n\\n{$Name}님의 회원가입 정보가 변경되었습니다.\\n\\n","../../");
}else{
	js_alert_location("\\n\\n{$Name}님의 회원가입 정보가 변경되었습니다.\\n\\n","$GoJumpUrl");
}

?>
