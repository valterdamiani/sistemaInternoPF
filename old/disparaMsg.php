<?php 
include 'connections.php';
include 'session.php';   
include "whats-api/bot.php";
$whatsAppBot = new whatsAppBot();

$setTimeZone = $pdo->prepare("
    SET time_zone='America/Sao_Paulo'");
$setTimeZone->execute();


$dtm = date('Y-m-d H:i:s');
$dtmCadastro = date('d/m/y H:i', strtotime("$dtm -3 hours"));   

$valueComprador = 'Valter Neto';
$demanda = '    '
$justificativa =
$valueDemandador =
$entrega =
$valueLocal =
$lastId =

$text = "Olá " . $valueComprador[0]['apelido'] . "\n
            Nova demanda realizada: " . $demanda . "\n
            Justificativa: " . $justificativa . "\n
            Demandante: " . $valueDemandador[0]['apelido'] . "\n
            Entrega: " . utf8_encode ( strftime('%d/%m/%y', strtotime($entrega))) . "\n
            Local: " . $valueLocal[0]['local'] . "\n
            Acesse app.piscinafacil.com.br/verDemanda?id=" . $lastId;

// $click = 1;

// $id  = 5;
// $cidade  = 'Florianopolis';
// $bairro = 'Trindade';
// $uf = 'SC';
// $tipoCliente = 'Residência'; 
// $qtdPiscinas = '1';
// $volume = 'Menos de 50.000 litros';
// $planoMensal = 'Sim';
// $detalhes ='Dimensões: 2x6x1,5 m';

// if($bairro == ''){
//     $endereco = $cidade . " - " . $uf;    
// }else{
//     $endereco = $bairro . " - " . $cidade . " - " . $uf;
// }

// if($click = 1){
// $text = "#". $id . " - PEDIDO DE ORÇAMENTO. 
// Recebido em: " . $dtmCadastro . "\n";

// if($cidade != ''){
//     $text = $text . "
// Localização: 
// *" . $endereco . "* \n";
// };
// if($tipoCliente != ''){
//     $text = $text . "
// Tipo de local: 
// *" . $tipoCliente . "* \n";
// };
// if($qtdPiscinas != ''){
//     $text = $text . "
// Piscinas: 
// *". $qtdPiscinas ."* \n";
// };
// if($volume != ''){
//     $text = $text ."
// Volume total aprox: 
// *" . $volume . " L* \n";
// };
// if($planoMensal != ''){
//     $text = $text . "
// Plano Mensal:
// *" . $planoMensal . "* \n";
// };
// if($detalhes != ''){
//     $text = $text . "
// Mensagem: 
// " . $detalhes . " \n";
// };

// $text = $text . "
// Para comprar esse lead acesse app.piscinafacil.com.br/leads";

// {        $text = "#". $lastId . "Olá Franqueados, temos um novo lead.  
//     Cadastrado em: " . $dtmCadastro . "
//     Tipo de local: " . $tipoCliente . "
//     Piscinas: " . $qtdPiscinas . "
//     Volume total aprox: " . $volume . "
//     Detalhes: " . $detalhes . " \n
//     Para comprar esse lead acesse app.piscinafacil.com.br/leads";
// }
// }      
$telefoneEnvio = "554896970551-1574971741@g.us"; //testes
$whatsAppBot->sendMessage($telefoneEnvio, $text);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste de Mensagem</title>
</head>
<body>
    <div>
        <h1>Teste de Envio</h1>
        <label>Atualize a pagina para enviar</label>
    </div>
</body>
</html>