<?
if ( $CB > 1 ) {
$PREV_PAGE = $SP - 1;
echo "<a href='$PHP_SELF?CURRENT_PAGE=$PREV_PAGE&$TransData'><img src='./$SKIN_FOLDER_NAME/page/$PageSkin/images/btn_prev.gif' border='0' align = absmiddle></a>";
} else {
echo "<img src='./$SKIN_FOLDER_NAME/page/$PageSkin/images/btn_prev.gif'  border='0' align = absmiddle>";
 }

/* LISTING NUMBER PART */
for ($i = $SP; $i <= $EP && $i <= $TP ; $i++) {
if($CURRENT_PAGE == $i){$NUMBER_SHAPE= "<B>${i}</B>";}
else $NUMBER_SHAPE=${i};
ECHO"&nbsp;<A HREF='$PHP_SELF?CURRENT_PAGE=$i&$TransData' class=link_gray_s>$NUMBER_SHAPE</a>";
}

/* NEXT or END PART */
if ($CB < $TB) {
$NEXT_PAGE = $EP + 1;
ECHO "&nbsp;<a href='$PHP_SELF?CURRENT_PAGE=$NEXT_PAGE&$TransData'><img src='./$SKIN_FOLDER_NAME/page/$PageSkin/images/btn_next.gif' border='0' align = absmiddle></a>";
} else {
ECHO"&nbsp;<img src='./$SKIN_FOLDER_NAME/page/$PageSkin/images/btn_next.gif'  border='0' align = absmiddle>";
}

?>