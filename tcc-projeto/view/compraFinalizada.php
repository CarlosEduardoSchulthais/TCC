<?php
    require_once "../control/validarSessao.php";
    if(validarSessao(true, false) == false){
        header("Location:login.php?msg=Você precisa fazer login como cliente para acessar esta página.");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Finalizada!</title>
    <link rel="stylesheet" href="cadCliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="pagina-inicial-cliente.css">
    <link rel="icon" href="../img/Logo guia.png" type="img/png">
</head>
<body style="margin: 0;
    padding: 0;
    box-sizing: border-box; /* Inclui padding e border no tamanho total */
    overflow-x: hidden;">
    <div class= "navbar">
        <div class="logo">
            <img src="../img/Logo.png" alt="Conteúdo Jeans Wear" style="width: 90px; height: 80px;">
            <a class="texto-tipos" href="pagina-inicial-cadCliente.php">Conteúdo Jeans Wear</a>
        </div>
        <div class="tipos-produtos">
            <a class="texto-tipos" href="pagina-cliente-feminino.php">Feminino</a>
            <a class="texto-tipos" href="pagina-cliente-masculino.php">Masculino</a>
            <a class="texto-tipos" href="pagina-cliente-lancamentos.php">Lançamentos</a>
        </div>
        <form class="d-flex" role="search" action="produtosPesquisadosCliente.php">
                <input class="form-control me-2" type="search" placeholder="Pesquisar produtos..." aria-label="Search" name="txtPesqProdutos" id="txtPesqProdutos">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
        <div class="carrinho">
            <a href="carrinho.php"><img src="../img/carrinho.png" alt="Carrinho de compras" style="width: 40px"></a>
            <a href="minhaContaCliente.php"><img src="../img/usuario.png" alt="Minha conta" style="width: 40px"></a>
            <a href="informacoesContatoCliente.php"><img src="../img/fone2.png" alt="Atendimento ao cliente" style="width: 50px;"></a>
        </div>
    </div>
    <div class="cadastroFundo" style="background-color: white">
        <div class="row" style="display: flex; justify-content: center">
            <div class="col">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Sua compra foi finalizada!</p>
            </div>
        </div>
        <br>
        <div style="display: flex; justify-content: center; flex-direction: column;">
            <img style="width: 150px; margin-left: 650px" src="../img/concluido.png" alt="Compra Finalizada">
            <br>
            <p style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif; font-size: 20px">Faça o pagamento através do QR Code abaixo e aguarde a aprovação da sua compra.</p>
            <br>
            <img style="width: 230px; margin-left: 620px" src="../img/qrcode.png" alt="QR Code do Pix">
            <br>
            <a class="btn btn-outline-secondary" href="pagina-inicial-cadCliente.php" style="width: 150px; margin-left: 660px">Voltar para a página inicial</a>
        </div>
    </div>
    <?php
        require_once "rodapeCliente.php";
    ?>
</body>
</html>