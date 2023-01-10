<?php
	session_start();
	if (!isset($_SESSION["usuario"]) || !isset($_SESSION["autenticado"]) ) {
		header("location: auth/login.php");
}
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cuidadores de 4 Patas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="icon" type="image/png" sizes="32x32" href="image/logo-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="image/logo-16x16.png"/>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script src="https://kit.fontawesome.com/af233e75ce.js" crossorigin="anonymous"></script>
</head>

<body>
  <!--
       Alunos:  Pedro Alysson Ramos Silva           -          Matrícula: 20211P2ADS0088
                Maria Victoria do Carmo Ferreira do Nascimento Matrícula: 20211P2ADS0142
                Fabricio Augusto Lopes dos Santos   -          Matrícula: 20211P2ADS0282
                Francisca Assunção Pereira Cardoso  -          Matrícula: 20211P2ADS0231
          
    
		[OBS] A estrutura do site foi feita com os components do Bootstrap, 
		mais informações sobre quais foram utilizados em: https://getbootstrap.com/docs/5.2/examples/
	-->

	<!--
		Inicio da estruturação do cabeçalho da página
	-->
	<header class="p-3 text-white fixed-top bg-dark">
		<nav class="navbar navbar-dark navbar-expand-lg">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
				aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a href="painel.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
				<img class="" src="image/logo.png" width="81" height="44" role="img"
					aria-label="Logo">
			</a>
      <h4> Olá, <?php echo $_SESSION['usuario']; ?>. Seja bem-vindo! </h4>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link header-link" href="painel.php">Inicio <span class="sr-only"></span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link header-link" href="#pets">Adote</a>
					</li>
					<li class="nav-item">
						<a class="nav-link header-link" href="#doar">Ajude-nos</a>
					</li>
					<li class="nav-item header-link">
						<a class="nav-link header-link" href="#sobre">Sobre</a>
					</li>
					<li class="nav-item header-link">
						<a class="nav-link header-link" href="https://api.whatsapp.com/send?phone=5519999999999&text=Texto%20aqui">Contato</a>
					</li>
					<li class="nav-item header-link">
						<a class="nav-link header-link" href="ajax/index.php">Buscar Cliente</a>
					</li>          
					<li class="nav-item header-link">
						<a class="btn btn-danger" type="button" href="auth/logoff.php">Sair</a>
					</li>
				</ul>
		</nav>
	</header> <!-- Fim do cabeçalho da página -->
	

	
	<!--
		Inicio da estruturação da mensagem de boas vindas do site
	-->
<main>
  <div id="myCarousel" class="carousel slide w-100 carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="bd-placeholder-img" src="image/capa.jpg " width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false" fill="#777">

        <div class="container">
          <div class="carousel-caption text-start-2">
            <h1>ONG <br>Cuidadores de 4 Patas</h1>
            <h3>Eu respeito, eu protejo!</h3>
            <p><a class="btn btn-lg btn-primary" href="#sobre">Saiba Mais</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" src="image/castracao.png " width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false" fill="#777">
        <div class="container">
          <div class="carousel-caption text-start-2">
            <h1>Campanha de Castração Gratuita</h1>
            <h3>Dia 16 de Novembro</h3>
            <p><a class="btn btn-lg btn-primary" href="https://api.whatsapp.com/send?phone=5519999999999&text=Texto%20aqui">Mais Informações</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" src="image/racao.png " width="100%" height="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false" fill="#777">
    <div class="container">
          <div class="carousel-caption text-start-2">
            <h1>Estamos precisando de ração</h1>
            <h3>Estoque para poucos dias!</h3>
            <p><a class="btn btn-lg btn-primary" href="#doar">Contribuir</a></p>
          </div>
        </div>  
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</main> <!-- Fim da mensagem de boas vindas -->

	<!--
		Início da estruturação do catálogo de animais disponíveis para adoção
	-->
	<div class="my-5 container d-grid gap-2">
		<h1 class="border-bottom" id="pets">Pets Disponíveis Para Adoção</h1><br>
    <a href="crud-stmt/create-update.php" class="btn btn-adt btn-sm btn-danger">Adicionar</a>
	</div>
	
	<div class="album bg-light">
		<div class="container my-5 px-5">

			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
				<?php
					include("conecta-inc.php");

					$sql = "SELECT id, nome, sexo, idade, tamanho, arquivo FROM pets"; //criamos uma query
					$result = $conn->query($sql); //executamos a query no objeto de conexão

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<div class='col'>";
								echo "<div class='card shadow-sm'>";
										echo '<img class="bd-placeholder-ipmg card-img-to w-auto p-3" width="90%" src=" ../image/' . $row['arquivo'] . '" >';
									echo "<div class='card-body'>";
										echo "<h3>" . $row['nome'] . "</h3>";
											echo "<p class='card-text'>";
												echo "<i class='icon fa-solid fa-venus-mars'></i>" . "Sexo: ". $row['sexo'] . "<br>";
												echo "<i class='icon fa-solid fa-cake-candles'></i>" . "Idade: " . $row['idade'] . "<br>";
												echo "<i class='icon fa-solid fa-dog'></i>" . "Tamanho: " . $row['tamanho'] . "<br>";
											echo "</p>";
											echo "<div class='d-grid gap-2'>
											<a href='adotar.php' class='btn btn-danger' type='button'>Adotar</a>
											</div>" ."<br>";
									echo "<div class='d-flex justify-content-between align-items-center'>";
										echo "<div class='btn-group container'>";
											echo "<a href='crud-stmt/create-update.php?id=" . $row['id'] . "' class='btn btn-adt btn-sm btn-outline-danger'>Editar</a>";
											echo "<a href='crud-stmt/remove.php?id=" . $row['id'] . "' class='btn btn-adt btn-sm btn-outline-danger'>Remover</a>";
										echo "</div>";
									echo "</div>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
						}
					} else{
						echo "Nenhum pet adicionado no Sistema.";
					}
				$conn->close();
				?>

				
			</div>
		</div>
	</div> <!-- Fim do catálogo de animais disponíveis para adoção -->

	<!--
		Início da estruturação dos meios disponíveis para doações
	-->

	<div class=" container">
		<h1 class="border-bottom" id="doar">Meios Para Doações</h1>
	</div>
	<div class="container px-4 py-5" id="featured-3">
		<div class="row g-4 py-5 row-cols-1 row-cols-lg-3 justify-content-center">
			<div class="feature col itens-meios-adocoes">
				<div
					class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-white fs-2 mb-3">
					<i class="fa-brands fa-pix icon"></i>
				</div>
				<h2>Via Pix:</h2>
				<p>(CNPJ) 47.902.768/0001-14;</p>
			</div>
			<div class="feature col itens-meios-adocoes">
				<div
					class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-white fs-2 mb-3">
					<i class="fa-solid fa-building-columns icon"></i>
				</div>
				<h2>Via Conta Bancária:</h2>
				<p>Banco do Brasil;<br>
				Agência 2428-7;<br>
				Conta 34.130-4;</p>
			</div>
			<div class="feature col itens-meios-adocoes">
				<div
					class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient text-white fs-2 mb-3">
					<i class="fa-solid fa-money-check-dollar icon"></i>
				</div>
				<h2>Via Catarse:</h2>
				<p><a href="https://www.catarse.me/cuidadores_de_4_patas_e434?ref=project_link" target="_blank">Faça seu registro e contribua com um valor mensal.</a></p>
			</div>
		</div>
	</div> <!-- Fim do componente de meios p/ doações -->


	<!--
		Inicio da sessão 'Sobre' a ONG
	-->


<div class="container">

		<h1 class="border-bottom" id="sobre">Sobre a ONG</h1>
		<br>
  <div class="row g-4 mt-5 pr-0 row-cols-1 row-cols-lg-2 justify-content-center">
    <div class="col-md-5">
		<p class="lead">Esse projeto foi criado a menos de 1 ano,por Fazinha,uma das fundadoras que teve essa
			ideia excepcional. Resolvemos nos juntar contra os abandonos de animais,e se disponibilizar para
			ajudá-los. Começamos sem nada,e só com a esperança de ajudar nosso animais de ruas que precisam da nossa
			imediata ajuda. Hoje somos um grupo com 150 voluntários. Não somos reconhecidos fora da cidade, e nem
			temos apoio gonvernamental. Montemos esse projeto por conta propia. Já ajudamos inúmeros de animais de
			rua que precisavam da nossa imediata ajuda,quase todos hoje estão em um lar. Quando nos dedicamos a uma
			causa não é esperando reconhecimento, é porque fazer algo alegra nossa alma e virar o rosto não é uma
			opção.
		</p>
    </div>
		<div class="col-md-5 order-md-1">
			<img class="img-fluid rounded-3  w-100 p-3" src="image/sobre.png" alt="Cuidadores de 4 Patas">
		</div>
	</div>
</div>


	<!--
		Inicio da estruturação do rodapé da página (footer)
	-->
<div class="container">
  <footer class="py-3 my-5">
    <ul class=" border-bottom nav justify-content-center pb-3 mb-3">
      <li class="nav-item"><a href="painel.php" class="nav-link px-2 text-muted">Início</a></li>
      <li class="nav-item"><a href="#pets" class="nav-link px-2 text-muted">Adote</a></li>
      <li class="nav-item"><a href="#doar" class="nav-link px-2 text-muted">Ajude-nos</a></li>
      <li class="nav-item"><a href="https://api.whatsapp.com/send?phone=5519999999999&text=Texto%20aqui" class="nav-link px-2 text-muted">Contato</a></li>
      <li class="nav-item"><a href="#sobre" class="nav-link px-2 text-muted">Sobre</a></li>
    </ul>
    <p class="text-center text-muted">&copy; 2022 Cuidadores de 4 Patas<br>Pedro II - PI</p>
  </footer>
</div>          
	<!-- footer antigo <div class="container">
		<footer class="py-3 my-4">
			<p class="lead text-center text-muted">© 2022 Cuidadores de 4 Patas<br>Pedro II - Piauí</p>
		</footer>
	</div> <!-- Fim do rodapé-->

	<!--inicio api whatsapp -->
	<a href="https://api.whatsapp.com/send?phone=5519999999999&text=Texto%20aqui" target="_blank"
		style="position:fixed;bottom:20px;right:30px;"><svg enable-background="new 0 0 512 512" width="50" height="50"
			version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
			<path
				d="M256.064,0h-0.128l0,0C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104  l98.4-31.456C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z"
				fill="#4CAF50" />
			<path
				d="m405.02 361.5c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.62-127.46-112.58-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016 0.16 8.576 0.288 7.52 0.32 11.296 0.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744s-7.36 7.68-11.136 12.352c-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z"
				fill="#FAFAFA" />
		</svg>
	</a>
	<!-- fim api whatsapp -->

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<script type="text/javascript" src="script.js"></script>

</body>
</html>