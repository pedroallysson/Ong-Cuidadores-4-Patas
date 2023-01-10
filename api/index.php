<?php
include("../conecta-inc.php"); //Arquivo de conexão que esta na raiz do projeto, um nível acima e cria a variável $conn
$method = $_SERVER['REQUEST_METHOD']; //captura o método HTTP usado
$parameter = explode('/', $_SERVER['PATH_INFO']); //Usa o formato da URL e divide com /
switch($method) {
  case 'GET': //Ação referente ao método GET
      header("Access-Control-Allow-Origin: *"); //permite acesso de qualquer lugar
      header("Content-Type: application/json; charset=UTF-8"); //GET sempre retornará JSON
      header("Access-Control-Allow-Methods: OPTIONS,GET");
      if (isset($parameter[1])) { //se existir ID realiza o SELECT com WHERE (statement)
          //echo "O path_info foi: ",$parameter[1];
          //inicio
          $id = trim($parameter[1]); //trata e armazena o parâmetro
          $stmt = $conn->prepare("SELECT * FROM cliente WHERE id = ?");
          $stmt->bind_param("i", $id); //
          $stmt->execute(); //executa o statement
          $result = $stmt->get_result(); //armazena um recordset
          $count = $result->num_rows; //apenas por conveniencia, cria uma variável com a quantidade
          $stmt->close(); //fecha o stmt 
        }//fim dos if isset       
      else { //caso não exista ID, seleciona * (todos)
          //echo "entrei sem ID";
          $sql = "SELECT * FROM cliente"; //Usamos query com raw SQL (não tem WHERE)
          $result = $conn->query($sql); //executamos a query no objeto de conexão
          $count = $result->num_rows; //apenas por conveniencia, cria uma variável com a quantidade
      }//fim do else parameter (ID)
      //variáveis usadas para criar o JSON
      $clientesArr = array(); //cria um array vazio
      $clientesArr["body"] = array(); //cria um array interno vazio para receber os dados
      $clientesArr["count"] = 0; //retorna a quantidade de registros junto com os dados
      if ($count > 0) {
          $clientesArr["count"] = $count; //armazena a quantidade de registros
          while ($row = $result->fetch_assoc()) { //itera no recordset linha a linha
                $cliente = array( //cria um array e popula
                        "id" => $row["id"],
                        "nome" => $row["nome"],
                        "endereco" => $row["endereco"],
                        "telefone" => $row["telefone"],
                        "email" => $row["email"],
                         ); //fecha o array
                array_push($clientesArr["body"], $cliente); //append o jogo no array de jogos
            }//fim do while $row
          echo json_encode($clientesArr); //Aqui monta e devolve um JSON com os dados + quantidade
      } else { //else do $count > 0,  caso não tenha resultados
        //A consulta não retornou registros, devolve um array vazio com contagem ZERO!
        echo json_encode($clientesArr);
      }//fim do else count
      $conn->close();//fecha a conexão crida no include
    //fim da lógica do GET   
    break; //break do GET para encerrar o switch $method
  case 'POST': //Ação para POST (INSERT)
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");
      header("Access-Control-Allow-Methods: OPTIONS, POST");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
      //recebe um JSON com campos
      $rawData = json_decode(file_get_contents("php://input")); //recebe e extrai os dados de um JSON

      $nome = $rawData->nome;
      $endereco = $rawData->endereco;
      $telefone = $rawData->telefone;
      $email = $rawData->email;
      
      $stmt = $conn->prepare("INSERT INTO cliente (nome, endereco, telefone, email) VALUES (?,?, ?, ?)"); //preparamos a query colocando as ?
      $stmt->bind_param("ssss", $nome, $endereco,$telefone,$email); //informamos os tipos e  as variáveis na ordem que foram informadas no prepare
      $stmt->execute(); //executa o statement
      if ($stmt->affected_rows > 0) {
          echo json_encode("Cliente inserido com sucesso!");
          //exit();
      } else { 
          echo json_encode("Houve um problema ao inserir o registro!");
         }
    $stmt->close(); //fecha o statement
    $conn->close(); //fecha a conexão
    break; //break do POST para encerrar o switch method

  case 'PUT'://Ação para PUT (UPDATE);
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");
      header("Access-Control-Allow-Methods: OPTIONS, PUT");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
      //recebe um JSON com os campos
      $rawData = json_decode(file_get_contents("php://input")); //recebe e extrai os dados de um JSON
      $id = $rawData->id; //para atualizar é necessário um ID
      $nome = $rawData->nome;
      $endereco = $rawData->endereco;
      $telefone = $rawData->telefone;
      $email = $rawData->email;

      $stmt = $conn->prepare("UPDATE cliente SET nome= ?, endereco = ?, telefone = ?, email = ? WHERE id = ?"); //preparamos a query colocando as ?
  $stmt->bind_param("ssssi", $nome, $endereco,$telefone,$email, $id ); //informamos os tipos e  as variáveis na ordem que foram informadas no prepare
      $stmt->execute(); //executa o statement
      if ($stmt->affected_rows > 0) {
          echo json_encode("Cliente atualizado com sucesso!");
          //exit();
      } else { 
          echo json_encode("Houve um problema ao atualizar o registro!");
         }
    $stmt->close(); //fecha o statement
    $conn->close(); //fecha a conexão
    break; //break do PUT para encerrar o switch

  case 'DELETE': //Ação para DELETE
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");
      header("Access-Control-Allow-Methods: OPTIONS, DELETE");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
      //recebe um JSON com um campo id,  ex:  { "id": 15 }
      $rawData = json_decode(file_get_contents("php://input")); //recebe e extrai os dados de um JSON

      $id = trim($rawData->id); //para remover é necessário um ID
      $stmt = $conn->prepare("DELETE FROM cliente WHERE id = ?"); //preparamos a query
      $stmt->bind_param("i", $id); //informamos os tipos e  as variáveis
      $stmt->execute();
      if ($stmt->affected_rows > 0) {
        echo json_encode("Registro excluído com sucesso!");
          
        } else { //else do if num_rows
          echo json_encode("Ocorreu um erro ao executar o comando.");
      }//fim do else 
    break; //break do DELETE para encerrar o switch

} //fim do switch method

?>