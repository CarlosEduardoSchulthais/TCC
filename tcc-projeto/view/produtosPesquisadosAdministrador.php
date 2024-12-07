<?php

    if(isset($_GET["txtPesqProdutos"])){
        $pesq = $_GET["txtPesqProdutos"];
    } else{
        $pesq = "";
    }

?>
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
    <title>Resultados</title>
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
            <form class="d-flex" role="search" action="produtosPesquisadosCliente.php">
                <input class="form-control me-2" type="search" placeholder="Pesquisar produtos..." aria-label="Search" name="txtPesqProdutos" id="txtPesqProdutos" value="<?php echo "$pesq"; ?>">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
            </form>
            <div class="carrinho">
                <a href="aprovarVendas.php"><img src="../img/carrinho.png" alt="Carrinho de compras" style="width: 40px"></a>
                <a href="minhaContaAdministrador.php"><img src="../img/usuario.png" alt="Minha conta" style="width: 40px"></a>
                <a href="informacoesContatoAdministrador.php"><img src="../img/fone2.png" alt="Atendimento ao cliente" style="width: 50px;"></a>
            </div>
        </div>

        <div class="cadastroFundo" style="background-color: white;">
        <br>
        <br>
        
        <div class="row" style="display: flex; justify-content: center">
            <div class="col">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Resultados</p>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
        <?php
               require_once "../model/produtoDAO.php";
               $resultado = pesquisarProdutos($pesq);
               $qtde = mysqli_num_rows($resultado);
               if($qtde == 0){
                echo "<div style='text-align: center; font-size: 30px'>Não foram encontrados resultados para a sua pesquisa.</div>";
                }
               while ( $registro = mysqli_fetch_assoc($resultado) ) {
                   $idProduto = $registro["idProduto"];
                   $referencia = $registro["referencia"];
                   $nome = $registro["nome"];
                   $descricao = $registro["descricao"];
                   $preco = $registro["preco"];
                   $imagem = $registro["foto"];
                   $qtdEstoque = $registro["qtdestoque"];
                   $modelo = $registro["modelo"];
                   
                   $fotoImg = base64_encode($imagem);
                   $precoFormatado = number_format($preco, 2, '.', '');
                   
                   echo "<div class='col-sm-4' style='display: flex; justify-content: center; flex-direction: column'>";
                   echo "<a href='dadosProdutoAdministrador.php?id=$idProduto' style='text-align: center'><img src='data:image/jpeg;base64,$fotoImg' height='300' width='300' style='margin-left: auto; margin-right: auto;'></a>";
                   echo "<a href='dadosProdutoAdministrador.php?id=$idProduto' style='text-decoration: none;'><h4 class='margin' style='text-align: center; color: black;'>$referencia $nome</h4></a>";
                   echo "<h5 class='margin' style='text-align: center'>R$ $precoFormatado</h5>";
                   echo "<div style='display: flex; justify-content: center'>";
                   echo "<a href='";
                   if($modelo == 'F'){ 
                    echo "cadastroProdutoFeminino.php?id=$idProduto"; 
                   } else{ echo "cadastroProdutoMasculino.php?id=$idProduto"; }
                   echo"' style='text-align: center; margin: 0 10px'><img src='../img/editar.png' height='30' width='30'></a>";
                   echo "<a href='../control/excluirProduto.php?id=$idProduto&modelo=$modelo' style='text-align: center; margin: 0 10px'><img src='../img/lixo.png' height='30' width='30'></a>";
                   echo "</div>";
                   echo "<br>";
                   echo "<br>";
                   echo "</div>";
               }

        ?>
        </div>
    </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
</body>
</html>