<?php
session_start();
function criarLogin($nome, $email, $senhaForm,$telefone,$endereco,$cpf)
{

    include("conexao.php");

    $email = $conn->real_escape_string($email);

    $sql = "SELECT id_usuario FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Este email já está cadastrado.";
        return;
    }

    $senha = password_hash($senhaForm, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }
    $sqlCliente="INSERT INTO cliente (nome,email,telefone,endereco,cpf) 
    VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sqlCliente);
    $stmt->bind_param('sssss', $nome, $email, $telefone, $endereco, $cpf);

    if ($stmt->execute()) {
        echo "Cadastro cliente realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }
    $conn->close();
    
}


function login($email, $senhaForm)
{
    include("conexao.php");

    $email = $conn->real_escape_string($email);
    $sql = "SELECT id_usuario, nome, email, senha FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($senhaForm, $row['senha'])) {
            session_start();
            $_SESSION['id_user'] = $row['id_usuario'];
            $_SESSION['user'] = $row['nome'];
            header("Location: /tccJAO/proje_integre/misturasoft-main/user/index.php");
            exit();
        } else {
            return "Senha incorreta.";
        }
    } else {
        return "Usuário não encontrado.";
    }
}


function cadastraAg($idProduto, $data, $horaInicio, $horaFim)
{
    include("conexao.php");

    if (!isset($_SESSION['id_user'])) {
        echo "Faça login para realizar o agendamento";
        exit;
    }

    $idUser = $_SESSION['id_user']; 

    $sql = "SELECT * FROM agendamento WHERE data = ? AND id_produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $data, $idProduto);
    $stmt->execute();
    $result = $stmt->get_result();
    $idAgendamento = null;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($horaInicio >= $row['horainicio'] && $horaInicio < $row['horafim']) {
            echo "<script type='text/javascript'>
                    alert('O horário de início já foi selecionado para esta data.');
                  </script>";
        } elseif ($horaFim > $row['horainicio'] && $horaFim <= $row['horafim']) {
            echo "<script type='text/javascript'>
                    alert('O horário de fim já foi selecionado para esta data.');
                  </script>";
        } elseif ($horaFim == $horaInicio) { 
            echo "<script type='text/javascript'>
                    alert('Os horários são iguais.');
                  </script>";
        } else {
            echo 'O produto está disponível para o horário solicitado!';
            $sqlInsert = "INSERT INTO agendamento (data, id_produto, horainicio, horafim, id_cliente, sts) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sqlInsert);
            $sts = 'concluido';
            $stmt->bind_param('ssssss', $data, $idProduto, $horaInicio, $horaFim, $idUser, $sts);

            if ($stmt->execute()) {  
                $idAgendamento = mysqli_insert_id($conn);
                echo 'Agendamento realizado com sucesso!';
                echo "ID do usuário: " . $idUser;  
            } else {
                echo 'Erro ao realizar o agendamento: ' . $stmt->error;
            }
        }
    } else {
        echo 'O produto está disponível para o agendamento!';
        $sqlInsert = "INSERT INTO agendamento (data, id_produto, horainicio, horafim, id_cliente, sts) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlInsert);
        $sts = 'concluido'; 
        $stmt->bind_param('ssssss', $data, $idProduto, $horaInicio, $horaFim, $idUser, $sts);

        if ($stmt->execute()) {
            $idAgendamento = mysqli_insert_id($conn);
        } else {
            echo 'Erro ao realizar o agendamento: ' . $stmt->error;
        }
    }

    return $idAgendamento; 
}
function cadastraAgProd($idProduto, $idUser, $hora_inicio, $hora_fim, $endereco, $idAgendamento)
{
    include("conexao.php");  

    if (empty($idUser)) {
        echo "Usuário não encontrado. Faça login para realizar o agendamento.";
        exit; 
    }
    if($endereco){
        echo $endereco;
    }

    // insere o relacionamento na tabela ag_prod_cliente
    $sqlInsertAgProd = "INSERT INTO ag_prod_cliente (id_produto, id_usuario, id_agendamento, hora_inicio, hora_fim, endereco) 
                        VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlInsertAgProd);
    $stmt->bind_param('iissss', $idProduto, $idUser, $idAgendamento, $hora_inicio, $hora_fim, $endereco);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
            alert('CADASTRO REALIZADO COM SUCESSO!');
            window.location.href = '/tccJAO/proje_integre/misturasoft-main/user/'; // Redireciona para a página anterior ou para uma página específica
          </script>";
            exit;
    } else {
        echo 'Erro ao vincular agendamento e produto: ' . $stmt->error;
    }
    $conn->close();
}
