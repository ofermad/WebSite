<?php
	$email = "";
	$pass = "";

	if (isset($_GET['email']))
	{
		$email = $_GET['email'];
	}
	
	if (isset($_GET['pass']))
	{
		$pass = $_GET['pass'];
	}
?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Продажа автозапчастей</title>
  <link rel="stylesheet" href="auth.css">
 </head>
 <body>
	<div class="navbar">
	  <a href="main_pg.php">Главная</a>
	  <div class="dropdown">
		<button class="dropbtn"> Каталог 
		  <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  <a href="tires_pg.php">Шины</a>
		  <a href="electr_pg.php">Автоэлектроника</a>
		  <a href="other_pg.php">Прочее</a>
		</div>
	  </div> 
	 <a href="contacts_pg.php">Контакты</a>
	 <a href="about_pg.php">О нас</a>
	 <a href="regist.php">Регистрация</a>
	 <a href="cart_pg.php">Корзина</a>
	</div>
	
	<form action="auth_check.php" method=POST>
			<table id=form>
				<tr>
					<td>Почта</td>
					<td><input type=text name=email value=<?php echo $email ?>></td>
				</tr>
				<tr>
					<td>Пароль</td>
					<td><input type=password name=pass value=<?php echo $pass ?>></td>
				</tr>
				<tr>
					<td colspan=2><input type=submit value="Внести данные"></td>
					
				</tr>
			</table>
			
		</form>
	
	<div>
		<footer>
		<p>© 2023 Автозапчасти</p>
		</footer>
    </div>
 </body>
</html>