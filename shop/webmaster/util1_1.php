<?

 // 총 게시물 수 구해오기 검색|일반
 
function total_search($PID) {
    // 현재 시간
	
	global $POLL_TABLE_NAME;
	
	$today = time();
	
	if($PID){
	
	 $WHEREIS = " WHERE PID = '$PID'";
	 $WHEREIS2 = " AND PID = '$PID'";
	 }
		
   
	$total[all] = getSingleValue("select count(*) from ${POLL_TABLE_NAME} $WHEREIS");
	// ing	
    $total[ing] = getSingleValue("select count(*) from ${POLL_TABLE_NAME} where ToDay > $today $WHEREIS2");	  
	// end	
	$total[end] = getSingleValue("select count(*) from ${POLL_TABLE_NAME} where ToDay < $today $WHEREIS2");
    return $total;
}

// 페이지 링크
function page_link($url) {
	global $page_num,$page,$total_page,$path;
     $first_page = intval(($page-1)/$page_num+1)*$page_num-($page_num-1);
     $last_page = $first_page+($page_num-1);
     if($last_page > $total_page) $last_page = $total_page;
     
	 echo"<a href='$url&page=1'><img src='./img/pre.gif' hspace='5' border='0'></a>";
     $prev = $first_page-1;
     if($page > $page_num) echo"<a href='$url&page=$prev'><img src='./img/pre.gif' hspace='5' border='0'></a> ";
    
     for($i = $first_page; $i <= $last_page; $i++) {
       if($page == $i) echo"<b>$i</b> ";
	   else echo"<a href='$url&page=$i' style = 'color:#000000'>$i</a> ";
     }

     $next = $last_page+1;
     if($next <= $total_page) echo"<a href='$url&page=$next'><img src='./img/next.gif' hspace='5' border='0'></a>";

	 echo"<a href='$url&page=$total_page'><img src='./img/next.gif' hspace='5' border='0'></a>";
}

// 공백 체크
function CheckField($field) {
	// if(!ereg("([^[:space:]]+)",$field) || !$field) return true;
	// if(!preg_match("//[^\d]/+)/",$field) || !$field) return true;
	return false;

}

// 숫자 체크
function CheckInt($field) {
	// if(ereg("[^[:digit:]]",$field)) return true;
	if(preg_match("/[^\d]/",$field)) return true;
	//return false;
}
?>