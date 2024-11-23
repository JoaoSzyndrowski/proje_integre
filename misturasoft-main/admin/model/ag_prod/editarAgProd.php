<?php
include("conexao.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "SELECT * FROM ag_prod_cliente WHERE id_agprodcliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_produto = $row['id_produto'];
        $id_usuario = $row['id_usuario'];
        $id_agendamento = $row['id_agendamento'];
        $hora_inicio = $row['hora_inicio'];
        $hora_fim = $row['hora_fim'];
        $endereco = $row['endereco'];
    } else {
        echo "Agendamento não encontrado.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $endereco = $_POST['endereco'];

    $updateSql = "UPDATE ag_prod_cliente SET hora_inicio = ?, hora_fim = ?, endereco = ? WHERE id_agprodcliente = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('sssi', $hora_inicio, $hora_fim, $endereco, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Agendamento atualizado com sucesso!');</script>";
        echo "<script>window.history.back()</script>";  
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
        <label for="hora_inicio">Hora Início:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" value="<?php echo $hora_inicio; ?>" required><br>

        <label for="hora_fim">Hora Fim:</label>
        <input type="time" name="hora_fim" id="hora_fim" value="<?php echo $hora_fim; ?>" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" value="<?php echo $endereco; ?>" required><br>

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
