<!DOCTYPE html>
<html>
<head>
    <title>Fechamento</title>
</head>
<body>
    <h1> Fechamento</h1>
    
    <h1>Resumo da Compra</h1>

    <h2>Itens no Carrinho:</h2>
   

    
    <ul>
        <?php
        require 'Produto.php'; 
        session_start();

        $total = 0;

        if (isset($_POST['fechar_carrinho'])) {
            $produtosNoCarrinho = $_SESSION['Carrinho'] ?? array();
            $produtos = $_SESSION['Produtos'] ?? array();

            foreach ($produtosNoCarrinho as $produtoIndex) {
                $produto = $produtos[$produtoIndex];
                echo "<li>";
                echo "<h2>" . $produto->nome . "</h2>";
                echo "<p>Descrição: " . $produto->descricao . "</p>";
                echo "<p>Preço: R$" . $produto->preco . "</p>";
                echo "<img src='" . $produto->caminhoImagem . "' alt='Imagem do Produto'>";
                echo "</li>";

                $total += $produto->preco;
            }
        } else {
            echo "<p>O carrinho está vazio.</p>";
        }
        ?>
    </ul>

    <p><strong>Total: R$ <?php echo number_format($total, 2); ?></strong></p>

    <h2>Informações do Cliente:</h2>
    <form method="post" action="processar_compra.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required><br>

        <input type="submit" value="Finalizar Compra">
    </form>
</body>
</html>
