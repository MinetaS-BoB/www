<? include "../../function/kerrigancap_lib.php" ; ?>
<html>
<head>
<title>우편번호 찾기</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<style type='text/css'>
<!--
body {
	background-color: #9eb91f;
}
table, tr, td, select, textarea, input{ 
	font-family: "굴림", "굴림체";
	font-size: 9pt;
	line-height: 18px;
	color: #555555 
}
.input2
{color:666666; font-size:12px; font-family: "굴림"; border:1px solid #999999;}

a:link     { color: #666666; text-decoration: none; line-height: 16px; font-size: 12px;}
a:visited  { color: #666666; text-decoration: none; line-height: 16px; font-size: 12px;}
a:active   { color: #666666; text-decoration: none; line-height: 16px; font-size: 12px;}
a:hover    { color: #0074AB; text-decoration: none; line-height: 16px; font-size: 12px;} 

-->
</style>
<script>
window.resizeTo(412,290);
function Copy(zip1,zip2,address) {
	opener.document.<?=$form?>.<?=$zip1?>.value = zip1;
	opener.document.<?=$form?>.<?=$zip2?>.value = zip2;
	opener.document.<?=$form?>.<?=$firstaddress?>.value = address;
	opener.document.<?=$form?>.<?=$secondaddress?>.focus();			
	window.close();
	return false;
}

function checkForm(f){
	if(!f.keyword.value){
		alert("주소를 입력해주세요");
		f.keyword.focus();
		return false;
	}
}
</script>
</head>
<body topmargin="0" leftmargin="0" onLoad=document.AddressFrm.keyword.focus()>
<table width="385" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td><a href="javascript:self.close()"><img src="./<? echo $ZipCodeSkin; ?>/images/pop_t_02.gif" width="385" height="38" border="0"></a></td>
  </tr>
  <tr> 
    <td align="center" bgcolor="9EB91F"><table width="367" border="0" cellpadding="10" cellspacing="1" bgcolor="788B1C">
        <tr> 
          <td align="center" bgcolor="#FFFFFF"><table width="300" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="50">찾고자 하는 주소의 동(읍/면/리)를 입력해주세요 <br>
                  예) 역삼2동, 서초동, 송파동 </td>
              </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="0">
              <form action="<? echo $_SERVER['PHP_SELF'];?>" method=post name=AddressFrm onSubmit="return checkForm(this);">
                <input type=hidden name=mode value=search>
                <input type=hidden name=form value=<?=$form?>>
                <input type=hidden name=zip1 value=<?=$zip1?>>
                <input type=hidden name=zip2 value=<?=$zip2?>>
                <input type=hidden name=firstaddress value=<?=$firstaddress?>>
                <input type=hidden name=secondaddress value=<?=$secondaddress?>>
                <input type=hidden name=searchmode value=address>
                <tr> 
                  <td><input name="keyword" type="text" class="input2" size="25"></td>
                  <td width="55" align="center"><input type = "image" src="./<? echo $ZipCodeSkin; ?>/images//btn_search.gif" width="43" height="20" border="0"></td>
                </tr>
              </form>
            </table>
<?
if($mode == "search"):
$zipfile = file("./zipcode.db");
$search_count = 0;

if ($keyword){
    while ($zipcode = each($zipfile)){
        if(strstr(substr($zipcode[1],9,512), $keyword)){
            $list[$search_count][zip1] = substr($zipcode[1],0,3);// Zipcode1
            $list[$search_count][zip2] = substr($zipcode[1],4,3);// Zipcode2
            $addr = explode(" ", substr($zipcode[1],8));// 공백 기준으로 분리

            if ($addr[sizeof($addr)-1]){
                $list[$search_count][addr] = str_replace($addr[sizeof($addr)-1], "", substr($zipcode[1],8));// 주소
                $list[$search_count][bunji] = trim($addr[sizeof($addr)-1]);// 번지 
            }
            else $list[$search_count][addr] = substr($zipcode[1],8);						          
            $search_count++;
        }    
    }
    
}

?>
            <br> <table width="330" border="0" cellpadding="0" cellspacing="0" bgcolor="cccccc">
              <tr> 
                <td height="1"> </td>
              </tr>
            </table>
            <br> <table width="330" border="0" cellpadding="2" cellspacing="1" bgcolor="dddddd">

<?
for ($i = 0; $i < sizeof($list); $i++){
?>
             		<tr>
								<td width="70" bgcolor="f2f2f2">
                  <? echo "{$list[$i][zip1]}-{$list[$i][zip2]}";?>
                </td>
                <td bgcolor="#FFFFFF"><a href="#" onClick="javascript: Copy('<?="{$list[$i][zip1]}"?>', '<?="{$list[$i][zip2]}"?>', '<?="{$list[$i][addr]}"?>')"> 
                 <? echo "{$list[$i][addr]} {$list[$i][bunji]}";?>                  
                  </a></td>
              </tr>
<?		 
}
?>
<?
if(!$search_count) { // 우편번호이 없으면
?>
              <tr align="center"> 
                <td colspan="2" bgcolor="f2f2f2">찾으시는 지역이 존재하지 않습니다</td>
              </tr>
              <?
}
?>
            </table>
            <br></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="10" align="center" bgcolor="9EB91F"> </td>
  </tr>
</table>
<?
endif;
?>
</body>
</html>
