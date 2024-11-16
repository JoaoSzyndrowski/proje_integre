<?php
session_start();

include("../control/conexao.php");

$nome = $_POST["nome"];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['userTipo'];

if(isset($nome) && isset($email) && isset($senha)){
    $sql = "INSERT INTO usuario (nome, email, senha, tipo) VALUES ('$nome','$email','$senha', '$tipo');";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "cliente inserido xuxexo";
        $_SESSION['login'] = $nome;
        header("Location: ../index.html"); 
    }else{
        echo "nao sei HAHAHAHHAHAHAHAHAHAHAHHHAHA";
    }
}



?>