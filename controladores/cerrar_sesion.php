<?php
  session_start();
  unset($_SESSION['USUARIO']); 
  session_destroy();
  header("Location: ../index.php");
  exit;
?>