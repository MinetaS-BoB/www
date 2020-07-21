var NUM = "0123456789"; 
var SALPHA = "abcdefghijklmnopqrstuvwxyz";
var ALPHA = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"+SALPHA;

function OpenZipcode(f){
window.open("./util/zipcode/zipcode.php?form=" + f.name + "&zip1=Zip1_1&zip2=Zip1_2&firstaddress=Address1&secondaddress=Address2","ZipWin","width=490,height=250,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no");
}
function OpenZipcode1(f){
window.open("./util/zipcode/zipcode.php?form=" + f.name + "&zip1=Zip2_1&zip2=Zip2_2&firstaddress=Address3&secondaddress=Address4","ZipWin","width=490,height=250,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no");
}

function moveFocus(num,fromform,toform){
    var str = fromform.value.length;
    if(str == num)
       toform.focus();
}

function IsIntChk(strTmp){// 정수 검사 
    var len, i, imsi;
    strTmp = "" + strTmp;
    len = strTmp.length;
    for(i=0; i<len; i++){
        imsi = strTmp.charAt(i);
        if(imsi<"0" || imsi>"9"){
        return false;
        }
    }
return true;
}


function filterNum(str)
{
    re = /^\$|,/g;
    str = String(str);
    return str.replace(re, "");
} 

function TypeCheck (s, spc) {// 숫자만 , 혹은 영문을 체크 할때..
var i;
	for(i=0; i< s.length; i++) {
		if (spc.indexOf(s.substring(i, i+1)) == -1) {
		return false;
		}
	}        
return true;
}

function PTypeCheck (s) {// 영문+숫자 조합만 가능하도록 (ID검색및 테이블명적을경우)
	
	var C1 = TypeCheck(s,ALPHA);
	var C2 = TypeCheck(s,NUM);
	
	alert("C1 : " + C1);
	alert("C2 : " + C2);
	if(C1 == false || C2 == false){
		return false;
	}else if(C1 == true && C2 == true){
		return true;
	}
		
}




function commaSplit(srcNumber) {
	var txtNumber = '' + srcNumber;
	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	var arrNumber = txtNumber.split('.');
	arrNumber[0] += '.';
		do {
			arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
		} while (rxSplit.test(arrNumber[0]));
		if (arrNumber.length > 1) {
		return arrNumber.join('');
		}
		else {
		return arrNumber[0].split('.')[0];
		}
}

function SetComma(frm) {
var rtn = "";
var val = "";
var j = 0;
x = frm.value.length;

	for(i=x; i>0; i--) {
		if(frm.value.substring(i,i-1) != ",") {
		val = frm.value.substring(i,i-1)+val;
		}
	}
	x = val.length;
	for(i=x; i>0; i--) {
		if(j%3 == 0 && j!=0) {
		rtn = val.substring(i,i-1)+","+rtn; 
		}else {
		rtn = val.substring(i,i-1)+rtn;
		}
	j++;
	}
frm.value = rtn;
}



function SpaceChk( str )
{
     if(str.search(/\s/) != -1){
         return true;
     }else {
         return "";
     }
}

function IsEmailChk( str )
{
     /* check whether input value is included space or not  */
     if(str == ""){
         alert("이메일 주소를 입력하세요.");
         return false;
     }
     var retVal = SpaceChk( str );
     if( retVal != "") {
         alert("이메일 주소를 빈공간 없이 넣으세요.");
         return false;
     }
          
     /* checkFormat */
     var isEmail = /[-!#$%&'*+\/^_~{}|0-9a-zA-Z]+(\.[-!#$%&'*+\/^_~{}|0-9a-zA-Z]+)*@[-!#$%&'*+\/^_~{}|0-9a-zA-Z]+(\.[-!#$%&'*+\/^_~{}|0-9a-zA-Z]+)*/;
     if( !isEmail.test(str) ) {
         alert("이메일 형식이 잘못 되었습니다.");
         return 0;
     }
     if( str.length > 60 ) {
         alert("이메일 주소는 60자까지 유효합니다.");
         return false;
     }
/*
     if( str.lastIndexOf("daum.net") >= 0 || str.lastIndexOf("hanmail.net") >= 0 ) {
          alert("다음 메일 계정은 사용하실 수 없습니다.");
         document.forms[0].email.focus();  
         return 0;
     }
*/

     return true;
}


function IsJuminChk(jumin1, jumin2){
	
	if(jumin1 == "" || jumin2 == ""){
	alert("주민번호를 넣어주세요");
	return false;
	}
	if ((!TypeCheck(jumin1, NUM)) || (!TypeCheck(jumin2, NUM)) ) {
	alert("주민등록번호에 잘못된 문자가 있습니다. ");
	return false;
	}
	// 주민번호 체크안하도록 수정
	return true;
	var i;
	chk = 0;
	for (i=0; i<6; i++) {
	chk += ( (i+2) * parseInt( jumin1.substring( i, i+1) ));
	}
	for (i=6; i<12; i++) {
	chk += ( (i%8+2) * parseInt( jumin2.substring( i-6, i-5) ));         
	}
	chk = 11 - (chk%11);
	chk %= 10;
	if (chk != parseInt( jumin2.substring(6,7))) {
	alert ("정확하지 않은 주민등록 번호입니다.");	
	return false;
	}    

	if ((jumin1.length < 6) || (jumin2.length < 7)) {
	alert("입력하신 주민등록 번호가 정확하지 않습니다. ");
	return false;
	}
	return true;
}	


function chkWorkNum(reg_no1,reg_no2,reg_no3) { 
    reg_no=reg_no1 + reg_no2 + reg_no3
        strNumb = reg_no; 
        
        sumMod        =        0; 
        sumMod        +=        parseInt(strNumb.substring(0,1)); 
        sumMod        +=        parseInt(strNumb.substring(1,2)) * 3 % 10; 
        sumMod        +=        parseInt(strNumb.substring(2,3)) * 7 % 10; 
        sumMod        +=        parseInt(strNumb.substring(3,4)) * 1 % 10; 
        sumMod        +=        parseInt(strNumb.substring(4,5)) * 3 % 10; 
        sumMod        +=        parseInt(strNumb.substring(5,6)) * 7 % 10; 
        sumMod        +=        parseInt(strNumb.substring(6,7)) * 1 % 10; 
        sumMod        +=        parseInt(strNumb.substring(7,8)) * 3 % 10; 
        sumMod        +=        Math.floor(parseInt(strNumb.substring(8,9)) * 5 / 10); 
        sumMod        +=        parseInt(strNumb.substring(8,9)) * 5 % 10; 
        sumMod        +=        parseInt(strNumb.substring(9,10)); 
         
        if (sumMod % 10 != 0) { 
                return false; 
        }
        return true; 
} 

function enter(field) {
  if (event.keyCode == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
      if (field == field.form.elements[i])
        break;
	  i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
  } else {
	  return true;
  }
}

function option(maxvalue,num){
	line = "";
	if (num==0)	{
		first = NowYear-maxvalue;
		last  = NowYear;
	}else{
		first = 1;
		last  = maxvalue;
	}
	for (i = first; i < last + 1 ; i++)	{
		line += "<option value=" + i + ">" + i;
	}
	return line;
}

// 하나 일경우도 선택 되도록 수정
function radiocheck(name){//name : documnet.Forms.name
	var namelength = name.length;	
	if(typeof(namelength) != "undefined"){
	 for($i=0; $i<namelength; $i++){ 
		if(name[$i].checked==true) return true;
	 }
	} else { // 라디오 버턴이 하나일경우
		if(name.checked == true) return true;
	}
}



var win1Open = null

function displayImage(picName, windowName, windowWidth, windowHeight){
return window.open(picName,windowName,"toolbar=no,scrollbars=no,resizable=no,width=" + (parseInt(windowWidth)+20) + ",height=" + (parseInt(windowHeight)+15),"left=0,top=0") 
}

function winClose(){
if(win1Open != null) win1Open.close() 
}

function doNothing(){}
function displayImage(picName, windowName, windowWidth, windowHeight){
var winHandle = window.open("" ,windowName,"toolbar=no,scrollbars=no,status=no, location = no,resizable=no,width=" + windowWidth + ",height=" + windowHeight + ",left=225,top=165")
if(winHandle != null){
var htmlString = "<html><head><title>DETAIL IMAGE</title></head>" 
htmlString += "<body leftmargin=10 topmargin=10 marginwidth=10 marginheight=10>"
htmlString += "<a href=javascript:window.close()><img src=" + picName + " border=0 alt=닫기></a>"
htmlString += "</body></html>"
winHandle.document.open()
winHandle.document.write(htmlString)
winHandle.document.close()
} 
if(winHandle != null) winHandle.focus()
return winHandle
}

function open_memo(skin,MType,ReceiveID){// 쪽지 열기
	void(window.open(skin + "/memo/index.php?MType=" + MType + "&ReceiveID=" + ReceiveID ,"MEMO","toolbar=no,scrollbars=yes,status=no, location = no,resizable=no,width=630,height=500,left=225,top=165"));
}

function open_scrap(skin){// 스크랩 열기
	void(window.open(skin + "/scrap/index.php" ,"SCRAP","left=0,top=0,toolbar=no,scrollbars=yes,status=no, location = no,resizable=no,width=630,height=500,left=225,top=165"));
}
function write_scrap(skin,tbl,uid,type){// 스크랩 쓸때 팝업
	void(window.open(skin + "/scrap/index.php?Tbl=" + tbl + "&UID=" + uid + "&Type=" + type + "&mode=write"  ,"SCRAP","toolbar=no,scrollbars=yes,status=no, location = no,resizable=no,width=630,height=500,left=225,top=165"));
}

function open_sms(skin,receive_phone){//sms 보내기
	void(window.open(skin + "/sms/index.php?addcall=" + receive_phone ,"SMS","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=200,height=500,left=225,top=165"));
}

function open_mail(skin,receive_mail,receive_name){//메일 보내기
	void(window.open(skin + "/mail/index.php?Email=" + receive_mail + "&Name=" + receive_name ,"MAIL","toolbar=no,scrollbars=yes,status=no, location = no,resizable=no,width=630,height=500,left=225,top=165"));
}

function goHomepage(url){ // 홈페이지 방문	
	void(window.open(url));
}




