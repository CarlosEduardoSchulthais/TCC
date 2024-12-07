<?php

    function validarSessao($cli, $adm){
        session_start();
        if(isset($_SESSION['cliente'])){
            return $cli;
        } else if(isset($_SESSION['administrador'])){
            return $adm;
        } else{
            return false;
        }
    }

?>