<script language="javascript" src="./js/popupEvent.js"></script>
<script language="JavaScript">
<?
$today = time();
$sql = "SELECT * FROM ${POPUP_TABLE_NAME} order by e_period desc ";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	if (($today >= $row[s_period] && $today <= $row[e_period])) { 
?>


if ( getCookie( "never<? echo $row[uid]; ?>" ) != "done" )	{
eventWindow  =  window.open('./manager/Popup_preview.php?uid=<? echo $row[uid]; ?>','event<? echo $row[uid]; ?>','width=<? echo $row[width]; ?>,height=<? echo $row[height] + 20; ?>,top=<? echo $row[itop]?>, left=<? echo $row[ileft]?>');
    eventWindow.opener = self;
}


	<? } ?>
<? } ?>
</script>