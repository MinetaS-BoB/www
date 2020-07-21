<?
//현재 동일 데이타가 있는지 책크
$OrderCnt = getSingleValue("SELECT COUNT(UID) FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$_COOKIE[CART_CODE]'");

if($OrderCnt > 0){//현재 주문번호가 존재하면
	$sqlstr = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$_COOKIE[CART_CODE]'";
	$sqlqry = mysql_query($sqlstr);
	$olist = mysql_fetch_array($sqlqry);
	$Zip1 = explode("-",$olist[Zip1]);
	$Zip2 = explode("-",$olist[Zip2]);
	$Sender_Tel = explode("-",$olist[Sender_Tel]); 
	$Sender_Hand = explode("-",$olist[Sender_Hand]);
	$Re_Tel = explode("-",$olist[Re_Tel]); 
	$Re_Hand = explode("-",$olist[Re_Hand]);
	$Sender_Company = $olist[Sender_Company];		
	$Address1 = $olist[Address1];
	$Address2 = $olist[Address2];
	$Address3 = $olist[Address3];
	$Address4 = $olist[Address4];
	$How_Bank = $olist[How_Bank];
	$Inputer = $olist[Inputer];
	$Sender_Name = $olist[Sender_Name];	
	$Sender_Email = explode("@" , $olist[Sender_Email]);	
	$Re_Email = explode("@" , $olist[Re_Email]);
	$Re_Name = $olist[Re_Name];
	$Message = $olist[Message];
}else if ( isMember() ) {
	$sqlstr = "SELECT * FROM ${MEMBER_TABLE_NAME} WHERE ID='$_COOKIE[MEMBER_ID]'";
	// echo  "sqlstr = $sqlstr <br>";
	$sqlqry = mysql_query($sqlstr);
	$olist = mysql_fetch_array($sqlqry);
	$Zip1 = explode("-",$olist[Zip1]);
	$Zip2 = explode("-",$olist[Zip2]);
	$Sender_Tel = explode("-",$olist[Tel]); 
	$Sender_Hand = explode("-",$olist[Hand]);
	$Sender_Company = $olist[Company];
	$Address1 = $olist[Address1];
	$Address2 = $olist[Address2];
	$Inputer = $olist[Name];
	$Sender_Name = $olist[Name];	
	$Sender_Email = explode("@" , $olist[Email]);
}

//if(isset($CARD_ENABLE_MONEY)) $CARD_ENABLE_MONEY = 0;

?>	
<script language="JavaScript" src="./js/General.js"></script>
<script language=javascript>
<!--

       
function CheckField(f)
{
            
									
		if (!f.Sender_Name.value) {
				alert("주문자 성명을 정확히 적어주십시오.");
				f.Sender_Name.focus();
				return false;
		}
		
		<? if(!isMember()):?>
		if (!f.PWD.value) {
				alert("비밀번호를 입력하여 주십시요");
				f.PWD.focus();
				return false;
		}		
		<? endif;?>

		if (f.Tel1_1.value.length < 1 && f.Tel2_1.value.length < 1) {
				alert("전화번호는 반드시 1개 이상 입력되어야 합니다.");
				f.Tel1_1.focus();
				return false;
		}
		
		if (f.Sender_Email1.value == "" || f.Sender_Email2.value == "") {
				alert("E-mail 주소를 입력하여 주십시요.");
				f.Sender_Email1.focus();
				return false;
		}
	 if  (f.Address1.value.length < 2) {
				alert("주소를 입력해주세요");
				f.Address1.focus();
				return false;
		}
		
	 if  (f.Address2.value.length < 2) {
				alert("상세주소를 입력해주세요");
				f.Address2.focus();
				return false;
		}

// 주문자 

		if (!f.Re_Name.value) {
				alert("받는분 성명을 정확히 적어주십시오.");
				f.Re_Name.focus();
				return false;
		}
		
		if (f.Tel3_1.value.length < 1 && f.Tel4_1.value.length < 1) {
				alert("전화번호는 반드시 1개 이상 입력되어야 합니다.");
				f.Tel3_1.focus();
				return false;
		}
					
		if (f.Re_Email1.value == "" || f.Re_Email2.value == "") {
				alert("E-mail 주소를 입력하여 주십시요.");
				f.Re_Email1.focus();
				return false;
		}
	 if  (f.Address3.value.length < 2) {
				alert("주소를 입력해주세요");
				f.Address3.focus();
				return false;
		}
		
	 if  (f.Address4.value.length < 2) {
				alert("상세주소를 입력해주세요");
				f.Address4.focus();
				return false;
		}

		if(!radiocheck(f.PayType)){
			alert('결제방법을 선택해 주세요');
			return false;
		}
		
}


function CopyValue(f){
	if(f.CopyAll.checked){	
		f.Re_Name.value = f.Sender_Name.value;
		f.Re_Email1.value = f.Sender_Email1.value;
		f.Re_Email2.value = f.Sender_Email2.value;
		f.Tel3_1.value = f.Tel1_1.value;
		f.Tel3_2.value = f.Tel1_2.value;
		f.Tel3_3.value = f.Tel1_3.value;
		f.Tel4_1.value = f.Tel2_1.value;
		f.Tel4_2.value = f.Tel2_2.value;
		f.Tel4_3.value = f.Tel2_3.value;
		f.Zip2_1.value = f.Zip1_1.value;
		f.Zip2_2.value = f.Zip1_2.value;
		f.Address3.value = f.Address1.value;
		f.Address4.value = f.Address2.value;
		return;
	}else{
		f.Re_Name.value = "";
		f.Re_Email1.value = "";
		f.Re_Email2.value = "";		
		f.Tel3_1.value = "";
		f.Tel3_2.value = "";
		f.Tel3_3.value = "";
		f.Tel4_1.value = "";
		f.Tel4_2.value = "";
		f.Tel4_3.value = "";
		f.Zip2_1.value = "";
		f.Zip2_2.value = "";
		f.Address3.value = "";
		f.Address4.value = "";		
		return;	
	}
}

function mailChange(f){// 메일 선택 
    if(f.sel_email.value){
      f.Sender_Email2.value=f.sel_email.value;				
    } else{
			f.Sender_Email2.value = "";
			f.Sender_Email2.focus();	
		}
}

function mailChange2(f){// 메일2 선택 
    if(f.sel_email2.value){
      f.Re_Email2.value=f.sel_email2.value;				
    } else{
			f.Re_Email2.value = "";
			f.Re_Email2.focus();	
		}
}


//-->
</script>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top"> 
    <td height="10" colspan="3"> </td>
  </tr>
  <tr align="left" valign="top"> 
    <td height="5" colspan="3"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_top_img_02.gif" width="690" height="100"></td>
  </tr>
  <tr align="left" valign="top"> 
    <td style="background-image: url(<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="670" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="10"></td>
        </tr>
        <tr> 
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%" align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;주문서작성 </td>
              </tr>
            </table></td>
                <td width="50%" align="right" valign="middle" class="666666_s">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="10"></td>
        </tr>
        <tr> 
          <td height="5" background="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/customer/bar01.gif"> </td>
        </tr>
        <tr> 
          <td height="20" align="left" valign="middle"> </td>
        </tr>
        <tr> 
          <td height="20" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="45" valign="top" class="999999">고객님의 배송지 정보와 결제방법을 
                  입력해 주세요. <br>
                  회원이실 경우,입력이 더욱 편리하고 혜택을 누리실수 있습니다. </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" valign="top"> 
<? 
// 장바구니 보기
include "${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_VIEW.php";
?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br> <br> <form name='FrmUserInfo' method=post action='<? echo  $_SERVER['PHP_SELF']; ?>?query=cardchecking' OnSubmit='return CheckField(this)'>							
              <input type="hidden" name="cod" value="<?=$cod?>">              
              <input type=hidden name=TOTAL_MONEY value='<?=$TOTAL_MONEY?>'>
              <input type=hidden name=goods_name value='<?=$NAME?>'>
							<input type=hidden name=Delivery_Money value='<?=$TACKBAE_MONEY?>'><!-- 택배비 -->
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td height="25" valign="top"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_t_06.gif" width="84" height="16"></td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td height="3"  bgcolor="909090"></td>
                            </tr>
                            <tr> 
                              <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                  <tr> 
                                    <td width="115" height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      주문하시는분</td>
                                    <td bgcolor="ffffff"><input name="Sender_Name" type="text" class="input2" id="Sender_Name" value="<?=$Sender_Name?>" size="50"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                    </td>
                                  </tr>
																	<? if(!isMember()){?>
																	<tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      비밀번호 </td>
                                    <td bgcolor="ffffff"><input name="PWD" type="password" class="input2" size="20">주문배송 조회시 필요 합니다.(10자리 이하)</td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                    </td>
                                  </tr>
																	<? } ?>
																	
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      회사명/부서명 </td>
                                    <td bgcolor="ffffff"><input name="Sender_Company" type="text" class="input2" size="50" value="<?=$Sender_Company?>"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      전화번호 </td>
                                    <td bgcolor="ffffff">
																		  <select name = "Tel1_1">
																			<option value = "" selected>선택</option>
																			<?
																				foreach($MEMBER_PHONE_ARRAY as $key => $value){
																				if($value == $Sender_Tel[0]) $checkSelected = " selected" ; else $checkSelected = "";
																				echo "<option value='$value' $checkSelected>$value</option>" ;
																			}
																			?>
																		</select>
                                      - 
                                      <input name="Tel1_2" type="text" class="input2" size="4" maxlength = 4 value="<?=$Sender_Tel[1];?>">
                                      - 
                                      <input name="Tel1_3" type="text" class="input2" size="4" maxlength = 4  value="<?=$Sender_Tel[2];?>"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      휴대전화 </td>
                                    <td bgcolor="ffffff">
																		<select name = "Tel2_1">
																			<option value = "" selected>선택</option>
																			<?
																			foreach($MEMBER_HANDPHONE_ARRAY as $key => $value){
																			if($value == $Sender_Hand[0]) $checkSelected = " selected" ; else $checkSelected = "";
																			echo "<option value='$value' $checkSelected>$value</option>" ;
																			}
																			?>
																			</select>																		
                                      - 
                                      <input name="Tel2_2" type="text" class="input2" size="4" maxlength = 4  value="<?=$Sender_Hand[1];?>">
                                      - 
                                      <input name="Tel2_3" type="text" class="input2" size="4" maxlength = 4  value="<?=$Sender_Hand[2];?>"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      이메일 </td>
                                    <td bgcolor="ffffff">
																		<input name="Sender_Email1" type="text" class="input2" size="15" value = "<? echo $Sender_Email[0];?>" >
																		@ 
																		<input name="Sender_Email2" type="text"  size="15" value = "<? echo $Sender_Email[1];?>"  class="input2"> <select name="sel_email" style="WIDTH: 120px" onchange="mailChange(this.form)">
																			<option value=''>기타메일직접입력</option>
																			<?
																				foreach($MEMBER_EMAIL_ARRAY as $key => $value){
																					echo "<option value='$key'>$value</option>" ;
																				}
																			 ?>
																			<option value=''>기타메일직접입력</option>
																		</select>
																		</td>
                                  </tr>
																	<tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
																	
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      우편번호 </td>
                                    <td bgcolor="ffffff"><table border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td><input name="Zip1_1" type="text" class="input2" size="4" readonly value="<?=$Zip1[0]?>">
                                            - 
                                            <input name="Zip1_2" type="text" class="input2" size="4" readonly value="<?=$Zip1[1]?>"></td>
                                          <td width="83" align="center"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_ad.gif" width="73" height="18" border="0"  onclick='javascript: OpenZipcode(document.FrmUserInfo)'style='cursor: hand'></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      주소 </td>
                                    <td bgcolor="ffffff"><input name="Address1" type="text" class="input2"  value="<?=$Address1?>" size="60" READONLY></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      나머지주소 </td>
                                    <td bgcolor="ffffff"><input name="Address2" type="text" class="input2"  value="<?=$Address2?>" size="60"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
																	 <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      희망배송일 </td>
                                    <td bgcolor="ffffff"> <? 
																				getSelectDate("YMD" , "WDY" , "WDM" , "WDD" , 0, 1 ,"Y");
																			?></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
																	
																	
                                </table></td>
                            </tr>
                            <tr> 
                              <td height="2" bgcolor="909090"></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <br>
              <br>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="84" height="25" valign="top"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_t_07.gif" width="84" height="16"></td>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td> <input type="checkbox" name="CopyAll" onclick="javascript:CopyValue(this.form)"; style="cursor:hand"></td>
                        <td class="999999">주문하신분과 받으시는분이 같으시면 체크하여 주세요 </td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td height="3"  bgcolor="909090"></td>
                            </tr>
                            <tr> 
                              <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                  <tr> 
                                    <td width="115" height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      받는분 </td>
                                    <td bgcolor="ffffff"><input name="Re_Name" type="text" class="input2" id="Re_Name" value="<?=$Re_Name;?>" size="50" ></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>																	
																	 <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      전화번호 </td>
                                    <td bgcolor="ffffff">
																		<select name = "Tel3_1">
																			<option value = "" selected>선택</option>
																			<?
																				foreach($MEMBER_PHONE_ARRAY as $key => $value){
																				if($value == $Re_Tel[0]) $checkSelected = " selected" ; else $checkSelected = "";
																				echo "<option value='$value' $checkSelected>$value</option>" ;
																			}
																			?>
																		</select>																
                                      - 
                                      <input name="Tel3_2" type="text" class="input2" maxlength = 4  value="<?=$Re_Tel[1];?>" size="4">
                                      - 
                                      <input name="Tel3_3" type="text" class="input2" maxlength = 4  value="<?=$Re_Tel[2];?>" size="4"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      휴대전화 </td>
                                    <td bgcolor="ffffff">
																		<select name = "Tel4_1">
																			<option value = "" selected>선택</option>
																			<?
																				foreach($MEMBER_HANDPHONE_ARRAY as $key => $value){
																				if($value == $Re_Hand[0]) $checkSelected = " selected" ; else $checkSelected = "";
																				echo "<option value='$value' $checkSelected>$value</option>" ;
																			}
																			?>
																		</select>
                                      - 
                                      <input name="Tel4_2" type="text" class="input2" maxlength = 4  value="<?=$Re_Hand[1];?>" size="4">
                                      - 
                                      <input name="Tel4_3" type="text" class="input2" maxlength = 4  value="<?=$Re_Hand[2];?>" size="4"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
																	<tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      이메일 </td>
                                    <td bgcolor="ffffff">
																		<input name="Re_Email1" type="text" class="input2" size="15" value = "<? echo $Re_Email[0];?>" >
																		@ 
																		<input name="Re_Email2" type="text"  size="15" value = "<? echo $Re_Email[1];?>"  class="input2"> <select name="sel_email2" style="WIDTH: 120px" onchange="mailChange2(this.form)">
																			<option value=''>기타메일직접입력</option>
																			<?
																				foreach($MEMBER_EMAIL_ARRAY as $key => $value){
																					echo "<option value='$key'>$value</option>" ;
																				}
																			 ?>
																			<option value=''>기타메일직접입력</option>
																		</select>																		
																		</td>
                                  </tr>
																	<tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
																	<tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      우편번호 </td>
                                    <td bgcolor="ffffff"><table border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td><input name="Zip2_1" type="text" class="input2" size="4" readonly value="<?=$Zip2[0]?>">
                                            - 
                                            <input name="Zip2_2" type="text" class="input2" size="4" readonly value="<?=$Zip2[1]?>"></td>
                                          <td width="83" align="center"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_ad.gif" width="73" height="18" border="0"  onclick='javascript: OpenZipcode1(document.FrmUserInfo)'style='CURSOR: hand'></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      주소 </td>
                                    <td bgcolor="ffffff"><input name="Address3" type="text" class="input2"  value="<?=$Address3?>" size="60" READONLY></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      나머지주소 </td>
                                    <td bgcolor="ffffff"><input name="Address4" type="text" class="input2"  value="<?=$Address4?>" size="50"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b">                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      남기실말씀</td>
                                    <td bgcolor="ffffff"><textarea name="Message" cols="83" rows="5" class="input2"><?=$Message?></textarea></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td height="2" bgcolor="909090"></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <br>
              <br>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td height="25" valign="top"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_t_08.gif" width="84" height="16"></td>
                </tr>
                <tr> 
                  <td height="45" valign="top" class="999999"> 주문자와 입금자가 다를 경우는 
                    반드시 실제로 입금하실 분의 이름을 입금자명에 입력해 주세요. <br>
                    온라인 입금을 사용하지 않으실경우 그대로 두세요 </td>
                </tr>
              </table>
							<!-- 결제 수단 선택-->
							
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="3"  bgcolor="909090"></td>
  </tr>
  <tr> 
    <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
        <tr> 
          <td width="115" height="30" valign="middle" class="333333_b"> &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
            결제방법선택 </td>
          <td bgcolor="ffffff">

<? if($ONLINE_ENABLE == "checked") : ?><input type=radio name='PayType' value='bank' onclick="PaySelect(this)"><b>무통장입금</b><? endif; ?>
<? if($CARD_ENABLE == "checked") : ?><input type=radio name='PayType' value='card' onclick="PaySelect(this)"><b>신용카드</b><? endif; ?>
<? if($AUTOBANKING_ENABLE == "checked") : ?><input type=radio name='PayType' value='autobank' onclick="PaySelect(this)"><b>계좌이체</b><? endif; ?>
<? if($PHONE_ENABLE == "checked") : ?><input type=radio name='PayType' value='hand' onclick="PaySelect(this)"><b>핸드폰결제</b><? endif; ?>
<? if($ESCROW_ENABLE == "checked") : ?><input type=radio name='PayType' value='escrow' onclick="PaySelect(this)"><b>에스크로결제</b><? endif; ?>
					
            </td>
        </tr>
        <tr bgcolor="#C7C7C7"> 
          <td height="1" colspan="2" valign="middle" class="333333_b"> </td>
        </tr>
				 <tr> 
          <td width="115" height="30" valign="middle" class="333333_b"> &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
            주문금액 </td>
          <td bgcolor="ffffff"><?  echo  number_format($TOTAL_MONEY);?>원				
            </td>
        </tr>
        <tr bgcolor="#C7C7C7"> 
          <td height="1" colspan="2" valign="middle" class="333333_b"> </td>
        </tr>
				<? if(!isMember() && !$POINT_ENABLE){?>
 				<tr> 
          <td width="115" height="30" valign="middle" class="333333_b"> &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
            결제금액 </td>
          <td bgcolor="ffffff" class = orange-b-02><?  echo  number_format($TOTAL_MONEY);?>원				
            </td>
        </tr>
        <tr bgcolor="#C7C7C7"> 
          <td height="1" colspan="2" valign="middle" class="333333_b"> </td>
        </tr>
				<? } ?>
				
      </table></td>
  </tr>
  <tr> 
    <td height="2" bgcolor="909090"></td>
  </tr>
</table>
<br>

<div id=point_div style="display:none">
<? if($POINT_ENABLE == "checked" && isMember()):?>
	
									<table  border="0" cellpadding="0" cellspacing="0">
										<tr><td height="29" align="center"><font color="#1AA5B0"><strong>포인트 결제</strong></font> - <font color="#CC3300">포인트 구매금액이 <? echo number_format($POINT_ENABLE_MONEY); ?>Point 이상 부터</font> 가능합니다. </td></tr>
									</table><br>
									
								<table  border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td  width="5" height="5"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/winBoxCnr01.gif" width="5" height="5"></td>
										<td background="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/winBoxT01.gif"></td>
										<td width="5" height="5"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/winBoxCnr02.gif" width="5" height="5"></td>
									</tr>
									<tr>
										<td background="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/winBoxL01.gif"></td>
										<td height="50" align="center" style="padding:15px">
										<table  border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td align="center">
												<table width="450"  border="0" cellpadding="0" cellspacing="0">
													<tr>
														    <td width="120" height="29" align="right">주문금액</td>
														<td style="padding-left:50px">
														<table width="150"  border="0" cellpadding="0" cellspacing="1">
															<tr>
																<td width="150" align="right" class="price"><?  echo  number_format($TOTAL_MONEY);?></td>
																<td align="right" class="price"><font color="#000000">원</font></td>
															</tr>
														</table>
														</td>
													</tr>
													<tr><td background="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/hdot.gif" height="1" colspan="2"></td></tr>
												</table>
												  
												<table width="450"  border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td width="120" height="29" align="right">사용할 포인트(-)</td>
														<td style="padding-left:50px">
														<table width="150"  border="0" cellpadding="0" cellspacing="1">
															<tr>
																<td width="150" align="right" class="price"><input onchange='setPayMoney(this.form);' onclick='setPayMoney(this.form);'   name="PointMoney" type="text" class="input2" style="width:140px; height:18px; color:#F24800; text-align:right; font-weight:bold; font-size:9pt" value="0"></td>
																<td align="right" class="price"><font color="#000000">원</font></td>
															</tr>
														</table>
														</td>
														<td style="padding-left:10px"></td>
													</tr>
												</table>
												<table width="450"  border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td style="padding-left:65px">
														<table width="270"  border="0" cellpadding="0" cellspacing="1">
															<tr><td align="right" class="price">사용가능 적립금 : <font color="#000000"><? echo number_format(getTotalEnablePoint($_COOKIE[MEMBER_ID]));?>원</font></td></tr>
														</table>
														</td>
														<td style="padding-left:10px"></td>
													</tr>
												</table>
												<table width="450" border="0" cellpadding="0" cellspacing="0">
													<tr><td bgcolor="#BCBCBC" height="1" colspan="2"></td></tr>
													<tr>
														<td width="168" height="35" align="right"><span id = "PayTitle" style = "color:5F2E96;font-weight:bold"></span>&nbsp;<strong><font color="#827648">결제하실 금액 </font></strong></td>
														<td width="282" class="price" >&nbsp;<input readonly name="PayMoney" type="text" class="input2" style="width:140px; height:18px; color:#F24800; text-align:right; font-weight:bold; font-size:11pt" value="<?  echo  number_format($TOTAL_MONEY);?>"> <font color="#000000">원</font>
														
														</td>
													</tr>
												</table>
												</td>
											</tr>
										</table>
										</td>
										<td background="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/winBoxR01.gif"></td>
									</tr>
									<tr>
										<td width="5" height="5"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/winBoxCnr04.gif" width="5" height="5"></td>
										<td background="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/winBoxB01.gif"></td>
										<td width="5" height="5"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/winBoxCnr03.gif" width="5" height="5"></td>
									</tr>
								</table><br>
<? endif; ?>
								</div>

								<div id=escrow_form style="display:none"></div>
															
							<div id=bank_div style="display:none">
<? if($ONLINE_ENABLE == "checked"):?>
							<!-- 결제 수단 선택-->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td height="3"  bgcolor="909090"></td>
                            </tr>
                            <tr> 
                              <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">                                 
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                    </td>
                                  </tr>                                  
                                 
                                  <tr> 
                                    <td width="16%" height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      은행선택 </td>
                                    <td width="84%" bgcolor="ffffff"> <select name='How_Bank' size='1' id="How_Bank">
<?
if (file_exists("./config/bank_info.php")) {
$BANK_KIND = file("./config/bank_info.php");
	while($bank = each($BANK_KIND)) {
			$bank[1] = chop($bank[1]);
			if($bank[1]) {
				 echo  "<option vlaue='$bank[1]'>$bank[1]</option>\n";
			}
	}
} else {
		 echo  "<option>무통장 입금 계좌가 등록되지 않았습니다.</option>";
}
?>
                                      </select> </td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      입금자명 </td>
                                    <td bgcolor="ffffff"><input name="Inputer"  maxlength="30"  value='<?=$Inputer?>' type="text" class="input2" size="20"></td>
                                  </tr>
                                  <tr bgcolor="#C7C7C7"> 
                                    <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="30" valign="middle" class="333333_b"> 
                                      &nbsp;<img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                      입금예정일 </td>
                                    <td bgcolor="ffffff"> 
                                      <? 
																				getSelectDate("YMD" , "DY" , "DM" , "DD" , 0, 1 ,"Y");
																			?>
                                    </td>
                                  </tr>																									
                                </table></td>
                            </tr>
                            <tr> 
                              <td height="2" bgcolor="909090"></td>
                            </tr>
                          </table>
<? endif; ?>
													</div>							
              
              <br>
              <br>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr align="center"> 
                  <td width="112"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_reset.gif" width="102" height="27"  onClick="javascript:history.go(-1);" style="cursor:hand"></td>
                  <td width="112"><input type = "image" src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_money.gif" width="102" height="27" border="0"></td>
                </tr>
              </table>
            </form>
            <br></td>
        </tr>
        <tr> 
          <td height="50" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td width="10" background="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="10" height="10"><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<?  echo  $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
<script>
// 결제 방법에 따라 DIV 숨기고 보이기 
function PaySelect(obj){
	
	var tmpVar = obj.value;	
	document.all['point_div'].style.display = "";
	if(tmpVar == "bank"){
			document.all['bank_div'].style.display = "";
			<? if($POINT_ENABLE == "checked" && isMember()):?>document.all['PayTitle'].innerText = "무통장입금";<? endif;?>
	}else if(tmpVar == "card"){
			document.all['bank_div'].style.display = "none";
			<? if($POINT_ENABLE == "checked" && isMember()):?>document.all['PayTitle'].innerText = "신용카드";<? endif;?>		
	}else if(tmpVar == "autobank"){
			document.all['bank_div'].style.display = "none";
			<? if($POINT_ENABLE == "checked" && isMember()):?>document.all['PayTitle'].innerText = "계좌이체";<? endif;?>		
	}else if(tmpVar == "hand"){
			document.all['bank_div'].style.display = "none";
			<? if($POINT_ENABLE == "checked" && isMember()):?>document.all['PayTitle'].innerText = "핸드폰";<? endif;?>		
	}else if(tmpVar == "escrow"){
			document.all['bank_div'].style.display = "none";
			<? if($POINT_ENABLE == "checked" && isMember()):?>document.all['PayTitle'].innerText = "에스크로";<? endif;?>		
	}
					
}
</script>
<script language=javascript>
var FilterValue = "0123456789,";
function setPayMoney(f) {	
	num1 = filterNum(f.PointMoney.value);
	num2 = filterNum(f.TOTAL_MONEY.value);				
	
	if (!TypeCheck(f.PointMoney.value, FilterValue)) {
			alert('숫자와 콤마만 입력가능합니다.');
			f.PointMoney.value = '0';
			f.PayMoney.value = commaSplit(f.TOTAL_MONEY.value);
			f.PointMoney.focus();
			return;   								           
	}
	
	if (parseInt(num1) > parseInt(num2)) {
			alert('포인트 결제금액이 제품 구매액보다 많게 입력되었습니다');
			f.PointMoney.value = 0;
			f.PayMoney.value = commaSplit(f.TOTAL_MONEY.value);								
			f.PointMoney.focus();								
			return;								             
	}				
	
	
	if( num1 < <? echo $POINT_ENABLE_MONEY; ?> && num1 > 0) {
		alert('<? echo $POINT_ENABLE_MONEY ; ?> 이상부터 포인트를 사용하실수 있습니다.');					
			f.PointMoney.value = 0;
			f.PayMoney.value = commaSplit(f.TOTAL_MONEY.value);
			f.PointMoney.focus(); 							              				
	}else if (num1 > <? echo getTotalEnablePoint($_COOKIE[MEMBER_ID]) ; ?>) {
			alert('고객님께서 사용가능한 <? echo  number_format(getTotalEnablePoint($_COOKIE[MEMBER_ID]));?>포인트 이내에서만 구매가능합니다.');                
			f.PointMoney.value = 0;
			f.PayMoney.value = commaSplit(f.TOTAL_MONEY.value);
			f.PointMoney.focus();  								                   
	}else {				
			f.PointMoney.value = commaSplit(f.PointMoney.value);
			f.PayMoney.value = commaSplit(num2 - num1) ;
	}
	
}
</script>
