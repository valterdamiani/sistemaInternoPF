<div class="form-group">
    <div class="inline nomeServico">
        <label class='menu' for='tratamentoPiscina'>Tratamento de Piscina</label>
    </div>
    <div class=" inline recorrencia">    
        <label>Serviço recorrente:</label>
    </div>
    <div class="inline recorrenciaOpcao">
        <input type='radio' name="recorrenciaTratamentoPiscina" id='recorrenciaTratamentoPiscinaSim' value='recorrenciaTratamentoPiscinaSim' checked>
        <label for='recorrenciaTratamentoPiscinaSim'>Sim</label>
    </div>
    <div class="inline recorrenciaOpcao">
        <input type='radio' name="recorrenciaTratamentoPiscina" id='recorrenciaTratamentoPiscinaNao' value='recorrenciaTratamentoPiscinaNao'>
        <label for='recorrenciaTratamentoPiscinaNao'>Não</label>
    </div>
    <div class=" inline recorrencia" style="margin-left: 3%;">    
        <label>Produtos Inclusos:</label>
    </div>
    <div class="inline recorrenciaOpcao">
        <input type='radio' name="produtosLimpeza" id='produtosLimpezaSim' value='produtosLimpezaSim' checked>
        <label for='produtosLimpezaSim'>Sim</label>
    </div>
    <div class="inline recorrenciaOpcao">
        <input type='radio' name="produtosLimpeza" id='produtosLimpezaNao' value='produtosLimpezaNao'>
        <label for='produtosLimpezaNao'>Não</label>
    </div>
    <div class="inline" style="margin-left: 3%; width: 5%;">
        <button id="descricaoTratamentoPiscina" class='btn btn-outline-primary btn-sm btn-block' onclick="modalDescricao()">Descrição</button>
    </div>
    <div class="menu inline rs">R$</div>
        <input id='tratamentoPiscinaPreco' class="form-control inline valor" placeholder="0,00" onkeydown="FormataMoeda(this,10,event)" onkeypress="return maskKeyPress(event)">
    </div>
</div>
