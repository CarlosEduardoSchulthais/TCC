<?php

function conectarBD(){
    
    // CONEXÃO COM O BANCO
    $conexao = mysqli_connect("127.0.0.1:3306", "root", "", "bd_tcc" ) or 
                    die("Erro ao conectar com o banco de dados.");
    
   
// PARA RESOLVER PROBLEMAS DE ACENTUAÇÃO 
   // Converte CODIFICAÇÃO para UTF-8
   mysqli_query($conexao, "SET NAMES 'utf8'");
   mysqli_query($conexao, "SET character_set_connection=utf8");
   mysqli_query($conexao, "SET character_set_client=utf8");
   mysqli_query($conexao, "SET character_set_results=utf8");
    
    return $conexao;
    
}



?>