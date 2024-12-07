<?php

    if(isset($_GET["id"]) && isset($_GET["modelo"])){
        require_once "../model/produtoDAO.php";
        $idProduto = $_GET["id"];
        excluirProduto($idProduto);
        $modelo = $_GET["modelo"];
        if($modelo == "F"){
            header("Location:../view/pagina-administrador-feminino.php");
        } else{
            header("Location:../view/pagina-administrador-masculino.php");
        }
        
    } else{
        header("Location:../view/pagina-inicial-administrador.php");
    }

?>