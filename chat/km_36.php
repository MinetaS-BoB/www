<?

@session_start();


include "chat_config.php";


    
$hty_connect=db_connect(); // 데이터베이스 연결


global $rno, $sno, $ctext, $cmd, $uname, $chat_max, $HTTP_SESSION_VARS;


$regtime=time();

$t_time=$regtime-60;

$sid=session_id();

$rno=intval($rno);

$sno=intval($sno);






// 대화 내용이 있으면 등록하고 상태값 업데이트
if($rno && $sno && $ctext && $uname && $cmd=="chatwrite")
{
	

$ctext=htmlspecialchars(addslashes($ctext));

// 글 등록
$sql = "insert into web_chat ( sid, rno, uname, ctalk, regdate ) values ( '$sid', '$rno', '$uname', '$ctext', '$regtime' )";
mysql_query($sql, $hty_connect); 
echo $sql;

// 상태값 업데이트 
mysql_query("update web_chat set regdate=$regtime where cno=$sno and ctype='S'", $hty_connect);

}

?>

<? if($rno) { ?>

<textarea name="ulist_src" style="min-height:400px;width:660px">
<?

$t_sql=mysql_query("select * from web_chat where rno=$rno and regdate>$t_time and ctype='S' order by cno desc",$hty_connect);

while($t_dat=mysql_fetch_array($t_sql))
{

	if( $t_dat['sid'] == $sid ) $t_color="#36C;font-weight:bold;"; else $t_color="#470;";

?>

<div style="text-align:left;padding:3px;border-bottom:1px dotted #BBB;margin-bottom:3px;color:#999;">└ <span style="color:<?=$t_color?>"><?=$t_dat['uname']?></span></div>

<?
}
?>

</textarea>


<textarea name="chat_src" style="min-height:400px;width:660px">
<?

// 가장 최근 등록된 글번호 구하기 - 채팅창 리로드용
$t_max=mysql_fetch_array(mysql_query("select cno from web_chat where rno=$rno and ctype='C' order by regdate desc limit 1",$hty_connect));

// 데이터 전송량을 줄이기 위한 세션변수 등록
if( !isset($HTTP_SESSION_VARS['chat_max']) )
{
	$chat_max=0;

	session_register2('chat_max');
}

// 세션에 등록된 값보다 크면.. 즉 새로운 채팅 글이 있을때만 내용 전송
if( $t_max['cno'] > $HTTP_SESSION_VARS['chat_max'] )
{

$HTTP_SESSION_VARS['chat_max']=$t_max['cno'];



$t_sql=mysql_query("select * from web_chat where rno=$rno and ctype='C' and cno>$sno order by regdate desc limit 100",$hty_connect);

unset($chat_arr);

$t_rows=mysql_num_rows($t_sql);

$t_cnt=$t_rows;

while($t_dat=mysql_fetch_array($t_sql))
{

$chat_arr[$t_cnt]['cno']=$t_dat['cno'];
$chat_arr[$t_cnt]['sessid']=$t_dat['sid'];
$chat_arr[$t_cnt]['uname']=$t_dat['uname'];
$chat_arr[$t_cnt]['ctalk']=$t_dat['ctalk'];
$chat_arr[$t_cnt]['regdate']=$t_dat['regdate'];

$t_cnt--;
}

for($i=1;$i<=$t_rows;$i++)
{

	if( $chat_arr[$i]['sessid'] == $sid ) { $t_color1="#36C"; $t_color2="#666"; } else { $t_color1="#3A0"; $t_color2="#999"; }

?>

<div style="text-align:left;line-height:150%;margin-bottom:10px;"><b style="color:<?=$t_color1?>;"><?=$chat_arr[$i]['uname']?></b> <span style="color:<?=$t_color2?>;">님 ( <?=date("Y-m-d H:i:s", $chat_arr[$i]['regdate'])?> )</span>
<br>&nbsp;&nbsp;<?=htmlspecialchars(stripslashes($chat_arr[$i]['ctalk']))?></div>

<?

}

}

?>
</textarea>

<? } else { ?>

<textarea name="rlist_src" style="min-height:400px;width:660px">
<?

$t_sql=mysql_query("select rno,croom,max(regdate),ctype from web_chat group by rno having max(regdate)>$t_time and ctype='S' order by cno desc",$hty_connect);

// echo "select * from hty_chat where max(regdate)>$t_time group by rno";

// echo intval(mysql_num_rows($t_sql));

while($t_dat=mysql_fetch_array($t_sql))
{
	$u_sql=mysql_query("select * from web_chat where regdate>$t_time and rno=".$t_dat['rno']." and ctype='S'", $hty_connect);

	$u_cnt=mysql_num_rows($u_sql);

?>

<div style="text-align:left;padding:5px;border-bottom:1px dotted #BBB;margin-bottom:5px;color:#999;">└ <a href="#" onclick="chat_enter(<?=$t_dat['rno']?>);"><b style="color:#369;"><?=$t_dat['croom']?></b></a> (<b style="color:#6A3"><?=$u_cnt?></b>)</div>

<?
}
?>
</textarea>

<? } ?>

<SCRIPT language="javascript">

<? if($rno) { ?>

//alert('<?=$rno?>');

parent.chat_ulist.innerHTML=ulist_src.value;

tmp_str=parent.chat_view.style.height;

tmp_arr=tmp_str.split("px");

if( parent.chat_ulist.scrollHeight > tmp_arr[0] ) parent.chat_view.style.height=(parent.chat_ulist.scrollHeight)+"px";

if( <?=$t_max['cno']?> > parent.chat_count ) 
{

//alert('채팅 리로드 ok'+parent.chat_count)
parent.chat_view.innerHTML=chat_src.value;
parent.chat_count=<?=$t_max['cno']?>;
parent.chat_view.scrollTop=parent.chat_view.scrollHeight+2000;

<? 

if( $t_rows>1 )
{

if( $chat_arr[$t_rows][sessid] == $sid )
 echo "parent.chatwav1.play();";
else
 echo "parent.chatwav2.play();";

}

?>

}

// parent.chat_count=100;

// parent.chat_no();

<? } else { ?>

parent.chat_rlist.innerHTML=rlist_src.value;

<? } ?>

<? if($cmd!="chatwrite") { 
echo $cmd;
mysql_query("update web_chat set regdate=".time()." where rno=$rno and ctype='S' and cno=$sno", $hty_connect);

if($rno) 
  echo "setTimeout('location.reload()',2500);"; 
else 
  echo "setTimeout('location.reload()',5000);";

} else {

?>

parent.km35_send.ctext.value="";
parent.km35_send.ctext.focus();

<? } ?>

</SCRIPT>


<?

// 데이터베이스 연결 해제
if($hty_connect) {
	@mysql_close($hty_connect);
	unset($hty_connect);
}
?>