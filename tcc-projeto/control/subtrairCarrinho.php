<?php

    if(isset($_GET["chave"])){
        $chaveProduto = $_GET["chave"];
    } else{
        $chaveProduto = "";
    }
    require_once "funcoesCarrinho.php";
    $validacao = alterarQtdeCarrinho($chaveProduto, -1);
    if($validacao == true){
        header("Location:../view/carrinho.php");
    } else{
        header("Location:../view/carrinho.php?msg=Não foi possível alterar a quantidade do produto.");
    }

?>