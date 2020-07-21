<div id=divMenu style="left:350px; top:100px; visibility: visible; width: 0px; position: relative;"> 
  <div id=divMenu style="left:0px; top:0px; visibility: visible; width: 0px; position: absolute;"> 
    <!--  높이 257 -->
    <table width="80" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td align="left" valign="top"><a href = "<? echo $CART_MAIN_FILE_NAME; ?>" onFocus="this.blur();"><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/quick_top.gif" width="80" border = 0></a></td>
      </tr>
      <tr> 
        <td height="60" align="center" valign="top" background="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/quick_bg.gif"><table width="80" height="60" border="0" cellpadding="0" cellspacing="0">
            <tr> 
              <td width="5">&nbsp;</td>
              <td align="center" valign="top" bgcolor="#E8E8E8"><table width="70" border="0" cellspacing="0" cellpadding="5">
                  <tr> 
                    <td> 
                      <?  
include "./config/db_info.php";
include "./config/db_connect.php";

if(!$TODAYPRODUCT) $TODAYPRODUCT = $_COOKIE[TODAY_PRODUCT];
if($TODAYPRODUCT):
$PCOOKIE = explode("|" , $TODAYPRODUCT);
$PCOOKIE = array_reverse($PCOOKIE);
$COUNT_COOKIE = sizeof($PCOOKIE) ; 

if($COUNT_COOKIE > 6) $COUNT_COOKIE = 6;

for($i = 0 ; $i <  $COUNT_COOKIE ; $i++){
if(!empty($PCOOKIE[$i])){
$COOKIE_SQL  = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID='$PCOOKIE[$i]'";
$COOKIE_LIST = mysql_fetch_array(mysql_query($COOKIE_SQL));
$COOKIE_PICTURE = explode("|",$COOKIE_LIST[Picture]); 	
$COOKIE_CATEGORY = $COOKIE_LIST[Category];
if($COOKIE_PICTURE[0]):// 사진이 존재 해야 나타남..
?>
                      <table width="60" border="0" cellpadding="0" cellspacing="0">
                        <tr> 
                          <td height="60" align="center" valign="top"><a href="<? echo $MART_MAIN_FILE_NAME;?>?query=view&code=<? echo $COOKIE_CATEGORY; ?>&no=<? echo $PCOOKIE[$i]; ?>"><img src="<? echo $STOCK_FOLDER_NAME; ?>/<? echo $COOKIE_PICTURE[0]; ?>" width="55" height="55" border="0"></a></td>
                        </tr>
                        <tr> 
                          <td height="2"></td>
                        </tr>
                      </table>
                      <?   
endif;
		}
	}
	
	
else :
?>
                      <table width="60" border="0" cellpadding="0" cellspacing="0">
                        <tr> 
                          <td height="60" align="center" valign="top">오늘본 상품이 
                            존재 하지 않습니다.</td>
                        </tr>
                        <tr> 
                          <td height="2"></td>
                        </tr>
                      </table>
                      <?	
	endif;
?>
                    </td>
                  </tr>
                </table></td>
              <td width="5">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr> 
        <td height="24" align="center" valign="middle" background="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/quick_bott.gif"><a href="#"><img src="<? echo $SKIN_FOLDER_NAME; ?>/layout/<? echo $LayOutSkin; ?>/images/quick_btn_top.gif" width="19" height="13" border="0"></a></td>
      </tr>
    </table>
  </div>
</div>
<script src = "./js/quick_scroll.js"></script>
