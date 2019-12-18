<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'session.php';
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Calculadora de Volume de Piscina Irregular [Piscina Fácil]</title>
        <?php require_once "head.php"; ?>    
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <style type="text/css">
            .show {
                display: block;
            }
            .all-calc {
                font-family: 'Open Sans';
                width:100%;
                padding: 20px;
                margin:0px;
                padding: 0px;
            }

            .calcAlternative {
                width: 100%;
                padding-top: 0px;
            }

            .calc_Padrao {
                float:left;
                width:100%;
            }

            .calc_menor_dimensao_media, .calc_profundidade_media {
                display: none;
                background: #eff9ff;
                margin-top: -71px;
                margin-bottom: 25px;
                padding: 25px 60px;
                border-radius: 8px;
                border: 1px solid #2c88c5;
                float:left;
                /* //height: auto; */
                border:1px solid green;
            }

            .calc_profundidade_media {
                display:none;
                float:left;
            }

            .nsei {
                cursor: pointer;
                height: 40px;
                width: 99.85%;
                font-family: 'Open Sans';
                background: #94cf1d;
                color: white;
                font-size: 16px;
                transition: background 0.2s;
                margin-top: 30px;
                margin-bottom: 30px;
                transition: background 0.2s;
                border: 1px solid #94cf1d;
                outline: none;
                float:left;
                position: relative;
                z-index: 1;
            }

            .nsei:hover {
                background: #fff;
                color: #94cf1d;
            }
            .show {
                display: block;
                z-index: 0;
            }

            .button_calc {
                height: 60px;
                width: 100%;
                font-family: 'Open Sans';
                background: #002843;
                color: white;
                font-size: 20px;
                transition: background 0.2s;
                border: #529e00;
                border-radius: 12px;
                font-weight: 300;
            }

            .button_calc:hover {
                cursor: pointer;
                background: #0088cb;
            }

            .button_calc2 {
                height: 40px;
                width: 100%;
                font-family: 'Open Sans';
                background: #96bf22;
                color: white;
                font-size: 16px;
                transition: background 0.2s;
                border-radius: 12px;
                border: 1px solid #759e00;
                margin-top: 25px;
            }

            .button_calc2:hover {
                cursor: pointer;
                background: #fff;
                color: #759e00;
            }

            .button_calc3 {
                height: 40px;
                width: 100%;
                font-family: 'Open Sans';
                background: #96bf22;
                color: white;
                font-size: 16px;
                transition: background 0.2s;
                border-radius: 12px;
                border: 1px solid #759e00;
                margin-top: 25px;
            }

            .button_calc3:hover {
                cursor: pointer;
                background: #fff;
                color: #759e00;
            }

            .label_and_input {
                width: 100%;
                margin:0px;
                max-height: 40px;
            }

            .input {
                width:60%;
                border: 1px solid #ccc;
                height: 40px;
                padding: 6px;
                font-family: 'Open Sans';
                font-size: 12pt;
                outline: none;
                display: inline;
                box-sizing: border-box;
                margin-left: -1px;
            }

            .inputClass, .inputClass2 {
                width: 49%;
                border: 1px solid #cccccc;
                font-size: 12pt;
                padding: 4px;
                padding-left: 6px;
                outline: none;
                height: 40px;
                box-sizing: border-box;
                margin-left: -1px;
                position: relative;
                top:-1.6px;
            }

            .inputClass2 {
                width: 25%;
            }

            .inputClass3 {
                width: 25%;
                border: 1px solid #cccccc;
                font-size: 12pt;
                padding: 4px;
                padding-left: 6px;
                outline: none;
                height: 40px;
                box-sizing: border-box;
                margin-left: -1px;
                position: relative;
                top:-1.6px;
            }

            .inputClass:focus, .inputClass2:focus, .inputClass3:focus {
                -webkit-animation: qtsmedicoes 0.5 infinite; /* Safari 4.0 - 8.0 */
                animation: qtsmedicoes 0.5s infinite;
                animation-direction: alternate;
            }

            .labelClass, .labelClass2 {
                width: 50%;
                padding: 6px;
                background: #1484c6;
                border: 1px solid #cccccc;
                color: #fff;
                box-sizing: border-box;
                text-align: center;
                font-size: 14pt;
                display: inline-block;
                height: 40px;
            }

            .labelClassBR {
                margin:0px;
                padding:0px;
                line-height: 0;
            }

            .qtsmedicoes {
                padding: 4px;
                padding-left: 6px;
                border: 1px solid #eee;
                outline: none;
                font-family: 'Open Sans';
                font-size: 12pt;
                border: 1px solid #2c88c5;
                width:90%;
                box-sizing: border-box;
                margin-top: -1px;
            }

            .qtsmedicoes:focus {
                -webkit-animation: qtsmedicoes 0.5 infinite; /* Safari 4.0 - 8.0 */
                animation: qtsmedicoes 0.5s infinite;
                animation-direction: alternate;
            }

            @keyframes qtsmedicoes {
                from {border: 1px solid #2c88c5;}
                to {border: 1px solid #ddf1ff;}
            }

            .all-imgs1 {
                position: relative;
                width: 300px;
                height: 320px;
            }
            .imagem_Button1 {
                position:absolute;
                left: 0px;
                top: 0px;
                z-index: 99;
            }
            .imagem_Button2 {
                position:absolute;
                left: 0px;
                top: 0px;
                z-index: 100;
                display: none;
            }
            .imagem_Button3 {
                position:absolute;
                left: 0px;
                top: 0px;
                z-index: 100;
                display: none;
            }
            .imagem_Button4 {
                position:absolute;
                left: 0px;
                top: 0px;
                z-index: 100;
                display: none;
            }

            .imagem_B {
                left: 0px;
                top: 0px;
                position:relative;
                border-radius: 8px;
                border: 1px solid #0088cb;
            }

            .imagem_B2_animation {
                border-radius: 8px;
                border: 1px solid #0088cb;
                -webkit-animation: imagem_Button 0.5s infinite;
                animation: imagem_Button 0.5s infinite;
                animation-direction: alternate;
            }
            @keyframes imagem_Button {
                from {opacity: 0;}
                to {opacity:100;}
            }

            .hidden {
                display: none;
            }

            .respostas {
                background:#94cf1d;
                padding: 0px;
                text-align: center;
                border-radius: 8px;
                margin: 25px 0px;
                font-size:16pt;
                color: #fff;
                width: 100%;
                box-sizing: border-box;
                font-weight: 300;
            }

            .resposta {
                margin: 0px;
                height: 40px;
                padding-top: 8px;
                border-bottom: 1px solid white;
            }
            .respostaV {
                margin:0px;
                height: 40px;
                padding-top: 8px;
            }

            .help_icon {
                vertical-align:-18%
            }

            .icon-link {
                text-decoration: none;
                color: #2c88c5;
            }

            .icon-link:active {
                color: #7bb14b;
            }

            .icon-link:visited {
                color: #2c88c5;
            }

            .icon-link:hover {
                color: #1194eb;
            }

            .labelStyle {
                padding: 6px;
                background: #1484c6;
                border: 1px solid #cccccc;
                color: #fff;
                box-sizing: border-box;
                text-align: center;
                font-size: 14pt;
                float:left;
                display: inline;
                height: 40px;
                width: 40%;
            }

            .labelStyle2 {
                padding: 6px;
                background: #1484c6;
                border: 1px solid #cccccc;
                color: #fff;
                box-sizing: border-box;
                text-align: center;
                font-size: 14pt;
                float:left;
                display: inline;
                height: 40px;
                width: 90%;
            }

            #label2 {
                margin-top: -1px;
            }
            .borderTR {
                border-top-right-radius: 8px;
            }

            .borderTL {
                border-top-left-radius: 8px;
            }

            .borderBR {
                border-bottom-right-radius: 8px;
            }

            .borderBL {
                border-bottom-left-radius: 8px;
            }

            #menorDimensao {
                margin-top:-1px;
            }

            .paragrafo {
                margin-top: 50px;
            }

            .iconStyleButton {
                margin-top: 6px;
            }

            .iconStyleButton2 {
                margin-top: 5px;
            }

            .textButton {
                position: relative;
                top: -12px;
                left: 12px;
            }

            .textButton2 {
                position: relative;
                top: -6px;
                left: 12px;
            }

            .esquerda {
                width: 50%;
                box-sizing: border-box;
                z-index: 2;
                margin-top: 25px;
                float: left;
            }

            .paragrafo2 {
                text-align: center;
            }

            .direita {
                width: auto;
                box-sizing: border-box;
                z-index: 2;
                margin-top: 25px;
                margin-left:30px;
                float: left;
                /* //border: 1px solid red; */
            }

            #label_and_input2 {
                margin-top: 10px;
                position: relative;
                top: -10px;
            }
            #label_and_input3 {
                margin-top: 25px;
            }

            .baixo {
                width: 100%;
                display: table;
                height: 200px;
                float: left;
            }
            .createdInputs2 {
                clear:both;
                /* //position: absolute;
                //height: auto;
                //display: inline-block; */
            }

            .createdInputs {
                clear:both;
                /* //display: flex;
                //flex-direction: column;
                //align-items: center; */
            }

            .createdInputs2 {
                margin-top:-4px;
                box-sizing: border-box;
            }
            .createdInputs3 {
                width: 50%;
                height: 40px;
                float: right;
                text-align: right;
                box-sizing: border-box;
            }

            #header1 {
                float:left;
                display: block;
                position: relative;
                left: 0px;
                width:50%;
                box-sizing: border-box;
                margin-bottom: -25px;
            }

            #header2 {
                float:left;
                display: block;
                position: relative;
                left: -1px;
                width:50%;
                box-sizing: border-box;
            }

            .clear {
                clear: both;
            }

            @media only screen and (max-width: 814px) {
                .esquerda {
                    width:100%;
                    margin-top: -25px;
                }

                .direita {
                    width: 100%;
                    text-align: center;
                    margin: 0px;
                    margin-top:25px;
                    padding: 0px;
                }

                .all-imgs1 {
                    display: inline-block;
                }

                .labelStyle {
                    font-size: 12pt;
                }
                .paragrafo {
                    text-align: center;
                }
                #p2 {
                    margin-top: 50px;
                }
                .createdInputs3 {
                    width: 65%;
                }
                .labelClass2 {
                    width: 35%;
                    font-size: 12pt;
                }
                #header1, #header2 {
                    font-size: 10pt;
                }
                .inputClass2, .inputClass3 {
                    width: 32.5%;
                }
            }

            @media only screen and (max-width: 600px) {
                .calc_profundidade_media {
                    padding:10px 24px;
                }
                .labelStyle {
                font-size: 12pt;
                width: 50%;
                }
                .input {
                    width: 50%;
                }
                .labelClass2 {
                    font-size: 10pt;
                    
                }
                .inputClass2, .inputClass3 {
                    font-size: 10pt;
                    box-sizing: border-box;
                    margin-bottom: -4px;
                }

                .labelClass4 {
                    margin-top: -6px;
                    position: relative;
                    top: -5px;
                }
            }
            .device{
                    width: 50%;
                }
            @media screen and (max-width: 1380px) {
                .device{
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <?php require_once "navbar.php"; ?>
        <div class="device">
            <div id="all-calc" class="all-calc">
                <div id="calc_Padrao" class="calc_Padrao">
                    <div id="label_and_input1" class="label_and_input">
                        <label class="labelStyle borderTL" class="labelStyle">Comprimento (m):</label>
                        <input id="maiorDimensao" type="number" step="0.01" name="MaiorDimensaoMedia" class="input borderTR" onchange="calcNow()">
                        <br><br>
                    </div>
                    <div id="label_and_input2" class="label_and_input">
                        <label id="label2" class="labelStyle borderBL">Largura média (m):</label>
                        <input id="menorDimensao" type="number" step="0.01" name="MenorDimensaoMedia" class="input borderBR" onchange="calcNow()">
                       
                        <button id="nsei" class="nsei borderTL borderTR borderBR borderBL" onclick="showCalc1()">
                            <img src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/interrogacao.png" class="iconStyleButton2" width="26" height="26">
                            <span class="textButton2">Não sei qual é a Largura Média</span>
                        </button>
                        <br><br>
                        <div id="calcAlternative" class="calcAlternative">
                            <div id="calc_menor_dimensao_media" class="calc_menor_dimensao_media">
                                <div id="esquerda" class="esquerda">
                                    <p id="p1" class="paragrafo">
                                        Para calcular a largura média da sua piscina, você deve fazer 1 medida transversal a cada 1m da piscina e depois dividir pela soma das suas medidas:
                                    </p>
                                    <label class="labelStyle2 borderTR borderTL">Quantas medições você fez?</label>
                                    <br>
                                    <input id="meditions" type="number" name="medicoes" onchange="createInput(value)" onblur="hidden_imagem2()" onfocus="show_imagem2()" class="qtsmedicoes borderBR borderBL"> <i class="material-icons help_icon"><a class="icon-link" class="icon-link" onclick="jump('paragrafo')"> help</a></i>
                                </div>
                                <div id="direita" class="direita">
                                    <div id="all-imgs1" class="all-imgs1" width="300px" height="300px">
                                        <div id="imagem_Button1" class="imagem_Button1"><img class="imagem_B" src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/Sem+T%C3%ADtulo-1.jpg" width="300px" height="300px"></div>
                                        <div id="imagem_Button2" class="imagem_Button2"><img class="imagem_B2 imagem_B2_animation" src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/media-menor-medida2.jpg" width="300px" height="300px"></div>
                                        <div id="imagem_Button3" class="imagem_Button3"><img class="imagem_B3 imagem_B2_animation" src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/media-menor-medida3.jpg" width="300px" height="300px"></div>
                                    </div>
                                    <br><br>  
                                </div>
                                <div id="baixo1" class="baixo">
                                    <div id="createdInputs" class="createdInputs"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div id="label_and_input3" class="label_and_input">
                        <label class="labelStyle borderTL borderBL">Profundidade média (m):</label>
                        <br>
                        <input id="profundidade" type="number" step="0.01" name="ProfundidadeMedia" class="input borderTR borderBR" onchange="calcNow()">
                        <button id="1424253704" class="nsei nsei2 borderTL borderTR borderBR borderBL" onclick="showCalc2()">
                            <img src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/interrogacao.png" class="iconStyleButton2" width="26" height="26"></img>
                            <span class="textButton2">Não sei qual é a profundidade média</span>
                        </button>
                        <br><br>
                    </div>
                </div>
                <div id="calcAlternative2" class="calcAlternative">
                    <div id="calc_profundidade_media" class="calc_profundidade_media">
                        <div id="esquerda" class="esquerda">
                            <p id="p2" class="p paragrafo2">
                            Para calcular a menor profundidade média, você deve fazer várias medidas de profundidade da sua piscina. Cada profundidade é multiplicada pelo comprimento correspondente a essa profundidade:
                            </p>
                            <label class="labelStyle2 borderTR borderTL">Quantas medições você fez?</label>
                            <br>
                            <input id="meditions2" type="number" name="medicoes2" onchange="createInput2(value)" class="qtsmedicoes borderBR borderBL" onblur="hidden_imagem4()" onfocus="show_imagem4()"><i class="material-icons help_icon"><a href="#p2" class="icon-link"> help</a></i>
                        </div>  
                        <div id="direita" class="direita">
                            <div id="all-imgs2" class="all-imgs1" width="300px" height="300px">
                                <div id="imagem_Button1-2" class="imagem_Button1"><img class="imagem_B" src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/media-profundidade-medida.jpg" width="300px" height="300px"></div>
                                <div id="imagem_Button2-2" class="imagem_Button2"><img class="imagem_B2 imagem_B2_animation" src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/media-profundidade-medida4.jpg" width="300px" height="300px"></div>
                                <div id="imagem_Button3-2" class="imagem_Button3"><img class="imagem_B3 imagem_B2_animation" src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/media-profundidade-medida2.jpg" width="300px" height="300px"></div>
                                <div id="imagem_Button4-2" class="imagem_Button4"><img class="imagem_B4 imagem_B2_animation" src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/media-profundidade-medida3.jpg" width="300px" height="300px"></div>
                            </div>
                        </div>
                        <br><br>
                        <div id="baixo2" class="baixo">
                            <div id="createdInputs3" class="createdInputs3 "></div>
                            <br><br>
                            <div id="createdInputs2" class="createdInputs2"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <button id="calc-vol-pisc-irregular" class="button_calc" onclick="calcNow()">
                    <img src="https://irp-cdn.multiscreensite.com/12ba6007/dms3rep/multi/calcular.png" class="iconStyleButton" width="40" height="40"></img><span class="textButton">Calcular Volume</span>
                </button>
                <div id="respostas" class="respostas">
                    <p id="resposta" class="resposta">Resposta em m³</p>
                    <p id="respostaV" class="respostaV">Resposta em Litros</p>
                </div>
            </div>
        </div>
        <script>
            function hidden_imagem2() {
                let el = document.getElementById("imagem_Button2");
                el.classList.remove("show");
                el.classList.add("hidden");
            }

            function show_imagem2() {
                let el = document.getElementById("imagem_Button2");
                el.classList.remove("hidden");
                el.classList.add("show");
            }

            function hidden_imagem3() {
                let el = document.getElementById("imagem_Button3");
                el.classList.remove("show");
                el.classList.add("hidden");
            }

            function show_imagem3() {
                let el = document.getElementById("imagem_Button3");
                el.classList.remove("hidden");
                el.classList.add("show");
            }
            function hidden_imagem4() {
                let el = document.getElementById("imagem_Button2-2");
                el.classList.remove("show");
                el.classList.add("hidden");
            }

            function show_imagem4() {
                let el = document.getElementById("imagem_Button2-2");
                el.classList.remove("hidden");
                el.classList.add("show");
            }
            function hidden_imagem5() {
                let el = document.getElementById("imagem_Button3-2");
                el.classList.remove("show");
                el.classList.add("hidden");
            }

            function show_imagem5() {
                let el = document.getElementById("imagem_Button3-2");
                el.classList.remove("hidden");
                el.classList.add("show");
            }
            function hidden_imagem6() {
                let el = document.getElementById("imagem_Button4-2");
                el.classList.remove("show");
                el.classList.add("hidden");
            }

            function show_imagem6() {
                let el = document.getElementById("imagem_Button4-2");
                el.classList.remove("hidden");
                el.classList.add("show");
            }

            var totMedidas = 0;
            function jump(h){
                        var top = document.getElementById(h).offsetTop;
                        window.scrollTo(0, top);
                    }
                //Faz aparecer calculadora para calcular a Menor dimensão média:
                function showCalc1() {
                    

                    let buttonNsei1 = document.getElementById("nsei");
                    buttonNsei1.classList.toggle("borderBR");
                    buttonNsei1.classList.toggle("borderBL");
                    let CalcMenorDimensaoMedia = document.getElementById("calc_menor_dimensao_media");
                    CalcMenorDimensaoMedia.classList.toggle("show");
                    document.getElementById("calc_menor_dimensao_media").focus();
                    document.getElementById("meditions").focus();
                    jump('nsei');

                }
                //Faz aparecer calculadora para calcular a Profundidade média:
                function showCalc2() {
                    let CalcProfundidadeMedia = document.getElementById("calc_profundidade_media");
                    CalcProfundidadeMedia.classList.toggle("show");
                    document.getElementById("meditions2").focus();
                    jump('1424253704');
                }
                function createInput(value) {
                    var dimensoes = {};
                    let divGeral = document.getElementById("all-calc");
                    let calcAlternative = document.getElementById("calcAlternative");
                    totMedidas = document.getElementById("meditions").value;
                    //divGeral.removeChild(divGeral.calcAlternative);
                    var el = document.querySelector("[class='inputClass']");
                    [...document.getElementsByClassName("inputClass")].map(n => n && n.remove());
                    [...document.getElementsByClassName("labelClass")].map(n => n && n.remove());
                    [...document.getElementsByClassName("button_calc2")].map(n => n && n.remove());
                    for (count=1; count<=value; count++)
                    {
                        inputNovo = document.createElement("input");
                        inputNovo.id = "input" + count;
                        inputNovo.classList.add("inputClass");
                        inputNovo.onfocus = function () {show_imagem3()};
                        inputNovo.onblur = function () {hidden_imagem3()};
                        labelNovo = document.createElement("label");
                        labelNovo.id = "label" + count;
                        labelNovo.classList.add("labelClass");
                        labelNovo.innerHTML = "Medida " + (count) + ": ";
                        if (labelNovo.id == "label1" && value == 1) {
                            labelNovo.classList.add("borderTL");
                            labelNovo.classList.add("borderBL");
                            inputNovo.classList.add("borderTR");
                            
                        }
                        else if (labelNovo.id == "label1") {
                            labelNovo.classList.add("borderTL");
                            inputNovo.classList.add("borderTR");
                        } else if (labelNovo.id == "label" + value) {
                            labelNovo.classList.add("borderBL");
                            inputNovo.classList.add("borderBR");

                        }
                        receiver = document.getElementById("createdInputs");
                        receiver.appendChild(labelNovo);
                        receiver.appendChild(inputNovo);
                    }
                    

                    console.log(totMedidas);
                    button = document.createElement("button");
                    receiver.appendChild(button);
                    button.id = "button_nsei";
                    button.classList.add("button_calc2");
                    button.innerHTML = "Calcular menor dimensão média";
                    document.getElementById("button_nsei").addEventListener("click", function(){
                        CalcMenorDimensaoMedia();
                    });

                    divClear = document.createElement("div");
                    divClear.id = "divClear";
                    divClear.classList.add("clear");
                    receiver.appendChild(divClear);
                }
                function calcNow() {
                    let maiorDimensao = document.getElementById("maiorDimensao").value;
                    let menorDimensao = document.getElementById("menorDimensao").value;
                    let profundidade = document.getElementById("profundidade").value;
                    let resposta = document.getElementById("resposta");
                    let respostaV = document.getElementById("respostaV");
                    let volume = maiorDimensao*menorDimensao*profundidade;
                    volume = volume.toFixed(2);
                    resposta.innerHTML = volume + ' m³';
                    respostaV.innerHTML = volume*1000 + ' L';
                }
                function CalcMenorDimensaoMedia() {
                    let CalcMenorDimensaoMedia = document.getElementById("calc_menor_dimensao_media");
                    CalcMenorDimensaoMedia.classList.toggle("show");
                    totMedidas = document.getElementById("meditions").value;
                    let DimensaoTot = 0;
                    dimensoes = {};
                    for (count=1; count<=totMedidas; count++) {
                        dimensoes["dimensao" + count] = document.getElementById("input"+count).value;
                        DimensaoTot = (DimensaoTot + parseInt(dimensoes["dimensao"+count]));
                    }
                    document.getElementById("menorDimensao").value = DimensaoTot/totMedidas;
                    calcNow();
                }
                    function createInput2(value) {
                    var dimensoes2 = {};
                    var largura2 = {};
                    let divGeral = document.getElementById("all-calc");
                    let calcAlternative = document.getElementById("calcAlternative");
                    receiver2 = document.getElementById("createdInputs2");
                    receiver3 = document.getElementById("createdInputs3");
                    totMedidas2 = document.getElementById("meditions2").value;
                    var el2 = document.querySelector("[class='inputClass2']");
                    [...document.getElementsByClassName("inputClass2")].map(n => n && n.remove());
                    [...document.getElementsByClassName("labelClass2")].map(n => n && n.remove());
                    [...document.getElementsByClassName("inputClass3")].map(n => n && n.remove());
                    [...document.getElementsByClassName("button_calc3")].map(n => n && n.remove());
                    
                    //label butao 2 hr da tabela
                    
                        labelNovo3 = document.createElement("label");
                        labelNovo3.id = "header1";
                        labelNovo3.classList.add("labelClass2");

                        labelNovo3.classList.add("borderTL");
                        labelNovo3.innerHTML = "Profundidade (m)";

                        labelNovo4 = document.createElement("label");
                        labelNovo4.id = "header2";
                        labelNovo4.classList.add("labelClass2");
                        labelNovo4.classList.add("borderTR");
                        labelNovo4.innerHTML = "Comprimento (m)";

                        receiver3.appendChild(labelNovo3);
                        receiver3.appendChild(labelNovo4);
                    for (count=1; count<=value; count++)
                    {
                        inputNovo2 = document.createElement("input");
                        inputNovo2.id = "input2" + count;
                        inputNovo2.classList.add("inputClass2");

                        inputNovo2.onfocus = function () {show_imagem5()};
                        inputNovo2.onblur = function () {hidden_imagem5()};
                        //inputNovo2.placeholder = "Profundidade (m)";
                        inputNovo3 = document.createElement("input");
                        inputNovo3.id = "input3-" + count;
                        inputNovo3.classList.add("inputClass3");
                        inputNovo3.onfocus = function () {show_imagem6()};
                        inputNovo3.onblur = function () {hidden_imagem6()};
                        //inputNovo3.placeholder = "Comprimento (m)";
                        inputNovo3.title = "Coloque aqui o comprimento (m) da piscina que possuí esta profundidade";
                        labelNovo2 = document.createElement("label");
                        labelNovo2.id = "label" + count;
                        labelNovo2.classList.add("labelClass2");
                        labelNovo2.innerHTML = "Profundidade " + (count) + ": ";
                        //aaaaaaaaaaaaaaa
                        labelNovo2.classList.add("labelClass4");
                        if (labelNovo2.id == "label1" && value == 1) {
                            labelNovo2.classList.add("borderTL");
                            labelNovo2.classList.add("borderBL");
                        }
                        else if (labelNovo2.id == "label1") {
                            labelNovo2.classList.add("borderTL");
                        } else if (labelNovo2.id == "label" + value) {
                            labelNovo2.classList.add("borderBL");
                        }

                        receiver2.appendChild(labelNovo2);
                        receiver2.appendChild(inputNovo2);
                        receiver2.appendChild(inputNovo3);
                    }
                    button2 = document.createElement("button");
                    receiver2.appendChild(button2);
                    button2.id = "button_nsei2";
                    button2.classList.add("button_calc3");
                    button2.innerHTML = "Calcular profundidade média";
                    document.getElementById("button_nsei2").addEventListener("click", function(){
                        CalcMenorDimensaoMedia2();
                    });
                }
                    function CalcMenorDimensaoMedia2() {
                    let CalcMenorDimensaoMedia2 = document.getElementById("calc_profundidade_media");
                    CalcMenorDimensaoMedia2.classList.toggle("show");
                    totMedidas2 = document.getElementById("meditions2").value;
                    let DimensaoTot2 = 0;
                    let profundidadeT = 0;
                    let larguraTot = 0;
                    dimensoes2 = {};
                    var largura2 = {};
                    for (count=1; count<=totMedidas2; count++) {
                        dimensoes2["dimensao" + count] = document.getElementById("input2"+count).value;
                        largura2["largura" + count] = document.getElementById("input3-"+count).value;
                        profundidadeT = profundidadeT + (parseInt(dimensoes2["dimensao"+count]) * parseInt(largura2["largura"+count]));
                        larguraTot = larguraTot + parseInt(largura2["largura"+count]);
                        DimensaoTot2 = (DimensaoTot2 + (parseInt(dimensoes2["dimensao"+count]) * parseInt(largura2["largura"+count])));
                            console.log(DimensaoTot2);
                    }
                    document.getElementById("profundidade").value = profundidadeT/larguraTot;
                    calcNow();
                }
                totMedidas = 0;
                totMedidas2 = 0;
        </script>
    </body>
</html>