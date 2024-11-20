<?php
include("../control/conexao.php");

if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    $sql = "SELECT * FROM cliente WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();

    if (!$cliente) {
        echo "cliente nao encontrado.";
        exit;
    }

    if (isset($_POST['atualizar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $cpf = $_POST['cpf'];

        //codigo do update

        $update_sql = "UPDATE cliente SET nome = ?, email = ?, telefone = ?, endereco = ?, cpf = ? WHERE id_cliente = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssssi", $nome, $email, $telefone, $endereco, $cpf, $id_cliente);
        
        if ($update_stmt->execute()) {
            sleep(5);
            echo "<script type='text/javascript'>
            alert('alteracao feita com xuxexo'); // Mensagem do alerta
            window.location.href = '../view/cliente.php'; // Redireciona após o alerta
            </script>";
        exit;
        } else {
            echo "Erro ao atualizar cliente.";
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
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($cliente['endereco']); ?>" required><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cliente['cpf']); ?>" required><br><br>

        <input type="submit" name="atualizar" value="Atualizar Cliente">
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
