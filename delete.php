<?php
	$des=mysqli_connect("localhost","root","root");
	mysqli_select_db($des,"products");
	mysqli_set_charset($des,"utf8");
	
	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		$tb_name=$_GET['tb_name'];
		
		if ($tb_name == "tires")
		{
			$id_nm="id_tires";
		}
		else if ($tb_name == "car_electronics")
		{
			$id_nm="id_electr";
		}
		else if ($tb_name == "other")
		{
			$id_nm="id_other";
		}

		mysqli_query($des, "DELETE FROM $tb_name WHERE $id_nm=$id");
		echo "Данные удалены<br>";
		echo '<a href="edit.php">Вернуться</a>';
	}
?>