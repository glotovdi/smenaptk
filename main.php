 <?php
 	require('parts/header.php');
 	require('classes/DBWorker.php');
 ?>
<html>
<head>
	<title>Системы</title>
	<script src="jq.js"></script>
	<script>
 	$(function () {
 	$(".logo_animate").animate(
 	{

 	opacity:1,
 	marginLeft:'28px'
 },1000);
});
</script> 


<script>
window.onload = function() 
{//onload begin
   var inp = document.getElementById('input');

  var find = function() 
  {//find begin
    var parent = document.getElementById('system_list');
    var divs = parent.getElementsByTagName('div');
    len = divs.length;

    for (var i = 0; i < len; i++) 
    {//for begin
     

     if (divs[i].innerHTML.toLowerCase().search(inp.value.toLowerCase()) < 0 ) 
     {//если элемент не равен вводу, то скрываем
	divs[i].style.display = 'none'; 
}
else 
	{
		if (divs[i].style.display != 'block') 
		{
        divs[i].style.display = 'block';

     }
   }



    }//for end
        
  }//find end

  inp.onkeyup = function() {
    find();
  }
 
}//onload end

// $(b).click(getInfo());
function getInfo(system_id)
{
	$('.once_system').load('/parts/systeminfo.php?'+system_id);	
}
// alert(cur_div);

// 



</script>

<div class="wrapper">
	<div class="content">
		<div id='search' class="search">
			<img class="search_icon" src="images/search_6541.png">
			<p>Поиск по названию системы</p>
			<input  id="input" class="input_us" placeholder="Введите название системы" type="text">
			<!-- <a href="#" class="button">Найти</a> -->
		</div>

		<!-- <div class="line"></div> -->

		<div class="system_list">Список систем:

<div id='system_list' class="systems">
<?php

	$dbWorker = new DBWorker();
	$res = $dbWorker->getSystems();
	while ($row = mysqli_fetch_array($res)) 
	{
		echo "<div id='systems_click' onclick=getInfo(".$row['system_id'].")>";
		echo $row['name'];
		echo "<hr>";
		echo "</div>";
	}
?>

</div>

</div>
<!-- <div class="line"></div> -->
<div class="once_system">
<div class="h1_system">АС ЭТРАН <div class="link_instr"><a href="#">Инструкция</a> </div></div>
<div class="dop_system_info">
<div class="system_system_list">Сервера<br>
<input class="system_servers_input" type="text">
ETR-VM-01<br>
ETR-VM-02<br>
</div>
<div class="system_admins">Администраторы
<div class="system_admin1">Иванов Иван Васильевич<br>раб: 7777777</div>
</div>
</div>

</div>

		</div>
</div>

</body>
</html>