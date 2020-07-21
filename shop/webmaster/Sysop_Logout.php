<?
include "../config/db_info.php" ; 
include "../config/db_connect.php" ; 
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";

$ID = $_COOKIE[MEMBER_ID]; 
if (file_exists("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$_COOKIE[MEMBER_ID].cgi")){
	unlink("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$_COOKIE[MEMBER_ID].cgi");
}

setcookie("ROOT_PASS", "0", 0, "/");
setcookie("ADMIN_CHECK_GRADE", "0", 0, "/");
setcookie("ROOT_COLOR_TYPE", "0", 0, "/");
setcookie("MEMBER_NAME", "", 0, "/");
setcookie("MEMBER_ID", "", 0, "/");
setcookie("MEMBER_EMAIL", "", 0, "/");
setcookie("MEMBER_URL", "", 0, "/");
setcookie("MEMBER_GRADE", "", 0, "/");
setcookie("MEMBER_NICKNAME", "", 0, "/");
setcookie("ORDER_NON_MEMBER_NAME", "0", 0, "/");
setcookie("ORDER_NON_MEMBER_PWD", "0", 0, "/");

$result = boolInsertLoginHistory($ID , $_SERVER['REMOTE_ADDR'] , '관리자페이지' , $_SERVER['HTTP_REFERRER'], 'LOGOUT' );	
if(!$result) js_alert("Login History DB 작업중 에러");

echo "<HTML>
<META http-equiv=\"refresh\" content =\"0;url=./default.php\">
</HTML>";
exit;

?>