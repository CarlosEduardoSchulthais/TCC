<?php
    require "funcoes.php";
    $id = $_POST["idCliente"];
    $nomeFantasia = $_POST["txtNomeFantasia"];
    $razaoSocial = $_POST["txtRazaoSocial"];
    $inscricaoEstadual = $_POST["txtInscricaoEstadual"];
    $cnpj = $_POST["txtCNPJ"];
    $rua = $_POST["txtRua"];
    $numero = $_POST["txtNumero"];
    $bairro = $_POST["txtBairro"];
    $cidade = $_POST["txtCidade"];
    $cep = $_POST["txtCEP"];
    $estado = $_POST["listaEstados"];
    $telefone = $_POST["txtTelefone"];
    $email = $_POST["txtEmail"];
    $senha = $_POST["txtSenha"];
    $senha2 = $_POST["txtSenha2"];
    $ativo = 1;

    if(empty($id) | $id === null || $id === ''){
        $msgErro = validacao($nomeFantasia,$razaoSocial, $inscricaoEstadual, $cnpj, $rua, $numero, $bairro,$cidade, $estado, $cep, $email, $senha, $senha2, $telefone);
    } else{
        $msgErro = validacaoAlterarCliente($nomeFantasia,$razaoSocial, $inscricaoEstadual, $cnpj, $rua, $numero, $bairro,$cidade, $estado, $cep, $email, $senha, $senha2);
    }

    if(empty($msgErro)){
        require_once "../model/clienteDAO.php";
        if(empty($id) | $id === null || $id === ''){
            inserirCliente($nomeFantasia, $razaoSocial, $inscricaoEstadual, $cnpj, $rua, $numero, $bairro, $cidade, $estado, $telefone, $email, $senha, $cep, $ativo);
            header("Location:../view/cadCliente.php?success=true");
            session_start();
            $_SESSION['cliente'] = $cnpj;
            $_SESSION['carrinho'] = array();
        } else{
            alterarCliente($nomeFantasia, $razaoSocial, $inscricaoEstadual, $cnpj, $rua, $numero, $bairro, $cidade, $estado, $telefone, $email, $senha, $cep);
            header("Location:../view/cadCliente.php?success=true");
        }
    } else{
        header("Location:../view/cadCliente.php?msg=$msgErro");
    }


?>