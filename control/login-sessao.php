<?php
    // include "./config/db.php";
    session_start();
  
    if(isset($_POST['login_email'], $_POST['login_senha'])) {
    
        $email = $_POST['login_email'];
        $senha = $_POST['login_senha'];
    
        $sql = "SELECT * FROM cadastros WHERE email = ? AND senha = ?";
    
        $query = $pdo->prepare($sql);
        $query->bindParam(1, $email);
        $query->bindParam(2, $senha);
    
        $query->execute();
    
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        if($result) {
            $_SESSION['email'] = $result['email'];
            // $_SESSION['nome'] = $result['nome'];
            // $_SESSION['id'] = $result['id'];
             header('location: home.php');
             exit();
        } else {
            echo "Email ou senha incorretos!";
        }
    
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }

?>
