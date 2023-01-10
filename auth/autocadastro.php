<?php
include("../conecta-inc.php");

$msgerro = "";
if(isset($_POST["cadastrar"])){ //botão enviou via post
    if(!empty($_POST["nome"]) && !empty($_POST["usuario"]) && !empty($_POST["senha"]) && !empty($_POST["email"])){
        include("../conecta-inc.php"); //só conecta se checagem acima for ok
        $nome = trim($_POST["nome"]); //recebe do form
        $usuario = trim($_POST["usuario"]); //recebe do form
        $senha = sha1($_POST["senha"]); //IMPORTANTE: hash SHA1 na senha antes de armazenar
        $email = trim($_POST["email"]); //recebe do form
        //verficar se o usuario ou mail ja estão em uso,note o uso do OU (OR)
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? OR email = ?");
        $stmt->bind_param("ss", $usuario, $email ); //bind dos parametros
        $stmt->execute(); //executa o statement
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {//Ja existe um usuario ou email iguais
            $msgerro = "Ja existe um usuário com este login/email"; //cria uma mensagem de erro
            $stmt->close(); //fecha o stmt
            $conn->close(); //fecha a conexão            
        } else { //else do if $result
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, usuario, senha, email) VALUES (?,?,?,?)"); //preparamos a query colocando as ?
            $stmt->bind_param("ssss", $nome, $usuario,$senha,$email); //tipos e variáveis na ordem do prepare
            $stmt->execute(); //executa o statement de INSERT
            if ($stmt->affected_rows > 0) { //se o INSERT ocorreu OK
                session_start(); //habilita o uso de sessão somente se tudo estiver ok
                $_SESSION["usuario"] = $usuario; //insere na sessão
                $_SESSION["autenticado"] = true; //variavel de controle
                $stmt->close(); //fecha o stmt
                $conn->close(); //fecha a conexão
                header("Location: ../index.php"); //OK:redireciona para listagem
            } else { //else do affected_rows
                $stmt->close(); //fecha o stmt
                $conn->close(); //fecha a conexão
                $msgerro = "Ocorreu um erro ao realizar o cadastro!"; //cria uma mensagem de erro
            } //fim do else-if-affected_rows
          } //fim do else $result 
    } //fim do if !empty
}//fim do if cadastrar
?>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cuidadores de 4 Patas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css" />
  <link rel="icon" type="image/png" sizes="32x32" href="../image/logo-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../image/logo-16x16.png">
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
					<img class="" src="../image/logo.png" width="40" height="32" role="img"
						aria-label="Logo"></img>
				</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<a class="nav-link header-link" href="../index.php">Retornar ao Inicio <span class="sr-only"></span></a>
						</li>
					</ul>
				</div>
		</nav>
	</header>

	
	<div class="container add-edit">
                <p style="color:red;">
                  <?php echo $msgerro;?>
                </p>
								<h2 align="center">Cadastro de Usuário</h2>
								<hr>
								</hr>
								<div class="content">
									<form action="autocadastro.php" method="POST">
										<label for="nome" class="form-label">Nome:</label>
										<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                    <label for="usuario" class="form-label">Login:</label>
										<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nome de Usuário" required>
										<label for="senha" class="form-label">Senha:</label>
										<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" minlength="8" required>
                    <label for="email" class="form-label">Email:</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
										<br>
                    <div class="d-grid gap-2">
										<input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar" class="btn btn-danger"><br>
                    </div>
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