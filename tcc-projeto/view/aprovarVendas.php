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
    <title>Aprovar Vendas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    <div class="cadastroFundo" style="background-color: white;">
        <br>
        <br>

        <div class="row" style="display: flex; justify-content: center">
            <div class="col">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Aprovar Vendas</p>
            </div>
        </div>
        <br>
        <br>

        <div class="row" style="display: flex; justify-content: center">
            <div class="col" style="display: flex; justify-content: center;">
                <form class="d-flex" role="search" action="aprovarVendas.php">
                    <select name="escolha">
                        <option value="0">Pesquisar por:</option>
                        <option value="1">CNPJ do Cliente</option>
                        <option value="2">ID</option>
                        <option value="3">Item</option>
                    </select>
                    <input class="form-control me-2" type="search" placeholder="Pesquisar vendas..." aria-label="Search" name="txtPesqVenda" id="txtPesqVenda">
                    <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
        </div>
        <br>
        <br>
        <div class="row" style="display: flex; justify-content: center">
        <?php
        
            if(isset($_GET["txtPesqVenda"])){
                echo "<table class='table table-striped table-bordered' style='width: 80%; text-align: center; align-items: center'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>ID</th>";
                echo "<th scope='col'>Dados do Cliente</th>";
                echo "<th scope='col'>Data</th>";
                echo "<th scope='col'>Preço</th>";
                echo "<th scope='col'>Produtos</th>";
                echo "<th scope='col'>Aprovar Vendas</th>";
                echo "</thead>";
                require_once "../model/vendaDAO.php";
                $pesq = $_GET["txtPesqVenda"];
                $tipo = $_GET["escolha"];
                $res = pesquisarVenda($pesq, $tipo);
                while($registro = mysqli_fetch_assoc($res)){
                    $idVenda = $registro["idVenda"];
                    $aprovado = $registro["aprovado"];
                    $idCliente = $registro["cliente_idCliente"];
                    require_once "../model/clienteDAO.php";
                    $res2 = pesquisarClientePorID($idCliente);
                    $registro2 = mysqli_fetch_assoc($res2);
                    $razaoSocial = $registro2["razaoSocial"];
                    $cnpj = $registro2["cnpj"];
                    $rua = $registro2["rua"];
                    $numero = $registro2["numero"];
                    $bairro = $registro2["bairro"];
                    $cidade = $registro2["cidade"];
                    $estado = $registro2["estado_idEstado"];
                    $cep = $registro2["cep"];
                    $telefone = $registro2["telefone"];
                    $email = $registro2["email"];
                    $dtVenda = $registro["dtVenda"];
                    $preco = $registro["valorVenda"];
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<th scope='row'>$idVenda</th>";
                    echo "<td>Razão Social: $razaoSocial.<br>CNPJ: $cnpj.<br>Rua: $rua.<br>Nº: $numero.<br>Bairro: $bairro.<br>Cidade: $cidade.<br>Estado: $estado.<br>CEP: $cep.<br>Telefone: $telefone.<br>E-mail: $email.</td>";
                    echo "<td>$dtVenda</td>";
                    echo "<td>$preco</td>";
                    echo "<td>";
                    require_once "../model/conexaoBD.php";
                    $conexao = conectarBD();
                    $res3 = exibirItensVenda($idVenda);
                    while ($registro3 = mysqli_fetch_assoc($res3)) {
                        $nomeProduto = $registro3["nomeProduto"];
                        $referenciaProduto = $registro3["referenciaProduto"];
                        $preco = $registro3["precoProduto"];
                        $precoProduto = number_format($preco, 2, ',', '.');
                        $tamanhoProduto = $registro3["tamanhoProduto"];
                        $corProduto = $registro3["corProduto"];
                        $qtdProduto = $registro3["qtdProduto"];
                        $foto = $registro3["fotoProduto"];
                        $fotoImg = base64_encode($foto);
                        echo "<img src='data:image/jpeg;base64,$fotoImg' height='30' width='30' style='margin-left: auto; margin-right: auto;'>";
                        echo "Nome: $nomeProduto; Referência: $referenciaProduto; Preço: $precoProduto; Tamanho: $tamanhoProduto;<br>Cor: $corProduto; Qtde: $qtdProduto.<br><br>";
                    }
                    echo "</td>";
                    if($aprovado == 1){
                        echo "<td>Venda aprovada!</td>";
                    } else{
                        echo "<td><a href='../control/aprovarVenda.php?id=$idVenda&txtPesqVenda=$pesq&escolha=$tipo' class='btn btn-outline-success'>Aprovar Venda</a></td>";
                    }

                }
            }

        ?>
        </div>
</body>
</html>