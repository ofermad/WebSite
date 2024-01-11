<?php
	$des=mysqli_connect("localhost","root","root");
	mysqli_select_db($des,"products");
	mysqli_set_charset($des,"utf8");
	
	$tb_nm = $_POST['tb_nm'];
	$nm = $_POST['nm'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$img_path = $_POST['img_path'];
	
	if ($tb_nm == "tires")
	{
		$pr_nm = "tires_name";
	}
	else if ($tb_nm == "car_electronics")
	{
		$pr_nm = "electr_name";
	}
	else if ($tb_nm == "other")
	{
		$pr_nm = "other_name";
	}
		
	
	if ($_POST['nm'] != "" && $_POST['quantity'] != ""  && $_POST['price'] != "" && $_POST['img_path'] !="")
	{
		#echo "INSERT INTO `".$tb_nm."` (".$pr_nm.", quantity, price, img_path) VALUES ('".$nm."','".$quantity."','".$price.",'".$img_path."'')";
		mysqli_query($des, "INSERT INTO ".$tb_nm." (".$pr_nm.", quantity, price, img_path) VALUES ('".$nm."','".$quantity."','".$price."','".$img_path."')");
		echo '<a href="edit.php">Вернуться</a>';
	}
	else
	{
		echo 'Внесены не все данные!<br>';
		echo '<a href="edit.php?nm='.$nm.'&quantity='.$quantity.'&price='.$price.'">Вернуться</a>';
	}
?>