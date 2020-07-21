//////////////////////////°æ°íÃ¢.Æ÷Ä¿½º
function alert_focus(fld,msg){
	alert(msg);
	fld.focus();
	return;
}

//////////////////////////ÇÊµå °Ë»ç
function check_field(fld) {
    if ((fld.value = trim(fld.value)) == ""||fld.value.length<1) {	   
		return false;
    }else{
		return true;
	}
}

//////////////////////////E-Mail °Ë»ç
function email_check(email) {
	pattern=/^[0-9a-zA-Z]+[\.0-9a-zA-Z_-]*[\.a-zA-Z]+[\.0-9a-zA-Z_-]*@[0-9a-zA-Z][0-9a-zA-Z_-]*[a-zA-Z]+[0-9a-zA-Z_-]*\..*[a-zA-Z][a-zA-Z]+$/;
    if (email.value.search(/(\S+)@(\S+)\.(\S+)/) == -1){
        return false;
    } else {
		if (pattern.test(email.value)) {
			return true;
		} else {
			return false;
		}
	}
}

//////////////////////////hanmail,daum °èÁ¤ ¸ÞÀÏ °Ë»ç
function daumemail_check(email) {
	var pattern1 =/([hanmail]|[daum])\.([net])/;
	if (pattern1.test(email.value)) {
        return true;
    } else {
        return false;
	}
}

//////////////////////////////////////// ¾ËÆÄºª °Ë»ç
function alpha_check (alpha){
	var pattern =/^[0-9A-Za-z]*$/;

	if (pattern.test(alpha.value)){
		return true;
	}else{
		return false;
	}
}

//////////////////////////////////////// ¼ýÀÚ °Ë»ç
function number_check (number){
	var pattern =/^[0-9]*$/;

	if (pattern.test(number.value)){
		return true;
	}else{
		return false;
	}
}

//////////////////////////////////////// ÇÑ±Û °Ë»ç
function han_check (han){
	var pattern =/^[°¡-ÆR]*$/;

	if (pattern.test(han.value)){
		return true;
	}else{
		return false;
	}
}

//////////////////////////////////////////URL °Ë»ç
function url_check (url){
	var pattern =/^[a-z]+:\/\/([a-z][a-z_-]+\.[a-zA-Z\.\/~]+)*$/;
			
	if (pattern.test(url.value)){
		return true;
	}else{
		return false;
	}
}

///////////////////////////ÀüÈ­¹øÈ£ °Ë»ç
function phone_check(Phone) {
	var pattern1 = /(0[2-6][0-5]?|01[01346-9])-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})|((080-[0-9]{3,4}|15(44|66|77|88))-[0-9]{4})/;
	var pattern2 = /([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})/;
    if (pattern1.test(Phone.value)||pattern2.test(Phone.value)){
        return true;
	} else {
        return false;
	}
}

////////////////////////////ÇÚµåÆù ¹øÈ£ °Ë»ç
function mobile_check(Mobile) {
	var pattern1 = /([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})/;

    if (pattern1.test(Mobile.value)) {
        return true;
    } else {
        return false;
	}
}

/////////////////////////trim check
function trim(s) {
	var t = "";
	var from_pos = to_pos = 0;

	for (i=0; i<s.length; i++) {
		if (s.charAt(i) == ' ') {
			continue;
		} else  {
			from_pos = i;
			break;
		}
	}

	for (i=s.length; i>=0; i--) {
		if (s.charAt(i-1) == ' ') {
			continue;
		} else {
			to_pos = i;
			break;
		}
	}	

	t = s.substring(from_pos, to_pos);
	return t;
}

/////////////////////////selected °Ë»ç
function seletboxck(fld){
	
	for (i=1; i<fld.length; i++) {
		if (fld[i].selected) {
			return true;
		}
	} 
	
}

////////////////////////checked °Ë»ç
function checkboxck(fld){
	for (i=0; i<fld.length; i++) {
		if (fld[i].checked) {
			return true;
		}
	} 
}

//////////////////////////ÇÊµå ÀÔ·Â ¼ýÀÚ Ã½Å© ÈÄ Á¡ÇÎ
function focus_move(nowfld,ncnt,nextfld){
	if(nowfld.value.length==ncnt){
		nextfld.focus();
	}
}


//////////////////////////°¡°Ý¿¡ ÄÄ¸¶ ¾ø¾Ö±â
function no_comma(data){
	var tmp = '';
    var comma = ',';
    var i;

	for (i=0; i<data.length; i++)
	{
		if (data.charAt(i) != comma)
		    tmp += data.charAt(i);
	}
	return tmp;
}


//////////////////////////°¡°Ý¿¡ ÄÄ¸¶ »ý¼ºÇÏ±â

function number_format(data) {

    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;
   
    len = data.length;
    mod = (len % cutlen);
    k = cutlen - mod;

    for (i=0; i<data.length; i++) 
	{
        number = number + data.charAt(i);
		
        if (i < data.length - 1) 
		{
            k++;
            if ((k % cutlen) == 0) 
			{
                number = number + comma;
                k = 0;
			}
        }
    }

    return number;
}

/////////////////////////¼ýÀÚ È®ÀÎ
function compute_amount(fld) {
	x = no_comma(fld.value);
	if (isNaN(x)) {
		alert("¼ýÀÚ°¡ ¾Æ´Õ´Ï´Ù.");
		fld.value = fld.defaultValue;
		fld.focus();
		return;
	} else if (x == "") {
		x = 0;
    	x = parseFloat(x);
        fld.value = number_format(String(x));
	}
}

//////////////////////////ÁÖ¹Îµî·Ï¹øÈ£ °Ë»ç
function jumin_check(j1, j2) {
	
    if (j1.value.length<6 || j2.value.length<7){
        return false;
	}

    var sum_1 = 0;
    var sum_2 = 0;
    var at=0;
    var juminno= j1.value + j2.value;
    sum_1 = (juminno.charAt(0)*2)+
				(juminno.charAt(1)*3)+
				(juminno.charAt(2)*4)+
				(juminno.charAt(3)*5)+
				(juminno.charAt(4)*6)+
				(juminno.charAt(5)*7)+
				(juminno.charAt(6)*8)+
				(juminno.charAt(7)*9)+
				(juminno.charAt(8)*2)+
				(juminno.charAt(9)*3)+
				(juminno.charAt(10)*4)+
				(juminno.charAt(11)*5);
    sum_2=sum_1%11;

    if (sum_2 == 0) {
        at = 10;
    } else  {
        if (sum_2 == 1){
			at = 11;
		}else{ 
            at = sum_2;
		}
    }
    att = 11 - at;
    if (juminno.charAt(12) != att) {
        return false;
    }

    return true
}
//////////////////////////»ç¾÷ÀÚµî·Ï¹øÈ£ °Ë»ç
function BuzNumCk(buz_no1,buz_no2,buz_no3) {

	BuzNum = buz_no1.value + buz_no2.value + buz_no3.value;

	SumBuz = 0; 
	SumBuz += parseInt(BuzNum.substring(0,1)); 
	SumBuz += parseInt(BuzNum.substring(1,2)) * 3 % 10; 
	SumBuz += parseInt(BuzNum.substring(2,3)) * 7 % 10; 
	SumBuz += parseInt(BuzNum.substring(3,4)) * 1 % 10; 
	SumBuz += parseInt(BuzNum.substring(4,5)) * 3 % 10; 
	SumBuz += parseInt(BuzNum.substring(5,6)) * 7 % 10; 
	SumBuz += parseInt(BuzNum.substring(6,7)) * 1 % 10; 
	SumBuz += parseInt(BuzNum.substring(7,8)) * 3 % 10; 
	SumBuz += Math.floor(parseInt(BuzNum.substring(8,9)) * 5 / 10); 
	SumBuz += parseInt(BuzNum.substring(8,9)) * 5 % 10; 
	SumBuz += parseInt(BuzNum.substring(9,10)); 

	if (SumBuz % 10 != 0) { 
		return false; 
	}
} 

//////////////////////////TextArea ¼¼·Î Å©±â º¯°æ

function textarea_size(fld, size) {
	var rows = parseInt(fld.rows);
	rows += parseInt(size);
	if (rows > 0) {
		fld.rows = rows;
	}
}

//////////////////////////¼ýÀÚ ÇÊµå °Ë»ç
function number_only(){
	if( !( event.keyCode>=48 && event.keyCode<=57 || event.keyCode>=96 && event.keyCode<=105 || event.keyCode==8 || event.keyCode==9 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46 ) ) {
		event.returnValue=false;
	}
}

//////////////////////////¿ìÆí¹øÈ£ Ã¢
function popup_zip(FmName, FLD1, FLD2, FLD3, Dir, top, left){	
	//alert(FmName+ FLD1+ FLD2+ FLD3+ Dir+ BackDir);
	url = Dir+'/AddrSearch.php?FmName='+FmName+'&FLD1='+FLD1+'&FLD2='+FLD2+'&FLD3='+FLD3;
	opt = 'scrollbars=yes,width=372,height=316,top='+top+',left='+left;
	window.open(url, 'winzip', opt);
}

///////////////////////////ÆË¾÷ Ã¢ ¶ç¿ì±â
function PopUpPage(Url,Wname,X2,Y2,X1,Y1,Sbar,Rsize){

	if(Sbar=='yes'){
		X = X2+18;
	}else{
		X = X2;
	}
	Opt ='width='+X+',height='+Y2+',left='+X1+',top='+Y1+',scrollbars='+Sbar+',resize='+Rsize+',status=no';
	window.open(Url, Wname, Opt);
}
 
 //////////////////////////ÀÌ¹ÌÁö ¹Ì¸® º¸±â
function VinputOptImgs(vb,va){
	document.getElementById(vb).setAttribute('src',va);
	document.getElementById(vb).style.display = "";
}

///////////////////////////DBÀÚ·á »èÁ¦
function ScriptDel(ALink){
    if(confirm("»èÁ¦ÇÑ ÀÚ·á´Â º¹±¸ÇÒ ¼ö ¾ø½À´Ï´Ù.\n\nÁ¤¸» »èÁ¦ÇÏ½Ã°Ú½À´Ï±î?")) 
        document.location.href = ALink;
}

///////////////////////////»óÅÂ Ã¢ ³»¿ë[±Û] Ç¥½Ã
function WStatusBarChar(msg){
    window.status = msg;
    return true;
}

function SelectLayerViewOnOff(Lname) {

	if (document.all[Lname].style.display == 'none'){ 
		document.all[Lname].style.display = ''; 
	}else {
		document.all[Lname].style.display = 'none'; 
	}
}

function SelectLayerViewCheck(Lname,bnone) {
	if(document.all[Lname].style.display != bnone){
		document.all[Lname].style.display = bnone; 
	}
}


function SelectLayerView(Lname,LastCnt,Sname) {
	for(i=1;i<=LastCnt;i++){
		if(Lname+i==Sname){
			document.all[Lname+i].style.display= '';
		}else{
			document.all[Lname+i].style.display= 'none';
		}
	}
}


