<?php
include("../control/conexao.php");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se o ID do cliente foi passado na URL
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    // exclui cliente :3
    $delete_cliente_sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $delete_cliente_stmt = $conn->prepare($delete_cliente_sql);

    if ($delete_cliente_stmt === false) {
        die("Erro na preparação da consulta de exclusão de cliente: " . $conn->error);
    }

    $delete_cliente_stmt->bind_param("i", $id_cliente);

    // exclui cliente do agendamento caso ele tenha feito algum agendamento =3
    $delete_agenda_sql = "DELETE FROM agendamento WHERE id_cliente = ?";
    $delete_agenda_stmt = $conn->prepare($delete_agenda_sql);

    if ($delete_agenda_stmt === false) {
        die("Erro na preparação da consulta de exclusão de cliente: " . $conn->error);
    }

    $delete_agenda_stmt->bind_param("i", $id_cliente);

    // executa a exclusao do cliente e do cliente na agenda :3
    if ($delete_agenda_stmt->execute() && $delete_cliente_stmt->execute()) {
        sleep(5);
            echo "<script type='text/javascript'>
            alert('alteracao feita com xuxexo'); // Mensagem do alerta
            window.location.href = '../view/cliente.php'; // Redireciona após o alerta
            </script>";
        exit;
    } else {
        echo "Erro ao excluir cliente: " . $delete_agenda_stmt->error . $delete_cliente_stmt->error; // Exibe o erro
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
    <title>Excluir Cliente</title>
</head>
<body>
    <h1>Deseja excluir o cliente?</h1>

    <?php
    // Verifica o ID na URL e exibe os dados do cliente
    if (isset($_GET['id'])) {
        $id_cliente = $_GET['id'];
        
        // Consulta para pegar os dados do cliente
        $sql = "SELECT * FROM cliente WHERE id_cliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        $result = $stmt->get_result();
        $cliente = $result->fetch_assoc();

        if ($cliente) {
            echo "<p><strong>ID:</strong> " . htmlspecialchars($cliente['id_cliente']) . "</p>";
            echo "<p><strong>Nome:</strong> " . htmlspecialchars($cliente['nome']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($cliente['email']) . "</p>";
            echo "<p><strong>Telefone:</strong> " . htmlspecialchars($cliente['telefone']) . "</p>";
            echo "<p><strong>Endereço:</strong> " . htmlspecialchars($cliente['endereco']) . "</p>";
            echo "<p><strong>CPF:</strong> " . htmlspecialchars($cliente['cpf']) . "</p>";
        } else {
            echo "Cliente não encontrado.";
            exit;
        }
    } else {
        echo "ID do cliente não foi fornecido.";
        exit;
    }
    ?>

    <form method="POST">
        <input type="submit" value="Confirmar Exclusão">
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
