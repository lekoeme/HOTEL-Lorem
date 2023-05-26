<?php
require_once("../configuracao.php");
require_once("../classBancoDados.inc");
require_once("../funcoes_diversas.php");

session_start();

if(isset($_SESSION["GERENTE_LOGADO"]) && ($_SESSION["GERENTE_LOGADO"] == 1)) {
    echo "<h3>Usuário já logado no sistema...</h3>";
}
else {
    $conexao_bd = new classBancoDados($ServidorMySQL);
        
    if (!$conexao_bd->AbrirConexao()) {
        echo "<h2>Não foi possível conectar com o banco de dados do site</h2><br>";
        echo $conexao_bd->CodigoErro() . " -> " . $conexao_bd->MensagemErro();
    }
    else {
        if(($_REQUEST["Usuario"] != "") && ($_REQUEST["Senha"] != "")) {
            $NomeUsuario = $_REQUEST["Usuario"];
            $SenhaAcesso =$_REQUEST["Senha"];
            $conexao_bd->SetSELECT("Codigo_Usuario,Nome_Usuario,Senha_Acesso,Codigo_Hotel,Nivel_Acesso","usuarios");
            $conexao_bd->SetWHERE("(Nome_Usuario = ".CampoTexto($NomeUsuario).") AND (Senha_Acesso = ".CampoTexto($SenhaAcesso).")");
        
            if($conexao_bd->ExecSELECT()) {
                $NumeroRegistros = $conexao_bd->TotalRegistros();
                $DataSet = $conexao_bd->GetDataSet();
                $Registros = $DataSet->fetch_assoc();
                
                if($NumeroRegistros == 1) {
                    if($Registros["Nivel_Acesso"] == 1) {
                        $_SESSION["GERENTE_LOGADO"] = 1;
                        $_SESSION["NOME_GERENTE"] = $NomeUsuario;
                        $_SESSION["CODIGO_GERENTE"] = $Registros["Codigo_Usuario"];
                        $_SESSION["HOTEL_GERENTE"] = $Registros["Codigo_Hotel"];
                        echo "<h3>Usuário logado com sucesso...</h3>";
                    }
                    else {
                        $_SESSION["GERENTE_LOGADO"] = 0;
                        $_SESSION["NOME_GERENTE"] = "";
                        $_SESSION["CODIGO_GERENTE"] = 0;
                        $_SESSION["HOTEL_GERENTE"] = 0;
                        echo "<h3>Usuário não autorizado a acessar este módulo...</h3>";
                    }
                }
                else {
                    $_SESSION["GERENTE_LOGADO"] = 0;
                    $_SESSION["NOME_GERENTE"] = "";
                    $_SESSION["CODIGO_GERENTE"] = 0;
                    $_SESSION["HOTEL_GERENTE"] = 0;
                    echo "<h3>Usuário/senha inválidos...</h3>";
                }
            }
            else {
                echo "<h2>Erro na execução comando SELECT...</h2>";
            }
        }
    }
        
    $conexao_bd->FecharConexao();
}
