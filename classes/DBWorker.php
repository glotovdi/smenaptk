<?php
	require('Server.php');
	require('System.php');
	require('Administrator.php');
	class DBWorker{
		public $connection;

		function __construct(){
			$this->connection = mysqli_connect('localhost','root','root') or die("Не удается соедениться с MySQL. " . $contact);
			mysqli_select_db($this->connection,"smenaptk_db") or die ("Ошибка подключения к БД smenaptk_db. " . $contact);
			mysqli_set_charset($this->connection,"utf8");
		}
		function addSystem(System $system)
		{
			$query = "INSERT INTO `system`(`name`, `instruction_url`, `name_full`, `arm_url`, `developer`) VALUES (\"$system->name\",\"$system->instruction_url\",\"$system->name_full\",\"$system->arm_url\",\"$system->developer\")";
			//echo $query;
			$res = mysqli_query($this->connection,$query);
		}
		function isSystemExist($system_name)
		{
			$query = 'SELECT * FROM `system` s WHERE s.name=\''.$system_name.'\'';
			$res = mysqli_query($this->connection,$query);
			$row = mysqli_fetch_array($res);
			if (empty($row['system_id']))
				return -1;
			else
				return $row['system_id'];
		}
		function isAdministratorExist($admin_name)
		{
			$query = 'SELECT * FROM `administrator` a WHERE a.name=\''.$admin_name.'\'';
			$res = mysqli_query($this->connection,$query);
			$row = mysqli_fetch_array($res);
			if (empty($row['id']))
				return -1;
			else
				return $row['id'];
		}
		function addServer(Server $server)
		{
			$query = "INSERT INTO `smenaptk_db`.`server` (`type`, `ip`, `space`, `host_cpu`, `CPUs`, `OS`, `software`, `EKespp`, `hostName`) VALUES (\"$server->type\", \"$server->ip\", \"$server->space\", \"$server->host_cpu\", \"$server->CPUs\", \"$server->OS\", \"$server->software\", \"$server->EKESPP\", \"$server->hostName\")";
			//echo $query;
			$res = mysqli_query($this->connection,$query);
		}
		function addAdministrator(Administrator $admin)
		{
			$query = "INSERT INTO `smenaptk_db`.`administrator` (`name`) VALUES (\"$admin->name\")";
			$res = mysqli_query($this->connection,$query);
		}
		function getServerId($server_hostName)
		{
			$query = 'SELECT * FROM `server` s WHERE s.hostName=\''.$server_hostName.'\'';
			$res = mysqli_query($this->connection,$query);
			$row = mysqli_fetch_array($res);
			if (empty($row['id']))
				return -1;
			else
				return $row['id'];
		}
		function connectServerAndSystem($server_id, $system_id)
		{
			$query = 'SELECT * FROM `server_in_system` s WHERE s.id_system=\''.$system_id.'\' and s.id_server=\''.$server_id.'\'';
			$res = mysqli_query($this->connection,$query);
			$row = mysqli_fetch_array($res);
			if (empty($row['id_system']))
			{
				// Если такой строки нет - добавляем!
				$query = "INSERT INTO `smenaptk_db`.`server_in_system` (`id_system`, `id_server`) VALUES (\"$system_id\", \"$server_id\")";
				echo $query;
				$res = mysqli_query($this->connection,$query);
			}
			else
				{
					echo "Такая связь уже существует!<br>";
				}
		}
		function connectAdministratorAndSystem($admin_id,$system_id)
		{
			$query = 'SELECT * FROM `adm_in_system` s WHERE s.id_system=\''.$system_id.'\' and s.id_admin=\''.$admin_id.'\'';
			$res = mysqli_query($this->connection,$query);
			$row = mysqli_fetch_array($res);
			if (empty($row['id_system']))
			{
				// Если такой строки нет - добавляем!
				$query = "INSERT INTO `smenaptk_db`.`adm_in_system` (`id_system`, `id_admin`) VALUES (\"$system_id\", \"$admin_id\")";
				echo $query;
				$res = mysqli_query($this->connection,$query);
			}
			else
				{
					echo "Такая связь уже существует!<br>";
				}
		}
		function getSystems()
		{
			$query = 'select * from system';
			$res = mysqli_query($this->connection,$query);
			return $res;
			/*while ($row = mysqli_fetch_array($res)) 
			{
				echo "id:".$row['id']."</br>";
				echo "hostname:".$row['hostname']."</br>";
				echo "ip:".$row['ip']."</br>";
			}*/
		}
		function getSystemInfo($system_id)
		{
			$query = 'select system.name, system.instruction_url, system.name_full, system.arm_url, server.id server_id, server.hostname, server.ip from system, server, server_in_system where (system.system_id = server_in_system.id_system and server.id = server_in_system.id_server and system_id='.$system_id.')';
			$res = mysqli_query($this->connection,$query);
			//$row = mysqli_fetch_array($res);
			return $res;
		}
	}
?>
