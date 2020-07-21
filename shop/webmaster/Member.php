<?
include "./ROOT_CHECK.php";
include "../config/membercheck_info.php";
if(!$MemberSkin) $MemberSkin = "BASIC";

include "../js/member.php" ; // 회원에 관련된 js 파일 입력및 수정을 같이 써주기 위해서 php로 구성


	if(!$mode){
		$title_txt = "가입";
	}else if($mode == "modify"){
		$title_txt = "수정";
	}
	
	
	$sql = "select * from ${MEMBER_TABLE_NAME} where ID = '$id'";	
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
	
	if($Back)  $GoJumpUrl = "$PHP_SELF?menushow=$menushow&THEME=$Back&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword"; 
	else  $GoJumpUrl = "$PHP_SELF?menushow=$menushow&THEME=MemberList&CURRENT_PAGE=$CURRENT_PAGE&WHERE=$WHERE&keyword=$keyword&SELECT_SORT=$SELECT_SORT&add=$add&Sex=$Sex&Dsort=$Dsort&SYear=$SYear&SMonth=$SMonth&SDay=$SDay"; 

	
?>
<script>
	// 아이디 체크 
	function IDCheck (form,obj,flag){	
			var trigger = obj.value;	
			var nform = form.name;			
			if(checkId(obj)== false) return false;
			else dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + trigger + "&flag=" + flag;
	}
	// 닉네임 체크
	function NickCheck (form,obj,flag){		  
		  var trigger = obj.value;	
			var nform = form.name;			
			if(checkNickName(obj)== false) return false;
			else dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + trigger + "&flag=" + flag;			
	}

	// 주민번호 체크
	function JuminCheck (form,flag){			
			 var nform = form.name;			
			 var Jumin1 = form.Jumin1.value ;
			 var Jumin2 = form.Jumin2.value ;
			if( IsJuminChk(Jumin1, Jumin2) == false) return false;
			else dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&Jumin1=" + Jumin1 + "&Jumin2=" + Jumin2 +"&flag=" + flag;
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
			  dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + RecID + "&flag=" + flag;								
			}
	}
	// 메일 체크 
	function MailCheck (form,flag){		 			
			EMAIL = form.Email1_1.value + "@" + form.Email1_2.value;	
			var nform = form.name;			
			if ( checkEmail(form) == false) return false;
			else dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + EMAIL + "&flag=" + flag;
	}
</script>
<script id="dynamic"></script>
<table width="747" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr> 
          <td align="center" bgcolor="#FFFFFF"><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30" class="black_16"><strong><font color="#3366CC">회원<? echo $title_txt; ?></font></strong></td>
              </tr>
              <tr> 
                <td>관리자 모드에서 수동으로 회원<? echo $title_txt; ?>을 하는곳입니다.</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <table width=100% cellspacing=0 cellpadding="0" border=0 align="CENTER" >
        <?
	if(!$mode){ 	
		$action = "../${MEMBER_FOLDER_NAME}/${MemberSkin}/USER_REGISQUERY.php" ; 
	}	else { 
		$action = "../${MEMBER_FOLDER_NAME}/${MemberSkin}/USER_MODIFYQUERY.php" ; 
	}
?>
        <FORM name="FrmUserInfo" method="post" enctype='multipart/form-data' OnSubmit="return MemberCheckField(this);" action="<? echo $action; ?>">
          <input type=hidden name=THEME value='<?  echo $THEME; ?>'>
          <input type=hidden name= menushow value=<? echo $menushow; ?>>
          <input type=hidden name=CURRENT_PAGE value='<?=$CURRENT_PAGE?>'>
          <input type=hidden name=WHERE value='<?=$WHERE?>'>
          <input type=hidden name=keyword value='<?=$keyword?>'>
          <input type=hidden name=SELECT_SORT value='<?=$SELECT_SORT?>'>
          <input type=hidden name=add value='<?=$add?>'>
          <!--<input type=hidden name=Sex value='<?=$Sex?>'> 변수 충돌-->
          <input type=hidden name=Dsort value='<?=$Dsort?>'>
          <input type=hidden name=SDay value='<?=$SDay?>'>
          <input type=hidden name=FDay value='<?=$FDay?>'>
          <input type="hidden" name="WHERE_REGIS" value="ADMIN">
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
          <TR> 
            <TD><table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                <TR> 
                  <TD COLSPAN=4 align="center" <? echo $TITLE_STYLE ; ?>>일반정보</TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>* 아이디</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if(!$mode){?>
                    <input type="text" name="ID" size="15" maxlength = 15> <input type = "button"  value = "ID 중복확인" class = btn10 onClick="javascript:IDCheck(this.form,this.form.ID,'ID')" style="cursor:hand";> 
                    <? } else { echo $List[ID]; }?>
                  </TD>
                </TR>
                <? if($_ENickName == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>* 닉네임</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if(!$mode){?>
                    <INPUT type="text" name="NickName" size="15" maxlength = 15> 
                    <input type = "button"  value = "닉네임 중복확인" class = btn10 onClick="javascript:NickCheck(this.form,this.form.NickName,'NickName')" style="cursor:hand";> 
                    <? } else { echo $List[NickName]; }?>
                  </TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100">* 비밀번호</TD>
                  <TD <? echo $CONTENT_STYLE; ?> width="205"> <INPUT type="password" name="PWD" size="15" maxlength = 15 VALUE="<?=$List[PWD]?>"> 
                  </TD>
                  <TD <? echo $LEFT_STYLE; ?> width="102">* 비밀번호확인</TD>
                  <TD <? echo $CONTENT_STYLE; ?> width="189"> <INPUT type="password" name="CPWD" size="15" maxlength = 15 VALUE="<?=$List[PWD]?>"></TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100">* 이 름</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> 
                    <? if(!$mode){?>
                    <INPUT type="text" name="Name" size="15" maxlength = 20> 
                    <? } else { echo $List[Name]; }?>
                  </TD>
                </TR>
                <? if($UseJuminCheck == "checked"){ // 주민 번호 사용시만 나타난다.?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100">주민등록번호</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if(!$mode){?>
                    <input  name="Jumin1" maxlength = 6 size="7"  <? echo $ONLY_NUMBER_STYLE; ?> value="<?=$List[Jumin1]?>" onKeyup="moveFocus(6,this,this.form.Jumin2);" <? if($_EBirthDay == "checked") echo "onBlur = 'FillBirthDay(this.form)'" ; ?> >
                    - 
                    <INPUT type = "password" maxLength="7" name="Jumin2" size="7"  value="<?=$List[Jumin2]?>" <? echo $ONLY_NUMBER_STYLE; ?> <? if($_ESex == "checked") echo "onBlur = 'checkSexValue(this.form)'" ; ?>> 
                    <input type = "button"  value = "주민번호 중복확인" class = btn10 onClick="javascript:JuminCheck(this.form,'JUMIN')" style="cursor:hand";> 
                    <? } else { echo "${List[Jumin1]}-*******"; }?>
                  </TD>
                </TR>
                <? } ?>
                <? if($_EBirthDay == "checked" ){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> 생년월일</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="BirthYY" size="4" maxlength="4" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[0]?>">
                    년 
                    <INPUT type="text" name="BirthMM" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[1]?>">
                    월 
                    <INPUT type="text" name="BirthDD" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[2]?>">
                    일 
                    <select name="BirthType" size="1">
                      <option value="S" <? if($List[BirthDay] == "S") echo " selected" ; ?>>양력</option>
                      <option value="L" <? if($List[BirthDay] == "L") echo " selected" ; ?> >음력</option>
                      <option value="M" <? if($List[BirthDay] == "M") echo " selected" ; ?> >윤달</option>
                    </select> </TD>
                </TR>
                <? } ?>
                <? if($_ESex == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100">성별</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <INPUT TYPE=RADIO NAME='Sex' VALUE='M'<? if($List[Sex]=='M') echo  " checked";?>>
                    남자 
                    <INPUT TYPE=RADIO NAME='Sex' VALUE='F' <? if($List[Sex]=='F') echo  " checked";?>>
                    여자 </TD>
                </TR>
                <? } ?>
                <? if($_EMarrStatus == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> 결혼여부</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>><INPUT TYPE=RADIO NAME='MarrStatus' VALUE='Y' <? if($List[MarrStatus]=='Y') echo  " checked";?>>
                    기혼 
                    <INPUT TYPE=RADIO NAME='MarrStatus' VALUE='N' <? if($List[MarrStatus]=='N') echo  " checked";?>>
                    미혼 </TD>
                </TR>
                <? } ?>
                <? if($_EMarrDate == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> 결혼기념일</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="MarrYY" size="4" maxlength="4" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[0]?>">
                    년 
                    <INPUT type="text" name="MarrMM" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[1]?>">
                    월 
                    <INPUT type="text" name="MarrDD" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[2]?>">
                    일 </TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>E-mail</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <input name="Email1_1" type="text" class="inputline" size="15" VALUE='<?=$Email[0]?>'>
                    @ 
                    <input name="Email1_2" type="text"  size="15" VALUE='<?=$Email[1]?>'> 
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
                    <input type = "button"  value = "메일중복확인" class = btn10 onClick="javascript:MailCheck(this.form,'EMAIL')" style="cursor:hand";>
                    <? } ?>
                  </TD>
                </TR>
                <? if($_EHomePage == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>홈페이지</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3>http:// 
                    <INPUT NAME="Url" type="text" size="45" value = "<? echo stripslashes($List[Url]) ;  ?>"></TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> 전화번호</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <select name = "Tel1_1">
                      <option value = "" selected>선택</option>
                      <?
													foreach($MEMBER_PHONE_ARRAY as $key => $value){
													if($value == $Tel[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input name=Tel1_2 type=text id="Tel1_2"  size=4 maxlength=4 value = "<? echo $Tel[1]; ?>">
                    - 
                    <input name=Tel1_3 type=text id="Tel1_3"  size=4 maxlength=4 value = "<? echo $Tel[2]; ?>"> 
                    &nbsp;</TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" >핸드폰</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><select name = "Hand1_1">
                      <option value = "" selected>선택</option>
                      <?
												foreach($MEMBER_HANDPHONE_ARRAY as $key => $value){
													if($value == $Hand[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input type=text name=Hand1_2 size=4 maxlength=4  value = "<? echo $Hand[1]; ?>">
                    - 
                    <input type=text name=Hand1_3 size=4 maxlength=4  value = "<? echo $Hand[2]; ?>"></TD>
                </TR>
                <? if($_EFax == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> 팩스번호</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <select name = "Fax1_1">
                      <option value = "" selected>선택</option>
                      <?
													foreach($MEMBER_PHONE_ARRAY as $key => $value){
													if($value == $Fax[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input name=Fax1_2 type=text id="Fax1_2"  size=4 maxlength=4 value = "<? echo $Fax[1]; ?>">
                    - 
                    <input name=Fax1_3 type=text id="Fax1_3"  size=4 maxlength=4 value = "<? echo $Fax[2]; ?>"> 
                    &nbsp;</TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>우편번호</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT maxLength="3" name="Zip1_1" size="3"  readonly value = "<?=$Zip1[0]?>">
                    - 
                    <INPUT maxLength="3" name="Zip1_2" size="3"  readonly value = "<?=$Zip1[1]?>"> 
                    <input type = "button"  value = "우편번호찾기" onClick="javascript:OpenZipcode(this.form)" style="cursor:hand" class = "btn20" > 
                  </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>주소</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="Address1" size="80" type="text" readonly VALUE='<?=$List[Address1]?>'></TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>상세주소</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="Address2" size="50" type="text" VALUE='<?=$List[Address2]?>'></TD>
                </TR>
                <? if($_EJob == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>직업선택</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><SELECT NAME='Job'>
                      <option value = "" selected>직업선택</option>
                      <option value = "" >--------------------</option>
                      <?				  
													foreach($MEMBER_JOB_ARRAY as $key => $value){
														if($key == $List[Job]) $checkSelected = " selected" ; else $checkSelected = "";				  
													if($key) echo "<option value = '$key' $checkSelected>$value</option>";			  
													}
													
												?>
                    </SELECT> </TD>
                </TR>
                <? } ?>
                <? if($_EScholarship == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>학력선택</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><SELECT NAME='Scholarship'>
                      <option value = "" selected>학력선택</option>
                      <option value = "" >--------------------</option>
                      <?				  
												foreach($MEMBER_SCHOOL_ARRAY as $key => $value){
													if($key == $List[Scholarship]) $checkSelected = " selected" ; else $checkSelected = "";				  
												if($key) echo "<option value = '$key' $checkSelected>$value</option>";			  
												}
												
											?>
                    </SELECT> </TD>
                </TR>
                <? } ?>
                <? if($_EPassQna == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> 비밀번호 재발급<br>
                    질문선택</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <SELECT NAME='PWDHint' style='width:356px'>
                      <option value = "">비밀번호 재발급 선택</option>
                      <option value = "" >--------------------------------------------------------</option>
                      <?				  
													foreach($MEMBER_PWD_Q_ARRAY as $key => $value){
															if($key == $List[PWDHint]) $checkSelected = " selected" ; else $checkSelected = "";
														echo "<option value = '$key' $checkSelected>$value</option>";	
													
													}												
											?>
                    </SELECT></TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>비밀번호 재발급<br>
                    답 입력</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="PWDAnswer" size="80" type="text" maxlength = 50 value = "<? echo stripslashes($List[PWDAnswer]) ;?>"></TD>
                </TR>
                <? } ?>
                <? if(!$mode && $USE_RECOMMEND == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>추천인아이디</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3>
                    <? if(!$mode){?>
                    <input type = "text" name = "RecID" value = "<? echo $List[RecID]?>"> 
                    <input type = "button"  value = "추천인검색" class = btn10 onClick="javascript:RecommandCheck(this.form,'RECOMMAND')" style="cursor:hand";> 
                    <? } else { echo $List[RecID]; }?>
                  </TD>
                </TR>
                <? } ?>
                <? if($_ECompany == "checked"){?>
                <TR> 
                  <TD COLSPAN=4 align="center" <? echo $TITLE_STYLE ; ?>>회사정보</TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">회사명</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="Company" size="30" value="<?=$List[Company]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_EPresident == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">대표자명</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="President" size="30" value="<?=$List[President]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_EBusiness == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">업태</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="Business" size="20" value="<?=$List[Business]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_EItem == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">종목</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="Item" size="20" value="<?=$List[Item]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_ECompNum == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">사업자등록번호</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="LicenseNo" size="25" value="<?=$List[LicenseNo]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_ECTel == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> 회사 전화번호</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <select name = "CTel1_1">
                      <option value = "" selected>선택</option>
                      <?
													foreach($MEMBER_PHONE_ARRAY as $key => $value){
													if($value == $CTel[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input name=CTel1_2 type=text id="CTel1_2"  size=4 maxlength=4 value = "<? echo $CTel[1]; ?>">
                    - 
                    <input name=CTel1_3 type=text id="CTel1_3"  size=4 maxlength=4 value = "<? echo $CTel[2]; ?>"> 
                    &nbsp;</TD>
                </TR>
                <? } ?>
                <? if($_ECFax == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> 회사 팩스번호</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <select name = "CFax1_1">
                      <option value = "" selected>선택</option>
                      <?
													foreach($MEMBER_PHONE_ARRAY as $key => $value){
													if($value == $CFax[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input name=CFax1_2 type=text id="CFax1_2"  size=4 maxlength=4 value = "<? echo $CFax[1]; ?>">
                    - 
                    <input name=CFax1_3 type=text id="CFax1_3"  size=4 maxlength=4 value = "<? echo $CFax[2]; ?>"> 
                    &nbsp;</TD>
                </TR>
                <? } ?>
                <? if($_ECAddress == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>회사 우편번호</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT maxLength="3" name="Zip2_1" size="3"  readonly value = "<?=$Zip2[0]?>">
                    - 
                    <INPUT maxLength="3" name="Zip2_2" size="3"  readonly value = "<?=$Zip2[1]?>"> 
                    <input type = "button"  value = "우편번호찾기" onClick="javascript:OpenZipcode1(this.form)" style="cursor:hand" class = "btn20" > 
                  </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>회사주소</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="Address3" size="80" type="text" readonly VALUE='<?=$List[Address3]?>'></TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>회사상세주소</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="Address4" size="50" type="text" VALUE='<?=$List[Address4]?>'></TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD COLSPAN=4 align="center" <? echo $TITLE_STYLE ; ?>>추가정보</TD>
                </TR>
                <? if($_EMailReceive == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>메일 수신</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><input type = "checkbox" name = "MailReceive" value = "Y" <? if($List[MailReceive] == "Y") echo " checked" ;  ?>></TD>
                </TR>
                <? } ?>
                <? if($_ESMS == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>SMS 수신</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><input type = "checkbox" name = "SMSReceive" value = "Y" <? if($List[SMSReceive] == "Y") echo " checked" ;  ?>></TD>
                </TR>
                <? } ?>
                <? if($_EInfo == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>정보공개여부</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><input type = "checkbox" name = "MPublic" value = "Y" <? if($List[MPublic] == "Y") echo " checked" ;  ?>>
                    타인에게 자신의 정보를 공개</TD>
                </TR>
                <? } ?>
                <? if($USE_ICON_TYPE){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>회원아이콘</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><img alt=미리보기 id=sm src="" width="largh" style="VISIBILITY: hidden"  name="imgsiz" border=1><br>
                    <INPUT type = "file" name = "file[]" id = "file" size="40"  onchange="return image_onchange(this.form);"> 
                    <? if($Picture[0]) { echo "<img src = '../${MEMBER_TEMP_FOLDER_NAME}/user_image/$Picture[0]' width = '$MEMBER_ICON_LIMIT_WIDTH' height = '$MEMBER_ICON_LIMIT_HEIGHT' border = 0> <input name='file_del[0]' type='checkbox' value='1'> 이미지삭제"; }  
									
									?>
                    <br>
                    업로드 용량은 <? echo number_format($MEMBER_ICON_LIMIT_CAPACITY); ?> 
                    바이트 이하 / 이미지 크기는 <? echo $MEMBER_ICON_LIMIT_WIDTH; ?> x <? echo $MEMBER_ICON_LIMIT_HEIGHT; ?>으로 
                    해주세요.</TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1"> 회원등급</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>>
										<? if($List[Grade] != "1"){?>
										<SELECT NAME='Grade'>
                      <?
											  // 배열을 역순으로 돌림. key, value를 유지 하고(preserve_keys)	
												foreach(array_reverse($MEMBER_GRADE_NAME,preserve_keys) as $key => $value){													
												if($key == $List[Grade]) $checkSelected = " selected" ; else $checkSelected = "" ;  // defaultSelected 10 등급(일반회원)				  
												if($value && $key != "1") echo "<option value = '$key' $checkSelected >$value</option>";// 관리자와 value 값이 없는건 제외			  
												}
												
											?>
                    </SELECT>
										<? } else { ?>										
										<input type = "hidden" name = "Grade" value = "1">
										최고관리자
										<? } ?>
										
										</TD>
                </TR>
                <? if($mode == "modify"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>로그인횟수</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <? echo number_format(getMemberLoginCnt($List[ID])); ?> 
                    회 </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>보유포인트</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <A HREF='#' onclick="javascript:window.open('./MemberPoint.php?id=<?=$id?>', 'PointWindow','width=650,height=750,statusbar=no,scrollbars=yes,toolbar=no')"> 
                    <? echo number_format(getTotalPoint($List[ID])); ?> Point 
                    </a> </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>회원가입일</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if ($List[RegDate]) echo date("Y-m-d h:i:s" , $List[RegDate]); ?>
                  </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>최근수정일</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if ($List[ModDate]) echo date("Y-m-d h:i:s" , $List[ModDate]); ?>
                  </TD>
                </TR>
								<TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>최근로그인날짜</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
										<? if(getLastLoginDate($id)) echo date("Y-m-d h:i:s" ,getLastLoginDate($id));  ?>                    
                  </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>회원탈퇴일</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if ($List[OutDate]) echo date("Y-m-d h:i:s" , $List[OutDate]); ?>
                  </TD>
                </TR>
								
								<TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>회원상태</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
										<? if($List[Grade] != "1"){?>
                    <select name = "GrantSta">
											<?											  	
												foreach($MEMBER_STATUS_ARRAY as $key => $value){													
												if($key == $List[GrantSta]) $checkSelected = " selected" ; else $checkSelected = "" ; 				  
												echo "<option value = '$key' $checkSelected >$value</option>";			  
												}												
											?>
										</select>
										<? } else { ?>										
										<input type = "hidden" name = "GrantSta" value = "checked">
										승인
										<? } ?>
										
                  </TD>
                </TR>
								
                <? } ?>
                <? if($_EProfile == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>자기소개</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><textarea name="MProfile" rows="7" style="width:99%" value = "<? echo stripslashes($List[MProfile]);?>"></textarea></TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>관리자메모</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><textarea name="MDesc" rows="7" style="width:99%" value = "<? echo stripslashes($List[MDesc]);?>"></textarea></TD>
                </TR>
                <TR> 
                  <TD height = 40 colspan = 10 <? echo $CONTENT_STYLE; ?> align = center ><input type = "image" src = "<? if($mode == "modify") echo "./img/btn_set/btn_modify_03.gif" ; else echo "./img/btn_set/btn_complete_02.gif" ; ?>" align = absmiddle class = "noninput"> 
                    &nbsp; <a href = "<? echo $GoJumpUrl; ?>"><img src = "./img/btn_set/btn_list_02.gif" style = "cursor:hand" border = 0 align = absmiddle></a></TD>
                </TR>
              </TABLE></TD>
          </TR>
        </FORM>
      </TABLE></td>
  </tr>
</table></td>
</tr> </table> 