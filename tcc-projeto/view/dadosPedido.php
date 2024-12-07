<?php
    require_once "../control/validarSessao.php";
    if(validarSessao(true, false) == false){
        header("Location:login.php?msg=Você precisa fazer login para acessar a esta página.");
    }
    if(isset($_GET["id"])){
        $idPedido = $_GET["id"];
        require_once "../model/vendaDAO.php";
        $res1 = pesquisarVenda($idPedido, 2);
        $registro1 = mysqli_fetch_assoc($res1);
        $valorVenda = $registro1["valorVenda"];
        $valorFormatado = number_format($valorVenda, 2, ',', '.');
        $data = $registro1["dtVenda"];
        require_once "../control/funcoes.php";
        $dataFormatada = formatarData($data);
        $aprovado = $registro1["aprovado"];
    } else{
        $idPedido = "";
        $valorFormatado = "";
        $dataFormatada = "";
        $aprovado = "";
    }
    $cnpjCliente = $_SESSION["cliente"];
    require_once "../model/clienteDAO.php";
    $res3 = pesquisar($cnpjCliente, 2);
    $clienteData = mysqli_fetch_assoc($res3);
    $rua = $clienteData["rua"];
    $numero = $clienteData["numero"];
    $bairro = $clienteData["bairro"];
    $cidade = $clienteData["cidade"];
    $cep = $clienteData["cep"];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido <?php echo $idPedido; ?></title>
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
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Pedido <?php echo $idPedido; ?></p>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col">
                <p style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif; font-size: 20px">Valor total: <?php echo $valorFormatado; ?></p>
            </div>
            <div class="col">
                <p style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif; font-size: 20px">Data do pedido: <?php echo $dataFormatada; ?></p>
            </div>
        </div>
        <br>
        <br>
        <div class="row" style="display: flex; justify-content: space-between; align-items: flex-start; padding: 30px">
            <!-- Coluna dos itens -->
            <div class="col" style="flex: 3; padding-right: 20px; display: flex; justify-content: center; flex-direction: column;">
                <?php
                    $res2 = exibirItensVenda($idPedido);
                    while($registro2 = mysqli_fetch_assoc($res2)){
                    $nomeProduto = $registro2["nomeProduto"];
                    $referenciaProduto = $registro2["referenciaProduto"];
                    $precoProduto = number_format($registro2["precoProduto"], 2, ',', '.');
                    $tamanhoProduto = $registro2["tamanhoProduto"];
                    $corProduto = $registro2["corProduto"];
                    $qtdProduto = $registro2["qtdProduto"];
                    $foto = $registro2["fotoProduto"];
                    $fotoImg = base64_encode($foto);
                    echo "<div style='display: flex; margin-bottom: 20px;'>";
                    echo "<img src='data:image/jpeg;base64,$fotoImg' height='100' width='100' style='margin-right: 20px;'>";
                    echo "<div>";
                    echo "Nome: $nomeProduto.<br>Referência: $referenciaProduto.<br>Preço: $precoProduto.<br>Tamanho: $tamanhoProduto.<br>Cor: $corProduto.<br>Qtde: $qtdProduto.<br>";
                    echo "</div>";
                    echo "</div>";
                    }
                ?>
            </div>

            <div class="col" style="font-size: 20px; text-align: center; display: flex; flex-direction: column; justify-content: center">
                <p class="h1" style="font-size: 30px">Endereço:</p>
                <p>Rua/Avenida: <?php echo $rua; ?></p>
                <p>Nº: <?php echo $numero; ?></p>
                <p>Bairro: <?php echo $bairro; ?></p>
                <p>Cidade: <?php echo $cidade; ?></p>
                <p>CEP: <?php echo $cep; ?></p>

            </div>

            <!-- Coluna da situação -->
            <div class="col" style="flex: 1; text-align: center; display: flex; justify-content: center; align-items: center; flex-direction: column">
                <?php
                if($aprovado == 1){
                    echo "<div style='font-size: 24px; color: green;'>Situação: Aprovado</div>";
                } else if($aprovado == 0){
                    echo "<div style='font-size: 24px; color: red;'>Situação: Aguardando aprovação de pagamento</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php
        require_once "rodapeCliente.php";
    ?>

    
</body>
</html>