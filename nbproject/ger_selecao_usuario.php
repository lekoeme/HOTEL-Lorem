<?php
require_once("../configuracao.php");
require_once("../classBancoDados.inc");
require_once("../funcoes_diversas.php");

echo "<link rel='stylesheet' href='../css/retorno_consulta.css' type='text/css'>";
echo "<script language='JavaScript'>function fechar_formulario() { location.href='index.php';}</script>";

session_start();

if(isset($_SESSION["GERENTE_LOGADO"]) && ($_SESSION["GERENTE_LOGADO"] == 1)) {
    $conexao_bd = new classBancoDados($ServidorMySQL);
        
    if (!$conexao_bd->AbrirConexao()) {
        echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
        echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
    }
    else {
        $conexao_bd->SetSELECT("*","usuarios");
        $conexao_bd->SetWHERE("Codigo_Hotel = ".$_SESSION["HOTEL_GERENTE"]);
        $conexao_bd->SetORDER("Nome_Usuario");

        if($conexao_bd->ExecSELECT()) {
            $NumeroRegistros = $conexao_bd->TotalRegistros();
            $DataSet = $conexao_bd->GetDataSet();
            
            if($NumeroRegistros > 0) {
                echo "<p class='titulo-formulario'>Edição de usuário</p>";
                echo "<br><br>";
                echo "<div class='retorno-consulta'>";
                echo "<table>";
                echo "<tr><th>Usuário</th><th>Nível de acesso</th><th></th></tr>";
          
                while($Registros = $DataSet->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$Registros["Nome_Usuario"]."</td>";
                    
                    if($Registros["Nivel_Acesso"] == 1) {
                      echo "<td>Gerência</td>";
                    }
                    else {
                         echo "<td>Atendimento</td>";
                    }

                    echo "<td><a href='ger_editar_usuario.php?CodigoUsuario=".$Registros["Codigo_Usuario"]."'>Editar</a></td>";
                    echo "</tr>";
                }
                
                echo "</table>";
                echo "</div>";
            }
            else {
                echo "<h3>Não existe usuário para exibição...</h3>";
            }
        }
        else {
            echo "<h2>Erro na execução comando SELECT...</h2>";
        }
    }
        
    $conexao_bd->FecharConexao();
}
else {
    echo "<h3>Para editar um usuário é preciso estar logado no sistema...</h3>";
}

echo "<br><br>";
echo "<button type='button' name='btnFechar' onclick='fechar_formulario()'>Fechar</button>";
