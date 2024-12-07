<?php
    include_once "conexaoBD.php";
    function selecionarTamanhosdoProduto($id){
        $conexao = conectarBD();
        $sql = "SELECT tamanho_idtamanho FROM tamanhoproduto WHERE produto_idProduto = $id";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function selecionarTamanhosdoProdutoRadio($id){
        $conexao = conectarBD();
        $sql = "SELECT * FROM tamanhoproduto WHERE produto_idProduto = $id";
        $res1 = mysqli_query($conexao, $sql);
        $options = "";
        while($registro1 = mysqli_fetch_assoc($res1)){
            $idTamanho = $registro1["tamanho_idtamanho"];
            require_once "tamanhoDAO.php";
            $res2 = buscarTamanho($idTamanho);
            $registro2 = mysqli_fetch_assoc($res2);
            $tamanho = $registro2["tamanho"];
            $options = $options . "<div class='form-check form-check-inline'>
                                    <input class='form-check-input' type='radio' name='listaTamanhosProduto' id='tamanho_$idTamanho' value='$idTamanho'>
                                    <label class='form-check-label' for='tamanho_$idTamanho'>$tamanho</label>
                                    </div>";
        }
        return $options;
    }

?>