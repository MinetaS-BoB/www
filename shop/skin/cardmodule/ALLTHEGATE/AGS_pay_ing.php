<?php
/**********************************************************************************************
*
* ���ϸ� : AGS_pay_ing.php
* �ۼ����� : 2005/03
*
* �ô�����Ʈ �÷����ο��� ���ϵ� ����Ÿ�� �޾Ƽ� ���ϰ�����û�� �մϴ�.
*
* Copyright 2004-2005 AEGISHYOSUNG.Co.,Ltd. All rights reserved.
*
**********************************************************************************************/

/** Function Library **/ 
require "aegis_Func.php";


/****************************************************************************
*
* [1] �ô�����Ʈ ������ ����� ���� ��ż��� IP/Port ��ȣ
*
* $IsDebug : 1:����,���� �޼��� Print 0:������
* $LOCALADDR : PG������ ����� ����ϴ� ��ȣȭProcess�� ��ġ�� �ִ� IP
* $LOCALPORT : ��Ʈ
* $ENCRYPT : 0:�Ƚ�Ŭ��,�Ϲݰ��� 2:ISP
* $CONN_TIMEOUT : ��ȣȭ ����� ���� ConnectŸ�Ӿƿ� �ð�(��)
* $READ_TIMEOUT : ������ ���� Ÿ�Ӿƿ� �ð�(��)
* 
****************************************************************************/

$IsDebug = 0;
$LOCALADDR = "220.85.12.3";
$LOCALPORT = "29760";
$ENCTYPE = 0;
$CONN_TIMEOUT = 10;
$READ_TIMEOUT = 30;


/****************************************************************************
*
* [2] AGS_pay.html �� ���� �Ѱܹ��� ����Ÿ
*
****************************************************************************/

$AuthTy = trim($_POST["AuthTy"]);						//��������
$SubTy = trim($_POST["SubTy"]);							//�����������
$StoreId = trim($_POST["StoreId"]);						//�������̵�
$OrdNo = trim($_POST["OrdNo"]);							//�ֹ���ȣ
$ProdNm = trim($_POST["ProdNm"]);						//��ǰ��
$Amt = trim($_POST["Amt"]);								//�ݾ�
$UserId = trim($_POST["UserId"]);						//ȸ�����̵�
$OrdNm = trim($_POST["OrdNm"]);							//�ֹ��ڸ�
$OrdPhone = trim($_POST["OrdPhone"]);					//�ֹ��ڿ���ó
$UserEmail = trim($_POST["UserEmail"]);					//�ֹ����̸���
$OrdAddr = trim($_POST["OrdAddr"]);					    //�ֹ����ּ� ��������߰�
$RcpNm = trim($_POST["RcpNm"]);							//�����ڸ�
$RcpPhone = trim($_POST["RcpPhone"]);					//�����ڿ���ó
$DlvAddr = trim($_POST["DlvAddr"]);						//������ּ�

$Remark = trim($_POST["Remark"]);						//���

$DeviId = trim($_POST["DeviId"]);						//�ܸ�����̵�

$AuthYn = trim($_POST["AuthYn"]);						//��������

$CardNo = trim($_POST["CardNo"]);						//ī���ȣ
	
$ExpMon = trim($_POST["ExpMon"]);						//��ȿ�Ⱓ(��)
	
$ExpYear = trim($_POST["ExpYear"]);						//��ȿ�Ⱓ(��)

$Instmt = trim($_POST["Instmt"]);						//�Һΰ�����

$Passwd = trim($_POST["Passwd"]);						//��й�ȣ

$SocId = trim($_POST["SocId"]);							//�ֹε�Ϲ�ȣ/����ڵ�Ϲ�ȣ

$partial_mm = trim($_POST["partial_mm"]);				//�Ϲ��ҺαⰣ

$noIntMonth = trim($_POST["noIntMonth"]);				//�������ҺαⰣ

$KVP_CURRENCY = trim($_POST["KVP_CURRENCY"]);			//KVP_��ȭ�ڵ�

$KVP_CARDCODE = trim($_POST["KVP_CARDCODE"]);			//KVP_ī����ڵ�

$KVP_SESSIONKEY = $_POST["KVP_SESSIONKEY"];				//KVP_SESSIONKEY

$KVP_ENCDATA = $_POST["KVP_ENCDATA"];					//KVP_ENCDATA
	
$KVP_CONAME = trim($_POST["KVP_CONAME"]);				//KVP_ī���

$KVP_NOINT = trim($_POST["KVP_NOINT"]);					//KVP_������=1 �Ϲ�=0

$KVP_QUOTA = trim($_POST["KVP_QUOTA"]);					//KVP_�Һΰ���

$MPI_CAVV = $_POST["MPI_CAVV"];							//MPI_CAVV

$MPI_ECI = $_POST["MPI_ECI"];							//MPI_ECI

$MPI_MD64 = $_POST["MPI_MD64"];							//MPI_MD64

$ICHE_OUTBANKNAME = trim($_POST["ICHE_OUTBANKNAME"]);		//��ü�����

$ICHE_OUTACCTNO = trim($_POST["ICHE_OUTACCTNO"]);			//��ü���¹�ȣ

$ICHE_OUTBANKMASTER = trim($_POST["ICHE_OUTBANKMASTER"]);	//��ü���¼�����

$ICHE_AMOUNT = trim($_POST["ICHE_AMOUNT"]);					//��ü�ݾ�

$UserIp = $_SERVER["REMOTE_ADDR"];						//ȸ�� IP

$HP_SERVERINFO = trim($_POST["HP_SERVERINFO"]);			//SERVER_INFO(�ڵ�������)

$HP_HANDPHONE = trim($_POST["HP_HANDPHONE"]);			//HANDPHONE(�ڵ�������)

$HP_COMPANY = trim($_POST["HP_COMPANY"]);				//COMPANY(�ڵ�������)

$HP_ID = trim($_POST["HP_ID"]);							//HP_ID(�ڵ�������)
	
$HP_SUBID = trim($_POST["HP_SUBID"]);					//HP_SUBID(�ڵ�������)

$HP_UNITType = trim($_POST["HP_UNITType"]);				//HP_UNITType(�ڵ�������)

$HP_IDEN = trim($_POST["HP_IDEN"]);						//HP_IDEN(�ڵ�������)

$HP_IPADDR = trim($_POST["HP_IPADDR"]);					//HP_IPADDR(�ڵ�������)

$VIRTUAL_CENTERCD = trim($_POST["VIRTUAL_CENTERCD"]);   //VIRTUAL_CENTERCD(�������Ա�) - �����ڵ� ��������߰�
  
$VIRTUAL_DEPODT = trim($_POST["VIRTUAL_DEPODT"]);		//VIRTUAL_DEPODT(�������Ա�) - �Աݿ����� ��������߰�
 
$ZuminCode = trim($_POST["ZuminCode"]);					//ZuminCode(�������Ա�) - �ֹι�ȣ ��������߰�

$MallUrl = trim($_POST["MallUrl"]);						//MallUrl(�������Ա�) - ���� ������ ��������߰�

$MallPage = trim($_POST["MallPage"]);					//MallPage(�������Ա�) - ���� ��/��� �뺸 ������ ��������߰�

$VIRTUAL_NO = trim($_POST["VIRTUAL_NO"]);				//VIRTUAL_NO(�������Ա�) - ������¹�ȣ ��������߰�


/****************************************************************************
*
* [3] ����Ÿ�� ��ȿ���� �˻��մϴ�.
*
****************************************************************************/

$ERRMSG = "";

if( empty( $StoreId ) || $StoreId == "" )
{
	$ERRMSG .= "�������̵� �Է¿��� Ȯ�ο�� <br>";		//�������̵�
}

if( empty( $OrdNo ) || $OrdNo == "" )
{
	$ERRMSG .= "�ֹ���ȣ �Է¿��� Ȯ�ο�� <br>";		//�ֹ���ȣ
}

if( empty( $ProdNm ) || $ProdNm == "" )
{
	$ERRMSG .= "��ǰ�� �Է¿��� Ȯ�ο�� <br>";			//��ǰ��
}

if( empty( $Amt ) || $Amt == "" )
{
	$ERRMSG .= "�ݾ� �Է¿��� Ȯ�ο�� <br>";			//�ݾ�
}

if( empty( $DeviId ) || $DeviId == "" )
{
	$ERRMSG .= "�ܸ�����̵� �Է¿��� Ȯ�ο�� <br>";		//�ܸ�����̵�
}

if( empty( $AuthYn ) || $AuthYn == "" )
{
	$ERRMSG .= "�������� �Է¿��� Ȯ�ο�� <br>";		//��������
}


if( strlen($ERRMSG) == 0 )
{
	/****************************************************************************
	* 
	* AuthTy = "card" �ſ�ī�����
	*	SubTy = "isp" ��������ISP
	*	SubTy = "visa3d" �Ƚ�Ŭ��
	*	SubTy = "normal" �Ϲݰ���
	*
	* AuthTy = "iche" ������ü
	*
	* AuthTy = "hp" �ڵ�������
	*
	****************************************************************************/
	
	if( strcmp( $AuthTy, "card" ) == 0 )
	{
		if( strcmp( $SubTy, "isp" ) == 0 )
		{
			/****************************************************************************
			*
			* [4] �ſ�ī����� - ISP
			* 
			* -- �̺κ��� ���� ó���� ���� ��ȣȭProcess�� Socket����ϴ� �κ��̴�.
			* ���� �ٽ��� �Ǵ� �κ��̹Ƿ� �����Ŀ��� �׽�Ʈ�� �Ͽ��� �Ѵ�.
			* -- ������ ���̴� �Ŵ��� ����
			* 
			* -- ���� ��û ���� ����
			* + �����ͱ���(6) + ISP�����ڵ�(1) + ������
			* + ������ ����(������ ������ "|"�� �Ѵ�.)
			* ��������(6)	| ��üID(20)	| ȸ��ID(20)	 	| �����ݾ�(12)		| 
			* �ֹ���ȣ(40)	| �ܸ����ȣ(10)	| ������(40)		| ��������ȭ(21)		| 
			* �����(100)	| �ֹ��ڸ�(40)	| �ֹ��ڿ���ó(100)	| ��Ÿ�䱸����(350)	|
			* ��ǰ��(300)	| ��ȭ�ڵ�(3)	| �Ϲ��ҺαⰣ(2)		| �������ҺαⰣ(2)	| 
			* KVPī���ڵ�(22)	| ����Ű(256)	| ��ȣȭ������(2048) 	| ī���(50)		|
			* ȸ�� IP(20)	| ȸ�� Email(50 ) 	|
			* 
			* -- ���� ���� ���� ����
			* + �����ͱ���(6) + ������
			* + ������ ����(������ ������ "|"�� �Ѵ�.
			* ��üID(20)	| �����ڵ�(4)	| �ŷ�������ȣ(6)| ���ι�ȣ(8)	| 
			* �ŷ��ݾ�(12)	| ��������(1)	| ���л���(20)	 | ���νð�(14)	| 
			* ī����ڵ�(4) |
			*    
			****************************************************************************/
			
			$ENCTYPE = 2;
			
			/****************************************************************************
			* 
			* ���� ���� Make
			* 
			****************************************************************************/
			
			$sDataMsg = $ENCTYPE.
				"plug15"."|".
				$StoreId."|".
				$UserId."|".
				$Amt."|".
				$OrdNo."|".
				$DeviId."|".
				$RcpNm."|".
				$RcpPhone."|".
				$DlvAddr."|".
				$OrdNm."|".
				$OrdPhone."|".
				$Remark."|".
				$ProdNm."|".
				$KVP_CURRENCY."|".
				$partial_mm."|".
				$noIntMonth."|".
				$KVP_CARDCODE."|".
				$KVP_SESSIONKEY."|".
				$KVP_ENCDATA."|".
				$KVP_CONAME."|".
				$UserIp."|".
				$UserEmail."|";
	
			$sSendMsg = sprintf( "%06d%s", strlen( $sDataMsg ), $sDataMsg );
			
			/****************************************************************************
			* 
			* ���� �޼��� ����Ʈ
			* 
			****************************************************************************/
			
			if( $IsDebug == 1 )
			{
				print $sSendMsg."<br>";
			}
	
			/****************************************************************************
			* 
			* ��ȣȭProcess�� ������ �ϰ� ���� ������ �ۼ���
			* 
			****************************************************************************/
			
			$fp = fsockopen( $LOCALADDR, $LOCALPORT , &$errno, &$errstr, $CONN_TIMEOUT );
			
			
			if( !$fp )
			{
				/** ���� ���з� ���� ���ν��� �޼��� ���� **/
				
				$rSuccYn = "n";
				$rResMsg = "���� ���з� ���� ���ν���";
			}
			else 
			{
				/** ���ῡ �����Ͽ����Ƿ� �����͸� �޴´�. **/
				
				$rResMsg = "���ῡ �����Ͽ����Ƿ� �����͸� �޴´�.";
				
				
				/** ���� ������ ��ȣȭProcess�� ���� **/
				
				fputs( $fp, $sSendMsg );
				
				socket_set_timeout($fp, $READ_TIMEOUT);
				
				/** ���� 6����Ʈ�� ������ ������ ���̸� üũ�� �� �����͸�ŭ�� �޴´�. **/
				
				$sRecvLen = fgets( $fp, 7 );
				$sRecvMsg = fgets( $fp, $sRecvLen + 1 );
			
				/****************************************************************************
				*
				* ������ ���� ���������� �Ѿ�� ���� ��� �̺κ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.
				* PHP ������ ���� ���� ������ ���� üũ�� ������������ �߻��� �� �ֽ��ϴ�
				* �����޼���:���� ������(����) üũ ���� ��ſ����� ���� ���� ����
				* ������ ���� üũ ������ �Ʒ��� ���� �����Ͽ� ����Ͻʽÿ�
				* $sRecvLen = fgets( $fp, 6 );
				* $sRecvMsg = fgets( $fp, $sRecvLen );
				*
				****************************************************************************/
		
				/** ���� close **/
				
				fclose( $fp );
			}
			
			/****************************************************************************
			* 
			* ���� �޼��� ����Ʈ
			* 
			****************************************************************************/
			
			if( $IsDebug == 1 )	
			{
				print $sRecvMsg."<br>";
			}
			
			if( strlen( $sRecvMsg ) == $sRecvLen )
			{
				/** ���� ������(����) üũ ���� **/
				
				$RecvValArray = array();
				$RecvValArray = explode( "|", $sRecvMsg );
			
				/** null �Ǵ� NULL ����, 0 �� �������� ��ȯ
				for( $i = 0; $i < sizeof( $RecvValArray); $i++ )
				{
					$RecvValArray[$i] = trim( $RecvValArray[$i] );
					
					if( !strcmp( $RecvValArray[$i], "null" ) || !strcmp( $RecvValArray[$i], "NULL" ) )
					{
						$RecvValArray[$i] = "";
					}
					
					if( IsNumber( $RecvValArray[$i] ) )
					{
						if( $RecvValArray[$i] == 0 ) $RecvValArray[$i] = "";
					}
				} **/
				
				$rStoreId = $RecvValArray[0];
				$rBusiCd = $RecvValArray[1];
				$rOrdNo = $OrdNo;
				$rDealNo = $RecvValArray[2];
				$rApprNo = $RecvValArray[3];
				$rProdNm = $ProdNm;
				$rAmt = $RecvValArray[4];
				$rInstmt = $KVP_QUOTA;
				$rSuccYn = $RecvValArray[5];
				$rResMsg = $RecvValArray[6];
				$rApprTm = $RecvValArray[7];
				$rCardCd = $RecvValArray[8];
				
				/****************************************************************************
				*
				* �ſ�ī�����(ISP) ����� ���������� ���ŵǾ����Ƿ� DB �۾��� �� ��� 
				* ����������� �����͸� �����ϱ� �� �̺κп��� �ϸ�ȴ�.
				*
				* ���⼭ DB �۾��� �� �ּ���.
				* ����) $rSuccYn ���� 'y' �ϰ�� �ſ�ī����μ���
				* ����) $rSuccYn ���� 'n' �ϰ�� �ſ�ī����ν���
				* DB �۾��� �Ͻ� ��� $rSuccYn ���� 'y' �Ǵ� 'n' �ϰ�쿡 �°� �۾��Ͻʽÿ�. 
				*
				****************************************************************************/
				
				
				
				
				
				
			}
			else
			{
				/** ���� ������(����) üũ ������ ��ſ����� ���� ���� ���з� ���� **/
				
				$rSuccYn = "n";
				$rResMsg = "���� ������(����) üũ ���� ��ſ����� ���� ���� ����";
			}
		}
		else if( ( strcmp( $SubTy, "visa3d" ) == 0 ) || ( strcmp( $SubTy, "normal" ) == 0 ) )
		{
			/****************************************************************************
			* 
			* [5] �ſ�ī����� - VISA3D, �Ϲ�
			* 
			* -- �̺κ��� ���� ó���� ���� ��ȣȭProcess�� Socket����ϴ� �κ��̴�.
			* ���� �ٽ��� �Ǵ� �κ��̹Ƿ� �����Ŀ��� ���� ���������� ������ �׽�Ʈ�� �Ͽ��� �Ѵ�.
			* -- ������ ���̴� �Ŵ��� ����
			* 
			* -- ���� ��û ���� ����
			* + �����ͱ���(6) + ��ȣȭ����(1) + ������
			* + ������ ����(������ ������ "|"�� �ϸ� ī���ȣ,��ȿ�Ⱓ,��й�ȣ,�ֹι�ȣ�� ��ȣȭ�ȴ�.)
			* ��������(6)		| ��üID(20)	 | ȸ��ID(20)	| �����ݾ�(12)		| �ֹ���ȣ(40)	|
			* �ܸ����ȣ(10)	| ī���ȣ(16)	 | ��ȿ�Ⱓ(6)	| �ҺαⰣ(4)		| ��������(1)		| 
			* ī���й�ȣ(2)	| �ֹε�Ϲ�ȣ/����ڹ�ȣ(10) | ������(40)	| ��������ȭ(21)	| �����(100)	|
			* �ֹ��ڸ�(40)		| �ֹ��ڿ���ó(100)	| ��Ÿ�䱸����(350) | ��ǰ��(300) |
			* 
			* -- ���� ���� ���� ����
			* + �����ͱ���(6) + ������
			* + ������ ����(������ ������ "|"�� �ϸ� ��ȣȭProcess���� �ص����� �ǵ����͸� �����ϰ� �ȴ�.
			* ��üID(20)	| �����ڵ�(4)		 | �ֹ���ȣ(40) | ���ι�ȣ(8)	| �ŷ��ݾ�(12)  |
			* ��������(1)	| ���л���(20)	 	 | ī����(20) 	| ���νð�(14)	| ī����ڵ�(4) |
			* ��������ȣ(15)	| ���Ի��ڵ�(4)	 | ���Ի��(20)	| ��ǥ��ȣ(6)	|
			* 
			****************************************************************************/
			
			$ENCTYPE = 0;
			
			/****************************************************************************
			* 
			* ���� ���� Make
			* 
			****************************************************************************/
			
			$sDataMsg = $ENCTYPE.
				"plug15"."|".
				$StoreId."|".
				$UserId."|".
				$Amt."|".
				$OrdNo."|".
				$DeviId."|".
				encrypt_aegis($CardNo)."|".
				encrypt_aegis($ExpYear.$ExpMon)."|".
				$Instmt."|".
				$AuthYn."|".
				encrypt_aegis($Passwd)."|".
				encrypt_aegis($SocId)."|".
				$RcpNm."|".
				$RcpPhone."|".
				$DlvAddr."|".
				$OrdNm."|".
				$UserIp.";".$OrdPhone."|".
				$UserEmail.";".$Remark."|".
				$ProdNm."|".
				$MPI_CAVV."|".
				$MPI_MD64."|".
				$MPI_ECI."|";
			
			$sSendMsg = sprintf( "%06d%s", strlen( $sDataMsg ), $sDataMsg );
			
			/****************************************************************************
			* 
			* ���� �޼��� ����Ʈ
			* 
			****************************************************************************/
			
			if( $IsDebug == 1 )
			{
				print $sSendMsg."<br>";
			}
	
			/****************************************************************************
			* 
			* ��ȣȭProcess�� ������ �ϰ� ���� ������ �ۼ���
			* 
			****************************************************************************/
			
			$fp = fsockopen( $LOCALADDR, $LOCALPORT , &$errno, &$errstr, $CONN_TIMEOUT );
			
			
			if( !$fp )
			{
				/** ���� ���з� ���� ���ν��� �޼��� ���� **/
				
				$rSuccYn = "n";
				$rResMsg = "���� ���з� ���� ���ν���";
			}
			else 
			{
				/** ���� ������ ��ȣȭProcess�� ���� **/
				
				fputs( $fp, $sSendMsg );
		
				socket_set_timeout($fp, $READ_TIMEOUT);
		
				/** ���� 6����Ʈ�� ������ ������ ���̸� üũ�� �� �����͸�ŭ�� �޴´�. **/
				
				$sRecvLen = fgets( $fp, 7 );
				$sRecvMsg = fgets( $fp, $sRecvLen + 1 );

				/****************************************************************************
				*
				* ������ ���� ���������� �Ѿ�� ���� ��� �̺κ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.
				* PHP ������ ���� ���� ������ ���� üũ�� ������������ �߻��� �� �ֽ��ϴ�
				* �����޼���:���� ������(����) üũ ���� ��ſ����� ���� ���� ����
				* ������ ���� üũ ������ �Ʒ��� ���� �����Ͽ� ����Ͻʽÿ�
				* $sRecvLen = fgets( $fp, 6 );
				* $sRecvMsg = fgets( $fp, $sRecvLen );
				*
				****************************************************************************/
				
				/** ���� close **/
				
				fclose( $fp );
			}
		
			/****************************************************************************
			* 
			* ���� �޼��� ����Ʈ
			* 
			****************************************************************************/
			
			if( $IsDebug == 1 )	
			{
				print $sRecvMsg."<br>";
			}
			
			if( strlen( $sRecvMsg ) == $sRecvLen )
			{
				/** ���� ������(����) üũ ���� **/
				
				$RecvValArray = array();
				$RecvValArray = explode( "|", $sRecvMsg );
			
				/** null �Ǵ� NULL ����, 0 �� �������� ��ȯ
				for( $i = 0; $i < sizeof( $RecvValArray); $i++ )
				{
					$RecvValArray[$i] = trim( $RecvValArray[$i] );
					
					if( !strcmp( $RecvValArray[$i], "null" ) || !strcmp( $RecvValArray[$i], "NULL" ) )
					{
						$RecvValArray[$i] = "";
					}
					
					if( IsNumber( $RecvValArray[$i] ) )
					{
						if( $RecvValArray[$i] == 0 ) $RecvValArray[$i] = "";
					}
				} **/
				
				$rStoreId = $RecvValArray[0];
				$rBusiCd = $RecvValArray[1];
				$rOrdNo = $RecvValArray[2];
				$rApprNo = $RecvValArray[3];
				$rInstmt = $Instmt;
				$rAmt = $RecvValArray[4];
				$rSuccYn = $RecvValArray[5];
				$rResMsg = $RecvValArray[6];
				$rCardNm = $RecvValArray[7];
				$rApprTm = $RecvValArray[8];
				$rCardCd = $RecvValArray[9];
				$rMembNo = $RecvValArray[10];
				$rAquiCd = $RecvValArray[11];
				$rAquiNm = $RecvValArray[12];
				$rBillNo = $RecvValArray[13];
				
				/****************************************************************************
				*
				* �ſ�ī�����(�Ƚ�Ŭ��, �Ϲݰ���) ����� ���������� ���ŵǾ����Ƿ� DB �۾��� �� ��� 
				* ����������� �����͸� �����ϱ� �� �̺κп��� �ϸ�ȴ�.
				*
				* ���⼭ DB �۾��� �� �ּ���.
				* ����) $rSuccYn ���� 'y' �ϰ�� �ſ�ī����μ���
				* ����) $rSuccYn ���� 'n' �ϰ�� �ſ�ī����ν���
				* DB �۾��� �Ͻ� ��� $rSuccYn ���� 'y' �Ǵ� 'n' �ϰ�쿡 �°� �۾��Ͻʽÿ�. 
				*
				****************************************************************************/
			
				
				
				
				
				
				
			}
			else
			{
				/** ���� ������(����) üũ ������ ��ſ����� ���� ���� ���з� ���� **/
				
				$rSuccYn = "n";
				$rResMsg = "���� ������(����) üũ ���� ��ſ����� ���� ���� ����";
			}
		}
	}
	else if( strcmp( $AuthTy, "iche" ) == 0 )
	{
		/****************************************************************************
		* 
		*  [6] ������ü�Ϸ�
		* 
		*  ������ü�� �ô�����Ʈ �÷����ο��� ��ü�Ϸ��� ��������� ��ȯ�մϴ�.
		*  �׷��Ƿ� ���� ������������ �ô�����Ʈ ���ϰ� ����� �ʿ䰡 �����ϴ�.
		*  ������ü ��������� DB�� �����Ͻ÷��� �̺κп��� �۾��Ͻʽÿ�.
   		*  
		*  ������ü�� ��������ʴ� ������ AGS_pay.html���� ���ҹ���� �� �ſ�ī��(����)���� ������ �����ñ� �ٶ��ϴ�.
		*  
		****************************************************************************/
	
		$rStoreId = $StoreId;
		$rOrdNo = $OrdNo;
		
		/****************************************************************************
		*
		* ���⼭ DB �۾��� �� �ּ���.
		* ����) ������ü�� ��� ������ü�����ϰ�� �� �������� �����ϵ��� �Ǿ� �ֽ��ϴ�.
		*
		****************************************************************************/
	
	
	
	
	
		
	
	}
	else if( strcmp( $AuthTy, "hp" ) == 0 )
	{
		/****************************************************************************
		* 
		* [7] �ڵ��� ����
		*
		*  �ڵ��� ������ ��������ʴ� ������ AGS_pay.html���� ���ҹ���� �� �ſ�ī��(����)���� ������ �����ñ� �ٶ��ϴ�.
		* 
		*  �̺κ��� ���� ó���� ���� ��ȣȭProcess�� Socket����ϴ� �κ��̴�.
		*  ���� �ٽ��� �Ǵ� �κ��̹Ƿ� �����Ŀ��� �׽�Ʈ�� �Ͽ��� �Ѵ�.
		*  -- ���� ��û ���� ����
		*  + �����ͱ���(6) + �ڵ��������ڵ�(1) + ������
		*  + ������ ����(������ ������ "|"�� �Ѵ�.)
		* 
		*  -- ���� ���� ���� ����
		*  + �����ͱ���(6) + ������
		*  + ������ ����(������ ������ "|"�� �Ѵ�.
		****************************************************************************/
			
		$ENCTYPE = h;
		$StrSubTy = Bill;
		
		/****************************************************************************
		* 
		* ���� ���� Make
		* 
		****************************************************************************/
		
		$sDataMsg = $ENCTYPE.
			$StrSubTy."|".
			$StoreId."|".
			$HP_SERVERINFO."|".
			$HP_ID."|".
			$HP_SUBID."|".
			$OrdNo."|".
			$Amt."|".
			$HP_UNITType."|".
			$HP_HANDPHONE."|".
			$HP_COMPANY."|".
			$HP_IDEN."|".
			$UserId."|".
			$UserEmail."|".
			$HP_IPADDR."|".
			$ProdNm."|";

		$sSendMsg = sprintf( "%06d%s", strlen( $sDataMsg ), $sDataMsg );

		/****************************************************************************
		* 
		* ���� �޼��� ����Ʈ
		* 
		****************************************************************************/
		
		if( $IsDebug == 1 )
		{
			print $sSendMsg."<br>";
		}

		/****************************************************************************
		* 
		* ��ȣȭProcess�� ������ �ϰ� ���� ������ �ۼ���
		* 
		****************************************************************************/
		
		$fp = fsockopen( $LOCALADDR, $LOCALPORT , &$errno, &$errstr, $CONN_TIMEOUT );
		
		
		if( !$fp )
		{
			/** ���� ���з� ���� ���ν��� �޼��� ���� **/
			
			$rSuccYn = "n";
			$rResMsg = "���� ���з� ���� ���ν���";
		}
		else 
		{
			/** ���� ������ ��ȣȭProcess�� ���� **/
			
			fputs( $fp, $sSendMsg );
			
			socket_set_timeout($fp, $READ_TIMEOUT);
			
			/** ���� 6����Ʈ�� ������ ������ ���̸� üũ�� �� �����͸�ŭ�� �޴´�. **/
			
			$sRecvLen = fgets( $fp, 7 );
			$sRecvMsg = fgets( $fp, $sRecvLen + 1 );
		
			/****************************************************************************
			*
			* ������ ���� ���������� �Ѿ�� ���� ��� �̺κ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.
			* PHP ������ ���� ���� ������ ���� üũ�� ������������ �߻��� �� �ֽ��ϴ�
			* �����޼���:���� ������(����) üũ ���� ��ſ����� ���� ���� ����
			* ������ ���� üũ ������ �Ʒ��� ���� �����Ͽ� ����Ͻʽÿ�
			* $sRecvLen = fgets( $fp, 6 );
			* $sRecvMsg = fgets( $fp, $sRecvLen );
			*
			****************************************************************************/
	
			/** ���� close **/
			
			fclose( $fp );
		}
		
		/****************************************************************************
		* 
		* ���� �޼��� ����Ʈ
		* 
		****************************************************************************/
		
		if( $IsDebug == 1 )	
		{
			print $sRecvMsg."<br>";
		}
		
		if( strlen( $sRecvMsg ) == $sRecvLen )
		{
			/** ���� ������(����) üũ ���� **/
			
			$RecvValArray = array();
			$RecvValArray = explode( "|", $sRecvMsg );
		
			/** null �Ǵ� NULL ����, 0 �� �������� ��ȯ
			for( $i = 0; $i < sizeof( $RecvValArray); $i++ )
			{
				$RecvValArray[$i] = trim( $RecvValArray[$i] );
				
				if( !strcmp( $RecvValArray[$i], "null" ) || !strcmp( $RecvValArray[$i], "NULL" ) )
				{
					$RecvValArray[$i] = "";
				}
				
				if( IsNumber( $RecvValArray[$i] ) )
				{
					if( $RecvValArray[$i] == 0 ) $RecvValArray[$i] = "";
				}
			} **/
			
			$rStoreId = $RecvValArray[0];	
			$rSuccYn = $RecvValArray[1];
			$rResMsg = $RecvValArray[2];
			$rHP_DATE = $RecvValArray[3];
			$rHP_TID = $RecvValArray[4];
			$rAmt = $Amt;
			$rOrdNo = $OrdNo;
			
			/****************************************************************************
			*
			* �ڵ������� ����� ���������� ���ŵǾ����Ƿ� DB �۾��� �� ��� 
			* ����������� �����͸� �����ϱ� �� �̺κп��� �ϸ�ȴ�.
			*
			* ���⼭ DB �۾��� �� �ּ���.
			* ����) $rSuccYn ���� 'y' �ϰ�� �ڵ����������μ���
			* ����) $rSuccYn ���� 'n' �ϰ�� �ڵ����������ν���
			* DB �۾��� �Ͻ� ��� $rSuccYn ���� 'y' �Ǵ� 'n' �ϰ�쿡 �°� �۾��Ͻʽÿ�. 
			*
			****************************************************************************/
			
			
			
			
			
			
		}
		else
		{
			/** ���� ������(����) üũ ������ ��ſ����� ���� ���� ���з� ���� **/
			
			$rSuccYn = "n";
			$rResMsg = "���� ������(����) üũ ���� ��ſ����� ���� ���� ����";
		}
	}
    else if( strcmp( $AuthTy, "virtual" ) == 0 ) //��������߰�
	{
            /****************************************************************************
			*
			* [8] ������� ����
			* 
			* -- �̺κ��� ���� ó���� ���� ��ȣȭProcess�� Socket����ϴ� �κ��̴�.
			* ���� �ٽ��� �Ǵ� �κ��̹Ƿ� �����Ŀ��� �׽�Ʈ�� �Ͽ��� �Ѵ�.
			* -- ������ ���̴� �Ŵ��� ����
			* 
			* -- ���� ��û ���� ����
			* + �����ͱ���(6) + ��ȣȭ ����(1) + ������
			* + ������ ����(������ ������ "|"�� �Ѵ�.)
			* ��������(10)	| ��üID(20)	| �ֹ���ȣ(40)	 	| �����ڵ�(4)		| ������¹�ȣ(20)
			* �ŷ��ݾ�(13)	| �Աݿ�����(8)	| �����ڸ�(20)		| �ֹι�ȣ(13)		| 
			* �̵���ȭ(21)	| �̸���(50)	| �������ּ�(100)	| �����ڸ�(20)	|
			* �����ڿ���ó(21)	| ������ּ�(100)	| ��ǰ��(100) | ��Ÿ�䱸����(300)		| ���� ������(50)|���� ������(100)|
			* 
			* -- ���� ���� ���� ����
			* + �����ͱ���(6) + ��ȣȭ ����(1) + ������
			* + ������ ����(������ ������ "|"�� �Ѵ�.
			* ��������(10)| ��üID(20)	| ��������(14)	| ������¹�ȣ(20)| ����ڵ�(1)	| ����޽���(100)	 | 
			* ������� �Ϲ� : vir_n ��Ŭ�� : vir_u ����ũ�� : vir_s   
            * ������¹�ȣ �� ��ǰ�� �߰� 2005-11-10
			****************************************************************************/
			
			$ENCTYPE = "V";
			
			/****************************************************************************
			* 
			* ���� ���� Make
			* 
			****************************************************************************/
			
			$sDataMsg = $ENCTYPE.
				/* $AuthTy."|". */
                "vir_n|".
				$StoreId."|".
				$OrdNo."|".
				$VIRTUAL_CENTERCD."|".
                $VIRTUAL_NO."|". 
				$Amt."|".
				$VIRTUAL_DEPODT."|".
				$OrdNm."|".
                $ZuminCode."|".
				$OrdPhone."|".
				$UserEmail."|".
				$OrdAddr."|".
				$RcpNm."|".
				$RcpPhone."|".
				$DlvAddr."|".
                $ProdNm."|".
				$Remark."|".
                $MallUrl."|".
                $MallPage."|";
	
			$sSendMsg = sprintf( "%06d%s", strlen( $sDataMsg ), $sDataMsg );
			
			/****************************************************************************
			* 
			* ���� �޼��� ����Ʈ
			* 
			****************************************************************************/
			
			if( $IsDebug == 1 )
			{
				print $sSendMsg."<br>";
			}
	
			/****************************************************************************
			* 
			* ��ȣȭProcess�� ������ �ϰ� ���� ������ �ۼ���
			* 
			****************************************************************************/
			
			$fp = fsockopen( $LOCALADDR, $LOCALPORT , &$errno, &$errstr, $CONN_TIMEOUT );
			
			
			if( !$fp )
			{
				/** ���� ���з� ���� ���ν��� �޼��� ���� **/
				
				$rSuccYn = "n";
				$rResMsg = "���� ���з� ���� ���ν���";
			}
			else 
			{
				/** ���ῡ �����Ͽ����Ƿ� �����͸� �޴´�. **/
				
				$rResMsg = "���ῡ �����Ͽ����Ƿ� �����͸� �޴´�.";
				
				
				/** ���� ������ ��ȣȭProcess�� ���� **/
				
				fputs( $fp, $sSendMsg );
				
				socket_set_timeout($fp, $READ_TIMEOUT);
				
				/** ���� 6����Ʈ�� ������ ������ ���̸� üũ�� �� �����͸�ŭ�� �޴´�. **/
				
				$sRecvLen = fgets( $fp, 7 );
				$sRecvMsg = fgets( $fp, $sRecvLen + 1 );
			
				/****************************************************************************
				*
				* ������ ���� ���������� �Ѿ�� ���� ��� �̺κ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.
				* PHP ������ ���� ���� ������ ���� üũ�� ������������ �߻��� �� �ֽ��ϴ�
				* �����޼���:���� ������(����) üũ ���� ��ſ����� ���� ���� ����
				* ������ ���� üũ ������ �Ʒ��� ���� �����Ͽ� ����Ͻʽÿ�
				* $sRecvLen = fgets( $fp, 6 );
				* $sRecvMsg = fgets( $fp, $sRecvLen );
				*
				****************************************************************************/
		
				/** ���� close **/
				
				fclose( $fp );
			}
			
			/****************************************************************************
			* 
			* ���� �޼��� ����Ʈ
			* 
			****************************************************************************/
			
			if( $IsDebug == 1 )	
			{
				print $sRecvMsg."<br>";
			}
			
			if( strlen( $sRecvMsg ) == $sRecvLen )
			{
				/** ���� ������(����) üũ ���� **/
				
				$RecvValArray = array();
				$RecvValArray = explode( "|", $sRecvMsg );
			
				/** null �Ǵ� NULL ����, 0 �� �������� ��ȯ
				for( $i = 0; $i < sizeof( $RecvValArray); $i++ )
				{
					$RecvValArray[$i] = trim( $RecvValArray[$i] );
					
					if( !strcmp( $RecvValArray[$i], "null" ) || !strcmp( $RecvValArray[$i], "NULL" ) )
					{
						$RecvValArray[$i] = "";
					}
					
					if( IsNumber( $RecvValArray[$i] ) )
					{
						if( $RecvValArray[$i] == 0 ) $RecvValArray[$i] = "";
					}
				} **/
				
                		$rAuthTy    = $RecvValArray[0];
				$rStoreId   = $RecvValArray[1];
				$rApprTm    = $RecvValArray[2];
				$rVirNo     = $RecvValArray[3];
				$rSuccYn    = $RecvValArray[4];
				$rResMsg    = $RecvValArray[5];

				$rOrdNo = $OrdNo;
                $rAmt = $Amt;
				
				/****************************************************************************
				*
				* ������¹��� ����� ���������� ���ŵǾ����Ƿ� DB �۾��� �� ��� 
				* ����������� �����͸� �����ϱ� �� �̺κп��� �ϸ�ȴ�.
				*
				* ���⼭ DB �۾��� �� �ּ���.
				* ����) $rSuccYn ���� 'y' �ϰ�� �ſ�ī����μ���
				* ����) $rSuccYn ���� 'n' �ϰ�� �ſ�ī����ν���
				* DB �۾��� �Ͻ� ��� $rSuccYn ���� 'y' �Ǵ� 'n' �ϰ�쿡 �°� �۾��Ͻʽÿ�. 
				*
				****************************************************************************/
				
				
				
				
				
				
			}
			else
			{
				/** ���� ������(����) üũ ������ ��ſ����� ���� ���� ���з� ���� **/
				
				$rSuccYn = "n";
				$rResMsg = "���� ������(����) üũ ���� ��ſ����� ���� ���� ����";
			}
       }
}
else
{
	$rSuccYn = "n";
	$rResMsg = $ERRMSG;
}
?>
<html>
<head>
</head>
<body onload="javascript:frmAGS_pay_ing.submit();">
<form name=frmAGS_pay_ing method=post action=AGS_pay_result.php>
<input type=hidden name=AuthTy value="<?=$AuthTy?>">
<input type=hidden name=SubTy value="<?=$SubTy?>">
<input type=hidden name=rStoreId value="<?=$rStoreId?>">
<input type=hidden name=rBusiCd value="<?=$rBusiCd?>">
<input type=hidden name=rOrdNo value="<?=$rOrdNo?>">
<input type=hidden name=rProdNm value="<?=$ProdNm?>">
<input type=hidden name=rApprNo value="<?=$rApprNo?>">
<input type=hidden name=rAmt value="<?=$rAmt?>">
<input type=hidden name=rSuccYn value="<?=$rSuccYn?>">
<input type=hidden name=rResMsg value="<?=$rResMsg?>">
<input type=hidden name=rApprTm value="<?=$rApprTm?>">
<input type=hidden name=rCardCd value="<?=$rCardCd?>">
<input type=hidden name=rCardNm value="<?=$rCardNm?>">
<input type=hidden name=rMembNo value="<?=$rMembNo?>">
<input type=hidden name=rAquiCd value="<?=$rAquiCd?>">
<input type=hidden name=rAquiNm value="<?=$rAquiNm?>">
<input type=hidden name=rBillNo value="<?=$rBillNo?>">
<input type=hidden name=rDealNo value="<?=$rDealNo?>">
<input type=hidden name=ICHE_OUTBANKNAME value="<?=$ICHE_OUTBANKNAME?>">
<input type=hidden name=ICHE_OUTACCTNO value="<?=$ICHE_OUTACCTNO?>">
<input type=hidden name=ICHE_OUTBANKMASTER value="<?=$ICHE_OUTBANKMASTER?>">
<input type=hidden name=ICHE_AMOUNT value="<?=$ICHE_AMOUNT?>">
<input type=hidden name=rHP_HANDPHONE value="<?=$HP_HANDPHONE?>">
<input type=hidden name=rHP_COMPANY value="<?=$HP_COMPANY?>">
<input type=hidden name=rHP_TID value="<?=$rHP_TID?>">
<input type=hidden name=rHP_DATE value="<?=$rHP_DATE?>">
<input type=hidden name=rVirNo value="<?=$rVirNo?>"><!-- ��������߰� -->
<input type=hidden name=VIRTUAL_CENTERCD value="<?=$VIRTUAL_CENTERCD?>">
</form>
</body>
</html>