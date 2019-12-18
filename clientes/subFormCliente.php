<?php 

$cliente = $pdo->prepare("
    SELECT `id`, `id_fk`, `nomeResponsavel`, `email`, `ddd`, `telefone`, `cep`, `uf`, `cidade`, `bairro`, `rua`, `numero`, `complemento`, `tipoCliente`, `nomeCliente`, 
    `servico`, `visitasSemana`, `visitasSemanaAlta`, `visitasSemanaBaixa`, `inicioAlta`, `fimAlta`, `produtosInclusos`, `inicioContrato`, `fimContrato`, `vencimento`, `observacoes` 
    FROM `clientes` 
    WHERE id_fk = :id
    ");
                                        
    $cliente->bindValue(':id', $id);
    $cliente->execute();
    $values = $cliente->fetchAll();
    $data = $values[0];

    $id_fk = $data['id_fk'];
    $nomeResponsavel = $data['nomeResponsavel']; 
    $email = $data['email'];
    $ddd = $data['ddd'];
    $telefone = $data['telefone'];
    $cep = $data['cep'];
    $uf = $data['uf'];
    $cidade = $data['cidade'];
    $bairro = $data['bairro'];
    $rua = $data['rua'];
    $numero = $data['numero'];
    $complemento = $data['complemento'];
    $tipoCliente = $data['tipoCliente'];
    $nomeCliente = $data['nomeCliente'];
    $servico = $data['servico'];
    $visitasSemana = $data['visitasSemana'];
    $visitasSemanaAlta = $data['visitasSemanaAlta'];
    $visitasSemanaBaixa = $data['visitasSemanaBaixa'];
    $inicioAlta = $data['inicioAlta'];//data
    $fimAlta = $data['fimAlta'];//data
    $produtosInclusos = $data['produtosInclusos'];
    $inicioContrato = $data['inicioContrato'];//data
    $fimContrato = $data['fimContrato'];//data
    $vencimento = $data['vencimento'];
    $observacoes = $data['observacoes'];


    // $inicioAlta = date('d/m/Y', $inicioAlta);
    // $fimAlta = date('d/m/Y', $fimAlta);
    // $inicioContrato = date('d/m/Y', $inicioContrato);
    // $fimContrato = date('d/m/Y', $fimContrato);
    // $dtm = date('Y-m-d H:i:s');
    // $dtmCadastro = date('d/m/y H:i', strtotime("$dtm -3 hours")); 
    echo"
    $inicioAlta
    $fimAlta
    $inicioContrato
    $fimContrato
    ";   
?>

<link rel="stylesheet" href="reset.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        .inline{
            display: flex;
        }
        .deskInline{
            display: flex;
        }
        .style {
            font-size: 50px;
            color: #002941;
            width: 100%;
            border-radius: 15px;
        }
        .title {
            width: 45%;
            font-size: 50%;
        }
        
        .titleBox {
            width: 110%;
            margin-left: -5%;
            text-align: center;
            padding: 1%;
            font-weight: bold;
            height: 50px;
            line-height: 50px;
            vertical-align: middle;
            background-color: #94cf1c;
            /* margin-bottom: 10px;   */

        }
        .subtitle {
            font-size: 50%;
            margin-top: 15px;
            text-align: center;
            padding: 1%;
            background-color: #2d8dc9;
            font-weight: bold;
            height: 40px;
            width: 100%;
            line-height: 30px;
            vertical-align: middle;
            border: 1px solid #2d8dc9;
        }
        .nameItem{
            background-color: #8bc4d1;
            font-size: 40%;
            height: 35px;
            padding: 1%;
            width: 28%;
            line-height: 25px;
            vertical-align: middle;
            font-weight: bold;
            border: 1px solid #002941;
            padding: 5px;
            
        }
        .nameItemLong{
            background-color: #8bc4d1;
            font-size: 40%;
            height: 35px;
            padding: 1%;
            width: 65%;
            line-height: 25px;
            vertical-align: middle;
            font-weight: bold;
            /* text-align: center; */
            border: 1px solid #002941;
            padding: 5px;
        }
        .textItem{
            background-color: #dff2f7;
            font-size: 35%;
            height: 35px;
            padding: 1%;
            width: 72%;
            line-height: 25px;
            vertical-align: middle;
            font-size: 35%;
            border: 1px solid #002941;
            padding: 5px;
        }
        .textItemShort{
            background-color: #dff2f7;
            font-size: 35%;
            height: 35px;
            padding: 1%;
            width: 35%;
            line-height: 25px;
            vertical-align: middle;
            font-size: 35%;
            border: 1px solid #002941;
            padding: 5px;

        }
      
        .inputs,
        .input:focus{
            width: 98%;
            height: 30px;
            background-color: #76aac5;
            display: none;
            font-size: 15px;
            margin-top: 2px;
            margin-bottom: 5px;
            margin-left: 1%;
            padding: 1%;
            box-shadow: 0 0 0 0;
            border: 0 none;
            outline: 0;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .saveBtn{
            display: none;
        }
        /* .details {
            width: 96%;
            height: 100px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            padding: 10px;
            margin-left: 2%;
            margin-bottom: 3%;
        } */
        /* .labels{
            width: 100%;
            font-size: 50%;
            background-color: green;
            height: 50px;
        } */
</style>
<form class="form-container" id="updateClientForm" method=post enctype="multipart/form-data" action="cadastrando_updateCliente">
<input name='id_fk' type='hidden' value='<?php echo "$id"?>'>
    <div class="style">
        <div class="titleBox">
            <div class="inline">
                <div class="title" style="margin-right: 2%; margin-left: 4%;">
                    <label class="labels" for="tipoCliente"><?php echo "$tipoCliente"?></label>
                </div>
                <div class="title">
                    <label class="labels" for="nomeCliente"><?php echo "$nomeCliente"?></label>
                </div>
            </div>
        </div>
        <div class="inline">
            <input class="inputs" id="tipoCliente" name='tipoCliente' value='<?php echo "$tipoCliente"?>'>
            <input class="inputs" id="nomeCliente" name='nomeCliente' value='<?php echo "$nomeCliente"?>'>
        </div>

       <div>
            <div class="subtitle inline" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div style="width: 85%">
                    Informações de contato
                </div>
                <div id="editContactBtn" style="width: 15%; margin-top: 4px;" id="editContactBtn">
                    <i class="material-icons" onclick="editContact()">edit</i>
                </div>
                <div id="editContactSaveBtn" class="saveBtn" style="width: 15%; margin-top: 4px;" onclick="submit()">
                    <i class="material-icons"  onclick="save()">save</i>
                </div>
            </div>
            <div class="inline">
                <div class="nameItem">Nome</div>
                <div class="textItem">
                    <label class="labels" for="nomeResponsavel"><?php echo "$nomeResponsavel"?></label>
                </div>
            </div>
            <input class="inputs" id="nomeResponsavel" name='nomeResponsavel' value='<?php echo "$nomeResponsavel"?>'>
            <div class="inline">
                <div class="nameItem">Email</div>
                <div class="textItem">
                    <label class="labels" for="email"><?php echo "$email"?></label>
                </div>
            </div>
            <input class="inputs" id="email" name='email' value='<?php echo "$email"?>'>
            <div>
                <div class="inline">
                    <div class="nameItem">Telefone</div>
                    <div class="textItem inline">
                        <div style="margin-right: 2%; width: 15%">
                            <label class="labels" for="ddd"><?php echo "$ddd"?></label>
                        </div>
                        <div style="width: 85%">
                            <label class="labels" for="telefone"><?php echo "$telefone"?></label>
                        </div>
                    </div>
                </div>
                <div class="inline">
                    <input class="inputs" type='number' id="ddd" style="width: 15%" id="ddd" name='ddd' value='<?php echo "$ddd"?>'>
                    <input class="inputs" type='number' id="telefone" name='telefone' value='<?php echo "$telefone"?>'>
                </div>
            </div>
        </div>
        <div>
            <div class="subtitle inline" >
                <div style="width: 85%">
                    Endereço
                </div>
                <div id="editAddresstBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="editAddress()">edit</i>
                </div>
                <div id="editAddressSaveBtn" class="saveBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="save()">save</i>
                </div>
            </div>
            <div>
                <div class="textItem" style="width: 100%; height: 100px; line-height: 30px; vertical-align: middle">
                    <label class="labels"><?php echo "$rua, $numero - $bairro. $complemento"?></label>
                    <div class="inline" style="width:100%;">
                        <label class="labels inline" style="width:90%"><?php echo "$cidade - $uf . $cep"?></label>
                        <div style="width: 10%; margin-top: 4px;height: 30px">
                            <i class="material-icons">content_copy</i>
                        </div>
                    </div>
                </div>
                <div class="inline">
                    <input class="inputs" style="width: 79%" id="rua" name='rua' value='<?php echo "$rua"?>'>
                    <input class="inputs" style="width: 18%" type='number' id="numero" name='numero' value='<?php echo "$numero"?>'>
                </div>
                <input class="inputs" id="bairro" name='bairro' value='<?php echo "$bairro"?>'>
                <input class="inputs" id="complemento" name='complemento' value='<?php echo "$complemento"?>'>
                <div class="inline">
                    <input class="inputs" style="width: 66%" id="cidade" name='cidade' value='<?php echo "$cidade"?>'>
                    <input class="inputs" style="width: 8%"  id="uf" name='uf' value='<?php echo "$uf"?>'>
                    <input class="inputs" style="width: 22%" type='number' id="cep" name='cep' value='<?php echo "$cep"?>'>
                </div>
            </div>
        </div>
        <div>
            <div class="subtitle inline">
                <div style="width: 85%">
                    Operação
                </div>
                <div id="editOperationBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="editOperation()">edit</i>
                </div>
                <div id="editOperationSaveBtn" class="saveBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="save()">save</i>
                </div>
            </div>    
            <div>
                <div class="inline">
                    <div class="nameItem">Serviço</div>
                    <div class="textItem">
                        <label class="labels" for="servico"><?php echo "$servico"?></label>
                    </div>
                </div>
                <input class="inputs" id="servico" name='servico' value='<?php echo "$servico"?>'>
                <div class="inline">
                    <div class="nameItemLong">Visitas por Semana</div>
                    <div class="textItemShort">
                        <label class="labels" for="visitasSemana"><?php echo "$visitasSemana"?></label>
                    </div>
                </div>
                <input class="inputs" id="visitasSemana" name='visitasSemana' value='<?php echo "$visitasSemana"?>'>
                <div class="inline">
                    <div class="nameItemLong">Produtos Inclusos</div>
                    <div class="textItemShort">
                        <label class="labels" for="produtosInclusos"><?php echo "$produtosInclusos"?></label>
                    </div>
                </div>
                <input class="inputs" id="produtosInclusos" name='produtosInclusos' value='<?php echo "$produtosInclusos"?>'>
            </div>
        </div>
        <div>
            <div class="subtitle inline">
                <div style="width: 85%">
                    Temporada
                </div>
                <div id="editSeasonBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons"onclick="editSeason()">edit</i>
                </div>
                <div id="editSeasonSaveBtn" class="saveBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="save()">save</i>
                </div>
            </div>
            <div class="inline">
                <div class="nameItemLong">Inicio alta temporada</div>
                <div class="textItemShort">
                    <label class="labels" for="inicioAlta"><?php echo "$inicioAlta"?></label>
                </div>
            </div>
            <input class="inputs" id="inicioAlta" name='inicioAlta' type="date" value='<?php echo "$inicioAlta"?>'>    
            <div class="inline">
                <div class="nameItemLong">Fim alta temporada</div>
                <div class="textItemShort">
                    <label class="labels" for="fimAlta"><?php echo "$fimAlta"?></label>
                </div>
            </div>
            <input class="inputs" id="fimAlta" name='fimAlta' type="date" value='<?php echo "$fimAlta"?>'>
            <div class="inline">
                <div class="nameItemLong">Visitas na alta</div>
                <div class="textItemShort">
                    <label class="labels" for="visitasSemanaAlta"><?php echo "$visitasSemanaAlta"?></label>
                </div>
            </div>
            <input class="inputs" id="visitasSemanaAlta" name='visitasSemanaAlta'value='<?php echo "$visitasSemanaAlta"?>'>
            <div class="inline">
                <div class="nameItemLong">Visitas na baixa</div>
                <div class="textItemShort">
                    <label class="labels" for="visitasSemanaBaixa"><?php echo "$visitasSemanaBaixa"?></label>
                </div>
            </div>
            <input class="inputs" id="visitasSemanaBaixa" name='visitasSemanaBaixa' value='<?php echo "$visitasSemanaBaixa"?>'>
        </div>
        <div>
            <div class="subtitle inline">
                <div style="width: 85%">
                    Financeiro
                </div>
                <div id="editFinanceBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="editFinance()">edit</i>
                </div>
                <div id="editFinanceSaveBtn" class="saveBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="save()">save</i>
                </div>
            </div>
            <div class="inline">
                <div class="nameItemLong">Inicio do Contrato</div>
                <div class="textItemShort">
                    <label class="labels" for="inicioContrato"><?php echo "$inicioContrato"?></label>
                </div>
            </div>
            <input class="inputs" id="inicioContrato" name='inicioContrato' type="date" value='<?php echo "$inicioContrato"?>'>
            <div class="inline">
                <div class="nameItemLong">Fim do Contrato</div>
                <div class="textItemShort">
                    <label class="labels" for="fimContrato"><?php echo "$fimContrato"?></label>
                </div>
            </div>
            <input class="inputs" id="fimContrato" name='fimContrato' type="date" value='<?php echo "$fimContrato"?>'>
            <div class="inline">
                <div class="nameItemLong">Data Vencimento</div>
                <div class="textItemShort">
                    <label class="labels" for="vencimento"><?php echo "$vencimento"?></label>
                </div>
            </div>
            <input class="inputs" id="vencimento" name='vencimento' value='<?php echo "$vencimento"?>'>
        </div>
       <div>
            <div class="subtitle inline">
                <div style="width: 85%">
                    Observacões
                </div>
                <div id="editDescriptionBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="editDescription()">edit</i>
                </div>
                <div id="editDescriptionSaveBtn" class="saveBtn" style="width: 15%; margin-top: 4px;">
                    <i class="material-icons" onclick="save()">save</i>
                </div>
            </div>
            <div class="textItem" style="width: 100%; height: 100px; line-height: 30px; vertical-align: middle">
                <label class="labels"><?php echo "$observacoes"?></label>
            </div>
        </div>
        <input class="inputs" id="observacoes" style="height: 100px; vertical-align: top;line-height: 30px;" name='observacoes' value='<?php echo "$observacoes"?>'>
        <!-- <button type="submit">Salvar</button> -->
    </div>
</form>
 <script>
        function editContact(){

            let name = document.getElementById('nomeResponsavel');
            let email = document.getElementById('email');
            let ddd = document.getElementById('ddd');
            let fone = document.getElementById('telefone');
            let editBtn = document.getElementById('editContactBtn');
            let saveBtn = document.getElementById('editContactSaveBtn');

            name.style.display = 'block';
            document.getElementById('nomeResponsavel').focus();
            email.style.display = 'block';
            ddd.style.display = 'block';
            fone.style.display = 'block';
            editBtn.style.display = 'none'
            saveBtn.style.display = 'block'
        };
        function editAddress(){
            let rua = document.getElementById('rua');
            let numero = document.getElementById('numero');
            let bairro = document.getElementById('bairro');
            let complemento = document.getElementById('complemento');
            let cidade = document.getElementById('cidade');
            let uf = document.getElementById('uf');
            let cep = document.getElementById('cep');
            let editBtn = document.getElementById('editAddresstBtn');
            let saveBtn = document.getElementById('editAddressSaveBtn');

            rua.style.display = 'block';
            document.getElementById('rua').focus();
            numero.style.display = 'block';
            bairro.style.display = 'block';
            complemento.style.display = 'block';
            cidade.style.display = 'block';
            uf.style.display = 'block';
            cep.style.display = 'block';
            editBtn.style.display = 'none'
            saveBtn.style.display = 'block'
        };

        function editOperation(){
            let servico = document.getElementById('servico');
            let visitasSemana = document.getElementById('visitasSemana');
            let produtosInclusos = document.getElementById('produtosInclusos');
            let editBtn = document.getElementById('editOperationBtn');
            let saveBtn = document.getElementById('editOperationSaveBtn');

            servico.style.display = 'block';
            document.getElementById('servico').focus();
            visitasSemana.style.display = 'block';
            produtosInclusos.style.display = 'block';
            editBtn.style.display = 'none'
            saveBtn.style.display = 'block'
        };
        function editSeason(){
            let inicioAlta = document.getElementById('inicioAlta');
            let fimAlta = document.getElementById('fimAlta');
            let visitasSemanaAlta = document.getElementById('visitasSemanaAlta');
            let visitasSemanaBaixa = document.getElementById('visitasSemanaBaixa');
            let editBtn = document.getElementById('editSeasonBtn');
            let saveBtn = document.getElementById('editSeasonSaveBtn');

            inicioAlta.style.display = 'block';
            document.getElementById('inicioAlta').focus();
            fimAlta.style.display = 'block';
            visitasSemanaAlta.style.display = 'block';
            visitasSemanaBaixa.style.display = 'block';
            editBtn.style.display = 'none'
            saveBtn.style.display = 'block'
        };
        function editFinance(){
            let inicioContrato = document.getElementById('inicioContrato');
            let fimContrato = document.getElementById('fimContrato');
            let vencimento  = document.getElementById('vencimento');
            let editBtn = document.getElementById('editFinanceBtn');
            let saveBtn = document.getElementById('editFinanceSaveBtn');

            inicioContrato.style.display = 'block';
            document.getElementById('inicioContrato').focus();
            fimContrato.style.display = 'block';
            vencimento.style.display = 'block';
            editBtn.style.display = 'none'
            saveBtn.style.display = 'block'
        };
        function editDescription(){
            let descricao = document.getElementById('observacoes');
            let editBtn = document.getElementById('editDescriptionBtn');
            let saveBtn = document.getElementById('editDescriptionSaveBtn');

            descricao.style.display = 'block'
            document.getElementById('observacoes').focus();
            editBtn.style.display = 'none'
            saveBtn.style.display = 'block'
        }

        function save(){
            document.getElementById('updateClientForm').submit();
        }
 </script>
    
    <?php
    // if(count($valuesArquivos)>0){
    //     echo"
    // <div class='blockThree'>
    //     <div>
    //         <div class='titleBox'>Arquivos</div>
    //     </div>
    //     <div class='archives'>";
    //             if(count($valuesArquivos)>0){
    //                 foreach($valuesArquivos as $linha) {
    //                     $id_fk = $linha["id_fk"];
    //                     $nome= $linha["nome"];
    //                     $extensao= $linha["extensao"];
    //                     $qtd= $linha["qtd"];
    //                     echo "
    //                     <div class='lineFull'>
    //                             <a target='_blank' href='arquivos/leads/" . $id_fk . "numero" . $qtd . "." . $extensao . "'>" . $qtd . " " . $nome .  "</a>
    //                     </div>";
    //                     }
    //                 echo "
    //     </div>";
    //                 }
    //             }
            ?>
