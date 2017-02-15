<?php
	require('connectDb.php');
	$query = 'select * from server';
	$res = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_array($res)) {
		echo "id:".$row['id']."</br>";
		echo "hostname:".$row['hostname']."</br>";
		echo "ip:".$row['ip']."</br>";
	}
?>