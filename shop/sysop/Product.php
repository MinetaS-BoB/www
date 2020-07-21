<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
/*

*/
######################################################################
#				Written by kerrigancap
#				Copyright kerrigancap.pe.kr
#				Date 2006 . 04
######################################################################
/*
2006/03/29
DetailPicture 필드 추가 상세페이지에서 상품정보 부분을 이미지처리
Status 필드 추가 Y(상품 표시) , N(상품 표시X) , T(휴지통 => 관리자 모드에서 삭제시 결제단의 에러를 최소화 시키기 위해)
품절부분과는 별도로 상품 표시 여부를 판단 해줄경우 쓰임..
Back 이 있으면 $Back으로 넘어 가주고 아니면 ProductList로 넘어 간다
2006/06/08
Price/Point 부분을 회원등급별 차등가격으로 인해 필드 변경 (tinytext)
전부 배열처리

2006/08/02
MERCHANT_ID 추가 (입점 아이디) => 공급업체와는 다름(실제 물건을 올리는 고유 아이디 SiteKey의 세분화)
PID => 다중 카테고리
CID => 관련상품 아이디


*/


include "./ROOT_CHECK.php";
include_once "../config/shopDisplay_info.php";
$tmparr = array("Option1", "Option2", "Option4", "Option5", "Size","Color");

if(!$mode)	$send_img = "./img/btn_set/btn_complete_02.gif";
else $send_img = "./img/btn_set/btn_modify_03.gif";

if($Back){// 다른 리스트 페이지에서 넘오온경우는 그쪽으로 Back
	$BackUrl = "$PHP_SELF?menushow=$menushow&THEME=$Back&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword";
}else{
	$BackUrl = "$PHP_SELF?menushow=$menushow&THEME=ProductList&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword";
}


if ($action == 'delete') {   //추가 사진 삭제옵션시 실행

	$VIEW_QUERY = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID='$uid'";
	$LIST = mysql_fetch_array(mysql_query($VIEW_QUERY, $DB_CONNECT));

	 if (file_exists("../${STOCK_FOLDER_NAME}/$del_Picture")) {
			 unlink("../${STOCK_FOLDER_NAME}/$del_Picture");
	 }

	$rePicture = str_replace($del_Picture , "" , $LIST[Picture]);


	$sql = "update ${MALL_TABLE_NAME} set Picture='$rePicture' where UID='$uid' ";
	$result = mysql_query($sql, $DB_CONNECT ) or die(mysql_error());
	if($result) {
		js_alert_location("이미지가 삭제 되었습니다","$PHP_SELF?menushow=$menushow&THEME=$THEME&uid=$uid&mode=modify&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword&Back=$Back");
	} else{
		js_alert_location("DB 작업중 에러가 발생 했습니다","-1");
	}


}


if ($action == 'delete2') {   //제품 설명 이미지 삭제

	$VIEW_QUERY = "SELECT DetailPicture FROM ${MALL_TABLE_NAME} WHERE UID='$uid'";
	$LIST = mysql_fetch_array(mysql_query($VIEW_QUERY, $DB_CONNECT));

	 if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$del_Picture")) {
			 unlink("../${STOCK_FOLDER_NAME}/product_detail/$del_Picture");
	 }

	$rePicture = str_replace($del_Picture , "" , $LIST[DetailPicture]);


	$sql = "update ${MALL_TABLE_NAME} set DetailPicture='$rePicture' where UID='$uid' ";
	$result = mysql_query($sql, $DB_CONNECT ) or die(mysql_error());
	if($result) {
		js_alert_location("이미지가 삭제 되었습니다","$PHP_SELF?menushow=$menushow&THEME=$THEME&uid=$uid&mode=modify&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword&Back=$Back");
	} else{
		js_alert_location("DB 작업중 에러가 발생 했습니다","-1");
	}

}



if ($action == 'writedata') {

		if($Category3) $Category = $Category3;
		else if($Category2) $Category = $Category2;
		else if($Category1) $Category = $Category1;
		else js_alert_location("카테고리가 설정되지 않았습니다.","-1");


		$Name = addslashes(trim($Name));
		$Size = addslashes(trim($Size));
		$Color = addslashes(trim($Color));
		$Model = addslashes(trim($Model));
		$CompName = addslashes(trim($CompName));
		$GetComp = addslashes(trim($GetComp));
		$CID = $TmpCID;// 관련상품

		// 가격
		$InputPrice = "";
		if(is_array($Price)){
			$InputPrice = implode("|" , $Price);
		}


		$InputPoint = "";
		if($POINTSTATUS == "checked"){ // 포인트 일률 적용시

			if(is_array($Price)){
				for($i = 0 ; $i < sizeof($Price) ; $i++){
					$InputPoint .=  $Price[$i] * ($POINTRATE/100) . "|";
				}

			}

			$InputPoint = substr($InputPont , 0 , -1);


		}else{// 일률 적용이 아닌 하나씩 입력시
			if(is_array($Point)){
				$InputPoint = implode("|" , $Point);
			}

		}


		//옵션 상품.
		$InputOption3 = "" ;
		for($i = 0 ; $i < sizeof($Option3) ; $i++){
			$InputOption3 .= $Option3[$i]. "|";
		}


    if($TextType1 == "checked") {$Description1 = addslashes( trim($Description1) );}
        else {$Description1 = htmlspecialchars($Description1);}
		if($TextType2 == "checked") {$Description2 = addslashes( trim($Description2) );}
        else {$Description2 = htmlspecialchars($Description2);}

		$SDay1 = explode("-" , $SDay);
		$WDate = mktime(0,0,0,$SDay1[1],$SDay1[2],$SDay1[0]);


/* 파일 업로딩 시작 */
unset($Picture);
/*
for($i=0; $i<sizeof($file); $i++){
	echo 'aa:';
	echo $file_name[$i];
	if($file[$i]!="none" && $file[$i]){
		echo "\$file_name[$i] = $file_name[$i] <br>";
		//$file_name[$i]=time();
    	if (file_exists("../${STOCK_FOLDER_NAME}/$file_name[$i]")) {
	    $file_name[$i] = time()."_$file_name[$i]";
    	}
	    if(!move_uploaded_file($file[$i], "../${STOCK_FOLDER_NAME}/$file_name[$i]")) {
    	echo "파일 업로드에 실패 하였습니다.";
	    exit;}
	}
	$Picture .=$file_name[$i]."|";
}
*/
$file = $_FILES["file0"]["tmp_name"];
$file_name = $_FILES["file0"]["name"];
if($file!="none" && $file){
	//echo "\$file_name = $file_name <br>";
	//$file_name[$i]=time();
	if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
	$file_name[$i] = time()."_$file_name";
	}
	if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
	echo "파일 업로드에 실패 하였습니다.";
	exit;}
}
$Picture .=$file_name."|";

$file = $_FILES["file1"]["tmp_name"];
$file_name = $_FILES["file1"]["name"];
if($file!="none" && $file){
	//echo "\$file_name = $file_name <br>";
	//$file_name[$i]=time();
	if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
	$file_name[$i] = time()."_$file_name";
	}
	if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
	echo "파일 업로드에 실패 하였습니다.";
	exit;}
}
$Picture .=$file_name."|";

$file = $_FILES["file2"]["tmp_name"];
$file_name = $_FILES["file2"]["name"];
if($file!="none" && $file){
	//echo "\$file_name = $file_name <br>";
	//$file_name[$i]=time();
	if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
	$file_name[$i] = time()."_$file_name";
	}
	if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
	echo "파일 업로드에 실패 하였습니다.";
	exit;}
}
$Picture .=$file_name."|";

unset($DetailPicture);//상세 설명 이미지
/*
for($i=0; $i<sizeof($file1); $i++){
	if($file1[$i]!="none" && $file1[$i]){
    	if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$file1_name[$i]")) {
	    $file1_name[$i] = time()."_$file1_name[$i]";

    	}
	    if(!move_uploaded_file($file1[$i], "../${STOCK_FOLDER_NAME}/product_detail/$file1_name[$i]")) {
    	echo "파일 업로드에 실패 하였습니다.";
	    exit;}
	$DetailPicture .=$file1_name[$i]."|";
	}
}
*/
$file1 = $_FILES["file10"]["tmp_name"];
$file1_name = $_FILES["file10"]["name"];
if($file1!="none" && $file1){
	if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$file1_name")) {
	$file1_name = time()."_$file1_name";

	}
	if(!move_uploaded_file($file1, "../${STOCK_FOLDER_NAME}/product_detail/$file1_name")) {
	echo "파일 업로드에 실패 하였습니다.";
	exit;}
$DetailPicture .=$file1_name."|";
}

if($Status !="Y") $Status = "N";

#옵션필드명 정의

$STRING = "<?";
$i=0;
foreach($OptionNameTmp as $key => $value){
		$STRING .= "
		\$OptionName[${tmparr[$i]}][0] = \"${OptionNameTmp[$i]}\";
		\$OptionName[${tmparr[$i]}][1] = \"${OptionPropertyTmp[$i]}\";
		";
	$i++;
}
$STRING .="?>";
$fp = fopen("../config/OptionName.php", "w");
fwrite($fp, "$STRING");
fclose($fp);


if(!$InputPrice) $InputPrice = 0;
if(!$InputPoint) $InputPoint = 0;


/* 파일 업로딩 끝 */
	$QUERY1 = "INSERT INTO ${MALL_TABLE_NAME} (
						 MERCHANT_ID , PID,Name,Brand,CompName,Price,Price1,Point,Model,Size,Color,Option1,Option2,Option3,Option4,Option5,
						 Picture,DetailPicture,None,Input,Output,Stock,WDate,Description1,Description2,Category,CID ,
						 TextType1,TextType2,Hit,GetComp,MainDisplay,Ranking,Status , SiteKey
						 ) VALUES (
						 '$MERCHANT_ID', '$PID','$Name','$Brand','$CompName','$InputPrice','$Price1','$InputPoint','$Model','$Size','$Color','$Option1','$Option2','$InputOption3',
						 '$Option4','$Option5','$Picture','$DetailPicture','$None','$Input','$Output','$Stock','$WDate','$Description1','$Description2','$Category','$CID' ,
						 '$TextType1','$TextType2', '$Hit','$GetComp','$MainDisplay','$Ranking','$Status' , '$SiteKey')";
	$result = mysql_query($QUERY1,$DB_CONNECT) or die(mysql_error());

	$PID = mysql_insert_id();

	$sql = "update ${MALL_TABLE_NAME} set PID = '$PID' where UID = '$PID' ";
	mysql_query($sql);
//옵션파일명 저장


// 다중 카테고리 작업
$MultiCategoryArr = explode("|", $TmpMultiCategoryvalue);
$MultiCategoryArr = array_unique($MultiCategoryArr); // 중복값 제거

for($i=0; $i < sizeof($MultiCategoryArr) && $MultiCategoryArr[$i] ; $i++){
	if($MultiCategoryArr[$i]){
		$sqlstr = "INSERT INTO ${MALL_TABLE_NAME} (
							 MERCHANT_ID , PID,Name,Brand,CompName,Price,Price1,Point,Model,Size,Color,Option1,Option2,Option4,Option5,
							 Picture,DetailPicture,None,Input,Output,Stock,WDate,Description1,Description2,Category,CID ,
							 TextType1,TextType2,Hit,GetComp,MainDisplay,Ranking,Status , SiteKey
							 ) VALUES (
							 '$MERCHANT_ID', '$PID','$Name','$Brand','$CompName','$InputPrice','$Price1','$InputPoint','$Model','$Size','$Color','$Option1','$Option2',
							 '$Option4','$Option5','$Picture','$DetailPicture','$None','$Input','$Output','$Stock','$WDate','$Description1','$Description2','$MultiCategoryArr[$i]','$CID' ,
							 '$TextType1','$TextType2', '$Hit','$GetComp','$MainDisplay','$Ranking','$Status' , '$SiteKey')";
							 $sqlqry = mysql_query($sqlstr) or die(mysql_error());
	}
}

	if($result){
		js_alert_location("성공적으로 저장 되었습니다.","$PHP_SELF?menushow=$menushow&THEME=ProductList&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword&Back=$Back");
	}else{
		js_alert_location("DB 작업중 에러가 발생하였습니다.","$PHP_SELF?menushow=$menushow&THEME=ProductList&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword&Back=$Back");
	}

}


if($bmode == "modify"){


	if($Category3) $Category = $Category3;
	else if($Category2) $Category = $Category2;
	else if($Category1) $Category = $Category1;
	else js_alert_location("카테고리가 설정되지 않았습니다.","-1");

	$Name = addslashes(trim($Name));
	$Size = addslashes(trim($Size));
	$Color = addslashes(trim($Color));
	$Model = addslashes(trim($Model));
	$CompName = addslashes(trim($CompName));
	$GetComp = addslashes(trim($GetComp));
	$Category = trim($Category);
	$CID = $TmpCID;// 관련상품

	//옵션 상품.
	$InputOption3 = "" ;
	for($i = 0 ; $i < sizeof($Option3) ; $i++){
		$InputOption3 .= $Option3[$i]. "|";
	}
	// 가격
	$InputPrice = "";
	if(is_array($Price)){
		$InputPrice = implode("|" , $Price);
	}


	$InputPoint = "";
	if($POINTSTATUS == "checked"){ // 포인트 일률 적용시

		if(is_array($Price)){
			for($i = 0 ; $i < sizeof($Price) ; $i++){
				$InputPoint .=  $Price[$i] * ($POINTRATE/100) . "|";
			}

		}

		$InputPoint = substr($InputPont , 0 , -1);


	}else{// 일률 적용이 아닌 하나씩 입력시
		if(is_array($Point)){
			$InputPoint = implode("|" , $Point);
		}

	}



	if($TextType1 == "checked") {$Description1 = addslashes( trim($Description1) );}
	else {$Description1 = htmlspecialchars($Description1);}

	if($TextType2 == "checked") {$Description2 = addslashes( trim($Description2) );}
	else {$Description2 = htmlspecialchars($Description2);}


	//$SDay1 = explode("-" , $SDay);
	//$WDate = mktime(0,0,0,$SDay1[1],$SDay1[2],$SDay1[0]);


	$PicValue = getSingleValue("select Picture from ${MALL_TABLE_NAME} WHERE UID='$uid'");
	$PicList = explode("|", $PicValue);
	/* 파일 업로딩 시작 */
	unset($Picture);
	/*
	for($i=0; $i < sizeof($file); $i++){
		$MicroTsmp = split(" ",microtime());
		$newFileName = str_replace(".", "", $MicroTsmp[0]);
		if($file[$i]!="none" && $file[$i]){
			$extention = strrchr($file_name[$i], ".");
			$file_name[$i] = time()."".$extention;
			if($PicList[$i]) unlink("../${STOCK_FOLDER_NAME}/$PicList[$i]");
			if (file_exists("../${STOCK_FOLDER_NAME}/$file_name[$i]")) {
			$file_name[$i] = $newFileName."_$file_name[$i]";
			}
			if(!move_uploaded_file($file[$i], "../${STOCK_FOLDER_NAME}/$file_name[$i]")) {
				js_alert_location("파일 업로드에 실패 하였습니다.","-1");
			}
		$UPDIR[$i]=$file_name[$i];
		}else $UPDIR[$i]=$PicList[$i];
	$Picture .=$UPDIR[$i]."|";
	}
	*/

	$file = $_FILES["file0"]["tmp_name"];
	$file_name = $_FILES["file0"]["name"];
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file!="none" && $file){
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		if($PicList[0]) unlink("../${STOCK_FOLDER_NAME}/$PicList[0]");
		if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
		$file_name = $newFileName."_$file_name";
		}
		if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
			js_alert_location("파일 업로드에 실패 하였습니다.","-1");
		}
	$UPDIR[0]=$file_name;
	}else $UPDIR[0]=$PicList[0];
	$Picture .=$UPDIR[0]."|";


	$file = $_FILES["file1"]["tmp_name"];
	$file_name = $_FILES["file1"]["name"];
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file!="none" && $file){
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		if($PicList[1]) unlink("../${STOCK_FOLDER_NAME}/$PicList[1]");
		if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
		$file_name = $newFileName."_$file_name";
		}
		if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
			js_alert_location("파일 업로드에 실패 하였습니다.","-1");
		}
	$UPDIR[1]=$file_name;
	}else $UPDIR[1]=$PicList[1];
	$Picture .=$UPDIR[1]."|";

	$file = $_FILES["file2"]["tmp_name"];
	$file_name = $_FILES["file2"]["name"];
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file!="none" && $file){
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		if($PicList[2]) unlink("../${STOCK_FOLDER_NAME}/$PicList[2]");
		if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
		$file_name = $newFileName."_$file_name";
		}
		if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
			js_alert_location("파일 업로드에 실패 하였습니다.","-1");
		}
	$UPDIR[2]=$file_name;
	}else $UPDIR[2]=$PicList[2];
	$Picture .=$UPDIR[2]."|";


// 상품 정보 이미지

	$PicValue2 = getSingleValue("select DetailPicture from ${MALL_TABLE_NAME} WHERE UID='$uid'");
	$PicList2 = explode("|", $PicValue2);
	/* 파일 업로딩 시작 */
	unset($DetailPicture);
	/*
	for($i=0; $i < sizeof($file1); $i++){
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
		if($file1[$i]!="none" && $file1[$i]){
			$extention = strrchr($file1_name[$i], ".");
			$file1_name[$i] = time()."".$extention;
			if($PicList2[$i]) unlink("../${STOCK_FOLDER_NAME}/product_detail/$PicList2[$i]");
			if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$file1_name[$i]")) {
			$file1_name[$i] = $newFileName."_$file1_name[$i]";
			}
			if(!move_uploaded_file($file1[$i], "../${STOCK_FOLDER_NAME}/product_detail/$file1_name[$i]")) {
				js_alert_location("파일 업로드에 실패 하였습니다.","-1");
			}
		$UPDIR2[$i]=$file1_name[$i];
		}else $UPDIR2[$i]=$PicList2[$i];
	$DetailPicture .=$UPDIR2[$i]."|";
	}
	*/

	$file1 = $_FILES["file10"]["tmp_name"];
	$file1_name = $_FILES["file10"]["name"];
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file1!="none" && $file1){
		$extention = strrchr($file1_name, ".");
		$file1_name = time()."".$extention;
		if($PicList2[0]) unlink("../${STOCK_FOLDER_NAME}/product_detail/$PicList2[0]");
		if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$file1_name")) {
		$file1_name = $newFileName."_$file1_name";
		}
		if(!move_uploaded_file($file1, "../${STOCK_FOLDER_NAME}/product_detail/$file1_name")) {
			js_alert_location("파일 업로드에 실패 하였습니다.","-1");
		}
	$UPDIR2[0]=$file1_name;
	}else $UPDIR2[0]=$PicList2[0];
	$DetailPicture .=$UPDIR2[0]."|";


if($Status !="Y") $Status = "N";
#옵션필드명 정의

$cnt = 0;

$STRING = "<?";
$i=0;
foreach($OptionNameTmp as $key => $value){
		$STRING .= "
		\$OptionName[${tmparr[$i]}][0] = \"${OptionNameTmp[$i]}\";
		\$OptionName[${tmparr[$i]}][1] = \"${OptionPropertyTmp[$i]}\";
		";
	$i++;
}
$STRING .="?>";
$fp = fopen("../config/OptionName.php", "w");
fwrite($fp, "$STRING");
fclose($fp);


if(!$InputPrice) $InputPrice = 0;
if(!$InputPoint) $InputPoint = 0;


$sql = "UPDATE ${MALL_TABLE_NAME} SET
MERCHANT_ID = '$MERCHANT_ID' ,
PID  = '$uid' ,
Name  = '$Name' ,
Brand  = '$Brand' ,
CompName  = '$CompName' ,
Price  = '$InputPrice' ,
Price1  = '$Price1' ,
Point  = '$InputPoint' ,
Model  = '$Model' ,
Size  = '$Size' ,
Color  = '$Color' ,
Option1  = '$Option1' ,
Option2  = '$Option2' ,
Option3  = '$InputOption3' ,
Option4  = '$Option4' ,
Option5  = '$Option5' ,
Picture  = '$Picture' ,
DetailPicture  = '$DetailPicture' ,
None  = '$None' ,
Input  = '$Input' ,
WDate  = '$WDate' ,
Description1  = '$Description1' ,
Description2  = '$Description2' ,
Category  = '$Category' ,
CID = '$CID' ,
TextType1  = '$TextType1' ,
TextType2  = '$TextType2' ,
GetComp  = '$GetComp' ,
MainDisplay  = '$MainDisplay' ,
Ranking  = '$Ranking' ,
Status = '$Status'
WHERE UID='$uid'";
$result = mysql_query($sql,$DB_CONNECT) or die(mysql_error());


/* MultiCategory 가 있을 경우 기존 카테고리는 삭제하고 새로 추가 한다. 또한 Option3은 insert하지 않는다. */
$sqlstr = "delete from ${MALL_TABLE_NAME} where PID <> '' and PID = '$uid' and PID <> UID";
$sqlqry = mysql_query($sqlstr) or die(mysql_error());
$MultiCategoryArr = explode("|", $TmpMultiCategoryvalue);
$MultiCategoryArr = array_unique($MultiCategoryArr); // 중복값 제거
for($i=0; $i < sizeof($MultiCategoryArr) && $MultiCategoryArr[$i] ; $i++){
	if($MultiCategoryArr[$i]){
		$sqlstr = "INSERT INTO ${MALL_TABLE_NAME} (
							 MERCHANT_ID , PID,Name,Brand,CompName,Price,Price1,Point,Model,Size,Color,Option1,Option2,Option4,Option5,
							 Picture,DetailPicture,None,Input,Output,Stock,WDate,Description1,Description2,Category,CID ,
							 TextType1,TextType2,Hit,GetComp,MainDisplay,Ranking,Status , SiteKey
							 ) VALUES(
							 '$MERCHANT_ID', '$uid','$Name','$Brand','$CompName','$InputPrice','$Price1','$InputPoint','$Model','$Size','$Color','$Option1','$Option2',
							 '$Option4','$Option5','$Picture','$DetailPicture','$None','$Input','$Output','$Stock','$WDate','$Description1','$Description2','$MultiCategoryArr[$i]','$CID' ,
							 '$TextType1','$TextType2', '$Hit','$GetComp','$MainDisplay','$Ranking','$Status' , '$SiteKey')";
							 $sqlqry = mysql_query($sqlstr) or die(mysql_error());
	}
}
/* MultiCategory 끝 */



if($result) {
	if($Back) js_alert_location("수정 되었습니다.","$PHP_SELF?menushow=$menushow&THEME=$Back&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword");
	else 	js_alert_location("수정 되었습니다.","$PHP_SELF?menushow=$menushow&THEME=ProductList&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword");
} else{
	js_alert_location("DB 작업중 에러가 발생 했습니다","-1");

}


}


if($mode == "modify") { // 디스플레이

	$sqlstr = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID='$uid'";
	$list = mysql_fetch_array(mysql_query($sqlstr, $DB_CONNECT));
	$list[Name] = stripslashes($list[Name]);
	$list[CompName] = stripslashes($list[CompName]);
	$list[Description1] = stripslashes($list[Description1]);
	$list[Description2] = stripslashes($list[Description2]);
	$list[Model] = stripslashes($list[Model]);
	$Picture = explode("|",$list[Picture]);
	$DetailPicture = explode("|",$list[DetailPicture]);
	$list[Option2] = stripslashes($list[Option2]);
	$list[Size] = stripslashes($list[Size]);
	$list[PID] = stripslashes($list[PID]);
	$Price = explode("|",$list[Price]);// 가격 배열처리
	$Point = explode("|",$list[Point]);// 포인트 배열처리


}
?>


<script language=javascript>
<!--
function checkForm(f) {

	var MultiCategorylen = f.TmpMultiCategory.length;
	var TmpMultivalue = '';
	for(var i=0; i< MultiCategorylen; i++){
	if(f.TmpMultiCategory.options[i]) TmpMultivalue += f.TmpMultiCategory.options[i].value + '|';
	}
	f.TmpMultiCategoryvalue.value = TmpMultivalue;

	var CIDlen = f.CID.length;
	var TmpCIDValue = '';
	for(var i=0; i< CIDlen; i++){
	if(f.CID.options[i]) TmpCIDValue += f.CID.options[i].value + '|';
	}
	f.TmpCID.value = TmpCIDValue;

checkenable = new Array();
    if(f.checkenable){
    var checkenablelen = f.checkenable.length
        for (i = 0; i < checkenablelen; i++){
            if(f.checkenable[i].value == ""){
            alert(f.checkenable[i].title);
            f.checkenable[i].focus();
            return false;
            }
        }
        if(!checkenablelen && f.checkenable.value == ""){
        alert(f.checkenable.title);
        f.checkenable.focus();
        return false;
        }
    }

}

//-->
</script>
<script>
<!--


function MultiCategorySelect(selObj){
	var f=document.WriteForm
	var aIdx=f.TmpMultiCategory.options.length;
	var str=selObj.options[selObj.selectedIndex].text;

	if(aIdx){
		for(i=0; i<aIdx; i++){
			if(f.TmpMultiCategory.options[i].value == selObj.options[selObj.selectedIndex].value){
				alert('동일카테고리가 선택되었습니다.');
				return false;
			}

		}
	}

	if(selObj.options[selObj.selectedIndex].value != ""){

		var itm= new Option(str)
		if(aIdx >= 10){
			window.alert('10개이상 카테고리 적용은 불가능합니다.');
			return false;
		}
		f.TmpMultiCategory.options[aIdx] = itm;
		f.TmpMultiCategory.options[aIdx].value = selObj.options[selObj.selectedIndex].value

	}

}

function DeleteMultiCat(sel){
	if(sel.selectedIndex == "-1" ){
		alert("삭제하고자 항목을 선택해주세요");
		return;
	} else {
		var selectedIndexNo = sel.selectedIndex;
		sel.options[sel.selectedIndex] = null;
	}
}
function DeleteRelative(sel){
	if(sel.selectedIndex == "-1" ){
		alert("삭제하고자 항목을 선택해주세요");
		return;
	} else {
		var selectedIndexNo = sel.selectedIndex;
		sel.options[sel.selectedIndex] = null;
	}
}


function addToPIC()
{

	nameToDiv.insertAdjacentElement("BeforeEnd",document.createElement("<INPUT type='file' name='file[]'  size = 30>"));
	nameToDiv.insertAdjacentElement("BeforeEnd",document.createElement("<br>"));
}

function del(obj,no)// 상품 이미지 삭제
{
	location.href = "<? echo $_SERVER[PHP_SELF]; ?>?menushow=<? echo $menushow;?>&THEME=<? echo $THEME; ?>&uid="+no+"&action=delete"+ "&del_Picture=" + obj + "&sort=<? echo $sort ;?>&sort1=<? echo $sort1 ;?>&sort2=<? echo $sort2 ;?>&sorting=<? echo $sorting ;?>&OptionList=<? echo $OptionList ;?>&CURRENT_PAGE=<? echo $CURRENT_PAGE ;?>&keyword=<? echo $keyword ;?>&Back=<? echo $Back; ?>" ;
}
function del2(obj,no)// 상품 설명 이미지 삭제
{
	location.href = "<? echo $_SERVER[PHP_SELF]; ?>?menushow=<? echo $menushow;?>&THEME=<? echo $THEME; ?>&uid="+no+"&action=delete2"+ "&del_Picture=" + obj + "&sort=<? echo $sort ;?>&sort1=<? echo $sort1 ;?>&sort2=<? echo $sort2 ;?>&sorting=<? echo $sorting ;?>&OptionList=<? echo $OptionList ;?>&CURRENT_PAGE=<? echo $CURRENT_PAGE ;?>&keyword=<? echo $keyword ;?>&Back=<? echo $Back; ?>" ;
}


function getCategory(step,f,flag){
	form = f.form.name;
	dynamic.src = "./SubCategory.php?step="+step+"&trigger="+f.value+"&form="+form+"&flag="+flag;
}

-->
</script>
<script language="Javascript1.2" >
<!-- // load htmlarea
_editor_url = "../js/HtmlArea/";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// -->
</script>
<script language="javascript" src = "../js/Calandar.js"></script>
<script language="javascript" src="../js/General.js"></script>
<script id="dynamic"></script>
<table width="747" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> <table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr>
          <td align="center" <? echo $CONTENT_STYLE; ?>><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30" class="black_16"><strong><font color="#3366CC">제품등록</font></strong></td>
              </tr>
              <tr>
                <td>제품을 카테고리에 맞게 분류하여 등록 및 수정 하십시오.<br>
                  카테고리를 지정하실 때에는 가장 하위 카테고리에 등록해 주시기 바랍니다.<br>
                  <strong><font color="C15B27">다중 카테고리적용시 같은 카테고리를 여러개 등록 하셔도
                  하나의 카테고리만 적용됩니다.<br>
                  다중 카테고리에 포함된 상품은 등록 옵션은 입력되지 않습니다.</font></strong></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td <? echo $TITLE_STYLE ; ?> height = 30 >*필수 입력 사항</td>
  </tr>
<form method='post' enctype='multipart/form-data' NAME='WriteForm' action='<? echo $PHP_SELF; ?>' onsubmit='return checkForm(this);'>
<INPUT type=hidden name='mode' value='<? echo $mode;?>'>
<?
if($list[UID]){
$mode = "modify";
?>
<INPUT type=hidden name='bmode' value='<? echo $mode;?>'>
<? }else{?>
<INPUT type=hidden name='action' value='writedata'>
<? } ?>
<INPUT type=hidden name='uid' value='<? echo $uid;?>'>
<INPUT type=hidden name= menushow value=<? echo $menushow; ?>>
<INPUT type=hidden name=THEME value=<? echo $THEME;?>>
<INPUT type=hidden name='Back' value='<?=$Back?>'><!-- 기존 페이지로 점프하기 위한 플래그 -->
<INPUT type=hidden name='keyword' value='<?=$keyword?>'>
<INPUT type=hidden name='OPTI_LIST' value='<?=$OPTI_LIST?>'>
<INPUT type=hidden name='sort' value='<?=$sort?>'>
<INPUT type=hidden name='sort1' value='<?=$sort1?>'>
<INPUT type=hidden name='sort2' value='<?=$sort2?>'>
<INPUT type=hidden name='sorting' value='<?=$sorting?>'>
<INPUT type=hidden name='CURRENT_PAGE' value='<?=$CURRENT_PAGE?>'>
<INPUT type=hidden id='TmpMultiCategoryvalue' name='TmpMultiCategoryvalue' value=''>
<INPUT type=hidden id='TmpCID' name='TmpCID' value=''>

    <tr>
      <td> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> *카테고리</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp;
							<select name="Category1" onChange="getCategory('1', this, 'M')" id = "checkenable" title = "카테고리를 설정해주십시요" style="width:130px">
							<option value="" selected style = "background-color:red;color:white">대분류 </option>
							<?
								$sqlstr = "SELECT cat_no, cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no < 100 and cat_flag = 'M' ORDER BY cat_no ASC";
								$sqlqry = mysql_query($sqlstr);
								while($LIST=@mysql_fetch_array($sqlqry)):
								if($LIST[cat_no] == "0000" . substr($list[Category],-2) ) $selected  = " selected" ; else $selected = "" ;
								echo"<option value='$LIST[cat_no]' ${selected}>$LIST[cat_name]</option> \n";
								endwhile;

							?>
							</select> <select name="Category2" onChange="getCategory('2', this, 'M')" style="width:130px">
							<option value="" selected style = "background-color:red;color:white">중분류</option>
							<?
							if($mode == "modify"){
								$Mcode = substr($list[Category],4);
								$sqlstr ="select cat_no, cat_name from ${CATEGORY_TABLE_NAME} WHERE cat_no < 10000 AND cat_no >= 100 AND cat_no LIKE '%$Mcode'  and cat_flag = 'M' ORDER BY cat_no ASC";
								$sqlqry = mysql_query($sqlstr);
								while($LIST=@mysql_fetch_array($sqlqry)):
									if($LIST[cat_no] == "00" . substr($list[Category],2) ) $selected  = " selected" ; else $selected = "" ;
								echo"<option value='$LIST[cat_no]' ${selected}>$LIST[cat_name]</option> \n";
								endwhile;
							}
							?>
							</select> <select name="Category3" style="width:130px">
							<option value="" selected style = "background-color:red;color:white">소분류</option>
							<?
							if($mode == "modify"){
								$Scode = substr($list[Category],2);
								$sqlstr ="select cat_no, cat_name from ${CATEGORY_TABLE_NAME} WHERE  cat_no >= 10000 AND cat_no like '%$Scode'  and cat_flag = 'M' ORDER BY cat_no ASC";
								$sqlqry = mysql_query($sqlstr);
								while($LIST=@mysql_fetch_array($sqlqry)):
									if($LIST[cat_no] == $list[Category]) $selected  = " selected" ; else $selected = "" ;
								echo"<option value='$LIST[cat_no]' ${selected}>$LIST[cat_name]</option> \n";
								endwhile;
							}
							?>
							</select>

			  <br>
              &nbsp;(등록카테고리가 없을시 카테고리를 <A HREF='./main.php?menushow=<? echo $menushow;?>&THEME=CategoryManager'><font color="#DBB6F5"><strong>등록</strong></font></A>
              하세요)</TD>
          </TR>

					<TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>다중카테고리</TD>
            <TD <? echo $CONTENT_STYLE; ?>>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="300px" valign="top">&nbsp; <select style="WIDTH: 270px" name="SelectCategory" class="dd1" onChange="MultiCategorySelect(this)">
                      <option value='' style = "background-color:red;color:white">상품등록 카테고리 선택</option>
                      <?
$SQL_STR = "SELECT cat_no, cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no < 100  and cat_flag = 'M' ORDER BY cat_no ASC";
$SQL_QRY = mysql_query($SQL_STR);
while($LIST=@mysql_fetch_array($SQL_QRY)):
	if($LIST[cat_no]==$list[Category]) ECHO "<OPTION VALUE='$LIST[cat_no]' selected>$LIST[cat_name]</OPTION>\n";
	else ECHO "<OPTION VALUE='$LIST[cat_no]'>$LIST[cat_name]</OPTION>\n";
	$cat_no_new = substr($LIST[cat_no],4);
	$SQL_STR1 = "SELECT cat_no, cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no < 10000 AND cat_no >= 100 AND cat_no LIKE '%$cat_no_new'  and cat_flag = 'M' ORDER BY cat_no ASC";
	$SQL_QRY1 = mysql_query($SQL_STR1);
	while($LIST1=@mysql_fetch_array($SQL_QRY1)):
		if($LIST1[cat_no]==$list[Category]) ECHO "<OPTION VALUE='$LIST1[cat_no]' selected>$LIST[cat_name] > $LIST1[cat_name]</OPTION>\n";
		else ECHO "<OPTION VALUE='$LIST1[cat_no]'>$LIST[cat_name] > $LIST1[cat_name]</OPTION>\n";
		$cat_no_new1 = substr($LIST1[cat_no],2);
		$SQL_STR2 = "SELECT cat_no, cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no >= 10000 AND cat_no LIKE '%$cat_no_new1'  and cat_flag = 'M' ORDER BY cat_no ASC";
		$SQL_QRY2 = mysql_query($SQL_STR2);
		while($LIST2=@mysql_fetch_array($SQL_QRY2)):
		if($LIST2[cat_no]==$list[Category]) ECHO "<OPTION VALUE='$LIST2[cat_no]' selected>$LIST[cat_name] > $LIST1[cat_name] > $LIST2[cat_name]</OPTION>\n";
		else ECHO "<OPTION VALUE='$LIST2[cat_no]'>$LIST[cat_name] > $LIST1[cat_name] > $LIST2[cat_name]</OPTION>\n";
		endwhile;
	endwhile;
endwhile;
?>
                    </select></td>
                  <td valign="top"><select name="TmpMultiCategory" size="10" multiple style = "width:270px">
<?

$sqlsubstr = "select Category from ${MALL_TABLE_NAME} where PID = '$uid' and UID != '$uid'";
$sqlsubqry = mysql_query($sqlsubstr) or die(mysql_error());
while($sublist = mysql_fetch_array($sqlsubqry)):
	if(($big_cat = substr($sublist[Category], -2)) > 0){
		$cat_name = getSingleValue("select cat_name from ${CATEGORY_TABLE_NAME} where cat_no = '0000$big_cat' and cat_flag = 'M' ");
	}
	if(($mid_cat = substr($sublist[Category], -4)) > 100){
		$cat_name .= ">" . getSingleValue("select cat_name from ${CATEGORY_TABLE_NAME} where cat_no = '00$mid_cat' and cat_flag = 'M'");
	}
	if(($small_cat = substr($sublist[Category], -6)) > 10000){
		$cat_name .= ">" . getSingleValue("select cat_name from ${CATEGORY_TABLE_NAME} where cat_no = '$small_cat' and cat_flag = 'M'");
	}
?>
<option value="<?=$sublist[Category]?>">
<?=$cat_name?>
</option>
<?
endwhile;
?>
                    </select>
										<img src = "./img/btn_set/btn_del.gif" onClick="DeleteMultiCat(document.WriteForm.TmpMultiCategory)" style = "cursor:hand">
                  </td>
                </tr>
              </table>

					  </TD>
          </TR>
          <TR>
            <TD WIDTH='100' height="40" <? echo $LEFT_STYLE; ?>> *상품명</TD>
            <TD <? echo $CONTENT_STYLE; ?> height="40">&nbsp; <INPUT name='Name' size='26' value = "<? echo $list[Name]; ?>" id = "checkenable" title = "상품명을 입력해주세요">
              &nbsp;</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 상품모델명</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <INPUT NAME='Model' SIZE='26' value = "<? echo $list[Model]; ?>">
              - 모델명이 존재할경우 기입</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 상품진열순서</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp;
								<select name="Ranking">
								<option value = "9999" <? if(!$mode || $list[Ranking] == "9999") echo " selected";?>>사용하지 않음</option>
								<?
									$cnt = getSingleValue("SELECT count(*) as cnt FROM ${MALL_TABLE_NAME}");
									if(!$mode) $cnt++;// 수정 모드 일경우는 현재 설정된 순번 갯수만 나온다.
									for($i = 1 ; $i <= $cnt ; $i++){
									$i = sprintf("%04d",$i);
									$selectChecked = "" ;
									if($i == $list[Ranking]) $selectChecked = " selected";
								?>
                <option value="<? echo $i; ?>" <? echo $selectChecked; ?>>
                <? echo $i ; ?>
                </option>
                <? }?>
              </select>
              각 매장별 보여줄 순서를 정합니다.. (순서가 필요 없는 경우는 <font color="#DBB6F5">'사용하지 않음'</font> 선택)</TD>
          </TR>
          <TR>
            <TD WIDTH='100' HEIGHT="25" <? echo $LEFT_STYLE; ?>> 소비자가</TD>
            <TD HEIGHT="25" <? echo $CONTENT_STYLE; ?>>&nbsp; <INPUT MAXLENGTH='30' NAME='Price1' SIZE='15' onkeyPress="if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;"style="ime-mode:disabled" value = "<? echo $list[Price1]; ?>">
            </TD>
          </TR>

          <TR>
            <TD WIDTH='100' height="35" <? echo $LEFT_STYLE; ?>> *판매가</TD>
            <TD <? echo $CONTENT_STYLE; ?> height="35" style = "padding-left:10px">
							<?
								if($PRICEDIFF == "checked"){// 등급별 차등가격방식일 경우
									 $pindex = 0 ;
									 foreach($MEMBER_GRADE_NAME as $key => $value){
										if($value) {
											echo "<input name='Price[]' size='10' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Price[$pindex]'> ${value}가 ";// 관리자와 value 값이 없는건 제외
											$pindex++;
											if($pindex%4 == 0 ) echo "<br>";
										}


										}

										$plastindex = sizeof($Price) -1 ;// 마지막 가격은 비회원가..

										echo "<input name='Price[]' size='10' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Price[$plastindex]'> 가격";// 판매가
								 }else{
												echo "<input name='Price[]' size='26' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Price[0]'> ";// 판매가
								 }
							?>

            </TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 부가 포인트</TD>
            <TD <? echo $CONTENT_STYLE; ?> style = "padding-left:10px">
			<? if($POINTSTATUS == "checked" ){
				echo "일률적용 $POINTRATE % ";

			 } else {// 개별적으로 적용시

					if($PRICEDIFF == "checked"){// 등급별 차등가격방식일 경우
					 $pindex = 0 ;
					 foreach($MEMBER_GRADE_NAME as $key => $value){
						if($value) {
							echo "<input name='Point[]' size='10' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Point[$pindex]'> ${value}Point ";//
							$pindex++;
							if($pindex%4 == 0 ) echo "<br>";
						}


					  }

					  $plastindex = sizeof($Point) -1 ;// 마지막 가격은 비회원가..

					  echo "<input name='Point[]' size='10' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Point[$plastindex]'> 일반Point";// 판매가
				 }else{
				        echo "<input name='Point[]' size='26' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Point[0]'> ";// 판매가
				 }

			 }

			?>

            </TD>
          </TR>
          <TR>
            <TD WIDTH='100' height="35" <? echo $LEFT_STYLE; ?>> *작은사진</FONT></p></TD>
            <TD <? echo $CONTENT_STYLE; ?> height="35" style = "padding-left:10px"><INPUT type='file' name='file0' size = 30>
							<? if($Picture[0]):
							$img = "../${STOCK_FOLDER_NAME}/$Picture[0]";

							if (is_file($img)){
							$Pic_size = @GetImageSize($img);
							$w = $Pic_size[0] + 20 ;
							$h = $Pic_size[1] + 20 ;

							}

							?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[0]?>' width = 30 border="0"></a>
			 				 <img src = "./img/btn_set/btn_del.gif" onClick = "del('<? echo $Picture[0]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
              <? endif;?>
              (권장사이즈 <? echo $SIMAGEW; ?> x <? echo $SIMAGEH; ?>)
			 				 <br>
              (<B><FONT COLOR="#FF6600">그림파일의 이름</FONT></B>은 <FONT COLOR="#FF0000"><B>영문으로
              표기</B></FONT>하시기를 권장합니다.)</TD>
          </TR>
          <TR>
            <TD WIDTH='100' height="35" <? echo $LEFT_STYLE; ?>> *중간사진</FONT></p></TD>
            <TD <? echo $CONTENT_STYLE; ?> height="35" style = "padding-left:10px">
			  <INPUT type='file' name='file1' size = 30>
							<? if($Picture[1]):
							$img = "../${STOCK_FOLDER_NAME}/$Picture[1]";

							if (is_file($img)){
							$Pic_size = @GetImageSize($img);
							$w = $Pic_size[0] + 20 ;
							$h = $Pic_size[1] + 20 ;

							}

							?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[1]?>' width = 30 border="0"></a>
			  			<img src = "./img/btn_set/btn_del.gif" onClick = "del('<? echo $Picture[1]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
              <? endif;?>
              (권장사이즈 <? echo $MIMAGEW; ?> x <? echo $MIMAGEH; ?>)

			</TD>
          </TR>
		  <TR>
            <TD WIDTH='100' height="35" <? echo $LEFT_STYLE; ?>> *큰사진</FONT></p></TD>
            <TD <? echo $CONTENT_STYLE; ?> height="35" style = "padding-left:10px">
						<INPUT type='file' name='file2' size = 30>
							<? if($Picture[2]):
							$img = "../${STOCK_FOLDER_NAME}/$Picture[2]";

							if (is_file($img)){
							$Pic_size = @GetImageSize($img);
							$w = $Pic_size[0] + 20 ;
							$h = $Pic_size[1] + 20 ;

							}

							?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[2]?>' width = 30 border="0"></a>
							<img src = "./img/btn_set/btn_del.gif" onClick = "del('<? echo $Picture[2]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
							 <? endif;?>
							(권장사이즈 : <? echo $LIMAGEW; ?> x <? echo $LIMAGEH; ?>)

								<? for($i=3; $i < sizeof($Picture)-1 && $Picture[$i]; $i++){
								$img = "../${STOCK_FOLDER_NAME}/$Picture[$i]";
								unset($w);
								unset($h);
								if (is_file($img)){
								$Pic_size = @GetImageSize($img);
								$w = $Pic_size[0] + 20 ;
								$h = $Pic_size[1] + 20 ;

								}

								?>
              <input type='file' name='file[<?=$i?>]' size = "30">
              <? if($Picture[$i]):?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[$i]?>' width = 30 border="0"></a>
              <img src = "./img/btn_set/btn_del.gif" onClick = "del('<? echo $Picture[$i]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
              <? endif;?>
              <? }?>
              &nbsp;
              <img src = "./img/btn_set/btn_plus.gif" style="cursor:hand" onClick="javascript:addToPIC() ;return false"; align = "absmiddle">
							<div id='nameToDiv'></div>
			</TD>
          </TR>
          <TR>
            <TD WIDTH='100' ROWSPAN='2' <? echo $LEFT_STYLE; ?>>  옵션1이름
              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Option1][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]' value = "checked">

							</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <TEXTAREA COLS='25' NAME='Option1' ROWS='10'><? echo $list["Option1"]; ?></TEXTAREA>
              <TEXTAREA COLS='25' NAME='EX' ROWS='10'>보기1)
20인치=-50000=-50
30인치=+100000=+100
35인치=+200000=+200
--------------------
보기2)
대
중
소 </TEXTAREA></TD>
          </TR>
          <TR>
            <TD <? echo $CONTENT_STYLE; ?>> <p>차등가격설정시 : 우측(보기1)과 같이 <FONT COLOR='#FF0000'>&quot;옵션=추가가격=추가포인트&quot;</FONT>의 형식으로 한줄에 하나씩 입력</p>
              <p>동일가격설정 및 옵션만 지정할 경우(보기2)에는 첫줄에는 옵션의 종류를, 둘째줄부터는 옵션의 내용을 입력</p></TD>
          </TR>
          <TR>
            <TD WIDTH='100' ROWSPAN='2' <? echo $LEFT_STYLE; ?>>  옵션2이름
							<INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Option2][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]' value = "checked">

            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <TEXTAREA COLS='25' NAME='Option2' ROWS='10'><? echo $list["Option2"]; ?></TEXTAREA>
              <TEXTAREA COLS='25' NAME='EX2' ROWS='10'>
Red
Blue
Yellow </TEXTAREA></TD>
          </TR>
          <TR>
            <TD <? echo $CONTENT_STYLE; ?>> 동일가격설정 및 옵션만 지정할 경우(보기2)에는 첫줄에는 옵션의
              종류를, 둘째줄부터는 옵션의 내용을 입력</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>  옵션3이름

              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Option4][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]'>
							</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <INPUT maxLength='30' name='Option4' size='26'  value = "<? echo $list[Option42]; ?>"></TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>  옵션4이름
              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Option5][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]'>

							</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <INPUT maxLength='30' name='Option5' size='26'  value = "<? echo $list[Option5]; ?>"></TD>
          </TR>

          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>  옵션5이름
              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Size][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]'>
							</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <INPUT maxLength='30' name='Size' size='26'  value = "<? echo $list[Size]; ?>"></TD>
          </TR>
					<TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>  옵션6이름
              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Color][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]'>
							</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <INPUT maxLength='30' name='Color' size='26'  value = "<? echo $list[Color]; ?>"></TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>*자세한설명<BR> <INPUT TYPE=hidden NAME=TextType1 VALUE=checked >
              <!--HTML사용--></TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <textarea cols='70' name='Description1' rows='15'><? echo $list[Description1]; ?></textarea>
						<script language='javascript1.2'>editor_generate('Description1');</script>
              &nbsp; <br>
              상품에 대한 설명을 넣는 곳입니다.<br>
              일반 TEXT 와 HTML을 모두 쓸 수 있습니다. <br>
              <font color="#0000FF"><strong>HTML 소스를 넣으실려면 &lt;&gt; 마크를 눌러 주십시요..</strong></font><br>
              <font color="#FF0000">설명 부분을 이미지로 대처 하실려면 하단의 설명 이미지에 이미지를 등록 하시기
              바랍니다.</font><br>
              (HTML을 쓰실 경우 &quot;html사용&quot;에 체크를 해주시고 쓰시기 바랍니다. html 숙련자가 아니라면
              전체 쇼핑몰이 깨어질 수 있으므로 사용을 자제하시기 바랍니다.)</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>설명 이미지</TD>
            <TD <? echo $CONTENT_STYLE; ?>><input type='file' name='file10' size = "30">
							<? if($DetailPicture[0]):
								$img = "../${STOCK_FOLDER_NAME}/product_detail/$DetailPicture[0]";

								 if (is_file($img)){
									$Pic_size = @GetImageSize($img);
									$w = $Pic_size[0] + 20 ;
									$h = $Pic_size[1] + 20 ;

								}

								?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/product_detail/<?=$DetailPicture[0]?>' width = 30 border="0"></a>
              <img src = "./img/btn_set/btn_del.gif" onClick = "del2('<? echo $DetailPicture[0]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
			  			<? endif;?> (<? echo $PIMAGEW; ?> px 이하로 등록 바랍니다.)
              <br>
              (<B><FONT COLOR="#FF6600">사진파일의 이름</FONT></B>은 <FONT COLOR="#FF0000"><B>영문으로
              표기</B></FONT>하시기를 권장합니다.)</TD>
          </TR>
        </table>
        <br> <center>
          <input type = "image" src = "<? echo $send_img ; ?>" align = "absmiddle"  class = "noninput">
		  <img src = "./img/btn_set/btn_list_02.gif" onClick = "javascript:location.href='<? echo $BackUrl; ?>'" style = "cursor:hand" align = "absmiddle">
        </center>
        <br> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
          <TR>
            <TD colspan = 2 <? echo $TITLE_STYLE ; ?>>* 옵션 입력사항&nbsp;&nbsp;&nbsp;(옵션 사항은 기입한경우만 쇼핑몰 상세 페이지에 나타납니다)</TD>
          </TR>
					<TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 원산지</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <select name='GetComp' style = "width:150px">
							<option value = "" selected style = "background-color:red;color:white">표시안함</option>
							<?
							if(file_exists("../config/brand_list.php")) {
							    include "../config/brand_list.php";
									$origin_list = explode(",",$Origin);
									for($i = 0 ; $i < sizeof($origin_list)  && $origin_list[$i] ; $i++){
											$OriginValue[$i] = trim($origin_list[$i]);
											if($list[GetComp]==$OriginValue[$i]) $selectedCheck = " selected "; else $selectedCheck = "" ;
											echo "<option value='$OriginValue[$i]' $selectedCheck>$OriginValue[$i]</option>\n";
									}
							}
							?>
              </select></TD>
          </TR>
          <TR>
            <TD WIDTH='100' height="40" <? echo $LEFT_STYLE; ?>> 브랜드</TD>
            <TD <? echo $CONTENT_STYLE; ?> height="40">&nbsp; <select name='Brand' style = "width:150px">
							<option value = "" selected style = "background-color:red;color:white">표시안함</option>
							<?
							if (file_exists("../config/brand_list.php")) {
							    include "../config/brand_list.php";
									$brand_name_list = split("\n",$brand_list);
									for($i = 0 ; $i < sizeof($brand_name_list)  && $brand_name_list[$i] ; $i++){
											$BrandValue[$i] = trim($brand_name_list[$i]);
											if($list[Brand]==$BrandValue[$i]) $selectedCheck = " selected "; else $selectedCheck = "" ;
											echo "<option value='$BrandValue[$i]' $selectedCheck>$BrandValue[$i]</option>\n";
									}
							}
							?>
              </select> &nbsp;</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 공급처</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp;
						<select name = "CompName">
						<option value = "" selected style = "background-color:red;color:white">사용안함</option>
							<?
							$sql = "SELECT UID , Company  FROM ${PARTNER_TABLE_NAME}  WHERE (PType = 'S' or PType = 'M') and Service = 'Y'";// Partner 에서 제조업체나 공급업체
							$sresult = mysql_query($sql);
							while( $clist = mysql_fetch_array( $sresult ) ) {
									if($clist[UID] == $list[CompName]) $selectedCheck = " selected" ; else $selectedCheck = "" ;
											echo  "<option value='$clist[UID]' $selectedCheck>$clist[Company]</option>";
							}
							?>
						</select>
            </TD>
          </TR>

          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 관련상품</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp;
						<select name="CID" size="10" multiple style = "width:470px">
						<?
						 $CID = explode("|" , $list[CID]);
						 for ($i = 0 ; $i < sizeof($CID) && $CID[$i] ; $i++){
						 $sql = "SELECT UID , Name , Category  FROM ${MALL_TABLE_NAME} WHERE UID = '$CID[$i]' AND Status = 'Y' ";
						 $result = mysql_query($sql);
						 $clist = mysql_fetch_array($result);
						 $clist[Name] = trim(stripslashes($clist[Name]));
						 $tmpValue = "<" . getCateName($clist[Category]) . ">  " .  $clist[Name];// 카테고리 이름과 같이 출력
						?>
						<option value="<? echo $clist[UID]?>">
						<? echo $tmpValue; ?>
						</option>
						<?
						}
						?>
                    </select>
              <img src = "./img/btn_set/btn_img01.gif" onClick="window.open('Product_Relative_Popup.php?mode=new','Product_Search_Window','width=640, height=650, scrollbars=yes')"; align = absbottom style="cursor:hand" >
							<img src = "./img/btn_set/btn_del.gif" onClick="DeleteRelative(document.WriteForm.CID)" align = absbottom style = "cursor:hand">
              <br>
              상품상세보기에서 관련상품을 디스플레이할 때 사용</TD>
          </TR>
        </TABLE></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
	  	<TR>
					<TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 상품표시여부</TD>
					<TD <? echo $CONTENT_STYLE; ?>>&nbsp; <input name='Status' type='checkbox' value='Y' <? if(!$mode) { echo " checked" ; } else { if($list[Status] == "Y") echo " checked" ; }?>>
						상품표시 선택을 해제시 관리자 모드에서는 나타나지만 쇼핑몰에 표시 되지는 않습니다.
			  </TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 품절</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <input name='None' type='checkbox' value='checked' <? echo $list[None]; ?>>
              품절상품은 리스트나 상세보기에서는 표시 되나 <font color="#DBB6F5">장바구니,</font><font color="#DBB6F5">위시리스트</font>에
              담겨지지 않습니다.</TD>
          </TR>
		      <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 등록옵션</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp;
              <?
								foreach($OPTION_PRODUCT_ARRAY as $key => $value){
								$chkValue = "";
								if(@ereg($key , $list[Option3])) $chkValue = " checked" ;
								echo "<input type = 'checkbox' name = 'Option3[]' id = 'Option3' value = '$key' $chkValue onClick = 'javascript:checkOptionBox();'>";

								echo $OPTION_IMAGE_ARRAY[$key] ;

							}
						 ?>
            </TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 메인화면 표시 </TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <input type="checkbox" name = "MainDisplay" value="checked" <? echo $list[MainDisplay]; ?>>
              <strong><font color="#FF0000"> (등록 옵션에 포함된것을 메인에 뿌려줍니다..)</font></strong></TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 입하량</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <INPUT name='Input' size='5' onkeyPress="if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;"style="ime-mode:disabled" value = "<? echo $list[Input]; ?>">
              상품이 입하된 수</TD>
          </TR>
					<? if($mode != "modify"){?>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> 등록일</TD>
            <TD <? echo $CONTENT_STYLE; ?>>
              <input type=text name=SDay size=15 class="dd1" value = "<? if($list[WDate]) echo  date("Y-m-d",$list[WDate]); else  echo date("Y-m-d");?>" readonly>
                    &nbsp;<img src = "./img/calendar.jpg" width = "16" height = "15" style = "cursor:hand" align = "absmiddle" onclick="popUpCalendar(this, SDay, 'yyyy-mm-dd');">
            </TD>
          </TR>
					<? } ?>


        </TABLE>
        <br> <DIV ALIGN="CENTER">
          <input type = "image" src = "<? echo $send_img ; ?>" align = "absmiddle"  class = "noninput"> <img src = "./img/btn_set/btn_list_02.gif" onClick = "javascript:location.href='<? echo $BackUrl; ?>'" style = "cursor:hand" align = "absmiddle">
        </DIV></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </FORM>
  <tr>
    <td height = 40 >&nbsp;</td>
  </tr>
</table>
<script>
	function checkOptionBox(){

		var f = document.WriteForm;
		if(f.Option3[0].checked){
			for(i = 1 ; i < f.Option3.length ; i++){
				f.Option3[i].checked = false;
				f.Option3[i].disabled = true;

			}
		}else{

			for(i = 1 ; i < f.Option3.length ; i++){
				f.Option3[i].disabled = false;
			}

		}
	}

	<? if(!$mode){ ?>
		document.WriteForm.Option3[0].checked = true;
		for(i = 1 ; i < document.WriteForm.Option3.length ; i++){
			document.WriteForm.Option3[i].checked = false;
			document.WriteForm.Option3[i].disabled = true;
		}
	<? } else{ ?>
		checkOptionBox();
	<? }?>
</script>
