<meta charset="UTF-8">
<!-- Global site tag (gtag.js) - Código Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124883145-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-124883145-2');
</script>
<!-- Fim Código Google Analytics -->

<link rel="stylesheet" href="/css/bootstrap.min.css"/>
<link href="css/googleapis-material-icons.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
<link rel="shortcut icon" href="/imagens/favicon-piscina-facil.png" type="image/png" />
<script src="js/chart.js"></script>

<style>
    .navbar-default{
        background-color: #002232;
    }
    
    .navbar-nav > li{
        padding-left:10px;
        padding-right:10px;
        text-align: center;
    }
    
    .p-imagem {
	    text-align: center;
    }
    
    .navbar-nav >li > a {
        color: #edf2ed;
    }
    
    .navbar-nav >li > a:hover {
        color: #94cf1c;
    }
    
    .navbar-nav > .active > a {
        color: #0088cb;
    }
    
    .navbar-nav  .active {   
        background-color: #c8e4f2;
        border-radius: 25px;
    }
    
    #nav ul {
        display: inline-block;
    }
    
    .textoDestaque {
        color: #002232;
    }
    
    td {
        color: #002232;
    }
    
    .tdAtrasado{
        background-color: #f97d6d!important;
    }
    
    .tdNoPrazo {
        background-color: #f1f590!important;
    }
    
    .btn-outline-primary {
        color: #0088c9;
        border-color: #0088c9;
    }
    
    .btn-outline-primary:hover {
        background-color: #0088c9;
        color: #fff;
    }
    
    th { 
        color: #00547c;
    }
    
    .table-striped>tbody>tr:nth-child(odd)>td, 
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #c8e4f2;
    }
     
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
        background-color: #002232;
        color: #ffffff;
    }
    
    table { 
        max-width:100%;
        position: relative;
    }
    
    .demanda {
        background-color: #e2e8dc;
        padding: 20px 20px 10px 20px;
        border-radius:20px;
    }

    .especificacao {
        background-color: #cedae0;
        padding: 20px 20px 10px 20px;
        border-radius:20px;
    }

    .aprovacao {
        background-color: #e8dedc;
        padding: 20px 20px 10px 20px;
        border-radius:20px;
    }

    .aprovacaoGame {
        background-color: #ffffff;
        padding: 20px 20px 10px 20px;
        border-radius:20px;
    }

    .imgMap {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        border: 3px solid !important;
    }

    .game {
        background-color: #dde5e2;
        padding: 15px 8px 15px 8px;
        border-radius:10px;
    }

    .centerDiv {
        margin: 0 auto;
    }

    .marginBottom {
        margin-bottom: 15px;
    }
    
    .cotacao {
        background-color: #f4eeba;
        padding: 20px 20px 10px 20px;
        border-radius:20px;
    }
    
    .naMesmaLinha{
        display:inline;
    }
    
    .naMesmaLinhaDireita{
        float:right;
    }
    
    .naMesmaLinhaDireitaForum{
        position: absolute;
        right: 8px;
        top: 8px;
        font-size: 10pt;
        color: #aaa;
    }
    
    .naMesmaLinhaCentro{
        float:center;
    }
    
    .divComentario {
        background: #f2f5f7;
        border-radius: 8px;
        font-family:'Open Sans';
        padding: 12px;
        position: relative;
    }
    .apelidoComentario {
        font-size: 12pt;
        font-weight: 500;
        color: #007bff;
        margin-bottom:0px;
    }
    .dataComentario {
        font-size: 10pt;
        color: #aaa;
    }
    .comentarioForum {
        font-size: 12pt;
    }
    
    textarea {
        -webkit-outline: none !important;
        border-radius: 8px;
    }

    body {
        font-family: "Open Sans", sans-serif;
        line-height: 1.25;
    }

    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

/*table caption {*/
/*  font-size: 1.5em;*/
/*  margin: .5em 0 .75em;*/
/*}*/

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
  border-radius: 8px;
  
}

table th,
table td {
  padding: .625em;
  vertical-align:middle!important;
  
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
  text-align: center;
  
}

  .buttonJogar {
    height: 40px;
    width: 100%;
    cursor: pointer;
    background: #a6ce39;
    border: none;
    
}
.buttonCancelar {
    height: 40px;
    width: 100%;
    cursor: pointer;
    background: danger;
    border: none;
    
}

  .buttonJogar:hover {
    height: 40px;
    width: 100%;
    cursor: pointer;
    background: #1286c8;
    border: none;
    
}

.dadosUsuario {
    font-size: 12pt;
    font-family: 'Open Sans';
    margin-bottom: 0px;
    padding-left: 50px;
}

.caixaDadosUsuario {
    background: #fff;
    border-radius: 8px;
    padding: 8px;
    border-top: 2px solid #e1ebf1;
    border-bottom: 2px solid #1e88ca;
    margin-bottom: 8px;
}

.apelidoRank {
    width: 350px;
}

.iconCertificado_verCurriculo {
    margin-right: 16px;
}

.td_verCurriculo {
    background: #fff !important;
    line-height: 0.5 !important;
    font-size: 12pt;
}
.align_center {
    text-align: center;
}

#caixa-dados-usuario {
    width: 66%;
    margin: 0 auto;
    margin-bottom: 25px;
    background: #f8f8f8;
}

.width66 {
    width: 66%;
    margin: auto;
}
.caixa-ranking {
    width: 50%;
    margin: 0 auto;
    margin-bottom: 25px;
    background: #f8f8f8;
    border: 2px solid #132b3d;
}

.treinamento_jogos_trofeu {
    width: 66%;
    margin: 0 auto;
}

.span_tabela_jogos {
    
    display: block;
    position: relative;
    left: 20px;
}

.float_left {
    float:left;
}

.tr_table {
    background: #1286c8;
    color: #FFF !important;
}

.border_azul {
    border: 2px solid #1286c8;
}

.th_table {
    border: 2px solid #1286c8;
    
}

.h3_treinamento {
    color: #FFF;
    background: #132b3d;
    font-size: 12pt;
    padding: 6px;
    text-transform: uppercase;
}

.borderTL {
    border-top-left-radius: 8px;
}

.borderTR {
    border-top-right-radius: 8px;
}
.borderBL {
    border-bottom-left-radius: 8px;
}
.borderBR {
    border-bottom-right-radius: 8px;
}

.font10 {
    font-size: 10pt;
}

.infos_rank {
    position: relative;
    left: 25px;
    top: -15px;
}

.icon_ranking {
    margin-right: 8px;
}
@media screen and (max-width: 991px) {
    #caixa-dados-usuario {
        width: 100%;
    }
    
    .treinamento_jogos_trofeu {
        width: 100%;
    }
    
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
    border-radius: 8px;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
  
  .buttonJogar {
    width: 100%;
    cursor: pointer;
    background: #a6ce39;
    text-transform: uppercase;

}

.img-jogador {
    display: none;
}

.caixa-ranking {
    width: 100%;
}

.width66 {
    width: 100%;
}

.dadosUsuario {
    padding-left: 0px;
}

}


</style>