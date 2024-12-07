<?php
    require "funcoes.php";
    require "../model/clienteDAO.php";
    require "../model/administradorDAO.php";
    // Receber login e senha
    $login = $_POST["txtLogin"];
    $senha = $_POST["txtSenha"];
    $usuario = $_POST["login"];

    if($usuario == "cliente"){
        $loginFormatado = formatarCNPJ_CPF($login);
        $msgErro = validarLoginCliente($loginFormatado, $senha);
        if(empty($msgErro)){
            header("Location:../view/login.php?successCliente=true");
            session_start();
            $_SESSION['cliente'] = $loginFormatado;
            $_SESSION['carrinho'] = array();
        } else{
            header("Location:../view/login.php?msg=$msgErro");
        }
    } else if($usuario == "administrador"){
        $loginFormatado = formatarCNPJ_CPF($login);
        $msgErro = validarLoginAdministrador($loginFormatado, $senha);
        if(empty($msgErro)){
            header("Location:../view/login.php?successAdministrador=true");
            session_start();
            $_SESSION['administrador'] = $loginFormatado;
        } else{
            header("Location:../view/login.php?msg=$msgErro");
        }
    }  
?>