<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'sessionFranqueado.php';
    
    
    $tipo= $_GET['tipo'];
    $usuario= $_SESSION['colaborador'];

    // consulta nas tabelas LEADS e SOLICITACOESLEAD

    $pesq = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $pesq->execute();

    $pesq = $pdo->prepare("
        SELECT `id`, `dtmInicio`, `dtmFim`, `motivoContato`, `assunto`, `uf`, `cidade`, `bairro`, `tipoCliente`, `qtdPiscinas`, `volume`, `visitasSemanais`, `produtosInclusos`, `detalhes`, `precoLead`, `statusDisputa`, `ganhador`, `statusConversao`, `leads`.`id`, `solicitado`, IF(NOW()>`dtmFim`, 'Sim', 'Não') AS distribuir
        FROM `leads`
        LEFT JOIN (SELECT solicitacoesLead.lead_fk AS solicitado, lead_fk FROM solicitacoesLead WHERE solicitante_fk = :usuario) AS solicitacoesLeadTemporaria ON `leads`.`id` = `solicitacoesLeadTemporaria`.`lead_fk` 
        WHERE ganhador = :usuario 
        ORDER BY id ASC");

        $pesq->bindValue(':usuario', $usuario);
        $pesq->execute();
        $valuesContratos = $pesq->fetchAll();

        // verificação de inadimplencia
        $pesqInadimplente = $pdo->prepare("
        SELECT `status`
        FROM `adimplenciaFranqueados`
        WHERE `franqueado_fk` = :usuario
        ORDER BY dtm DESC
        LIMIT 1
        ");

        $pesqInadimplente->bindValue(':usuario', $usuario);
        $pesqInadimplente->execute();
        $valueAdimplencia = $pesqInadimplente->fetchAll();
        $linha = $valueAdimplencia[0];
        $adimplencia = $linha['status'];

        $upDateLead = $pdo->prepare("
        SELECT leads.id, leads.dtmFim, COUNT(solicitacoesLead.id) as solicitantes 
        FROM leads
        INNER JOIN solicitacoesLead ON leads.id = solicitacoesLead.lead_fk
        WHERE leads.statusDisputa <> 'distribuido'
        GROUP BY leads.id
        ");

        $pesqInadimplente->bindValue(':usuario', $usuario);
        $pesqInadimplente->execute();
        $valueAdimplencia = $pesqInadimplente->fetchAll();
        $linha = $valueAdimplencia[0];
        $adimplencia = $linha['status'];

        $saldo = $pdo->prepare("
            SELECT `id`, `usuario_fk`, `saldoCredito`
            FROM `creditosLead`
            WHERE usuario_fk = $usuario 
            ORDER BY usuario_fk ASC
            ");
            
        $saldo->execute();
        $saldo = $saldo->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Meus Leads</title>
    <?php require_once "head.php";?>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);
        body {
            font-family: 'Open Sans', serif;
        }
        
         ::-webkit-scrollbar {
            height: 8px;
            width: 12px;
        }
        
         ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
         ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.2);
        }
        
        @media screen and (min-width: 801px) {
            /* box 1 */
            .desktopInline {
                display: flex;
            }
            .box {
                margin-bottom: 12px;
                width: 80%;
                margin-left: 10%;
                font-size: 20px;
                border-radius: 15px;
            }
            .lineBox {
                height: 60px;
                border: 1px solid #d8d8d8;
                color: #002941;
                border-radius: 15px;
            }
            .nameBox {
                height: 60px;
                line-height: 40px;
                width: 50%;
                vertical-align: middle;
                padding: 1%;
            }
            .nameSubBox {
                box-sizing: border-box;
                white-space: nowrap;
                overflow: auto;
                font-size: 80%;
            }
            .locationBox {
                height: 60px;
                line-height: 40px;
                vertical-align: middle;
                padding: 1%;
                white-space: nowrap;
            }
            .locationSubBox {
                box-sizing: border-box;
            }
            .locationIcon {
                max-width: 25px;
                max-height: 25px;
            }
            .numberBox {
                background-color: #a8dbef;
                width: 15%;
                text-align: center;
                line-height: 60px;
                vertical-align: middle;
                font-weight: bold;
                border-top-left-radius: 11px;
                border-bottom-left-radius: 11px;
            }
            .subLineBox {
                width: 65%;
            }
            .priceBox {
                padding: 8px;
                width: 20%;
                text-align: center;
            }
            .pricebtn {
                width: 90%;
                height: 100%;
                font-size: 75%;
                border-radius: 10px;
                color: white;
            }
            /* box 2 ##########################################################################################################################################*/
            .box2 {
                width: 80%;
                margin-left: 10%;
                margin-bottom: 12px;
                background-color: #f2f2f2;
                border-radius: 12px;
                font-size: 20px;
            }
            .lineBox2 {
                border: 1px solid #d8d8d8;
                color: #002941;
                border-radius: 12px;
            }
            .numberBox2 {
                background-color: #002941;
                width: 15%;
                line-height: 60px;
                vertical-align: middle;
                font-weight: bold;
                border-top-left-radius: 12px;
                color: white;
                font-size: 80%;
                text-align: center;
            }
            .subLineBox2 {
                width: 70%;
                background-color: #0088cb;
            }
            .serviceBox {
                height: 60px;
                color: white;
                font-weight: bold;
                font-size: 100%;
                line-height: 60px;
                vertical-align: middle;
                margin-left: 5%;
            }
            .timeBox {
                height: 60px;
                line-height: 60px;
                text-align: center;
                background-color: #0088cb;
                color: white;
                border-left: none;
                border-top-right-radius: 12px;
                text-align: center;
                width: 20%;
                font-size: 80%;
            }
            .addressBox {
                border-bottom: 1px solid #d8d8d8;
                line-height: 60px;
                vertical-align: middle;
            }
            .addressSubBox {
                text-align: center;
                width: 85%;
                font-size: 90%;
            }
            .addressSubBoxText {
                width: 42%;
            }
            .addressIconBox {
                width: 15%;
                text-align: left;
            }
            .addressIcon {
                max-width: 50px;
                max-height: 50px;
            }
            .lineInfoBox {
                padding: 2%;
                border-bottom: 1px solid #d8d8d8;
                width: 100%;
            }
            .infoSubBoxLeft {
                width: 70%;
                padding: 2%;
                padding-left: 4%;
                padding-right: 4%;
                border-bottom-left-radius: 12px;
            }
            .infoSubBoxRight {
                width: 30%;
                text-align: center;
            }
            .infoTitle {
                width: 100%;
                font-size: 85%;
            }
            .info {
                width: 100%;
                font-weight: bold;
                font-size: 75%;
                margin-left: 5px;
            }
            .modalBox {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);
            }
            .modalContent {
                position: relative;
                background-color: #fefefe;
                margin: auto;
                padding: 0;
                border: 1px solid #888;
                width: 35%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                -webkit-animation-name: animatetop;
                -webkit-animation-duration: 0.4s;
                animation-name: animatetop;
                animation-duration: 0.4s;
                border-radius: 10px;
            }
            .modalHeader {
                padding: 15px;
                font-weight: bold;
            }
            .modalBody {
                padding: 8px 16px;
            }
            .modalFooter {
                padding: 15px 16px;
                color: #002941;
            }
            .btnBox {
                margin-top: 15%;
                text-align: center;
                width: 100%;
            }
            .btnSubBox {
                width: 80%;
                margin-left: 10%;
                margin-top: 10px;
                padding: 1%;
            }
            .comprarBtn {
                width: 100%;
                margin-right: 10%;
                height: 60px;
                background-color: #94cf1c;
                color: white;
                font-weight: bold;
                border-radius: 10px;
                border: 1px solid #94cf1c;
            }
            .cancelBtn {
                width: 80%;
                height: 40px;
                background-color: red;
                color: white;
                border-radius: 8px;
                border: 1px solid red;
                margin-top: 5px;
            }
            .closeBtn {
                padding: 4px;
                width: 40%;
                height: 35px;
                border-radius: 8px;
                border: 1px solid red;
                color: white;
                background-color: red;
                margin-bottom: 15px;
                margin-left: 15px;
                margin-top: 10px;
            }
            .closeBtn:hover,
            .closeBtn:focus {
                cursor: pointer;
            }
            /* ############################################################ */
        }
        
        @media screen and (max-width: 800px) {
            /* box 1 */
            .inline {
                display: flex;
            }
            .box {
                margin-bottom: 12px;
                width: 100%;
            }
            .lineBox {
                height: 90px;
                border: 1px solid #d8d8d8;
                color: #002941;
                border-radius: 12px;
            }
            .numberBox {
                background-color: #a8dbef;
                width: 15%;
                text-align: center;
                line-height: 80px;
                vertical-align: middle;
                font-weight: bold;
                border-top-left-radius: 11px;
                border-bottom-left-radius: 11px;
                font-size: 80%;
            }
            .subLineBox {
                width: 60%;
                height: 90px;
                font-size: 70%;
            }
            .nameBox {
                height: 50px;
                line-height: 45px;
                vertical-align: middle;
                padding: 3%;
            }
            .nameSubBox {
                border-bottom: 1px solid gray;
                box-sizing: border-box;
                white-space: nowrap;
                overflow: auto;
            }
            .locationBox {
                height: 40px;
                line-height: 25px;
                vertical-align: middle;
                padding: 3%;
                white-space: nowrap;
            }
            .locationSubBox {
                box-sizing: border-box;
            }
            .locationIcon {
                max-width: 25px;
                max-height: 25px;
            }
            .priceBox {
                padding: 2%;
                width: 30%;
            }
            .pricebtn {
                width: 100%;
                height: 100%;
                border-radius: 10px;
                color: white;
                font-size: 70%;
            }
            /* box 2 */
            .box2 {
                width: 100%;
                margin-bottom: 12px;
                background-color: #f2f2f2;
                border-radius: 12px;
            }
            .lineBox2 {
                border: 1px solid #d8d8d8;
                color: #002941;
                margin-bottom: 12px;
                border-radius: 12px;
            }
            .numberBox2 {
                background-color: #002941;
                width: 15%;
                text-align: center;
                line-height: 80px;
                vertical-align: middle;
                font-weight: bold;
                border-top-left-radius: 12px;
                color: white;
                font-size: 80%;
            }
            .subLineBox2 {
                width: 70%;
            }
            .timeBox {
                height: 88px;
                padding-top: 6%;
                background-color: #0088cb;
                color: white;
                border-left: none;
                border-top-right-radius: 12px;
                text-align: center;
                width: 20%;
                font-size: 80%;
            }
            .serviceBox {
                height: 88px;
                width: 101%;
                line-height: 75px;
                vertical-align: middle;
                padding: 3%;
                background-color: #0088cb;
                color: white;
                font-weight: bold;
                border-right: none;
                font-size: 70%;
            }
            .infoBox {
                width: 90%;
                margin-left: 5%;
                border-bottom-right-radius: 12px;
                border-bottom-left-radius: 12px;
            }
            .addressBox {
                padding: 2%;
                padding-left: -2%;
                border-bottom: 1px solid #d8d8d8;
            }
            .addressIconBox {
                width: 25%;
                text-align: left;
            }
            .addressIcon {
                max-width: 50px;
                max-height: 50px;
            }
            .addressSubBox {
                text-align: left;
                width: 74%;
                font-size: 90%;
            }
            .lineInfoBox {
                padding: 2%;
                border-bottom: 1px solid #d8d8d8;
            }
            .infoTitle {
                width: 45%;
                font-size: 85%;
            }
            .info {
                width: 59%;
                font-weight: bold;
                font-size: 75%;
                margin-left: 5px;
            }
            .btnBox {
                margin-top: 2px;
                padding: 3%;
                text-align: center;
                width: 100%;
            }
            .btnSubBox {
                width: 50%;
                padding: 1%;
            }
            .comprarBtn {
                width: 100%;
                margin-right: 10%;
                height: 45px;
                background-color: #94cf1c;
                color: white;
                font-weight: bold;
                border-radius: 10px;
                border: 1px solid #94cf1c;
                font-size: 90%;
            }
            .cancelBtn {
                width: 80%;
                height: 35px;
                background-color: red;
                color: white;
                border-radius: 8px;
                border: 1px solid red;
                margin-top: 5px;
            }
            .modalBox {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);
            }
            .modalContent {
                position: relative;
                background-color: #fefefe;
                margin: auto;
                padding: 0;
                border: 1px solid #888;
                width: 80%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                -webkit-animation-name: animatetop;
                -webkit-animation-duration: 0.4s;
                animation-name: animatetop;
                animation-duration: 0.4s;
                border-radius: 10px;
            }
            .modalHeader {
                padding: 15px;
                font-weight: bold;
            }
            .modalBody {
                padding: 8px 16px;
            }
            .modalFooter {
                padding: 15px 16px;
                color: #002941;
            }
            .closeBtn {
                padding: 4px;
                width: 60%;
                height: 35px;
                border-radius: 8px;
                border: 1px solid red;
                color: white;
                background-color: red;
                margin-bottom: 15px;
                margin-left: 15px;
                margin-top: 10px;
            }
            .closeBtn:hover,
            .closeBtn:focus {
                cursor: pointer;
            }
        }
    </style>
</head>

<body>
    <?php require_once "navbar.php";?>
    <h1>Meus leads</h1>
    <?php
    foreach($valuesContratos as $linha) {
        
        $id= $linha["id"];
        $distribuir= $linha["distribuir"];

        $dtmInicio= strftime('%d/%m %H:%M', strtotime($linha["dtmInicio"]));
        $assunto = $linha["assunto"];
        $uf = $linha["uf"];
        $cidade = $linha["cidade"];
        $bairro = $linha["bairro"];
        $tipoCliente = $linha["tipoCliente"];
        $qtdPiscinas = $linha["qtdPiscinas"];
        $precoLead = $linha["precoLead"];
        $visitasSemanais = $linha["visitasSemanais"];
        $produtosInclusos = $linha["produtosInclusos"];
        $leadId= $linha['solicitado'];
        $statusDisputa = $linha['statusDisputa'];
        $statusConversao = $linha['statusConversao'];
        $ganhador = $linha['ganhador'];
    
    foreach($saldo as $teste){
        $usuario_fk= $teste['usuario_fk'];
        $saldoCredito= $teste['saldoCredito'];
    }
    if($statusConversao == NULL){
        $destino = "onclick=window.location.href='verLead?id=$id'";
    echo"
        <div id='box" .$id ."' class='box' onclick='showBox(id)'>
        <input type='hidden' value='box" . $id . "' id='input'>
            <div class='lineBox inline desktopInline'>
                <div class='numberBox'>" .  $id . "</div>
                <div class='subLineBox'>
                    <div class='desktopInline'>
                        <div class='nameBox'>
                            <div class='nameSubBox'>"  . $assunto ."</div>
                        </div>
                        <div class='locationBox'>
                            <div class='locationSubBox'><img class='locationIcon' src='./arquivos/icons/enderecoIcon.png'>" . $cidade . "</div>
                        </div>
                    </div>
                </div>
                <div class='priceBox'>
                    <button class='pricebtn' style='background-color: #94cf1c' " . $destino . "> Ver Lead</button>
                </div>
            </div>
        </div>
        <div id='subbox" .$id ."' class='box2' style='display: none;'>
            <div id='subbox" .$id ."' class='lineBox2 inline desktopInline'  onclick='hiddenBox(id)'>
                <div class='numberBox2'>" .  $id . "</div>
                <div class='subLineBox2'>
                    <div class='serviceBox'>
                        <div>
                            "  . $assunto ."
                        </div>
                    </div>
                </div>
                <div class='timeBox'>
                    <div>" . $dtmInicio . "</div>
                </div>
            </div>
            <div class='infoBox desktopInline'>
                <div class='infoSubBoxLeft'>
                    <div class='addressBox inline desktopInline'>
                            <div class='addressIconBox'>
                                <img class='addressIcon' src='./arquivos/icons/enderecoIcon.png'>
                            </div>
                            <div class='addressSubBox desktopInline'>
                                <div class='addressSubBoxText'>
                                    " . $cidade . ' - ' . $uf . "
                                </div>
                                <div class='addressSubBoxText'>
                                    " . $bairro . "
                                </div>
                            </div>
                        </div>
                        <div class='lineInfoBox inline desktopInline'>
                            <div class='infoTitle'>
                                Tipo de cliente
                            </div>
                            <div class='info'>
                            " . $tipoCliente . "
                        </div>
                    </div>
                    <div class='desktopInline'>
                        <div class='lineInfoBox inline desktopInline'>
                            <div class='infoTitle'>
                                Piscinas
                            </div>
                            <div class='info'>
                                " . $qtdPiscinas . "
                            </div>
                        </div>
                        <div class='lineInfoBox inline desktopInline'>
                            <div class='infoTitle'>
                                Visitas
                            </div>
                            <div class='info'>
                                " . $visitasSemanais . "
                            </div>
                        </div>
                    </div>
                    <div class='desktopInline'>
                        <div class='lineInfoBox inline desktopInline' style='border-bottom: none'>
                            <div class='infoTitle'>
                                Produtos
                            </div>
                            <div class='info'>
                                " . $produtosInclusos . "
                            </div>
                        </div>
                        <div class='lineInfoBox inline desktopInline' style='border-bottom: none'>
                            <div class='infoTitle'>
                                Preço
                            </div>
                            <div class='info'>
                                R$  " . $precoLead . "
                            </div>
                        </div>
                    </div>
                </div>
                <div class='infoSubBoxRight'>
                    <div class='inline' style='width: 100%;'>
                        <div class='btnBox inline' >
                            <div class='btnSubBox' " .$showHidden . ">
                                <button id='" . $id . "' class='comprarBtn' " . $destino . ">Ver Lead</button>
                            </div>
                            <div class='btnSubBox'>
                                <button id='subbox" .$id ."' class='cancelBtn' onclick='hiddenBox(id)'>Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ";

    }
    }
        ?>
        <?php require_once "footer.php";?>
</body>
<script>
    function modal(id) {
        var btn = document.getElementById(id);
        btnId = btn.id;
        var modal = document.getElementById('modalBox' + btnId);
        modal.style.display = 'block';
    }

    function hiddenModal(id) {
        var closeModal = document.getElementById(id);
        var id = closeModal.id.replace('closeBtn', 'modalBox')
        var modal = document.getElementById(id)
        modal.style.display = 'none';
    }

    function showBox(id) {
        var box = document.getElementById(id)
        var boxId = box.id;
        var subBox = document.getElementById('sub' + id)
        box.style.display = 'none';
        subBox.style.display = 'block'
    }

    function hiddenBox(id) {
        var subBox = document.getElementById(id);
        var subBox = subBox.id;
        var box = subBox.replace('subbox', 'box')
        box = document.getElementById(box)
        box.style.display = 'block'
        subBox = document.getElementById(subBox)
        subBox.style.display = 'none'
    }
</script>

</html>