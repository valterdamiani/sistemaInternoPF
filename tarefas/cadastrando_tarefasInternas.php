<?php 
// includes the connections and session pages, responsible for verifying user authentication and storing actions performed by the user during their access
    include 'connections.php';
    include 'session.php';   
    
    $usuario = $_SESSION['colaborador'];
    $title = $_POST['title'];
    $task = $_POST['task'];
    
      $insertTarefa = $pdo->prepare('
        INSERT INTO `tarefasInternas`(`titulo`, `tarefa`, `criador`, `dataCadastro`) 
        VALUES (:title, :task, :creator, NOW())');
      $insertTarefa->bindValue(':title', $title);
      $insertTarefa->bindValue(':task', $task);
      $insertTarefa->bindValue(':creator', $usuario);
      $insertTarefa ->execute();

    $opcaoDeEnvio = "tarefasInternas";
    $titulo = "Autenticando..."; 
    $tempo = 100;
    require_once "autenticando.php";
?>