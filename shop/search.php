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

include "./config/db_info.php";
include "./config/db_connect.php";
include "./config/admin_info.php";
include "./config/skin_info.php";
include "./config/shopDisplay_info.php";
include "./config/membercheck_info.php";
include "./config/cart_info.php";
include "./function/const_array.php";
include "./function/kerrigancap_lib.php";

include "./function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$keyword = filter($keyword);

if (file_exists("./config/brand_list.php")) include "./config/brand_list.php";// 브랜드/원산지
?>
<?
if(file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php");
?>
<table width="884" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" align="center" valign="top">
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php");
?></td>
    <td align="center" valign="top">

<?
		if ( !$cat ) { $search_from = "all"; }
		if ( $query == 'search') include  ("${SKIN_FOLDER_NAME}/search/$SearchSkin/result.php");

?>

</td>
  </tr>
</table>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
?>
