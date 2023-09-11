<?php 

session_start();
// check if the user is authorized
if(session_status() == PHP_SESSION_ACTIVE) {
    if (isset($_SESSION['user_id'])) {
    } else {
        // user is not logged in, redirect to login page
        header('Location: https://pyis.fun/');
		exit;
    }
}
else{
	header('Location: https://pyis.fun/');
	exit;
}
$conn = new mysqli("localhost", "pyis", "9wAxegZQ8h!", "PyIs");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT access1 FROM accounts WHERE vkid = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$accessfi = $row['access1'];

$stmts = $conn->prepare("SELECT task FROM compleatetasks WHERE vkid = ? AND course = 1");
$stmts->bind_param("i", $_SESSION['user_id']);
$stmts->execute();
$stmts->bind_result($task);
$results = array();
while ($stmts->fetch()) {
    $results[] = $task;
}
// Close the connection
$conn->close();
if($accessfi != 1) {
	
	header('Location: https://pyis.fun/testing');
	exit;
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>pyis.fun | Этап 1</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">  <!-- Google web font "Open Sans" -->
	<link rel="stylesheet" href="css/fontawesome-all.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css"/>
	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
	<link rel="stylesheet" href="css/tooplate-style.css">
	<link rel="stylesheet" href="../lib/codemirror.css">
	<script src="../lib/codemirror.js"></script>
	<script src="../mode/python/python.js"></script>

	<script>
		var renderPage = true;
		if(navigator.userAgent.indexOf('MSIE')!==-1
			|| navigator.appVersion.indexOf('Trident/') > 0){
			/* Microsoft Internet Explorer detected in. */
			alert("Please view this in a modern browser such as Chrome or Microsoft Edge.");
			renderPage = false;
		}
	</script>
</head>

<body>
	<!-- Loader -->
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	
	<!-- Page Content -->
	<div class="container-fluid tm-main">
		<div class="row tm-main-row">

			<!-- Sidebar -->
			<div id="tmSideBar" class="col-xl-3 col-lg-4 col-md-12 col-sm-12 sidebar">

				<button id="tmMainNavToggle" class="menu-icon">&#9776;</button>

				<div class="inner">
					<nav id="tmMainNav" class="tm-main-nav">
						<ul>
							<?php if ((in_array(2, $results)) && (in_array(3, $results)) && (in_array(4, $results)) && (in_array(5, $results)) && (in_array(6, $results)) && (in_array(7, $results)) && (in_array(8, $results)) && (in_array(9, $results))){ ?>
							<li>
								<a href="#good_job" class="scrolly active" data-bg-img="bg_01.jpg" data-page="#good_job">
									<i class="fas fa-star tm-nav-fa-icon"></i>
									<span>Well done!</span>
								</a>
							</li>
							<?php } ?>
							<li>
								<a href="#task11" id="task111" class="scrolly active" data-bg-img="bg_01.jpg" data-page="#task11">
									<i class="fas fa-home tm-nav-fa-icon"></i>
									<span><?php if(in_array(1, $results)) echo "✅";?> Проверка</span>
								</a>
							</li>								
							<li>
								<a href="#task12" class="scrolly" data-bg-img="bg_03.jpg" data-page="#task12">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span><?php if(in_array(2, $results)) echo "✅";?> Твиттер</span>
								</a>
							</li>
							<li>
								<a href="#task13" class="scrolly" data-bg-img="bg_04.jpg" data-page="#task13">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span><?php if(in_array(3, $results)) echo "✅";?> Нумерология</span>
								</a>
							</li>
							<li>
								<a href="#task14" class="scrolly" data-bg-img="bg_05.jpg" data-page="#task14">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span><?php if(in_array(4, $results)) echo "✅";?> Новый менеджер</span>
								</a>
							</li>
							<li>
								<a href="#task15" class="scrolly" data-bg-img="bg_06.jpg" data-page="#task15">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span><?php if(in_array(5, $results)) echo "✅";?> Все серьезно: Логика[1]</span>
								</a>
							</li>
							<li>
								<a href="#task16" class="scrolly" data-bg-img="bg_07.jpg" data-page="#task16">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span><?php if(in_array(6, $results)) echo "✅";?> Все серьезно: Логика[2]</span>
								</a>
							</li>
							<li>
								<a href="#task17" class="scrolly" data-bg-img="bg_08.jpg" data-page="#task17">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span><?php if(in_array(7, $results)) echo "✅";?> Все серьезно: Логика[3]</span>
								</a>
							</li>
							<li>
								<a href="#task18" class="scrolly" data-bg-img="bg_09.jpg" data-page="#task18">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span><?php if(in_array(8, $results)) echo "✅";?> Первое знакомство с УБ</span>
								</a>
							</li>
							<li>
								<a href="#task19" class="scrolly" data-bg-img="bg_10.jpg" data-page="#task19">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span><?php if(in_array(9, $results)) echo "✅";?> Русский язык</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>

			</div>

			<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 tm-content">

					<!-- Task 1 -->
					<section id="good_job" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Этап 1 полностью завершен. ✅</h2></header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>Поздравляю! Ты завершил 1 этап - сдал все задачи. Поделишься эмоциями? 🤔<br>Как факт, все арты сделаны с помощью ИИ: Midjourney. Для каждой задачи - индивидуально.🖌️</p>
									</div>
								</div>
								
							</div>
						</div>
					</section>
					<section id="task11" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Проверка</h2></header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>Смысл задания в проверке работоспособности функций и понимания как все работает! Дано значение A, которое вводится пользователем. Необходимо значение 2*A.</p>
										<p><b>Пример. Ввод: 3. Вывод: 6</b></p>
									</div>
								</div>
								<?php if (in_array(1, $results)){ ?>
								<font color="#00B64F"><p><b>Твой последний код успешно прошел проверку<br>Если ничего не изменилось и зеленая надпись осталась, значит и этот код проверку прошел<br>Если хочешь выполнить проверку еще раз введи код:<br>a=int(input())
<br>print(2*a)</b></p></font>
								<?php } ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code.php" method="post">
											  <textarea id="code-editor1" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								
							</div>
						</div>
					</section>	


					<!-- Task 2 -->
					<section id="task12" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Твиттер</h2></header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>После того как Илон Маск купил твиттер, он ввел специфическую систему KPI. Для расчета KPI он использовал определенную формулу:</p>
<img src="img/kpi1.png" alt="тут понятно, что 90% будет уволено по этой формуле">
<p>Где:
    <br>x представляет собой количество успешных проектов, завершенных отделом
    <br>y - общий доход, полученный отделом
    <br>h - количество часов, отработанных отделом
    <br>l - количество сотрудников в отделе
    <br>g - количество целей, поставленных перед отделом и достигнутых.
<br>Подставляя значения x, y, h, l и g, каждый сотрудник может рассчитать KPI для отдела и определить его общую эффективность. 30 ноября каждый сотрудник решил посчитать свой KPI и определить через сколько дней он сможет расстаться с корпоративным мерседесом, личным водителем, и мемов в рабочем чате. Составьте программу, которая сможет посчитать KPI для каждого сотрудника. 
</p>

										<p><b>Пример:<br>
INPUT:<br> 
5<br>
100000<br>
2000<br>
10<br>
4<br><br>
OUTPUT:<br>
0.03560114074582641</b></p>
									</div>
								</div>
								<?php if (in_array(2, $results)){ ?>
								<font color="#00B64F"><p><b>Ты успешно выполнил задачу 2, 1-го этапа!<br>К сожалению, сдать повторно не получится, но позже в других задачах ты сможешь увидеть похожее</b></p></font>
								<?php }else{ ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code2.php" method="post">
											  <textarea id="code-editor2" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>
					<!-- Task 3 -->
					<section id="task13" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Нумерология</h2></header>
								</div>
							</div>
							
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>Ваш восхитительный топ-менеджмент, который активизируется для новых идей лишь через 100 дней c нового года, решил заняться нумерологией и предсказать какое событие будет в этот день в зависимости от метода и цифры. Для этого они решили сделать анализ каким методом это будет лучше сделать.<br>
1 метод – Последняя цифра, просто потому что она последняя и может это не спроста, что в слове «семнадцать» последняя цифра 7.<br>
2 метод – Число десятков. По аналогичному принципу, только с 10-ками.<br>
3 метод – Сумма цифр, просто потому что кто-то очень сильно хотел доказать, что раз число «сто» имеет сумму цифр 1, а «сто два» имеет уже 3, то в этом явно есть смысл.<br>
Ваша задача состоит в том, чтобы по входному дню, дать 3 ответа по 3 разным методам.<br>
</p>
										<p><b>Пример<br>INPUT:<br>
101<br>
OUTPUT:<br>
1 0 2</b></p>
									</div>
								</div>
								<?php if (in_array(3, $results)){ ?>
								<font color="#00B64F"><p><b>Ты успешно выполнил задачу 3, 1-го этапа!<br>К сожалению, сдать повторно не получится, но позже в других задачах ты сможешь увидеть похожее</b></p></font>
								<?php }else{ ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code3.php" method="post">
											  <textarea id="code-editor3" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>
					<!-- Task 4 -->
					<section id="task14" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Новый менеджер</h2></header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>В компании создан новый отдел, который выполняет функции по повышению эффективности других отделов и менеджмента. В связи с новым курсом компании, который говорит, что компания будет использовать элементы эзотерики, был нанят соответствующий руководитель отдела. Он предложил новую формулу KPI эффективности сотрудников.</p>
<img src="img/kpi2.png" alt="др у шефа 30 числа, поэтому он самый эффективный"><p>
Подставляя значения: Знак зодиака, День рождения, Время сколько работал сотрудник в офисе, Улица, Дом, $ заработал отдел, сколько целей выполнил сотрудник, каждый сотрудник может рассчитать KPI для отдела и определить его общую эффективность. <br>30 ноября каждый сотрудник решил посчитать свой KPI и определить через сколько дней его уволят. Составьте программу, которая поможет рассчитать всем их KPI.<br>

</p>
										<p><b>Пример<br>
										INPUT:<br>
Козерог<br>
30<br>
1000<br>
Ходынский бульвар<br>
5<br>
5000000<br>
3<br><br>OUTPUT:<br>0.008166666666666666</b></p>
									</div>
								</div>
								<?php if (in_array(4, $results)){ ?>
								<font color="#00B64F"><p><b>Ты успешно выполнил задачу 4, 1-го этапа!<br>К сожалению, сдать повторно не получится, но позже в других задачах ты сможешь увидеть похожее</b></p></font>
								<?php }else{ ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code4.php" method="post">
											  <textarea id="code-editor4" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>
					<!-- Task 5 -->
					<section id="task15" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Все серьезно: Логика[1]</h2></header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>А вот теперь без шуток, пошла чистая логика.<br>Расставьте скобки в выражении ниже в соответствии с порядком вычисления выражения (приоритетом операций).</p><p><b><code class="hljs llvm">a and b or not a and not b</code></b></p><p>Подсказка: Пять операторов, пять пар скобок. Обозначить выполнение каждого оператора скобками (то есть, поставить с каждой стороны от оператора скобки  заключив в них ближайшие операнды) таким образом что бы выражение выполнилось так же как и без скобок.</p>
										<p><b><br>Напоминалка: первым выполняется not, вторым and , третьим or.<br>
Операторы бывают бинарными и унарными.  and и  or - бинарные.  not - унарный. При использовании бинарного оператора операнды записываются перед и после (справа и слева) оператора. При использовании  унарного оператора операнд записывается после оператора (справа от оператора).</b></p>
									</div>
								</div>
								<?php if (in_array(5, $results)){ ?>
								<font color="#00B64F"><p><b>Ты успешно выполнил задачу 5, 1-го этапа!<br>К сожалению, сдать повторно не получится, но позже в других задачах ты сможешь увидеть похожее</b></p></font>
								<?php }else{ ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code5.php" method="post">
											  <textarea id="code-editor5" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>
					<!-- Task 6 -->
					<section id="task16" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Все серьезно: Логика[2]</h2></header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>Код ниже вставьте в IDE/iPython и выполните его. В поле ответа вставьте результат вычисления.<br>Небольшая просьба, постарайтесь понять, почему интерпретатор выдал именно такой ответ (вставлять в поле ввода это не нужно). Если не можете разобраться напишите мне в личку в ВК - подскажу, если же хотите разобраться сами, то пересмотрите занятие еще раз.<br> Помните, что любые арифметические операции выше по приоритету операций сравнения и логических операторов.
Помните, что в Python логические значения пишутся с большой буквы: <code class="hljs llvm">True</code>, <code class="hljs llvm">False</code>.</p>
										<p><code class="hljs llvm">x = 5<br>y = 10<br>y > x * x or y >= 2 * x and x < y</code></p>
									</div>
								</div>
								<?php if (in_array(6, $results)){ ?>
								<font color="#00B64F"><p><b>Ты успешно выполнил задачу 6, 1-го этапа!<br>К сожалению, сдать повторно не получится, но позже в других задачах ты сможешь увидеть похожее</b></p></font>
								<?php }else{ ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code6.php" method="post">
											  <textarea id="code-editor6" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>
					<!-- Task 7 -->
					<section id="task17" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Все серьезно: Логика[3]</h2></header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>С логикой практически закончено, last one!<br></p><p>Найдите результат выражения для заданных значений a и b. Учитывайте регистр символов при ответе.<br>
<code class="hljs llvm"><br>a = True<br>b = False<br>a and b or not a and not b</code></p>
									</div>
								</div>
								<?php if (in_array(7, $results)){ ?>
								<font color="#00B64F"><p><b>Ты успешно выполнил задачу 7, 1-го этапа!<br>К сожалению, сдать повторно не получится, но позже в других задачах ты сможешь увидеть похожее</b></p></font>
								<?php }else{ ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code7.php" method="post">
											  <textarea id="code-editor7" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>
					<!-- Task 8 -->
					<section id="task18" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow"></h2>Первое знакомство с УБ</header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>Абитуриентов УБ привели в бар. Каждый выпил по несколько пинты пива. Потом их попросили встать в ряд, чтобы обозначить кто выпил больше всех, меньше всех, а потом остальных. Для примера возьмем трех абитуриентов, которое выпили целое число пинт пива. Составьте код для вычисления рейтинг выпитых пинт пива тремя абитуриентами. Ответ выведите в формате: Наибольшее, наименьшее, остальное.<br>Пожалуйста, при решении не используйте: .sort() / sorted() / списки (массивы). Только IF только хардкор!</p>
										<p><b>Пример<br>INPUT:<br>
8<br>
2<br>
14<br>
OUTPUT:<br>
14 2 8
</b></p>
									</div>
								</div>
								<?php if (in_array(8, $results)){ ?>
								<font color="#00B64F"><p><b>Ты успешно выполнил задачу 9, 1-го этапа!<br>К сожалению, сдать повторно не получится, но позже в других задачах ты сможешь увидеть похожее</b></p></font>
								<?php }else{ ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code8.php" method="post">
											  <textarea id="code-editor8" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>
					<!-- Task 9 -->
					<section id="task19" class="tm-section">
						<div class="tm-bg-transparent-black tm-contact-box-pad">
							<div class="row mb-4">
								<div class="col-sm-12">
									<header><h2 class="tm-text-shadow">Русский язык</h2></header>
								</div>
							</div>
							<div class="row tm-page-4-content">
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="tm-address-box">
										<p>Отступление: Я обожаю русский язык, но порой его не очень-то сильно люблю. Так в нем есть окончания: нулевое, «-а», «-ов» и чаще всего они применяются к числительным. 685 менеджеров; 681 менеджер; 682 менеджера.</p>
<p>Представим, что в бар заходит андроид и считает сколько собралось менеджеров в баре. После расчета он садится и оглашает результат: в комнате «682 менеджер», это ужасно портит слух. Поэтому составьте код, который поможет его не портить и корректно говорить сколько менеджеров в баре.</p>
										<p><b>INPUT:<br>
5 <br>
OUTPUT:<br>
5 менеджеров<br>
INPUT: <br>
1 <br>
OUTPUT:<br>
1 менеджер<br>
INPUT:<br>
2<br>
OUTPUT:<br>
2 менеджера</b></p>
									</div>
								</div>
								<?php if (in_array(9, $results)){ ?>
								<font color="#00B64F"><p><b>Ты успешно выполнил задачу 10, 1-го этапа!<br>К сожалению, сдать повторно не получится, но позже в других задачах ты сможешь увидеть похожее</b></p></font>
								<?php }else{ ?>
								<div class="col-md-12 col-sm-24 tm-contact-col">
									<div class="contact_message">
										<form action="test_code9.php" method="post">
											  <textarea id="code-editor9" name="code" rows="20" cols="50"></textarea>
											  <br>
											  <button type="submit" class="btn tm-btn-submit tm-btn ml-auto">Submit</button>
										</form>
									
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>								
				</div>	
			</div>	<!-- row -->			
		</div>
		<div id="preload-01"></div>
		<div id="preload-02"></div>
		<div id="preload-03"></div>
		<div id="preload-04"></div>
		<div id="preload-05"></div>
		<div id="preload-06"></div>
		<div id="preload-07"></div>
		<div id="preload-08"></div>
		<div id="preload-09"></div>
		<div id="preload-10"></div>
		
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
		<script type="text/javascript" src="slick/slick.min.js"></script> <!-- Slick Carousel -->

		<script>

		var sidebarVisible = false;
		var currentPageID = "#task11";
		
		var editor = CodeMirror.fromTextArea(document.getElementById("code-editor1"), {
			lineNumbers: true,
			mode: "python"
		});
		
		if (document.getElementById("code-editor2")) {
			var editor = CodeMirror.fromTextArea(document.getElementById("code-editor2"), {
				lineNumbers: true,
				mode: "python"
			});
		}
		if (document.getElementById("code-editor3")) {
			var editor = CodeMirror.fromTextArea(document.getElementById("code-editor3"), {
				lineNumbers: true,
				mode: "python"
			});
		}
		if (document.getElementById("code-editor4")) {
			var editor = CodeMirror.fromTextArea(document.getElementById("code-editor4"), {
				lineNumbers: true,
				mode: "python"
			});
		}
		if (document.getElementById("code-editor5")) {
			var editor = CodeMirror.fromTextArea(document.getElementById("code-editor5"), {
				lineNumbers: true,
				mode: "python"
			});
		}
		if (document.getElementById("code-editor6")) {
			var editor = CodeMirror.fromTextArea(document.getElementById("code-editor6"), {
				lineNumbers: true,
				mode: "python"
			});
		}
		if (document.getElementById("code-editor7")) {
			var editor = CodeMirror.fromTextArea(document.getElementById("code-editor7"), {
				lineNumbers: true,
				mode: "python"
			});
		}
		if (document.getElementById("code-editor8")) {
			var editor = CodeMirror.fromTextArea(document.getElementById("code-editor8"), {
				lineNumbers: true,
				mode: "python"
			});
		}
		if (document.getElementById("code-editor9")) {
			var editor = CodeMirror.fromTextArea(document.getElementById("code-editor9"), {
				lineNumbers: true,
				mode: "python"
			});
		}
		// Setup Carousel
		function setupCarousel() {

			// If current page isn't Carousel page, don't do anything.
			if($('#tm-section-2').css('display') == "none") {
			}
			else {	// If current page is Carousel page, set up the Carousel.

				var slider = $('.tm-img-slider');
				var windowWidth = $(window).width();

				if (slider.hasClass('slick-initialized')) {
					slider.slick('destroy');
				}

				if(windowWidth < 640) {
					slider.slick({
	              		dots: true,
	              		infinite: false,
	              		slidesToShow: 1,
	              		slidesToScroll: 1
	              	});
				}
				else if(windowWidth < 992) {
					slider.slick({
	              		dots: true,
	              		infinite: false,
	              		slidesToShow: 2,
	              		slidesToScroll: 1
	              	});
				}
				else {
					// Slick carousel
	              	slider.slick({
	              		dots: true,
	              		infinite: false,
	              		slidesToShow: 3,
	              		slidesToScroll: 2
	              	});
				}

				// Init Magnific Popup
				$('.tm-img-slider').magnificPopup({
				  delegate: 'a', // child items selector, by clicking on it popup will open
				  type: 'image',
				  gallery: {enabled:true}
				  // other options
				});
      		}
  		}

  		// Setup Nav
  		function setupNav() {
  			// Add Event Listener to each Nav item
	     	$(".tm-main-nav a").click(function(e){
	     		e.preventDefault();
		    	
		    	var currentNavItem = $(this);
		    	changePage(currentNavItem);
		    	
		    	setupCarousel();
		    	setupFooter();

		    	// Hide the nav on mobile
		    	$("#tmSideBar").removeClass("show");
		    });	    
  		}

  		function changePage(currentNavItem) {
  			// Update Nav items
  			$(".tm-main-nav a").removeClass("active");
     		currentNavItem.addClass("active");

	    	$(currentPageID).hide();

	    	// Show current page
	    	currentPageID = currentNavItem.data("page");
	    	$(currentPageID).fadeIn(1000);

	    	// Change background image
	    	var bgImg = currentNavItem.data("bgImg");
	    	$.backstretch("img/" + bgImg);		    	
  		}

  		// Setup Nav Toggle Button
  		function setupNavToggle() {

			$("#tmMainNavToggle").on("click", function(){
				$(".sidebar").toggleClass("show");
			});
  		}

  		// If there is enough room, stick the footer at the bottom of page content.
  		// If not, place it after the page content
  		function setupFooter() {
  			
  			var padding = 100;
  			var footerPadding = 40;
  			var mainContent = $("section"+currentPageID);
  			var mainContentHeight = mainContent.outerHeight(true);
  			var footer = $(".footer-link");
  			var footerHeight = footer.outerHeight(true);
  			var totalPageHeight = mainContentHeight + footerHeight + footerPadding + padding;
  			var windowHeight = $(window).height();		

  			if(totalPageHeight > windowHeight){
  				$(".tm-content").css("margin-bottom", footerHeight + footerPadding + "px");
  				footer.css("bottom", footerHeight + "px");  			
  			}
  			else {
  				$(".tm-content").css("margin-bottom", "0");
  				footer.css("bottom", "20px");  				
  			}  			
  		}

  		// Everything is loaded including images.
      	$(window).on("load", function(){

      		// Render the page on modern browser only.
      		if(renderPage) {
				// Remove loader
		      	$('body').addClass('loaded');

		      	// Page transition
		      	var allPages = $(".tm-section");

		      	// Handle click of "Continue", which changes to next page
		      	// The link contains data-nav-link attribute, which holds the nav item ID
		      	// Nav item ID is then used to access and trigger click on the corresponding nav item
		      	var linkToAnotherPage = $("a.tm-btn[data-nav-link]");
			    
			    if(linkToAnotherPage != null) {
			    	
			    	linkToAnotherPage.on("click", function(){
			    		var navItemToHighlight = linkToAnotherPage.data("navLink");
			    		$("a" + navItemToHighlight).click();
			    	});
			    }
		      	
		      	// Hide all pages
		      	allPages.hide();

		      	$("#tm-section-1").fadeIn();

		     	// Set up background first page
		     	var bgImg = $("#task111").data("bgImg");
		     	
		     	$.backstretch("img/" + bgImg, {fade: 500});

		     	// Setup Carousel, Nav, and Nav Toggle
			    setupCarousel();
			    setupNav();
			    setupNavToggle();
			    setupFooter();

			    // Resize Carousel upon window resize
			    $(window).resize(function() {
			    	setupCarousel();
			    	setupFooter();
			    });
      		}	      	
		});

		</script>
	</body>
</html>