<?php
    require "../model/produtoDAO.php";
    require "funcoes.php";
    $id = $_POST["idProduto"];
    $referencia = $_POST["txtReferenciaProduto"];
    $nome = $_POST["txtNomeProduto"];
    $preco = $_POST["txtPreco"];
    $descricao = $_POST["txtDescricao"];
    $qtdestoque = $_POST["txtEstoque"];
    $foto = $_FILES["img"];
    $modelo = "M";
    $coresSelecionadas = isset($_POST['cores']) ? $_POST['cores'] : [];
    $tamanhosSelecionados = isset($_POST['tamanhos']) ? $_POST['tamanhos'] : [];
    $ativo = 1;

    if(empty($id) | $id === null || $id === ''){
        $msgErro = validarProduto($referencia, $nome, $preco, $descricao, $qtdestoque, $foto, $coresSelecionadas, $tamanhosSelecionados);
    } else{
        $msgErro = validacaoAlterarProduto($referencia, $nome, $preco, $descricao, $qtdestoque, $foto, $coresSelecionadas, $tamanhosSelecionados);
    }
    if(empty($msgErro)){
        if(empty($id) | $id === null || $id === ''){
            inserirProduto($referencia, $nome, $preco, $descricao, $qtdestoque, $foto, $modelo, $coresSelecionadas, $tamanhosSelecionados, $ativo);
            header("Location:../view/cadastroProdutoMasculino.php?msg=Produto inserido com sucesso.");
        } else{
            alterarProduto($referencia, $nome, $preco, $descricao, $qtdestoque, $foto, $modelo, $coresSelecionadas, $tamanhosSelecionados, $id);
            header("Location:../view/cadastroProdutoMasculino.php?msg=Produto alterado com sucesso.");
        }
    } else{
        header("Location:../view/cadastroProdutoMasculino.php?msg=$msgErro");
    }


?>