<?php
require_once '../data/database.php';

$query_modalidade = "SELECT id, nome FROM modalidades";
$stmt = $conexao->prepare($query_modalidade);
$stmt->execute();
$modalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $cor = $_POST['cor'];
    $modalidade_aula = $_POST['modalidade'];
    $salario = $_POST['salario'];

    $query_insert = "INSERT INTO professor(nome, idade, peso, altura, cor, id_modalidade, salario)
    VALUES(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($query_insert);
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $idade);
    $stmt->bindParam(3, $peso);
    $stmt->bindParam(4, $altura);
    $stmt->bindParam(5, $cor);
    $stmt->bindParam(6, $modalidade_aula);
    $stmt->bindParam(7, $salario);
    if($stmt->execute()){
        header("Location: ../views/professores.php");
        exit();
    }else{
        echo "Erro ao cadastrar professor: " . $stmt->errorInfo()[2]; 
    }

}

?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Cadastro Professor</title>
</head>
<body>

<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center pb-5">
        <div class="col-lg-8 col-md-10">
            <div class="card p-4">

                <div class="row justify-content-center">
                    <div class="col-10">

                        <h4 style="color: #007bff; "><strong>Cadastro Professor</strong></h4>

                        <hr>

                        <form action="" method="post">

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="idade" class="form-label">Idade</label>
                                <input type="number" name="idade" id="idade" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="peso" class="form-label">Peso</label>
                                <input type="number" name="peso" id="peso" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="altura" class="form-label">Altura</label>
                                <input type="number" step="0.01" name="altura" id="altura" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="cor" class="form-label">Cor</label>
                                <input type="text" name="cor" id="cor" class="form-control">
                            </div>

                            <div class="mb-3">
                                <select name="modalidade" class="form-control  mx-auto"> 
                                    <option value="">Selecione uma modalidade</option>
                                    <?php foreach ($modalidades as $row): ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nome']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="salario" class="form-label">Salario</label>
                                <input type="number" step="0.001" name="salario" id="salario" class="form-control">
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

   

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>