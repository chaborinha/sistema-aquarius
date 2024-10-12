<?php
require_once '../data/database.php';
$query_modalidades = "SELECT id, nome FROM modalidades";
$stmt = $conexao->prepare($query_modalidades);
$stmt->execute();
$modalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

// =======================================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modalidade_id = $_POST['modalidade'];
    $idade = $_POST['idade'];
    
    // Definindo a condição da idade
    if ($idade === 'menor_9') {
        $idade_condition = 'a.idade <= 9';
    } elseif ($idade === '9_15') {
        $idade_condition = 'a.idade > 9 AND a.idade <= 15';
    } elseif ($idade === '15_20') {
        $idade_condition = 'a.idade > 15 AND a.idade <= 20';
    } elseif ($idade === 'maior_40') {
        $idade_condition = 'a.idade > 40';
    } else {
        $idade_condition = '1=1'; // Sem filtro de idade
    }

    $query_modalidade_aluno = "SELECT
            a.nome AS aluno,
            a.idade AS idade,
            m.nome AS modalidade,
            a.ativo
        FROM 
            alunos a
        JOIN 
            modalidades_aluno ma ON a.id = ma.id_aluno
        JOIN 
            modalidades m ON ma.id_modalidade = m.id
        WHERE 
            a.ativo IS TRUE
            AND m.id = ?
            AND $idade_condition
        ORDER BY 
            a.nome";

    $stmt = $conexao->prepare($query_modalidade_aluno);
    $stmt->bindParam(1, $modalidade_id);
    $stmt->execute();
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Aqui você atribui os alunos
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-fluid {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h5 {
            color: #343a40;
        }
        .form-group select {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        table {
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 5px;
        }
        th, td {
            vertical-align: middle;
        }
        th {
            background-color: #343a40;
            color: #ffffff;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    <title>Alunos/Modalidades</title>
</head>
<body>

<div class="container-fluid mt-5"> 
    <div class="row">
        <div class="col">
            <h5><i class="fa-solid fa-users me-2"></i>Alunos/Modalidades</h5>
        </div>
        <div class="col text-end d-flex justify-content-end">
            <a href="../index.php" class="btn btn-secondary" style="margin-right: 10px;"><i class="fa-solid fa-arrow-left me-2"></i>Voltar</a>
            <a href="../views/cadastrar.php" class="btn btn-secondary"><i class="fa-solid fa-plus"></i>Novo Cadastro</a>
        </div>
    </div>

    <div class="mt-5">
        <form action="" method="post" class="text-center">
            <div class="form-group">
                <select name="modalidade" class="form-control w-50 mx-auto mt-2f"> 
                    <option value="">Selecione Modalidade</option>
                    <?php foreach ($modalidades as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nome'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="idade" class="form-control w-50 mx-auto mt-2"> 
                    <option value="">Filtrar Idade</option>
                    <option value="menor_9">Menor que 9</option>
                    <option value="9_15">Entre 9 e 15</option>
                    <option value="15_20">Entre 15 e 20</option>
                    <option value="maior_40">Maiores que 40</option>
                    <option value="todas">Todas</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Visualizar</button>
        </form>
    </div>

    <?php if(empty($alunos)): ?>
        <p class="my-5 text-center opacity-75">Não existem alunos registrados.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Idade</th>
                    <th>Modalidade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?= $aluno['aluno'] ?></td>
                        <td><?= $aluno['idade'] ?></td>
                        <td><?= $aluno['modalidade'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

</body>
</html>
