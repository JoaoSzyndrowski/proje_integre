<?php
include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];

    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, cpf) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("sssss", $nome, $email, $telefone, $endereco, $cpf);

    if ($stmt->execute()) {
        echo "<script>alert('Cliente cadastrado com sucesso!');</script>";
        echo "<script>window.history.back()</script>";  
    } else {
        echo "Erro ao cadastrar cliente: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
</head>
<body>
    <h2>Cadastro de Cliente</h2>
    <form action="" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" required><br><br>

        <label for="endereco">Endereço:</label><br>
        <input type="text" id="endereco" name="endereco" required><br><br>

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" required><br><br>

        <input type="submit" value="Cadastrar Cliente">
    </form>

</body>
</html>




