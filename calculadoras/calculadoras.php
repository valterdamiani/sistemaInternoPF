<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'sessionAluno.php';
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <?php require_once "head.php"; ?>
        <style>
            .box {
            }
            
            .subBox {
                text-align: center;
            }
            
            .icons {
                margin: 40px 50px 40px 40px;
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

            @media screen and (max-width: 1580px) {
                .icons {
                margin: 20px 20px 20px 20px;
                }
            
                .iconImg {
                max-width: 150px;
                cursor:pointer;
                }
            }

            @media screen and (max-width: 880px) {
                .icons {
                margin: 10px 10px 10px 10px;
                }
        
                .iconImg {
                max-width: 100px;
                cursor:pointer;
                }
            }

            @media screen and (max-width: 530px) {
                .icons {
                margin: 5px 5px 5px 5px;
                }
        
                .iconImg {
                max-width: 80px;
                cursor:pointer;
                }
            }
            @media screen and (max-width: 400px) {
                .icons {
                margin: 25px 5px 5px 5px;
                }
        
                .iconImg {
                max-width: 80px;
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
            <div class="subBox">
                <div class="icons inline">
                    <img class="iconImg" src="./arquivos/icons/langelier.png" onclick="window.location.href='calculadoraLangelier'">
                </div>
                <div class="icons inline">
                    <img style="cursor: not-allowed" class="iconImg" src="./arquivos/icons/calculadoraPreco.png" onclick="window.location.href='calculadoraPreco'">
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
        </div>
        <?php require_once "footer.php"; ?>
    </body>
</html>