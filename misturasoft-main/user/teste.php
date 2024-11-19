<?php
include("conexao.php");

// Consultar os produtos
$sql = "SELECT * FROM produto";
$resultado = mysqli_query($conn, $sql);

if ($resultado) {
    $produtos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
} else {
    $produtos = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <!-- Adicionando o Bootstrap para estilos básicos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="album py-5 bg-color">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($produtos as $produto): ?>
                    <div class="col mb-4">
                        <a href="ag_brinq.php?id=<?php echo urlencode($produto['id_produto']); ?>" class="text-decoration-none text-body">
                            <div class="card produtos-card">
                                <!-- Verificando se a imagem existe, caso contrário usa a imagem padrão -->
                                <img src="imagens/<?php echo htmlspecialchars($produto['img']) ?: 'default.jpg'; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                                
                                <div class="card-body d-flex flex-column produtos-bg-color">
                                    <div>
                                        <p class="card-text"><?php echo htmlspecialchars($produto['nome']); ?></p>
                                        <p class="card-text"><?php echo htmlspecialchars(substr($produto['descricao'], 0, 100)); ?>...</p> <!-- Descrição truncada -->
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">Adicionar ao carrinho</button>
                                            <button type="button" class="btn btn-success">Comprar</button>
                                        </div>
                                        <small class="text-body-secondary">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
