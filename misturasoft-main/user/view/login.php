<?php

include_once '../model/auth/funcoes.php';  

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senhaForm = $_POST['senha'];
    
    $mensagem = login($email, $senhaForm);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login MisturaSoft</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 800px;
            height: 500px;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            border-radius: 10px;
        }

        .login-section, .signup-section {
            flex: 1;
            padding: 40px;
        }

        .login-section {
            background-color: #141414;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-section img {
            width: 50px;
            margin-bottom: 20px;
        }

        .login-section h1 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .login-section p {
            margin-bottom: 40px;
            font-size: 16px;
        }

        .login-section button {
            background-color: #6fae42;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .login-section button:hover {
            background-color: #5b8d36;
        }

        .signup-section {
            background-color: #6fae42;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signup-section h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .signup-section label {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .signup-section input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
        }

        .signup-section button {
            background-color: #141414;
            color: #ffffff;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .signup-section button:hover {
            background-color: #333333;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }
            .login-section, .signup-section {
                padding: 20px;
            }
        }

        .mensagem {
            text-align: center;
            margin-bottom: 15px;
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Seção de Boas-vindas -->
    <div class="login-section">
        <img src="../imagens/logomini.png" alt="Logo">
        <h1>Seja bem-vindo à MisturaSoft!</h1>
        <p>Não tem uma conta?</p>
        <a href="criaLogin.php">
            <button>Cadastro</button>
        </a>
    </div>

    <!-- Seção de Login -->
    <div class="signup-section">
        <h2>Logar</h2>

        <!-- Exibição de mensagens -->
        <?php if (!empty($mensagem)): ?>
            <div class="mensagem"><?php echo htmlspecialchars($mensagem); ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            <button type="submit">Logar</button>
        </form>
    </div>
</div>
</body>
</html>
