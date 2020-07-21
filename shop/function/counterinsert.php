<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
  // 사용자 IP 얻어옴
  $user_ip=$REMOTE_ADDR;
  $referer=$HTTP_REFERER;
  if(!$referer) $referer="플래쉬나 직접입력";

  // 오늘의 날자 구함
  $today=mktime(0,0,0,date("m"),date("d"),date("Y"));
  $yesterday=mktime(0,0,0,date("m"),date("d"),date("Y"))-60*60*24;
  $tomorrow=mktime(23,59,59,date("m"),date("d"),date("Y"));
  $time=time();
//------------------- 카운터 테이블에 데이타 입력 부분 -------------------------------------------------------

  // ${COUNTER_MAIN_TABLE_NAME}에서 오늘날짜 행이 없으면 추가.
  $check=mysql_fetch_array(mysql_query("select count(*) from ${COUNTER_MAIN_TABLE_NAME} where date='$today'"));
  if(!$check[0])
  {
   mysql_query("insert into ${COUNTER_MAIN_TABLE_NAME} (date, unique_counter, pageview) values ('$today', '0', '0')");
  }

  // 지금 아이피로 접속한 사람이 오늘 처음 온 사람인지 검사
  $check=mysql_fetch_array(mysql_query("select count(*) from ${COUNTER_IP_TABLE_NAME} where date>=$today and date<$tomorrow and ip='$user_ip'"));
  // 오늘 처음왔을때
  if($check[0]==0)
  {
   // 전체랑 오늘 카운터 올림
   mysql_query("update ${COUNTER_MAIN_TABLE_NAME} set unique_counter=unique_counter+1, pageview=pageview+1 where no=1 or date='$today'");  

   // 오늘 시간대별 ip 입력
   mysql_query("insert into ${COUNTER_IP_TABLE_NAME} (date, ip) values ('$time','$user_ip')");
  }
  // 오늘 한번 이상 온 상태일때
  else
  {
   // 페이지뷰 올림
   mysql_query("update ${COUNTER_MAIN_TABLE_NAME} set pageview=pageview+1 where no=1 or date='$today'");
  }

  // referer 값 저장
  $check2=mysql_fetch_array(mysql_query("select count(*) from ${COUNTER_REFERER_TABLE_NAME} where date=$today and referer='$referer'"));
   if($check2[0]==0)
   {
    mysql_query("insert into ${COUNTER_REFERER_TABLE_NAME} (date, referer, hit) values ('$today','$referer','1')");
   }
   else
   {
    mysql_query("update ${COUNTER_REFERER_TABLE_NAME} set hit=hit+1 where date=$today and referer='$referer'");
   }
   ?>
