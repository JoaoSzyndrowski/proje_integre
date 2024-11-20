<?php
include("../control/conexao.php");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Consulta para pegar os dados do usuário
    $sql = "SELECT id_usuario, nome, email FROM usuario WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Se o formulário de confirmação for enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Exclui o usuário
        $delete_usuario_sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $delete_usuario_stmt = $conn->prepare($delete_usuario_sql);

        if ($delete_usuario_stmt === false) {
            die("Erro na preparação da consulta de exclusão de usuário: " . $conn->error);
        }

        $delete_usuario_stmt->bind_param("i", $id_usuario);

        // Executa a exclusão
        if ($delete_usuario_stmt->execute()) {
            echo "<script type='text/javascript'>
                    alert('Usuário excluído com sucesso!');
                    window.location.href = '../view/user.php'; // Redireciona para a lista de usuários após a exclusão
                  </script>";
            exit;
        } else {
            echo "Erro ao excluir o usuário: " . $conn->error;
        }
    }
} else {
    echo "ID do usuário não foi fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário</title>
</head>
<body>
    <h1>Deseja excluir o usuário?</h1>

    <p><strong>ID:</strong> <?php echo htmlspecialchars($usuario['id_usuario']); ?></p>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>

    <form method="POST">
        <input type="submit" value="Confirmar Exclusão">
        <a href="listar_usuarios.php">Cancelar</a> <!-- Ou onde você preferir redirecionar em caso de cancelamento -->
    </form>
</body>
</html>
