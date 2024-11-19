<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Login - MisturaSoft</title>
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

        .signup-section input, select, option {
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
    </style>
</head>
<body>
    <div class="container">
        <div class="login-section"> 
            <img src="../imagens/logomini.png" alt="">
            <h1>Seja bem-vindo à MisturaSoft!</h1>
            <br><br><br><br>
            <p>Já tem uma conta?</p>
            <a href="login.php">
            <button>Login</button>
            </a>
        </div>
        <div class="signup-section">
            <form action="../model/auth/processaCad.php" method="POST">
            <h2>Criar Conta</h2>
            <center><input type="text" id="nome" name="nome" placeholder="Nome Completo"></center>
            <center><input type="email" id="email" name="email" placeholder="Email"></center>
            <center><input type="password" id="senha" name="senha" placeholder="Senha"></center>
            <center><select name="userTipo"></center>
            <center><option name="adm" value="adm">Administrador</option></center>
            <center><option name="cliente" value="cliente">Cliente</option></center>
            </select>
            <center><button type="submit">Criar</button></center>
            </form>
        </div>
    </div>
</body>
</html>
