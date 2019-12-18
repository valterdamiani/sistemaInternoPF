<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'session.php';
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    
    $tipo= $_GET['tipo'];
    
    $pesq = $pdo->prepare("
    SELECT colaboradores.id AS colaboradoresId, creditosLead.id AS creditosLeadId, creditosLead.dtm, usuario_fk, saldoCredito, responsavel, dataCompra, apelido
    FROM colaboradores
    LEFT JOIN creditosLead ON colaboradores.id = creditosLead.usuario_fk
    WHERE cargo= 'Franqueado'
    ORDER BY colaboradoresId ASC");
        
    $pesq->execute();
    $creditosLead = $pesq->fetchAll();
 ?>

<!DOCTYPE html>
<html>

<head>
    <title>Crédito Franqueados</title>
    <?php require_once "head.php"; ?>
</head>

<body>
    <?php require_once "navbar.php"; ?>
    <form class: "form-container" method=post enctype="multipart/form-data">
        <div class="row col-sm-10 col-lg-12">
            <div class="col-sm-10 col-lg-4">
                <h3 class="naMesmaLinha">Crédito Franqueados</h3>
            </div>
        </div>
    </form>
    <br>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <!-- <th width="10%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#codigo'>Nº</button></th> -->
                <th width="20%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#entrega'>Franqueado</button></th>
                <th width="20%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#data'>Ultima atualização</button></th>
                <th width="15%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#inicio'>Responsavel</button></th>
                <!-- <th width="10%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#inicio'>User</button></th> -->
                <th width="20%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#resumo'>Data da Compra</button></th>
                <th width="15%"><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#status'>Saldo</button></th>
                <th width="10%"></th>
            </tr>
        </thead>
        <tbody>

            <?php

    foreach($creditosLead as $linha) {
        if(!is_null($linha["dtm"])){
            $dtm= strftime('%d/%m/%y', strtotime($linha["dtm"]));
        }else{
            $dtm ='';
        }
        if(!is_null($linha["inicio"])){
            $inicio= strftime('%d/%m/%y', strtotime($linha["inicio"]));
        }else{
            $inicio ='';
        }
        $id= $linha["creditosLeadId"];
        $usuario_fk = $linha["colaboradoresId"];
        $saldoCredito = $linha["saldoCredito"];
        $responsavel = $linha["responsavel"];
        $dataCompra = $linha["dataCompra"];
        $franqueado = $linha["apelido"];

        echo "  
                <tr style='text-align: center;'>
                    <!-- <td style='vertical-align:middle'>" . $id . "</td> -->
                    <td style='vertical-align:middle'>" . $franqueado . "</td>
                    <td style='vertical-align:middle'>" . utf8_encode ($dtm) . "</td>
                    <td style='vertical-align:middle'>" . $responsavel . "</td>
                    <!-- <td style='vertical-align:middle'>" . $usuario_fk . "</td> -->
                    <td style='vertical-align:middle'>" . utf8_encode ($dataCompra) . "</td>
                    <td style='vertical-align:middle'>" . $saldoCredito . "</td>
                    <td><button type='button' class='btn btn-outline-warning btn-sm btn-block' data-toggle='modal' data-target='#creditar" . $usuario_fk . "'>Adicionar crédito</button></td>
                </tr>";
                
        echo "<!-- Modal -->
                <div class='modal fade' id='creditar" . $usuario_fk . "' tabindex='-1' role='dialog' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h3>Adicionar crédito</h3>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form class='form-container' method=post enctype='multipart/form-data' action='cadastrando_credito'>
                                    <div class='form-group col-md-12'>
                                        <div>
                                           <label>Adicionar mais credito ao usuario " . $franqueado . ' ' . $usuario_fk . "</label>
                                        </div>
                                        <br>
                                        <div>
                                            <label>Valor a ser creditado:</label>
                                            <input style='width: 60%; margin-left: 20%;' type='number' class='form-control' name='credito' required>
                                        </div>
                                        <div>
                                            <label>Data de compra:</label>
                                            <input style='width: 60%; margin-left: 20%;' type='date' class='form-control' name='dataCompra' required>
                                        </div>
                                        <br>
                                        <div>
                                            <label>Anexar comprovante:</label>
                                            <div class='form-group' style='width: 90%; margin-left: 5%; text-align: center;'>
                                                <div class='file-field'>
                                                    <div class='btn btn btn-success btn-sm b'>
                                                        <input name='upload1[]' type='file' multiple='multiple' class='custom-file'/>
                                                        <input type = 'text' name = 'arquivo2' class='form-control' placeholder= 'Nomeie o comprovante'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type='hidden' name='usuario_fk' value='" . $usuario_fk . "'>
                                        <input type='hidden' name='saldoAnterior' value='" . $saldoCredito . "'>
                                        <input type='hidden' name='idTransacao' value='" . $id . "'>
                                    </div>
                                    <div style='margin-top: 40px; text-align: center;'>
                                        <button type='submit' class='btn btn-primary'>Confirmar</button>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
                
        }
?>
        </tbody>
    </table>
    <?php require_once "footer.php"; ?>
</body>

</html>