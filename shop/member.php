<?
/*<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
/*
	mypage skin 분리 ${SKIN_FOLDER_NAME}/mypage/
	USER_POINT
	USER_MYPAGE
	USER_ORDER
	USER_ORDER_SPEC
	regis 와 info를 regis로 통합
	회원 수정시 (비번기입 query=auth)

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
if (file_exists("./config/brand_list.php")) include "./config/brand_list.php";// 브랜드/원산지

include "./function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$Name = filter($Name);
$Jumin1 = filter($Jumin1);
$Jumin2 = filter($Jumin2);
$ID = filter($ID);


$OrderName = trim($OrderName);
$OrderPWD = trim($OrderPWD);

###############################################################################################
# 비회원 조회시 쿠키 적용
###############################################################################################

if($query == "order" && $mode == "NonMemberCookie"){// 비회원 주문정보 확인시 아이디 비번 쿠키화
	$OrderCnt = getSingleValue("SELECT COUNT(*) as cnt FROM ${BUYER_TABLE_NAME} WHERE Sender_Name = '$OrderName' AND PWD = '$OrderPWD'");
	if($OrderCnt  > 0 ){
		setcookie("ORDER_NON_MEMBER_NAME", "$OrderName", 0, "/");
		setcookie("ORDER_NON_MEMBER_PWD", "$OrderPWD", 0, "/");
		js_location("./${MEMBER_MAIN_FILE_NAME}?query=order");
		exit;
	}else{
		js_alert_location("고객님의 구매내역이 존재하지 않습니다.","./${MEMBER_MAIN_FILE_NAME}?query=order");
		exit;
	}
}

/****************** 본격적으로 본론 진입 ***********************/

if(!strcmp($INCLUDE_MALL_SKIN,"Y")):/* ${MEMBER_FOLDER_NAME} 에 스킨 인클루드 책크시 */

if(!$TABLE_WIDTH) $TABLE_WIDTH = "100%";
if(!$TABLE_ALIGN) $TABLE_ALIGN = "DEFAULT";
?>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php");
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
/* ${MEMBER_FOLDER_NAME} 에 스킨 인클루드 책크시 */
endif;
?>
<?
if(file_exists("./config/MemberSkinTop.php")) include "./config/MemberSkinTop.php";
?>
            <table width="<?=$TABLE_WIDTH?>" border="0" cellpadding="0" cellspacing="0" align="<?=$TABLE_ALIGN?>">
              <tr>
                <td valign="top">
                  <?
/* 로그인 후 움직이는 페이지 */
unset($status); /* 로그인과 이후 혹은 query 값에 대한 다양한 결과가 요구되므로 $status의 상황에 따라 각각 행동 반경을 정한다. */
if (isMember()) {
			if ($query == 'point') {
							include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_POINT.php");
							$status = "point";
			}
			else if ($query == 'mypage') { // 마이페이지
							include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_MYPAGE.php");
							$status = "mypage" ;
			}
			else if ($query == 'order') {
							include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_ORDER.php");
							$status = "order";
			}
			else if ($query == 'regis') {
							include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_REGIS.php");
							$status = "regis";
			}
			else if ($query == 'auth') {// 회원정보수정시 패스워드 기입란.
							include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_AUTH.php");
							$status = "auth";
			}
			else if ($query == 'wish') {
							include ("./${SKIN_FOLDER_NAME}/wishList/$WishSkin/USER_WISH.php");
							$status = "wish";
			}
			else if ($query == 'out') {
							include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_OUT.php");
							$status = "out";
			}

}
/* 로그인 없이 갈 수 있는 페이지 */

		if (!strcmp($query,"passsearch") && !$status) {
            include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/IDPASS_SEARCH.php");
		}
		else if (!strcmp($query,"idsearch") && !$status) { /* 회원비밀번호확인란 */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/ID_SEARCH.php");
		}
		else if (!strcmp($query,"auth") && !$status) { /* 회원비밀번호확인란 */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_AUTH.php");
		}
		else if (!strcmp($query,"accept") && !$status) { /* 일반회원가입 */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_ACCEPT.php");
		}
		else if (!strcmp($query,"regis") && !$status) { /* 일반회원가입 */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_REGIS.php");
		}
		else if (!strcmp($query,"regis_complete") && !$status) { /* 일반회원가입 */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_REGIS_COMPLETE.php");
		}
		else if(!strcmp($query,"order")  && !$status && $_COOKIE[ORDER_NON_MEMBER_NAME] && $_COOKIE[ORDER_NON_MEMBER_PWD]) {/* 주문 상세 정보*/

						include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_ORDER.php");
		}
		else if(!strcmp($query,"order_detail")  && !$status) {/* 주문 상세 정보*/
						include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_ORDER_SPEC.php");
		}
		else if(!strcmp($query,"login") && !$status) {
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_LOGIN.php");
		}
		else if(!$status){
						// 상품 평이나 마트에서 넘어온값은 ReturnUrl을 다시 체크 하지 않는다.
						if(!ereg("$MART_MAIN_FILE_NAME",$ReturnUrl)) include "./function/member_check_module.php" ;
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_LOGIN.php");
		}

?>
                </td>
              </tr>
            </table>
            <!-- Main End -->
<?
if(file_exists("./config/MemberSkinBottom.php")) include "./config/MemberSkinBottom.php";
?>
<?
if(!strcmp($INCLUDE_MALL_SKIN,"Y")):/* ${MEMBER_FOLDER_NAME}에 스킨 인클루드 책크시 */
?>
          </td>
  </tr>
</table>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
if(file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
/* ${MEMBER_FOLDER_NAME} 에 스킨 인클루드 책크시 */
endif;

?>
