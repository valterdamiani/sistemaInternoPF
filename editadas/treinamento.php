<?php header("Cache-Control: no-cache, must-revalidate"); 

    include 'connections.php';
    include 'sessionAluno.php';
    
    $_SESSION['jogo']=0;
    $_SESSION['exercicioResposta']=0;
    $_SESSION['contadorResposta']=0;
    $usuario = $_SESSION['colaborador'];
    
    $_SESSION['jogada']=0;
    $_SESSION['acertos']=0;

    $sql = $pdo->prepare("
        SELECT apelido, pontos, arquivo, qtd, extensao, nome
        FROM colaboradores
        LEFT JOIN (SELECT id AS arquivo, qtd, extensao, id_fk, nome FROM arquivos WHERE id_fk = :usuario and tipo = 'colaborador') AS arquivoTemp ON colaboradores.id = arquivoTemp.id_fk
        WHERE colaboradores.id = :usuario");
    $sql->bindValue(':usuario', $usuario);
    $sql->execute();
    $values = $sql->fetchAll();
    $apelido = $values[0]["apelido"];
    $moedas = $values[0]["pontos"];
    $qtd = $values[0]["qtd"];
    $extensao = $values[0]["extensao"];
    $nome = $values[0]["nome"];
    
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <title><?php echo $titulo; ?></title>
        <?php require_once "head.php"; ?>
        <?php require_once "voltarBlock.php"; ?>
        <style>
            .inline{
                display: inline-block;
            }
            .trofeu{
                width: 15%;
                text-align: right;
                margin-top: 12px;
                height: 30px;
            }
            .moedas{
                width: 15%;
                text-align: right;
                margin-top: 12px;
                height: 30px;
            }
        </style>
    </head>
    <body>
        <?php require_once "navbar.php"; ?>
        <div id="caixa-dados-usuario" class="caixaDadosUsuario">
            <p id="dados-usuario" class="dadosUsuario">
                <!-- Piscineiro -->
                <img width="20px" src="./imagens/img-treinamento/01-nome-05.svg" alt="icon-piscineiro" />
                <strong><?php echo $apelido; ?></strong><br>
                <!-- Moedas -->
                <img width="20px" src="./imagens/img-treinamento/02-moedas-12.svg" alt="icon-moedas" />&nbsp;<?php echo $moedas; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            </p>
        </div>
        <table class="treinamento_jogos_trofeu border_azul">
            <thead>
                <tr class="tr_table">
                    <th class="th_table" style="color: #FFF;">Jogos</th>
                    <th class="th_table" style="color: #FFF;">Troféus</th>
                    <th class="th_table" style="color: #FFF;" width="10%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style='vertical-align:middle'><img width="50px" src="./imagens/img-treinamento/03-piscineiro-profissional-04.svg" alt="icon-piscineiro-profissional" /> &nbsp; &nbsp; <strong>Piscineiro Profissional</strong></td>
                    <td class="align_center">
<?php

    $sql = $pdo->prepare("
        SELECT trofeu, COUNT(trofeu) AS qtd
        FROM trofeus
        WHERE usuario_fk = :usuario
        AND jogo_fk =1
        GROUP BY trofeu
        ORDER BY acertos DESC");
    $sql->bindValue(':usuario', $usuario);
    $sql->execute();
    $valuesTrofeu = $sql->fetchAll();
    
    foreach($valuesTrofeu as $linhaTrofeu) {
        $trofeu = $linhaTrofeu["trofeu"];
        if($trofeu == 'Joelho de Bronze'){
                $qtd = $linhaTrofeu["qtd"];
                $trofeu="<img width='35px' class='' src='./imagens/img-treinamento/07-cano-bronze-11.svg' alt='icon-joelho-bronze' />";
        }elseif($trofeu == 'Joelho de Prata'){
            $qtd = $linhaTrofeu["qtd"];
            $trofeu="<img width='35px' src='./imagens/img-treinamento/06-cano-prata-10.svg' alt='icon-joelho-prata' />";
        }elseif($trofeu == 'Joelho de Ouro'){
            $qtd = $linhaTrofeu["qtd"];
            $trofeu="<img width='35px' src='./imagens/img-treinamento/05-cano-ouro-09.svg' alt='icon-joelho-ouro' />";
        }
            
        echo
                        $qtd . "x " . $trofeu . " &nbsp; &nbsp; &nbsp; &nbsp;";
    }
?>
                    </td>
                    <td style="text-align: center;"><button type='button' class='btn-success btn-sm buttonJogar' style="text-transform: uppercase;" onclick="window.location.href = 'piscineiroProfissional';">Jogar</button></td>
                </tr>
                <!--
                <tr>
                    <td style='vertical-align:middle; '><img class="float_left" width="50px" src="./imagens/img-treinamento/04-exame-03.svg" alt="icon-exame" /><span class="span_tabela_jogos"><strong>Exame de Aproveitamento do Curso de Piscineiro Profissional</strong></span></td>
                    <td class="align_center">
<?php
    /*
    $sql = $pdo->prepare("
        SELECT trofeu, COUNT(trofeu) AS qtd
        FROM trofeus
        WHERE usuario_fk = :usuario
        AND jogo_fk =2
        GROUP BY trofeu
        ORDER BY acertos DESC");
    $sql->bindValue(':usuario', $usuario);
    $sql->execute();
    $valuesTrofeu = $sql->fetchAll();
    
    foreach($valuesTrofeu as $linhaTrofeu) {
        $trofeuManometro = $linhaTrofeu["trofeu"];
        if($trofeuManometro == 'Manômetro de Bronze'){
            $qtdManometro = $linhaTrofeu["qtd"];
            $trofeuManometro="<img width='35px' src='./imagens/img-treinamento/10-valvula-bronze-08.svg' alt='icon-manômetro-bronze' />";
        }elseif($trofeuManometro == 'Manômetro de Prata'){
            $qtdManometro = $linhaTrofeu["qtd"];
            $trofeuManometro="<img width='35px' src='./imagens/img-treinamento/09-valvula-prata-07.svg' alt='icon-manômetro-prata' />";
        }elseif($trofeuManometro == 'Manômetro de Ouro'){
            $qtdManometro = $linhaTrofeu["qtd"];
            $trofeuManometro="<img width='35px' src='./imagens/img-treinamento/08-valvula-ouro-06.svg' alt='icon-manômetro-ouro' />";
        }
            
        echo
                        $qtdManometro . "x " . $trofeuManometro . " &nbsp; &nbsp; &nbsp; &nbsp;";
    }
    */
?>
                    </td>
                    <td style="text-align: center;"><button type='button' class='btn-success btn-sm buttonJogar' style="text-transform: uppercase;" onclick="window.location.href = 'testeConhecimentosCurso';">Jogar</button></td>
                </tr>
                -->
            </tbody>
        </table>
        <br>
        <div class="width66">
        <div id="caixa-ranking" class="caixa-ranking float_left borderTL borderTR borderBL borderBR">
            <h3 class="h3_treinamento borderTL borderTR"><img class="icon_ranking" width="25px" src="./imagens/img-treinamento/11-ranking-13.svg" alt="icon-ranking" />Ranking</h3>
<?php

    $sql = $pdo->prepare("
        SELECT apelido, SUM(IF(trofeu='Joelho de Ouro',1,0)) AS ouro, SUM(IF(trofeu='Joelho de Prata',1,0)) AS prata, SUM(IF(trofeu='Joelho de Bronze',1,0)) AS bronze, pontos
        FROM colaboradores
        LEFT JOIN trofeus ON colaboradores.id = trofeus.usuario_fk
        GROUP BY colaboradores.id
        ORDER BY ouro DESC, prata DESC, bronze DESC, pontos DESC
        LIMIT 10");
    $sql->execute();
    $valuesRanking = $sql->fetchAll();

    $posicao=1;
    
    foreach($valuesRanking as $linhaRanking) {
        $apelido = $linhaRanking["apelido"];
        $ouro = $linhaRanking["ouro"];
        $prata = $linhaRanking["prata"];
        $bronze = $linhaRanking["bronze"];
        $moedas = $linhaRanking["pontos"];
        
        echo "
                                <div class='divComentario'>
                                    <div class='apelidoRank'><p class='naMesmaLinha'><strong>" . $posicao . "</strong>&nbsp;&nbsp; " . $apelido . "</p></div>&nbsp;&nbsp;
                                        <div class='infos_rank'>
                                            <div class='trofeu inline'>
                                                <p class='naMesmaLinha'>" . $ouro . "x <img width='25px' src='./imagens/img-treinamento/05-cano-ouro-09.svg' alt='icon-joelho-ouro' /></p>&nbsp;&nbsp;
                                            </div>
                                            <div class='trofeu inline'>
                                                <p class='naMesmaLinha'>" . $prata . "x <img width='25px' src='./imagens/img-treinamento/06-cano-prata-10.svg' alt='icon-joelho-prata' /></p>&nbsp;&nbsp;
                                            </div>
                                            <div class='trofeu inline'>
                                                <p class='naMesmaLinha'>" . $bronze . "x <img width='25px' src='./imagens/img-treinamento/07-cano-bronze-11.svg' alt='icon-joelho-bronze' /></p>&nbsp;&nbsp;
                                            </div>
                                            <div class='moedas inline'>
                                                <p class='naMesmaLinha'>" . $moedas . "x <img width='20px' src='./imagens/img-treinamento/02-moedas-12.svg' alt='icon-moedas' /></p>
                                            </div>
                                        </div>
                                </div>                              
                                ";
        $posicao=$posicao+1;
    }
?>
                </div>
                <div>
                    <img width="50%" src='./imagens/img-treinamento/12-jogador.png' alt='img-jogador' class="img-jogador"/>
                </div>
                </div>
            </tbody>
        </table>
        
        <?php require_once "footer.php"; ?>
    </body>
</html>