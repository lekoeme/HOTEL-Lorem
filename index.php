<!DOCTYPE HTML>
<html>
 <head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <meta content="Site Hotel LOREM IPSUM" name="description">
  <title>Hotel LOREM IPSUM</title>
  <link rel="stylesheet" href="css/estilos_gerais.css" type="text/css">
  <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css">
  
  <script>
   $(function() {$( "#calendario" ).datepicker({ changeMonth: true, 
                                                 changeYear: true, 
												 showOtherMonths: true,
												 selectOtherMonths: true,
                                                 dateFormat: 'dd/mm/yy',
                                                 dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                                                 dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                                                 dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                                                 monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                                                 monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'] } );});
  </script>
 
  <script>
      function carregar(pagina){$("#conteudo").load(pagina);}
  </script>
  
  <script>
      function formulario_cadastro(pagina){$(".conteudo-corpo").load(pagina);}
  </script>
        
 </head>

 <body class="corpo-documento">
     <?php
     session_start();

     if(isset($_SESSION["USUARIO_LOGADO"]) && ($_SESSION["USUARIO_LOGADO"] == 1)) {
         $NomeUsuario = $_SESSION["NOME_USUARIO"];
     }
     else {
         $NomeUsuario = "";
     }
     ?>
  <div class="topo-pagina">
   <div class="base-pagina">
    <div class="pagina">
     <div class="main">
      <div class="header">
       <div class="header-topo">
        <h1>Hotel LOREM IPSUM </h1>
        <h2>A rede de hotéis com tudo que você precisa para seu descanso e lazer</h2>
       </div>
       <div class="header-base">
           <p>Usuário: <?=$NomeUsuario?></div></p>
       </div>
       <div class="barra-menu">
        <div class="dropdown">
         <button class="dropbutton" onclick="carregar('consulta_apartamento.php')">Consulta</button>
        </div>
        <div class="dropdown">
         <button class="dropbutton">Cadastro</button>
         <div class="dropdown-opcoes">
             <a onclick="formulario_cadastro('cadastro_hospede.php')" href="#">Adicionar cliente</a>
             <a onclick="formulario_cadastro('editar_cadastro.php')" href="#">Editar cliente</a>
         </div>
        </div>
        <div class="dropdown">
         <button class="dropbutton" onclick="carregar('reserva_apartamento.php')">Reserva</button>
        </div>
        <div class="dropdown">
         <button class="dropbutton" onclick="formulario_cadastro('historico_hospedagem.php')">Histórico</button>
        </div>
        <div class="dropdown">
         <button class="dropbutton" onclick="carregar('login.html')">Login</button>
        </div>
       </div>
      </div>
      <div class="conteudo-corpo">
       <div class="coluna-esquerda">
           <?php
           require_once("configuracao.php");
           require_once("classBancoDados.inc");
           
           $conexao_bd = new classBancoDados($ServidorMySQL);
           
           if (!$conexao_bd->AbrirConexao()) {
               echo "<p>Erro na conexão com o banco de dados!<br>" . $conexao_bd->MensagemErro() . "</p>";
           }
           else {
               $conexao_bd->SetSELECT("*","hoteis");
               $conexao_bd->SetORDER("UF,Cidade");

               if($conexao_bd->ExecSELECT()) {
                   $NumeroRegistros = $conexao_bd->TotalRegistros();
                   $DataSet = $conexao_bd->GetDataSet();
                
                   if($NumeroRegistros > 0) {
                       while($Registros = $DataSet->fetch_assoc()) {
                           $EnderecoHotel = "<p><b>" . trim($Registros["Endereco"]) . ", " . trim($Registros["Numero"]) . "<br>";
                           $EnderecoHotel .= trim($Registros["Bairro"]) . " - " . $Registros["Cidade"] . "<br>";
                           $EnderecoHotel .= $Registros["UF"] . " - Fone: " . $Registros["Telefone"] . "<br></b></p>";
                           echo $EnderecoHotel;
                       }
                   }
               }
               else {
                   echo "<p>Erro na execução do comando SELECT</p>";
               }
           }
        
           $conexao_bd->FecharConexao();
           ?>
       </div>
       <div class="coluna-central" id="conteudo">
       </div>
       <div class="coluna-direita">
        <div class="linha1-coluna-direita">
         <div class="calendario" align="center" id="calendario"></div>
        </div>
        <div class="separacao-linhas"></div>
        <div class="linha2-coluna-direita">
        </div>
       </div>
      </div>
      <div class="rodape-pagina">
        <div align="center">
         <p>&copy; Copyright 2016. Designed by William Pereira Alves</p>
        </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>