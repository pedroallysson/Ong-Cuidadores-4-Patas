<?php
//1 – Definimos Para quem vai ser enviado o email
$destinatario = "cuidadores4patas@alwaysdata.net";
//2 – Definimos um Assunto do Email
$assunto = "Adoção de Pet";
//3 - resgatar os dados digitado no formulário e  grava nas variaveis
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$arquivo = date("Y.m.d-H.i.s") . $ext;
 //4 – Agora definimos a  mensagem que vai ser enviado no corpo do e-mail
$mensagem = "<h1>Dados do interessado no PET </h1>";
$mensagem .= "<br><strong>Nome:  </strong>".$nome;
$mensagem .= "<br><strong>Endereço:  </strong>".$endereco;
$mensagem .= "<br><strong>Telefone:  </strong>".$telefone;
$mensagem .= "<br><strong>Email:  </strong>".$email;
$mensagem .=  '<img src="./image/' . $arquivo . '" class="img img-responsive img-thumbnail" width="200">';

//5 – agora inserimos as codificações corretas e  tudo mais.
$headers =  "Content-Type:text/html; charset=UTF-8\n";
$headers .= "From:  dominio.com.br<sistema@dominio.com.br>\n";
//Vai ser //mostrado que  o email partiu deste email e seguido do nome
$headers .= "X-Sender:  <sistema@dominio.com.br>\n";
//email do servidor //que enviou
$headers .= "X-Mailer: PHP  v".phpversion()."\n";
$headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
$headers .= "Return-Path:  <sistema@dominio.com.br>\n";
//caso a msg //seja respondida vai para  este email.
$headers .= "MIME-Version: 1.0\n";

mail($destinatario, $assunto, $mensagem, $headers);  //função que faz o envio do email.

  include("conecta-inc.php");

	//cria as variaveis vazias.
	$id = $nome = $endereco = $telefone = $email = "";
	
  if (isset($_GET["id"]) && !empty($_GET["id"])) { //elseif do primeiro isset
		//Este bloco é executado se existir o parametro na  URL
		$id = trim($_GET["id"]); //trata e armazena o parâmetro
    $stmt = $conn->prepare("SELECT * FROM clientes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();                                                      
		
    $result = $stmt->get_result(); 
	
		if ($result->num_rows == 1) {
	    $row = $result->fetch_assoc();
			$nome = $row["nome"];
			$endereco = $row["endereco"];
			$telefone = $row["telefone"];
			$email = $row["email"];
		} else {
			echo "Erro fatal, mais de um registro encontrado na consulta.";
		}
$stmt->close();
$conn->close(); //fecha a conexão																										
}   elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["id"])) { //Verifica se foi pressionado o botão (POST) e ainda nao tem id (novo registro)
	  //não possuimos o ID, criaremos um usert para um novo registro
    $id = $_POST["id"];
		$nome = trim($_POST["nome"]);
		$endereco = trim($_POST["endereco"]);
		$telefone = trim($_POST["telefone"]);
		$email = trim($_POST["email"]);
	
    $stmt = $conn->prepare("INSERT INTO cliente (nome, endereco, telefone, email) VALUES (?, ?, ?, ?)"); //preparamos a query colocando as ?
    $stmt->bind_param("ssss", $nome, $endereco, $telefone, $email);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $stmt->close();
      $conn->close(); //fecha a conexão antes de redirecionar
      echo "<script language='javascript' type='text/javascript'>
        alert('Cadastrado com sucesso!');window.location
        .href='index.php';</script>";
      exit();
	  }else{
			echo "Erro ao inserir o registro: " . $conn->error;
      $stmt->close();
			$conn->close(); //fecha a conexão
		}
	}
?>
     

