<?php
require_once("../configuracao.php");
require_once("../classBancoDados.inc");
require_once("../funcoes_diversas.php");

$RegistroApartamento = $_GET["RegistroApartamento"];
$DataEntrada = $_GET["DataEntrada"];
$DataSaida = $_GET["DataSaida"];
$CodigoHospede = $_GET["Hospede"];

$conexao_bd = new classBancoDados($ServidorMySQL);
           
if (!$conexao_bd->AbrirConexao()) {
   echo "<h3>Erro na conexão com o banco de dados!<br>" . $conexao_bd->MensagemErro() . "</h3>";
}
else {
    $DadosRegistro["Ocupado"] = "'S'";
    $DadosRegistro["Inicio_Hospedagem"] = CampoTexto($DataEntrada);
    $DadosRegistro["Fim_Hospedagem"] = CampoTexto($DataSaida);
    $DadosRegistro["Codigo_Hospede"] = $CodigoHospede;

    $Clausula = "ID_Registro = $RegistroApartamento";
        
    $conexao_bd->SetUPDATE($DadosRegistro,"apartamentos");
    $conexao_bd->SetWHERE($Clausula);
       
   
    if(!$conexao_bd->ExecUPDATE()) {
        echo "<h3>Erro na execução do comando UPDATE</h3>";
    }
    else {
        header("location: index.php");
    }
}
       
$conexao_bd->FecharConexao();

session_start();
$_SESSION["CODIGO_HOSPEDE"] = 0;
$_SESSION["NOME_HOSPEDE"] = "";

