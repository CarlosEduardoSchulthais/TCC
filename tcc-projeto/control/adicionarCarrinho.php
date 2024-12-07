<?php
    require "funcoesCarrinho.php";
    if(isset($_GET["addID"]) && isset($_GET["referencia"]) && isset($_GET["nome"]) && isset($_GET["preco"]) && isset($_GET["modelo"])){
        $idProduto = $_GET["addID"];
        $referencia = $_GET["referencia"];
        $nome = $_GET["nome"];
        $preco = $_GET["preco"];
        $modelo = $_GET["modelo"];
    } else{
        $idProduto = "";
        $referencia = "";
        $nome = "";
        $preco = "";
        $modelo = "";
    }

    $qtde = $_POST["inputQuantidade"];
    $cor = $_POST["listaCoresProduto"];
    if(isset($_POST["listaTamanhosProduto"])){
        $tamanho = $_POST["listaTamanhosProduto"];
    } else{
        $tamanho = "";
    }

    $msgErro = validarCarrinho($qtde, $cor, $tamanho, $idProduto);
    if(empty($msgErro)){
        inserirCarrinho($idProduto, $referencia, $nome, $qtde, $tamanho, $cor, $preco, $modelo);
        header("Location:../view/dadosProdutoCliente.php?id=$idProduto&msg=Produto inserido no carrinho.");
    } else{
        header("Location:../view/dadosProdutoCliente.php?id=$idProduto&msg=$msgErro");
    }




    

    

?>