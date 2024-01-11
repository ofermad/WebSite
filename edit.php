<?php
	session_start();

	if (isset($_GET['nm']))
	{
		$nm = $_GET['nm'];
	}
	
	if (isset($_GET['quantity']))
	{
		$quantity = $_GET['quantity'];
	}
	
	if (isset($_GET['price']))
	{
		$price = $_GET['price'];
	}
	
	if (isset($_GET['img_path']))
	{
		$price = $_GET['img_path'];
	}
	
	$des=mysqli_connect("localhost","root","root");
	mysqli_select_db($des,"products");
	mysqli_set_charset($des,"utf8");
	
	if (isset($_GET['table']))
	{
		$tb_name = $_GET['table'];
		
		$sql = mysqli_query($des, 'SELECT * FROM '.$tb_name.'');
	}
	else
	{
		$tb_name = "tires";
		
		$sql = mysqli_query($des, 'SELECT * FROM '.$tb_name.'');
	}
?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Продажа автозапчастей</title>
  <link rel="stylesheet" href="edit.css">
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
	 <?php
	 if (isset($_SESSION['authenticated_admin']) && $_SESSION['authenticated_admin'] === true) 
	 {
		 echo "<a href=\"logout.php\">Выйти</a>";
	 }
	 else if (isset($_SESSION['authenticated_user']) && $_SESSION['authenticated_user'] === true) 
	 {
		 echo "<a href=\"logout.php\">Выйти</a>";
	 }
	 else
	 {
		echo "<a href=\"auth.php\">Войти</a>";
		echo "<a href=\"regist.php\">Регистрация</a>";
	 }
	 ?>
	 <a href="cart_pg.php">Корзина</a>
	</div>
	
	<form class=tb_form method="GET" action="edit.php">
	  <label for="table">Выберите таблицу:</label>
	  <select name="table" id="table">
		<option value="tires">Шины</option>
		<option value="car_electronics">Автоэлектроника</option>
		<option value="other">Прочее</option>
	  </select>
	  <input type="submit" value="Показать таблицу">
	</form>
	
	
	<?php
		//echo "SELECT * FROM `tires` $s;";
		//$sql = mysqli_query($des, 'SELECT * FROM `tires`');
		echo '<table border=\"1\">';
		echo '<tr>';
		echo '<th>Название</th><th>Количество</th><th>Цена</th><th>Удаление</th><th>Изменить</th>';
		echo '</tr>';
		
		if ($tb_name == "tires")
		{
			$pr_nm = 'tires_name';
			$id = 'id_tires';
		}
		else if ($tb_name == "car_electronics")
		{
			$pr_nm = 'electr_name';
			$id = 'id_electr';
		}
		else if ($tb_name == "other")
		{
			$pr_nm = 'other_name';
			$id = 'id_other';
		}
		
		while($result = mysqli_fetch_array($sql))
		{
			echo '<tr>';
			
			echo '<td>';
			echo $result[$pr_nm];
			echo '</td>';
			
			echo '<td>';
			echo $result['quantity'];
			echo '</td>';
			
			echo '<td>';
			echo $result['price'];
			echo '</td>';
			
			echo '<td>';
			echo '<a href="delete.php?id='.$result[$id].'&tb_name='.$tb_name.'">Удалить</a>';
			echo '</td>';
			
			echo '<td>';
			echo '<a href="update.php?id='.$result[$id].'&tb_name='.$tb_name.'&pr_nm='.$result[$pr_nm].'&quantity='.$result['quantity'].'&price='.$result['price'].'&img_path='.$result['img_path'].'">Изменить</a>';
			echo '</td>';
			
			echo '</tr>';
		}
		
		echo '</table>';
	?>
	
	<h3>Добавить в таблицу</h3>
	<form action="insert.php" method=POST>
		<table id=form>
			<tr>
				<td><input type=hidden name=tb_nm value="<?php echo $tb_name;?>"></td>
			</tr>
			<tr>
				<td>Название</td>
				<td><input type=text name=nm value="<?php echo $nm;?>"></td>
			</tr>
			<tr>
				<td>Количество</td>
				<td><input type=text name=quantity value="<?php echo $quantity;?>"></td>
			</tr>
			<tr>
				<td>Цена</td>
				<td><input type=text name=price value="<?php echo $price;?>"></td>
			</tr>
			<tr>
				<td>Путь к картинке</td>
				<td><input type=text name=img_path value="<?php echo $img_path;?>"></td>
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