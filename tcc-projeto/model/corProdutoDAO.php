<?php
    include_once "conexaoBD.php";
    function selecionarCoresdoProduto($id){
        $conexao = conectarBD();
        $sql = "SELECT cor_idcor FROM corproduto WHERE produto_idProduto = $id";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function selecionarCoresdoProdutoComboBox($id){
        $conexao = conectarBD();
        $sql = "SELECT * FROM corproduto WHERE produto_idProduto = $id";
        $res1 = mysqli_query($conexao, $sql);
        $options = "";
        while($registro1 = mysqli_fetch_assoc($res1)){
            $idCor = $registro1["cor_idcor"];
            require_once "corDAO.php";
            $res2 = buscarCor($idCor);
            $registro2 = mysqli_fetch_assoc($res2);
            $nomeCor = $registro2["nomeCor"];
            $options = $options . "<option value='$idCor'>$nomeCor</option>";
        }
        return $options;
    }

?>