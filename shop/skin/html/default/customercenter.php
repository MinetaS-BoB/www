<?

if($query == "sendmail"){

$sender = $Mail1."@".$Mail2;
//$receiver = "master@webpiad.co.kr";
$receiver = "$ADMIN_EMAIL";

$title = "공객상담문의메일[${ADMIN_TITLE}]";

$mailheaders .=  "Return-Path: $sender\r\n";

$mailheaders .=  "From: $Name<$sender>\r\n";

$mailheaders .=  "X-Mailer: SHOP_WIZARD FORM Mailer\r\n";

$mailheaders .=  "Mime-Version: 1.0\r\n";

$mailheaders .=  "Content-Type: text/html; charset='iso-2022-kr'\r\n";





$save = "

<table width='537' border='0' cellspacing='0' cellpadding='0'>

    <tr> 

      <td><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_01.gif' width='536' height='15'></td>

    </tr>

    <tr> 

      <td> <table width='510' border='0' cellspacing='0' cellpadding='0'>

          <tr> 

            <td width='25' background='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_02.gif'>&nbsp;</td>

            <td width="484" valign='top'> <table width='484' border='0' cellspacing='0' cellpadding='0'>

                <tr> 

                  <td height='5'></td>

                </tr>

                <tr> 

                  <td class='text1'> <table width='484' border='0' cellspacing='0' cellpadding='0' height='25'>

                      <tr> 

                        <td class='text' width='98'><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_05.gif' width='4' height='4' hspace='2' align='absmiddle'> 

                          제 목</td>

                        <td class='text' valign='middle'>$Subject

                        </td>

                      </tr>

                    </table></td>

                </tr>

                <tr> 

                  <td> <table width='484' border='0' cellspacing='0' cellpadding='0' height='25'>

                      <tr> 

                        <td class='text' width='98'><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_05.gif' width='4' height='4' hspace='2' align='absmiddle'> 

                          성 명</td>

                        <td class='text' valign='middle'>$Name

                        </td>

                      </tr>

                    </table></td>

                </tr>

                <tr> 

                  <td height='5'></td>

                </tr>

                <tr> 

                  <td align='center'><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_06.gif' width='484' height='1'></td>

                </tr>

                <tr> 

                  <td align='center' height='5'> </td>

                </tr>

                <tr> 

                  <td> <table width='484' border='0' cellspacing='0' cellpadding='0' height='25'>

                      <tr> 

                        <td class='text' width='98'><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_05.gif' width='4' height='4' hspace='2' align='absmiddle'> 

                          연락처</td>

                        

                      <td class='text' valign='middle'> <img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_07.gif' width='4' height='6' hspace='7'>전<font color='#FFFFFF'>..</font> 

                        화 : $Tel1_1 - $Tel1_2 - $Tel1_3 </td>

                      </tr>

                    </table></td>

                </tr>

                <tr> 

                  <td align='center'> <table width='484' border='0' cellspacing='0' cellpadding='0' height='25'>

                      <tr> 

                        <td class='text' width='98'>&nbsp;</td>

                        

                      <td class='text' valign='middle'> <img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/client/on_img_07.gif' width='4' height='6' hspace='7'>핸드폰 

                        : 

                        $Tel2_1 - $Tel2_2 - $Tel2_3

                        </td>

                      </tr>

                    </table></td>

                </tr>

                <tr> 

                  <td align='center'> <table width='484' border='0' cellspacing='0' cellpadding='0' height='25'>

                      <tr> 

                        <td class='text' width='98'>&nbsp;</td>

                        

                      <td class='text' valign='middle'> <img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_07.gif' width='4' height='6' hspace='7'>팩<font color='#FFFFFF'>..</font> 

                        스 : 

                        $Tel3_1 - $Tel3_2 -  $Tel3_3

                        </td>

                      </tr>

                    </table></td>

                </tr>

                <tr> 

                  <td align='center' height='11' valign='middle'><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/client/on_img_06.gif' width='484' height='1'></td>

                </tr>

                <tr> 

                  <td align='center'> <table width='484' border='0' cellspacing='0' cellpadding='0' height='25'>

                      <tr> 

                        <td class='text' width='98'><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_05.gif' width='4' height='4' hspace='2' align='absmiddle'> 

                          E-mail</td>

                        <td class='text' valign='middle'> $sender

                        </td>

                      </tr>

                    </table></td>

                </tr>

                <tr> 

                  <td height='5'></td>

                </tr>

                <tr> 

                  <td><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_06.gif' width='484' height='1'></td>

                </tr>

                <tr> 

                  <td height='5'></td>

                </tr>

                <tr> 

                  <td align='center'> <table width='484' border='0' cellspacing='0' cellpadding='0' height='25'>

                      <tr> 

                        <td class='text' width='98'><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_05.gif' width='4' height='4' hspace='2' align='absmiddle'> 

                          문의항목</td>

                        <td class='text' valign='middle'> $Item </td>

                      </tr>

                    </table></td>

                </tr>

                <tr> 

                  <td align='center'> <table width='484' border='0' cellspacing='0' cellpadding='0' height='25'>

                      <tr> 

                        <td class='text' width='98' valign='top'>
                          <h2>문의사항</h2></td>

                        <td class='text' valign='middle'> $Contents

                        </td>

                      </tr>

                    </table></td>

                </tr>

              </table></td>

            <td width='10' background='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_03.gif'>&nbsp;</td>

          </tr>

        </table></td>

    </tr>

    <tr> 

      <td><img src='$MART_BASEDIR/$SKIN_FOLDER_NAME/html/$HtmlSkin/images/on_img_04.gif' width='536' height='28'></td>

    </tr>

    <tr> 

      <td align='center' height='7'></td>

    </tr>

</table>

";





 $mresult = mail("$receiver", "$title", $save, $mailheaders);
 if($sender) mail("$sender", "$title", $save, $mailheaders);
  if($mresult){
          echo "<script>window.alert('정상적으로 메일이 발송되었습니다.\\n 받는이메일 : $receiver \\n 보내는 이메일 : $sender');location.replace('./');</script>";
  }else{

          echo "<script>window.alert('Warnning Traffic Error!! Pls try again later');

                history.go(-1); </script>";

       }



    



}



?>



<script language="JavaScript">

<!--

function checkForm(){

var f=document.InquireForm;

  if(f.Subject.value == ''){

  alert('제목을 입력해주세요');

  f.Subject.focus();

  return false;

  }  

  else if(f.Name.value == ''){

  alert('성함을 입력해주세요');

  f.Name.focus();

  return false;

  }

 }

//-->

</script><table width="690" border="0" cellspacing="0" cellpadding="0">
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
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;고객센타 </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr> 

                <td><div align="left"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/title_01.gif" width="567" height="30"></div></td>

              </tr>

              <tr> 

                <td height="30">&nbsp;</td>

              </tr>

              <tr> 

                <td align="center" valign="top"> <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family: '굴림', '돋움','Arial';font-size: 12px; color:#666666;line-height:140%">

                    <tr> 

                      <td valign="top" widtth="555"></td>

                    </tr>

                    <tr> 

                      <td valign="top"> <div align="left"> </div>

                        <span class="text2"><?=$ADMIN_TITLE?>을 이용해 주셔서 감사합니다. </span> 

                        <p class="text2">저희 <?=$ADMIN_TITLE?>에서는 무엇보다도 완벽한 품질의 제품과 최고의 서비스를 

                          제공하기<br>

                          위하여 끊임없이 노력하고 있습니다.</p>

                        <p class="text2">저희 제품에 대하여 궁금하신 사항이나 사용상의 문제점 등 제반 문의사항이 
                          있으시면<br>
                          전화( 
                          <?=$CUSTOMER_TEL?>
                          ) 또는 이메일을 주십시오.</p>

                        <p class="text2">☞ 회사 연락처<br>

                          주 소 : <?=$COMPANY_ADD?><br>

                          전 화 : <?=$CUSTOMER_TEL?><br>

                          팩 스 : <?=$CUSTOMER_FAX?><br>

                          <span class="text2">E-mail : <?=$ADMIN_EMAIL?></span></p></td>

                    </tr>

                    <tr> 

                      <td valign="top">&nbsp;</td>

                    </tr>

                    <tr> 

                      <td><table width="100%" border="0" cellspacing="0" cellpadding="2">

                          <tr> 

                            <td class="products3"><font color="#FF6600">문의메일</font></td>

                          </tr>

                          <tr> 

                            <td> <table border="0" cellpadding="0" cellspacing="0">

                                <form name="InquireForm" method="POST" action="<?=$PHP_SELF?>" onsubmit='return checkForm();' enctype="multipart/form-data">

                                  <input type="hidden" name="html" value="customercenter">

                                  <input type="hidden" name="query" value="sendmail">

                                  <tr> 

                                    <td height="11"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_bgc_01.gif" width="11" height="11"></td>

                                    <td height="11"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_bg_02.gif" width="514" height="11"></td>

                                    <td height="11"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_bgc_02.gif" width="11" height="11"></td>

                                  </tr>

                                  <tr> 

                                    <td background="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_bg_01.gif">&nbsp;</td>

                                    <td><table border="0" align="center" cellpadding="0" cellspacing="0">

                                        <td valign="top"> <table width="484" border="0" cellspacing="0" cellpadding="0">

                                            <tr> 

                                              <td height="15"></td>

                                            </tr>

                                            <tr> 

                                              <td class="text1"> <table width="484" height="25" border="0" cellpadding="0" cellspacing="0" style="font-family: '굴림', '돋움','Arial';font-size: 12px; color:#666666;line-height:140%">

                                                  <tr> 

                                                      <td class="text" width="98"><img src="../<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_icon_1.gif" width="4" height="4" hspace="2" align="absmiddle"> 

                                                        제 목</td>

                                                    <td class="text" valign="middle"> 

                                                      <input name="Subject" type="text" class="border" id="address" size="50"> 

                                                    </td>

                                                  </tr>

                                                </table></td>

                                            </tr>

                                            <tr> 

                                              <td> <table width="484" height="25" border="0" cellpadding="0" cellspacing="0" style="font-family: '굴림', '돋움','Arial';font-size: 12px; color:#666666;line-height:140%">

                                                  <tr> 

                                                    <td class="text" width="98"><img src="../<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_icon_1.gif" width="4" height="4" hspace="2" align="absmiddle"> 

                                                      성 명</td>

                                                    <td class="text" valign="middle"> 

                                                      <input name="Name" type="text" class="border" id="Tel3" size="8"> 

                                                    </td>

                                                  </tr>

                                                </table></td>

                                            </tr>

                                            <tr> 

                                              <td height="5"></td>

                                            </tr>

                                            <tr> 

                                              <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/dot.gif"></td>

                                            </tr>

                                            <tr> 

                                              <td align="center" height="5"> </td>

                                            </tr>

                                            <tr> 

                                              <td> <table width="484" height="25" border="0" cellpadding="0" cellspacing="0" style="font-family: '굴림', '돋움','Arial';font-size: 12px; color:#666666;line-height:140%">

                                                  <tr> 

                                                    <td class="text" width="98"><img src="../<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_icon_1.gif" width="4" height="4" hspace="2" align="absmiddle"> 

                                                      연락처</td>

                                                      <td class="text" valign="middle"> 

                                                        <img src="../<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_icon.gif" width="4" height="6" hspace="7">전<font color="#FFFFFF">..</font> 

                                                        화 

                                                        <input name="Tel1_1" type="text" class="border" id="Tel1_1" size="3">

                                                      - 

                                                      <input name="Tel1_2" type="text" class="border" id="Tel1_2" size="4">

                                                      - 

                                                      <input name="Tel1_3" type="text" class="border" id="Tel1_3" size="5"> 

                                                    </td>

                                                  </tr>

                                                </table></td>

                                            </tr>

                                            <tr> 

                                              <td align="center"> <table width="484" height="25" border="0" cellpadding="0" cellspacing="0" style="font-family: '굴림', '돋움','Arial';font-size: 12px; color:#666666;line-height:140%">

                                                  <tr> 

                                                    <td class="text" width="98">&nbsp;</td>

                                                    <td class="text" valign="middle"> 

                                                      <img src="../<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_icon.gif" width="4" height="6" hspace="7">핸드폰 

                                                      <input name="Tel2_1" type="text" class="border" id="Tel1" size="3">

                                                      - 

                                                      <input name="Tel2_2" type="text" class="border" id="Tel2" size="4">

                                                      - 

                                                      <input name="Tel2_3" type="text" class="border" id="Tel3" size="5"> 

                                                    </td>

                                                  </tr>

                                                </table></td>

                                            </tr>

                                            <tr> 

                                              <td align="center"> <table width="484" height="25" border="0" cellpadding="0" cellspacing="0" style="font-family: '굴림', '돋움','Arial';font-size: 12px; color:#666666;line-height:140%">

                                                  <tr> 

                                                    <td class="text" width="98">&nbsp;</td>

                                                    <td class="text" valign="middle"> 

                                                      <img src="../<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_icon.gif" width="4" height="6" hspace="7">팩<font color="#FFFFFF">..</font> 

                                                      스 

                                                      <input name="Tel3_1" type="text" class="border" id="Tel1" size="3">

                                                      - 

                                                      <input name="Tel3_2" type="text" class="border" id="Tel2" size="4">

                                                      - 

                                                      <input name="Tel3_3" type="text" class="border" id="Tel3" size="5"> 

                                                    </td>

                                                  </tr>

                                                </table></td>

                                            </tr>

                                            <tr> 

                                              <td align="center" height="11" valign="middle"><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/dot.gif" width="484" height="1"></td>

                                            </tr>

                                            <tr> 

                                              <td align="center"> <table width="484" height="25" border="0" cellpadding="0" cellspacing="0" style="font-family: '굴림', '돋움','Arial';font-size: 12px; color:#666666;line-height:140%">

                                                  <tr> 

                                                    <td class="text" width="98"><img src="../<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_icon_1.gif" width="4" height="4" hspace="2" align="absmiddle"> 

                                                      E-mail</td>

                                                    <td class="text" valign="middle"> 

                                                      <input name="Mail1" type="text" class="border" id="Mail1" size="9">

                                                      @ 

                                                      <input name="Mail2" type="text" class="border" id="Mail2" size="12"> 

                                                    </td>

                                                  </tr>

                                                </table></td>

                                            </tr>

                                            <tr> 

                                              <td height="5"></td>

                                            </tr>

                                            <tr> 

                                              <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/dot.gif"></td>

                                            </tr>

                                            <tr> 

                                              <td height="5"></td>

                                            </tr>

                                            <tr> 

                                              <td align="center"> <table width="484" height="25" border="0" cellpadding="0" cellspacing="0" style="font-family: '굴림', '돋움','Arial';font-size: 12px; color:#666666;line-height:140%">

                                                  <tr> 

                                                    <td class="text" width="98"><img src="../<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_icon_1.gif" width="4" height="4" hspace="2" align="absmiddle"> 

                                                      문의항목</td>

                                                    <td class="text" valign="middle"> 

                                                      <select name="Item" class="border" id="Item">

                                                        <option selected>==항목을 

                                                        선택하세요==</option>

                                                        <option>---------------------</option>

                                                        <option value="제품 구입에 관한 문의">제품 

                                                        구입에 관한 문의</option>

                                                        <option value="제품 사용법에 관한 문의">제품 

                                                        사용법에 관한 문의</option>

                                                        <option value="제품 서비스에 관한 문의">제품 

                                                        서비스에 관한 문의</option>

                                                        <option value="기타">기타</option>

                                                      </select> </td>

                                                  </tr>

                                                </table></td>

                                            </tr>

                                            <tr> 

                                              <td align="center"> <table width="484" height="25" border="0" cellpadding="0" cellspacing="0" style=" color:#666666;line-height:140%">

                                                  <tr> 

                                                    <td class="text" width="98" valign="top">
                                                      <h2>문의사항</h2></td>

                                                    <td class="text" valign="middle"> 

                                                      <textarea name="Contents" cols="52" rows="5" wrap="VIRTUAL" class="border" id="Contents"></textarea> 

                                                    </td>

                                                  </tr>

                                                </table></td>

                                            </tr>

                                            <tr> 

                                              <td height="15" align="center"></td>

                                            </tr>

                                          </table></td>

                                        </tr>

                                      </table></td>

                                    <td background="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_bg_03.gif">&nbsp;</td>

                                  </tr>

                                  <tr> 

                                    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_bgc_03.gif" width="11" height="11"></td>

                                    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_bg_04.gif" width="514" height="11"></td>

                                    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/list_bgc_04.gif" width="11" height="11"></td>

                                  </tr>

                                  <tr> 

                                    <td height="10" colspan="3" align="center"></td>

                                  </tr>

                                  <tr> 

                                    <td colspan="3" align="center"><input name="image" type="image" src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/enter_img.gif" width="70" height="29"> 

                                      &nbsp;&nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/html/<?=$HtmlSkin?>/images/cancle_btn.gif" width="70" height="29" hspace="5" onclick="history.go(-1)"; style="cursor:hand"> 

                                    </td>

                                  </tr>

                                </form>

                              </table>

                              <p>&nbsp;</p></td>

                          </tr>

                        </table></td>

                    </tr>

                  </table></td>

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
