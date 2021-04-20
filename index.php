<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/estilos.css">
	<title>Autos</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/logodw.ico">
</head>
<body>
	<header>
	<?php include_once("menu.php"); ?>
	</header>

	<section class="main">
		<div class="container">
			<!-- Slider / Carousel -->
			<div class="row">
				<div class="col-md-12">
					<div id="slider" class="carousel slide" data-ride="carousel">
						<!-- Indicadores de posicion -->
						<ol class="carousel-indicators">
							<li data-target="#slider" data-slide-to="0" class="active"></li>
							<li data-target="#slider" data-slide-to="1"></li>
							<li data-target="#slider" data-slide-to="2"></li>
						</ol>
						
						<!-- Contenedor de Sliders -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="img/unnamed.png" alt="">
							</div>
			
							<div class="item">
								<img src="img/ferrari.png" alt="">
							</div>
			
							<div class="item">
								<img src="img/bugati.png" alt="">
							</div>
						</div>
			
						<!-- Controles -->
						<a href="#slider" class="left carousel-control" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
							<span class="sr-only">Anterior</span>
						</a>
						<a href="#slider" class="right carousel-control" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
							<span class="sr-only">Siguiente</span>
						</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h1 class="text-center">Galeria</h1>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="thumbnail">
						<a href="#">
							<img src="img/a1.png" alt="">
						</a>
						<div class="caption">
							<h3>Fiat 500</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<p>
								<a href="#" class="btn btn-default">Detalles</a>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="thumbnail">
						<a href="#">
							<img src="img/c1.png" alt="">
						</a>
						<div class="caption">
							<h3>Ford Ranger</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<p>
								<a href="#" class="btn btn-default">Detalles</a>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="thumbnail">
						<a href="#">
							<img src="img/a2.png" alt="">
						</a>
						<div class="caption">
							<h3>Subaru Impreza</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<p>
								<a href="#" class="btn btn-default">Detalles</a>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="thumbnail">
						<a href="#">
							<img src="img/c2.png" alt="">
						</a>
						<div class="caption">
							<h3>Hummer</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<p>
								<a href="#" class="btn btn-default">Detalles</a>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="thumbnail">
						<a href="#">
							<img src="img/a3.png" alt="">
						</a>
						<div class="caption">
							<h3>Mercedes Benz</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<p>
								<a href="#" class="btn btn-default">Detalles</a>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="thumbnail">
						<a href="#">
							<img src="img/c3.png" alt="">
						</a>
						<div class="caption">
							<h3>Rubicon</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<p>
								<a href="#" class="btn btn-default">Detalles</a>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="thumbnail">
						<a href="#">
							<img src="img/a4.png" alt="">
						</a>
						<div class="caption">
							<h3>Mini Cooper</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<p>
								<a href="#" class="btn btn-default">Detalles</a>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="thumbnail">
						<a href="#">
							<img src="img/c4.png" alt="">
						</a>
						<div class="caption">
							<h3>Nissan Patrol</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<p>
								<a href="#" class="btn btn-default">Detalles</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include_once("footer.php"); ?>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>