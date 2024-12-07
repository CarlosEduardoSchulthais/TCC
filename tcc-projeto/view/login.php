<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="pagina-inicial-cliente.css">
    <link rel="stylesheet" href="cadCliente.css">
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
    <div class="cadastroFundo">
        <div class="cadastro">
            <div class="row" style="display: flex; justify-content: space-around">
                <img src="../img/usuario.png" alt="Cliente" style="width: 90px">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;">Login</p>
            </div>
            <form action="../control/login.php" method="post" name="formLogin">
                <div style="display: flex; justify-content: space-around">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="login" id="login" value="cliente" checked>
                        <label class="form-check-label" for="login">Entrar como cliente</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="login" id="login" value="administrador">
                        <label class="form-check-label" for="login">Entrar como administrador</label>
                    </div>
                </div>
                <br>
                <br>
                <div class="mensagem">
                    <?php

                        if(isset($_GET["msg"])){
                            $mensagem = $_GET["msg"];
                            echo "<FONT color=red>$mensagem</FONT>";
                        }

                    ?>
                </div>
                <div class="row">
                    <div class="col" style="display: flex">
                        <label for="txtLogin" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Login: </label>
                        <input type="text" class="form-control" placeholder="Insira seu login" name="txtLogin" id="txtLogin" required="">
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col" style="display: flex;">
                        <label for="txtSenha" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Senha: </label>
                        <input type="password" class="form-control" size="40" maxlength="8" placeholder="Insira sua Senha" name="txtSenha" id="txtSenha" required="">
                    </div>
                </div>

            <br>
            <br>
            <div class="row">
                <div class="col" style="display: flex; justify-content: center">
                    <input type="submit" class="btn btn-outline-secondary" name="btnEntrar" value="Entrar">
                </div>
                <div class="col">
                    <p >É um cliente e não possui uma conta ainda? Clique <a href="cadCliente.php">aqui</a> para se cadastrar.</p>
                </div>
            </div>
            
            <div class="modal fade" tabindex="-1" id="modalLoginCliente">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Login concluído</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <p>Login feito com sucesso.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="pagina-inicial-cadCliente.php" type="button" class="btn btn-success" style="background-color: gray">Ir para a página inicial</a>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" tabindex="-1" id="modalLoginAdministrador">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login concluído</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Login feito com sucesso.</p>
            </div>
            <div class="modal-footer">
                <a href="pagina-inicial-administrador.php" type="button" class="btn btn-success" style="background-color: gray">Ir para a página inicial</a>
            </div>
        </div>
    </div>
    </div>
            </form>
        </div>
    </div>
    <br>
    <br>
    <?php
        require_once "rodape.php";
    ?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    // Exibir o modal se a URL contiver o parâmetro de sucesso
    window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('successCliente') === 'true') {
                var myModal = new bootstrap.Modal(document.getElementById('modalLoginCliente'));
                myModal.show();
            }
            if (urlParams.get('successAdministrador') === 'true') {
                var myModal = new bootstrap.Modal(document.getElementById('modalLoginAdministrador'));
                myModal.show();
            }
        }
</script>

</body>
</html>