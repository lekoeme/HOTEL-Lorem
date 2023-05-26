<?php
session_start();

if(isset($_SESSION["GERENTE_LOGADO"])) {
    session_unset();
    session_destroy();
    echo "<h3>Logout do usuário efetuado...</h3>";
}
