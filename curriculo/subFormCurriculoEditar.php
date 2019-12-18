<div class="demanda">
    <h3>Currículo</h3>
    <br>
    <form class="form-container" method=post enctype="multipart/form-data" action= "editando_curriculo">
        <div class="form-row col-md-12">
            <div class="form-group col-md-3">
                <img src="<?php echo $foto; ?>" alt="Avatar" style="width:200px">
                <div class='file-field'>
                    <div style="margin-top: 20px;" class='btn btn btn-sm'>
                        <input name='foto' type='file' class='custom-file'/>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="nome">Nome:</label>
                        <input type = 'text' name = 'nome' class="form-control" value="<?php echo $nome; ?>">
                        <input type = 'hidden' name = 'id' value="<?php echo $id; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="email">Email:</label>
                        <input type = 'text' name = 'email' class="form-control" value="<?php echo $email; ?>">
                    </div> 
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="telefone">Telefone:</label>
                        <input type = 'text' name = 'telefone' class="form-control" value="<?php echo $telefone; ?>">
                    </div>  
                </div>
            </div>
            <div class="form-group col-md-3">
<?php 
        echo "
        <table class='table table-striped col-md-12'>
            <thead>
                <tr>
                    <th>Certificados:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <div class='file-field'>
                        <div style='width: 100%; margin-bottom: 20px;' class='btn btn btn-primary btn-sm b'>
                            <input name='upload1[]' type='file' multiple='multiple' class='custom-file'/>
                            <input type='text' name='arquivo1' class='form-control' placeholder= 'Nomeie o certificado'>
                        </div>
                    </div>
                </tr>";
        foreach($valuesArquivos as $linha) {
            $id_fk = $linha["id_fk"];
            $nome= $linha["nome"];
            $extensao= $linha["extensao"];
            $qtd= $linha["qtd"];
        echo "  
                <tr>
                    <td><a target='_blank' href='arquivos/curriculos/" . $id_fk . "numero" . $qtd . "." . $extensao . "'>" . $nome . "</a></td>
                    <input type = 'hidden' name = 'qtd' value=" . $qtd . ">
                </tr>";
        }
        echo "
            </tbody>
        </table>";
?>
            </div>
        </div>
        <div style="text-align: right; margin-right: 1.5%">
            <button class="btn-danger btn-sm buttonCancelar" style="width: 12%;" onclick='window.location.href="verCurriculo"'>Cancelar</button>
            <button type="submit" class="btn-success btn-sm buttonJogar" style="width: 12%; margin-bottom: 10px;">Confirmar</button>
        </div>
    </form>
</div>