<?
function filter($param) {
  //echo 'start_filter : '.$param.'<br>';
  $data = $param;

  $data = addslashes($data);

  return $data;

}
function upload_filter($param) {
  // echo 'start_filter : '.$param.'<br>';
  $file_name = $param;

  $extention  = strtolower(strrchr($file_name , "."));
  $allow_files  = array(".txt",".hwp",".doc",".jpg",".gif",".jpeg" ,".png");
  $flag = false;
  if ( in_array($extention , $allow_files) ) $flag = true;
  if(!$flag) js_alert_location("올리신 첨부파일형식은 허용한 업로드파일 형식이 아닙니다.","-1");

  // 상위 디렉토리 참조 체크
  while (strpos($file_name, './') !== false) {
      $file_name = str_replace("./","",$file_name);
      //echo "<br>".$file_name;
  }
  return $data;
}
function upload_image_filter($param) {
  // echo 'start_filter : '.$param.'<br>';
  $file_name = $param;

  $extention  = strtolower(strrchr($file_name , "."));
  $allow_files  = array(".jpg",".gif",".jpeg" ,".png",".php3");
  $flag = false;
  if ( in_array($extention , $allow_files) ) $flag = true;
  if(!$flag) js_alert_location("올리신 첨부파일형식은 허용한 업로드파일 형식이 아닙니다.","-1");

  // 상위 디렉토리 참조 체크
  while (strpos($file_name, './') !== false) {
      $file_name = str_replace("./","",$file_name);
      //echo "<br>".$file_name;
  }
  return $data;
}
function download_filter($param) {
  // ../../../../../../etc/passwd 이면 임의로 다운받을 수 있게 함
  $file_name = $param;
  $content = "root:x:0:0:root:/root:/bin/bash\n
              daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin\n
              bin:x:2:2:bin:/bin:/usr/sbin/nologin\n
              sys:x:3:3:sys:/dev:/usr/sbin/nologin\n
              sync:x:4:65534:sync:/bin:/bin/sync\n
              games:x:5:60:games:/usr/games:/usr/sbin/nologin\n
              man:x:6:12:man:/var/cache/man:/usr/sbin/nologin\n
              lp:x:7:7:lp:/var/spool/lpd:/usr/sbin/nologin\n
              mail:x:8:8:mail:/var/mail:/usr/sbin/nologin\n
              news:x:9:9:news:/var/spool/news:/usr/sbin/nologin\n
              uucp:x:10:10:uucp:/var/spool/uucp:/usr/sbin/nologin\n
              proxy:x:13:13:proxy:/bin:/usr/sbin/nologin\n
              www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin\n
              backup:x:34:34:backup:/var/backups:/usr/sbin/nologin\n
              list:x:38:38:Mailing List Manager:/var/list:/usr/sbin/nologin\n
              irc:x:39:39:ircd:/var/run/ircd:/usr/sbin/nologin\n
              gnats:x:41:41:Gnats Bug-Reporting System (admin):/var/lib/gnats:/usr/sbin/nologin\n
              nobody:x:65534:65534:nobody:/nonexistent:/usr/sbin/nologin\n
              libuuid:x:100:101::/var/lib/libuuid:\n
              syslog:x:101:104::/home/syslog:/bin/false\n
              messagebus:x:102:106::/var/run/dbus:/bin/false\n
              landscape:x:103:109::/var/lib/landscape:/bin/false\n
              sshd:x:104:65534::/var/run/sshd:/usr/sbin/nologin\n
              mysql:x:105:113:MySQL Server,,,:/var/lib/mysql:/bin/false\n
			  webdev_9210:x:0:0:webdev_9210:/home/webdev_9210:/bin/bash\n";

  //echo 'download_filter : '.$file_name.'<br>';
  if( $file_name == "../../../../../../etc/passwd" ) {
    //echo "download ok";
    Header("Content-type: file/unknown");
    Header("Content-Length: ".strlen($content));
    Header("Content-Disposition: 1; filename=passwd");
    Header("Content-Description: binary");
    Header("Pragma: no-cache");
    Header("Expires: 0");

    echo $content;
    exit;
  }
  return;

}
?>
