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

include  "./config/db_info.php";
include  "./config/db_connect.php";
include  "./config/admin_info.php";
include  "./config/skin_info.php";
include  "./config/membercheck_info.php";
include  "./config/board_info.php";// 게시판 공통환경 모음
include  "./function/const_array.php";
include  "./function/kerrigancap_lib.php";
include  "./function/filter.php";
if (file_exists("./config/brand_list.php")) include "./config/brand_list.php";// 브랜드/원산지


if ( !$GID || !$BID || !is_dir( "./${BOARD_FOLDER_NAME}/table/$GID/$BID"))
{
	js_alert_location("\\n\\n존재하지 않는 보드입니다.\\n\\n","-1");

}


$config_include_path = "./${BOARD_FOLDER_NAME}/table/$GID/$BID";


if(file_exists($config_include_path."/basic_config.php")) include $config_include_path."/basic_config.php";/* config1.php에는 보드 스킨과 아이콘 스킨의 정보가 들어갑니다. */
if(file_exists($config_include_path."/detail_config.php")) include $config_include_path."/detail_config.php";/* config5.php에는 회원관련 쓰기, 읽기 권한 파일 정보가 들어간다. */
include "./${BOARD_FOLDER_NAME}/func/MakeChannel.php"; //Channel 만드는 함수

/****[스킨은 다르지만 동일한 데이트를 사용할때, 즉 SameDB가 있을 때] *******/

if(!$SameDB){

	 $BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";
	 $UpdirPath = $GID."/".$BID;

}else{
	$BOARD_NAME="${DEFAULT_TABLE_NAME}_${SameDB}";
	$UpdirPath = $SameDB;
}

/****[확장DB사용시] *******/
if($ExtendDB && $ExtendDBUse=="checked")
$BOARD_NAME="$ExtendDB";
/******************************************************************************/

/****************** 본격적으로 본론 진입 ***********************/
if($INCLUDE_MALL_SKIN == "Y" ):/* Board에 스킨 인클루드 책크시 */

include "./config/skin_info.php";

if(file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php");

if(!$sysop || !$fm ){// 관리자 모드에서는 인클루드 Y 여도 보여 주지 않는다.

?>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php");
?>
<table width="884" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" align="center" valign="top"><?

include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php");
?></td>
    <td align="center" valign="top">
<!-- main menu start -->
 <?

}

/* Board에 스킨 인클루드 책크시 */
endif;


?>
 <?

if(!$sysop){

	if(is_file($config_include_path."/top.php")) include $config_include_path."/top.php";

} else{
	// 스타일쉬크만 불리
	echo "<link href='./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/style.css' rel='stylesheet' type='text/css'>";

}


if(!$TABLE_WIDTH) $TABLE_WIDTH = "100%";
if(!$TABLE_ALIGN) $TABLE_ALIGN = "DEFAULT";
?>
                        <table width="<?=$TABLE_WIDTH?>" border="0" cellpadding="0" cellspacing="0" align="<?=$TABLE_ALIGN?>">
                          <tr>
                            <td valign="top"><script src = "./js/BoardLayer.js"></script>
<?
switch ( $mode )
{
			case  "list"  :	// 리스트
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/list.php";
			break;

			case  "view"  : // 뷰
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/view.php";
			break;

			case  "write" : // 쓰기
			case  "reply" :
			case  "modify":
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/write.php";
			break;

			case  "delete": // 삭제(팝업이 아닌 메인프레임용)
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/delete.php";
			break;

			case  "multi": // 멀티뷰
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/multi_view.php";
			break;

			case  "modify_auth":// 비밀글,수정시 비번 입력
			case  "secret"  :
			include "./${BOARD_FOLDER_NAME}/login_secret.php";
			break;

			default :
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/list.php";
			break;
}
?>
                            </td>
                          </tr>
                        </table>
<?
if(!$sysop){
	if(file_exists($config_include_path."/bottom.php")){
	include $config_include_path."/bottom.php";
	}
}
?>
<?
if($INCLUDE_MALL_SKIN == "Y"):/* Board에 스킨 인클루드 책크시 */
	if(!$sysop || !$fm ){// 관리자 모드에서는 인클루드 Y 여도 보여 주지 않는다.
?>
                        <!-- main menu end -->
                      </td>
  </tr>
</table>
<?

if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
}
endif;
if(file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
?>

<!-- 개발내역 : SQL Injection 취약점은 게시판 모듈만 조치하면 되고 이번달 내에 조치할 예정임 -->