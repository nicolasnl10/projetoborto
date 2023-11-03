<?php
require 'Produto.php';
session_start();


if (!isset($_SESSION['Produtos'])) {
    $produtos = array(
        new Produto("Produto 1", 10.99, "Descrição do Produto 1", "./img/barradecereal.jpeg"),
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
?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <h1>Produtos</h1>
                <form method="post">
                <div class="row row-cols-4">
                        <?php
                        $produtos = $_SESSION['Produtos'];
                        foreach ($produtos as $key => $produto) {
                            echo "<div class='col'>";
                                echo "<div class='card h-100'>";
                                    echo "<img src='" . $produto->caminhoImagem . "' class='card-img-top' alt='Imagem do Produto'>";
                                    echo "<div class='card-body'>";
                                        echo "<h2>" . $produto->nome . "</h2>";
                                        echo "<p>Descrição: " . $produto->descricao . "</p>";
                                        echo "<p>Preço: R$" . $produto->preco . "</p>";
                                        echo "<input type='checkbox' name='selecionado[]' value='$key'> Selecionar";
                                        echo "<button class='btn btn-primary' type='submit' name='adicionar'>Adicionar ao Carrinho</button>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";

                        }
                        ?>
                        <div class="d-grid gap-2 col-6 mx-auto mt-3">
                            <button class='btn btn-success' type="submit" name="enviar_carrinho">Enviar Carrinho</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    
</body>
</html>
