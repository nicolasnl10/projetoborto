<?php
 include 'header.php'
?>
<body>
<div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <i class="bi bi-basket2 fs-5"></i>
                </a>
            </div>
            <div class="col-md-3 text-end">
                <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="bi bi-cart2"></i> Carrinho
                </button>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Carrinho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul>
                        <?php
                        if (isset($selecionados)) {
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
                        } else {
                            echo '<li>Não existe produtos</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Fechamento</h1>
                <p class="text-center text-muted">Resumo da Compra</h1>
            </div>
        </div>
        <div class="row rounded-3 shadow p-5">
            <div class="col-12">
                <h3 class="text-left">Itens no Carrinho:</h1>
            </div>
            <div class="col-12">
                <ul class="list-group">
                    <?php
                    require 'Produto.php'; 
                    session_start();

                    $total = 0;

                    if (isset($_POST['fechar_carrinho'])) {
                        $produtosNoCarrinho = $_SESSION['Carrinho'] ?? array();
                        $produtos = $_SESSION['Produtos'] ?? array();

                        foreach ($produtosNoCarrinho as $produtoIndex) {
                            $produto = $produtos[$produtoIndex];
                            echo "<li class='list-group-item'>";
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
            </div>
            <div class="col-12">
                <p><strong>Total: R$ <?php echo number_format($total, 2); ?></strong></p>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="text-left">Informações do Cliente:</h3>
                
            </div>
        </div>
            <form method="post" action="processar_compra.php">
                <div class="row">
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Seu Nome" required>
                            <label for="nome">Nome:</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Seu endereco" required>
                            <label for="endereco">Endereco:</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Seu email" required>
                            <label for="email">Email:</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mx-auto">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="Seu telefone" required>
                            <label for="telefone">Telefone:</label>
                        </div>
                    </div>

                        <button class="btn btn-success" type="submit"> Finalizar Compra</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
