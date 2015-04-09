<!DOCTYPE html>
<html>
<head>
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


</head>



<!-- da auto-submit no form para redirecionamento ao B!Cash !-->
<body onload="document.createElement('form').submit.call(document.getElementById('myForm'))">


<?php

//recenbendo os dados do formulário
$evento = "Evento ABC";
$nome = $_POST['cad_nome'];
$email = $_POST['cad_email'];
$profissao = $_POST['cad_profissao'];
$cpf = $_POST['cad_cpf'];
$cep = $_POST['cad_cep'];
$endereco = $_POST['cad_endereco'];
$endereco_num = $_POST['cad_endereco_num'];
$complemento = $_POST['cad_complemento'];
$bairro = $_POST['cad_bairro'];
$cidade = $_POST['cad_cidade'];
$uf = $_POST['cad_uf'];
$telefone = $_POST['cad_telefone'];
$celular = $_POST['cad_celular'];
$valor_inscricao = $_POST['cad_valor_inscricao'];
//cobrança de mensalidade não será abordada neste caso
$cobrar_mensalidade = $_POST['cobrarMensalidade'];
$mensalidade_parcelas = $_POST['parcelas'];


// cadastrando no banco

$dbName = 'e:\contoso\bancos\evento-abc.mdb';
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
//access driver
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;");

//monta query com prepared statement para prevenção de inject no banco
$sql  = "INSERT INTO inscricao (DS_NOME, DS_EMAIL, DS_PROFISSAO, DS_CPF, DS_CEP, DS_ENDERECO, DS_COMPLEMENTO, DS_BAIRRO, DS_CIDADE, DS_UF, DS_TELEFONE, DS_CELULAR,VL_INSCRICAO,DS_MENSALIDADE, DS_MENSALIDADE_PARCELA) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
$stmt = $db->prepare($sql);
$stmt->bindValue(1, $nome);
$stmt->bindValue(2, $email);
$stmt->bindValue(3, $profissao);
$stmt->bindValue(4, $cpf);
$stmt->bindValue(5, $cep);
$stmt->bindValue(6, $endereco . ", " .  $endereco_num);
$stmt->bindValue(7, $complemento);
$stmt->bindValue(8, $bairro);
$stmt->bindValue(9, $cidade);
$stmt->bindValue(10, $uf);
$stmt->bindValue(11, $telefone);
$stmt->bindValue(12, $celular);
$stmt->bindValue(13, $valor_inscricao);
$stmt->bindValue(14, $cobrar_mensalidade);
$stmt->bindValue(15, $mensalidade_parcelas);

$result = $stmt->execute();


//se der certo, prossegue, se não der certo, abre um alert e redireciona para a home
if($result) {
    echo("<br/>Redirecionando...");
} else {
    echo "<script type=\"text/javascript\">alert('Ocorreu um erro! Por favor tente de novo ou entre em contato com suporte@contoso.com.br');</script>"; 
	header("Location: http://www.contoso.com.br");
}


// ENVIANDO E-MAIL - para nós ( o funcionário que está cuidando das inscrições recebe o email com a ficha da pessoa, o dpto. de suporte/ti recebe uma cópia)
$quebra_linha = "\r\n";
$emailSender = "inscricao@contoso.com.br";
$nomeRemetente = "Contoso";
$emailDestinatario = "funcionario@contoso.com.br";
$cco = "suporte@contoso.org.br";
$assunto = "Inscrição -> " . $evento;
$mensagemHTML = '
	<p>Nome.......: ' . $nome . '</p>
	<p>E-mail.......: '.$email . ' </p>
	<p>Profissão.......: '. $profissao . '  </p>
	<p>Endereço.....: '. $endereco . ', ' . $endereco_num . ' </p>
	<p>Complemento.....: '. $complemento . '</p>
	<p>Bairro.......: ' . $bairro . ' </p>
	<p>CEP..........: '. $cep . ' </p>
	<p>Cidade.......: ' . $cidade . ' </p>
	<p>UF...........: ' . $uf . ' </p>
	<p>Telefone.....: ' . $telefone . ' </p>
	<p>Celular......: ' . $celular . ' </p>
	<p>Inscrição p/.: ' . $evento . '</p>
	<p>Valor da inscrição: <b>R$' . $valor_inscricao . '</b></p>';

//headers do email
$headers = "MIME-Version: 1.1" . $quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1". $quebra_linha;
$headers .= "From: " . $emailSender . $quebra_linha;
$headers .= "Return-Path: " . $emailSender . $quebra_linha;
$headers .= "Bcc: " . $cco . $quebra_linha;
$headers .= "Reply-to: " .  $emailSender . $quebra_linha;

//email para nós - metodo do envio
mail($emailDestinatario , $assunto, $mensagemHTML,$headers, $emailSender);



//email para o inscrito
//montando o corpo da mensagem
		$mensagemHTMLinscrito = '<p><img src="http://contoso.com.br/logo.jpg" alt="CONTOSO" /></p>
		<p> Olá  ' . $nome . '</p>
		<p>Você acaba de se inscrever no evento: <b>' . $evento . '</b></p>
		<br/> <br/> <font color="red" size="5">Atenção: sua inscrição só será confirmada a partir do momento que você realizar o pagamento e receber a confirmação de pagamento do B!Cash </font>';
	
		//montando os headers
		$headers2 = "MIME-Version: 1.1" . $quebra_linha;
		$headers2 .= "Content-type: text/html; charset=iso-8859-1". $quebra_linha;
		$headers2 .= "From: " . $emailSender . $quebra_linha;
		$headers2 .= "Return-Path: " . $emailSender . $quebra_linha;
		$headers2 .= "Reply-to: " .  $emailSender . $quebra_linha;
	
		//enviando o email para o inscrito
	mail($email, 'Contoso - Recebemos sua ficha de inscrição - ' . $evento, $mensagemHTMLinscrito, $headers2, $emailSender);

echo "<script type=\"text/javascript\">alert('Sua inscrição foi recebida com sucesso! Estamos te encaminhando para o site do B!Cash para a realização do pagamento.');</script>"; 
	

?>

<!-- PARTE API DO BCASH -->
<form class="form-horizontal" action="https://www.bcash.com.br/checkout/pay/" method="post" id="myForm" name="myForm" >



 
    <!-- Identificação do vendedor -->;
 
        <input name="email_loja" type="hidden" value="vendas@contoso.com.br">
 
    <!-- Dados do Pedido / Produtos -->
 
        <input name="produto_codigo_1"type="hidden" value="1">
 
        <input name="produto_descricao_1" type="hidden" value="<?echo $evento;?>" id="produto_descricao_1">
 
        <input name="produto_qtde_1" type="hidden" value="1">
 
        <input name="produto_valor_1"type="hidden"value="<?echo $valor_inscricao;?>" id="produto_valor_1">
 
    <!-- Dados do Comprador -->
 
        <input name="email"type="hidden"value="<?echo $email;?>" id="email">
 
        <input name="nome"type="hidden"value="<?echo $nome;?>" id="nome">
 
        <input name="cpf"type="hidden"value="<?echo str_replace(array('.','-'),'',$cpf);?>" id="cpf">
 
        <input name="telefone"type="hidden"value="<?echo $telefone;?>" id="telefone">
 
    <!-- Dados de Entrega -->
 
        <input name="cep" type="hidden" value="<?echo $cep;?>" id="cep">
 
        <input name="endereco"type="hidden" value="<?echo $endereco . " " . $endereco_num ;?>" id="endereco">
 
        <input name="cidade"type="hidden" value="<?echo $cidade;?>" id="cidade">
 
        <input name="estado"type="hidden" value="<?echo $uf;?>" id="estado">
 
    
	
	<!-- Outros -->    
    
        <input name="parcela_maxima" type="hidden" value="3">
 
        <input type="hidden" name="submit" id="submit" value="Comprar">
        
        

 
</form>


</body>
</html>
