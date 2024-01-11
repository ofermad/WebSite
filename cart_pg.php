<?php
	session_start();
?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Продажа автозапчастей</title>
  <link rel="stylesheet" href="cart_pg.css">
  <script src="cart_pg.js"></script>
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
	
	<div class="cart">
	  <h2>Корзина</h2>
	  <ul id="cart-items">
	  </ul>
	  <p>Общая цена: <span id="total-price">0</span> руб.</p>
	  <button id="clcart" onclick="clearCart()">Очистить корзину</button>
	</div>
	
	<div>
		<footer>
		<p>© 2023 Автозапчасти</p>
		</footer>
    </div>
 </body>
</html>