<?php
session_start();
$_SESSION["CODIGO_HOSPEDE"] = $_GET["CodigoHospede"];
$_SESSION["NOME_HOSPEDE"] = $_GET["NomeHospede"];
header("location: index.php");
