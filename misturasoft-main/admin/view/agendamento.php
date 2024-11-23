<?php
include("../control/conexao.php");

$sql = "SELECT * FROM agendamento";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>DATA</th>
                <th>PRODUTO</th>
                <th>HORA_INICIO</th>
                <th>HORA FIM</th>
                <th>CLIENTE</th>
                <th>STATUS</th>
                <th>EDITAR</th>
                <th>EXCLUIR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_agenda']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['data']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_produto']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['horainicio']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['horafim']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_cliente']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['sts']) . "</td>";
                    echo "<td><a href='../model/agendamento/editarAg.php?id=" . $row['id_agenda'] . "'>Editar</a></td>";
                    echo "<td><a href='../model/agendamento/excluirAg.php?id=" . $row['id_agenda'] . "'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
