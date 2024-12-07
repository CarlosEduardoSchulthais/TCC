<?php

    require_once "conexaoBD.php";
    static $conexao;
    function inserirCliente($nFantasia, $rSocial, $iEstadual, $cnpj, $rua, $numero, $bairro, $cidade, $estado, $telefone, $email, $senha, $cep, $ativo){
        $conexao = conectarBD();
        $sql = "INSERT INTO cliente (nomeFantasia, razaoSocial, inscricaoEstadual, cnpj, rua, numero, bairro, cidade, estado_idEstado, telefone, email, senha, cep, ativo) VALUES
                ('$nFantasia', '$rSocial', '$iEstadual', '$cnpj', '$rua', $numero, '$bairro', '$cidade', '$estado', '$telefone', '$email', '$senha', '$cep', $ativo)";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    }

    function alterarCliente($nFantasia, $rSocial, $iEstadual, $cnpj, $rua, $numero, $bairro, $cidade, $estado, $telefone, $email, $senha, $cep){
        $conexao = conectarBD();
        $sql = "UPDATE Cliente SET
                nomeFantasia = '$nFantasia',
                razaoSocial = '$rSocial',
                inscricaoEstadual = '$iEstadual',
                rua = '$rua',
                numero = '$numero',
                bairro = '$bairro',
                cidade = '$cidade',
                estado_idEstado = '$estado',
                telefone = '$telefone',
                email = '$email',
                senha = '$senha',
                cep = '$cep' WHERE cnpj = '$cnpj'";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    }

    function excluirCliente($id){
        $conexao = conectarBD();
        $sql = "UPDATE Cliente SET ativo = 0 WHERE idCliente = $id";
        mysqli_query($conexao, $sql);
    }

    function validarLoginCliente($login, $senha){
        $msgErro = "";
        $conexao = conectarBD();
        $sql = "SELECT * FROM cliente WHERE cnpj = '$login' AND senha = '$senha' AND ativo = 1";
        $res = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        if(mysqli_num_rows($res) == 0){
            $msgErro = $msgErro . "Login e/ou senha incorretos.<br>";
        }
        return $msgErro;
    }

    function pesquisarClientePorID($id){
        $conexao = conectarBD();
        $sql = "SELECT * FROM Cliente WHERE idCliente = $id";
        $res = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        mysqli_close($conexao);
        return $res;
    }

    function pesquisar ($pesq, $tipo) {

        $conexao = conectarBD(); 
    
        $sql = "SELECT * FROM Cliente WHERE ";
        switch ($tipo) {
            case 1: // Por Razão Social
                    $sql = $sql . "razaoSocial LIKE '$pesq%' ";
                    break;
            case 2: // Por CNPJ
                    $sql = $sql . "cnpj = '$pesq' ";
                    break;
            case 3: // Por Nome Fantasia
                $sql = $sql . "nomeFantasia LIKE '$pesq%' ";
        }
    
        $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao) );
        return $res;
    }

    function ativarCliente($id){
        $conexao = conectarBD();
        $sql = "UPDATE Cliente SET ativo = 1 WHERE idCliente = $id";
        mysqli_query($conexao, $sql);
    }



?>