<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações de Contato da Empresa Fornecedora</title>
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
            <a class="texto-tipos" href="pagina-inicial-cliente.php">Conteúdo Jeans Wear</a>
        </div>
        <div class="tipos-produtos">
            <a class="texto-tipos" href="pagina-feminino.php">Feminino</a>
            <a class="texto-tipos" href="pagina-masculino.php">Masculino</a>
            <a class="texto-tipos" href="pagina-lancamentos.php">Lançamentos</a>
        </div>
        <form class="d-flex" role="search" action="produtosPesquisados.php">
                <input class="form-control me-2" type="search" placeholder="Pesquisar produtos..." aria-label="Search" name="txtPesqProdutos" id="txtPesqProdutos">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
        <div class="carrinho">
            <a href="carrinho.php"><img src="../img/carrinho.png" alt="Carrinho de compras" style="width: 40px"></a>
            <a href="login.php"><img src="../img/usuario.png" alt="Minha conta" style="width: 40px"></a>
            <a href="informacoesContato.php"><img src="../img/fone2.png" alt="Atendimento ao cliente" style="width: 50px;"></a>
        </div>
    </div>
    <div class="cadastroFundo">
        <div class="cadastro">
            <div class="row" style="display: flex; justify-content: center">
                <img src="../img/fone2.png" alt="Informações de Contato" style="width: 100px">
                <p class="h1" style="font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif; font-size: 30px; text-align: center">Informações de contato da empresa fornecedora</p>
            </div>
            <br>
            <br>
            <div style="display: flex;" class="informacoes">
                <p>Telefone: (27) 99970-2066</p>
            </div>
            <br>
            <div style="display: flex" class="informacoes">
                <p>E-mail: conteudojeanswear@gmail.com</p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php
        require_once "rodape.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>