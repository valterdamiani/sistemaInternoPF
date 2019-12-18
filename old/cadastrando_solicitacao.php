<?php
    // includes the connections and session pages, responsible for verifying user authentication and storing actions performed by the user during their access
    include 'connections.php';
    include 'session.php';   
    
    $lead_fk= $_POST['id'];
    $solicitante_fk= $_SESSION['colaborador'];

    // set time zone to sao paulo for use in DB insertion
    $setTimeZone = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $setTimeZone->execute();

    // insert data into 'solicitacoesLead' table
    $sqlLicitacao = $pdo->prepare("
        INSERT INTO `solicitacoesLead`(`lead_fk`, `solicitante_fk`, `status`, `dtm`)
        VALUES (:lead_fk, :solicitante_fk, 'Aguardando', NOW())");
        
    $sqlLicitacao->bindValue(':lead_fk', $lead_fk);
    $sqlLicitacao->bindValue(':solicitante_fk', $solicitante_fk);
    $sqlLicitacao->execute();
    $lastId = $pdo->lastInsertId();
    

    // define page to be redirected to after insert data into database
    $opcaoDeEnvio = "leads";
    $titulo = "Autenticando...";
    $tempo = 3000;
    require_once "autenticando.php";
?>