<nav class="navbar navbar-inverse navbar-static-top">
			<!-- 
				navbar-default		Color claro
				navbar-inverse		Color Oscuro

				navbar-static-top	Menu estatico, sin bordes
				navbar-fixed-top	Menu fijo arriba
				navbar-fixed-bottom	Menu fijo abajo

				nota: si utilizamos fixed tenemos que agregar un padding-top al body de 70px
			 -->
			<div class="container">

				<!-- Encabezado de nuestro Menu -->
				<div class="navbar-header">
					<a href="index.php" class="navbar-brand">DileoWeb</a>

					<!-- Boton hamburguesa, solo visible en dispositivos moviles -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#btn-colapsar">
						<span class="sr-only">Navegacion</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<!-- Elementos del Menu -->
				<!-- Links y formulario -->
				<div class="collapse navbar-collapse" id="btn-colapsar">

					<!-- Links del Menu -->
					<ul class="nav navbar-nav">
						<li><a href="index.php">Inicio</a></li>
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Autos <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="auto-formulario.php">Nuevo Auto</a></li>
								<li><a href="autos.php">Listado de Autos</a></li>
							</ul>
						</li>
						<li><a href="contacto.php">Contacto</a></li>
					</ul>

					<!-- Formulario de Busqueda -->
					<form class="navbar-form navbar-right" action="" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Buscar">
							<button type="submit" class="btn btn-default">Buscar</button>
						</div>
					</form>
				</div>
			</div>				
		</nav>