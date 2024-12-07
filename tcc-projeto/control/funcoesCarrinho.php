<?php
    require_once "../model/conexaoBD.php";
    session_start();
    function inserirCarrinho($idProduto, $referencia, $nome, $qtde, $tamanho, $cor, $preco, $modelo){
        $chaveProduto = $idProduto . '-' . $tamanho . '-' . $cor;
        if (!isset($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = [];
        }
    
        // Verificar se o produto já existe no carrinho
        if (isset($_SESSION["carrinho"][$chaveProduto])) {
            // Se o produto já existe, apenas atualiza a quantidade
            $_SESSION["carrinho"][$chaveProduto]["qtde"] += $qtde;
        } else {
            // Se o produto não existe, adiciona como novo item
            $_SESSION["carrinho"][$chaveProduto] = array(
                "idProduto" => $idProduto,
                "referencia" => $referencia,
                "nome" => $nome,
                "qtde" => $qtde,
                "tamanho" => $tamanho,
                "cor" => $cor,
                "preco" => $preco,
                "modelo" => $modelo
            );
        }
    }

    function validarCarrinho($qtde, $cor, $tamanho, $idProduto){
        $msgErro = "";
        if($qtde < 0){
            $msgErro = $msgErro . "Insira uma quantidade válida.<br>";
        }
        $conexao = conectarBD();
        $sql = "SELECT * FROM produto WHERE idProduto = $idProduto";
        $res = mysqli_query($conexao, $sql);
        $registro = mysqli_fetch_assoc($res);
        $qtdEstoque = $registro["qtdestoque"];
        if($qtde > $qtdEstoque){
            $msgErro = $msgErro . "Quantidade maior do que a que possuímos no estoque.<br>";
        }
        if($cor == ""){
            $msgErro = $msgErro . "Selecione uma cor.<br>";
        }
        if($tamanho == ""){
            $msgErro = $msgErro . "Selecione um tamanho.<br>";
        }
        return $msgErro;
    }

    function alterarQtdeCarrinho($chaveProduto, $quantidade) {
        if (isset($_SESSION['carrinho'][$chaveProduto])) {
            $_SESSION['carrinho'][$chaveProduto]['qtde'] += $quantidade;
            if ($_SESSION['carrinho'][$chaveProduto]['qtde'] <= 0) {
                unset($_SESSION['carrinho'][$chaveProduto]); // Remove o item se a quantidade for 0 ou menor
            }
            return true;
        } else{
            return false; // Retorna falso se o produto não estava no carrinho
        }
    }
    
    function removerCarrinho($chaveProduto) {
        if (isset($_SESSION['carrinho'][$chaveProduto])) {
            unset($_SESSION['carrinho'][$chaveProduto]);
            return true;
        } else{
            return false; // Retorna falso se o produto não estava no carrinho
        }
    }

    function obterQuantidadeProduto($idProduto) {
        if (isset($_SESSION['carrinho'][$idProduto])) {
            return $_SESSION['carrinho'][$idProduto]['quantidade'];
        }
        return 0;
    }
    
    // Calcula o subtotal para o produto específico
    function calcularSubtotal($idProduto) {
        if (isset($_SESSION['carrinho'][$idProduto])) {
            $quantidade = $_SESSION['carrinho'][$idProduto]['quantidade'];
            $preco = $_SESSION['carrinho'][$idProduto]['preco'];
            return $quantidade * $preco;
        }
        return 0;
    }
    
    // Calcula o total atualizado do carrinho
    function calcularTotalCarrinho() {
        $total = 0;
        if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $item) {
                $total += $item['quantidade'] * $item['preco'];
            }
        }
        return $total;
    }

    function validarVenda($idProduto, $qtde, $carrinho){
        $msgErro = "";
        $conexao = conectarBD();
        $sql = "SELECT * FROM produto WHERE idProduto = $idProduto";
        $res = mysqli_query($conexao, $sql);
        $registro = mysqli_fetch_assoc($res);
        $qtdEstoque = $registro["qtdestoque"];
        if($qtde > $qtdEstoque){
            $msgErro = $msgErro . "Quantidade maior do que a que possuímos no estoque.<br>";
        }
        if(count($carrinho) <= 0){
            $msgErro = $msgErro . "Não existem produtos.<br>";
        }
        return $msgErro;
    }


?>