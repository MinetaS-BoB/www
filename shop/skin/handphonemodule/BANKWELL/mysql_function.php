<?

if ( ! $bFunc[FncDB] ):

$bFunc[FncDB] = true;

// 전달 받을 인수 값: DB 네임, Host, User, Password
function FncOpenDatabase ()
{
	$cfgSQLDataBase  =''; //데이타베이스명
	$cfgSQLDataSource=''; //써버 보통 localhost로 지정
	$cfgSQLUsername  =''; //데이터베이스 로그인 아이디
	$cfgSQLPasswd    =''; //데이터베이스 로그인 페스워드

	$nConnID = @MySQL_connect( $cfgSQLDataSource, $cfgSQLUsername, $cfgSQLPasswd);

	if($nConnID == 0)
	{	TraceLog ("MySQL", "connect", "[ERROR] Connection to SQL-Server failed.\n".mysql_error() );
		exit;
	}

	$bCheck = @mysql_select_db($cfgSQLDataBase, $nConnID);

	if($bCheck == 0)
	{	TraceLog ("MySQL", "select_db", "[ERROR] Connection to database failed.\n".mysql_error() );
		exit;
	}

	return $nConnID;
};

/*
**
**	쿼리 문장을 실행한다.
**
*/
function FncQuery ( $svSQL )
{
	$connectionID = FncOpenDatabase ();
	$result = @mysql_query( $svSQL,$connectionID );

	if ($result)
	{	return $result;
	}
	else
	{	return false;
	}
};

/*
**
**	쿼리 문장을 실행하고, 결과를 리턴한다.
**
*/
function FncResultQuery ( $svSQL )
{
	$connectionID = FncOpenDatabase ();
	$result = @mysql_query( $svSQL,$connectionID );
	$saResult = @mysql_fetch_array($result);

	if ($saResult)
	{	return $saResult;
	}
	else
	{	return false;
	}
};

/*
**
**	쿼리 문장을 실행한다.
**
*/
function FncExecQuery ( $svSQL )
{
	$connectionID = FncOpenDatabase ();
	$result = @mysql_query( $svSQL,$connectionID );

	if ($result)
	{	return true;
	}
	else
	{	return false;
	}
};

endif;

?>
