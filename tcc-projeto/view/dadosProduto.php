<?php
    if(isset($_GET["id"])){
        $idProduto = $_GET["id"];
        require_once "../model/produtoDAO.php";
        $res = pesquisarProdutoPorID($idProduto);
        while($registro = mysqli_fetch_assoc($res)){
            $nome = $registro["nome"];
            $descricao = $registro["descricao"];
            $preco = $registro["preco"];
            $imagem = $registro["foto"];
            $referencia = $registro["referencia"];
            $modelo = $registro["modelo"];
            $qtdEstoque = $registro["qtdestoque"];
    
            $fotoImg = base64_encode($imagem);
            $precoFormatado = number_format($preco, 2, '.', '');
        }
    } else{
        $idProduto = "";
        $nome = "";
        $descricao = "";
        $precoFormatado = "";
        $fotoImg = "";
        $referencia = "";
        $modelo = "";
        $qtdEstoque = "";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$nome/$referencia" ?></title>
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

    <div class="cadastroFundo" style="background-color: white">
        <div class="row">
            <div class="col">
                <?php echo "<img src='data:image/jpeg;base64,$fotoImg' height='600' width='600' style='margin-left: auto; margin-right: auto;'>"; ?>   
            </div>
            <div class="col" style="display: flex; flex-direction: column; justify-content: flex-start; align-items: flex-start">
                <div class="row">
                    <?php 
                        echo "<h4 class='margin' style='text-align: center; color: black; font-size: 40px'>$nome/$referencia</h4>";
                    ?>
                </div>
                <br>
                <div class="row">
                    <select name="listaCoresProduto" id="listaCoresProduto" class="form-select">
                        <option value="">Selecione a cor desejada:</option>
                        <?php
                            require_once "../model/corProdutoDAO.php";
                            $options = selecionarCoresdoProdutoComboBox($idProduto);
                            echo $options;
                        ?>
                    </select>
                </div>
                <br>
                <div class="row">
                    <h5 class='margin' style='text-align: center'>Tamanho:</h5>
                </div>
                <br>
                <div class="row" class="form-check">
                    <div style="display: flex">
                        <?php
                            require_once "../model/tamanhoProdutoDAO.php";
                            $options = selecionarTamanhosdoProdutoRadio($idProduto);
                            echo $options;
                        ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <?php 
                        echo "<h5 class='margin' style='text-align: center'>R$ $precoFormatado</h5>";
                    ?>
                </div>
                <br>
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-between">
                        <div style="display: flex; align-items: center; justify-content: space-between; width: 100px; margin-top: 20px; border: solid 1px black; padding: 10px">
                            <button style="display: flex" onclick="increment()">+</button> <!-- Símbolo de menos -->
                            <div id="counter-display" style="display: flex">1</div>
                            <button style="display: flex" onclick="decrement()">-</button> <!-- Símbolo de mais -->
                        </div>
                        <a href="login.php?msg=Você precisa fazer login para adicionar o produto ao carrinho." type="button" class="btn btn-success" style="margin-left: 20px">Adicionar ao carrinho</a>
                    </div>
                    
                        
                    
                </div>
                <br>
                <div class="row">
                    <h4>Descrição do produto:</h4>
                    <br>
                    <br>
                    <p><?php echo $descricao; ?></p>
                </div>

        </div>
        
    </div>
    <br>
    <br>
    <?php
        require_once "rodape.php";
    ?>

    <script>
        let itemCount = 1; // Valor inicial do contador

        function increment() {
            itemCount++;
            document.getElementById('counter-display').textContent = itemCount;
        }

        function decrement() {
            if (itemCount > 1) { // Para impedir que o valor fique abaixo de 1
                itemCount--;
                document.getElementById('counter-display').textContent = itemCount;
            }
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>