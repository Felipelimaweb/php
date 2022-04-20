<?php

require_once 'conexao.php';

$PDO = db_connect();

$sql_count = "SELECT COUNT(*) id FROM aluno ORDER BY nome ASC";

$sql = "SELECT id, nome, endereco FROM aluno ORDER BY nome ASC";

$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

$stmt = $PDO->prepare($sql);
$stmt->execute();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
</head>

<body>

    <h2>Cadastro de Alunos</h2>

    <form action="adicionarAluno.php" method="POST">
        <label for="nome">Nome: </label>
        <br>
        <input type="text" name="nome" id="nome">

        <br><br>

        <label for="endereco">Endereco: </label>
        <br>
        <input type="text" name="endereco" id="endereco">

        <br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <h2>Lista de Alunos</h2>
    <p>Total de alunos: <?php echo $total ?></p>

    <?php if ($total > 0) : ?>

        <table width="30%" border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $user['nome'] ?></td>
                        <td><?php echo $user['endereco'] ?></td>
                        <td>
                            <a href="editarFormularioAluno.php?id=<?php echo $user['id'] ?>">Editar</a>
                            <a href="deleteAluno.php?id=<?php echo $user['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php else : ?>

        <p>Nenhum aluno encontrado</p>

    <?php endif; ?>

</body>

</html>