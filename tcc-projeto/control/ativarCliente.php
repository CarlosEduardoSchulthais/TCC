<?php

    if(isset($_GET["id"]) && isset($_GET["pesq"]) && isset($_GET["tipo"])){
        $idCliente = $_GET["id"];
        $pesq = $_GET["pesq"];
        $tipo = $_GET["tipo"];
        require_once "../model/clienteDAO.php";
        ativarCliente($idCliente);
        header("Location:../view/pesquisarCliente.php?escolha=$tipo&txtPesqCliente=$pesq");
    } else{
        header("Location:../view/pesquisarCliente.php");
    }

?>