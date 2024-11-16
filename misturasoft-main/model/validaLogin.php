<?php
session_start();

include("../control/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

if (empty($email)) {
    echo "digite o email!";
    exit();
} else if (empty($senha)) {
    echo "digite sua senha!";
    exit();
} else { 
    $email = $conn->real_escape_string($email);

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        echo "Usuário não encontrado";
        exit();
    } else {
        $row = $result->fetch_assoc();

        if ($row['senha'] === $senha) {
            $_SESSION['login'] = $row['email'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['id'] = $row['id_usuario'];
            echo "Acesso garantido";
            header("Location: ../index.php"); 
            //tela que voce quer que o usuario va depois do login ;-)
        } else {
            echo "Senha incorreta";
            exit();
        }
    }
}


$conn->close();
?>