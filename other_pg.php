<?php
	session_start();

	if(isset($_GET['sort']))
	{
		$sort=$_GET['sort'];
		
		if($sort==1)
		{
			$s="ORDER BY tires_name";
		}
	
		if($sort==2)
		{
			$s="ORDER BY tires_name DESC";
		}
		
		if($sort==3)
		{
			$s="ORDER BY price";
		}
	
		if($sort==4)
		{
			$s="ORDER BY price DESC";
		}
		
		if($sort==5)
		{
			$s="ORDER BY quantity";
		}
	
		if($sort==6)
		{
			$s="ORDER BY quantity DESC";
		}
	}
	
	$des=mysqli_connect("localhost","root","root");
	mysqli_select_db($des,"products");
	mysqli_set_charset($des,"utf8");
?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Продажа автозапчастей</title>
  <link rel="stylesheet" href="other_pg.css">
  <script src="cart.js"></script>
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
		 echo "<a href=\"edit.php\">Редактор таблиц</a>";
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
	
	<button id="open-cart"><img id="open-cart-img" src="Pictures_for_site\cart\cart.png"></button>
	<div class="cart">
	  <span class="close">&times;</span>
	  <h2>Корзина</h2>
	  <ul id="cart-items">
	  </ul>
	  <p>Общая цена: <span id="total-price">0</span> руб.</p>
	  <button id="clcart" onclick="clearCart()">Очистить корзину</button>
	</div>
	
	<div class="sort">
		<div>Отсортировать по названию: <a href="other_pg.php?sort=1">↑</a> <a href="other_pg.php?sort=2">↓</a></div>
		<div>Отсортировать по цене: <a href="other_pg.php?sort=3">↑</a> <a href="other_pg.php?sort=4">↓</a></div>
		<div>Отсортировать по количеству: <a href="other_pg.php?sort=5">↑</a> <a href="other_pg.php?sort=6">↓</a></div>
		
		<div><a href="other_pg.php">Сбросить</a></div>
	</div>
	
	<?php
		$sql = mysqli_query($des, 'SELECT * FROM `other`'.$s);
		echo '<div class="product-feed">';
		
		while($result = mysqli_fetch_array($sql))
		{
			echo '<div class="product">';
			echo '<img src="Pictures_for_site\other\\'.$result['img_path'].'" onclick="showModal('.$result['id_other'].')">';
			echo '<h3 class="prod_nm" onclick="showModal('.$result['id_other'].')">'.$result['other_name'].' </h3>';
			echo '<h4 class=prod_price>'.'Цена: '.$result['price'].' руб.</h4>';
			//echo '<p>В наличии: '.$result['quantity'].' шт.</p>';
			echo '<button onclick="addToCart(\''.htmlspecialchars($result['other_name']).'\', '.$result['price'].')">В корзину</button>';
			echo '</div>';
			
			echo '<div id="'.$result['id_other'].'" class="modal">';
			echo '<div class="modal-content">';
			echo '<span class="close_modal" onclick="closeModal('.$result['id_other'].')">&times;</span>';
			echo '<img src="Pictures_for_site\other\\'.$result['img_path'].'">';
			echo '<h2>'.$result['other_name'].'</h2>';
			echo '<p>В наличии: '.$result['quantity'].'</p>';
			echo '<span>Цена: '.$result['price'].'</span><br>';
			echo '</div>';
			echo '</div>';
		}
		
		echo '</div>';
	?>
	
	<div>
		<footer>
		<p>© 2023 Автозапчасти</p>
		</footer>
    </div>
 </body>
</html>