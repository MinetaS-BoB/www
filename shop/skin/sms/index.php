<? 
include "../../config/skin_info.php";
include "../../function/kerrigancap_lib.php";
if(!$SMSSkin) $SMSSkin = "icode";
js_location("./$SMSSkin/index.php?addcall=$addcall");
exit;
?>
