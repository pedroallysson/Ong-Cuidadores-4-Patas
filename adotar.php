<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cuidadores de 4 Patas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="icon" type="image/png" sizes="32x32" href="image/logo-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="image/logo-16x16.png">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script src="https://kit.fontawesome.com/af233e75ce.js" crossorigin="anonymous"></script>
</head>

<body>
	<header class="p-3 text-white fixed-top bg-dark">
		<nav class="navbar navbar-expand-lg navbar-dark">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
					aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
				<img class="" src="image/logo.png" width="81" height="44" role="img"
					aria-label="Logo">
				</a>
	
				<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<a class="nav-link header-link" href="index.php">Retornar ao Inicio <span class="sr-only"></span></a>
						</li>
					</ul>
				</div>
		</nav>
	</header>


	
	<div class="container add-edit">
								<h2>Adotar Pet</h2>
								<hr>
								</hr>
								<div class="content">
									<form action="enviar.php" method="POST">
										<input type="hidden" name="id" value="<?php echo $id; ?>"/>

                    										<label for="nomepet" class="form-label">Pet escolhido:</label>
										<input type="text" class="form-control" id="nomepet" name="nomepet" value='<?php echo $nomepet; ?>'/>
										<label for="nome" class="form-label">Nome:</label>
										<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" value='<?php echo $nome; ?>'/>
										<label for="nome" class="form-label">Endereço:</label>
										<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Seu endereço" value='<?php echo $endereco; ?>'/>
										<label for="idade" class="form-label">Telefone:</label>
										<input type="number" class="form-control" id="telefone" name="telefone" placeholder="Digite seu numero para contato" value="<?php echo $telefone; ?>">
                    <label for="email" class="form-label">Email:</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email para contato" value="<?php echo $email; ?>">
										<br>

										<button type="submit" class="btn btn-danger">Salvar</button> <a href="index.php" type="submit" class="btn btn-dark">Voltar</a>
									</form>
								</div>
								<hr>
								</hr>
							</div>
  
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>