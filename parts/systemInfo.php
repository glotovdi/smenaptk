<?php
	require('../classes/DBWorker.php');
	$system_id = $_GET["system_id"];
	$dbWorker = new DBWorker();
	$res = $dbWorker->getSystemInfo($system_id);
	$row = mysqli_fetch_array($res);
?>
	<div class="h1_system">
	<?php 
	echo  $row['name']; 
	?>

	<div class="link_instr"><a href="#">Инструкция</a> </div></div>
	<div class="dop_system_info">
	<div class="system_system_list">Сервера<br>
	<input class="system_servers_input" type="text">
		
	<?php
	echo "<div id='server' server_id='".$row['server_id']."'>";//просто вывод первого сервера из списка, далее остальные в цикле.
	echo $row['hostname'];	
	echo "<br>";
	echo "</div>";
	
	while ($row = mysqli_fetch_array($res)) {
		echo "<div id='server' server_id='".$row['server_id']."'>";
		echo $row['hostname'];
		echo "<br>";
		echo "</div>";
	}
	?>
	</div>
	<div class="system_admins">Администраторы
	<div class="system_admin1">Иванов Иван Васильевич<br>раб: 7777777</div>
	</div>
	</div>
