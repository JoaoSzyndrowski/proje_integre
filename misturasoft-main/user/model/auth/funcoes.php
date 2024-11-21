<?php

// Função para criar um novo usuário
function criarLogin($nome, $email, $senhaForm)
{
    // Inicia a sessão para gerenciar as variáveis de sessão
    session_start();

    include("conexao.php");

    // Escapa os dados para evitar SQL Injection
    $email = $conn->real_escape_string($email);

    // Verifica se o email já está cadastrado
    $sql = "SELECT id_usuario FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Caso o email já exista
        echo "Este email já está cadastrado.";
        return;
    }

    // Criptografa a senha antes de armazená-la
    $senha = password_hash($senhaForm, PASSWORD_DEFAULT);

    // Pega o IP do cliente
    $ip_cliente = $_SERVER['REMOTE_ADDR'];

    // Insere o novo usuário no banco de dados
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nome,  $email, $senha);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    // Fecha a conexão
    $conn->close();
}

// Função para fazer o login
function login($email, $senhaForm)
{
    // Inicia a sessão para acessar as variáveis de sessão
    session_start();

    include("conexao.php");

    // Escapa os dados para evitar SQL Injection
    $email = $conn->real_escape_string($email);

    // Verifica se o usuário existe no banco de dados
    $sql = "SELECT id_usuario, nome, email, senha FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica se a senha fornecida corresponde à senha armazenada
        if (password_verify($senhaForm, $row['senha'])) {
            // Se o login for bem-sucedido, salva as informações do usuário na sessão
            $_SESSION['id_user'] = $row['id_usuario'];
            $_SESSION['user'] = $row['nome'];
            echo "Login bem-sucedido! Bem-vindo, " . htmlspecialchars($row['nome']);
            // Redireciona para a página inicial ou dashboard após login
            header("Location: /tccJAO/proje_integre/misturasoft-main/user/index.php");
            exit(); // Certifique-se de que o código após o header não seja executado
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }

    // Fecha a conexão
    $conn->close();
}

function cadastraAg($idProduto, $data, $horaInicio, $horaFim)
{

    session_start();
    include("conexao.php");

    // Verifica se o usuário está logado
    if (isset($_SESSION['id_user'])) {
        $idUser = $_SESSION['id_user'];
        
    } else {
        echo "Faça login para realizar o agendamento";
        exit; // Finaliza o script caso o usuário não esteja logado
    }


    // Verifica se já existe um agendamento para o mesmo produto e data
    $sql = "SELECT * FROM agendamento WHERE data = ? AND id_produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $data, $idProduto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se já existem agendamentos para a data, verifica os horários
        $row = $result->fetch_assoc();

        // Verifica se o horário de início ou fim já está reservado
        if ($horaInicio >= $row['horainicio'] && $horaInicio < $row['horafim']) {
            echo 'O horário de início já foi selecionado para esta data.';
        } elseif ($horaFim > $row['horainicio'] && $horaFim <= $row['horafim']) {
            echo 'O horário de fim já foi selecionado para esta data.';
        } else {
            echo 'O produto está disponível para o horário solicitado!';
            // Aqui você pode inserir o novo agendamento no banco de dados
            $sqlInsert = "INSERT INTO agendamento (data, id_produto, horainicio, horafim, sts) 
                          VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sqlInsert);
            $sts = 'concluido'; // Define o status
            $stmt->bind_param('sssss',$idProduto, $data, $horaInicio, $horaFim, $sts);
            if ($stmt->execute()) {
                echo 'Agendamento realizado com sucesso!';
            } else {
                echo 'Erro ao realizar o agendamento: ' . $stmt->error;
            }
        }
    } else {
        // Caso não haja agendamento para a data, você pode inserir o novo agendamento
        echo 'O produto está disponível para o agendamento!';
        $sqlInsert = "INSERT INTO agendamento (data, id_produto, horainicio, horafim, id_cliente, sts) 
              VALUES (?, ?, ?, ?, ?, ?)";  // Inclui id_cliente corretamente
        $stmt = $conn->prepare($sqlInsert);
        $idUser = 1;
        // Aqui são passados os valores corretos de acordo com a tabela
        $sts = 'concluido'; // Define o status
        $stmt->bind_param('ssssss', $data, $idProduto, $horaInicio, $horaFim, $idUser, $sts);

        if ($stmt->execute()) {
            echo 'Agendamento realizado com sucesso!';
        } else {
            echo 'Erro ao realizar o agendamento: ' . $stmt->error;
        }
    }

    // Fecha a conexão
    $conn->close();
}
