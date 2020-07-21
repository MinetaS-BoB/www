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
include "./config/cart_info.php";
include "./function/const_array.php";
include "./function/kerrigancap_lib.php";
if (file_exists("./config/brand_list.php")) include "./config/brand_list.php";// 브랜드/원산지

include "./function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$big_code = filter($big_code);
$code = filter($code);
$mid_code = filter($mid_code);
$no = filter($no);

// 사용자 정의 리스트 갯수를 쿠키로 굽는다.
$ListNo = "";
$ListMaxCnt = $_POST["ListMaxCnt"];

if($ListMaxCnt){
 $ListNo = $ListMaxCnt;
}else if($_COOKIE["ListMaxCnt"]){
$ListNo = $_COOKIE["ListMaxCnt"];
}else $ListNo = $SubListNo;
if($ListMaxCnt):
		setcookie("ListMaxCnt", $ListMaxCnt, 0 , "/");
endif;
//////////////////////////////////////////

if(!strcmp($query,"view")):

	if($_COOKIE["TODAY_PRODUCT"]){
		$TODAYCOOKIE = explode("|" , $_COOKIE[TODAY_PRODUCT]);

			if(in_array($no , $TODAYCOOKIE)){// no 값과 배열값이 일치 한건 쿠키를 구울 필요가 없다.

					$TODAYPRODUCT = $_COOKIE["TODAY_PRODUCT"];

			}else{

				$TODAYPRODUCT = $_COOKIE[TODAY_PRODUCT] .  $no . "|" ;
				setcookie("TODAY_PRODUCT", "$TODAYPRODUCT", time() + 60*60*24 ,"/");

			}

	}else{

		$TODAYPRODUCT = $no . "|" ;
		setcookie("TODAY_PRODUCT", "{$no}|", time() + 60*60*24 , "/");

	}

endif;

// 상품평 쓰기
if(!strcmp($mode,"Estimate_Write")):

	if($GoodsDisplayEstimStatus == "checked") $Display = "N";
	else $Display = "Y";
	$Subject = addslashes($Subject);
	$CONTENTS = addslashes($CONTENTS);
	$Option1 = addslashes($Option1);

	$WDate=time();
	$sql = "INSERT INTO ${EVALUATION_TABLE_NAME} (GID,ID , Name,Grade,Subject,Contents,IP, WDate , Display , Option1 ,  Sitekey )
	VALUES('$GID','$ID','$Name','$Grade','$Subject','$CONTENTS','$IP','$WDate' , '$Display' ,  '$Option1', '$SiteKey')";

	$result = mysql_query($sql);


	if($Display == "Y")	$Estimate_Message = "고객님의 상품평에 감사드립니다." ;
	else $Estimate_Message = "관리자의 승인후 고객님의 상품평이 표시됩니다." ;


	if($result){
		js_alert_location("$Estimate_Message","$PHP_SELF?query=view&code=$code&no=$GID#EVALU");
	}else{
		js_alert_location("DB 에러가 발생 했습니다.","-1");
	}

endif;

if(!strcmp($mode,"del")):

	$sql = "delete from ${EVALUATION_TABLE_NAME}  where UID = '$UID'";
	$result = mysql_query($sql);
	if($result){
		js_alert_location("성공적으로 삭제 되었습니다","$PHP_SELF?query=view&code=$code&no=$no#EVALU");
	}else{
		js_alert_location("DB 에러가 발생 했습니다.","-1");
	}

endif;


if (!$code && !$query && !$option3) {
		js_alert_location("잘못된 접근입니다. \\n 자세한 사항은 관리자에게 문의 주세요.","-1");
}


$big_code = substr($code,4);
$mid_code = substr($code, 2, 2);
$small_code = substr($code, 0, 2);


if($big_code > 0){
$Sqlstr = "SELECT  cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no='0000${big_code}' and cat_flag = 'M'";
$big_name = getSingleValue($Sqlstr);
$route = " > <a href='${MART_MAIN_FILE_NAME}?code=0000${big_code}'>".$big_name."</a>";
$title = $big_name;
}
if($mid_code > 0){
$Sqlstr = "SELECT  cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no='00${mid_code}${big_code}' and cat_flag = 'M'";
$mid_name = getSingleValue($Sqlstr);
$route .= " > <a href='${MART_MAIN_FILE_NAME}?code=00${mid_code}${big_code}'>".$mid_name."</a>";
$title = $mid_name;
}
if($small_code > 0){
$Sqlstr = "SELECT  cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no='${small_code}${mid_code}${big_code}' and cat_flag = 'M'";
$small_name = getSingleValue($Sqlstr);
$route .= " > <a href='${MART_MAIN_FILE_NAME}?code=${small_code}${mid_code}${big_code}'>".$small_name."</a>";
$title = $small_name;
}


//카테고리 매장 분류에서 사용자 정의가 되어있어면 아래와 같이 실행된다.
/* 1차 카테고리 스킨정의 */
$sqlstr = "select cat_skin, cat_skin_viewer from ${CATEGORY_TABLE_NAME} where cat_no < 100 AND cat_no LIKE '%{$big_code}' and cat_flag = 'M'";
$firstSkinList = _mysql_fetch_array($sqlstr);
$ShopSkinTmp = $firstSkinList[cat_skin];
$ShopSkinViewerTmp = $firstSkinList[cat_skin_viewer];
if($ShopSkinTmp) $ShopSkin = $ShopSkinTmp;
if($ShopSkinViewerTmp) $ViewerSkin = $ShopSkinViewerTmp;

/* 2차 카테고리 스킨정의 */
$sqlstr = "select cat_skin, cat_skin_viewer from ${CATEGORY_TABLE_NAME} where cat_no >= 100 AND cat_no < 10000 AND cat_no LIKE '%{$mid_code}${big_code}' and cat_flag = 'M'";
$secondSkinList = _mysql_fetch_array($sqlstr);
$ShopSkinTmp = $secondSkinList[cat_skin];
$ShopSkinViewerTmp = $secondSkinList[cat_skin_viewer];
if($ShopSkinTmp) $ShopSkin = $ShopSkinTmp;
if($ShopSkinViewerTmp) $ViewerSkin = $ShopSkinViewerTmp;

/* 정의된 shop-skin이 있으면 이것으로 skin을 바꾼다.*/
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

switch ( $query )
{
        case ( "view" ) :
        include ("${SKIN_FOLDER_NAME}/viewer/$ViewerSkin/view.php");
        break;
        case ( "cmp" ) ://비교하기
        include ("${SKIN_FOLDER_NAME}/shop/$ShopSkin/multi.php");
        break;
        default :
        include ("${SKIN_FOLDER_NAME}/shop/$ShopSkin/list.php");
}
?>
</td>
  </tr>
</table>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
?>
