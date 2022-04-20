<?php

require 'conexao.php';

//Pega ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

//Valida ID
if (empty($id)) {
    echo "Aluno não localizado";
    exit;
}

//Busca os dados do usuário a ser editado.
$PDO = db_connect();
$sql = "SELECT nome, endereco FROM aluno WHERE id=:id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

//Se o método fetch não retornar um array, significa que o ID não é de um usuário válido
if (!is_array($user)) {
    echo "Nenhum aluno encontrado";
    exit;
}

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">

    <title>Edição Alunos</title>
</head>

<body>

    <h2>Edição de Alunos:</h2>

    <form action="editarAluno.php" method="POST">
        <label for="nome">Nome: </label>
        <br>
        <input type="text" name="nome" id="nome">

        <br><br>

        <label for="endereco">Endereco: </label>
        <br>
        <input type="text" name="endereco" id="endereco">

        <br><br>

        <input type="hidden" name="id" value="<?php echo $id ?>">

        <input type="submit" value="Alterar">
    </form>

</body>

</html>