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
    <title>Carrinho de Compras</title>
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

    <div class="cadastroFundo" style="margin-top: 40px">
    <div class="row" style="display: flex; justify-content: space-around">
        <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Carrinho</p>
    </div>
    <div class="row" style="display: flex; justify-content: center; margin-top: 40px">
    <table class="table table-striped table-bordered table-hover" style="width: 80%; text-align: center; align-items: center;">
        <thead class="thead-light">
            <tr>
            <th>Produto</th>
            <th>Modelo</th>
            <th>Tamanho</th>
            <th>Cor</th>
            <th>Preço (R$)</th>
            <th>Quantidade</th>
            <th>TOTAL (R$)</th>
          </tr>
        </thead>
        <tbody>
             <?php
                // MOSTRAR
                $carrinho = $_SESSION["carrinho"];
                $total = 0;
                $frete = 0;
                $freteFormatado = number_format($frete, 2, ',', '.');
                foreach ( $carrinho as $chaveProduto => $produto ) {

                    $nome = $produto["nome"];
                    $modelo = $produto["modelo"];
                    $cor = $produto["cor"];
                    require_once "../model/corDAO.php";
                    $res1 = buscarCor($cor);
                    $registro1 = mysqli_fetch_assoc($res1);
                    $nomeCor = $registro1["nomeCor"];
                    $tamanho = $produto["tamanho"];
                    require_once "../model/tamanhoDAO.php";
                    $res2 = buscarTamanho($tamanho);
                    $registro2 = mysqli_fetch_assoc($res2);
                    $numeroTamanho = $registro2["tamanho"];
                    $qtde = (int) $produto["qtde"];
                    $preco = (float) $produto["preco"];
                    $subTotal = $qtde * $preco;
                    $total = $total + $subTotal;
                    $frete = 0;
                    if($total >= 600){
                        $frete = 0;
                    } else{
                        $frete = 50;
                    }
                    $totalVenda = $total + $frete;
                    $freteFormatado = number_format($frete, 2, '.', '.');
                    $precoFormatado = number_format($preco, 2, ',', '.');
                    $subTotFormatado = number_format($subTotal, 2, ',', '.');
                    if(empty($carrinho) == false){
                    echo "<tr>";
                    echo "<td>$nome</td>";
                    echo "<td>$modelo</td>";
                    echo "<td>$numeroTamanho</td>";
                    echo "<td>$nomeCor</td>";
                    echo "<td><span id='preco$chaveProduto'>$precoFormatado</span></td>";
                    echo "<td><a href='../control/subtrairCarrinho.php?chave=$chaveProduto'><img src='../img/remover.png'height='20' width='20' data-id='$chaveProduto' data-tipo='rem'></a>"
                            . "<span id='qtde$chaveProduto'>$qtde</span>"
                            . "<a href='../control/somarCarrinho.php?chave=$chaveProduto'><img src='../img/add.png'height='20' width='20' data-id='$chaveProduto' data-tipo='add'></a>
                          </td>";
                    echo "<td><span id='subTot$chaveProduto'>$subTotFormatado</span></td>";
                    echo "<td><a href='../control/removerCarrinho.php?chave=$chaveProduto'><img src='../img/lixo.png'height='20' width='20' data-id='$chaveProduto' data-tipo='exc'></a></td>";
                    echo "<tr>";
                    } else{
                        echo "Ainda não há produtos inseridos em seu carrinho.";
                    }


                }
                $totalFormatado = number_format($total, 2, ',', '.');
             
             ?>
             </tbody>
             <tfoot>
                <tr>
                    <th colspan="6" style="text-align: right;" class="text-center">TOTAL (R$)</th>
                    <th class="text-center"><span id='total'><?php echo $totalFormatado; ?></span> </th>
                </tr>
            </tfoot>
        </table>
        <br>
        <br>
        <div style="display: flex; justify-content: center">
            <p style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Frete: R$ <?php echo $freteFormatado; ?></p>
        </div>
        <br>
        <br>
        
        </div>
        <div style="display: flex; justify-content: center">
            <a href="confirmarEndereco.php?frete=<?php echo $frete; ?>" class="btn btn-outline-secondary">Finalizar Compra</a>
            
        </div>
        <br>
        <br>
        <div class="mensagem" style="text-align: center">
            <?php
                if(isset($_GET["msg"])){
                    $mensagem = $_GET["msg"];
                        echo "<FONT color=red>$mensagem</FONT>";
                    }
            ?>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php
        require_once "rodapeCliente.php";
    ?>

    <script>

    




    </script>

    
</body>
</html>