<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Module
 *   $Id: movefolder.inc.php,v 1.1 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 */
 
#name Move
#author Andrew Godwin - Edits by Mike Mason
#description Moves folders
#iscore 1

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }


$filepath = bh_fpclean($_GET['filepath']);
$filename = bh_get_filename($filepath);

if (empty($infolder)) { $infolder = $_GET['infolder']; }
if (empty($infolder)) { $infolder = $_POST['infolder']; }
if (empty($infolder)) { $infolder = $bhsession['lastdir']; }
if (empty($infolder)) { $infolder = $bhcurrent['userobj']->homedir; }


if (bh_file_exists($filepath) == true && $bhcurrent['userobj']->homedir <> $filepath) {

	if ($_POST['newname']) {
	
		$destfilepath = bh_fpclean($infolder."/".$_POST['newname']);
	
		$fileobj = new bhfile($filepath);
		$fileobj->moveto($destfilepath);
		
		bh_log($bhlang['notice:folder_copied'], "BH_NOTICE");
		bh_log(str_replace("#DEST#", $newfilepath, str_replace("#FILE#", $filepath, str_replace("#USER#", $bhsession['username'], $bhlang['log:#USER#_copied_#FILE#_to_#DEST#']))), "BH_FILE_COPIED");
		
		$_GET['filepath'] = $infolder;
		
		require "modules/viewdir.inc.php";
	
	} else {
		
		$layoutobj = new bhlayout("movefolderform");
		$layoutobj->infolder = $infolder;
		$layoutobj->subtitle1 = str_replace("#FILE#", $filename, $bhlang['title:moveing_#FILE#']);
		$layoutobj->title = str_replace("#FILE#", $filename, $bhlang['title:moveing_#FILE#']);
		$layoutobj->content1 = $filename;
		$layoutobj->filepath = $filepath;
		
		$layoutobj->display();
	
	}
	
	
} else {
    if ($bhcurrent['userobj']->homedir == $filepath) {
		bh_log($bhlang['error:move_home_dir'], "BH_NOPAGE");
	} else {
		bh_log($bhlang['error:file_not_exist'], "BH_NOPAGE");
	}
	require "modules/error.inc.php";
}