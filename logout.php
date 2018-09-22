<?php
//sessie wissen
session_start();
session_destroy();

//cookie wissen
setcookie("login", "", -1);

//terug naar loginscherm
header("Location:index.php");

?>