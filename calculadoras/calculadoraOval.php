<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'session.php';
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Volume de Piscina Oval [Piscina Fácil]</title>
    <?php require_once "head.php"; ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style type="text/css">
        /* CORES 
        verde: #94cf1d
        azul: #1484c6
        a-escuro: #002843
        cinza: #d9d9d9
        */

        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        :focus {
            outline: 0;
            border: 2px solid #94CF1D;
        }

        .todas {
            font-family: 'Open Sans', sans-serif;
        }

        .style-button {
            background-color: #002843;
            border: none;
            color: white;
            padding: 6px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            font-family: 'Open Sans', sans-serif;
        }

        div#esquerda {
            float: left;
            width: 25%;
            background: #eee;
            padding: 25px;
        }

        div#centro {
            float: left;
            width: 25%;
            padding: 25px;
            margin-left: 25px;
            background: #eee;
        }

        div#direita {
            float: left;
            width: 25%;
            padding: 25px;
            margin-left: 25px;
            background: #eee;
        }

        p.menor {
            font-size: 18pt;
            font-weight: 700;
            line-height: 1;
            margin: 0px;
            padding: 0px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
        }

        input.calc-vol {
            background: #FFF !important;
            height: 31px;
            font-family: 'Open Sans', sans-serif;
            padding-left: 6px;
            box-sizing: border-box;
            width: 100%
        }

        #larguraPiscCircular {
            height: 33px;
        }

        #profundidadePiscCircular {
            height: 33px;
        }

        @media only screen and (max-width: 1464px) {
            .div_labels {
                font-size: 10pt;
            }
        }

        @media only screen and (max-width: 1254px) {
            div#todas {
                width: 100%;
            }
            div#esquerda {
                float: left;
                width: 100%;
                background: #eee;
                padding: 0px;
                margin-left: 0px;
            }
            div#centro {
                float: left;
                width: 100%;
                padding: 0px;
                background: #eee;
                margin-left: 0px;
            }
            div#direita {
                float: left;
                width: 100%;
                padding: 0px;
                background: #eee;
                margin-left: 0px;
            }
            p.menor {
                font-size: 16pt;
                font-weight: 600;
                line-height: 1;
                margin: 0px;
                padding: 0px;
            }
        }

        .-labels-calc {
            cursor: pointer;
            height: 26.2px;
        }

        .titulo_calc1 {
            position: relative;
            width: 100%;
            height: 40px;
            padding: 0px;
            margin: 0px;
            border: 1px solid #d9d9d9;
            background: #fff;
        }

        .h3_calc_de_volume {
            color: #002843;
            text-transform: uppercase;
            padding: 0px;
            text-align: center;
            font-size: 14pt;
            font-weight: 500;
            line-height: 1;
            /*centralizar verticalmente */
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
        }

        .borderTR {
            border-top-right-radius: 12px;
        }

        .borderTL {
            border-top-left-radius: 12px;
        }

        .borderBR {
            border-bottom-right-radius: 12px;
        }

        .borderBL {
            border-bottom-left-radius: 12px;
        }

        .titulo_calc2 {
            background: #94cf1d;
            width: 100%;
            height: 40px;
            padding: 0px;
            margin: 0px;
            position: relative;
            height: 40px;
            border-left: 1px solid #d9d9d9;
            border-right: 1px solid #d9d9d9;
            position: relative;
        }

        .div_labels {
            float: left;
            background: #1484c6;
            color: #FFF;
            text-align: right;
            padding: 6px 11px 8px 11px;
            display: grid;
            box-sizing: border-box;
            width: 50%;
        }

        .div_inputs {
            /* box-sizing: border-box; */
            display: grid;
            margin: 0px;
        }

        .label-oval {
            font-size: 10pt;
        }

        .label2 {
            position: relative;
            top: 4px;
        }

        .label3 {
            position: relative;
            top: 8px;
        }

        .text-buttom {
            position: relative;
            top: -7px;
        }

        .icon-calcular {
            position: relative;
            top: 3px;
        }

        .resposta_vol {
            background: #94cf1d;
            color: #002843;
            font-size: 14pt;
            font-weight: 600;
            text-align: center;
            height: 40px;
            margin: 0 auto;
            padding-top: 8px;
            box-sizing: border-box;
        }

        .labels_inputs {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php require_once "navbar.php"; ?>
    <div id="direita" class="direita">
        <div class="titulo_calc1 borderTR borderTL">
            <h3 class="h3_calc_de_volume">CALCULADORA DE VOLUME</h3>
        </div>
        <div class="titulo_calc2">
            <p class="menor">PISCINA OVAL</p>
        </div>

        <div class="labels_inputs">
            <div class="div_labels">
                <label id="diâmetroMaior<-label" class="-labels-calc label-oval" for="larguraPiscOval">Di&acirc;metro Maior (m):</label>
                <label id="diâmetroMenor-label" class="-labels-calc label-oval label2" for="comprimentoPiscOval">Di&acirc;metro Menor (m):</label>
                <label id="profundidade-label-oval" class="-labels-calc label-oval label3" for="profundidadePiscOval">Profundidade (m):</label>
            </div>

            <div class="div_inputs">
                <input class="calc-vol" type="number" step="0.1" id="larguraPiscOval" />

                <input class="calc-vol" type="number" step="0.1" id="comprimentoPiscOval" />

                <input class="calc-vol" type="number" step="0.1" id="profundidadePiscOval" />
            </div>
        </div>

        <button onclick="calcularVolOval()" class="style-button">
          <img width="30px" height="30px" class="icon-calcular" src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/calcular.png" alt="icon-calcular"> 
          <span class="text-buttom">Calcular Volume</span>
        </button>

        <br/>
        <p type="text" id="VolumePisOval" class="resposta_vol"> <br/> </p>
        <p type="text" id="VolumeLPisOval" class="resposta_vol borderBL borderBR"></p>
    </div>
    <script>

        function calcularVolOval() {
            var diametroMaior = document.getElementById("larguraPiscOval").value;
            var diametroMenor = document.getElementById("comprimentoPiscOval").value;
            var profundidadeOval = document.getElementById("profundidadePiscOval").value;
            var volumeOval = 0;


            volumeOval = diametroMaior * diametroMenor * profundidadeOval * 0.8;
            volumeLOval = volumeOval * 1000;
            document.getElementById("VolumePisOval").innerHTML = volumeOval.toFixed(2).replace(".", ",") + " m³";
            document.getElementById("VolumeLPisOval").innerHTML = volumeLOval + " L";
    }
    </script>
</body>

</html>