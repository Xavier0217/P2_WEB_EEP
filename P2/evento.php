<?php

require 'includes/config.php';

if (!isset($_GET['id'])){
    echo "Evento não expecificado.";
    exit();
}

$id = $_GET['id'];

$stmt = $conexao->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$resultado = $stmt->get_result();
$evento = $resultado->fetch_assoc();

if (!$evento){
    echo "Evento não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($evento['titulo']); ?> | AcademicLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles-evento.css">
</head>
<body>
    <header class="event-header">
        <div class="container">
            <h1><?php echo htmlspecialchars($evento['titulo']); ?></h1>
            <a href="index.php" class="btn-voltar">Voltar ao Mural Público</a>
        </div>
    </header>

    <main class="event-container">
        <div class="event-card">
            <?php if (!empty($evento['imagem'])): ?>
                <img src="<?php echo htmlspecialchars($evento['imagem']); ?>" class="event-img" alt="<?php echo htmlspecialchars($evento['titulo']); ?>">
            <?php endif; ?>
            
            <div class="event-body">
                <div class="event-description">
                    <?php echo nl2br(htmlspecialchars($evento['descricao'])); ?>
                </div>
                
                <div class="event-details">
                    <p><strong>Local:</strong> <?php echo htmlspecialchars($evento['localizacao']); ?></p>
                    <p><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($evento['data_evento'])); ?> às <?php echo htmlspecialchars($evento['horario']); ?></p>
                    <p><strong>Categoria:</strong> <?php echo htmlspecialchars($evento['categoria']); ?></p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>