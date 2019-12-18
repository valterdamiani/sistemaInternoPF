<?php header("Cache-Control: no-cache, must-revalidate");

    include 'connections.php';
    include 'sessionFranqueado.php';
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    
    $id = $_GET['id'];

    $pesq = $pdo->prepare("
        SELECT `dtmInicio`, `dtmFim`, `motivoContato`, `assunto`, `contatoNome`, 
        `dddContato`, `telefoneContato`, `emailContato`, `tipoCliente`, `uf`, `cidade`, 
        `bairro`, `logradouro`, `numero`, `complemento`, `cep`, `qtdPiscinas`, `volume`, 
        `visitasSemanais`, `produtosInclusos`, `primeiroAtendimento`, `detalhes`, `statusConversao` 
        FROM `leads` WHERE id = :id");
                                        
    $pesq->bindValue(':id', $id);
    $pesq->execute();
    $values = $pesq->fetchAll();
    
    $linha = $values[0];
            
    $dtmInicio = strftime('%A, %d/%m/%y %H:%M', strtotime($linha["dtmInicio"]));
    $dtmFim = strftime('%A, %d/%m/%y %H:%M', strtotime($linha["dtmFim"]));
    $motivoContato = $linha["motivoContato"];
    $primeiroAtendimento = $linha["primeiroAtendimento"];

    $contatoNome = $linha["contatoNome"];
    $emailContato = $linha["emailContato"];
    $dddContato = $linha["dddContato"];
    $telefoneContato = $linha["telefoneContato"];
    $uf= $linha["uf"];
    $cidade= $linha["cidade"];
    $bairro = $linha["bairro"];
    $logradouro = $linha["logradouro"];
    $numero = $linha["numero"];
    $cep = $linha["cep"];
    $complemento = $linha["complemento"];
    $assunto = $linha["assunto"];
    $tipoCliente = $linha["tipoCliente"];
    $qtdPiscinas = $linha["qtdPiscinas"];
    $volume = $linha["volume"];
    $visitasSemanais = $linha["visitasSemanais"];
    $produtosInclusos = $linha["produtosInclusos"];
    $detalhes = $linha["detalhes"];
    $anexos = $linha["anexos"];
    $statusConversao = $linha["statusConversao"];


    $pesqArquivos = $pdo->prepare("
        SELECT id_fk, qtd, extensao, nome
        FROM arquivos
        WHERE tipo= 'lead'
        AND id_fk = :id");
                                        
    $pesqArquivos->bindValue(':id', $id);
    $pesqArquivos->execute();
    $valuesArquivos = $pesqArquivos->fetchAll();
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lead</title>
        <?php require_once "head.php"; ?>
    </head>

    <body >
        <?php require_once "navbar.php"; ?>
        <div>
            <?php require_once "subFormCliente.php"; ?>
        </div>
        <br>
        <?php require_once "footer.php"; ?>
    </body>
</html>