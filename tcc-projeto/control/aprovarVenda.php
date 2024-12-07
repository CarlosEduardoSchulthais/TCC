<?php
    if(isset($_GET["id"]) && isset($_GET["txtPesqVenda"]) && isset($_GET["escolha"])){
        $idVenda = $_GET["id"];
        $pesq = $_GET["txtPesqVenda"];
        $tipo = $_GET["escolha"];
    } else{
        $idVenda = "";
        $pesq = "";
        $tipo = "";
    }
    
    require_once "../model/vendaDAO.php";
    aprovarVenda($idVenda);
    header("Location:../view/aprovarVendas.php?escolha=$tipo&txtPesqVenda=$pesq");
?>