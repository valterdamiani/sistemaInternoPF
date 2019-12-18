<?php

    include 'connections.php';
    include 'session.php';   
    include "whats-api/bot.php";
    
    $whatsAppBot = new whatsAppBot();
    
    $arquivo1= $_POST['arquivo1'];
    $demanda= $_POST['demanda'];
    $justificativa= $_POST['justificativa'];
    $entrega = $_POST["entrega"];
    $local = $_POST["local"];
    $colaborador = $_SESSION["colaborador"];
    
    $setTimeZone = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $setTimeZone->execute();
    
    $sqlDemanda = $pdo->prepare("
        INSERT INTO demandas (demanda, justificativa, entrega, local_fk, demandante_fk, dtm)
        VALUES (:demanda,:justificativa,:entrega,:local, :colaborador, NOW())");
        
    $sqlDemanda->bindValue(':demanda', $demanda);
    $sqlDemanda->bindValue(':justificativa', $justificativa);
    $sqlDemanda->bindValue(':entrega', $entrega);
    $sqlDemanda->bindValue(':local', $local);
    $sqlDemanda->bindValue(':colaborador', $colaborador);
    $sqlDemanda->execute();
    $lastId = $pdo->lastInsertId();
    
    $n=1;
    for ($c=1; $c<=3;$c++){
        $arquivo = "arquivo" . $c;
        $arquivo= $_POST[$arquivo];
        $nomeUpload = "upload" . $c;
        
        //$files = array_filter($_FILES['upload']['name']); //something like that to be used before processing files.
    
        // Count # of uploaded files in array
        $total = count($_FILES[$nomeUpload]['name']);
    
        // Loop through each file
        for( $i=0 ; $i <= $total ; $i++ ) {
            

            //Get the temp file path
            $tmpFilePath = $_FILES[$nomeUpload]['tmp_name'][$i];
    
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                $ex = explode('.', $_FILES[$nomeUpload]['name'][$i]);
                
                foreach ($ex as $key => $value) {
                    $chave = $key;
                }
          
                //Setup our new file path
                $newFilePath = "./arquivos/demandas/". $lastId . "numero" . $n .".".$ex[$chave];
    
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    
                    $insertArquivo = $pdo->prepare("
                        INSERT INTO arquivos (tipo, id_fk, qtd, extensao, nome)
                        VALUES ('demanda',:id_fk,:qtd,:extensao, :nome)");
                        
                    $insertArquivo->bindValue(':id_fk', $lastId);
                    $insertArquivo->bindValue(':qtd', $n);
                    $insertArquivo->bindValue(':nome', $arquivo);
                    $insertArquivo->bindValue(':extensao', $ex[$chave]);
                    $insertArquivo->execute();
                    
                    $n++;
                }
            }
        }
    }
    
    $pesqColaborador = $pdo->prepare("SELECT id, apelido, ddd, telefone FROM colaboradores WHERE email = 'financeiro@piscinafacil.com.br'");
    $pesqColaborador->execute();
    $valueComprador = $pesqColaborador->fetchAll();
    
    $comprador = $valueComprador[0]['id'];
    
    $pesqColaborador = $pdo->prepare("SELECT id, apelido FROM colaboradores WHERE id = :colaborador");
    $pesqColaborador->bindValue(':colaborador', $colaborador);
    $pesqColaborador->execute();
    $valueDemandador = $pesqColaborador->fetchAll();

    $pesqLocal = $pdo->prepare("SELECT local FROM locais WHERE id = :local");
    $pesqLocal->bindValue(':local', $local);
    $pesqLocal->execute();
    $valueLocal = $pesqLocal->fetchAll();

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: Piscina Fácil <financeiro@piscinafacil.com.br>';
    
    
    $msg="  <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
                <head>
                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                </head>
                <body>
                    <div>
                        <p>Olá " . $valueComprador[0]['apelido'] . "</p>
                        Demanda: " . $demanda . "<br>
                        Justificativa: " . $justificativa . "<br>
                        Demandante: " . $valueDemandador[0]['apelido'] . "<br>
                        Entrega: " . utf8_encode ( strftime('%d/%m/%y', strtotime($entrega))) . "<br> 
                        Local: " . $valueLocal[0]['local'] . "<br>
                        Acesse <a href ='app.piscinafacil.com.br/verDemanda?id=" . $lastId . "'>www.piscinafacil.com.br</a></p>
                    </div>
                </body>
            </html>";

    if(mail("financeiro@piscinafacil.com.br", "Demanda criada", $msg, $headers)){
    }
    
    $sqlDemanda = $pdo->prepare("
        INSERT INTO pendencias (tipo, url, id_fk, resumo, responsavel_fk, dtm, esconder, id_demanda, tabela)
        VALUES ('Especificar','verDemanda.php?id=', :id, :demanda, :colaborador, NOW(), 'nao', :lastId, 'demandas' )");
        
    $sqlDemanda->bindValue(':lastId', $lastId);
    $sqlDemanda->bindValue(':id', $lastId);
    $sqlDemanda->bindValue(':demanda', $demanda);
    $sqlDemanda->bindValue(':colaborador', $comprador);
    $sqlDemanda->execute();
    
    $text = "Olá " . $valueComprador[0]['apelido'] . "\n
            Nova demanda realizada: " . $demanda . "\n
            Justificativa: " . $justificativa . "\n
            Demandante: " . $valueDemandador[0]['apelido'] . "\n
            Entrega: " . utf8_encode ( strftime('%d/%m/%y', strtotime($entrega))) . "\n
            Local: " . $valueLocal[0]['local'] . "\n
            Acesse app.piscinafacil.com.br/verDemanda?id=" . $lastId;
            
    $telefoneEnvio = "55" . $valueComprador[0]['ddd'] . $valueComprador[0]['telefone'] . "@c.us";
    $whatsAppBot->sendMessage($telefoneEnvio, $text);

    $opcaoDeEnvio = "pendencias.php";
    $titulo = "Autenticando...";
    $tempo = 5000;
    require_once "autenticando.php";
?>