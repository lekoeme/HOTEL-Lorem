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
                    var registro  = $("input[name=CodigoApartamento]").val();
                    var numero_chave  = $("input[name=NumeroChave]").val();
                    var tipo_apartamento = $("select[name=TipoApartamento]").val();
                    var tipo_acomodacao = $("select[name=TipoAcomodacao]").val();
                    var camas = $("input[name=Camas]").val();
                    var tem_tv = ($("input[name=TV]").is(":checked")) ? "S":"N";
                    var tem_frigobar = ($("input[name=Frigobar]").is(":checked")) ? "S":"N";
                    var tem_banheira = ($("input[name=Banheira]").is(":checked")) ? "S":"N";
                    var tem_escrivaninha = ($("input[name=Escrivaninha]").is(":checked")) ? "S":"N";

                    $.ajax({
                        "url": "ger_gravar_apartamento.php",
                        "dataType": "html",
                        "data": { "Registro":registro,
                                  "NumeroChave":numero_chave,
                                  "TipoApartamento":tipo_apartamento,
                                  "TipoAcomodacao":tipo_acomodacao,
                                  "Camas":camas,
                                  "TV":tem_tv,
                                  "Frigobar":tem_frigobar,
                                  "Banheira":tem_banheira,
                                  "Escrivaninha":tem_escrivaninha },
                        "success": function(response) { $("div#retorno").html(response);
                                                        setTimeout("location.href = 'index.php'",5000); }
                    });
                });
            });
        </script>
        
    </head>
    <body>
        <?php
        require_once("../classApartamento.inc");
        require_once("../funcoes_diversas.php");

        $CodigoApartamento = $_GET["RegistroApartamento"];
        
        $DadosApartamento = new classApartamento();

        $DadosApartamento = RecuperaDadosApartamento($CodigoApartamento);
        ?>
        
        <div class="formulario" id="formulario">
        <p class="titulo-formulario">Edição de Usuário</p>
        <form name="formEditarApartamento">
            <input name="CodigoApartamento" value="<?=$CodigoApartamento;?>" type="hidden">
            Nro. apto: <?=$DadosApartamento->GetNumeroApartamento()?>&nbsp
            Número da chave: <input maxlength="2" size="2" name="NumeroChave" value="<?=$DadosApartamento->GetNumeroChave()?>"><br>
            Tipo de apartamento:
            <select name="TipoApartamento">
                <option value="1"
                <?php if($DadosApartamento->GetTipoApartamento() == 1) { ?>selected="selected"<?php } ?>
                >Solteiro</option>
                <option value="2"
                <?php if($DadosApartamento->GetTipoApartamento() == 2) { ?>selected="selected"<?php } ?>
                >Casal</option>
            </select><br>
            
            Tipo de acomodação:
            <select name="TipoAcomodacao">
                <option value="1"
                <?php if($DadosApartamento->GetTipoAcomodacao() == 1) { ?>selected="selected"<?php } ?>
                >Standard</option>
                <option value="2"
                <?php if($DadosApartamento->GetTipoAcomodacao() == 2) { ?>selected="selected"<?php } ?>
                >Luxo</option>
                <option value="3"
                <?php if($DadosApartamento->GetTipoAcomodacao() == 3) { ?>selected="selected"<?php } ?>
                >Suíte</option>
            </select><br>
            Camas: <input maxlength="2" size="2" name="Camas" value="<?=$DadosApartamento->GetCamas()?>"><br>
            <input name="TV" value="TV" type="checkbox"
            <?php if($DadosApartamento->GetTV() == "S") { ?>checked="checked"<?php } ?>
            >TV
            <input name="Frigobar" value="Frigobar" type="checkbox"
            <?php if($DadosApartamento->GetFrigobar() == "S") { ?>checked="checked"<?php } ?>
            >Frigobar
            <input name="Banheira" value="Banheira" type="checkbox"
            <?php if($DadosApartamento->GetBanheira() == "S") { ?>checked="checked"<?php } ?>
            >Banheira
            <input name="Escrivaninha" value="Escrivaninha" type="checkbox"
            <?php if($DadosApartamento->GetEscrivaninha() == "S") { ?>checked="checked"<?php } ?>
            >Escrivaninha<br>

            <button type="button" name="btnConfirmar" id="btnConfirmar">Confirmar</button>
            <br><br>
        </form>
        </div>
        <div id="retorno"></div>
    </body>
</html>