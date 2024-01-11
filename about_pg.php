<?php
	session_start();
?>
<html>
 <head>
  <meta charset="utf-8">
  <title>Продажа автозапчастей</title>
  <link rel="stylesheet" href="about_pg.css">
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
	
	<h1 class='title'>Добро пожаловать в наш магазин автозапчастей!</h1>
	
	<p class='main_text'>Мы - команда профессионалов, специализирующихся на предоставлении качественных запчастей для Вашего автомобиля. 
	Наша цель - обеспечить Вас надежными деталями и высоким уровнем обслуживания.</p>
	
	<p class='main_text'>У нас Вы найдете широкий ассортимент автозапчастей от ведущих производителей по доступным ценам. 
	Мы работаем напрямую с поставщиками, чтобы гарантировать подлинность и качество каждой запчасти.</p>
	
	<p class='main_text'>Наша команда всегда готова помочь Вам подобрать правильные запчасти и предоставить компетентные консультации по любым вопросам.</p>
	
	<p class='main_text'>Мы стремимся к тому, чтобы Ваш опыт покупок у нас был удовлетворительным, 
	и мы работаем над тем, чтобы стать Вашим надежным партнером в обеспечении автозапчастями.</p>
	
	<p class='end'><b>С уважением,<br>
	Команда магазина автозапчастей</b></p>
	
	<div>
		<footer>
		<p>© 2023 Автозапчасти</p>
		</footer>
    </div>
 </body>
</html>