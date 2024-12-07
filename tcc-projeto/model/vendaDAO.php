<?php

    include_once "conexaoBD.php";    
    static $conexao;

    function inserirVenda($idCliente) {
        $conexao = conectarBD();  

        $sql = "INSERT INTO venda (dtVenda, valorVenda, cliente_idCliente) "
                . "VALUES ( NOW(), 0.0, $idCliente ) ";
        
        mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
        $id = mysqli_insert_id($conexao);
        return $id;
    }


    function inserirItemVenda($idProduto, $idVenda, $qtde, $cor, $tamanho){
        $conexao = conectarBD();  

        $sql = "INSERT INTO itensvenda (produto_idProduto, venda_idVenda, qtdProduto, cor_idcor, tamanho_idtamanho) "
                . "VALUES ($idProduto, $idVenda, $qtde, $cor, $tamanho)";
        
        mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
    }

    
    function alterarTotal ($idVenda, $total) {
        $conexao = conectarBD();  
        
        $sql = "UPDATE Venda SET valorVenda = $total WHERE idVenda = $idVenda";
        mysqli_query($conexao, $sql) or die (mysqli_error($conexao));        
    }

    function pesquisarVenda($pesq, $tipo){
        $conexao = conectarBD();
        $sql = "";
        switch ($tipo) {
            case 0:
                    $sql = $sql . "SELECT * FROM venda";
                    break;
            case 1: // Por CNPJ
                    $sql = $sql . "SELECT * FROM venda v INNER JOIN cliente c ON v.cliente_idCliente = c.idCliente WHERE c.cnpj = '$pesq'";
                    break;
            case 2: // Por ID
                    $sql = $sql . "SELECT * FROM venda WHERE idVenda = '$pesq' ";
                    break;
            case 3: // Por Item
                    $sql = $sql . "SELECT * FROM venda v INNER JOIN itensvenda i ON v.idVenda = i.venda_idVenda INNER JOIN produto p ON p.idProduto = i.produto_idProduto WHERE p.nome LIKE '%$pesq%'";

        }
    
        $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao) );
        mysqli_close($conexao);
        return $res;
    }

    function aprovarVenda($id){
        $conexao = conectarBD();
        $sql1 = "UPDATE venda SET aprovado = 1 WHERE idVenda = $id";
        mysqli_query($conexao, $sql1);
        $sql2 = "SELECT * FROM itensvenda WHERE venda_idVenda = $id";
        $res2 = mysqli_query($conexao, $sql2);
        while($registro = mysqli_fetch_assoc($res2)){
            $idProduto = $registro["produto_idProduto"];
            $qtdProduto = $registro["qtdProduto"];
            $sql3 = "UPDATE produto SET qtdestoque = qtdestoque - $qtdProduto WHERE idProduto = $idProduto";
            mysqli_query($conexao, $sql3);
        }
    }
    
    function exibirPedidos($id){
        $conexao = conectarBD();
        $sql = "SELECT * FROM venda WHERE cliente_idCliente = $id";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function exibirItensVenda($id){
        $conexao = conectarBD();
        $sql = "SELECT 
                p.nome AS nomeProduto,
                p.foto AS fotoProduto,
                p.referencia AS referenciaProduto, 
                p.preco AS precoProduto, 
                t.tamanho AS tamanhoProduto, 
                c.nomeCor AS corProduto,
                i.qtdProduto AS qtdProduto
                FROM 
                produto p
                INNER JOIN 
                itensVenda i ON i.produto_idProduto = p.idProduto
                INNER JOIN 
                venda v ON v.idVenda = i.venda_idVenda
                LEFT JOIN 
                tamanho t ON i.tamanho_idtamanho = t.idtamanho
                LEFT JOIN 
                cor c ON i.cor_idcor = c.idcor
                WHERE 
                v.idVenda = $id";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }
    
?>