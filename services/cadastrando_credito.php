<?php
include 'connections.php';
include 'session.php';   

$usuario_fk= $_POST['usuario_fk'];
$saldoCredito = $_POST['credito'];
$responsavel = $_SESSION['colaborador'];
$dataCompra = $_POST['dataCompra'];
$saldoAnterior = $_POST['saldoAnterior'];
$saldoAtual = ($saldoAnterior + $saldoCredito);
$id_fk = $_POST['idTransacao'];

    $setTimeZone = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $setTimeZone->execute();

    if($saldoAnterior == NULL){
        $tipo = 'credito';
        $sql = $pdo->prepare(" 
        INSERT INTO creditosLead
        (dtm, usuario_fk, saldoCredito, responsavel, dataCompra)
        VALUES (NOW(), :usuario_fk, :saldoCredito, :responsavel, :dataCompra)");

        $sql->bindValue(':usuario_fk', $usuario_fk);
        $sql->bindValue(':saldoCredito', $saldoCredito);
        $sql->bindValue(':responsavel', $responsavel);
        $sql->bindValue(':dataCompra', $dataCompra);
        $sql->execute();
    }else{        
        $tipo = 'credito';
        $sql = $pdo->prepare("
        UPDATE creditosLead
        SET dtm= NOW(), 
        saldoCredito= :saldoAtual, 
        responsavel= :responsavel,
        dataCompra= :dataCompra
        WHERE usuario_fk = :usuario_fk
        ");
        $sql->bindValue(':usuario_fk', $usuario_fk);
        $sql->bindValue(':saldoAtual', $saldoAtual);
        $sql->bindValue(':dataCompra', $dataCompra);
        $sql->bindValue(':responsavel', $responsavel);
        $sql->execute();    
    }

    $log = $pdo->prepare(" 
    INSERT INTO logCredito
    (dtm, usuario_fk, responsavel, saldoAnterior, creditoDebito, saldoAtual , tipo, id_fk)
    VALUES (NOW(), :usuario_fk, :responsavel, :saldoAnterior, :creditoDebito,  :saldoAtual, :tipo, :id_fk)");

    $log->bindValue(':usuario_fk', $usuario_fk);
    $log->bindValue(':responsavel', $responsavel);
    $log->bindValue(':saldoAnterior', $saldoAnterior);
    $log->bindValue(':creditoDebito', $saldoCredito);
    $log->bindValue(':saldoAtual', $saldoAtual);
    $log->bindValue(':tipo', $tipo);
    $log->bindValue(':id_fk', $id_fk);
    $log->execute();  

    $opcaoDeEnvio = "creditoFranqueados";
    $titulo = "Autenticando...";
    $tempo = 3000;
    require_once "autenticando.php";
?>