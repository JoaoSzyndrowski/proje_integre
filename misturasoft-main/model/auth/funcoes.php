<?php
$nome = $_POST["nome"];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['userTipo'];

function criaLogin($nome,$email,$senha,$tipo){
    include("conexao.php");

    if(isset($nome) && isset($email) && isset($senha)){
        $sql = "INSERT INTO usuario (nome, email, senha, tipo) VALUES ('$nome','$email','$senha', '$tipo');";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "cliente inserido xuxexo";
            $_SESSION['login'] = $email;
            header("Location: ../index.html"); 
        }else{
            echo "nao sei HAHAHAHHAHAHAHAHAHAHAHHHAHA";
        }
    }
}
function validaLogin($email,$senha){

    include("conexao.php");

    $email = $_POST['email'];
    $senha = $_POST['senha'];

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