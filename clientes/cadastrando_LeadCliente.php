<?php 
    include 'connections.php';
    include 'cadastrando_debito.php';   

    $setTimeZone = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $setTimeZone->execute();


    $usuario= $_SESSION['colaborador'];
    $idLead= $_POST['idLead'];
    $proposta= $_POST['proposta'];
    
    $check = $pdo->prepare("
    SELECT `id`, `dtmInicio`, `dtmFim`, `motivoContato`, `assunto`, `contatoNome`, 
    `dddContato`, `telefoneContato`, `emailContato`, `tipoCliente`, `cidade`, `uf`, 
    `bairro`, `logradouro`, `numero`, `complemento`, `cep`, `qtdPiscinas`, `volume`, 
    `visitasSemanais`, `produtosInclusos`, `primeiroAtendimento`, `detalhes`, `precoLead`, 
    `statusDisputa`, `ganhador`, `statusConversao`, `dtmConversao` 
    FROM `leads` 
    WHERE id = :idLead
    ORDER BY id ASC
    ");
    $check->bindValue(':idLead', $idLead);
    $check->execute();    
    $values = $check->fetchAll();
    $data = $values[0];

    $statusDisputa= $data['statusDisputa'];
    $ganhador= $data['ganhador'];
    $id_fk= $data['id'];
    $nomeResponsavel= $data['contatoNome'];
    $email= $data['emailContato'];
    $ddd= $data['dddContato'];
    $telefone= $data['telefoneContato'];
    $cep= $data['cep'];
    $uf= $data['uf'];
    $cidade= $data['cidade'];
    $bairro= $data['bairro'];
    $rua= $data['logradouro'];
    $numero= $data['numero'];
    $complemento= $data['complemento'];
    $tipoCliente= $data['tipoCliente'];
    $servico= $data['assunto'];
    $qtdPiscinas= $data['qtdPiscinas'];
    $visitasSemana= $data['visitasSemanais'];
    $produtosInclusos= $data['produtosInclusos'];
    $inicioContrato= $data['dtmConversao'];
    $observacoes= $data['detalhes'];

    if($usuario = $ganhador){
        if($proposta == 'aceita'){
            $status = $pdo->prepare("
                UPDATE leads
                SET statusConversao= 'cliente', 
                dtmConversao= NOW()
                WHERE id = :idLead
            ");
            $status->bindValue(':idLead', $idLead);
            $status->execute();    
            
            $cliente = $pdo->prepare("
                INSERT INTO `clientes`(`id_fk`, `nomeResponsavel`, `email`, `ddd`, `telefone`, `cep`, `uf`, `cidade`, `bairro`, `rua`, `numero`, `complemento`, `tipoCliente`, `servico`, `qtdPiscinas`, `visitasSemana`, `produtosInclusos`, `inicioContrato`, `observacoes`) 
                VALUES (:id_fk, :nomeResponsavel, :email, :ddd, :telefone, :cep,       :uf, :cidade, :bairro, :rua, :numero, :complemento, :tipoCliente,  :servico, :qtdPiscinas, :visitasSemana, :produtosInclusos, :inicioContrato, :observacoes)");
            
            $cliente->bindValue(':id_fk', $id_fk);
            $cliente->bindValue(':nomeResponsavel', $nomeResponsavel);
            $cliente->bindValue(':email', $email);
            $cliente->bindValue(':ddd', $ddd);
            $cliente->bindValue(':telefone', $telefone);
            $cliente->bindValue(':cep', $cep);
            $cliente->bindValue(':uf', $uf);
            $cliente->bindValue(':cidade', $cidade);
            $cliente->bindValue(':bairro', $bairro);
            $cliente->bindValue(':rua', $rua);
            $cliente->bindValue(':numero', $numero);
            $cliente->bindValue(':complemento', $complemento);
            $cliente->bindValue(':tipoCliente', $tipoCliente);
            $cliente->bindValue(':servico', $servico);
            $cliente->bindValue(':qtdPiscinas', $qtdPiscinas);
            $cliente->bindValue(':visitasSemana', $visitasSemana);
            $cliente->bindValue(':produtosInclusos', $produtosInclusos);
            $cliente->bindValue(':inicioContrato', $inicioContrato);
            $cliente->bindValue(':observacoes', $observacoes);
            $cliente->execute();    

            $opcaoDeEnvio = "meusClientes";
            $titulo = "Autenticando...";
            $tempo = 500;
            require_once "autenticando.php";
        }else{          
            $status = $pdo->prepare("
                UPDATE leads
                SET statusConversao= 'propostaRecusada', 
                dtmConversao= NOW()
                WHERE id = :idLead
            ");
            $status->bindValue(':idLead', $idLead);
            $status->execute();

            $opcaoDeEnvio = "meusLeads";
            $titulo = "Autenticando...";
            $tempo = 500;
            require_once "autenticando.php";
        }
        
    }else{
        $opcaoDeEnvio = "log";
        $titulo = "Autenticando...";
        $tempo = 200;
        require_once "autenticando.php";
    }
?>