<?php
require_once("configuracao.php");
require_once("classBancoDados.inc");
require_once("funcoes_diversas.php");

session_start();

$Hotel = $_REQUEST["CodigoHotel"];
$Apartamento = $_REQUEST["NumeroApartamento"];
$DataEntrada = $_REQUEST["DataEntrada"];
$DataSaida = $_REQUEST["DataSaida"];
$ErroDados = FALSE;
$MensagemErro = "";

if(trim($Hotel) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Nenhum hotel selecionado...</h3>";
}

if(trim($Apartamento) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Nenhum apartamento informado...</h3>";
}

if(trim($DataEntrada) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Data de entrada não fornecida...</h3>";
}

if(trim($DataSaida) == "") {
    $ErroDados = TRUE;
    $MensagemErro .= "<h3>Data de saída não fornecida...</h3>";
}

if(!$ErroDados)  {
    $conexao_bd = new classBancoDados($ServidorMySQL);
           
    if (!$conexao_bd->AbrirConexao()) {
       echo "<h3>Erro na conexão com o banco de dados!<br>" . $conexao_bd->MensagemErro() . "</h3>";
    }
    else {
        $Clausula = "(Codigo_Hotel = $Hotel) AND (Numero_Apartamento = $Apartamento) AND (Ocupado = 'N')";
        $conexao_bd->SetSELECT("ID_Registro","apartamentos");
        $conexao_bd->SetWHERE($Clausula);

        if($conexao_bd->ExecSELECT()) {
           $NumeroRegistros = $conexao_bd->TotalRegistros();
                
            if($NumeroRegistros == 0) {
                echo "<h3>Apartamento não disponível...</h3>";
            }
            else {
                $DadosRegistro["Ocupado"] = "'S'";
                $DadosRegistro["Inicio_Hospedagem"] = CampoTexto(DataInvertida($DataEntrada));
                $DadosRegistro["Fim_Hospedagem"] = CampoTexto(DataInvertida($DataSaida));
                $DadosRegistro["Codigo_Hospede"] = $_SESSION["CODIGO_HOSPEDE"];

                $Clausula = "(Codigo_Hotel = $Hotel) AND (Numero_Apartamento = $Apartamento)";
        
                $conexao_bd->SetUPDATE($DadosRegistro,"apartamentos");
                $conexao_bd->SetWHERE($Clausula);
            
                if(!$conexao_bd->ExecUPDATE()) {
                    echo "<h3>Erro na execução do comando UPDATE</h3>";
                }
                else {
                    echo "<h3>Reserva efetuada com sucesso!</h3>";
                }
            }
        }
    }
        
    $conexao_bd->FecharConexao();
}
else {
    echo $MensagemErro;
}