<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '0');
/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   filelink.php
 *   $Id: filelink.php,v 1.3 2005/07/28 20:53:21 andrewgodwin Exp $
 *
 */
 
/*

This file handles the FileMail codes. It takes in the codes, checks them, and either dishes out the file or a warning message.

*/


define("IN_BH", 1);
session_start();

 
# Temporary layout fix
#$bhconfig['layout'] = "discoverer";
#$bhconfig['skin'] = "roundedsolid";

# Get includes
require "includes/version.inc.php";				# Version
require "includes/configfunc.inc.php";				# Config functions
bh_checkconfig();						# Check the config exists, or don't bother with the rest.
require "config.inc.php";					# Load config file
require "includes/db/".$dbconfig['dbmod'];			# Database functions 
bh_loadconfig();						# Load configuration

//require "includes/auth/".$bhconfig['authmodule'];		# Authentication functions 
require "langs/".$bhconfig['lang'].".lang.php";					# Language File 
require "includes/filesystem/".$bhconfig['filesystemmodule']."/filesystem.inc.php";	# Filesystem functions 
require "includes/filesystem/".$bhconfig['filesystemmodule']."/mimetype.inc.php";	# Mimetype functions
require "includes/filesystem/".$bhconfig['filesystemmodule']."/thumbnails.inc.php";	# Thumbnail functions 
require "layouts/".$bhconfig['layout']."/main.inc.php";		# Layout file 
require "includes/log.inc.php";					# Logging functions
require "includes/users.inc.php";				# User functions
require "includes/modules.inc.php";				# Module functions
require "includes/detect.inc.php";				# Detection functions
require "includes/views.inc.php";				# View functions
require "includes/bandwidth.inc.php";				# Bandwidth functions
require "includes/misc.inc.php";				# Miscellaneous functions
require "includes/email.inc.php";				# Email functions
require "includes/filelink.inc.php";				# FileLink/FileMail functions

require "includes/pear/PEAR.php";				# Inbuilt PEAR file. This is bad, I know, but we need it.
require "includes/pear/Archive/tar.inc.php";			# And the Archive_Tar library. Slightly modified.

//bh_updatemoduledb();						# Add any new modules
//bh_purge_old();							# Purge old requests for things


# Right. See if there is a file code
if (empty($_GET['folderDZ'])) { bh_die("error:no_foldercode"); }

$filecode = $_GET['folderDZ'];
$fileInfo = bh_folderDZ_destination($filecode);

if ($fileInfo == false) 
  { 
    bh_log(str_replace("#FILELINK", $filecode, $bhlang['log:filelink_denied']), "BH_FILELINK_ACCESSED"); 
	bh_die("error:filecode_invalid"); 
  }
  
  
  
# Well, it must be valid.
$quota    = $fileInfo[0]["quota"];
$filepath = $fileInfo[0]["filepath"];
$emailTO  = $fileInfo[0]["email"];

//print_r($fileInfo[0]);

if ($fileInfo[0]["notify"]==1) {
	$emailNotify = true;
}

$bhcurrent['userobj'] = new bhuser($fileInfo[0]["username"]);
$uname = $fileInfo[0]["username"];
$userobj   = new bhuser($uname);
$fullname  = $userobj->userinfo['fullname'];
$emailFrom = $userobj->userinfo['email'];



# If it is a upload:
if ($fullname != "") {
	$sender = $fullname;
} else {
	$sender = $uname;
}



///////////////////////////////
$username = $fileInfo[0]["username"];
$bhcurrent['userobj'] = new bhuser($username);

# Loop through any posted files and save details in array
$fupload = array();
if (is_array($_FILES)) {
	foreach($_FILES as $varname => $fileinfo ){
		if(empty($fileinfo["name"]) !== TRUE) {
			$fupload[] = array('tempname' => $fileinfo["tmp_name"], 'name' => $fileinfo["name"], 'size' => $fileinfo["size"]);
		}
	}
} else {
	die("No uploaded files recieved. Fatal error.");
}

	# Calculate used bandwidth
	foreach($fupload as $fileinfo) {
		bh_bandwidth($username, "up", $fileinfo['size']);
	}

	# Check they can write to the destination directory
	if (bh_checkrights($filepath, $username) >= 2) {
		foreach($fupload as $fileinfo) {
			# If it's a valid upload...
			if (empty($fileinfo['name']) !== TRUE) {
				# Check the file actually exists.
				if (file_exists($fileinfo['tempname'])) {
					# Create thing of banned exts
					$bannedexts = array("exexexexex"=>1);
					$invalid = False;
					foreach ($bannedexts as $ext=>$one) {
						if (substr($fileinfo['name'], 0-(strlen($ext))) == $ext) {
							$invalid = True;
						}
					}
					# Check the file would not exceed the quota
					if ($quota < $fileinfo['size']) {
						bh_add_logvars(array("quota"=>round($quota/1048576,2)));
						bh_add_error($bhlang['error:quota_exceeded']);
					} elseif ($invalid) {
						print("You have tried to upload an invalid filetype.");
						exit();
					} else {
						#update Quota remaining...
							update_bhdb("folderdzcodes", array("quota"=>$quota - $fileinfo['size']), array("foldercode"=>$filecode));
						# All fine, continue
						$badcharacters = array("'", '"', "\\");
						$newfilepath = bh_fpclean($filepath."/".str_replace($badcharacters, "", $fileinfo['name']));
						$tmppath = $fileinfo['tempname'];
						
						bh_move_uploaded_file($tmppath, $newfilepath);
						//echo $newfilepath;
						# Make it add info into the db.
						$newfileobj = new bhfile($newfilepath);
						unset($newfileobj);
						bh_log(str_replace("#FILE#", $fileinfo['name'], $bhlang['notice:file_#FILE#_upload_success']), "BH_NOTICE");
						bh_log(str_replace("#USER#", $bhsession['username'], str_replace("#FILE#", $newfilepath, $bhlang['log:#USER#_uploaded_#FILE#'])), "BH_FILE_UPLOAD");


						$fileList .= $newfilepath."\n\r";
				
	
	
	
					}
					
					
				} else {
					# Error???
					$newfilepath = bh_fpclean($infolder."/".$fileinfo['name']);
					bh_add_logvars(array("file"=>$fileinfo['name'], "user"=>$bhsession['username'], "username"=>$bhsession['username']));
					bh_add_error($bhlang['notice:file_#FILE#_upload_failure']);
					bh_add_log($bhlang['log:#USER#_failed_upload_#FILE#'], "BH_FILE_UPLOAD");
				}
			}
		}
		
				#tell user about new file(s)
		if ($emailNotify == true) {
			$NotifyeMail = new bhemail();
			$NotifyeMail->to = $emailFrom;
			if ($emailTo != "") {
				$NotifyeMail->from = $emailTo;					
			} else {
				$NotifyeMail->from = "NoReply@" . $_SERVER[SERVER_NAME];
				$emailTo = "SomeBody";
			}
				$str2rpl = array("#SENDER#", "#SITENAME#");
				$str2plc = array($emailTo, $bhconfig['sitename']);
			$NotifyeMail->subject = str_replace($str2rpl, $str2plc, $bhlang['email:fileReceivedSubject']);
				$str2rpl = array("#USER#", "#SENDER#", "#FILES#", "#SITENAME#");
				$str2plc = array($fullname, $emailTo, $fileList, $bhconfig['sitename']);
			$NotifyeMail->message = str_replace($str2rpl, $str2plc, $bhlang['email:fileReceivedContent']);
			$NotifyeMail->send();
		}		
		
		# Show directory where they went
		# $_GET['filepath'] = $infolder;
		# require "modules/viewdir.inc.php";
		
	} else {
		# Sorry, no access.
		//echo "no access";
		bh_log($bhlang['error:no_write_permission'], "BH_ACCESS_DENIED");
		require "modules/error.inc.php";
	}

////////////////////////
$username = "guest";
$bhcurrent['userobj'] = new bhuser("guest");


$layoutobj = new bhlayout("DZuploadform");
# Send the file listing to the layout, along with directory name
$layoutobj->title = $bhlang['title:upload'];
$layoutobj->content1 = $bhlang['explain:upload'];
$layoutobj->type = "DZuploadform";
	$findarr = array("#SENDER#", "#QUOTA#");
	$replarr = array($sender,round($quota/1048576, 2));
$bhlang['title:hasgrantedyou'] = str_replace($findarr, $replarr, $bhlang['title:hasgrantedyou']);
				
$layoutobj->display();





?> 