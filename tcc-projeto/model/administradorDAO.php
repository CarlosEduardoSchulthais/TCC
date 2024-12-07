<?php
    require_once "conexaoBD.php";
    function validarLoginAdministrador($login, $senha){
        $msgErro = "";
        $conexao = conectarBD();
        $sql = "SELECT * FROM administrador WHERE cpf = '$login' AND senha = '$senha'";
        $res = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        if(mysqli_num_rows($res) == 0){
            $msgErro = $msgErro . "Login e/ou senha incorretos.<br>";
        }
        return $msgErro;
    }

?>