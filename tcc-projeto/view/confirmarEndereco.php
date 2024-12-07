<?php
    require_once "../control/validarSessao.php";
    if(validarSessao(true, false) == false){
        header("Location:login.php?msg=Você precisa fazer login como cliente para acessar esta página.");
    }
    $cliente = $_SESSION["cliente"];
    require_once "../model/conexaoBD.php";
    $conexao = conectarBD();
    $sql = "SELECT * FROM cliente WHERE cnpj = '$cliente'";
    $res = mysqli_query($conexao, $sql);
    $rg = mysqli_fetch_assoc($res);
    $rua = $rg["rua"];
    $numero = $rg["numero"];
    $bairro = $rg["bairro"];
    $cidade = $rg["cidade"];
    $cep = $rg["cep"];
    $idCliente = $rg["idCliente"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Endereco</title>
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
        <div class="col">
        <div class="row" style="display: flex; justify-content: center">
            <div class="col">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Confirme seu endereço</p>
            </div>
        </div>
        <br>
        <div class="row" style="display: flex; justify-content: center; flex-direction: column; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif; font-size: 30px">
            <p style="text-align: center">Rua/Avenida: <?php echo $rua; ?></p>
            <p style="text-align: center">Número: <?php echo $numero; ?></p>
            <p style="text-align: center">Bairro: <?php echo $bairro; ?></p>
            <p style="text-align: center">Cidade: <?php echo $cidade; ?></p>
            <p style="text-align: center">CEP: <?php echo $cep; ?></p>
        </div>
        <br>
        <br>
        <?php
                if(isset($_GET["frete"])){
                    $frete = $_GET["frete"];
                } else{
                    $frete = 0;
                }
                $carrinho = $_SESSION["carrinho"];
                $total = $frete;
                foreach ( $carrinho as $chaveProduto => $produto) {
                    $idProduto = $produto["idProduto"];
                    $preco = $produto["preco"];
                    $qtde = $produto["qtde"];
                    $cor = $produto["cor"];
                    $tamanho = $produto["tamanho"];
    
                    $subTotal = $preco * $qtde;
                    $total = $total + $subTotal;
                }
        ?>
        <div class="row">
            <div class="col" style="text-align: center">
                <a href="<?php echo "cadCliente.php?id=$idCliente"; ?>" class="btn btn-outline-secondary">Alterar Endereço</a>
            </div>
            <div class="col" style="text-align: center">
                <form action="../control/finalizarVenda.php" method="post">
                    <input type="hidden" value="<?php echo $frete; ?>" name="frete">
                    <input type="submit" class="btn btn-outline-secondary" value="Finalizar Compra">
                </form>
            </div>
        </div>
        </div>
        <div class="col" style="display: flex; justify-content: center; align-items: center">
            <p style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Total da compra: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
        </div>
    </div>
    <?php
        require_once "rodapeCliente.php";
    ?>
    
</body>
</html>