<?php
    require_once "../control/validarSessao.php";
    if(validarSessao(false, true) == false){
        header("Location:login.php?msg=Você precisa fazer login para acessar a esta página.");
    }
?>
<?php
    require "../model/administradorDAO.php";
    if (!isset($_SESSION['administrador'])) {
        header("Location: login.php");
        exit();
    }
    
    // Conectar ao banco de dados
    require_once "../model/conexaoBD.php";
    $conexao = conectarBD();
    
    // Recuperar dados do usuário do banco de dados
    $administrador = $_SESSION['administrador'];
    $query = "SELECT * FROM administrador WHERE cpf = '$administrador'";
    $result = mysqli_query($conexao, $query);
    $administradorData = mysqli_fetch_assoc($result);
    
    // Fechar conexão
    mysqli_close($conexao);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <link rel="stylesheet" href="pagina-inicial-cliente.css">
    <link rel="stylesheet" href="cadCliente.css">
    <link rel="stylesheet" href="informacoesContato.css">
    <link rel="icon" href="../img/Logo guia.png" type="img/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="margin: 0;
    padding: 0;
    box-sizing: border-box; /* Inclui padding e border no tamanho total */
    overflow-x: hidden;">
    <div class= "navbar">
        <div class="logo">
            <img src="../img/Logo.png" alt="Conteúdo Jeans Wear" style="width: 90px; height: 80px;">
            <a class="texto-tipos" href="pagina-inicial-administrador.php">Conteúdo Jeans Wear</a>
        </div>
        <div style="display: flex; flex-direction: center">
                <a href="pesquisarCliente.php" type="button" class="btn btn-secondary btn-lg">Pesquisar Cliente</a>
            </div>
        <div class="tipos-produtos">
            <a class="texto-tipos" href="pagina-administrador-feminino.php">Feminino</a>
            <a class="texto-tipos" href="pagina-administrador-masculino.php">Masculino</a>
            <a class="texto-tipos" href="pagina-administrador-lancamentos.php">Lançamentos</a>
        </div>
        <form class="d-flex" role="search" action="produtosPesquisadosAdministrador.php">
                <input class="form-control me-2" type="search" placeholder="Pesquisar produtos..." aria-label="Search" name="txtPesqProdutos" id="txtPesqProdutos">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
        <div class="carrinho">
            <a href="aprovarVendas.php"><img src="../img/carrinho.png" alt="Carrinho de compras" style="width: 40px"></a>
            <a href="minhaContaAdministrador.php"><img src="../img/usuario.png" alt="Minha conta" style="width: 40px"></a>
            <a href="informacoesContatoAdministrador.php"><img src="../img/fone2.png" alt="Atendimento ao cliente" style="width: 50px;"></a>
        </div>
    </div>
    <div class="cadastroFundo">
        <div class="cadastro">
            <div class="row" style="display: flex; justify-content: space-around">
                <img src="../img/usuario.png" alt="Cliente" style="width: 90px">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;"><?php echo $administradorData['nome'] ?></p>
            </div>
            <br>
            <br>
            <div style="display: flex; justify-content: center" class="informacoes">
                <a href="pagina-inicial-cliente.php" style="color: black; padding: 30px; text-decoration: none"><p>Sair</p></a>
            </div>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>