<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/


function step($code, $over){
global $result;
$result = getSingleValue("select count(cat_no) as cnt from ${CATEGORY_TABLE_NAME} WHERE cat_no like '%$code' AND cat_no >= '$over' and cat_flag = 'M'");
}

unset($IsStep3);
unset($IsStep2);

if($big_code) step($big_code, "100");
if($result) $IsStep2="yes";

if($big_code) step($big_code, "10000");
if($result) $IsStep3="yes";

$list_dir=eregi_replace("list.php","",realpath(__FILE__));



if($option3)  include "optionlist.php";
else include $list_dir."/firstlist.php";
// 일반 몰 일경우 아래와 같이 lv나 step에 따라 단계를 변경한다.


/*
else if($lv == 1 ){
include $list_dir."/firstlist.php";
}else if($lv == 2){
include $list_dir."/secondlist.php";
}else if($lv == 3){
include $list_dir."/finallist.php";
}else{
include $list_dir."/firstlist.php";
}
*/
?>
