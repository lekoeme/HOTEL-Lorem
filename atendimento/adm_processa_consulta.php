<?php
require_once("../configuracao.php");
require_once("../classBancoDados.inc");
require_once("../funcoes_diversas.php");

session_start();

if(isset($_SESSION["CODIGO_HOTEL"])) {
    $CodigoHotel = $_SESSION["CODIGO_HOTEL"];
}
else {
    $CodigoHotel = 0;
}

if(isset($_SESSION["CODIGO_HOSPEDE"])) {
    $CodigoHospede = $_SESSION["CODIGO_HOSPEDE"];
}
else {
    $CodigoHospede = 0;
}

if($CodigoHotel != 0) {
    $conexao_bd = new classBancoDados($ServidorMySQL);
        
    if (!$conexao_bd->AbrirConexao()) {
       echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
       echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
    }
    else {
        if($_REQUEST["DataEntrada"] != "") {
            $DataEntrada = DataInvertida($_REQUEST["DataEntrada"]);
            $DataSaida = DataInvertida($_REQUEST["DataSaida"]);
            $Campos = "apartamentos.ID_Registro,apartamentos.Numero_Apartamento,apartamentos.Valor_Diaria,Tem_TV,Tem_Frigobar,Tem_Banheira,Tem_Escrivaninha,Quantidade_Cama";
            $Clausula = "(apartamentos.Ocupado = 'N') AND (apartamentos.Tipo_Apartamento = ".$_REQUEST["TipoApartamento"].")".
                        " AND (apartamentos.Tipo_Acomodacao = ".$_REQUEST["TipoAcomodacao"].") AND (apartamentos.Codigo_Hotel = $CodigoHotel)";
        
            $conexao_bd->SetSELECT($Campos,"apartamentos");
            $conexao_bd->SetWHERE($Clausula);
            $conexao_bd->SetORDER("apartamentos.Numero_Apartamento");

            if($conexao_bd->ExecSELECT()) {
                $NumeroRegistros = $conexao_bd->TotalRegistros();
                $DataSet = $conexao_bd->GetDataSet();
            
                if($NumeroRegistros > 0) {
                    echo "<br><br>";
                    echo "<div class='retorno-consulta'>";
                    echo "<table>";
                    echo "<tr><th>Apto</th><th>TV</th><th>Frigobar</th><th>Banheira</th><th>Escrivaninha</th><th>Camas</th><th></th></tr>";
          
                    while($Registros = $DataSet->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$Registros["Numero_Apartamento"]."</td>";
                        echo "<td>".$Registros["Tem_TV"]."</td>";
                        echo "<td>".$Registros["Tem_Frigobar"]."</td>";
                        echo "<td>".$Registros["Tem_Banheira"]."</td>";
                        echo "<td>".$Registros["Tem_Escrivaninha"]."</td>";
                        echo "<td>".$Registros["Quantidade_Cama"]."</td>";
                        
                        if($CodigoHospede != 0) {
                            echo "<td><a href='adm_registrar_reserva.php?RegistroApartamento=".$Registros["ID_Registro"].
                                 "&DataEntrada=$DataEntrada&DataSaida=$DataSaida&Hospede=$CodigoHospede'>Reservar</a></td>";
                        }
                        echo "</tr>";
                    }
                
                    echo "</table>";
                    echo "</div>";
                }
                else {
                    echo "<br><br>";
                    echo "<h3>Não existem vagas disponíveis...</h3>";
               }
            }
            else {
                echo "<h2>Erro na execução comando SELECT...</h2>";
            }
        }
    }
        
    $conexao_bd->FecharConexao();
}