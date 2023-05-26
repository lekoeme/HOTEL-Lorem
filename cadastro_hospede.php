<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <meta content="Cadastro de Hóspedes" name="description">
        <title>Hotel LOREM IPSUM</title>
        <link rel="stylesheet" href="css/estilos_gerais.css" type="text/css">
        <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#btnConfirmar").click(function() {
                    var nome_hospede  = $("input[name=NomeHospede]").val();
                    var dia_nascimento = $("input[name=DiaNascimento]").val();
                    var mes_nascimento = $("input[name=MesNascimento]").val();
                    var ano_nascimento = $("input[name=AnoNascimento]").val();
                    var numero_cpf = $("input[name=NumeroCPF]").val();
                    var numero_rg = $("input[name=NumeroRG]").val();
                    var endereco = $("input[name=Endereco]").val();
                    var numero = $("input[name=Numero]").val();
                    var complemento = $("input[name=Complemento]").val();
                    var bairro = $("input[name=Bairro]").val();
                    var cidade = $("input[name=Cidade]").val();
                    var estado = $("select[name=Estado]").val();
                    var cep = $("input[name=CEP]").val();
                    var telefone = $("input[name=Telefone]").val();
                    var celular = $("input[name=Celular]").val();
                    var empresa = $("input[name=Empresa]").val();
                    var usuario = $("input[name=NomeUsuario]").val();
                    var senha = $("input[name=SenhaAcesso]").val();
                    var email = $("input[name=Email]").val();

                    $.ajax({
                        "url": "incluir_hospede.php",
                        "dataType": "html",
                        "data": { "NomeHospede":nome_hospede,
                                  "DiaNascimento":dia_nascimento,
                                  "MesNascimento":mes_nascimento,
                                  "AnoNascimento":ano_nascimento,
                                  "NumeroCPF":numero_cpf,
                                  "NumeroRG":numero_rg,
                                  "Endereco":endereco,
                                  "Numero":numero,
                                  "Complemento":complemento,
                                  "Bairro":bairro,
                                  "Cidade":cidade,
                                  "Estado":estado,
                                  "CEP":cep,
                                  "Telefone":telefone,
                                  "Celular":celular,
                                  "Empresa":empresa,
                                  "NomeUsuario":usuario,
                                  "SenhaAcesso":senha,
                                  "Email":email },
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
        <div class="formulario" id="formulario">
        <p class="titulo-formulario">Cadastro de Hóspede</p>
        <form name="formCadastroHospede">
            <p>Nome:<input maxlength="50" size="50" tabindex="1" name="NomeHospede"></p>
            <p>Data de nascimento:<input maxlength="2" size="2" tabindex="2" name="DiaNascimento">/<input maxlength="2" size="2" tabindex="3" name="MesNascimento">/<input maxlength="4" size="4" tabindex="4" name="AnoNascimento"></p>
            <p>RG:<input maxlength="12" size="12" tabindex="5" name="NumeroRG"> CPF:<input maxlength="14" size="14" tabindex="6" name="NumeroCPF"></p>
            <p>Endereço:<input maxlength="50" size="50" tabindex="7" name="Endereco"> <input maxlength="10" size="10" tabindex="8" name="Numero"></p>
            <p>Compl.:<input maxlength="20" size="20" tabindex="9" name="Complemento"> Bairro:<input maxlength="40" size="40" tabindex="10" name="Bairro"></p>
            <p>Cidade:<input maxlength="40" size="40" tabindex="11" name="Cidade"> Estado:
            <?php
            require_once("funcoes_diversas.php");
            echo Estados(12);
            ?>
            </p>
            <p>CEP:<input maxlength="9" size="9" tabindex="13" name="CEP"> Telefone:<input maxlength="18" size="18" tabindex="14" name="Telefone"> Celular:<input maxlength="18" size="18" tabindex="15" name="Celular"></p>
            <p>Empresa onde trabalha:<input maxlength="50" size="50" tabindex="16" name="Empresa"></p>
            <p>Nome usuário:<input maxlength="20" size="20" tabindex="17" name="NomeUsuario"></p>
            <p>Senha:<input maxlength="12" size="12" tabindex="18" name="SenhaAcesso" type="password"></p>
            <p>Email:<input maxlength="80" size="80" tabindex="19" name="Email"></p><br>
            <button type="button" name="btnConfirmar" id="btnConfirmar">Confirmar</button>
            <button type="button" name="btnCancelar" onclick="fechar_formulario()">Cancelar</button>
            <br><br><br>
        </form>
        </div>
        <div id="retorno"></div>
    </body>
</html>