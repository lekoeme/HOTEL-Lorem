<?php
require_once("../configuracao.php");
require_once("../classBancoDados.inc");
require_once("../funcoes_diversas.php");

$NomeUsuario = $_REQUEST["NomeUsuario"];
$SenhaAcesso = $_REQUEST["SenhaAcesso"];
$NivelAcesso = $_REQUEST["NivelAcesso"];
$ErroDados = FALSE;
$MensagemErro = "";

if(trim($NomeUsuario) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Nome do usuário obrigatório...</h3>";
}

if(trim($SenhaAcesso) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Senha obrigatória...</h3>";
}

if(!$ErroDados)  {
    session_start();

    $conexao_bd = new classBancoDados($ServidorMySQL);
           
    if (!$conexao_bd->AbrirConexao()) {
        echo "<h3>Erro na conexão com o banco de dados!<br>" . $conexao_bd->MensagemErro() . "</h3>";
    }
    else {
        $DadosRegistro["Nome_Usuario"] = CampoTexto($NomeUsuario);
        $DadosRegistro["Senha_Acesso"] = CampoTexto($SenhaAcesso);
        $DadosRegistro["Nivel_Acesso"] = $NivelAcesso;
        $DadosRegistro["Codigo_Hotel"] = $_SESSION["HOTEL_GERENTE"];
        
        $conexao_bd->SetINSERT($DadosRegistro,"usuarios");

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
