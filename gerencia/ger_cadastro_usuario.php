<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <meta content="Cadastro de Hóspedes" name="description">
        <title>Hotel LOREM IPSUM</title>
        <link rel="stylesheet" href="../css/estilos_gerais.css" type="text/css">
        <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#btnConfirmar").click(function() {
                    var nome_usuario  = $("input[name=NomeUsuario]").val();
                    var senha = $("input[name=SenhaAcesso]").val();
                    var nivel_acesso = $("select[name=NivelAcesso]").val();

                    $.ajax({
                        "url": "ger_incluir_usuario.php",
                        "dataType": "html",
                        "data": { "NomeUsuario":nome_usuario,
                                  "SenhaAcesso":senha,
                                  "NivelAcesso":nivel_acesso },
                        "success": function(response) { $("div#retorno").html(response); }
                    });
                });
            });
        </script>
        
        <script language="JavaScript">
            function fechar_formulario() {
                location.href="index.php";
            }
        </script>
    </head>
    <body>
        <?php 
        session_start();

        if(isset($_SESSION["GERENTE_LOGADO"]) && ($_SESSION["GERENTE_LOGADO"] == 1)) {
            $CodigoGerente = $_SESSION["CODIGO_GERENTE"];
        }
        else {
            $CodigoGerente = "";
        }
        ?>
        
        <div class="formulario" id="formulario">
        <p class="titulo-formulario">Cadastro de Usuário</p>
        <form name="formCadastroUsuario">
            <?php if($CodigoGerente != "") { ?>
            <p>Identificação do usuário:<input maxlength="20" size="20" name="NomeUsuario"></p>
            <p>Senha de acesso:<input maxlength="10" size="10" type="password" name="SenhaAcesso"></p>
            <p>Nível de acesso: 
            <select name="NivelAcesso">
                <option value="2">Atendimento</option>
                <option value="1">Gerência</option>
            </select>
            </p>
            <button type="button" name="btnConfirmar" id="btnConfirmar">Confirmar</button>
            <button type="button" name="btnCancelar" onclick="fechar_formulario()">Cancelar</button>
            <br><br><br>
            <?php } else { ?>
            <p>Para cadastrar um usuário é preciso estar logado no sistema!</p>
            <button type="button" name="btnFechar" onclick="fechar_formulario()">Fechar</button>
            <?php } ?>
        </form>
        </div>
        <div id="retorno"></div>
    </body>
</html>