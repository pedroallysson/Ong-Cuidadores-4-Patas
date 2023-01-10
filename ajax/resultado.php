<?php
include("../conecta-inc.php");
$msgerro = "";
if(isset($_POST["id"]) && !empty(trim($_POST["id"]))){
  $id = trim($_POST["id"]); //trata o parâmetro (remove espaços)
  $stmt = $conn->prepare("SELECT * FROM cliente WHERE id = ?");
  $stmt->bind_param("i", $id); //
  $stmt->execute(); //executa o statement
  $result = $stmt->get_result();
  if ($result->num_rows == 1) { //busca pelo ID não pode retornar mais de um
    $row = $result->fetch_assoc();
    $nome = $row["nome"];
    $endereco = $row["endereco"];
    $telefone = $row["telefone"];
    $email = $row["email"];
    
  
    } else { //else do if num_rows
      $msgerro = "Ocorreu um erro ao executar a consulta!";
  }//fim do else 
} //fim dos if isset
$stmt->close(); //fecha o stmt
$conn->close(); //fecha a conexão
?>


<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cuidadores de 4 Patas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="icon" type="image/png" sizes="32x32" href="../image/logo-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../image/logo-16x16.png">
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<script src="https://kit.fontawesome.com/af233e75ce.js" crossorigin="anonymous"></script>
</head>

<body>
	<header class="bg-dark">
		<nav class="navbar navbar-expand-lg navbar-dark">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
					aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
				<img class="" src="../image/logo.png" width="81" height="44" role="img"
					aria-label="Logo">
				</a>
	
				<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<a class="nav-link header-link" href="../painel.php">Retornar ao Inicio <span class="sr-only"></span></a>
						</li>
					</ul>
				</div>
		</nav>
	</header>

    <!-- inicio da estrutura de exibição do formulario da pagina-->
    <div class="container"><br>
			<br><h1>Detalhes do Cliente</h1>
			<hr>
			</hr>
			  <div class="content">
          <p style="color:red;">
            <?php echo $msgerro;?>
          </p>
            <label for="nome" class="form-label">Nome:</label>
						<input class="form-control" type="text" value='<?php echo $nome; ?>' aria-label="Disabled input example" disabled readonly>
            <label for="nome" class="form-label">Endereço:</label>
						<input class="form-control" type="text" value='<?php echo $endereco; ?>' aria-label="Disabled input example" disabled readonly>
						<label for="idade" class="form-label">Telefone:</label>
						<input class="form-control" type="text" value='<?php echo $telefone; ?>' aria-label="Disabled input example" disabled readonly>
						<label for="idade" class="form-label">Email:</label>
						<input class="form-control" type="text" value='<?php echo $email; ?>' aria-label="Disabled input example" disabled readonly>
						<br>
            <a href="../painel.php" class="btn btn-danger">Retornar ao Inicio</a>
			</div>
		</div>
    <br>

  
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>
