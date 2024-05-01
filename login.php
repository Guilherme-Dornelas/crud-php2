<?php
include  "./config/db.php";
session_start();

if(isset($_POST['login_email'], $_POST['login_senha'])) {
    $email = $_POST['login_email'];
    $senha = $_POST['login_senha'];

    // Busca no banco de dados o registro correspondente ao email fornecido
    $sql = "SELECT * FROM cadastros WHERE email = ?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $email);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Verifica se o registro foi encontrado e se a senha corresponde
    if($result && password_verify($senha, $result['senha'])) {
        $_SESSION['email'] = $result['email'];
        // Redireciona para a página home.php
        header('location: home.php');
        exit(); // Encerra o script após o redirecionamento
    } else {
        echo "Email ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2>Login</h2>
        <form method="post" action="login.php">
          <div class="form-group">
            <label for="login_email">Email:</label>
            <input type="email" class="form-control" name="login_email" id="login_email" placeholder="Digite seu email">
          </div>
          <div class="form-group">
            <label for="login_senha">Senha:</label>
            <input type="password" class="form-control" name="login_senha" id="login_senha" maxlength="8" placeholder="Digite sua senha">
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          <a href="cadastro.php">Cadastrar agora!</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
