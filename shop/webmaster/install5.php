<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include "../config/db_info.php";
include "../config/db_connect.php";
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";

if($query =="adminsave"){
$fp = fopen("../config/admin_info.php", "w");
fwrite($fp,"<?
\$ADMIN_NAME = \"$ADMIN_NAME\";
\$COMPANY_NAME = \"$COMPANY_NAME\";
\$ADMIN_TEL = \"$ADMIN_TEL\";
\$ADMIN_EMAIL = \"$ADMIN_EMAIL\";
\$ADMIN_TITLE = \"$ADMIN_TITLE\";
\$COMPANY_BUSINESS_NUM = \"$COMPANY_BUSINESS_NUM\";
\$COMPANY_CEO = \"$COMPANY_CEO\";
\$CUSTOMER_TEL = \"$CUSTOMER_TEL\";
\$CUSTOMER_FAX = \"$CUSTOMER_FAX\";
\$COMPANY_ADD = \"$COMPANY_ADD\";
\$SITE_URL = \"$SITE_URL\";
\$HOME_TITLE = \"$HOME_TITLE\";
\$HOME_DESCRIPTION = \"$HOME_DESCRIPTION\";
\$HOME_KEYWORD = \"$HOME_KEYWORD\";
\$HOME_REFKEYWORD = \"$HOME_REFKEYWORD\";
\$SOURCEPROTECTION = \"checked\";
\$DENYIP = \"$DENYIP\";
\$ALLOWFORADMIN = \"1\";
\$SYSTEM_HDD_SIZE = \"100\";
\$SYSTEM_DB_SIZE = \"50\";
?>"); 
fclose($fp); 


$fp = fopen("../config/bank_info.php", "w"); 
fwrite($fp,"OO은행 12345-67-89012 예금주명"); 
fclose($fp); 

$fp = fopen("../config/cart_info.php", "w"); 
fwrite($fp,"<?
\$PHONE_PACK = \"BANKWELL\";
\$PHONE_ENABLE_MONEY = \"0\";
\$ONLINE_ENABLE = \"checked\";
\$ONLINE_ENABLE = \"checked\";
\$CARD_ENABLE = \"checked\";
\$TACKBAE_ALL = \"checked\";
\$TACKBAE_CUTLINE = \"30000\";
\$TACKBAE_MONEY = \"2500\";
\$CARD_PACK = \"$CARD_PACK\";
\$CARD_ID = \"$CARD_ID\";
\$CARD_ENABLE = \"checked\";
\$CARD_ENABLE_MONEY = \"0\";
\$POINT_ENABLE = \"checked\";
\$POINT_ENABLE_MONEY = \"5000\";
\$POINT_PAY_DATE = \"0\";
\$CARDCHECK_ENABLE = \"$CARDCHECK_ENABLE\";
\$CARDCHECK_RATE = \"$CARDCHECK_RATE\";
\$CARDCHECK_RATE_VALUE1 = \"$CARDCHECK_RATE_VALUE1\";
\$CARDCHECK_RATE_VALUE2 = \"CARDCHECK_RATE_VALUE2\";
\$DIRNOTSAME_METHOD = \"$DIRNOTSAME_METHODE\";
\$DIFF_CARD_RATE = \"$DIFF_CARD_RATE\";
\$DIFF_CARD_VALUE = \"$DIFF_CARD_VALUE\";
\$POINTSTATUS = \"$POINTSTATUS\";
\$POINTRATE = \"$POINTRATE\";
\$PRICEDIFF = \"$PRICEDIFF\";

?>"); 
// PRICEDIFF 차등 가격 사용 여부 
// LPoint 회원 로그인시 포인트 적용
fclose($fp); 

$fp = fopen("../config/membercheck_info.php", "w"); 
fwrite($fp,"<?
\$UseJuminCheck = \"checked\";
\$EGrantSta = \"checked\";
\$USE_BOARD_NICKNAME = \"\";
\$USE_RECOMMEND = \"checked\";
\$LPoint = \"1\";
\$EPoint = \"1000\";
\$RPoint = \"10\";
\$INCLUDE_MALL_SKIN = \"Y\";
\$SendMail = \"Y\";
\$USE_LETTER = \"checked\";
\$LETTER_DEL_DATE = \"50\";
\$NICKNAME_MODIFY_LIMIT_DATE = \"60\";
\$MEMBER_MODIFY_LIMIT_DATE = \"60\";
\$USE_ICON_TYPE = \"1\";
\$MEMBER_OUT_LIMIT_DATE = \"30\";
\$MEMBER_ICON_LIMIT_GRADE = \"1|\";
\$MEMBER_ICON_LIMIT_CAPACITY = \"50000\";
\$MEMBER_ICON_LIMIT_WIDTH = \"40\";
\$MEMBER_ICON_LIMIT_HEIGHT = \"40\";
\$USE_SCRAB = \"checked\";
\$DISABLEID = \"admin,administrator,관리자,운영자,어드민,주인장,webmaster,웹마스터,sysop,시삽,시샵,manager,매니저,메니저,root,루트,su,guest,방문객,테스트,test,test1,test2,test3,test4,test5,test6,test7,test8,test9,tester,master,ceo\";
?>"); 
fclose($fp); 


$fp = fopen("../config/shopDisplay_info.php", "w"); 
fwrite($fp,"<?
\$SIMAGEW = \"120\";
\$SIMAGEH = \"120\";
\$MIMAGEW = \"250\";
\$MIMAGEH = \"250\";
\$LIMAGEW = \"500\";
\$LIMAGEH = \"500\";
\$PIMAGEW = \"550\";
\$PLIMAGEW = \"120\";
\$PLIMAGEH = \"120\";
\$WLIMAGEW = \"120\";
\$WLIMAGEH = \"120\";
\$UserArrayListNo = \"10,20,40,60,80,100\";
\$SubListNo = \"10\";
\$BreakListNo = \"5\";
\$SubPageNo = \"10\";
\$SearchSubListNo = \"10\";
\$BreakSearchListNo = \"5\";
\$SearchSubPageNo = \"10\";
\$GoodsDisplayEstim = \"checked\";
\$GoodsDisplayPid = \"checked\";
\$GoodsDisplayPidCnt = \"10\";
\$BreakGoodPidListNo = \"5\";
?>"); 
fclose($fp); 

$fp = fopen("../config/admin_skin_info.php", "w"); 
fwrite($fp,"<?
\$ListNo = \"20\";
\$PageNo = \"10\";
?>"); 
fclose($fp); 


$fp = fopen("../config/skin_info.php", "w"); 
fwrite($fp,"<?
\$LayOutSkin = \"default\";
\$MainSkin = \"default\";
\$MenuSkin = \"default\";
\$ShopSkin = \"default\";
\$ViewerSkin = \"default\";
\$PageSkin = \"default\";
\$CartSkin = \"default\";
\$CoorBuySkin = \"default\";
\$SearchSkin = \"default\";
\$GoodsNoShow = \"checked\";
\$MemberSkin = \"BASIC\";
\$MyPageSkin = \"BASIC\";
\$WishSkin = \"default\";
\$ZipCodeSkin = \"default\";
\$MemoSkin = \"default\";
\$ScrapSkin = \"default\";
\$SMSSkin = \"icode\";
\$PollSkin = \"default\";
\$CalandarSkin = \"default\";
\$HtmlSkin = \"default\";
\$MailSkin = \"default\";
?>"); 
fclose($fp); 


// 게시판 공통 환경설정 파일
$fp = fopen("../config/board_info.php", "w"); 
fwrite($fp,"<?
\$DENYWORD = \"18아,18놈,18새끼,18년,18뇬,18노,18것,18넘,개년,개놈,개뇬,개새,개색끼,개세끼,개세이,개쉐이,개쉑,개쉽,개시키,개자식,개좆,게색기,게색끼,광뇬,뇬,눈깔,뉘미럴,니귀미,니기미,니미,도촬,되질래,디져라,디진다,디질래,병쉰,병신,뻐큐,뻑큐,뽁큐,삐리넷,새꺄,쉬발,쉬밸,쉬팔,쉽알,스패킹,스팽,시벌,시부랄,시부럴,시부리,시불,시브랄,시팍,시팔,시펄,실밸,십8,십쌔,십창,싶알,쌉년,썅놈,쌔끼,쌩쑈,썅,써벌,썩을년,쎄꺄,쎄엑,쓰바,쓰발,쓰벌,쓰팔,씨8,씨댕,씨바,씨발,씨뱅,씨봉알,씨부랄,씨부럴,씨부렁,씨부리,씨불,씨브랄,씨빠,씨빨,씨뽀랄,씨팍,씨팔,씨펄,씹,아가리,아갈이,엄창,접년,잡놈,재랄,저주글,조까,조빠,조쟁이,조지냐,조진다,조질래,존나,존니,좀물,좁년,좃,좆,좇,쥐랄,쥐롤,쥬디,지랄,지럴,지롤,지미랄,쫍빱,凸,퍽큐,뻑큐,빠큐,ㅅㅂㄹㅁ\";
\$REVOKE_EXTENSION = \"inc|cgi|php|asp|jsp|exe|java|xml|class|aspx|php3|php5|php4|html|htm|shtml\";
\$FILE_NAME_REARRANGE = \"checked\";
\$GRANT_IMAGE_EXTENSION = \"gif|jpg|jpeg|png\";
\$GRANT_FLASH_EXTENSION = \"swf\";
\$GRANT_MOVIE_EXTENSION = \"asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3\";
?>"); 
fclose($fp); 


//SMS 설정정보
$fp = fopen("../config/sms_info.php", "w"); 
fwrite($fp,"<?
\$SMS_CONTENT_MEMBER_REGIS = \"{이름}님의 회원가입을 축하드립니다.
ID:{회원아이디}
{회사명}\";
\$SMS_CONTENT_MEMBER_ORDER = \"{이름}님께서 주문하셨습니다.
{주문번호}
{주문금액}원
{회사명}\";
\$SMS_CONTENT_MEMBER_MONEY_COMMING = \"{이름}님 입금 감사합니다.
{입금액}원
주문번호:
{주문번호}
{회사명}\";
\$SMS_CONTENT_MEMBER_PRODUCT_DELIVERY = \"{이름}님 배송합니다.
택배:{택배회사}
운송장번호:
{운송장번호}
{회사명}\";

\$USE_SMS_MEMBER_REGIS = \"$USE_SMS_MEMBER_REGIS\";
\$USE_SMS_MEMBER_ORDER = \"$USE_SMS_MEMBER_ORDER\";
\$USE_SMS_MEMBER_MONEY_COMMING = \"$USE_SMS_MEMBER_MONEY_COMMING\";
\$USE_SMS_MEMBER_PRODUCT_DELIVERY = \"$USE_SMS_MEMBER_PRODUCT_DELIVERY\";
\$USE_SMS = \"$USE_SMS\";
\$SMS_ADMIN_TEL = \"$SMS_ADMIN_TEL\";
\$SMS_ID = \"$SMS_ID\";
\$SMS_PASSWORD = \"$SMS_PASSWORD\";
\$SMS_SERVER_IP = \"$SMS_SERVER_IP\";
\$SMS_SERVER_PORT = \"$SMS_SERVER_PORT\";

?>"); 
fclose($fp); 


// 회원 등급 기본 세팅

$fp = fopen("../config/membernickname_info.php", "w"); 
fwrite($fp,"<?
\$MEMBER_GRADE_NAME[1] = \"최고관리자\";
\$MEMBER_GRADE_NAME[2] = \"\";
\$MEMBER_GRADE_NAME[3] = \"\";
\$MEMBER_GRADE_NAME[4] = \"\";
\$MEMBER_GRADE_NAME[5] = \"기업회원\";
\$MEMBER_GRADE_NAME[6] = \"\";
\$MEMBER_GRADE_NAME[7] = \"\";
\$MEMBER_GRADE_NAME[8] = \"\";
\$MEMBER_GRADE_NAME[9] = \"\";
\$MEMBER_GRADE_NAME[10] = \"일반회원\";
?>"); 
fclose($fp); 


$Content = "인터넷 사이버몰 利用標準約款<BR>------------------------------------------------- <BR><BR>제1조(목적)<BR>이 약관은 ${ADMIN_TITLE}회사(전자거래 사업자)가 운영하는 ${ADMIN_TITLE} 사이버 몰(이하 \"몰\"이라 한다)에서 제공하는 인터넷 관련 서비스(이하 \"서비스\"라 한다)를 이용함에 있어 사이버몰과 이용자의 권리·의무 및 책임사항을 규정함을 목적으로 합니다. <BR>※ 「PC통신등을 이용하는 전자거래에 대해서도 그 성질에 반하지 않는한 이 약관을 준용합니다」 <BR><BR><BR><BR>제2조(정의)<BR><BR><BR>① \"몰\" 이란 ${ADMIN_TITLE} 회사가 재화 또는 용역을 이용자에게 제공하기 위하여 컴퓨터등 정보통신설비를 이용하여 재화 또는 용역을 거래할 수 있도록 설정한 가상의 영업장을 말하며, 아울러 사이버몰을 운영하는 사업자의 의미로도 사용합니다. <BR><BR>② \"이용자\"란 \"몰\"에 접속하여 이 약관에 따라 \"몰\"이 제공하는 서비스를 받는 회원 및 비회원을 말합니다. <BR><BR>③ 회원\'이라 함은 \"몰\"에 개인정보를 제공하여 회원등록을 한 자로서, \"몰\"의 정보를 지속적으로 제공받으며, \"몰\"이 제공하는 서비스를 계속적으로 이용할 수 있는 자를 말합니다. <BR><BR>④ 비회원\'이라 함은 회원에 가입하지 않고 \"몰\"이 제공하는 서비스를 이용하는 자를 말합니다. <BR><BR><BR><BR>제3조 (약관의 명시와 개정)<BR><BR><BR>① \"몰\"은 이 약관의 내용과 상호, 영업소 소재지, 대표자의 성명, 사업자등록번호, 연락처(전화, 팩스, 전자우편 주소 등) 등을 이용자가 알 수 있도록 ${ADMIN_TITLE} 사이버몰의 초기 서비스화면(전면)에 게시합니다. <BR><BR>② \"몰\"은 약관의규제등에관한법률, 전자거래기본법, 전자서명법, 정보통신망이용촉진등에관한법률, 방문판매등에관한법률, 소비자보호법 등 관련법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다. <BR><BR>③ \"몰\"이 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 몰의 초기화면에 그 적용일자 7일이전부터 적용일자 전일까지 공지합니다. <BR><BR>④ \"몰\"이 약관을 개정할 경우에는 그 개정약관은 그 적용일자 이후에 체결되는 계약에만 적용되고 그 이전에 이미 체결된 계약에 대해서는 개정전의 약관조항이 그대로 적용됩니다. 다만 이미 계약을 체결한 이용자가 개정약관 조항의 적용을 받기를 원하는 뜻을 제3항에 의한 개정약관의 공지기간내에 \'몰\"에 송신하여 \"몰\"의 동의를 받은 경우에는 개정약관 조항이 적용됩니다. <BR><BR>⑤ 이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 정부가 제정한 전자거래소비자보호지침 및 관계법령 또는 상관례에 따릅니다. <BR><BR><BR><BR>제4조(서비스의 제공 및 변경)<BR><BR><BR>① \"몰\"은 다음과 같은 업무를 수행합니다.<BR><BR>1. 재화 또는 용역에 대한 정보 제공 및 구매계약의 체결<BR>2. 구매계약이 체결된 재화 또는 용역의 배송<BR>3. 기타 \"몰\"이 정하는 업무<BR><BR>② \"몰\"은 재화의 품절 또는 기술적 사양의 변경 등의 경우에는 장차 체결되는 계약에 의해 제공할 재화·용역의 내용을 변경할 수 있습니다. 이 경우에는 변경된 재화·용역의 내용 및 제공일자를 명시하여 현재의 재화·용역의 내용을 게시한 곳에 그 제공일자 이전 7일부터 공지합니다.<BR>③ \"몰\"이 제공하기로 이용자와 계약을 체결한 서비스의 내용을 재화의 품절 또는 기술적 사양의 변경등의 사유로 변경할 경우에는 \"몰\"은 이로 인하여 이용자가 입은 손해를 배상합니다. 단, \"몰\"에 고의 또는 과실이 없는 경우에는 그러하지 아니합니다.<BR><BR><BR><BR>제5조(서비스의 중단)<BR><BR><BR>① \"몰\"은 컴퓨터 등 정보통신설비의 보수점검·교체 및 고장, 통신의 두절 등의 사유가 발생한 경우에는 서비스의 제공을 일시적으로 중단할 수 있습니다. <BR><BR>② 제1항에 의한 서비스 중단의 경우에는 \"몰\"은 제8조에 정한 방법으로 이용자에게 통지합니다. <BR><BR>③ \"몰\"은 제1항의 사유로 서비스의 제공이 일시적으로 중단됨으로 인하여 이용자 또는 제3자가 입은 손해에 대하여 배상합니다. 단 \"몰\"에 고의 또는 과실이 없는 경우에는 그러하지 아니합니다. <BR><BR><BR><BR>제6조(회원가입)<BR><BR><BR>① 이용자는 \"몰\"이 정한 가입 양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로서 회원가입을 신청합니다. <BR><BR>② \"몰\"은 제1항과 같이 회원으로 가입할 것을 신청한 이용자 중 다음 각호에 해당하지 않는 한 회원으로 등록합니다. <BR><BR>1. 가입신청자가 이 약관 제7조제3항에 의하여 이전에 회원자격을 상실한 적이 있는 경우, 다만 제7조제3항에 의한 회원자격 상실후 3년이 경과한 자로서 \"몰\"의 회원재가입 승낙을 얻은 경우에는 예외로 한다. <BR>2. 등록 내용에 허위, 기재누락, 오기가 있는 경우 <BR>3. 기타 회원으로 등록하는 것이 \"몰\"의 기술상 현저히 지장이 있다고 판단되는 경우 <BR><BR>③ 회원가입계약의 성립시기는 \"몰\"의 승낙이 회원에게 도달한 시점으로 합니다. <BR><BR>④ 회원은 제15조제1항에 의한 등록사항에 변경이 있는 경우, 즉시 전자우편 기타 방법으로 \"몰\"에 대하여 그 변경사항을 알려야 합니다. <BR><BR><BR><BR>제7조(회원 탈퇴 및 자격 상실 등) <BR><BR><BR>① 회원은 \"몰\"에 언제든지 탈퇴를 요청할 수 있으며 \"몰\"은 즉시 회원탈퇴를 처리합니다. <BR><BR>② 회원이 다음 각호의 사유에 해당하는 경우, \"몰\"은 회원자격을 제한 및 정지시킬 수 있습니다. <BR><BR>1. 가입 신청시에 허위 내용을 등록한 경우 <BR>2. \"몰\"을 이용하여 구입한 재화·용역 등의 대금, 기타 \"몰\"이용에 관련하여 회원이 부담하는 채무를 기일에 지급하지 않는 경우 <BR>3. 다른 사람의 \"몰\" 이용을 방해하거나 그 정보를 도용하는 등 전자거래질서를 위협하는 경우 <BR>4. \"몰\"을 이용하여 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하는 경우 <BR><BR>③ \"몰\"이 회원 자격을 제한·정지 시킨후, 동일한 행위가 2회이상 반복되거나 30일이내에 그 사유가 시정되지 아니하는 경우 \"몰\"은 회원자격을 상실시킬 수 있습니다. <BR><BR>④ \"몰\"이 회원자격을 상실시키는 경우에는 회원등록을 말소합니다. 이 경우 회원에게 이를 통지하고, 회원등록 말소전에 소명할 기회를 부여합니다. <BR><BR><BR><BR>제8조(회원에 대한 통지)<BR><BR><BR>① \"몰\"이 회원에 대한 통지를 하는 경우, 회원이 \"몰\"에 제출한 전자우편 주소로 할 수 있습니다. <BR><BR>② \"몰\"은 불특정다수 회원에 대한 통지의 경우 1주일이상 \"몰\" 게시판에 게시함으로서 개별 통지에 갈음할 수 있습니다. <BR><BR><BR><BR>제9조(구매신청)<BR><BR><BR>\"몰\"이용자는 \"몰\"상에서 이하의 방법에 의하여 구매를 신청합니다. <BR><BR>1. 성명, 주소, 전화번호 입력 <BR>2. 재화 또는 용역의 선택 <BR>3. 결제방법의 선택 <BR>4. 이 약관에 동의한다는 표시(예, 마우스 클릭) <BR><BR><BR><BR>제10조 (계약의 성립)<BR><BR><BR>① \"몰\"은 제9조와 같은 구매신청에 대하여 다음 각호에 해당하지 않는 한 승낙합니다. <BR><BR>1. 신청 내용에 허위, 기재누락, 오기가 있는 경우 <BR>2. 미성년자가 담배, 주류등 청소년보호법에서 금지하는 재화 및 용역을 구매하는 경우 <BR>3. 기타 구매신청에 승낙하는 것이 \"몰\" 기술상 현저히 지장이 있다고 판단하는 경우 <BR><BR>② \"몰\"의 승낙이 제12조제1항의 수신확인통지형태로 이용자에게 도달한 시점에 계약이 성립한 것으로 봅니다. <BR><BR><BR><BR>제11조(지급방법)<BR><BR><BR><BR><BR>몰\"에서 구매한 재화 또는 용역에 대한 대금지급방법은 다음 각호의 하나로 할 수 있습니다.<BR><BR>1. 계좌이체 <BR>2. 신용카드결제 <BR>3. 온라인무통장입금 <BR>4. 전자화폐에 의한 결제 <BR>5. 수령시 대금지급 등 <BR><BR><BR><BR>제12조(수신확인통지·구매신청 변경 및 취소)<BR><BR><BR>① \"몰\"은 이용자의 구매신청이 있는 경우 이용자에게 수신확인통지를 합니다. <BR><BR>② 수신확인통지를 받은 이용자는 의사표시의 불일치등이 있는 경우에는 수신확인통지를 받은 후 즉시 구매신청 변경 및 취소를 요청할 수 있습니다. <BR><BR>③ \"몰\"은 배송전 이용자의 구매신청 변경 및 취소 요청이 있는 때에는 지체없이 그 요청에 따라 처리합니다. <BR><BR><BR><BR>제13조(배송)<BR><BR><BR>\"몰\"은 이용자가 구매한 재화에 대해 배송수단, 수단별 배송비용 부담자, 수단별 배송기간 등을 명시합니다. 만약 \"몰\"의 고의·과실로 약정 배송기간을 초과한 경우에는 그로 인한 이용자의 손해를 배상합니다. <BR><BR><BR><BR>제14조(환급, 반품 및 교환)<BR><BR><BR>① \"몰\"은 이용자가 구매신청한 재화 또는 용역이 품절등의 사유로 재화의 인도 또는 용역의 제공을 할 수 없을 때에는 지체없이 그 사유를 이용자에게 통지하고, 사전에 재화 또는 용역의 대금을 받은 경우에는 대금을 받은 날부터 3일이내에, 그렇지 않은 경우에는 그 사유발생일로부터 3일이내에 계약해제 및 환급절차를 취합니다. <BR><BR>② 다음 각호의 경우에는 \"몰\"은 배송된 재화일지라도 재화를 반품받은 다음 영업일 이내에 이용자의 요구에 따라 즉시 환급, 반품 및 교환 조치를 합니다. 다만 그 요구기한은 배송된 날로부터 20일 이내로 합니다. <BR><BR>1. 배송된 재화가 주문내용과 상이하거나 \"몰\"이 제공한 정보와 상이할 경우 <BR>2. 배송된 재화가 파손, 손상되었거나 오염되었을 경우 <BR>3. 재화가 광고에 표시된 배송기간보다 늦게 배송된 경우 <BR>4. 방문판매등에관한법률 제18조에 의하여 광고에 표시하여야 할 사항을 표시하지 아니한 상태에서 이용자의 청약이 이루어진 경우 <BR><BR><BR><BR>제15조(개인정보보호)<BR><BR><BR>① \"몰\"은 이용자의 정보수집시 구매계약 이행에 필요한 최소한의 정보를 수집합니다. <BR><BR>다음 사항을 필수사항으로 하며 그 외 사항은 선택사항으로 합니다. <BR><BR>1. 성명 <BR>2. 주민등록번호(회원의 경우) <BR>3. 주소 <BR>4. 전화번호 <BR>5. 희망ID(회원의 경우) <BR>6. 비밀번호(회원의 경우) <BR><BR>② \"몰\"이 이용자의 개인식별이 가능한 개인정보를 수집하는 때에는 반드시 당해 이용자의 동의를 받습니다. <BR><BR>③ 제공된 개인정보는 당해 이용자의 동의없이 목적외의 이용이나 제3자에게 제공할 수 없으며, 이에 대한 모든 책임은 \"몰\"이 집니다. 다만, 다음의 경우에는 예외로 합니다. <BR><BR>1. 배송업무상 배송업체에게 배송에 필요한 최소한의 이용자의 정보(성명, 주소, 전화번호)를 알려주는 경우 <BR>2. 통계작성, 학술연구 또는 시장조사를 위하여 필요한 경우로서 특정 개인을 식별할 수 없는 형태로 제공하는 경우 <BR><BR>④ \"몰\"이 제2항과 제3항에 의해 이용자의 동의를 받아야 하는 경우에는 개인정보관리 책임자의 신원(소속, 성명 및 전화번호 기타 연락처), 정보의 수집목적 및 이용목적, 제3자에 대한 정보제공 관련사항(제공받는자, 제공목적 및 제공할 정보의 내용)등 정보통신망이용촉진등에관한법률 제16조제3항이 규정한 사항을 미리 명시하거나 고지해야 하며 이용자는 언제든지 이 동의를 철회할 수 있습니다. <BR><BR>⑤ 이용자는 언제든지 \"몰\"이 가지고 있는 자신의 개인정보에 대해 열람 및 오류정정을 요구할 수 있으며 \"몰\"은 이에 대해 지체없이 필요한 조치를 취할 의무를 집니다. 이용자가 오류의 정정을 요구한 경우에는 \"몰\"은 그 오류를 정정할 때까지 당해 개인정보를 이용하지 않습니다. <BR><BR>⑥ \"몰\"은 개인정보 보호를 위하여 관리자를 한정하여 그 수를 최소화하며 신용카드, 은행계좌 등을 포함한 이용자의 개인정보의 분실, 도난, 유출, 변조 등으로 인한 이용자의 손해에 대하여 모든 책임을 집니다. <BR><BR>⑦ \"몰\" 또는 그로부터 개인정보를 제공받은 제3자는 개인정보의 수집목적 또는 제공받은 목적을 달성한 때에는 당해 개인정보를 지체없이 파기합니다. <BR><BR><BR><BR>제16조(\"몰\"의 의무)<BR><BR><BR>① \"몰은 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하지 않으며 이 약관이 정하는 바에 따라 지속적이고, 안정적으로 재화·용역을 제공하는 데 최선을 다하여야 합니다. <BR><BR>② \"몰\"은 이용자가 안전하게 인터넷 서비스를 이용할 수 있도록 이용자의 개인정보(신용정보 포함)보호를 위한 보안 시스템을 갖추어야 합니다. <BR><BR>③ \"몰\"이 상품이나 용역에 대하여 「표시·광고의공정화에관한법률」 제3조 소정의 부당한 표시·광고행위를 함으로써 이용자가 손해를 입은 때에는 이를 배상할 책임을 집니다. <BR><BR>④ \"몰\"은 이용자가 원하지 않는 영리목적의 광고성 전자우편을 발송하지 않습니다. <BR><BR><BR><BR>제17조( 회원의 ID 및 비밀번호에 대한 의무)<BR><BR><BR>① 제15조의 경우를 제외한 ID와 비밀번호에 관한 관리책임은 회원에게 있습니다. <BR><BR>② 회원은 자신의 ID 및 비밀번호를 제3자에게 이용하게 해서는 안됩니다. <BR><BR>③ 회원이 자신의 ID 및 비밀번호를 도난당하거나 제3자가 사용하고 있음을 인지한 경우에는 바로 \"몰\"에 통보하고 \"몰\"의 안내가 있는 경우에는 그에 따라야 합니다. <BR><BR><BR><BR>제18조(이용자의 의무)<BR><BR><BR>이용자는 다음 행위를 하여서는 안됩니다. <BR><BR>1. 신청 또는 변경시 허위내용의 등록 <BR>2. \"몰\"에 게시된 정보의 변경 <BR>3. \"몰\"이 정한 정보 이외의 정보(컴퓨터 프로그램 등)의 송신 또는 게시 <BR>4. \"몰\" 기타 제3자의 저작권 등 지적재산권에 대한 침해 <BR>5. \"몰\" 기타 제3자의 명예를 손상시키거나 업무를 방해하는 행위 <BR>6. 외설 또는 폭력적인 메시지·화상·음성 기타 공서양속에 반하는 정보를 몰에 공개 또는 게시하는 행위 <BR><BR><BR><BR>제19조(연결\"몰\"과 피연결\"몰\" 간의 관계)<BR><BR><BR>① 상위 \"몰\"과 하위 \"몰\"이 하이퍼 링크(예: 하이퍼 링크의 대상에는 문자, 그림 및 동화상 등이 포함됨)방식 등으로 연결된 경우, 전자를 연결 \"몰\"(웹 사이트)이라고 하고 후자를 피연결 \"몰\"(웹사이트)이라고 합니다. <BR><BR>② 연결 \"몰\"은 피연결 \"몰\"이 독자적으로 제공하는 재화·용역에 의하여 이용자와 행하는 거래에 대해서 보증책임을지지 않는다는 뜻을 연결 \"몰\"의 사이트에서 명시한 경우에는 그 거래에 대한 보증책임을지지 않습니다. <BR><BR><BR><BR>제20조(저작권의 귀속 및 이용제한)<BR><BR><BR>① \"몰\"이 작성한 저작물에 대한 저작권 기타 지적재산권은 \"몰\"에 귀속합니다. <BR><BR>② 이용자는 \"몰\"을 이용함으로써 얻은 정보를 \"몰\"의 사전 승낙없이 복제, 송신, 출판, 배포, 방송 기타 방법에 의하여 영리목적으로 이용하거나 제3자에게 이용하게 하여서는 안됩니다. <BR><BR><BR><BR>제21조(분쟁해결)<BR><BR><BR>① \"몰\"은 이용자가 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리하기 위하여 피해보상처리기구를 설치·운영합니다. <BR><BR>② \"몰\"은 이용자로부터 제출되는 불만사항 및 의견은 우선적으로 그 사항을 처리합니다. 다만, 신속한 처리가 곤란한 경우에는 이용자에게 그 사유와 처리일정을 즉시 통보해 드립니다. <BR><BR>③ \"몰\"과 이용자간에 발생한 분쟁은 전자거래기본법 제28조 및 동 시행령 제15조에 의하여 설치된 전자거래분쟁조정위원회의 조정에 따를 수 있습니다. <BR><BR><BR><BR>제22조(재판권 및 준거법)<BR><BR><BR>① \"몰\"과 이용자간에 발생한 전자거래 분쟁에 관한 소송은 민사소송법상의 관할법원에 제기합니다. <BR><BR>② \"몰\"과 이용자간에 제기된 전자거래 소송에는 한국법을 적용합니다. <BR>";

$sql = "insert into ${CONTENT_TABLE_NAME} (Content , Code , SiteKey) values ('$Content','agreement','$SiteKey')" ;
mysql_query($sql);

// 세팅된 날짜 

$start_time = time();
$fp = fopen("../config/start_time.php", "w"); 
fwrite($fp,"<?
\$SITE_START_DATE = \"{$start_time}\";
?>"); 
fclose($fp); 



// 옵션 이름

$fp = fopen("../config/OptionName.php", "w"); 
fwrite($fp,"<?
\$OptionName[Option1][0] = \"옵션1\";
\$OptionName[Option1][1] = \"checked\";	
\$OptionName[Option2][0] = \"옵션2\";
\$OptionName[Option2][1] = \"checked\";
?>"); 
fclose($fp); 

}

?>


<script>
function login_link(url) {
        window.alert('\n 기초정보 설치가 완료되었습니다.\n\n 쇼핑몰 로그인 페이지로 이동합니다.. \n\n');
        window.top.location=url;
}
</script><BODY onLoad="login_link('./default.php')">
</body>