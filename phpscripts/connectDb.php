<?php
	$contact = "�������� ������ �.�.";
	$connection = mysqli_connect('localhost','root','') or die("�� ������� ����������� � MySQL. " . $contact);
	if (!$connection)
	{
		echo ':(';
		//throw new Exception("������ ����������� � ��", 1);
	}
	else
	{
		echo ':)';
	}
	mysqli_select_db($connection,"smenaptk_db") or die ("������ ����������� � �� smenaptk_db. " . $contact);
?>