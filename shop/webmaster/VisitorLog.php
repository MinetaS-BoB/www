<?
include ("./ROOT_CHECK.php");
  // 날자 세팅
  if(!$year) $year=date("Y");
  if(!$month) $month=date("m");
  if(!$day) $day=date("d");
  // 사용자 IP 얻어옴
  $user_ip=$REMOTE_ADDR;
  $referer=$HTTP_REFERER;
  // 오늘의 날자 구함
  $today=mktime(0,0,0,$month,$day,$year);
  $yesterday=mktime(0,0,0,$month,$day,$year)-3600*24;
  // 이번달의 첫번째 날자 구함
  $month_start=mktime(0,0,0,$month,1,$year);
  // 이번달의 마지막 날자 구함
  $lastdate=01;
  while (checkdate($month,$lastdate,$year)): 
    $lastdate++;  
  endwhile;
  $lastdate=mktime(0,0,0,$month,$lastdate,$year);
  if(!$no)$no=1;
?>
<table width="735" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr> 
          <td align="center" bgcolor="#FFFFFF"><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30" class="black_16"><strong><font color="#3366CC">방문자통계</font></strong></td>
              </tr>
              <tr> 
                <td>unique 값은 금일 순수 방문자수를 표시합니다.(1인 1번 이상 책크되지 않음)</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td></td>
  </tr>
  <tr> 
    <td><table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
        <form method=post name = "VisitFrm" action="<?=$PHP_SELF?>">
          <input type=hidden name=no value="<? echo $no; ?>">
          <input type=hidden name= menushow value=<? echo $menushow; ?>>
          <input type=hidden name=THEME value="<?  echo $THEME; ?>">
          <tr> 
            <td valign=bottom width="100%" <? echo $TITLE_STYLE ; ?>>방문자 통계 보기</td>
          </tr>
          <tr> 
            <td align=right width=417 <? echo $LEFT_STYLE; ?>><b>Year : 
              <select name="year">
                <?
$ThisYear = date("Y");
for($i = ${ThisYear};$i >= date("Y" , $SITE_START_DATE );$i--) {
if($year == $i) echo "<option value='$i' selected>$i</option>\n";
else echo "<option value='$i'>$i</option>\n";
}
?>
              </select> &nbsp;&nbsp; Month : 
              <select name="month">
                <?
for($i=1;$i<=12;$i++) {
if($month == $i) echo "<option value='$i' selected>$i</option>\n";
else echo "<option value='$i'>$i</option>\n";
}
?>
              </select> &nbsp; Day : 
              <select name="day">
                <?
for($i=1;$i<=31;$i++) {
if($day == $i) echo "<option value='$i' selected>$i</option>\n";
else echo "<option value='$i'>$i</option>\n";
}
?></b>
                </select> <img src = "./img/btn_set/btn_move_02.gif"  align = absmiddle onClick = "javascript:document.VisitFrm.submit();" style = "cursor:hand"> 
            </td>
          </tr>
          <!-- --------------------------- -->
          <?
//-------------------------- 카운터 수 구해옴 -----------------------------//
  // 전체
  $total=mysql_fetch_array(mysql_query("select unique_counter, pageview from ${COUNTER_MAIN_TABLE_NAME} where no=1"));
  $count[total_hit]=$total[0];
  $count[total_view]=$total[1];
  // 오늘 카운터 읽어오는 부분
  $detail=mysql_fetch_Array(mysql_query("select unique_counter, pageview from ${COUNTER_MAIN_TABLE_NAME} where date='$today'"));
  $count[today_hit]=$detail[0];
  $count[today_view]=$detail[1];
  // 어제 카운터 읽어오는 부분
  $detail=mysql_fetch_Array(mysql_query("select unique_counter, pageview from ${COUNTER_MAIN_TABLE_NAME} where date='$yesterday'"));
  $count[yesterday_hit]=$detail[0];
  $count[yesterday_view]=$detail[1];
  // 최고 카운터 읽어오는 부분
  $detail=mysql_fetch_Array(mysql_query("select max(unique_counter), max(pageview) from ${COUNTER_MAIN_TABLE_NAME} where no>1"));
  $count[max_hit]=$detail[0];
  $count[max_view]=$detail[1];
  // 최저 카운터 읽어오는 부분
  $detail=mysql_fetch_Array(mysql_query("select min(unique_counter), min(pageview) from ${COUNTER_MAIN_TABLE_NAME} where no>1 and date<$today"));
  $count[min_hit]=$detail[0];
  $count[min_view]=$detail[1];
//-----------------------------------------------------------------------------
// 전체카운터 (1)
//-----------------------------------------------------------------------------
if($no=="1"):
?>
          <tr> 
            <td bgcolor=#ffffff height=40><font color="#000000">전체 방문자수 : 
              <?=$count[total_hit]?>
              <br>
              전체 페이지뷰 : 
              <?=$count[total_view]?>
              </font></td>
          </tr>
          <tr> 
            <td bgcolor=#ffffff height=40><font color="#000000"> 오늘 방문자수 : 
              <?=$count[today_hit]?>
              <br>
              오늘 페이지뷰 : 
              <?=$count[today_view]?>
              </font></td>
          </tr>
          <tr> 
            <td bgcolor=#ffffff height=40><font color="#000000">어제 방문자수 : 
              <?=$count[yesterday_hit]?>
              <br>
              어제 페이지뷰 : 
              <?=$count[yesterday_view]?>
              </font></td>
          </tr>
          <tr> 
            <td bgcolor=#ffffff height=40><font color="#000000">최고 방문자수 : 
              <?=$count[max_hit]?>
              <br>
              최고 페이지뷰 : 
              <?=$count[max_view]?>
              </font></td>
          </tr>
          <tr> 
            <td bgcolor=#ffffff height=40><font color="#000000">최저 방문자수 : 
              <?=$count[min_hit]?>
              <br>
              최저 페이지뷰 : 
              <?=$count[min_view]?>
              </font></td>
          </tr>
          <!-- --------------------------- -->
          <?
//-----------------------------------------------------------------------------
// 오늘 시간대별 카운터 (2)
//-----------------------------------------------------------------------------
elseif($no=="2"):
?>
          <tr> 
            <td bgcolor=#ffffff height=25>&nbsp; <font color="#000000"> 
              <?=$month?>
              월 
              <?=$day?>
              일 방문자수 : 
              <?=$count[today_hit]?>
              <br>
              &nbsp; 
              <?=$month?>
              월 
              <?=$day?>
              일 페이지뷰 : 
              <?=$count[today_view]?>
              </font></td>
          </tr>
          <tr> 
            <td align=middle bgcolor=#ffffff height=30> <table cellspacing=0 cellpadding=1 width="98%" border=0 >
                <?  
  $max=1;
  for($i=0;$i<24;$i++)
  {
   $time1=mktime($i,0,0,$month,$day,$year);
   $time2=mktime($i,59,59,$month,$day,$year);
   $temp=mysql_fetch_array(mysql_query("select count(*) from ${COUNTER_IP_TABLE_NAME} where date>='$time1' and date<='$time2'"));
   $time_count[$i]=$temp[0];
   if($max<$time_count[$i]) $max=$time_count[$i];
  }
 
  for($i=0;$i<24;$i++)
  {
   $per1=(int)($time_count[$i]/$max*100);
   if($per1>100)$per1=99;
?>
                <tr> 
                  <td width="9%"><font color="#000000">- 
                    <?=$i?>
                    시 </font></td>
                  <td align=left width="76%"><img src="img/grp2.gif" width="<?=$per1?>%" height="10" alt='<?=$i?>시 방문자수 : <?=$time_count[$i]?>'></td>
                  <td width="15%">&nbsp; <font color=blue>Unique 
                    <?=$time_count[$i]?>
                    </font></td>
                </tr>
                <?
  } /* for($i=0;$i<24;$i++)문 닫음 */
?>
              </table></td>
          </tr>
          <!-- --------------------------- -->
          <?
//-----------------------------------------------------------------------------
// 주간별 카운터 (3)
//-----------------------------------------------------------------------------
elseif($no=="3"):
 $start_day=$day;
 while(date('l',mktime(0,0,0,$month,$start_day,$year))!='Sunday')
 {
  $start_day--;
 }
 $last_day=$day;
 while(date('l',mktime(0,0,0,$month,$last_day,$year))!='Saturday')
 {
  $last_day++;
 }
 $start_time=mktime(0,0,0,$month,$start_day,$year);
 $last_time=mktime(23,59,59,$month,$last_day,$year);
 
 $detail=mysql_fetch_Array(mysql_query("select sum(unique_counter), sum(pageview) from ${COUNTER_MAIN_TABLE_NAME} where date>=$start_time and date<=$last_time"));
 $count[week_hit]=$detail[0];
 $count[week_view]=$detail[1];
?>
          <tr> 
            <td bgcolor=#ffffff height=25>&nbsp; 
              <?=$month?>
              월 
              <?=$start_day?>
              ~ 
              <?=$last_day?>
              일 방문자수 : 
              <?=$count[week_hit]?>
              <br> &nbsp; 
              <?=$month?>
              월 
              <?=$start_day?>
              ~ 
              <?=$last_day?>
              일 페이지뷰 : 
              <?=$count[week_view]?>
            </td>
          </tr>
          <tr> 
            <td align=middle bgcolor=#ffffff height=30> <table cellspacing=0 cellpadding=1 width="98%" border=0 >
                <?
  $max1=1;
  $max2=1;
  for($i=0;$i<7;$i++)
  {
   $time=mktime(0,0,0,$month,$start_day+$i,$year);
   $temp=mysql_fetch_array(mysql_query("select unique_counter, pageview from ${COUNTER_MAIN_TABLE_NAME} where date='$time'"));
   $time_count1[$i]=$temp[0];
   if($max1<$time_count1[$i]) $max1=$time_count1[$i];
   $time_count2[$i]=$temp[1];
   if($max2<$time_count2[$i]) $max2=$time_count2[$i];
  }
  $week=array("일요일","월요일","화요일","수요일","목요일","금요일","토요일");
  for($i=0;$i<7;$i++)
  {
   $per1=(int)($time_count1[$i]/$max1*100+1);
   $per2=(int)($time_count2[$i]/$max2*100+1);
   if($per1>100)$per1=99;
   if($per2>100)$per2=99;
?>
                <tr> 
                  <td width="11%">- 
                    <?=$week[$i]?>
                  </td>
                  <td width="66%"> <table width="200" border="0">
                      <tr> 
                        <td><img src="img/grp1.gif" width="<?=$per1?>%" height="10" alt='<?=$week[$i]?> 방문자수 : <?=$time_count1[$i]?>'></td>
                      </tr>
                      <tr> 
                        <td><img src="img/grp2.gif" width="<?=$per2?>%" height="10" alt='<?=$week[$i]?> 페이지뷰 : <?=$time_count2[$i]?>'></td>
                      </tr>
                    </table></td>
                  <td width="23%">&nbsp; <font color=blue>Unique : 
                    <?=$time_count1[$i]?>
                    </font><br> &nbsp; <font color=red>PageView : 
                    <?=$time_count2[$i]?>
                    </font></td>
                </tr>
                <?
  }/* for($i=0;$i<7;$i++) */
?>
              </table></td>
          </tr>
          <!-- --------------------------- -->
          <?
//-----------------------------------------------------------------------------
// 월간카운터 (4)
//-----------------------------------------------------------------------------
elseif($no=="4"):
  $total_month_counter=mysql_fetch_array(mysql_query("select sum(unique_counter), sum(pageview) from ${COUNTER_MAIN_TABLE_NAME} where date>='$month_start' and date<='$lastdate'"));
?>
          <tr> 
            <td bgcolor=#ffffff height=25>&nbsp; 
              <?=$month?>
              월 방문자수 : 
              <?=$total_month_counter[0]?>
              <br> &nbsp; 
              <?=$month?>
              월 페이지뷰 : 
              <?=$total_month_counter[1]?>
            </td>
          </tr>
          <tr> 
            <td align=middle bgcolor=#ffffff height=30> <table cellspacing=0 cellpadding=1 width="98%" border=0 >
                <?
  // 이번달 카운터 (각각)
  $max=mysql_fetch_array(mysql_query("select max(unique_counter), max(pageview) from ${COUNTER_MAIN_TABLE_NAME} where date>='$month_start' and date<='$lastdate'"));
  $month_counter=mysql_query("select date, unique_counter, pageview from ${COUNTER_MAIN_TABLE_NAME} where date>='$month_start' and date<='$lastdate'"); 
  while($data=mysql_fetch_array($month_counter)):
   $per1=$data[unique_counter]/$max[0]*100;
   $per2=$data[pageview]/$max[1]*100;
?>
                <tr> 
                  <td width="12%"><font color="#000000">- 
                    <?=date("d 일",$data[date])?>
                    </font></td>
                  <td align=left width="53%"> <table width="200" border="0">
                      <tr> 
                        <td><img src="img/grp1.gif" width="<?=$per1?>%" height="10" alt='Unique : <?=$data[unique_counter]?>'></td>
                      </tr>
                      <tr> 
                        <td><img src="img/grp2.gif" width="<?=$per2?>%" height="10" alt='PageView : <?=$data[pageview]?>'></td>
                      </tr>
                    </table></td>
                  <td width="35%">&nbsp; <font color=blue>Unique : 
                    <?=$data[unique_counter]?>
                    </font><br> &nbsp; <font color=red>PageView : 
                    <?=$data[pageview]?>
                    </font></td>
                </tr>
                <?		 
  endwhile;
?>
              </table></td>
          </tr>
          <!-- --------------------------- -->
          <?
//-----------------------------------------------------------------------------
// 년간카운터 (5)
//-----------------------------------------------------------------------------
elseif($no=="5"):
  $year_start=mktime(0,0,0,1,1,$year);
  $year_last=mktime(23,59,59,12,31,$year);
  $total_year_counter=mysql_fetch_array(mysql_query("select sum(unique_counter), sum(pageview) from ${COUNTER_MAIN_TABLE_NAME} where date>='$year_start' and date<='$year_last'"));
?>
          <tr> 
            <td bgcolor=#ffffff height=25>&nbsp; 
              <?=$year?>
              년 방문자수 : 
              <?=$total_year_counter[0]?>
              <br> &nbsp; 
              <?=$year?>
              년 페이지뷰 : 
              <?=$total_year_counter[1]?>
            </td>
          </tr>
          <tr> 
            <td align=middle bgcolor=#ffffff height=30 valign="top"> <table cellspacing=0 cellpadding=1 width="98%" border=0 >
                <?
  // 이번달 카운터 (각각)
$max1=1;
  $max2=1;
  for($i=0;$i<7;$i++)
  {
   $time=mktime(0,0,0,$month,$start_day+$i,$year);
   $temp=mysql_fetch_array(mysql_query("select unique_counter, pageview from ${COUNTER_MAIN_TABLE_NAME} where date='$time'"));
   $time_count1[$i]=$temp[0];
   if($max1<$time_count1[$i]) $max1=$time_count1[$i];
   $time_count2[$i]=$temp[1];
   if($max2<$time_count2[$i]) $max2=$time_count2[$i];
  }
  $mmax=array("31","28","31","30","31","30","31","31","30","31","30","31");
  $max=1;
  $max2=1;
  for($i=0;$i<12;$i++)
  {
   $sdate=mktime(0,0,0,$i+1,1,$year);
   $edate=mktime(0,0,0,$i+1,$mmax[$i],$year);
   $year_counter=mysql_query("select sum(unique_counter), sum(pageview) from ${COUNTER_MAIN_TABLE_NAME} where date>='$sdate' and date<='$edate'");
   $temp=mysql_fetch_array($year_counter);
   $time_count1[$i]=$temp[0];
   if($max1<$time_count1[$i]) $max1=$time_count1[$i];
   $time_count2[$i]=$temp[1];
   if($max2<$time_count2[$i]) $max2=$time_count2[$i];
  }
  
  for($i=0;$i<12;$i++)
  {
   $per1=(int)($time_count1[$i]/$max1*100+1);
   $per2=(int)($time_count2[$i]/$max2*100+1);
   if($per1>100)$per1=99;
   if($per2>100)$per2=99;
   $j=$i+1;
?>
                <tr> 
                  <td width="11%"><font color="#000000">- 
                    <?=$j?>
                    월 </font></td>
                  <td align=left width="66%"> <table width="200" border="0">
                      <tr> 
                        <td><img src="img/grp1.gif" width="<?=$per1?>" height="10" alt='<?=$week[$i]?> 방문자수 : <?=$time_count1[$i]?>'></td>
                      </tr>
                      <tr> 
                        <td><img src="img/grp2.gif" width="<?=$per2?>" height="10" alt='<?=$week[$i]?> 페이지뷰 : <?=$time_count2[$i]?>'></td>
                      </tr>
                    </table>
                    <br> </td>
                  <td width="23%">&nbsp; <font color=blue>Unique : 
                    <?=$time_count1[$i]?>
                    </font><br> &nbsp; <font color=red>PageView : 
                    <?=$time_count2[$i]?>
                    </font></td>
                </tr>
                <?		 
  } /* for($i=0;$i<12;$i++) */
?>
              </table></td>
          </tr>
          <!-- --------------------------- -->
          <?
//-----------------------------------------------------------------------------
// 접속자 방문경로?(6)
//-----------------------------------------------------------------------------
elseif($no=="6"):
?>
          <tr> 
            <td align=middle bgcolor=#ffffff height=30 valign="top"><table cellspacing=0 cellpadding=1 width="98%" border=0 >
                <tr> 
                  <td align=left> 
                    <?

$TOTAL_STR = "SELECT count(*) FROM ${COUNTER_REFERER_TABLE_NAME} where date='$today'";
$TOTAL_QRY = mysql_query($TOTAL_STR);
$TOTAL = @mysql_result($TOTAL_QRY, 0, 0);

$LIST_NO=50; /* 페이지당 출력 리스트 수 */
$BOTTOM_NO=10; /* 페이지 밑의 출력 수 */
if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
//--페이지 나타내기--
$TP = ceil($TOTAL / $LIST_NO) ; /* 페이지 하단의 총 페이지수 */
$CB = ceil($CURRENT_PAGE / $BOTTOM_NO);
$SP = ($CB - 1) * $BOTTOM_NO + 1;
$EP = ($CB * $BOTTOM_NO);
$TB = ceil($TP / $BOTTOM_NO);
		  
$START_NO = ($CURRENT_PAGE - 1) * $LIST_NO;
$BOARD_NO=$TOTAL-($LIST_NO*($CURRENT_PAGE-1));
  $ip=mysql_query("select referer, hit from ${COUNTER_REFERER_TABLE_NAME} where date='$today' order by hit desc LIMIT $START_NO, $LIST_NO");

  while($data=mysql_fetch_array($ip))

  {

   if(strlen($data[referer])>90) 

   {

    $temp=substr($data[referer],0,90);

    $text="$temp..."; 

   }

   else $text=$data[referer];

   if(!eregi("직접입력", $data[referer])) $data[referer]="<a href=$data[referer] target=_blank><font color='black'>$text</font></a>";

   echo "&nbsp;&nbsp;&nbsp; - $data[referer] ($data[hit])<br>";

  }

?>
                  </td>
                </tr>
              </table></td>
          </tr>
          <!-- 페이지 처리-->
          <tr> 
            <td bgcolor = FFFFFF><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor = FFFFFF >
                <tr> 
                  <td align = center> 
				  
<?
	$PostValue = "no=6&menushow=$menushow&THEME=$THEME&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword&year=$year&month=$month&day=$day";
	include "./adminskin/pageskin/$PGSKIN/index.php" ; 
?>
                    
                  </td>
                </tr>
              </table></td>
          </tr>
          <!-- 페이지 처리-->
          <?
//-----------------------------------------------------------------------------
// 접속자 방문경로?(6)
//-----------------------------------------------------------------------------
elseif($no=="7"):
?>
          <tr> 
            <td align=middle bgcolor=#ffffff height=30 valign="top"><table cellspacing=0 cellpadding=1 width="98%" border=0 >
                <tr> 
                  <td align=left> 
                    <?
  $sqlqry=mysql_query("select referer from ${COUNTER_REFERER_TABLE_NAME} where date > $month_start and date <='$today' order by hit desc") or die(mysql_error());
  $k=0;
  while($list = mysql_fetch_array($sqlqry)):
  $split_unique_referer = split("\/", $list[referer]);
  if($split_unique_referer[2])
  $unique_referer[$k] = "http://".$split_unique_referer[2];
  else $unique_referer[$k] = "플래쉬나 직접입력";
  $k++;
  endwhile;
/* 월간 경로중 unique 한 값을 구한다. */
  $unique_referer_value = array_unique($unique_referer);
  $k=0;
  for($i=0; $i < sizeof($unique_referer); $i++){
     if($unique_referer_value[$i]){
     $refer_value[$k] = $unique_referer_value[$i];
     $k++;
     }
  }


/* 아래는 실제 unique 한 방문 경로를 넣어서 실제 값을 도출 한다.*/
for($i=0; $i < sizeof($refer_value); $i++){

 
  $ip=mysql_query("select sum(hit) from ${COUNTER_REFERER_TABLE_NAME} where date > $month_start and date <='$today' and referer like '$refer_value[$i]%' order by hit desc") or die(mysql_error());
  $hit = mysql_result($ip, 0, 0);
  $countNo++;
  

   echo "&nbsp;&nbsp;&nbsp; - $refer_value[$i] ($hit)<br>";

  }

?>
                  </td>
                </tr>
              </table></td>
          </tr>
          <?
endif;
//-----------------------------------------------------------------------------
//  하단부분
//-----------------------------------------------------------------------------
?>
        </form>
      </table></td>
  </tr>
</table>
