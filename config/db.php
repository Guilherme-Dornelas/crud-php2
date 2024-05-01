<?php

   // cenxao com o banco de dados em pdo

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "usuarios";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

?>