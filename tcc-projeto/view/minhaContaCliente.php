<?php
    require_once "../control/validarSessao.php";
    if(validarSessao(true, false) == false){
        header("Location:login.php?msg=Você precisa fazer login para acessar a esta página.");
    }
?>
<?php
    require_once "../model/clienteDAO.php";
    if (!isset($_SESSION['cliente'])) {
        header("Location: login.php");
        exit();
    }
    
    // Conectar ao banco de dados
    require_once "../model/conexaoBD.php";
    $conexao = conectarBD();
    
    // Recuperar dados do usuário do banco de dados
    $cliente = $_SESSION['cliente'];
    $query = "SELECT * FROM cliente WHERE cnpj = '$cliente'";
    $result = mysqli_query($conexao, $query);
    $clienteData = mysqli_fetch_assoc($result);
    
    // Fechar conexão
    mysqli_close($conexao);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
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
    <div class="cadastroFundo">
        <div class="cadastro">
            <div class="row" style="display: flex; justify-content: space-around">
                <img src="../img/usuario.png" alt="Cliente" style="width: 90px">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;"><?php echo $clienteData['razaoSocial'] ?></p>
            </div>
            <br>
            <br>
            <div style="display: flex; justify-content: center" class="informacoes">
                <a href="meusPedidos.php?id=<?php echo $clienteData['idCliente']; ?>" style="color: black; padding: 30px; text-decoration: none"><p>Meus pedidos</p></a>
                <a href="cadCliente.php?id=<?php echo $clienteData['idCliente']; ?>" style="color: black; padding: 30px; text-decoration: none"><p>Alterar conta</p></a>
                <a href="#" style="color: black; padding: 30px; text-decoration: none" onclick="openModalExcluir()"><p>Excluir conta</p></a>
                <a href="#" style="color: black; padding: 30px; text-decoration: none" onclick="openModalSair()"><p>Sair</p></a>
            </div>
            <div class="modal fade" tabindex="-1" id="modalExcluir">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir conta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir sua conta?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="minhaContaCliente.php" type="button" class="btn btn-success" style="background-color: gray">Cancelar</a>
                        <a href="../control/exCliente.php" type="button" class="btn btn-success" style="background-color: gray">Sim</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modalSair">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir conta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja sair da sua conta? Seus itens no carrinho serão descartados.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="minhaContaCliente.php" type="button" class="btn btn-success" style="background-color: gray">Cancelar</a>
                        <a href="pagina-inicial-cliente.php" type="button" class="btn btn-success" style="background-color: gray">Sim</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php
        require_once "rodapeCliente.php";
    ?>

    <script>

        function openModalExcluir(){
            var myModal = new bootstrap.Modal(document.getElementById('modalExcluir'));
            myModal.show();
        }
        function openModalSair(){
            var myModal = new bootstrap.Modal(document.getElementById('modalSair'));
            myModal.show();
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>