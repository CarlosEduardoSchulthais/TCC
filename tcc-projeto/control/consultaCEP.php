<?php
    //  Receber o CEP que deseja consultar via POST
    if (isset($_POST['txtCEP'])) {
        $cep = $_POST['txtCEP'];
    
        // Retirar os símbolos. Deixar apenas os números
        $cep = preg_replace('/[^0-9]/', '', $cep);
    
        // Faz a consulta e retorna um JSON
        $url = "https://viacep.com.br/ws/{$cep}/json/";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $data = json_decode($response, true);
    
        if (isset($data['erro'])) {
            echo json_encode(null); // Retorna nulo se o CEP for inválido
        }
    
        echo json_encode($data);
    }
?>