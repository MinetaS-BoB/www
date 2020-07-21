<?
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?
include "./config/db_info.php";
include "./config/db_connect.php";
include "./config/admin_info.php";
include "./config/skin_info.php";
include "./config/shopDisplay_info.php";
include "./config/cart_info.php";
include "./function/const_array.php";
include "./function/kerrigancap_lib.php";
if (file_exists("./config/brand_list.php")) include "./config/brand_list.php";


/*******************************************************************************
옵션값이 none이면 반드시 옵션선택
*******************************************************************************/
if(!strcmp($Option1, "none") || !strcmp($Option2, "none") || !strcmp($Option4, "none") ||!strcmp($Option5, "none") ){
js_alert_location("옵션을 선택해 주세요","-1");
}
/*******************************************************************************
CART파일의 생성시간을 구해서 2시간(mktime()기준 - 7200)이 경과된 경우 자동삭제..
*******************************************************************************/
$LOG_DIR = opendir("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers");
while($LOG_FILE = readdir($LOG_DIR)) {
	if($LOG_FILE !="." && $LOG_FILE !=".."){
	    if(file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$LOG_FILE") && mktime() - filemtime("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$LOG_FILE") > 7200) {
         unlink("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$LOG_FILE");
        }
	} //if($LOG_FILE !="." && $LOG_FILE !="..") 닫음
}
closedir($LOG_DIR);
/* $no|$BUYNUM|$GoodsPrice|$Option1|$Option4|$Option5 : 상품코드|갯수|가격|옵션1|옵션2|옵션4|옵션5|*/
/*********************************************************************************
다중선택 장바구니 담기일경우
*********************************************************************************/
if ($query == 'cmp') {
/* 장바구니 코드가 없을 경우 - 처음으로 장바구니에 담기할 경우 */
       if (!$_COOKIE[CART_CODE] || !file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")) {
                $CART_CODE = date("Ymdhis");  // 장바구니고유코드
                setcookie("CART_CODE","$CART_CODE",0,"/");
								$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$CART_CODE.cgi", "w");
								while (list($key,$value) = each($mall_chk)) :
											 //if(ereg("multi", $key)) :
										$BUYNUM = ${BUYNUM_.$key};
										$GoodsPrice = ${GoodsPrice_.$key};
										$GoodsPoint = ${GoodsPoint_.$key};
										/*
										$tmpvalue = OptionValueFnc($Option1, 1);#옵션가격이 동일할경우 2로변경한다.
										if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
										if($tmpvalue[1]) $Option1 = $tmpvalue[1];
										*/

										fwrite($fp, "$key|$BUYNUM|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
											 //endif;
								endwhile;

        for ($i=0;$i<sizeof($CART_DATA);$i++){
                fwrite($fp, chop($CART_DATA[$i])."\n");
        }
        fclose($fp);
        }
/* 이미 장바구니 코드가 존재할 경우 */
        else {
		        unset($CartDataTmp);
            while (list($key,$value) = each($mall_chk)) :
                     // if(ereg("multi", $key)) :/* multi일경우는 $GoodsPrice가 넘어 오지 않으므로 새로 db에서 가져와야 한다. */
					  $sqlstr = "select Price from {$MALL_TABLE_NAME} where UID = '$key'";
					  $sqlqry = mysql_query($sqlstr) or die(mysql_error());
					  $BUYNUM = ${BUYNUM_.$key};
					  $GoodsPrice = ${GoodsPrice_.$key};
						$GoodsPoint = ${GoodsPoint_.$key};
/* 현재 장바구니에 담겨있는지 여부를 책크후 담겨있으면 갯수만 올림 */


            $Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
						$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$CART_CODE.cgi", "w");
			                while ($Cart_Data_f = each($Cart_Data)) :
            			    $C_dat = explode("|", chop($Cart_Data_f[1]));
											//echo "\$C_dat[0] = $C_dat[0], \$no = $no <br>";
                        			if("$C_dat[0]" == "$key") { /* Multi의 경우는 옵션적용이 되지 않는다.*/
			                                $AddedNum = $BUYNUM + $C_dat[1];
																			/*
																			$tmpvalue = OptionValueFnc($Option1, 1);#옵션가격이 동일할경우 2로변경한다.
																			if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
																			if($tmpvalue[1]) $Option1 = $tmpvalue[1];
																			*/

            			                    fwrite($fp, "$key|$AddedNum|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
                       				} else {
            			                    fwrite($fp, chop($Cart_Data_f[1])."\n");
                        			}
			                endwhile;
            			    fclose($fp);

														if (!$AddedNum) { /* 만약 값이 업데이트 되지 않았다면, 즉 기존의 장바구니에 없던 제품이라면 배열에 일단 저장해 둔다.*/
																/*
																$tmpvalue = OptionValueFnc($Option1, 1);#옵션가격이 동일할경우 2로변경한다.
																if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
																if($tmpvalue[1]) $Option1 = $tmpvalue[1];
																*/

																$CartDataTmp .= "$key|$BUYNUM|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n";
																//echo "\$CartDataTmp = $CartDataTmp <br>";
														}
							/* 여기까지가 중복 여부 책크 하는데..*/
														 // endif;
       			 endwhile;
		                  $fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "a");
			                fwrite($fp, "$CartDataTmp");
            			    fclose($fp);
        }
		//exit; /* 테스트용 */
/* 어휴 긴 프로그램 여기서 끝 */
         echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
        exit;
}
/*********************************************************************************
하나씩 선택하여 장바구니 담기일경우
*********************************************************************************/
if (!strcmp($query,"cart_save")) { // 장바구니담기
        if (!$_COOKIE[CART_CODE] || !file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")) {
                $CART_CODE = date("Ymdhis");  // 장바구니고유코드
                setcookie("CART_CODE","$CART_CODE",0,"/");
                $fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$CART_CODE.cgi", "w");
								/*
								$tmpvalue = OptionValueFnc($Option1, 1);#옵션가격이 동일할경우 2로변경한다.
								if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
								if($tmpvalue[1]) $Option1 = $tmpvalue[1];
								*/

								fwrite($fp, "$no|$BUYNUM|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
								fclose($fp);
        } else {
                if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
									$Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
									$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "w");
									while ($Cart_Data_f = each($Cart_Data)) {
									$C_dat = explode("|", chop($Cart_Data_f[1]));
														if("$C_dat[0]^$C_dat[4]^$C_dat[5]^$C_dat[6]^$C_dat[7]" == "$no^$Option1^$Option2^$Option4^$Option5") {
																if(!strcmp($NoneDouble,"checked")) $AddedNum = $BUYNUM; /* 중복담기가 금지되어 있으면 */
																else $AddedNum = $BUYNUM + $C_dat[1];
																/*
																$tmpvalue = OptionValueFnc($Option1, 1);#옵션가격이 동일할경우 2로변경한다.
																if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
																if($tmpvalue[1]) $Option1 = $tmpvalue[1];
																*/

														fwrite($fp, "$no|$AddedNum|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
														}	else {
																	fwrite($fp, chop($Cart_Data_f[1])."\n");
														}
									}
									fclose($fp);
									if (!$AddedNum) {
											$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "a");
											/*
											$tmpvalue = OptionValueFnc($Option1, 1);#옵션가격이 동일할경우 2로변경한다.
											if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
											if($tmpvalue[1]) $Option1 = $tmpvalue[1];
											*/

											fwrite($fp, "$no|$BUYNUM|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
											fclose($fp);
									}
                }
        }

			if($sub_query)  echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF?query=step1'></HTML>";
			else  echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
			exit;
}
/*********************************************************************************
장바구니 택일삭제
*********************************************************************************/
if (!strcmp($query,"delete")){ // 장바구니 택일삭제
			if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
			$Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
			$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "w");
			while ($Cart_Data_f = each($Cart_Data)) {
			$C_dat = explode("|", chop($Cart_Data_f[1]));
					if("$C_dat[0]^$C_dat[4]^$C_dat[5]^$C_dat[6]^$C_dat[7]" != urldecode($value) ) {
									fwrite($fp, chop($Cart_Data_f[1])."\n");
					}
			}
			fclose($fp);
			}
			 echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
			 exit;
}
/*********************************************************************************
장바구니 택일수정
*********************************************************************************/
if (!strcmp($query,"modify")){ // 장바구니 택일수정
        if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
        $Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
        $fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "w");
        while ($Cart_Data_f = each($Cart_Data)) {
        $C_dat = explode("|", chop($Cart_Data_f[1]));
						if("$C_dat[0]^$C_dat[4]^$C_dat[5]^$C_dat[6]^$C_dat[7]" == urldecode($value) ) {
								fwrite($fp, "$C_dat[0]|$BUYNUM|$GoodsPrice|$GoodsPoint|$C_dat[4]|$C_dat[5]|$C_dat[6]|$C_dat[7]|$C_dat[8]|$C_dat[9]|$C_dat[10]|$C_dat[11]|$C_dat[12]|$C_dat[13]|$C_dat[14]||$C_dat[12]|$C_dat[13]|$C_dat[14]||$C_dat[12]|$C_dat[13]|$C_dat[14]|$C_dat[15]|$C_dat[16]|$C_dat[17]||$C_dat[18]|$C_dat[19]|$C_dat[20]|\n");
						}
						else {
								fwrite($fp, chop($Cart_Data_f[1])."\n");
						}
        }
        fclose($fp);
        }
         echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
         exit;
}
/*********************************************************************************
장바구니 비우기
*********************************************************************************/
if (!strcmp($query,"step4")){ // 장바구니 비우기
	if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
		unlink("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
	}
	  setcookie("CART_CODE","",0,"/");
}

if (!strcmp($query,"trash")){ // 장바구니 비우기
			if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
				unlink("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
				setcookie("CART_CODE","",0,"/");
			}
			if($goto){
				echo "<HTML><META http-equiv='refresh' content='0;url=$goto'></HTML>";
			}else{
				echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
			}
			exit;
}

/*********************************************************************************
결제하기 선택(step1)이고 회원로그인 상태이면 바로 결제방법선택(step2)로 넘어가고,
회원로그인 상태가 아니면 회원로그인 창으로 넘어간다.
*********************************************************************************/
if (!strcmp($query,"step1")){
		if (isMember() || !strcmp($NoneMemOnly,"checked")) {
		 echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF?query=step2'></HTML>";
		 exit;
		}
}

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
switch ( $query )
{
		case ( "cart_save" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_SAVE.php");
		break;
		case ( "step1" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_LOGIN.php");
		break;
		case ( "step2" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_WRITE.php");
		break;
		case ( "step3" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_FINISH.php");
		break;
		case ( "step4" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_QUERY_FINAL.php");
		break;
		case ( "cardchecking" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CARD_CHECKING.php");
		break;
		default :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_SAVE.php");
		break;
}
?>
</td>
  </tr>
</table>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
?>
