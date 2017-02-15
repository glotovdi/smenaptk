<?php
	require('/classes/DBWorker.php');
	$dbWorker = new DBWorker();

	$handle = fopen('systems.csv', 'r');

	for($i=0;$i<500;$i++){
		$csv = fgetcsv($handle,1000,';');
		$currentSystemId;
		// Если $csv[1] не пустое - значит необходимо либо добавить новую систему, либо найти id существующей
		if ($csv[1]!='')
		{
			echo "Строка с системой $csv[1]<br>";
			$currentSystemId = $dbWorker->isSystemExist($csv[1]);
			if($currentSystemId!=-1)
			{
				echo "Такая система существует! id=".$currentSystemId."<br>";
			}
			else
			{
				echo "Такой системы не существует, необходимо добавить в БД<br>";
				// Замена символов " на /"
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
				echo "Система добавлена в БД (id=".$currentSystemId.")<br>";
			}
			// Тут парсим таблицу администраторов
			$adminName = $csv[24];
			if ($adminName!='')
			{
				echo "Строка с адмнистратором " . $adminName . "<br>";
				if ($dbWorker->isAdministratorExist($adminName)!=-1)
				{
					echo "Администратора нет в БД. Добавляем!<br>";
					$admin = new Administrator($adminName,'','','');
					$dbWorker->addAdministrator($admin);
					echo "Добавляем администратора в связи к системе<br>";
					$admin_id = $dbWorker->isAdministratorExist($adminName);
					$dbWorker->connectAdministratorAndSystem($admin)

				}
				else
				{
					echo "Данный администратор уже есть в БД<br>";
				}
			}

		}
		// На этом этапе получили currentSystemId, далее парсим сами сервера, и связываем их с системами
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
			echo "Пустое поле ip, пытаюсь взять из 16 столбца. Теперь мой ip: ".$serverIp;
		}
		if($serverIp!=''){
			$currentServerId = $dbWorker->getServerId($serverHostName);
			if($currentServerId==-1)
			{
				$server = new Server($serverType,$serverIp,$serverSpace,$serverHostCpu,$serverCPUs,$serverOS,$serverSoftware,$serverEKESPP,$serverHostName);
				$dbWorker->addServer($server);
				$currentServerId = $dbWorker->getServerId($serverHostName);
				echo "Сервер " . $serverHostName . "; с id =" . $currentServerId . "<br>";
				// Связываем сервер с системой
				$dbWorker->connectServerAndSystem($currentServerId,$currentSystemId);
			}
			else
			{
				echo "Сервер ".$serverHostName." уже занесен в БД. Связываем существующий сервер с системой " . $csv[1] . "<br>";
				$dbWorker->connectServerAndSystem($currentServerId,$currentSystemId);
			}
		}	

		echo '<hr>';
	}
	
?>