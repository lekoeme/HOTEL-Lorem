<?php
require_once("configuracao.php");
require_once("classBancoDados.inc");
require_once("funcoes_diversas.php");

echo "<link rel='stylesheet' href='css/retorno_consulta.css' type='text/css'>";
echo "<script language='JavaScript'>function fechar_formulario() { location.href='index.php';}</script>";

session_start();

if(isset($_SESSION["USUARIO_LOGADO"]) && ($_SESSION["USUARIO_LOGADO"] == 1)) {
    $CodigoHospede = $_SESSION["CODIGO_HOSPEDE"];
    $conexao_bd = new classBancoDados($ServidorMySQL);
        
    if (!$conexao_bd->AbrirConexao()) {
        echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
        echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
    }
    else {
        $Campos = "hoteis.Endereco,hoteis.Numero,hoteis.Bairro,hoteis.Cidade,hoteis.UF,apartamentos.Numero_Apartamento,".
                  "apartamentos.Valor_Diaria,DATE_FORMAT(historico_hospedagem.Inicio_Hospedagem,'%d/%m/%Y') AS DataEntrada,".
                  "DATE_FORMAT(historico_hospedagem.Fim_Hospedagem,'%d/%m/%Y') AS DataSaida";
        $Clausula = "(historico_hospedagem.Codigo_Hospede = $CodigoHospede) AND (historico_hospedagem.Codigo_Apartamento = apartamentos.ID_Registro)".
                    "AND (apartamentos.Codigo_Hotel = hoteis.Codigo_Hotel)";
        
        $conexao_bd->SetSELECT($Campos,"apartamentos,hoteis,historico_hospedagem");
        $conexao_bd->SetWHERE($Clausula);
        $conexao_bd->SetORDER("historico_hospedagem.Inicio_Hospedagem");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                echo "<p class='titulo-formulario'>Histórico de Hospedagens</p>";
                echo "<br><br>";
                echo "<div class='retorno-consulta'>";
                echo "<table>";
                echo "<tr><th>Apto</th><th>Endereço</th><th>Bairro</th><th>Cidade</th><th>UF</th><th>Entrada</th><th>Saída</th><th>Diária</th></tr>";
          
                while($Registros = $DataSet->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$Registros["Numero_Apartamento"]."</td>";
                    echo "<td>".trim($Registros["Endereco"]).", ".trim($Registros["Numero"])."</td>";
                    echo "<td>".$Registros["Bairro"]."</td>";
                    echo "<td>".$Registros["Cidade"]."</td>";
                    echo "<td>".$Registros["UF"]."</td>";
                    echo "<td>".$Registros["DataEntrada"]."</td>";
                    echo "<td>".$Registros["DataSaida"]."</td>";
                    echo "<td>".number_format($Registros["Valor_Diaria"],2,",","")."</td>";
                    echo "</tr>";
                }
                
                echo "</table>";
                echo "</div>";
            }
            else {
                echo "<h3>Não existe histórico para exibição...</h3>";
            }
        }
        else {
            echo "<h2>Erro na execução comando SELECT...</h2>";
        }
    }
        
    $conexao_bd->FecharConexao();
}
else {
    echo "<h3>Para visualizar O histórico, efetue o login no sistema...</h3>";
}

echo "<br><br>";
echo "<button type='button' name='btnFechar' onclick='fechar_formulario()'>Fechar</button>";