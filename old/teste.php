<?php header("Cache-Control: no-cache, must-revalidate");

    include 'connections.php';
    include 'session.php';
    
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    
    $id = $_GET['id'];
    $usuario= $_SESSION['colaborador'];


    $pesq = $pdo->prepare("
        SELECT `dtmInicio`, `dtmFim`, `motivoContato`, `assunto`, `contatoNome`, 
        `dddContato`, `telefoneContato`, `emailContato`, `tipoCliente`, `uf`, `cidade`, 
        `bairro`, `logradouro`, `numero`, `complemento`, `cep`, `qtdPiscinas`, `volume`, 
        `visitasSemanais`, `produtosInclusos`, `primeiroAtendimento`, `detalhes`, `ganhador`, `statusConversao` 
        FROM `leads` WHERE id = :id");
                                        
    $pesq->bindValue(':id', $id);
    $pesq->execute();
    $values = $pesq->fetchAll();
    
    $linha = $values[0];
            
    $dtmInicio = strftime('%A, %d/%m/%y %H:%M', strtotime($linha["dtmInicio"]));
    $dtmFim = strftime('%A, %d/%m/%y %H:%M', strtotime($linha["dtmFim"]));
    $motivoContato = $linha["motivoContato"];
    $primeiroAtendimento = $linha["primeiroAtendimento"];

    $contatoNome = $linha["contatoNome"];
    $emailContato = $linha["emailContato"];
    $dddContato = $linha["dddContato"];
    $telefoneContato = $linha["telefoneContato"];
    $uf= $linha["uf"];
    $cidade= $linha["cidade"];
    $bairro = $linha["bairro"];
    $logradouro = $linha["logradouro"];
    $numero = $linha["numero"];
    $cep = $linha["cep"];
    $complemento = $linha["complemento"];
    $assunto = $linha["assunto"];
    $tipoCliente = $linha["tipoCliente"];
    $qtdPiscinas = $linha["qtdPiscinas"];
    $volume = $linha["volume"];
    $visitasSemanais = $linha["visitasSemanais"];
    $produtosInclusos = $linha["produtosInclusos"];
    $detalhes = $linha["detalhes"];
    $ganhador = $linha["ganhador"];
    $anexos = $linha["anexos"];
    $statusConversao = $linha["statusConversao"];


    $pesqArquivos = $pdo->prepare("
        SELECT id_fk, qtd, extensao, nome
        FROM arquivos
        WHERE tipo= 'lead'
        AND id_fk = :id");
                                        
    $pesqArquivos->bindValue(':id', $id);
    $pesqArquivos->execute();
    $valuesArquivos = $pesqArquivos->fetchAll();
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lead</title>
        <?php require_once "head.php"; ?>
        <style>
            .propostaBtn {
                    font-size: 22px;
                    width: 30%;
                    margin-left: 35%;
                    height: 60px;
                    border-radius: 5px;
                    background-color: #2d8dc9;
                    border: 2px solid #002941;
                    color: #002941;
                    font-weight: bold;
                }
                
                .cancelPropostaBtn {
                    font-size: 22px;
                    width: 30%;
                    margin-left: 35%;
                    height: 60px;
                    border-radius: 5px;
                    border: 2px solid #002941;
                    color: #002941;
                    font-weight: bold;
                    background-color: #94cf1c;
                    border-bottom: none;
                    border-bottom-left-radius: 0px;
                    border-bottom-right-radius: 0px;
                }
                .clientBtn{
                    font-size: 22px;
                    width: 50%;
                    /* margin-left: 35%; */
                    height: 60px;
                    border-radius: 5px;
                    background-color: #2d8dc9;
                    border: 2px solid #002941;
                    color: #002941;
                    font-weight: bold;
                    margin-bottom: 20px;
                }
            @media screen and (max-width: 1000px){

                .propostaBtn {
                    font-size: 22px;
                    width: 96%;
                    margin-left: 2%;
                    height: 60px;
                    border-radius: 5px;
                    background-color: #2d8dc9;
                    border: 2px solid #002941;
                    color: #002941;
                    font-weight: bold;
                }
                
                .cancelPropostaBtn {
                    font-size: 22px;
                    width: 96%;
                    margin-left: 2%;
                    height: 60px;
                    border-radius: 5px;
                    border: 2px solid #002941;
                    color: #002941;
                    font-weight: bold;
                    background-color: #94cf1c;
                    border-bottom: none;
                    border-bottom-left-radius: 0px;
                    border-bottom-right-radius: 0px;
                }
                .clientBtn{
                    font-size: 22px;
                    width: 96%;
                    margin-left: 2%;
                    height: 60px;
                    border-radius: 5px;
                    background-color: #2d8dc9;
                    border: 2px solid #002941;
                    color: #002941;
                    font-weight: bold;
                }
            }
        </style>
        <script>
            function exibeProposta() {
                document.getElementById('proposta').style.display = 'block';
                document.getElementById('propostaBtn').style.display = 'none';
                document.getElementById('cancelPropostaBtn').style.display = 'block'
            }

            function ocultaProposta() {
                document.getElementById('proposta').style.display = 'none';
                document.getElementById('propostaBtn').style.display = 'block';
                document.getElementById('cancelPropostaBtn').style.display = 'none'
            }
        </script>
    </head>
<?php 
    if($ganhador == $usuario){
        echo "
    
    <body >
             require_once navbar.php
            <div>
                require_once subFormLead.php;
            </div>
            <br>
            <input type='hidden' id='statusConversao' value='$statusConversao'>
        <!-- <div>
            <button id='propostaBtn' class='propostaBtn' onclick='exibeProposta()'>Proposta comercial</button>
            <button id='cancelPropostaBtn' class='cancelPropostaBtn' style='display: none' onclick='ocultaProposta()'>Proposta comercial</button>
        </div> -->
        <br>
        <!-- <div style='display: none' id='proposta'>
            <?php // require_once 'subFormProposta.php'; ?>
        </div> -->
        <div style='text-align: center; width: 80%; margin-left: 10%;'>
            <form method=post enctype='multipart/form-data' action='cadastrando_leadCliente'>
                <input type='hidden' name='idLead' value='$id'>
                <input type='hidden' name='proposta' value='aceita'>
                <button id='acceptBtn' class='clientBtn'>Proposta aceita!</button>
            </form>
        </div>
        <div style='text-align: center; width: 60%; margin-left: 20%;'>
            <form method=post enctype='multipart/form-data' action='cadastrando_leadCliente'>
                <input type='hidden' name='idLead' value='$id'>
                <input type='hidden' name='proposta' value='recusada'>
                <button id='refusedBtn' class='clientBtn' style='background-color: red; color: lightgray'>Proposta recusada!</button>
            </form>
        </div>
        
        <br>
        <?php require_once 'footer.php'; ?>
    </body>";

    }else{
            $opcaoDeEnvio = 'log';
            $titulo = "Autenticando...";
            $tempo = 2000;
            require_once "autenticando.php";
    }
?>
    <script>
        var statusConversao = document.getElementById('statusConversao').value

        if(statusConversao != ''){
            var acceptBtn = document.getElementById('acceptBtn');
            var refusedBtn = document.getElementById('refusedBtn');

            acceptBtn.style.display = 'none';
            refusedBtn.style.display = 'none';
        }else{
            acceptBtn.style.display = 'block';
            refusedBtn.style.display = 'block';
        }
    </script>
</html>