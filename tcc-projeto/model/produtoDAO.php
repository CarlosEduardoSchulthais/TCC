<?php
    require "conexaoBD.php";
    function inserirProduto($referencia, $nome, $preco, $descricao, $qtdestoque, $foto, $modelo, $cores, $tamanhos, $ativo){
        $conexao = conectarBD();
        $tamanhoImg = $foto["size"]; 
        $arqAberto = fopen ( $foto["tmp_name"], "r" );
        $imagem = addslashes( fread ( $arqAberto , $tamanhoImg ) );
        $sqlProduto = "INSERT INTO produto (referencia, nome, preco, descricao, qtdestoque, foto, modelo, ativo)
        VALUES ('$referencia', '$nome', $preco, '$descricao', $qtdestoque, '$imagem', '$modelo', $ativo)";
        mysqli_query($conexao, $sqlProduto) or die(mysqli_error($conexao));
        $idProduto = mysqli_insert_id($conexao);
        foreach ($cores as $idCor){
            $sqlCor = "INSERT INTO corproduto (produto_idProduto, cor_idcor) VALUES ($idProduto, $idCor)";
            mysqli_query($conexao, $sqlCor) or die(mysqli_error($conexao));
        }
        foreach ($tamanhos as $idTamanho){
            $sqlTamanho = "INSERT INTO tamanhoproduto (produto_idProduto, tamanho_idtamanho) VALUES ($idProduto, $idTamanho)";
            mysqli_query($conexao, $sqlTamanho) or die(mysqli_error($conexao));
        }
    }

    function exibirProdutosFeminino(){
        $conexao = conectarBD();
        $sql = "SELECT * FROM produto WHERE modelo = 'F' AND ativo = 1";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function exibirProdutosFemininoPaginaInicial(){
        $conexao = conectarBD();
        $sql = "SELECT * FROM produto WHERE modelo = 'F' AND ativo = 1 AND qtdestoque > 0 ORDER BY idProduto DESC LIMIT 3";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function exibirProdutosMasculino(){
        $conexao = conectarBD();
        $sql = "SELECT * FROM produto WHERE modelo = 'M' AND ativo = 1";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function exibirProdutosMasculinoPaginaInicial(){
        $conexao = conectarBD();
        $sql = "SELECT * FROM produto WHERE modelo = 'M' AND ativo = 1 AND qtdestoque > 0 ORDER BY idProduto DESC LIMIT 3";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function pesquisarProdutos($pesq){
        $conexao = conectarBD(); 
        $sql = "SELECT * FROM Produto WHERE nome LIKE '%$pesq%' AND ativo = 1";
        $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao) );
        return $res;
    }

    function excluirProduto($id){
        $conexao = conectarBD();
        $sql = "UPDATE Produto SET ativo = 0 WHERE idProduto = $id";
        mysqli_query($conexao, $sql);
    }

    function pesquisarProdutoPorID($id){
        $conexao = conectarBD();
        $sql = "SELECT * FROM Produto WHERE idProduto = $id";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function alterarProduto($referencia, $nome, $preco, $descricao, $qtdestoque, $foto, $modelo, $cores, $tamanhos, $id){
        $conexao = conectarBD();
        $tamanhoImg = $foto["size"]; 
        $arqAberto = fopen ( $foto["tmp_name"], "r" );
        $imagem = addslashes( fread ( $arqAberto , $tamanhoImg ) );
        $sqlProduto = "UPDATE Produto SET
                       referencia = '$referencia',
                       nome = '$nome',
                       preco = $preco,
                       descricao = '$descricao',
                       qtdestoque = '$qtdestoque',
                       foto = '$imagem',
                       modelo = '$modelo' WHERE idProduto = $id";
        mysqli_query($conexao, $sqlProduto) or die(mysqli_error($conexao));

        $sqlCor = "DELETE FROM corproduto WHERE produto_idProduto = $id";
        mysqli_query($conexao, $sqlCor) or die(mysqli_error($conexao));

        $sqlTamanho = "DELETE FROM tamanhoproduto WHERE produto_idProduto = $id";
        mysqli_query($conexao, $sqlTamanho) or die(mysqli_error($conexao));

        foreach ($cores as $idCor){
            $sqlCor2 = "INSERT INTO corproduto (produto_idProduto, cor_idcor) VALUES ($id, $idCor)";
            mysqli_query($conexao, $sqlCor2) or die(mysqli_error($conexao));
        }
        foreach ($tamanhos as $idTamanho){
            $sqlTamanho2 = "INSERT INTO tamanhoproduto (produto_idProduto, tamanho_idtamanho) VALUES ($id, $idTamanho)";
            mysqli_query($conexao, $sqlTamanho2) or die(mysqli_error($conexao));
        }

    }

    function exibirProdutosLancamento(){
        $conexao = conectarBD();
        $sql = "SELECT * FROM produto WHERE ativo = 1 ORDER BY idProduto DESC LIMIT 9";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }
?>