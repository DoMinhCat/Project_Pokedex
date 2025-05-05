<?php
session_start();

session_unset();
session_destroy();

setcookie("cookienom", $_GET["nom"],time()-10);
setcookie("cookieid", $_GET["identifiant"],time()-10);

header('Location: index.php');
exit();
?>