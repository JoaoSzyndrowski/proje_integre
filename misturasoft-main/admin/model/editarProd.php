<?php
include("../control/conexao.php");

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];
    
    // Consulta para pegar os detalhes do produto que será editado
    $sql = "SELECT * FROM produto WHERE id_produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();

    if (!$produto) {
        // Produto não encontrado
        echo "Produto não encontrado.";
        exit;
    }

    // Verifica se o formulário de atualização foi enviado
    if (isset($_POST['atualizar'])) {
        // Pega os dados do formulário
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $tamanho = $_POST['tamanho'];
        $faixa_etaria = $_POST['faixa_etaria'];
        $status = $_POST['status'];

        // Atualiza o produto no banco de dados
        $update_sql = "UPDATE produto SET nome = ?, preco = ?, descricao = ?, tamanho = ?, faixa_etaria = ?, status = ? WHERE id_produto = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssssi", $nome, $preco, $descricao, $tamanho, $faixa_etaria, $status, $id_produto);
        
        if ($update_stmt->execute()) {
            sleep(5);
            echo "<script type='text/javascript'>
            alert('alteracao feita com xuxexo'); // Mensagem do alerta
            window.location.href = '../view/brinquedo.php'; // Redireciona após o alerta
            </script>";
            exit;
        } else {
            echo "Erro ao atualizar produto.";
        }
    }
} else {
    echo "ID não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required><br><br>

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea><br><br>

        <label for="tamanho">Tamanho:</label>
        <input type="text" id="tamanho" name="tamanho" value="<?php echo htmlspecialchars($produto['tamanho']); ?>" required><br><br>

        <label for="faixa_etaria">Faixa Etária:</label>
        <input type="text" id="faixa_etaria" name="faixa_etaria" value="<?php echo htmlspecialchars($produto['faixa_etaria']); ?>" required><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="ativo" <?php if ($produto['status'] == 'ativo') echo 'selected'; ?>>Ativo</option>
            <option value="inativo" <?php if ($produto['status'] == 'inativo') echo 'selected'; ?>>Inativo</option>
        </select><br><br>

        <input type="submit" name="atualizar" value="Atualizar Produto">
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
