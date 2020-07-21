<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/


include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/admin_info.php";
include "../../../config/skin_info.php";
include "../../../config/shopDisplay_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

include "../../../function/filter.php";
////////////////////////////////
// 파라메터 필터링
////////////////////////////////
$no = filter($no);


?>
<script language="JavaScript">
<!--
function ChangeImage(ImgName) {
PathImg = "../../../<? echo ${STOCK_FOLDER_NAME}; ?>/"+ImgName;
    if(ImgName != ""){
    document.all.GoodsBigPic.filters.blendTrans.stop();
    document.all.GoodsBigPic.filters.blendTrans.Apply();
    document.all.GoodsBigPic.src=PathImg;
    document.all.GoodsBigPic.filters.blendTrans.Play();
        }

document['GoodsBigPic'].src = PathImg;
}
-->
</script>

<?
/* Get a information of a piece of First Image */
$sqlstr="SELECT * FROM ${MALL_TABLE_NAME} WHERE UID = '$no'";
// echo  'query : '.$sqlstr;

$sqlqry=mysql_query($sqlstr) or die(mysql_error());
$list = mysql_fetch_array($sqlqry);
$Picture = explode("|", $list[Picture]);
?>

<html>
<head>
<title>확대보기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="3" cellpadding="0" cellspacing="0" bordercolor="#A0B927">
  <tr>
    <td align="left" valign="top"><table width="594" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><table width="594" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="500" align="left" valign="top"><table width="500" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top"><img src="picviewimages/zoom_img01.gif" width="119" height="33"></td>
                    </tr>
                    <tr>
                      <td height="380" align="center" valign="middle"><img name="GoodsBigPic" src='../../../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[2]?>' width = "<? echo $LIMAGEW; ?>" height = "<? echo $LIMAGEH; ?>" style="filter:blendTrans(duration=0.5)" border="0"></td>
                    </tr>
                  </table></td>
                <td width="122" align="left" valign="top"><table width="122" height="500" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                    <tr>
                      <td width="120" align="center" valign="top" background="picviewimages/zoom_bg01.gif">

<?
$NO=0;
for($i=2; $i < sizeof($Picture)-1; $i++){
if($Picture[$i]){
?>
                        <table width="60" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="60" align="center" valign="top"><img src="../../../<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[$i]?>" width="80" height = "80" border="0" onMouseOver="ChangeImage('<?=$Picture[$i]?>')"></td>
                          </tr>
                          <tr>
                            <td height="2"></td>
                          </tr>
                        </table>
<?
	}
 }?>
						</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="28" align="left" valign="middle" bgcolor="#A0B927">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="79%" align="left"><img src="picviewimages/zoom_img02.gif" width="338" height="12"></td>
                <td width="21%" align="right" style="padding-right : 10"><a href="#" onClick="self.close();"><img src="picviewimages/zoom_btn_close.gif" width="47" height="14" border="0"></a></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<script>
	this.focus();
</script>
