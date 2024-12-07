<?php
    require_once "../control/validarSessao.php";
    if(validarSessao(false, true) == false){
        header("Location:login.php?msg=Você precisa fazer login para acessar a esta página.");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdo Jeans Wear - Página Inicial</title>
    <link rel="stylesheet" href="pagina-inicial-cliente.css">
    <link rel="icon" href="../img/Logo guia.png" type="img/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="margin: 0;
    padding: 0;
    box-sizing: border-box; /* Inclui padding e border no tamanho total */
    overflow-x: hidden;">

        <div class= "navbar">
            <div class="logo">
                <img src="../img/Logo.png" alt="Conteúdo Jeans Wear" style="width: 90px; height: 80px;">
                <a class="texto-tipos" href="#">Conteúdo Jeans Wear</a>
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
        <div> 
            <img src="../img/capa.png" alt="" style="width: 1200px;">
        </div>
        <div class="barra-inferior" style="background-color: #CD5C5C; display: flex; align-items: center; padding: padding: 0;">
            <p class="texto-tipos"> Frete grátis à partir de R$ 600,00</p>
            <p class="texto-tipos"> Parcelamento em até 6x </p>
            <p class="texto-tipos"> 10% de desconto em pagamentos via PIX</p>
        </div>
        <div style="background-color: #DCDCDC">
            <div class="row" style="display: flex; justify-content: center">
                <div class="col">
                    <br>
                    <br>
                    <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Feminino</p>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <?php
                    require_once "../model/produtoDAO.php";
                    $resultado = exibirProdutosFemininoPaginaInicial();
                    while ($registro = mysqli_fetch_assoc($resultado)){
                        $idProduto = $registro["idProduto"];
                        $nome = $registro["nome"];
                        $descricao = $registro["descricao"];
                        $preco = $registro["preco"];
                        $imagem = $registro["foto"];
                        $referencia = $registro["referencia"];
                        $modelo = $registro["modelo"];
    
                        $fotoImg = base64_encode($imagem);
                        $precoFormatado = number_format($preco, 2, '.', '');

                        echo "<div class='col-sm-4' style='display: flex; justify-content: center; flex-direction: column'>";
                        echo "<a href='dadosProdutoAdministrador.php?id=$idProduto' style='text-align: center'><img src='data:image/jpeg;base64,$fotoImg' height='300' width='300' style='margin-left: auto; margin-right: auto;'></a>";
                        echo "<a href='dadosProdutoAdministrador.php?id=$idProduto' style='text-decoration: none; color: black'><h4 class='margin' style='text-align: center'>$referencia/$nome</h4></a>";
                        echo "<br>";
                        echo "<br>";
                        echo "</div>";
                    }
                ?>
            </div>
            <br>
            <div class="row" style="display: flex; justify-content: center">
                <a href="pagina-administrador-feminino.php" class="btn btn-success" style="width: 20%">VER DETALHES →</a>
            </div>
            <br>
            <br>
        </div>
        <div style="background-color: #A9A9A9">
            <div class="row" style="display: flex; justify-content: center">
                <div class="col">
                    <br>
                    <br>
                    <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Masculino</p>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <?php
                    require_once "../model/produtoDAO.php";
                    $resultado = exibirProdutosMasculinoPaginaInicial();
                    while ($registro = mysqli_fetch_assoc($resultado)){
                        $idProduto = $registro["idProduto"];
                        $nome = $registro["nome"];
                        $descricao = $registro["descricao"];
                        $preco = $registro["preco"];
                        $imagem = $registro["foto"];
                        $referencia = $registro["referencia"];
                        $modelo = $registro["modelo"];
    
                        $fotoImg = base64_encode($imagem);
                        $precoFormatado = number_format($preco, 2, '.', '');

                        echo "<div class='col-sm-4' style='display: flex; justify-content: center; flex-direction: column'>";
                        echo "<a href='dadosProdutoAdministrador.php?id=$idProduto' style='text-align: center'><img src='data:image/jpeg;base64,$fotoImg' height='300' width='300' style='margin-left: auto; margin-right: auto;'></a>";
                        echo "<a href='dadosProdutoAdministrador.php?id=$idProduto' style='text-decoration: none; color: black'><h4 class='margin' style='text-align: center'>$referencia/$nome</h4></a>";
                        echo "<br>";
                        echo "<br>";
                        echo "</div>";
                    }
                ?>
            </div>
            <br>
            <div class="row" style="display: flex; justify-content: center">
                <a href="pagina-administrador-masculino.php" class="btn btn-success" style="width: 20%">VER DETALHES →</a>
            </div>
            <br>
            <br>
        </div>

        <?php
            require_once "rodapeAdministrador.php";
        ?>
    
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>