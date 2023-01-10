<?php

$msgerro = "";
if(isset($_POST["resetar"])){ //botão enviou via post
    if(!empty($_POST["email"])){
        include("../conecta-inc.php"); //só conecta se checagem acima for ok        
        $email = trim($_POST["email"]); //recebe do form
        //verficar se o mail realmente esta cadastrado
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email ); //bind dos parametros
        $stmt->execute(); //executa o statement
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {//se existe este mail cadastrado
            $tamanho = 8;
            $caracteresvalidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@?#';
            $max = strlen($caracteresvalidos);
            for ($i = 0; $i < $tamanho; ++$i) {
                $senha .= $caracteresvalidos[random_int(0, $max)];
              } //fim do for
            $senhanew = sha1($senha); //cria o hash para armazenar no banco
            $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
            $stmt->bind_param("ss", $senhanew, $email ); //cadastra o hash SHA1
            $stmt->execute(); //executa o statement
            if ($stmt->affected_rows > 0) { //se o UPDATE ocorreu OK
                $mensagem = "Caro usuário,sua solicitação de reset de senha foi executada. Recomendamos que a senha seja alterada no próximo login. Segue a senha gerada automaticamente: $senha";
                mail($email,"Sistema: Recuperação de senha","$mensagem","FROM:services@meusistema.com");
               } else { //else do affected_rows
                $msgerro = "Ocorreu um erro ao resetar as credenciais!"; //cria uma mensagem de erro
               } //fim do else-if-affected_rows
            $stmt->close(); //fecha o stmt
            $conn->close(); //fecha a conexão            
        } else { //else do if $result (mail não cadastrado)
            $msgerro = "Não existe usuário com este email"; //cria uma mensagem de erro
          } //fim do else $result 
    } //fim do if !empty
}//fim do if resetar
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
<html>
<head>
<title>Resetar senha </title>
</head>
<body>
	
	<div class="container add-edit">
                <p style="color:red;">
                  <?php echo $msgerro;?>
                </p>
								<h2 align="center">Resetar Senha</h2>
								<hr>
								</hr>
								<div class="content">
									<form action="reset.php" method="POST">
										<label for="email" class="form-label">Email:</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <div class="d-grid gap-2">
										<input type="submit" value="Resetar Senha" id="resetar" name="resetar" class="btn btn-danger"><br>
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