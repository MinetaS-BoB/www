<?

if(!ereg("System_Basic_Proc.php",$_SERVER['PHP_SELF'])){
	include_once "../config/admin_info.php";
}// System_Basic_Proc.php 파일에서는 불러 오지 않는다

include_once "../config/db_info.php";
include_once "../config/db_connect.php";
include_once "../function/const_array.php";
include_once "../function/kerrigancap_lib.php";


if(file_exists("../config/admin_skin_info.php") && $THEME != "System_Board" ){// 게시판 환경설정은 불러 오지 않는다.
	include_once "../config/admin_skin_info.php";// 관리자 스킨
}


if ( !$_COOKIE[ADMIN_CHECK_GRADE] && !isMember() ){// 기본적으로  ADMIN_CHECK_GRADE 체크 및 회원 아이디 체크 
setcookie("ROOT_PASS", "0", 0, "/");
setcookie("ADMIN_CHECK_GRADE", "0", 0, "/");
setcookie("ROOT_COLOR_TYPE", "0", 0, "/");
setcookie("MEMBER_NAME", "", 0, "/");
setcookie("MEMBER_ID", "", 0, "/");
setcookie("MEMBER_EMAIL", "", 0, "/");
setcookie("MEMBER_URL", "", 0, "/");
setcookie("MEMBER_GRADE", "", 0, "/");
setcookie("MEMBER_NICKNAME", "", 0, "/");

if (file_exists("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$_COOKIE[MEMBER_ID].cgi")){
	unlink("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$_COOKIE[MEMBER_ID].cgi");
}		 
		js_location("./default.php");
		exit;     
}


$AUTH_READ_FLAG = false;//읽기 
$AUTH_WRITE_FLAG = false;//쓰기 
$AUTH_DELETE_FLAG = false;//삭제 


if(!isAdmin() && $THEME != "Front"){// 최고 관리자가 아니면 권한별로 관리자 페이지를 보게 한다..Front 페이지는 기본적으로 보여준다.
		
		
		$AUTH_CODE_FLIP = array_flip ($ADMIN_MENU_CODE_ARRAY);//배열의 key 값과 value 값을 바꾼다.		
		$AUTH_CODE = $AUTH_CODE_FLIP["$THEME"];
		$auth_sql = "select AuthService from {$PERMISSION_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]' and Code = '$AUTH_CODE'" ; 
		$auth_list = _mysql_fetch_array($auth_sql);
		
		if(ereg("r" , $auth_list[AuthService])) $AUTH_READ_FLAG = true;
		if(ereg("w" , $auth_list[AuthService])) $AUTH_WRITE_FLAG = true;
		if(ereg("d" , $auth_list[AuthService])) $AUTH_DELETE_FLAG = true;		
		
		// 권한이 없을경우 default.php로 툉기게 한다..
		if(!$AUTH_READ_FLAG) js_alert_location("{$_COOKIE[MEMBER_ID]}님은 해당 권한이 없습니다(보기)","./default.php");
		
		//if(!$AUTH_WRITE_FLAG) js_alert_location("{$_COOKIE[MEMBER_ID]}님은 쓰기 권한이 없습니다","-1");
		//if(!$AUTH_DELETE_FLAG) js_alert_location("{$_COOKIE[MEMBER_ID]}님은 삭제 권한이 없습니다","-1");
		
}

$PGSKIN = "default";// 관리자 페이지 스킨
?>