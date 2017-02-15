<?php
	$contact = "Сообщить Сухину Д.К.";
	$connection = mysqli_connect('localhost','root','') or die("Не удается соедениться с MySQL. " . $contact);
	if (!$connection)
	{
		echo ':(';
		//throw new Exception("Ошибка подключения к БД", 1);
	}
	else
	{
		echo ':)';
	}
	mysqli_select_db($connection,"smenaptk_db") or die ("Ошибка подключения к БД smenaptk_db. " . $contact);
?>