<?
//const_array.php의 경로문제를 해결하기 위해서
$MALL_SETTING_PATH = str_replace("/function/const_array.php","", realpath(__FILE__));



############################################################################
# 사이트 시작 시간
############################################################################
if(file_exists( $MALL_SETTING_PATH. "/config/start_time.php"))
	include_once $MALL_SETTING_PATH.  "/config/start_time.php";

// 사이트 고유 번호
$SiteKey = "fsec";


// 등급NickName은 System_Member에서는 불러오지 않는다..중첩되기때믄에
//echo $MALL_SETTING_PATH. "/config/membernickname_info.php";
if(file_exists( $MALL_SETTING_PATH. "/config/membernickname_info.php") && $THEME != "System_Member" )
	include_once $MALL_SETTING_PATH . "/config/membernickname_info.php";

#상품필드네임
if(file_exists( $MALL_SETTING_PATH. "/config/OptionName.php"))
	include_once $MALL_SETTING_PATH . "/config/OptionName.php";

##################################################################################################################
# 차단 아이피 필터
##################################################################################################################

if(file_exists( $MALL_SETTING_PATH. "/function/banip.php"))
	include_once $MALL_SETTING_PATH . "/function/banip.php";

############################################################################
# 테이블 이름
############################################################################

$BANNER_TABLE_NAME = "fsec_Banner"; // 배너 테이블
$COUNTER_IP_TABLE_NAME = "fsec_Counter_Ip"; // 카운터 IP 테이블
$COUNTER_MAIN_TABLE_NAME = "fsec_Counter_Main"; // 카운터 MAIN 테이블
$COUNTER_REFERER_TABLE_NAME = "fsec_Counter_Referer"; // 카운터 REFERER 테이블
$POPUP_TABLE_NAME = "fsec_Popup"; // 팝업창 테이블
$BUYER_TABLE_NAME = "fsec_Buyers"; // 구매자 테이블
$CATEGORY_TABLE_NAME = "fsec_Category"; //카테고리 테이블
$CONTENT_TABLE_NAME = "fsec_Content"; // 컨텐츠 페이지 테이블
$EVALUATION_TABLE_NAME = "fsec_Evalu"; // 상품평가 테이블
$INQUIRY_TABLE_NAME = "fsec_Inquire"; // 문의 테이블
$LOGIN_HISTORY_TABLE_NAME = "fsec_LoginHistory"; // 로그인 히스토리 테이블
$MALL_TABLE_NAME = "fsec_Mall"; // 쇼핑몰 메인 테이블
$MEMBER_TABLE_NAME = "fsec_Members"; // 회원 테이블
$MEMO_TABLE_NAME = "fsec_Memo"; // 쪽지 테이블
$PARTNER_TABLE_NAME = "fsec_Partner"; // 파트너 테이블(배송관리 , 거래처 관리 )
$PERMISSION_TABLE_NAME = "fsec_Auth"; // 관리자 권한 테이블
$POINT_TABLE_NAME = "fsec_Point"; // 포인트 테이블
$POLL_TABLE_NAME = "fsec_Poll" ; // 투표 테이블
$DIARY_TABLE_NAME = "fsec_Diary"; // 일정 테이블
$RECOMMAND_TABLE_NAME = "fsec_Recommand"; // 추천 테이블
$SCRAP_TABLE_NAME = "fsec_Scrap"; // 스크랩 테이블
$BOARD_GROUP_TABLE_NAME = "fsec_Table_Grp"; // 게시판 그룹 테이블
$BOARD_MAIN_TABLE_NAME = "fsec_Table_Main"; // 게시판 메인 테이블
$WISHLIST_TABLE_NAME = "fsec_Wish"; // 위시리스트 테이블
$DEFAULT_TABLE_NAME = "fsec_Table"; // 게시판 테이블 PREFIX 테이블
$CO_BUY_TABLE_NAME = "fsec_CoBuy"; // 공동구매 테이블
$SMS_TABLE_NAME = "fsec_SMS"; // SMS 테이블

############################################################################
# 폴더이름
############################################################################

$STOCK_FOLDER_NAME = "stock";// 상품 이미지 업로드 폴더
$BOARD_FOLDER_NAME = "board";// 게시판 폴더
$MEMBER_FOLDER_NAME = "member";// 회원 폴더
$MEMBER_TEMP_FOLDER_NAME = "member_tmp";// 회원 임시 저장 폴더
$SKIN_FOLDER_NAME = "skin" ; // 스킨 폴더

############################################################################
# 파일 이름
############################################################################

$BOARD_MAIN_FILE_NAME = "board.php";// 게시판 메인 이름
$MEMBER_MAIN_FILE_NAME = "member.php";// 회원 메인 이름
$HTML_MAIN_FILE_NAME = "html.php";// html 메인 이름
$CART_MAIN_FILE_NAME = "bag.php";// 장바구니 메인 이름
$MART_MAIN_FILE_NAME = "mart.php";// 마트 메인 이름
$SEARCH_MAIN_FILE_NAME = "search.php"; // 검색 메인 이름
$ONLINE_CAL_MAIN_FILE_NAME = "calcu.php"; // 온라인 견적 메인 이름
$CO_BUY_MAIN_FILE_NAME = "coorbuy.php"; // 공동 구매 메인 이름

############################################################################
# 관리자 페이지 권한 배열
############################################################################

$ADMIN_MENU_CODE_ARRAY = array(
//	"A" => array(// 기본환경
		"A001" => "System_Basic" ,
		"A002" => "System_Payment" ,
		"A003" => "System_Skin" ,
		"A004" => "System_Email_Content" ,
		"A005" => "System_Info" ,
		"A006" => "System_Info_Insert" ,
		"A007" => "System_Member" ,
		"A008" => "System_Board" ,
		"A009" => "System_Partner" ,
		"A010" => "System_Auth" ,
		"A011" => "System_MainBanner" ,
		"A012" => "System_SMS" ,
		"A015" => "System_Sql" ,
		"A016" => "System_PHPINFO"  ,

//	),
//	"B" => array(// 상품관리
		"B001" => "CategoryManager" ,
		"B002" => "Brand" ,
		"B003" => "Product" ,
		"B004" => "ProductList" ,
		"B005" => "ProductPriceList" ,
		"B006" => "ProductSoldOutList" ,
		"B007" => "ProductTrashList" ,
		"B008" => "ProductWishList" ,
		"B009" => "ProductEstimate" ,
//	),
//	"C" => array(// 주문배송관리
		"C001" => "OrderList" ,
		"C002" => "OrderView" ,
		"C003" => "OrderCompleteList" ,
		"C004" => "OrderReturnList" ,
//	),
//	"D" => array(// 회원관리
		"D001" => "MemberList" ,
		"D002" => "MemberView" ,
		"D003" => "MemberAgeList" ,
		"D004" => "MemberAreaList" ,
		"D005" => "Member" ,
		"D006" => "MemberLoginList" ,
//	),
//	"E" => array(// 메일링관리
		"E001" => "MailSend" ,
//	),
//	"F" => array(// 게시판관리
		"F001" => "GroupManager" ,
		"F002" => "BoardManager",
//	),
//	"G" => array(// 방문자통계보기
		"G001" => "VisitorLog" ,
//	),
//	"H" => array(// 매출/통계분석
		"H001" => "Product_Statistic1" ,
		"H002" => "Product_Statistic2" ,
		"H003" => "Product_Statistic3" ,
//	),
//	"I" => array(// 문의관리
		"I001" => "Customer_InquiryList" ,
//	),
//	"J" => array(// 기타관리
		"J001" => "Popup" ,
		"J002" => "Popup_pop" ,
		"J003" => "Poll" ,
		"J004" => "Diary"

//	)

);

//메뉴에 대한설명
$ADMIN_MENU_NAME_ARRAY = array(
		"A001" => "기본환경설정" ,
		"A002" => "결제환경설정 " ,
		"A003" => "몰스킨설정 " ,
		"A004" => "메일내용설정" ,
		"A005" => "사이트내용설정" ,
		"A006" => "사이트내용입력" ,
		"A007" => "회원설정" ,
		"A008" => "게시판환경설정" ,
		"A009" => "거래처설정" ,
		"A010" => "관리자권한설정" ,
		"A011" => "메인스킨이미지설정" ,
		"A012" => "SMS 설정" ,
		"A015" => "phpMyAdmin" ,
		"A016" => "phpinfo()" ,


		"B001" => "사이트 카테고리관리" ,
		"B002" => "브랜드관리" ,
		"B003" => "상품신규등록" ,
		"B004" => "상품리스트" ,
		"B005" => "상품가격일괄수정" ,
		"B006" => "품절상품관리" ,
		"B007" => "상품휴지통" ,
		"B008" => "위시리스트상품" ,
		"B009" => "상품평관리" ,

		"C001" => "주문 및 배송상품" ,
		"C002" => "주문 및 배송보기" ,
		"C003" => "주문완료상품" ,
		"C004" => "반송상품" ,

		"D001" => "회원정보" ,
		"D002" => "회원정보보기" ,
		"D003" => "회원연령분석" ,
		"D004" => "가입지역분석" ,
		"D005" => "회원가입" ,
		"D006" => "회원접속정보" ,

		"E001" => "메일발송하기" ,

		"F001" => "게시판그룹관리" ,
		"F002" => "게시판관리" ,

		"G001" => "방문자통계보기" ,


		"H001" => "제품/판매 통계" ,
		"H002" => "구매지역 통계" ,
		"H003" => "구매고객층 통계" ,


		"I001" => "고객문의 관리" ,

		"J001" => "팝업창관리" ,
		"J002" => "팝업창등록" ,
		"J003" => "투표관리" ,
		"J004" => "일정관리"

);

############################################################################
# 소스보기 방지/ 숫자만 입력
############################################################################

$SOURCE_PROTECTION_CODE = " oncontextmenu='return false' onselectstart='return false' ondragstart='return false' ";
$ONLY_NUMBER_STYLE = "onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style = 'ime-mode:disabled;'" ;

############################################################################
# 사이트내용 설정
############################################################################

$COMPANY_DESCRIPTION = array(
	"company" => "회사소개" ,
	"agreement" => "회원 약관설정" ,
	"privacy" => "개인보호정책" ,
	"guide" => "이용안내" ,
	"delivery" => "배송 정보안내"  ,
	"exchange" => "교환 환불안내" ,
	"yakdo" => "찾아오시는길"  ,
	"sitemap" => "사이트맵"
);

############################################################################
# 메일내용설정
############################################################################

$MAIL_DESCRIPTION = array(
	"MAIL_CODE_01" => "회원가입" ,
	"MAIL_CODE_02" => "아이디비번찾기" ,
	"MAIL_CODE_03" => "상품추천" ,
	"MAIL_CODE_04" => "쿠폰발행"  ,
	"MAIL_CODE_05" => "주문완료"

);


############################################################################
# 게시판환경설정
############################################################################

$BOARD_CONFIG_TITLE = array(
	"01" => "게시판 기본환경 , 리스트 , 뷰 설정" ,
	"02" => "게시판 권한 , 포인트 , 카테고리설정"
);


############################################################################
# 회원 가입 배열
############################################################################
// 국가 코드
$COUNTRY_CODE_ARRAY = array("AL"=>"Albania","DZ"=>"Algeria","AS"=>"American Samoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica",
"AG"=>"Antigua And Barbuda","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas",
"BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan",
"BO"=>"Bolivia","BA"=>"Bosnia And Herzegowina","BW"=>"Botswana","BV"=>"Bouvet Island","BR"=>"Brazil","IO"=>"British Indian Ocean Territory",
"BN"=>"Brunei Darussalam","BG"=>"Bulgaria","BF"=>"Burkina Faso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada",
"CV"=>"Cape Verde","KY"=>"Cayman Islands","CF"=>"Central African Republic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"Christmas Island",
"CC"=>"Cocos (Keeling) Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CK"=>"Cook Islands","CR"=>"Costa Rica","CI"=>"Cote D'ivoire",
"HR"=>"CROATIA (Local Name: Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"Czech Republic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica",
"DO"=>"Dominican Republic","TP"=>"East Timor","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"El Salvador","GQ"=>"Equatorial Guinea","ER"=>"Eritrea",
"EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"Falkland Islands (Malvinas)","FO"=>"Faroe Islands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France",
"FX"=>"France, Metropolitan","GF"=>"French Guiana","PF"=>"French Polynesia","TF"=>"French Southern Territories","GA"=>"Gabon ","GM"=>"Gambia",
"GE"=>"Georgia","DE"=>"Germany ","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam",
"GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"Heard And Mc Donald Islands","HN"=>"Honduras",
"HK"=>"Hong Kong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran (Islamic Republic Of)","IQ"=>"Iraq","IE"=>"Ireland",
"IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea, Democratic People's Rep. Of","KR"=>"Korea, Republic Of","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"Lao People's Democratic Republic",
"LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"Libyan Arab Jamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania",
"LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia, The Former Yugoslav Rep. Of","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives",
"ML"=>"Mali","MT"=>"Malta","MH"=>"Marshall Islands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico",
"FM"=>"Micronesia, Federated States Of","MD"=>"Moldova, Republic Of","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco",
"MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"Netherlands Antilles","NC"=>"New Caledonia",
"NZ"=>"New Zealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"Norfolk Island","MP"=>"Northern Mariana Islands",
"NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"Papua New Guinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines",
"PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"Puerto Rico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"Russian Federation",
"RW"=>"Rwanda","KN"=>"Saint Kitts And Nevis","LC"=>"Saint Lucia","VC"=>"Saint Vincent And The Grenadines","WS"=>"Samoa","SM"=>"San Marino",
"ST"=>"Sao Tome And Principe","SA"=>"Saudi Arabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"Sierra Leone","SG"=>"Singapore",
"SK"=>"Slovakia (Slovak Republic)","SI"=>"Slovenia","SB"=>"Solomon Islands","SO"=>"Somalia","ZA"=>"South Africa",
"GS"=>"S. Georgia And The S. Sandwich Islands","ES"=>"Spain","LK"=>"Sri Lanka","SH"=>"St. Helena","PM"=>"St. Pierre And Miquelon","SD"=>"Sudan",
"SR"=>"Suriname","SJ"=>"Svalbard And Jan Mayen Islands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"Syrian Arab Republic",
"TW"=>"Taiwan","TJ"=>"Tajikistan","TZ"=>"Tanzania, United Republic Of","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga",
"TT"=>"Trinidad And Tobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"Turks And Caicos Islands","TV"=>"Tuvalu","UG"=>"Uganda",
"UA"=>"Ukraine","AE"=>"United Arab Emirates","GB"=>"United Kingdom","US"=>"United States","UM"=>"United States Minor Outlying Islands","UY"=>"Uruguay",
"UZ"=>"Uzbekistan","VU"=>"Vanuatu","VA"=>"Vatican City State (Holy See)","VE"=>"Venezuela","VN"=>"Viet Nam","VG"=>"Virgin Islands (British)",
"VI"=>"Virgin Islands (U.S.)","WF"=>"Wallis And Futuna Islands","EH"=>"Western Sahara","YE"=>"Yemen","YU"=>"Yugoslavia","ZR"=>"Zaire","ZM"=>"Zambia",
"ZW"=>"Zimbabwe");

$MEMBER_HANDPHONE_ARRAY = array("010","011","016","017","018","019","0130");
$MEMBER_PHONE_ARRAY = array("02" , "031" , "032" , "033" , "041" , "042"  , "043" , "051" , "052" , "053" , "054" , "055" , "061" , "062" , "063" , "064","0502","0504","0505","0506");
$MEMBER_EMAIL_ARRAY = array(
"chol.com" => "chol.com" ,
"daum.net" => "daum.net" ,
"dreamwiz.com" => "dreamwiz.com" ,
"empal.com" => "empal.com" ,
"freechal.com" => "freechal.com" ,
"hanafos.com" => "hanafos.com" ,
"hotmail.com" => "hotmail.com" ,
"intizen.com" => "intizen.com" ,
"kebi.com" => "kebi.com" ,
"korea.com" => "korea.com" ,
"lycos.co.kr" => "lycos.co.kr" ,
"nate.com" => "nate.com" ,
"naver.com" => "naver.com" ,
"netian.com" => "netian.com" ,
"paran.com" => "paran.com" ,
"yahoo.co.kr" => "yahoo.co.kr"
);

$MEMBER_JOB_ARRAY = array(
"01" => "무직" ,
"02" => "학생" ,
"03" => "컴퓨터/인터넷" ,
"04" => "언론" ,
"05" => "공무원" ,
"06" => "자영업" ,
"07" => "주부" ,
"08" => "군인" ,
"09" => "금융/증권/보험업" ,
"10" => "농/수/임/광산업" ,
"11" => "종교인" ,
"12" => "의료인" ,
"13" => "법조인" ,
"14" => "교직자" ,
"15" => "예술인" ,
"16" => "연예/스포츠" ,
"17" => "건설업" ,
"18" => "제조업" ,
"19" => "부동산업" ,
"20" => "운송업" ,
"21" => "회사원" ,
"22" => "가사"
);

$MEMBER_SCHOOL_ARRAY = array(
"01" => "없음" ,
"02" => "초등학교재학" ,
"03" => "초등학교졸업" ,
"04" => "중학교재학" ,
"05" => "중학교졸업" ,
"06" => "고등학교재학" ,
"07" => "고등학교졸업" ,
"08" => "대학교재학" ,
"09" => "대학교졸업" ,
"10" => "대학원재학" ,
"11" => "대학원졸업이상"
);

$MEMBER_PWD_Q_ARRAY = array(

"01" => "나의 보물 제 1호는?" ,
"02" => "가장 생각나는 친구 이름은?" ,
"03" => "가장 생각나는 선생님 성함은?" ,
"04" => "가장 기억에 남는 여행지는?" ,
"05" => "받았던 선물중 기억에 남는 선물은?" ,
"06" => "내가 존경하는 사람은?" ,
"07" => "나의 노래방 애창곡은?" ,
"08" => "내가 가장 좋아하는 만화 주인공은?" ,
"09" => "감명깊게 본 영화는?" ,
"10" => "내가 좋아하는 연예인?" ,
"11" => "내가 좋아하는 스포츠인?" ,
"12" => "여행하고 싶은 나라는?" ,
"13" => "좋아하는 스포츠 팀 이름은?" ,
"14" => "가장 기억에 남는 장소는?" ,
"15" => "나의 출신 초등학교는?" ,
"16" => "다시 태어나면 되고 싶은 것은?" ,
"17" => "인상 깊게 읽은 책 이름은?" ,
"18" => "가장 생각나는 친구 이름은?"
);


// 회원 탈퇴 사유..

$ARRAY_OUT_REASON = array(
"01" => "물건 하자 " ,
"02" => "배송관련" ,
"03" => "맘이 바껴서"
);

// 회원 상태값
$MEMBER_STATUS_ARRAY = array(
"checked" => "승인상태" ,
"hold" => "보류상태" ,
"bad" => "불량상태" ,
"remove" => "탈퇴상태"
);

// 회원 정렬순서
$MEMBER_SORTING_ARRAY = array (
"RegDate" => "등록날짜순 정렬" ,
"ID" => "아이디순 정렬" ,
"Name" => "이름순 정렬" ,
"Point" => "포인트순 정렬" ,
"Grade" => "등급순 정렬" ,
"LoginNum" => "접속순 정렬"  ,
"Jumin1" => "나이구분 정렬"  ,
"Address1" => "지역구분 정렬"  ,
"Sex" => "성별구분 정렬"  ,
);

// 회원 검색영역
$MEMBER_SEARCH_TITLE_ARRAY = array (
"ID" => "아이디" ,
"Name" => "이름" ,
"Address1" => "주소" ,
"Email" => "이메일"
);

// Option 상품 배열
$OPTION_PRODUCT_ARRAY = array(
"N" => "표시안함" ,
"신규" => "신규" , //new
"인기" => "인기" , //hit
"베스트" => "베스트" , //X
"핫" => "핫" , //hot
"세일" => "세일" ,
"가격" => "가격인하"  //가격인하
);


// 이미지 경로 때문에(관리자 모드와 일반 모드의 호환을 위해)
if(ereg("/manager/","$PHP_SELF")) $Option_Path_Src = "../";
else $Option_Path_Src = "./";
$OPTION_IMAGE_ARRAY = array(
"N" => "표시안함" ,
"신규" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_new.gif'>" , //new
"인기" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_hit.gif'>" , //hit
"세일" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_sale.gif'>" ,//세일
"가격" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_down.gif'>" , //가격인하
"베스트" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_best.gif'>" , //베스트
"핫" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_hot.gif'>" , //핫
"NONE" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_none.gif'>"  // 품절
);

// 상품 정렬 배열

$PRODUCT_SORTING_ARRAY = array (
"" => "상품정렬하기" ,
"Ranking" => "순번순 정렬" ,
"UID" => "등록순 정렬" ,
"WDate" => "수정순 정렬" ,
"Price" => "가격순 정렬" ,
"Hit" => "조회순 정렬" ,
"Input" => "재고량순 정렬" ,
"OutPut" => "판매순 정렬" ,
"Point" => "포인트순 정렬"
);

// 주문 상태
$ORDER_STATUS_ARRAY = array(
"10" => "주문접수" ,
"20" => "입금확인" ,
"30" => "배송준비" ,
"40" => "배송중" ,
"50" => "배송완료" ,
"60" => "교환환불"
);

// 주문 배송 정렬
$ORDER_SORT_ARRAY = array(
"Total_Money" => "구매금액순정렬" ,
"Address1" => "구매지역구분" ,
"How_Buy" => "결제방식구분" ,
"ID" => "(비)회원구분 "
);


// 결제 방법
$ORDER_METHOD_ARRAY = array(
"bank" => "무통장입금" ,
"card" => "신용카드결제" ,
"hand" => "핸드폰결제" ,
"autobank" => "계좌이체결제" ,
"escrow" => "에스크로결제"
//"coupon" => "쿠폰결제" ,
);

// 문의 부분 배열 처리
// 문의를 추가 하실수 있습니다. "INQ2" => "AS 문의 "
$COSTOMER_CODE_ARRAY = array(
"INQ1" => "고객문의 관리"
);


// 카테고리 (기본 M)
$CATEGORY_ARRAY = array(
"M" => "사이트"
);

// 투표 배열
$POLL_ARRAY = array(
"POLL1" => "일반투표",
"POLL2" => "이벤트투표"
);


// 거래처 배열
$COMPANY_TYPE_ARRAY = array(
"S" => "공급업체" ,
"D" => "배송업체" ,
"M" => "제조업체" ,
"P" => "PG사"
);

?>
