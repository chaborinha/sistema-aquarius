<?php
require_once('../data/database.php'); 

$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql = "SELECT * FROM modalidades WHERE nome LIKE :search";
$stmt = $conexao->prepare($sql);
$stmt->bindValue(':search', '%' . $search . '%'); 
$stmt->execute();
$modalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Lista de Modalidades</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
        }
        .table-hover tbody tr:hover {
            background-color: #6c757d; 
        }
    </style>
</head>
<body>
<div class="container-fluid mt-5">
<div class="row">
    <div class="col">
        <h5><i class="fa-solid fa-users me-2"></i>Lista de Modalidades</h5>
    </div>
    <div class="col text-end d-flex justify-content-end">
        <a href="../index.php" class="btn btn-secondary" style="margin-right: 10px;"><i class="fa-solid fa-arrow-left me-2"></i>Voltar</a>
        <a href="../functions/query_insert_modalidade.php" class="btn btn-secondary"><i class="fa-solid fa-plus"></i>Nova modalidade</a>
    </div>
</div>

    <hr>

    <form method="post" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar modalidade pelo nome" value="<?= htmlspecialchars($search); ?>">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </div>
        </div>
    </form>

    <?php if(empty($modalidades)): ?>
    <p class="my-5 text-center opacity-75">Não existem modalidades registradas.</p>
    <?php else: ?>

        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Valor</th>
                <th></th>
            </tr>
        </thead>
        <tbody >
        <?php foreach ($modalidades as $modalidade): ?>
            <tr>
                <td><?= htmlspecialchars($modalidade['nome']); ?></td>
                <td><?= htmlspecialchars($modalidade['valor']); ?></td>
                <td class="text-end">
                    <a href="alterar_modalidade.php?id=<?= $modalidade['id'] ?>"><i class="fa-regular fa-pen-to-square me-2"></i>Alterar</a>
                    <span class="mx-2 opacity-50">|</span>
                    <a href="deletar_modalidade.php?id=<?= $modalidade['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esse aluno?')"><i class="fa-solid fa-trash-can me-2"></i>Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col">
            <p class="mb-5"><strong>Total de modalidades: <?= count($modalidades) ?></strong></p>
        </div>
    </div>
    <?php endif; ?>
</div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
