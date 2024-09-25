<?php

require_once '../data/database.php';

if (empty($_GET['id'])) {
    echo 'Nenhum ID de aluno foi fornecido!';
    exit();
}

$id_aluno = $_GET['id'];

$query_nome = "SELECT nome FROM alunos WHERE id = ?";
$stmt = $conexao->prepare($query_nome);
$stmt->bindParam(1, $id_aluno);
$stmt->execute();
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

$query_modalidade = "SELECT id, nome FROM modalidades";
$stmt = $conexao->prepare($query_modalidade);
$stmt->execute();
$modalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modalidade_id = $_POST['id'];
    
    $sql_insert = "INSERT INTO modalidades_aluno (id_aluno, id_modalidade) VALUES (?, ?)";
    $stmt = $conexao->prepare($sql_insert);
    $stmt->bindParam(1, $id_aluno);
    $stmt->bindParam(2, $modalidade_id);

    if ($stmt->execute()) {
        $mensagem = "Aluno cadastrado na modalidade.";
    } else {
        $mensagem = "Erro: " . $stmt->errorInfo()[2];     
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Aluno: <?php echo htmlspecialchars($aluno['nome']); ?></h1>
    
    <?php if (isset($mensagem)): ?>
        <div class="alert alert-info text-center"><?php echo $mensagem; ?></div>
    <?php endif; ?>

    <form action="" method="post" class="text-center">
        <div class="form-group">
            <select name="id" class="form-control w-50 mx-auto"> 
                <option value="">Selecione...</option>
                <?php foreach ($modalidades as $row): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nome']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
