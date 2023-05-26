<?php
require_once("configuracao.php");
require_once("classBancoDados.inc");
require_once("funcoes_diversas.php");

date_default_timezone_set('UTC');
$DataInclusao = date("d/m/Y");
$Nome = $_REQUEST["NomeHospede"];
$Dia = $_REQUEST["DiaNascimento"];
$Mes = $_REQUEST["MesNascimento"];
$Ano = $_REQUEST["AnoNascimento"];
$DataNascimento = "$Ano/$Mes/$Dia";
$CPF = $_REQUEST["NumeroCPF"];
$RG = $_REQUEST["NumeroRG"];
$Endereco = $_REQUEST["Endereco"];
$Numero = $_REQUEST["Numero"];
$Complemento = $_REQUEST["Complemento"];
$Bairro = $_REQUEST["Bairro"];
$Cidade = $_REQUEST["Cidade"];
$Estado = $_REQUEST["Estado"];
$CEP = $_REQUEST["CEP"];
$FoneFixo = $_REQUEST["Telefone"];
$Celular = $_REQUEST["Celular"];
$Emmpresa = $_REQUEST["Empresa"];
$Usuario = $_REQUEST["NomeUsuario"];
$Senha = $_REQUEST["SenhaAcesso"];
$Email = $_REQUEST["Email"];
$ErroDados = FALSE;
$MensagemErro = "";

if(trim($Nome) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Nome obrigatório...</h3>";
}

if((trim($Dia) != "") && (trim($Mes) != "") && (trim($Ano) != "")) {
    if(!checkdate($Mes,$Dia,$Ano)) {
        $ErroDados = TRUE;
        $MensagemErro .= "<h3>Data de nascimento inválida...</h3>";
    }
}
else {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Data de nascimento obrigatória...</h3>";
}

if(trim($CPF) != "") {
    if(!ValidaCPF($CPF)) {
        $ErroDados = TRUE;
        $MensagemErro .= "<h3>Número do CPF inválido...</h3>";
    }
}
else {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Número do CPF obrigatório...</h3>";
}

if(trim($RG) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Número do RG obrigatório...</h3>";
}

if(trim($Endereco) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Endereço obrigatório...</h3>";
}

if(trim($Bairro) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Bairro obrigatório...</h3>";
}

if(trim($Cidade) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Cidade obrigatória...</h3>";
}

if(trim($CEP) != "") {
    if(!ValidaCEP($CEP)) {
        $ErroDados = TRUE;
        $MensagemErro .= "<h3>Formato do CEP inválido...</h3>";
    }
}
else {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>CEP obrigatório...</h3>";
}

if(trim($FoneFixo) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Telefone obrigatório...</h3>";
}

if(trim($Usuario) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Usuário obrigatório...</h3>";
}

if(trim($Senha) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Senha obrigatória...</h3>";
}

if(!$ErroDados)  {
    $conexao_bd = new classBancoDados($ServidorMySQL);
           
    if (!$conexao_bd->AbrirConexao()) {
        echo "<h3>Erro na conexão com o banco de dados!<br>" . $conexao_bd->MensagemErro() . "</h3>";
    }
    else {
        $DadosRegistro["Data_Inclusao"] = CampoTexto(DataInvertida($DataInclusao));
        $DadosRegistro["Nome_Hospede"] = CampoTexto($Nome);
        $DadosRegistro["Data_Nascimento"] = CampoTexto($DataNascimento);
        $DadosRegistro["CPF"] = CampoTexto($CPF);
        $DadosRegistro["RG"] = CampoTexto($RG);
        $DadosRegistro["Endereco"] = CampoTexto($Endereco);
        $DadosRegistro["Numero"] = CampoTexto($Numero);
        $DadosRegistro["Complemento"] = CampoTexto($Complemento);
        $DadosRegistro["Bairro"] = CampoTexto($Bairro);
        $DadosRegistro["Cidade"] = CampoTexto($Cidade);
        $DadosRegistro["UF"] = CampoTexto($Estado);
        $DadosRegistro["CEP"] = CampoTexto($CEP);
        $DadosRegistro["Telefone"] = CampoTexto($FoneFixo);
        $DadosRegistro["Celular"] = CampoTexto($Celular);
        $DadosRegistro["Empresa"] = CampoTexto($Emmpresa);
        $DadosRegistro["Nome_Usuario"] = CampoTexto($Usuario);
        $DadosRegistro["Senha_Acesso"] = CampoTexto($Senha);
        $DadosRegistro["Email"] = CampoTexto($Email);
                
        $conexao_bd->SetINSERT($DadosRegistro,"hospedes");

        if(!$conexao_bd->ExecINSERT()) {
            echo "<h3>Erro na execução do comando INSERT</h3>";
        }
        else {
            echo "<h3>Cadastro efetuado com sucesso!</h3>";
        }
    }
        
    $conexao_bd->FecharConexao();
}
else {
    echo $MensagemErro;
}