<?php
include 'connections.php';
include 'session.php';

$pesqLocal = $pdo->prepare("SELECT id, local FROM locais ORDER BY local");
$pesqLocal->execute();
$values = $pesqLocal->fetchAll();

?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>Novo Lead</title>
            <?php require_once "head.php";?>
            <link rel="stylesheet" type="text/css" href="./css/novoLead.css">
        <script>
            function show(){
                if(document.getElementById("modalidade").selectedIndex == 2){
                    document.getElementById("sitioDiv").style.display ="block";
                    document.getElementById("codigoDiv").style.display ="block";
                }else{
                    document.getElementById("sitioDiv").style.display ="none";
                    document.getElementById("sitio").value ="";
                    document.getElementById("codigoDiv").style.display ="none";
                    document.getElementById("codigo").value ="";
                }
            };
        </script>
        <style>
            #sitioDiv{
                display:none;
            }
            #codigoDiv{
                display:none;
            }
            
        </style>
        </head>
        <body>
            <?php require_once "navbar.php";?>
            <div class="licitação" >
                <form class="form-container" method=post enctype="multipart/form-data" action="cadastrando_lead" >
                    <div class="form-row">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <h3 for="inputEmail4">Novo Lead</h3>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Motivo do Contato:</label>
                            <select name='motivoContato' id='motivoContato' class="form-control" required>
                                <option value= "">Selecione o motivo do contato</option>
                                <option value= "Orçamento">Orçamento</option>
                                <option value= "Cotação">Cotação para licitação</option>
                                <option value= "Duvidas">Duvidas</option>
                                <option value= "Sugestões">Sugestões</option>
                                <option value= "Reclamações">Reclamações</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="assunto">Assunto:</label>
                            <select name='assunto' id='assunto' class="form-control" required>
                                <option value=  "">Selecione o assunto do Lead</option>
                                <option value=  "Tratamento de Piscina">Tratamento de Piscina</option>
                                <option value=  "Manutenção Hidraulica">Manutenção Hidraulica</option>
                                <option value=  "Manutenção Elétrica">Manutenção Elétrica</option>
                                <option value=  "Troca de Areia">Troca de Areia</option>
                                <option value=  "Reforma">Reforma de Piscina</option>
                                <option value=  "Construção">Construção de Piscina</option>
                                <option value=  "Manutenção Elétrica">Manutenção Elétrica</option>
                                <option value=  "Guarda Vidas">Guarda Vidas</option>
                                <option value=  "Franquia">Franquia</option>
                                <option value=  "Curso">Curso</option>
                                <option value=  "Aplicativo">Aplicativo</option>
                                <option value=  "Manutenção de Outros Equipamentos">Manutenção de Outros Equipamentos</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="contatoNome">Contato:</label>
                            <input type = 'text' id='contatoNome' name ='contatoNome' placeholder="Nome do contato" class="form-control" required>
                        </div>
                        <div class="form-group" style="width: 5%; margin-right: 0.3%">
                            <label for="dddContato">DDD:</label>
                            <input type ='number' name = 'dddContato' class="form-control" required>
                        </div>
                        <div class="form-group" style="width: 11.4%;">
                            <label  for="telefoneContato">Telefone:</label>
                            <input type ='number' name = 'telefoneContato' class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="emailContato">Email:</label>
                            <input type ='email' name = 'emailContato' class="form-control" >
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label for="uf">UF:</label>
                            <select name='uf' class="form-control" required>
                                <option value= "">UF</option>
                                <option value= "AC">AC</option>
                                <option value= "AL">AL</option>
                                <option value= "AM">AM</option>
                                <option value= "AP">AP</option>
                                <option value= "BA">BA</option>
                                <option value= "CE">CE</option>
                                <option value= "DF">DF</option>
                                <option value= "ES">ES</option>
                                <option value= "GO">GO</option>
                                <option value= "MA">MA</option>
                                <option value= "MG">MG</option>
                                <option value= "MS">MS</option>
                                <option value= "MT">MT</option>
                                <option value= "PA">PA</option>
                                <option value= "PB">PB</option>
                                <option value= "PE">PE</option>
                                <option value= "PI">PI</option>
                                <option value= "PR">PR</option>
                                <option value= "RJ">RJ</option>
                                <option value= "RN">RN</option>
                                <option value= "RO">RO</option>
                                <option value= "RR">RR</option>
                                <option value= "RS">RS</option>
                                <option value= "SC">SC</option>
                                <option value= "SE">SE</option>
                                <option value= "SP">SP</option>
                                <option value= "TO">TO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cidade">Cidade:</label>
                            <input type = 'text' name = 'cidade' class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bairro">Bairro:</label>
                            <input type ='text' name ='bairro' class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="logradouro">Logradouro:</label>
                            <input type='text' name ='logradouro' class="form-control">
                        </div>
                        <div class="form-group" style="width: 7.5%; margin-right: 0.3%; margin-left: 0.3%">
                            <label for="numero">Nº:</label>
                            <input type='number' name='numero' class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cep">CEP:</label>
                            <input type='number' name='cep' class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="complemento">Complemento:</label>
                            <input type='text' name='complemento' class="form-control">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-row">
                        <div class="form-group" style="width: 23.5%; margin-right: 0.3%; margin-left: 0.3%">
                            <label for="volume">Volume Aproximado: (L)</label>
                            <select id='volume' name='volume' class="form-control" onchange="escreverPreco(document.getElementById('tipoCliente').value, document.getElementById('volume').value, document.getElementById('planoMensal').value)" required>
                                <option value= "">Selecione a faixa de volume</option>
                                <option value= "Menor que 50 mil litros">Menor que 50 mil litros</option>
                                <option value= "Entre 50 e 200 mil litros">Entre 50 e 200 mil litros</option>
                                <option value= "Maior que 200 mil litros">Maior que 200 mil litros</option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 23.5%; margin-right: 0.3%; margin-left: 0.3%">
                            <label for="tipoCliente">Localização da Piscina:</label>
                            <select name='tipoCliente' id='tipoCliente' class="form-control" onchange="escreverPreco(document.getElementById('tipoCliente').value, document.getElementById('volume').value, document.getElementById('planoMensal').value)" required>
                                <option value= "">Selecione o tipo de Cliente</option>
                                <option value= "Escola">Escola</option>
                                <option value= "Clinica">Clínica</option>
                                <option value= "Academia">Academia</option>
                                <option value="Condominio">Condomínio</option>
                                <option value= "Publico">Local Público</option>
                                <option value= "Residencia">Residência</option>
                                <option value= "Clube Recreativo">Clube / Associação</option>
                                <option value= "Outro Local com Piscina Coletiva">Outro Local com Piscina Coletiva</option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 17.5%; margin-right: 0.3%; margin-left: 0.3%">
                            <label for="planoMensal">Plano Mensal:</label>
                            <select id="planoMensal" name="planoMensal" class="form-control" onchange="escreverPreco(document.getElementById('tipoCliente').value, document.getElementById('volume').value, document.getElementById('planoMensal').value)">
                	    	  <option disabled selected value="">Selecione</option>
                			  <option value="Sim">Sim</option>
                			  <option value="Não">Não</option>
                			</select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="width: 11.5%; margin-right: 0.3%; margin-left: 0.3%">
                            <label for="produtosInclusos">Preço do lead</label>
                            <input type='text' id='precoLead' name='precoLead' class="form-control" placeholder="R$ 0,00">
                        </div>
                        <div class="form-group" style="width: 24.5%; margin-right: 0.3%; margin-left: 0.3%; text-align: center">
                            <label for="primeiroAtendimento">Data e hora de recebimento</label>
                            <div style="display: flex; width: 100%;">
                                <input type='date' id='dataRecebimento' name='dataRecebimento' class="form-control" style="width: 59.4%; margin-right: 0.3%; margin-left: 0.3%; text-align: center">
                                <input type='time' id='horaRecebimento' name='horaRecebimento' class="form-control" style="width: 40%; margin-right: 0.3%; margin-left: 0.3%; text-align: center">
                            </div>
                        </div>
                        <div class="form-group" style="width: 9.5%; margin-right: 0.3%; margin-left: 0.3%">
                            <label for="qtdPiscinas">Piscinas:</label>
                            <input type ='number' name = 'qtdPiscinas' class="form-control">
                        </div>
                        <div class="form-group" style="width: 18.5%; margin-right: 0.3%; margin-left: 0.3%">
                            <label for="produtosInclusos">Informe a Origem do Lead:</label>
                            <select name="origem" id="origem" class="form-control">
                                <option disabled selected value="">Origem do Lead</option>
                                <option value="Formulário no Site">Formulário no Site</option>
                                <option value="Whatsapp">Whatsapp</option>
                                <option value="Ligação">Ligação</option>
                                <option value="E-mail">E-mail</option>
                                <option value="Indicação">Indicação</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="width: 66.4%; margin-right: 0.3%; margin-left: 0.3%">
                            <label for="detalhes">Detalhes:</label>
                            <textarea rows="5" name='detalhes' id="detalhes" class="form-control" placeholder="Descreva os detalhes"></textarea>
                            <br>
                        </div>
                    </div>
                    </div>
                <div class="form-row">
                    <div class="form-group" style="width: 15%; margin-left: 0.3%">
                        <div class="file-field">
                            <div class="btn btn btn-success btn-sm b">
                                <input name="upload1[]" type="file" multiple="multiple" class="custom-file"/>
                                <input type = 'text' name = 'arquivo1' class="form-control" placeholder= "Nomeie o arquivo">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="width: 15%; margin-left: 2.2%">
                        <div class="file-field">
                            <div class="btn btn btn-success btn-sm b">
                                <input name="upload2[]" type="file" multiple="multiple" class="custom-file"/>
                                <input type = 'text' name = 'arquivo2' class="form-control" placeholder= "Nomeie o arquivo">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="width: 15%; margin-left: 2.2%">
                        <div class="file-field">
                            <div class="btn btn btn-success btn-sm b">
                                <input name="upload3[]" type="file" multiple="multiple" class="custom-file"/>
                                <input type = 'text' name = 'arquivo3' class="form-control" placeholder= "Nomeie o arquivo">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                
                <button type="submit" class="btn btn-success" style="width: 8%; height: 50px; margin-left: 41.7%">Salvar</button>
                <br><br>
            </form>
            </div>
            <!-- Verifica os campos responsáveis para determinar o preço do lead automaticamente -->
            <script src="./js/escutarPrecoLead.js"></script>
            
            <?php require_once "footer.php";?>
        </body>
    </html>
