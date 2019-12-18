<?php

include 'connections.php';
include 'sessionFranqueado.php';

$id_fk= $_POST['id_fk'];
$nomeCliente = $_POST['nomeCliente'];
$tipoCliente = $_POST['tipoCliente'];
$id_fk = $_POST['id_fk'];
$nomeResponsavel = $_POST['nomeResponsavel']; 
$email = $_POST['email']; 
$ddd = $_POST['ddd']; 
$telefone = $_POST['telefone']; 
$cep = $_POST['cep']; 
$uf = $_POST['uf']; 
$cidade = $_POST['cidade']; 
$bairro = $_POST['bairro']; 
$rua = $_POST['rua']; 
$numero = $_POST['numero']; 
$complemento = $_POST['complemento']; 
$tipoCliente = $_POST['tipoCliente'];
$nomeCliente = $_POST['nomeCliente'];
$servico = $_POST['servico']; 
$visitasSemana = $_POST['visitasSemana']; 
$visitasSemanaAlta = $_POST['visitasSemanaAlta']; 
$visitasSemanaBaixa = $_POST['visitasSemanaBaixa']; 
$inicioAlta = $_POST['inicioAlta']; //data
$fimAlta = $_POST['fimAlta']; //data
$produtosInclusos = $_POST['produtosInclusos']; 
$inicioContrato = $_POST['inicioContrato']; //data
$fimContrato = $_POST['fimContrato']; //data
$observacoes = $_POST['observacoes'];

echo"
    $inicioAlta
    $fimAlta
    $inicioContrato
    $fimContrato
    ";

//     $inicioAlta = date('Y/m/d', strtotime($inicioAlta));
//     $fimAlta = date('Y/m/d', strtotime($fimAlta));
//     $inicioContrato = date('Y/m/d', strtotime($inicioContrato));
//     $fimContrato = date('Y/m/d', strtotime($fimContrato));

    echo"<br>
    $inicioAlta<br>
    $fimAlta<br>
    $inicioContrato<br>
    $fimContrato<br>
    ";

    echo "<br><br>UPDATE clientes
    SET nomeResponsavel= $nomeResponsavel,
    email= $email,
    ddd= $ddd,
    telefone= $telefone,
    cep= $cep,
    uf= $uf,
    cidade= $cidade,
    bairro= $bairro,
    rua= $rua,
    numero= $numero,
    complemento= $complemento,
    tipoCliente= $tipoCliente,
    nomeCliente= $nomeCliente,
    servico= $servico,
    visitasSemana= $visitasSemana,
    visitasSemanaAlta= $visitasSemanaAlta,
    visitasSemanaBaixa= $visitasSemanaBaixa,
    inicioAlta= $inicioAlta,
    fimAlta= $fimAlta,
    produtosInclusos= $produtosInclusos,
    inicioContrato= $inicioContrato,
    fimContrato= $fimContrato,
    observacoes= $observacoes
    
    WHERE id_fk = $id_fk";

$updateCliente = $pdo->prepare("
        UPDATE clientes
        SET nomeResponsavel= :nomeResponsavel,
        email= :email,
        ddd= :ddd,
        telefone= :telefone,
        cep= :cep,
        uf= :uf,
        cidade= :cidade,
        bairro= :bairro,
        rua= :rua,
        numero= :numero,
        complemento= :complemento,
        tipoCliente= :tipoCliente,
        nomeCliente= :nomeCliente,
        servico= :servico,
        visitasSemana= :visitasSemana,
        visitasSemanaAlta= :visitasSemanaAlta,
        visitasSemanaBaixa= :visitasSemanaBaixa,
        inicioAlta= :inicioAlta,
        fimAlta= :fimAlta,
        produtosInclusos= :produtosInclusos,
        inicioContrato= :inicioContrato,
        fimContrato= :fimContrato,
        observacoes= :observacoes

        WHERE id_fk = :id_fk
    ");
    $updateCliente->bindValue(':id_fk', $id_fk);
    $updateCliente->bindValue(':nomeResponsavel', $nomeResponsavel);
    $updateCliente->bindValue(':email', $email);
    $updateCliente->bindValue(':ddd', $ddd);
    $updateCliente->bindValue(':telefone', $telefone);
    $updateCliente->bindValue(':cep', $cep);
    $updateCliente->bindValue(':uf', $uf);
    $updateCliente->bindValue(':cidade', $cidade);
    $updateCliente->bindValue(':bairro', $bairro);
    $updateCliente->bindValue(':rua', $rua);
    $updateCliente->bindValue(':numero', $numero);
    $updateCliente->bindValue(':complemento', $complemento);
    $updateCliente->bindValue(':tipoCliente', $tipoCliente);
    $updateCliente->bindValue(':nomeCliente', $nomeCliente);
    $updateCliente->bindValue(':servico', $servico);
    $updateCliente->bindValue(':visitasSemana', $visitasSemana);
    $updateCliente->bindValue(':visitasSemanaAlta', $visitasSemanaAlta);
    $updateCliente->bindValue(':visitasSemanaBaixa', $visitasSemanaBaixa);
    $updateCliente->bindValue(':inicioAlta', $inicioAlta);
    $updateCliente->bindValue(':fimAlta', $fimAlta);
    $updateCliente->bindValue(':produtosInclusos', $produtosInclusos);
    $updateCliente->bindValue(':inicioContrato', $inicioContrato);
    $updateCliente->bindValue(':fimContrato', $fimContrato);
    $updateCliente->bindValue(':observacoes', $observacoes);

    $updateCliente->execute();    

            $opcaoDeEnvio = "verCliente?id=$id_fk";
            $titulo = "Autenticando...";
            $tempo = 500;
            require_once "autenticando.php";
?>