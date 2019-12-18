<!DOCTYPE html>
<html>
    <head>
        <title>Piscina Fácil App - Login</title>
        <?php require_once "head.php"; ?>
        <style>
            body {
                padding: 100px;
            }
            .iconBox{
                background: #1286c8;
                width: 38px;
                height: 38px;
                position: absolute;
                border-top-left-radius: 8px;
                border-bottom-left-radius: 8px;
                text-align: center;
                line-height: 38px;
                vertical-align: middle;
            }
            .icon{
                width: 26px;
                height: 22px;
            }
            .input{
                width: 90%;
                margin-left: 10%;
                border: 1px solid #1286c8;
                color: #a6ce39;
            }
            .input:focus{
                outline: none; 
                box-shadow: none;       
            }
            .inline{
                display: inline-block;
            }
            .loginBtn{
                background-color: #a6ce39;
                border: none;
                height: 38px;
                margin-top: 30px;
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
                    <img width="320" style=" margin-bottom: 50px;" src="./arquivos/icons/01-logo.png" class="rounded mx-auto d-block" alt="Responsive image">
                    <br>
                    <form class="form-container" name ="loginform" method="post" action="autentica">
                        <div class="form-group">
                            <div class="iconBox inline">
                                <img class="icon" src="./arquivos/icons/02-email.png" alt="">
                            </div>
                            <input class="form-control input inline" type="email" name="email"  id="email" aria-describedby="emailHelp" placeholder="e-mail">
                        </div>
                        <div class="form-group">
                            <div class="iconBox inline">
                                <img class="icon" src="./arquivos/icons/03-senha.png" alt="">
                            </div>
                            <input class="form-control input inline" type="password" name="senha"  id="senha" placeholder="senha">
                        </div>
                        <input value="Entrar" type="submit" class="btn loginBtn btn-primary btn-block">
                        <div  style="text-align:center">
                            <input class="btn btn-link text-primary " value="Primeiro acesso" type="submit" onclick ="loginform.action='primeiroAcesso'; return true;">
                            <input class="btn btn-link text-primary " value="Não sabe a senha" type="submit" onclick ="loginform.action='esqueci_a_senha'; return true;">
                        </div>
                    </form>
                </section>
            </section>
        </section>
        <?php require_once "footer.php"; ?>
    </body>
</html>