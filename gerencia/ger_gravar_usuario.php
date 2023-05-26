<?php
require_once("../configuracao.php");
require_once("../classBancoDados.inc");
require_once("../funcoes_diversas.php");

$Codigo = $_REQUEST["CodigoUsuario"];
$Nome = $_REQUEST["NomeUsuario"];
$Senha = $_REQUEST["SenhaAcesso"];
$Nivel = $_REQUEST["NivelAcesso"];
$ErroDados = FALSE;
$MensagemErro = "";

if(trim($Nome) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Nome obrigatório...</h3>";
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
        $DadosRegistro["Nome_Usuario"] = CampoTexto($Nome);
        $DadosRegistro["Senha_Acesso"] = CampoTexto($Senha);
        $DadosRegistro["Nivel_Acesso"] = $Nivel;
                
        $conexao_bd->SetUPDATE($DadosRegistro,"usuarios");
        $conexao_bd->SetWHERE("Codigo_Usuario = $Codigo");

        if(!$conexao_bd->ExecUPDATE()) {
            echo "<h3>Erro na execução do comando UPDATE</h3>";
        }
        else {
            echo "<h3>Cadastro do usuário atualizado com sucesso!</h3>";
        }
    }
        
    $conexao_bd->FecharConexao();
}
else {
    echo $MensagemErro;
}
