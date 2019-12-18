<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'session.php';   

    $setTimeZone = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $setTimeZone->execute();


    $usuario= $_SESSION['colaborador'];
    $idLocal = $_GET['local'];

    $infoLocal = $pdo->prepare("
        SELECT `local`, `cidade`, `bairro`, `descricao`, `valor`, `capacidade`, `churrasqueira`, `banheiros`, `cozinha`, `apelidoPiscina`, `comprimento`, `largura`, `profundidade`, `apelido`, `colaboradores`.`id`
        FROM `locaisPiscinas`
        INNER JOIN piscinas ON `locaisPiscinas` .`id`  = `piscinas` .`local_fk`
        INNER JOIN colaboradores ON `colaboradores` .`id`  = `locaisPiscinas` .`proprietario_fk`
        WHERE `locaisPiscinas`.`id` = :idLocal
        ");
    
    $infoLocal->bindValue(':idLocal', $idLocal);
    $infoLocal->execute();
    $value = $infoLocal->fetchAll();

    $data = $value[0];
      
    $local = $data['local'];
    $cidade = $data['cidade'];
    $bairro = $data['bairro'];
    $descricao = $data['descricao'];
    $valor = $data['valor'];
    $churrasqueira = $data['churrasqueira'];
    $banheiros = $data['banheiros'];
    $cozinha = $data['cozinha'];
    
    $capacidade = $data['capacidade'];
    $apelidoPiscina = $data['apelidoPiscina'];
    $largura = $data['largura'];
    $profundidade = $data['profundidade'];
    $apelido = $data['apelido'];
    $colaboradores = $data['colaboradores'];
    $id = $data['id'];
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            
            body {
                background: rgb(224, 218, 218);
            }
            
            a,
            img {
                border: none;
                max-width: 346px;
            };
            
            .trs {
                -webkit-transition: all ease-out 0.5s;
                -moz-transition: all ease-out 0.5s;
                -o-transition: all ease-out 0.5s;
                -ms-transition: all ease-out 0.5s;
                transition: all ease-out 0.5s;
            }
            
            #slider {
                position: absolute;
                z-index: 1;
            }
            
            #slider a {
                position: absolute;
                top: 0px;
                left: 0px;
                opacity: 0;
                filter: alpha(opacity=0);
            }
            
            
            .ativo {
                opacity: 1!important;
                filter: alpha(opacity=100)!important;
            }
            /*controladores*/
            
            span {
                background: #0190EE;
                cursor: pointer;
                opacity: 0;
                filter: alpha(opacity=0);
                position: absolute;
                bottom: 55%;
                width: 43px;
                height: 43px;
                z-index: 5;
            }
            
            .next {
                right: 10px;
            }
            
            .next:before,
            .next:after {
                left: 21px;
            }
            
            .next:before {
                -webkit-transform: rotate(-42deg);
                top: 5px;
            }
            
            .next:after {
                -webkit-transform: rotate(-132deg);
                top: 19px;
            }
            
            .next:before,
            .next:after,
            .prev:before,
            .prev:after {
                content: "";
                height: 20px;
                background: #fff;
                width: 1px;
                position: absolute;
            }
            
            .prev {
                left: 10px;
            }
            
            .prev:before,
            .prev:after {
                left: 18px;
            }
            
            .prev:before {
                -webkit-transform: rotate(42deg);
                top: 5px;
            }
            
            .prev:after {
                -webkit-transform: rotate(132deg);
                top: 19px;
            }
            
            figure:hover span {
                opacity: 0.76;
                filter: alpha(opacity=76);
            }
            
            figure {
                max-width: 737px;
                /* height: 554px; */
                /* position: relative; */
                overflow: hidden;
                /* margin: 50px auto; */
            }
            
            figcaption {
                /* padding-left: 20px; */
                color: #fff;
                font-family: "Kaushan Script", "Lato", "arial";
                font-size: 22px;
                background: rgba(1, 144, 238, 0.76);
                width: 100%;
                position: absolute;
                bottom: 0;
                left: 0;
                line-height: 55px;
                height: 55px;
                z-index: 5
            }
            /* test area  */
            /* Set the size of the div element that contains the map */
            
            #map {
                height: 100%;
                /* The height is 400 pixels */
                width: 100%;
                /* The width is the width of the web page */
            }
        </style>
        <script type="text/javascript">
            function setaImagem() {
                var settings = {
                    primeiraImg: function() {
                        elemento = document.querySelector("#slider a:first-child");
                        elemento.classList.add("ativo");
                        this.legenda(elemento);
                    },

                    slide: function() {
                        elemento = document.querySelector(".ativo");

                        if (elemento.nextElementSibling) {
                            elemento.nextElementSibling.classList.add("ativo");
                            settings.legenda(elemento.nextElementSibling);
                            elemento.classList.remove("ativo");
                        } else {
                            elemento.classList.remove("ativo");
                            settings.primeiraImg();
                        }
                    },

                    proximo: function() {
                        clearInterval(intervalo);
                        elemento = document.querySelector(".ativo");

                        if (elemento.nextElementSibling) {
                            elemento.nextElementSibling.classList.add("ativo");
                            settings.legenda(elemento.nextElementSibling);
                            elemento.classList.remove("ativo");
                        } else {
                            elemento.classList.remove("ativo");
                            settings.primeiraImg();
                        }
                        intervalo = setInterval(settings.slide, 4000);
                    },

                    anterior: function() {
                        clearInterval(intervalo);
                        elemento = document.querySelector(".ativo");

                        if (elemento.previousElementSibling) {
                            elemento.previousElementSibling.classList.add("ativo");
                            settings.legenda(elemento.previousElementSibling);
                            elemento.classList.remove("ativo");
                        } else {
                            elemento.classList.remove("ativo");
                            elemento = document.querySelector("a:last-child");
                            elemento.classList.add("ativo");
                            this.legenda(elemento);
                        }
                        intervalo = setInterval(settings.slide, 4000);
                    },

                    legenda: function(obj) {
                        var legenda = obj.querySelector("img").getAttribute("alt");
                        document.querySelector("figcaption").innerHTML = legenda;
                    }
                }

                //chama o slide
                settings.primeiraImg();

                //chama a legenda
                settings.legenda(elemento);

                //chama o slide à um determinado tempo
                var intervalo = setInterval(settings.slide, 4000);
                document.querySelector(".next").addEventListener("click", settings.proximo, false);
                document.querySelector(".prev").addEventListener("click", settings.anterior, false);
            }

            window.addEventListener("load", setaImagem, false);




            // teste area ##########################################################################################################################


            // Initialize and add the map
            function initMap() {
                // The location of Uluru
                var uluru = {
                    lat: -27.5842467,
                    lng: -48.5271091
                };
                // The map, centered at Uluru
                var map = new google.maps.Map(
                    document.getElementById('map'), {
                        zoom: 14,
                        center: uluru
                    });
                // The marker, positioned at Uluru
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
            }
        </script>
    </head>

    <body>
        <div class="titleBox">
            <div class="titleTxt">Titulo Anuncio</div>
        </div>
        <div class="locationBox">
            <div >
                <?php echo " $cidade, $bairro "?>
            </div>
        </div>
        <div class="sliderBox">
            <figure>
                <span class="trs next"></span>
                <span class="trs prev"></span>
                <div id="slider">
                    <a href="#" class="trs"><img src="teste1.PNG" alt="Legenda da imagem 1" /></a>
                    <a href="#" class="trs"><img src="teste2.PNG" alt="Legenda da imagem 2" /></a>
                </div>
                <!-- <figcaption></figcaption> -->
            </figure>
        </div>
        <!-- description of rent -->
        <div class="descriptionBox">
            <div>
            <?php echo " $descricao "?>
            </div>
        </div>
        <!-- information of pool -->
        <div class="infoBox ">
            <div class="inlineMobile">
                <div class="subTitleBox">
                    Dimensões da piscina
                </div>
                <div class="subTitleBox">
                    Profundidade
                </div>
            </div>
            <div class="inlineMobile">
                <div class="infoSubBox">
                    8,5 x 7,5 m
                </div>
                <div class="infoSubBox">
                    1,5 m
                </div>
            </div>
        </div>
        <!-- information of available facilities -->
        <div class="facilitiesBox">
            <div class="subTitle">
                Comodidades
            </div>
            <div class="inlineMobile">
                <div class="facilitiesIcon">
                    <i class="material-icons">gradient</i>
                </div>
                <div class="facilitiesItem">
                    Churrasqueira: <?php echo " $churrasqueira "?>
                </div>
            </div>
            <div class="inlineMobile">
                <div class="facilitiesIcon">
                    <i class="material-icons">wc</i>
                </div>
                <div class="facilitiesItem">
                    Banheiros: <?php echo " $banheiros "?>
                </div>
            </div>
            <div class="inlineMobile">
                <div class="facilitiesIcon">
                    <i class="material-icons">local_dining</i>
                </div>
                <div class="facilitiesItem">
                    Cozinha: <?php echo " $cozinha "?>
                </div>
            </div>
            <div class="inlineMobile">
                <div class="facilitiesIcon">
                    <i class="material-icons">kitchen</i>
                </div>
                <div class="facilitiesItem">
                    Geladeira
                </div>
            </div>
            <div class="inlineMobile">
                <div class="facilitiesIcon">
                    <i class="material-icons">wifi</i>
                </div>
                <div class="facilitiesItem">
                    Internet
                </div>
            </div>
        </div>
        <!-- rules of pool -->
        <div class="rulesBox">
            <div class="subTitle">
                Regras
            </div>
            <div class="inlineMobile">
                <div class="facilitiesIcon">
                    <i class="material-icons">supervisor_account</i>
                </div>
                <div class="facilitiesItem">
                    Capacidade maxima 10
                </div>
            </div>
            <div class="inlineMobile">
                <div class="facilitiesIcon">
                    <i class="material-icons">pets</i>
                </div>
                <div class="facilitiesItem">
                    Aceita pets
                </div>
            </div>
            <div class="inlineMobile">
                <div class="facilitiesIcon">
                    <i class="material-icons">smoking_rooms</i>
                </div>
                <div class="facilitiesItem">
                    Espaço para fumantes
                </div>
            </div>
        </div>
        <div class="mapBox">
            <div id="map"></div>
        </div>
        <!-- price of rent -->
        <div class="priceBox inlineMobile">
            <div class="priceValue">
                <?php echo "$valor" ?>
            </div>
            <div class="priceBtnBox">
                <button class="priceBtn">Reservar</button>
            </div>
        </div>

    </body>
    <style>
        .inlineMobile {
            display: flex;
        }
        
        .titleBox {
            width: 70%;
            height: 40px;
            margin-left: 15%;
            /* background-color: orange; */
            text-align: center;
            margin-top: 10px;
        }
        
        .titleTxt {
            font-size: 30px;
            font-weight: bold;
        }
        
        .locationBox {
            /* background-color: rgb(39, 39, 138); */
            width: 96%;
            height: 30px;
            line-height: 30px;
            vertical-align: middle;
            margin-left: 2%;
            margin-top: 2%;
            margin-bottom: 2%;
        }
        
        .sliderBox {
            width: 96%;
            background-color: red;
            height: 232px;
            margin-left: 2%;
        }
        
        .descriptionBox {
            width: 92%;
            /* background-color: lime; */
            /* height: 70px; */
            margin-left: 2%;
            margin-top: 2%;
            margin-bottom: 2%;
            padding: 2%;
            text-align: justify;
        }
        
        .infoBox {
            width: 92%;
            height: 50px;
            text-align: center;
            margin-left: 2%;
            margin-top: 2%;
            margin-bottom: 2%;
            padding: 2%;
        }
        
        .subTitleBox {
            width: 50%;
            font-size: 17px;
            color: grey;
        }
        
        .infoSubBox {
            width: 50%;
            font-size: 17px;
            font-weight: bold;
        }
        
        .subTitle {
            font-size: 20px;
            font-weight: bold;
            padding: 5px;
        }
        
        .facilitiesBox {
            /* background-color: indigo; */
            /* height: 100px; */
            width: 92%;
            margin-left: 2%;
            margin-top: 2%;
            margin-bottom: 2%;
            padding: 2%;
        }
        
        .facilitiesIcon {
            height: 25px;
            line-height: 25px;
            vertical-align: middle;
            padding: 3px;
            /* background-color: red; */
            /* margin-top: 2px; */
        }
        
        .facilitiesItem {
            height: 25px;
            line-height: 25px;
            vertical-align: middle;
            padding: 3px;
            /* background-color: lawngreen; */
            /* margin-top: 2px; */
        }
        
        .rulesBox {
            /* background-color: indigo; */
            /* height: 100px; */
            width: 92%;
            margin-left: 2%;
            margin-top: 2%;
            margin-bottom: 2%;
            padding: 2%;
        }
        
        .mapBox {
            width: 96%;
            margin-left: 2%;
            height: 345px;
            background-color: mediumorchid;
            margin-bottom: 120px;
        }
        
        .priceBox {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            line-height: 100px;
            text-align: center;
            background-color: rgb(6, 204, 211);
        }
        
        .priceValue {
            /* background-color: palevioletred; */
            font-size: 25px;
            font-weight: bold;
            width: 50%;
        }
        
        .priceBtnBox {
            /* background-color: purple; */
            width: 50%;
        }
        
        .priceBtn {
            width: 80%;
            height: 50px;
            border-radius: 5px;
            font-size: 22px;
            background-color: rgb(44, 196, 39);
            border: 4px solid rgb(102, 196, 39);
        }
    </style>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNi-x4KtVlHs-JKSqC2hHSrVigqThvuGg&callback=initMap">
    </script>

</html>