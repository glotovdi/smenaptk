<?php
	require('/classes/DBWorker.php');
	$dbWorker = new DBWorker();

	$handle = fopen('systems.csv', 'r');

	for($i=0;$i<500;$i++){
		$csv = fgetcsv($handle,1000,';');
		$currentSystemId;
		// ���� $csv[1] �� ������ - ������ ���������� ���� �������� ����� �������, ���� ����� id ������������
		if ($csv[1]!='')
		{
			echo "������ � �������� $csv[1]<br>";
			$currentSystemId = $dbWorker->isSystemExist($csv[1]);
			if($currentSystemId!=-1)
			{
				echo "����� ������� ����������! id=".$currentSystemId."<br>";
			}
			else
			{
				echo "����� ������� �� ����������, ���������� �������� � ��<br>";
				// ������ �������� " �� /"
				$search = '"'; 
				$replace = '\"';
				$sysname = str_replace($search, $replace, $csv[1]);
				$sysinstr = str_replace($search, $replace, $csv[28]);
				$sysfullname = str_replace($search, $replace, $csv[2]);
				$sysurl = str_replace($search, $replace, $csv[21]);
				$sysdeveloper = str_replace($search, $replace, $csv[25]);
				$system = new System($sysname,$sysinstr,$sysfullname,$sysurl,$sysdeveloper);
				$dbWorker->addSystem($system);
				$currentSystemId = $dbWorker->isSystemExist($csv[1]);
				echo "������� ��������� � �� (id=".$currentSystemId.")<br>";
			}
			// ��� ������ ������� ���������������
			$adminName = $csv[24];
			if ($adminName!='')
			{
				echo "������ � �������������� " . $adminName . "<br>";
				if ($dbWorker->isAdministratorExist($adminName)!=-1)
				{
					echo "�������������� ��� � ��. ���������!<br>";
					$admin = new Administrator($adminName,'','','');
					$dbWorker->addAdministrator($admin);
					echo "��������� �������������� � ����� � �������<br>";
					$admin_id = $dbWorker->isAdministratorExist($adminName);
					$dbWorker->connectAdministratorAndSystem($admin)

				}
				else
				{
					echo "������ ������������� ��� ���� � ��<br>";
				}
			}

		}
		// �� ���� ����� �������� currentSystemId, ����� ������ ���� �������, � ��������� �� � ���������
		$serverType = $csv[7];
		$serverIp = $csv[16];
		$serverSpace = $csv[9];
		$serverHostCpu = $csv[10];
		$serverCPUs = $csv[12];
		$serverOS = $csv[13];
		$serverSoftware = $csv[18];
		$serverEKESPP = $csv[17];
		$serverHostName = $csv[5];

		if($serverIp=='')
		{
			$serverIp = $csv[16];
			echo "������ ���� ip, ������� ����� �� 16 �������. ������ ��� ip: ".$serverIp;
		}
		if($serverIp!=''){
			$currentServerId = $dbWorker->getServerId($serverHostName);
			if($currentServerId==-1)
			{
				$server = new Server($serverType,$serverIp,$serverSpace,$serverHostCpu,$serverCPUs,$serverOS,$serverSoftware,$serverEKESPP,$serverHostName);
				$dbWorker->addServer($server);
				$currentServerId = $dbWorker->getServerId($serverHostName);
				echo "������ " . $serverHostName . "; � id =" . $currentServerId . "<br>";
				// ��������� ������ � ��������
				$dbWorker->connectServerAndSystem($currentServerId,$currentSystemId);
			}
			else
			{
				echo "������ ".$serverHostName." ��� ������� � ��. ��������� ������������ ������ � �������� " . $csv[1] . "<br>";
				$dbWorker->connectServerAndSystem($currentServerId,$currentSystemId);
			}
		}	

		echo '<hr>';
	}
	
?>