<?php
include("../conecta-inc.php");
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
  $id = trim($_GET["id"]); //trata e armazena o parâmetro
  $sql = "DELETE FROM pets WHERE id = $id";
  if ($conn->query($sql) == TRUE) {
    } else { //else do if num_rows
  }//fim do else 
} //fim dos if isset
$conn->close();
echo "<script language='javascript' type='text/javascript'>
        alert('Excluído com sucesso!');window.location
        .href='../painel.php';</script>";
exit();
?>