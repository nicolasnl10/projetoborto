<?php
require 'Produto.php';
session_start();




if (!isset($_SESSION['Produtos'])) {
    $produtos = array(
        new Produto("Produto 1", 10.99, "Descrição do Produto 1", "./joystore.jpg"),
        new Produto("Produto 2", 20.99, "Descrição do Produto 2", "imagem2.jpg"),
        new Produto("Produto 3", 30.99, "Descrição do Produto 3", "imagem3.jpg"),
        new Produto("Produto 4", 40.99, "Descrição do Produto 4", "imagem4.jpg"),
        new Produto("Produto 5", 40.99, "Descrição do Produto 5", "imagem5.jpg")
    );




    $_SESSION['Produtos'] = $produtos;
}




if (!isset($_SESSION['Carrinho'])) {
    $_SESSION['Carrinho'] = array();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar'])) {
        if (isset($_POST['selecionado']) && is_array($_POST['selecionado'])) {
            $_SESSION['Carrinho'] = array_merge($_SESSION['Carrinho'], $_POST['selecionado']);
        }
    } elseif (isset($_POST['enviar_carrinho'])) {
        header("Location: Carrinho.php");
        exit;
    }
}
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
        <div class="row row-cols-1">
            <div class="col">
                <h1 class="text-center my-3">Produtos</h1>
            </div>
            <div class="col">
                <form method="post">
                    <div class="row row-cols-4">
                        <?php
                        $produtos = $_SESSION['Produtos'];
                        foreach ($produtos as $key => $produto) {
                            echo "<div class='col mt-2'>";
                            echo "<div class='card h-100'>";
                            echo "<img src='" . $produto->caminhoImagem . "' class='card-img-top' alt='Imagem do Produto'>";
                            echo "<div class='card-body'>";
                            echo "<h2>" . $produto->nome . "</h2>";
                            echo "<p>Descrição: " . $produto->descricao . "</p>";
                            echo "<p>Preço: R$" . $produto->preco . "</p>";
                            echo "<input type='checkbox' name='selecionado[]' value='$key'> Selecionar";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto mt-3">
                        <button class='btn btn-success' type="submit" name="enviar_carrinho">Enviar Carrinho</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <footer class="py-3 my-4">
            <p class="text-center text-body-secondary">© 2023 Joy Store, Inc</p>
        </footer>
    </div>


</body>


</html>