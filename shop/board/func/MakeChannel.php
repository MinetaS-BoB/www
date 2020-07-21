<?
//인수 function(채널명)
function MakeChannel($channel){

	global ${BOARD_FOLDER_NAME};

$today = time();
$todayzero = mktime(0,0,0,date("m"),date("d"),date("Y"));
//	mkdir("${SetupPath}/table/${NewTableName}/updir", 0777);
/* channel 폴더가 없을 경우 channel 폴더 생성 */
	if(!file_exists("./${BOARD_FOLDER_NAME}/channel")) mkdir("./${BOARD_FOLDER_NAME}/channel", 0707);
	
/* 현재 작업 channel이 없는 경우 */
	if(!file_exists("./${BOARD_FOLDER_NAME}/channel/$channel")) mkdir("./${BOARD_FOLDER_NAME}/channel/$channel", 0707);
	
/* totalcount.php 가 없을 경우 totalcount.php를 초기화하여 만들고 있을 경우는 토탈 카운트를 1씩 올린다. */
	$filepath1 = "./${BOARD_FOLDER_NAME}/channel/$channel/totalcount.php";
	if(!file_exists("$filepath1")){ 
	$fp = fopen($filepath1, "w");
	fwrite($fp,"1|$todayzero");
	fclose($fp);
	}else{
	$fileLines = file($filepath1);
	$fileArr = explode("|", $fileLines[0]);
	$NewTotalCount = $fileArr[0] + 1;
	$fp = fopen($filepath1, "w");
	fwrite($fp,"${NewTotalCount}|$fileArr[1]");
	fclose($fp);
	}

/*  금일 daily.txt 화일 생성 및 파일 업*/
/* totalcount.php 가 없을 경우 totalcount.php를 초기화하여 만들고 있을 경우는 토탈 카운트를 1씩 올린다. */
	$filepath2 = "./${BOARD_FOLDER_NAME}/channel/$channel/$todayzero.php";
	if(!file_exists("$filepath2")){ 
	$fp = fopen($filepath2, "w");
	fwrite($fp,"$today\n");
	fclose($fp);
	}else{
	$fp = fopen($filepath2, "a");
	fwrite($fp,"$today\n");
	fclose($fp);
	}
	$todaycount = sizeof(file($filepath2));
	
		
/* 금일 카운트와 비교하여 max 카운트 발생시 maxcount.php를 업데이트 한다. */
	$filepath3 = "./${BOARD_FOLDER_NAME}/channel/$channel/maxcount.php";
	if(!file_exists("$filepath3")){ 
	$fp = fopen($filepath3, "w");
	fwrite($fp,"1|$today");
	fclose($fp);
	}
	/* 기존 max 카운트 불러오기 */
	$fileLines = file($filepath3);
	$fileArr = explode("|", $fileLines[0]);
		
	if($todaycount >= $fileArr[0]){
	$fp = fopen($filepath3, "w");
	$NewTotalCount = 
	fwrite($fp,"${todaycount}|$today");
	fclose($fp);
	}

}

?>