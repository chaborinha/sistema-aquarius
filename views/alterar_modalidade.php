<?php
require_once "../data/database.php";

if (empty($_GET['id'])) {
	echo 'Nenhum ID de aluno foi fornecido!';
	exit();
}

$id_modalidade = $_GET['id'];

$sql_modalidades = "SELECT nome, valor FROM modalidades WHERE id = ?";
$stmt = $conexao->prepare($sql_modalidades);
$stmt->bindParam(1, $id_modalidade);
$stmt->execute();
$modalidade = $stmt->fetch(PDO::FETCH_ASSOC);


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];

    //preparar query de atualização
    $query_atualizar = "UPDATE modalidades SET nome = ?, valor = ? WHERE id = ?";
    $stmt = $conexao->prepare($query_atualizar);
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $valor);
    $stmt->bindParam(3, $id_modalidade);
    if ($stmt->execute()){
        header("Location: modalidades.php");
        exit();
    }else{
        echo "Erro ao alterar modalidade: " . $stmt->errorInfo()[2]; 
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

    <title>Alterar Modalidade</title>
</head>
<body>

<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center pb-5">
        <div class="col-lg-8 col-md-10">
            <div class="card p-4">

                <div class="row justify-content-center">
                    <div class="col-10">

                        <h4><strong>Alterar Modalidade</strong></h4>

                        <hr>

                        <form action="" method="post">

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($modalidade['nome']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="valor" class="form-label">Valor</label>
                                <input type="number" step="0.01" name="valor" id="valor" class="form-control" value="<?= htmlspecialchars($modalidade['valor']) ?>" required>
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