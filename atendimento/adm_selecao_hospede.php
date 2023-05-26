<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <title>Seleção de hóspede</title>
        <link rel="stylesheet" href="../css/estilos_gerais.css" type="text/css">
        <link rel='stylesheet' href='../css/retorno_consulta.css' type='text/css'>
        <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.4.0.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css">
  
        <script>
            $(document).ready(function() {
                $("#btnPesquisar").click(function() {
                    var nome = $("input[name=Nome]").val();
                    var cpf = $("input[name=CPF]").val();

                    $.ajax({
                        "url": "adm_visualiza_hospede.php",
                        "dataType": "html",
                        "data": { "NomeHospede":nome,
                                  "NumeroCPF":cpf },
                        "success": function(response) { $("div#retorno").html(response); }
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="formulario" id="formulario">
        <p class="titulo-formulario">Seleção de Hóspede</p>

        <form name="formSelecaoHospede">
            Nome:<input maxlength="50" size="50" name="Nome"><br>
            CPF:<input maxlength="14" size="14" name="CPF"><br><br>
            <button type="button" name="Pesquisar" id="btnPesquisar">Pesquisar</button>
        </form>
        </div>
       
        <div id="retorno"></div>
    </body>
</html>
