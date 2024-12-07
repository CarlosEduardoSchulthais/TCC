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
    <title>Cadastro de Produto Feminino</title>
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

    <?php
    
        if(isset($_GET["id"])){
            require_once "../model/produtoDAO.php";
            require_once "../model/corProdutoDAO.php";
            require_once "../model/tamanhoProdutoDAO.php";
            $idProduto = $_GET["id"];
            $res1 = pesquisarProdutoPorID($idProduto);
            if($res1 != null){
                $registro = mysqli_fetch_assoc($res1);
                $referencia = $registro["referencia"];
                $nome = $registro["nome"];
                $preco = $registro["preco"];
                $descricao = $registro["descricao"];
                $qtdEstoque = $registro["qtdestoque"];
                $foto = $registro["foto"];
            }
            $res2 = selecionarCoresdoProduto($idProduto);
            if($res2 != null){
                $coresSelecionadas = [];
                while ($registroCores = mysqli_fetch_assoc($res2)){
                    $coresSelecionadas[] = $registroCores["cor_idcor"];
                }
            }
            $res3 = selecionarTamanhosdoProduto($idProduto);
            if($res3 != null){
                $tamanhosSelecionados = [];
                while ($registroTamanhos = mysqli_fetch_assoc($res3)){
                    $tamanhosSelecionados[] = $registroTamanhos["tamanho_idtamanho"];
                }
            }
        } else{
            $idProduto = "";
            $referencia = "";
            $nome = "";
            $preco = 0;
            $descricao = "";
            $qtdEstoque = 0;
            $foto = "";
            $coresSelecionadas = [];
            $tamanhosSelecionados = [];
        }
    
    ?>

    <div class="navbar">
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
    <div class="cadastroFundo">
        <form method="post" name="formCadProduto" action="../control/cadProdutoFeminino.php" enctype="multipart/form-data">
            <input type="hidden" name="idProduto" value="<?php echo $idProduto; ?>">
            <div class="cadastro">
                <div class="row" style="display: flex; justify-content: space-around">
                    <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;"><?php if(isset($_GET["id"])){ echo "Alterar Produto Feminino"; } else{ echo "Cadastro de Produto Feminino"; } ?></p>
                </div>

                <div class="mensagem">
                    <?php
                        if(isset($_GET["msg"])){
                            $mensagem = $_GET["msg"];
                            echo "<FONT color=red>$mensagem</FONT>";
                        }
                    ?>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col" style="display: flex;">
                        <label for="txtNomeProduto" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px;">Nome do Produto: </label>
                        <input type="text" class="form-control" size="40" name="txtNomeProduto" id="txtNomeProduto" placeholder="Insira o nome do produto" required="" value="<?php echo "$nome"; ?>">
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col" style="display: flex;">
                        <label for="txtReferenciaProduto" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px;">Referência: </label>
                        <input type="text" class="form-control" size="40" name="txtReferenciaProduto" id="txtReferenciaProduto" placeholder="Insira a referência do produto" required="" value="<?php echo "$referencia"; ?>" <?php if(isset($_GET["id"])){ echo "readonly"; } ?>>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col" style="display: flex;">
                        <label for="txtDescricao" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Descrição: </label>
                        <textarea class="form-control" placeholder="Insira a descrição do produto:" id="txtDescricao" name="txtDescricao" style="height: 200px"><?php echo "$descricao"; ?></textarea>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col" style="display: flex;">
                        <label for="txtPreco" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Preço: </label>
                        <input type="text" class="form-control" size="40" placeholder="Insira o preço do produto" name="txtPreco" id="txtPreco" required="" value="<?php echo "$preco"; ?>">
                    </div>
                    <div class="col" style="display: flex;">
                        <label for="txtEstoque" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Estoque: </label>
                        <input type="number" class="form-control" size="40" placeholder="Insira a quantidade em estoque" name="txtEstoque" id="txtEstoque" required="" value="<?php echo "$qtdEstoque"; ?>">
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="txtCor" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Cores: </label>
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once "../model/corDAO.php";
                                    $res = exibirCor();
                                    while ($registro = mysqli_fetch_assoc($res)){
                                        $idCor = $registro["idcor"];
                                        $nomeCor = $registro["nomeCor"];
                                        $isCorSelecionada = in_array($idCor, $coresSelecionadas);
                                        echo "<tr>";
                                        echo "<th scope='row'><input class='form-check-input' type='checkbox' value='$idCor' name='cores[]' ". ($isCorSelecionada ? 'checked' : '') ."></th>";
                                        echo "<td>$idCor</td>";
                                        echo "<td>$nomeCor</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <label for="txtTamanho" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Tamanhos: </label>
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tamanho</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once "../model/tamanhoDAO.php";
                                    $res = exibirTamanho();
                                    while ($registro = mysqli_fetch_assoc($res)){
                                        $idTamanho = $registro["idtamanho"];
                                        $tamanho = $registro["tamanho"];
                                        $isTamanhoSelecionado = in_array($idTamanho, $tamanhosSelecionados);
                                        echo "<tr>";
                                        echo "<th scope='row'><input class='form-check-input' type='checkbox' value='$idTamanho' name='tamanhos[]'". ($isTamanhoSelecionado ? 'checked' : '') ."></th>";
                                        echo "<td>$idTamanho</td>";
                                        echo "<td>$tamanho</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="img">Foto:  </label>
                        <input type="file" class="form-control" id="img" name="img" required="">
                    </div>
                    <div class="col">
                        <?php
                            if ( ! empty($foto) ) {
                                $imagem = base64_encode($foto);
                                echo "Imagem atual:";
                                echo "<br>";
                                echo "<img src='data:image/jpeg;base64,$imagem' id='imgPreview' height='150' width='150'>";
                            } else {
                                echo "<img src='../img/imagem-produto.png' id='imgPreview' height='150' width='150' >";
                            }
                        ?>
                    </div>
                    <div class="col" style="display: flex; justify-content: center">
                        <input type="submit" class="btn btn-outline-secondary" name="btnFinalizar" value="Finalizar Cadastro">
                    </div>
                </div>

                <div class="modal fade" tabindex="-1" id="modal01">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cadastro concluído</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>O cadastro do produto foi concluído com sucesso.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="pagina-inicial-cadProduto.php" type="button" class="btn btn-success" style="background-color: gray">Ir para a página inicial</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br>
    </div>
    <script>
        const imageInput = document.getElementById('img');
        const imagePreview = document.getElementById('imgPreview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function() {
                    imagePreview.src = this.result;
                });

                reader.readAsDataURL(file); // Convert file to a data URL
            } else {
                imagePreview.src= ""; // Show message if no image is selected
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>