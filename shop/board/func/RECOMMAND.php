<?
$BOARD_TITLE_DESC = getTableName($GID , $BID);
switch($RECOMMAND){
	case "GOOD" : $Rec = "R" ; $Rec_Text = "추천"; $RecPoint = $RecommandPoint ;  break ; 
	case "BAD" : $Rec = "NR" ; $Rec_Text = "비추천"; $RecPoint = $DelRecommandPoint ;break ; 
}
//Flag는 글쓰기 인지 글쓰기(BW) , 코멘트쓰기(BCW) , 회원로그인(ML) , 회원추천(MR) , 추천(R) , 비추(NR) ,
//       주문 종료시 (OF) , 주문상품 반품 (OR) ,  투표참여시(P)
//       글읽기 (BR) , 게시판 다운로드(BD) , 관리자 입력(SI) , 로그인(L)

$result = boolInsertRecommand($BOARD_NAME , $UID , $_COOKIE[MEMBER_ID], $RECOMMAND, "BOARD");

if($result){	
		
	if(isMember() && $PointEnable == "checked"){
		// 글쓴이한테 포인트를 부여 한다..
		$Content = "$_COOKIE[MEMBER_ID]님이 ${BOARD_TITLE_DESC} 게시판 $UID 글에 대한 ${Rec_Text} 포인트 부여" ; 
		$iresult = boolInsertPoint($BOARD_NAME , $LIST[ID] , $_COOKIE[MEMBER_ID] , $RecPoint , $Rec ,$Content);
		if(!$iresult) js_alert("포인트 부여 실패");
	}
	
	js_alert_location("성공적으로 처리되었습니다.","$PHP_SELF?BID=$BID&GID=$GID&mode=view&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
}

?>