<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'session.php';
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    
    $tipo= $_GET['tipo'];

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
    
    if (isset($_POST['locate_status']) && !empty($_POST['locate_status']) && $_POST['locate_status'] !=null && $_POST['locate_status'] !='Todos'){
        $locate_status = $_POST['locate_status'];
        $filtraStatus = " AND status = '" . $locate_status . "'";
    }else{
        $locate_status='Todos';
    }
    
    $pesq = $pdo->prepare("
        SELECT `id`, `dtmInicio`, `dtmFim`, `status`, `ganhador` 
        FROM `leads` 
        WHERE id >0 " .
        $filtraCodigo . 
        $filtraInicio .
        $filtraFim . 
        $status . 
        $ganhador ." 
        ORDER BY dtmInicio ASC");
        
    $pesq->execute();
    $valuesContratos = $pesq->fetchAll();
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Status Leads</title>
        <?php require_once "head.php"; ?>

    </head>
    <body>
        <?php require_once "navbar.php"; ?>
        <form class="form-container" method=post enctype="multipart/form-data">
            <div class="row col-sm-10 col-lg-12">
                <div class="col-sm-10 col-lg-4">
                    <h3 class="naMesmaLinha">Status Leads</h3>
                </div>
            </div>
        </form>
    <br>
        <table class="table table-striped table-hover" style="width: 40%;">
            <thead>
                <tr>
                    <th width="10%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#codigo'>Nº</button></th>
                    <th width="20%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#inicio'>Início</button></th>
                    <th width="30%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#status'>Status</button></th>
                    <th width="20%"><button type='button' class='btn btn-outline-primary dropdown-toggle' data-toggle='modal' data-target='#ganhador'>Ganhador</button></th>                    
                    <th width="20%"></th>
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
                                <input type='hidden' name='locate_produtosInclusos' value='" . $locate_status . "'>
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
                                <input type='hidden' name='locate_produtosInclusos' value='" . $locate_status . "'>

                            </div>
                            <button type='submit' class='btn btn-primary'>Confirmar</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

    echo "<!-- Modal -->
        <div class='modal fade' id='status' tabindex='-1' role='dialog' aria-hidden='true'>
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
                                    <select name='locate_status' id='locate_status' class='form-control'>
                                        <option value='" . $locate_status. "'>" . $locate_status . "</option>
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
        $dtmInicio= strftime('%d/%m %H:%M', strtotime($linha["dtmInicio"]));
        $status = $linha["status"];
        $ganhador = $linha["ganhador"];

        echo "  
            <tr>
                <td style='vertical-align:middle; text-align: center;width: 10%'>" . $id . "</td>
                <td style='vertical-align:middle; text-align: center;width: 20%'>" . utf8_encode ($dtmInicio) . "</td>
                <td style='vertical-align:middle; text-align: center;width: 30%'>" . $status . "</td>
                <td style='vertical-align:middle; text-align: center;width: 20%'>" .  $ganhador . "</td>";
             

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
?>
                <td style='vertical-align:middle'>
                    <button type='button' class='btn btn-outline-warning btn-sm btn-block' data-toggle='modal'>Editar Status</button>
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