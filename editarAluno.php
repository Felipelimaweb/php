<?php

require 'conexao.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

if (empty($nome) || empty($endereco)) {
    echo "Volte e preencha todos os campos";
    exit;
}

$PDO = db_connect();
$sql = "UPDATE aluno SET nome = :nome, endereco = :endereco WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':endereco', $endereco);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Erro ao atualizar aluno!";
    print_r($stmt->errorInfo());
}
