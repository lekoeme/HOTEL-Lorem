<!DOCTYPE HTML>
<html>
 <head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <meta content="Site Hotel LOREM IPSUM" name="description">
  <title>Hotel LOREM IPSUM</title>
  <link rel="stylesheet" href="../css/estilos_gerais.css" type="text/css">
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

     if(isset($_SESSION["GERENTE_LOGADO"]) && ($_SESSION["GERENTE_LOGADO"] == 1)) {
         $NomeUsuario = $_SESSION["NOME_GERENTE"];
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
           <p>Usuário: <?=$NomeUsuario?></p>
       </div>
       <div class="barra-menu">
        <div class="dropdown">
         <button class="dropbutton">Usuários</button>
         <div class="dropdown-opcoes">
             <a onclick="carregar('ger_cadastro_usuario.php')" href="#">Cadastrar</a>
             <a onclick="carregar('ger_selecao_usuario.php')" href="#">Editar</a>
         </div>
        </div>
        <div class="dropdown">
         <button class="dropbutton" onclick="carregar('ger_selecao_apartamento.php')">Apartamentos</button>
        </div>
        <div class="dropdown">
         <button class="dropbutton" onclick="carregar('ger_login.html')">Login</button>
        </div>
        <div class="dropdown">
         <button class="dropbutton" onclick="carregar('ger_logout.php')">Logout</button>
        </div>
       </div>
      </div>
      <div class="conteudo-corpo">
       <div class="coluna-esquerda-adm"></div>
       <div class="coluna-central-adm" id="conteudo"></div>
       <div class="coluna-direita">
        <div class="linha1-coluna-direita">
         <div class="calendario" align="center" id="calendario"></div>
        </div>
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