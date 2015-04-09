<html>
<head>
 <?php
header("Access-Control-Allow-Origin: https://correiosapi.apphb.com");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
 ?>
<title>Ficha de inscrição</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Title" Content="Ficha de Inscrição">
<meta name="Author" Content="Lucas Mattos (lucasmat.7@gmail.com)">
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- JavaScript   Bootstrap-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Mascara de input Jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"></script>



<script language="JavaScript">

//a implementar, para validações do tipo emails sem @ e outras
function valida(){
}



<!-- Hide e Show nas parcelas do cobrança na mensalidade-->
$(document).ready(function() {
	$("#escolheParcelas").hide();
	
	$("#cobrarMensalidade").on("click", function(){
        $("#escolheParcelas").slideToggle("fast");
    });
	
<!-- Mascaras -->
		$("#cad_cpf").mask("000.000.000-00");
		$("#cad_cep").mask("00000-000");
		$("#cad_telefone").mask("(00) 0000-00000");
		$("#cad_celular").mask("(00) 00000-0000");
	});
	
	
<!-- Busca de CEP  API correios-->
	$(function(){
               /**
                * Atribuo ao elemento #cep, o evento blur
                * Blur, dispara uma ação, quando o foco
                * sair do elemento, no nosso caso cep 
                */
               $("#cad_cep").blur(function(){
                   /**
                    * Resgatamos o valor do campo #cep
                    * usamos o replace, pra remover tudo que não for numérico,
                    * com uma expressão regular
                    */
                   var cep     = $(this).val().replace(/[^0-9]/, ''); 
                   
                  //Cria variável com a URL da consulta, passando o CEP
                 //var url = 'https://correiosapi.apphb.com/cep/'+cep;
				 var url = 'httpt://www.contoso.com/pegaCep.php?cep='+cep;

				  /**
				  * Fazemos um requisição a URL, como vamos retornar json, 
				  * usamos o método $.getJSON;
				  * Que é composta pela URL, e a função que vai retorna os dados
				  * o qual passamos a variável json, para recuperar os valores
				  */
				  
				  $.getJSON(url, function(json){
                               //Atribuimos o valor aos inputs
                               $("#cad_endereco").val(json.logradouro);
                               $("#cad_bairro").val(json.bairro);
                               $("#cad_cidade").val(json.localidade);
                               $("#cad_uf").val(json.uf);
							   
                           }).fail(function(){
                            //Ainda a ser decidido se iremos apresentar um alert no caso de erro 
                       });
                   
               });
           });





</script>





</head>
<!-- --------------------------------body-------------------------------- -->

<body>
<br/>
<div class="container" style= "width:800px;">

<form class="form-horizontal" action="ficha_inscricao_final.php" method="post" width="800px">
<fieldset>

<!-- Form Name -->
<legend>Ficha de inscrição: <span id="nome_evento" name="nome_evento" value="Evento ABC" >Evento ABC</span></legend>


<!-- Text nome-->
<div class="form-group">
	<label class="col-md-4 control-label" for="cad_nome">Nome*</label>  
		<div class="col-md-4">
			<input id="cad_nome" name="cad_nome" type="text" placeholder="digite aqui seu nome" class="form-control input-md" required="" title="Coloque seu nome">
		</div>
</div>



<!-- Text email-->
<div class="form-group">
	<label class="col-md-4 control-label" for="cad_email">Email*</label>  
		<div class="col-md-4">
			<input id="cad_email" name="cad_email" type="text" placeholder="digite aqui seu email" class="form-control input-md" required="" title="Coloque seu email">
		</div>
</div>


<!-- Text profissao-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_profissao">Profissão*</label>  
	  <div class="col-md-4">
			<input id="cad_profissao" name="cad_profissao" type="text" placeholder="digite aqui sua profissão" class="form-control input-md" required="" title="Coloque sua profissao">
		</div>
</div>


	<!-- Text cpf-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_cpf">CPF*</label>  
	  <div class="col-md-4">
		  <input id="cad_cpf" name="cad_cpf" type="text" placeholder="digite aqui seu cpf" class="form-control input-md" required="" title="Coloque seu cpf">
	  </div>
</div>

<!-- Text cep-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_cep">CEP*</label>  
	  <div class="col-md-2">
			<input id="cad_cep" name="cad_cep" type="text" placeholder="" class="form-control input-md" required="" title="Coloque seu nome">
	  </div>
</div>


<!-- Text endereco-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_endereco">Endereço*</label>  
	  <div class="col-md-4">
			<input id="cad_endereco" name="cad_endereco" type="text" placeholder="digite aqui seu endereço" class="form-control input-md" required="" title="Coloque seu endereço">
		</div>
</div>

<!-- Text endereco_numero-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_endereco_num">Nº*</label>  
	  <div class="col-md-2">
		  <input id="cad_endereco_num" name="cad_endereco_num" type="text" placeholder="" class="form-control input-md" required="" title="Coloque o número da residência">
	  </div>
</div>


<!-- Text complemento-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_complemento">Complemento</label>  
	  <div class="col-md-4">
			<input id="cad_complemento" name="cad_complemento" type="text" placeholder="casa, apartamento, condomínio...." class="form-control input-md">
	  </div>
</div>

<!-- Text Bairro-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_bairro">Bairro*</label>  
	  <div class="col-md-4">
			<input id="cad_bairro" name="cad_bairro" type="text" placeholder="digite aqui seu bairro" class="form-control input-md" required="">
	  </div>
</div>

<!-- Text Cidade-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_cidade">Cidade*</label>  
	  <div class="col-md-4">
			<input id="cad_cidade" name="cad_cidade" type="text" placeholder="digite aqui sua cidade" class="form-control input-md" required="">
	  </div>
</div>

<!-- Select UF -->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_uf">UF*</label>
	  <div class="col-md-2">
		<select id="cad_uf" name="cad_uf" class="form-control">
		  <option value="UF">UF</option>
		  <option value="AC">AC</option>
		  <option value="AL">AL</option>
		  <option value="AP">AP</option>
		  <option value="AM">AM</option>
		  <option value="BA">BA</option>
		  <option value="CE">CE</option>
		  <option value="DF">DF</option>
		  <option value="ES">ES</option>
		  <option value="GO">GO</option>
		  <option value="MA">MA</option>
		  <option value="MT">MT</option>
		  <option value="MS">MS</option>
		  <option value="MG">MG</option>
		  <option value="PA">PA</option>
		  <option value="PB">PB</option>
		  <option value="PR">PR</option>
		  <option value="PE">PE</option>
		  <option value="PI">PI</option>
		  <option value="RJ">RJ</option>
		  <option value="RN">RN</option>
		  <option value="RS">RS</option>
		  <option value="RO">RO</option>
		  <option value="RR">RR</option>
		  <option value="SC">SC</option>
		  <option value="SP">SP</option>
		  <option value="SE">SE</option>
		  <option value="TO">TO</option>
		</select>
	  </div>
</div>

<!-- Text Telefone-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_telefone">Telefone*</label>  
	  <div class="col-md-4">
		  <input id="cad_telefone" name="cad_telefone" type="text" placeholder="" class="form-control input-md" required="">
		  <span class="help-block">não esqueça do DDD</span>  
	  </div>
</div>

<!-- Text Celular-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_celular">Celular*</label>  
	  <div class="col-md-4">
		  <input id="cad_celular" name="cad_celular" type="text" placeholder="" class="form-control input-md" required="">
		  <span class="help-block">não esqueça do DDD</span>  
	  </div>
</div>

<!-- Multiple Valores -->
<div class="form-group">
  <label class="col-md-4 control-label" for="cad_valor_inscricao">Valor da inscrição*</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="cad_valor_inscricao-0">
      <input type="radio" name="cad_valor_inscricao" id="cad_valor_inscricao-0" value="170" checked="checked">
      <b>R$170,00</b> Faixa A
    </label>
	</div>
  <div class="radio">
    <label for="cad_valor_inscricao-1">
      <input type="radio" name="cad_valor_inscricao" id="cad_valor_inscricao-1" value="135">
      <b>R$135,00</b> Faixa B
    </label>
	</div>
  <div class="radio">
    <label for="cad_valor_inscricao-2">
      <input type="radio" name="cad_valor_inscricao" id="cad_valor_inscricao-2" value="85">
      <b>R$85,00</b> Faixa C
    </label>
	</div>
  </div>
</div>

<!-- Check cobrar na mensalidade -->
<div class="form-group">

	<div class="checkbox">
		<label for="cobrarMensalidade">
			<input type="checkbox" name="cobrarMensalidade" id="cobrarMensalidade" value="sim">
			Clique aqui caso deseje que o valor acima seja cobrado na mensalidade  <b>*APENAS PARA MEMBROS CONTOSO*</b>
		</label>
	</div>

	<!-- Multiple parcelas do cobrar na mensalidade -->
<div class="form-group" id="escolheParcelas">
  <label class="col-md-4 control-label" for="parcelas">Quantas parcelas?</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="parcelas-0">
      <input type="radio" name="parcelas" id="parcelas-0" value="1x" checked="checked">
      1x
    </label> 
    <label class="radio-inline" for="parcelas-1">
      <input type="radio" name="parcelas" id="parcelas-1" value="2x">
      2x
    </label> 
    <label class="radio-inline" for="parcelas-2">
      <input type="radio" name="parcelas" id="parcelas-2" value="3x">
      3x
    </label> 
    
  </div>
</div>

</div>



<input type="submit" class="btn btn-primary btn-block " value="Enviar"alt="Enviar"border="0" onClick="valida();">
 


</fieldset>
 
</form>

</div>
</body>
</html>
