<?php
// Verifique se o parâmetro 'id' está presente na URL
$idProduto = isset($_GET['id']) ? $_GET['id'] : null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #6fae42;
            width: 90%;
            max-width: 600px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
            text-align: center;
        }

        .container h2 {
            font-size: 24px;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .calendar {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .time-section {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
        }

        .time-section label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .time-section input[type="time"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #ffffff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .back-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .submit-button {
            background-color: #ffffff;
            color: #6fae42;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #e0e0e0;
        }

        /* decoraçao */
        .decorative-left, .decorative-right {
            position: absolute;
            width: 80px;
            height: 80px;
            background-color: #ff7f50;
            border-radius: 50%;
        }

        .decorative-left {
            top: -30px;
            left: -30px;
        }

        .decorative-right {
            bottom: -30px;
            right: -30px;
        }

        /* Responsividade */
        @media (max-width: 480px) {
            .time-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="decorative-left"></div>
        <div class="decorative-right"></div>

        <h2>AGENDAMENTO</h2>
        <form action="../model/auth/processaAg.php" method="POST">
            <div class="calendar">
                <!-- calendário -->
                <input type="date" name="data" required>
            </div>

            <div class="time-section">
                <div>
                    <label for="start-time">Hora Inicial</label>
                    <input type="time" id="start-time" name="hora_inicio" required>
                </div>
                <div>
                    <label for="end-time">Hora Final</label>
                    <input type="time" id="end-time" name="hora_fim" required>
                </div>
            </div>

            <!-- Passando o ID do produto para a página de validação -->
            <input type="hidden" name="id_produto" value="<?php echo $idProduto; ?>">

            <a href="brinquedos.php" class="back-link">Voltar para os brinquedos</a>
            <button type="submit" class="submit-button">Concluir</button>
        </form>
    </div>
</body>
</html>
