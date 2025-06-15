<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

require 'includes/config.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $localizacao = $_POST['localizacao'];
    $data_evento = $_POST['data_evento'];
    $horario = $_POST['horario'];
    $categoria = $_POST['categoria'];
    $imagem = $_POST['imagem'];
    
    $stmt = $conexao->prepare("INSERT INTO eventos(titulo, descricao, localizacao, data_evento, horario, categoria, imagem, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");   
    $stmt ->bind_param("sssiissi", $titulo, $descricao, $localizacao, $data_evento, $horario, $categoria, $imagem, $_SESSION['user_id']);
    $stmt ->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Evento | AcademicLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles-editCriar_eventos.css">
</head>
<body>
    <header class="container-fluid">
        <div class="container py-4">
            <h1>Criar Novo Evento</h1>
            <p class="subtitle">Preencha os detalhes para cadastrar um evento incrível</p>
        </div>
    </header>

    <main class="container-fluid py-4">
        <div class="container">
            <form method="post" class="event-form">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="col-md-6">
                        <label for="categoria" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" required>
                    </div>
                    <div class="col-12">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="localizacao" class="form-label">Localização</label>
                        <input type="text" class="form-control" id="localizacao" name="localizacao" required>
                    </div>
                    <div class="col-md-4">
                        <label for="data_evento" class="form-label">Data do Evento</label>
                        <input type="date" class="form-control" id="data_evento" name="data_evento" required>
                    </div>
                    <div class="col-md-4">
                        <label for="horario" class="form-label">Horário</label>
                        <input type="time" class="form-control" id="horario" name="horario" required>
                    </div>
                    <div class="col-12">
                        <label for="imagem" class="form-label">URL da Imagem</label>
                        <input type="text" class="form-control" id="imagem" name="imagem" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3 mt-5">
                    <button class="btn" type="submit">Salvar Evento</button>
                    <a class="btn" href="dashboard.php">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>