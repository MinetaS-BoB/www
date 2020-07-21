var gdCurDate = new Date();
var Year = gdCurDate.getFullYear();
var Month = gdCurDate.getMonth()+1;
var Day = gdCurDate.getDate();
var	onoffchk=1;

function reserv_chg() {
	var sw=smsForm.checkbox.value;
	if (sw==0) {
		smsForm.checkbox.value=1; 
		smsForm.reserve.value="R";
		smsForm.Dateff1.disabled=false; 
		smsForm.time1.disabled=false; 
		smsForm.time2.disabled=false;
		bt_on.style.visibility="visible";
		bt_off.style.visibility="hidden";
		bt_on.focus();
	}	else { 
		hide_cal();
		smsForm.checkbox.value=0; 
		smsForm.reserve.value="";
		smsForm.Dateff1.disabled=true; 
		smsForm.time1.disabled=true; 
		smsForm.time2.disabled=true;
		bt_on.style.visibility="hidden";
		bt_off.style.visibility="visible";
	}
}
function show_cal(){
	calendar.style.visibility="visible";		//달려보이기
}
function onoff(){
	if (onoffchk==0) {
		calendar.style.visibility="hidden";			//달력감추기
		onoffchk=1;
	}else{
		calendar.style.visibility="visible";			//달력감추기
	//	calendar.createCalendar();
			onoffchk=0;
	}
}
function hide_cal(){			
 	calendar.style.visibility="hidden";			//달력감추기
}
function chg2(init){
  	if (init>9) {
  		return init;
  	} else {
	  	str="0"+init;
		return str;
	}
}
															 
function AddData(str,idx)											//클릭한 이모티콘 화면에 표시
{
	clear2();
	form = document.smsForm;

   	// 리턴, 더블쿼테이션, 싱글쿼테이션, 백슬래시 처리
	var re, sq, dq, bs, qq;
	var r1;

	re = /cR_/g;
	sq = /sQ_/g;
	dq = /dQ_/g;
	//bs = /bS_/g;
  
	r1 = str.replace(re, "\r\n");
	r1 = r1.replace(sq, "'");
	r1 = r1.replace(dq, "\"");
	//r1 = r1.replace(bs, "\\");

	form.messageTemp.value = r1;
   	form.cid.value = idx;
   	
    cal_byte(form.messageTemp.value);
}

function insertEmoti(char)												// 이모티콘 삽입
{				
		clear2();
		document.smsForm.messageTemp.value += char;
		cal_byte(document.smsForm.messageTemp.value);
}

function cal_byte(query)												// 입력 바이트 수 계산
{
       var tmpStr;
       var temp=0;
       var onechar;
       var tcount;
       tcount = 0;

       tmpStr = new String(query);
       temp = tmpStr.length;

       for (k=0;k<temp;k++)
       {
            onechar = tmpStr.charAt(k);

            if (escape(onechar).length > 4) {
                 tcount += 2;
            }
            else if (onechar!='\r') {
                 tcount++;
            }
            
       }

       document.smsForm.cbyte.value = tcount;

       if(tcount>80) {
            reserve = tcount-80;
            alert("메시지 내용은80바이트 이상은 전송하실수 없습니다.\r\n 쓰신 메세지는 "+reserve+"바이트가 초과되었습니다.\r\n 초과된 부분은 자동으로 삭제됩니다.");
            cutText();
            return;
       }
}

function cal_byte2(query)
{
       var tmpStr;
       var temp=0;
       var onechar;
       var tcount;
       tcount = 0;

       tmpStr = new String(query);
       temp = tmpStr.length;

       for (k=0;k<temp;k++)
       {
            onechar = tmpStr.charAt(k);

            if (escape(onechar).length > 4) {
                 tcount += 2;
            }
            else if (onechar!='\r') {
                 tcount++;
            }
            
       }
	   return tcount;
}


function cutText()															//문자열자르기
{
       cut_string(document.smsForm.messageTemp.value, 80);				//일정길이80바이트까지만...
}

function cut_string(query,max)												//문자자르는 로직
{
       var tmpStr;
       var temp=0;
       var onechar;
       var tcount;
       tcount = 0;

       tmpStr = new String(query);
       temp = tmpStr.length;

       for(k=0;k<temp;k++)
       {
            onechar = tmpStr.charAt(k);

            if(escape(onechar).length > 4) {
                 tcount += 2;
            }
            else if(onechar!='\r') {
                 tcount++;
            }
            
            if(tcount>max) {
                 tmpStr = tmpStr.substring(0,k);
                 break;
            }
       }

       if (max == 80) {
            document.smsForm.messageTemp.value = tmpStr;
            cal_byte(tmpStr);
       }

       return tmpStr;
}


function SendToSMS1()
{
	var form = document.smsForm;
	var idx=0;
	var new_rphone='';
	var tcount = 0;
	var digits="0123456789";
	var temp;
	var yyyy;
	var mm;
	var dd;

	tmpStr = form.messageTemp.value;
	tcount = cal_byte2(tmpStr);
	if(tcount > 80) {
		reserve = tcount-80;
		alert("메시지 내용은80바이트 이상은 전송하실수 없습니다.\r\n 쓰신 메세지는 "+reserve+"바이트가 초과되었습니다.\r\n 초과된 부분은 자동으로 삭제됩니다.");
		cutText();
		form.messageTemp.focus();
		return;
	}

	if(form.checkbox.value!=0){
		var a1=form.Dateff1.value.substring(0,4);					//선택한 년도
		var a2=form.Dateff1.value.substring(6,8);					//선택한 월
		var a3=form.Dateff1.value.substring(10,12);					//선택한 일
		var a4=form.time1.value;									//선택한 시
		var a5=form.time2.value;									//선택한 분 

		var today=null;
		today=new Date();
		var b1=today.getYear();
		var b2=today.getMonth()+1;									//getMonth는 0:1월, 1:2월 이므로 1더함
		var b3=today.getDate();
		var b4=today.getHours();
		var b5=today.getMinutes()+5;
			
		
		var X = new Date(b1,b2,b3,b4,b5); 							//현재시간+5분
		var D = new Date(a1,a2,a3,a4,a5,0); 						//선택한 날짜

		//시간차를 구하기 위해 밀리세컨 값으로 각각을 바꾼다.
		X = X.getTime();//현재 날짜를 밀리세컨 값으로 리턴
		D = D.getTime();//선택한 날짜를 밀리세컨 값으로 리턴

		//바꾼 밀리세컨 숫자값으로 뺄셈을 한다.(분차이를 알 수 있도록 60*1000 으로 설정)
		var day_gap = Math.floor((X - D) / (60*1000));

		if(X-D > 0){ //현재시간-선택시간
			alert("예약발송 가능 시각은 현재시각에서 최소5분 후입니다.");
			return;
		}
	}

	if(form.messageTemp.value=='' || form.cbyte.value==0) {
		alert("내용을 입력해주세요!");
		form.messageTemp.focus();
		return;
	}

	if(form.receive.value=='' || form.receive.value.length<10) {
		alert('받는사람 전화번호를 확인해 주세요');
		form.receive.focus();
		return;
	}

	for(var q=0;q<form.send.value.length;q++){
		temp=form.send.value.substring(q,q+1);
		if (digits.indexOf(temp)==-1){
			alert("보내는사람 전화번호에 숫자만 입력하세요. 확인바랍니다.");
			form.send.focus();
			return;
		}
	}

	rphones=form.receive.value.split("\r\n");
	//alert('rphone개수는='+rphones.length);

	for(i=0;i<rphones.length;i++)
	{
	  	if (rphones[i]=='') {
	  	} else {
			for(var r=0;r<rphones[i].length;r++){
				temp=rphones[i].substring(r,r+1);
				if (digits.indexOf(temp)==-1){
					alert("받는사람 전화번호에 숫자만 입력하세요. 확인바랍니다.");
					form.receive.focus();
					return;
				}
			}
			if (i==(rphones.length-1)) {					// 콜론으로 보내는번호 구분
				new_rphone=new_rphone+rphones[i];
			} else {
				new_rphone=new_rphone+rphones[i]+":";
			}
	  	}
	}

	new_rphone=both_trim(new_rphone);
	new_rphones=new_rphone.split(":");
      
	if (new_rphones.length>50) {
		alert("동시에 전송할 수 있는 인원수를 초과하였습니다. (최대 50명)\r\n"+new_rphones.length+"개를 입력하셨습니다.");
		form.receive.focus();
		return;
	}

	if(form.send.value=='' || form.send.value.length>11) {
		alert('보내는사람 전화번호를 확인해 주세요');
		form.send.focus();
		return;
	}

	form.message.value=form.messageTemp.value;
	form.sendPhone.value=form.send.value;
	form.receivePhone.value=new_rphone;
	if (form.cid.value=='')	{form.cid.value="99100001";}
	
	yyyy = form.Dateff1.value.substring(0,4);
	mm = form.Dateff1.value.substring(6,8);
	dd = form.Dateff1.value.substring(10,12);
	form.reserveTime.value=yyyy+"-"+mm+"-"+dd+" "+form.time1.value+":"+form.time2.value+":00";
	
	/*
	if (form.location.value=='NPNS' || form.location.value=='NMSN') {		//메신저일경우
	} else {
		form.messageTemp.value="";				//보내기창 초기화
		form.cbyte.value="0";
		form.receive.value="";
	}
	*/
	
	if (form.location.value=='NMSN') {		//메신저일경우
		gosend();
	} else {
		window.open("","sendSms","scrollbars=no,resizable=no,top=40,left=40,width=420,height=480");
		form.target="sendSms";
		form.submit();
		form.cid.value="";
	}
}

function SendToSMS2()		//네이버 검색에서 사용(2004.11.12 추가)
{
	var form = document.smsForm;
	var idx=0;
	var new_rphone='';
	var tcount = 0;
	var digits="0123456789";
	var temp;

	tmpStr = document.smsForm.messageTemp.value;
	tcount = cal_byte2(tmpStr);
	
	if(tcount > 80) {
		reserve = tcount-80;
		alert("메시지 내용은80바이트 이상은 전송하실수 없습니다.\r\n 쓰신 메세지는 "+reserve+"바이트가 초과되었습니다.\r\n 초과된 부분은 자동으로 삭제됩니다.");
		cutText();
		form.messageTemp.focus();
		return;
	}
	            
	if(form.messageTemp.value=='' || form.cbyte.value==0) {
		alert("내용을 입력해주세요!");
		form.messageTemp.focus();
		return;
	}
   
	if(form.receive.value=='' || form.receive.value.length<10) {
		alert('받는사람 전화번호를 확인해 주세요');
		form.receive.focus();
		return;
	}
      
	if(form.send.value=='') {
		alert('보내는사람 전화번호를 확인해 주세요');
		form.send.focus();
		return;
	}
     
	if (isNaN(form.receive.value)) {
		alert ('받는 사람 폰번호는 숫자로만 입력해야 합니다.!!');
		form.receive.value = '';
		form.receive.focus();
		return;
	}
	
	if (isNaN(form.send.value)) {
		alert ('보내는 사람 폰번호는 숫자로만 입력해야 합니다.!!');
		form.send.value = '';
		form.send.focus();
		return;
	}

	if(form.send.value=='' || form.send.value.length>11) {
		alert('보내는사람 전화번호를 확인해 주세요');
		form.send.focus();
		return;
	}

	form.message.value=form.messageTemp.value;
	form.sendPhone.value=form.send.value;
	form.receivePhone.value=form.receive.value;
	if (form.cid.value=='')	{form.cid.value="99100001";}

	form.messageTemp.value="";				//보내기창 초기화
	form.cbyte.value="0";

	window.open("","sendSms","scrollbars=no,resizable=no,top=40,left=40,width=420,height=480");
	form.target="sendSms";
	form.submit();
	form.cid.value="";

}

function cal_pre()												//문자메시지 입력시 80바이트 체크 부분
{
	var tmpStr, tcount;
	tmpStr = document.smsForm.messageTemp.value;

	cal_byte(tmpStr);

	if(document.smsForm.cbyte.value > 80) {
		reserve = tcount-80;
		alert("메시지 내용은 80바이트 이상은 전송하실수 없습니다.\r\n 쓰신 메세지는 "+reserve+"바이트가 초과되었습니다.\r\n 초과된 부분은 자동으로 삭제됩니다.");
		cutText();
		return;
	}
}

function clear2() {												//화면 클리어(화면클리어는 cid는 남겨둔다.이모티콘선택인경우)
	if (document.smsForm.chk.value=="0") {    		
		document.smsForm.chk.value = "1";
		document.smsForm.cbyte.value = 0;
		document.smsForm.messageTemp.value = "";
	}
}

function AddChar(str)											//클릭된 문자열 화면에 추가
{
	clear2();
	form = document.smsForm;
	form.messageTemp.value = form.messageTemp.value + str;
	cal_byte(form.messageTemp.value);
}

function Cancel()												//취소버튼 클릭시
{
	document.smsForm.cid.value = "";
	document.smsForm.cbyte.value = 0;
	document.smsForm.messageTemp.value="";
	document.smsForm.messageTemp.focus();
}

function Cancel_Emoti()											//이모티콘 취소시
{
	document.smsForm.cbyte.value = 0;
	document.smsForm.messageTemp.value="";
	document.smsForm.cid.value="";
	document.smsForm.msg.value = "";
	document.smsForm.messageTemp.focus();
}

function Paste_Emo(char)										//이모티콘 붙이기
{	
	document.smsForm.messageTemp.value="";
	document.smsForm.messageTemp.value=char;
	document.smsForm.messageTemp.focus();
}

function chk_key()												//받는 사람 번호 체크로직(keypress 이벤트시)
{
	var r_str = document.smsForm.receive.value;
	var tmpStr;
	var temp=0;
	arr_rphone=r_str.split("\r\n");
	
	if (event.keyCode < 48 || event.keyCode > 57) {				//키코드가 숫자가 아닐때
		if (event.keyCode != 13) {
			event.returnValue=false;							//입력값을 취소함(엔터키 제외)
		} else {												//엔터를 입력시
			for (i=0;i<arr_rphone.length;i++)
			{
				if (arr_rphone[i]=='') {						//빈 칸에서 엔터 무응답
					event.returnValue=false;
				} else {										//빈 칸이 아니고 엔터를 입력했을 때
					if (arr_rphone.length>=50) {
						event.returnValue=false;
						alert("동시에 전송할 수 있는 인원수를 초과하였습니다. (최대 50명)")
						return;
					}
					// 앞3자리 체크
					if ((arr_rphone[i].substring(0,3)=='010')||(arr_rphone[i].substring(0,3)=='011')||(arr_rphone[i].substring(0,3)=='016')||(arr_rphone[i].substring(0,3)=='017')||(arr_rphone[i].substring(0,3)=='018')||(arr_rphone[i].substring(0,3)=='019')){
						if (i>=1) {
							for(var j=0;j<i;j++)
							{
								if (arr_rphone[i]==arr_rphone[j]){
									alert('받는 폰 번호가 중복 입력되었습니다.');
									tmpStr = new String(document.smsForm.receive.value);
									temp = tmpStr.length;
									tmpStr = tmpStr.substring(0,temp-arr_rphone[i].length-2);
									document.smsForm.receive.value=tmpStr;
									document.smsForm.receive.focus();
								}
							}
						}
					}else{
							alert('받는 폰 번호는 010,011,016,017,018,019로 시작해야 합니다.');
							if (i==0){
							document.smsForm.receive.value="";
							event.returnValue=false;
							document.smsForm.receive.focus();
							}
							if (i>=1){
							tmpStr = new String(document.smsForm.receive.value);
							temp = tmpStr.length;
							tmpStr = tmpStr.substring(0,temp-arr_rphone[i].length-2);
							document.smsForm.receive.value=tmpStr;
							document.smsForm.receive.focus();
							//document.smsForm.receive.focus();
							//event.returnValue=false;
							}
					}
				}
			}
		}
	} else {													//숫자를 입력했을 때
		
	}
}

function chk_num()												//받는 사람 번호 체크로직(keydown시)
{
	var r_str = document.smsForm.receive.value;
	var tmpStr;
	var temp=0;
	arr_rphone=r_str.split("\r\n");
	
	if (event.keyCode >= 48 && event.keyCode <= 57) {
		for (i=0;i<arr_rphone.length;i++)
			{
				if (arr_rphone[i].length>=12) {												
					alert('받는 폰 번호는 11자를 초과할수 없습니다. 다시 한번 확인바랍니다.');
					tmpStr = new String(document.smsForm.receive.value);
					temp = tmpStr.length;
					tmpStr = tmpStr.substring(0,temp-arr_rphone[i].length-2);
					document.smsForm.receive.value=tmpStr;
					document.smsForm.receive.focus();
				} 
			}
	}
}

function both_trim(a)											//양쪽 : 자르기
{
   var search=0;
   while (a.charAt(search)==":")
   {
     search=search+1;
   }
   a=a.substring(search,(a.length))
   search=a.length-1;
   while (a.charAt(search)==":")
   {
     search = search-1;
   }
   return a.substring(0,search+1)
}

function trim(a)								//공백제거
{
   var search=0;
   while (a.charAt(search)==" ")
   {
     search=search+1;
   }
   a=a.substring(search,(a.length))
   search=a.length-1;
   while (a.charAt(search)==" ")
   {
     search = search-1;
   }
   return a.substring(0,search+1)
}

function Main_SMS_Send()
{
	var form = document.smsForm;
	var digits="0123456789";
	var tcount = 0;
    var new_rphone='';
    var temp;
         
	if(form.messageTemp.value.length>80){
			alert("메시지의 길이는 80바이트를 넘을수 없습니다. 확인바랍니다.");
			return;
		}
		
	if(form.messageTemp.value=='' || document.smsForm.cbyte.value=='0') {
	    alert("내용을 입력해주세요!");
	    form.messageTemp.focus();
	    return;
	}

	if(form.receive.value=='' || form.receive.value.length<10) {
       	alert('받는사람 전화번호를 확인해 주세요');
       	form.receive.focus();
       	return;
    }
 
	if (isNaN(form.send.value))
	{
  	  alert ('보내는 사람 폰번호는 숫자로만 입력해야 합니다.!!');
   	  form.send.value = '';
	  form.send.focus();
   	  return;
	}		
	
	if(form.send.value=='' || form.send.value.length>11) {
	   	alert('보내는사람 전화번호를 확인해 주세요');
	   	form.send.focus();
	   	return;
	}
		
	rphones=form.receive.value.split(",");
      //alert('rphone개수는='+rphones.length);
    for(i=0;i<rphones.length;i++)
    {
	  	if (rphones[i]=='') {
	  	} else {
	  		for(var r=0;r<rphones[i].length;r++){
					temp=rphones[i].substring(r,r+1);
					if (digits.indexOf(temp)==-1){
						alert("받는사람 전화번호에 숫자만 입력하세요. 확인바랍니다.");
						form.receive.focus();
						return;
					}
				}
				
		  	if (i==(rphones.length-1)) {					// 콜론으로 보내는번호 구분
		  		new_rphone=new_rphone+rphones[i];
		  	} else {
		  		new_rphone=new_rphone+rphones[i]+":";
		  	}
	  	}
	}
    new_rphone=both_trim(new_rphone);
    new_rphones=new_rphone.split(":");
      
    if (new_rphones.length>50) {
    	alert("동시에 전송할 수 있는 인원수를 초과하였습니다. (최대 50명)\r\n"+new_rphones.length+"개를 입력하셨습니다.");
    	form.receive.focus();
    	return;
    }
    
    form.message.value=form.messageTemp.value;
	form.sendPhone.value=form.send.value;
	form.receivePhone.value=new_rphone;
	if (form.cid.value=='')	{ form.cid.value="99100001"; }

	form.messageTemp.value="";				//보내기창 초기화
	form.cbyte.value="0";
	window.open("","sendSms","scrollbars=no,resizable=no,top=40,left=40,width=420,height=480");
	form.target="sendSms";
	form.submit();
	form.cid.value="";
}