<!DOCTYPE HTML>
<html>
 <head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <meta content="Site Hotel LOREM IPSUM" name="description">
  <title>Hotel LOREM IPSUM</title>
  <link rel="stylesheet" href="../css/retorno_consulta.css" type="text/css">
  <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
 
  <script> function carregar(pagina){$("#formulario-edicao").load(pagina);} </script>

  <script language='JavaScript'>function fechar_formulario() { location.href="index.php";}</script>
  
 </head>

 <body>
     <?php
     require_once("../classBancoDados.inc");
     require_once("../funcoes_diversas.php");

     session_start();

     if(isset($_SESSION["GERENTE_LOGADO"]) && ($_SESSION["GERENTE_LOGADO"] == 1)) {
        $CodigoHotel = $_SESSION["HOTEL_GERENTE"];
     }
     else {
         $CodigoHotel = 0;
     }
     ?>
     
     <?php if($CodigoHotel != 0) { ?>
     <div class="retorno-consulta" id="lista-usuarios">
        <h3><center>Edição de apartamentoo</center></h3><br>
        <table>
        <tr><th>Apto</th><th>Chave</th><th>TV</th><th>Frigobar</th><th>Banheira</th><th>Escrivaninha</th><th></th></tr>
        <?php echo ListaApartamentos($CodigoHotel)?>
        </table>
     </div>
     <div id="formulario-edicao"></div>
     <?php } else { ?>
     <h3>Para editar um apartamento é preciso estar logado no sistema...</h3>
     <?php } ?>
     <br>
     <button type='button' name='btnFechar' onclick='fechar_formulario()'>Fechar</button>
 </body>
</html>
