<?php
include("../control/conexao.php");
session_start();
$idUser = $_SESSION['id_user'];


var_dump($idUser);  

$sql = "
    SELECT 
        agendamento.id_agenda, 
        agendamento.data, 
        produto.nome AS nome_produto,  -- Nome do produto
        agendamento.horainicio, 
        agendamento.horafim, 
        cliente.nome AS nome_cliente,  -- Nome do cliente
        agendamento.sts, 
        agendamento.horaInsert
    FROM 
        agendamento
    INNER JOIN 
        produto ON agendamento.id_produto = produto.id_produto  -- Relaciona com a tabela produtos
    INNER JOIN 
        cliente ON agendamento.id_cliente = cliente.id_cliente  -- Relaciona com a tabela clientes
    WHERE 
        agendamento.id_cliente = ?";  // Usando o ? como placeholder para o prepared statement

// Prepara a declaração SQL
$stmt = $conn->prepare($sql);

// Verifica se a preparação foi bem-sucedida
if (!$stmt) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

// Vincula o parâmetro (idUser) ao prepared statement
$stmt->bind_param("i", $idUser);

// Executa a consulta
$stmt->execute();

// Obtém o resultado
$result = $stmt->get_result();

// Verifica se a consulta retornou algum resultado

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
    <th>
        id_agenda
    </th>    
    <th>
        data
    </th>
    <th>
        nome produto
    </th>
    <th>
        horainicio
    </th>
    <th>
        horafim
    </th>
    <th>
        nome cliente
    </th>
    <th>
        sts
    </th>
    <th>
        editar
    </th>
    <th>
        excluir
    </th>
    <?php
    if ($result->num_rows > 0) {
    // Exibe os dados na tabela
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id_agenda']) . "</td>";
        echo "<td>" . htmlspecialchars($row['data']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nome_produto']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['horainicio']) . "</td>";
        echo "<td>" . htmlspecialchars($row['horafim']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nome_cliente']) . "</td>";  
        echo "<td>" . htmlspecialchars($row['sts']) . "</td>";
        echo "<td><a href='#' onclick='alert(\"Entre em contato com nossos colaboradores para editar seu agendamento: WPP  48 99661-8098 e informe seu ID de Agendamento: " . $row['id_agenda'] . "\");'>Editar</a></td>";
        echo "<td><a href='#' onclick='alert(\"Entre em contato com nossos colaboradores para editar seu agendamento: WPP  48 99661-8098 e informe seu ID de Agendamento: " . $row['id_agenda'] . "\");'>Editar</a></td>";
        echo "</tr>";
    }
} else {
    // Se não houver resultados
    echo "<tr><td colspan='9'>Nenhum agendamento encontrado.</td></tr>";
}
    ?></table>
</body>
</html>
