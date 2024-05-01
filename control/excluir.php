<?php

   include '../config/db.php';

    if(isset($_GET['id'])) {
         $id = $_GET['id'];
    
         $sql = "DELETE FROM cadastros WHERE id = ?";
         $query = $conn->prepare($sql);
         $query->bindParam(1, $id);
         $query->execute();
    
         if($query) {
              echo "Registro excluído com sucesso!";
              header('location: ../home.php');
         } else {
              echo "Erro ao excluir registro!";
         }
    } else {
         echo "ID não informado!";
    }



?>