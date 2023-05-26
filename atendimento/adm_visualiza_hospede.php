<?php
require_once("../configuracao.php");
require_once("../classBancoDados.inc");
require_once("../funcoes_diversas.php");

session_start();

if(!isset($_SESSION["CODIGO_HOSPEDE"])) {
    $_SESSION["CODIGO_HOSPEDE"] = 0;
}

$conexao_bd = new classBancoDados($ServidorMySQL);
        
if (!$conexao_bd->AbrirConexao()) {
    echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
    echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
}
else {
    $Clausula = "";
    $NomeHospede = $_REQUEST["NomeHospede"];
    $CPF = $_REQUEST["NumeroCPF"];
    
    if(trim($NomeHospede) != "") {
        $Clausula = "Nome_Hospede LIKE '".$NomeHospede."%'";
    }

    if(trim($CPF) != "") {
        $Clausula = "CPF = '".$CPF."'";
    }
    
    if($Clausula != "") {
        $conexao_bd->SetSELECT("Codigo_Hospede,Nome_Hospede,CPF,Cidade,UF","hospedes");
        $conexao_bd->SetWHERE($Clausula);
    
        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                echo "<br><br>";
                echo "<div class='retorno-consulta'>";
                echo "<table>";
                echo "<tr><th>Nome</th><th>CPF</th><th>Cidade</th><th>Estado</th><th></th></tr>";
          
                while($Registros = $DataSet->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$Registros["Nome_Hospede"]."</td>";
                    echo "<td>".$Registros["CPF"]."</td>";
                    echo "<td>".$Registros["Cidade"]."</td>";
                    echo "<td>".$Registros["UF"]."</td>";
                    echo "<td><a href='adm_guarda_hospede.php?CodigoHospede=".$Registros["Codigo_Hospede"].
                            "&NomeHospede=".$Registros["Nome_Hospede"]."'>Selecionar</a></td>";
                    echo "</tr>";
                }
                
                echo "</table>";
                echo "</div>";
            }
            else {
                echo "<br><br>";
                echo "<h3>Nenhum registro encontrado...</h3>";
            }
            
            }
    else {
        echo "<h2>Erro na execução comando SELECT...</h2>";
    }
    }
}
        
$conexao_bd->FecharConexao();
