<?php
include("conexao.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteSql = "DELETE FROM agendamento WHERE id_agenda = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Agendamento excluído com sucesso!');</script>";
        echo "<script>window.history.back();</script>";  // Redireciona de volta para a lista
    } else {
        echo "Erro ao excluir o agendamento: " . $stmt->error;
    }
} else {
    echo "ID não especificado.";
}

$conn->close();
?>
