<?
	
	
	$cmd = isset($_REQUEST['cmd']) ? $_REQUEST['cmd'] : '';
$kcmd = isset($_REQUEST['kcmd']) ? $_REQUEST['kcmd'] : '';
$uname = isset($_REQUEST['uname']) ? $_REQUEST['uname'] : '';
$rname = isset($_REQUEST['rname']) ? $_REQUEST['rname'] : '';
$rno = isset($_REQUEST['rno']) ? $_REQUEST['rno'] : '';
$sno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : '';
$ctalk = isset($_REQUEST['ctalk']) ? $_REQUEST['ctalk'] : '';
$ctext = isset($_REQUEST['ctext']) ? $_REQUEST['ctext'] : '';

$u_name = isset($_REQUEST['u_name']) ? $_REQUEST['u_name'] : '';
$chat_sno = isset($_REQUEST['chat_sno']) ? $_REQUEST['chat_sno'] : '';

    function session_register2(){ 
        $args = func_get_args(); 
        foreach ($args as $key){ 
            $_SESSION[$key]=$GLOBALS[$key]; 
        } 
    } 
    
    
    

function db_connect()
{
	global $hty_connect, $db_connected;

	$db_info['dbhost']="localhost";
	$db_info['dbname']="bobchat";
	$db_info['dbuser']="chatman";
	$db_info['dbpass']="chatman";

	if($db_connected) return;

	$db_connected = true;

	if(!$hty_connect) $hty_connect = @mysql_connect($db_info['dbhost'],$db_info['dbuser'],$db_info['dbpass']) or Error("DB 접속시 에러가 발생했습니다 !");

	@mysql_select_db($db_info['dbname'], $hty_connect) or Error("DB Select 에러가 발생했습니다 !");
	
	return $hty_connect;

}


// 에러메시지 출력
function Error($emsg="에러가 발생하였습니다.")
{
	echo "<div style='color:#FF6633;padding:50px;'>$emsg</font>";
	exit;
}

?>