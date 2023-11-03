<?php
require 'Produto.php'; 
session_start();

if (isset($_GET['remover'])) {
    $indiceRemover = $_GET['remover'];
    unset($_SESSION['Carrinho'][$indiceRemover]);
    $_SESSION['Carrinho'] = array_values($_SESSION['Carrinho']);
}

$selecionados = $_SESSION['Carrinho'] ?? array();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrinho</title>
</head>
<body>
    <h1>Produtos</h1>
    <ul>
        <?php
        foreach ($selecionados as $key => $produtoIndex) {
            $produto = $_SESSION['Produtos'][$produtoIndex];
            echo "<li>";
            echo "<h2>" . $produto->nome . "</h2>";
            echo "<p>Descrição: " . $produto->descricao . "</p>";
            echo "<p>Preço: R$" . $produto->preco . "</p>";
            echo "<img src='" . $produto->caminhoImagem . "' alt='Imagem do Produto'>";
            echo "<a href='Carrinho.php?remover=$key'>Remover</a>";
            echo "</li>";
        }
        ?>
    </ul>
    <form method="post" action="Fechamento.php">
        <button type="submit" name="fechar_carrinho">Fechar Carrinho</button>
    </form>
</body>
</html>
