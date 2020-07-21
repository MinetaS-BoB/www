<?
	if(!$_COOKIE[ROOT_COLOR_TYPE]){
		setcookie("ROOT_COLOR_TYPE", "2", 0, "/");
	}
	include "../function/const_array.php" ;
	include "../function/kerrigancap_lib.php" ;	
?>
<HTML>
<HEAD>
<TITLE>INSTALL PAGE</TITLE>
</HEAD><link href="./style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<BODY>
<table width="747" border="0" cellspacing="0" cellpadding="0" align = center>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width=100% cellspacing=0 cellpading = 0 border=0 >
        <TR> 
          <TD WIDTH=100% HEIGHT=50 BGCOLOR=WHITE VALIGN=TOP><table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
              <TR ALIGN=CENTER HEIGHT=22 > 
                <TD colspan="6" <? echo $TITLE_STYLE ; ?>>
								<FONT STYLE="font-size:15pt;" SIZE=4><B>쇼핑몰 INSTALL 
								PAGE</B></FONT> <br>
								* install 전의 준비사항<br>
								- webroot에 반드시 config 디렉토리가 생성되어있어야하고 퍼미션이 707 혹은 777 이어야합니다.<br>
								- webroot/<? echo ${BOARD_FOLDER_NAME}; ?>/table 의 퍼미션이 707 혹은 777 이어야 합니다.<br>
								- webroot/<? echo ${BOARD_FOLDER_NAME}; ?>/channel 의 퍼미션이 707 혹은 777 이어야 합니다.<br>
								- webroot/<? echo ${STOCK_FOLDER_NAME}; ?> 의 퍼미션이 707 혹은 777이어야 합니다.<br>         
								- webroot/<? echo ${MEMBER_TEMP_FOLDER_NAME}; ?> 의 퍼미션이 707 혹은 777이어야 합니다.<br>								
								<br>
								- 상기 퍼미션이 정상적으로 주어졌어면 아래의 Next 버튼을 눌러 주세요
				</TD>
              </TR>
              
            </TABLE>
            </TD>
        </TR>
		<tr>
			<td align = center><?
if(!is_dir("../config")) ECHO"WebRoot에 config 디렉토리를 생성하시고 퍼미션을 707로 조절해 주세요";
else if(fileperms("../config")!=16839 && fileperms("../config")!=16895) ECHO "webroot/config 의 퍼미션을 707로 조절해 주세요. <a href='#' onClick= 'location.reload()'>새로고침</a>";
else if(file_exists("../config/db_info.php") && fileperms("../config/db_info.php")!=33279 && fileperms("../config/db_info.php")!=33223 && fileperms("../config/db_info.php")!=33188) ECHO "webroot/config/db_info.php 의 퍼미션을 707로 조절해 주세요. <a href='#' onClick= 'location.reload()'>새로고침</a>";
else if(file_exists("../config/db_connect.php") && fileperms("../config/db_connect.php")!=33279 && fileperms("../config/db_connect.php")!=33223 && fileperms("../config/db_connect.php")!=33188) ECHO "webroot/config/db_connect.php 의 퍼미션을 707로 조절해 주세요. <a href='#' onClick= 'location.reload()'>새로고침</a>";
else if(fileperms("../${BOARD_FOLDER_NAME}/table") !=16839 && fileperms("../${BOARD_FOLDER_NAME}/table") !=16895) ECHO "webroot/${BOARD_FOLDER_NAME}/table 의 퍼미션을 707로 조절해 주세요. <a href='#' onClick= 'location.reload()'>새로고침</a>";
else if(fileperms("../${BOARD_FOLDER_NAME}/channel") !=16839 && fileperms("../${BOARD_FOLDER_NAME}/channel") !=16895) ECHO "webroot/${BOARD_FOLDER_NAME}/channel 의 퍼미션을 707로 조절해 주세요. <a href='#' onClick= 'location.reload()'>새로고침</a>";
else if(fileperms("../${STOCK_FOLDER_NAME}") !=16839 && fileperms("../${STOCK_FOLDER_NAME}") !=16895) ECHO "webroot/${STOCK_FOLDER_NAME} 의 퍼미션을 707로 조절해 주세요. <a href='#' onClick= 'location.reload()'>새로고침</a>";
else if(fileperms("../${MEMBER_TEMP_FOLDER_NAME}") !=16839 && fileperms("../${MEMBER_TEMP_FOLDER_NAME}") !=16895) ECHO "webroot/${MEMBER_FOLDER_NAME}/${MEMBER_TEMP_FOLDER_NAME} 의 퍼미션을 707로 조절해 주세요. <a href='#' onClick= 'location.reload()'>새로고침</a>";
else ECHO "<INPUT TYPE=Button VALUE='Next' onclick = \"javascript:location.replace('./install2.php')\" style=\"cursor:hand\" class = 'btn20'> ";
?></td>
		</tr>
      </TABLE></td>
  </tr>
</table>

</BODY></HTML>