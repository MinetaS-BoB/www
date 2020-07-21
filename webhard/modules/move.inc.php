<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: move.inc.php,v 1.4 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */

#name Move
#author Andrew Godwin - Edited by Mike Mason
#description Moves stuff.
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

$filepath = bh_fpclean($_GET['filepath']);
$filename = bh_get_filename($filepath);

if (empty($infolder)) { $infolder = $_GET['infolder']; }
if (empty($infolder)) { $infolder = $_POST['infolder']; }
if (empty($infolder)) { $infolder = $bhsession['lastdir']; }
if (empty($infolder)) { $infolder = $bhcurrent['userobj']->homedir; }

if (bh_file_exists($filepath) == true) {

	if ($_POST['newname']) {

		$destfilepath = bh_fpclean($infolder."/".$_POST['newname']);


		$permitexts = array("doc"=>1,"xls"=>1,"hwp"=>1,"txt"=>1,"bmp"=>1,"png"=>1,"jpg"=>1,"gif"=>1,"docx"=>1,"xlsx"=>1,"zip"=>1,"alz"=>1);
		$invalid = False;
		foreach ($permitexts as $ext=>$one) {
			if (substr($destfilepath, 0-(strlen($ext))) == $ext) {
				$invalid = True;
			}
		}
		if (!$invalid) {
			print("허용되지 않는 확장자 입니다.");
			exit();
		}


		if (bh_checkrights($infolder, $bhsession['username']) >= 2) {

			$fileobj = new bhfile($filepath);
			$fileobj->moveto($destfilepath);

			bh_log($bhlang['notice:file_copied'], "BH_NOTICE");
			bh_log(str_replace("#DEST#", $newfilepath, str_replace("#FILE#", $filepath, str_replace("#USER#", $bhsession['username'], $bhlang['log:#USER#_copied_#FILE#_to_#DEST#']))), "BH_FILE_COPIED");

			$_GET['filepath'] = $infolder;

			require "modules/viewdir.inc.php";

		} else { die("You are not allowed to upload files there."); }

	} else {

		$layoutobj = new bhlayout("moveform");
		$layoutobj->infolder = $infolder;
		$layoutobj->subtitle1 = str_replace("#FILE#", $filename, $bhlang['title:moveing_#FILE#']);
		$layoutobj->title = str_replace("#FILE#", $filename, $bhlang['title:moveing_#FILE#']);
		$layoutobj->content1 = $filename;
		$layoutobj->filepath = $filepath;

		$layoutobj->display();

	}


} else {
	bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	require "modules/error.inc.php";
}
