<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <title>Consulta de apartamento</title>
        <link rel="stylesheet" href="../css/estilos_gerais.css" type="text/css">
        <link rel='stylesheet' href='../css/retorno_consulta.css' type='text/css'>
        <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.4.0.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css">
  
        <script>
            $(function() {$(".data").datepicker({
                    showOn: "button",
                    buttonImage: "../imagens/calendario.png",
                    buttonImageOnly: true,
                    changeMonth: true,
                    changeYear: true,
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'] } );
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#btnPesquisar").click(function() {
                    var data_entrada  = $("input[name=DataEntrada]").val();
                    var data_saida = $("input[name=DataSaida]").val();
                    var tipo_apartamento = $("select[name=TipoApartamento]").val();
                    var tipo_acomodacao = $("select[name=TipoAcomodacao]").val();

                    $.ajax({
                        "url": "adm_processa_consulta.php",
                        "dataType": "html",
                        "data": { "DataEntrada":data_entrada,
                                  "DataSaida":data_saida,
                                  "TipoApartamento":tipo_apartamento,
                                  "TipoAcomodacao":tipo_acomodacao },
                        "success": function(response) { $("div#retorno").html(response); }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#btnFechar").click(function() { $(location).attr("href","index.php"); });
            });
        </script>
    </head>
    <body>
        <?php
        session_start();

        if(isset($_SESSION["NOME_HOSPEDE"])) {
            $NomeHospede = $_SESSION["NOME_HOSPEDE"];
        }
        else {
            $NomeHospede = "";
        }
        ?>
        
        <div class="formulario" id="formulario">
        <p class="titulo-formulario">Consulta de Apartamentos Para Reserva</p>

        <form name="formConsultaApartamento">
            <?php if($NomeHospede != "") { ?>
            <p>Cliente: <?=$NomeHospede?></p><br>
            <?php }?>
            Data de entrada:<input maxlength="10" size="10" tabindex="1" name="DataEntrada" class="data">
            Data de saída:<input maxlength="10" size="10" tabindex="2" name="DataSaida" class="data"><br>
            Tipo de apartamento:
            <select tabindex="3" name="TipoApartamento">
                <option value="1">Solteiro</option>
                <option value="2">Casal</option>
            </select><br>
            Tipo de acomodação:
            <select tabindex="4" name="TipoAcomodacao">
                <option value="1">Standard</option>
                <option value="2">Luxo</option>
                <option value="3">Suíte</option>
            </select><br>
            <button type="button" name="Pesquisar" id="btnPesquisar">Pesquisar</button>
            <button type="button" name="Fechar" id="btnFechar">Fechar</button>
        </form>
        </div>
       
        <div id="retorno"></div>
    </body>
</html>