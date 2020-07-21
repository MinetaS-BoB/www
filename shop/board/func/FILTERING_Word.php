<?
	
	$prohibit_word = explode(",",$DENYWORD);
	for($i = 0; $i < sizeof($prohibit_word) && $prohibit_word[$i]; $i++){
	//echo "\$CONTENTS = $CONTENTS <br>";
	//echo "\$prohibit_word[$i] = $prohibit_word[$i] <br>";
	
		if($CONTENTS && in_array($prohibit_word[$i],$CONTENTS)){ //내용 체크
			$prohibit_word[$i] = addslashes($prohibit_word[$i]); //스크립트 에러를 막기 위해 사용
			js_alert_location(" 내용에 금지된 단어인 $prohibit_word[$i] 가 \\n 사용되었기 때문에 글을 등록할 수 없습니다. \\n 내용을 수정 후 다시 올려 주시기 바랍니다. ","-1");		
		}
		if($SUBJECT && in_array($prohibit_word[$i],$SUBJECT)){ //제목 체크
		  $prohibit_word[$i] = addslashes($prohibit_word[$i]); //스크립트 에러를 막기 위해 사용
			js_alert_location(" 제목에 금지된 단어인 $prohibit_word[$i] 가 \\n 사용되었기 때문에 글을 등록할 수 없습니다. \\n 제목을 수정 후 다시 올려 주시기 바랍니다. ","-1");	
		
		}		
	}
	

?>