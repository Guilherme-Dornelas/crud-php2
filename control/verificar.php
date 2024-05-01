<?php

session_start();
session_regenerate_id();
  
if(!isset($_SESSION['email'])) {
       header('location: login.php');
       exit();
   }
?>