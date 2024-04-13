<?php 
session_start();
unset($_SESSION["myusername"]);
header("Location: ../login/");
?>