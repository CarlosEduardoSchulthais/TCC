<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo Masculino</title>
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
    
    <div class="cadastroFundo" style="background-color: white;">
        <div class="row" style="display: flex; justify-content: center">
            <div class="col">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Masculino</p>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
        <?php

            require_once '../model/produtoDAO.php';               

            $resultado = exibirProdutosMasculino();
            while ( $registro = mysqli_fetch_assoc($resultado) ) {
                $idProduto = $registro["idProduto"];
                $nome = $registro["nome"];
                $descricao = $registro["descricao"];
                $preco = $registro["preco"];
                $imagem = $registro["foto"];
                $referencia = $registro["referencia"];
                $qtdEstoque = $registro["qtdestoque"];
    
                $fotoImg = base64_encode($imagem);
                $precoFormatado = number_format($preco, 2, '.', '');
    
                if($qtdEstoque > 0){
                    echo "<div class='col-sm-4' style='display: flex; justify-content: center; flex-direction: column'>";
                    echo "<a href='dadosProduto.php?id=$idProduto' style='text-align: center'><img src='data:image/jpeg;base64,$fotoImg' height='300' width='300' style='margin-left: auto; margin-right: auto;'></a>";
                    echo "<a href='dadosProduto.php?id=$idProduto' style='text-decoration: none; color: black'><h4 class='margin' style='text-align: center'>$referencia $nome</h4></a>";
                    echo "<h5 class='margin' style='text-align: center'>R$ $precoFormatado</h5>";
                } else{
                    echo "<div class='col-sm-4' style='display: flex; justify-content: center; flex-direction: column'>";
                    echo "<a style='text-align: center'><img src='data:image/jpeg;base64,$fotoImg' height='300' width='300' style='margin-left: auto; margin-right: auto;'></a>";
                    echo "<a style='text-decoration: none; color: black'><h4 class='margin' style='text-align: center'>$referencia $nome</h4></a>";
                    echo "<h5 class='margin' style='text-align: center'>R$ $precoFormatado</h5>";
                }
                if($qtdEstoque == 0){
                    echo "<h5 class='margin' style='text-align: center; color: red'>Produto indisponível</h5>";
                }
                echo "<br>";
                echo "<br>";
                echo "</div>";
            }

        ?>
        </div>
    </div>
    <br>
    <br>
    <?php
        require_once "rodape.php";
    ?>
</body>
</html>