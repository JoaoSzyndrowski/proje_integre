<?php
include("../control/conexao.php");

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Consulta para pegar os dados do usuário
    $sql = "SELECT id_usuario, nome, email FROM usuario WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows == 0) {
        die("Usuário não encontrado.");
    }

    $user = $result->fetch_assoc();
}

// Atualiza os dados do usuário quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualiza as informações do usuário no banco de dados
    $update_sql = "UPDATE usuario SET nome = ?, email = ? WHERE id_usuario = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $nome, $email, $id_usuario);

    if ($update_stmt->execute()) {
        echo "<script type='text/javascript'>
                    alert('Usuário excluído com sucesso!');
                    window.location.href = '../view/user.php'; // Redireciona para a lista de usuários após a exclusão
                  </script>";
            exit;// Redireciona para a lista de usuários após a atualização
    } else {
        echo "Erro ao atualizar o usuário: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <br><br>

        <button type="submit">Atualizar</button>
    </form>
    <br>
    <a href="../view/user.php   ">Voltar para a lista</a>
</body>
</html>
