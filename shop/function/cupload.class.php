<?php
class CUpload {
	var $arrExt = Array();											// 확장자 검사 (array) 
	var $strSaveDir;													// 업로드 디렉토리 상대경로 (string)
	var $booIsOpen = 0;												// 0 공개 1비공개, 비공개일때 업로드된 파일명 변경 (bool)
	var $uitLimitFileSize = 1048576;								// 업로드 용량제한 (int unsigned)
	var $arrUploadFile = Array();									 // 업로드파일 (array)
	var $arrUploadFileTmp = Array();							 // tmp 에 업로드된 파일 (array)
	var $arrUploadFileName = Array();						  // 파일명 (array)
	var $arrUploadFileExt = Array();							  // 파일 확장자 (array)
	var $arrUploadFileSize = Array();							  // 파일사이즈 (array)
	var $arrComFile = Array();										  // 업로드완료된 파일(업로드중 에러시 이전 업로드파일 삭제) (array)
	var $arrRealFileName = Array();							  // 클라이언트측 파일명 (array)
	var $arrSaveFileName = Array();							// 업로드된 서버측 파일명 (array)
	var $uitUploadFileNum = 0;									 // 업로드 파일 개수 (int unsigned)
	var $strErrMsg = '';												// 에러 메세지 (string)

	function CUpload ($strSaveDir, $booIsOpen=0, $arrExt=array()) {
		$this->strSaveDir = $strSaveDir;											// 저장될 디렉토리 상대경로
		$this->arrExt = $arrExt;															 // 업로드 제한 확장자
		$this->booIsOpen = $booIsOpen;                                        // 업로드 공개
		return true;
	}

	function checkFile() {

		$uitFileSize = 0;																							// 파일 사이즈를 0으로 정의

		for($i=0; $i<$this->uitUploadFileNum; $i++) {												// 파일 숫자 만큼 반복
			 if(is_uploaded_file($this->arrUploadFileTmp[$i])) {								// 업로드된 파일인지 확인
				$strExt = strtolower(substr($this->arrUploadFileName[$i],-3,3));		// 확장자 추출
				$arrExt = Array($strExt);																	// 추출된 확장자 배열로 변환
				if (sizeof($this->arrExt) != 0) {															// 제한 확장자가 있을 경우
					$arrOkExt = array_intersect($this->arrExt,$arrExt);						// 비교해서 같은 것만 입력
				} else {																							// 제한 확장자가 없을 경우 모두 업로드
					$arrOkExt = $arrExt;
				}

				if(sizeof($arrOkExt) == 0 || $strExt == 'php' || $strExt == 'htm' || $strExt == 'html' || $strExt == 'cgi') {																// 업로드가 불가능한 확장자 에러발생
					$this->strErrMsg = "허용되지 않은 파일 확장자 입니다.";
					return 2;                        
				}

				$uitUpFileSize = filesize($this->arrUploadFileTmp[$i]);						// 파일 사이즈 구함

				if($uitUpFileSize > $this->uitLimitFileSize) {										// 업로드 용량 초과시 에러발생
					$this->strErrMsg = "업로드 용량을 초과하였습니다.!!";
					return 3;
				}

				$uitFileSize += $uitUpFileSize;															// 업로드 전체 파일 용량 합계
				$this->arrUploadFileExt[$i] = $strExt;												// 업로드된 파일들의 확장자 배열
			 }else {
				 $this->strErrMsg = "정상적인 업로드 파일이 아닙니다.";
				return 1;                
			}
		}

		if($uitFileSize > $this->uitLimitFileSize) {													// 용량 초과시 에러발생
			$this->strErrMsg = "업로드 용량을 초과하였습니다.";
			return 3;                        
		}
		return 0;
	}

	function upload($arrFile) {
		if(!is_dir($this->strSaveDir)) {																	// 업로드 디렉토리 유무 체크
			$this->strErrMsg = "업로드할 디렉토리가 존재하지 않습니다.";
			return 8;
		}

		$uitFileNum = sizeof($arrFile[tmp_name]);												// 업로드 파일수 체크

		$j = 0;
		for($i=0; $i<$uitFileNum; $i++) {																	// 업로드 될 파일 수 만큼 변수에 파일명등을 저장
			if($arrFile[tmp_name][$i] != "none" && $arrFile[tmp_name][$i]) {
				$this->arrUploadFile[$j] = $arrFile;
				$this->arrUploadFileTmp[$j] = $arrFile[tmp_name][$i];
				$this->arrUploadFileName[$j] = $arrFile[name][$i];
				$this->arrUploadFileSize[$j] = $arrFile[size][$i];
				$j++;
			}
		}     

		if($j == 0) {																								// 업로드 될 파일이 없을 경우
			$strErrMsg = '업로드할 파일이 존재하지 않습니다.';
			return 4;
		}else {
			$this->uitUploadFileNum = $j;																// 업로드 될 파일 갯수 저장
		}

		$uitIsOk = $this->checkFile();																	// 업로드 가능여부 체크(확장자, 사이즈)
		if($uitIsOk > 0) {																						// 업로드 체크에서 오류가 있으면...
			return $uitIsOk;
		}

		$this->setFileName();																				// 서버에 올릴 이름 지정 업로드시 서버에 저장될 이름을 가져옴, 비공개시 이름이 변경됨

		$k = 0;
		for($i=0; $i<$j; $i++) {																				// 실질적인 업로드
			if(!move_uploaded_file($this->arrUploadFileTmp[$i],$this->strSaveDir.$this->arrSaveFileName[$i])) {
				return $this->delUploadFile();															// 업로드 실패시 이전에 업로드된 파일을 삭제
			}else {
				chmod ($this->strSaveDir.$this->arrSaveFileName[$i], 0606);
				$this->arrComFile[$k] = $this->arrSaveFileName[$i];						//업로드 성공된 파일의 배열, 다음 파일이 실패일경우 사용됨
				$k++;
			}
		}
		return 0;																									// 업로드 성공
	}


	function setFileName() {
		$arrName = Array();
		$arrRealFileName = Array();

		for($i=0; $i<$this->uitUploadFileNum; $i++) {																
			$j = $i+1;
			$strExt = strtolower(substr($this->arrUploadFileName[$i],-3,3));							// 확장자
			$arrRealFileName[$i] = $this->arrUploadFileName[$i];						// 파일명
			if($this->booIsOpen == 1) {																					// 비공개일때 서버측 이름 변경
				$arrName[$i] = $j.'_'.time().(int)(microtime() *1000).'_'.$strExt;
				while(file_exists($this->strSaveDir.$arrName[$i])) {										// 파일명이 중복일 경우
					$arrName[$i] = $j.'_'.time().(int)(microtime() *1000).'_'.$strExt; 
				}
			}else {																													// 공개시 파일 이름 설정
				$arrName[$i] = $this->arrUploadFileName[$i];
				if(file_exists($this->strSaveDir.$arrName[$i])) {
					$arrName[$i] = time().'_'.$this->arrUploadFileName[$i];		// 중복일 경우 시간을 추가
				}
			}
			@clearstatcache();
		}
		$this->arrRealFileName = $arrRealFileName;															// 클라이언트 파일명과 서버측 저장 파일명을 저장
		$this->arrSaveFileName = $arrName;
		return $arrName;
	}

	function delUploadFile() {
		$uitIsDel = 5;
		for($i=0; $i<sizeof($this->arrComFile); $i++) {														// 업로드가 완료된 파일 수 만큼 반복해서 삭제
			$uitIsDel = @unlink($this->strSaveDir.$this->arrComFile[$i]);
			if(!$uitIsDel) {
				$uitIsDel = 6;
			}
		}
		return $uitIsDel;
	}

	function getRealFileName () {
		$strRealFileName = '';
		foreach ($this->arrRealFileName as $val) {															// 클라이언트측 파일명을 구분자(|)로 구분하여 문자열로 반환
			$strRealFileName .= $val . "|";
		}
		return $strRealFileName;
	}
	function getSaveFileName () {
		$strSaveFileName = '';
		foreach ($this->arrSaveFileName as $val) {														// 서버측 저장 파일명을 구분자(|)로 구분하여 문자열로 반환
			$strSaveFileName .= $val . "|";
		}
		return $strSaveFileName;
	}
	function getFileSize () {
		$strFileSize = '';
		foreach ($this->arrUploadFileSize as $val) {													// 파일 사이즈를 구분자(|)로 구분하여 문자열로 반환
			$strFileSize .= $val . "|";
		}
		return $strFileSize;
	}
}
?>