<?

/*

<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">

*/

/* 페이지 번호 리스트 부분 */

/* PREVIOUS or First 부분 */

$TransData = "BID=$BID&GID=$GID&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword&category=$category&STitle=$STitle&SOrder=$SOrder&search_term=$search_term&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax";

if ( $CB > 1 ) {

$PREV_PAGE = $SP - 1;

echo "<a href='$PHP_SELF?CURRENT_PAGE=$PREV_PAGE&$TransData'><img src='./${BOARD_FOLDER_NAME}/skin_btnm/$BOTTOM_SKIN_TYPE/pre.gif' border='0' align = absmiddle></a>";

} else {

echo "<img src='./${BOARD_FOLDER_NAME}/skin_btnm/$BOTTOM_SKIN_TYPE/pre.gif' border='0' align = absmiddle>";

 }

 ?>


 <?

/* LISTING NUMBER PART */

for ($i = $SP; $i <= $EP && $i <= $TP ; $i++) {

if($CURRENT_PAGE == $i){$NUMBER_SHAPE= "<B>${i}</B>";}

else $NUMBER_SHAPE=${i};

ECHO"&nbsp;<A HREF='$PHP_SELF?CURRENT_PAGE=$i&$TransData'>$NUMBER_SHAPE</a>";

}

?>


<?

/* NEXT or END PART */

if ($CB < $TB) {

$NEXT_PAGE = $EP + 1;

ECHO "&nbsp;<a href='$PHP_SELF?CURRENT_PAGE=$NEXT_PAGE&$TransData'><img src='./${BOARD_FOLDER_NAME}/skin_btnm/$BOTTOM_SKIN_TYPE/next.gif' border='0' align = absmiddle></a>";

} else {

ECHO"&nbsp;<img src='./${BOARD_FOLDER_NAME}/skin_btnm/$BOTTOM_SKIN_TYPE/next.gif' border='0' align = absmiddle>";

}

?>

