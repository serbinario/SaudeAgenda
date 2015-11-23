<?php

#Verificando se o arquivo existe
if (isset($argv[1]) && \file_exists($argv[1]) ) {
    #Conexão e sql ultizados
    $pdo   = new \PDO("mysql:dbname=agenda_servidor;host=localhost", "root", "serbinario");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql   = "insert into cgm (nome, numero_nis, sexo_id_sexo, data_nascimento, cpf_cnpj,"
            . " rg, data_expedicao, orgao_emissor, numero_titulo, numero_zona, numero_sessao, tipo_cadastro)"
            . " values(?,?,?,?,?,?,?,?,?,?,?,?);";
    
    #Abrindo o arquivo
    $handle = fopen ($argv[1],"r");
        
    #Varrendo o cada linha do csv
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        
        #Tratando os valores do arraye prenchendo os campos para inserção 
        $nome       = $data[4];
        $numeroNis  = $data[5];
        $sexo       = $data[7];
        $dataNasc   = $data[8];
        $cpf        = $data[33];
        $rg         = $data[34];
        $dataExp    = $data[36];    
        $orgEmissor = $data[38];
        $numTitulo  = $data[43];
        $numZona    = $data[44];
        $numSessao  = $data[45];
        $tipoCad    = 1;
        
        #Criando o comando do pdo e setando os parametros
        $statement  = $pdo->prepare($sql);
        $statement->bindValue(1,  $nome);
        $statement->bindValue(2,  $numeroNis);
        $statement->bindValue(3,  $sexo);
        $statement->bindValue(4,  $dataNasc);
        $statement->bindValue(5,  $cpf);
        $statement->bindValue(6,  $rg);
        $statement->bindValue(7,  $dataExp);
        $statement->bindValue(8,  $orgEmissor);
        $statement->bindValue(9,  $numTitulo);
        $statement->bindValue(10, $numZona);
        $statement->bindValue(11, $numSessao);
        $statement->bindValue(12, $tipoCad);
        
        #Executando
        try {
            $statement->execute();
            
            #mensagem de retorno
            echo "Cadastro realizado com sucesso \n";
        }catch(\PDOException $e) {
            echo $e->getMessage();exit;
        }      
    }
    
    #Fechando o arquivo
    fclose ($handle);   
} else {
    echo "Você deve inserir um arquivo ou o arquivo não existe";
}
