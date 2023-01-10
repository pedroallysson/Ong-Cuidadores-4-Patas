<?php
  include("../conecta-inc.php");

	session_start();
	if (!isset($_SESSION["usuario"]) || !isset($_SESSION["autenticado"]) ) {
		header("location: ../auth/login.php");
}	
	//cria as variaveis vazias.
   if(isset($_FILES['arquivo'])) {
    $ext = strtolower(substr($_FILES['arquivo']['name'],-4)); //Pegando extensão do arquivo
    $arquivo = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
    $dir = '../image/'; //Diretório para uploads
    //$arquivo = $_FILES['arquivo']["name"];
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$arquivo);
   }
	$id = $nome = $sexo = $idade = $tamanho = $arquivo = "";
	if(isset($_POST["id"]) && !empty($_POST["id"])){
  	//este bloco é executado se o for  for enviado usando o botão (POST)
    
  	$id = $_POST["id"];
		$nome = trim($_POST["nome"]);
		$sexo = trim($_POST["sexo"]);
		$idade = trim($_POST["idade"]);
		$tamanho = trim($_POST["tamanho"]);
    $arquivo = date("Y.m.d-H.i.s") . $ext;
		
		$stmt = $conn->prepare("UPDATE pets SET nome= ?, sexo = ?, idade = ?, tamanho = ?, arquivo = ? WHERE id= ?");
    $stmt->bind_param("ssissi", $nome, $sexo, $idade, $tamanho, $arquivo, $id); 
    $stmt->execute();

      if ($stmt->affected_rows > 0) {
      	$stmt->close(); //fecha a conexão antes de redirecionar
        $conn->close();
				echo "<script language='javascript' type='text/javascript'>
        alert('Atualizado com sucesso!');window.location
        .href='../painel.php';</script>";
				exit();
			} else {
    		echo "Error updating record: " . $conn->error;
        $stmt->close();
        $conn->close(); //fecha a conexão
			}} //fim do if conn

	elseif (isset($_GET["id"]) && !empty($_GET["id"])) { //elseif do primeiro isset
		//Este bloco é executado se existir o parametro na  URL
		$id = trim($_GET["id"]); //trata e armazena o parâmetro
    $stmt = $conn->prepare("SELECT * FROM pets WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();                                                      
		
    $result = $stmt->get_result(); 
	
		if ($result->num_rows == 1) {
	    $row = $result->fetch_assoc();
			$nome = $row["nome"];
			$sexo = $row["sexo"];
			$idade = $row["idade"];
			$tamanho = $row["tamanho"];
      $arquivo = $row["arquivo"];
		} else {
			echo "Erro fatal, mais de um registro encontrado na consulta.";
		}
$stmt->close();
$conn->close(); //fecha a conexão
}
  
  elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["id"])) { //Verifica se foi pressionado o botão (POST) e ainda nao tem id (novo registro)
	  //não possuimos o ID, criaremos um usert para um novo registro
    $id = $_POST["id"];
		$nome = trim($_POST["nome"]);
		$sexo = trim($_POST["sexo"]);
		$idade = trim($_POST["idade"]);
		$tamanho = trim($_POST["tamanho"]);
    $arquivo = date("Y.m.d-H.i.s") . $ext;                                                                    

    $stmt = $conn->prepare("INSERT INTO pets (nome, sexo, idade, tamanho, arquivo) VALUES (?, ?, ?, ?, ?)"); //preparamos a query colocando as ?
    $stmt->bind_param("ssiss", $nome, $sexo, $idade, $tamanho, $arquivo);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $stmt->close();
      $conn->close(); //fecha a conexão antes de redirecionar
      echo "<script language='javascript' type='text/javascript'>
        alert('Cadastrado com sucesso!');window.location
        .href='../painel.php';</script>";
      exit();
	  }else{
			echo "Erro ao inserir o registro: " . $conn->error;
      $stmt->close();
			$conn->close(); //fecha a conexão
		}
	}
?>
    

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cuidadores de 4 Patas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="icon" type="image/png" sizes="32x32" href="../image/logo-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../image/logo-16x16.png">
	<link rel="stylesheet" type="text/css" href="../style.css" />
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
					<img class="" src="../image/logo.png" width="81" height="44" role="img"
						aria-label="Logo"></img>
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


	
	<div class="container add-edit">
								<h2>Adicionar Pet / Editar Pet</h2>
								<hr>
								</hr>
								<div class="content">
									<form action="create-update.php" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="id" value="<?php echo $id; ?>"/>
										<label for="nome" class="form-label">Nome:</label>
										<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome do Pet" value='<?php echo $nome; ?>'/>
										<label class="form-label">Sexo:</label>
										<input type="text" class="form-control" id="sexo" name="sexo" placeholder="Digite o Sexo do Pet" value='<?php echo $sexo; ?>'/>
										<label for="idade" class="form-label">Idade:</label>
										<input type="number" class="form-control" id="idade" name="idade" placeholder="Digite a Idade do Pet" value="<?php echo $idade; ?>">
										<label for="idade" class="form-label">Tamanho:</label>
										<input type="text" class="form-control" id="tamanho" name="tamanho"placeholder="Digite o Tamanho (ex: Médio, Pequeno, Grande, Filhote)" value="<?php echo $tamanho; ?>"><br>
                    <label for="arquivo" class="form-label">Adicionar Foto:</label>
										<input type="file" class="form-control" id="arquivo" name="arquivo" accept="image/*" placeholder="Carregar Foto" value="<?php echo $arquivo; ?>"><br>

										<button type="submit" class="btn btn-danger">Salvar</button>
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