<?php
// Incluir o arquivo onde a função de login está definida
include_once 'funcoes.php';  // Ajuste o caminho conforme necessário

// Verificar se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $email = $_POST['email'];
    $senhaForm = $_POST['senha'];

    // Chama a função de login
    login($email, $senhaForm);
}
?>
