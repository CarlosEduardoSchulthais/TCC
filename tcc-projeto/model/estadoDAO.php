<?php

    require_once "conexaoBD.php";
    static $conexao;

    function carregarComboEstado($estado){
        $sql = "SELECT * FROM estado";
        $conexao = conectarBD();    
        $resultado = mysqli_query($conexao, $sql );

        $options = "";
        while (  $registro = mysqli_fetch_assoc($resultado)  ) {
            // Pegar os campos do REGISTRO
            $idEstado = $registro["idEstado"];
            $nome = $registro["nomeEstado"];

            if ( $idEstado == $estado) {
                $options = $options . "<OPTION SELECTED value='$idEstado'>$nome</OPTION>";
            } else {
                $options = $options . "<OPTION value='$idEstado'>$nome</OPTION>";
            }
        }

        return $options;
    }

?>