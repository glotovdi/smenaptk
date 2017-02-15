<?php
	require('connectDb.php');
	$system_id = $_GET['system_id'];
	$query = 'select system.name, system.instruction_url, system.name_full, system.arm_url, server.id server_id, server.hostname, server.ip from system, server, server_in_system where (system.system_id = server_in_system.id_system and server.id = server_in_system.id_server and system_id='.$system_id.');';
	$res = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_array($res)) {
		echo "id:".$row['system_id']."</br>";
		echo "name:".$row['name']."</br>";
		echo "instruction_url:".$row['instruction_url']."</br>";
	}
?>