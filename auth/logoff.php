<?php
session_start(); //Necessário sempre que usar sessão
if (isset($_SESSION["usuario"]) && isset($_SESSION["autenticado"])){
    unset($_SESSION["usuario"]); //remove da sessão
    unset($_SESSION["autenticado"]); //remove da sessão
}
header("Location: ../index.php"); //redireciona para pagina de login na mesma pasta
?>