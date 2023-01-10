<?php
include("../conecta-inc.php"); //Cria a variável $conn
if(isset($_GET["term"]) && !empty(trim($_GET["term"]))){
  $termo = trim($_GET["term"]); //remove espaços
  $termo = "%". $termo . "%"; //adiciona os CORINGAS inicial e final para o LIKE 
  $stmt = $conn->prepare("SELECT * FROM cliente WHERE nome LIKE ? ORDER BY nome ASC");
  $stmt->bind_param("s", $termo); // aqui $termo ja possui os coringas, ex: %anue% 
  $stmt->execute(); //executa o statement
  $result = $stmt->get_result();
  $arrayData = array(); //cria um array que será convertido em json
  if ($result->num_rows > 0) { //consulta encontrou resultados
      while($row = $result->fetch_assoc()){ //percorre e monta os itens
          $data["id"] = $row["id"];
          $data["value"] = $row["nome"]; //IMPORTANTE: key deve ser "value"          
          array_push($arrayData, $data); //concatena no array
      } //fim do while
      echo json_encode($arrayData); //retorna um json com os resultados  
    } //fim do if num_rows > 0 
} //fim dos if isset
$stmt->close(); //fecha o stmt
$conn->close(); //fecha a conexão
?>