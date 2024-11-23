<?php
include("../control/conexao.php");

$sql = "SELECT 
            ag_prod_cliente.id_agprodcliente, 
            ag_prod_cliente.id_produto, 
            ag_prod_cliente.id_usuario, 
            ag_prod_cliente.id_agendamento, 
            ag_prod_cliente.hora_inicio, 
            ag_prod_cliente.hora_fim, 
            ag_prod_cliente.endereco,
            produto.nome AS nome_produto,
            usuario.nome AS nome_usuario   
        FROM ag_prod_cliente
        INNER JOIN produto ON ag_prod_cliente.id_produto = produto.id_produto
        INNER JOIN usuario ON ag_prod_cliente.id_usuario = usuario.id_usuario";

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
                <th>Nome Produto</th>
                <th>Nome Usuário</th>
                <th>ID_AGENDAMENTO</th>
                <th>HORA INICIO</th>
                <th>HORA FIM</th>
                <th>ENDERECO</th>
                <th>EDITAR</th>
                <th>EXCLUIR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_agprodcliente']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nome_produto']) . "</td>";  
                    echo "<td>" . htmlspecialchars($row['nome_usuario']) . "</td>"; 
                    echo "<td>" . htmlspecialchars($row['id_agendamento']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['hora_inicio']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['hora_fim']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['endereco']) . "</td>";
                    echo "<td><a href='../model/ag_prod/editarAgProd.php?id=" . $row['id_agprodcliente'] . "'>Editar</a></td>";
                    echo "<td><a href='../model/ag_prod/excluirAgProd.php?id=" . $row['id_agprodcliente'] . "'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Nenhum agendamento encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
