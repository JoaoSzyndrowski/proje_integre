<?php
include("conexao.php");

// Verifica se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do agendamento para preencher o formulário
    $sql = "SELECT * FROM agendamento WHERE id_agenda = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data = $row['data'];
        $hora_inicio = $row['horainicio'];
        $hora_fim = $row['horafim'];
        $status = $row['sts'];
        $id_produto = $row['id_produto'];
        $id_cliente = $row['id_cliente'];
    } else {
        echo "Agendamento não encontrado.";
        exit;
    }
}

// Atualiza os dados quando o formulário for submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $status = $_POST['status'];

    // Query de UPDATE
    $updateSql = "UPDATE agendamento SET data = ?, horainicio = ?, horafim = ?, sts = ? WHERE id_agenda = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('ssssi', $data, $hora_inicio, $hora_fim, $status, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Agendamento atualizado com sucesso!');</script>";
        echo "<script>window.history.back()';</script>";  // Redireciona de volta para a lista
    } else {
        echo "Erro ao atualizar o agendamento: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
</head>
<body>
    <h2>Editar Agendamento</h2>
    <form action="" method="post">
        <label for="data">Data:</label>
        <input type="date" name="data" id="data" value="<?php echo $data; ?>" required><br>

        <label for="hora_inicio">Hora Início:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" value="<?php echo $hora_inicio; ?>" required><br>

        <label for="hora_fim">Hora Fim:</label>
        <input type="time" name="hora_fim" id="hora_fim" value="<?php echo $hora_fim; ?>" required><br>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="concluido" <?php if ($status == 'concluido') echo 'selected'; ?>>Concluído</option>
            <option value="pendente" <?php if ($status == 'pendente') echo 'selected'; ?>>Pendente</option>
            <option value="cancelado" <?php if ($status == 'cancelado') echo 'selected'; ?>>Cancelado</option>
        </select><br>

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
