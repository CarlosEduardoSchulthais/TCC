<?php
    require_once "conexaoBD.php";
    function exibirCor(){
        $conexao = conectarBD();
        $sql = "SELECT * FROM cor";
        $res = mysqli_query($conexao, $sql);
        mysqli_close($conexao);
        return $res;
    }

    function buscarCor($id){
        $conexao = conectarBD();
        $sql = "SELECT * FROM cor WHERE idcor = $id";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

?>