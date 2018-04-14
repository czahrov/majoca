<?php
	require_once __DIR__ . "/config.php";
	
	$price = 109;
	
	if( !empty( $_POST ) ){
		require_once __DIR__ . "/php/PHPMailerAutoload.php";
		
		$ID = time();
		$mailer = new PHPMailer();
		$mailer->Encoding = 'base64';
		$mailer->CharSet = 'utf8';
		$mailer->setLanguage( 'pl' );
		
		$mailer->setFrom( "noreply@{$_SERVER['SERVER_NAME']}", 'majoca.pl' );
		
		if( DMODE ){
			$mailer->addAddress( 'sprytne@scepter.pl' );
		}
		else{
			$mailer->addAddress( "{$_POST['email']}" );
			$mailer->addAddress( "babymajoca@gmail.com" );
		}
		$mailer->Subject = sprintf(
			'Zamówienie [%u], %s %s',
			$ID,
			$_POST['imie'],
			$_POST['nazwisko']
			
		);
		$mailer->Body = sprintf(
'Zamawiający
---
Imię: %s
Nazwisko: %s
Adres: %s %s, %s %s

Dane kontaktowe
---
Telefon: %s
Email: %s

Produkt
---
Kolor: %s
Cena: %.2f

---
Wiadomość wygenerowana automatycznie na stronie %s',
			$_POST['imie'],
			$_POST['nazwisko'],
			$_POST['ulica'],
			$_POST['budynek'],
			$_POST['kod'],
			$_POST['miejscowosc'],
			$_POST['telefon'],
			$_POST['email'],
			$_POST['kolor'],
			$price,
			URI
			
		);
		
		if( DMODE ){
			echo "<!--{$mailer->Body}-->";
			
		}
		
		$result = new stdClass();
			
		if( $mailer->send() ){
			unset( $_POST );
			$result->status = 'ok';
			$result->msg = 'Wiadomość wysłana pomyślnie';
			
		}
		else{
			$result->status = 'err';
			$result->msg = "Nie udało się wysłać wiadomości";
			
		}
		
	}
	
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>MaJoCa Dla rodziców nowoczesnych i stylowych oraz dbających o komfortową przestrzeń swojego dziecka</title>
		<!-- Bootstrap core CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom fonts for this template -->
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
		<!-- Plugin CSS -->
		<link rel="stylesheet" href="device-mockups/device-mockups.min.css">
		<!-- Custom styles for this template -->
		<link href="css/majoca.css" rel="stylesheet">
		<link href="css/override.css" rel="stylesheet">
	</head>
	<body id="page-top">
		<div id='popup' class="">
			<div class='box'>
				<div class='close'>x</div>
				<div class='title'>
					<div class='bold'>
						Dobry wybór!
					</div>
					<div class=''>
						Po wypełnieniu formularz wyślemy do Ciebie informację o Twoim zamówieniu
					</div>
				</div>
				<div class='body'>
					<form id='form' method='post'>
						<div class='bold'>
							Twoje dane
						</div>
						<input class='' type='text' name='imie' placeholder='Imię' required>
						<input class='' type='text' name='nazwisko' placeholder='Nazwisko' required>
						<input class='' type='mail' name='email' placeholder='Adres e-mail' pattern='^[^@]+@[^\.]+\..+$' title='login@domena' required>
						<input class='' type='tel' name='telefon' placeholder='Numer telefonu' pattern='^\d[\d ]+$' title='cyfry i spacje' required>
						<input class='' type='text' name='miejscowosc' placeholder='Miejscowość' required>
						<input class='' type='text' name='kod' placeholder='Kod pocztowy' pattern='^\d{2}-\d{3}$' title='np: 23-456' required>
						<input class='' type='text' name='ulica' placeholder='Ulica' required>
						<input class='' type='text' name='budynek' placeholder='Numer budynku' required>
						
						<div class='bold'>
							Informacje o produkcie
						</div>
						<select name='kolor' required>
							<option disabled selected>wybierz kolor</option>
							<option description='92% mikromodal 8%, elastan Micromodal'>Deep navy</option>
							<option description='92% wiskoza, 8% elastan'>Navy sailor</option>
							<option description='92% wiskoza, 8% elastan'>Black and white</option>
							<option description='92% wiskoza, 8% elastan'>Pink rose</option>
							<option description='92% mikromodal 8%, elastan Micromodal'>Strong white</option>
							
						</select>
						<div class='description'>---</div>
						
						<button type='submit' class='bold'>
							Zamów produkt
						</button>
						
					</form>
					
				</div>
			</div>
		</div>
		<?php if( isset( $result ) ): ?>
		<div id='notify' class='<?php echo $result->status; ?>'>
			<?php echo $result->msg; ?>
		</div>
		<?php endif; ?>
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="#page-top"></a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fa fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#zamow">Zamów produkt</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#o-produkcie">O produkcie</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#zastosowanie">Zastosowanie</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#kontakt">Kontakt</a>
						</li>
						<li class="nav-item">
							<a href="https://www.facebook.com/babymajoca"><span class="fb-menu"></span></a>
						</li>
						<li class="nav-item">
							<a href="https://www.instagram.com/babymajoca"><span class="insta-menu"></span></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<header class="masthead" id="zamow">
			<div class="circle-pink"></div>
			<div class="container h-100">
				<div class="row h-100">
					<div class="col-lg-7 my-auto">
						<div class="header-content">
							<h1 class="promo">Chusta MaJoCa</h1>
							<h2 class="promo">
								Dla rodziców nowoczesnych, stylowych oraz dbających o komfortową przestrzeń swojego dziecka
							</h2>
							<h1 class="promo price">
								<?php printf( '%.2f', $price ); ?>
							</h2>
							<a href="#order" class="btn btn-outline btn-xl">Zamów produkt</a>
						</div>
					</div>
					<div class="col-lg-5 my-auto" id='slider'>
						<div class='nav'>
							<div class='icon up'>
								<div class='fa fa-arrow-circle-o-up'></div>
							</div>
							<div class='icon down'>
								<div class='fa fa-arrow-circle-o-down'></div>
							</div>
							
						</div>
						<div class="circle-white">
						</div>
						<div class='view'>
							<?php
								$files = glob( "img/slider/*.*" );
								// print_r( $files );
								foreach( $files as $slide ):
								 ?>
							<div class="item product-img" style="background-image: url( <?php echo $slide; ?> );"></div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</header>
		<section class="features" id="o-produkcie">
			<div class="white-bg"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-7 ">
						<div class="header-content">
							<h2 class="section-heading">O produkcie</h2>
							<ul class="about-majoca">
								<li><span class="dot"></span>Posiada właściwości termoregulacyjne</li>
								<li><span class="dot"></span>Chroni przed chłodem, a nie przegrzewa w upały</li>
								<li><span class="dot"></span>Jest przewiewna i oddychająca</li>
								<li><span class="dot"></span>Dobrze absorbuje wilgoć</li>
								<li><span class="dot"></span>Jest elastyczna, dopasowuje się do każdego kształtu</li>
								<li><span class="dot"></span>Wykonana jest z najwyższej jakości dzianiny 
									przyjaznej dla dziecka oraz środowiska
								</li>
							</ul>
							<p>Chusta MaJoCa została stworzona 
								z myślą o macierzyństwie funkcjonalnym. 
								Wierzymy, że produkt ten spełni oczekiwania 
								najbardziej wymagających rodziców.
							</p>
							<a href="#kontakt" class="btn btn-outline btn-xl js-scroll-trigger">Skontaktuj się!</a>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="bg-image"></div>
						<div class="bg-ping">
							<div class="product-value">
								<div class="col-lg-12 my-auto">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-6">
												<div class="feature-item">
													<i class="icon-miekka text-primary"></i>
													<h3>Miękka</h3>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="feature-item">
													<i class="icon-odkrywajaca text-primary"></i>
													<h3>Okrywająca</h3>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<div class="feature-item">
													<i class="icon-rozciagliwa text-primary"></i>
													<h3>Rozciągliwa</h3>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="feature-item">
													<i class="icon-oddychajaca text-primary"></i>
													<h3>Oddychająca</h3>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="how-to-use" id="zastosowanie">
			<div class="container">
				<div class="col-lg-12 my-auto">
					<h2 class="section-heading">Jak używać Chusty MaJoCa</h2>
					<div class="white-space"></div>
					<div class="row">
						<div class="col-lg-4 bordered-padding d-flex justify-content-center">
							<div class="feature-item">
								<i class="karmienie text-primary"></i>
								<h3>Karmienie</h3>
							</div>
						</div>
						<div class="col-lg-4 d-flex bordered-top justify-content-center">
							<div class="feature-item">
								<i class="wozek-sklepowy text-primary"></i>
								<h3>Wózek sklepowy</h3>
							</div>
						</div>
						<div class="col-lg-4 bordered-padding d-flex justify-content-center">
							<div class="feature-item">
								<i class="hustawka text-primary"></i>
								<h3>Huśtawka</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 bordered-left d-flex justify-content-center">
							<div class="feature-item">
								<i class="nosidelko text-primary"></i>
								<h3>Nosidełko<br> samochodowe</h3>
							</div>
						</div>
						<div class="col-lg-4 bordered-padding d-flex justify-content-center">
							<div class="feature-item">
								<i class="wozek text-primary"></i>
								<h3>Wózek</h3>
							</div>
						</div>
						<div class="col-lg-4  bordered-right d-flex justify-content-center">
							<div class="feature-item">
								<i class="krzeselko text-primary"></i>
								<h3>Krzesełko<br> do karmienia</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section  id="kontakt"></section>
		<section class="cta">
			<div class="cta-content">
				<div class="contact-info ml-auto">
					<div class="container">
						<h3>Masz pytania?<span> Napisz lub zadzwoń</span></h3>
						<p>e-mail: babymajoca@gmail.com</p>
						<p>tel.: +48 530-180-420</p>
						<div class="social-media">
							<a href="https://www.facebook.com/babymajoca"><span class="fb"></span></a>
							<a href="https://www.instagram.com/babymajoca"><span class="insta"></span></a>
						</div>
						<a href="#order" class="btn btn-outline btn-xl">Zamów produkt</a>
					</div>
				</div>
			</div>
			<div class="overlay"></div>
		</section>
		<footer>
			<div class="container foot-content">
				<p>Używając chusty MaJoCa nigdy nie zostawiaj dziecka bez nadzoru.
					Otulając dziecko,pamiętaj o zapewnieniu mu dostępu do świeżego powietrza. 
				</p>
				<div class="white-space-small"></div>
				<p><i class="pl"></i>Produkt polski</p>
			</div>
			<div class="copy">
				<div class="container  d-flex flex-wrap">
					<div class="mr-auto">
						<p>&copy; MaJoCa 2018 Joanna Grzyb</p>
					</div>
					<div class="ml-auto">
						<p>Projekt i realizacja: <a href="http://www.scepter.pl">Scepter Agencja interaktywna</a></p>
					</div>
				</div>
			</div>
		</footer>
		<!-- Bootstrap core JavaScript -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Plugin JavaScript -->
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
		<!-- Custom scripts for this template -->
		<script src="js/new-age.min.js"></script>
		<script src="js/CSSPlugin.min.js"></script>
		<script src="js/TweenLite.min.js"></script>
		<script src="js/TimelineLite.min.js"></script>
		<script src="js/jquery.touchSwipe.min.js"></script>
		<script src="js/slider.min.js"></script>
		<script src="js/popup.min.js"></script>
		<script src="js/notify.min.js"></script>
		<!--
			<?php echo URL . PHP_EOL; ?>
			<?php echo URI . PHP_EOL; ?>
			-->
	</body>
</html>