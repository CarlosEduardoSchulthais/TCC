<?php
    require_once "../control/validarSessao.php";
    if(validarSessao(true, false) == false){
        header("Location:login.php?msg=Você precisa fazer login para acessar a esta página.");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
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
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Meus pedidos</p>
            </div>
        </div>
        <br>
        <br>
        <?php
            if(isset($_GET["id"])){
                $idCliente = $_GET["id"];
            } else{
                $idCliente = "";
            }
            require_once "../model/vendaDAO.php";
            $res1 = exibirPedidos($idCliente);
            if(mysqli_num_rows($res1) == 0){
                echo "<div style='text-align: center; font-size: 30px'>Ainda não foram feitos pedidos nessa conta.</div>";
            } 
        ?>
        <div style="display: flex; justify-content: center;">
        <table class="table table-striped table-bordered" style="width: 80%; text-align: center; align-items: center">
            <?php
                if(mysqli_num_rows($res1) > 0){
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">ID</th>';
                    echo '<th scope="col">Pedidos</th>';
                    echo '<th scope="col">Total da compra</th>';
                    echo '<th scope="col">Data</th>';
                    echo '<th scope="col">Detalhes</th>';
                    echo '</tr>';
                    echo '</thead>';
                }
            ?>
                <tbody>
                    <?php
                        while($registro1 = mysqli_fetch_assoc($res1)){
                            $idVenda = $registro1["idVenda"];
                            echo "<tr>";
                            echo "<th scope='row'>$idVenda</th>";
                            $res2 = exibirItensVenda($idVenda);
                            echo "<td>";
                            while($registro2 = mysqli_fetch_assoc($res2)){
                                $nomeProduto = $registro2["nomeProduto"];
                                $referenciaProduto = $registro2["referenciaProduto"];
                                $precoProduto = number_format($registro2["precoProduto"], 2, ',', '.');
                                $tamanhoProduto = $registro2["tamanhoProduto"];
                                $corProduto = $registro2["corProduto"];
                                $qtdProduto = $registro2["qtdProduto"];
                                $foto = $registro2["fotoProduto"];
                                $fotoImg = base64_encode($foto);
                                echo "<img src='data:image/jpeg;base64,$fotoImg' height='30' width='30' style='margin-left: auto; margin-right: auto;'>";
                                echo "Nome: $nomeProduto; Referência: $referenciaProduto; Preço: $precoProduto; Tamanho: $tamanhoProduto;<br>Cor: $corProduto; Qtde: $qtdProduto.<br><br>";
                            }
                            echo "</td>";
                            $total = $registro1["valorVenda"];
                            $totalFormatado = number_format($total, 2, ',', '.');
                            $data = $registro1["dtVenda"];
                            require_once "../control/funcoes.php";
                            $dataFormatada = formatarData($data);
                            echo "<td>$totalFormatado</td>";
                            echo "<td>$dataFormatada</td>";
                            echo "<td><a href='dadosPedido.php?id=$idVenda' class='btn btn-secondary'>Ver detalhes do pedido</a></td>";
                            echo "</tr>";
                        }

                    ?>
                </tbody>
        </table>
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