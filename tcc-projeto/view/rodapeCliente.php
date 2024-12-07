<?php
    require_once "../model/clienteDAO.php";
    
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
<div class="row" style="background-color: #808080; height: 330px">
    <div class="col" style="margin: 30px">
        <h1 style="font-size: 30px">Informações</h1>
        <br>
        <a href="minhaContaCliente.php" style="font-size: 20px; text-decoration: none; color: black">Minha conta</a>
        <br>
        <a href="meusPedidos.php?id=<?php echo $clienteData["idCliente"];?>" style="font-size: 20px; text-decoration: none; color: black">Meus pedidos</a>
        <br>
        <a href="carrinho.php" style="font-size: 20px; text-decoration: none; color: black">Carrinho</a>
    </div>
    <div class="col" style="margin: 30px">
        <h1 style="font-size: 30px">Contatos</h1>
        <br>
        <p style="font-size: 20px; text-decoration: none; color: black">Telefone: (27) 99970-2066</p>
        <p style="font-size: 20px; text-decoration: none; color: black">E-mail: conteudojeanswear@gmail.com</p>
        <p style="font-size: 20px; text-decoration: none; color: black">Whatsapp: (27) 99970-2066</p>
    </div>
    <div class="col" style="margin: 30px;">
        <h1 style="font-size: 30px">Redes sociais:</h1>
        <br>
        <a href="https://www.instagram.com/conteudojeanswear/"><img src="../img/instagram.png" alt="Logo do Instagram" style="width: 50px"></a>
        <a href="https://www.facebook.com/conteudojeanswear"><img src="../img/facebook.webp" alt="Logo do Facebook" style="width: 50px"></a>
    </div>
</div>