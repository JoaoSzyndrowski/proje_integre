<?php
include("conexao.php");


if (isset($_GET['id'])) {

    $id_produto = $_GET['id'];
    $sql = "SELECT * FROM produto WHERE id_produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();

    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }

    if (isset($_POST['confirmar'])) {
        $delete_sql = "DELETE FROM produto WHERE id_produto = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $id_produto);
        
        if ($delete_stmt->execute()) {
            sleep(5);
            echo "<script type='text/javascript'>
            alert('alteracao feita com xuxexo'); // Mensagem do alerta
            window.location.href = '../../view/brinquedo.php'; // Redireciona após o alerta
            </script>";
            exit;
        } else {
            echo "Erro ao excluir produto.";
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
    <title>Excluir Produto</title>
</head>
<body>
    <h1>Deseja excluir o produto?</h1>
    <p><strong>ID:</strong> <?php echo htmlspecialchars($produto['id_produto']); ?></p>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($produto['nome']); ?></p>
    <p><strong>Descrição:</strong> <?php echo htmlspecialchars($produto['descricao']); ?></p>
    <p><strong>Preço:</strong> R$ <?php echo htmlspecialchars($produto['preco']); ?></p>

    <form method="POST">
        <input type="submit" name="confirmar" value="Confirmar Exclusão">
        <a href="index.php">Cancelar</a> 
    </form>
</body>
</html>
