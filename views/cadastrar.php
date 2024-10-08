<?php
require_once('../data/database.php'); 
$search = isset($_POST['search']) ? $_POST['search'] : '';

try {
    $sql = "SELECT id, nome, idade, email, data_de_nascimento, altura, ativo, peso, cor, remedio, PcD FROM alunos WHERE nome LIKE :search";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':search', '%' . $search . '%');
    $stmt->execute();
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Lista de Alunos</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table {
            background-color: #343a40;
        }
        .table th, .table td {
            color: #ffffff;
            vertical-align: middle;
        }
        h2 {
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #495057; 
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
            <h5><i class="fa-solid fa-users me-2"></i>Lista de Alunos</h5>
        </div>
        <div class="col text-end d-flex justify-content-end">
            <a href="../index.php" class="btn btn-secondary" style="margin-right: 10px;"><i class="fa-solid fa-arrow-left me-2"></i>Voltar</a>
        </div>
    </div>

    <hr>

    <!-- Formulário de Pesquisa -->
    <form method="post" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar aluno pelo nome" value="<?= htmlspecialchars($search); ?>">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </div>
        </div>
    </form>

    <?php if(empty($alunos)): ?>
    <p class="my-5 text-center opacity-75">Não existem alunos registados.</p>
    <?php else: ?>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th style="color: #ffffff;">Nome</th>
                    <th class="text-center" style="color: #ffffff;">Idade</th>
                    <th style="color: #ffffff;">Email</th>
                    <th class="text-center" style="color: #ffffff;">Nascimento</th>
                    <th class="text-center" style="color: #ffffff;">Altura</th>
                    <th class="text-center" style="color: #ffffff;">Ativo</th>
                    <th style="color: #ffffff;">Peso</th>
                    <th style="color: #ffffff;">Cor</th>
                    <th style="color: #ffffff;">Remédios</th>
                    <th class="text-center" style="color: #ffffff;">PcD</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="color: #ffffff;">
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['nome']); ?></td>
                    <td class="text-center"><?= htmlspecialchars($aluno['idade']); ?></td>
                    <td><?= htmlspecialchars($aluno['email']); ?></td>
                    <td class="text-center"><?= htmlspecialchars($aluno['data_de_nascimento']); ?></td>
                    <td class="text-center"><?= htmlspecialchars($aluno['altura']); ?></td>
                    <td class="text-center"><?= $aluno['ativo'] ? 'Sim' : 'Não'; ?></td>
                    <td><?= htmlspecialchars($aluno['peso']); ?></td>
                    <td><?= htmlspecialchars($aluno['cor']); ?></td>
                    <td><?= htmlspecialchars($aluno['remedio']); ?></td>
                    <td class="text-center"><?= htmlspecialchars($aluno['PcD']); ?></td>
                    <td class="text-end">
                        <a href="associar_usuario.php?id=<?= $aluno['id'] ?>"><i class="fa-regular fa-pen-to-square me-2"></i>Cadastrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row">
            <div class="col">
                <p class="mb-5"><strong>Total de alunos: <?= count($alunos) ?></strong></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
