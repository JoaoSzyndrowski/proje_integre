<?php
// sem isso, nem eu funciono
include("conexao.php");


$limite = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $limite;


$sql = "SELECT * FROM produto LIMIT $limite OFFSET $offset";
$resultado = mysqli_query($conn, $sql);

if ($resultado) {
    $produtos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
} else {
    $produtos = [];
}
//conta prod
$sql_total = "SELECT COUNT(*) AS total FROM produto";
$resultado_total = mysqli_query($conn, $sql_total);
$total_produtos = mysqli_fetch_assoc($resultado_total)['total'];

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brinquedos - MisturaSoft</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f2f2f2;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 400px;
        }

        .search-bar button {
            background-color: #6fae42;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .search-bar button:hover {
            background-color: #5b8d36;
        }

        .products {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-card {
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            overflow: hidden;
            margin-right: 20px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            flex: 1;
        }

        .product-info h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .product-info p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .product-card button {
            background-color: #6fae42;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .product-card button:hover {
            background-color: #5b8d36;
        }

        .load-more {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #6fae42;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .load-more:hover {
            background-color: #5b8d36;
        }
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                flex-direction: column;
                gap: 10px;
            }

            .product-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .product-image {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="/misturasoft-main/imagens/logo.png" alt="" height="100" width="230">
            </div>
            <nav>
                <ul>
                    <li><a href="/misturasoft-main/iniciologado.html">Início</a></li>
                    <li><a href="#">Brinquedos</a></li>
                    <li><a href="sobre.php">Sobre nós</a></li>
                </ul>
            </nav>
        </header>
        
        <div class="search-bar">
            <input type="text" placeholder="Pesquisar brinquedo">
            <button>🔍</button>
        </div>

        <h2>Brinquedos</h2>
        
        <div class="products">
    <?php foreach ($produtos as $produto): ?>
        <a href="ag_brinq.php?id=<?php echo urlencode($produto['id_produto']); ?>" class="product-link">
            <div class="product-card" id="product-<?php echo $produto['id_produto']; ?>"> <!-- Adicionando o id dinâmico -->
                <div class="product-image">
                    <img src="imagens/<?php echo htmlspecialchars($produto['img']) ?: 'default.jpg'; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                </div>
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($produto['descricao'], 0, 100)); ?>...</p> <!-- Descrição truncada -->
                </div>
                <button>Reservar</button>
            </div>
        </a>
    <?php endforeach; ?>
</div>

        <?php if ($pagina * $limite < $total_produtos): ?>
            <div style="text-align: center; margin-top: 20px;">
                <a href="?pagina=<?php echo $pagina + 1; ?>">
                    <button class="load-more">Carregar Mais</button>
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
