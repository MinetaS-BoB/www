/*********************************************************
*  레이어
*********************************************************/
// 레이어(<div>) 페이지에 쓰기
document.writeln("<div id=popup style=display:none;position:absolute;z-index:1000; onmouseout='LayDown()' onMouseOver=\"this.style.display='block'\"></div>");
document.writeln("<iframe name=popup_frame id=popup_frame width=0 height=0 frameborder=0></iframe>");

var szUserId='';
var szTargetId='';
function popup_proc(act) {
	document.all.popup_frame.src="./ezboard/process.php?Act="+act+"&userid="+szUserId+"&targetid="+szTargetId;
}
// 레이어 띄우기 (아이디)
function LaySet(skin, userid, targetid) {
	if (!userid || !targetid || userid == targetid) {
		return false;
	}

	szUserId = userid;
	szTargetId = targetid;

	
	nWidth = 105;
	nHeight = 96;

	sHtml =	""+
				"<table width=96 height=96 border=0 cellpadding=0 cellspacing=0>"+
				"<tr height=4><td><img src=./ezboard/skin/" + skin + "/images/layer_top.gif></td></tr>"+
				"<tr>"+
				"<td background=./ezboard/skin/" + skin + "/images/layer_mid.gif style='padding:0 0 0 5'>"+
				"<table border=0 cellpadding=0 cellspacing=0>"+
				"<tr height=21><td><img src=./ezboard/skin/" + skin + "/images/layer_bl01off.gif name=no01 style='margin:0 4 1 0'><a onclick=\"popup_proc('Memo')\" style='cursor:pointer' OnMouseOver=\"document.no01.src='./ezboard/skin/" + skin + "/images/layer_bl01on.gif'\" OnMouseOut=\"document.no01.src='./ezboard/skin/" + skin + "/images/layer_bl01off.gif'\"><font face='tahoma'>쪽지보내기</font></a></td></tr>"+
				"<tr height=21><td><img src=./ezboard/skin/" + skin + "/images/layer_bl02off.gif name=no02 style='margin:0 3 -1 0'><a onclick=\"popup_proc('Homepage')\" style='cursor:pointer' OnMouseOver=\"document.no02.src='./ezboard/skin/" + skin + "/images/layer_bl02on.gif'\" OnMouseOut=\"document.no02.src='./ezboard/skin/" + skin + "/images/layer_bl02off.gif'\"><font face='tahoma'>홈페이지방문</font></a></td></tr>"+
				"<tr height=21><td><img src=./ezboard/skin/" + skin + "/images/layer_bl03off.gif name=no03 style='margin:0 3 -1 0'><a onclick=\"popup_proc('Mail')\" style='cursor:pointer' OnMouseOver=\"document.no03.src='./ezboard/skin/" + skin + "/images/layer_bl03on.gif'\" OnMouseOut=\"document.no03.src='./ezboard/skin/" + skin + "/images/layer_bl03off.gif'\"><font face='tahoma'>메일보내기</font></a></td></tr>"+
				"<tr height=21><td><img src=./ezboard/skin/" + skin + "/images/layer_bl04off.gif name=no04 style='margin:0 3 0 0'><a onclick=\"popup_proc('Sms')\" style='cursor:pointer' OnMouseOver=\"document.no04.src='./ezboard/skin/" + skin + "/images/layer_bl04on.gif'\" OnMouseOut=\"document.no04.src='./ezboard/skin/" + skin + "/images/layer_bl04off.gif'\"><font face='tahoma'>문자보내기</font></a></td></tr>"+
				"</table>"+
				"</td>"+
				"<tr height=4><td><img src=./ezboard/skin/" + skin + "/images/layer_btm.gif></td></tr>"+
				"</table>";
				
	LayerPicture = popup;

	LayerPicture.style.width = nWidth;
	LayerPicture.style.height = nHeight;

	LayerPicture.innerHTML = sHtml;


	var ntmpx, ntmpy, nMarginX, nMarginY;
	
	ntmpx = event.clientX + nWidth;
	ntmpy = event.clientY + nHeight;
	nMarginX = document.body.clientWidth - ntmpx;
	nMarginY = document.body.clientHeight - ntmpy ;
	
	if(nMarginX < 0) {
		ntmpx = event.clientX + document.body.scrollLeft + nMarginX;
	} else {
		ntmpx = event.clientX + document.body.scrollLeft;
	}
	
	if(nMarginY < 0) {
		ntmpy = event.clientY + document.body.scrollTop + nMarginY + 20;
	} else {
		ntmpy = event.clientY + document.body.scrollTop;
	}

	LayerPicture.style.posLeft = ntmpx - 15;
	LayerPicture.style.posTop = ntmpy - 3;

	LayerPicture.style.display = 'block';
}



// 레이어 닫기
function LayDown() {
	popup.style.display = 'none';
}
