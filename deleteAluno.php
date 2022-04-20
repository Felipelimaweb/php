<?php

require_once 'conexao.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (empty($id)) {
    echo "Nenhum aluno encontrado";
    exit;
}

$PDO = db_connect();
$sql = "DELETE FROM aluno WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}
