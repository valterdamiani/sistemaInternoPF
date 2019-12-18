<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'sessionExterno.php';
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    
    $cargo = $_SESSION['cargo'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <?php require_once "head.php"; ?>
        <style>
            .subBox {
                text-align: center;
                width: 80%;
                margin-left: 10%;
            }
            
            .icons {
                margin: 20px 50px 40px 40px;
            }
            
            .iconImg {
                max-width: 200px;
                cursor:pointer;
            }
            
            .iconImg:hover{
            }
            
            .inline {
                display: inline-block;
            }

            @media screen and (max-width: 1150px) {
                .icons {
                margin: 20px 20px 20px 20px;
                }
            
                .iconImg {
                max-width: 150px;
                cursor:pointer;
                }
            }

            @media screen and (max-width: 760px) {
                .icons {
                    margin: 10px 10px 10px 10px;
                }
        
                .iconImg {
                    max-width: 120px;
                    cursor:pointer;
                }
            }

            @media screen and (max-width: 570px) {
                .icons {
                    margin: 5px 5px 5px 5px;
                }
        
                .iconImg {
                    max-width: 110px;
                    cursor:pointer;
                }
            }
            @media screen and (max-width: 400px) {
                .icons {
                    margin: 25px 5px 5px 5px;
                }
        
                .iconImg {
                    max-width: 200px;
                    cursor:pointer;
                }
                .inline{
                    display: block;
                }
            }
        </style>
    </head>
    <body>
        <?php require_once "navbar.php"; ?>
        <div class="box">
            <?php
    if(!is_null($cargo)){
        ?>
        <div class="subBox">
            <div class="icons inline">
                <img class="iconImg" src="./arquivos/icons/perfil.png" onclick="window.location.href='verCurriculo.php'">
            </div>
<?php } ?>
            <div class="icons inline">
                <img id="gameIcon" class="iconImg" src="./arquivos/icons/game.png" onclick="window.location.href='treinamento'">
            </div>
            <div class="icons inline">
                <img class="iconImg" src="./arquivos/icons/calculadoras.png" onclick="window.location.href='calculadoras'">
            </div>
        </div>
<?php

    if($_SESSION['cargo'] == 'Admin' || $_SESSION['cargo'] == 'Franqueado'){
?>
            <div class="subBox">
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/leads.png" onclick="window.location.href='leads'">
                </div>
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/meusLeads.png" onclick="window.location.href='meusLeads'">
                </div>
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/meusClientes.png" onclick="window.location.href='meusClientes'">
                </div>
                
            </div>
<?php }else{ ?>
            <div class="subBox">
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/langelier.png" onclick="window.location.href='calculadoraLangelier'">
                </div>
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/calculadoraPreco.png" onclick="window.location.href='calculadoraPreco'">
                </div>
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/volumePiscinaRetangular.png" onclick="window.location.href='calculadoraRetangular'">
                </div>
            </div>
            <div class="subBox">
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/volumePiscinaIrregular.png" onclick="window.location.href='calculadoraIrregular'">
                </div>
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/volumePiscinaOval.png" onclick="window.location.href='calculadoraOval'">
                </div>
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/volumePiscinaRedonda.png" onclick="window.location.href='calculadoraCircular'">
                </div>
            </div>
<?php } ?>
            <div class="subBox">
                <div class="icons inline">
                    <img style="display:none;" class="iconImg" src="./arquivos/icons/tarefas.png" onclick="window.location.href='tarefas'">
                </div>
                <div class="icons inline">
                    <img id="gameIcon" class="iconImg" src="" onclick="window.location.href=''">
                </div>
            </div>
        </div>
        <?php require_once "footer.php"; ?>
    </body>
</html>