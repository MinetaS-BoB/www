<?
include "./config/membercheck_info.php";


if(isMember()){// 회원 수정
	$MemberTitle = "회원수정";
	$FrmAction = "./${MEMBER_FOLDER_NAME}/${MemberSkin}/USER_MODIFYQUERY.php" ;
	$mode = "modify";

	// 다이렉트로 치고 들어 온경우는 auth로 되돌린다.
	if($PassAuthResult != "PassAuthChecked"){
		js_location("./${MEMBER_MAIN_FILE_NAME}?query=auth");
		exit;
	}
}else{// 가입
	$MemberTitle = "회원가입";
	$FrmAction = "./${MEMBER_FOLDER_NAME}/${MemberSkin}/USER_REGISQUERY.php" ;
	$mode = "";
}

include "./js/member.php" ; // 회원에 관련된 js 파일 입력및 수정을 같이 써주기 위해서 php로 구성

	$sql = "select * from ${MEMBER_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]'";
	$List = _mysql_fetch_array($sql);
	$Email = explode("@" , $List[Email]);
	$Tel = explode("-",$List[Tel]);
	$Hand = explode("-",$List[Hand]);
	$Fax = explode("-",$List[Fax]);
	$CTel = explode("-",$List[CTel]);
	$CFax = explode("-",$List[CFax]);

	$Zip1 = explode("-",$List[Zip1]);
	$Zip2 = explode("-",$List[Zip2]);
	$BirthDay = explode("-",$List[BirthDay]);
	$MarrDate = explode("-" , $List[MarrDate]);
	$Picture = explode("|" , $List[Picture]);

	// 필수 항목 아이콘
	$MUST_IMAGE_ICON = "<img src='$MEMBER_FOLDER_NAME/$MemberSkin/images/dot_red.gif' width='3' height='3' hspace='0' vspace='3'>";
	// 선택 항목 아이콘
	$SEL_IMAGE_ICON = "<img src='$MEMBER_FOLDER_NAME/$MemberSkin/images/dot_blue.gif' width='3' height='3' hspace='0' vspace='3'>";
	// 변동 아이콘
	if($_CSex == "checked")	$_CSex_ICON = $MUST_IMAGE_ICON ; else $_CSex_ICON = $SEL_IMAGE_ICON ;
	if($_CBirthDay == "checked")	$_CBirthDay_ICON = $MUST_IMAGE_ICON ; else $_CBirthDay_ICON = $SEL_IMAGE_ICON ;
	if($_CMarrStatus == "checked")	$_CMarrStatus_ICON = $MUST_IMAGE_ICON ; else $_CMarrStatus_ICON = $SEL_IMAGE_ICON ;
	if($_CMarrDate == "checked")	$_CMarrDate_ICON = $MUST_IMAGE_ICON ; else $_CMarrDate_ICON = $SEL_IMAGE_ICON ;
	if($_CFax == "checked")	$_CFax_ICON = $MUST_IMAGE_ICON ; else $_CFax_ICON = $SEL_IMAGE_ICON ;
	if($_CHomePage == "checked")	$_CHomePage_ICON = $MUST_IMAGE_ICON ; else $_CHomePage_ICON = $SEL_IMAGE_ICON ;
	if($_CJob == "checked")	$_CJob_ICON = $MUST_IMAGE_ICON ; else $_CJob_ICON = $SEL_IMAGE_ICON ;
	if($_CScholarship == "checked")	$_CScholarship_ICON = $MUST_IMAGE_ICON ; else $_CScholarship_ICON = $SEL_IMAGE_ICON ;
	if($_CPassQna == "checked")	$_CPassQna_ICON = $MUST_IMAGE_ICON ; else $_CPassQna_ICON = $SEL_IMAGE_ICON ;
	if($_CCompany == "checked")	$_CCompany_ICON = $MUST_IMAGE_ICON ; else $_CCompany_ICON = $SEL_IMAGE_ICON ;
	if($_CPresident == "checked")	$_CPresident_ICON = $MUST_IMAGE_ICON ; else $_CPresident_ICON = $SEL_IMAGE_ICON ;
	if($_CBusiness == "checked")	$_CBusiness_ICON = $MUST_IMAGE_ICON ; else $_CBusiness_ICON = $SEL_IMAGE_ICON ;
	if($_CItem == "checked")	$_CItem_ICON = $MUST_IMAGE_ICON ; else $_CItem_ICON = $SEL_IMAGE_ICON ;
	if($_CCompNum == "checked")	$_CCompNum_ICON = $MUST_IMAGE_ICON ; else $_CCompNum_ICON = $SEL_IMAGE_ICON ;
	if($_CCTel == "checked")	$_CCTel_ICON = $MUST_IMAGE_ICON ; else $_CCTel_ICON = $SEL_IMAGE_ICON ;
	if($_CCFax == "checked")	$_CCFax_ICON = $MUST_IMAGE_ICON ; else $_CCFax_ICON = $SEL_IMAGE_ICON ;
	if($_CCAddress == "checked")	$_CCAddress_ICON = $MUST_IMAGE_ICON ; else $_CCAddress_ICON = $SEL_IMAGE_ICON ;
	if($_CSMS == "checked")	$_CSMS_ICON = $MUST_IMAGE_ICON ; else $_CSMS_ICON = $SEL_IMAGE_ICON ;
	if($_CMailReceive == "checked")	$_CMailReceive_ICON = $MUST_IMAGE_ICON ; else $_CMailReceive_ICON = $SEL_IMAGE_ICON ;
	if($_CInfo == "checked")	$_CInfo_ICON = $MUST_IMAGE_ICON ; else $_CInfo_ICON = $SEL_IMAGE_ICON ;
	if($_CProfile == "checked")	$_CProfile_ICON = $MUST_IMAGE_ICON ; else $_CProfile_ICON = $SEL_IMAGE_ICON ;

?>
<script>
	// 아이디 체크
	function IDCheck (form,obj,flag){
			var trigger = obj.value;
			var nform = form.name;
			if(checkId(obj)== false) return false;
			else dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + trigger + "&flag=" + flag;
	}
	// 닉네임 체크
	function NickCheck (form,obj,flag){
		  var trigger = obj.value;
			var nform = form.name;
			if(checkNickName(obj)== false) return false;
			else dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + trigger + "&flag=" + flag;
	}

	// 주민번호 체크
	function JuminCheck (form,flag){
			 var nform = form.name;
			 var Jumin1 = form.Jumin1.value ;
			 var Jumin2 = form.Jumin2.value ;
			if( IsJuminChk(Jumin1, Jumin2) == false) return false;
			else dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&Jumin1=" + Jumin1 + "&Jumin2=" + Jumin2 +"&flag=" + flag;
	}

	// 추천 체크
	function RecommandCheck (form,flag){
		  var nform = form.name;
		  RecID = form.RecID.value;
			if(RecID ==""){
				alert("추천인 아이디를 입력해주세요");
				form.RecID.focus();
				return false;
			}else{
			  dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + RecID + "&flag=" + flag;
			}
	}
	// 메일 체크
	function MailCheck (form,flag){
			EMAIL = form.Email1_1.value + "@" + form.Email1_2.value;
			var nform = form.name;
			if ( checkEmail(form) == false) return false;
			else dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + EMAIL + "&flag=" + flag;
	}
</script>
<script id="dynamic"></script>
<script language="javascript" src="./js/General.js"></script>
<FORM name="FrmUserInfo" method="post" OnSubmit="return MemberCheckField(this);" enctype='multipart/form-data' action="<? echo $FrmAction; ?>">
<input type="hidden" name="IP" value="<? echo $_SERVER['REMOTE_ADDR'];?>">
<? if(!$mode){?>
<input type="hidden" name="IDCheckFlag" value="N">
<!-- 아이디 체크를 했는지 Flag-->
<? if($_ENickName == "checked"){ ?>
<input type="hidden" name="NickCheckFlag" value="N">
<!-- 별명 체크를 했는지 Flag-->
<? } ?>
<? if($UseJuminCheck == "checked"){ ?>
<input type="hidden" name="JuminCheckFlag" value="N">
<!-- 주민번호 체크 Flag-->
<? } ?>
<? } ?>
<input type="hidden" name="MailCheckFlag" value="N">
<!-- 메일 체크를 했는지 Flag-->
<input type="hidden" name="UploadCheckFlag" value="Y">
<!-- 업로드 가능한지 Flag 기본 Y-->
<? if($mode == "modify"){ // 수정시만 ?>
<input type = "hidden" name = "ID" value = "<? echo $List[ID];?>">
<input type = "hidden" name = "Name" value = "<? echo $List[Name];?>">
<? } ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr align="left" valign="top">
      <td width="10" height="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
      <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_02.gif"></td>
      <td width="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
    </tr>
    <tr align="left" valign="top">
      <td style="background-image: url(<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
      <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;<? echo $MemberTitle; ?></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="25" align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="16" align="center" valign="top"><table width = "100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="25" valign="top"> &nbsp;<img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/dot_red.gif" width="3" height="3" hspace="1" vspace="3">
                    는 필수입력사항입니다. </td>
                </tr>
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" valign="top"><table  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="3"  bgcolor="909090"></td>
                                  </tr>
                                  <tr>
                                    <td height="3" align="left"><table  border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                        <tr align="center">
                                          <td height="30" colspan="2" valign="middle" class="333333_b">
                                            회원 일반정보 </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="115" height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            회원ID </td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <input type="text" name="ID" size="15" maxlength = 15 class="input2">
                                            <input type = "button"  value = "ID 중복확인"  onClick="javascript:IDCheck(this.form,this.form.ID,'ID')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '돋움';cursor:hand";>
                                            <? } else { echo $List[ID]; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_ENickName == "checked"){?>
                                        <tr>
                                          <td width="115" height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            닉네임 </td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <INPUT type="text" name="NickName" size="15" maxlength = 15 class="input2">
                                            <input type = "button"  value = "닉네임 중복확인"  onClick="javascript:NickCheck(this.form,this.form.NickName,'NickName')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '돋움';cursor:hand";>
                                            <? } else { echo $List[NickName]; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            <? if($mode == "modify") echo "새";?>비밀번호 </td>
                                          <td bgcolor="ffffff"><INPUT type="password" name="PWD" size="15" maxlength = 15 class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            비밀번호확인 </td>
                                          <td bgcolor="ffffff"><INPUT type="password" name="CPWD" size="15" maxlength = 15 class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            성명 </td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <INPUT type="text" name="Name" size="15" maxlength = 20 class="input2">
                                            <? } else { echo $List[Name]; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($UseJuminCheck == "checked"){ // 주민 번호 사용시만 나타난다.?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            주민등록번호</td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <input  name="Jumin1" maxlength = 6 size="7"  <? echo $ONLY_NUMBER_STYLE; ?> value="<?=$List[Jumin1]?>" onKeyup="moveFocus(6,this,this.form.Jumin2);" <? if($_EBirthDay == "checked") echo "onBlur = 'FillBirthDay(this.form)'" ; ?> class="input2">
                                            -
                                            <INPUT type = "password" maxLength="7" name="Jumin2" size="7"  value="<?=$List[Jumin2]?>" <? echo $ONLY_NUMBER_STYLE; ?> <? if($_ESex == "checked") echo "onBlur = 'checkSexValue(this.form)'" ; ?> class="input2">
                                            <input type = "button"  value = "주민번호 중복확인"  onClick="javascript:JuminCheck(this.form,'JUMIN')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '돋움';cursor:hand";>
                                            <? } else { echo "${List[Jumin1]}-*******"; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EBirthDay == "checked" ){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CBirthDay_ICON; ?>
                                            생년월일</td>
                                          <td bgcolor="ffffff"><INPUT type="text" name="BirthYY" size="4" maxlength="4" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[0]?>" class="input2">
                                            년
                                            <INPUT type="text" name="BirthMM" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[1]?>" class="input2">
                                            월
                                            <INPUT type="text" name="BirthDD" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[2]?>" class="input2">
                                            일
                                            <select name="BirthType" size="1">
                                              <option value="S" <? if($List[BirthDay] == "S") echo " selected" ; ?>>양력</option>
                                              <option value="L" <? if($List[BirthDay] == "L") echo " selected" ; ?> >음력</option>
                                              <option value="M" <? if($List[BirthDay] == "M") echo " selected" ; ?> >윤달</option>
                                            </select></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ESex == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CSex_ICON;?> 성별 </td>
                                          <td bgcolor="ffffff"><INPUT TYPE=RADIO NAME='Sex' VALUE='M'<? if($List[Sex]=='M') echo  " checked";?>>
                                            남자
                                            <INPUT TYPE=RADIO NAME='Sex' VALUE='F' <? if($List[Sex]=='F') echo  " checked";?>>
                                            여자 </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EMarrStatus == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CMarrStatus_ICON;?>
                                            결혼여부</td>
                                          <td bgcolor="ffffff"><INPUT TYPE=RADIO NAME='MarrStatus' VALUE='Y' <? if($List[MarrStatus]=='Y') echo  " checked";?>>
                                            기혼
                                            <INPUT TYPE=RADIO NAME='MarrStatus' VALUE='N' <? if($List[MarrStatus]=='N') echo  " checked";?>>
                                            미혼 </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EMarrDate == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CMarrDate_ICON;?>
                                            결혼기념일</td>
                                          <td bgcolor="ffffff"><INPUT type="text" name="MarrYY" size="4" maxlength="4" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[0]?>" class="input2">
                                            년
                                            <INPUT type="text" name="MarrMM" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[1]?>" class="input2">
                                            월
                                            <INPUT type="text" name="MarrDD" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[2]?>" class="input2">
                                            일 </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            이메일</td>
                                          <td bgcolor="ffffff"><input name="Email1_1" type="text" class="input2" size="15" VALUE='<?=$Email[0]?>'>
                                            @
                                            <input name="Email1_2" type="text"  size="15" VALUE='<?=$Email[1]?>' class="input2">
                                            <select name="sel_email" style="WIDTH: 120px" onchange="mailChange(this.form)">
                                              <option value=''>기타메일직접입력</option>
                                              <?
																								foreach($MEMBER_EMAIL_ARRAY as $key => $value){
																									echo "<option value='$key'>$value</option>" ;
																								}
																							 ?>
                                              <option value=''>기타메일직접입력</option>
                                            </select>
                                            <? if(!$mode){?>
                                            <input type = "button"  value = "메일중복확인"  onClick="javascript:MailCheck(this.form,'EMAIL')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '돋움';cursor:hand";>
                                            <? } ?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_EHomePage == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CHomePage_ICON;?>
                                            홈페이지 </td>
                                          <td bgcolor="ffffff">http://
                                            <INPUT NAME="Url" type="text" size="45" value = "<? echo stripslashes($List[Url]) ;  ?>" class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            전화번호</td>
                                          <td bgcolor="ffffff"><select name = "Tel1_1">
                                              <option value = "" selected>선택</option>
                                              <?
																								foreach($MEMBER_PHONE_ARRAY as $key => $value){
																								if($value == $Tel[0]) $checkSelected = " selected" ; else $checkSelected = "";
																								echo "<option value='$value' $checkSelected>$value</option>" ;
																							}
																							?>
                                            </select>
                                            -
                                            <input name=Tel1_2 type=text id="Tel1_2"  size=4 maxlength=4 value = "<? echo $Tel[1]; ?>" class="input2">
                                            -
                                            <input name=Tel1_3 type=text id="Tel1_3"  size=4 maxlength=4 value = "<? echo $Tel[2]; ?>" class="input2">
                                            &nbsp;</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            휴대전화 </td>
                                          <td bgcolor="ffffff"><select name = "Hand1_1">
                                              <option value = "" selected>선택</option>
                                              <?
																								foreach($MEMBER_HANDPHONE_ARRAY as $key => $value){
																									if($value == $Hand[0]) $checkSelected = " selected" ; else $checkSelected = "";
																									echo "<option value='$value' $checkSelected>$value</option>" ;
																								}
																								?>
                                            </select>
                                            -
                                            <input type=text name=Hand1_2 size=4 maxlength=4  value = "<? echo $Hand[1]; ?>" class="input2">
                                            -
                                            <input type=text name=Hand1_3 size=4 maxlength=4  value = "<? echo $Hand[2]; ?>" class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_EFax == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CFax_ICON;?> 팩스번호
                                          </td>
                                          <td bgcolor="ffffff"><select name = "Fax1_1">
                                              <option value = "" selected>선택</option>
                                              <?
																									foreach($MEMBER_PHONE_ARRAY as $key => $value){
																									if($value == $Fax[0]) $checkSelected = " selected" ; else $checkSelected = "";
																									echo "<option value='$value' $checkSelected>$value</option>" ;
																									}
																								?>
                                            </select>
                                            -
                                            <input name=Fax1_2 type=text id="Fax1_2"  size=4 maxlength=4 value = "<? echo $Fax[1]; ?>" class="input2">
                                            -
                                            <input name=Fax1_3 type=text id="Fax1_3"  size=4 maxlength=4 value = "<? echo $Fax[2]; ?>" class="input2">
                                            &nbsp;</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            우편번호 </td>
                                          <td bgcolor="ffffff"><INPUT maxLength="3" name="Zip1_1" size="3"  readonly value = "<?=$Zip1[0]?>" class="input2">
                                            -
                                            <INPUT maxLength="3" name="Zip1_2" size="3"  readonly value = "<?=$Zip1[1]?>" class="input2">
                                            <img src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/images/btn_ad.gif" style="cursor:hand" onClick="javascript:OpenZipcode(document.FrmUserInfo)" align = absmiddle>
																						</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            주소</td>
                                          <td bgcolor="ffffff"><INPUT NAME="Address1" size="60" type="text" readonly VALUE='<?=$List[Address1]?>' class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            상세 주소</td>
                                          <td bgcolor="ffffff"><INPUT NAME="Address2" size="50" type="text" VALUE='<?=$List[Address2]?>' class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_EJob == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CJob_ICON;?> 직업선택</td>
                                          <td bgcolor="ffffff"><SELECT NAME='Job'>
                                              <option value = "" selected>직업선택</option>
                                              <option value = "" >--------------------</option>
                                              <?
																								foreach($MEMBER_JOB_ARRAY as $key => $value){
																									if($key == $List[Job]) $checkSelected = " selected" ; else $checkSelected = "";
																								if($key) echo "<option value = '$key' $checkSelected>$value</option>";
																								}

																							?>
                                            </SELECT></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EScholarship == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CScholarship_ICON;?>
                                            학력선택</td>
                                          <td bgcolor="ffffff"><SELECT NAME='Scholarship'>
                                              <option value = "" selected>학력선택</option>
                                              <option value = "" >--------------------</option>
                                              <?
																								foreach($MEMBER_SCHOOL_ARRAY as $key => $value){
																									if($key == $List[Scholarship]) $checkSelected = " selected" ; else $checkSelected = "";
																								if($key) echo "<option value = '$key' $checkSelected>$value</option>";
																								}

																							?>
                                            </SELECT></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EPassQna == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CPassQna_ICON;?> 비밀번호 <br>
                                            &nbsp;&nbsp;재발급
                                            질문선택</td>
                                          <td bgcolor="ffffff"><SELECT NAME='PWDHint' style='width:356px'>
                                              <option value = "">비밀번호 재발급 선택</option>
                                              <option value = "" >--------------------------------------------------------</option>
                                              <?
																									foreach($MEMBER_PWD_Q_ARRAY as $key => $value){
																											if($key == $List[PWDHint]) $checkSelected = " selected" ; else $checkSelected = "";
																										echo "<option value = '$key' $checkSelected>$value</option>";

																									}
																							?>
                                            </SELECT></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CPassQna_ICON;?> 비밀번호 <br>
                                            &nbsp;&nbsp;재발급
                                            답 입력</td>
                                          <td bgcolor="ffffff"><INPUT NAME="PWDAnswer" size="60" type="text" maxlength = 50 value = "<? echo stripslashes($List[PWDAnswer]) ;?>" class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if(!$mode && $USE_RECOMMEND == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            추천인아이디</td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <input type = "text" name = "RecID" value = "<? echo $List[RecID]?>" class="input2">
                                            <input type = "button"  value = "추천인검색"  onClick="javascript:RecommandCheck(this.form,'RECOMMAND')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '돋움';cursor:hand";>
                                            <? } else { echo $List[RecID]; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECompany == "checked"){?>
                                        <tr>
                                          <td height="30" colspan="2" align="center" valign="middle" class="333333_b">
                                            회사정보</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECompany == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCompany_ICON;?> 회사명</td>
                                          <td bgcolor="ffffff"> <INPUT type="text" name="Company" size="30" value="<?=$List[Company]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EPresident == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CPresident_ICON;?>
                                            대표자명</td>
                                          <td bgcolor="ffffff"><INPUT type="text" name="President" size="30" value="<?=$List[President]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EBusiness == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CBusiness_ICON;?>
                                            업태</td>
                                          <td bgcolor="ffffff"> <INPUT type="text" name="Business" size="20" value="<?=$List[Business]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EItem == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CItem_ICON;?> 종목</td>
                                          <td bgcolor="ffffff"> <INPUT type="text" name="Item" size="20" value="<?=$List[Item]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECompNum == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCompNum_ICON;?> 사업자등록번호</td>
                                          <td bgcolor="ffffff"> <INPUT type="text" name="LicenseNo" size="25" value="<?=$List[LicenseNo]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECTel == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCTel_ICON;?> 회사 전화번호</td>
                                          <td bgcolor="ffffff"> <select name = "CTel1_1">
                                              <option value = "" selected>선택</option>
                                              <?
																								foreach($MEMBER_PHONE_ARRAY as $key => $value){
																								if($value == $CTel[0]) $checkSelected = " selected" ; else $checkSelected = "";
																								echo "<option value='$value' $checkSelected>$value</option>" ;
																							}
																							?>
                                            </select>
                                            -
                                            <input name=CTel1_2 type=text id="CTel1_2"  size=4 maxlength=4 value = "<? echo $CTel[1]; ?>" class="input2">
                                            -
                                            <input name=CTel1_3 type=text id="CTel1_3"  size=4 maxlength=4 value = "<? echo $CTel[2]; ?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECFax == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCFax_ICON;?> 회사 팩스번호</td>
                                          <td bgcolor="ffffff"> <select name = "CFax1_1">
                                              <option value = "" selected>선택</option>
                                              <?
																								foreach($MEMBER_PHONE_ARRAY as $key => $value){
																								if($value == $CFax[0]) $checkSelected = " selected" ; else $checkSelected = "";
																								echo "<option value='$value' $checkSelected>$value</option>" ;
																							}
																							?>
                                            </select>
                                            -
                                            <input name=CFax1_2 type=text id="CFax1_2"  size=4 maxlength=4 value = "<? echo $CFax[1]; ?>" class="input2">
                                            -
                                            <input name=CFax1_3 type=text id="CFax1_3"  size=4 maxlength=4 value = "<? echo $CFax[2]; ?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECAddress == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCAddress_ICON;?>
                                            회사 우편번호</td>
                                          <td bgcolor="ffffff"> <INPUT maxLength="3" name="Zip2_1" size="3"  readonly value = "<?=$Zip2[0]?>" class="input2">
                                            -
                                            <INPUT maxLength="3" name="Zip2_2" size="3"  readonly value = "<?=$Zip2[1]?>" class="input2">
																						<img src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/images/btn_ad.gif" style="cursor:hand" onClick="javascript:OpenZipcode1(document.FrmUserInfo)" align = absmiddle>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCAddress_ICON;?>
                                            회사주소</td>
                                          <td bgcolor="ffffff"> <INPUT NAME="Address3" size="80" type="text" readonly VALUE='<?=$List[Address3]?>' class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCAddress_ICON;?>
                                            회사상세주소</td>
                                          <td bgcolor="ffffff"> <INPUT NAME="Address4" size="50" type="text" VALUE='<?=$List[Address4]?>' class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" colspan="2" align="center" valign="middle" class="333333_b">
                                            추가정보</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_EMailReceive == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CMailReceive_ICON;?>
                                            메일 수신</td>
                                          <td bgcolor="ffffff"> <input type = "checkbox" name = "MailReceive" value = "Y" <? if($List[MailReceive] == "Y") echo " checked" ;  ?>>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ESMS == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CSMS_ICON;?> SMS 수신</td>
                                          <td bgcolor="ffffff"> <input type = "checkbox" name = "SMSReceive" value = "Y" <? if($List[SMSReceive] == "Y") echo " checked" ;  ?>>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EInfo == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CInfo_ICON;?> 정보공개여부</td>
                                          <td bgcolor="ffffff"> <input type = "checkbox" name = "MPublic" value = "Y" <? if($List[MPublic] == "Y") echo " checked" ;  ?>>
                                            타인에게 자신의 정보를 공개 </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($USE_ICON_TYPE){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            회원아이콘</td>
                                          <td bgcolor="ffffff"> <img alt=미리보기 id=sm src="" width="largh" style="VISIBILITY: hidden"  name="imgsiz" border=1><br>
                                            <INPUT type = "file" name = "file1" id = "file" size="40"  onchange="return image_onchange(this.form);" class="input2"> 
                                            <? if($Picture[0]) { echo "<img src = './${MEMBER_TEMP_FOLDER_NAME}/user_image/$Picture[0]' width = '$MEMBER_ICON_LIMIT_WIDTH' height = '$MEMBER_ICON_LIMIT_HEIGHT' border = 0> <input name='file_del[0]' type='checkbox' value='1'> 이미지삭제"; } 	?>
                                            <br>
                                            업로드 용량은 <? echo number_format($MEMBER_ICON_LIMIT_CAPACITY); ?>
                                            바이트 이하 / 이미지 크기는 <? echo $MEMBER_ICON_LIMIT_WIDTH; ?>
                                            x <? echo $MEMBER_ICON_LIMIT_HEIGHT; ?>으로
                                            해주세요. </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($mode == "modify"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            로그인횟수</td>
                                          <td bgcolor="ffffff"> <? echo number_format(getMemberLoginCnt($List[ID])); ?>
                                            회 </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            보유포인트</td>
                                          <td bgcolor="ffffff">
                                            <? echo number_format(getTotalPoint($List[ID])); ?>
                                            Point  </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            회원가입일</td>
                                          <td bgcolor="ffffff">
                                            <? if ($List[RegDate]) echo date("Y-m-d h:i:s" , $List[RegDate]); ?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            최종수정일 </td>
                                          <td bgcolor="ffffff">
                                            <? if ($List[ModDate]) echo date("Y-m-d h:i:s" , $List[ModDate]); ?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
																				<tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            최근로그인날짜 </td>
                                          <td bgcolor="ffffff">
                                            <? if(getLastLoginDate($_COOKIE[MEMBER_ID])) echo date("Y-m-d h:i:s" ,getLastLoginDate($_COOKIE[MEMBER_ID]));  ?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            회원등급</td>
                                          <td bgcolor="ffffff"> <? echo $MEMBER_GRADE_NAME[$_COOKIE[MEMBER_GRADE]]?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EProfile == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CProfile_ICON;?> 자기소개</td>
                                          <td bgcolor="ffffff"> <textarea name="MProfile" rows="7" style="width:99%" class="input2"><? echo stripslashes($List[MProfile]);?></textarea>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td height="2" bgcolor="909090"></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <br> <table border="0" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td width="133"><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_ok.gif"  border="0"  onFocus = "this.blur();"></td>
                  <td width="133"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_cancle.gif"  onclick="javascript:location.href='./'"; style="cursor:hand"  onFocus = "this.blur();"></td>
                </tr>
              </table>
              <br> <br> <br></td>
          </tr>
          <tr>
            <td height="20" align="center" valign="top">&nbsp;</td>
          </tr>
        </table></td>
      <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_04.gif"></td>
    </tr>
    <tr align="left" valign="top">
      <td width="10" height="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
      <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_06.gif"></td>
      <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
    </tr>

</table>
</form>
