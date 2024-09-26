<?php
require_once '../data/database.php';

if(empty($_GET['id'])){
    echo "Nenhum professor foi fornecido";
    header("Location: ../index.php");
}

$id_professor = $_GET['id'];
$query_delete = "DELETE FROM professor WHERE id = ?";
$stmt = $conexao->prepare($query_delete);
$stmt->bindParam(1, $id_professor);
if($stmt->execute()){
    header("Location: professores.php");
    exit();
}else{
    echo "Erro ao deletar professor: " . $stmt->errorInfo()[2];
}