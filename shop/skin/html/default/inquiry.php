<?
	$sql = "select * from ${MEMBER_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]'";
	$List = _mysql_fetch_array($sql);
	$Email = explode("@" , $List[Email]);
	$Tel = explode("-",$List[Tel]);
	$Hand = explode("-",$List[Hand]);
	$Fax = explode("-",$List[Fax]);
	$Zip1 = explode("-",$List[Zip1]);

?>
<script language="JavaScript">
<!--
function checkInqForm(f){

checkenable = new Array();
//텍스트 박스 책크 시작
    if(f.checkenable){
    var checkenablelen = f.checkenable.length
        for (i = 0; i < checkenablelen; i++){
            if(f.checkenable[i].value == ""){
            alert(f.checkenable[i].title);
            f.checkenable[i].focus();
            return false;
            }
        }
        if(!checkenablelen && f.checkenable.value == ""){
        alert(f.checkenable.title);
        f.checkenable.focus();
        return false;
        }
    }


/*
	 라디오 버턴일경우 사용
	if(!radiocheck(f.etc1)){
		alert('pc설치대수를 선택해 주세요');
		return false;
	}
*/

//체크 박스도 동일 단..id값으로 해줄것..배열처리가 되었다면Option1[]==> id= "Option1"
}


function mailChange(f){// 메일 선택
    if(f.sel_email.value){
      f.Email1_2.value=f.sel_email.value;
    } else{
			f.Email1_2.value = "";
			f.Email1_2.focus();
		}

}

//-->
</script>

<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;상담문의</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0"  >
  <form name="Frm" method="POST" action="<?=$PHP_SELF?>" onsubmit='return checkInqForm(this);' enctype="multipart/form-data">
    <input type="hidden" name="html" value="<? echo $html; ?>">
    <input type="hidden" name="query" value="INQ">
    <input type="hidden" name="IID" value="<? echo $IID; ?>">
    <tr>
      <td align="center"> <br> <table width = "100%" cellspacing="0" cellpadding="0" border="0" >
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>
          <tr>
            <td width="150" height="30" bgcolor="#F3F3F3" align="center">회사명/부서</td>
            <td valign="top" width="1" height="30" align="center"></td>
            <td height="30"><font color="#FFFFFF">---</font> <input type="text" name="Company" size="20" maxlength="30"  style="border:1 solid #999999" value='<?=$List[Company]?>' id = "checkenable" title = "회사명을 입력하세요">
              &nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>
          <tr>
            <td height="30" bgcolor="#F3F3F3" align="center">성명</td>
            <td valign="top" width="1" height="30" align="center"></td>
            <td height="30"><font color="#FFFFFF">---</font> <input type="text" name="Name" size="20" maxlength="30"  style="border:1 solid #999999" value = "<? echo $_COOKIE[MEMBER_NAME]; ?>" id = "checkenable" title = "성명을 입력하세요">
              &nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>
          <tr>
            <td height="30" bgcolor="#F3F3F3" align="center">전화번호</td>
            <td valign="top" width="1" height="30" align="center"></td>
            <td height="30"><font color="#FFFFFF">---</font>
              <select name = "Tel1" id = "checkenable" title = "전화번호를 선택해주세요">
                <option value = "" selected>선택</option>
								<?
									foreach($MEMBER_PHONE_ARRAY as $key => $value){
									if($value == $Tel[0]) $checkSelected = " selected" ; else $checkSelected = "";
									echo "<option value='$value' $checkSelected>$value</option>" ;
								}
								?>
              </select>
              -
              <input name=Tel2 type=text   size=4 maxlength=4  class="input2" value = "<? echo $Tel[1]; ?>" id = "checkenable" title = "전화번호를 입력해주세요">
              -
              <input name=Tel3 type=text  size=4 maxlength=4  class="input2" value = "<? echo $Tel[2]; ?>" id = "checkenable" title = "전화번호를 입력해주세요">
              &nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>
          <tr>
            <td height="30" bgcolor="#F3F3F3" align="center">휴대폰</td>
            <td valign="top" width="1" height="30" align="center"></td>
            <td height="30"><font color="#FFFFFF">---</font> <select name = "Hand1" id = "checkenable" title = "핸드폰번호를 선택해주세요">
                <option value = "" selected>선택</option>
								<?
									foreach($MEMBER_HANDPHONE_ARRAY as $key => $value){
										if($value == $Hand[0]) $checkSelected = " selected" ; else $checkSelected = "";
										echo "<option value='$value' $checkSelected>$value</option>" ;
									}
									?>
              </select>
              -
              <input type=text name=Hand2 size=4 maxlength=4   class="input2" value = "<? echo $Hand[1]; ?>" id = "checkenable"  title = "핸드폰번호를 입력해주세요">
              -
              <input type=text name=Hand3 size=4 maxlength=4   class="input2" value = "<? echo $Hand[2]; ?>" id = "checkenable"  title = "핸드폰번호를 입력해주세요">
            </td>
          </tr>
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>
          <tr>
          <tr>
            <td height="30" bgcolor="#F3F3F3" align="center">팩스</td>
            <td valign="top" width="1" height="30" align="center"></td>
            <td height="30"><font color="#FFFFFF">---</font> <select name = "Fax1">
                <option value = "" selected>선택</option>
								<?
										foreach($MEMBER_PHONE_ARRAY as $key => $value){
										if($value == $Fax[0]) $checkSelected = " selected" ; else $checkSelected = "";
										echo "<option value='$value' $checkSelected>$value</option>" ;
										}
									?>
              </select>
              -
              <input name=Fax1_2 type=text id="Fax2"  size=4 maxlength=4  value = "<? echo $Fax[1]; ?>" class="input2">
              -
              <input name=Fax1_3 type=text id="Fax3"  size=4 maxlength=4  value = "<? echo $Fax[2]; ?>" class="input2">
              &nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>
          <tr>
          <tr>
            <td height="75" bgcolor="#F3F3F3" align="center" rowspan="3">주소</td>
            <td valign="top" width="1" height="30" align="center" rowspan="3"></td>
            <td height="30"><font color="#FFFFFF">---</font> <input  style="border:1 solid #999999" maxlength=3 size=3 name=Zip1_1 READONLY value = "<?=$Zip1[0]?>">
              -
              <input  style="border:1 solid #999999" maxlength=3 size=3 name=Zip1_2 READONLY value = "<?=$Zip1[1]?>">
							<img src = "./<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/btn_ad.gif" style="cursor:hand" onClick="javascript:OpenZipcode(document.Frm)" align = absmiddle>
          </tr>
          <tr>
            <td height="28"><font color="#FFFFFF">---</font> <input style="border:1 solid #999999" size=39 name=Address1 value='<?=$List[Address1]?>'>
            </td>
          </tr>
          <tr>
            <td height="28"><font color="#FFFFFF">---</font> <input style="border:1 solid #999999" size=39 name=Address2 value='<?=$List[Address2]?>'>
            </td>
          </tr>
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>
          <tr>
            <td height="30" bgcolor="#F3F3F3" align="center">email</td>
            <td valign="top" width="1" height="30" align="center"></td>
            <td height="30"><font color="#FFFFFF">---</font> <input name="Email1_1" type="text" class="input2" size="15" value = "<? echo $Email[0];?>" id = "checkenable"  title = "이메일주소를 입력해주세요">
              @
              <input name="Email1_2" type="text"  size="15" value = "<? echo $Email[1];?>"  class="input2" id = "checkenable"  title = "이메일주소를 입력해주세요"> <select name="sel_email" style="WIDTH: 120px" onchange="mailChange(this.form)">
                <option value=''>기타메일직접입력</option>
                <?
									foreach($MEMBER_EMAIL_ARRAY as $key => $value){
										echo "<option value='$key'>$value</option>" ;
									}
								 ?>
                <option value=''>기타메일직접입력</option>
              </select> </td>
          </tr>
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>
          <tr>
            <td height="170" bgcolor="#F3F3F3" align="center">제품관련문의</td>
            <td valign="top" width="1" height="30" align="center"></td>
            <td><font color="#FFFFFF">---</font> <textarea name="Contents" cols="45" style="border:1 solid #999999" rows="10" id = "checkenable"  title = "내용을 입력해주세요"></textarea>
              &nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"> </tr>

          <tr>
            <td bgcolor="d7d7d7" height="1" colspan="3"></tr>
        </table>
        <br> <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><input type = "image" src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/btn_ok.gif"  border="0">
              &nbsp; </td>
            <td align="right"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/btn_cancle.gif"  ONCLICK="javascript:location.href='./'"; style="cursor:hand"></td>
          </tr>
        </table>
        <br> </td>
    </tr>
  </FORM>
</table>


								</td>
              </tr>
              <tr>
                <td height="30"></td>
              </tr>
              <tr>
                <td height="30"></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
