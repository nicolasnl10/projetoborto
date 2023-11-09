
<?php
require 'Produto.php'; 
session_start();

if (isset($_GET['remover'])) {
    $indiceRemover = $_GET['remover'];
    unset($_SESSION['Carrinho'][$indiceRemover]);
    $_SESSION['Carrinho'] = array_values($_SESSION['Carrinho']);
}

$selecionados = $_SESSION['Carrinho'] ?? array();

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
                <h1 class="text-center">Produtos</h1>

            </div>
            <div class="col-12">
            <ul class="list-group">
                <?php
                foreach ($selecionados as $key => $produtoIndex) {
                    $produto = $_SESSION['Produtos'][$produtoIndex];
                    echo "<li class='list-group-item'>";
                    echo "<h2>" . $produto->nome . "</h2>";
                    echo "<p>Descrição: " . $produto->descricao . "</p>";
                    echo "<p>Preço: R$" . $produto->preco . "</p>";
                    echo "<img src='" . $produto->caminhoImagem . "' alt='Imagem do Produto'>";
                    echo "<a class='btn btn-danger' href='Carrinho.php?remover=$key'>Remover</a>";
                    echo "</li>";
                }
                ?>
            </ul>
            <form method="post" action="Fechamento.php">
                <button class="btn btn-success" type="submit" name="fechar_carrinho">Fechar Carrinho</button>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
