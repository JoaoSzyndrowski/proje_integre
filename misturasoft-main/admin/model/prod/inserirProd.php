<?php
include("control/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $preco = $_POST['preco'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $tamanho = $_POST['tamanho'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $status = $_POST['status'];

    $sql = "INSERT INTO produto (preco, nome, descricao, tamanho, faixa_etaria, status)
            VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $preco, $nome, $descricao, $tamanho, $faixa_etaria, $status);
        if ($stmt->execute()) {
            echo "Produto inserido com sucesso!";
            header("Location: ../../view/brinquedo.php"); // Redireciona de volta à página principal após inserção
            exit;
        } else {
            echo "Erro ao inserir produto: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Produto</title>
</head>
<body>
    <h2>Adicionar Novo Produto</h2>
    <form action="inserirProd.php" method="POST">
        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" required><br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br><br>

        <label for="tamanho">Tamanho:</label>
        <select id="tamanho" name="tamanho">
            <option value="PP">PP</option>
            <option value="P">P</option>
            <option value="M">M</option>
            <option value="G">G</option>
            <option value="GG">GG</option>
        </select><BR><BR>
        

        <label for="faixa_etaria">Faixa Etária:</label>
        <select id="faixa_etaria" name="faixa_etaria">
            <option value="Adulto">Adulto</option>
            <option value="Criança">Criança</option>
        </select><BR><BR>
        
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="dips">Disponível</option>
            <option value="indisp">Indisponível</option>
        </select><br><br>

        <button type="submit">Adicionar Produto</button>
    </form>
</body>
</html>
