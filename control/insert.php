<?php
 // inclua o arquivo de configuração do banco de dados
   include "../config/db.php";
// Verifica se os campos do formulário foram enviados antes de acessá-los
if(isset($_POST['nome'], $_POST['senha'], $_POST['email'], $_POST['data_nasc'], $_POST['telefone'])) {

   // Recupere os valores do formulário
   $nome = $_POST['nome'];
   $senha = $_POST['senha'];
   $email = $_POST['email'];
   $senhaSegura = password_hash( $senha, PASSWORD_DEFAULT, ['cost' => 12]);
   $data_nasc = $_POST['data_nasc'];
   $telefone = $_POST['telefone'];

   // SQL para inserir dados
   $sql = "INSERT INTO cadastros (nome, senha, email, data_nascimento, telefone) 
           VALUES (:nome, :senhaSegura, :email, :data_nasc, :telefone)";

   // Preparar e executar a consulta
   $query = $conn->prepare($sql);
   $query->bindParam(':nome', $nome);
   $query->bindParam(':senhaSegura', $senhaSegura);
   $query->bindParam(':email', $email);
   $query->bindParam(':data_nasc', $data_nasc);
   $query->bindParam(':telefone', $telefone);
   
   $query->execute();

   // verificar se a consulta foi bem-sucedida

   if($query) {
      echo "Cadastro realizado com sucesso!";
      header('location: ../login.php');
       exit(); // Encerra o script após o redirecionamento
   } else {
      echo "Erro ao cadastrar!";
   }
  
} else {
   // Se os campos do formulário não foram enviados, exiba uma mensagem de erro ou trate de outra forma
   echo "Por favor, preencha todos os campos do formulário.";
}
?>
