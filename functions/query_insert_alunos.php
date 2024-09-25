<?php
 require_once('../data/database.php');

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $data_nascimento = $_POST['data_de_nascimento'];
    $email = $_POST['email'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $cor = $_POST['cor'];
    $remedio = $_POST['remedio'];
    $pcd = $_POST['PcD'];


    $dateTime = DateTime::createFromFormat('d/m/Y', $data_nascimento);
    if ($dateTime) {
        $data_nascimento = $dateTime->format('Y-m-d');
    } else {
        echo "Data de nascimento inválida.";
        exit;
    }


    $sql = "INSERT INTO alunos (
        nome,
        idade,
        email,
        data_de_nascimento,
        altura,
        peso,
        cor,
        remedio,
        PcD,
        ativo
    ) VALUES (
        :nome,
        :idade,
        :email,
        :data_de_nascimento,
        :altura,
        :peso,
        :cor,
        :remedio,
        :pcd,
        true
    )";

    $stmt = $conexao->prepare($sql);


    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':data_de_nascimento', $data_nascimento);
    $stmt->bindParam(':altura', $altura);
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':cor', $cor);
    $stmt->bindParam(':remedio', $remedio);
    $stmt->bindParam(':pcd', $pcd);

    // Execute a query
    if ($stmt->execute()) {
        header('Location: ../views/alunos.php');
        exit();
    } else {
        echo "Erro ao cadastrar aluno: " . $stmt->errorInfo()[2]; 
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
            background-color: #f8f9fa; /* Cor de fundo suave */
        }
        .card {
            background-color: #ffffff; /* Cor do cartão */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        h4 {
            color: #007bff; /* Cor do título */
        }
        .btn-primary {
            background-color: #007bff; /* Cor do botão "Salvar" */
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Cor do botão "Salvar" ao passar o mouse */
        }
        .btn-secondary {
            background-color: #6c757d; /* Cor do botão "Cancelar" */
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Cor do botão "Cancelar" ao passar o mouse */
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

                        <h4><strong>Cadastro de Alunos</strong></h4>

                        <hr>

                        <form action="" method="post">

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="idade" class="form-label">Idade</label>
                                    <input type="number" name="idade" id="idade" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="data_de_nascimento" class="form-label">Data de Nascimento</label>
                                    <input type="text" class="form-control" name="data_de_nascimento" id="data_de_nascimento">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="altura" class="form-label">Altura (em metros)</label>
                                    <input type="number" step="0.01" class="form-control" name="altura" id="altura">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="peso" class="form-label">Peso (em kg)</label>
                                    <input type="number" step="0.1" class="form-control" name="peso" id="peso">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="cor" class="form-label">Cor</label>
                                    <input type="text" class="form-control" name="cor" id="cor">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="remedio" class="form-label">Remédio</label>
                                <input type="text" class="form-control" name="remedio" id="remedio">
                            </div>

                            <div class="mb-3">
                                <label for="pcd" class="form-label">PcD</label>
                                <select class="form-control" id="pcd" name="PcD">
                                    <option value="não">Não</option>
                                    <option value="sim">Sim</option>
                                </select>
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




