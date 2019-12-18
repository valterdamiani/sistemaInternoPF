<?php

    include 'connections.php';
    include 'session.php';   
    include "whats-api/bot.php";
    $whatsAppBot = new whatsAppBot();
    
    $motivoContato= $_POST['motivoContato'];
    $assunto= $_POST['assunto'];
    $contatoNome= $_POST['contatoNome'];
    $dddContato= $_POST['dddContato'];
    $telefoneContato= $_POST['telefoneContato'];
    $emailContato= $_POST['emailContato'];
    $tipoCliente= $_POST['tipoCliente'];
    $cidade= $_POST['cidade'];
    $uf= $_POST['uf'];
    $bairro=$_POST['bairro'];
    $logradouro= $_POST['logradouro'];
    $numero= $_POST['numero'];
    $complemento= $_POST['complemento'];
    $cep= $_POST['cep'];
    $qtdPiscinas= $_POST['qtdPiscinas'];
    $volume= $_POST['volume'];
    $planoMensal = $_POST['planoMensal'];
    $visitasSemanais= $_POST['visitasSemanais'];
    $primeiroAtendimento= $_POST['primeiroAtendimento'];
    $produtosInclusos= $_POST['produtosInclusos'];
    $detalhes= $_POST['detalhes'];
    $precoLead= $_POST['precoLead'];
    $origem = $_POST['origem'];
    $dataRecebimento = $_POST['dataRecebimento'];
    $horaRecebimento = $_POST['horaRecebimento'];

    // $franqueados = $pdo->prepare("
    // SELECT id, nome_completo, email, ddd, telefone
    // FROM colaboradores
    // WHERE cargo= 'Franqueado'
    // ");
        
    // $franqueados->execute();
    // $infoFranqueado = $franqueados->fetchAll();

    // foreach($infoFranqueado as $linha) {
    //     $id= $linha["id"];
    //     $franqueado = $linha["nome_completo"];
    //     $email = $linha["email"];
    //     $ddd = $linha["ddd"];
    //     $telefone = $linha["telefone"];
    // }
    
    $sqlLicitacao = $pdo->prepare("
        INSERT INTO `leads`(`dtmInicio`, `dtmFim`, `dataRecebimento`, `horaRecebimento`, `motivoContato`, `assunto`, `contatoNome`, `dddContato`, `telefoneContato`, `emailContato`, `tipoCliente`, `cidade`, `uf`, `bairro`, `logradouro`, `numero`, `complemento`, `cep`, `qtdPiscinas`, `volume`, `planoMensal`, `visitasSemanais`, `produtosInclusos`, `primeiroAtendimento`, `detalhes`, `origem`, `precoLead`)
        VALUES (DATE_ADD(NOW(), INTERVAL -3 HOUR), DATE_ADD(NOW(), INTERVAL 3 HOUR), :dataRecebimento, :horaRecebimento, :motivoContato, :assunto, :contatoNome, :dddContato, :telefoneContato, :emailContato, :tipoCliente, :cidade, :uf, :bairro, :logradouro, :numero, :complemento, :cep, :qtdPiscinas, :volume, :planoMensal, :visitasSemanais, :produtosInclusos, :primeiroAtendimento, :detalhes, :origem, :precoLead)");
        
    $sqlLicitacao->bindValue(':dataRecebimento', $dataRecebimento);
    $sqlLicitacao->bindValue(':horaRecebimento', $horaRecebimento);
    $sqlLicitacao->bindValue(':motivoContato', $motivoContato);
    $sqlLicitacao->bindValue(':assunto', $assunto);
    $sqlLicitacao->bindValue(':contatoNome', $contatoNome);
    $sqlLicitacao->bindValue(':dddContato', $dddContato);
    $sqlLicitacao->bindValue(':telefoneContato', $telefoneContato);
    $sqlLicitacao->bindValue(':emailContato', $emailContato);
    $sqlLicitacao->bindValue(':tipoCliente', $tipoCliente);
    $sqlLicitacao->bindValue(':cidade', $cidade);
    $sqlLicitacao->bindValue(':uf', $uf);
    $sqlLicitacao->bindValue(':bairro', $bairro);
    $sqlLicitacao->bindValue(':logradouro', $logradouro);
    $sqlLicitacao->bindValue(':numero', $numero);
    $sqlLicitacao->bindValue(':complemento', $complemento);
    $sqlLicitacao->bindValue(':cep', $cep);
    $sqlLicitacao->bindValue(':qtdPiscinas', $qtdPiscinas);
    $sqlLicitacao->bindValue(':volume', $volume);
    $sqlLicitacao->bindValue(':planoMensal', $planoMensal);
    $sqlLicitacao->bindValue(':visitasSemanais', $visitasSemanais);
    $sqlLicitacao->bindValue(':produtosInclusos', $produtosInclusos);
    $sqlLicitacao->bindValue(':primeiroAtendimento', $primeiroAtendimento);
    $sqlLicitacao->bindValue(':detalhes', $detalhes);
    $sqlLicitacao->bindValue(':origem', $origem);
    $sqlLicitacao->bindValue(':precoLead', $precoLead);
    $sqlLicitacao->execute();
    $lastId = $pdo->lastInsertId();
    
    // $dtmCadastro = date('d/m/y H:i');
    $dtm = date('Y-m-d H:i:s');
    $dtmCadastro = date('d/m/y H:i', strtotime("$dtm -3 hours"));    

    if($bairro == ''){
        $endereco = $cidade . " - " . $uf;    
    }else{
        $endereco = $bairro . " - " . $cidade . " - " . $uf;
    }

    if($horaRecebimento == ''){
        $dataHoraRecebimento = date('d/m/Y', strtotime($dataRecebimento));  
    }else{
        $dataHoraRecebimento = date('d/m/Y', strtotime($dataRecebimento)) . " às " . $horaRecebimento;
    };

    
$text = "#". $lastId . " - PEDIDO DE ORÇAMENTO. 
Recebido em: " . $dataHoraRecebimento . "\n";

if($cidade != ''){
    $text = $text . "
Localização: 
*" . $endereco . "* \n";
};
if($tipoCliente != ''){
    $text = $text . "
Tipo de local: 
*" . $tipoCliente . "* \n";
};
if($qtdPiscinas != ''){
    $text = $text . "
Piscinas: 
*". $qtdPiscinas ."* \n";
};
if($volume != ''){
    $text = $text ."
Volume total aprox: 
*" . $volume . "*\n";
};
if($planoMensal != ''){
    $text = $text . "
Plano Mensal:
*" . $planoMensal . "* \n";
};
if($detalhes != ''){
    $text = $text . "
Mensagem: 
" . $detalhes . " \n";
};

if($precoLead != ''){
    $text = $text . "
Preço do lead: 
*R$ " . $precoLead . ",00* \n";
};

$text = $text . "
Para comprar esse lead acesse app.piscinafacil.com.br/leads";
    $telefoneEnvio = "554896970551-1574971741@g.us"; //Grupo de Teste
    //$telefoneEnvio = "554888179575-1541014756@g.us"; //Grupo de Orçamento
    $whatsAppBot->sendMessage($telefoneEnvio, $text);

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
                $newFilePath = "./arquivos/leads/". $lastId . "numero" . $n .".".$ex[$chave];
    
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    
                    $insertArquivo = $pdo->prepare("
                        INSERT INTO arquivos (tipo, id_fk, qtd, extensao, nome)
                        VALUES ('lead',:id_fk,:qtd,:extensao, :nome)");
                        
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
    
    $opcaoDeEnvio = "leads";
    $titulo = "Autenticando...";
    $tempo = 500;
    require_once "autenticando.php";
?>