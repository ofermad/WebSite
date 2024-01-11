<?php
	session_start();
	
	
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
	if ($_POST['email'] != ""  && $_POST['pass'] != "")
	{
		$des=mysqli_connect("localhost","root","root");
		mysqli_select_db($des,"users");
		mysqli_set_charset($des,"utf8");
		
		$result1 = mysqli_query($des, "SELECT * FROM users WHERE user_email = '$email'");
		$result2 = mysqli_query($des, "SELECT * FROM admin_user WHERE user_name = '$email'");
		
			
			if (mysqli_num_rows($result2) > 0)
			{
				echo 'Вы успешно вошли';
				echo '<a href="main_pg.php"> Вернуться</a>';
				$_SESSION['authenticated_admin'] = true;
			}
			else if (mysqli_num_rows($result1) > 0)
			{
				echo 'Вы успешно вошли';
				echo '<a href="main_pg.php"> Вернуться</a>';
				$_SESSION['authenticated_user'] = true;
			}
			else
			{
				echo 'Неверные почта или пароль';
				echo '<a href="auth.php"> Вернуться</a>';
				$_SESSION['authenticated_admin'] = false;
				$_SESSION['authenticated_user'] = false;
			}
	}
	else
	{
		echo 'Внесены не все данные!<br>';
		echo '<a href="auth.php?email='.$email.'&pass='.$pass.'">Вернуться</a>';
	}
?>