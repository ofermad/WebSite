<?php
	session_start();
?>
<html>
 <head>
  <meta charset="utf-8">
  <title>Продажа автозапчастей</title>
  <link rel="stylesheet" href="contacts_pg.css">
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
	
	<p class='main_text'>Если у вас возникли вопросы или вам нужна помощь с выбором автозапчастей, обращайтесь к нам! <br>
	Мы всегда рады помочь нашим клиентам и предоставить профессиональную консультацию.</p>
	
	<p class='main_text'>Наши контактные данные:<br>
	Телефон: +7 (XXX) XXX-XX-XX<br>
	E-mail: info@autoparts.com<br>
	Адрес: ул. Пушкина, дом 10, г. Москва</p>
	
	<p class='main_text'>Мы также доступны для общения в социальных сетях:<br>
	Telegram: @autopartsrus<br>
	Instagram: @autopartsrus</p>

	<p class='main_text'>Будем рады ответить на любые вопросы и помочь вам подобрать нужные запчасти для вашего автомобиля. Не стесняйтесь обращаться к нам!</p>
	
	<div>
		<footer>
		<p>© 2023 Автозапчасти</p>
		</footer>
    </div>
 </body>
</html>