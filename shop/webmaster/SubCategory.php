<?
include "./ROOT_CHECK.php";

$step = $_GET['step'];
$form = $_GET['form'];
$flag = $_GET['flag'];
$trigger = $_GET['trigger'];
$big_code = substr($trigger,-2);
$mid_code = substr($trigger,2,4);
if($step == "1"){
	$sqlstr = "select cat_no, cat_name from ${CATEGORY_TABLE_NAME} where cat_flag = '$flag' and cat_no >= 100 and cat_no < 10000 and cat_no like '%$big_code'  order by cat_no asc";
	$str = "중분류";
	$target = "Category2";
	
}elseif($step == "2"){
	$sqlstr = "select cat_no, cat_name from ${CATEGORY_TABLE_NAME} where cat_flag = '$flag' and cat_no >= 10000 and cat_no < 1000000 and cat_no like '%$mid_code' order by cat_no asc";
	$str = "소분류";
	$target = "Category3";
}
//echo "sqlstr = $sqlstr <br>";
$sqlqry = mysql_query($sqlstr);
$length = mysql_num_rows($sqlqry)+1;

header("Content-Type: application/x-javascript");
echo "document.forms['$form'].elements['$target'].length = $length; \n";
echo "document.forms['$form'].elements['$target'].options[0].text = '$str'; \n";
echo "document.forms['$form'].elements['$target'].options[0].selected = true; \n";
$i=1;	
while($list = mysql_fetch_array($sqlqry)):
	echo "document.forms['$form'].elements['$target'].options[$i].text = '$list[cat_name]'; \n";
	echo "document.forms['$form'].elements['$target'].options[$i].value = '$list[cat_no]'; \n";
$i++;
endwhile;

function resetField($form, $claretarget, $targetstr){
	echo "document.forms['$form'].elements['$claretarget'].length = 1; \n";
	echo "document.forms['$form'].elements['$claretarget'].options[0].text = '$targetstr'; \n";
	echo "document.forms['$form'].elements['$claretarget'].options[0].selected = true; \n";
}


if($step == "1"){	// 소분류 리셋
	if(!$trigger){ // 대분류의 값이 없을 경우는 중분류도 리셋
		resetField($form, $claretarget="Category2", $targetstr="중분류");
	}
	resetField($form, $claretarget="Category3", $targetstr="소분류");	
}


?>

