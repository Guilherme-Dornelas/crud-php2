<?php
include "../config/db.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM cadastros WHERE id = ?";
    $query = $conn->prepare($sql);
    $query->bindParam(1, $id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if($result) {
        echo '
        <form action="" method="POST">
            <input type="hidden" name="id" value="'.$result['id'].'">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="'.$result['nome'].'">
            <label for="email">Email:</label>
            <input type="email" name="email" value="'.$result['email'].'">
            <label for="data_nasc">Data de Nascimento:</label>
            <input type="date" name="data_nasc" value="'.$result['data_nascimento'].'">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="'.$result['telefone'].'">
            <button type="submit">Atualizar</button>
        </form>';

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $data = $_POST["data_nasc"];
            $email = $_POST["email"];
            $telefone= $_POST["telefone"];

            $sql = "UPDATE cadastros SET nome = ?, data_nascimento = ?, email = ?, telefone = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $query->execute([$nome, $data, $email, $telefone, $id]);

            if ($query) {
                header("Location: ../home.php");
                exit();
            } else {
                echo "Erro ao atualizar!";
            }
        }
    } else {
        echo "Registro não encontrado!";
    }
} else {
    echo "ID não informado!";
}
?>
