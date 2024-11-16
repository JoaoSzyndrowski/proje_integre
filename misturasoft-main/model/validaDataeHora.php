<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include("../control/conexao.php");

$idProduto = $_GET['id_produto'];  
$data = $_GET['data']; 
$horaInicio = $_GET['hora_inicio'];  
$horaFim = $_GET['hora_fim']; 

// Verifica se o usuário está logado
if(isset($_SESSION['id'])){   
    $idUser = $_SESSION['id'];
    $sqlNome = "SELECT * FROM usuario WHERE id_usuario = '$idUser';";
    $resultado = $conn->query($sqlNome);
    $rowNome = $resultado->fetch_assoc();
} else {
    echo "Faça login para realizar a compra";
    exit; // Finaliza o script caso o usuário não esteja logado
}

// Verifica se já existe um agendamento para o mesmo produto e data
$sql = "SELECT * FROM agendamento WHERE data = '$data' AND id_produto = $idProduto";
$result = $conn->query($sql);

// Verifica se encontrou algum agendamento para essa data
if($result->num_rows > 0) {
    // Se já existem agendamentos para a data, verifica os horários
    $row = $result->fetch_assoc();
    
    // Verifica se o horário de início já está reservado
    if($horaInicio >= $row['horainicio'] && $horaInicio < $row['horafim']) {
        echo 'O horário de início já foi selecionado para esta data.';
    } elseif($horaFim > $row['horainicio'] && $horaFim <= $row['horafim']) {
        // Verifica se o horário de fim já está reservado
        echo 'O horário de fim já foi selecionado para esta data.';
    } else {
        echo 'O produto está disponível para o horário solicitado!';
        // Aqui você pode inserir o novo agendamento no banco de dados
        $sqlInsert = "INSERT INTO agendamento (data, id_produto, horainicio, horafim, id_usuario,  sts) 
                      VALUES ('$data', $idProduto, '$horaInicio', '$horaFim', '$idUser', 'concluido')";
        
        if($conn->query($sqlInsert) === TRUE) {
            echo 'Agendamento realizado com sucesso!';
        } else {
            echo 'Erro ao realizar o agendamento: ' . $conn->error;
        }
    }
} else {
    // Caso não haja agendamento para a data, você pode inserir o novo agendamento
    echo 'O produto está disponível para o agendamento!';
    $idUser = $_SESSION['id'];
    $sqlInsert = "INSERT INTO agendamento (data, id_produto,horainicio, horafim, id_cliente,  sts) 
                  VALUES ('$data',  $idProduto, '$horaInicio', '$horaFim', '$idUser', 'concluido')";
    
    $conn->query($sqlInsert);
    if($sqlInsert){
        echo "absudbahsbd";
        echo 'Agendamento realizado com sucesso!';
    } else {
        echo 'Erro ao realizar o agendamento: ' . $conn->error;
    }
}

?>
