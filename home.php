<?php
include "./control/verificar.php";
echo "<a href='logout.php'>sair</a>";

include "./config/db.php";

$sql = "SELECT * FROM cadastros";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$lista = ''; 
if($result){
    foreach($result as $dados) {
        $lista .= '
        <tr>
            <td>' . $dados['id'] . '</td>
            <td>' . $dados['nome'] . '</td>
            <td>' . $dados['email'] . '</td>
            <td>' . $dados['data_nascimento'] . '</td>
            <td>' . $dados['telefone'] . '</td>
            
            <td style="display: flex; gap:10px;">
                <a href=" ./control/update.php?id='.$dados["id"].'" class="btnEdit" title="Editar" style="display: flex; align-items: center; justify-content: center;">
                   <i class="bi bi-pencil-square"></i>
                </a>
            
                <a href="./control/excluir.php?id='.$dados["id"].'"  class="btnEXIT" style="display: flex; align-items: center; justify-content: center;" title="Apagar" >
                      <i class="bi bi-x-lg"></i>
                </a>
            </td>
        </tr>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabela de Cadastros</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    /* Estilo personalizado para o cabeçalho da tabela */
    .dark-blue-header {
      background-color: #343a40; /* Azul escuro */
      color: #fff; /* Texto branco */
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Tabela de Cadastros</h2>
  <table class="table">
    <thead class="dark-blue-header">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Data de Nascimento</th>
        <th>Telefone</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $lista; ?>
    </tbody>
  </table>
</div>

</body>
</html>
