<link rel="stylesheet" href="reset.css">
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
    @media screen and (min-width: 1301px) {
        .style {
            font-size: 85px;
            color: #002941;
            width: 80%;
            margin-left: 10%;
            margin-bottom: 3%;
            color: rgb(172, 171, 171)f1c;
        }
        .title {
            width: 96%;
            height: 80px;
            line-height: 75px;
            vertical-align: middle;
            font-size: 60%;
            font-weight: bold;
            text-align: center;
            background-color: #94cf1c;
            margin-bottom: 1%;
            margin-left: 2%;
        }
        .subtitle {
            font-size: 50%;
            font-weight: bold;
            text-align: center;
            margin-left: 4%;
        }
        .subtitleDesktop {
            display: none;
        }
        .titleBox {
            background-color: #2d8dc9;
            width: 94%;
            height: 60px;
            line-height: 50px;
            font-size: 40%;
            font-weight: bold;
            text-align: center;
            border: 1px solid #2d8dc9;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            margin-left: 3%;
        }
        .lineLeft {
            background-color: #8bc4d1;
            width: 27%;
            height: 45px;
            line-height: 28px;
            vertical-align: middle;
            font-size: 25%;
            font-weight: bold;
            text-align: center;
            border: 1px solid #002941;
            padding: 5px;
            margin-left: 3%;
        }
        .lineRight {
            background-color: #dff2f7;
            width: 67%;
            height: 45px;
            line-height: 28px;
            vertical-align: middle;
            font-size: 20%;
            border: 1px solid #002941;
            padding: 5px;
        }
        .lineFull {
            background-color: #dff2f7;
            height: 45px;
            line-height: 28px;
            vertical-align: middle;
            font-size: 20%;
            border: 1px solid #002941;
            padding: 5px;
        }
        .deskInline {
            display: flex;
        }
        .blockOne {
            background-color: #b4cfd6;
            margin-left: 2%;
            margin-top: 1%;
            width: 47%;
            padding-top: 3%;
            padding-bottom: 3%;
        }
        .blockTwo {
            background-color: #b4cfd6;
            margin-left: 2%;
            margin-top: 1%;
            width: 47%;
            padding-top: 3%;
            /* padding-bottom: 3%; */
        }
        .blockThree {
            background-color: #b4cfd6;
            margin-top: 2%;
            width: 96%;
            padding-top: 3%;
            padding-bottom: 3%;
            margin-left: 2%;
        }
        .detailsBox {
            width: 100%;
            position: relative;
            top: -46px;
        }
        .details {
            top: -200px;
            width: 94%;
            height: 90px;
            font-size: 17%;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            padding: 5px;
            margin-left: 3%;
        }
        .archives {
            text-align: center;
            margin-bottom: 1%;
            width: 94%;
            margin-left: 3%;
        }
    }
    
    @media screen and (max-width: 1300px) {
        .style {
            font-size: 60px;
            color: #002941;
            width: 100%;
        }
        .title {
            width: 96%;
            height: 60px;
            line-height: 50px;
            vertical-align: middle;
            font-size: 60%;
            font-weight: bold;
            text-align: center;
            background-color: #94cf1c;
            margin-bottom: 15px;
            margin-left: 2%;
        }
        .subtitle {
            font-size: 40%;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            margin-left: 2%;
        }
        .subtitleDesktop {
            display: none;
        }
        .titleBox {
            background-color: #2d8dc9;
            width: 96%;
            height: 60px;
            line-height: 50px;
            font-size: 50%;
            font-weight: bold;
            text-align: center;
            border: 1px solid #2d8dc9;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            margin-top: 3%;
            margin-left: 2%;
        }
        .lineLeft {
            background-color: #8bc4d1;
            width: 28%;
            height: 45px;
            line-height: 28px;
            vertical-align: middle;
            font-size: 40%;
            font-weight: bold;
            text-align: center;
            border: 1px solid #002941;
            padding: 5px;
            margin-left: 2%;
        }
        .lineRight {
            background-color: #dff2f7;
            width: 68%;
            height: 45px;
            line-height: 28px;
            vertical-align: middle;
            font-size: 35%;
            border: 1px solid #002941;
            padding: 5px;
        }
        .lineFull {
            background-color: #dff2f7;
            height: 45px;
            line-height: 28px;
            vertical-align: middle;
            font-size: 35%;
            border: 1px solid #002941;
            padding: 5px;
        }
        .inline {
            display: flex;
        }
        .details {
            width: 96%;
            height: 150px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            padding: 10px;
            margin-left: 2%;
            margin-bottom: 3%;
        }
        .archives {
            text-align: center;
            margin-bottom: 50px;
            width: 96%;
            margin-left: 2%;
        }
    }
    
    @media screen and (max-width: 800px) {
        .style {
            font-size: 40px;
            color: #002941;
            width: 100%;
        }
        .title {
            width: 96%;
            height: 50px;
            line-height: 50px;
            vertical-align: middle;
            font-size: 60%;
            font-weight: bold;
            text-align: center;
            background-color: #94cf1c;
            margin-bottom: 15px;
            margin-left: 2%;
        }
        .subtitle {
            font-size: 40%;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            margin-left: 2%;
        }
        .titleBox {
            background-color: #2d8dc9;
            width: 96%;
            height: 50px;
            line-height: 50px;
            font-size: 50%;
            font-weight: bold;
            text-align: center;
            border: 1px solid #2d8dc9;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            margin-top: 3%;
            margin-left: 2%;
        }
        .lineLeft {
            background-color: #8bc4d1;
            width: 28%;
            height: 40px;
            line-height: 25px;
            vertical-align: middle;
            font-size: 40%;
            font-weight: bold;
            text-align: center;
            border: 1px solid #002941;
            padding: 5px;
            margin-left: 2%;
        }
        .lineRight {
            background-color: #dff2f7;
            width: 68%;
            height: 40px;
            line-height: 25px;
            vertical-align: middle;
            font-size: 35%;
            border: 1px solid #002941;
            padding: 5px;
        }
        .lineFull {
            background-color: #dff2f7;
            height: 30px;
            line-height: 25px;
            vertical-align: middle;
            font-size: 35%;
            border: 1px solid #002941;
            padding: 5px;
        }
        .inline {
            display: flex;
        }
        .details {
            width: 96%;
            height: 100px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            padding: 10px;
            margin-left: 2%;
            margin-bottom: 3%;
        }
        .archives {
            text-align: center;
            margin-bottom: 50px;
            width: 96%;
            margin-left: 2%;
        }
    }
</style>
<div class="style">
    <div class="title">Solicitação de Serviço</div>
    <div class="subtitle deskInline inline">
        <div>Lead Nº</div>
        <div>
            <?php echo $id ?>
        </div>
    </div>
    <div class="deskInline">
        <div class="blockOne">
            <div>
                <div class="titleBox">
                    <div>Informações de contato</div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Nome</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo  $contatoNome ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Email</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo  $emailContato ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft" style="border-bottom-left-radius: 15px;">
                        <div>Telefone</div>
                    </div>
                    <div class="lineRight" style="border-bottom-right-radius: 15px; ">
                        <div>
                            <?php echo  "$dddContato $telefoneContato" ?>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 25px;">
                <div class="titleBox">
                    <div>Informações de endereço</div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>UF</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $uf ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Cidade</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $cidade ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Bairro</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $bairro ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Rua:</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $logradouro ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Nº:</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $numero ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>CEP:</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $cep ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft" style="border-bottom-left-radius: 15px;">
                        <div>Compl:</div>
                    </div>
                    <div class="lineRight" style="border-bottom-right-radius: 15px; ">
                        <div>
                            <?php echo $complemento ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blockTwo">
            <div>
                <div class="titleBox">
                    <div>Serviço</div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Serviço</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $assunto ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Cliente</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $tipoCliente ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Inicio</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            Imediato, Prox dias, até 30 dias, sem prev
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Intenção</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            Negociar serviço, duvidas, apenas preço
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Piscinas</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $qtdPiscinas ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Vol. total</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $volume ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft">
                        <div>Visitas</div>
                    </div>
                    <div class="lineRight">
                        <div>
                            <?php echo $visitasSemanais ?>
                        </div>
                    </div>
                </div>
                <div class="inline deskInline">
                    <div class="lineLeft" style="border-bottom-left-radius: 15px;">
                        <div>Produtos</div>
                    </div>
                    <div class="lineRight" style="border-bottom-right-radius: 15px; ">
                        <div>
                            <?php echo $produtosInclusos ?>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 25px;">
                <div class="titleBox" style="margin-bottom: 0px;">
                    Detalhes
                </div>
                <div class="inline detailsBox" style="margin-top: 0px;">
                    <div class="lineRight details">

                        <?php echo $detalhes ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(count($valuesArquivos)>0){
        echo"
    <div class='blockThree'>
        <div>
            <div class='titleBox'>Arquivos</div>
        </div>
        <div class='archives'>";
                if(count($valuesArquivos)>0){
                    foreach($valuesArquivos as $linha) {
                        $id_fk = $linha["id_fk"];
                        $nome= $linha["nome"];
                        $extensao= $linha["extensao"];
                        $qtd= $linha["qtd"];
                        echo "
                        <div class='lineFull'>
                                <a target='_blank' href='arquivos/leads/" . $id_fk . "numero" . $qtd . "." . $extensao . "'>" . $qtd . " " . $nome .  "</a>
                        </div>";
                        }
                    echo "
        </div>";
                    }
                }
            ?>
</div>
</div>