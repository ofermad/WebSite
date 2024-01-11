<?php
	$nm = $_POST['nm'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
	if ($_POST['nm'] != "" && $_POST['email'] != ""  && $_POST['pass'] != "")
	{
		$des=mysqli_connect("localhost","root","root");
		mysqli_select_db($des,"users");
		mysqli_set_charset($des,"utf8");
		
		$result = mysqli_query($des, "SELECT * FROM users WHERE user_email = '$email'");
		
			
			if (mysqli_num_rows($result) > 0)
			{
				echo 'Такой пользователь уже есть<br>';
				echo '<a href="regist.php?nm='.$nm.'&email='.$email.'&pass='.$pass.'">Вернуться</a>';
			}
			else
			{
				echo 'Вы успешно зарегистрировались<br>';
				
				mysqli_query($des, "INSERT INTO users (user_name, user_email, user_pass) VALUES ('".$nm."','".$email."','".$pass."')");
				
				echo '<a href="main_pg.php"> Вернуться</a>';
			}
			//echo 'YES';
	}
	
/*
	if (isset($_POST['email']))
	{
		$_POST['email'];
	}
		
	if (isset($_POST['pass']))
	{
		$_POST['pass'];
	}*/
	
	else
	{
		echo 'Внесены не все данные!<br>';
		echo '<a href="regist.php?nm='.$nm.'&email='.$email.'&pass='.$pass.'">Вернуться</a>';
	}
?>