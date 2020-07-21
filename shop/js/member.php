<script language=javascript>

function MemberCheckField(f){


<? if(!$mode): // 입력시만 체크 ?>

// 아이디 체크
if(checkId(f.ID)== false) return false;
if(f.IDCheckFlag.value == "N"){// 아이디 체크 를 했는지 안했는지 체크 
	alert("아이디 중복 체크를 해주십시요");
	return false;
}


<? if($_ENickName == "checked"){?>
// 닉네임체크
if(checkNickName(f.NickName)== false) return false;
if(f.NickCheckFlag.value == "N"){// 닉네임 체크 를 했는지 안했는지 체크 
	alert("닉네임 중복 체크를 해주십시요");
	return false;
}
<? } ?>


if (f.PWD.value.length < 4) {
	alert("비밀번호는 4자 이상이어야 합니다. ");
	f.PWD.focus();
	return false;
}



if ((f.PWD.value) != (f.CPWD.value)) {
	alert("비밀번호재확인을 정확히 입력해 주세요. ");
	f.CPWD.focus();
	return false;
}

// 이름 체크 
if(checkName(f.Name)== false) return false;

<? if($UseJuminCheck == "checked"){?>
// 주민 체크
if( IsJuminChk(f.Jumin1.value , f.Jumin2.value) == false) return false;
if(f.JuminCheckFlag.value == "N"){//  주민번호 체크 를 했는지 안했는지 체크 
	alert("주민번호 체크를 해주십시요");
	return false;
}
<? } // 주민번호 체크시 ?>

<? endif// 입력시?>

<? if($mode): // 수정 모드시 ?>


if ( f.PWD.value != "" && ((f.PWD.value) != (f.CPWD.value))) {
	alert("비밀번호재확인을 정확히 입력해 주세요. ");
	f.CPWD.focus();
	return false;
}

<? endif; ?>


// 생년월일 체크 
<? if($_EBirthDay == "checked" && $_CBirthDay == "checked" ){// 생년월일 체크  ?>
if(!f.BirthYY.value && !f.BirthMM.value && !f.BirthDD.value.value){
	alert("생년월일을 입력해주세요");
	return false;
}
<? } ?>
// 성별 체크 
<? if($_ESex == "checked" && $_CSex == "checked" ){// 성별 체크 ?>
if(!radiocheck(f.Sex)) {
	alert("성별을 입력해 주세요.");	
	return false;
}  
<? } ?>
// 결혼 여부 체크 
<? if($_EMarrStatus == "checked" && $_CMarrStatus == "checked" ){// 결혼 여부 체크  ?>
if(!radiocheck(f.MarrStatus)) {
	alert("결혼여부를 입력해 주세요.");	
	return false;
}  
<? } ?>
// 결혼 기념일 체크 
<? if($_EMarrDate == "checked" && $_CMarrDate == "checked" ){// 결혼 기념일 체크  ?>
if(!f.MarrYY.value && !f.MarrMM.value && !f.MarrDD.value){
	alert("결혼기념일을 입력해주세요");
	return false;
}
<? } ?>

// 이메일체크 
//var Email = f.Email1_1.value + "@" + f.Email1_2.value;
if ( checkEmail(f) == false) return false;
<? if(!$mode){ // 입력시만?>
if(f.MailCheckFlag.value == "N"){// 메일중복 체크 를 했는지 안했는지 체크 
	alert("메일 중복 체크를 해주십시요");
	return false;
}
<? } ?>
// 홈페이지 체크
<? if($_EHomePage == "checked" && $_CHomePage == "checked" ){// 홈페이지 ?>
if  (f.Url.value == "" ) {
	alert("홈페이지주소를 입력해 주세요.");
	f.Url.focus();
	return false;
}  
<? } ?>


// 전화번호 체크
if(!f.Tel1_1.value || !f.Tel1_2.value || !f.Tel1_3.value){
	alert("전화번호를 정확히 입력해주세요");
	return false;
}

// 핸드폰 체크
if(!f.Hand1_1.value || !f.Hand1_2.value || !f.Hand1_3.value){
	alert("핸드폰번호를 정확히 입력해주세요");
	return false;
}
 
// 팩스 체크 (체크시만)
<? if($_EFax == "checked" && $_CFax == "checked" ){ ?>
if(!f.Fax1_1.value || !f.Fax1_2.value || !f.Fax1_3.value){
	alert("팩스번호를 정확히 입력해주세요");
	return false;
}	
<? } ?>

// 주소 체크 
if  (f.Address1.value.length < 5) {
	alert("주소를 정확히 입력해 주세요.");
	f.Address1.focus();
	return false;
}  
if  (f.Address2.value.length < 2) {
	alert("번지수/통/반을 정확히 입력해 주세요.[예:123번지] ");
	f.Address2.focus();
	return false;
} 

// 기타 정보들 

<? if($_EJob == "checked" && $_CJob == "checked"){// 직업 ?>
if  (f.Job.value == "" ) {
	alert("직업을 선택해 주세요.");
	f.Job.focus();
	return false;
}  
<? } ?>
<? if($_EScholarship == "checked" && $_CScholarship == "checked"){// 학력 ?>
if  (f.Scholarship.value == "" ) {
	alert("학력을 선택해 주세요.");
	f.Scholarship.focus();
	return false;
} 
<? } ?>

// 비밀번호 분실시 질문및 답 
<? if($_EPassQna == "checked" && $_CPassQna == "checked"){?>
if  (f.PWDHint.value == "" ) {
	alert("비밀번호 재발급 질문을 선택해 주세요.");
	f.PWDHint.focus();
	return false;
} 
if  (f.PWDAnswer.value == "" ) {
	alert("비밀번호 재발급 답을 입력해 주세요");
	f.PWDAnswer.focus();
	return false;
} 
<? } ?>

// 회사명
<? if($_ECompany == "checked" && $_CCompany == "checked"){ ?>
if  (f.Company.value == "" ) {
	alert("회사명을 입력해 주세요");
	f.Company.focus();
	return false;
} 
<? } ?>

// 대표자명
<? if($_EPresident == "checked" && $_CPresident == "checked"){ ?>
if  (f.President.value == "" ) {
	alert("대표자명을 입력해 주세요");
	f.President.focus();
	return false;
} 
<? } ?>

// 업태
<? if($_EBusiness == "checked" && $_CBusiness == "checked"){ ?>
if  (f.Business.value == "" ) {
	alert("업태를 입력해 주세요");
	f.Business.focus();
	return false;
}
<? } ?>

// 종목
<? if($_EItem == "checked" && $_CItem == "checked"){ ?>
if  (f.Item.value == "" ) {
	alert("종목을 입력해 주세요");
	f.Item.focus();
	return false;
}
<? } ?>

<? if($_ECompNum == "checked" && $_CCompNum == "checked" ){?>
if  (f.LicenseNo.value == "" ) {
	alert("사업자등록번호를 입력해 주세요");
	f.LicenseNo.focus();
	return false;
}
<? } ?>


// 회사 전화
<? if($_ECTel == "checked" && $_CCTel == "checked"){ ?>
if(!f.CTel1_1.value || !f.CTel1_2.value || !f.CTel1_3.value){
	alert("회사전화번호를 정확히 입력해주세요");
	return false;
}	
<? } ?>

// 회사팩스
<? if($_ECFax == "checked" && $_CCFax == "checked"){ ?>
if(!f.CFax1_1.value || !f.CFax1_2.value || !f.CFax1_3.value){
	alert("회사팩스번호를를 정확히 입력해주세요");
	return false;
}	
<? } ?>

// 회사주소
<? if($_ECAddress == "checked" && $_CCAddress == "checked"){ ?>
// 주소 체크 
if  (f.Address3.value.length < 5) {
	alert("주소를 정확히 입력해 주세요.");
	f.Address3.focus();
	return false;
}  
if  (f.Address4.value.length < 2) {
	alert("번지수/통/반을 정확히 입력해 주세요.[예:123번지] ");
	f.Address4.focus();
	return false;
} 
<? } ?>

// 메일 수신 여부
<? if($_EMailReceive == "checked" && $_CMailReceive == "checked"){ ?>
if(f.MailReceive.checked == false) {
	alert("메일수신여부 체크를 해주세요");	
	return false;
}
<? } ?>

// SMS 수신 여부
<? if($_ESMS == "checked" && $_CSMS == "checked"){ ?>
if(f.SMSReceive.checked == false) {
	alert("SMS 수신여부 체크를 해주세요");	
	return false;
}
<? } ?>

//정보공개 여부
<? if($_EInfo == "checked" && $_CInfo == "checked"){ ?>
if(f.MPublic.checked == false) {
	alert("정보공개 여부 체크를 해주세요");	
	return false;
}
<? } ?>

//자기 소개 여부
<? if($_EProfile == "checked" && $_CProfile == "checked"){ ?>
if  (f.MProfile.value == "" ) {
	alert("자기소개서를 입력해 주세요");
	f.MProfile.focus();
	return false;
}
<? } ?>

<? if($USE_ICON_TYPE){ ?>
	if(f.UploadCheckFlag.value == "N"){
		alert("파일을 다시 체크해주세요");		
		return false;		
	}
<? } ?>


	return true;
}// end MemberCheckField


function FillBirthDay(f){

	if ( ! TypeCheck(f.Jumin1.value, NUM)) {
		alert("주민등록 번호에 잘못된 문자가 있습니다. ");
		f.Jumin1.focus();
		return false;
	}

	num = f.Jumin1.value;
	
	mm = parseInt(num.substring(2,4), 10);
	dd = parseInt(num.substring(4,6), 10);
	
	if ((mm < 1) || (mm > 12)) {
		alert ("주민등록 번호 앞자리가 잘못되었습니다.");
		return false;
	}
	
	if ((dd < 1) || (dd > 31)) {
		alert ("주민등록 번호 앞자리가 잘못되었습니다.");
		return false;
	}

	if(f.Jumin1.value.length == 6){
	
		f.BirthYY.value = "19" + num.substring(0,2);
		f.BirthMM.value = num.substring(2,4);
		f.BirthDD.value = num.substring(4,6);
	
	}
	
	f.Jumin2.focus();
}


function checkSexValue(f){// 자동 성별 체크 
	var JuminValue = f.Jumin2.value;
	var DigitNum = JuminValue.substring(0,1);
	if(JuminValue){
		switch(DigitNum){			
			case "1" : 
			case "3" : f.Sex[0].checked = true; break ;			
			case "2" : 
			case "4" : f.Sex[1].checked = true ; break ; 	
		
		}		
	}
}

function mailChange(f){// 메일 선택 
    if(f.sel_email.value){
        f.Email1_2.value=f.sel_email.value;
				//f.Email1_2.readOnly = true;// readOnly 동적 구현 O는 대문자
    } else{
			f.Email1_2.value = "";
			f.Email1_2.focus();	
		}

}

// 아이디 체크 

function checkId(f)
{
	
	if(!f.value){
		alert("아이디를 입력하여 주세요");
		f.focus();
		return false;		
	}	else if(f.value.length < 4 || f.value.length > 20)
	{
		alert("아이디는 4자이상 20자 이내로 구성하십시요.");
		f.focus();
		return false;
	}
	
	for (var i=0; i<f.value.length; i++) {
		var ch = f.value.charAt(i);
		if(i == 0 && !(ch>="a" && "z">=ch) )
		{
			alert("아이디는 반드시 영문자로 시작하여야 합니다.");
			f.focus();
			return false;
		}
		
		if(!((ch>="0" && "9">=ch) || (ch>="a" && "z">=ch) || ch=="-" || ch=="_"))
		{
			alert("아이디에는 문자 " + ch + " 를 사용할 수 없습니다");
			f.focus();			
			return false;
		}
	} 
	
}

// 이름 체크 
function checkName(f) {
	
	if(!f.value){
		alert("이름을 입력하세요!");
		f.focus();
		return false;
	}
	
	
	if (f.value.indexOf(" ") != -1) {
		alert("이름에 공백을 입력할수 없습니다.");
		f.focus();
		return false;		
	}

	for (var i=0; i<f.value.length; i++) {
		var ch = f.value.charAt(i);
	
		if( (ch>="a" && "z">=ch) || ch=="-" || ch=="_" || (ch>="0" && "9">=ch) || (ch>="a" && "z">=ch) || (ch>="A" && "Z">=ch) || ch=="!" || ch=="@" || ch=="$" || ch=="%" || ch=="^" || ch=="&" || ch=="*" )
		{
			alert("이름에는 문자 " +ch+ " 를 사용할 수 없습니다");
			f.focus();
			return false;
		}
	} 
	
}

// 닉네임 체크 
function checkNickName(f)
{				
				if(!f.value){
								alert("닉네임을 입력하여 주세요");
								f.focus();
								return false;
				}

        if( f && f.value.length != 0 )
        {
                if ( f.value.length <= 1 )
                {
                        alert("닉네임은 두 자 이상입니다.");
                        f.focus();
                        return false;
                }

                if ( f.value.indexOf(" ") != -1 )
                {
                        alert("닉네임에 공백을 입력할수 없습니다.");
                        f.focus();
                        return false;
                }

                for (var i=0; i<f.value.length; i++)
                {
                        var ch = f.value.charAt(i);

                        if ( ch=="-" || ch=="_" || (ch>="0" && "9">=ch) || ch=="'" || ch=="\"" || ch=="\\" )
                        {
                                alert("닉메임은 문자 " + ch + " 를 사용할 수 없습니다");
                                f.focus();
                                return false;
                        }
                }
        }
       
}


// 메일 체크 

function checkEmail(f)
{	
	
		Email1_1 = f.Email1_1.value ;
		Email1_2 = f.Email1_2.value ;
		
		if(Email1_1 == ""){
				alert("이메일 주소를 입력해주세요");
				f.Email1_1.focus();
				return false;
			}else if(Email1_2 == ""){
				alert("이메일 주소를 입력해주세요");
				f.Email1_2.focus();
				return false;
			}
			
			
    var id = f.Email1_1.value + "@" + f.Email1_2.value;//str.value;
    var num = id;
    var checkOk = "~!#$%^&*()+|}{\":?><=\\][';/,` ";

    size = id.length;

    var at = -1;
    var dot = -1;
    var special = false;
    var lastdot = -1;

    for(i=0; i<size; ++i) 
    {
        var test = num.charAt(i);
        if( test == "@" ) at = i;
        else if ( test == "." ) 
        {
        if ( dot == -1 ) dot = i;
        lastdot = i;
        }
        else 
        {
        for (j=0; j < checkOk.length ; j++ )
            if ( test == checkOk.charAt(j) ) special = true;
        }
    }

    if ( special ) 
    {
        alert("E-mail에는 " + checkOk + " 등의 특수문자를 사용할 수 없습니다.");
        f.Email1_1.focus();    
        return false;
    }

    if ( lastdot == size - 1 ) 
    {
        alert("E-mail이 형식에 맞지 않습니다. 예) eztotal@eztotal.com");
        f.Email1_1.focus();    
        return false;
    }
   
}


	
// 이미지 관련 함수 	
	function AutoResize(img){ 
	//alert(img);
		foto1= new Image(); 
		foto1.src=(img); 
		Controlla(img);
	} 
	
	function Controlla(img){ 
		if((foto1.width!=0)&&(foto1.height!=0)){ 
			viewFoto(img); 
		} 
		else{ 
			funzione="Controlla('"+img+"')"; 
			intervallo=setTimeout(funzione,20); 
		} 
	} 

	function viewFoto(img){ 
		largh=foto1.width; 
		altez=foto1.height;
		 if(largh >= <? echo $MEMBER_ICON_LIMIT_WIDTH; ?>) {
				largh = <? echo $MEMBER_ICON_LIMIT_WIDTH; ?>;
		 }
		 if(altez >= <? echo $MEMBER_ICON_LIMIT_HEIGHT; ?>) {
				altez = <? echo $MEMBER_ICON_LIMIT_HEIGHT; ?>;
		 }	 
		var imgsiz
		document.imgsiz.width = largh ;
	} 


	function image_onchange(f){    

    if(f.file.value != ""){
			f.sm.src=f.file.value;
			f.sm.style.visibility="visible";
			imgsize = f.file.value;
			img_pre = 'sm';
				if(event.srcElement.value.match(/(.jpg|.jpeg|.gif|.png|.JPG|.JPEG|.GIF|.PNG)/)) {
						document.images[img_pre].src = event.srcElement.value;
						document.images[img_pre].style.display = '';					
						if(f.sm.fileSize > <? echo $MEMBER_ICON_LIMIT_CAPACITY; ?>){ 
							document.images[img_pre].style.display = 'none';
							f.UploadCheckFlag.value = "N";
							alert("<? echo $MEMBER_ICON_LIMIT_CAPACITY; ?>바이트 이상은 업로드 하실수 없습니다.");
						}						
						
				}	else {
						document.images[img_pre].style.display = 'none';		
						if(f.sm.fileSize ==-1){
							f.UploadCheckFlag.value = "N";
							alert("이미지 파일만 가능합니다");
						}
						
				}
		f.UploadCheckFlag.value = "Y";		
    AutoResize(imgsize);	
	
    }                

}



</script>