<?php
	require('connectDb.php');

	$query = 'select * from system';
	$res = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_array($res)) {
		echo "id:".$row['system_id']."</br>";
		echo "name:".$row['name']."</br>";
		echo "instruction_url:".$row['instruction_url']."</br>";
	}
?>