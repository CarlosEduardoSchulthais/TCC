<?php
    include_once "conexaoBD.php";
    function exibirTamanho(){
        $conexao = conectarBD();
        $sql = "SELECT * FROM tamanho";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

    function buscarTamanho($id){
        $conexao = conectarBD();
        $sql = "SELECT * FROM tamanho WHERE idtamanho = $id";
        $res = mysqli_query($conexao, $sql);
        return $res;
    }

?>