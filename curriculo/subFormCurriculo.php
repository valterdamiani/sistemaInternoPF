<style>
    .title{
        font-size: 50px;
        color: #132b3d;
        text-align: center;
    }
    .subTitle{
        font-size: 20px;
        color: #132b3d;
        margin-left: 5px;
    }
    .data{
        font-size: 25px;
        color: #1286c8;
        margin-left: 15px;
    }
    .link{
        font-size: 22px;
        color: #1286c8;
    }
</style>

<div class="demanda">
    <h3 class="title">Currículo</h3>
    <br>
    <form class="form-container" method=post enctype="multipart/form-data" action= "editando_contrato">
        <div class="form-row col-md-12">
            <div class="form-group col-md-2" style="margin-left: 2%;">
                <img src="<?php echo $foto; ?>" alt="Avatar" style="width:300px">
            </div>

            <div class="form-group col-md-4" style="margin-top: 30px; margin-left: 8%;">
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label class="subTitle" for="nome">Nome:</label>
                        <div class="data"><?php echo $nome; ?></div>
                        <input type='hidden' name='id' value="<?php echo $id; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label class="subTitle" for="email">Email:</label>
                        <div class="data"><?php echo $email; ?></div>
                    </div> 
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label class="subTitle" for="telefone">Telefone:</label>
                        <div class="data"><?php echo $telefone; ?></div>
                    </div>  
                </div>
            </div>
            <div style='margin-left: 6%;' class="form-group col-md-4">
<?php 

    if(count($valuesArquivos)>0){
        echo "
        
            <table class='table table-striped col-md-12' >
                <thead>
                    <tr>
                        <th class='subTitle'>Certificados:</th>
                    </tr>
                </thead>";

            foreach($valuesArquivos as $linha) {
                $id_fk = $linha["id_fk"];
                $nome= $linha["nome"];
                $extensao= $linha["extensao"];
                $qtd= $linha["qtd"];
        
            echo "  
                <tr>
                    <td class='td_verCurriculo link'><a target='_blank' href='arquivos/curriculos/" . $id_fk . "numero" . $qtd . "." . $extensao . "'><img width='60' height='60' class='iconCertificado_verCurriculo' src='./imagens/cursos-certificado-icon.png' alt='icon certificado'/>" . "$nome" . "</a></td>
                </tr>";
            }
            
            echo "
            </table>";
    }
?>
            </div>
        </div>
    </form>
    <div style="text-align: right; ">
        <button class="btn-primary btn-sm buttonJogar" style="width: 10%; margin-right: 2%; margin-bottom: 10px;" onclick='window.location.href="editarCurriculo"'>Editar Perfil</button>
    </div>
</div>
