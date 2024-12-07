<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="cadCliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="pagina-inicial-cliente.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="../img/Logo guia.png" type="img/png">
</head>
<body style="margin: 0;
    padding: 0;
    box-sizing: border-box; /* Inclui padding e border no tamanho total */
    overflow-x: hidden;">
    <?php

    if ( isset($_GET["id"] ) ) {
        require_once '../model/clienteDAO.php';
        require_once '../control/funcoes.php';
        $idCliente = $_GET["id"];
        $res = pesquisarClientePorID($idCliente);
        if($res != null){
            $registro = mysqli_fetch_assoc($res);
            $nomeFantasia = $registro["nomeFantasia"];
            $razaoSocial = $registro["razaoSocial"];
            $inscricaoEstadual = $registro["inscricaoEstadual"];
            $cnpj = $registro["cnpj"];
            $rua = $registro["rua"];
            $numero = $registro["numero"];
            $bairro = $registro["bairro"];
            $cidade = $registro["cidade"];
            $cep = $registro["cep"];
            $telefone = $registro["telefone"];
            $email = $registro["email"];
            $estado = $registro["estado_idEstado"];

        }

    } else{
        $nomeFantasia = "";
        $razaoSocial = "";
        $inscricaoEstadual = "";
        $cnpj = "";
        $rua = "";
        $numero = "";
        $bairro = "";
        $cidade = "";
        $cep = "";
        $telefone = "";
        $email = "";
        $estado = "";
        $idCliente = "";
        
    }
    
    ?>
    <div class= "navbar">
        <div class="logo">
            <img src="../img/Logo.png" alt="Conteúdo Jeans Wear" style="width: 90px; height: 80px;">
            <a class="texto-tipos" href="<?php if(isset($_GET["id"])){ echo "pagina-inicial-cadCliente.php";} else{ echo "pagina-inicial-cliente.php"; } ?>">Conteúdo Jeans Wear</a>
        </div>
        <div class="tipos-produtos">
            <a class="texto-tipos" href="<?php if(isset($_GET["id"])){ echo "pagina-cliente-feminino.php";} else{ echo "pagina-feminino.php"; } ?>">Feminino</a>
            <a class="texto-tipos" href="<?php if(isset($_GET["id"])){ echo "pagina-cliente-masculino.php";} else{ echo "pagina-masculino.php"; } ?>">Masculino</a>
            <a class="texto-tipos" href="<?php if(isset($_GET["id"])){ echo "pagina-cliente-lancamentos.php";} else{ echo "pagina-lancamentos.php"; } ?>">Lançamentos</a>
        </div>
        <form class="d-flex" role="search" action="<?php if(isset($_GET["id"])){ echo "produtosPesquisadosCliente.php";} else{ echo "produtosPesquisados.php"; } ?>">
                <input class="form-control me-2" type="search" placeholder="Pesquisar produtos..." aria-label="Search" name="txtPesqProdutos" id="txtPesqProdutos">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
        <div class="carrinho">
            <a href="carrinho.php"><img src="../img/carrinho.png" alt="Carrinho de compras" style="width: 40px"></a>
            <a href="<?php if(isset($_GET["id"])){ echo "minhaContaCliente.php";} else{ echo "login.php"; } ?>"><img src="../img/usuario.png" alt="Minha conta" style="width: 40px"></a>
            <a href="<?php if(isset($_GET["id"])){ echo "informacoesContatoCliente.php";} else{ echo "informacoesContato.php"; } ?>"><img src="../img/fone2.png" alt="Atendimento ao cliente" style="width: 50px;"></a>
        </div>
    </div>
    <div class="cadastroFundo">
        <form method="post" name="formCadCliente" action="../control/cdcliente.php">
        <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">
        <div class="cadastro">
            <div class="row" style="display: flex; justify-content: space-around">
                <img src="../img/usuario.png" alt="Cliente" style="width: 90px">
                <p class="h1" style="text-align: center; font-family: Impact, Haettenschweile, 'Arial Narrow Bold', sans-serif;"><?php if(isset($_GET["id"])){ echo "Alteração de Cliente";} else{ echo "Cadastro de Cliente"; } ?></p>
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
                    <label for="txtCNPJ" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px;">CNPJ: </label>
                    <input type="text" class="form-control" size="40" name="txtCNPJ" id="txtCNPJ" pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" placeholder="00.000.000/0000-00" id="txtCNPJ" required="" value="<?php echo $cnpj; ?>" <?php if(isset($_GET["id"])){ echo "readonly"; } ?>>
                </div>
                <div class="col" style="display: flex">
                    <label for="txtInscricaoEstadual" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Insc. Estadual: </label>
                    <input type="text" class="form-control" placeholder="Insira sua Insc. Estadual" name="txtInscricaoEstadual" id="txtInscricaoEstadual" value="<?php echo $inscricaoEstadual; ?>">
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col" style="display: flex;">
                    <label for="txtRazaoSocial" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Razão Social: </label>
                    <input type="text" class="form-control" size="40" placeholder="Insira sua Razão Social" name="txtRazaoSocial" id="txtRazaoSocial" required="" value="<?php echo $razaoSocial; ?>" <?php if(isset($_GET["id"])){ echo "readonly"; } ?>>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col" style="display: flex;">
                    <label for="txtNomeFantasia" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Nome Fantasia: </label>
                    <input type="text" class="form-control" size="40" placeholder="Insira seu Nome Fantasia" name="txtNomeFantasia" id="txtNomeFantasia" value="<?php echo $nomeFantasia; ?>">
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col" style="display: flex">
                    <label for="txtCEP" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">CEP: </label>
                    <input type="text" class="form-control" name="txtCEP" id="txtCEP" pattern="\d{5}-\d{3}" placeholder="00000-000" required="" value="<?php echo $cep; ?>">
                </div>
                <div class="col" style="display: flex;">
                    <label for="txtRua" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px;">Rua/Avenida: </label>
                    <input type="text" class="form-control" size="40" placeholder="Insira a rua/avenida do seu endereço" id="txtRua" name="txtRua" required="" value="<?php echo $rua; ?>">
                </div>
                <div class="col" style="display: flex">
                    <label for="txtNumero" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Nº</label>
                    <input type="text" class="form-control" placeholder="Insira o nº do seu endereço" name="txtNumero" id="txtNumero" required="" value="<?php echo $numero; ?>">
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col" style="display: flex;">
                    <label for="txtBairro" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px;">Bairro: </label>
                    <input type="text" class="form-control" size="40" placeholder="Insira seu bairro" name="txtBairro" id="txtBairro" required="" value="<?php echo $bairro; ?>">
                </div>
                <div class="col" style="display: flex">
                    <label for="txtCidade" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Cidade: </label>
                    <input type="text" class="form-control" placeholder="Insira sua cidade" name="txtCidade" id="txtCidade" required="" value="<?php echo $cidade; ?>">
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col" style="display: flex">
                <label for="listaEstados" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Estado: </label>
                    <select class="form-select" aria-label="Default select example" name="listaEstados" id="listaEstados">
                        <option selected value="">Selecione um estado</option>
                        <?php
                            
                            require_once "../model/estadoDAO.php";
                            $options = carregarComboEstado($estado);
                            echo $options;

                        ?>
                    </select>
                </div>
                <div class="col" style="display: flex;">
                    <label for="txtEmail" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px;">E-mail: </label>
                    <input type="text" class="form-control" size="40" placeholder="Insira seu e-mail" name="txtEmail" id="txtEmail" required="" value="<?php echo $email; ?>">
                </div>
                
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col" style="display: flex">
                    <label for="txtTelefone" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Celular: </label>
                    <input type="text" class="form-control" placeholder="Insira seu número de celular" name="txtTelefone" id="txtTelefone" required="" value="<?php echo $telefone; ?>">
                </div>
                <div class="col" style="display: flex;">
                    <label for="txtSenha" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Senha: </label>
                    <input type="password" class="form-control" size="40" maxlength="8" placeholder="Insira sua Senha" name="txtSenha" id="txtSenha">
                </div>
                <div class="col" style="display: flex;">
                    <label for="txtSenha2" class="form-label" style="margin-left: 30px; margin-right: 30px; margin-top: 10px; margin-bottom: 10px; font-size: 25px">Confirmar Senha: </label>
                    <input type="password" class="form-control" size="40" maxlength="8" placeholder="Confirme sua senha" name="txtSenha2" id="txtSenha2">
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col" style="display: flex; justify-content: center">
                    <input type="submit" class="btn btn-outline-secondary" name="btnFinalizar" value="Finalizar Cadastro">
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="modal01">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php if(isset($_GET["id"])){ echo "Alteração concluída"; } else{ echo "Cadastro concluído"; }?></h5>
                        
                    </div>
                    <div class="modal-body">
                        <p><?php if(isset($_GET["id"])){ echo "Cadastro alterado com sucesso."; } else{ echo "Cadastro feito com sucessso."; }?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="pagina-inicial-cadCliente.php" type="button" class="btn btn-success" style="background-color: gray">Ir para a página inicial</a>
                    </div>
                </div>
            </div>
        </div>

        </div>
        </form>
        <br>
        
    </div>
    <?php
        require_once "rodape.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.getElementById('txtCNPJ').addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
            e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + (x[3] ? '.' + x[3] : '') + (x[4] ? '/' + x[4] : '') + (x[5] ? '-' + x[5] : '');
        });

        document.getElementById('txtCEP').addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,5})(\d{0,3})/);
            e.target.value = x[1] + (x[2] ? '-' + x[2] : '');
        });

        
        // Exibir o modal se a URL contiver o parâmetro de sucesso
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === 'true') {
                var myModal = new bootstrap.Modal(document.getElementById('modal01'));
                myModal.show();
            }
        }
    
    </script>
    <script>
    $(document).ready(function() {
        $('#txtCEP').on('blur', function() {
            var cep = $(this).val().replace(/\D/g, '');

            if (cep !== "") {
                $.ajax({
                    url: '../control/consultaCEP.php',
                    type: 'POST',
                    data: { txtCEP: cep },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#txtRua').val(data.logradouro);
                            $('#txtBairro').val(data.bairro);
                            $('#txtCidade').val(data.localidade);
                            $('#listaEstados').val(data.uf);
                        } else {
                            // ERRO. Apagar os campos
                            $('#txtRua').val("");
                            $('#txtBairro').val("");
                            $('#txtCidade').val("");
                            $('#listaEstados').val("");
                        
                            alert('CEP não encontrado.');  // Pode trocar por outra forma de mostrar a mensagem
                        }
                    },
                    error: function() {
                        // ERRO. Apagar os campos
                        $('#txtRua').val("");
                        $('#txtBairro').val("");
                        $('#txtCidade').val("");
                        $('#listaEstados').val("");
                        
                        alert('Erro ao consultar o CEP.');   // Pode trocar por outra forma de mostrar a mensagem
                    }
                });
            }
        });
    });
</script>

<script>
        $(document).ready(function() {
            $('#txtTelefone').on('input', function() {
                var numero = $(this).val().replace(/\D/g, ''); // Remove tudo que não for dígito
                
                if (numero.length > 10) {
                    numero = numero.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3'); // Formato celular
                } else if (numero.length > 5) {
                    numero = numero.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3'); // Formato fixo
                } else if (numero.length > 2) {
                    numero = numero.replace(/^(\d{2})(\d{0,5})/, '($1) $2'); // Parcial
                } else {
                    numero = numero.replace(/^(\d*)/, '($1'); // Começa com o DDD
                }

                $(this).val(numero);
            });
        });
    </script>
</body>
</html>