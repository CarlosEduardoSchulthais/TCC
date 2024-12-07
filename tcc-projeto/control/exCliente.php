<?php
    require "../model/clienteDAO.php";
    session_start();
    if (!isset($_SESSION['cliente'])) {
        header("Location: login.php");
        exit();
    }
    
    // Conectar ao banco de dados
    require_once "../model/conexaoBD.php";
    $conexao = conectarBD();
    
    // Recuperar dados do usuário do banco de dados
    $cliente = $_SESSION['cliente'];
    $query = "SELECT * FROM cliente WHERE cnpj = '$cliente'";
    $result = mysqli_query($conexao, $query);
    $clienteData = mysqli_fetch_assoc($result);
    $id = $clienteData['idCliente'];
    
    // Fechar conexão
    mysqli_close($conexao);

    excluirCliente($id);
    header("Location:../view/pagina-inicial-cliente.php")
?>