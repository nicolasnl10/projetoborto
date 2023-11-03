<?php
class Produto {
    public $nome;
    public $preco;
    public $descricao;
    public $caminhoImagem;

    public function __construct($nome, $preco, $descricao, $caminhoImagem) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->caminhoImagem = $caminhoImagem;
    }
}
?>
