<?php
    require_once '../model/vendaDAO.php';
    require_once "../model/conexaoBD.php";
	require_once "funcoesCarrinho.php";
    session_start();
    $cliente = $_SESSION["cliente"];
    $carrinho = $_SESSION["carrinho"];
	$frete = $_POST["frete"];

	if(count($carrinho) != 0){
    	$conexao = conectarBD();
    	$sql = "SELECT * FROM cliente WHERE cnpj = '$cliente'";
    	$res = mysqli_query($conexao, $sql);
    	$registro = mysqli_fetch_assoc($res);
    	$idCliente = $registro["idCliente"];
		$qtde = 0;
		foreach ( $carrinho as $chaveProduto => $produto) {
			$idProduto = $produto["idProduto"];
			$qtde = $qtde + $produto["qtde"];
		}

		$msgErro = validarVenda($idProduto, $qtde, $carrinho);
    
		if (empty($msgErro)) {
		// Inserir na TABELA PRINCIPAL DA VENDA
			$idVenda = inserirVenda($idCliente);
		
		
		// Percorrer o carrinho (sessão) e inserir na tabela ITENSVENDA
			$total = 0;
			foreach ($carrinho as $chaveProduto => $produto) {
				$idProduto = $produto["idProduto"];
				$preco = $produto["preco"];
				$qtde = $produto["qtde"];
				$cor = $produto["cor"];
				$tamanho = $produto["tamanho"];
		
				$subTotal = $preco * $qtde;
				$total += $subTotal;
				inserirItemVenda($idProduto, $idVenda, $qtde, $cor, $tamanho);
			}
			$totalVenda = $total + $frete;
		
			alterarTotal ( $idVenda, $totalVenda);
		
		// Apaga o carrinho da sessão
			unset( $_SESSION["carrinho"] );

		// Cria um novo carrinho vazio
			$_SESSION["carrinho"] = array();

			header("Location:../view/compraFinalizada.php");
		} else {
			header("Location:../view/carrinho.php?msg=$msgErro");
		}
	} else{
		header("Location:../view/carrinho.php?msg=Não foram inseridos produtos no carrinho.");
	}
?>
