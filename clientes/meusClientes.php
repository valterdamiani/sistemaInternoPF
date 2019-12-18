<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'sessionFranqueado.php';

    
    $tipo= $_GET['tipo'];
    $usuario= $_SESSION['colaborador'];
    
    $pesq = $pdo->prepare("
    SET time_zone='America/Sao_Paulo'");
    $pesq->execute();
    // consulta nas tabelas LEADS e SOLICITACOESLEAD
    
    $pesq = $pdo->prepare("
        SELECT `id`, `contatoNome`, `bairro`, `ganhador`, `statusConversao`
        FROM `leads` 
        WHERE statusConversao = 'cliente'
        ORDER BY id ASC");

        $pesq->bindValue(':usuario', $usuario);
        $pesq->execute();
        $data = $pesq->fetchAll();
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
        }
        
        @media screen and (max-width: 800px) {
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
        }
    </style>
</head>

<body>
    <?php require_once "navbar.php";?>
    <h1>Meus Clientes</h1>
    <?php
    foreach($data as $linha) {    
        $id= $linha["id"];
        $contatoNome = $linha["contatoNome"];
        $bairro = $linha["bairro"];
        $ganhador = $linha['ganhador'];

    if($ganhador == $usuario){
            $destino = "onclick=window.location.href='verCliente?id=$id'";
            // $destino = "onclick=window.location.href=''";
            echo"
            <div id='box" .$id ."' class='box' onclick='showBox(id)'>
                <input type='hidden' value='box" . $id . "' id='input'>
                <div class='lineBox inline desktopInline'>
                    <div class='numberBox'>" . $id . "</div>
                    <div class='subLineBox'>
                        <div class='desktopInline'>
                            <div class='nameBox'>
                                <div class='nameSubBox'>"  . $contatoNome ."</div>
                            </div>
                            <div class='locationBox'>
                                <div class='locationSubBox'><img class='locationIcon' src='./arquivos/icons/enderecoIcon.png'>" . $bairro . "</div>
                            </div>
                        </div>
                    </div>
                    <div class='priceBox'>
                        <button class='pricebtn' style='background-color: #94cf1c' " . $destino . ">Ver cliente</button>
                    </div>
                </div>
            </div>";
        }
    }
        ?>
        <?php require_once "footer.php";?>
</body>

</html>