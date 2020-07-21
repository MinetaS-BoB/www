<?
/*
if ($SUBJECT) {
	$SUBJECT = eregi_replace("\|", "&#124;", $SUBJECT);
	if ( $PASS != $BOARD_PASS && $PASS != $ROOT_PASS) {
	$SUBJECT = eregi_replace("<", "&lt;", $SUBJECT);
	$SUBJECT = eregi_replace(">", "&gt;", $SUBJECT);
	$SUBJECT = eregi_replace("\"", "&quot;", $SUBJECT);
	}
}
*/
if ($CONTENTS) {
//$TxtType =  settype(string, $TxtType);
//$TxtType = 5;	
	if (!strcmp($TxtType,"br")) { 
		$CONTENTS = ereg_replace("\r\n\r\n", "<P>", $CONTENTS);
//		$CONTENTS = ereg_replace("\r\n", "<BR>", $CONTENTS);
		$CONTENTS = eregi_replace("\|", "&#124;", $CONTENTS);
	}else if(!strcmp($TxtType,"html")){
		//$CONTENTS = ereg_replace("\r\n\r\n", "", $CONTENTS);
		//$CONTENTS = ereg_replace("\r\n", "", $CONTENTS);
		//$CONTENTS = eregi_replace("\|", "&#124;", $CONTENTS);
	}else if(!strcmp($TxtType,"2")) {
		$CONTENTS = ereg_replace("\r\n\r\n", "<P>", $CONTENTS);
//		$CONTENTS = ereg_replace("\r\n", "<BR>", $CONTENTS);
		$CONTENTS = eregi_replace("\|", "&#124;", $CONTENTS);
	}else if(!strcmp($TxtType,"1")){//Html 체크시필터

		$CONTENTS = eregi_replace("<script>", "&lt;script&gt;", $CONTENTS);
		$CONTENTS = eregi_replace("<xmp>", "&lt;xmp&gt;", $CONTENTS);
		$CONTENTS = eregi_replace("</script>", "&lt;/script&gt;", $CONTENTS);
		$CONTENTS = eregi_replace("</xmp>", "&lt;/xmp&gt;", $CONTENTS);
		//$CONTENTS = ereg_replace("\r\n\r\n", "", $CONTENTS);
		//$CONTENTS = ereg_replace("\r\n", "", $CONTENTS);
		//$CONTENTS = eregi_replace("\|", "&#124;", $CONTENTS);
	}else{//($TxtType == "text")
	
		$CONTENTS = eregi_replace("<", "&lt;", $CONTENTS);
		$CONTENTS = eregi_replace(">", "&gt;", $CONTENTS);
		$CONTENTS = eregi_replace("\"", "&quot;", $CONTENTS);
		$CONTENTS = eregi_replace("\|", "&#124;", $CONTENTS);
//		$CONTENTS = eregi_replace("\r\n\r\n", "<P>", $CONTENTS);
//		$CONTENTS = eregi_replace("\r\n", "<BR>", $CONTENTS);

	}
	
}
?><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">