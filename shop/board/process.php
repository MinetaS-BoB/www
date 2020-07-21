<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include  "../config/db_info.php";
include  "../config/db_connect.php";
include  "../config/admin_info.php";
include  "../config/skin_info.php";
include  "../config/membercheck_info.php";
include  "../config/board_info.php";// 게시판 공통환경 모음
include  "../function/const_array.php";
include  "../function/kerrigancap_lib.php";
?>
<script src="../js/General.js"></script>
<?

$sql = "SELECT Name, Hand  , Url , Email , MPublic  FROM $MEMBER_TABLE_NAME WHERE ID = '$targetid'";
$list = _mysql_fetch_array($sql);

// 상대방 전화번호 
// 상대방 홈페이지
// 상대방 메일주소


unset($Message);
unset($goUrl);
if(!isAdmin()):
	
	if($list[MPublic] == "N"){// 정보 공개 거부
			$Message = "정보공개가 되어 있지 않습니다.";
	} else {	
		if(!$list[Url]) $Message = "홈페이지가 없습니다.";
	}	
		
else ://관리자 이지만 홈페이지가 없는경우는 메세지를 보여준다.
		if(!$list[Url]) $Message = "홈페이지가 없습니다.";
endif;


switch($Act){
	case "Memo" :							
							$goUrl = "void(open_memo('../$SKIN_FOLDER_NAME','write','$targetid'))" ;
							break ;
							
	case "Homepage" :
							if(!isAdmin()):							
							
								if($list[MPublic] == "N"){// 정보 공개 거부							
									$goUrl = "alert('정보공개가 되어 있지 않습니다.')" ; 
								} else {	
									if(!$list[Url]) $goUrl = "alert('홈페이지가 없습니다.')" ;
									else $goUrl = "goHomepage('http://$list[Url]')";
								}
								
							else ://관리자 이지만 홈페이지가 없는경우는 메세지를 보여준다.
								if(!$list[Url]) $goUrl = "alert('홈페이지가 없습니다.')" ;
								else $goUrl = "goHomepage('http://$list[Url]')";
							endif;							
							
							break ; 
	case "Mail" : $goUrl = "void(open_mail('../$SKIN_FOLDER_NAME','$list[Email]','$list[Name]'))" ; break ; 
	case "Sms" : $goUrl = "void(open_sms('../$SKIN_FOLDER_NAME','$list[Hand]'))" ; break ;   		
}


?>
<script>
<? echo $goUrl; ?>;	
</script>
