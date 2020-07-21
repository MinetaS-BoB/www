<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Language file
 *   $Id: en.lang.php,v 1.11 2005/07/28 22:38:50 andrewgodwin Exp $
 *
 */

#name English
#author Andrew Godwin
#description The (default) english language file.

$bhlang['module:main'] = "메인";
$bhlang['module:login'] = "로그인";
$bhlang['module:logout'] = "로그아웃";
$bhlang['module:find'] = "Find File";

$bhlang['title:login'] = "로그인";
//$bhlang['explain:login'] = "Please enter your username and password to login to the system.";
$bhlang['explain:login'] = "아이디와 비밀번호를 입력하세요.";

$bhlang['label:username'] = "아이디: ";
$bhlang['label:password'] = "비밀번호: ";
$bhlang['button:login'] = "로그인";

$bhlang['title:folders'] = "폴더";

$bhlang['title:viewing_directory'] = "Viewing directory:";
$bhlang['error:not_a_dir'] = "The file path provided is not a directory.";

$bhlang['error:nothing_in_toolbar'] = "You have no items in your toolbar. This is a fatal error; please see your admiinstrator.";

$bhlang['error:not_a_file'] = "The file provided is not the right type for this action.";
$bhlang['error:no_file_specified'] = "This action needs a file, but it seems you've come here without one.";
$bhlang['title:viewing_file'] = "파일: ";

$bhlang['module:download'] = "다운로드";
$bhlang['moduledesc:download'] = "파일 다운로드";

$bhlang['module:delete'] = "삭제";
$bhlang['moduledesc:delete'] = "파일 삭제";

$bhlang['label:_files'] = " Files";

$bhlang['title:error'] = "Error";
// $bhlang['explain:error_occured'] = "An error has occurred. It has been logged, but please notify the administrator if you think it is serious.";
$bhlang['explain:error_occured'] = "에러가 발생하였습니다.";

//$bhlang['error:page_not_exist'] = "That page does not exist!";
//$bhlang['error:file_not_exist'] = "That file does not exist!";
//$bhlang['error:move_home_dir'] = "Hey, You can't move your home directory!";

$bhlang['error:page_not_exist'] = "페이지가 존재하지 않습니다.!";
$bhlang['error:file_not_exist'] = "파일이 존재하지 않습니다.!";
$bhlang['error:move_home_dir'] = "홈디렉토리는 이동할 수 없습니다.";

// $bhlang['error:directory_no_exist'] = "That directory does not exist!";
$bhlang['error:directory_no_exist'] = "디렉토리가 존재하지 않습니다.";

$bhlang['title:deleting_'] = "삭제중 ";
$bhlang['explain:delete'] = "삭제하시겠습니까?";

$bhlang['button:delete_file'] = "파일 삭제";
$bhlang['button:cancel'] = "취소";
$bhlang['notice:file_deleted'] = "파일 삭제됨.";

// $bhlang['error:access_denied'] = "You're not allowed to do that.";
$bhlang['error:access_denied'] = "허용되지 않는 기능입니다.";
$bhlang['title:upload'] = "업로드 파일";

// $bhlang['explain:upload'] = "Please select the files you wish to upload, and then click on the Upload button to begin the uploading process. <br><br>Please note that while the files are uploading nothing will happen on this screen; however, your browser's progress bar should show you the status of the upload.";
$bhlang['explain:upload'] = "업로드할 파일은 선택하고 업로드 버튼을 누르면 업로드가 진행됩니다.";

$bhlang['module:upload'] = "업로드 파일";
$bhlang['moduledesc:upload'] = "전송중";

$bhlang['button:upload'] = "업로드";
$bhlang['label:uploading_to'] = "업로드 위치: ";
$bhlang['button:change_folder'] = "변경";
$bhlang['title:choose_folder'] = "폴더 선택";

$bhlang['error:no_write_permission'] = "You are not allowed to write to that file.";

$bhlang['module:url'] = "File URL";
$bhlang['moduledesc:url'] = "Shows the file's URL";

$bhlang['explain:the_url_to_that_file_is_'] = "The URL for that file is: ";
$bhlang['notice:file_#FILE#_upload_success'] = "File #FILE# uploaded successfully.";

$bhlang['notice:logged_out'] = "로그아웃 되었습니다.";

$bhlang['log:#USER#_logged_out'] = "#USER# 로그아웃 되었습니다.";
$bhlang['notice:logged_in_as_#USER#'] = "#USER# 로그인 되었습니다.";
$bhlang['notice:login_failed'] = "아이디/비밀번호가 맞지 않습니다.";
$bhlang['log:failed_login_#USER#'] = "Failed login for #USER#";
$bhlang['log:successful_login_#USER#'] = "Successful login for #USER#";
$bhlang['log:#USER#_uploaded_#FILE#'] = "File upload to #FILE# by #USER#";

$bhlang['title:add_folder'] = "폴더 생성";
$bhlang['module:addfolder'] = "폴더 생성";
$bhlang['moduledesc:addfolder'] = "Lets you create a folder";
//$bhlang['explain:add_folder'] = "You are creating a new folder. Select the existing folder which you would like to create it in, and then choose the name of your new folder.";
$bhlang['explain:add_folder'] = "새폴더를 생성합니다. 폴더를 생성할 위치를 선택하고 새폴더 이름을 입력하세요.";

$bhlang['button:add_folder'] = "폴더 생성";
$bhlang['label:folder_name'] = "폴더 이름: ";
$bhlang['label:create_in'] = "생성위치: ";
$bhlang['log:#USER#_denied_#PAGE#'] = "Access denied to #PAGE# for #USER#";

$bhlang['log:#USER#_created_#FOLDER#'] = "Folder #FOLDER# created by #USER#";
$bhlang['notice:folder_created'] = "폴더 생성됨.";

$bhlang['notice:file_#FILE#_upload_failure'] = "Upload of file #FILE# failed.";
$bhlang['log:#USER#_failed_upload_#FILE#'] = "Upload failed of #FILE# for #USER#";

$bhlang['explain:edit'] = "파일을 편집하고 저장하세요. 텍스트 파일만 정상적으로 편집할 수 있습니다.";
$bhlang['title:editing_#FILE#'] = "Editing #FILE#";
$bhlang['button:save'] = "Save";

$bhlang['module:edit'] = "편집";
$bhlang['moduledesc:edit'] = "파일 편집 (텍스트모드)";

$bhlang['notice:file_saved'] = "파일 저장됨.";
$bhlang['log:#USER#_modified_#FILE#'] = "File #FILE# modified by #USER#";

$bhlang['module:htmledit'] = "HTML Editor";
$bhlang['moduledesc:htmledit'] = "Edit the file (in HTML mode)";

$bhlang['explain:htmledit'] = "Make your changes to the page below and then press save to store them.";

$bhlang['label:copy_to'] = "여기로 복사: ";
$bhlang['label:move_to'] = "여기로 이동: ";
$bhlang['explain:copy'] = "복사할 위치를 선택하고 파일명을 입력하세요.";
$bhlang['explain:move'] = "이동할 위치를 선택하고 파일명을 입력하세요.";
$bhlang['label:new_name'] = "파일명: ";
$bhlang['button:move'] = "이동";
$bhlang['button:copy'] = "복사";
$bhlang['title:copying_#FILE#'] = "Copying #FILE#";
$bhlang['title:moving_#FILE#'] = "Moving #FILE#";
$bhlang['log:#USER#_moved_#FILE#_to_#DEST#'] = "File #FILE# Moved to #DEST# by #USER#";
$bhlang['log:#USER#_copied_#FILE#_to_#DEST#'] = "File #FILE# copied to #DEST# by #USER#";
$bhlang['notice:file_moved'] = "파일 이동됨.";
$bhlang['notice:file_copied'] = "파일 복사됨.";
$bhlang['module:copy'] = "복사";
$bhlang['module:move'] = "이동";
$bhlang['moduledesc:copy'] = "다른폴더로 파일 복사";
$bhlang['moduledesc:move'] = "다른폴더로 파일 이동";

$bhlang['title:uploading'] = "Uploading";
$bhlang['explain:uploading'] = "The upload is in progress. It may take a while.<br>This window will close when the upload completes.";

$bhlang['notice:you_must_be_admin'] = "You must be an administrator to access this area.";
$bhlang['title:__administration'] = " [Administration]";

$bhlang['title:welcome_to_administration'] = "Welcome to ByteHoard Administration";
$bhlang['explain:welcome_to_administration'] = "Welcome to the ByteHoard administration area. Select a section to use from the links above or below.";

$bhlang['module:users'] = "Users";
$bhlang['moduledesc:users'] = "Administrate Users and Groups";

$bhlang['title:user_administration'] = "User Administration";
$bhlang['explain:user_administration'] = "Select a group or All below to view the users in that group / all users. To edit a user, click on their username.";

$bhlang['label:disk_space_used'] = "Disk space used";
$bhlang['label:upload_bandwidth_used'] = "Upload bandwidth used";
$bhlang['label:download_bandwidth_used'] = "Download bandwidth used";

$bhlang['title:views'] = "views";

$bhlang['module:sharing'] = "Sharing";
$bhlang['moduledesc:sharing'] = "Share this with other users";

$bhlang['title:sharing_'] = "Sharing of ";
$bhlang['explain:sharing'] = "Here you can configure who else can see this file, as well as what they can do.";
$bhlang['label:users'] = "Users";
$bhlang['label:groups'] = "Groups";
$bhlang['label:public'] = "Everyone";
$bhlang['explain:no_users_sharing_to'] = "You are not sharing with any users.";
$bhlang['explain:no_groups_sharing_to'] = "You are not sharing with any groups.";

$bhlang['label:sharing_hidden'] = "Hidden";
$bhlang['explain:sharing_hidden'] = "This file is hidden.";

$bhlang['label:sharing_viewable'] = "Viewable";
$bhlang['explain:sharing_viewable'] = "This file can be viewed and copied but not changed.";

$bhlang['label:sharing_writable'] = "Writeable";
$bhlang['explain:sharing_writable'] = "This file can be viewed, moved, changed or deleted.";

$bhlang['label:sharingfolder_hidden'] = "Hidden";
$bhlang['explain:sharingfolder_hidden'] = "This folder is hidden.";

$bhlang['label:sharingfolder_viewable'] = "Viewable";
$bhlang['explain:sharingfolder_viewable'] = "This folder can be viewed and copied but not changed.";

$bhlang['label:sharingfolder_writable'] = "Writeable";
$bhlang['explain:sharingfolder_writable'] = "This folder can be viewed, moved, changed or deleted.";

$bhlang['label:change_to'] = "Change to: ";

$bhlang['notice:permissions_changed'] = "Permissions Changed";

$bhlang['label:add_user'] = "Add User:";
$bhlang['label:add_group'] = "Add Group:";
$bhlang['button:add'] = "Add";

$bhlang['button:edit'] = "편집";
$bhlang['button:delete'] = "삭제";

$bhlang['column:user_type'] = "Type";
$bhlang['column:used_space'] = "Used Space";
$bhlang['column:bandwidth_30_days'] = "Bandwidth (Last 30 Days)";
$bhlang['column:actions'] = "Actions";
$bhlang['column:username'] = "Username";

$bhlang['explain:delete_user'] = "Are you sure you want to irreversibly delete this user (and their files)?";
$bhlang['button:delete_user'] = "Delete User";
$bhlang['button:delete_user_and_files'] = "Delete User and ther files";

$bhlang['notice:user_deleted'] = "User deleted.";
$bhlang['notice:user_and_files_deleted'] = "User and their files deleted.";

$bhlang['title:settings'] = "Settings";
$bhlang['explain:settings'] = "Here you can change the base settings of ByteHoard. Select/edit the options you want and then click 'Save Settings' to use them.";

$bhlang['label:settings_usetrash'] = "Use Trash?";
$bhlang['explain:settings_usetrash'] = "If Yes, files are not permantely deleted but moved to a Trash folder.";

$bhlang['label:yes'] = "Yes";
$bhlang['label:no'] = "No";

$bhlang['button:save_settings'] = "Save Settings";

$bhlang['module:settings'] = "Settings";
$bhlang['moduledesc:settings'] = "Change base settings";

$bhlang['label:settings_sitename'] = "Site Name";
$bhlang['explain:settings_sitename'] = "The name of the site (displayed on website and in emails)";

$bhlang['label:settings_limitthumbs'] = "Only thumbnail small files?";
$bhlang['explain:settings_limitthumbs'] = "If set to No, large images may cause the system to slow or stop while being thumbnailed.";

$bhlang['notice:settings_saved'] = "Settings Saved.";

$bhlang['title:delete_user'] = "Delete User";
$bhlang['title:edit_user'] = "Edit User";

$bhlang['title:settings'] = "Settings";

$bhlang['explain:edit_user'] = "Make your changes to this user, then click 'Save User' to store those changes. <br>If you don't want to change the password, just leave the boxes blank.";

$bhlang['subtitle:details'] = "Details";

$bhlang['title:editing_user_'] = "Editing User: ";
$bhlang['label:email'] = "Email 주소:";
$bhlang['label:full_name'] = "이름:";
$bhlang['label:user_type'] = "User Type:";

$bhlang['value:guest'] = "Guest";
$bhlang['value:normal'] = "Normal";
$bhlang['value:admin'] = "Administrator";

$bhlang['subtitle:password'] = "패스워드";
$bhlang['label:new_password'] = "새 패스워드:";
$bhlang['label:repeat_new_password'] = "새 패스워드 확인:";

$bhlang['button:save_user'] = "Save User";

$bhlang['error:passwords_dont_match'] = "패스워드가 동일하지 않습니다.";
$bhlang['notice:user_updated'] = "User Updated!";

$bhlang['title:signup'] = "회원가입";
$bhlang['explain:signup'] = "입력 후 '회원가입' 버튼을 누르세요.";

$bhlang['label:repeat_password'] = "패스워드 확인:";
$bhlang['button:signup'] = "회원가입";

$bhlang['module:signup'] = "회원 가입";
$bhlang['moduledesc:signup'] = "Register an account";

$bhlang['error:username_in_use'] = "존재하는 아이디 입니다.";
$bhlang['notice:signup_successful_can_login'] = "회원가입이 완료되었습니다.";
$bhlang['log:user_signed_up_'] = "User successfully signed up with username ";
$bhlang['error:password_empty'] = "패스워드를 입력하세요.";

$bhlang['notice:file_description_saved'] = "파일 설명 저장됨.";
$bhlang['title:editing_description_#FILE#'] = "#FILE# 파일 설명 편집";
$bhlang['explain:editdesc'] = "파일에 대한 설명을 아래에 적고 저장하세요..";

$bhlang['button:savedesc'] = "저장";
$bhlang['module:editdesc'] = "편집";
$bhlang['moduledesc:editdesc'] = "파일 설명 변경";

$bhlang['title:appearance']  = "Appearance";
$bhlang['explain:appearance'] = "";

$bhlang['label:author'] = "Author: ";

$bhlang['module:appearance'] = "Appearance";
$bhlang['moduledesc:appearance'] = "Edit the system's appearance";

$bhlang['explain:current_skin'] = "Current Skin";

$bhlang['button:use_this_skin'] = "Use This Skin";
$bhlang['notice:skin_changed'] = "Skin Changed.";

$bhlang['label:settings_signupmoderation'] = "Moderate user registrations?";
$bhlang['explain:settings_signupmoderation'] = "If set to yes an administrator must approve all new users.";

$bhlang['error:validation_link_wrong'] = "Sorry, the validation link you have clicked is not valid. It may have expired; in this case, try signing up again.";
$bhlang['log:user_validated_'] = "User successfully validated username ";
$bhlang['log:user_signup_m_pending_'] = "Moderation now pending for username ";

$bhlang['notice:moderation_now_pending'] = "Your registration request has been successfully validated and has been submitted to the administrator(s) for approval. You will be notified when your request is accepted or rejected.";
$bhlang['notice:do_email_validation'] = "An email has been sent to the address you provided with details of how you can verify your email address in order to continue with the signup.";

$bhlang['emailsubject:registration_validation'] = "#SITENAME# registration validation";


# Note to translators: Just the stuff inside the double quotes, it's allowed to go over multiple lines.
# Another note: Lines beginning with a hash (#) are ignored. So this line is ignored. And the one above.
$bhlang['email:registration_validation'] = "Your request for an account is currentely awaiting verification.

In order to verify your account, visit the following address into your browser:

#LINK#

If you do not validate this account within seven days your registration will be deleted.";




$bhlang['error:email_error'] = "We are currentely experiencing problems with the email system; your request cannot be completed at this time. Please try again later.";

$bhlang['notice:validation_already_done_pending_approval'] = "You have already validated your account! It is currently awaiting approval.";

$bhlang['title:registrations_administration'] = "Registrations Administration";
$bhlang['module:registrations'] = "Registrations";
$bhlang['moduledesc:registrations'] = "Approve or deny new user registrations";
$bhlang['explain:registration_administration'] = "This is a list of all verified, pending registrations. The details of each prospective user are shown, along with options to accept or reject their application. <br>Be careful, as there is no confirmation for either action.";

$bhlang['notice:registration_moderation_off'] = "Registration moderation is off; all users are currentely being automatically approved after they are verified. To turn it on, go to Settings and change 'Moderate user registrations?' to 'Yes'.";

$bhlang['button:reject'] = "Reject";
$bhlang['button:accept'] = "Accept";

$bhlang['notice:#USER#_accepted'] = "#USER# accepted.";
$bhlang['notice:#USER#_rejected'] = "#USER# rejected.";

$bhlang['emailsubject:registration_accepted'] = "Registration Accepted for #SITENAME#";
$bhlang['email:registration_accepted'] = "Your registration has been accepted by an administrator.

You may log in with the following details:
Username: #USERNAME#
Password: As you entered on the registration form.

We cannot retrieve your password for you, as it is now encrypted in our database, but it is possible to reset it; see the site for more details.

We hope you enjoy the service.";

$bhlang['emailsubject:registration_rejected'] = "Registration Rejected for #SITENAME#";
$bhlang['email:registration_rejected'] = "Your registration has not been approved; your user account will not be created.

You are free to reapply; however, if your application was not accepted the first time it is unlikely it will accepted the second time.";


$bhlang['error:registration_doesnt_exist'] = "That registration no longer exists. It may have been accepted or rejected by someone else.";

$bhlang['error:username_too_long'] = "That username is too long. It must be less than 255 characters in length.";

$bhlang['button:go'] = "확인";
$bhlang['button:request_reset'] = "Request Reset";

$bhlang['title:recover_password'] = "패스워드 찾기";
$bhlang['explain:recover_password'] = "이름 또는 이메일 주소를 입력 후 '확인' 버튼을 누르세요.";

$bhlang['text:or'] = "또는";

$bhlang['module:passreset'] = "패스워드 찾기";
$bhlang['moduledesc:passreset'] = "Recover your username or reset your password";

$bhlang['emailsubject:passreset_request'] = "Password Reset Request at #SITENAME#";
$bhlang['email:passreset_request'] = "You, or someone pretending to be you, has requested a password reset at the site. To reset your password, visit this address in your browser:

#LINK#

If you did not ask for this reset, ignore this email. The request will be deleted in 48 hours.";

$bhlang['error:username_doesnt_exist'] = "아이디가 존재하지 않습니다.";
$bhlang['error:email_doesnt_exist'] = "이메일 주소가 존재하지 않습니다.";

$bhlang['emailsubject:passreset_u_request'] = "Username and Password Request at #SITENAME#";
$bhlang['email:passreset_u_request'] = "You, or someone pretending to be you, has requested a reminder of your details at the site.

Your username is: #USERNAME#

To reset your password, visit this address in your browser:

#LINK#

If you did not ask for this reset, ignore this email. The request will be deleted in 48 hours.";

$bhlang['notice:passreset_request_sent'] = "The email containing further instructions has been sent to your email address.";

$bhlang['error:passreset_link_invalid'] = "That link is invalid - it has either expired or you copied it wrong.";

$bhlang['emailsubject:passreset_new_password'] = "Your new password for #SITENAME#";
$bhlang['email:passreset_new_password'] = "Your new password for the site is:

#PASSWORD#

This password has been randomly generated, and can be changed when you log in.";

$bhlang['notice:passreset_new_password_sent'] = "Your new password has been sent to your email address.";

$bhlang['error:username_invalid'] = "That username is invalid.";

$bhlang['error:systemwrong'] = "Fatal error: Your system setup prevents this function from working.";

$bhlang['title:options'] = "옵션";
$bhlang['module:options'] = "옵션";
$bhlang['moduledesc:options'] = "옵션 변경";
// $bhlang['explain:options'] = "Here you can change several options for how the system looks and works, as well as changing your password and contact details.";
$bhlang['explain:options'] = "계정 패스워드 및 프로파일을 변경할 수 있습니다.";

$bhlang['title:change_password'] = "패스워드 변경";
$bhlang['title:interface_options'] = "Interface Options";
$bhlang['title:profile'] = "프로필";

$bhlang['label:old_password'] = "기존 패스워드: ";
$bhlang['button:change_password'] = "패스워드 변경";
$bhlang['error:old_password_invalid'] = "기존 패스워드가 맞지 않습니다. 다시 시도해주세요.";
$bhlang['notice:password_changed'] = "패스워드가 변경되었습니다.";

$bhlang['error:unknown'] = "An unknown error has occured. This may be a good opportunity to report it.";
$bhlang['warning:blank_password'] = "You're using a blank password! That's a bad idea.";

# These are all options! We're not going to collect all this inforation about every user.
# The administrator will be able to choose which ones to allow.
$bhlang['profile:email'] = "이메일 주소";
$bhlang['profile:fullname'] = "이름";
$bhlang['profile:website'] = "Website";
$bhlang['profile:telephone'] = "Telephone Number";
$bhlang['profile:fax'] = "Fax Number";
$bhlang['profile:jabber'] = "Jabber ID";
$bhlang['profile:icq'] = "ICQ#";
$bhlang['profile:msn'] = "MSN ID";
$bhlang['profile:aim'] = "AIM ID";
$bhlang['profile:yahoo'] = "Yahoo! ID";
$bhlang['profile:nickname'] = "Nickname";
$bhlang['profile:position'] = "Position";
$bhlang['profile:location'] = "Location";
$bhlang['profile:gender'] = "Gender";
$bhlang['profile:address'] = "Address";
$bhlang['profile:postcode'] = "Postcode";
$bhlang['profile:zipcode'] = "Zipcode";
$bhlang['profile:nationality'] = "Nationality";
$bhlang['profile:latitude'] = "Latitude";
$bhlang['profile:longitude'] = "Longitude";
$bhlang['profile:occupation'] = "Occupation";
$bhlang['profile:status'] = "Status";

$bhlang['button:save_profile'] = "프로파일 저장";
$bhlang['notice:profile_saved'] = "프로파일 저장됨.";

$bhlang['error:cannot_determine_update_server'] = "The update server cannot be located. It is likely that the ByteHoard site is down; please try again later.";
$bhlang['error:cannot_download_package'] = "The package file cannot be downloaded from the remote server.";
$bhlang['error:system_setup_wrong'] = "Your system is unable to download the files required. You must do this manually.";
$bhlang['error:cannot_write_to_package'] = "Cannot write to the package file. Check the ByteHoard directory's permissions are correctly set.";

$bhlang['title:folder_files'] = "파일";
$bhlang['title:folder_actions'] = "폴더";
$bhlang['module:deletefolder'] = "삭제";
$bhlang['moduledesc:deletefolder'] = "폴더 삭제";
$bhlang['module:copyfolder'] = "복사";
$bhlang['moduledesc:copyfolder'] = "다른 장소로 복사";
$bhlang['module:movefolder'] = "이동";
$bhlang['moduledesc:movefolder'] = "다른 장소로 이동";
$bhlang['module:sharingfolder'] = "Sharing";
$bhlang['moduledesc:sharingfolder'] = "Share this folder with other users";
$bhlang['notice:folder_deleted'] = "Folder Deleted";

$bhlang['error:cannot_delete_that'] = "You cannot delete that folder or file.";

$bhlang['button:delete_folder'] = "Delete Folder";
$bhlang['explain:deletefolder'] = "Do you really want to delete this folder and all its contents?";

$bhlang['label:settings_fromemail'] = "System From: Address: ";
$bhlang['explain:settings_fromemail'] = "The address from which all system emails appear to come.";
$bhlang['label:settings_imageprog'] = "Image program to use: ";
$bhlang['explain:settings_imageprog'] = "Must be one of 'imagemagick' or 'gd'.";
$bhlang['label:settings_syspath_convert'] = "Path of 'convert': ";

# Translators; Leave $"."PATH as it is.
$bhlang['explain:settings_syspath_convert'] = "Only required if you select 'imagemagick' as the image program.<br>You can use 'convert' if the program is in your system $"."PATH.";

$bhlang['label:settings_fileroot'] = "Virtual File System Directory: ";
$bhlang['explain:settings_fileroot'] = "The directory under which the ByteHoard files are stored.<br><b>DO NOT CHANGE</b> unless you know what you're doing.<br>The path MUST NOT end in a trailing slash.";

$bhlang['error:no_gd'] = "GD is not installed, yet GD is selected for thumbnailing. This is fatal.";

$bhlang['explain:sharingfolder'] = "Here you can configure who else can see this folder, as well as what they can do. <br>Note that whatever changes you make to this folder will affect all files inside it.<br>For this reason, we don't recommend sharing your main directory.";

$bhlang['label:sharingfolder_owner'] = "Owner";
$bhlang['explain:sharingfolder_owner'] = "Has maximum control over the folder.";
$bhlang['label:sharing_owner'] = "Owner";
$bhlang['explain:sharing_owner'] = "Has maximum control over the file.";

$bhlang['error:permissions_self'] = "You cannot change your own permissions.";
$bhlang['notice:permissions_changed'] = "Permissions Changed.";
$bhlang['notice:permissions_group_added'] = "Group Added.";
$bhlang['notice:permissions_user_added'] = "User Added.";
$bhlang['notice:permissions_group_deleted'] = "Group Deleted.";
$bhlang['notice:permissions_user_deleted'] = "User Deleted.";

$bhlang['label:delete_user'] = "Delete User: ";
$bhlang['label:delete_group'] = "Delete Group: ";

$bhlang['button:return'] = "Return";

$bhlang['module:returntofolder'] = "이전폴더";
$bhlang['moduledesc:returntofolder'] = "폴더로 이동";

$bhlang['notice:folder_copied'] = "Folder Copied.";

$bhlang['module:filelink'] = "FileMail";
$bhlang['moduledesc:filelink'] = "Email or create a temporary link to this file";
$bhlang['error:no_filepath'] = "Fatal Error: No filepath provided.";

$bhlang['title:filemail'] = "FileMail";
$bhlang['explain:filemail'] = "FileMail allows you to email a temporary link to this file which will expire after a certain time period. <br><br>Fill out the fields below with the recipient of the email, its subject and optionally a message. The link will be automatically added onto the bottom of the email. For multiple recipients you should separate email addresses with commas.";

$bhlang['label:subject'] = "Subject: ";
$bhlang['label:message'] = "Message: ";

$bhlang['error:no_emailaddr'] = "You have not provided an email address.";
$bhlang['error:no_emailsubj'] = "You have not provided a subject for the email.";
$bhlang['error:invalid_email_#EMAIL#'] = "The email address '#EMAIL#' is invalid.";

$bhlang['notice:email_sent'] = "Email successfully sent.";
$bhlang['notice:email_sent_to_#EMAIL#'] = "Email successfully sent to #EMAIL#.";

$bhlang['text:days'] = " days";
$bhlang['label:expires_in'] = "Expires in: ";

$bhlang['text:max_#NUM#_days'] = "(maximum #NUM# days)";

$bhlang['error:expires_invalid'] = "That expiry time is invalid. It must be a positive number.";
$bhlang['error:expires_too_much'] = "That expiry time is above the maximum limit.";

$bhlang['label:settings_maxexpires'] = "Maximum FileMail expiry time (days): ";
$bhlang['explain:settings_maxexpires'] = "The maximum number of days FileMail links can be set to be valid for.";

$bhlang['error:no_filecode'] = "You have not provided a link with a file code.";
$bhlang['error:filecode_invalid'] = "The link you provided is either invalid or has expired.";

$bhlang['title:filelinks'] = "File Link Administration";
$bhlang['module:filelinks'] = "FileMail";
$bhlang['moduledesc:filelinks'] = "FileMail Link Administration";
$bhlang['explain:filelinks'] = "This page provides an overview of the active FileMail links. <br>They are ordered by username, and under each username is a list of their links, along with the connected email address and file, and the time until the link expires. <br>You may view the link by clicking the 'Link' link next to the entry, and you can deactivate a link by clicking the 'Delete' link.";

$bhlang['column:expires_in'] = "Expires In";
$bhlang['column:email'] = "Email Address";
$bhlang['column:file'] = "File";

$bhlang['button:link'] = "Link";

$bhlang['notice:filelink_deleted'] = "FileMail link deleted.";

$bhlang['log:filelink_denied'] = "Denied access to #FILELINK#";
$bhlang['log:filelink_accessed'] = "#FILEPATH# accessed by FileLink [#FILELINK#].";

$bhlang['label:settings_authmodule'] = "Authentication Module: ";
$bhlang['explain:settings_authmodule'] = "The module used to authenticate users. Leave as the default 'bytehoard.inc.php' if you don't need to authenticate against something other than ByteHoard.";

$bhlang['button:send'] = "Send";
$bhlang['button:back'] = "Back";


$bhlang['label:settings_baseuri'] = "ByteHoard Web URL (optional): ";
$bhlang['explain:settings_baseuri'] = "The URL of the main bytehoard directory (must include trailing slash). This is optional; leave it blank to use an auto-detected value.";

$bhlang['title:overwriting_'] = "Overwriting ";
$bhlang['explain:overwrite'] = "The file you have just uploaded has the same name as one that already exists. What would you like to do?";

$bhlang['label:linkonly'] = "Create link only (do not email it): ";

$bhlang['text:link__expire_in_#EXPIRE#'] = "Link (Will expire in #EXPIRE# days): ";

$bhlang['label:html'] = "HTML: ";
$bhlang['label:bbcode'] = "BBcode: ";
$bhlang['title:image_tags'] = "Image Tags";

$bhlang['error:email_empty'] = "이메일 주소를 입력하세요.";

$bhlang['email:filemail_footer'] = "---------------------------------------------
File will be available for download until #DATE#

Attachment: #FILENAME#, #FILESIZE# (MD5: #MD5#)
#LINK#

You have received a file attachment link within this email sent via #SYSTEMNAME#.
To retrieve the attachment, please click on the link.";

$bhlang['label:downloadnotice'] = "Send Download Notification Emails: ";

$bhlang['emailsubject:filemail_link_accessed'] = "FileMail Link Access Notification (#FILENAME#)";

$bhlang['email:filemail_link_accessed'] = "This is an automated notification.

One of your FileMail links has been accessed. You requested notification of any accesses to this file when you created the link.

The file (#FILEPATH#) was accessed at #TIME#, from IP address #IP#. The email you sent this link to was #EMAIL#.

Note: This link expires on #EXPIRES#.";




$bhlang['install:title:bytehoard_installation'] = "ByteHoard Installation";

$bhlang['install:title:page_not_found'] = "Page Not Found";
$bhlang['install:error:page_not_found'] = "That page does not exist!";
$bhlang['install:title:menu'] = "Menu";
$bhlang['install:menu:install'] = "Install ByteHoard";
$bhlang['install:menu:upgrade'] = "Upgrade ByteHoard";
$bhlang['install:menu:documentation'] = "Documentation";
$bhlang['install:menu:systeminfo'] = "System Information";

$bhlang['install:text:install_intro'] = "Welcome to ByteHoard ".$bhconfig['version'].".<br><br>The next few pages will take you through the installation process. The setup is relatively easy; the system will try to guide you through it as much as possible. You will need to have the details of your database login handy, as well as ensuring your system meets the minumum requirements for installing ByteHoard.<br><br>By proceeding with the installation, you agree to the license of this software - the GNU GPL v2 (a copy of which you can find included with the archive under the file LICENSE, or at <a href='http://www.gnu.org/copyleft/gpl.html'>http://www.gnu.org/copyleft/gpl.html</a>.<br><br>For support, updates, extras and news on development check out our website at <a href='http://bytehoard.org'>bytehoard.org</a>";

$bhlang['install:title:introduction'] = "Introduction";
$bhlang['install:title:systemchecks'] = "System Checks";
$bhlang['install:text:checking_system'] = "Checking system...";
$bhlang['install:label:php'] = "PHP";
$bhlang['install:label:extensions'] = "Extensions";
$bhlang['install:label:external_progs'] = "External Programs";
$bhlang['install:label:filesystem'] = "Filesystem";
$bhlang['install:check:php'] = "PHP version: ";
$bhlang['install:check:safe_mode'] = "Safe_mode is off: ";
$bhlang['install:check:pcre'] = "PCRE: ";
$bhlang['install:check:gd'] = "GD: ";
$bhlang['install:check:imagemagick'] = "ImageMagick: ";

$bhlang['install:check:php5'] = "PHP5 (not fully tested)";
$bhlang['install:check:failed'] = "Failed";
$bhlang['install:check:failedoption'] = "Failed (optional)";
$bhlang['install:check:ok'] = "OK";

$bhlang['install:check:failedphp'] = "Failed (PHP 4.2 or newer required)";
$bhlang['install:check:failedsafemode'] = "Failed (safe_mode is ON)";
$bhlang['install:check:failedperm'] = "Failed (file not writable, check permissions)";

$bhlang['install:check:config.inc.php'] = "config.inc.php is writable: ";
$bhlang['install:check:cache'] = "cache/ is writable: ";

$bhlang['install:text:checksok'] = "All checks seem to have passed. Good.";
$bhlang['install:text:checkswarnings'] = "You seem to have a few warnings, but nothing serious. You may continue, or you can try to install the missing components. If you need help with this, please feel free to drop by the ByteHoard website (bytehoard.org) and ask us questions.";
$bhlang['install:text:checksfatals'] = "One or more essential tests failed. Please sort these out before you continue. If you need help with any of there problems, then please drop by bytehoard.org and we'll be happy to help you.";
$bhlang['install:text:thumbnails_disabled'] = "Note: Thumbnails will be disabled. Please install GD or ImageMagick to use thumbnails.";
$bhlang['button:next'] = "Next";

$bhlang['install:title:choose_database'] = "Choose Database";
$bhlang['install:title:configure_database'] = "Configure Database";

$bhlang['install:title:system_information'] = "System Information";

$bhlang['install:configdb:intro'] = "You must now provide your database connection details. If you are unsure about what they are, talk to your system administrator, or if that fails, or you don't have one, try asking us for help.";
$bhlang['install:configdb:nont_needed'] = "This database module has no configuration. You may proceed to the next step.";
$bhlang['install:title:save_database_configuration'] = "Saving Database Configuration...";
$bhlang['install:writeconfig:saved'] = "Database configuration successfully saved.";
$bhlang['install:writeconfig:not_saved'] = "There was an error while saving the database configuration. Please check the permissions on the ByteHoard directory.";
$bhlang['install:title:init_database'] = "Initialising Database";

$bhlang['install:title:test_database_configuration'] = "Testing Database Configuration...";
$bhlang['install:testdb:ok'] = "Configuration seems to be valid.";
$bhlang['install:testdb:failed'] = "Cannot connect to the database! Error is below.";
$bhlang['error:error_creating_table'] = "Error creating table: ";
$bhlang['install:initdb:database_initialised'] = "Database Initialised.";

$bhlang['install:title:set_paths'] = "Set Paths";

$bhlang['install:paths:intro'] = "You now need to set the paths for ByteHoard. You will need to set both the URL of the system and the directory where users' files will be stored.<br><br>The installer will have tried to guess your URL; nevertheless, check it, as sometimes extra parts appear or slashes are missing. The given URL should have a http:// or https:// prefix, and a trailing slash (/) at the end.<br><br>The 'filestorage' directory defaults to the subdirectory in the ByteHoard directory called 'filestorage'; this is not totally secure, and if you can you should create a directory outside of the web directories, give it the appropriate permissions, and provide that as a path instead. <br>Please note that a relative path will be interpreted from the ByteHoard directory.";

$bhlang['install:paths:system_url'] = "System URL: ";
$bhlang['install:paths:file_storage_directory'] = "File storage directory: ";

$bhlang['value:enabled'] = "No";
$bhlang['value:disabled'] = "Yes (User cannnot log in)";

$bhlang['label:disabled'] = "User disabled?: ";

$bhlang['install:title:save_paths'] = "Saving Paths...";

$bhlang['install:savepaths:message'] = "Paths saved.";

$bhlang['install:savepaths:error_baseuri'] = "That is an invalid system URL. Please ensure that the URL includes http:// or https:// and that it ends in a trailing slash.";
$bhlang['install:savepaths:error_fileroot'] = "That is an invalid directory path.";

$bhlang['install:title:create_administrator'] = "Create Administrator";

$bhlang['notice:login_failed_disabled'] = "Login Failed: Your account has been disabled.";

$bhlang['log:failed_login_disabled_#USER#'] = "#USER# was denied login (disabled)";

$bhlang['title:add_user'] = "Add User";
$bhlang['explain:add_user'] = "Use this form to add a new user. You must enter a username, password and email; the other fields are optional.";
$bhlang['button:add_user'] = "Add User";
$bhlang['notice:user_added'] = "User successfully added.";
$bhlang['label:homedir'] = "Home Directory: ";
$bhlang['value:normal_homedir'] = "Subdirectory under / (default)";
$bhlang['value:root_homedir'] = "/ (no home directory)";
$bhlang['label:groups'] = "Initial Groups (separate with commas): ";
$bhlang['module:adduser'] = "Add User";
$bhlang['moduledesc:adduser'] = "Add a new user to the system.";

$bhlang['install:createadmin:explain'] = "An administrator user has been created. Please keep these details safe; you can change the password or add a new administrator user once you have logged in.";


$bhlang['install:finish:explain'] = "Installation is now complete. You may log in using the administrator username and password shown above.<br><br><b>Please note: You MUST completely delete the install/ directory before you start using ByteHoard. Anyone who has access to this directory can reset the system with a new administration username and password, which they will know, as well as possibly being able to access the database of both ByteHoard and other software on this machine. Leaving it is a massive security risk. Should you wish to re-install or upgrade, you can simply extract just the install/ directory from the archive.</b><br><br>We recommend that you log in to the administration area first and change the settings to suit your system. The URLs of the main area and the administration area are shown below.";
$bhlang['install:finish:label:url'] = "System URL: ";
$bhlang['install:finish:label:adminurl'] = "Administration URL: ";

$bhlang['error:signup_disabled'] = "Signup has been disabled.";
$bhlang['label:settings_signupdisabled'] = "Disable Signup?: ";
$bhlang['explain:settings_signupdisabled'] = "If this is checked the 'Signup' option will be rendered inaccessible.";

$bhlang['install:title:complete'] = "Complete";

$bhlang['install:title:bytehoard_upgrade'] = "ByteHoard Upgrade";

$bhlang['install:update:intro'] = "Welcome to the ByteHoard Updater. This program will upgrade your old ByteHoard installation to this version.<br><br>Note that to upgrade you should have moved or deleted the contents of the old ByteHoard directory apart from the <i>config.inc.php</i> file and the <i>filestorage/</i> or <i>userfiles/</i> directory, and then you should have extracted the new ByteHoard files into that same directory (you may have to move them from the folder the extraction generates, probably called something like <i>bytehoard-".str_replace(" ","-",strtolower($bhconfig['version']))."/</i>.<br><br>Please make a backup of your old ByteHoard files and database before performing this operation; you should do this before installing any new software, but in this case the upgrade operations may not work successfully, due to the large variety of systems they are designed to upgrade.";

$bhlang['install:title:choose_old_version'] = "Choose Old Version";

$bhlang['install:upgrade:choose_text'] = "Please select the version you are upgrading from. Note that selecting the wrong version will have... interesting results.";

$bhlang['button:upgrade'] = "Upgrade";

$bhlang['install:title:upgrading'] = "Upgrading...";

$bhlang['install:error:no_upgradefrom'] = "You have not selected a version to upgrade from!";
$bhlang['install:error:invalid_upgradefrom'] = "You have somehow managed to provide a wrong version to upgrade from. Try again.";

$bhlang['install:upgrade:complete'] = "Upgrade complete. You can now use the system; see below for upgrade-specific notes.";

$bhlang['install:upgrade:notes'] = "Notes:";

$bhlang['install:upgrade:specific:2.0.x_to_2.1.g'] = "ByteHoard 2.1 is quite a big step up from 2.0. There are many new features and some have disappeared since 2.0. Things you should note include: <ul><li>The administration area is now accessed by going to the ByteHoard URL followed by /administrator/ (Note that an 'administration centre' link should appear anyway).</li>
<li>All your users have been transferred over, and your old administrators remain as administrators. However, any pending registrations have been removed.</li>
<li>All your old FileMail links will continue to work until they expire.</li>
<li>All your old groups and their users have been carried over.</li>
<li>All FileMails now come from the users' email addresses by default.</li>
<li>If email functions were turned off they have been turned back on.</li>
<li>User space quotas have been removed, since this is not yet implemented.</li></ul><br><br>We hope you enjoy ByteHoard 2.1.";

$bhlang['label:remind_in'] = "Remind: ";
$bhlang['text:days_before_expiry'] = "days before expiry (0 = No reminder)";

$bhlang['title:group_administration'] = "Group Administration";

$bhlang['explain:group_administration'] = "Here you can manage groups of users. <br><br>All current groups are listed below, with the users they contain. <br>To remove a user from a group, click 'Remove' next to their username. <br>To add a user to a group, enter their name and the group name in the form at the top and press 'Add'. <br><br>Please note that groups are simply collections of users; to create a new group, simply add a user to it (i.e. to create the new group 'friends' simply add a user to 'friends').<br> Also note that the group name 'All' is reserved for internal use, and that all group names will be converted to lowercase.";

$bhlang['button:remove'] = "Remove";
$bhlang['label:group'] = "Group: ";
$bhlang['button:add_to_group'] = "Add To Group";

$bhlang['module:admin'] = "Administration";
$bhlang['moduledesc:admin'] = "Takes you to the administration area.";

$bhlang['module:return'] = "Return to BH";
$bhlang['moduledesc:return'] = "Return to the main ByteHoard system.";

$bhlang['module:groups'] = "Groups";
$bhlang['moduledesc:groups'] = "Create and manage usergroups.";

$bhlang['text:no_groups'] = "There are currently no groups.";

$bhlang['notice:user_added_to_group'] = "User '#USERNAME#' has been added to group '#GROUP#'.";
$bhlang['notice:user_removed_from_group'] = "User '#USERNAME#' has been removed from group '#GROUP#'.";
$bhlang['error:user_is_in_group'] = "User '#USERNAME#' is already in group '#GROUP#'.";
$bhlang['error:user_does_not_exist'] = "User '#USERNAME# does not exist!";

$bhlang['title:file_download'] = "File Download";
$bhlang['label:filesize'] = "Filesize: ";
$bhlang['label:filename'] = "Filename: ";
$bhlang['label:from'] = "From: ";
$bhlang['label:md5'] = "MD5 Hash: ";
$bhlang['button:download_file'] = "Download #FILENAME#";
$bhlang['error:md5_file_too_large'] = "(file too large; MD5 not calculated)";

$bhlang['explain:filelink_download'] = "The file will start to download in a few seconds. If it does not, click on the link below. If your browser opens the document instead of saving it, you can right-click on the link and select 'Save Link As...' or 'Save Target As...' to save the file to your computer.";

$bhlang['error:quota_exceeded'] = "Doing that would exceed your quota of #QUOTA# MB.";

$bhlang['label:settings_lang'] = "Language File: ";
$bhlang['explain:settings_lang'] = "The language file to be used.";

$bhlang['label:quota'] = "사용량: ";

$bhlang['label:_mb'] = "MB";

$bhlang['explain:edit_quota'] = "(Note: 0 or a blank box means unlimited space)";
$bhlang['error:quota_not_a_number'] = "The quota you entered is not a valid number!";

$bhlang['title:quota'] = "Quota";
$bhlang['explain:you_have_used_some_quota'] = "사용중 : #QUOTAUSED#<br>총용량 : #QUOTA#";

$bhlang['title:types_administration'] = "User Types/Quota Administration";
$bhlang['error:missed_something'] = "You have not given a value for a required field.";
$bhlang['explain:types_administration'] = "Use this screen to create and delete user types (quotas/pricing plans).";
$bhlang['column:type_name'] = "Type Name";
$bhlang['column:type_size'] = "Type Quota";

$bhlang['module:types'] = "User Types";
$bhlang['moduledesc:types'] = "Edit user types";

$bhlang['column:edit_quota'] = "Edit Quota (in MB)";
$bhlang['column:delete'] = "삭제";

$bhlang['notice:type_updated'] = "Type Created/Updated.";
#folderDZ
$bhlang['error:quota_too_large'] = "The Quota entered excedes your quota to provide.";
$bhlang['error:quota_invalid'] = "The Quota provided was invalid";
$bhlang['error:expires_too_much'] = "The expiration length excedes the allowed expiration time";
$bhlang['error:expires_invalid'] = "The expiration length was invalid";
$bhlang['title:folderDZ'] = "Create a Folder DropZone:  ";

$bhlang['label:uploadnotice'] = "Notify after an upload completes.";
$bhlang['title:folderdz'] = "Folder DropZone";
$bhlang['email:folderdz_footer'] = "---------------------------------------------
A folder dropzone has been created for your use until #DATE#

#LINK#

You will be allowed to upload files at the provided link.";

$bhlang['explain:DZupload'] = "Please select the files you wish to upload, and then click on the Upload button to begin the uploading process. <br><br>Please note that while the files are uploading nothing will happen on this screen; however, your browser's progress bar should show you the status of the upload.";
$bhlang['title:hasgrantedyou'] = "#SENDER# has granted you #QUOTA# MB of space to upload to.";

$bhlang['explain:folderdz'] = "This page provides an overview of the active Folder DropZone locations.  <br> They are ordered by username with their DropZone folders listed with the expiration time.<br> You may visit the folder locations by clicking on the link, however this will Log You Out.<br>  You can also delete DropZone locations if you need to.";

$bhlang['moduledesc:folderDZ'] = "Make this a folder DropZone";
$bhlang['email:fileReceivedSubject'] = "#SENDER# Left you a File. #SITENAME#";
$bhlang['email:fileReceivedContent'] = "Good Day #USER# <br>
#SENDER# Left you one or more Files:
#FILES#

Enjoy your new files.
Thanks.
#SITENAME#";



#$bhlang[''] = "";
#$bhlang[''] = "";
#$bhlang[''] = "";
#$bhlang[''] = "";
#$bhlang[''] = "";
#$bhlang[''] = "";
