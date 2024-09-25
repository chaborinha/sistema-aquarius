<?php

require_once '../data/database.php';


if (empty($_GET['id'])) {
	echo 'Nenhum ID de aluno foi fornecido';
	exit();
}

$id_aluno = $_GET['id'];
$sql = ("DELETE FROM alunos WHERE id = ?");
$stmt = $conexao->prepare($sql);
$stmt->bindParam(1, $id_aluno);

$msg = '';

if ($stmt->execute()) {
	$msg = 'Aluno deletado com sucesso';
	header("Location:alunos.php");
} else {
	$msg = 'Erro ao deletar aluno' . $stmt->errorInfo()[2];
}

?>

