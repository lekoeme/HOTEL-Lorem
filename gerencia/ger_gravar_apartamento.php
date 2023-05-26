<?php
require_once("../configuracao.php");
require_once("../classBancoDados.inc");
require_once("../funcoes_diversas.php");

$Registro = $_REQUEST["Registro"];
$NumeroChave = $_REQUEST["NumeroChave"];
$TipoApartamento = $_REQUEST["TipoApartamento"];
$TipoAcomodacao = $_REQUEST["TipoAcomodacao"];
$Camas = $_REQUEST["Camas"];
$TV = $_REQUEST["TV"];
$Frigobar = $_REQUEST["Frigobar"];
$Banheira = $_REQUEST["Banheira"];
$Escrivaninha = $_REQUEST["Escrivaninha"];
$ErroDados = FALSE;
$MensagemErro = "";

if(trim($NumeroChave) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Número da chave obrigatório...</h3>";
}

if(!$ErroDados)  {
    $conexao_bd = new classBancoDados($ServidorMySQL);
           
    if (!$conexao_bd->AbrirConexao()) {
        echo "<h3>Erro na conexão com o banco de dados!<br>" . $conexao_bd->MensagemErro() . "</h3>";
    }
    else {
        $DadosRegistro["Numero_Chave"] = $NumeroChave;
        $DadosRegistro["Tipo_Apartamento"] = $TipoApartamento;
        $DadosRegistro["Tipo_Acomodacao"] = $TipoAcomodacao;
        $DadosRegistro["Quantidade_Cama"] = $Camas;
        $DadosRegistro["Tem_TV"] = CampoTexto($TV);
        $DadosRegistro["Tem_Frigobar"] = CampoTexto($Frigobar);
        $DadosRegistro["Tem_Banheira"] = CampoTexto($Banheira);
        $DadosRegistro["Tem_Escrivaninha"] = CampoTexto($Escrivaninha);
                
        $conexao_bd->SetUPDATE($DadosRegistro,"apartamentos");
        $conexao_bd->SetWHERE("ID_Registro = $Registro");

        if(!$conexao_bd->ExecUPDATE()) {
            echo "<h3>Erro na execução do comando UPDATE</h3>";
        }
        else {
            echo "<h3>Dados de apartamento atualizados com sucesso!</h3>";
        }
    }
        
    $conexao_bd->FecharConexao();
}
else {
    echo $MensagemErro;
}
