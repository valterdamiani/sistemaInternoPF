    <?php

        if(!isset($_SESSION['cargo'])){
            $cargo = "0";
        }else{
            $cargo = $_SESSION['cargo'];
        }
        
        $colaborador = $_SESSION['colaborador'];
        
        function active($currect_page){
            $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
            $url = end($url_array);  
            if($currect_page == $url){
                echo 'active'; //class name in css 
            } 
        }
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        body{
            /* background-image: url(./arquivos/icons/teste2.png); */
        }
        .backgroundNavBar{
            background-image: linear-gradient(90deg,#0088cb 0,#8ec44e 100%)!important;
            font-family: 'Open Sans', serif;
            font-weight: bold;
            /* background-color: white; */
            /* color: darkblue; */
        }
        .loginSair{
            position: absolute;
            right: 20px;
            float: right;
        }

    </style>
    <nav class="backgroundNavBar navbar navbar-expand-lg sticky-top navbar-default">
        <img src="imagens/logoPiscinaFacil.png" height="50" class="d-inline-block align-top" text-align="right" alt="Piscina Facil" style="margin-right: 20px">
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if($cargo=='Admin'){ ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php active('pendencias');?>">
                        <a class="nav-link" href="pendencias">Pendências</a>
                    </li>
                    <li class="nav-item <?php active('demandas');?> dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compras</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="demandas">Demandas</a>
                            <a class="dropdown-item" href="novaDemanda">Nova Demanda</a>
                        </div>
                    </li>
                    <li class="nav-item <?php active('ciclosOkr');?> dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OKR</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="ciclosOkr">Ciclos OKR</a>
                            <a class="dropdown-item" href="novoCiclo">Novo Ciclo OKR</a>
                        </div>
                    </li>
                    <li class="nav-item <?php active('colaboradores');?> dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastro</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="colaboradores">Colaboradores</a>
                            <a class="dropdown-item" href="locais">Locais</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="novoColaborador">Novo Colaborador</a>
                            <a class="dropdown-item" href="novoLocal">Novo Local</a>
                        </div>
                    </li> 
                    <li class="nav-item <?php active('Jurídico');?> dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contratos</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="contratos?tipo=licitacao">Licitações</a>
                            <a class="dropdown-item" href="contratos?tipo=publico">Clientes Públicos</a>
                            <a class="dropdown-item" href="contratos?tipo=privado">Clientes Privados</a>
                            <a class="dropdown-item" href="contratos?tipo=orcamento">Orçamentos</a>
                            <a class="dropdown-item" href="contratos?tipo=fornecedor">Fornecedores</a>
                            <a class="dropdown-item" href="contratos?tipo=franquia">Franqueados</a>
                            <a class="dropdown-item" href="contratos?tipo=documento">Documentos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="novoContrato">Novo Contrato</a>
                        </div>
                    </li>
                    <li class="nav-item <?php active('financeiro');?> dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Financeiro</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="adimplenciaFranqueados">Adimplência Franqueados</a>
                            <a class="dropdown-item" href="creditoFranqueados">Crédito Franqueados</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="contasAilos">Cartão Ailos</a>
                            <a class="dropdown-item" href="cartaoAilos">Nova Fatura Ailos</a>
                        </div>
                    </li>
                    <li class="nav-item <?php active('principal');?> dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Meu espaço</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="principal">Home</a>
                            <a class="dropdown-item" href="verCurriculo">Perfil</a>
                            <a class="dropdown-item" href="calculadoras">Calculadoras</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="treinamento">Game</a>
                            <a class="dropdown-item" href="treinamentoInterno">Ranking</a>
                            <a class="dropdown-item" href="novoExercicio">Novo Exercício - Múltipla Escolha</a>
                            <a class="dropdown-item" href="novoExercicioEscrever">Novo Exercício - Escrever</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="tarefasInternas">Tarefas</a>
                        </div>
                    </li>
                    <li class="nav-item <?php active('leads');?> dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Leads</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="novoLead">Novo Lead</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="leads">Leads</a>
                            <a class="dropdown-item" href="meusLeads">Meus Leads</a>
                            <a class="dropdown-item" href="meusClientes">Meus Clientes</a>
                        </div>
                    </li>
                    <li class="loginSair nav-item <?php active('sair');?>">
                        <a class="nav-link" href="sair">Sair</a>
                    </li>
                </ul>
            </div>
        <?php }elseif($cargo=="Franqueado"){ ?>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">   
                    <li class="nav-item <?php active('principal');?>">
                        <a class="nav-link" href="principal">Home</a>
                    </li>
                    <li class="nav-item <?php active('treinamento');?>">
                        <a class="nav-link" href="treinamento">Game</a>
                    </li>
                    <li class="nav-item <?php active('verCurriculo');?>">
                        <a class="nav-link" href="verCurriculo">Perfil</a>
                    </li>
                    <li class="nav-item <?php active('calculadoras');?>">
                        <a class="nav-link" href="calculadoras">Calculadoras</a>
                    </li>
                    <li class="nav-item <?php active('leads');?>">
                        <a class="nav-link" href="leads">Leads</a>
                    </li>
                    <li class="nav-item <?php active('meusLeads');?>">
                        <a class="nav-link" href="meusLeads">Meus Leads</a>
                    </li>
                    <li class="nav-item <?php active('meusClientes');?>">
                        <a class="nav-link" href="meusClientes">Meus Clientes</a>
                    </li>
                    <li class="loginSair nav-item <?php active('sair');?>">
                        <a class="nav-link" href="sair">Sair</a>
                    </li>
                </ul>
            </div>
        <?php }elseif($cargo=="Aluno"){ ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">   
                    <li class="nav-item <?php active('principal');?>">
                        <a class="nav-link" href="principal">Home</a>
                    </li>
                    <li class="nav-item <?php active('treinamento');?>">
                        <a class="nav-link" href="treinamento">Game</a>
                    </li>
                    <li class="nav-item <?php active('verCurriculo');?>">
                        <a class="nav-link" href="verCurriculo">Perfil</a>
                    </li>
                    <li class="nav-item <?php active('calculadoras');?>">
                        <a class="nav-link" href="calculadoras">Calculadoras</a>
                    </li>
                    <li class="loginSair nav-item <?php active('sair');?>">
                        <a class="nav-link" href="sair">Sair</a>
                    </li>
                </ul>
            </div>
        <?php }else{ ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">   
                    <li class="nav-item <?php active('principal');?>">
                        <a class="nav-link" href="principal">Home</a>
                    </li>
                    <li class="nav-item <?php active('treinamento');?>">
                        <a class="nav-link" href="treinamento">Game</a>
                    </li>
                    <li class="nav-item <?php active('calculadoras');?>">
                        <a class="nav-link" href="calculadoras">Calculadoras</a>
                    </li>
                    <li class="loginSair nav-item <?php active('log');?>" style="color: white;">
                        <a class="nav-link" href="log">Login</a>
                    </li>
                </ul>
            </div>
    <?php } ?>
        </nav>
    <br>
        <div class= "container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12">