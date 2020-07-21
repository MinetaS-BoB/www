 <?
/* 페이지 번호 리스트 부분 */
/* PREVIOUS or First 부분 */
	  
if ( $CB > 1 ) {
$PREV_PAGE = $SP - 1;
echo "<a href='$PHP_SELF?CURRENT_PAGE=$PREV_PAGE&$PostValue'><img src='./adminskin/pageskin/$PGSKIN/images/pre.gif' hspace='5' border='0'></a>";
} else {
echo "<img src='./adminskin/pageskin/$PGSKIN/images/pre.gif' hspace='5' border='0'>";
 }
/* LISTING NUMBER PART */
for ($i = $SP; $i <= $EP && $i <= $TP ; $i++) {
if($CURRENT_PAGE == $i){$NUMBER_SHAPE= "<font color = 'gray'><B>${i}</B></font>";}
else $NUMBER_SHAPE="<font color = 'gray'>".${i}."</font>";
ECHO"&nbsp;<A HREF='$PHP_SELF?CURRENT_PAGE=$i&$PostValue'>$NUMBER_SHAPE</a>";
}
/* NEXT or END PART */
if ($CB < $TB) {
$NEXT_PAGE = $EP + 1;
ECHO "&nbsp;<a href='$PHP_SELF?CURRENT_PAGE=$NEXT_PAGE&$PostValue'><img src='./adminskin/pageskin/$PGSKIN/images/next.gif' hspace='5' border='0'></a>";
} else {
ECHO"&nbsp;<img src='./adminskin/pageskin/$PGSKIN/images/next.gif' hspace='5' border='0'>";
}
?>