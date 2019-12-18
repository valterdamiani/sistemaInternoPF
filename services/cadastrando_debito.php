<?php
include 'connections.php';
include 'sessionFranqueado.php';

$setTimeZone = $pdo->prepare("
    SET time_zone='America/Sao_Paulo'");
$setTimeZone->execute();

$usuario= $_SESSION['colaborador'];
$idLead = $_POST['idLead'];
$precoLead= $_POST['precoLead'];

$saldo = $pdo->prepare("
            SELECT usuario_fk, saldoCredito
            FROM creditosLead
            WHERE usuario_fk = :usuario
            ORDER BY usuario_fk ASC
            ");
            
        $saldo->bindValue(':usuario', $usuario);
        
        $saldo->execute();
        $values = $saldo->fetchAll();
        $data = $values[0];

        
        $usuario_fk= $data['usuario_fk'];
        $saldoCredito= $data['saldoCredito'];

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

// ############ criação do debito ######### criação do debito  ######### criação do debito  ######### criação do debito  ######### criação do debito  ######### criação do debito  #########

if($usuario == $usuario_fk){
    // $tipo = 'debito';
    if($adimplencia == 'Quite'){  
        if($saldoCredito >= $precoLead){
            $saldoJaDebitado = $saldoCredito - $precoLead;  

            // ############ criação do debito #########      

            $sql = $pdo->prepare("
            UPDATE creditosLead
            SET dtm= NOW(), 
            saldoCredito= :saldoJaDebitado, 
            responsavel= :usuario
            WHERE usuario_fk = :usuario
            ");
                $sql->bindValue(':usuario_fk', $usuario_fk);
                $sql->bindValue(':saldoJaDebitado', $saldoJaDebitado);
                $sql->bindValue(':usuario', $usuario);
                $sql->execute();    

            // ##### atualização do status do lead ####        
            $leads = $pdo->prepare("
            UPDATE leads
            SET statusDisputa= 'distribuido', 
            ganhador= :usuario_fk,
            disparoEmail = 'nao'
            WHERE id = :idLead
            ");
                $leads->bindValue(':usuario_fk', $usuario_fk);
                $leads->bindValue(':idLead', $idLead);
                $leads->execute();    

            // ############ criação de log ############
            $tipo = 'debito';

            $log = $pdo->prepare(" 
                INSERT INTO logCredito
                (dtm, usuario_fk, responsavel, saldoAnterior, creditoDebito, saldoAtual , tipo, id_fk)
                VALUES (NOW(), :usuario_fk, :responsavel, :saldoAnterior, :creditoDebito,  :saldoAtual, :tipo, :id_fk)");
                
                $log->bindValue(':usuario_fk', $usuario_fk);
                $log->bindValue(':responsavel', $usuario);
                $log->bindValue(':saldoAnterior', $saldoCredito);
                $log->bindValue(':creditoDebito', $precoLead);
                $log->bindValue(':saldoAtual', $saldoJaDebitado);
                $log->bindValue(':tipo', $tipo);
                $log->bindValue(':id_fk', $idLead);
                $log->execute();  

            $opcaoDeEnvio = "meusLeads";
            $titulo = "Autenticando...";
            $tempo = 3000;
            require_once "autenticando.php";

        }else{
            $tipo = 'tentativaDebito';

            $log = $pdo->prepare(" 
            INSERT INTO logCredito
            (dtm, usuario_fk, responsavel, saldoAnterior, creditoDebito, saldoAtual , tipo, id_fk)
            VALUES (NOW(), :usuario_fk, :responsavel, :saldoAnterior, :creditoDebito,  :saldoAtual, :tipo, :id_fk)");
            
                $log->bindValue(':usuario_fk', $usuario_fk);
                $log->bindValue(':responsavel', $usuario);
                $log->bindValue(':saldoAnterior', $saldoCredito);
                $log->bindValue(':creditoDebito', $precoLead);
                $log->bindValue(':saldoAtual', $saldoCredito);
                $log->bindValue(':tipo', $tipo);
                $log->bindValue(':id_fk', $idLead);
                $log->execute();  


            $opcaoDeEnvio = "leads";
            $titulo = "Autenticando...";
            $tempo = 3000;
            require_once "autenticando.php";
        }
    }else{
            $tipo = 'inadimplente';

                $log = $pdo->prepare(" 
                INSERT INTO logCredito
                (dtm, usuario_fk, responsavel, saldoAnterior, creditoDebito, saldoAtual , tipo, id_fk)
                VALUES (NOW(), :usuario_fk, :responsavel, :saldoAnterior, :creditoDebito,  :saldoAtual, :tipo, :id_fk)");
                
                    $log->bindValue(':usuario_fk', $usuario_fk);
                    $log->bindValue(':responsavel', $usuario);
                    $log->bindValue(':saldoAnterior', $saldoCredito);
                    $log->bindValue(':creditoDebito', $precoLead);
                    $log->bindValue(':saldoAtual', $saldoCredito);
                    $log->bindValue(':tipo', $tipo);
                    $log->bindValue(':id_fk', $idLead);
                    $log->execute();  

            $opcaoDeEnvio = "leads";
            $titulo = "Autenticando...";
            $tempo = 1000;
            require_once "autenticando.php";
    }
}else{
    // caso o usuario que tente realizar a compra não conste na lista de franqueados, ele será redirecionado para realizar o login novamente e registrará nos logs como acesso negado

    $tipo = 'acessoNegado';

        $log = $pdo->prepare(" 
        INSERT INTO logCredito
        (dtm, usuario_fk, responsavel, saldoAnterior, creditoDebito, saldoAtual , tipo, id_fk)
        VALUES (NOW(), :usuario_fk, :responsavel, :saldoAnterior, :creditoDebito,  :saldoAtual, :tipo, :id_fk)");
        
            $log->bindValue(':usuario_fk', $usuario_fk);
            $log->bindValue(':responsavel', $usuario);
            $log->bindValue(':saldoAnterior', $saldoCredito);
            $log->bindValue(':creditoDebito', $precoLead);
            $log->bindValue(':saldoAtual', $saldoCredito);
            $log->bindValue(':tipo', $tipo);
            $log->bindValue(':id_fk', $idLead);
            $log->execute();  

    $opcaoDeEnvio = "log";
    $titulo = "Autenticando...";
    $tempo = 1000;
    require_once "autenticando.php";
}
?>