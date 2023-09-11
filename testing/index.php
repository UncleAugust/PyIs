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
$stmt = $conn->prepare("SELECT name, surname, access1, access2, access3, access4, access5, access6, access7, access8, admin FROM accounts WHERE vkid = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$name = $row['name'];
$surname = $row['surname'];
$accessfi = $row['access1'];
$accessse = $row['access2'];
$accessth = $row['access3'];
$accessfo = $row['access4'];
$accessfit = $row['access5'];
$accesssix = $row['access6'];
$accesssev = $row['access7'];
$accesseig = $row['access8'];
$admin = $row['admin'];
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
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Профиль</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">  <!-- Google web font "Open Sans" -->
	<link rel="stylesheet" href="css/fontawesome-all.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css"/>
	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
	<link rel="stylesheet" href="css/tooplate-style.css">

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
							<li>
								<a href="#profile" id="tmNavLink1" class="scrolly active" data-bg-img="constructive_bg_01.jpg" data-page="#tm-section-1">
									<i class="fas fa-home tm-nav-fa-icon"></i>
									<span>Профиль</span>
								</a>
							</li>					
							<li>
								<a href="#courses" id="tmNavLink2" class="scrolly" data-bg-img="constructive_bg_03.jpg" data-page="#tm-section-3">
									<i class="fas fa-users tm-nav-fa-icon"></i>
									<span>Все курсы</span>
								</a>
							</li>
							<?php if($admin==1){ ?>
							<li>
								<a href="#admin" class="scrolly" data-page="#tm-section-4">
									<i class="fas fa-user-secret tm-nav-fa-icon"></i>
									<span>Админка</span>
								</a>
							</li>
							<?php } ?>
						</ul>
					</nav>
				</div>

			</div>

			<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 tm-content">

					<!-- section 1 -->
					<section id="tm-section-1" class="tm-section">
						<div class="ml-auto">
							<header class="mb-4"><h1 class="tm-text-shadow"><?php echo $name . " " . $surname; ?></h1></header>
							<p class="mb-5 tm-font-big">UID: <?php echo $_SESSION['user_id']; ?></p>
							<a href="#" class="btn tm-btn tm-font-big" data-nav-link="#tmNavLink2">Дальше</a> 
						</div>
					</section>


					<section id="tm-section-3" class="tm-section">						
						<div class="row mb-4">
							<header class="col-xl-12"><h2 class="tm-text-shadow">Все этапы</h2></header>		
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-apple tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<a href="https://pyis.fun/testing/course-one/"><h3><?php if ((in_array(2, $results)) && (in_array(3, $results)) && (in_array(4, $results)) && (in_array(5, $results)) && (in_array(6, $results)) && (in_array(7, $results)) && (in_array(8, $results)) && (in_array(9, $results))){ echo "✅ ";} else {echo "🧑‍💻 ";} ?> Этап 1: Начало</h3></a>
										<p><?php if ($accessfi==1){ echo "😊 Этап доступен для прохождения! ";} else {echo "😑 Этап недоступен...  ";}?></p>	
									</div>
								</div>
							</div>	
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-linode mr-4 tm-icon-circled tm-icon-media"></i>	
									<div class="media-body">
										<h3>Этап 2</h3>
										<p><?php if ($accessse==1){ echo "😊 Этап доступен для прохождения! ";} else {echo "😑 Этап недоступен...  ";}?></p>
										<p><font color="#FF6400">Этап закрыт до: теория[2 этап]</font></p>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-linode mr-4 tm-icon-circled tm-icon-media"></i>	
									<div class="media-body">
										<h3>Этап 3</h3>
										<p><?php if ($accessth==1){ echo "😊 Этап доступен для прохождения! ";} else {echo "😑 Этап недоступен...  ";}?></p>
										<p><font color="#FF6400">Этап закрыт до: теория[3 этап]</font></p>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-linode mr-4 tm-icon-circled tm-icon-media"></i>	
									<div class="media-body">
										<h3>Этап 4</h3>
										<p><?php if ($accessfo==1){ echo "😊 Этап доступен для прохождения! ";} else {echo "😑 Этап недоступен...  ";}?></p>	
										<p><font color="#FF6400">Этап закрыт до: теория[4 этап]</font></p>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-linode mr-4 tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<h3>Этап 5</h3>
										<p><?php if ($accessfit==1){ echo "😊 Этап доступен для прохождения! ";} else {echo "😑 Этап недоступен...  ";}?></p>		
										<p><font color="#FF6400">Этап закрыт до: теория[5 этап]</font></p>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-linode mr-4 tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<h3>Этап 6</h3>
										<p><?php if ($accesssix==1){ echo "😊 Этап доступен для прохождения! ";} else {echo "😑 Этап недоступен...  ";}?></p>	
										<p><font color="#FF6400">Этап закрыт до: теория[6 этап]</font></p>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-linode mr-4 tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<h3>Этап 7</h3>
										<p><?php if ($accesssev==1){ echo "😊 Этап доступен для прохождения! ";} else {echo "😑 Этап недоступен...  ";}?></p>	
										<p><font color="#FF6400">Этап закрыт до: теория[7 этап]</font></p>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-linode mr-4 tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<h3>Этап 8</h3>
										<p><?php if ($accesseig==1){ echo "😊 Этап доступен для прохождения! ";} else {echo "😑 Этап недоступен...  ";}?></p>	
										<p><font color="#FF6400">Этап закрыт до: теория[8 этап]</font></p>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-linode mr-4 tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<h3>?</h3>
										<p>Временно недоступно (?)</p>	
									</div>
								</div>
							</div>
						</div>						               
					</section>

					<section id="tm-section-4" class="tm-section">						
						<div class="row mb-4">
							<header class="col-xl-12"><h2 class="tm-text-shadow">Все курсы</h2></header>		
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-apple tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<a href="https://pyis.fun/admin"><h3>Список пользователей (VKID, Name, Surname)</h3></a>
										<p>Тут можно посмотреть всех пользователей, вообще</p>	
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-apple tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<a href="https://pyis.fun/admin"><h3>Доступы к курсам</h3></a>
										<p>Добавить/Удалить курс</p>	
									</div>
								</div>
							</div> 
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-apple tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<a href="https://pyis.fun/admin"><h3>Добавить админа</h3></a>
										<p>Добавить нового админа на курс (нет смысла)</p>	
									</div>
								</div>
							</div> 
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-apple tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<a href="https://pyis.fun/admin"><h3>Логи</h3></a>
										<p>Что там нарешали/отправляли</p>	
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-apple tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<a href="https://pyis.fun/phpmyadmin"><h3>PHPMYADMIN</h3></a>
										<p>База данных (требуется доп. авторизация)</p>	
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mb-4">
								<div class="media tm-bg-transparent-black tm-border-white">
									<i class="fab fa-apple tm-icon-circled tm-icon-media"></i>
									<div class="media-body">
										<a href="https://pyis.fun/admin"><h3>Доступ к заданиям</h3></a>
										<p>Зачесть задание / Снять зачет с задания / Устроить тотальное обнуление [пользователю/всем]</p>	
									</div>
								</div>
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

		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
		<script type="text/javascript" src="slick/slick.min.js"></script> <!-- Slick Carousel -->

		<script>

		var sidebarVisible = false;
		var currentPageID = "#tm-section-1";

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
		     	var bgImg = $("#tmNavLink1").data("bgImg");
		     	
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