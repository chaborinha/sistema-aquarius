<?php
require_once('../data/database.php');


if(empty($_GET['id'])){
    echo "Nenhuma modalidade fornecida";
    exit();
}

$id_modalidade = $_GET['id'];
$query_delete = "DELETE FROM modalidades WHERE id = ?";
$stmt = $conexao->prepare($query_delete);
$stmt->bindParam(1, $id_modalidade);
if($stmt->execute()){
    header("Location: modalidades.php");
    exit();
}else{
    echo "Erro ao deletar modalidade: " . $stmt->errorInfo()[2]; 
}