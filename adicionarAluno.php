<?php

require_once 'conexao.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;

var_dump($nome, $endereco);
if (empty($nome) || empty($endereco)) {
    echo "Preencha todos os campos";
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO aluno(nome, endereco) VALUES (:nome, :endereco)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':endereco', $endereco);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
