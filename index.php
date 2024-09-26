<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Home Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        #sidebar {
            background-color: #6f42c1; 
            height: 100vh;
            width: 200px;
            position: fixed; 
            padding: 20px; 
        }

        .main-content {
            margin-left: 220px; 
            padding: 20px;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }

        .card {
            margin: 10px;
            width: 20rem; 
            height: 10rem; 
        }

        .card a {
            color: white; 
            text-decoration: none; 
            display: block; 
            height: 100%; 
            text-align: center; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .card:hover {
            opacity: 0.9; 
        }

        .sidebar-link {
            color: white; 
            text-decoration: none; 
            padding: 10px 0; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.5); 
            transition: 0.3s; 
            display: block; 
            outline: none;
        }

        .sidebar-link:hover {
            border-bottom: 1px solid white; 
            color: white;
        }

    </style>
</head>
<body>
<div id="sidebar">
    <div id="sidebar-nav" class="text-sm-start min-vh-100">
        <h4 class="text-light">Cadastrar</h4>
        <a href="functions/query_insert_alunos.php" style="text-decoration: none;" class="sidebar-link">Aluno</a>
        <a href="functions/query_insert_professor.php" style="text-decoration: none;" class="sidebar-link">Professor</a>
        <a href="functions/query_insert_modalidade.php" style="text-decoration: none;" class="sidebar-link">Modalidade</a>
    </div>
</div>

<main class="main-content">
    <div class="row">
        <div class="col-12 d-flex justify-content-center flex-wrap">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <a href="views/cadastrar.php">Cadastrar</a>
                </div>
            </div>
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <a style="color:#f8f9fa" href="views/alunos.php">Alunos</a>
                </div>
            </div>
            <div class="card text-white bg-success">
                <div class="card-body">
                    <a href="views/professores.php">Professores</a>
                </div>
            </div>
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <a href="views/modalidades.php">Modalidades</a>
                </div>
            </div>
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <a href="views/aluno_modalidade.php">Alunos/Modalidades</a>
                </div>
            </div>
            <div class="card text-white bg-info">
                <div class="card-body">
                    <a href="views/inativos.php">Inativos</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
