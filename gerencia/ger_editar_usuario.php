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
                    var codigo_usuario  = $("input[name=CodigoUsuario]").val();
                    var nome_usuario  = $("input[name=NomeUsuario]").val();
                    var senha_acesso = $("input[name=SenhaAcesso]").val();
                    var nivel_acesso = $("select[name=NivelAcesso]").val();

                    $.ajax({
                        "url": "ger_gravar_usuario.php",
                        "dataType": "html",
                        "data": { "CodigoUsuario":codigo_usuario,
                                  "NomeUsuario":nome_usuario,
                                  "SenhaAcesso":senha_acesso,
                                  "NivelAcesso":nivel_acesso },
                        "success": function(response) { $("div#retorno").html(response);
                                                        setTimeout("location.href = 'index.php'",5000); }
                    });
                });
            });
        </script>
        
    </head>
    <body>
        <?php
        require_once("../classUsuario.inc");
        require_once("../funcoes_diversas.php");

        $CodigoUsuario = $_GET["CodigoUsuario"];
        
        $DadosUsuario = new classUsuario();

        $DadosUsuario = RecuperaDadosUsuario($CodigoUsuario);
        ?>
        
        <div class="formulario" id="formulario">
        <p class="titulo-formulario">Edição de Usuário</p>
        <form name="formEditarUsuario">
            <input name="CodigoUsuario" value="<?=$CodigoUsuario;?>" type="hidden">
            <p>Nome do usuário:<input value="<?=$DadosUsuario->GetNomeUsuario();?>" maxlength="20" size="20" tabindex="1" name="NomeUsuario"></p>
            <p>Senha de acesso:<input value="<?=$DadosUsuario->GetSenhaAcesso();?>" maxlength="10" size="10" tabindex="2" type="password" name="SenhaAcesso"></p>
            <p>Nível de acesso:
            <select name="NivelAcesso">
                <option value="2"
                <?php if($DadosUsuario->GetNivelAcesso() == 2) { ?>selected="selected"<?php } ?>
                >Atendimento</option>
            
                <option value="1"
                <?php if($DadosUsuario->GetNivelAcesso() == 1) { ?>selected="selected"<?php } ?>
                >Gerência</option> 
            </select>
            </p>
            <button type="button" name="btnConfirmar" id="btnConfirmar">Confirmar</button>
            <br><br>
        </form>
        </div>
        <div id="retorno"></div>
    </body>
</html>