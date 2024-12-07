<?php

    if ( isset($_GET["id"]) && isset($_GET["pesq"])) {

        require_once '../model/clienteDAO.php';

        $id = $_GET["id"];
        $pesq = $_GET["pesq"];
        $tipo = $_GET["tipo"];
        excluirCliente($id);
        header("Location:../view/pesquisarCliente.php?escolha=$tipo&txtPesqCliente=$pesq");
    }
    else {
        header("Location:../view/pesquisarCliente.php");
    }
    

?>