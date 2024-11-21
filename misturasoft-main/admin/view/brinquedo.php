<?php
include("../control/conexao.php");

$sql = "SELECT * FROM produto";
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
        <a href="../model/prod/inserirProd.php">inserir prods</a>
        <thead>
            <tr>
                <th>ID</th>
                <th>PRECO</th>
                <th>NOME</th>
                <th>DESCRICAO</th>
                <th>TAMANHO</th>
                <th>FAIXA ETARIA</th>
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
                    echo "<td>" . htmlspecialchars($row['id_produto']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['preco']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tamanho']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['faixa_etaria']) . "</td>"; 
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td><a href='../model/prod/editarProd.php?id=" . $row['id_produto'] . "'>Editar</a></td>";
                    echo "<td><a href='../model/prod/excluirProd.php?id=" . $row['id_produto'] . "'>Excluir</a></td>";
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
