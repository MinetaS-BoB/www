<?
$trigger = $_GET['trigger'];
$target = $_GET['target'];
$form = $_GET['form'];
$flag = $_GET['flag'];

include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/membercheck_info.php";
include "../../function/const_array.php";
include "../../function/kerrigancap_lib.php";

include "../../function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$trigger = filter($trigger);
$Jumin1 = filter($Jumin1);
$Jumin2 = filter($Jumin2);


header("Content-Type: application/x-javascript");


if($flag == "ID")://아이디 체크
	$ID = trim($trigger);
	$DISABLEID = explode("," , $DISABLEID);

	if(!$ID) {
		echo "
		alert('아이디를 입력해주세요');
		document." . $form . ".ID.focus();
		document." . $form . ".IDCheckFlag.value = 'N';
		";
		exit;
	}else if((strlen($ID) > 20) || (strlen($ID) < 4)) {
		echo "
		alert('아이디는 4~20자 사이의 영문숫자 혼합으로 구성되어야 합니다.');
		document." . $form . ".ID.focus();
		document." . $form . ".IDCheckFlag.value = 'N';
		";
		exit;
	}else if(in_array($ID , $DISABLEID)){
		echo "
		alert('".$ID." 은 사용불가 ID 입니다.');
		document." . $form . ".ID.value = '';
		document." . $form . ".ID.focus();
		document." . $form . ".IDCheckFlag.value = 'N';
		";
		exit;
	}

	$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE ID='$ID'", $DB_CONNECT);

	if ( $cnt > 0  ) {
	echo "
		alert('".$ID." 은 이미 사용중인 아이디입니다.');
		document." . $form . ".ID.value = '';
		document." . $form . ".ID.focus();
		document." . $form . ".IDCheckFlag.value = 'N';
		";
		exit;
	}else{
		echo "
		alert('사용가능한 아이디입니다.');
		document." . $form . ".IDCheckFlag.value = 'Y';
		";
		exit;
	}

exit;
endif;

if($flag == "NickName"):// 닉네임 체크
$NICKANME = trim($trigger);
$DISABLEID = explode("," , $DISABLEID);
if(!$NICKANME) {
		echo "
		alert('닉네임을 입력해주세요');
		document." . $form . ".NickName.focus();
		document." . $form . ".NickCheckFlag.value = 'N';
		";
		exit;
	}else if((strlen($NICKANME) > 16) || (strlen($NICKANME) < 4)) {
		echo "
		alert('닉네임은 4~16자 까지만 구성되어야 합니다.');
		document." . $form . ".NickName.focus();
		document." . $form . ".NickCheckFlag.value = 'N';
		";
		exit;
	}else if(in_array($NICKANME , $DISABLEID)){
		echo "
		alert('".$NICKANME." 은 사용불가 NICKANME 입니다.');
		document." . $form . ".NickName.focus();
		document." . $form . ".NickCheckFlag.value = 'N';
		";
		exit;
	}

	$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE NickName='$NICKANME'", $DB_CONNECT);
	if ( $cnt > 0  ) {
	echo "
		alert('".$NICKANME." 은 이미 사용중인 닉네임 입니다.');
		document." . $form . ".NickName.value = '';
		document." . $form . ".NickName.focus();
		document." . $form . ".NickCheckFlag.value = 'N';
		";
		exit;
	}else{

		echo "
		alert('사용가능한 닉네임입니다.');
		document." . $form . ".NickCheckFlag.value = 'Y';
		";
		exit;
	}
exit;
endif;


if($flag == "JUMIN"):// 주민등록 번호

$Jumin1 = trim($Jumin1);
$Jumin2 = trim($Jumin2);
if(!$Jumin1 || !$Jumin2) {
		echo "
		alert('주민번호를 입력해주세요');
		document." . $form . ".Jumin1.focus();
		document." . $form . ".JuminCheckFlag.value = 'N';
		";
		exit;
}

$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE Jumin1='$Jumin1' and Jumin2 = '$Jumin2' ", $DB_CONNECT);

if ( $cnt > 0  ) {
		echo "
		alert('이미 사용중인 주민번호 입니다');
		document." . $form . ".Jumin1.focus();
		document." . $form . ".JuminCheckFlag.value = 'N';
		";
		exit;
}else{
		echo "
		alert('사용가능한 주민번호 입니다.');
		document." . $form . ".JuminCheckFlag.value = 'Y';
		";
		exit;
}

exit;
endif;



if($flag == "EMAIL"):// 이메일

$MAIL = trim($trigger);
if(!$MAIL) {
		echo "
		alert('이메일을 입력해주세요');
		document." . $form . ".MailCheckFlag.value = 'N';
		";
		exit;
}

$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE Email = '$MAIL'", $DB_CONNECT);
if ( $cnt > 0  ) {
		echo "
		alert('이미 사용중인 이메일입니다.');
		document." . $form . ".Email1_1.value= '';
		document." . $form . ".Email1_2.value= '';
		document." . $form . ".Email1_1.focus();
		document." . $form . ".MailCheckFlag.value = 'N';
		";
		exit;
}else{
		echo "
		alert('사용가능한 이메일입니다.');
		document." . $form . ".MailCheckFlag.value = 'Y';
		";
		exit;
}

exit;
endif;


if($flag == "RECOMMAND"):// 추천인 아이디

$RecID = trim($trigger);

if(!$RecID) {
		echo "
		alert('추천인 아이디를 입력해주세요');
		document." . $form . ".RecID.focus();
		";
		exit;
}

$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE ID = '$RecID' ", $DB_CONNECT);
if ( $cnt ==  0  ) {
		echo "
		alert('존재하지 않는 추천인 아이디입니다.');
		document." . $form . ".RecID.value= '';
		document." . $form . ".RecID.focus();
		";
		exit;
}else{
		echo "alert('적용가능 추천인아이디 입니다.');";
		exit;
}
exit;
endif;

?>
