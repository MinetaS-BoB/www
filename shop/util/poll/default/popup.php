<?
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../function/const_array.php" ;
include "../../../function/kerrigancap_lib.php" ;

if(!$bar_width) $bar_width = "100"; // 투표 % 막대 너비
if(!$bar_height) $bar_height = "4"; // 투표 % 막대 높이
if(!$bar_color) $bar_color = "#008080"; // 투표 막대 색
if(!$width) $width = "200"; // 투표 너비
if(!$window_width) $window_width = "220"; // 투표창 너비
if(!$window_height) $window_height = "320"; // 투표창 높이

if(!$UID) js_alert_location("잘못된 경로로 부터의 접근입니다.","close"); 

$total = getSingleValue("select count(*) from ${POLL_TABLE_NAME} where UID='$UID'");

if($total == 0) js_alert_location("생성되지 않은 코드입니다.","close");	
	

// 투표 기간이 종료 되었을때
$Sqlqry = mysql_query("SELECT * FROM ${POLL_TABLE_NAME} WHERE UID='$UID'");
$List = mysql_fetch_array($Sqlqry);
$Contents = explode("|",$List[Contents]);
$Vote = explode("|",$List[Vote]);
	if($List[ToDay] < time()) {
	$mode = "view"; // 기간 종료시 투표 결과 보이기
	$day_end = "y"; // 기간 종료시 메시지 보이기 유.무
}
    // 총 투표수
	for($i=0; $i<count($Contents)-1; $i++) {
		$TotalVote += $Vote[$i];
	}

	// 등록일 : 종료일 : 종료일 - 등록일 = 일수(기간)
	$FromDay = date("Y.m.d",$List[FromDay]);
	$ToDay = date("Y.m.d",$List[ToDay]);
	$day = ($List[ToDay]-$List[FromDay])/24/60/60;
?>

<?
if($mode == "poll" && !${"PollCookie".$UID}) {


	if(!$num || CheckInt($num)) {
		js_alert_location("항목을 선택해 주세요.","-1");		
	}

    // 총 항목수
	$Vote = explode("|",$List[Vote]);
	if($num > count($Vote)-1) {
		js_alert_location("잘못된 경로로부터의 접근입니다.","-1");		
	}

	// 쿠키 체크 -> 투표 증가
    if(!${"PollCookie".$UID}) {
		for($i=0; $i<count($Vote)-1; $i++) {
			if($num-1 == $i) $Vote[$i] += 1;
			$vote_ok .= $Vote[$i]."|";
		}
		
		// 항목 투표수 1 증가
		$Result = mysql_query("UPDATE ${POLL_TABLE_NAME} SET Vote='$vote_ok' where UID='$UID'") or die(mysql_error());
		
		// 투표 한사람에게 쿠키 생성(1일)
		//setcookie("PollCookie".$PID,"1",time()+86400);
	// 결과 보여주기
	js_location("$PHP_SELF?UID=$UID&mode=view&window_open=$window_open&width=$width");
	exit;		
		
    }

}

## 투표 결과
else if($mode == "view" || ${"PollCookie".$UID}) {
	$Subject = explode("|",$List[Subject]);
	$Vote = explode("|",$List[Vote]);

    // 총 투표수
	for($i=0; $i<count($Subject)-1; $i++) {
		$TotalVote += $Vote[$i];
	}

	// 등록일 : 종료일 : 종료일 - 등록일 = 일수(기간)
	$FromDay = date("Y.m.d",$List[FromDay]);
	$ToDay = date("Y.m.d",$List[ToDay]);
	$day = ($List[ToDay]-$List[FromDay])/24/60/60;
?>

        <title>투표결과: <?=$List[Subject]?></title>
<style>
P, BODY,TD , DIV , CENTER , PRE ,  BLOCKQUOTE , TD , TR , BR , TABLE {FONT-SIZE: 9pt; color: black; font-family :굴림;}

A:link{color:black;text-decoration:none;}
A:visited {color:black;text-decoration:none;}
A:active{color:black;text-decoration:none;}
A:hover{color:black;text-decoration:underline;}

</style>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="271" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td><img src="images/onlinepoll_title.gif" width="271" height="34"></td>
  </tr>
  <tr> 
    <td>
      <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="D8D8D8">
        <tr>
          <td bgcolor="#FFFFFF">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="10"></td>
              </tr>
              <tr>
                <td align="center"> 
                  <table width="95%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td height="30"> <font color="2394B7"><?=$List[Subject]?></font></td>
                    </tr>
                    <tr> 
                      <td bgcolor="D8D8D8" height="1"></td>
                    </tr>
                    <tr> 
                      <td height="5"></td>
                    </tr>
<?
    // 항목 : 투표수 출력
	for($i=0; $i< sizeof($Contents)-1; $i++) {

		$no = $i+1;
		// %와 바 길이
		$percent = @intval($Vote[$i]/$TotalVote*100);
		$bar_width = 100;
		$bar_length = @intval($Vote[$i]/$TotalVote*$bar_width)+1;
?>                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="20">
                              <?=$no?>
                              . 
                              <?=$Contents[$i]?>
                            </td>
                          </tr>
                          <tr> 
                            <td background="images/line01.gif" height="1"></td>
                          </tr>

                          <tr> 
                            <td height="20"> <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                <tr> 
                                  <td width="69%" align="right" height="20"><img src="images/onlinepoll_ba.gif" width="<?=$bar_length?>" height="<?=$bar_height?>"></td>
                                  <td width="30%">
                                    <?=$Vote[$i]?>
                                    표 : 
                                    <?=$percent?>
                                    % </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td bgcolor="D8D8D8" height="1"></td>
                          </tr>
<?
}
// 총 투표수 : 투표 기간(등록일~종료일,기간)
?>
                          <tr> 
                            <td height="20">총 <?=$TotalVote?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr> 
                <td height="10"></td>
              </tr>
              <tr> 
                <td align="right" height="30"><a href='javascript:window.close();'><img src="images/close_btn.gif" width="67" height="20" border="0"></a>&nbsp;&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
<?
}
?>
<script>
	window.resizeTo(281,300)
</script>