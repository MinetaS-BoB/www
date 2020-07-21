<? 
include "../../config/skin_info.php";
include "../../function/kerrigancap_lib.php";
if(!$MailSkin) $MailSkin = "default";
js_location("./$MailSkin/index.php?Name=$Name&Email=$Email");
exit;
?>