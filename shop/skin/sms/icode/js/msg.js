function IsInteger(contents)   {
	for (j=0; (j<contents.length); j++) {
        if ((contents.substring(j,j+1) < "0")||(contents.substring(j,j+1) > "9")) {
        	return false;
        }
	}
	return true;
}

function add(str) {
	document.MsgForm.MSG_TXT.focus();
	document.MsgForm.MSG_TXT.value+=str; 
	ChkLen();
	return;
}
function ChkLen() {
	var pos;
	var msglen = 0;
	var len = MsgForm.MSG_TXT.value.length;
	for(i=0;i<len;i++){
		pos = MsgForm.MSG_TXT.value.charAt(i);
		if (escape(pos).length > 4)
			msglen += 2;
		else
			msglen++;
	}
    MsgForm.MSG_TXT_CNT.value = msglen;
	if(msglen > 80 )
		alert('���ڸ޽����� 80����Ʈ�� ���� �� �����ϴ�.');
   // MsgForm.MSG_TXT_CNT.value = msglen;

}

function CWCheck(form) {
    dest = document.all["sDest"]
	if (document.MsgForm.SendFlag[0].checked) { //�ٷκ����⸦ �������� ���
		sDest.style.display = "none";
	}
	else //���������� ���
	{
		sDest.style.display = "block";	
	}
} 


function varcheck(){
	var content = document.MsgForm.MSG_TXT.value;
	var callback = document.MsgForm.callback.value;
    var sendphone = document.MsgForm.addcall.value;

	if(content == ""){
		alert("�޽����� �Է��� �ּ���");
		document.MsgForm.MSG_TXT.focus();
		return false;
	}
	if(sendphone  == null || sendphone == "")
	{
		alert("������ ��ȣ�� �Է��� �ּ���");
		document.MsgForm.addcall.focus();
		return false;
	}
	if(!IsInteger(sendphone))
	{
		alert('������ ��ȣ�� ���ڸ� �����մϴ�.');
		document.MsgForm.addcall.focus();
		return false;
	}
	if(callback  == null || callback == "")
	{
		alert("ȸ�Ź�ȣ�� �Է��ϼ���");
		document.MsgForm.callback.focus();
		return false;
	}
	if(!IsInteger(callback))
	{
		alert('ȸ�Ź�ȣ�� ���ڸ� �����մϴ�.');
		document.MsgForm.callback.focus();
		return false;
	}

	if(document.MsgForm.SendFlag[1].checked && document.MsgForm.R_YEAR.value.length!=4)
	{
		alert("�⵵�� ��Ȯ���� �ʽ��ϴ�.");
		document.MsgForm.R_YEAR.focus();
		return false;
	}
	
	if(document.MsgForm.SendFlag[1].checked && document.MsgForm.R_MONTH.value.length!=2)
	{
		alert("���� ��Ȯ���� �ʽ��ϴ�.");
		document.MsgForm.R_MONTH.focus();
		return false;
	}

	if(document.MsgForm.SendFlag[1].checked && document.MsgForm.R_DAY.value.length!=2)
	{
		alert("���� ��Ȯ���� �ʽ��ϴ�.");
		document.MsgForm.R_DAY.focus();
		return false;
	}

}
