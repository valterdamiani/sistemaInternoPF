<!DOCTYPE html>
<html>
    <head>
        <title>Piscina Fácil App - Login</title>
        <?php require_once "head.php"; ?>
        <style>
            body {
                padding: 25px;
            }
            .iconBox{
                background: #1286c8;
                width: 45px;
                height: 48px;
                position: absolute;
                border-top-left-radius: 8px;
                border-bottom-left-radius: 8px;
                text-align: center;
                line-height: 48px;
                vertical-align: middle;
            }
            .icon{
                width: 26px;
                height: 22px;
            }
            .input{
                padding: 20px;
                height: 48px;
                width: 90%;
                margin-left: 9%;
                border: 1px solid #1286c8;
                border-radius: 8px;
                color: #a6ce39;
                margin-bottom: 5px;
            }
            .input:focus{
                outline: none; 
                box-shadow: none;       
            }
            .inline{
                display: inline-block;
            }
            .select{
                height: 48px;
                border: 1px solid #1286c8;
                /* color: #a6ce39; */
                border-radius: 8px;
                margin-bottom: 30px;
            }
            .loginBtn{
                background-color: #a6ce39;
                border: none;
                height: 38px;
                margin-top: 20px;
                margin-bottom: 10px;
            }
            .loginBtn:hover{
                background-color: #1286c8;
            }
        </style>
    </head>
    <body>
        <section class= "container-fluid col-sm-12 col-xl-3">
            <section class = "row justify-content-center">
                <section>
                    <img width="320" style="margin-bottom: 40px;" src="imagens/logoPiscinaFacil2.png" class="rounded mx-auto d-block" alt="Responsive image">

                    <form class="form-container" name = "loginform" method = "post" action = "autentica2">
                        <div class="form-group">
                            <div class="iconBox inline">
                                <img class="icon" src="./arquivos/icons/04-nome.png" alt="">
                            </div>
                            <input class="form-control input inline" type="nome" name="nome" placeholder="nome completo" required>
                        </div>
                        <div class="form-group">
                            <div class="iconBox inline">
                                <img class="icon" src="./arquivos/icons/05-apelido.png" alt="">
                            </div>
                            <input class="form-control input inline" type="apelido" name="apelido"  placeholder="apelido no jogo" maxlength="10" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px">
                            <div class="iconBox inline">
                                <img class="icon" src="./arquivos/icons/06-telefone.png" alt="">
                            </div>
                            <div class="form-group inline" style="margin-left: 7%; width: 30%;">
                                <input class="form-control input inline"  type="text" maxlength="2" name="ddd"  placeholder="ddd" required>
                            </div>
                            <div  class="form-group inline" style="width: 61%;">
                                <input class="form-control input inline" style="margin-left: 0%; width:100%;" type="text" maxlength="11" name="telefone"  placeholder="telefone">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="iconBox inline">
                                <img class="icon" src="./arquivos/icons/02-email.png" alt="">
                            </div>
                            <input class="form-control input inline" type="email" name="email" placeholder="e-mail" required>
                        </div>
                        <div class="form-group" style="width: 99%; border-radius: 8px; margin-left: 0%">
                            <select class="form-control select" name='relacaoPiscina'  required>
                            <option value= "">Qual sua relação com piscinas?</option>
                            <option value= "autonomo">Sou tratador autônomo</option>
                            <option value="loja">Tenho uma loja de piscinas</option>
                            <option value="empresa">Tenho uma empresa de manutenção de piscinas</option>
                            <option value= "interessado">Pretendo me tornar tratador profissional</option>
                            <option value= "empregado">Sou empregado em uma empresa de tratamento</option>
                            <option value= "residencial">Tenho uma piscina em minha residência</option>
                            <option value= "pública">Limpo as piscinas de um clube ou condomínio</option>
                        </select>
                        </div>
                        <input value="Registrar" type="submit" class="btn loginBtn btn-primary btn-block">
                        
                    </form>
                    <form style="text-align:center" action="log">
                        <input class="btn btn-link text-primary " value="Voltar para login" type="submit">
                    </form>
                </section>
            </section>
        </section>
        <?php require_once "footer.php"; ?>
    </body>
</html>