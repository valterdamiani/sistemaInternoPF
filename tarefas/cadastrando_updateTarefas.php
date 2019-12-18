<?php
    include 'connections.php';
    include 'session.php';   

    $usuario = $_SESSION['colaborador'];
    $id = $_POST['id'];
    $status = $_POST['status'];


    if($status == NULL){
      $updateTarefa = $pdo->prepare('
        UPDATE `tarefasInternas` 
        SET status = "Em Andamento",
        responsavel = :usuario,
        dataInicio = NOW()
        WHERE id = :id
      ');
      $updateTarefa->bindValue(':usuario', $usuario);
      $updateTarefa->bindValue(':id', $id);
      $updateTarefa->execute();
    }
    if($status == 'Pausado'){
      $pauseStatus = $pdo->prepare('
        UPDATE `tarefasInternas` 
        SET status = "Pausado",
        responsavel = :usuario,
        dataPausa = NOW()
        WHERE id = :id
      ');
      $pauseStatus->bindValue(':usuario', $usuario);
      $pauseStatus->bindValue(':id', $id);
      $pauseStatus->execute();
    }
    if($status == 'Fazendo'){
      $startStatus = $pdo->prepare('
        UPDATE `tarefasInternas` 
        SET status = "Em Andamento",
        responsavel = :usuario,
        dataFim = NOW()
        WHERE id = :id
      ');
      $startStatus->bindValue(':usuario', $usuario);
      $startStatus->bindValue(':id', $id);
      $startStatus->execute();   
    }
    if($status == 'Finalizado'){
      $finishedStatus = $pdo->prepare('
        UPDATE `tarefasInternas` 
        SET status = "Finalizado",
        responsavel = :usuario,
        dataFim = NOW()
        WHERE id = :id
      ');
      $finishedStatus->bindValue(':usuario', $usuario);
      $finishedStatus->bindValue(':id', $id);
      $finishedStatus->execute();   
    }
    
  $opcaoDeEnvio = "tarefasInternas";
  $titulo = "Autenticando..."; 
  $tempo = 100;
  require_once "autenticando.php";
?>