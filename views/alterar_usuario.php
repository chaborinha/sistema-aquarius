<?php
require_once '../data/database.php';

if (empty($_GET['id'])) {
	echo 'Nenhum ID de aluno foi fornecido!';
	exit();
}

$id_aluno = $_GET['id'];
$msg = '';

$sql_alunos = "SELECT nome, idade, data_de_nascimento, email, altura, peso, remedio FROM alunos WHERE id = ?";
$stmt = $conexao->prepare($sql_alunos);
$stmt->bindParam(1, $id_aluno);
$stmt->execute();
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $data_nascimento = $_POST['data_de_nascimento'];
    $email = $_POST['email'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $remedio = $_POST['remedio'];

	// preparando a querry
	$sql = ("UPDATE alunos SET nome = ?, idade = ?, data_de_nascimento = ?,  email = ?,  altura = ?, peso = ?, remedio = ? WHERE id = ?");
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $idade);
    $stmt->bindParam(3, $data_nascimento);
    $stmt->bindParam(4, $email);
    $stmt->bindParam(5, $altura);
    $stmt->bindParam(6, $peso);
    $stmt->bindParam(7, $remedio);
    $stmt->bindParam(8, $id_aluno);

    // Execute a query
    if ($stmt->execute()) {
        header('Location: alunos.php');
        exit();
    } else {
        echo "Erro ao atualizar aluno: " . $stmt->errorInfo()[2];
    }

}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
    <!-- Link do Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link do Font Awesome (para ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            background-color: #ffffff; 
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h4 {
            color: #007bff; 
        }
        .btn-primary {
            background-color: #007bff; 
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3; 
        }
        .btn-secondary {
            background-color: #6c757d; 
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268; 
        }
    </style>
</head>
<body>

<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center pb-5">
        <div class="col-lg-8 col-md-10">
            <div class="card p-4">

                <div class="row justify-content-center">
                    <div class="col-10">

                        <h4><strong>Atualizar Aluno</strong></h4>

                        <hr>

                        <form action="" method="post">

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($aluno['nome']); ?>" class="form-control">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="idade" class="form-label">Idade</label>
                                    <input type="number" name="idade" id="idade" value="<?= htmlspecialchars($aluno['idade']); ?>" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="data_de_nascimento" class="form-label">Data de Nascimento</label>
                                    <input type="text" class="form-control" name="data_de_nascimento" id="data_de_nascimento" value="<?= htmlspecialchars($aluno['data_de_nascimento']); ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($aluno['email']); ?>">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="altura" class="form-label">Altura (em metros)</label>
                                    <input type="number" step="0.01" class="form-control" name="altura" id="altura" value="<?= htmlspecialchars($aluno['altura']); ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="peso" class="form-label">Peso (em kg)</label>
                                    <input type="number" step="0.1" class="form-control" name="peso" id="peso" value="<?= htmlspecialchars($aluno['peso']); ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="remedio" class="form-label">Remédio</label>
                                <input type="text" class="form-control" name="remedio" id="remedio" value="<?= htmlspecialchars($aluno['remedio']); ?>">
                            </div>


                            <div class="mb-3 text-center">
                                <a href="../index.php" class="btn btn-secondary"><i class="fa-solid fa-xmark me-2"></i>Cancelar</a>
                                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk me-2"></i>Salvar</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Link do Bootstrap JS e jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
