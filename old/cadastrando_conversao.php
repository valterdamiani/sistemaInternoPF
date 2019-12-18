<?php
    // includes the connections and session pages, responsible for verifying user authentication and storing actions performed by the user during their access
    include 'connections.php';
    include 'session.php';   

    // get values from variables for use in 'for'
    $idLead= $_POST['idLead'];
    $total = $_POST['total'];
    $desconto = $_POST['desconto'];
    $valorFinal = $_POST['valorFinal'];

    // set time zone to sao paulo for use in DB insertion
    $setTimeZone = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $setTimeZone->execute();
    
    // update data in 'leads' table
    $updateConversao = $pdo->prepare("
        UPDATE `leads` 
        SET statusConversao = 'Proposta enviada', dtmConversao = NOW()
        WHERE id = :idLead");
    $updateConversao->bindValue(':idLead', $idLead);
    $updateConversao->execute();
    
    // insert data into 'propostas' table
    $updateProposta = $pdo->prepare("
        INSERT INTO `propostas` (`lead_fk`, `total`, `desconto`, `valorFinal`) 
        VALUES( :idLead, :total, :desconto, :valorFinal)");
    $updateProposta->bindValue(':idLead', $idLead);
    $updateProposta->bindValue(':total', $total);
    $updateProposta->bindValue(':desconto', $desconto);
    $updateProposta->bindValue(':valorFinal', $valorFinal);
    $updateProposta->execute();
    $lastId = $pdo->lastInsertId();



    // the 'for' performs an insertion in the DB for each row added by the user in 'subFormProposta'
    for($i = 1; $i <= $_POST['quantidadeDeServicos']; $i++){
        $servico = $_POST['serviceSelect' . $i ];
        $recorrencia = $_POST['recorrencia' . $i ];
        $material = $_POST['material' . $i ];
        $descricao = $_POST['servicoDescricao' . $i ];
        $preco = $_POST['preco' . $i ];
    
        $updateServicos = $pdo->prepare("
        INSERT INTO `servicosProposta` (`proposta_fk`, `servico`, `recorrente`, `material`, `descricao`, `valorServico`) 
        VALUES( :proposta_fk, :servico, :recorrencia, :material, :descricao, :preco)");
        
        $updateServicos->bindValue(':proposta_fk', $lastId);
        $updateServicos->bindValue(':servico', $servico);
        $updateServicos->bindValue(':recorrencia', $recorrencia);
        $updateServicos->bindValue(':material', $material);
        $updateServicos->bindValue(':descricao', $descricao);
        $updateServicos->bindValue(':preco', $preco);
        $updateServicos->execute();
    }

    // define page to be redirected to after update data into database
    $opcaoDeEnvio = "meusLeads";
    $titulo = "Autenticando...";
    $tempo = 2000;
    require_once "autenticando.php";
?>