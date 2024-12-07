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
    <title>Pesquisar Cliente</title>
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
            <form class="d-flex" role="search" action="produtosPesquisadosCliente.php">
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
            <div class="col" style="display: flex; justify-content: center;">
                <form class="d-flex" role="search" action="pesquisarCliente.php">
                    <select name="escolha">
                        <option value="1">Razão Social</option>
                        <option value="2">CNPJ</option>
                        <option value="3">Nome Fantasia</option>
                    </select>
                    <input class="form-control me-2" type="search" placeholder="Pesquisar clientes..." aria-label="Search" name="txtPesqCliente" id="txtPesqCliente">
                    <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
        </div>
        <br>
        <br>
        <div class="row" style="display: flex; justify-content: center">

            <?php
                if(isset($_GET["txtPesqCliente"])){
                    require_once "../model/clienteDAO.php";
                    require_once "../control/funcoes.php";
                    echo "<table class='table table-striped table-bordered' style='width: 80%; text-align: center; align-items: center'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th scope='col'>ID</th>";
                    echo "<th scope='col'>Nome Fantasia</th>";
                    echo "<th scope='col'>Razão Social</th>";
                    echo "<th scope='col'>Inscrição Estadual</th>";
                    echo "<th scope='col'>CNPJ</th>";
                    echo "<th scope='col'>Rua</th>";
                    echo "<th scope='col'>Nº do Endereço</th>";
                    echo "<th scope='col'>Bairro</th>";
                    echo "<th scope='col'>Cidade</th>";
                    echo "<th scope='col'>Estado</th>";
                    echo "<th scope='col'>CEP</th>";
                    echo "<th scope='col'>Telefone</th>";
                    echo "<th scope='col'>E-mail</th>";
                    echo "<th scope='col'>Ativo</th>";
                    echo "<th scope='col'>Desativar Cliente</th>";
                    echo "</thead>";

                    $pesq = $_GET["txtPesqCliente"];
                    $tipo = $_GET["escolha"];
                    $res = pesquisar($pesq, $tipo);

                    while($registro = mysqli_fetch_assoc($res)){
                        $idCliente = $registro["idCliente"];
                        $nomeFantasia = $registro["nomeFantasia"];
                        $razaoSocial = $registro["razaoSocial"];
                        $inscricaoEstadual = $registro["inscricaoEstadual"];
                        $cnpj = $registro["cnpj"];
                        $rua = $registro["rua"];
                        $numero = $registro["numero"];
                        $bairro = $registro["bairro"];
                        $cidade = $registro["cidade"];
                        $estado = $registro["estado_idEstado"];
                        $cep = $registro["cep"];
                        $telefone = $registro["telefone"];
                        $email = $registro["email"];
                        $ativo = $registro["ativo"];

                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>$idCliente</th>";
                        echo "<td>$nomeFantasia</td>";
                        echo "<td>$razaoSocial</td>";
                        echo "<td>$inscricaoEstadual</td>";
                        echo "<td>$cnpj</td>";
                        echo "<td>$rua</td>";
                        echo "<td>$numero</td>";
                        echo "<td>$bairro</td>";
                        echo "<td>$cidade</td>";
                        echo "<td>$estado</td>";
                        echo "<td>$cep</td>";
                        echo "<td>$telefone</td>";
                        echo "<td>$email</td>";
                        echo "<td>$ativo</td>";
                        echo "<td>";
                        if($ativo == 1){
                            echo "<a class='excluir' href='../control/excluirClienteAdministrador.php?id=$idCliente&pesq=$pesq&tipo=$tipo' style='color: black; padding: 30px; text-decoration: none'><img src='../img/lixo.png' height='30' width='30'></a>";
                        } else{
                            echo "Já está desativado. Clique <a href='../control/ativarCliente.php?id=$idCliente&pesq=$pesq&tipo=$tipo'>aqui</a> para ativar novamente.";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";

                }
            ?>

        </div>
        
<script>
    $(document).ready(function() {
        $('.desativar').on('click', function(e) {
            // Previne o comportamento padrão do link
            e.preventDefault();

            // Obtém o URL do link clicado
            var url = $(this).attr('href');

            // Exibe uma janela de confirmação
            var confirmAction = confirm("Você tem certeza de que deseja desativar este cliente?");

            if (confirmAction) {
                // Redireciona para a URL se a confirmação for positiva
                window.location.href = url;
            } 
        });
    });
</script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>