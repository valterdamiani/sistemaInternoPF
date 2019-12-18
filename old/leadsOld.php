<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'session.php';
    
    
    $tipo= $_GET['tipo'];
    $usuario= $_SESSION['colaborador'];

    if (isset($_POST['locate_codigo']) && !empty($_POST['locate_codigo'] && $_POST['locate_codigo']) !=null){
        $locate_codigo = $_POST['locate_codigo'];
        $filtraCodigo = " AND locate('" . $locate_codigo . "',id)>0";
    }
    
    if (isset($_POST['initial_date']) && !empty($_POST['initial_date'] && $_POST['initial_date']) !=null){
        $initial_date = $_POST['initial_date'];
        $filtraInicio = " AND dtmInicio >= '" . $initial_date . "'";
    }
    
    if (isset($_POST['final_date']) && !empty($_POST['final_date'] && $_POST['final_date']) !=null){
        $final_date = $_POST['final_date'];
        $filtraFim = " AND dtmInicio <= '" . $final_date . " 23:59:59'";
    }
    
    if (isset($_POST['locate_assunto']) && !empty($_POST['locate_assunto'] && $_POST['locate_assunto']) !=null){
        $locate_assunto = $_POST['locate_assunto'];
        $filtraAssunto = " AND locate('" . $locate_assunto . "',assunto)>0";
    }

    if (isset($_POST['locate_uf']) && !empty($_POST['locate_uf']) && $_POST['locate_uf'] !=null && $_POST['locate_uf'] !='Todos'){
        $locate_uf = $_POST['locate_uf'];
        $filtraUf = " AND uf = '" . $locate_uf . "'";
    }else{
        $locate_uf='Todos';
    }

    if (isset($_POST['locate_cidade']) && !empty($_POST['locate_cidade'] && $_POST['locate_cidade']) !=null){
        $locate_cidade = $_POST['locate_cidade'];
        $filtraCidade = " AND locate('" . $locate_cidade . "',cidade)>0";
    }
    
    if (isset($_POST['locate_tipoCliente']) && !empty($_POST['locate_tipoCliente']) && $_POST['locate_tipoCliente'] !=null && $_POST['locate_tipoCliente'] !='Todos'){
        $locate_tipoCliente = $_POST['locate_tipoCliente'];
        $filtraTipoCliente = " AND tipoCliente = '" . $locate_tipoCliente . "'";
    }else{
        $locate_tipoCliente='Todos';
    }

    if (isset($_POST['locate_produtosInclusos']) && !empty($_POST['locate_produtosInclusos']) && $_POST['locate_produtosInclusos'] !=null && $_POST['locate_produtosInclusos'] !='Todos'){
        $locate_produtosInclusos = $_POST['locate_produtosInclusos'];
        $filtraProdutosInclusos = " AND produtosInclusos = '" . $locate_produtosInclusos . "'";
    }else{
        $locate_produtosInclusos ='Todos';
    }

    // consulta nas tabelas LEADS e SOLICITACOESLEAD

    $pesq = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $pesq->execute();

    $pesq = $pdo->prepare("
        SELECT `id`, `dtmInicio`, `dtmFim`, `motivoContato`, `assunto`, `uf`, `cidade`, `bairro`, `tipoCliente`, `qtdPiscinas`, `volume`, `visitasSemanais`, `produtosInclusos`, `detalhes`, `statusDisputa`, `ganhador`, `statusConversao`, `leads`.`id`, `solicitado`, IF(NOW()>`dtmFim`, 'Sim', 'Não') AS distribuir
        FROM `leads`
        LEFT JOIN (SELECT solicitacoesLead.lead_fk AS solicitado, lead_fk FROM solicitacoesLead WHERE solicitante_fk = :usuario) AS solicitacoesLeadTemporaria ON `leads`.`id` = `solicitacoesLeadTemporaria`.`lead_fk` 
        WHERE id >0 " .

        $filtraCodigo . 
        $filtraInicio .
        $filtraFim . 
        $filtraAssunto . 
        $filtraUf  . 
        $filtraCidade . 
        $filtraTipoCliente . 
        $filtraProdutosInclusos . " 
        ORDER BY dtmInicio ASC");

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
        // $adimplencia = "Inadimplênte";

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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Leads</title>
        <?php require_once "head.php"; ?>
    </head>
    <body>
        <?php require_once "navbar.php"; ?>
        <form class="form-container" method=post enctype="multipart/form-data">
            <div class="row col-sm-10 col-lg-12">
                <div class="col-sm-10 col-lg-4">
                    <h3 class="naMesmaLinha">Leads</h3>
                </div>
            </div>
        </form>
    <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="2.5%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#codigo'>Nº</button></th>
                    <th width="4%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#inicio'>Início</button></th>
                    <th width="7%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#assunto'>Assunto</button></th>
                    <th width="2.5%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#uf'>UF</button></th>
                    <th width="7%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#cidade'>Cidade</button></th>
                    <th width="7%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#Bairro'>Bairro</button></th>
                    <th width="5.5%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#tipoCliente'>Tipo Cliente</button></th>
                    <th width="3.5%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#qtdPiscinas'>Piscinas</button></th>
                    <th width="3%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#volumeTotal'>M³</button></th>
                    <th width="5%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#produtosInclusos'>Produtos</button></th>
                    <th width="4%"><i type="submit" onclick="location.href='novoLead'" class="btn btn-primary material-icons">add_box</i></th>
                </tr>
            </thead>
        <tbody>
<?php
    
    echo "<!-- Modal -->
        <div class='modal fade' id='codigo' tabindex='-1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h3>Código</h3>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class: 'form-container' method=post enctype='multipart/form-data'>
                            <div class='form-group col-md-12'>
                                <label>Digite o código do contrato</label>
                                <div>
                                    <label>Código:</label>
                                    <input type='number' class='form-control' name = 'locate_codigo' id='locate_codigo' value='" . $locate_codigo . "' >
                                </div>
                                <input type='hidden' name='initial_date' value='" . $initial_date . "'>
                                <input type='hidden' name='final_date' value='" . $final_date . "'>
                                <input type='hidden' name='locate_assunto' value='" . $locate_assunto . "'>
                                <input type='hidden' name='locate_uf' value='" . $locate_uf . "'>
                                <input type='hidden' name='locate_cidade' value='" . $locate_cidade . "'>
                                <input type='hidden' name='locate_tipoCliente' value='" . $locate_tipoCliente . "'>
                                <input type='hidden' name='locate_produtosInclusos' value='" . $locate_produtosInclusos . "'>
                            </div>
                            <button type='submit' class='btn btn-primary'>Confirmar</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    
    echo "<!-- Modal -->
        <div class='modal fade' id='inicio' tabindex='-1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h3>Data de Início</h3>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class: 'form-container' method=post enctype='multipart/form-data'>
                            <div class='form-group col-md-12'>
                                <label>Filtre a data do início:</label>
                                <div>
                                    <label>De:</label>
                                    <input type='date' class='form-control' name = 'initial_date' id='initial_date' value='" . $initial_date . "' >
                                </div>
                                <div>
                                    <label>Até:</label>
                                    <input type='date' class='form-control' name = 'final_date' id='final_date' value='" . $final_date . "' > 
                                </div>
                                
                                <input type='hidden' name='locate_codigo' value='" . $locate_codigo . "'>
                                <input type='hidden' name='locate_assunto' value='" . $locate_assunto . "'>
                                <input type='hidden' name='locate_uf' value='" . $locate_uf . "'>
                                <input type='hidden' name='locate_cidade' value='" . $locate_cidade . "'>
                                <input type='hidden' name='locate_tipoCliente' value='" . $locate_tipoCliente . "'>
                                <input type='hidden' name='locate_produtosInclusos' value='" . $locate_produtosInclusos . "'>

                            </div>
                            <button type='submit' class='btn btn-primary'>Confirmar</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

    echo "<!-- Modal -->
        <div class='modal fade' id='assunto' tabindex='-1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h3>Assunto</h3>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class: 'form-container' method=post enctype='multipart/form-data'>
                            <div class='form-group col-md-12'>
                                <label>Digite parte do assunto de interesse</label>
                                <div>
                                    <label>Assunto:</label>
                                    <input type='text' class='form-control' name = 'locate_assunto' id='locate_assunto' value='" . $locate_assunto . "' >
                                </div>
                                <input type='hidden' name='locate_codigo' value='" . $locate_codigo . "'>
                                <input type='hidden' name='initial_date' value='" . $initial_date . "'>
                                <input type='hidden' name='final_date' value='" . $final_date . "'>
                                <input type='hidden' name='locate_uf' value='" . $locate_uf . "'>
                                <input type='hidden' name='locate_cidade' value='" . $locate_cidade . "'>
                                <input type='hidden' name='locate_tipoCliente' value='" . $locate_tipoCliente . "'>
                                <input type='hidden' name='locate_produtosInclusos' value='" . $locate_produtosInclusos . "'>
                            </div>
                            <button type='submit' class='btn btn-primary'>Confirmar</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

    echo "<!-- Modal -->
        <div class='modal fade' id='uf' tabindex='-1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h3>Unidade Federativa</h3>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class: 'form-container' method=post enctype='multipart/form-data'>
                            <div class='form-group col-md-12'>
                                <label>Selecione uma UF:</label>
                                <div>
                                    <select name='locate_uf' id='locate_uf' class='form-control'>
                                        <option value='" . $locate_uf. "'>" . $locate_uf . "</option>
                                        <option value='Todos'>Todos</option>
                                        <option value= 'AC'>AC</option>
                                        <option value= 'AL'>AL</option>
                                        <option value= 'AM'>AM</option>
                                        <option value= 'AP'>AP</option>
                                        <option value= 'BA'>BA</option>
                                        <option value= 'CE'>CE</option>
                                        <option value= 'DF'>DF</option>
                                        <option value= 'ES'>ES</option>
                                        <option value= 'GO'>GO</option>
                                        <option value= 'MA'>MA</option>
                                        <option value= 'MG'>MG</option>
                                        <option value= 'MS'>MS</option>
                                        <option value= 'MT'>MT</option>
                                        <option value= 'PA'>PA</option>
                                        <option value= 'PB'>PB</option>
                                        <option value= 'PE'>PE</option>
                                        <option value= 'PI'>PI</option>
                                        <option value= 'PR'>PR</option>
                                        <option value= 'RJ'>RJ</option>
                                        <option value= 'RN'>RN</option>
                                        <option value= 'RO'>RO</option>
                                        <option value= 'RR'>RR</option>
                                        <option value= 'RS'>RS</option>
                                        <option value= 'SC'>SC</option>
                                        <option value= 'SE'>SE</option>
                                        <option value= 'SP'>SP</option>
                                        <option value= 'TO'>TO</option>
                                    </select>  
                                </div>
                                <input type='hidden' name='locate_codigo' value='" . $locate_codigo . "'>
                                <input type='hidden' name='initial_date' value='" . $initial_date . "'>
                                <input type='hidden' name='final_date' value='" . $final_date . "'>
                                <input type='hidden' name='locate_assunto' value='" . $locate_assunto . "'>
                                <input type='hidden' name='locate_cidade' value='" . $locate_cidade . "'>
                                <input type='hidden' name='locate_tipoCliente' value='" . $locate_tipoCliente . "'>
                                <input type='hidden' name='locate_produtosInclusos' value='" . $locate_produtosInclusos . "'>
                            </div>
                            <button type='submit' class='btn btn-primary'>Confirmar</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    
    

    echo "<!-- Modal -->
        <div class='modal fade' id='cidade' tabindex='-1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h3>Cidade</h3>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class: 'form-container' method=post enctype='multipart/form-data'>
                            <div class='form-group col-md-12'>
                                <label>Digite parte do nome da cidade</label>
                                <div>
                                    <label>Cidade:</label>
                                    <input type='text' class='form-control' name = 'locate_cidade' id='locate_cidade' value='" . $locate_cidade . "' >
                                </div>
                                <input type='hidden' name='locate_codigo' value='" . $locate_codigo . "'>
                                <input type='hidden' name='initial_date' value='" . $initial_date . "'>
                                <input type='hidden' name='final_date' value='" . $final_date . "'>
                                <input type='hidden' name='locate_assunto' value='" . $locate_assunto . "'>
                                <input type='hidden' name='locate_uf' value='" . $locate_uf . "'>
                                <input type='hidden' name='locate_tipoCliente' value='" . $locate_tipoCliente . "'>
                                <input type='hidden' name='locate_produtosInclusos' value='" . $locate_produtosInclusos . "'>
                            </div>
                            <button type='submit' class='btn btn-primary'>Confirmar</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

    echo "<!-- Modal -->
        <div class='modal fade' id='tipoCliente' tabindex='-1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h3>Clientes</h3>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class: 'form-container' method=post enctype='multipart/form-data'>
                            <div class='form-group col-md-12'>
                                <label>Selecione um tipo de cliente:</label>
                                <div>
                                    <select name='locate_tipoCliente' id='locate_tipoCliente' class='form-control'>
                                        <option value='" . $locate_tipoCliente. "'>" . $locate_tipoCliente . "</option>
                                        <option value= ''>Selecione o tipo de Cliente</option>
                                        <option value= 'Residencia'>Residêncial</option>
                                        <option value= 'Condominio'>Condomínio</option>
                                        <option value= 'Clube' Recreativo>Clube Recreativo</option>
                                        <option value= 'Academia'>Academia</option>
                                        <option value= 'Clinica'>Clínica </option>
                                        <option value= 'Escola'>Escola </option>
                                    </select>  
                                </div>
                                <input type='hidden' name='locate_codigo' value='" . $locate_codigo . "'>
                                <input type='hidden' name='initial_date' value='" . $initial_date . "'>
                                <input type='hidden' name='final_date' value='" . $final_date . "'>
                                <input type='hidden' name='locate_assunto' value='" . $locate_assunto . "'>
                                <input type='hidden' name='locate_uf' value='" . $locate_uf . "'>
                                <input type='hidden' name='locate_cidade' value='" . $locate_cidade . "'>
                                <input type='hidden' name='locate_produtosInclusos' value='" . $locate_produtosInclusos . "'>
                            </div>
                            <button type='submit' class='btn btn-primary'>Confirmar</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

    echo "<!-- Modal -->
        <div class='modal fade' id='produtosInclusos' tabindex='-1' role='dialog' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h3>Produtos Inclusos</h3>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class: 'form-container' method=post enctype='multipart/form-data'>
                            <div class='form-group col-md-12'>
                                <label>Produtos inclusos:</label>
                                <div>
                                    <select name='locate_produtosInclusos' id='locate_produtosInclusos' class='form-control'>
                                        <option value='" . $locate_produtosInclusos. "'>" . $locate_produtosInclusos . "</option>
                                        <option value= 'Sim'>Sim</option>
                                        <option value= 'Não'>Não</option>
                                    </select>  
                                </div>
                                <input type='hidden' name='locate_codigo' value='" . $locate_codigo . "'>
                                <input type='hidden' name='initial_date' value='" . $initial_date . "'>
                                <input type='hidden' name='final_date' value='" . $final_date . "'>
                                <input type='hidden' name='locate_assunto' value='" . $locate_assunto . "'>
                                <input type='hidden' name='locate_uf' value='" . $locate_uf . "'>
                                <input type='hidden' name='locate_cidade' value='" . $locate_cidade . "'>
                                <input type='hidden' name='locate_tipoCliente' value='" . $locate_tipoCliente . "'>
                            </div>
                            <button type='submit' class='btn btn-primary'>Confirmar</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

    foreach($valuesContratos as $linha) {
        
        if(!is_null($linha["dtmFim"])){
            $dtmFim = strftime('%d/%m %H:%M', strtotime($linha["dtmFim"]));
        }else{
            $dtmFim = NULL;
        }
        
        $id= $linha["id"];
        $distribuir= $linha["distribuir"];

        $dtmInicio= strftime('%d/%m %H:%M', strtotime($linha["dtmInicio"]));
        $assunto = $linha["assunto"];
        $uf = $linha["uf"];
        $cidade = $linha["cidade"];
        $bairro = $linha["bairro"];
        $tipoCliente = $linha["tipoCliente"];
        $qtdPiscinas = $linha["qtdPiscinas"];
        $volume = $linha["volume"];
        $visitasSemanais = $linha["visitasSemanais"];
        $produtosInclusos = $linha["produtosInclusos"];
        $leadId= $linha['solicitado'];
        $solicitante = $linha['solicitante'];
        $statusDisputa = $linha['statusDisputa'];
        $statusLead = $linha['$statusConvercao'];
        $ganhador = $linha['ganhador'];

        echo "  
            <tr>
                <td style='text-align:center; vertical-align:middle'>" . $id . "</td>
                <td style='text-align:center; vertical-align:middle'>" . utf8_encode ($dtmInicio) . "</td>
                <td style='text-align:center; vertical-align:middle'>" . $assunto . "</td>
                <td style='text-align:center; vertical-align:middle'>" . $uf . "</td>
                <td style='text-align:center; vertical-align:middle'>" . $cidade . "</td>
                <td style='text-align:center; vertical-align:middle'>" . $bairro . "</td>
                <td style='text-align:center; vertical-align:middle'>" . $tipoCliente . "</td>
                <td style='text-align:center; vertical-align:middle'>" . $qtdPiscinas . "</td>
                <td style='text-align:center; vertical-align:middle'>" . $volume . "</td>
                <td style='text-align:center; vertical-align:middle'>" . $produtosInclusos . "</td>";
             

        echo "<!-- Modal -->
            <div class='modal fade' id='solicitarLead" . $id ."' tabindex='-1' role='dialog' aria-hidden='true' >
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h2>Solicitar Lead" . ' ' . $id . "</h2>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <form class:='form-container' method=post enctype='multipart/form-data' action='cadastrando_solicitacao'>
                                <div style='text-align: center;' class='form-group col-md-12'>
                                    <label>Tem certeza que deseja solicitar esse Lead?</label>
                                </div>
                                <input type='hidden' name='id' value='" . $id . "'>
                                <div style='text-align: center;'>
                                    <button type='submit' class='btn btn-success' style='width:25%; height: 50px; font-size: 18px;'>Solicitar</button>
                                    <button type='button' class='btn btn-danger' style='width:25%; height: 50px; font-size: 18px;' data-dismiss='modal'>Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";

        echo "<!-- Modal -->
            <div class='modal fade' id='leadSolicitado" . $id ."' tabindex='-1' role='dialog' aria-hidden='true' >
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h2>Lead solicitado" . ' ' . $id . "</h2>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <form class:='form-container' method=post enctype='multipart/form-data' action='cadastrando_solicitacao'>
                                <div style='text-align: center;' class='form-group col-md-12'>
                                    <label>Você já solicitou esse Lead. o resultado estará disponivel em $dtmFim </label>
                                </div>
                                <input type='hidden' name='id' value='" . $id . "'>
                                <div style='text-align: center;'>
                                    <button type='button' class='btn btn-danger' style='width:25%; height: 50px; font-size: 18px;' data-dismiss='modal'>Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";

        echo "<!-- Modal -->
            <div class='modal fade' id='inadimplente" . $id ."' tabindex='-1' role='dialog' aria-hidden='true' >
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h2>Restrição</h2>
                        </div>
                        <div class='modal-body'>
                            <form class:='form-container' method=post enctype='multipart/form-data'>
                                <div style='text-align: center;' class='form-group col-md-12'>
                                    <label>Foi identificada uma restrição em seu cadastro, entre em contato com o setor financeiro, (48) 3112-1512, para regularizar a situação!</label>
                                </div>
                                <input type='hidden' name='id' value='" . $id . "'>
                                <div style='text-align: center;'>
                                    <button type='button' class='btn btn-danger' style='width:25%; height: 50px; font-size: 18px;' data-dismiss='modal'>Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";


        echo "<!-- Modal -->
            <div class='modal fade' id='perdeu" . $id ."' tabindex='-1' role='dialog' aria-hidden='true' >
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h2>Esse Lead não é seu</h2>
                        </div>
                        <div class='modal-body'>
                            <form class:='form-container' method=post enctype='multipart/form-data'>
                                <div style='text-align: center;' class='form-group col-md-12'>
                                    <label>
                                        Infelizmente outro franqueado já ganhou esse lead!
                                    </label>
                                </div>
                                <input type='hidden' name='id' value='" . $id . "'>
                                <div style='text-align: center;'>
                                    <button type='button' class='btn btn-danger' style='width:25%; height: 50px; font-size: 18px;' data-dismiss='modal'>Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";


        if($statusDisputa == 'distribuido'){
            if($ganhador == $usuario){
                $corBtn = 'success';
                $mensagemBotao = 'Ver Lead!';
                $destino = "onclick=window.location.href='meusLeads'";
            }else{
                $corBtn = 'dark';
                $mensagemBotao = 'Lead distribuido!';
                $destino = " data-toggle='modal' data-target='#perdeu" . $id . "'";               
            }
        }elseif($id === $leadId){
            $mensagemBotao = 'Já solicitei!';
            $corBtn = 'secondary';
            $destino = " data-toggle='modal' data-target='#leadSolicitado" . $id . "'";               
        }else{
            $mensagemBotao = 'Tenho Interesse!';
            $corBtn = 'primary';
            if($adimplencia ==='Inadimplênte'){
                $destino = " data-toggle='modal' data-target='#inadimplente" . $id . "'";               
            }else{
                $destino = " data-toggle='modal' data-target='#solicitarLead" . $id . "'";               
            }
        }

        if($distribuir == 'Sim'){
            $pesq = $pdo->prepare("
            SELECT  COUNT(solicitante_fk) AS interessados
            FROM `solicitacoesLead`
            INNER JOIN adimplenciaFranqueados ON adimplenciaFranqueados.franqueado_fk = solicitacoesLead.solicitante_fk
            WHERE lead_fk = :id 
            AND adimplenciaFranqueados.status = 'Quite'
            ");

            $pesq->bindValue(':id', $id);
            $pesq->execute();
            $values = $pesq->fetchAll();  
            
        //     if($values[0]['interessados'] > 0){

        //     }
        
        //     echo "
        //         Sim = " . $distribuir;
        // }else {
        //     echo "
        //         Não = " . $distribuir;
        };
        
        
?>
                <td style='vertical-align:middle'>
                    <button type='button' <?php echo $enviar; ?> class='btn btn-<?php echo $corBtn; ?> btn-sm btn-block' <?php echo $destino; ?>><?php echo $mensagemBotao; ?></button>
                </td>              
            </tr>
<?php
        }
?>
        </tbody>
        </table>
        <?php require_once "footer.php"; ?>
    </body>
</html>