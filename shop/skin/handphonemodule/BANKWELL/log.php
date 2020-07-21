<?
// ###################################################################################
//
//   log.php
//
//   Copyright (c) 2004 BANKWELL Co. LTD.
//   All rights reserved.
//
// ###################################################################################
//
//	Log 정보를 처리하는 모듈
//
// ###################################################################################
//
// ============= Input 변수 ==========================================================
// strModule   : Module Name
// strFunction : Function Name
// strLogMsg   : Logging 할 정보
// ===================================================================================

function TraceLog( $strModule, $strFunction, $strLogMsg )
{
	include "config.php";

	$ForReading   = 1;
	$ForWriting   = 2;
	$ForAppending = 8;

	if ( ! $LOG_FLAG ) return;

	//***************************************************************************
	// Log File 지정
	//***************************************************************************
	if ( empty($LOG_PATH) ) $LOG_PATH = ".";

	$strLogFile = $LOG_PATH."/".$strModule."_".f_Now_Date().".txt";

	//*************************************************************************
	// Logging 할 Record 생성
	//*************************************************************************
	$strRecord = "";
	$strRecord .= "[".f_Now_Time()."] ";
	$strRecord .= PadR($strFunction,18);
	$strRecord .= ": $strLogMsg \n";

	//*************************************************************************
	// 화일에 Logging
	//*************************************************************************
	//Set fs = CreateObject("Scripting.FileSystemObject")
    	//Set f = fs.OpenTextFile(strLogFile, ForAppending, True)
	//f.WriteLine(strRecord)
	//f.Close
	$fp = fopen($strLogFile, "a");
	if ( $fp )
	{
		fwrite($fp, $strRecord, strlen($strRecord));
		fclose( $fp );
	}
}

?>
