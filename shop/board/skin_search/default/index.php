<table border="0" align="right" cellpadding="0" cellspacing="0">
<script language="JavaScript">
<!--
function search(){
	var f=document.SEARCH_FORM;
		if(f.searchkeyword.value == ''){
		alert('검색어를 입력해주세요');
		f.searchkeyword.focus();
		} else { f.submit(); }
 }
//-->
</script>
<FORM NAME="SEARCH_FORM" ACTION="<? echo $PHP_SELF; ?>" METHOD="GET">
<input type="hidden" name="BID" value="<?=$BID?>" >
<input type="hidden" name="GID" value="<?=$GID?>" >
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="sysop" value="<?=$sysop?>">
<input type="hidden" name="fm" value="<?=$fm?>">
<input type="hidden" name="BType" value="<? echo $BType; ?>">
<input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">
<tr> 
<td width="73"> <select name="SEARCHTITLE" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #D0D0D0 1 solid; font-family:돋움; font-size:11px; color:#5E5E5E; HEIGHT: 19px; width: 70px" value="25">
<option value="SUBJECT" selected>제 목</option>
<option value="CONTENTS">내 용</option>
</select> </td>
<td width="105"> <input type="text" name="searchkeyword" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:12px; color:#5E5E5E; HEIGHT: 18px; width: 100px"> 
</td>
<td width="45" align="right">
<?=showBoardIcon('search');?>
</td>
</tr>
</form>
</table>